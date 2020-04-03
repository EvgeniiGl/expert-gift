<?php

namespace App\Providers;

use App\Repositories\GiftRepository;
use App\Repositories\Interfaces\GiftRepository as GiftRepositoryInterface;
use App\Repositories\Interfaces\UserRepository as UserRepositoryInterface;
use App\Repositories\UserRepository;
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
        $this->app->bind(GiftRepositoryInterface::class,
            GiftRepository::class);
        $this->app->bind(UserRepositoryInterface::class,
            UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
