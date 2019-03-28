<?php
session_start();

echo '<link rel="stylesheet" href="css/style.css" />';
echo '<script src="js/jquery.js" type="text/javascript"></script>';
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn').click(function () {
            console.log('2');
            $.ajax({
                url: 'register_check.php',
                data: {
                    username: $('#username').val(),
                    pass: $('#pass').val(),
                    realname: $('#realname').val(),
                    email: $('#email').val()
                },
                type: 'post',
            }).done(function (data) {
                $('#error').html(data);


            }).fail(function (er) {
                console.log(er);
            })
        });
    });


</script>

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

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Регистирай се / Great Empire</title>
</head>
</html>