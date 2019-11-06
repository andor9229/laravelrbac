<?php

namespace Andor9229\Rbac;

use Andor9229\Rbac\Crud;
use Illuminate\Support\Str;

class Command extends Crud {
    protected $name;
    protected $dir;
    protected $file;

    public function __construct()
    {
        $this->name = "CreatePermissions";
        $this->dir = "Console/Commands";
        $this->file = "CreatePermissions.php";
    }

    public function setTemplate()
    {
        $this->template = $this->getStub("command");
    }
}
