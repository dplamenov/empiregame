<?php
session_start();
require 'config.php';
$attack = new \System\Attack();
$userRepository = new system\Repository\UserRepository($database);
$userService = new \system\Service\UserService($userRepository);
$defender = $userService->findByUsername($_POST['user']);
$defender = $defender->getUserId();
try {
    $attack->startAttack($dbc, intval($_SESSION['user']['user_id']),
        intval($defender));
}catch (Exception $exception){
    $json['code'] = '1';
    $json['exception'] = $exception->getMessage();
    echo json_encode($json);
}
