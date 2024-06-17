<?php


namespace Core;


class Repositories
{
    private $repositories;

    public function __construct($repositories, $db)
    {
        $this->repositories = [];
        foreach ($repositories as $key => $repository) {
            $repository_class = "Repository\\" . $repository;
            $this->repositories[$key] = new $repository_class($db);
        }
    }

    public function get($key)
    {
        return $this->repositories[$key];
    }
}