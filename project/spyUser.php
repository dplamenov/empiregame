<?php
session_start();
include 'config.php';
$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
$user = mysqli_query($dbc, "SELECT * FROM users where user_name = '" . $username . "'");
$user = mysqli_fetch_assoc($user);
$army = mysqli_query($dbc, "SELECT * FROM user_army LEFT JOIN army ON user_army.army_id = army.army_id WHERE user_army.user_id = " . $user['user_id']);
$army_count = 0;
while($army_ = mysqli_fetch_assoc($army)){
    $army_count += $army_['count'];
}
$castle_level = mysqli_query($dbc, "SELECT * FROM users_building WHERE building_id = 2 and user_id = " . $user['user_id']);
$castle_level = mysqli_fetch_assoc($castle_level)['build_lv'];
?>
<p style="font-weight: bold; text-align: center;font-size: 22px">Spy result</p>
<p>Username: <?=$user['user_name']?></p>
<p>Army count: <?=$army_count?></p>
<p>Castle Level: <?=$castle_level?></p>
