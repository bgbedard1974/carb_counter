<?php


namespace Repository;


class MealFoodRepository extends \Core\Repository
{
    public function __construct($db)
    {
        $columns = [
            'id' => 'string',
            'meal_id' => 'int',
            'food_id' => 'int',
            'amount' => 'int'
        ];
        $table = 'meal_food';
        parent::__construct($db, $table, $columns);
    }
}