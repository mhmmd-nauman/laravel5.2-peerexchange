<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 17-01-16
 * Time: 12:01 PM
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\AccountService;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton(AccountService::class, function() {
            return new AccountService();
        });
    }
}