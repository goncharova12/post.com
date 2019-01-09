<?php
require_once "CRUD.php";
require_once "registered_mail.php";
$mail = new RegisteredMail();
//var_dump($_POST);
?>
<h1>РЕДАКТИРОВАНИЕ ОТПРАВЛЕНИЯ</h1>
<h3>Проверьте, пожалуйста, данные перед сохранением в систему.</h3>
<p>Номер ID: <?= $_POST['number_id'] ?></p>
<p>Тип отправления: <?php
    $mail->typeMail = $_POST['type_mail'];
    $type = $mail->getTitleTypeMail();
    echo $type ?></p>
<p>Отправитель: <?= $_POST['name_sender'] ?></p>
<p>Адрес отправителя: <?= $_POST['address_sender'] ?></p>
<p>Получатель: <?= $_POST['name_addressee'] ?></p>
<p>Адрес Получателя: <?= $_POST['address_addressee'] ?></p>
<form method="post" action="update_mail.php">
    <input type="hidden" name="number_id" value="<?= $_POST['number_id'] ?>">
    <input type="hidden" name="type_mail" value="<?= $_POST['type_mail'] ?>">
    <input type="hidden" name="name_sender" value="<?= $_POST['name_sender'] ?>">
    <input type="hidden" name="old_name_sender" value="<?=$_POST['old_name_sender']?>">
    <input type="hidden" name="address_sender" value="<?= $_POST['address_sender'] ?>">
    <input type="hidden" name="old_address_sender" value="<?=$_POST['old_address_sender']?>">
    <input type="hidden" name="name_addressee" value="<?= $_POST['name_addressee']?> ">
    <input type="hidden" name="old_name_addressee" value="<?= $_POST['old_name_addressee']?>">
    <input type="hidden" name="address_addressee" value="<?= $_POST['address_addressee'] ?>">
    <input type="hidden" name="old_address_addressee" value="<?=$_POST['old_address_addressee']?>">
    <input type="hidden" name="status_mail" value="1"><br>
    <input type="submit" name="update" value="Далее">
</form>