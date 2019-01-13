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


$array = $_GET;
$mailInfo = $mail->getDesiredMail($array);
//var_dump($mailInfo);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование РПО</title>
</head>
<body>
<?php if(!isset($_POST['action'])):?>
<form method="post" action="form_update_mail.php">
    <?php
    $number = $mailInfo['0']['number_id'];
    echo $number . "<input type='hidden' name='number_id' value='$number'><br>";
    ?>
    <select name="type_mail">
        <?php
        $mail->typeMail = "*";
        $type = $mail->getTitleTypeMail2();
        //        var_dump($type);
        foreach ($type as $value) {
            if ($value['name_type'] == $mailInfo['0']['name_type']) {
                echo "<option value='{$value['number_type']}' selected>{$value['name_type']}</option>";
            } else {
                echo "<option value='{$value['number_type']}'>{$value['name_type']}</option>";
            }
        }
        ?>
    </select><br>
    <input type="text" name="name_sender" value="<?=$mailInfo['0']['name_sender']?>">
    <input type="hidden" name="old_name_sender" value="<?=$mailInfo['0']['name_sender']?>"><br>
    <input type="text" name="address_sender" value="<?=$mailInfo['0']['address_sender']?>">
    <input type="hidden" name="old_address_sender" value="<?=$mailInfo['0']['address_sender']?>"><br>
    <input type="text" name="name_addressee" value="<?=$mailInfo['0']['name_addressee']?>">
    <input type="hidden" name="old_name_addressee" value="<?=$mailInfo['0']['name_addressee']?>"><br>
    <input type="text" name="address_addressee" value="<?=$mailInfo['0']['address']?>">
    <input type="hidden" name="old_address_addressee" value="<?=$mailInfo['0']['address']?>"><br>
    <input type="submit" name="action" value="далее"><br>
</form>

<?php elseif (!empty($_POST['number_id']) && !empty($_POST['type_mail']) && !empty($_POST['name_sender']) && !empty($_POST['address_sender']) && !empty($_POST['name_addressee']) && !empty($_POST['address_addressee'])):?>
<h1>РЕДАКТИРОВАНИЕ ОТПРАВЛЕНИЯ</h1>
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
<form method="post" action="update_mail.php">
    <input type="hidden" name="number_id" value="<?= $_POST['number_id'] ?>">
    <input type="hidden" name="type_mail" value="<?= $_POST['type_mail'] ?>">
    <input type="hidden" name="name_sender" value="<?= $_POST['name_sender'] ?>">
    <input type="hidden" name="old_name_sender" value="<?=$_POST['old_name_sender']?>">
    <input type="hidden" name="address_sender" value="<?= $_POST['address_sender'] ?>">
    <input type="hidden" name="old_address_sender" value="<?=$_POST['old_address_sender']?>">
    <input type="hidden" name="name_addressee" value="<?= $_POST['name_addressee']?> ">
    <input type="hidden" name="old_name_addressee" value="<?= $_POST['old_name_addressee']?>">
    <input type="hidden" name="address_addressee" value="<?= $_POST['address_addressee'] ?>">
    <input type="hidden" name="old_address_addressee" value="<?=$_POST['old_address_addressee']?>">
    <input type="hidden" name="status_mail" value="1"><br>
    <input type="submit" name="update" value="Далее">
</form>
<?php else: ?>
<form method="post" action="form_update_mail.php">
    <?php
    $number = $mailInfo['0']['number_id'];
    echo $number . "<input type='hidden' name='number_id' value='$number'><br>";
    ?>
    <select name="type_mail">
        <?php
        $mail->typeMail = "*";
        $type = $mail->getTitleTypeMail2();
        //        var_dump($type);
        foreach ($type as $value) {
            if ($value['name_type'] == $mailInfo['0']['name_type']) {
                echo "<option value='{$value['number_type']}' selected>{$value['name_type']}</option>";
            } else {
                echo "<option value='{$value['number_type']}'>{$value['name_type']}</option>";
            }
        }
        ?>
    </select><br>
    <input type="text" name="name_sender" value="<?=$mailInfo['0']['name_sender']?>">
    <input type="hidden" name="old_name_sender" value="<?=$mailInfo['0']['name_sender']?>"><br>
    <input type="text" name="address_sender" value="<?=$mailInfo['0']['address_sender']?>">
    <input type="hidden" name="old_address_sender" value="<?=$mailInfo['0']['address_sender']?>"><br>
    <input type="text" name="name_addressee" value="<?=$mailInfo['0']['name_addressee']?>">
    <input type="hidden" name="old_name_addressee" value="<?=$mailInfo['0']['name_addressee']?>"><br>
    <input type="text" name="address_addressee" value="<?=$mailInfo['0']['address']?>">
    <input type="hidden" name="old_address_addressee" value="<?=$mailInfo['0']['address']?>"><br>
    <input type="submit" name="action" value="далее"><br>
</form>
<?php endif;?>
</body>
</html>