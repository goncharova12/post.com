<?php

class NumberId extends CRUD
{
    public $numberId;
    public $statusId;

    /**
     * метод используемый для создания новых идентификаторов.
     * @return string возвращается созданный ID
     */
    function createId()
    {
        $barcode = "1821030100001";

        $i = 0;
        while ($i < 1) {
            $result = (bool)$this->searchForData("number_barcode", "barcode", $barcode);
            if ($result == true) {
                $barcode += 1;
            } else {
                $this->numberId = $barcode . mt_rand(0, 9);
                $this->statusId = "1";
                $this->dataTable = $this->numberId . ", " . $this->statusId;
                $this->nameTable = "number_barcode";
                $this->create();
//                var_dump($this->numberId);
                $i++;
                $number = $this->numberId;
            }
        }
        return $number;
    }

    /**
     * @return mixed возвращает массив, содержащий данные обо всех созданных ID
     */
    function getId()
    {
        $this->dataTable = "*";
        $this->nameTable = "number_barcode";
        $this->nameColumn = "barcode";
        $result = $this->read();
//        var_dump($result);
        return $result;
    }

    /**
     * метод для изменения статуса ID
     */
    function updateId()
    {
        $this->nameTable = "number_barcode";
        $this->nameColumn = "barcode";
        $this->nameColumnTwo = "status_id";
        $this->oldDataTable = "1";
        $this->newDataTable = "2";
        $this->update();
    }

    /**
     * метод для удаления ID
     */
    function deleteId()
    {
        $this->nameTable = "number_barcode";
        $this->nameColumn = "barcode";
        $this->dataTable = $this->numberId;
        $this->nameColumnTwo = 'status_id';
        $this->dataTableTwo = 1;
        $newResult = (bool)$this->delete();
        if ($newResult == true) {
            echo $this->dataTable . " удален <hr>";
        } else {
            echo $this->dataTable . "не найден <hr>";
        }
    }

    /**
     * @return mixed возвращает неиспользуемый идентификатор, если таких нет, то создает новый
     */
    function findingAFreeID(){
        $readId = $this->oneColumnSearch("number_barcode", "status_id", "1");
//        var_dump($readId);
        $booleanResult = (bool)$readId;
        if ($booleanResult == true) {
            $this->numberId = $readId[0]["barcode"];
            return $this->numberId;
        } else {
            $this->createId();
        }
    }

    /**
     * @return mixed возвращает ID, поиск которых проходил по статусу.
     */
    function getIDByStatus(){
        $result = $this->oneColumnSearch("number_barcode", "status_id", $this->statusId);
        return $result;
    }
}

