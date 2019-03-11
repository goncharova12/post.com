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
        $type = $mail->getTitleTypeMail2('*');
        $array = $_POST;
        $result = compact( 'type', 'array', $mail->typeMail);
        $this->view->page = "postalServices/processing_mail/verification_page.php";
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