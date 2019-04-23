<?php
session_start();
include 'config.php';
if (@$_SERVER['HTTP_REFERER'] == "") {
    exit;
}
echo '<script src="js/jquery.js" type="text/javascript"></script>';
?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.army1').click(function () {
                var armynum = $('#army_num').val();
                var armyid = 1;
                if (armynum <= 240 && armynum != 0) {


                    //busnes logic to train army
                    $.ajax({
                        url: 'train_army.php',
                        type: 'POST',
                        data: {
                            armynum: armynum,
                            armyid: armyid
                        }
                    }).done(function (data) {
                        if (data != "No money.") {
                            window.location.href = "index.php";
                        }

                        $('#er').html(data);
                    });


                } else {
                    $('#er').html('Invalid army count');
                }

            });
            $('.army2').click(function () {
                var armynum = $('#army_num').val();
                var armyid = 2;
                if (armynum <= 240 && armynum != 0) {
                    $.ajax({
                        url: 'train_army.php',
                        type: 'POST',
                        data: {
                            armynum: armynum,
                            armyid: armyid
                        }
                    }).done(function (data) {
                        if (data != "No money.") {
                            window.location.href = "index.php";
                        }

                        $('#er').html(data);
                    });

                } else {
                    $('#er').html('Невалиден брой армия');
                }
            });
        });

    </script>
<?php

echo '<p>Your Money: $' . userdata($_SESSION['user']['user_id'], 'money', $dbc) . '</p>';
echo '<p>Barrack - train soldiers</p>';
echo '<p>The maximum number of soldiers you can train at one time is 240</p>';
echo '<p>Write how many soldiers you want to train and choose a look</p>';
$sql_get_kazarma_level = "SELECT build_lv FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "' AND building_id='1'";
$get_kazarma_level = mysqli_query($dbc, $sql_get_kazarma_level);
$get_kazarma_level_array = mysqli_fetch_assoc($get_kazarma_level);
$kazarma_level = $get_kazarma_level_array['build_lv'];
$getarmy_sql = "SELECT * FROM army WHERE army_level<='" . $kazarma_level . "'";
$get_army_q = mysqli_query($dbc, $getarmy_sql);

echo '<div id="armynum">
  <input id="army_num" type="text" placeholder="Брой войници / 240" />
</div>';

echo '<table border="1" id="army"><tr><td>T</td><td>Пари</td><td>Време</td><td>Тренирай</td></tr>';
while ($army = mysqli_fetch_assoc($get_army_q)) {
    if (userdata($_SESSION['user']['user_id'], 'money', $dbc) >= $army['money']) {
        $link = '<a class="army' . $army['army_id'] . '" href="#">Тренирай</a>';
        $class = 'ok';
    } else {
        $link = 'Нямаш пари';
    }


    echo '<tr><td>' . $army['army_name'] . '</td><td>' . $army['money'] . ' Лева</td><td>' . $army['time'] . ' Мин</td><td>' . $link . '</td></tr>';
}
echo '</table>';
echo '<div id="er"></div>';