<?php

namespace Yudhi\Apigen\Core;

use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Throwable;

class Generator
{
    public static function generate(ApiGenContext $context): string
    {
        $stub = $context->getStubPath();
        $fileSystem = new Filesystem;

        try {
            self::dirCreate($context, $fileSystem);
            if (! $fileSystem->exists($stub)) {
                throw new Exception($context->outputFiles.' File is not exists');
            }
            $content = $fileSystem->get($stub);
            foreach ($context->replacer as $key => $value) {
                $content = self::replaceData($key, $content, $value);
            }
            file_put_contents($context->outputFiles, $content);

            return "[$context->outputFiles] Generated Successfully";
        } catch (Throwable $e) {
            return $e->getMessage();
        }

    }

    private static function replaceData(string $search, string $from, string $to)
    {
        return Str::replace($search, $to, $from);
    }

    private static function dirCreate(ApiGenContext $context, Filesystem $fileSystem)
    {
        $basePath = $context->getConfig()->getAppPath();
        $basePath = Str::replace('\\\\', DIRECTORY_SEPARATOR, $basePath);
        $app = dirname($basePath);
        $modulePath = $basePath.$context->moduleName;

        if (! $fileSystem->exists($app)) {
            $fileSystem->makeDirectory($app);
        }

        if (! $fileSystem->exists($basePath)) {
            $fileSystem->makeDirectory($basePath);
        }

        if (! $fileSystem->exists($modulePath)) {
            $fileSystem->makeDirectory($modulePath);
        }
        foreach ($context->dirToCreate as $dir) {
            if (! $fileSystem->exists($dir)) {
                $fileSystem->makeDirectory($dir);
            }
        }

    }
}
