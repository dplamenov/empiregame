<?php
session_start();
include 'config.php';
$user_army = mysqli_query($dbc, "SELECT * FROM user_army WHERE army_id = " . $_POST['army']);
$user_army = mysqli_fetch_assoc($user_army);
$army = mysqli_query($dbc, "SELECT * FROM army where army_id = " . $user_army['army_name']);
$army = mysqli_fetch_assoc($army);
$start = time();
$end = $start + ($user_army['count'] * $army['time'] * 60);
$level = $user_army['lvl'] + 1;
mysqli_query($dbc, "INSERT INTO upgrade_army (army_name, start, end, level) VALUES (".$user_army['army_name'].", ".$start.", ".$end.", ".$level.")");