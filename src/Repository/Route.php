<?php

namespace  Andor9229\Rbac;


class Route extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = 'routes';
        $this->file = "{$name}.php";
    }

    public function setTemplate()
    {
        $this->template = $this->getStub("routes/{$this->name}");
    }
}
