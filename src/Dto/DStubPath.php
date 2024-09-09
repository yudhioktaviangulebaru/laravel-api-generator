<?php

namespace Yudhi\Apigen\Dto;

use Yudhi\Apigen\Abstracts\Dto;

class DStubPath extends Dto
{
    public function __construct(
        private string $controller,
        private string $entity,
        private string $repository,
        private string $service,
        private DRequest $requests
    ) {}

    public function getController(): string
    {
        return $this->controller;
    }

    public function getEntity(): string
    {
        return $this->entity;
    }

    public function getRepository(): string
    {
        return $this->repository;
    }

    public function getService(): string
    {
        return $this->service;
    }

    public function getRequests(): DRequest
    {
        return $this->requests;
    }

    public static function fromConfig(array $data): self
    {
        return new self(
            $data['controller'],
            $data['entity'],
            $data['repository'],
            $data['service'],
            DRequest::fromConfig($data['requests'])
        );

    }

    public function toArray(): array
    {
        return [
            'controller' => $this->controller,
            'entity' => $this->entity,
            'repository' => $this->repository,
            'service' => $this->service,
            'requests' => $this->requests->toArray(),
        ];
    }
}
