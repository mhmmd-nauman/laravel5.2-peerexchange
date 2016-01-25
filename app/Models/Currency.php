<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 19-01-16
 * Time: 12:36 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';

    protected $fillable = [
        'code',
        'name'
    ];
}