<?php

namespace Yudhi\Apigen\Enums;

enum NamespacesEnum: string
{
    case Base = '{rootNamespace}\\Core\\{entityName}';
    case Request = '{rootNamespace}\\{entityName}\\HttpRequests';
}
