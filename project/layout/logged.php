<div id="header">
    <p>Hello, <?php echo $_SESSION['user']['user_name'] . '</br><a href="logout.php">Log out</a>' ?></p>
    <div>
        <a href="settings.php">Profile</a>
    </div>
</div>
<div id="info">
    <div id="servertime">Server time <?php echo date('H:i:s'); ?></div>
</div>
<div id="rightbar" style="padding: 5px;height: 400px;">
    <?php
        include_once 'rightbar.php';
    ?>

</div>
<div id="content" style="padding-bottom: auto">

    <img src="images/map.jpg" alt="" style="margin: 20px 30px" usemap="#Map"/><br>
    <img src="images/global.png" style="margin: 20px 30px" alt=""/>
    <div style="margin: 20px 30px">
        <?php
        $user_building = "SELECT * FROM building_now WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
        $get_now_user_build = mysqli_query($dbc, $user_building);
        if (mysqli_num_rows($get_now_user_build) >= 1) {
            echo '<p>You are building:</p>';
            echo '<table>';
            echo '<table border="1">';
            echo '<tr><td>Build</td><td>Level</td><td>Will be ready after:</td></tr>';
            while ($get_now_user_buildb = mysqli_fetch_assoc($get_now_user_build)) {
                $select_build_name_from_id_sql = "SELECT * FROM building WHERE building_id='" . $get_now_user_buildb['building_name'] . "'";
                $select_build_name_from_id = mysqli_query($dbc, $select_build_name_from_id_sql);
                $select_build_name_from_idarray = mysqli_fetch_assoc($select_build_name_from_id);

                $level = mysqli_query($dbc, "SELECT build_lv FROM users_building WHERE user_id = " . $_SESSION['user']['user_id'] . " and building_id = " . $get_now_user_buildb['building_name']);
                $level = mysqli_fetch_assoc($level)['build_lv'] + 1;
                echo '<tr><td>' . ucfirst($select_build_name_from_idarray['build_name']) . '</td><td>' . $level . '</td><td id="build_' . $get_now_user_buildb['building_name'] . '">' . date('H:i:s', $get_now_user_buildb['end_time'] - time() - 7200) . '</td></tr>';
            }
            echo '</table>';
        }
        ?>
    </div>
    <div style="margin: 20px 30px">
        <?php

        $sql_get_now_user_army = "SELECT * FROM `army_now` WHERE `user_id` = " . $_SESSION['user']['user_id'];
        $get_now_user_army = mysqli_query($dbc, $sql_get_now_user_army);

        if (mysqli_num_rows($get_now_user_army) >= 1) {
            echo "<br>";
            echo "<span>Now train</span>";
            echo '<table>';
            echo '<table border="1">';
            echo '<tr><td>Army</td><td>Count</td><td>Will be ready after:</td></tr>';
            $counter = 0;
            while ($army_now = mysqli_fetch_assoc($get_now_user_army)) {
                $army_name = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT `army_name` FROM `army` WHERE `army_id` = " . $army_now['army_name']))['army_name'];
                date_default_timezone_set('Europe/Sofia');
                $end_time = $army_now['end_time'] - time();
                $end_time = date("H:i:s", $end_time - 7200);
                echo "<tr><td>" . $army_name . "</td><td>" . $army_now['army_num'] . "</td><td id='army_" . $army_now['army_name'] . "'>" . $end_time . "</td></tr>";
            }

            echo "</table>";
            echo "<br>";

        }
        ?>
    </div>
    <div style="margin: 20px 30px">
        <?php
        $user_build_data = mysqli_query($dbc, "SELECT * FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "'");
        if (mysqli_num_rows($user_build_data) >= 1) {
            echo '<br>';
            echo '<span>Your building</span>';
            echo '<table border="1" id="ready_build">';
            echo '<tr><td>Build</td><td>Level</td></tr>';

            while ($u_army = mysqli_fetch_assoc($user_build_data)) {
                $get_build_name_by_id = "SELECT * FROM building WHERE building_id='" . $u_army['building_id'] . "' ";
                $get_build_name_by_id = mysqli_query($dbc, $get_build_name_by_id);
                $build = mysqli_fetch_assoc($get_build_name_by_id);
                echo '<tr><td>' . ucfirst($build['build_name']) . '</td><td>' . $u_army['build_lv'] . '</td></tr>';
            }
            echo '</table>';
        }

        echo "<br>";

        ?>
    </div>
    <div style="margin: 20px 30px">
        <?php
        $user_army = "SELECT * FROM user_army WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
        $user_army = mysqli_query($dbc, $user_army);
        if (mysqli_num_rows($user_army) >= 1) {
            echo '<span>Your army</span>';
            echo '<table border="1" id="ready_army">';
            echo '<tr><td>Army</td><td>Count</td><td>Level</td><td>Upgrade</td><td>Delete</td></tr>';

            while ($u_army = mysqli_fetch_assoc($user_army)) {

                $armyname = "SELECT * FROM army WHERE army_id='" . $u_army['army_name'] . "' ";
                $armyname = mysqli_query($dbc, $armyname);
                $army_name = mysqli_fetch_assoc($armyname);
                if ($u_army['lvl'] == 10) {
                    $result = '<td>Max Level</td>';
                } else {
                    $result = '<td onclick="upgrade_army(' . $u_army['army_id'] . ')">Upgrade</td>';
                }
                echo '<tr><td>' . $army_name['army_name'] . '</td><td>' . $u_army['count'] . '</td><td>' . $u_army['lvl'] . '</td>' . $result .
                    '<td onclick="delete_army(' . $u_army['army_id'] . ')">Delete</tr>';
            }


            echo '</table><br>';
        }
        ?>
    </div>
    <div style="margin: 20px 30px">
        <?php
        $upgrade_army = mysqli_query($dbc, "SELECT * FROM upgrade_army LEFT JOIN user_army ON user_army.army_name = upgrade_army.army_name WHERE user_army.user_id = " . $_SESSION['user']['user_id']);
        if (mysqli_num_rows($upgrade_army) >= 1) {
            echo '<span>You upgrade that army:</span>';
            echo '<table border="1" id="upgrade_army">';
            echo '<tr><td>Army</td><td>Count</td><td>Level</td><td>Will be ready after:</td></tr>';
            while ($army = mysqli_fetch_assoc($upgrade_army)) {

                $_army = "SELECT * FROM army WHERE army_id='" . $army['army_name'] . "' ";
                $_army = mysqli_query($dbc, $_army);
                $army_name = mysqli_fetch_assoc($_army)['army_name'];

                $end_time = $army['end'] - time();
                $end_time = date("H:i:s", $end_time - 7200);
                echo '<tr><td>' . $army_name . '</td><td>' . $army['count'] . '</td><td>' . $army['level'] . '</td><td id="_army_upgrade' . $army['army_id'] . '">' . $end_time . '</td>
</tr>';

            }

            echo '</table>';
        }
        ?>
    </div>
    <div id="text"></div>
</div>

<map name="Map" id="Map">
    <area alt="" title="" id="townhall" href="#" shape="rect" coords="377,264,274,216"/>
    <?php
    deletebuilding($dbc);
    $sql_get_users_build_area = "SELECT * FROM users_building WHERE user_id='" . $_SESSION['user']['user_id'] . "'";
    $get_users_build_area = mysqli_query($dbc, $sql_get_users_build_area);
    while ($get_users_build_area_array = mysqli_fetch_assoc($get_users_build_area)) {
        $sql_get_build_area = "SELECT * FROM building WHERE building_id='" . $get_users_build_area_array['building_id'] . "'";
        $get_build_area = mysqli_query($dbc, $sql_get_build_area);
        $get_build_area_array = mysqli_fetch_assoc($get_build_area);
        echo '<area alt="" title="" id="' . $get_build_area_array['geo_id'] . '" href="#" shape="' . $get_build_area_array['shape'] . '" coords="' . $get_build_area_array['geo_location'] . '" />';
    }
    ?>
    <?php
    if (isset($_GET['army'])) {
        echo 'You are training army.';
    }
    ?>
</map>