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
<form method="post" action="edit_form.php">

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
