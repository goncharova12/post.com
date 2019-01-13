<?php
require_once "CRUD.php";
require_once "number_id.php";
require_once "registered_mail.php";

$numberId = new NumberId();
$mail = new RegisteredMail();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Прием РПО</title>
</head>
<body>
<?php if (!isset($_POST['action'])): ?>
    <form method="post" action="">
        <?php
        $number = $numberId->findingAFreeID();
        echo $number . "<input type='hidden' name='number_id' value='$number'><br>";
        ?>
        <input type="hidden" value="">
        <select name="type_mail">
            <option disabled selected>Выберите тип отправления</option>
            <?php
            $mail->typeMail = "*";
            $type = $mail->getTitleTypeMail2();
            //        var_dump($type);
            foreach ($type as $value) {
                echo "<option value='{$value['number_type']}'>{$value['name_type']}</option>";
            }
            ?>
        </select><br>
        <input type="text" name="name_sender" placeholder="Отправитель"><br>
        <input type="text" name="address_sender" placeholder="Адрес отправителя"><br>
        <input type="text" name="name_addressee" placeholder="Адресат"><br>
        <input type="text" name="address_addressee" placeholder="Адрес адресата"><br>
        <input type="submit" name="action" value="далее"><br>
    </form>
<?php elseif (!empty($_POST['type_mail']) && !empty($_POST['name_sender']) && !empty($_POST['address_sender']) && !empty($_POST['name_addressee']) && !empty($_POST['address_addressee'])): ?>
    <h3>Проверьте, пожалуйста, данные перед сохранением в систему.</h3>
    <p>Номер ID: <?= $_POST['number_id'] ?></p>
    <p>Тип отправления: <?php
        $mail->typeMail = $_POST['type_mail'];
        $type = $mail->getTitleTypeMail();
        echo $type ?></p>
    <p>Отправитель: <?= $_POST['name_sender'] ?></p>
    <p>Адрес отправителя: <?= $_POST['address_sender'] ?></p>
    <p>Получатель: <?= $_POST['name_addressee'] ?></p>
    <p>Адрес Получателя: <?= $_POST['address_addressee'] ?></p>
    <form method="post" action="saving_mail.php">
        <input type="hidden" name="number_id" value="<?= $_POST['number_id'] ?>">
        <input type="hidden" name="type_mail" value="<?= $_POST['type_mail'] ?>">
        <input type="hidden" name="name_sender" value="<?= $_POST['name_sender'] ?>">
        <input type="hidden" name="address_sender" value="<?= $_POST['address_sender'] ?>">
        <input type="hidden" name="name_addressee" value="<?= $_POST['name_addressee'] ?> ">
        <input type="hidden" name="address_addressee" value="<?= $_POST['address_addressee'] ?>">
        <input type="hidden" name="status_mail" value="1"><br>
        <input type="submit" name="save" value="Далее">
    </form>
<?php else: ?>
    <p>Введите все данные</p>
    <form method="post" action="">
        <?php
        $number = $numberId->findingAFreeID();
        echo $number . "<input type='hidden' name='number_id' value='$number'><br>";
        ?>
        <input type="hidden" value="">
        <select name="type_mail">
            <option disabled selected>Выберите тип отправления</option>
            <?php
            $mail->typeMail = "*";
            $type = $mail->getTitleTypeMail2();
            //        var_dump($type);
            foreach ($type as $value) {
                echo "<option value='{$value['number_type']}'>{$value['name_type']}</option>";
            }
            ?>
        </select><br>
        <input type="text" name="name_sender" placeholder="Отправитель"><br>
        <input type="text" name="address_sender" placeholder="Адрес отправителя"><br>
        <input type="text" name="name_addressee" placeholder="Адресат"><br>
        <input type="text" name="address_addressee" placeholder="Адрес адресата"><br>
        <input type="submit" name="action" value="далее"><br>
    </form>
<?php endif; ?>
</body>
</html>