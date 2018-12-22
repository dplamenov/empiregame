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
                        if (data != "Нямаш пари.") {
                            window.location.href = "index.php";
                        }

                        $('#er').html(data);
                    });


                } else {
                    $('#er').html('Невалиден брой армия');
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
                        if (data != "Нямаш пари.") {
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

echo '<p>Вашите пари:' . userdata($_SESSION['user']['user_id'], 'money', $dbc) . 'лева</p>';
echo '<p>Казарма - Тренирай войници</p>';
echo '<p>Максимум войници които можеш да тренираш на веднъж са 240</p>';
echo '<p>Напиши колко войници искаш да тренираш и избери вид</p>';
//echo '<p>Има три вида войници по сила това са - леки(10,10),тежки(15,15),елитни(25,25).<br> Във скобите е дадено атаката и защитата на единиците.<br> За леки единици се иззисгва казарма ниво 1,<br>За тежки единици се иззисгва казарма ниво 5,<br>За елитни единици се иззисгва казарма ниво 11</p>';
$sql_get_kazarma_level = "SELECT build_lv FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "' AND building_id='1'";
$get_kazarma_level = mysqli_query($dbc, $sql_get_kazarma_level);
$get_kazarma_level_array = mysqli_fetch_assoc($get_kazarma_level);
$kazarma_level = $get_kazarma_level_array['build_lv'];

//echo '<pre>'.print_r($get_kazarma_level_array, true).'</pre>';
$getarmy_sql = "SELECT * FROM army WHERE army_level<='" . $kazarma_level . "'";
$get_army_q = mysqli_query($dbc, $getarmy_sql);

echo '<div id="armynum">
  <input id="army_num"type="text" placeholder="Брой войници / 240" />
</div>';

echo '<table border="1" id="army"><tr><td>Единица</td><td>Пари</td><td>Време</td><td>Тренирай</td></tr>';
while ($army = mysqli_fetch_assoc($get_army_q)) {
    //table
    if (userdata($_SESSION['user']['user_id'], 'money', $dbc) >= $army['money']) {
        $link = '<a class="army' . $army['army_id'] . '" href="#">Тренирай</a>';

        $class = 'ok';
    } else {
        $link = 'Нямаш пари';
        //$link2 = $building['money']-$_SESSION['user']['money'].'<br>';
    }


    echo '<tr><td>' . $army['army_name'] . '</td><td>' . $army['money'] . ' Лева</td><td>' . $army['time'] . ' Мин</td><td>' . $link . @$link2 . '</td></tr>';
}
echo '</table>';
echo '<div id="er"></div>';