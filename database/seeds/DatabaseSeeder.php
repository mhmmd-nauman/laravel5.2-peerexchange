<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CurrencyTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TransactionTypeTableSeeder::class);
        $this->call(PaymentGatewayTableSeeder::class);
        $this->call(AccountTableSeeder::class);
    }
}
