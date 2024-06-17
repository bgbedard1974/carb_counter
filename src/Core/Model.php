<?php


namespace Core;


class Model
{
    protected $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function getData()
    {
        return $this->data;
    }
}