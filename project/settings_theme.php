<script type="text/javascript">
    function changepassword() {
        let div = document.getElementById("change_password");
        div.style.visibility = "visible";
        document.getElementById("btn_changepassword").style.visibility = "hidden";
    }

    function deleteprofile() {

        window.location.href = "deleteprofile.php";

        let div = document.getElementById("change_password");
        div.style.visibility = "hidden";
        document.getElementById("btn_changepassword").style.visibility = "visible";


    }
</script>
<head>
    <title><?= $title; ?></title>
    <link type="text/css" rel="stylesheet" href="<?= $stylesheet; ?>"/>
</head>
<body>
<a href="index.php">Back</a>
<p>User Id: <?= $user_id; ?></p>
<p>Username: <?= $username; ?></p>
<p>Money: <?= $money; ?> лева</p>
<p>XP: <?= $xp; ?></p>

<button style="border:0;background-color: indianred;padding: 7px" id="deleteprofile" onclick="deleteprofile()"
        title="You will be redirect to another page">Delete your profile
</button>
<button style="border:0;background-color: lightblue;padding: 7px" onclick="changepassword()" id="btn_changepassword">
    Change password
</button>

<div id="change_password" style="visibility: hidden">
    <h2>Change password</h2>
    <form method="post" action="settings.php">
        <input style="background:#cccccc;padding: 5px;border: 1px solid white" type="password" name="oldpassword"
               placeholder="Old Password"/>
        <input style="background:#cccccc;padding: 5px;border: 1px solid white" type="password" name="newpasasword"
               placeholder="New Password"/>
        <input style="background:#cccccc;padding: 5px;border: 1px solid white" type="password" name="repeat"
               placeholder="Repeat new Password"/>
        <button type="submit" style="border:0;background-color: lightblue;padding: 7px" id="btn_changepassword">Go
        </button>
        <button type="reset" style="border:0;background-color: indianred;padding: 7px" id="">Reset</button>
    </form>
</div>


</body>