<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 9:49 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    const ADMIN = 'admin';
    const CUSTOMER = 'customer';

    protected $table = 'user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}