<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 19-01-16
 * Time: 12:28 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoneySell extends Model
{
    protected $table = 'money_sell';

    protected $fillable = [
        'account_id',
        'from_currency',
        'to_currency',
        'amount',
        'rate'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'money_sell_id');
    }
    
    public  function moneybuy(){
         return $this->hasOne(MoneyBuy::class, 'money_sell_id')->orderBy('created_at', 'desc');
    }
     
}