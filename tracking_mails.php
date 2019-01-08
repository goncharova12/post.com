<h1>Отслеживание</h1>
<form action="index.php" method="post">
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