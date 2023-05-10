<?php

namespace app\Repositories;

abstract class MainRepository
{
    protected $model;

    public function __construct()
    {
        $class = $this->getModelClass();
        $this->model = new $class();
    }

    abstract protected function getModelClass();

    protected function startRequest()
    {
        return clone $this->model;
    }
}