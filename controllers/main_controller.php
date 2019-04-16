<?php

class MainController extends Controller
{
    /**
     * метод, загружающий главную страницу сайта
     */
    public function actionIndex()
    {
        $this->view->page = "main.php";
        $this->view->render('');
    }


}