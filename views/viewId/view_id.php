<?php
require_once "CRUD.php";
require_once "number_id.php";
require_once "function.php";
$numberId = new NumberId();

if (!empty($_POST['delete'])) {
    if (!empty($_POST['number'])) {
//        var_dump($_POST);
        $deleteId = $_POST['number'];
//        var_dump($deleteId);
        deleteID($deleteId, $numberId);
    } else {
        echo "Выберите ID, который хотите удалить";
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Идентификаторы</title>
</head>
<body>
<h1>Просмотр ID</h1>
<hr>
<form method="post" action="view_id.php">
    <a href="../../index.php">Назад</a>
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
    <input type="submit" value="Найти">

    <hr>
    <input type="submit" name="delete" value="Удалить выбранный ID"> <a href="create_id.php">Создать новые ID</a>
    <hr>
    <table>
        <tr>
            <th></th>
            <th>№</th>
            <th>ID</th>
            <th>Статус</th>
        </tr>
        "
        <?php
        //    var_dump($_POST);//exit();
        if (!empty($_POST['status'])) {
            $numberId->statusId = $_POST['status'];
            $ID = $numberId->getIDByStatus();
//        var_dump($ID);
        } else {
            $ID = $numberId->getId();
//        var_dump($ID);
        }

        $i = 1;

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
        ?>
    </table>
</form>
</body>
</html>