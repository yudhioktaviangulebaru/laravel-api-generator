<?php
return
    [
        'abstractControllerName' => 'App\\Http\\Controllers\\Controller',
        'rootNamespace' => 'App',
        'basePath' => base_path(),
        'appPath' => app_path(),
        'stubPath' => [
            'controller' => '{rootPath}'.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'controller.stub',
            'entity' => '{rootPath}'.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'entity.stub',
            'repository' => '{rootPath}'.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'repository.stub',
            'service' => '{rootPath}'.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'service.stub',
            'requests' => [
                'base' => '{rootPath}'.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'request.base.stub',
                'create' => '{rootPath}'.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'request.create.stub',
                'update' => '{rootPath}'.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'request.update.stub',
            ],
        ]
];
