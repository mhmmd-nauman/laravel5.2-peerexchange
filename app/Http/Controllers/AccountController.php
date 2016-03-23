<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 11:18 AM
 */

namespace App\Http\Controllers;


use App\Models\MoneyBuy;
use Illuminate\Http\Request;
use App\Services\AccountService;

class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function getDeposit()
    {
        $this->args['account'] = $this->user->account;
        return view('account.deposit', $this->args);
    }

    public function postDeposit(Request $request, AccountService $accountService)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:10'
        ]);

        $amount = floatval($request->input('amount'));
        $currency =  $request->input('currency');
        $user_id = $this->user->id;
        $transaction = $accountService->deposit($user_id, $amount,$currency);
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
        $account = $this->user->account;
        $this->args['account'] = $account;
        $this->args['moneyBuys'] = MoneyBuy::where('account_id', $account->id)->orderBy('created_at', 'desc')->get();
        return view('account.withdraw', $this->args);
    }

    public function postWithdraw(Request $request, AccountService $accountService)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:10'
        ]);

        $amount = floatval($request->input('amount'));
        $account = $this->user->account;
        try {
            $transaction = $accountService->withdraw($account, $amount);
            if ($transaction) {
                $request->session()->flash('message', 'Withdraw Successful');
                return redirect()->route('account.withdraw');
            } else {
                $request->session()->flash('message', 'Withdraw Failed');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $ex) {
            $request->session()->flash('error', 'Withdraw Failed: ' . $ex->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function getTransactions()
    {
        $accounts = $this->user->account;
        //echo $user_id = $this->user->id;
        
        foreach($accounts as $account){
            $transactions[] = $account->transactions;
        }
        //echo "<pre>";
        //print_r($transactions);
        //echo "</pre>";
        //exit;
        //$transactions = MoneyBuy::where('account_id', $account->id)->orderBy('created_at', 'desc')->get();
        //$transactions = $account->transactions;

        $this->args['account'] = $account;
        $this->args['transactions'] = $transactions;
        return view('account.transactions', $this->args);
    }
}