<form method="post" action="/core/route.php">
    <?php
    echo $number . "<input type='hidden' name='number_id' value='$number'><br>";
    ?>
    <input type="hidden" value="">
    <select name="type_mail">
        <option disabled selected>Выберите тип отправления</option>
        <?php
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
    <button type="submit" formaction="index.php?r=postalServices/verificationPage">Далее</button>
</form>
