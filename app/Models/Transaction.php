<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 9:14 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id', 'type_id', 'payment_gateway_id', 'credit', 'debit', 'balance'
    ];

    public function account() {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function type() {
        return $this->belongsTo(TransactionType::class, 'type_id', 'id');
    }

    public function gateway() {
        return $this->belongsTo(PaymentGateway::class, 'type_id', 'id');
    }
}