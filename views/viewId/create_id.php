<form method="post" action="create_id.php">
    <input type="number" name="number" placeholder="Укажите количество">
    <input type="submit" name="action" formaction="index.php?r=id/createId" value="Создать">
</form>

<?php
if (isset($text)) {
    echo $text;
}
?>
<a href="index.php?r=id/index">Назад</a>
