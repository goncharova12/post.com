<?php
require_once "CRUD.php";
require_once "registered_mail.php";
$mail = new RegisteredMail();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Журнал РПО</title>
</head>
<body>
<form method="post" action="table_mails.php">
    <a href="index.php">В главное меню</a>
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
    <input type="text" name="name_sender" placeholder="Имя отправителя">

    <input type="text" name="name_addressee" placeholder="Имя адресата">
    <select name="status_mail">
        <option disabled selected>Выберите значение статуса</option>
        <?php
        $mail->statusMail = "*";
        $status = $mail->getTitleStatusMail();
        foreach ($status as $value) {
            echo "<option value='{$value['number_status']}'>{$value['status_value']}</option>";
        }
        ?>
    </select>
    <input type="date" name="date_time" placeholder="Дата и время"><br>
    <input type="submit" value="поиск">
    <input type="reset" value="очистить">
    <br>
</form>

<hr>

<form method="post" action="table_status.php">
    <input type="submit" name="action" value="Показать статусы отправления">
    <table>
        <tr>
            <th></th>
            <th>ID</th>
            <th>ТИП</th>
            <th>ОТПРАВИТЕЛЬ</th>
            <th>АДРЕСАТ</th>
            <th>СТАТУС</th>
            <th>ДАТА ПРИЁМА</th>
            <th>ОПЕРАЦИЯ</th>
        </tr>
        <?php
        $search = $_POST;
        $mails = $mail->getDesiredMail($search);
        foreach ($mails as $value) {
            echo "<tr>
        <td><input type='radio' name='number_id' value='{$value['number_id']}'></td>
        <td>{$value['number_id']}</td>
        <td>{$value['name_type']}</td>
        <td>{$value['name_sender']}</td>
        <td>{$value['name_addressee']}</td>
        <td>{$value['status_value']}</td>
        <td>{$value['date_time']}</td>
        <td><a href='form_update_mail.php?number_id={$value['number_id']}'>Редактировать</a></td>
    </tr>";
        }
        ?>
    </table>
</form>
</body>
</html>
