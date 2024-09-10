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
        $config = __DIR__.'/Config/apigen.php';
        $this->publishes([
            $config => config_path('apigen.php'),
        ], 'apigen_config');

        AboutCommand::add('Laravel API Generator By Yudhi', fn () => ['version' => '1.0.0.0']);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ApiGenMakeAll::class,
            ]);
        }
    }
}
