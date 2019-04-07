<?php

namespace App\Providers;
use App\User;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; //Import Schema


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); //Solved by increasing StringLength
        view()->composer('*',function($view) {
             //604800 seconds in a week
            $today = strtotime("now");
            $weeks = floor($today / 604800);
            $n = User::where('type', '!=', 'user')->count();
            $user_id = $weeks % $n + 1;

            $admin_on_duty = User::where('id', $user_id)->first();
            $view->with('admin_on_duty', $admin_on_duty);
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
