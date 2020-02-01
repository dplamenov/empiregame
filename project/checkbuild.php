<?php
include 'config.php';
$getbuild_sql = "SELECT * FROM building";
$get_build_q = mysqli_query($dbc, $getbuild_sql);
echo '<p>Your money: $' . userdata($_SESSION['user']['user_id'], 'money', $dbc) . '</p>';

echo '<p>Town hall</p>';
echo '<table id="build" border="1" style="width: 100%;"><tr><td>Name</td><td>Money</td><td>Time</td><td>Build</td></tr>';
while ($building = mysqli_fetch_assoc($get_build_q)) {
    if (userdata($_SESSION['user']['user_id'], 'money', $dbc) >= $building['money']) {
        $ifbuildexists = mysqli_query($dbc, "SELECT * FROM `users_building` WHERE user_id = " . $_SESSION['user']['user_id'] . " and building_id = " . $building['building_id']);
        if(mysqli_num_rows($ifbuildexists) > 0){
            $link = '<a style="color: green" href="?build=' . $building['building_id'] . '">Upgrade</a>';
        }else{
            $link = '<a style="color: green" href="?build=' . $building['building_id'] . '">Build</a>';
        }
    } else {
        $link = '<a href="" style="color: red">No money</a>';
    }
    echo '<tr><td>' . ucfirst($building['build_name']) . '</td><td>$' . $building['money'] . '</td><td>' . $building['time'] . ' Min</td><td>' . $link . '</td></tr>';
}
echo '</table>';