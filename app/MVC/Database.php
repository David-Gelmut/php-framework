<?php

namespace App\MVC;

class Database
{
    protected \PDO $connection;
    protected \PDOStatement $stmt;

    public function __construct()
    {
        $dsn = "mysql:host=" . DB_SETTINGS['host'] . ";port=" . DB_SETTINGS['port'] . ";dbname=" . DB_SETTINGS['database'] . ";charset=" . DB_SETTINGS['charset'];
        try {
            $this->connection = new \PDO($dsn, DB_SETTINGS['username'], DB_SETTINGS['password'], DB_SETTINGS['options']);
        } catch (\PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] DB Error: {$e->getMessage()}" . PHP_EOL, 3, ERROR_LOGS);
            abort('DB error connection', 500);
        }
        return $this;
    }

    public function query(string $query, array $params = []): self
    {
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute($params);
        return $this;
    }

    public function get(): array|false
    {
        return $this->stmt->fetchAll();
    }

    public function getOne(): mixed
    {
        return $this->stmt->fetch();
    }

    public function getAssoc(string $key = 'id'): array
    {
        $data = [];
        while ($row = $this->stmt->fetch()) {
            $data[$row[$key]] = $row;
        }

        return $data;
    }

    public function getColumn(): mixed
    {
        return $this->stmt->fetchColumn();
    }

    public function findAll(string $table): array|false
    {
        $this->query("select * from  {$table}");
        return $this->stmt->fetchAll();
    }

    public function findOne(string $table, mixed $value, mixed $key = 'id'): array|false
    {
        $this->query("select * from  {$table} where {$key}= ? limit 1", [$value]);
        return $this->stmt->fetch();
    }

    public function findOrFail(string $table, mixed $value, mixed $key = 'id'): array|false
    {
        $result = $this->findOne($table, $value, $key);
        if (!$result) {
            abort('Fail results');
        }
        return $result;
    }

    public function getInsertID(): false|string
    {
        return $this->connection->lastInsertId();
    }

    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    public function beginTransaction(): bool
    {
        return $this->connection->beginTransaction();
    }

    public function commitTransaction(): bool
    {
        return $this->connection->commit();
    }

    public function rollbackTransaction(): bool
    {
        return $this->connection->rollBack();
    }
}