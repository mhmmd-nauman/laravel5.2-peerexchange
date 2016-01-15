<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 9:49 AM
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\UserRole;

class UserRoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_roles')->insert([
            ['name' => UserRole::ADMIN, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => UserRole::CUSTOMER, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ]);
    }
}