<?php

namespace App\Http\Controllers\Admin;

use App\Models\Balance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    public function index()
    {
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;

        return view('admin.balance.index', compact('amount'));
    }

    public function deposit()
    {
        return view('admin.balance.deposit');
    }

    public function depositStore(Request $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $balance->deposit($request->value);

    }
}
