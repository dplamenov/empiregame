<?php

namespace system;

class Battle
{
    private $data = array();

    private function _findOpponent($dbc, int $user_id)
    {
        $user_xp = "SELECT `xp` FROM users WHERE `user_id` = $user_id";
        $user_xp = intval(mysqli_fetch_object(mysqli_query($dbc, $user_xp))->xp);

        $min_xp = $user_xp / 2;
        $max_xp = $user_xp * 2;

        $this->data['user_xp'] = $user_xp;
        $this->data['mix_xp'] = $min_xp;
        $this->data['max_xp'] = $max_xp;


        $users_toattack = "SELECT * FROM `users` WHERE `xp` > $min_xp and `xp` < $max_xp and `user_id` != $user_id LIMIT 1";
        $users_toattack = mysqli_query($dbc, $users_toattack);

        $userscount = mysqli_num_rows($users_toattack);
        if ($userscount == 0) {
            throw new \Exception('No suitable users found');
        }
        $defender = mysqli_fetch_assoc($users_toattack)['user_id'];

        $attack = new Attack();
        echo $attack->startAttack($dbc, $user_id, $defender);


    }

    public function battle($dbc, $user_id)
    {

        $this->_findOpponent($dbc, $user_id);
    }
}