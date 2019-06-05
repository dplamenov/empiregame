<?php
session_start();
include 'config.php';
$army = mysqli_query($dbc, "SELECT * FROM `user_army` WHERE army_id = " .  $_POST['army']);
$army = mysqli_fetch_assoc($army)['army_name'];
$result = mysqli_query($dbc, "SELECT * FROM `upgrade_army` WHERE army_name = " . $army);
if(mysqli_num_rows($result) == 0){
    echo 1;
}