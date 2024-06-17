<?php


namespace Model;


class MealDayModel extends \Core\Model
{
    public function __construct($container, $day)
    {
        parent::__construct();
        $repositories = $container->get('repositories');
        $repository = $repositories->get('meal');
        $entities = $repository->filterAll('date', $day->toString());
        $meals = [];
        $total_carbs = 0;
        $total_sodium = 0;
        foreach ($entities as $entity) {
            $model = new MealModel($container);
            $model->createFromEntity($entity);
            $data = $model->getData();
            $total_carbs += $data['carbs'];
            $total_sodium += $data['sodium'];
            $meals[] = $data;
        }
        $this->data = [
            'day' => $day->getData(),
            'meals' => $meals,
            'num_meals' => count($meals),
            'total_carbs' => $total_carbs,
            'total_sodium' => $total_sodium
        ];
    }

    public function construct_bk($container, $day)
    {
        parent::__construct();
        $repositories = $container->get('repositories');
        $meals = $repositories->get('meal');
        $foods = $repositories->get('food');
        $meal_foods = $repositories->get('meal_food');
        $periods = $repositories->get('meal_period');
        $entities = $meals->filterAll('date', $day->toString());
        $meals_day = [];
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
            $meals_day[] = [
                'meal' => $entity,
                'foods' => $food
            ];
        }

        $this->data = [
            'day' => $day->getData(),
            'meals' => $meals_day,
            'num_meals' => count($meals_day),
            'total_carbs' => $carbs_total
        ];

    }
}