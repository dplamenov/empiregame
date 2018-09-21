<?php
session_start();
include_once 'config.php';
if($_SESSION['islogged'] == true){
    $title = "User Settings";
    $stylesheet = "css/settings.css";
    $user_id = $_SESSION['user']['user_id'];
    $username = $_SESSION['user']['user_name'];
    $money = userdata($_SESSION['user']['user_id'],'money',$dbc);
    $xp = userdata($_SESSION['user']['user_id'],'xp',$dbc);

    if(isset($_POST['oldpassword'])){
        foreach ($_POST as $key=>$value){
            $$key = trim($value);
        }

        if($newpasasword  == $repeat && mb_strlen($newpasasword) >= 8){
            $oldpassword = mysqli_real_escape_string($dbc,$oldpassword);
            $newpasasword = mysqli_real_escape_string($dbc,$newpasasword);
            $repeat = mysqli_real_escape_string($dbc,$repeat);

            $sql = "SELECT * FROM `users` WHERE `user_id` = '".$user_id."' AND `pass` = ". $oldpassword;
            $r = mysqli_query($dbc,$sql);
            if(mysqli_num_rows($r) == 1){
                mysqli_query($dbc,"UPDATE `users` SET `pass` = '".$newpasasword."' WHERE `user_id` = ".$user_id);
                echo "Ready";
            }elseif (mysqli_num_rows($r) == 0){
                echo 'Password is not valid.';
            }
        }else{
            echo 'Password is not valid.';
        }
    }
    include "settings_theme.php";
}else{
    header("Location: error.php");
}