<?php


namespace Core;


class DB
{
    private $connection;
    private $statement;

    public function __construct($db_info)
    {
        $dsn = 'mysql:host=' . $db_info['hostname'] . ';dbname=' . $db_info['db_name'] . ';charset=utf8mb4';
        $this->connection = new \PDO($dsn, $db_info['username'], $db_info['password']);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function query($query, $params = null)
    {
        $this->statement = null;
        try {
            if ($params == null) {
                $this->statement = $this->connection->query($query);
            } else {
                $this->statement = $this->connection->prepare($query);
                $this->statement->execute($params);
            }
        } catch(Exception $e) {
            print('Exception -> ');
            var_dump($e->getMessage());
        }
    }

    public function execute($query, $params = null)
    {
        $this->statement = null;
        try {
            if ($params == null) {
                $this->statement = $this->connection->exec($query);
            } else {
                $this->statement = $this->connection->prepare($query);
                $this->statement->execute($params);
            }
        } catch(Exception $e) {
            print('Exception -> ');
            var_dump($e->getMessage());
        }
    }

    public function getResults()
    {
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getSingleResult()
    {
        return $this->statement;
    }
}