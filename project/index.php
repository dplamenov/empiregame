<?php

if (!file_exists('setup/database.php')) {
    header('Location: setup/index.php');
}
include 'config.php';

if (ob == 'yes') {
    ob_start();
}
session_start();

if (isset($_GET['find_opponent']) and $_GET['find_opponent'] == 1) {
    $battle = new \system\Battle();

    try {
        $battle->battle($dbc, intval($_SESSION['user']['user_id']));
    } catch (Exception $exception) {
        echo '<script>alert("' . $exception->getMessage() . '")</script>';
        echo '<script>window.location.href= "index.php"</script>';
    }
}

include_once 'layout/header.php';
?>
<meta charset="UTF-8">
<script type="text/javascript">
    $(document).ready(function () {

        function refresh() {
            $.ajax({
                url: 'auto_refreshservertime.php',
            }).done(function (data) {
                $("#servertime").html("Server time " + data);
            });
        }

        setInterval(function () {
            refresh()
        }, 1000);

        $('#login').click(function () {

            $.ajax({
                url: 'login.php',
                data: {
                    username: $('#username').val(),
                    pass: $('#pass').val()
                },
                type: 'post',
            }).done(function (data) {
                if (data == 'error') {
                    $('#error').text("Wrong username or password");
                } else {
                    window.location.reload(true);
                }

            }).fail(function (er) {
            }).always(function () {
            });
        });
    });

</script>
<?php
if (@$_SESSION['islogged'] === TRUE) {

    deletebuilding($dbc);
    deletearmy($dbc);
    echo '<script src="js/javascript.js"></script>';

} else {
    echo '</head>';
    include_once 'layout/loginform.php';

    exit;
}
?>
<title>Empire game</title>
</head>
<body>

<?php


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

            $is_now_build = '<p>Вече строиш</p>';
            unset($_GET);
        }
    }
}
?>

<div id="header"><p>Здравей, <?php echo $_SESSION['user']['user_name'] . '</br><a href="logout.php">Изход</a>' ?></p>
    <div>

        <a href="settings.php">Настройки на профила</a>
    </div>
</div>
<div id="info">
    <div id="servertime">Server time <?php echo date('H:i:s'); ?></div>
</div>
<div id="rightbar"><?php
    echo '<p>Вашите пари:  ' . userdata($_SESSION['user']['user_id'], 'money', $dbc) . 'лева</p>';
    echo '<p>XP: ' . userdata($_SESSION['user']['user_id'], 'xp', $dbc) . 'xp</p><br>';
    echo @$is_now_build;
    ?>

</div>
<div id="content">

    <img src="images/map.jpg" alt="" usemap="#Map"/><br>
    <div><img src="images/global.png"/></div>
    <?php


    $sql_get_now_user_build = "SELECT * FROM building_now WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
    $get_now_user_build = mysqli_query($dbc, $sql_get_now_user_build);
    if (mysqli_num_rows($get_now_user_build) >= 1) {
        echo '<p>Сега строиш</p>';
        echo '<table>';
        echo '<table border="1">';
        echo '<tr><td>Сграда</td><td>Ниво(Скоро)</td><td>Ще бъде готово в</td></tr>';
        while ($get_now_user_buildb = mysqli_fetch_assoc($get_now_user_build)) {
            $select_build_name_from_id_sql = "SELECT * FROM building WHERE building_id='" . $get_now_user_buildb['building_name'] . "'";
            $select_build_name_from_id = mysqli_query($dbc, $select_build_name_from_id_sql);
            $select_build_name_from_idarray = mysqli_fetch_assoc($select_build_name_from_id);

            echo '<tr><td>' . $select_build_name_from_idarray['build_name'] . '</td><td>Ниво(Скоро)</td><td id="build_' . $get_now_user_buildb['building_name'] . '">' . date('H:i:s', $get_now_user_buildb['end_time'] - time() - 7200) . '</td></tr>';
        }
        echo '</table>';
    }


    $sql_get_now_user_army = "SELECT * FROM `army_now` WHERE `user_id` = " . $_SESSION['user']['user_id'];
    $get_now_user_army = mysqli_query($dbc, $sql_get_now_user_army);

    if (mysqli_num_rows($get_now_user_army) >= 1) {
        echo "<br>";
        //echo "<br>";
        echo "<span>Сега тренираш</span>";
        echo '<table>';
        echo '<table border="1">';
        echo '<tr><td>Армия</td><td>Брой</td><td>Остава още</td></tr>';
        $counter = 0;
        while ($army_now = mysqli_fetch_assoc($get_now_user_army)) {
            $army_name = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT `army_name` FROM `army` WHERE `army_id` = " . $army_now['army_name']))['army_name'];
            date_default_timezone_set('Europe/Sofia');
            $end_time = $army_now['end_time'] - time();
            $end_time = date("H:i:s", $end_time - 7200);
            echo "<tr><td>" . $army_name . "</td><td>" . $army_now['army_num'] . "</td><td id='army_" . $army_now['army_name'] . "'>" . $end_time . "</td></tr>";
        }

        echo "</table>";
        echo "<br>";


    }


    $user_build_data = "SELECT * FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
    $user_build_data_r = mysqli_query($dbc, $user_build_data);
    if (mysqli_num_rows($user_build_data_r) >= 1) {
        echo '<br>';
        echo '<span>Твоите сгради</span>';
        echo '<table border="1">';
        echo '<tr><td>Сграда</td><td>Ниво</td></tr>';

        while ($xv = mysqli_fetch_assoc($user_build_data_r)) {
            $get_build_name_by_id_sql = "SELECT * FROM building WHERE building_id='" . $xv['building_id'] . "' ";
            $xva = mysqli_query($dbc, $get_build_name_by_id_sql);
            $xvaa = mysqli_fetch_assoc($xva);
            echo '<tr><td>' . $xvaa['build_name'] . '</td><td>' . $xv['build_lv'] . '</td></tr>';
        }
        echo '</table>';
    }

    echo "<br>";


    $user_army_data = "SELECT * FROM user_army WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
    $user_army_data_r = mysqli_query($dbc, $user_army_data);
    if (mysqli_num_rows($user_army_data_r) >= 1) {
        echo '<span>Твоята армия</span>';
        echo '<table border="1">';
        echo '<tr><td>Армия</td><td>Брой</td></tr>';

        while ($xv = mysqli_fetch_assoc($user_army_data_r)) {

            $get_build_name_by_id_sql = "SELECT * FROM army WHERE army_id='" . $xv['army_name'] . "' ";
            $xva = mysqli_query($dbc, $get_build_name_by_id_sql);
            $xvaa = mysqli_fetch_assoc($xva);
            $all_user_army[][$xvaa['army_id']] = $xv['count'];
            echo '<tr><td>' . $xvaa['army_name'] . '</td><td>' . $xv['count'] . '</td></tr>';
        }


        echo '</table>';
    }

    ?>
    <div id="text"></div>
</div>

<map name="Map" id="Map">
    <area alt="" title="" id="sgradacentur" href="#" shape="rect" coords="307,351,226,272"/>
    <?php
    deletebuilding($dbc);
    $sql_get_users_build_area = "SELECT * FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
    $get_users_build_area = mysqli_query($dbc, $sql_get_users_build_area);
    while ($get_users_build_area_array = mysqli_fetch_assoc($get_users_build_area)) {
        $sql_get_build_area = "SELECT * FROM building WHERE building_id='" . $get_users_build_area_array['building_id'] . "'";
        $get_build_area = mysqli_query($dbc, $sql_get_build_area);
        $get_build_area_array = mysqli_fetch_assoc($get_build_area);
        echo '<area alt="" title="" id="' . $get_build_area_array['geo_id'] . '" href="#" shape="' . $get_build_area_array['shape'] . '" coords="' . $get_build_area_array['geo_location'] . '" />';
    }
    ?>
    <?php
    if (isset($_GET['army'])) {
        echo 'Тренираш армия';
    }
    ?>
</map>
</body>
</html>