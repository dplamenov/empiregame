<?php
session_start();
include_once "config.php";
function getCount($dbc): int
{
    $count = mysqli_query($dbc, "SELECT * FROM upgrade_army WHERE user_id = " . $_SESSION['user']['user_id']);
    $count = mysqli_num_rows($count);
}


if (@$_POST['getCount'] == true) {
    echo getCount($dbc);
}