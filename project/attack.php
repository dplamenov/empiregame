<?php
session_start();
require 'config.php';
$attack = new \System\Attack();
$defender = mysqli_query($dbc, "SELECT * FROM users WHERE user_name = '" . $_POST['user'] . "'");
$defender = mysqli_fetch_assoc($defender);
$defender = $defender['user_id'];
try {
    $attack->startAttack($dbc, intval($_SESSION['user']['user_id']),
        intval($defender));
}catch (Exception $exception){
    echo $exception->getMessage();
}