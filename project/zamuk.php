<?php
session_start();
include 'config.php';
//echo '<p>Вашите пари: ' . userdata($_SESSION['user']['user_id'], 'money',$dbc) . 'лева</p>';
echo '<p style="margin-left: 40%">Замък</p>';
echo '<button type="button" class="btn btn-danger" style="margin-left: 5%"><a href="?find_opponent=1">Намери противник</a></button>';
