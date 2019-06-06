<?php

namespace system\Repository;


use Database\PDODatabase;
use system\DTO\ArmyDTO;

class ArmyRepository
{
    private $database;
    public function __construct(PDODatabase $PDODatabase)
    {
        $this->database = $PDODatabase;
    }

    public function allArmy()
    {
        $stm = $this->database->query('SELECT * FROM army');
        $result = $stm->execute();

        return $result->fetch(ArmyDTO::class);
    }
}