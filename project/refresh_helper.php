<?php
session_start();
include_once 'config.php';
sleep(1);
deletearmy($dbc);
deletebuilding($dbc);
upgrade_army($dbc);
header("Location: index.php");