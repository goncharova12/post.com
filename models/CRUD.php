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
    private $host = '127.0.0.1';
    private $userName = 'root';
    private $passwd = '';
    private $dbName = 'post';
    public $conn;

    /**
     * CRUD constructor. подключает к БД
     */
    function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbName;charset=UTF8";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->conn = new PDO($dsn, $this->userName, $this->passwd, $opt);
    }

    /**
     * @return bool|mysqli_result
     */
    public function create()
    {
        $result = $this->conn->query("INSERT INTO $this->nameTable VALUES ($this->dataTable)");
//        var_dump($sqlCreate);
        return $result;
    }

    /**
     * @return mixed возвращает в виде массива результат поиска, отсортированный по искомой колонке
     */
    public function read()
    {
        $result = $this->conn->query("SELECT $this->dataTable FROM $this->nameTable  ORDER BY $this->nameColumn")->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @return bool|mysqli_result
     */
    public function update()
    {
        $result = $this->conn->query("UPDATE $this->nameTable SET $this->nameColumnTwo='$this->newDataTable' WHERE $this->nameColumn='$this->dataTable' AND $this->nameColumnTwo='$this->oldDataTable'");
        return $result;

    }

    /**
     * @return bool|mysqli_result
     */
    public function delete()
    {
        $result = $this->conn->query( "DELETE FROM $this->nameTable WHERE $this->nameColumn='$this->dataTable' AND $this->nameColumnTwo = '$this->dataTableTwo'");
        return $result;
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
        $result = $this->conn->query("SELECT * FROM $nameTable WHERE $nameColumnOne='$dataTableOne' AND $nameColumnTwo='$dataTableTwo'")->fetchAll(PDO::FETCH_ASSOC);
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
        $result = $this->conn->query("SELECT * FROM $nameTable WHERE  $nameColumn = '$dataTable'")->fetchAll(PDO::FETCH_ASSOC);
        return $result;
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
        $result = $this->conn->query("SELECT * FROM $nameTable WHERE $nameColumn LIKE '%$dataTable%'")->fetchAll(PDO::FETCH_ASSOC);
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