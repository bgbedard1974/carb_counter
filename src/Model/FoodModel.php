<?php


namespace Model;


class FoodModel extends \Core\Model
{
    private $container;

    public function __construct($container)
    {
        parent::__construct();
        $this->container = $container;
    }

    public function create()
    {
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('food');
        $this->data = $repository->create();
    }

    public function createFromId($id) {
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('food');
        $this->data = $repository->get($id);
    }

    public function createFromEntity($entity)
    {
        $this->data = $entity;
    }

}