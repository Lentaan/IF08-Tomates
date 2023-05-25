<?php

require_once '../global_const.php';
require_once 'routes.php';
require_once MODEL_DIR . 'ModelUser.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($user) && isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

$request = str_replace(parse_url(BASE_URL)['path'], '', $_SERVER['REQUEST_URI']);
$parsed_path = parse_url($request)['path'];
$args = $_GET;
$args['method'] = $_SERVER['REQUEST_METHOD'];


if (isset($routes[$parsed_path])) {
    $route = $routes[$parsed_path];
    if ($parsed_path === '' || $parsed_path === 'deconnexion') {
        $_SESSION['user'] = null;
        unset($user);
    }
    $roles = ModelUser::getNameRoles();

    if ($route[0] !== 'homepage' && (!isset($user) || $user->getStatus() !== $roles[$route[0]])) {
        header('Location: connexion?code_err=3');
    }

    $controller = 'Controller' . ucfirst($route[0]);
    require_once CONTROLLER_DIR . $controller . '.php';
    $action = $route[1];
    $controller::$action($args);
} else {
    require_once CONTROLLER_DIR . 'ControllerHomepage.php';
    ControllerHomepage::display404($args);
}

