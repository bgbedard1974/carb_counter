<?php


namespace Controller;


use Model\DaysModel;

class VenueController extends \Core\Controller
{
    private $model;

    public function __construct($container, $id)
    {
        parent::__construct($container);
        $this->setTemplate('meal_day.html.twig');
        $this->model = new DaysModel($this->db, $id);
    }

    public function indexAction()
    {
        $model_data = $this->model->getData();
        $data = [
            'page_title' => "Venue",
        ];
        $data = array_merge($data, $model_data);
        return $this->render($data);
    }
}