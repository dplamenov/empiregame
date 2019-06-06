<?php
session_start();

include_once "config.php";
$armyRepository = new \system\Repository\ArmyRepository($database);
$armyService = new \system\Service\ArmyService($armyRepository);
function getCount(\Database\PDODatabase $database, $armyRepository, $armyService): int
{
    $army = $armyService->allArmy();
    return iterator_count($army);
}

function getArmyById(\Database\PDODatabase $database, $dbc, int $user_id, int $army_id, \system\Service\armyService $armyService): string
{
    $armyService->trainingArmyByUser($user_id, $army_id);
    $sql = "SELECT * FROM `army_now` WHERE `user_id` = " . $user_id . " AND `army_name` = " . $army_id . " ORDER BY `end_time`";
    $a = mysqli_fetch_assoc(mysqli_query($dbc, $sql))['end_time'] - time() - 7200;
    if (date("H:i:s", $a) == "00:00:00") {
        return 1;
    }
    return date("H:i:s", $a);
}

if (@$_POST['getCount'] == true) {
    echo getCount($database);
}
if (isset($_POST['id'])) {
    $id = trim($_POST['id']);
    echo getArmyById($database, $dbc, $_SESSION['user']['user_id'], $id, $armyService);
}