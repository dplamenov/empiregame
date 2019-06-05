<?php
session_start();
include 'config.php';
$user_name = $_POST['username'];
$user_pass = $_POST['pass'];
$userService = new \system\Service\UserService(new \system\Repository\UserRepository($database));
$user = $userService->login($user_name, $user_pass);
$_SESSION['user']['user_name'] = $user->getUserName();
$_SESSION['user']['user_id'] = $user->getUserId();
$_SESSION['user']['xp'] = $user->getXp();
$_SESSION['user']['money'] = $user->getMoney();

$lastlogin = $user->getLastlogin();
$hours = abs(time() - $lastlogin) / 60 / 60;
mysqli_query($dbc, "UPDATE `users` SET `lastlogin`=  " . time(). " WHERE `user_id` = " . $user->getUserId());
if($hours >= 1){
    mysqli_query($dbc, "UPDATE `users` SET `money`=  `money` + " . $hours * 50 . " WHERE `user_id` = " . $user->getUserId());
}
$_SESSION['islogged'] = true;