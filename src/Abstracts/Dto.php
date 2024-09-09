<?php

namespace Yudhi\Apigen\Abstracts;

abstract class Dto
{
    abstract public function toArray(): array;

    abstract public static function fromConfig(array $data);
}
