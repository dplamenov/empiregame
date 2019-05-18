<?php
session_start();
include_once 'config.php';
$level = mysqli_query($dbc, "SELECT * FROM `levels` WHERE ". userdata($_SESSION['user']['user_id'], 'xp', $dbc) ." BETWEEN from_xp and to_xp");
$level = mysqli_fetch_assoc($level)['level_id'];
echo '<p>Your  money: $' . userdata($_SESSION['user']['user_id'], 'money', $dbc) . '</p>';
echo '<span style="display: block">Level '.$level.' / XP: ' . userdata($_SESSION['user']['user_id'], 'xp', $dbc) . 'xp</span>';
echo '<span>Population: ' . userdata($_SESSION['user']['user_id'], 'people', $dbc) . '</span><br>';

echo '<a href="statistics.php"><img src="images/statistic-icon.png" title="Statistics"/><a/>';