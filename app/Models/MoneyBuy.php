<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 19-01-16
 * Time: 10:41 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoneyBuy extends Model
{
    protected $table = 'money_buy';

    protected $fillable = [
        'account_id',
        'money_sell_id'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'money_buy_id');
    }

    public function moneySell()
    {
        return $this->belongsTo(MoneySell::class, 'money_sell_id');
    }
}