<?php
session_start();
include_once 'config.php';
$__database->runRawQuery("UPDATE `users` SET `active`= 0 WHERE `user_id` = " . $_SESSION['user']['user_id']);
session_destroy();