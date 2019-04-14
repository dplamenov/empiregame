<?php
session_start();
include 'config.php';
echo '<p>Your money: $' . userdata($_SESSION['user']['user_id'], 'money', $dbc) . '</p>';