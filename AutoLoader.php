<?php

spl_autoload_register(function($class_name)
{
    $prefix = str_replace('\\', '/', $class_name);
    $class_path = str_replace('webshop_v2/', '', $prefix);
    $full_class_path = dirname(__FILE__) . '/' . $class_path . '.php';

    if(file_exists($full_class_path)){
        require($full_class_path);
        return true;
    }
    return false;
});
