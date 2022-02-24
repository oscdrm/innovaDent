<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Surgery;
use View;

class SendSurgerysProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {   
        
        View::composer('layouts.app2', function($view){
            $surgeries = Surgery::all();
            $view->with('surgeries', $surgeries);
        });
    }
}