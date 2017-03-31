<?php

/**
 * Get all public methods of a class.
 *
 * @param $class
 */
function methods($class)
{
    $class = new ReflectionClass(get_class($class));
    $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
    echo '<pre>';
    var_dump($methods);
    echo '</pre>';
    die();
}