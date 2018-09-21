<head>
    <script type="text/javascript" src="js/jquery.js"></script>
    <title>Delete your profile</title>
    <script type="text/javascript">
        var i = 0;

        function deleteprofile_() {
            if (i == 1) {
                i = 0;
            } else if (i == 0) {
                i = 1;
            }
            let radio_button = document.getElementById("radio").value;
            console.log(radio_button);
        }

        function deleteprofile() {
            $.ajax({
                url: 'deletehelper.php',
            }).done(function (data) {
                console.log(data);
                window.location.href = "index.php";
            });
        }
    </script>
</head>
<body>
<div>
    <input type="checkbox" id="radio" onclick="deleteprofile_()"/>
    <span>Yes, I understand consequences by press Delete profile</span>
    <button onclick="deleteprofile()">Delete profile</button>
</div>
</body>