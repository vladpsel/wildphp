<?php

declare(strict_types=1);

namespace Voopsc\Wild\Storage\Mysql;

use PDO;

class MysqlStorage extends Connection
{

    /**
     * Create item in storage
     * @param string $table
     * @param array $keys
     * @return string|null
     */
    public function create(string $table, array $keys): ?string
    {
        $db = $this->getConnection();
        $lastKey = array_slice($keys, -1, 1);
        array_pop($keys);

        $sql = 'INSERT INTO %s';
        $sql = sprintf($sql, $table);
        $sql .= ' (';
        foreach ($keys as $key => $value) {
            $sql .= $key . ', ';
        }
        $sql .= key($lastKey) . ') VALUES (';
        foreach ($keys as $key => $value) {
            $sql .= ':' . $key . ', ';
        }
        $sql .= ':' . key($lastKey) . ');';

        $keys = array_merge($keys, $lastKey);
        $result = $db->prepare($sql);

        foreach ($keys as $param => &$val) {
            $result->bindParam(":$param", $val, PDO::PARAM_STR);
        }

        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return null;
    }

    /**
     * @param array $sqlParams
     * @param string $table
     * @return mixed|null
     */
    public function readOneBy(array $sqlParams, string $table)
    {
        $db = $this->getConnection();
        $sql = "SELECT * FROM %s WHERE ";
        $sql = sprintf($sql, $table);
        $lastParam = array_slice($sqlParams, -1, 1);
        array_pop($sqlParams);

        if (is_array($sqlParams)) {
            foreach ($sqlParams as $param => $value) {
                $sql .= "  $param" . ' = :' . $param . ' AND ';
            }
        }
        $sql .= key($lastParam) . ' = :' . key($lastParam);

        $result = $db->prepare($sql);

        if (is_array($sqlParams)) {
            foreach ($sqlParams as $param => &$value) {
                $result->bindParam(':' . $param, $value, PDO::PARAM_STR);
            }
        }
        $result->bindParam(':' . key($lastParam), $lastParam[key($lastParam)], PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $operationResult = $result->fetch();
        if ($operationResult === false) {
            return null;
        }
        return $operationResult;
    }


    /**
     * Read by params in "select" sql part
     * @param array $sqlParams
     * @param string $table
     * @param null $sorting
     * @return array|null
     */
    public function readBy(array $sqlParams, string $table, $sorting = null): ?array
    {
        $db = $this->getConnection();
        $sql = "SELECT * FROM %s WHERE ";
        $sql = sprintf($sql, $table);
        $lastParam = array_slice($sqlParams, -1, 1);
        array_pop($sqlParams);

        if (is_array($sqlParams)) {
            foreach ($sqlParams as $param => $value) {
                $sql .= "  $param" . ' = :' . $param . ' AND ';
            }
        }
        $sql .= key($lastParam) . ' = :' . key($lastParam);

        if (!is_null($sorting)) {
            $sql .= ' ' . $sorting;
        }

        $result = $db->prepare($sql);

        if (is_array($sqlParams)) {
            foreach ($sqlParams as $param => &$value) {
                $result->bindParam(':' . $param, $value, PDO::PARAM_STR);
            }
        }
        $result->bindParam(':' . key($lastParam), $lastParam[key($lastParam)], PDO::PARAM_STR);

        return $this->getValues($table, $result);
    }

    /**
     * Read by string sql request
     * @param string $sql
     * @param $table
     * @param array $keys
     * @return array
     */
    public function readByQuery(string $sql, $table, $keys = [])
    {
        $db = $this->getConnection();
        $sql = sprintf($sql, $table);
        $result = $db->prepare($sql);
        return $this->getValues($table, $result, $keys);
    }

    /**
     * @param array|null $data
     * @param array|null $param
     * @param string $table
     * @return bool
     */
    public function updateDataByParam(?array $data, ?array $param, string $table)
    {
        $db = $this->getConnection();

        $sql = 'UPDATE %s';

        $sql = sprintf($sql, $table);
        $sql .= ' SET ';

        $lastItem = array_slice($data, -1, 1);
        array_pop($data);

        if (!empty($data)) {
            foreach ($data as $key => $item) {
                $sql .= "$key " . "= :$key, ";
            }
        }

        $sql .= key($lastItem) . ' = :' . key($lastItem);
        $sql .= ' WHERE ' . key($param) . ' = :' . key($param);


        $result = $db->prepare($sql);

        if (is_array($data)) {
            foreach ($data as $paramItem => &$value) {
                $result->bindParam(':' . $paramItem, $value, PDO::PARAM_STR);
            }
        }
        $result->bindParam(':' . key($lastItem), $lastItem[key($lastItem)], PDO::PARAM_STR);
        $result->bindParam(':' . key($param), $param[key($param)], PDO::PARAM_STR);

        return $result->execute();
    }


    /**
     * Get all columns title from table
     * @param string $table
     * @return array
     */
    private function getColumns(string $table): array
    {
        $db = self::getConnection();

        $sql = 'SHOW COLUMNS FROM %s';
        $sql = sprintf($sql, $table);

        $result = $db->prepare($sql);
        $result->execute();

        $i = 0;
        $list = [];
        while ($row = $result->fetch()) {
            $list[$i] = $row['Field'];
            $i++;
        }
        return $list;
    }

    /**
     * Get data from db for every row based on requested keys.
     * Default (empty) keys return all db columns
     * @param string $table name of table
     * @param object $pdo PDO object with prepared sql
     * @param array $keys custom keys for db
     * @return array with data
     */
    private function getValues(string $table, object $pdo, array $keys = []): array
    {
        $pdo->setFetchMode(PDO::FETCH_ASSOC);
        $pdo->execute();

        $i = 0;
        $list = [];

        if (empty($keys)) {
            $keys = self::getColumns($table);
        }

        while ($row = $pdo->fetch()) {
            foreach ($keys as $value) {
                $list[$i][$value] = $row[$value];
            }
            $i++;
        }
        return $list;
    }

}