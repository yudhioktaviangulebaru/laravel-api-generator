<?php

namespace Yudhi\Apigen\Enums;

enum OutputFileNameEnum: string
{
    case Controller = '{entityName}Controller.php';
    case Entity = '{entityName}.php';
    case Repository = '{entityName}Repository.php';
    case Service = '{entityName}Service.php';
    case BaseRequest = 'HttpRequests{dir_separator}{entityName}BaseRequest.php';
    case CreateRequest = 'HttpRequests{dir_separator}{entityName}CreateRequest.php';
    case UpdateRequest = 'HttpRequests{dir_separator}{entityName}UpdateRequest.php';
}
