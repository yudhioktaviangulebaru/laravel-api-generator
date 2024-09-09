<?php

namespace Yudhi\Apigen;

use Illuminate\Support\ServiceProvider;

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
    }
}
