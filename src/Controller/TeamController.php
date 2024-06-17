<?php


namespace Controller;


use Model\FoodModel;

class TeamController extends \Core\Controller
{
    private $model;

    public function __construct($container, $id)
    {
        parent::__construct($container);
        $this->setTemplate('food.html.twig');
        $this->model = new FoodModel($this->db, $id);
    }

    public function indexAction()
    {
        $model_data = $this->model->getData();
        $data = [
            'page_title' => "Team",
        ];
        $data = array_merge($data, $model_data);
        return $this->render($data);
    }
}