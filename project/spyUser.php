<?php
session_start();
include 'config.php';
$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
$user = mysqli_query($dbc, "SELECT * FROM users where user_name = '" . $username . "'");
$user = mysqli_fetch_assoc($user);
$army = mysqli_query($dbc, "SELECT * FROM user_army LEFT JOIN army ON user_army.army_id = army.army_id WHERE user_army.user_id = " . $user['user_id']);
while($army_ = mysqli_fetch_assoc($army)){
    var_dump($army_);
}
echo $user['user_name'];
