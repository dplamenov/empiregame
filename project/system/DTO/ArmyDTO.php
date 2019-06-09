<?php
namespace system\DTO;


class ArmyDTO
{
    /**
     * @var int
     */
    private $army_id;

    /**
     * @var string
     */
    private $army_name;

    /**
     * @var int
     */
    private $army_level;

    /**
     * @var int
     */
    private $money;

    /**
     * @var int
     */
    private $time;

    /**
     * @var int
     */
    private $give_xp;


    /**
     * @return int
     */
    public function getArmyId(): int
    {
        return $this->army_id;
    }

    /**
     * @param int $army_id
     */
    public function setArmyId(int $army_id): void
    {
        $this->army_id = $army_id;
    }

    /**
     * @return string
     */
    public function getArmyName(): string
    {
        return $this->army_name;
    }

    /**
     * @param string $army_name
     */
    public function setArmyName(string $army_name): void
    {
        $this->army_name = $army_name;
    }

    /**
     * @return int
     */
    public function getArmyLevel(): int
    {
        return $this->army_level;
    }

    /**
     * @param int $army_level
     */
    public function setArmyLevel(int $army_level): void
    {
        $this->army_level = $army_level;
    }

    /**
     * @return int
     */
    public function getMoney(): int
    {
        return $this->money;
    }

    /**
     * @param int $money
     */
    public function setMoney(int $money): void
    {
        $this->money = $money;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time): void
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getGiveXp(): int
    {
        return $this->give_xp;
    }

    /**
     * @param int $give_xp
     */
    public function setGiveXp(int $give_xp): void
    {
        $this->give_xp = $give_xp;
    }


}