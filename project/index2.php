<?php
if (!file_exists('setup/database.php')) {
    header('Location: setup/index.php');
}
include 'config.php';
if (ob == 'yes') {
    ob_start();
}
if (@$_SESSION['islogged'] === true) {
    deletebuilding($dbc);
    deletearmy($dbc);
    upgrade_army($dbc);
    include 'layout/logged.php';
} else {

}