<?php
/**
 * Вспомогательна функция для удаления одного и более значений из таблицы
 * @param $deleteId -  то, что необходимо удалить
 * @param $numberId object объект класса NumberID
 */
function deleteID($deleteId, $numberId)
{
    if (is_array($deleteId)) {
        for ($i = 0; $i < count($deleteId); $i++) {
            $numberId->numberId = $deleteId[$i];
          $result =  $numberId->deleteId();
        }
    } else {
        $numberId->numberId = $deleteId;
        $result = $numberId->deleteId();
    }
    return $result;
}

/**
 * Вспомогательная функция. с помоью которой можно сохранить в базу больше одного эначения
 * @param $countId int количество создаваемых идентификаторов
 * @param $numberId object Объект Класса NumberId
 */
function createId($countId, $numberId)
{
    for ($i = 0; $i < $countId; $i++) {
       $number[] = $numberId->createId();
    }
    return $number;
}
