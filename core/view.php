<?php

class View
{
    public $page;
    public $template;

    /**
     * View constructor.
     * @param $page
     * @param $template
     */
    public function __construct($page = NULL, $template = NULL)
    {
//        $this->page = $page;
//        $this->template = $template;
    }

    /**
     * Генерация страницы
     */
    public function render($result)
    {
        if(!empty($result)){
            extract($result,EXTR_OVERWRITE );
        }
        include_once "views/$this->page";
    }
}