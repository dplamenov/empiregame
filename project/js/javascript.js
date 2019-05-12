$(document).ready(function () {

    function globalmap() {
        console.log("global");
    }


    function refresh() {
        $.ajax({
            url: 'auto_refreshservertime.php',
        }).done(function (data) {
            $("#servertime").html("Server time " + data);
        });
    }

    function auto_refresh_army() {
        $.ajax({
            url: 'auto_refresharmy.php',
            data: {
                getCount: true
            },
            type: 'post'
        }).done(function (count) {
            if (count >= 1) {
                for (let i = 1; i <= count; i++) {

                    $.ajax({
                        url: 'auto_refresharmy.php',
                        data: {
                            id: i
                        },
                        type: 'post'
                    }).done(function (data) {
                        if (data == 1) {
                            window.location.href = "refresh_helper.php";

                        } else {
                            $("#army_" + i).html(data);
                        }

                    });
                }
            }
        });
    }

    function auto_refresh_build() {
        $.ajax({
            url: 'auto_refreshbuild.php',
            data: {
                getCount: true
            },
            type: 'post'
        }).done(function (count) {
            if (count >= 1) {
                for (let i = 1; i <= count; i++) {

                    $.ajax({
                        url: 'auto_refreshbuild.php',
                        data: {
                            id: i
                        },
                        type: 'post'
                    }).done(function (data) {
                        if (data == 1) {
                            window.location.href = "refresh_helper.php";

                        } else {
                            $("#build_" + i).html(data);
                        }

                    });
                }
            }
        });
    }

    function auto_refresh_upgrade_army() {
        $.ajax({
            url: 'upgradearmy_refresh.php',
            data: {
                getCount: true
            },
            type: 'post'
        }).done(function (count) {
            if (count >= 1) {
                for (let i = 1; i <= count; i++) {
                    $.ajax({
                        url: 'upgradearmy_refresh.php',
                        data: {
                            id: i
                        },
                        type: 'post'
                    }).done(function (data) {
                        if (data == 1) {
                            window.location.href = "refresh_helper.php";
                        } else {
                            let data_ = JSON.parse(data);
                            $("#_army_upgrade" + data_.id).html(data_.date);
                        }

                    });
                }
            }
        });
    }

    setInterval(function () {
        auto_refresh_army();
        auto_refresh_build();
        auto_refresh_upgrade_army();
    }, 1000);
    setInterval(function () {
        refresh();
    }, 1000);
    $('#townhall').click(function () {
        $.ajax({
            url: 'checkbuild.php'

        }).done(function (data) {
            $('#rightbar').html(data);


        });
    });

    $('#castle').click(function () {
        $.ajax({
            url: 'castle.php'
        }).done(function (data) {
            $('#rightbar').html(data);
        });
    });

    $('#house').click(function () {
        $.ajax({
            url: 'house.php'
        }).done(function (data) {
            $('#rightbar').html(data);
        });
    });

    $('#barrack').click(function () {
        $.ajax({
            url: 'barrack.php'
        }).done(function (data) {
            $('#rightbar').html(data);
        });
    });

    $('#palace').click(function () {
        $.ajax({
            url: 'dvorec.php'
        }).done(function (data) {
            $('#rightbar').html(data);
        });
    });

    $('#content').click(function () {
        $.ajax({
            url: 'rightbar.php'
        }).done(function (data) {
            $('#rightbar').html(data);
        });
    });
    $('#header').click(function () {
        $.ajax({
            url: 'rightbar.php'
        }).done(function (data) {
            $('#rightbar').html(data);
        });
    });
    $('#info').click(function () {
        $.ajax({
            url: 'rightbar.php'
        }).done(function (data) {
            $('#rightbar').html(data);
        });
    });

    $('#attack_button').click(function () {
        let specific_user = document.getElementById('specific_user').value;
        if (specific_user.length < 4) {
            let html = $('#rightbar').html();
            document.getElementById('rightbar').innerHTML = '<p style="text-align: center; font-weight: bold; color: red;font-size: 17px">Error </p>' + html;
        } else {
            $.ajax({
                url: 'attack.php',
                data: {
                    user: specific_user
                },
                method: "post"
            }).done(function (data) {
                let data_ = JSON.parse(data);
                if (data_.code == 1) {
                    console.log(data);
                    let error = document.getElementById('error');
                    error.innerHTML = data_.exception;
                } else {
                    let error = document.getElementById('error');
                    error.innerHTML = data;

                }
                setTimeout(
                    function () {
                        window.location.href = 'index.php';
                    }, 1000);
            });
        }
    });
});

function delete_army(army_id) {
    $.ajax({
        url: 'delete_army.php',
        data: {
            army: army_id
        },
        method: "post"
    }).done(function (data) {
        window.location.href = 'index.php';
    });
}

function upgrade_army(army_id) {
    $.ajax({
        url: 'check_upgrade.php',
        data: {
            army: army_id
        },
        method: "post"
    }).done(function (data) {
        console.log(data);
        if (data == 1) {
            $.ajax({
                url: 'upgrade_army.php',
                data: {
                    army: army_id
                },
                method: "post"
            }).done(function (data) {
                window.location.href = 'index.php';
            });
        }
    });

}

function checkUser() {
    let user = document.getElementById('user').value;
    console.log(user);
}