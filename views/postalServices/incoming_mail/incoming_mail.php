<h1>Обработка входящей почты</h1>
<hr>
<form method="post">
    <select name="mails">
        <option selected disabled>Выберите отправления для отправки</option>
        <?php foreach ($incomingMail as $value): ?>
            <option value="<?= $value['number_id'] ?>"><?= $value['number_id'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" name="action" formaction="index.php?r=postalServices/incomingMail" value="Обработать">
</form>
<p><?=$text?></p>
<a href="index.php?r=postalServices/index">Назад</a>
