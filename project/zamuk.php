<?php
session_start();
include 'config.php';
echo '<p>Вашите пари:' . userdata($_SESSION['user']['user_id'], 'money',$dbc) . 'лева</p>';
echo '<p>Замък</p>';
//TODO -> Make link with text 'Find Opponent' & make it working