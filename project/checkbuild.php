<?php
session_start();
include 'config.php';
$getbuild_sql="SELECT * FROM building";
$get_build_q=  mysqli_query($dbc, $getbuild_sql);
echo '<p>Your money:' . userdata($_SESSION['user']['user_id'], 'money') . 'Euro</p>';

echo '<p>Town hall</p><p>All times are in minutes</p>';
echo '<table><tr><td>Build name</td><td>Money</td><td>Time</td><td>Build</td></tr>';
while ($building=  mysqli_fetch_assoc($get_build_q)) {
    if(userdata($_SESSION['user']['user_id'], 'money')>=$building['money']){
        $link='<a href="?build='.$building['building_id'].'">Build</a>';
        
$class='ok';    
}else{
    $link='No money';
//$link2 = $building['money']-$_SESSION['user']['money'].'<br>';

}


echo '<tr><td>'.$building['build_name'].'</td><td>'.$building['money'].' Euro</td><td>'.$building['time'].' Min</td><td>'.$link . @$link2.'</td></tr>';}
echo '</table>';
