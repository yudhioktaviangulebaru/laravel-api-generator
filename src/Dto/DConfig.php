<?php

namespace Yudhi\Apigen\Dto;

use Yudhi\Apigen\Abstracts\Dto;
use Yudhi\Apigen\Helpers\Encoding;

class DConfig extends Dto
{
    public function __construct(
        private string $abstractControllerName,
        private string $rootNamespace,
        private string $basePath,
        private string $appPath,
        private DStubPath $stubPath
    ) {}

    public function getRootNamespace(): string
    {
        return $this->rootNamespace;
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function getAppPath(): string
    {
        return $this->appPath;
    }

    public function getStubPath(): DStubPath
    {
        return $this->stubPath;
    }

    public static function getConfig(): self
    {
        $configuration = config('apigen');

        return self::fromConfig(Encoding::toArray($configuration));
    }

    public static function fromConfig(array $data): self
    {
        return new self(
            $data['abstractControllerName'],
            $data['rootNamespace'],
            $data['basePath'],
            $data['appPath'],
            DStubPath::fromConfig($data['stubPath'])
        );
    }

    public function toArray(): array
    {
        return [
            'rootNamespace' => $this->getRootNamespace(),
            'basePath' => $this->getBasePath(),
            'appPath' => $this->getAppPath(),
            'stubPath' => $this->getStubPath()->toArray(),
        ];
    }

    public function getAbstractControllerName()
    {
        return $this->abstractControllerName;
    }
}
