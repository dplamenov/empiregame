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

    echo '<script src="js/battle.js"></script>';
    try {
        $battle->battle($dbc, intval($_SESSION['user']['user_id']));
    } catch (Exception $exception) {
        echo '<script>alert("' . $exception->getMessage() . '")</script>';
        echo '<script>window.location.href= "index.php"</script>';
    }
}
//ToDo Remove when auto refresh will be ready,
upgrade_army($dbc);
include_once 'layout/header.php';
?>
<div id="error">

</div>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                console.log(data);
            });
        });
    });

</script>
<?php
if (@$_SESSION['islogged'] === TRUE) {

    deletebuilding($dbc);
    deletearmy($dbc);
    echo '<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />';
    echo '<link rel="apple-touch-icon" href="apple.png">';
    echo '<script src="js/javascript.js"></script>';

} else {
    echo '<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>';
    echo '<link rel="apple-touch-icon" href="apple.png">';
    echo '</head>';

    include_once 'layout/loginform.php';
    exit;
}
?>
<title>Empire game</title>
</head>
<body style=" background: #cccccc;">

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

            $is_now_build = '<p>Already build</p>';
            unset($_GET);
        }
    }
}
?>
<div id="header"><p>Hello, <?php echo $_SESSION['user']['user_name'] . '</br><a href="logout.php">Log out</a>' ?></p>
    <div>

        <a href="settings.php">Profile</a>
    </div>
</div>
<div id="info">
    <div id="servertime">Server time <?php echo date('H:i:s'); ?></div>
</div>
<div id="rightbar" style="padding: 5px;height: 400px;">
    <?php
    $level = mysqli_query($dbc, "SELECT * FROM `levels` WHERE " . userdata($_SESSION['user']['user_id'], 'xp', $dbc) . " BETWEEN from_xp and to_xp");
    $level = mysqli_fetch_assoc($level)['level_id'];
    echo '<p>Your  money: $' . userdata($_SESSION['user']['user_id'], 'money', $dbc) . '</p>';
    echo '<span style="display: block">Level ' . $level . ' / XP: ' . userdata($_SESSION['user']['user_id'], 'xp', $dbc) . 'xp</span>';
    echo '<span>Population: ' . userdata($_SESSION['user']['user_id'], 'people', $dbc) . '</span><br>';

    echo @$is_now_build;
    ?>

</div>
<div id="content" style="padding-bottom: auto">

    <img src="images/map.jpg" alt="" usemap="#Map"/><br>
    <div><img src="images/global.png" alt=""/></div>
    <?php

    $user_building = "SELECT * FROM building_now WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
    $get_now_user_build = mysqli_query($dbc, $user_building);
    if (mysqli_num_rows($get_now_user_build) >= 1) {
        echo '<p>You are building:</p>';
        echo '<table>';
        echo '<table border="1">';
        echo '<tr><td>Build</td><td>Level</td><td>Will be ready after:</td></tr>';
        while ($get_now_user_buildb = mysqli_fetch_assoc($get_now_user_build)) {
            $select_build_name_from_id_sql = "SELECT * FROM building WHERE building_id='" . $get_now_user_buildb['building_name'] . "'";
            $select_build_name_from_id = mysqli_query($dbc, $select_build_name_from_id_sql);
            $select_build_name_from_idarray = mysqli_fetch_assoc($select_build_name_from_id);

            $level = mysqli_query($dbc, "SELECT build_lv FROM users_building WHERE user_id = " . $_SESSION['user']['user_id'] . " and building_id = " . $get_now_user_buildb['building_name']);
            $level = mysqli_fetch_assoc($level)['build_lv'] + 1;
            echo '<tr><td>' . ucfirst($select_build_name_from_idarray['build_name']) . '</td><td>' . $level . '</td><td id="build_' . $get_now_user_buildb['building_name'] . '">' . date('H:i:s', $get_now_user_buildb['end_time'] - time() - 7200) . '</td></tr>';
        }
        echo '</table>';
    }


    $sql_get_now_user_army = "SELECT * FROM `army_now` WHERE `user_id` = " . $_SESSION['user']['user_id'];
    $get_now_user_army = mysqli_query($dbc, $sql_get_now_user_army);

    if (mysqli_num_rows($get_now_user_army) >= 1) {
        echo "<br>";
        echo "<span>Now train</span>";
        echo '<table>';
        echo '<table border="1">';
        echo '<tr><td>Army</td><td>Count</td><td>Will be ready after:</td></tr>';
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

    $user_build_data = mysqli_query($dbc, "SELECT * FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "'");
    if (mysqli_num_rows($user_build_data) >= 1) {
        echo '<br>';
        echo '<span>Your building</span>';
        echo '<table border="1" id="ready_build">';
        echo '<tr><td>Build</td><td>Level</td></tr>';

        while ($u_army = mysqli_fetch_assoc($user_build_data)) {
            $get_build_name_by_id = "SELECT * FROM building WHERE building_id='" . $u_army['building_id'] . "' ";
            $get_build_name_by_id = mysqli_query($dbc, $get_build_name_by_id);
            $build = mysqli_fetch_assoc($get_build_name_by_id);
            echo '<tr><td>' . ucfirst($build['build_name']) . '</td><td>' . $u_army['build_lv'] . '</td></tr>';
        }
        echo '</table>';
    }

    echo "<br>";


    $user_army = "SELECT * FROM user_army WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
    $user_army = mysqli_query($dbc, $user_army);
    if (mysqli_num_rows($user_army) >= 1) {
        echo '<span>Your army</span>';
        echo '<table border="1" id="ready_army">';
        echo '<tr><td>Army</td><td>Count</td><td>Level</td><td>Upgrade</td><td>Delete</td></tr>';

        while ($u_army = mysqli_fetch_assoc($user_army)) {

            $armyname = "SELECT * FROM army WHERE army_id='" . $u_army['army_name'] . "' ";
            $armyname = mysqli_query($dbc, $armyname);
            $army_name = mysqli_fetch_assoc($armyname);
            echo '<tr><td>' . $army_name['army_name'] . '</td><td>' . $u_army['count'] . '</td><td>'.$u_army['lvl'].'</td>
<td onclick="upgrade_army('.$u_army['army_id'].')">Upgrade</td><td onclick="delete_army('.$u_army['army_id'].')">Delete</tr>';
        }


        echo '</table><br>';
    }
    $upgrade_army = mysqli_query($dbc, "SELECT * FROM upgrade_army LEFT JOIN user_army ON user_army.army_name = upgrade_army.army_name WHERE user_army.user_id = " . $_SESSION['user']['user_id']);
    if(mysqli_num_rows($upgrade_army) >= 1){
        echo '<span>You upgrade that army:</span>';
        echo '<table border="1" id="upgrade_army">';
        echo '<tr><td>Army</td><td>Count</td><td>Level</td><td>Will be ready after:</td></tr>';
        while ($army = mysqli_fetch_assoc($upgrade_army)) {

            $_army = "SELECT * FROM army WHERE army_id='" . $army['army_name'] . "' ";
            $_army = mysqli_query($dbc, $_army);
            $army_name = mysqli_fetch_assoc($_army)['army_name'];

            $end_time = $army['end'] - time();
            $end_time = date("H:i:s", $end_time - 7200);
            echo '<tr><td>' . $army_name . '</td><td>' . $army['count'] . '</td><td>'.$army['level'].'</td><td id="_army_upgrade'.$army['army_id'].'">'. $end_time .'</td>
</tr>';

        }

        echo '</table>';
    }
    ?>
    <div id="text"></div>
</div>

<map name="Map" id="Map">
    <area alt="" title="" id="townhall" href="#" shape="rect" coords="377,264,274,216"/>
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
        echo 'You are training army.';
    }
    ?>
</map>
</body>
</html>