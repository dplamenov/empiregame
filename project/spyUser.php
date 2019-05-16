<?php
session_start();
include 'config.php';
$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
$user = mysqli_query($dbc, "SELECT * FROM users where user_name = '" . $username . "'");
$user = mysqli_fetch_assoc($user);
