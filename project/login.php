<?php
session_start();
include 'config.php';
$user_name = $_POST['username'];
$user_pass = $_POST['pass'];
$users = mysqli_query($dbc, "SELECT * FROM users WHERE pass='" . $user_pass . "' AND user_name='" . $user_name . "' AND active = 1");
$lastlogin = $users['lastlogin'];
$days = abs(time() - $lastlogin) / 60 / 60 / 24;
mysqli_query($dbc, "UPDATE `users` SET `lastlogin`=  " . time(). "WHERE `user_id` = " . $users['user_id']);
mysqli_query($dbc, "UPDATE `users` SET `money`=  " . $days * 500 . "WHERE `user_id` = " . $users['user_id']);
$row = mysqli_fetch_assoc($users);
$_SESSION['user']['user_name'] = $row['user_name'];
$_SESSION['user']['user_id'] = $row['user_id'];
$_SESSION['user']['xp'] = $row['xp'];
$_SESSION['user']['money'] = $row['money'];
if (mysqli_num_rows($users) == 1) {

    $_SESSION['islogged'] = true;
    echo 'window.location.reload(true); ';
    exit;
} else {
    echo 'error';
}