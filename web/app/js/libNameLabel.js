function renderLabel(mod, lang, module) {
    $.ajax({
        url: baseUrl + `lng/${lang}/?mod=${mod}`,
        type: "GET",
        dataType: "json",

        success: function (data) {
            for (var key in data[module]) {
                let name = data[module];
                for (var key2 in name[key]) {
                    $(`[name="${key2}"]`).text(name[key][key2]);
                }
            }
        },
        error: function () {
            console.log("Error in Operation");
        },
    });
}

//pay
function renderLabelPay(mod, lang, module) {
    $.ajax({
        url: payUrl + `lng/${lang}/?mod=${mod}`,
        type: "GET",
        dataType: "json",

        success: function (data) {
            for (var key in data[module]) {
                let name = data[module];
                for (var key2 in name[key]) {
                    $(`[name="${key2}"]`).text(name[key][key2]);
                }
            }
        },
        error: function () {
            console.log("Error in Operation");
        },
    });
}
