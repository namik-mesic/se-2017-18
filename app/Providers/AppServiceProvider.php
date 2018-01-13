<?php

namespace App\Providers;

use App;
use Illuminate\Support\Facades\Schema;
use App\Repositories\MySQL\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

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

        App::bind(UserRepositoryInterface::class, function () {

            return new UserRepository;

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
