<?php

class MainController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
    }

    public function actionIndex()
    {
        $this->view->page = "main.php";
        $this->view->render('');
    }


}