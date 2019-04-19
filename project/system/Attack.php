<?php

namespace System;

class Attack
{
    public function startAttack($dbc, int $attack, int $defender)
    {
        $user1_id = $attack;
        $user2_id = $defender;
        $user1_army = 0;
        $user2_army = 0;
        $start = time();
        $user1_id_army = mysqli_query($dbc, "SELECT * FROM `user_army` WHERE `user_id` = " . $user1_id);
        while ($user1_id_army_r = mysqli_fetch_assoc($user1_id_army)) {
            $money = mysqli_query($dbc, "SELECT money FROM `army` WHERE `army_id` = " . $user1_id_army_r['army_name']);
            $money = mysqli_fetch_assoc($money)['money'];
            $user1_army += $money * $user1_id_army_r['count'];

        }
        $user2_id_army = mysqli_query($dbc, "SELECT * FROM `user_army` WHERE `user_id` = " . $user2_id);
        while ($user2_id_army_r = mysqli_fetch_assoc($user2_id_army)) {
            $money = mysqli_query($dbc, "SELECT money FROM `army` WHERE `army_id` = " . $user2_id_army_r['army_name']);
            $money = mysqli_fetch_assoc($money)['money'];
            $user2_army += $money * $user2_id_army_r['count'];
        }
        $end = time();
        //ToDo insert into table battle result from batle
        if ($user1_army > $user2_army) {
            mysqli_query($dbc, "INSERT INTO battle (attacker, defender, result, start, end) VALUES ('" . $user1_id . "', '" . $user2_id . "', 1, " . $start . ", " . $end . ")");
            $this->showAlert(1);

        } elseif ($user1_army <= $user2_army) {
            mysqli_query($dbc, "INSERT INTO battle (attacker, defender, result, start, end) VALUES ('" . $user1_id . "', '" . $user2_id . "', 2, " . $start . ", " . $end . ")");
            $this->showAlert(2);
        }


    }

    private function showAlert($i)
    {
        switch ($i) {
            case 1:
                echo "<script>battle()</script><div class=\"alert alert-success\" style=\"margin: 0\" role=\"alert\">
  You win
</div>";
                break;
            case 2:
                echo "<div class=\"alert alert-danger\" style=\"margin: 0\" role=\"alert\">
   You lose
</div>";
                break;
        }
    }
}