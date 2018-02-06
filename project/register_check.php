<?php
session_start();
$v='1';
include 'config.php';
//$error=array();
$user_name=$_POST['username'];
$user_pass= $_POST['pass'];
$user_realname=$_POST['realname'];
$user_email= $_POST['email'];
$sql="SELECT * FROM users WHERE email='".$user_email."'";
$checkemail=  mysqli_query($dbc, $sql);

$sql2="SELECT * FROM users WHERE user_name='".$user_name."'";
$checkusername=  mysqli_query($dbc, $sql2);

$checknamenum=mysqli_num_rows($checkusername);

$checkemailnum=mysqli_num_rows($checkemail);

if($checkemailnum==1){
    $error[]='<p>Този емайл се използва</p>';
}
if($checknamenum==1){
    $error[]='<p>Има такова потребителско име</p>';
}

if(@count($error)>0){
    foreach ($error as $er){
        echo $er;
    }
    //echo 'a';
    exit;
}else{
   // echo 'inset';
    $sql3="INSERT INTO `users`(`user_name`, `real_name`, `email`, `pass`) VALUES ('".$user_name."','".$user_realname."','".$user_email."','".$user_email."')";

mysqli_query($dbc, $sql3);
$_SESSION['islogget']=true;
$v='0';
 echo ' ВИЕ СЕ РЕГИСТРИРАХТЕ УСПЕШНО В НАШАТА ИГРА ЦИКНИ ТАМ ЗА ДА ИГРАЕШ -><a href="index.php">ЦЪКНИ МЕ</a> ';
}


