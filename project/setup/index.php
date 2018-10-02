<?php
?>
<!doctype html>
<html>
    <head>
        <title>Setup</title>
    </head>
    <body>
        <div id="container">
            <h1>Setup</h1>
            <h2>Database:</h2>
            <form action="index.php" method="post">
                <label>Database host:</label>
                <input name="database_host" value="127.0.0.1"/>
                <br />
                <label>Username:</label>
                <input name="username" value="root"/>
                <br />
                <label>Password:</label>
                <input name="password" value="password"/>
                <br />
                <label>Database name:</label>
                <input name="database_name" value="game"/>

                <button type="submit">Next</button>
            </form>
        </div>
    </body>
</html>
