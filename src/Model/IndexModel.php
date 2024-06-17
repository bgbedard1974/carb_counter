<?php


namespace Model;


class IndexModel extends \Core\Model
{
    public function __construct($container)
    {
        /*
        parent::__construct();
        $today = '05_18_2020';
        $repositories = $container->get('repositories');
        $meals = $repositories->get('meal');
        $foods = $repositories->get('food');
        $meal_foods = $repositories->get('meal_food');
        $periods = $repositories->get('meal_period');
        $entities = $meals->filterAll('date', $today);
        $meals_today = [];
        $carbs_total = 0;
        foreach ($entities as $entity) {
            $foods_eaten = $meal_foods->filterAll('meal_id', $entity['id']);
            $entity['period'] = $periods->get($entity['period_id']);
            $food = [];
            foreach ($foods_eaten as $item) {
                $food_entity = $foods->get($item['food_id']);
                $food_eaten = [];
                $food_eaten['name'] = $food_entity['name'];
                $carbs = $food_entity['carbs'] * $item['amount'];
                $carbs_total += $carbs;
                $food_eaten['carbs'] = $carbs;
                $food[] = $food_eaten;
            }
            $meals_today[] = [
                'meal' => $entity,
                'foods' => $food
            ];
        }

        $this->data = [
            'today' => $today,
            'meals' => $meals_today,
            'num_meals' => count($meals_today),
            'total_carbs' => $carbs_total
        ];
*/
    }

}