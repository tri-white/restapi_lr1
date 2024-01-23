<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Backpack\CRUD\app\Library\Widget;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Widget::add()
    ->to('before_content')
    ->type('progress')
    ->content(null);
    }
}
