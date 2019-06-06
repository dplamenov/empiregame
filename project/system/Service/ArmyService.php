<?php

namespace system\Service;


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

}