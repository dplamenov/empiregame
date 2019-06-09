<?php
session_start();

include_once "config.php";
$buildingRepository = new \system\Repository\BuildingRepository($database);
$buildingService = new \system\Service\BuildingService($buildingRepository);
function getCount($dbc): int
{
    $sql = "SELECT * FROM `building`";
    $result = mysqli_query($dbc, $sql);
    $build_count = mysqli_num_rows($result);
    return $build_count;
}

function getBuildById($dbc, int $user_id, int $id): string
{
    $sql = "SELECT * FROM `building_now` WHERE `user_id` = " . $user_id . " AND `building_name` = " . $id . " ORDER BY `end_time` DESC";
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
    echo getBuildById($dbc, $_SESSION['user']['user_id'], $id);
}