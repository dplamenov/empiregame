<?php

namespace Database;


class PDODatabase implements DatabaseInterface
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function query(string $query): StatementInterface
    {
        $stmt = $this->pdo->prepare($query);

        return new PDOPreparedStatement($stmt);
    }

    public function lastInsertId():int{
      return $this->pdo->lastInsertId();
    }

    public function getLastError(): array
    {
        return $this->pdo->errorInfo();
    }
}