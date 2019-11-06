<?php

namespace Andor9229\Rbac;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Migration extends Crud {
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->createMigration($name);
        $this->name = $name;
        $this->dir = "migrations";
        $this->file = $this->getMigrationName($name);
    }

    public function setTemplate()
    {
        $this->template = $this->getStub("{$this->name}/migration");
    }

    private function createMigration($name)
    {
        if($name !== 'user') {
            $migrationName = $this->normalizeMigrationName($name);
            Artisan::call('make:migration', [
                'name' => "create_{$migrationName}_table"
            ]);
        }

        return;

    }

    private function getMigrationName($name)
    {
        $migrationName = $this->normalizeMigrationName($name);
        foreach(File::allFiles(database_path('migrations')) as $migration)
        {
            if(Str::contains($migration->getFilename(), $migrationName)) {
                return $migration->getFilename();
            }
        }

        return null;
    }

    private function normalizeMigrationName($name)
    {
        return Str::contains($name, '_') ? $name : Str::plural($name);
    }
}
