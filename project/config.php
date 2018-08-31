<?php
define('ob','no');
mb_internal_encoding('UTF-8');

date_default_timezone_set('Europe/Sofia');
//database config



$dbc = mysqli_connect('localhost', 'digia_empire', '21282128', 'digia_greatempire');
mysqli_set_charset($dbc, 'utf8');
function deletebuilding() {
    $dbc = mysqli_connect('localhost', 'digia_empire', '21282128', 'digia_greatempire');
    $sega = time();
    $sql = "SELECT * FROM building_now WHERE end_time <'" . $sega . "'";
    $get_finished = mysqli_query($dbc, $sql);
    $get_finish_builing_n = mysqli_num_rows($get_finished);
    if ($get_finish_builing_n >= 1) {
        while ($x = mysqli_fetch_assoc($get_finished)) {
            $get_build_id = "SELECT * FROM building_now WHERE user_id='".$_SESSION['user']['user_id']."'";
          
            $r2 = mysqli_query($dbc, $get_build_id);
            $r2a = mysqli_fetch_assoc($r2);
            $bid = $x['building_id'];
            $userid = $x['user_id'];
            $select_build_sql = "SELECT * FROM building WHERE building_id ='" . $bid . "'";
            $select_build_q = mysqli_query($dbc, $select_build_sql);
            $select_build_a = mysqli_fetch_assoc($select_build_q);
            $givexp = $select_build_a['give_xp'];
            mysqli_query($dbc, "UPDATE users SET xp  = xp +'" . $givexp . "' WHERE user_id='" . $userid . "'");
            $countub = mysqli_query($dbc, "SELECT * FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "' AND  building_id='" . $r2a['building_name'] . "'");
            if (mysqli_num_rows($countub) == 0) {
                $select_build_lv = "INSERT INTO users_building (user_id,building_id,build_lv) VALUES ('" . $_SESSION['user']['user_id'] . "','" . $r2a['building_name'] . "','1')";
              
                mysqli_query($dbc, $select_build_lv);
            } else {
                $lv = mysqli_query($dbc, "SELECT build_lv FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "' AND  building_id='" . $r2a['building_name'] . "'");
                $lva = mysqli_fetch_assoc($lv);
                $lva['build_lv'];
                $sql_update_u_l = "UPDATE users_building SET build_lv  = build_lv +'1' WHERE user_id='" . $userid . "'";
               
                $lv = mysqli_query($dbc, $sql_update_u_l);
            }
        }
        $sql_delete = "DELETE FROM building_now WHERE `end_time` < '" . $sega . "'";
        
        mysqli_query($dbc, $sql_delete);
    }
    
}
function deletearmy() {
    $dbc = mysqli_connect('localhost', 'digia_empire', '21282128', 'digia_greatempire');
    $sega = time();
    $sql = "SELECT * FROM army_now WHERE end_time <'" . $sega . "'";
    $get_finished_army = mysqli_query($dbc, $sql);
    $get_finish_army = mysqli_num_rows($get_finished_army);
    if ($get_finish_army >= 1) {
        while ($x = mysqli_fetch_assoc($get_finished_army)) {
            $get_army_id = "SELECT * FROM army_now WHERE user_id='".$_SESSION['user']['user_id']."'";
          
            $r2a = mysqli_query($dbc, $get_army_id);
            $r2aa = mysqli_fetch_assoc($r2a);
            $bida = $x['army_name'];
            $count = $x['army_num'];
            $userid = $x['user_id'];
            $select_army_sql = "SELECT * FROM army WHERE army_name ='" . $bida . "'";
            $select_army_q = mysqli_query($dbc, $select_army_sql);
            $select_army_a = mysqli_fetch_assoc($select_army_q);
            $givexp = $select_army_a['give_xp'];
            mysqli_query($dbc, "UPDATE users SET xp  = xp +'" . $givexp . "' WHERE user_id='" . $userid . "'");
            $countub = mysqli_query($dbc, "SELECT * FROM user_army WHERE user_id='" . $_SESSION['user']['user_id'] . "' AND  army_name='" . $r2aa['army_name'] . "'");
            if (mysqli_num_rows($countub) == 0) {
                $select_build_lv = "INSERT INTO user_army (user_id,army_name,count) VALUES ('" . $_SESSION['user']['user_id'] . "','" . $r2aa['army_name'] . "','".$count."')";
              echo $select_build_lv;
                mysqli_query($dbc, $select_build_lv);
            } else {
                $lv = mysqli_query($dbc, "SELECT lvl FROM user_army WHERE user_id='" . $_SESSION['user']['user_id'] . "' AND  army_name'" . $r2aa['army_name'] . "'");
                $lva = mysqli_fetch_assoc($lv);
                $lva['build_lv'];
                $sql_update_u_l = "UPDATE user_army SET lvl  = lvl +'1' WHERE user_id='" . $userid . "'";
               
                $lv = mysqli_query($dbc, $sql_update_u_l);
            }
        }
        $sql_delete = "DELETE FROM army_now WHERE `end_time` < '" . $sega . "'";
        
        mysqli_query($dbc, $sql_delete);
    }
    
}



function userdata($id, $param) {
    $dbc = mysqli_connect('localhost', 'digia_empire', '21282128', 'digia_greatempire');
    $g = mysqli_query($dbc, "SELECT * FROM users WHERE user_id='$id'");
    $r = mysqli_fetch_assoc($g);
    return $r[$param];
   
}

function refresh($time, $url = "") {
    echo "<meta http-equiv=\"refresh\" content=\"" . $time . ";url=" . $url . "\">";
}
