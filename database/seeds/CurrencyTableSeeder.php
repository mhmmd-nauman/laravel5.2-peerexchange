<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 19-01-16
 * Time: 12:36 AM
 */

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencyTableSeeder extends Seeder
{
    public function run()
    {
        Currency::create([
            'code' => 'SGD',
            'name' => 'Singapore dollar'
        ]);
        Currency::create([
            'code' => 'MYR',
            'name' => 'Malaysian ringgit'
        ]);
    }
}