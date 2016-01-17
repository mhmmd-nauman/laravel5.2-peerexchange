<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 8:38 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    const GATEWAY_SYSTEM = 'System';
    const GATEWAY_BANK = 'Name';
    const GATEWAY_BRAINTREE = 'Braintree';

    protected $table = 'payment_gateways';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public static function getSystem()
    {
        return PaymentGateway::where('name', PaymentGateway::GATEWAY_SYSTEM)->first();
    }
}