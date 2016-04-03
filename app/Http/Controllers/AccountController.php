<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 11:18 AM
 */

namespace App\Http\Controllers;


use App\Models\MoneyBuy;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Services\AccountService;
use Session;

class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function getBankAccounts()
    {
        $this->args['bankaccounts'] = $this->user->bankaccount;
       
        return view('account.bankaccounts', $this->args);
    }
    public function postBankAccount(Request $request)
    {
        //$this->user->id;
        $this->validate($request, [
            'bank_name' => 'required|min:3',
            'bank_account_title' => 'required|min:3',
            'bank_account_number' => 'required|min:3',
            'currency_code' => 'required|min:3',
            'country_code' => 'required|min:2'
        ]);

        $bank_name = $request->input('bank_name');
        $bank_account_title =  $request->input('bank_account_title');
        $bank_account_number =  $request->input('bank_account_number');
        $currency_code =  $request->input('currency_code');
        $country_code =  $request->input('country_code');
        $is_primary =  $request->input('is_primary');
        $user_id = $this->user->id;
        $bankaccount = new BankAccount();
        $bankaccount->user_id = $user_id;
        $bankaccount->bank_name = $bank_name;
        $bankaccount->bank_account_title = $bank_account_title;
        $bankaccount->bank_account_number = $bank_account_number;
        $bankaccount->currency_code = $currency_code;
        $bankaccount->country_code = $country_code;
        $bankaccount->is_primary = $is_primary;
        $bankaccount->save();
        if ($bankaccount) {
            $request->session()->flash('message', 'Bank Account Created Successfully');
            return redirect()->route('account.bankaccount');
        } else {
            $request->session()->flash('message', 'Bank Account Creation Failed');
            return redirect()->back()->withInput();
        }
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
        $accounts = $this->user->account;
        $this->args['accounts'] = $accounts;
        $moneyBuys = array();
        foreach($accounts as $account){
            $moneyBuys[]= MoneyBuy::where('account_id', $account->id)->orderBy('created_at', 'desc')->get();
        }
        $this->args['moneyBuys'] = $moneyBuys;
        return view('account.withdraw', $this->args);
    }

    public function postWithdraw(Request $request, AccountService $accountService)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:10'
        ]);
        $currency_code = $request->input('currency_code');
        $amount = floatval($request->input('amount'));
        $current_user = $this->user->id;
        try {
            $transaction = $accountService->withdraw($current_user,$currency_code, $amount);
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