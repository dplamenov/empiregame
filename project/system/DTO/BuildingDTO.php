<?php


namespace system\DTO;

class BuildingDTO
{
    private $build_name;

    private $money;

    private $time;

    private $building_id;

    private $geo_id;

    private $geo_location;

    private $shape;

    private $give_xp;

    /**
     * @return mixed
     */
    public function getBuildName()
    {
        return $this->build_name;
    }

    /**
     * @param mixed $build_name
     */
    public function setBuildName($build_name): void
    {
        $this->build_name = $build_name;
    }

    /**
     * @return mixed
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * @param mixed $money
     */
    public function setMoney($money): void
    {
        $this->money = $money;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getBuildingId()
    {
        return $this->building_id;
    }

    /**
     * @param mixed $building_id
     */
    public function setBuildingId($building_id): void
    {
        $this->building_id = $building_id;
    }

    /**
     * @return mixed
     */
    public function getGeoId()
    {
        return $this->geo_id;
    }

    /**
     * @param mixed $geo_id
     */
    public function setGeoId($geo_id): void
    {
        $this->geo_id = $geo_id;
    }

    /**
     * @return mixed
     */
    public function getGeoLocation()
    {
        return $this->geo_location;
    }

    /**
     * @param mixed $geo_location
     */
    public function setGeoLocation($geo_location): void
    {
        $this->geo_location = $geo_location;
    }

    /**
     * @return mixed
     */
    public function getShape()
    {
        return $this->shape;
    }

    /**
     * @param mixed $shape
     */
    public function setShape($shape): void
    {
        $this->shape = $shape;
    }

    /**
     * @return mixed
     */
    public function getGiveXp()
    {
        return $this->give_xp;
    }

    /**
     * @param mixed $give_xp
     */
    public function setGiveXp($give_xp): void
    {
        $this->give_xp = $give_xp;
    }



}