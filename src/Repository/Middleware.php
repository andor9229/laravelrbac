<?php

namespace Andor9229\Rbac;

use Andor9229\Rbac\Crud;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class Middleware extends Crud {
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "Http/Middleware";
        $this->file = "{$name}.php";
    }

    public function setTemplate()
    {
        $this->template = $this->getStub("middleware/{$this->name}");
    }

    public function create()
    {
        Artisan::call('make:middleware', [
            'name' => $this->name
        ]);
    }

    public function updateKernel()
    {
        $this->template = $this->getStub("middleware/kernel");
        $this->dir = 'Http';
        $this->file = 'kernel.php';
        $this->filePutContests();
    }
}
