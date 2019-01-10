<?php
require_once "CRUD.php";
require_once "registered_mail.php";

$mail = new RegisteredMail();

if (!empty($_POST['action'])) {

    $mail->numberId = $_POST['mails'];
    $mail->statusMail = 2;
    $result = $mail->processingMail();
    echo $result;
    $mail->statusMail = "1";
    $outgoingMail = $mail->getMailByStatus();
} else {
    $mail->statusMail = "1";
    $outgoingMail = $mail->getMailByStatus();
//var_dump($outgoingMail);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Исходящая почта</title>
</head>
<body>
<h1>Обработка исходящей почты</h1>
<hr>
<form method="post" action="outgoing_mail.php">
    <select name="mails">
        <option selected disabled>Выберите отправления для отправки</option>
        <?php foreach ($outgoingMail as $value): ?>
            <option value="<?= $value['number_id'] ?>"><?= $value['number_id'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" name="action" value="Обработать">
</form>
<a href="postal_services.html">Назад</a>
</body>
</html>
