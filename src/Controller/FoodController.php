<?php


namespace Controller;


use Model\FoodModel;
use Model\FoodsModel;


class FoodController extends \Core\Controller
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
        $this->setTemplate('foods.html.twig');
        $model = new FoodsModel($this->container);
        $data = [
            'page_title' => "Foods",
            'foods' => $model->getData()
        ];
        if ($this->message) {
            $data['message'] = $this->message;
        }
        return $this->render($data);
    }

    public function viewAction()
    {
        $this->setTemplate('food.html.twig');
        $model = new FoodModel($this->container);
        $model->createFromId($this->id);
        $data = [
            'page_title' => "Food",
            'food' => $model->getData()
        ];
        if ($this->message) {
            $data['message'] = $this->message;
        }
        return $this->render($data);
    }

    public function newAction()
    {
        $this->setTemplate('food_form.html.twig');
        $model = new FoodModel($this->container);
        $model->create();
        $data = [
            'page_title' => "Create New Food",
            'food' => $model->getData()
        ];
        return $this->render($data);
    }

    public function editAction()
    {
        $this->setTemplate('food_form.html.twig');
        $model = new FoodModel($this->container);
        $model->createFromId($this->id);
        $data = [
            'page_title' => "Edit Food",
            'food' => $model->getData()
        ];
        return $this->render($data);
    }

    public function saveAction()
    {
        $data = [
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'carbs' => $_POST['carbs'],
            'sodium' => $_POST['sodium']
        ];
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('food');
        $this->id = $repository->save($data);
        $this->message = "Food Saved.";
        return $this->viewAction();
    }
/*
    public function confirmAction()
    {
        $this->setTemplate('confirm.html.twig');
        $model = new FoodModel($this->container, $this->id);
        $model_data = $model->getData();
        $data = [
            'page_title' => "Delete Team",
            'name' => $model_data['location'] . " " . $model_data['nickname'],
            'id' => $model_data['id'],
            'type' => 'team',
            'type_plural' => 'teams'
        ];
        return $this->render($data);
    }

    public function deleteAction()
    {
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('team');
        $entity = $repository->get($this->id);
        $repository->delete($entity);
        $this->message = "Team Deleted.";
        return $this->indexAction();
    }
*/
}