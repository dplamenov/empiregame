<?php
session_start();
include_once "config.php";
function getCount($dbc): int
{
    $count = mysqli_query($dbc, "SELECT * FROM upgrade_army WHERE user_id = " . $_SESSION['user']['user_id']);
    return mysqli_num_rows($count);
}

function upgrade($dbc, $user, $id)
{
    $army = mysqli_query($dbc, "SELECT * FROM upgrade_army WHERE user_id = '" . $user . "' and army_name = " . $id . " ORDER BY `end` DESC");
    $a = mysqli_fetch_assoc($army);
    if (date("H:i:s", $a['end'] - time() - 7200 ) == "00:00:00") {
        return 1;
    }
    $result['date'] = date("H:i:s", $a['end'] - time() - 7200);
    $result['id'] = $a['army_id'];
    return json_encode($result);

}

if (@$_POST['getCount'] == true) {
    echo getCount($dbc);
}
if (isset($_POST['id'])) {
    $id = trim($_POST['id']);
    echo upgrade($dbc, $_SESSION['user']['user_id'], $id);
}