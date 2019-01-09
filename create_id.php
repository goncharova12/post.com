<?php
require_once "CRUD.php";
require_once "number_id.php";
require_once "function.php";
$numberId = new NumberId();
?>

<form method="post" action="create_id.php">
    <input type="number" name="number" placeholder="Укажите количество">
    <input type="submit" name="action" value="Создать">
</form>

<?php
if(!empty($_POST)) {
    $countId = $_POST['number'];
    $id = createId($countId, $numberId);
    $createID = "";
//var_dump($id);
    foreach ($id as $value) {
        $createID .= "$value <br>";
    }

    echo "Созданы следующие ID: <br> $createID";
}
?>
<a href="view_id.php">Назад</a>
