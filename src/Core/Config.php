<?php


namespace Core;

use \Symfony\Component\Yaml\Yaml;

class Config
{
    private $data;

    public function __construct()
    {
        $this->data = Yaml::parseFile('../config/global.yml');
    }

    public function get($key)
    {
        return $this->data[$key];
    }
}