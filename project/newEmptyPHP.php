 echo '<p>Сега строиш</p>';

                echo '<table border="1">';
                $get_build_name_by_id_sqlb = "SELECT * FROM building WHERE building_id='" . $xv['building_id'] . "' ";
                $xvab = mysqli_query($dbc, $get_build_name_by_id_sqlb);
                $xvaab = mysqli_fetch_assoc($xvab);
                echo '<tr><td>Сграда</td><td>Ниво(Скоро)</td><td>Ще бъде готово в</td></tr>';
                $sql_get_build_user = "SELECT * FROM building_now WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
                $x = mysqli_query($dbc, $sql_get_build_user);
                $vremetosega = time();

                while ($xvaabb = mysqli_fetch_assoc($xvaab)) {

                    echo '<tr><td>' . $xvaabb['build_name'] . '</td><td>Ниво(Скоро)</td><td>' . date('H i s', $xv['end_time']) . '</td></tr>';
                }