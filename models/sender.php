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

    /**
     * Метод для изменения имени
     * @param $oldNameSender string, имя которое нужно изменить
     * @param $oldAddressSender string, старый адрес. Нужен для поиска строки, в которой нужно произвести замену
     */
    public function updateNameSender($oldNameSender, $oldAddressSender){
        $this->newDataTable = $this->nameSender;
        $this->nameTable = "sender";
        $this->nameColumnTwo = "name_sender";
        $this->nameColumn = "address_sender";
        $this->dataTable = $oldAddressSender;
        $this->oldDataTable = $oldNameSender;
        $this->update();
    }

    /**
     * метод для изменения адреса
     * @param $oldNameSender string, старое имя. Нужно для поиска строки, по которой нужно произвести замену
     * @param $oldAddressSender string, адрес, который нужно заменить.
     */
    public function updateAddress($oldNameSender, $oldAddressSender){
        $this->newDataTable = $this->addressSender;
        $this->nameTable = "sender";
        $this->nameColumnTwo = "address_sender";
        $this->nameColumn = "name_sender";
        $this->dataTable = $oldNameSender;
        $this->oldDataTable = $oldAddressSender;
        $this->update();
    }

    /**
     * метод для изменения имани и адреса получателя
     * @param $oldNameSender string, старое имя
     * @param $oldAddressSender string, старый адрес
     */
    public function updateNameAndAddressSender($oldNameSender, $oldAddressSender){
        $this->updateNameSender($oldNameSender, $oldAddressSender);
        $this->updateAddress($oldNameSender, $oldAddressSender);
    }
}