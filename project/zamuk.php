<?php
session_start();
include 'config.php';
echo '<div>';
//echo '<p>Вашите пари: ' . userdata($_SESSION['user']['user_id'], 'money',$dbc) . 'лева</p>';
echo '<p style="margin-left: 40%">Castle</p>';
echo '<button type="button" class="btn btn-danger" style="margin-left: auto; margin-right: auto"><a href="?find_opponent=1">Find opponent</a></button>';
?>
<br>
<span style="display: block">Attack specific user</span>
<input type="text" name="user" id="name"/>
<button type="button" class="btn btn-danger">Attack</button>
</div>

