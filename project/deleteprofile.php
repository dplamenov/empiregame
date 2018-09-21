<?php
session_start();

if($_SESSION['islogged'] == true){
    include "config.php";
    include_once 'deleteprofile_theme.php';



}else{
    header("Location: index.php");
    exit;
}
