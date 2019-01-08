<form method="post" action="index.php">
    <input type="text" name="number_id" placeholder="ID">
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
    </select><br>
    <input type="date" name="date_time" placeholder="Дата и время">
    <input type="submit" value="поиск">
    <input type="reset" value="очистить">
    <br>
</form>

<hr>

<form method="post" action="index.php">
    <input type="submit" name="action" value="Операции">
    <input type="submit" name="redaction" value="Редактировать">
    <table>
        <tr>
            <th></th>
            <th>ID</th>
            <th>ТИП</th>
            <th>ОТПРАВИТЕЛЬ</th>
            <th>АДРЕСАТ</th>
            <th>СТАТУС</th>
            <th>ДАТА ПРИЁМА</th>
        </tr>
        <?php
        $search = $_POST;
        $mails = $mail->getDesiredMail($search);
        foreach ($mails as $value) {
            echo "<tr>
        <th><input type='radio' name='number_id' value='{$value['number_id']}'></th>
        <th>{$value['number_id']}</th>
        <th>{$value['name_type']}</th>
        <th>{$value['name_sender']}</th>
        <th>{$value['name_addressee']}</th>
        <th>{$value['status_value']}</th>
        <th>{$value['date_time']}</th>
    </tr>";
        }
        ?>
    </table>
</form>
