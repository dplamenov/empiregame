<?php

namespace system;

class Random
{
    private $x;
    private $y;
    private $sql;

    public function __construct($user_id, $dbc)
    {
        $this->random($user_id, $dbc);
    }


    private function random($user_id, $dbc)
    {
        $x = $user_id;
        $y = $user_id;
        $this->x = $x;
        $this->y = $y;
        $this->sql = "SELECT * FROM `users` WHERE `user_id` = " . $user_id . " AND 
        `x` = " . $x . " AND
         `y` = " . $y;
        if (mysqli_num_rows(mysqli_query($dbc, $this->sql)) > 1) {
            $this->random($user_id, $dbc);
        } else {
            echo $this->x;
        }
    }


}