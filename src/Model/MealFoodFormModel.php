<?php


namespace Model;


class MealFoodFormModel extends \Core\Model
{
    public function __construct($container, $id)
    {
        parent::__construct();
        $meal = new MealModel($container);
        if ($id == 0) {
            $meal->create();
        } else {
            $meal->createFromId($id);
        }
        $this->data['meal'] = $meal->getData();

        $repositories = $container->get('repositories');
        $repository = $repositories->get('food');
        $foods = $repository->getAll();
        $options_model = new OptionsModel($foods, 'id', 'name', true);
        $data = $options_model->getData();
        $this->data['food_options'] = $data['options'];
    }
}