<form method="post">
    <a href="index.php?r=main/index">В главное меню</a>
    <hr>
    <input type="number" name="number_id" placeholder="ID">
    <select name="type_mail">
        <option disabled selected>Выберите тип отправления</option>
        <?php
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
        foreach ($status as $value) {
            echo "<option value='{$value['number_status']}'>{$value['status_value']}</option>";
        }
        ?>
    </select>
    <input type="text" name="date_time" placeholder="Дата и время"><br>
    <input type="submit" formaction="index.php?r=tableMails/index" value="поиск">
    <input type="reset" value="очистить">
    <br>
</form>

<hr>

<form method="post">
    <input type="submit"  formaction="index.php?r=tableMails/statusMails" value="Показать статусы отправления">
    <input type='submit'  formaction='index.php?r=tableMails/updateMails' value='Редактировать'>
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
        foreach ($mails as $value) {
            echo "<tr>
        <td><input type='radio' name='number_id' value='{$value['number_id']}'></td>
        <td>{$value['number_id']}</td>
        <td>{$value['name_type']}</td>
        <td>{$value['name_sender']}</td>
        <td>{$value['name_addressee']}</td>
        <td>{$value['status_value']}</td>
        <td>{$value['date_time']}</td>
    </tr>";
        }
        ?>
    </table>
</form>
