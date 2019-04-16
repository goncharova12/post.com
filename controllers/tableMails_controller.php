<?php

class TableMailsController extends Controller
{
    /**
     * открывает главную страницу журнала РПО
     */
    public function actionIndex()
    {
        $mail = new RegisteredMail();
        $type = $mail->getTitleTypeMail2('*');
        $status = $mail->getTitleStatusMail('*');
        $search = $_POST;
        $mails = $mail->getDesiredMail($search);
        $result = compact('type', 'status', 'mails');
        $this->view->page = "tableMails/table_mails.php";
        $this->view->render($result);

    }

    /**
     * открывает страницу для работы со статусами отправления
     */
    public function actionStatusMails()
    {
        $numberId = new NumberId();
        $mail = new RegisteredMail();
        $sender = new Sender();
        $addressee = new Addressee();
        if (!empty($_POST['number_id'])) {
            $mail->numberId = $_POST['number_id'];
            $searchStatus = $mail->getStatusMail();
            $i = 1;
            $text = "";
            if (!empty($_POST['delete'])) {
                if (!empty($_POST['number_status'])) {
                    $mail->numberId = $_POST['number_id'];
                    $mail->statusMail = $_POST['number_status'];
                    $mail->deleteStatusMail();
                    $text = "<p>Статус успешно удален</p>";
                    $searchStatus = $mail->getStatusMail();
                } else {
                    $text = "Вы не выбрали статус, который хотите удалить";
                }
            }
        } else {
            $text = "Вы не выбрали отправление. Вернитесь назад, чтобы выбрать РПО, статусы которого вы хотите просмотреть.";
        }
        $result = compact('searchStatus', 'i', 'text');
        $this->view->page = "tableMails/statusMails/table_status.php";
        $this->view->render($result);
    }

    /**
     * открывает страницу редактирования отправления
     */
    public function actionUpdateMails(){
        $numberId = new NumberId();
        $mail = new RegisteredMail();
        $sender = new Sender();
        $addressee = new Addressee();

//        var_dump($_POST);
        $array = $_POST;
        $mailInfo = $mail->getDesiredMail($array);
        $number = $mailInfo['0']['number_id'];
        $type = $mail->getTitleTypeMail2('*');
//        var_dump($mailInfo);
        $result = compact('mailInfo', 'number', 'type');
        $this->view->page = "tableMails/updateMail/form_update_mail.php";
        $this->view->render($result);
    }

    /**
     * открывает страницу для проверки редактируемых данных
     */
    public function actionCheckingEditing () {
        $mail = new RegisteredMail();
        $type = $mail->getTitleTypeMail($_POST['type_mail']);

        $result = compact('mailInfo', 'type');
        $this->view->page = "tableMails/updateMail/checking_editing.php";
        $this->view->render($result);
    }

    /**
     * сохраняет редактируемые данные, открывает страницу, где подверждается успешное редактирование
     */
    public function actionSavingEdits () {
        $numberId = new NumberId();
        $mail = new RegisteredMail();
        $sender = new Sender();
        $addressee = new Addressee();


        if(!empty($_POST['update'])){
//    var_dump($_POST);
            $mail->numberId = $_POST['number_id'];
            $mail->typeMail = $_POST['type_mail'];
            $sender->nameSender = $_POST['name_sender'];
            $sender->addressSender = $_POST['address_sender'];
            $addressee->nameAddressee = $_POST['name_addressee'];
            $addressee->addressAddressee = $_POST['address_addressee'];
            $mail->statusMail = $_POST['status_mail'];
            $mail->updateTypeMail();
            $addressee->updateNameAndAddress($_POST['old_name_addressee'], $_POST['old_address_addressee']);
            $sender->updateNameAndAddressSender($_POST['old_name_sender'], $_POST['old_address_sender']);
            $text =  "Успешно отредактировано";
        }
        $result = compact('text');
        $this->view->page = "tableMails/updateMail/saving_edits.php";
        $this->view->render($result);
    }
}