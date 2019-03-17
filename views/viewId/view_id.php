<h1>Просмотр ID</h1>
<hr>
<form method="post" action="view_id.php">
    <a href="index.php?r=main/index">Назад</a>
    <hr>
    <select name="status">
        <option disabled selected>Выберите статус</option>
        <option value="1">
            Не используется
        </option>
        <option value="2">
            Используется
        </option>
    </select>
    <input type="submit" formaction="index.php?r=id/index" value="Найти">

    <hr>
    <input type="submit" name="delete" formaction="index.php?r=id/deleteId" value="Удалить выбранный ID"> <a href="index.php?r=id/createId">Создать новые ID</a>
    <hr>
    <table>
        <tr>
            <th></th>
            <th>№</th>
            <th>ID</th>
            <th>Статус</th>
        </tr>
        <?php
        foreach ($ID as $item) {
            if ($item['status_id'] == 1) {
                $statusID = "Не используется";
            } else {
                $statusID = "Используется";
            }
            echo "
    <tr>
        <td><input type='checkbox' name='number[]' value='{$item['barcode']}'></td>
        <td>$i</td><td>{$item['barcode']}</td>
        <td>$statusID</td>
    </tr>";
            $i++;
        }
        if (isset($text)) {
            echo $text;
        }
        ?>
    </table>
</form>
