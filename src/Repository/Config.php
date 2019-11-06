<?php

namespace Andor9229\Rbac;

use Andor9229\Rbac\Crud;
use Illuminate\Support\Str;

class Config extends Crud {
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "";
        $this->file = "{$name}.php";
    }

    public function setTemplate()
    {
        $this->template = $this->getStub("config");
    }
}
