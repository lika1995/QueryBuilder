<?php

namespace Lika\QueryBuilder;

class QueryBuilder
{
    private $pdo;

    /**
     * QueryBuilder constructor.
     * @param $pdo
     *
     * записывает в $pdo объект класса PDO
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param $table
     * @return mixed
     *
     * Получает все записи из тфблицы в БД
     */
    public function getAll($table)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$table}");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $table
     * @param $data
     *
     * Создает новую запись в БД
     */
    public function create($table, $data)
    {
        $keys = implode(',', array_keys($data));
        $values = '';

        foreach($data as $field){
            $values .= '?,';
        }
        $tags = rtrim($values, ',');
        $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$tags})";
        $stmt = $this->pdo->prepare($sql);
        if(count($data)){
            $i = 1;
            foreach ($data as $param) {
                $stmt->bindValue($i, $param);
                $i++;
            }
        }

        $stmt->execute();
    }

    /**
     * @param $table
     * @param $id
     * @return mixed
     *
     * Получает запись из таблицы по id
     */
    public function getOneById($table, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1 , $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $table
     * @param array $data
     * @param $id
     *
     * Меняет запись в таблице по id
     */
    public function update($table,array $data, $id)
    {
        $keys = array_keys($data);
        $string = '';

        foreach ($keys as $key){
            $string .= $key . '=:' . $key . ',';
        }

        $keys = rtrim($string, ',');
        $data['id'] = $id;
        $sql = "UPDATE {$table} SET {$keys} WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute($data);
    }

    /**
     * @param $table
     * @param $id
     *
     * Удаляет запись из таблицы
     */
    public function delete($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}