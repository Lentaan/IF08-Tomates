<?php

require_once '../global_var.php';
require_once CONTROLLER_DIR . 'ControllerInterface.php';

$parsed_url = parse_url($_SERVER['REQUEST_URI']);
$parsed_path = explode('/', ltrim($parsed_url['path'], '/'));
$args = $_GET;
$method = $_SERVER['REQUEST_METHOD'];

if (isset($parsed_path[0]) && !empty($parsed_path[0])) {
    $controller = 'Controller' . ucfirst($parsed_path[0]);
    if (file_exists(CONTROLLER_DIR . $controller . '.php')) {
        require_once CONTROLLER_DIR . $controller . '.php';
        if (class_exists($controller) && ($c = new ReflectionClass($controller))->implementsInterface(
            ControllerInterface::class
          )) {
            if (isset($parsed_path[1]) && $c->hasMethod($parsed_path[1])) {
                $action = $parsed_path[1];
                $controller::$action($args);
            } else {
                $controller::display404($args);
            }
        } else {
            require_once CONTROLLER_DIR . 'ControllerHomepage.php';
            ControllerHomepage::displayError($args);
        }
    } else {
        require_once CONTROLLER_DIR . 'ControllerHomepage.php';
        ControllerHomepage::display404($args);
    }
} else {
    require_once CONTROLLER_DIR . 'ControllerHomepage.php';
    ControllerHomepage::view($args);
}

