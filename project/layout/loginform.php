<title>Empiregame Login</title>
<div class="header"><h1 style="margin-top: 10px">Logo</h1></div>

<div class="info">
    <div id="servertime">Server time <?php echo date('H:i:s'); ?></div>
    <div id="error_login" class="alert-danger"></div>

</div>
<div class="rightbar">
    <ul style="text-decoration: none">

    </ul>

</div>
<div id="form">

    <div><input type="text" placeholder="Username" id="username"/></div>
    <div><input type="password" placeholder="Password" id="pass"/></div>
    <div id="register">
        <a id="login" class="btn btn-primary" href="#">
            Log in
        </a>

        <a id="registration" class="btn btn-primary" href="register.php">
            Register
        </a>
    </div>

</div>