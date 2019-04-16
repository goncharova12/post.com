<h1>Вручение</h1>
<hr>
<form method="post">
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
    <input type="text" name="name_addressee" placeholder="Имя получателя">
    <input type="hidden" name="status_mail" value="3">
    <input type="submit" formaction="index.php?r=postalServices/deliveryMail" value="поиск">
    <input type="reset" value="очистить">
    <br>
</form>
<hr>
<form method="post">
    <input type="submit" name="action" formaction="index.php?r=postalServices/deliveryMail" value="Вручить"> <a href="index.php?r=postalServices/index">Назад</a>
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
<p><?=$text?></p>
