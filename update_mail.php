<?php
//var_dump($_POST);
require_once "CRUD.php";
require_once "number_id.php";
require_once "function.php";
require_once "registered_mail.php";
require_once "addressee.php";
require_once "sender.php";


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
    $mail->updateAddresseeMail($addressee);
    $mail->updateToAddresseeMail($addressee);
    $mail->updateSenderMail($sender);
    $mail->updateFromSenderMail($sender);
    echo "Успешно отредактировано";
}
?>
<br>
<a href="index.php">Вернуться назад</a>
