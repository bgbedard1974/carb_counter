<?php


namespace Repository;


class FoodRepository extends \Core\Repository
{
    public function __construct($db)
    {
        $columns = [
            'id' => 'int',
            'name' => 'string',
            'description' => 'string',
            'carbs' => 'int',
            'sodium' => 'int'
        ];
        $table = 'food';
        parent::__construct($db, $table, $columns);
    }
}