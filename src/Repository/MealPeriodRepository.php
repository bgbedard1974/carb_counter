<?php


namespace Repository;


class MealPeriodRepository extends \Core\Repository
{
    public function __construct($db)
    {
        $columns = [
            'id' => 'int',
            'name' => 'string'
        ];
        $table = 'meal_period';
        parent::__construct($db, $table, $columns);
    }
}