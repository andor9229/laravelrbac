<?php


namespace Andor9229\Rbac\View;

use Andor9229\Rbac\Crud;
use Illuminate\Support\Str;

class ManageUsers extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct()
    {
        $this->name = 'index';
        $this->dir = "views/pages/rbac";
        $this->file =  "index.blade.php";
    }

    public function setTemplate()
    {
        $this->template = $this->getStub("manage-users");
    }

}
