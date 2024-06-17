<?php


namespace Core;


class Controller
{
    protected $container;
    private $template;
    protected $data;

    public function __construct($container)
    {
        $this->container = $container;

        $this->template = 'base.html.twig';
        $this->data = [
            'site_name' => 'Carb Counter',
            'base_path' => '/carb_counter/public'
        ];
    }

    protected function setTemplate($template)
    {
        $this->template = $template;
    }

    protected function render($data)
    {
        $renderer = $this->container->get('renderer');
        $this->data = array_merge($this->data, $data);
        return $renderer->render($this->template, $this->data);
    }
}