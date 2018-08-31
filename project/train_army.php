<?php

session_start();
include 'config.php';
$sega = time();
$army_id = (int) $_POST['armyid'];
$sql_check_exist_army = "SELECT * FROM army WHERE army_id='" . $army_id . "'";
$check_exist_army_q = mysqli_query($dbc, $sql_check_exist_army);
if (mysqli_num_rows($check_exist_army_q) == 1) {
    $sql_get_user_train_army_now = "SELECT * FROM army_now WHERE user_id='" . $_SESSION['user']['user_id'] . "' AND army_name='" . $army_id . "'";
    $get_user_train_army_now=mysqli_query($dbc, $sql_get_user_train_army_now);
    if(mysqli_num_rows($get_user_train_army_now) == 0){
        $check_exist_army_array=  mysqli_fetch_assoc($check_exist_army_q);
        $army_time_train = $check_exist_army_array['time'];
        //$end_time_army = $sega+($army_time_train*(int)$_POST['armynum']*60);
        $end_time_army = $sega + 1;
        
        $sql_train_army="INSERT INTO `army_now`(`army_name`, `user_id`, `army_num`, `end_time`) VALUES ('".$army_id."','".$_SESSION['user']['user_id']."','".(int)$_POST['armynum']."','".$end_time_army."')";
      
        if(mysqli_query($dbc, $sql_train_army)){
            
            
            unset($_GET['army']);
        }
        
        
        
    }else{
        echo 'Вече тренираш тази армия';
    }
    
} else {
    echo 'Възникна грешка презареди!';
}