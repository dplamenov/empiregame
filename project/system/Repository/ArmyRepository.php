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

    public function trainingArmyByUserNow()
    {
        $stm = $this->database->query('SELECT * FROM `army_now` WHERE `user_id` = :user_id  AND `army_name` = :army_id  ORDER BY `end_time`');

    }
}