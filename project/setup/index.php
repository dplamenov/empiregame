<?php
if (file_exists('database.php')) {
    header("Location: ../index.php");
}

if (isset($_POST['database_host']) && isset($_POST['username']) && isset($_POST['password'])
    && isset($_POST['database_name'])) {

    $database_host = trim($_POST['database_host']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $database_name = trim($_POST['database_name']);

    if ($database_host == 'localhost') {
        $database_host = '127.0.0.1';
    }

    $dbc = mysqli_connect($database_host, $username, $password, $database_name);
    $data = '<?php' . ' ' . "mb_internal_encoding('UTF-8');" . '$dbc = mysqli_connect("' . $database_host . '","' . $username . '","' . $password . '","' . $database_name . '");';
    $data .= '$dsn = "mysql:host='.$database_host.';dbname='.$database_name.'";' . '$db_username = "'.$username.'"; $db_password = "'.$password.'";';
    file_put_contents("database.php", $data);

    if ($dbc) {
        $create_sql = file_get_contents('sql.sql');
        $create_sql = explode(';', $create_sql);
        foreach ($create_sql as $sql) {
            mysqli_query($dbc, $sql);
        }
        header("Location: ../index.php");
    } else {
        echo 'error';
    }
}
?>
<!doctype html>
<html lang="bg">
<head>
    <title>Setup</title>
</head>
<body>
<div id="container">
    <h1>Setup</h1>
    <h2>Database:</h2>
    <form action="index.php" method="post">
        <label>Database host:</label>
        <input name="database_host" placeholder="127.0.0.1"/>
        <br/>
        <label>Username:</label>
        <input name="username" placeholder="root"/>
        <br/>
        <label>Password:</label>
        <input name="password" placeholder="password"/>
        <br/>
        <label>Database name:</label>
        <input name="database_name" placeholder="game"/>

        <button type="submit">Next</button>
    </form>
</div>
</body>
</html>
