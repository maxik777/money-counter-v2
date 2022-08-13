<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSpendsRequest;
use App\Models\Spends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $spends = Spends::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->where('user_id', $user->id)
            ->get()
            ->sum('price');

        $spends = $spends ?: 0.00;
        return response()->json([
            'status' => 200,
            'spends' => $spends
        ]);
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
            $spends = Spends::select('name')
                ->where('user_id', $user->id)
                ->where('name', 'like', '%'.$name.'%')
                ->orderByDesc('created_at')
                ->limit(10)
                ->distinct()
                ->get();
            $spendArr = [];
            foreach ($spends as $spend){
                $spendArr[] = $spend->name;
            }

            return response()->json($spendArr);
        }
    }
}
