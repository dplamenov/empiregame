<?php
session_start();
include 'config.php';
$user_name = $_POST['username'];
$user_pass = $_POST['pass'];
$userRepository = new \system\Repository\UserRepository($database);
$userService = new \system\Service\UserService($userRepository);
$user = $userService->login($user_name, $user_pass);
$_SESSION['user']['user_name'] = $user->getUserName();
$_SESSION['user']['user_id'] = $user->getUserId();
$_SESSION['user']['xp'] = $user->getXp();
$_SESSION['user']['money'] = $user->getMoney();

$hours = abs(time() - $user->getLastlogin()) / 60 / 60;

$stm = $database->query('UPDATE `users` SET `lastlogin` = :lastlogin WHERE `user_id` = :user_id');
$stm->execute([
    'lastlogin' => time(),
    'user_id' => $user->getUserId()
]);

if ($hours >= 1) {
    mysqli_query($dbc, "UPDATE `users` SET `money`=  `money` + " . $hours * 50 . " WHERE `user_id` = " . $user->getUserId());
}
$_SESSION['islogged'] = true;