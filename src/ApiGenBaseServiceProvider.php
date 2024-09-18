<?php

namespace Yudhi\Apigen;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use Yudhi\Apigen\Console\ApiGenMakeAll;

class ApiGenBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPublishing();
    }

    public function register() {}

    protected function registerPublishing(): void
    {

        $this->publishes([
            __DIR__.'/Config/apigen.php' => config_path('apigen.php'),
        ], 'laravel-assets');

        AboutCommand::add('Laravel API Generator By Yudhi', fn () => ['version' => '1.0.0']);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ApiGenMakeAll::class,
            ]);
        }
    }
}
