<?php

class RegisteredMail extends CRUD
{
    public $numberId;
    public $typeMail;
    public $sender;
    public $fromSender;
    public $addressee;
    public $toAddressee;
    public $statusMail;
    public $dateMail;

    /**
     * @return bool|false|string возвращает дату и время сохранения регистрации в таблицу status_registration
     */
    public function registeredStatusMail()
    {
        //ищем не было ли уже принято отправление с таким номером
        $read = $this->twoColumnSearch("status_registration", "number_id", $this->numberId, "status_mail", $this->statusMail);
        $result = (bool)$read;

        //если результат отрицательный, то
        if ($result == false) {
            //узнаем текущие дату и время с помощью функции date, результат выполнения функции присваиваем $dateTime
            $dateTime = date("d/m/Y - G:i", time());
            //Создаем строку, в которой будут содержатся данные для сохранения в БД
            $this->dataTable = '"' . $this->numberId . '", "' . $this->statusMail . '", "' . $dateTime . '"';
            //указываем название таблицы, куда нужно сохранить
            $this->nameTable = "status_registration";
            //var_dump($this->dataTable);
            //регистрируем отправление со статусом принято в таблице статусов регистрации
            $this->create();
            // ищем зарегистрированное текущее отправление для того, чтобы получить время регистрации
            $read = $this->twoColumnSearch($this->nameTable, "number_id", $this->numberId, "status_mail", $this->statusMail);
//            var_dump($read);
            $dateTime = $read[0]["time_acceptance"];
//            var_dump($dateTime);
            return $dateTime;
        } else {
            // если результат поиска положительный, то возвращаем false
            return false;
        }
    }

    /**
     * @param $numberId object
     * @param $addressee object
     * @param $sender object
     * метод, сохраняющий в таблицу registered_mail данные об отправлении и регистрирующий статус приема в таблице
     *     status_registration
     */
    public function createMail($numberId, $addressee, $sender)
    {
        //вызываем методы для сохранения данных об отправителе и получателе.
        $this->sender = $this->fromSender = $sender->createSender();
        $this->addressee = $this->toAddressee = $addressee->createAddressee();
        //сохраняем статус регистрации в таблице статусов
        $this->dateMail = $this->registeredStatusMail();

        //сохраняем полученные данные в главную таблицу registered_mail
        $this->dataTable = '"' . $this->numberId . '", "' . $this->typeMail . '", "' . $this->sender . '", "' . $this->fromSender . '", "' . $this->addressee . '", "' . $this->toAddressee . '", "' . $this->statusMail . '", "' . $this->dateMail . '"';
        $this->nameTable = 'registered_mail';
        $this->create();

        //изменяем статус используемого ID
        $numberId->dataTable = $this->numberId;
        $numberId->updateId();
    }

    /**
     * метод для изменения статуса отправления
     */
    public function updateStatusMail()
    {
        $this->nameTable = "registered_mail";
        $this->nameColumnTwo = "status_mail";
        $this->nameColumn = "number_id";
        $this->newDataTable = $this->statusMail;
        $this->dataTable = $this->numberId;
        $result = $this->oneColumnSearch($this->nameTable, $this->nameColumn, $this->dataTable);
        $this->oldDataTable = $result[0]['status_mail'];
        $this->update();

    }

    /**
     * метод для изменения даты и время регистрации
     */
    public function updateDateMail()
    {
        $this->nameTable = "registered_mail";
        $this->nameColumnTwo = "date_time";
        $this->nameColumn = "number_id";
        $this->newDataTable = $this->dateMail;
        $this->dataTable = $this->numberId;
        $result = $this->oneColumnSearch($this->nameTable, $this->nameColumn, $this->dataTable);
        $this->oldDataTable = $result[0]['date_time'];
        $this->update();
    }

//    /**
//     * @param $addressee object
//     * метод для изменения получателя в таблице registered_mail
//     */
//    public function updateAddresseeMail($addressee)
//    {
//        $this->newDataTable = $addressee->createAddressee();
//        $this->nameTable = "registered_mail";
//        $this->nameColumnTwo = "addressee";
//        $this->nameColumn = "number_id";
//        $this->dataTable = $this->numberId;
//        $result = $this->oneColumnSearch($this->nameTable, $this->nameColumn, $this->dataTable);
//        $this->oldDataTable = $result[0]['addressee'];
//        $this->update();
//    }
//
//    /**
//     * @param $addressee object
//     * метод для изменения адреса получателя в таблице registered_mail
//     */
//    public function updateToAddresseeMail($addressee)
//    {
//        $this->newDataTable = $addressee->createAddressee();
//        $this->nameTable = "registered_mail";
//        $this->nameColumnTwo = "to_addressee";
//        $this->nameColumn = "number_id";
//        $this->dataTable = $this->numberId;
//        $result = $this->oneColumnSearch($this->nameTable, $this->nameColumn, $this->dataTable);
//        $this->oldDataTable = $result[0]['to_addressee'];
//        $this->update();
//    }
//
//    /**
//     * @param $sender object
//     * метод для изменения отправителя в таблице registered_mail
//     */
//    public function updateSenderMail($sender)
//    {
//        $this->newDataTable = $sender->createSender();
//        $this->nameTable = "registered_mail";
//        $this->nameColumnTwo = "sender";
//        $this->nameColumn = "number_id";
//        $this->dataTable = $this->numberId;
//        $result = $this->oneColumnSearch($this->nameTable, $this->nameColumn, $this->dataTable);
//        $this->oldDataTable = $result[0]['sender'];
//        $this->update();
//    }
//
//    /**
//     * @param $sender object
//     * метод для изменения адреса отправителя в таблице registered_mail
//     */
//    public function updateFromSenderMail($sender)
//    {
//        $this->newDataTable = $sender->createSender();
//        $this->nameTable = "registered_mail";
//        $this->nameColumnTwo = "from_sender";
//        $this->nameColumn = "number_id";
//        $this->dataTable = $this->numberId;
//        $result = $this->oneColumnSearch($this->nameTable, $this->nameColumn, $this->dataTable);
//        $this->oldDataTable = $result[0]['from_sender'];
//        $this->update();
//    }

    /**
     * метод для изменения типа отправления в таблице registered_mail
     */
    public function updateTypeMail()
    {
        $this->newDataTable = $this->typeMail;
        $this->nameTable = "registered_mail";
        $this->nameColumnTwo = "type_mail";
        $this->nameColumn = "number_id";
        $this->dataTable = $this->numberId;
        $result = $this->oneColumnSearch($this->nameTable, $this->nameColumn, $this->dataTable);
        $this->oldDataTable = $result[0]['type_mail'];
        $this->update();
    }

    /**
     * метод для регистрации статусов обработки заказов (покинуло пункт приема, прибыло в пункт выдачи, вручение) в
     * таблице status_registration и изменения текущих статуса и времени в таблице registered_mail
     */
    public function processingMail()
    {

        switch ($this->statusMail) {

            case 2:
                $result = (bool)$this->twoColumnSearch('status_registration', 'number_id', $this->numberId, 'status_mail', '1');
                if ($result == true) {
                    $this->dateMail = $this->registeredStatusMail();
                    $result = (bool)$this->dateMail;
                    if ($result == false) {
                        echo $this->numberId . " уже был зарегистрирован со статусом " . $this->statusMail;
                    } else {
                        $this->updateStatusMail();
                        $this->updateDateMail();
                        echo "$this->numberId успешно зарегистрирован в системе";
                    }
                } else {
                     echo "$this->numberId не зарегистрирован в системе";
                }
                break;
            case 3:
                $result = (bool)$this->twoColumnSearch('status_registration', 'number_id', $this->numberId, 'status_mail', '2');
                if ($result == true) {
                    $this->dateMail = $this->registeredStatusMail();
                    $result = (bool)$this->dateMail;
                    if ($result == false) {
                        echo $this->numberId . " уже был зарегистрирован со статусом " . $this->statusMail;
                    } else {
                        $this->updateStatusMail();
                        $this->updateDateMail();
                        echo "$this->numberId успешно зарегистрирован в системе";
                    }
                } else {
                    echo "$this->numberId не зарегистрирован в системе либо отсутствует статус 'Покинуло пункт приема'";
                }
                break;
            case 4:
                $result = (bool)$this->twoColumnSearch('status_registration', 'number_id', $this->numberId, 'status_mail', '3');
                if ($result == true) {
                    $this->dateMail = $this->registeredStatusMail();
                    $result = (bool)$this->dateMail;
                    if ($result == false) {
                        echo $this->numberId . " уже был зарегистрирован со статусом " . $this->statusMail;
                    } else {
                        $this->updateStatusMail();
                        $this->updateDateMail();
                        echo "$this->numberId успешно зарегистрирован в системе";
                    }
                } else {
                    echo "$this->numberId не зарегистрирован в системе либо отсутствует статус 'Прибыло в пункт выдачи'";
                }
                break;
        }
    }

    /**
     * @return mixed возвращает статусы, зарегестрированные для конкретного отправления
     */
    public function getStatusMail()
    {
        $result  = $this->conn->query("SELECT status_registration.number_id, status_id.number_status, status_id.status_value, status_registration.time_acceptance FROM `status_registration` LEFT JOIN status_id ON status_registration.status_mail = status_id.number_status WHERE number_id = '$this->numberId'")->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

//    /**
//     * @return mixed возвращает результат поиска по ID из таблицы registered_mail
//     */
//    public function getAllMail()
//    {
//        $this->dataTable = $this->numberId;
//        $this->nameTable ="registered_mail";
//        $this->nameColumn = "number_id";
//        $result = $this->read();
////        var_dump($result);
//        return $result;
//    }

    /**
     * @return mixed возвращает результат поиска по ID из таблицы registered_mail
     */
    public function getOneMailByNumberID()
    {
        $this->dataTable = $this->numberId;
        $this->nameTable = "registered_mail";
        $this->nameColumn = "number_id";
        $result = $this->oneColumnSearch("registered_mail", "number_id", $this->numberId);
//        var_dump($result);
        return $result;
    }

    /**
     * @param $mail array найденные отправления в таблице registered_mail
     * @param $sender object
     * @param $addressee object
     * @return array возвращает преобразованную информаию об искомых отправлениях
     */
    public function getMailInfo($mail, $sender, $addressee)
    {
        $getMailInfo[] = "";
        foreach ($mail as $value) {
            $getMail['number'] = $value['number_id'];
            $getMail['type'] = $this->getTitleTypeMail($value['type_mail']);
            $sender->nameSender = $value['sender'];
            $getSender = $sender->getSenderOneByID();
            $getMail['sender'] = $getSender[0]['name_sender'];
            $getMail['fromSender'] = $getSender[0]['address_sender'];
            $addressee->nameAddressee = $value['addressee'];
            $getAddress = $addressee->getAddresseeOneByID();
            $getMail['addressee'] = $getAddress[0]['name_addressee'];
            $getMail['toAddressee'] = $getAddress[0]['address'];
            $this->statusMail = $value['status_mail'];
            $getMail['statusMail'] = $this->getStatusByID();
            $getMail['dateTime'] = $value['date_time'];
            $getMailInfo[] = $getMail;
        }
//        var_dump($getMailInfo);
        return $getMailInfo;
    }

    /**
     * @return mixed возвращает тип отправления из таблицы type_mail
     */
    public function getTitleTypeMail($typeMail)
    {
        $this->dataTable = $typeMail;
        $this->nameColumn = "number_type";
        $this->nameTable = "type_mail";
        $result = $this->oneColumnSearch($this->nameTable, $this->nameColumn, $this->dataTable);
//        var_dump($result);
        return $result[0]['name_type'];
    }

    /**
     * @param $type принимает значение типа, по которому нужно искать
     * @return mixed возвращает название искомого типа
     */
    public function getTitleTypeMail2($type)
    {
        $this->dataTable = $type;
        $this->nameColumn = "number_type";
        $this->nameTable = "type_mail";
//        $result = $this->oneColumnSearch($this->nameTable, $this->nameColumn, $this->dataTable);
        $result = $this->read();
//        var_dump($result);
        return $result;
    }

    /**
     * @param $typeMail принимает значение типа статуса отправления, по которому нужно искать
     * @return mixed возвращает название статуса отправления
     */
    public function getTitleStatusMail($typeMail)
    {
        $this->dataTable = $typeMail;
        $this->nameColumn = "number_status";
        $this->nameTable = "status_id";
//        $result = $this->oneColumnSearch($this->nameTable, $this->nameColumn, $this->dataTable);
        $result = $this->read();
//        var_dump($result);
        return $result;
    }

    /**
     * @return mixed возвращает результат поиска по статусу регистрации
     */
    public function getMailByStatus()
    {
        $result = $this->oneColumnSearch('registered_mail', 'status_mail', $this->statusMail);
//        var_dump($result);
        return $result;
    }

    /**
     * @return mixed возвращает результат поиска по ID из таблицы status_id
     */
    public function getStatusByID()
    {
        $result = $this->oneColumnSearch('status_id', 'number_status', $this->statusMail);
//        var_dump($result);
        return $result[0]['status_value'];
    }

    /**
     * метод удаления статусов отправления.
     */
    public function deleteStatusMail()
    {
        $this->nameTable = "status_registration";
        $this->nameColumn = "number_id";
        $this->dataTable = $this->numberId;
        $this->nameColumnTwo = "status_mail";
        $this->dataTableTwo = $this->statusMail;

        switch ($this->statusMail) {
            case 1:
                $result = (bool)$this->twoColumnSearch('status_registration', 'status_mail', '2', 'number_id', $this->numberId);
                if ($result == true) {
                    echo "Запрещено удалять статус 'Принято' отправления $this->numberId";
                } else {
                    $this->delete();
                    $this->statusMail = "0";
                    $this->dateMail = date("d/m/Y - G:i", time());
                    $this->updateStatusMail();
                    $this->updateDateMail();
                }
                break;
            case 2:
                $result = (bool)$this->twoColumnSearch('status_registration', 'status_mail', '3', 'number_id', $this->numberId);
//                var_dump($result);
                if ($result == true) {
                    echo "Запрещено удалять статус 'Покинуло пункт приема' отправления $this->numberId";
                } else {
                    $this->delete();
                    $this->dataTable = $this->statusMail = 1;
                    $result = $this->twoColumnSearch('status_registration', 'status_mail', $this->dataTable, 'number_id', $this->numberId);
                    $this->dateMail = $result[0]['time_acceptance'];
                    $this->updateStatusMail();
                    $this->updateDateMail();
                }
                break;
            case 3:
                $result = (bool)$this->twoColumnSearch('status_registration', 'status_mail', '4', 'number_id', $this->numberId);
                if ($result == true) {
                    echo "Запрещено удалять статус 'Поступило в пункт вручения' отправления $this->numberId";
                } else {
                    $this->delete();
                    $this->dataTable = $this->statusMail = 2;
                    $result = $this->twoColumnSearch('status_registration', 'status_mail', $this->dataTable, 'number_id', $this->numberId);
//                    var_dump($result);
                    $this->dateMail = $result[0]['time_acceptance'];
                    $this->updateStatusMail();
                    $this->updateDateMail();
                }
                break;
            case 4:
                $this->delete();
                $this->dataTable = $this->statusMail = 3;
                $result = $this->twoColumnSearch('status_registration', 'status_mail', $this->dataTable, 'number_id', $this->numberId);
                $this->dateMail = $result[0]['time_acceptance'];
                $this->updateStatusMail();
                $this->updateDateMail();
                break;
        }
    }

    /**
     * @param $array принимает значения, по которым нужно произвести поиск
     * @return mixed возращает искомые данные
     */
    function getDesiredMail($array)
    {
        $i = 1;
        $where = "";
        $sql = "SELECT registered_mail.number_id, type_mail.name_type, sender.name_sender, sender.address_sender, addressee.name_addressee, addressee.address, status_id.status_value, registered_mail.date_time FROM registered_mail LEFT JOIN type_mail ON registered_mail.type_mail = type_mail.number_type LEFT JOIN sender ON registered_mail.sender = sender.number LEFT JOIN addressee ON registered_mail.addressee = addressee.number LEFT JOIN status_id ON registered_mail.status_mail = status_id.number_status";
        foreach ($array as $key => $value) {
            switch ($key) {
                case 'name_sender':
                    $key = "sender." . $key;
                    break;
                case 'name_addressee':
                    $key = "addressee." . $key;
                    break;
            }

            if ($value != "") {
                if ($i == 1) {

                    $where = " WHERE $key LIKE '%$value%'";
                    $i++;
                } else {
                    $where .= " AND $key LIKE '%$value%'";
                }
            }
        }
$where = htmlspecialchars($where);
        $result = $this->conn->query($sql . $where)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}