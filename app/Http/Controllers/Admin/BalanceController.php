<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MoneyValidationFormRequest;
use App\Models\Balance;
use App\Models\Historic;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    private $numPage = 5;

    public function index()
    {
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;

        return view('admin.balance.index', compact('amount'));
    }

    public function deposit()
    {
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;

        return view('admin.balance.deposit', compact('amount'));
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
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;
        return view('admin.balance.withdraw', compact('amount'));
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

    public function confirmTransfer(Request $request, User $user)
    {
        if (!$sender = $user->getSender($request->sender))
            return redirect()
                ->back()
                ->with('error', 'Usúario ou Email informado não encontrado!');
        if ($sender->id == auth()->user()->id)
            return redirect()
                ->back()
                ->with('error', 'Não ha necessidade de tranferir pra você mesmo!');

        $balance = auth()->user()->balance;

        return view('admin.balance.transfer-confirm', compact('sender', 'balance'));


    }

    public function transferStore(MoneyValidationFormRequest $request, User $user)
    {

        if (!$sender = $user->find($request->sender_id))
            return redirect()
                ->route('balance.transfer')
                ->with('success', 'Recebedor Não Encontrado!');


        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transfer($request->value, $sender);

        if ($response['success'])
            return redirect()
                ->route('admin.balance')
                ->with('success', $response['message']);

        return redirect()
            ->route('balance.transfer')
            ->with('error', $response['message']);
    }

    public function historic(Historic $historic)
    {
        $historics = auth()
            ->user()
            ->historics()
            ->with(['userSender'])
            ->paginate($this->numPage);

        $types = $historic->type();

        return view('admin.balance.historic', compact('historics', 'types'));
    }

    public function searchHistoric(Request $request, Historic $historic)
    {
        $dataForm = $request->except('_token');
        $historics = $historic->sarch($dataForm, $this->numPage);

        $types = $historic->type();

        return view('admin.balance.historic', compact('historics', 'types','dataForm'));
    }

}
