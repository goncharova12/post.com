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
$mail->numberId = $_POST['number_id'];
$searchStatus = $mail->getStatusMail();
$i = 1;
foreach ($searchStatus as $value) {
    $tracking .= "<tr>
                <th><input type='radio' name='number_id' value='{$value['status_value']}'></th>
                <th>$i</th>
                <th>{$value['status_value']}</th>
                <th>{$value['time_acceptance']}</th>
            </tr>";
    $i++;
}
?>
</table>
