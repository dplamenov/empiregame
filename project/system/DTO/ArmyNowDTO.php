<?php


namespace system\DTO;


class ArmyNowDTO
{
    private $user_id;

    private $army_name;

    private $end_time;

    private $army_num;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
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
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @param mixed $end_time
     */
    public function setEndTime($end_time): void
    {
        $this->end_time = $end_time;
    }

    /**
     * @return mixed
     */
    public function getArmyNum()
    {
        return $this->army_num;
    }

    /**
     * @param mixed $army_num
     */
    public function setArmyNum($army_num): void
    {
        $this->army_num = $army_num;
    }


}