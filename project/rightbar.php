<?php
session_start();
include_once 'config.php';
echo '<p>Your  money: $' . userdata($_SESSION['user']['user_id'], 'money', $dbc) . '</p>';
echo '<span style="display: block">XP: ' . userdata($_SESSION['user']['user_id'], 'xp', $dbc) . 'xp</span>';
echo '<span>Population: ' . userdata($_SESSION['user']['user_id'], 'people', $dbc) . '</span><br>';