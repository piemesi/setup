<?php

namespace App;

/**
 * Class Init
 * @package App
 */
final class Init
{
    /**
     * Количество записей в бд для заполнения изначально
     */
    const NUM_OF_ROWS = 10;

    /**
     * @var \mysqli
     */
    private $connect = null;

    /**
     * Init constructor.
     */
    public function __construct()
    {
        $this->create();
        $this->fill();
    }

    /**
     * Метод создающий структуру таблицы test
     */
    private function create()
    {

        // @toDo - в идеале вынести в отдельный файл настроек и получать из docker-compose
        $mysqli = new \mysqli("172.17.0.1", "writer", "123456", "Task", "3307");

        /* проверка соединения */
        if ($mysqli->connect_errno) {
            printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
            exit();
        }

        /* Очистим таблицу */
        $queryInit = /** @lang sql */
            "DROP TABLE IF EXISTS test CASCADE";
        $mysqli->query($queryInit);

        $query = /** @lang sql */
            "CREATE TABLE test (
          id integer unsigned not null auto_increment,
          script_name varchar(25) not null default '',
          start_time timestamp not null default '0000-00-00 00:00:00',
          sort_index tinyint(3) not null default '0',
          result enum('normal', 'illegal', 'failed', 'success') not null default 'normal',
          PRIMARY KEY (id),
          KEY result (result)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";


        /* Выполняем запрос */
        if ($mysqli->query($query) === TRUE) {
            printf("Таблица test успешно создана.\n");
        }

        $this->connect = $mysqli;
    }

    /**
     * Заполнение таблицы данными
     */
    private function fill()
    {

        $resultValues = ['normal', 'illegal', 'failed', 'success'];
        $inserts = [];
        for ($i = 0; $i < self::NUM_OF_ROWS; $i++) {
            $script_name = uniqid() . substr(time(), 0, 6);
            $sort_index = 100 + $i;
            shuffle($resultValues);
            $result = $resultValues[0];
            $start_time = date('Y-m-d H:i:s');

            $inserts[] = "('{$script_name}', '{$sort_index}', '{$result}', '{$start_time}')";
        }

        $query = /** @lang sql */
            "INSERT INTO test (`script_name`, `sort_index`, `result`, `start_time`) 
        VALUES " . join(', ', $inserts) . ";";


        /* Выполняем запрос */
        $queryResult = $this->connect->query($query);
        if ($queryResult) {
            printf("Данные успешно добавлены. %d строк.\n", self::NUM_OF_ROWS);

        }

    }

    /**
     * получаем данные из таблицы test
     */
    public function get()
    {
        if (!$this->connect) {
            throw new \Exception('There is no connect to DB');
        }

        $query = /** @lang sql */
            "SELECT * FROM test WHERE result IN ('normal','success')";

        $data = 'No relevant rows founded';        /* Извлекае необходимые данные */
        if ($result = $this->connect->query($query)->fetch_all(MYSQLI_ASSOC)) {
            $data = $result;
        }

        $this->connect->close();

        return $data;
    }

}

$i = new Init();

$data = $i->get();

print_r($data);

