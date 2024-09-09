<?php

namespace Yudhi\Apigen\Core;

use Yudhi\Apigen\Dto\DConfig;
use Yudhi\Apigen\Enums\GenerationTypeEnum;

class ApiGenerator
{
    private ApiGenContext $context;

    public static function make(string $moduleName): self
    {
        return new self($moduleName);
    }

    public function __construct(protected string $moduleName)
    {
        $this->context = new ApiGenContext($moduleName, DConfig::getConfig());
    }

    public function generateRequest(): self
    {
        $this->context->generate(GenerationTypeEnum::REQUEST_BASE);
        Generator::generate($this->context);
        $this->context->generate(GenerationTypeEnum::REQUEST_CREATE);
        Generator::generate($this->context);
        $this->context->generate(GenerationTypeEnum::REQUEST_UPDATE);
        Generator::generate($this->context);

        return $this;
    }

    public function generateEntity(): self
    {
        $this->context->generate(GenerationTypeEnum::ENTITY);
        Generator::generate($this->context);

        return $this;
    }

    public function generateController(): self
    {
        $this->context->generate(GenerationTypeEnum::CONTROLLER);
        Generator::generate($this->context);

        return $this;
    }

    public function generateService(): self
    {
        $this->context->generate(GenerationTypeEnum::SERVICE);
        Generator::generate($this->context);

        return $this;
    }

    public function generateRepository(): self
    {
        $this->context->generate(GenerationTypeEnum::REPOSITORY);
        Generator::generate($this->context);

        return $this;
    }

    public function generateAll(): self
    {
        return $this->generateEntity()
            ->generateRequest()
            ->generateRepository()
            ->generateService()
            ->generateController();
    }
}
