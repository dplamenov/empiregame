<?php
namespace system\DTO;


class ArmyDTO
{
    private $army_id;

    private $army_name;

    private $army_level;

    private $money;

    private $time;

    private $give_xp;

    /**
     * @return mixed
     */
    public function getArmyId()
    {
        return $this->army_id;
    }

    /**
     * @param mixed $army_id
     */
    public function setArmyId($army_id): void
    {
        $this->army_id = $army_id;
    }

    /**
     * @return mixed
     */
    public function getArmyName()
    {
        return $this->army_name;
    }

    /**
     * @param mixed $army_name
     */
    public function setArmyName($army_name): void
    {
        $this->army_name = $army_name;
    }

    /**
     * @return mixed
     */
    public function getArmyLevel()
    {
        return $this->army_level;
    }

    /**
     * @param mixed $army_level
     */
    public function setArmyLevel($army_level): void
    {
        $this->army_level = $army_level;
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