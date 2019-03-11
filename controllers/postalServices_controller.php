<?php

class PostalServicesController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
    }

    public function actionIndex()
    {
        $this->view->page = "postalServices/postal_services.html";
        $this->view->render('');
    }

    public function actionProcessingMail()
    {
        $numberId = new NumberId();
        $mail = new RegisteredMail();
        $number = $numberId->findingAFreeID();
        $type = $mail->getTitleTypeMail2("*");
        $result = compact('number', 'type');
        $this->view->page = "postalServices/processing_mail/form_processing_mail.php";
        $this->view->render($result);
    }

    public function actionVerificationPage()
    {
        $numberId = new NumberId();
        $mail = new RegisteredMail();
        $mail->typeMail = $_POST['type_mail'];
        $type = $mail->getTitleTypeMail();
        $mail->typeMail = $_POST['type_mail'];
        $types = $mail->getTitleTypeMail2('*');
        $array = $_POST;
        $result = compact('type', 'array', 'types');
        $this->view->page = "postalServices/processing_mail/verification_page.php";
        $this->view->render($result);
    }

    public function actionSavingMail()
    {
        $numberId = new NumberId();
        $mail = new RegisteredMail();
        $sender = new Sender();
        $addressee = new Addressee();

        $mail->numberId = trim(urldecode(htmlspecialchars($_POST['number_id'])));
        $mail->typeMail = trim(urldecode(htmlspecialchars($_POST['type_mail'])));
        $sender->nameSender = trim(urldecode(htmlspecialchars($_POST['name_sender'])));
        $sender->addressSender = trim(urldecode(htmlspecialchars($_POST['address_sender'])));
        $addressee->nameAddressee = trim(urldecode(htmlspecialchars($_POST['name_addressee'])));
        $addressee->addressAddressee = trim(urldecode(htmlspecialchars($_POST['address_addressee'])));
        $mail->statusMail = trim(urldecode(htmlspecialchars($_POST['status_mail'])));
        $mail->createMail($numberId, $addressee, $sender);
        $result = ['text' => 'Отправление сохранено'];
        $this->view->page = "postalServices/processing_mail/saving_mail.php";
        $this->view->render($result);
    }

    public function actionOutgoingMail()
    {
        $mail = new RegisteredMail();
        $mail->statusMail = "1";
        $outgoingMail = $mail->getMailByStatus();
        $this->view->page = "postalServices/outgoingMail/outgoing_mail.php";
        $this->view->render($outgoingMail);
    }
}