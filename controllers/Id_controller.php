<?php

class IdController extends Controller
{
    /**
     * метод, отвечающий за загрузку главной страницы, работающей с идентификаторами
     */
    public function actionIndex()
    {
        //создается объект класса NumberId
        $numberId = new NumberId();

        //Если существующий $_POST['status'] не пустой, идет поиск идентификаторов по статусу, иначе отображуются все созданные идентификатор
        if (!empty($_POST['status'])) {
            $numberId->statusId = filter_input(INPUT_POST, $_POST['status'], FILTER_VALIDATE_INT);
            $ID = $numberId->getIDByStatus();
//        var_dump($ID);
        } else {
            $ID = $numberId->getId();
//        var_dump($ID);
        }

        //С помощью $i подсчитывается количество строк в таблице, в которой выводятся идентификаторы. По умолчанию $i присваивается значение 1, во вьюше происходит при каждой итерации увеличение числа на единицу и вывод текущего значения на экран.
        $i = 1;

        // с помощью функции compact создается ассоциативный массив, где название переменной - ключ, а значение переменной, становится значением массива, которое привязывается к ключу.
        $result = compact('ID', 'i');
        $this->view->page = "viewId/view_id.php";
        $this->view->render($result);

    }

    /**
     * Метод, который вызывается при удалении идентификаторов
     */
    public function actionDeleteId()
    {
        //создается объект класса NumberId
        $numberId = new NumberId();

        //Если $_POST['delete'] и $_POST['number'] не пустые удаляются выбранные идентификаторы и результат выполнения функции присваивается $text, иначе $text присваивается строка, в которой оповещается, что ничего не выбрано.
        if (!empty($_POST['delete'])) {
            if (!empty($_POST['number'])) {
//        var_dump($_POST);
                $deleteId = filter_input(INPUT_POST, $_POST['number'], FILTER_VALIDATE_INT);
//        var_dump($deleteId);
                $text = deleteID($deleteId, $numberId);
            } else {
                $text = "Выберите ID, который хотите удалить";
            }
        }

        //происходит поиск имеющихся на данный момент всех идентификаторов
        $ID = $numberId->getId();

//С помощью $i подсчитывается количество строк в таблице, в которой выводятся идентификаторы. По умолчанию $i присваивается значение 1, во вьюше происходит при каждой итерации увеличение числа на единицу и вывод текущего значения на экран.я
        $i = 1;

        // с помощью функции compact создается ассоциативный массив, где название переменной - ключ, а значение переменной, становится значением массива, которое привязывается к ключу.
        $result = compact('ID', 'i', 'text');
        $this->view->page = "viewId/view_id.php";
        $this->view->render($result);

    }

    /**
     * метод, вызывающий страницу, в которой создаются идентификаторы
     */
    public function actionCreateId()
    {
        //создается объект класса NumberId
        $numberId = new NumberId();

        //Если $_POST['number'] не пустой
        if (!empty($_POST['number'])) {
            //$countId передается количество идентификаторов, которых нужно создать
            $countId = filter_input(INPUT_POST, $_POST['number']< FILTER_VALIDATE_INT);
            //генерируется необходимое количество идентификаторов. Результат выполнения функции присваивается $id(array)
            $id = createId($countId, $numberId);
            //создается переменная $createID, которой присваивается пустое значение
            $createID = "";

           //$id раскладывается на значения. Формируется строка из созданных идентификаторов
            foreach ($id as $value) {
                $createID .= "$value <br>";
            }
            // создается текстовое сообщение о созданных идентификаторах
            $text = "Созданы следующие ID: <br> $createID";
        }

        $result = compact('text');
        $this->view->page = "viewId/create_id.php";
        $this->view->render($result);
    }
}