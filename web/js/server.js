function checkServer() {
    $.ajax({
        // url: "http://localhost:8080/server",
        url: baseUrl + "server",

        type: "GET",
        success: function (data) {
            let api = data.substring(0, 3);
            let db = data.substring(4, 7);

            redAlert(api);
            redAlert(db);

            console.log(api);
            console.log(db);

            if (api != 200 || db != 200) {
                setTimeout(checkServer, 5000);
                console.log("recheck ");
            }
        },
        error: function (response) {
            console.log("check fail");
        },
    });
}
