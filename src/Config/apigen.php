<?php

use Yudhi\Apigen\Core\Controller;
use Yudhi\Apigen\Helpers\DirHelper;

return
    [
        'abstractControllerName' => Controller::class,
        'rootNamespace' => 'App',
        'basePath'      => base_path() . DIRECTORY_SEPARATOR,
        'appPath'       => app_path('/Core') . DIRECTORY_SEPARATOR,
        'stubPath'      => [
            'controller' => DirHelper::stubDir('controller.stub'),
            'entity'     => DirHelper::stubDir('entity.stub'),
            'repository' => DirHelper::stubDir('repository.stub'),
            'service'    => DirHelper::stubDir('service.stub'),
            'requests'   => [
                'base'   => DirHelper::stubDir('request.base.stub'),
                'create' => DirHelper::stubDir('request.create.stub'),
                'update' => DirHelper::stubDir('request.update.stub'),
            ],
        ],

    ];
