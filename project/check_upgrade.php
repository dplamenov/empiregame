<?php
session_start();
include 'config.php';
$result = mysqli_query($dbc, "SELECT * FROM upgrade_army WHERE user_id = " . $_SESSION['user']['user_id']. " and army_name = " . $_POST['army']);
if(mysqli_num_rows($result) == 1){
    return true;
}
return false;