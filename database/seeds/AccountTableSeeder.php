<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 17-01-16
 * Time: 12:21 PM
 */

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Account;

class AccountTableSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::where('email', 'user1@gmail.com')->first();
        Account::create([
            'user_id' => $user1->id,
        ]);
        $user2 = User::where('email', 'user2@gmail.com')->first();
        Account::create([
            'user_id' => $user2->id
        ]);
    }
}