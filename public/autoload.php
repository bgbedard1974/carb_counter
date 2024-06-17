<?php

spl_autoload_register(function ($class_name) {
    include '../src/' . str_replace('\\', "/", $class_name) . '.php';
});