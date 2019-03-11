<?php if (!empty($array['type_mail']) && !empty($array['name_sender']) && !empty($array['address_sender']) && !empty($array['name_addressee']) && !empty($array['address_addressee'])): ?>
<h3>Проверьте, пожалуйста, данные перед сохранением в систему.</h3>
    <p>Номер ID: <?= $array['number_id'] ?></p>
    <p>Тип отправления: <?php
        echo $type ?></p>
    <p>Отправитель: <?= $array['name_sender'] ?></p>
    <p>Адрес отправителя: <?= $array['address_sender'] ?></p>
    <p>Получатель: <?= $array['name_addressee'] ?></p>
    <p>Адрес Получателя: <?= $array['address_addressee'] ?></p>
    <form method="post" action="/core/route.php">
        <input type="hidden" name="number_id" value="<?= $array['number_id'] ?>">
        <input type="hidden" name="type_mail" value="<?= $array['type_mail'] ?>">
        <input type="hidden" name="name_sender" value="<?= $array['name_sender'] ?>">
        <input type="hidden" name="address_sender" value="<?= $array['address_sender'] ?>">
        <input type="hidden" name="name_addressee" value="<?= $array['name_addressee'] ?> ">
        <input type="hidden" name="address_addressee" value="<?= $array['address_addressee'] ?>">
        <input type="hidden" name="status_mail" value="1"><br>
        <input type="submit" name="save" value="Далее">
    </form>
<?php else: ?>
    <p>Введите все данные</p>
    <form method="post" action="">
        <?php
        var_dump($array);
        echo $array['number_id'] . "<input type='hidden' name='number_id' value='{$array['number_id']}'><br>";
        ?>
        <input type="hidden" value="">
        <select name="type_mail">
            <option disabled selected>Выберите тип отправления</option>
            <?php
            //        var_dump($type);
            foreach ($type as $value) {
                if ($value['number_type'] == $array['type_mail']) {
                    echo "<option value='{$value['number_type']}' selected>{$value['name_type']}</option>";
                } else {
                    echo "<option value='{$value['number_type']}'>{$value['name_type']}</option>";
                }
            }
            ?>
        </select><br>
        <input type="text" name="name_sender" placeholder="Отправитель" value='<?=$array['name_sender']?>'><br>
        <input type="text" name="address_sender" placeholder="Адрес отправителя" value='<?=$array['address_sender']?>'><br>
        <input type="text" name="name_addressee" placeholder="Адресат" value='<?=$array['name_addressee']?>'><br>
        <input type="text" name="address_addressee" placeholder="Адрес адресата" value='<?=$array['address_addressee']?>'><br>
        <input type="submit" name="action" value="далее"><br>
    </form>
<?php endif; ?>