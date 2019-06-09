<?php

namespace system\Repository;


use Database\PDODatabase;

class BuildingRepository
{
    private $database;

    public function __construct(PDODatabase $database)
    {
        $this->database = $database;
    }

    public function allBuildings()
    {

    }
}