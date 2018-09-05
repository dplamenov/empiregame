<?php
session_start($session_config);
include 'config.php';
echo '<p>Вашите пари:' . userdata($_SESSION['user']['user_id'], 'money') . 'лева</p>';
echo '<p>Замък</p>';