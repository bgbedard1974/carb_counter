<?php


namespace Model;


class VenuesModel extends \Core\Model
{
    public function __construct($container)
    {
        parent::__construct($container);
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('venue');
        $ids = $repository->getIds();
        $this->data = [];
        foreach ($ids as $id) {
            $venue = new DaysModel($this->container, $id);
            $this->data[] = $venue->getData();
        }
    }
}