<?php


namespace Controller;


use Model\MealModel;
use Model\MealFoodFormModel;
use Model\MealFormModel;
use Model\MealsModel;

class MealController extends \Core\Controller
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
        $this->setTemplate('meals.html.twig');
        $model = new MealsModel($this->container);
        $model_data = $model->getData();
        $data = [
            'page_title' => "Meals",
            'meals' => $model_data
        ];
        if ($this->message) {
            $data['message'] = $this->message;
        }
        return $this->render($data);
    }

    public function viewAction()
    {
        $this->setTemplate('meal.html.twig');
        $model = new MealModel($this->container);
        $model->createFromId($this->id);
        $data = [
            'page_title' => "Meal",
            'meal' => $model->getData()
        ];
        if ($this->message) {
            $data['message'] = $this->message;
        }
        return $this->render($data);
    }

    public function newAction()
    {
        $this->setTemplate('meal_form.html.twig');
        $model = new MealFormModel($this->container, 0);
        $data = [
            'page_title' => "Create New Meal"
        ];
        $data = array_merge($data, $model->getData());
        return $this->render($data);
    }

    public function editAction()
    {
        $this->setTemplate('meal_form.html.twig');
        $model = new MealFormModel($this->container, $this->id);
        $data = [
            'page_title' => "Edit Meal"
        ];
        $data = array_merge($data, $model->getData());
        return $this->render($data);
    }

    public function saveAction()
    {
        $data = [
            'id' => $_POST['id'],
            'period_id' => $_POST['period_id'],
            'date' => $_POST['date']
        ];
        $repositories = $this->container->get('repositories');
        $repository = $repositories->get('meal');
        $this->id = $repository->save($data);
        $this->message = "Meal Saved.";
        return $this->viewAction();
    }

    public function addFoodAction()
    {
        $this->setTemplate('add_food_form.html.twig');
        $model = new MealFoodFormModel($this->container, $this->id);
        $data = [
            'page_title' => "Add Food to Meal"
        ];
        $data = array_merge($data, $model->getData());
        return $this->render($data);
    }

    public function saveFoodAction()
    {
        $c = 0;
        for ($i = 1; $i <= 5; $i++) {
            $food_key = 'food_id_' . $i;
            $amount_key = 'amount_' . $i;
            if ($_POST[$food_key] != 0) {
                $c++;
                $data = [
                    'id' => 0,
                    'meal_id' => $_POST['id'],
                    'food_id' => $_POST[$food_key],
                    'amount' => $_POST[$amount_key]
                ];
                $repositories = $this->container->get('repositories');
                $repository = $repositories->get('meal_food');
                $id = $repository->save($data);
            }
        }

        $this->message = "$c Food Added.";
        $this->id = $_POST['id'];
        return $this->viewAction();
    }
}