<?php


namespace Model;


class DaysModel extends \Core\Model
{
    public function __construct($container)
    {
        parent::__construct($container);
        $meals = new MealsModel($container);
        $day_strings = [];
        $days = [];
        foreach ($meals->getData() as $meal) {
            if (!in_array($meal['date'], $day_strings)) {
                $day_strings[] = $meal['date'];
                $date = new \Core\Date($meal['date']);
                $days[] = $date->getData();
            }
        }

        $this->data['days'] = $days;
    }
}