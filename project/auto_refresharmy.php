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

function getArmyById(\Database\PDODatabase $database, int $user_id, int $army_id, \system\Service\armyService $armyService): string
{
    $army = $armyService->trainingArmyByUser($user_id, $army_id);
    if (date("H:i:s", ($army->getEndTime() - time() - 7200)) == "00:00:00") {
        return 1;
    }
    return date("H:i:s", ($army->getEndTime() - time() - 7200));
}

if (@$_POST['getCount'] == true) {
    echo getCount($database, $armyRepository, $armyService);
}
if (isset($_POST['id'])) {
    $id = trim($_POST['id']);
    echo getArmyById($database, $_SESSION['user']['user_id'], $id, $armyService);
}