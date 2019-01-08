<?php
require_once "CRUD.php";
require_once "registered_mail.php";
$mail = new RegisteredMail();
//var_dump($_POST);
?>
<h1>ПРИЁМ ОТПРАВЛЕНИЯ</h1>
<h3>Проверьте, пожалуйста, данные перед сохранением в систему.</h3>
<p>Номер ID: <?= $_POST['number_id']?></p>
<p>Тип отправления: <?php
    $mail->typeMail = $_POST['type_mail'];
    $type = $mail->getTitleTypeMail();
    echo $type?></p>
<p>Отправитель: <?= $_POST['name_sender']?></p>
<p>Адрес отправителя: <?= $_POST['address_sender']?></p>
<p>Получатель: <?= $_POST['name_addressee']?></p>
<p>Адрес Получателя: <?= $_POST['address_addressee']?></p>
<form method="post" action="saving_mail.php">
<input type="submit" name="save" value="Далее">
</form>