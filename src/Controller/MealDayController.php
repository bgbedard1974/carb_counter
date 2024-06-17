<?php


namespace Controller;


use Model\DaysModel;
use Model\MealDayModel;


class MealDayController extends \Core\Controller
{
    private $day;

    public function __construct($container, $args = null)
    {
        if (isset($args['day'])) {
            $this->day = $args['day'];
        }
        parent::__construct($container);
    }

    public function indexAction()
    {
        $this->setTemplate('days.html.twig');
        $model = new DaysModel($this->container);
        $data = $model->getData();
        $data['page_title'] = "Dates";
        return $this->render($data);
    }

    public function viewAction()
    {
        $this->setTemplate('meal_day.html.twig');
        //$today = new \Core\Date();
        $today = new \Core\Date($this->day);
        $model = new MealDayModel($this->container, $today);
        $data = $model->getData();
        $data['page_title'] = "Meals on this day";
        return $this->render($data);
    }

}