<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отсдеживание РПО</title>
</head>
<body>
<h1>Отслеживание</h1>
<form action="tracking_mails.php" method="post">
    <a href="index.php?r=main/index">Назад</a>
    <hr>
    <input type="number" name="number_id" placeholder="Введите трек-номер">
    <input type="submit" formaction="index.php?r=trackingMails/getInfo" value="Найти">
</form>

<hr>

<?php if(isset($text)) {
    echo $text;
}?>
</body>
</html>
