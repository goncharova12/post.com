<?php
require_once "CRUD.php";
require_once "registered_mail.php";

$mail = new RegisteredMail();

//var_dump($deliveryMail);

if (!empty($_POST['action'])) {
    if (!empty($_POST['number_id'])) {
        //    var_dump($_POST);
        $mail->numberId = $_POST['number_id'];
        $mail->statusMail = "4";
        $result = $mail->processingMail();
        echo $result;
        $mail->statusMail = ['status_mail' => "3"];
        $deliveryMail = $mail->getDesiredMail($mail->statusMail);
    }
} elseif (empty($_POST)) {
    echo "Выберите отправление для вручения";
    $mail->statusMail = ['status_mail' => "3"];
    $deliveryMail = $mail->getDesiredMail($mail->statusMail);
} else {
    $search = $_POST;
//    var_dump($search);
    $deliveryMail = $mail->getDesiredMail($search);
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
    <hr>
    <input type="number" name="number_id" placeholder="ID">
    <select name="type_mail">
        <option disabled selected>Выберите тип отправления</option>
        <?php
        $mail->typeMail = "*";
        $type = $mail->getTitleTypeMail2();
        //        var_dump($type);
        foreach ($type as $value) {
            echo "<option value='{$value['number_type']}'>{$value['name_type']}</option>";
        }
        ?>
    </select>
    <input type="text" name="name_addressee" placeholder="Имя получателя">
    <input type="hidden" name="status_mail" value="3">
    <input type="submit" value="поиск">
    <input type="reset" value="очистить">
    <br>
</form>
<hr>
<form method="post" action="delivery_mail.php">
    <input type="submit" name="action" value="Вручить"> <a href="../postal_services.html">Назад</a>
    <table>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Тип отправления</th>
            <th>Имя получателя</th>
            <th>Адрес</th>
            <th>Дата поступления</th>
        </tr>
        <?php foreach ($deliveryMail as $value): ?>
            <tr>
                <td><input type="radio" name="number_id" value="<?= $value['number_id'] ?>"></td>
                <td><?= $value['number_id'] ?></td>
                <td><?= $value['name_type'] ?></td>
                <td><?= $value['name_addressee'] ?></td>
                <td><?= $value['address'] ?></td>
                <td><?= $value['date_time'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>
</body>
</html>
