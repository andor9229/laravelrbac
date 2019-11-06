<?php

namespace  Andor9229\Rbac;

use Illuminate\Support\Facades\File;

class Crud {

    protected $template;

    protected function getStub($type)
    {
        return file_get_contents(__DIR__ . "/stubs/$type.stub");
    }

    public function makeDir($file = NULL)
    {
        File::makeDirectory(app_path($this->dir), $mode = 0777, true, true);
    }

    public function makeFile()
    {
        File::makeDirectory(app_path($this->dir . '/' .$this->file), $mode = 0777, true, true);
    }

    public function filePutContests($path = 'app')
    {
        switch ($path)
        {
            case 'app': file_put_contents(app_path($this->getPath()), $this->template); break;
            case 'database': file_put_contents(database_path($this->getPath()), $this->template); break;
            case 'routes': file_put_contents(base_path($this->getPath()), $this->template); break;
            case 'config': file_put_contents(config_path($this->getPath()), $this->template); break;
            case 'resource': file_put_contents(resource_path($this->getPath()), $this->template); break;
        }

    }

    public function dirAlreadyExists()
    {
        return File::exists(app_path($this->dir));
    }

    public function fileAlreadyExists()
    {
        return File::exists(app_path("../{$this->getPath()}"));
    }

    protected function getPath() {
        return $this->dir . '/'. $this->file;
    }
}
