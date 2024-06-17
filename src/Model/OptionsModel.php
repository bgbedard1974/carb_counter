<?php


namespace Model;


class OptionsModel extends \Core\Model
{
    public function __construct($entities, $key_field, $value_field, $default_choice = false)
    {
        parent::__construct();
        $options = [];
        if ($default_choice) {
            $options[0] = '--Select One--';
        }
        foreach ($entities as $entity) {
            $key = $entity[$key_field];
            $value = $entity[$value_field];
            $options[$key] = $value;
        }
        $this->data['options'] = $options;
    }
}