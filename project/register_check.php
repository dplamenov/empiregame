<?php
session_start();
$v = '1';
include 'config.php';
//$error=array();
$user_name = trim($_POST['username']);
$user_pass = trim($_POST['pass']);
$user_realname = trim($_POST['realname']);
$user_email = trim($_POST['email']);

$sql_to_check_email = "SELECT * FROM users WHERE email='" . $user_email . "'";
$checkemail = mysqli_query($dbc, $sql_to_check_email);

$sql_to_check_username = "SELECT * FROM users WHERE user_name='" . $user_name . "'";
$checkusername = mysqli_query($dbc, $sql_to_check_username);

$checknamenum = mysqli_num_rows($checkusername);

$checkemailnum = mysqli_num_rows($checkemail);

if ($checkemailnum == 1) {
    $error[] = '<p>Този емайл се използва</p>';
}
if ($checknamenum == 1) {
    $error[] = '<p>Има такова потребителско име</p>';
}

if (mb_strlen($user_name) < 2) {
    $error[] = '<p>Името е прекалено късо.</p>';
}

if (mb_strlen($user_pass) < 8) {
    $error[] = '<p>Паролата е прекалено къса.</p>';
}

if (mb_strlen($user_email) < 6 or !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    $error[] = '<p>Невалиден емайл</p>';
}


if (@count($error) > 0) {
    foreach ($error as $er) {
        echo $er;
    }
    exit;
} else {

    $user_name = mysqli_real_escape_string($dbc, trim($user_name));
    $user_realname = mysqli_real_escape_string($dbc, trim($user_realname));
    $user_email = mysqli_real_escape_string($dbc, trim($user_email));
    $user_pass = mysqli_real_escape_string($dbc, trim($user_pass));

    $now = time();
    $sql_to_register = "INSERT INTO `users`(`user_name`, `real_name`, `email`, `pass`, `money`, `lastlogin`) VALUES ('" . $user_name . "','" . $user_realname . "','" . $user_email . "','" . $user_pass . "' , 680, $now)";
    mysqli_query($dbc, $sql_to_register);

    $users = mysqli_query($dbc, "SELECT * FROM users WHERE pass='" . $user_pass . "' AND user_name='" . $user_name . "'");
    $row = mysqli_fetch_assoc($users);


    $_SESSION['islogged'] = true;
    $_SESSION['user']['user_name'] = $row['user_name'];
    $_SESSION['user']['user_id'] = $row['user_id'];
    $_SESSION['user']['xp'] = $row['xp'];
    $_SESSION['user']['money'] = $row['money'];
    $v = '0';
    echo ' You register successfully -><a href="index.php">Click on me to play</a> ';
}