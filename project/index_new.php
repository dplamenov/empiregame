<?php

if (!file_exists('setup/database.php')) {
    header('Location: setup/index.php');
}
include 'config.php';
if (ob == 'yes') {
    ob_start();
}

$user = new \system\DTO\UserDTO();

session_start();
if (isset($_GET['find_opponent']) and $_GET['find_opponent'] == 1) {
    $battle = new \system\Battle();

    echo '<script src="js/battle.js"></script>';
    try {
        $battle->battle($dbc, intval($_SESSION['user']['user_id']));
    } catch (Exception $exception) {
        echo '<script>alert("' . $exception->getMessage() . '")</script>';
        echo '<script>window.location.href= "index.php"</script>';
    }
}

if (!file_exists('setup/database.php')) {
    header('Location: setup/index.php');
}

if (ob == 'yes') {
    ob_start();
}
if (@$_SESSION['islogged'] === true) {
    deletebuilding($dbc);
    deletearmy($dbc);
    upgrade_army($dbc);

    if (isset($_GET['build'])) {
        $build_id = (int)$_GET['build'];
        $check_build_sql = "SELECT * FROM building WHERE building_id='" . $build_id . "'";
        $check_build = mysqli_query($dbc, $check_build_sql);
        $now_build = mysqli_fetch_assoc($check_build);
        $build_time = $now_build['time'];
        $time_now = time();

        $end_time = ($time_now + $build_time * 60);

        if (mysqli_num_rows($check_build) == 1) {

            $sql_get_users_now_build = "SELECT * FROM building_now WHERE user_id='" . $_SESSION['user']['user_id'] . "' AND building_name='" . $build_id . "' AND end_time > '" . $time_now . "'";
            $get_users_now_build = mysqli_query($dbc, $sql_get_users_now_build);
            $num_rows = mysqli_num_rows($get_users_now_build);
            if ($num_rows == 0) {

                $sql_remove_money = "UPDATE users SET money = money-'" . $now_build['money'] . "'WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
                mysqli_query($dbc, $sql_remove_money);
                $add_build_sql = "INSERT INTO building_now (user_id,building_name,end_time) VALUES ('" . $_SESSION['user']['user_id'] . "','" . $build_id . "','" . $end_time . "')";
                mysqli_query($dbc, $add_build_sql);
                unset($_GET['build_id']);
                refresh(0, "./");

            } else {

                $is_now_build = '<p>Already build</p>';
                unset($_GET);
            }
        }
    }

    $title = 'Empire game | Home page';
    include 'layout/header.php';
    include 'layout/logged.php';
    include 'layout/footer.php';
} else {
    $title = 'Empire game | Login';
    include 'layout/header.php';
    include 'layout/loginform.php';
    include 'layout/footer.php';
}