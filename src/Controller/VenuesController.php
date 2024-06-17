<?php


namespace Controller;


use Model\DaysModel;
use Model\VenuesModel;
use Model\MealFormModel;

class VenuesController extends \Core\Controller
{
    private $id;
    private $message;

    public function __construct($container, $args = null)
    {
        parent::__construct($container);
        $this->id = null;
        $this->message = null;
        if (isset($args['id'])) {
            $this->id = $args['id'];
        }
    }

    public function indexAction()
    {
        $this->setTemplate('days.html.twig');
        $model = new VenuesModel($this->container);
        $model_data = $model->getData();
        $data = [
            'page_title' => "Venues",
            'venues' => $model_data
        ];
        if ($this->message) {
            $data['message'] = $this->message;
        }
        return $this->render($data);
    }

    public function viewAction()
    {
        $this->setTemplate('meal_day.html.twig');
        $model = new DaysModel($this->container, $this->id);
        $model_data = $model->getData();
        $data = [
            'page_title' => "Venue",
        ];
        if ($this->message) {
            $data['message'] = $this->message;
        }
        $data = array_merge($data, $model_data);
        return $this->render($data);
    }

    public function newAction()
    {
        $this->setTemplate('add_food_form.html.twig');
        $model = new MealFormModel($this->container, 0);
        $data = [
            'page_title' => "Create New Venue"
        ];
        $data = array_merge($data, $model->getData());
        return $this->render($data);
    }

    public function editAction()
    {
        $this->setTemplate('add_food_form.html.twig');
        $model = new MealFormModel($this->container, $this->id);
        $data = [
            'page_title' => "Edit Venue"
        ];
        $data = array_merge($data, $model->getData());
        return $this->render($data);
    }

    public function saveAction()
    {
        $data = [
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'city' => $_POST['city'],
            'state_id' => $_POST['state_id']
        ];
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('venue');
        $this->id = $repository->save($data);
        $this->message = "Venue Saved.";
        return $this->viewAction();
    }

    public function confirmAction()
    {
        $this->setTemplate('confirm.html.twig');
        $model = new DaysModel($this->container, $this->id);
        $model_data = $model->getData();
        $data = [
            'page_title' => "Delete Venue",
            'name' => $model_data['name'],
            'id' => $model_data['id'],
            'type' => 'venue',
            'type_plural' => 'venues'
        ];
        return $this->render($data);
    }

    public function deleteAction()
    {
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('venue');
        $entity = $repository->get($this->id);
        $repository->delete($entity);
        $this->message = "Venue Deleted.";
        return $this->indexAction();
    }
}