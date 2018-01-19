<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MoneyValidationFormRequest;
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

    public function depositStore(MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->value);

        if ($response['success'])
            return redirect()
                ->route('admin.balance')
                ->with('success', $response['message']);

        return redirect()
            ->back()
            ->with('error', $response['message']);

    }

    public function withdraw()
    {
        return view('admin.balance.withdraw');
    }

    public function withdrawStore(MoneyValidationFormRequest $request)
    {

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->value);

        if ($response['success'])
            return redirect()
                ->route('admin.balance')
                ->with('success', $response['message']);

        return redirect()
            ->back()
            ->with('error', $response['message']);
    }

    public function transfer()
    {
        return view('admin.balance.transfer');
    }

    public function confirmTransfer(Request $request)
    {
        dd($request->all());
    }
}
