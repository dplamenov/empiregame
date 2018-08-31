<?php
include 'config.php';
$getbuild_sql="SELECT * FROM building";
$get_build_q=  mysqli_query($dbc, $getbuild_sql);
while($building=  mysqli_fetch_assoc($get_build_q)){

}