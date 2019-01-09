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
?>
<h1>Отслеживание</h1>
<form action="tracking_mails.php" method="post">
    <a href="index.php">Назад</a><hr>
    <input type="text" name="number_id" placeholder="Введите трек-номер">
    <input type="submit" value="Найти">
</form>

<hr>

<?php

if (!empty($_POST)) {
    $mail->numberId = $_POST['number_id'];
    $search = $mail->getOneMailByNumberID();
    $searchMail = $mail->getMailInfo($search, $sender, $addressee);
    $tracking = "";
//    var_dump($searchMail);
    if ($searchMail['1']['statusMail'] != "Удалено") {
        $searchStatus = $mail->getStatusMail();
        $i = 1;
        foreach ($searchStatus as $value) {
            $tracking .= "<tr>
                <td>$i</td>
                <td>{$value['status_value']}</td>
                <td>{$value['time_acceptance']}</td>
            </tr>";
            $i++;
        }
        $table =<<<_TABLE
<table>
    <tr>
        <th></th>
        <th>ШИ</th>
        <td>{$mail->numberId}</td>
    </tr>
    <tr>
        <th></th>
        <th>Получатель</th>
        <td>{$searchMail['1']['addressee']}</td>
    </tr>
    <tr>
        <th></th>
        <th>Отправитель</th>
        <td>{$searchMail['1']['sender']}</td>
    </tr>
    <tr>
        <th>№</th>
        <th>Статус</th>
        <th>Время регистрации</th>
    </tr>
    $tracking
</table>
_TABLE;
        echo $table;
    }
}
?>