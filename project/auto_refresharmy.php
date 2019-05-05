<?php
session_start();

include_once "config.php";
function getCount($dbc): int
{
    //ToDo fix potential bug
    $result = mysqli_query($dbc, "SELECT * FROM `army`");
    $army_count = mysqli_num_rows($result);
    return $army_count;
}

function getArmyById($dbc, int $user_id, int $army_id): string
{
    $sql = "SELECT * FROM `army_now` WHERE `user_id` = " . $user_id . " AND `army_name` = " . $army_id . " ORDER BY `end_time` DESC";
    $a = mysqli_fetch_assoc(mysqli_query($dbc, $sql))['end_time'] - time() - 7200;
    if (date("H:i:s", $a) == "00:00:00") {
        return 1;
    }
    return date("H:i:s", $a);
}

if (@$_POST['getCount'] == true) {
    echo getCount($dbc);
}
if (isset($_POST['id'])) {
    $id = trim($_POST['id']);
    echo getArmyById($dbc, $_SESSION['user']['user_id'], $id);
}