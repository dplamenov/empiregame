<?php
session_start();
include 'config.php';
$getbuild_sql="SELECT * FROM building";
$get_build_q=  mysqli_query($dbc, $getbuild_sql);
echo '<p>Your money:' . userdata($_SESSION['user']['user_id'], 'money') . 'Euro</p>';

echo '<p>Сграда Център</p><p>All times are in minutes</p>';
echo '<table border="1"><tr><td>Име на сградата</td><td>Пари</td><td>Време</td><td>Построй</td></tr>';
while ($building=  mysqli_fetch_assoc($get_build_q)) {
    if(userdata($_SESSION['user']['user_id'], 'money')>=$building['money']){
        $link='<a href="?build='.$building['building_id'].'">Построй</a>';
        
$class='ok';    
}else{
    $link='Нямаш пари';
//$link2 = $building['money']-$_SESSION['user']['money'].'<br>';

}


echo '<tr><td>'.$building['build_name'].'</td><td>'.$building['money'].' Лева</td><td>'.$building['time'].' Мин</td><td>'.$link . @$link2.'</td></tr>';}
echo '</table>';
