<?php


namespace Model;


class TeamFormModel extends \Core\Model
{
    public function __construct($container, $id)
    {
        parent::__construct($container);
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('team');
        if ($id == 0) {
            $this->data['team'] = $repository->create();
        } else {
            $this->data['team'] = $repository->get($id);
        }
        // Create options list for leagues
        $repository = $repositories->get('league');
        $entities = $repository->getAll();
        $league_options = [];
        foreach ($entities as $entity) {
            $key = $entity['id'];
            $value = $entity['abbr'];
            $league_options[$key] = $value;
        }
        $this->data['league_options'] = $league_options;

        // Create options list for venues
        $repository = $repositories->get('venue');
        $entities = $repository->getAll();
        $venue_options = [];
        foreach ($entities as $entity) {
            $key = $entity['id'];
            $value = $entity['name'];
            $venue_options[$key] = $value;
        }
        $this->data['venue_options'] = $venue_options;
    }
}