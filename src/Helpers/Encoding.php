<?php

namespace Yudhi\Apigen\Helpers;

class Encoding
{
    public static function encodeToObject(array $data): object
    {
        return json_decode(json_encode($data));
    }

    public static function toArray(array $data): array
    {
        return json_decode(json_encode($data), true);
    }
}
