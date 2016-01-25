<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 19-01-16
 * Time: 9:12 AM
 */

namespace Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\MarketService;

class MarketServiceProvider extends ServiceProvider
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
        app()->singleton(MarketService::class, function() {
            return new MarketService();
        });
    }
}