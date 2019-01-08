<?php

class Addressee extends CRUD
{
    public $nameAddressee;
    public $addressAddressee;

    /**
     * @return mixed возвращает ID сохраненного адресата
     */
    public function createAddressee()
    {
        $readId = $this->twoColumnSearch("addressee", "name_addressee", $this->nameAddressee, "address", $this->addressAddressee);
        $boolResult = (bool)$readId;
        if ($boolResult != true) {
            $this->dataTable = '"", "' . $this->nameAddressee . '", "' . $this->addressAddressee . '"';
            $this->nameTable = "addressee";
            $this->create();
            $readId = $this->twoColumnSearch("addressee", "name_addressee", $this->nameAddressee, "address", $this->addressAddressee);
//            var_dump($readId[0]["number"]);
            return $readId[0]["number"];
        } else {
//            var_dump($readId[0]["number"]);
            return $readId[0]["number"];
        }

    }

    /**
     * @return mixed возвращает массив, содержащий данные обо бо всех получателях
     */
    public function getAddresseeAll()
    {
        $this->dataTable = "*";
        $this->nameTable = "addressee";
        $this->nameColumn = "number";
        $result = $this->read();
//        var_dump($result);
        return $result;
    }

    /**
     * @return mixed возвращает массив, содержащий данные об получателе, которого искали по ID
     */
    public function getAddresseeOneByID()
    {
        $result = $this->oneColumnSearch("addressee", "number", $this->nameAddressee);
//        var_dump($result);
        return $result;
    }

    /**
     * @return bool|mixed|mysqli_result возвращает массив, содержащий данные об получателе, которого искали по имени
     */
    public function getAddresseeOneByName()
    {
        $result = $this->searchForData("addressee", "name_addressee", $this->nameAddressee);
//        var_dump($result);
        return $result;
    }
}