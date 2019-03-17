<h1>Статусы регистрации</h1>
<a href="index.php?r=tableMails/index">Назад</a>
<form method="post" action="table_status.php">
    <input type="submit" name="delete" formaction="index.php?r=tableMails/statusMails" value="Удалить">
    <hr>

    <?php if (!empty($_POST['number_id'])):?>
    <table>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th><?=$searchStatus['0']['number_id']?></th>
        </tr>
        <tr>
            <th></th>
            <th>№</th>
            <th>Статус регистрации</th>
            <th>Время регистрации</th>
        </tr>
        <?php foreach ($searchStatus as $value): ?>
            <tr>
                <td><input type='radio' name='number_id' value='<?=$value['number_id']?>'></td>
                <td><?=$i++?>
                    <input type='hidden' name='number_status' value='<?=$value['number_status']?>'></td>
                <td><?=$value['status_value']?></td>
                <td><?=$value['time_acceptance']?>
                    <input type='hidden' name='status_id' value='<?=$value['status_value']?>'>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
        <p><?=$text?></p>
    <?php else:?>
        <p><?=$text?></p>
    <?php endif;?>
</form>
