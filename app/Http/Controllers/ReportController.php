<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSpendsRequest;
use App\Models\Spends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $spends = Spends::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->where('user_id', $user->id)
                ->get();

            return Datatables::of($spends)
                ->addColumn('action', function ($row) {
                    $actionBtn =
                    '<a data-id = ' . $row->id . ' class="edit-modal btn btn-success btn-sm">Edit</a>
                    <a data-id = ' . $row->id . ' class="delete-modal btn btn-danger btn-sm" >Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('report');
    }

    public function getSpendsRecord($id, Request $request)
    {
        $user = Auth::user();
        $spendsRecord = Spends::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        return response()->json([
            'status' => 200,
            'name' => $spendsRecord->name,
            'price' => $spendsRecord->price
        ]);
    }

    public function update($id, UpdateSpendsRequest $request)
    {
        $user = Auth::user();
        $spendsRecord = Spends::where('id', $id)
            ->where('user_id', $user->id)
            ->first();
        $name = $request->input('name');
        $price = $request->input('price');
        $spendsRecord->name = $name;
        $spendsRecord->price = $price;
        $spendsRecord->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $deleteResult = Spends::where('id', $id)
            ->where('user_id', $user->id)
            ->delete();
        if ($deleteResult){
            return response()->json([
                'status' => 200
            ]);
        }
    }
}
