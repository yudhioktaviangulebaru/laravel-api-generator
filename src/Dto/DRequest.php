<?php

namespace Yudhi\Apigen\Dto;

use Yudhi\Apigen\Abstracts\Dto;

class DRequest extends Dto
{
    public function __construct(
        private string $base,
        private string $create,
        private string $update,
    ) {}

    public function getBase(): string
    {
        return $this->base;
    }

    public function getCreate(): string
    {
        return $this->create;
    }

    public function getUpdate(): string
    {
        return $this->update;
    }

    public function toArray(): array
    {
        return [
            'base' => $this->getBase(),
            'create' => $this->getCreate(),
            'update' => $this->getUpdate(),
        ];
    }

    public static function fromConfig(array $data)
    {
        return new self(
            $data['base'],
            $data['create'],
            $data['update'],
        );
    }
}
