<?php


namespace Model;


class MealModel extends \Core\Model
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
        $repository = $repositories->get('meal');
        $this->data = $repository->create();
    }

    public function createFromId($id) {
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('meal');
        $this->data = $repository->get($id);
        $this->setPeriod();
        $this->setFoods();
        $this->setCarbs();
        $this->setSodium();
    }

    public function createFromEntity($entity)
    {
        $this->data = $entity;
        $this->setPeriod();
        $this->setFoods();
        $this->setCarbs();
        $this->setSodium();
    }

    private function setPeriod()
    {
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('meal_period');
        $this->data['period'] = $repository->get($this->data['period_id']);
    }

    private function setFoods()
    {
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('meal_food');
        $entities = $repository->filterAll('meal_id', $this->data['id']);
        $foods = [];
        $repository = $repositories->get('food');
        foreach ($entities as $entity) {
            $food = [];
            $food_entity = $repository->get($entity['food_id']);
            $food['food'] = $food_entity;
            $food['amount'] = $entity['amount'];
            $foods[] = $food;
        }
        $this->data['foods'] = $foods;
    }

    private function setCarbs()
    {
        $carbs_total = 0;
        $foods = [];
        foreach ($this->data['foods'] as $food) {
            $food_entity = $food['food'];
            $carbs = $food_entity['carbs'];
            $food_carbs_total = $carbs * $food['amount'];
            $carbs_total += $food_carbs_total;
            $food['carbs'] = $food_carbs_total;
            $foods[] = $food;
        }
        $this->data['foods'] = $foods;
        $this->data['carbs'] = $carbs_total;
    }

    private function setSodium()
    {
        $sodium_total = 0;
        $foods = [];
        foreach ($this->data['foods'] as $food) {
            $food_entity = $food['food'];
            $sodium = $food_entity['sodium'];
            $food_sodium_total = $sodium * $food['amount'];
            $sodium_total += $food_sodium_total;
            $food['sodium'] = $food_sodium_total;
            $foods[] = $food;
        }
        $this->data['foods'] = $foods;
        $this->data['sodium'] = $sodium_total;
    }

}