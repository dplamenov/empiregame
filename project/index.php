<?php
include 'config.php';
if (ob == 'yes') {
    ob_start();
}

session_start();

echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">';
echo '<link rel="stylesheet" href="style.css" />';

echo '<script src="jquery.js" type="text/javascript"></script>';
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn').click(function () {

            $.ajax({
                url: 'login.php',
                data: {
                    username: $('#username').val(),
                    pass: $('#pass').val()
                },
                type: 'post',
            }).done(function (data) {
                window.location.reload(true);

            }).fail(function (er) {
                console.log('1');
            }).always(function () {
                // console.log('d');
            });
        });
    });


</script>
<?php
if (@$_SESSION['islogged'] === TRUE) {
    deletebuilding();
    deletearmy();
//    include 'login.php';
    //echo 'ok';
} else {
    //echo 'not ok';
    ?>
    <div class="header"><img scr="logo.png"></div>

    <div class="info">Server time <?php echo date('H:i:s') ?></div>
    <div class="rightbar">
        <ul style="text-decoration: none">

        </ul>

    </div>
    <div id="form">

        <div><input type="text" placeholder="Потребителско име" id="username"/></div>
        <div><input type="password" placeholder="Парола" id="pass"/></div>
        <div id="register">
            <button type="button" id="btn" id="btn" href="#" class="btn btn-primary">Вход</button>
            <span style="color:white">или се</span>
            <button type="button" class="btn btn-primary"><a style="color:white" href="register.php">Регистрирай</a>
            </button>
        </div>

    </div>

    <?php
    exit;
}
?>
<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <script type="text/javascript"> $(document).ready(function () {


            $('#sgradacentur').click(function () {
                $.ajax({
                    url: 'checkbuild.php'

                }).done(function (data) {
                    $('#rightbar').html(data);


                });
            });

            $('#zamuk').click(function () {
                $.ajax({
                    url: 'zamuk.php'
                }).done(function (data) {
                    $('#rightbar').html(data);
                });
            });

            $('#kazarma').click(function () {
                $.ajax({
                    url: 'kazarma.php'
                }).done(function (data) {
                    $('#rightbar').html(data);
                });
            });

            $('#dvorec').click(function () {
                $.ajax({
                    url: 'dvorec.php'
                }).done(function (data) {
                    $('#rightbar').html(data);
                });
            });

            $('#content').click(function () {
                $('#rightbar').html('');
            });
            $('#header').click(function () {
                $('#rightbar').html('');
            });
            $('#info').click(function () {
                $('#rightbar').html('');
            });

        });</script>
    <title></title>
</head>
<body>
<?php
if (isset($_GET['build'])) {
    $time = time();
    $build_id = (int)$_GET['build'];
    $check_exist_build_sql = "SELECT * FROM building WHERE building_id='" . $build_id . "'";
    $check_exist_build = mysqli_query($dbc, $check_exist_build_sql);
    $now_build = mysqli_fetch_assoc($check_exist_build);
    $build_time = $now_build['time'];
    $sega = time();

    $end_time = ($sega + $build_time * 60);
    if (mysqli_num_rows($check_exist_build) == 1) {

        $sql_get_users_now_build = "SELECT * FROM building_now WHERE user_id='" . $_SESSION['user']['user_id'] . "' AND building_name='" . $build_id . "' AND end_time > '" . $sega . "'";
        $get_users_now_build = mysqli_query($dbc, $sql_get_users_now_build);
        $num_rows = mysqli_num_rows($get_users_now_build);
        if ($num_rows == 0) {

            $sql_remove_money = "UPDATE users SET money = money-'" . $now_build['money'] . "'WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
            echo $sql_remove_money;
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
</div>
<div id="info">Server time <?php echo date('H:i:s'); ?>
</div>
<div id="rightbar"><?php
    echo '<p>Вашите пари:  ' . userdata($_SESSION['user']['user_id'], 'money') . 'лева</p>';
    echo 'XP   ' . userdata($_SESSION['user']['user_id'], 'xp') . '<br>';
    echo @$is_now_build;
    ?>

</div>
<div id="content">
    <img src="MAP-DARK.jpg" alt=""  usemap="#Map"/><br><img src="global.png" />
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

            echo '<tr><td>' . $select_build_name_from_idarray['build_name'] . '</td><td>Ниво(Скоро)</td><td>' . date('H i s', $get_now_user_buildb['end_time']) . '</td></tr>';
        }
        echo '</table>';
    }


    echo '<p>Твоите сгради</p>';


    $user_build_data = "SELECT * FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
    $user_build_data_r = mysqli_query($dbc, $user_build_data);
    if (mysqli_num_rows($user_build_data_r) >= 1) {
        //  echo '<p>Сега строиш</p>';

        echo '<table border="1">';
        echo '<tr><td>Сграда</td><td>Ниво</td></tr>';

        while ($xv = mysqli_fetch_assoc($user_build_data_r)) {
            //echo '<pre>'.print_r($xv, true).'</pre>';
            $get_build_name_by_id_sql = "SELECT * FROM building WHERE building_id='" . $xv['building_id'] . "' ";
            $xva = mysqli_query($dbc, $get_build_name_by_id_sql);
            $xvaa = mysqli_fetch_assoc($xva);
            // echo $get_build_name_by_id_sql;
            echo '<tr><td>' . $xvaa['build_name'] . '</td><td>' . $xv['build_lv'] . '</td></tr>';
        }
        echo '</table>';
    } else {
//Town centre
    }
    ?>
    <div id="text"></div>
</div>

<map name="Map" id="Map">
    <area alt="" title="" id="sgradacentur" href="#" shape="rect" coords="307,351,226,272"/>
    <?php
    deletebuilding();
    $sql_get_users_build_area = "SELECT * FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
    $get_users_build_area = mysqli_query($dbc, $sql_get_users_build_area);
    while ($get_users_build_area_array = mysqli_fetch_assoc($get_users_build_area)) {
        $sql_get_build_area = "SELECT * FROM building WHERE building_id='" . $get_users_build_area_array['building_id'] . "'";
        // echo $sql_get_build_area;
        $get_build_area = mysqli_query($dbc, $sql_get_build_area);
        $get_build_area_array = mysqli_fetch_assoc($get_build_area);
//                //echo '<pre>'.print_r($get_build_area_array, true).'</pre>';
        //echo 'a';
        echo '<area alt="" title="" id="' . $get_build_area_array['geo_id'] . '" href="#" shape="rect" coords="' . $get_build_area_array['geo_location'] . '" />';
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