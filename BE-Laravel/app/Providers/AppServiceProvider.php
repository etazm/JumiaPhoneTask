<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            \DB::connection()->getPdo()->sqliteCreateFunction("REGEXP", "preg_match", 2);
        } catch (\Exception $exception) {
            
        }
    }
}
