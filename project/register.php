<?php
session_start();
include 'config.php';
$title = 'Register';
include 'layout/header.php';
?>
<div class="header">GREAT EMPIRE</div>

<div class="info"></div>
<div class="rightbar"></div>
<div id="form">
    <div><input type="text" placeholder="Username" id="username"/></div>
    <div><input type="password" placeholder="Password" id="pass"/></div>
    <div><input type="text" placeholder="Real name" id="realname"/></div>
    <div><input type="text" placeholder="Email" id="email"/></div>
    <div id="register">
        <button id="btn">Регистирай се</button>
    </div>
    <div id="error" style="color: black"></div>
</div>
<?php
include 'layout/footer.php';
?>