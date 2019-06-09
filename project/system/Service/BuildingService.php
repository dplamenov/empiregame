<?php

namespace system\Service;


use system\Repository\BuildingRepository;

class BuildingService
{
    private $buildingRepository;

    public function __construct(BuildingRepository $buildingRepository)
    {
        $this->buildingRepository = $buildingRepository;
    }

    public function getAllBuildings()
    {
        return $this->buildingRepository->allBuildings();
    }


}