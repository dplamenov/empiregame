<?php
session_start();
include 'config.php';
  echo '<p>Вашите пари:' . userdata($_SESSION['user']['user_id'], 'money') . 'лева</p>';
echo '<p>Дворец</p>';

