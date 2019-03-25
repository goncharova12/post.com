<?php
require_once "view.php";
require_once "controller.php";
require_once "controllers/main_controller.php";
require_once "controllers/postalServices_controller.php";
require_once "controllers/tableMails_controller.php";
require_once "controllers/trackingMails_controller.php";
require_once "controllers/Id_controller.php";
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
        //если есть указанный контроллер, то создаем объект контроллера
        $mainController = new $controllerName();
        if (method_exists($controllerName, $actionName)) {
            //если есть в контроллере указанный метод, открывается нужная страница
            $mainController->$actionName();
        } else {
            // если нет указанного метода в нужном классе происходит переход на главную страницу текущего раздела
            $mainController->actionIndex();
        }
    } else {
        //если нет указанного контроллера выводит 404 ошибку
        echo "404";
    }
} else {
    //если нет $_GET['r'] происходит переход на главную страницу сайта
    $mainController = new MainController();
    $mainController->actionIndex();
}
