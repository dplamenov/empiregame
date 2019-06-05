<!DOCTYPE html>
<html lang="bg">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
      integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css"/>
<script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery-ui.js" type="text/javascript"></script>
    <title><?php echo $title;?></title>
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
                    } else {
                        window.location.reload(true);
                    }

                });
            });
        });

    </script>
</head>