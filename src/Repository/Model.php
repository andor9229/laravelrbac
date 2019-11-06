<?php

namespace Andor9229\Rbac;

use Andor9229\Rbac\Crud;
use Illuminate\Support\Str;

class Model extends Crud {
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "Models/Rbac/" . Str::ucfirst($name);
        $this->file = Str::ucfirst($name) . ".php";
    }

    public function setTemplate()
    {
        $this->template = str_replace(
            ['{{modelName}}'],
            [$this->name],
            $this->getStub("{$this->name}/model")
        );
    }
}
