<?php

namespace System;

class Attack
{
    public function startAttack($dbc, int $attack, int $defender)
    {
        $user1_id = $attack;
        $user2_id = $defender;

        $user1_id_army = mysqli_query($dbc,"SELECT * FROM `user_army` WHERE `user_id` = " . $user1_id);
        while($user1_id_army_r = mysqli_fetch_assoc($user1_id_army)){
            echo '<pre>' . print_r($user1_id_army_r, true) . '</pre>';
        }

        $user2_id_army = mysqli_query($dbc,"SELECT * FROM `user_army` WHERE `user_id` = " . $user2_id);
        while($user2_id_army_r = mysqli_fetch_assoc($user2_id_army)){
            echo '<pre>' . print_r($user2_id_army_r, true) . '</pre>';
        }


    }
}