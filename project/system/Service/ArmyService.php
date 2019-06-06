<?php

namespace system\Service;


use system\DTO\ArmyNowDTO;
use system\Repository\ArmyRepository;

class ArmyService
{
    private $armyRepositoy;

    public function __construct(ArmyRepository $armyRepositoy)
    {
        $this->armyRepositoy = $armyRepositoy;
    }

    public function allArmy()
    {
        return $this->armyRepositoy->allArmy();
    }

    public function trainingArmyByUser(int $user_id, int $army_id): ArmyNowDTO
    {
        return $this->armyRepositoy->trainingArmyByUserNow($user_id, $army_id);
    }
}