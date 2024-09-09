<?php

namespace Yudhi\Apigen\Helpers;

use Yudhi\Apigen\Enums\OutputFileNameEnum;

class OutputFileEnumHelper
{
    public static function getOutputFileName(OutputFileNameEnum $enum, string $entityName): string
    {
        $patterns = '/{entityName}|{dir_separator}/';
        $subject = [
            '{entityName}' => $entityName,
            '{dir_separator}' => DIRECTORY_SEPARATOR,
        ];

        return preg_replace_callback($patterns, fn ($matches) => self::matching($matches, $subject), $enum->value);
    }

    private static function matching($matches, $subject)
    {
        return $subject[$matches[0]];
    }
}
