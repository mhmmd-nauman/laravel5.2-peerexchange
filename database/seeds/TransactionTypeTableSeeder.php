<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 10:38 AM
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionTypeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('transaction_types')->insert([
            ['name' => 'Deposit', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Withdraw', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sell', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Buy', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ]);
    }
}