<?php


namespace Model;


class FoodsModel extends \Core\Model
{
    public function __construct($container)
    {
        parent::__construct();
        $repositories = $container->get('repositories');
        $repository = $repositories->get('food');
        $foods = $repository->getAll();
        foreach ($foods as $food_entity) {
            $food = new FoodModel($container);
            $food->createFromEntity($food_entity);
            $this->data[] = $food->getData();
        }
    }
}