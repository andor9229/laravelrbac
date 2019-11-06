<?php


namespace Andor9229\Rbac\View\Layouts;

use Andor9229\Rbac\Crud;
use Illuminate\Support\Str;

class Layout extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;
        $this->dir = "views/layouts";
        $this->file =  "{$name}.blade.php";
    }

    public function setTemplate()
    {
        $this->template = $this->getStub("layouts/{$this->name}");
    }

}
