<?php

namespace system;


class Battle
{
    private $data = array();

    private function _findOpponent($dbc, int $user_id)
    {
        $user_xp = "SELECT `xp` FROM users WHERE `user_id` = $user_id";
        $user_xp = intval(mysqli_fetch_object(mysqli_query($dbc,$user_xp))->xp);

        $min_xp = $user_xp / 2;
        $max_xp = $user_xp * 2;

        $this->data['user_xp'] = $user_xp;
        $this->data['mix_xp'] = $min_xp;
        $this->data['max_xp'] = $max_xp;


        return $this->data;


    }

    public function findOpponent($dbc, $user_id){

        echo $this->_findOpponent($dbc, $user_id);
    }
}