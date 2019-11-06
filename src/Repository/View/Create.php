<?php


namespace Andor9229\Rbac\View;

use Andor9229\Rbac\Crud;
use Illuminate\Support\Str;

class Create extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = $name;

        if ($name !== 'user') {
            $this->dir = "views/pages/rbac/{$name}";
            $this->file =  "create.blade.php";
        } else {
            $this->dir = "views/auth";
            $this->file =  "register.blade.php";
        }

    }

    public function setTemplate()
    {
        $this->template = $this->getStub("{$this->name}/create");
    }

}
