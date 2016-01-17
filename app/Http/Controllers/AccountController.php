<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 11:18 AM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\AccountService;

class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDeposit()
    {
        return view('account.deposit', $this->args);
    }

    public function postDeposit(Request $request, AccountService $accountService)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);

        $amount = floatval($request->input('amount'));
        $account = $this->user->account;
        $transaction = $accountService->deposit($account, $amount);
        if ($transaction) {
            $request->session()->flash('message', 'Deposit Successful');
            return redirect()->route('account.deposit');
        } else {
            $request->session()->flash('message', 'Deposit Failed');
            return redirect()->back()->withInput();
        }
    }

    public function getWithdraw()
    {
        return view('account.withdraw', $this->args);
    }

    public function getTransactions()
    {
        $account = $this->user->account;
        $transactions = $account->transactions;

        $this->args['account'] = $account;
        $this->args['transactions'] = $transactions;
        return view('account.transactions', $this->args);
    }
}