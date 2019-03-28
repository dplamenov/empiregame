<?php
session_start();
include "../config.php";
if ($_SESSION['is_log'] != true) {
    header("Location: ../index.php");
    exit;
}

echo "Welcome, admin ";
echo '<a href="logout.php">Log out</a>';

echo "<h1>List of all users:</h1>";
$get_all_user_sql = "SELECT * FROM `users`";
$get_all_user = mysqli_query($dbc, $get_all_user_sql);
echo '<table><tr><td>User id</td><td>Username</td><td>Real name</td><td>Email</td><td>Password</td><td>Money</td><td>Xp</td><td>Active</td></tr>';
$user_count = 0;
while ($all_user = mysqli_fetch_assoc($get_all_user)) {
    $user_count++;

    if (intval($all_user['active']) == 0) {
        $active = "Not active.";
    } elseif (intval($all_user['active']) == 1) {
        $active = "Active.";
    } else {
        $active = "Error!";
    }

    $all_user['pass'] = str_repeat("*", 8);
    echo '<tr><td>' . $all_user['user_id'] . '</td><td>' . $all_user['user_name'] . '</td><td>' . $all_user['real_name'] . '</td>
<td>' . $all_user['email'] . '</td><td>' . $all_user['pass'] . '</td><td>' . $all_user['money'] . '</td><td>' . $all_user['xp'] . '</td>
<td>' . $active . '</td></tr>';
}
echo '</table>';
$build_count = 0;
echo "<h1>List of all building:</h1>";

$get_all_building = mysqli_query($dbc, "SELECT * FROM `building`");
echo '<table><tr><td>Building Name</td><td>Cost Money</td><td>Time in Minutes</td><td>Id</td><td>Geo Id</td><td>Geo Location</td></tr>';
while ($all_building = mysqli_fetch_assoc($get_all_building)) {
    $build_count++;
    echo '<tr><td>' . $all_building['build_name'] . '</td><td>' . $all_building['money'] . '</td><td>' . $all_building['time'] . '</td>
<td>' . $all_building['building_id'] . '</td><td>' . $all_building['geo_id'] . '</td><td>' . $all_building['geo_location'] . '</td></tr>';
}
echo '</table>';