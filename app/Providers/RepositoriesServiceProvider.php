<?php

namespace App\Providers;

use App\Interfaces\AppointmentInterface;
use App\Interfaces\ContactInterface;
use App\Interfaces\UserInterface;
use App\Repositories\AppointmentRepository;
use App\Repositories\ContactRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
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
        $this->app->bind(UserInterface::class,UserRepository::class);
        $this->app->bind(AppointmentInterface::class,AppointmentRepository::class);
        $this->app->bind(ContactInterface::class,ContactRepository::class);
    }
}
