<?php

class MainController extends Controller
{
    /**
     * метод, загружающий главнйю страницу сайта
     */
    public function actionIndex()
    {
        $this->view->page = "main.php";
        $this->view->render('');
    }


}