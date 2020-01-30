<div class="container">
    <div class="header">
        <h1>HEADER</h1>
    </div>

    <div class="info">
        <div id="servertime">Server time <?php echo date('H:i:s'); ?></div>
        <hr>
        <div>
            Best players (week):
            <ul>
                <li>1</li>
                <li>2</li>
                <li>3</li>
                <li>4</li>
                <li>5</li>
                <li>6</li>
                <li>7</li>
                <li>8</li>
                <li>9</li>
                <li>10</li>
            </ul>
        </div>
        <div id="error_login" class="alert-danger"></div>
    </div>
    <div id="form">
        <div class="input-group mb-3" style="width: 70%;">
            <input type="text" class="form-control" placeholder="Username" id="username" aria-label="Username"
                   aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3" style="width: 70%;">
            <input type="text" class="form-control" placeholder="Password" id="pass" aria-label="Username"
                   aria-describedby="basic-addon1">
        </div>
        <div style="margin-top: 30px;">
            <a id="login" class="btn btn-primary" href="#">
                Log in
            </a>
            <a id="registration" class="btn btn-primary" href="register.php">
                Register
            </a>
        </div>
    </div>
</div>