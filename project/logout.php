<?php
session_start();
$_SESSION['islogged']=false;
session_destroy();
header('Location: index.php');
exit;
