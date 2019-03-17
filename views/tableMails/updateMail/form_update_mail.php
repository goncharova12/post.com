
<form method="post">
    <?php
    echo $number . "<input type='hidden' name='number_id' value='$number'><br>";
    ?>
    <select name="type_mail">
        <?php
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
    <input type="submit" formaction="index.php?r=tableMails/checkingEditing" value="далее"><br>
</form>

