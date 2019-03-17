<?php
class Controller {
    public $model;
    public $view;

    /**
     *
     * создается объект класса View
     */
    public function __construct()
    {
        $this->view = new View();
    }


}