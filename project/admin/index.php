<?php
session_start();
$form_set = false;
if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $form_set = true;
}
if($form_set) {
    if ($username == "admin" && $password == "2128") {
        $_SESSION['is_log'] = true;
        header("Location: logged.php");
        exit;
    } else {
        header("Location: ../index.php");
    }
}
?>
<form method="post" action="index.php">
    <input type="text" name="username" placeholder="Username"/>
    <input type="text" name="password" placeholder="password"/>
    <input type="submit" name="submit"/>
</form>
