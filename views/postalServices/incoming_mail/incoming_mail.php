<?php
require_once "CRUD.php";
require_once "registered_mail.php";

$mail = new RegisteredMail();

if (!empty($_POST['action'])) {
    if (!empty($_POST['mails'])) {
        //    var_dump($_POST);
        $mail->numberId = $_POST['mails'];
        $mail->statusMail = "3";
        $result = $mail->processingMail();
        echo $result;
        $mail->statusMail = "2";
        $outgoingMail = $mail->getMailByStatus();
    } else {
        echo "Выберите отправление для обработки";
        $mail->statusMail = "2";
        $outgoingMail = $mail->getMailByStatus();
    }
} else {
    $mail->statusMail = "2";
    $outgoingMail = $mail->getMailByStatus();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Входящая почта</title>
</head>
<body>
<h1>Обработка входящей почты</h1>
<hr>
<form method="post" action="incoming_mail.php">
    <select name="mails">
        <option selected disabled>Выберите отправления для отправки</option>
        <?php foreach ($outgoingMail as $value): ?>
            <option value="<?= $value['number_id'] ?>"><?= $value['number_id'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" name="action" value="Обработать">
</form>
<a href="../postal_services.html">Назад</a>
</body>
</html>
