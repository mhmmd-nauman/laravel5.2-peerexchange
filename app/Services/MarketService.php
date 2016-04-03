<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 19-01-16
 * Time: 9:12 AM
 */

namespace App\Services;

use App\Models\Account;
use App\Models\MoneyBuy;
use App\Models\MoneySell;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;

class MarketService
{
    public function __construct()
    {
    }

    public function sell($current_user, $currency, $amount, $rate,$from_currency)
    {
        $transaction = new Transaction();
        DB::transaction(function() use ($current_user, $currency, $amount, $rate, $transaction,$from_currency) {
            $account1 = DB::table('accounts')
                    ->where('currency', '=', $from_currency)
                    ->where('user_id', '=', $current_user)
                    ->first();
            $account = Account::findOrFail($account1->id);
            if ($amount > $account->balance) {
                throw new \Exception('Insufficient funds in account'.$account->balance." ".$currency);
            }
            
            $account->balance = $account->balance - $amount;
            $account->debits = $account->debits + $amount;
            $account->save();

            $moneySell = new MoneySell();
            $moneySell->account_id = $account->id;
            $moneySell->from_currency = $account->currency;
            $moneySell->to_currency = $currency;
            $moneySell->amount = $amount;
            $moneySell->rate = $rate;
            $moneySell->save();

            $type = TransactionType::getSell();
            $gateway = PaymentGateway::getSystem();

            $transaction->account_id =  $account->id;
            $transaction->type_id = $type->id;
            $transaction->payment_gateway_id = $gateway->id;
            $transaction->money_sell_id = $moneySell->id;
            $transaction->currency = $account->currency;
            $transaction->amount = $amount;
            $transaction->balance = $account->balance;
            $transaction->save();
        });
        return $transaction;
    }

    public function buy($current_user, MoneySell &$moneySell)
    {
       //echo "come here".$moneySell->to_currency;
        //    exit;
        $transaction = new Transaction();
        DB::transaction(function() use ($current_user, $moneySell, $transaction) {
           
            $account1 = DB::table('accounts')
                    ->where('currency', '=', $moneySell->to_currency)
                    ->where('user_id', '=', $current_user)
                    ->first();
            
            $account2 = DB::table('accounts')
                    ->where('currency', '=', $moneySell->from_currency)
                    ->where('user_id', '=', $current_user)
                    ->first();
             
            $account = Account::findOrFail($account1->id);
            $account3 = Account::findOrFail($account2->id);

            $toAmount = round($moneySell->amount * $moneySell->rate, 2);
            if ($toAmount > $account->balance) {
                throw new \Exception('Insufficient funds in account'.$account->balance);
            }

            $receiverAccount = $account3;
            $receiverAccount->balance = $receiverAccount->balance + $moneySell->amount;
            $receiverAccount->save();
            
            $buyerAccount = $account;
            $buyerAccount->balance = $buyerAccount->balance - $toAmount;
            $buyerAccount->save();

            $moneyBuy = new MoneyBuy();
            $moneyBuy->account_id = $buyerAccount->id;
            $moneyBuy->money_sell_id = $moneySell->id;
            $moneyBuy->save();
            
            $account4 = Account::findOrFail($moneySell->account_id);
            $account4->balance = $buyerAccount->balance + $moneySell->amount;
            $account4->save();
            
            $moneySell->sold = true;
            $moneySell->save();

            $type = TransactionType::getBuy();
            $gateway = PaymentGateway::getSystem();
            $transaction->account_id = $buyerAccount->id;
            $transaction->type_id = $type->id;
            $transaction->payment_gateway_id = $gateway->id;
            $transaction->money_buy_id = $moneyBuy->id;
            $transaction->currency = $buyerAccount->currency;
            $transaction->amount = $toAmount;
            $transaction->balance = $buyerAccount->balance;
            $transaction->save();
        });
        return $transaction;
    }
}