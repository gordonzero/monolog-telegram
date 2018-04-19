<?php

namespace Logger\Laravel\Provider;

use Illuminate\Support\ServiceProvider;

class MonologTelegramHandlerServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        //
    }

    public function register()
    {
        //
    }

    public function provides()
    {
        return array();
    }
}
