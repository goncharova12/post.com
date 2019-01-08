<?php

class Sender extends CRUD
{
    public $nameSender;
    public $addressSender;

    /**
     * @return mixed возращает идентификатор отправителя
     */
    public function createSender()
    {
        $readId = $this->twoColumnSearch("sender", "name_sender", $this->nameSender, "address_sender", $this->addressSender);
        $boolResult = (bool)$readId;
        if ($boolResult != true) {
            $this->dataTable = '"", "' . $this->nameSender . '", "' . $this->addressSender . '"';
            $this->nameTable = "sender";
            $this->create();
            $readId = $this->twoColumnSearch("sender", "name_sender", $this->nameSender, "address_sender", $this->addressSender);
            return $readId[0]["number"];
        } else {
            return $readId[0]["number"];

        }

    }

    /**
     * @return mixed возвращает массив, содержащий все данные об отправителях
     */
    public function getSenderAll()
    {
        $this->dataTable = "*";
        $this->nameTable = "sender";
        $this->nameColumn = "number";
        $result = $this->read();
//        var_dump($result);
        return $result;
    }

    /**
     * @return mixed возвращает массив, содержащий данные об отправителе, которого искали по ID
     */
    public function getSenderOneByID()
    {
        $result = $this->oneColumnSearch("sender", "number", $this->nameSender);
//        var_dump($result);
        return $result;
    }

    /**
     * @return bool|mixed|mysqli_result возвращает массив, содержащий данные об отправителе, которого искали по имени
     */
    public function getSenderOneByName()
    {
        $result = $this->searchForData("sender", "name_sender", $this->nameSender);
//        var_dump($result);
        return $result;
    }

}