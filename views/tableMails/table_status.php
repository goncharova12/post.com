<?php
require_once "CRUD.php";
require_once "number_id.php";
require_once "function.php";
require_once "registered_mail.php";
require_once "addressee.php";
require_once "sender.php";


$numberId = new NumberId();
$mail = new RegisteredMail();
$sender = new Sender();
$addressee = new Addressee();

if (!empty($_POST['delete'])) {
//    var_dump($_POST);
    if (!empty($_POST['number_status'])) {
        $mail->numberId = $_POST['number_id'];
        $mail->statusMail = $_POST['number_status'];
        $mail->deleteStatusMail();
        echo "<p>Статус успешно удален</p>";
    } else {
        echo "Вы не выбрали статус, который хотите удалить";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Статусы регистрации</title>
</head>
<body>
<h1>Статусы регистрации</h1>
<a href="table_mails.php">Назад</a>
<form method="post" action="table_status.php">
    <input type="submit" name="delete" value="Удалить">
    <hr>
    <table>
        <tr>
            <th></th>
            <th>№</th>
            <th>Статус регистрации</th>
            <th>Время регистрации</th>
        </tr>
        <?php
        if (!empty($_POST['number_id'])) {
            $mail->numberId = $_POST['number_id'];
            $searchStatus = $mail->getStatusMail();
//        var_dump($searchStatus);
            $i = 1;
            $tracking = "";
            foreach ($searchStatus as $value) {
                $tracking .= "<tr>
                
                <td><input type='radio' name='number_id' value='{$value['number_id']}'></td>
                <td>$i <input type='hidden' name='number_status' value='{$value['number_status']}'></td>
                <td>{$value['status_value']}</td>
                <td>{$value['time_acceptance']} <input type='hidden' name='status_id' value='{$value['status_value']}'></td>
            </tr>";
                $i++;
            }
            echo $tracking;
        } else {
            echo "Вы не выбрали отправление. Вернитесь назад и выберите отправление, по которому хотите просмотреть статусы регистрации.";
        }
        ?>
    </table>
</form>
</body>
</html>