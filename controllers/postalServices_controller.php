<?php

class PostalServicesController extends Controller
{


    /**
     * метод контроллера, с помощью которого загружается главная страница почтовых услуг
     */
    public function actionIndex()
    {
        //Указываем путь к Вьюшке
        $this->view->page = "postalServices/postal_services.html";
        //Вызываем метод для отрисовки страницы
        $this->view->render('');
    }

    /**
     * метод, загружающий страницу приема РПО
     */
    public function actionProcessingMail()
    {
        //создаются объекты классов NumberId и RegisteredMail
        $numberId = new NumberId();
        $mail = new RegisteredMail();

        //происходит поиск свободных идентификаторов
        $number = $numberId->findingAFreeID();
        //получение названий всех типов отправлений
        $type = $mail->getTitleTypeMail2("*");

        //создается ассоциативный массив
        $result = compact('number', 'type');
        $this->view->page = "postalServices/processing_mail/form_processing_mail.php";
        $this->view->render($result);
    }

    /**
     * метод, отвечающий за отображение страницы проверки приема РПО
     */
    public function actionVerificationPage()
    {
        //создаются объекты классов NumberId и RegisteredMail
        $numberId = new NumberId();
        $mail = new RegisteredMail();

        //получение названия конкретного типа отправления
        if (!empty($_POST['type_mail'])) {
            $type = $mail->getTitleTypeMail($_POST['type_mail']);
        }

        //получение названий всез типов отправлений на тот случай, если не все данные получены
        $types = $mail->getTitleTypeMail2('*');
        $array = $_POST;
        $result = compact('type', 'array', 'types');
        $this->view->page = "postalServices/processing_mail/verification_page.php";
        $this->view->render($result);
    }

    /**
     * метод, отвечающий за отображение страницы, где происходит сохранение принятого отправления
     */
    public function actionSavingMail()
    {
        //создаются объекты классов
        $numberId = new NumberId();
        $mail = new RegisteredMail();
        $sender = new Sender();
        $addressee = new Addressee();

        //проверяются полученные данные и присваиваются свойствам объектов
        $mail->numberId = trim(urldecode(htmlspecialchars($_POST['number_id'])));
        $mail->typeMail = trim(urldecode(htmlspecialchars($_POST['type_mail'])));
        $sender->nameSender = trim(urldecode(htmlspecialchars($_POST['name_sender'])));
        $sender->addressSender = trim(urldecode(htmlspecialchars($_POST['address_sender'])));
        $addressee->nameAddressee = trim(urldecode(htmlspecialchars($_POST['name_addressee'])));
        $addressee->addressAddressee = trim(urldecode(htmlspecialchars($_POST['address_addressee'])));
        $mail->statusMail = trim(urldecode(htmlspecialchars($_POST['status_mail'])));

        //происходит сохранение отправления
        $mail->createMail($numberId, $addressee, $sender);
        $result = ['text' => 'Отправление сохранено'];
        $this->view->page = "postalServices/processing_mail/saving_mail.php";
        $this->view->render($result);
    }

    /**
     * метод, отвечающий за отображения страницы исходящей почты
     */
    public function actionOutgoingMail()
    {
        $mail = new RegisteredMail();
        if (!empty($_POST['action'])) {
            if (!empty($_POST['mails'])) {
                $mail->numberId = $_POST['mails'];
                $mail->statusMail = 2;
                $text = $mail->processingMail();
                $mail->statusMail = "1";
                $outgoingMail = $mail->getMailByStatus();
            } else {
                $text = "Выберите отправление для обработки";
                $mail->statusMail = "1";
                $outgoingMail = $mail->getMailByStatus();
            }
        } else {
            $mail->statusMail = "1";
            $outgoingMail = $mail->getMailByStatus();
            $text = '';
        }
        $result = compact('outgoingMail', 'text');
        $this->view->page = "postalServices/outgoing_mail/outgoing_mail.php";
        $this->view->render($result);
    }

    /**
     * метод, отвечающий за отображение страницы входящей почты
     */
    public function actionIncomingMail() {
        $mail = new RegisteredMail();

        if (!empty($_POST['action'])) {
            if (!empty($_POST['mails'])) {
                $mail->numberId = $_POST['mails'];
                $mail->statusMail = "3";
                $text = $mail->processingMail();
                $mail->statusMail = "2";
                $incomingMail = $mail->getMailByStatus();
            } else {
                $text = "Выберите отправление для обработки";
                $mail->statusMail = "2";
                $incomingMail = $mail->getMailByStatus();
            }
        } else {
            $mail->statusMail = "2";
            $incomingMail = $mail->getMailByStatus();
            $text = "";
        }
        $result = compact('incomingMail', 'text');
        $this->view->page = "postalServices/incoming_mail/incoming_mail.php";
        $this->view->render($result);
    }

    /**
     * метод, отвечающий за отображение страницы вручения РПО
     */
    public function actionDeliveryMail() {
        $mail = new RegisteredMail();
        $type = $mail->getTitleTypeMail2('*');
        //        var_dump($type);
        if (!empty($_POST['action'])) {
            if (!empty($_POST['number_id'])) {
                //    var_dump($_POST);
                $mail->numberId = $_POST['number_id'];
                $mail->statusMail = "4";
                $text = $mail->processingMail();
                $mail->statusMail = ['status_mail' => "3"];
                $deliveryMail = $mail->getDesiredMail($mail->statusMail);
            }
        } elseif (empty($_POST)) {
            $text = "Выберите отправление для вручения";
            $mail->statusMail = ['status_mail' => "3"];
            $deliveryMail = $mail->getDesiredMail($mail->statusMail);
        } else {
            $search = $_POST;
            $deliveryMail = $mail->getDesiredMail($search);
            $text = "";
        }
        $result = compact('deliveryMail', 'text', 'type');
        $this->view->page = "postalServices/delivery_mail/delivery_mail.php";
        $this->view->render($result);
    }
}