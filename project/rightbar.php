<?php
session_start();
include_once 'config.php';
echo '<p>Вашите пари:  ' . userdata($_SESSION['user']['user_id'], 'money', $dbc) . 'лева</p>';
echo '<p>XP: ' . userdata($_SESSION['user']['user_id'], 'xp', $dbc) . 'xp</p><br>';