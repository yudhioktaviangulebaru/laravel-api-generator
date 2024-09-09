<?php

namespace Yudhi\Apigen\Core;

use Illuminate\Support\Str;
use Yudhi\Apigen\Dto\DConfig;
use Yudhi\Apigen\Enums\GenerationTypeEnum;
use Yudhi\Apigen\Enums\NamespacesEnum;
use Yudhi\Apigen\Enums\OutputFileNameEnum;
use Yudhi\Apigen\Helpers\NamespaceEnumHelper;
use Yudhi\Apigen\Helpers\OutputFileEnumHelper;

class ApiGenContext
{
    private string $stubPath;

    private string $baseNamespace;

    public array $replacer = [];

    public string $outputFiles = '';

    private GenerationTypeEnum $generationType;

    public array $dirToCreate = [];

    private OutputFileNameEnum $outputFileType;

    public function __construct(
        public string $moduleName,
        private DConfig $config,
    ) {}

    public function getConfig(): DConfig
    {
        return $this->config;
    }

    public function generate(GenerationTypeEnum $generationType): self
    {
        $this->generationType = $generationType;
        $this->setBaseNamespace()
            ->setAttributes()
            ->setOutput();

        return $this;
    }

    public function setAttributes(): static
    {
        $this->stubPath = '';
        switch ($this->generationType) {
            case GenerationTypeEnum::CONTROLLER:
                $this->outputFileType = OutputFileNameEnum::Controller;
                $this->stubPath = $this->config->getStubPath()->getController();

                return $this->stubPathReplace()
                    ->setReplacer(GenerationTypeEnum::CONTROLLER);
            case GenerationTypeEnum::ENTITY:
                $this->outputFileType = OutputFileNameEnum::Entity;
                $this->stubPath = $this->config->getStubPath()->getEntity();

                return $this->stubPathReplace()
                    ->setReplacer(GenerationTypeEnum::ENTITY);
            case GenerationTypeEnum::REPOSITORY:
                $this->outputFileType = OutputFileNameEnum::Repository;
                $this->stubPath = $this->config->getStubPath()->getRepository();

                return $this->stubPathReplace()
                    ->setReplacer(GenerationTypeEnum::REPOSITORY);
            case GenerationTypeEnum::SERVICE:
                $this->outputFileType = OutputFileNameEnum::Service;
                $this->stubPath = $this->config->getStubPath()->getService();

                return $this->stubPathReplace()
                    ->setReplacer(GenerationTypeEnum::SERVICE);
            case GenerationTypeEnum::REQUEST_BASE:
                $this->outputFileType = OutputFileNameEnum::BaseRequest;
                $this->stubPath = $this->config->getStubPath()->getRequests()->getBase();

                return $this->stubPathReplace()
                    ->setReplacer(GenerationTypeEnum::REQUEST_BASE);
            case GenerationTypeEnum::REQUEST_CREATE:
                $this->outputFileType = OutputFileNameEnum::CreateRequest;
                $this->stubPath = $this->config->getStubPath()->getRequests()->getCreate();

                return $this->stubPathReplace()
                    ->setReplacer(GenerationTypeEnum::REQUEST_CREATE);
            default:
                $this->outputFileType = OutputFileNameEnum::UpdateRequest;
                $this->stubPath = $this->config->getStubPath()->getRequests()->getUpdate();

                return $this->stubPathReplace()
                    ->setReplacer(GenerationTypeEnum::REQUEST_UPDATE);
        }
    }

    public function getBaseNamespace()
    {
        return $this->baseNamespace;
    }

    public function setBaseNamespace(): static
    {
        $root = $this->config->getRootNamespace();
        $replaceResult = NamespaceEnumHelper::getNamespace(
            enum: NamespacesEnum::Base,
            rootNamespace: $root,
            entityName: $this->moduleName);
        $this->baseNamespace = $replaceResult;

        return $this;
    }

    private function stubPathReplace(): self
    {
        $this->stubPath = str_replace('{rootPath}', $this->config->getBasePath().DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR, $this->stubPath);

        $this->stubPath = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $this->stubPath);

        return $this;
    }

    private function setReplacer(GenerationTypeEnum $generationType): self
    {

        $controllerName = Str::studly($this->moduleName.' Controller');
        $serviceName = Str::studly($this->moduleName.' Service');
        $repositoryName = Str::studly($this->moduleName.' Repository');
        $baseRequestName = Str::studly("Base $this->moduleName request");
        $createRequestName = Str::studly("Create $this->moduleName request");
        $updateRequestName = Str::studly("update $this->moduleName request");
        $this->replacer = [
            '{{abstractControllerName}}' => $this->getConfig()->getAbstractControllerName(),
            '{{BaseNamespace}}' => $this->getBaseNamespace(),
            '{{rootNamespace}}' => $this->config->getRootNamespace(),
            '{{controllerName}}' => $controllerName,
            '{{serviceName}}' => $serviceName,
            '{{createRequestName}}' => $createRequestName,
            '{{entityName}}' => Str::studly($this->moduleName),
            '{{updateRequestName}}' => $updateRequestName,
            '{{repositoryName}}' => $repositoryName,
            '{{baseRequestName}}' => $baseRequestName,
            '{{requestNamespace}}' => NamespaceEnumHelper::getNamespace(
                NamespacesEnum::Request,
                $this->config->getRootNamespace(),
                $this->moduleName
            ),
        ];

        return $this;
    }

    private function setOutput()
    {
        $generationTypeRequest = [GenerationTypeEnum::REQUEST_BASE, GenerationTypeEnum::REQUEST_CREATE, GenerationTypeEnum::REQUEST_UPDATE];

        if (in_array($this->generationType, $generationTypeRequest)) {
            $this->dirToCreate[] = $this->config->getAppPath().$this->moduleName.DIRECTORY_SEPARATOR.'HttpRequests';
        }
        $this->outputFiles = $this->config->getAppPath().$this->moduleName.DIRECTORY_SEPARATOR.OutputFileEnumHelper::getOutputFileName($this->outputFileType, $this->moduleName);

    }

    public function getStubPath()
    {
        return $this->stubPath;
    }
}
