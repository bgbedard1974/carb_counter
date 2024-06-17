<?php


namespace Repository;


class MealRepository extends \Core\Repository
{
    public function __construct($db)
    {
        $columns = [
            'id' => 'int',
            'period_id' => 'string',
            'date' => 'int'
        ];
        $table = 'meal';
        parent::__construct($db, $table, $columns);
    }
}