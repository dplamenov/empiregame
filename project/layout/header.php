<!DOCTYPE html>
<html lang="bg">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css"/>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery-ui.js" type="text/javascript"></script>
    <title><?php echo $title; ?></title>
    <script src="js/javascript.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            function refresh() {
                $.ajax({
                    url: 'auto_refreshservertime.php',
                }).done(function (data) {
                    $("#servertime").html("Server time " + data);
                });
            }

            setInterval(function () {
                refresh()
            }, 1000);

            $('#login').click(function () {

                $.ajax({
                    url: 'login.php',
                    data: {
                        username: $('#username').val(),
                        pass: $('#pass').val()
                    },
                    type: 'post',
                }).done(function (data) {
                    if (data == 'error') {
                        $('#error_login').text("Wrong username or password");
                    }
                    login();
                });
            });

        });

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#btn').click(function () {
                console.log('2');
                $.ajax({
                    url: 'register_check.php',
                    data: {
                        user_name: $('#username').val(),
                        pass: $('#pass').val(),
                        real_name: $('#realname').val(),
                        email: $('#email').val()
                    },
                    type: 'post',
                }).done(function (data) {
                    $('#error').html(data);


                });
            });
        });


    </script>
</head>
<body>

<div style="width: 1600px; margin: auto">