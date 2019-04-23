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
                    $('#er').html('Invalid army count');
                }
            });
        });

    </script>
<?php

echo '<p>Your Money: $' . userdata($_SESSION['user']['user_id'], 'money', $dbc) . '</p>';
echo '<p>Barrack - train soldiers</p>';
echo '<p>The maximum number of soldiers you can train at one time is 240</p>';
echo '<p>Write how many soldiers you want to train and choose a look</p>';
$barrack_level = "SELECT build_lv FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "' AND building_id='1'";
$barrack_level = mysqli_query($dbc, $barrack_level);
$barrack_level = mysqli_fetch_assoc($barrack_level);
$barrack_level = $barrack_level['build_lv'];
$getarmy_sql = "SELECT * FROM army WHERE army_level<='" . $barrack_level . "'";
$get_army_q = mysqli_query($dbc, $getarmy_sql);

echo '<div id="armynum">
  <input id="army_num" type="text" placeholder="Count" />
</div>';

echo '<table border="1" id="army" style="width: 100%"><tr><td>Type</td><td>Money</td><td>Time</td><td>Train</td></tr>';
while ($army = mysqli_fetch_assoc($get_army_q)) {
    if (userdata($_SESSION['user']['user_id'], 'money', $dbc) >= $army['money']) {
        $link = '<a class="army' . $army['army_id'] . '" href="#">Train</a>';
        $class = 'ok';
    } else {
        $link = 'No money';
    }


    echo '<tr><td>' . $army['army_name'] . '</td><td>$' . $army['money'] . '</td><td>' . $army['time'] . '</td><td>' . $link . '</td></tr>';
}
echo '</table>';
echo '<div id="er"></div>';