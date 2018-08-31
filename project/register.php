<?php
session_start();

echo '<link rel="stylesheet" href="style.css" />';
echo '<script src="jquery.js" type="text/javascript"></script>';
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
                console.log('1');
            })
        });
    });


</script>

<div class="header">GREAT EMPIRE</div>

<div class="info">e</div>
<div class="rightbar" >1</div>
<div id="form">
    <div> <input type="text" placeholder="Потребителско име" id="username" /></div>
    <div><input type="password" placeholder="Парола" id="pass" /></div>
    <div> <input type="text" placeholder="Истинско име" id="realname" /></div>
    <div><input type="text" placeholder="email" id="email" /></div>
    <div id="register"><button id="btn">Регистирай се</button></div>
    <div id="error" style="color: black"></div>
</div>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">


        <title>Регистирай се / Great Empire</title>
    </head>
    <body>




    </body>
</html>
