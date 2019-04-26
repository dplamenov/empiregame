<?php
session_start();
include 'config.php';
$army_id = $_POST['army'];
$army = mysqli_query($dbc, "SELECT * FROM user_army WHERE army_id = " . $army_id);
$army = mysqli_fetch_assoc($army);
$price = mysqli_query($dbc, "SELECT * FROM army WHERE army_id = " . $army['army_name']);
$price = mysqli_fetch_assoc($price)['money'];
$total_price = $price * $army['count'];
echo $total_price;