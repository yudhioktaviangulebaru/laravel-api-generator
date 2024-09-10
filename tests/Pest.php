<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Yudhi\Apigen\Core\ApiGenerator;
use Yudhi\Apigen\Dto\DConfig;
use Yudhi\Apigen\Test\TestCases;

uses(TestCases::class)->in(__DIR__);

function createApiGen(): ApiGenerator
{
    return ApiGenerator::make(Str::studly(fake()->name()));
}

function cleanDirectory(): void
{
    $filesystem = new Filesystem;
    $config = DConfig::getConfig();
    if ($filesystem->exists($config->getBasePath().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Core')) {
        $filesystem->cleanDirectory($config->getBasePath().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Core');
    }
}
