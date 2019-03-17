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
     * @param $result @param $result array, массив, содержащий данные, извлеченные из БД, необходимые для работы на сгенерированной странице
     */
    public function render($result)
    {
        /**
         * если существует переданный параметр, то массив разбивается на ключ и значение, где ключ становится названием переменной, которой присваивается значение
         */
        if(!empty($result)){
            extract($result,EXTR_OVERWRITE );
        }
        include_once "views/$this->page";
    }
}