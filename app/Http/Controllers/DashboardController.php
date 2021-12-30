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
            'spends' => number_format($spends, 2)
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
}
