<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 17-01-16
 * Time: 12:00 PM
 */

namespace App\Services;

use App\Models\Account;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;

class AccountService
{
    public function deposit(Account &$account, $amount)
    {
        $transaction = new Transaction();
        DB::transaction(function() use ($account, $amount, $transaction) {

            $account->balance = $account->balance + $amount;
            $account->credits = $account->credits + $amount;
            $account->save();

            $type = TransactionType::getDeposit();
            $gateway = PaymentGateway::getSystem();

            $transaction->account_id =  $account->id;
            $transaction->type_id = $type->id;
            $transaction->payment_gateway_id = $gateway->id;
            $transaction->amount = $amount;
            $transaction->balance = $account->balance;
            $transaction->save();
        });
        return $transaction;
    }
}