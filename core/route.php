<?php
require_once "view.php";
require_once "controller.php";
require_once "controllers/main_controller.php";
require_once "controllers/postalServices_controller.php";
require_once "models/CRUD.php";
require_once "models/number_id.php";
require_once "models/registered_mail.php";
require_once "models/function.php";
require_once "models/addressee.php";
require_once "models/sender.php";

if (!empty($_GET['r'])) {
    $paramController = $_GET['r'];

    $paramController = explode("/", $paramController);
//print_r($paramController);
    $controller = ucfirst($paramController[0]);
    $action = ucfirst($paramController[1]);

    $controllerName = $controller . 'Controller';
    $actionName = "action" . $action;
    if (class_exists($controllerName)) {
        $mainController = new $controllerName();
        if (method_exists($controllerName, $actionName)) {
            $mainController->$actionName();
        } else {
            $mainController->actionIndex();
        }
    } else {
        echo "404";
    }
} else {
    $mainController = new MainController();
    $mainController->actionIndex();
}
