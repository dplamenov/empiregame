<?php
session_start();
include 'config.php';
$army = mysqli_query($dbc, "SELECT * FROM user_army WHERE army_id = " . $army_id);
