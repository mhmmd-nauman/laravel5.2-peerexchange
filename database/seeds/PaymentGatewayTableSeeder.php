<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 10:42 AM
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentGatewayTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('payment_gateways')->insert([
            ['name' => 'System'],
            ['name' => 'Bank'],
            ['name' => 'Braintree']
        ]);
    }
}