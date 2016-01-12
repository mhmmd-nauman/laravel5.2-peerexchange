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
    }
}