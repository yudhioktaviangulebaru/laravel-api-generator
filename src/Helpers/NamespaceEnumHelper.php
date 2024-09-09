<?php

namespace Yudhi\Apigen\Helpers;

use Yudhi\Apigen\Enums\NamespacesEnum;

class NamespaceEnumHelper
{
    public static function getNamespace(NamespacesEnum $enum, string $rootNamespace, string $entityName): string
    {
        $data = $enum->value;
        $replacer = [
            '{rootNamespace}' => $rootNamespace,
            '{entityName}' => $entityName,
        ];
        $pattern = '/'.implode('|', array_keys($replacer)).'/';

        return preg_replace_callback(
            $pattern,
            function ($matches) use ($replacer) {
                return $replacer[$matches[0]];
            },
            $data
        );
    }
}
