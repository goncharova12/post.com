<?php

class CRUD
{
    public $nameTable;
    public $dataTable;
    public $dataTableTwo;
    public $nameColumn;
    public $oldDataTable;
    public $newDataTable;
    public $nameColumnTwo;
    private $host = "localhost";
    private $userName = "root";
    private $passwd = "";
    private $dbName = "post";
    public $conn;

    /**
     * CRUD constructor. подключает к БД
     */
    function __construct()
    {
        $this->conn = new mysqli($this->host, $this->userName, $this->passwd, $this->dbName);
        if ($this->conn->connect_error) die("Ошибка подключения к БД: " . $this->conn->connect_error);
        $this->conn->set_charset("UTF8");
    }

    /**
     * @return bool|mysqli_result
     */
    public function create()
    {
        $sqlCreate = "INSERT INTO $this->nameTable VALUES ($this->dataTable)";
        $result = $this->conn->query($sqlCreate);
//        var_dump($sqlCreate);
        if (!$result) {
            die("Сбой при доступе к базе данных: " . mysqli_connect_error());
        } else {
            return $result;
        }
    }

    /**
     * @return mixed возвращает в виде массива результат поиска, отсортированный по искомой колонке
     */
    public function read()
    {
        $sqlRead = "SELECT $this->dataTable FROM $this->nameTable  ORDER BY $this->nameColumn";
//        var_dump($sqlRead);
        $result  = $this->conn->query($sqlRead);
        if (!$result) {
            die("Сбой при доступе к базе данных: " . mysqli_connect_error());
        } else {
            echo "<br>";
            $readId = $result->fetch_all(MYSQLI_ASSOC);
            return $readId;
        }
    }

    /**
     * @return bool|mysqli_result
     */
    public function update()
    {
        $sqlUpdate = "UPDATE $this->nameTable SET $this->nameColumnTwo='$this->newDataTable' WHERE $this->nameColumn='$this->dataTable' AND $this->nameColumnTwo='$this->oldDataTable'";
//        var_dump($sqlUpdate);
        $result = $this->conn->query($sqlUpdate);

        if (!$result) {
            die("Сбой при доступе к базе данных: " . mysqli_connect_error());
        } else {
            return $result;
        }
    }

    /**
     * @return bool|mysqli_result
     */
    public function delete()
    {
        $sqlDelete = "DELETE FROM $this->nameTable WHERE $this->nameColumn='$this->dataTable' AND $this->nameColumnTwo = '$this->dataTableTwo'";
//        var_dump($sqlDelete);
        $result = $this->conn->query($sqlDelete);

        if (!$result) {
            die("Сбой при доступе к базе данных: " . mysqli_connect_error());
        } else {
            return $result;
        }
    }

    /**
     * Метод для поиска по двум столбцам
     * @param $nameTable string - название таблицы, в которой нужно произвести поиск
     * @param $nameColumnOne string - название первого столбца, по которому нужно произвести поиск
     * @param $dataTableOne string - то, что нужно найти в первом столбце
     * @param $nameColumnTwo string - название второго столбца, по которому нужно произвести поиск
     * @param $dataTableTwo string - то, что нужно найти во втором столбце
     * @return bool|mixed|mysqli_result - возвращает строку, хранящую исскомые данные
     */
    public function twoColumnSearch($nameTable, $nameColumnOne, $dataTableOne, $nameColumnTwo, $dataTableTwo)
    {
        $sqlRequare = "SELECT * FROM $nameTable WHERE $nameColumnOne='$dataTableOne' AND $nameColumnTwo='$dataTableTwo'";
        $result = $this->conn->query($sqlRequare);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    /**
     * Метод для поиска по одному столбцу
     * @param $nameTable - название таблицы, в которой происходит поиск
     * @param $nameColumn - название колонки, в которой происходит поиск
     * @param $dataTable - данные, которые нужно найти
     * @return mixed возвращает искомый результат
     */
    public function oneColumnSearch($nameTable, $nameColumn, $dataTable)
    {
        $sqlLook = "SELECT * FROM $nameTable WHERE  $nameColumn = '$dataTable'";
//        var_dump($sqlLook);
        $result = $this->conn->query($sqlLook);
        $readId = $result->fetch_all(MYSQLI_ASSOC);
        return $readId;
    }

    /**
     * Метод для поиска по части известных данных
     * @param $nameTable - название таблицы, в которой ведется поиск
     * @param $nameColumn - название колонки, по которой происходит поиск
     * @param $dataTable - то, что нужно найти
     * @return bool|mixed|mysqli_result возвращает результат в формате try или false
     */
    public function searchForData($nameTable, $nameColumn, $dataTable)
    {
        $sql = "SELECT * FROM $nameTable WHERE $nameColumn LIKE '%$dataTable%'";
        $result = $this->conn->query($sql);
        $result = $result->fetch_all(MYSQLI_ASSOC);
//        var_dump($result);
        return $result;

    }

    /**
     * @param $var переменная, которую нужно просмотреть
     */
    public function debug($var) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}