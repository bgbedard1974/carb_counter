<?php

namespace Model;

class MealsModel extends \Core\Model
{
    public function __construct($container)
    {
        parent::__construct();
        $repositories = $container->get('repositories');
        $repository = $repositories->get('meal');
        $meals = $repository->getAll();
        foreach ($meals as $meal_entity) {
            $meal = new MealModel($container);
            $meal->createFromEntity($meal_entity);
            $this->data[] = $meal->getData();
        }
    }
}