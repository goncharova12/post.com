<?php
require_once "CRUD.php";
require_once "registered_mail.php";

$mail = new RegisteredMail();

//var_dump($deliveryMail);

    if (!empty($_POST['action'])) {
        //    var_dump($_POST);
        $mail->numberId = $_POST['number_id'];
        $mail->statusMail = "4";
        $result = $mail->processingMail();
        echo $result;
        $mail->statusMail = ['status_mail'=>"3"];
        $deliveryMail = $mail->getDesiredMail($mail->statusMail);
    } else {
        $mail->statusMail = ['status_mail'=>"3"];
        $deliveryMail = $mail->getDesiredMail($mail->statusMail);
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вручение РПО</title>
</head>
<body>
<h1>Вручение</h1>
<hr>
<form method="post" action="delivery_mail.php">
    <input type="submit" name="action" value="Вручить"> <a href="postal_services.html">Назад</a>
    <table>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Тип отправления</th>
            <th>Имя получателя</th>
            <th>Адрес</th>
        </tr>
        <?php foreach ($deliveryMail as $value): ?>
        <tr>
            <td><input type="radio" name="number_id" value="<?= $value['number_id']?>"></td>
            <td><?= $value['number_id']?></td>
            <td><?= $value['name_type']?></td>
            <td><?= $value['name_addressee']?></td>
            <td><?= $value['address']?></td>
        </tr>
        <?php endforeach;?>
    </table>
</form>
</body>
</html>
