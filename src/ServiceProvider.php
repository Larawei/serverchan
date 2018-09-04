<?php

namespace Larawei\Serverchan;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {

        $this->app->singleton(ServerChan::class, function () {
            return new ServerChan(config('services.serverChan.key'));
        });

        $this->app->alias(ServerChan::class, 'serverChan');
    }

    public function provides()
    {
        return [ServerChan::class, 'serverChan'];
    }
}