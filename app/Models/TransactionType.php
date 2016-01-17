<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 8:33 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    const TYPE_DEPOSIT = 'Deposit';
    const TYPE_WITHDRAW = 'Withdraw';
    const TYPE_SELL = 'Sell';
    const TYPE_BUY = 'Buy';

    protected $table = 'transaction_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public static function getDeposit()
    {
        return TransactionType::where('name', TransactionType::TYPE_DEPOSIT)->first();
    }
}