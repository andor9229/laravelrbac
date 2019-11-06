<?php

namespace Andor9229\Rbac;

use Andor9229\Rbac\Crud;
use Illuminate\Support\Str;

class Controller extends Crud {
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = 'Http/Controllers/Rbac';
        $this->file = Str::ucfirst($name) . "Controller.php";
    }

    public function setTemplate()
    {
        $this->template = $this->getStub("{$this->name}/controller");
    }

}
