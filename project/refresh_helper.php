<?php
session_start();
include_once 'config.php';
sleep(1);
deletearmy();
deletebuilding();
header("Location: index.php");