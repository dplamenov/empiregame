<?php

namespace system\Repository;


use Database\PDODatabase;
use system\DTO\BuildingDTO;

class BuildingRepository
{
    private $database;

    public function __construct(PDODatabase $database)
    {
        $this->database = $database;
    }

    public function allBuildings()
    {
        $stm = $this->database->query('SELECT * FROM building');
        $result = $stm->execute();

        return $result->fetch(BuildingDTO::class);
    }
}