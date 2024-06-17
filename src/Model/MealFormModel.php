<?php


namespace Model;


class MealFormModel extends \Core\Model
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
        $repository = $repositories->get('meal_period');
        $periods = $repository->getAll();
        $options_model = new OptionsModel($periods, 'id', 'name');
        $data = $options_model->getData();
        $this->data['period_options'] = $data['options'];
    }
}