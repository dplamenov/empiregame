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

    setInterval(function () {
        auto_refresh_army();
        auto_refresh_build();
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
            url: 'zamuk.php'
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
            url: 'kazarma.php'
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

});