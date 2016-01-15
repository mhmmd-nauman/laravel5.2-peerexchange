<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 11-01-16
 * Time: 11:09 PM
 */

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        if (User::where('email', 'admin@gmail.com')->exists() == false) {
            User::create([
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1234'),
                'first_name' => 'Admin',
                'last_name' => 'PeerExchange',
            ]);
        }

        if (User::where('email', 'user1@gmail.com')->exists() == false) {
            User::create([
                'email' => 'user1@gmail.com',
                'password' => Hash::make('1234'),
                'first_name' => 'User1',
                'last_name' => 'PeerExchange'
            ]);
        }

        if (User::where('email', 'user2@gmail.com')->exists() == false) {
            User::create([
                'email' => 'user2@gmail.com',
                'password' => Hash::make('1234'),
                'first_name' => 'User2',
                'last_name' => 'PeerExchange'
            ]);
        }
    }
}