<?php

namespace  Andor9229\Rbac;

use Illuminate\Support\Str;

class Request extends Crud
{
    protected $name;
    protected $dir;
    protected $file;

    public function __construct($name)
    {
        $this->name = Str::ucfirst($name);
        $this->dir = "Http/Requests/{$this->name}";
        $this->file = "{$this->name}Request.php";
    }

    public function setTemplate()
    {
        $this->template = str_replace(
            [
                '{{modelName}}'
            ],
            [
                $this->name
            ],
            $this->getStub('request')
        );
    }

}
