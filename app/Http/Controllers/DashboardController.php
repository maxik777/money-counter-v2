<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSpendsRequest;
use App\Models\Spends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $user = Auth::user();

            if ($request->from && $request->to){
                $spends = Spends::whereBetween('created_at', [$request->from, $request->to])
                    ->where('user_id', $user->id)
                    ->get()
                    ->sum('price');
                return response()->json([
                    'status' => 200,
                    'current_spends' => $spends,
                ]);
            }

            $spendsCurrentMonth = Spends::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->where('user_id', $user->id)
                ->get()
                ->sum('price');

            $spendsPreviousMonth = Spends::whereMonth('created_at', Carbon::now()->subMonths(1)->format('m'))
                ->whereYear('created_at', date('Y'))
                ->where('user_id', $user->id)
                ->get()
                ->sum('price');

            $spendsCurrentMonth = $spendsCurrentMonth ?: 0.00;
            return response()->json([
                'status' => 200,
                'current_spends' => $spendsCurrentMonth,
                'previous_spends' => $spendsPreviousMonth
            ]);
        }
    }

    public function saveSpends(SaveSpendsRequest $request)
    {
        $user = Auth::user();
        $name = $request->input('name');
        $price = $request->input('price');
        $spends = new Spends();
        $spends->user_id = $user->id;
        $spends->name = $name;
        $spends->price = $price;

        $result = $spends->save();

        if ($result){
            return response()->json([
                'status' =>200
            ]);
        }
    }

    public function getSpendsNames($name, Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();

            // Fetch a larger set of records ordered by created_at
            $spends = Spends::select('name', 'created_at')
                ->where('user_id', $user->id)
                ->where('name', 'like', '%'.$name.'%')
                ->orderByDesc('created_at')
                ->limit(100) // Fetch more records to ensure we get enough unique names
                ->get();

            // Filter distinct names
            $uniqueSpends = $spends->unique('name')->values();

            // Limit to the first 10 distinct names
            $spendArr = $uniqueSpends->take(10)->pluck('name');

            return response()->json($spendArr);
        }
    }
}
