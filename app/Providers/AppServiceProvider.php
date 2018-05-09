<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Auth;
use View;
use App\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


        //compose all the views....
        view()->composer('*', function ($view) 
        {
            $id = User::find(Auth::id());
            $is_super_admin = $id['attributes']['is_super_admin'];

            View::share('is_super_admin', $is_super_admin); 
        });  
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
