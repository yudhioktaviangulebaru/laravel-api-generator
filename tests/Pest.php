<?php

use Illuminate\Filesystem\Filesystem;
use Yudhi\Apigen\Core\ApiGenerator;
use Yudhi\Apigen\Dto\ConfigDto;
use Yudhi\Apigen\Test\TestCases;

uses(TestCases::class)->in(__DIR__);

function createApiGen(): ApiGenerator
{
    return ApiGenerator::make('Botol');
}

function cleanDirectory(): void
{
    $filesystem = new Filesystem;
    $config = ConfigDto::getConfig();
    if ($filesystem->exists($config->basePath.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Core')) {
        $filesystem->cleanDirectory($config->basePath.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Core');
    }
}
