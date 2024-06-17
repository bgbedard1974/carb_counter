<?php


namespace Controller;

use Model\MealDayModel;

class IndexController extends \Core\Controller
{
    public function __construct($container, $args = null)
    {
        parent::__construct($container);
    }

    public function indexAction()
    {
        $this->setTemplate('index.html.twig');
        $today = new \Core\Date();
        //$today = new \Core\Date('05_18_2020');
        $model = new MealDayModel($this->container, $today);
        $data = $model->getData();
        $data['page_title'] = "Home";
        return $this->render($data);
    }
}