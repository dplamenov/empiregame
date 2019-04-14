<?php
session_start();
include 'config.php';
$getbuild_sql = "SELECT * FROM building";
$get_build_q = mysqli_query($dbc, $getbuild_sql);
echo '<p>Your money: $' . userdata($_SESSION['user']['user_id'], 'money', $dbc) . '</p>';

echo '<p>Town hall</p>';
echo '<table border="1"><tr><td>Name</td><td>Money</td><td>Време</td><td>Построй</td></tr>';
while ($building = mysqli_fetch_assoc($get_build_q)) {
    if (userdata($_SESSION['user']['user_id'], 'money', $dbc) >= $building['money']) {
        $link = '<a href="?build=' . $building['building_id'] . '">Build</a>';
        $class = 'ok';
    } else {
        $link = 'Нямаш пари';
    }
    echo '<tr><td>' . ucfirst($building['build_name']) . '</td><td>$' . $building['money'] . '</td><td>' . $building['time'] . ' Min</td><td>' . $link . @$link2 . '</td></tr>';
}
echo '</table>';