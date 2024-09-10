<?php

namespace Yudhi\Apigen\Console;

use Illuminate\Console\Command;
use Yudhi\Apigen\Core\ApiGenerator;

class ApiGenMakeAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apigen:make {module?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create set API';

    private string $module = '';

    public function handle()
    {
        $this->module = $this->argument('module') ?? '';
        $this->setModule();
        ApiGenerator::make($this->module)->generateAll();

    }

    private function setModule(): void
    {
        if ($this->module === '') {
            $this->module = $this->ask('Please specify Module Name') ?? '';
        }
        if ($this->module === '') {
            $this->setModule();
        }
    }
}
