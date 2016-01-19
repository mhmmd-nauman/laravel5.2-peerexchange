<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 19-01-16
 * Time: 9:12 AM
 */

namespace App\Services;

use App\Models\Account;
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

    public function sell(Account &$account, $currency, $amount, $rate)
    {
        $transaction = new Transaction();
        DB::transaction(function() use ($account, $currency, $amount, $rate, $transaction) {

            if ($amount > $account->balance) {
                throw new \Exception('Insufficient funds in account');
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

    public function buy(Account &$account, MoneySell &$moneySell)
    {
        $transaction = new Transaction();
        DB::transaction(function() use ($account, $moneySell) {

            if ($moneySell->to_currency != $account->currency) {
                throw new \Exception('Incompatible currencies');
            }

            $toAmount = round($moneySell->amount * $moneySell->rate, 2);
            if ($toAmount > $account->balance) {
                throw new \Exception('Insufficient funds in account');
            }

            $buyerAccount = $account;
            $sellerAccount = $moneySell->account;
        });
        return $transaction;
    }
}