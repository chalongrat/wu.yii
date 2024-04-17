// document.getElementById("indexDisp").style.display = "block";
// document.getElementById('detailDisp').style.display = "none";

// *⁡⁣⁣⁢++++++++++++++++++++++++++++++++++++ :: Label :: +++++++++++++++++++++++++++++++++++++⁡⁣⁣⁢+++++++
var arrMenu = [];
var lang = $("#lang").val();
// renderLabel("aps-job", lang, "apsJob");
// *⁡⁣⁣⁢++++++++++++++++++++++++++++++++++++ :: End :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢+++++++++++++

// ?++++++++++++++++++++++++++++++++++++ :: Render :: +++++++++++++++++++++++++++++++++++⁡++++++++
var isResult = false;
/** document ready */
$(document).ready(function () {
    localStorage.clear();
    indexPage();

    // console.log(arrMenu);
});
// ?⁢++++++++++++++++++++++++++++++++++++ :: End :: ++++++++++++++++++++++++++++++++++++++++++++++

// TODO+++++++++++++++++++++++++++++++++ :: View :: +++++++++++++++++++++++++++++++++++++++++++++
function indexPage() {
    console.log(baseUrl + "aps/jobagreeconf/dispregconf");

    $.ajax({
        url: baseUrl + "aps/jobagreeconf/dispregconf",
        type: "GET",
        dataType: "json",
        success: function (data) {
            for (var xi = 0; xi < data.dt.length; xi++) {
                arrMenu.push({
                    JOBAGREECONF_ID: data.dt[xi].JOBAGREECONF_ID,
                    JOBAGREECONF_PARENT: data.dt[xi].JOBAGREECONF_PARENT,
                    PATH: data.dt[xi].PATH,
                    JOBAGREECONF_NAME: data.dt[xi].JOBAGREECONF_NAME,
                    JOBAGREECONF_DESC: data.dt[xi].JOBAGREECONF_DESC,
                    JOBAGREECONF_CODE: data.dt[xi].JOBAGREECONF_CODE,
                    JOBAGREECONF_LEVEL: data.dt[xi].JOBAGREECONF_LEVEL,
                    JOBAGREECONF_LPOINT: data.dt[xi].JOBAGREECONF_LPOINT,
                    JOBAGREECONF_HPOINT: data.dt[xi].JOBAGREECONF_HPOINT,
                    JOBAGREECONF_FORMULA: data.dt[xi].JOBAGREECONF_FORMULA,
                    JOBAGREECONF_SYS: data.dt[xi].JOBAGREECONF_SYS,
                    JSONMODULE: data.dt[xi].JSONMODULE,
                    JSONTABLE: data.dt[xi].JSONTABLE,
                });
            }

            let html1 = "";
            for (var i = 0; i < data.dt.length; i++) {
                if (data.dt[i].JOBAGREECONF_LEVEL == 2) {
                    html1 += drawHeader(data.dt[i].JOBAGREECONF_NAME, data.dt[i].JOBAGREECONF_ID, data.dt[i].JOBAGREECONF_CODE);
                }
            }

            $("#dinamic_format").html(html1);
        },
        error: function () {
            console.log("Error in Operation");
        },
    });
}
// TODO⁣+++++++++++++++++++++++++++++++++ :: End :: ++++++++++++++++++++++++++++++++++++++++++++++

// !⁣+++++++++++++++++++++++++++++++++++++++ :: Zone -> Action :: ++++++++++++++++++++++++++++++++
function drawHeader(header, cardId, realID) {
    var strHtml = "";

    strHtml += '<div class="col-lg-4 col-md-12">';
    strHtml += '<div class="card menu-card" style="height: 820px;">';
    strHtml += '<div class="card-header menu-card-header">';
    strHtml += '<h3 class="card-title">' + header + "</h3>";
    strHtml += '<div class="card-options">';
    // strHtml += ' <a href="#" class="card-options-collapse" data-toggle="card-collapse">';
    // strHtml += '<i class="fe fe-chevron-up"></i>';
    // strHtml += " </a>";
    // strHtml += '<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen">';
    // strHtml += ' <i class="fe fe-maximize"></i>';
    // strHtml += "</a>";
    // strHtml += '<a href="#" class="card-options-remove" data-toggle="card-remove">';
    // strHtml += '<i class="fe fe-x"></i>';
    // strHtml += "</a>";
    // strHtml += '<div class="item-action dropdown ml-2">';
    // strHtml += '<a href="javascript:void(0)" data-toggle="dropdown">';
    // strHtml += '<i class="fe fe-more-vertical"></i>';
    // strHtml += "</a>";
    // strHtml += '<div class="dropdown-menu dropdown-menu-right">';
    // strHtml += '<a href="javascript:void(0)" class="dropdown-item">';
    // strHtml += '<i class="dropdown-icon fa fa-eye"></i> View Details{" "}';
    // strHtml += "</a>";
    // strHtml += '<a href="javascript:void(0)" class="dropdown-item">';
    // strHtml += '<i class="dropdown-icon fa fa-share-alt"></i> Share{" "}';
    // strHtml += "</a>";
    // strHtml += '<a href="javascript:void(0)" class="dropdown-item">';
    // strHtml += '<i class="dropdown-icon fa fa-cloud-download"></i> Download';
    // strHtml += "</a>";
    // strHtml += '<div class="dropdown-divider"></div>';
    // strHtml += '<a href="javascript:void(0)" class="dropdown-item">';
    // strHtml += '<i class="dropdown-icon fa fa-copy"></i> Copy to';
    // strHtml += "</a>";
    // strHtml += '<a href="javascript:void(0)" class="dropdown-item">';
    // strHtml += '<i class="dropdown-icon fa fa-folder"></i> Move to';
    // strHtml += "</a>";
    // strHtml += '<a href="javascript:void(0)" class="dropdown-item">';
    // strHtml += '<i class="dropdown-icon fa fa-edit"></i> Rename';
    // strHtml += "</a>";
    // strHtml += '<a href="javascript:void(0)" class="dropdown-item">';
    // strHtml += '<i class="dropdown-icon fa fa-trash"></i> Delete';
    // strHtml += "</a>";
    // strHtml += "</div>";
    // strHtml += "</div>";
    strHtml += "</div>";
    strHtml += "</div>";

    strHtml += drawSub_Menu(cardId, realID);

    strHtml += "</div>";
    strHtml += "</div>";

    return strHtml;
}

function drawSub_Menu(cardId, realID) {
    var strHtml = "";

    /* ถ้าเป็น งานทำนุบำรุงศิลปะและวัฒนธรรม ให้ render link */
    if (realID != "CUL20001") {
        strHtml += '<div class="card-body" style="overflow-y: auto;">';
        strHtml += '<ul class="list-unstyled feeds_widget">';

        for (var i = 0; i < arrMenu.length; i++) {
            if (arrMenu[i].JOBAGREECONF_PARENT == cardId) {
                strHtml += "<li>";
                strHtml += '<div class="feeds-left">';
                // strHtml += '<i class="fa fa-leanpub"></i>';

                strHtml += '<img src="theme/assets/images/main-menu.png" width="20px" />';

                strHtml += "</div>";
                strHtml += '<div class="feeds-body">';
                strHtml += '<h4 class="title">' + arrMenu[i].JOBAGREECONF_NAME + "</h4>";

                strHtml += drawMenuLink(arrMenu[i].JOBAGREECONF_ID);

                strHtml += "</div>";
                strHtml += "</li>";
            }
        }
        strHtml += "</ul>";
        strHtml += "</div>";
    } else {
        /* เป็น งานทำนุบำรุงศิลปะและวัฒนธรรม */
        strHtml += '<div class="card-body">';
        strHtml += '<ul class="list-unstyled feeds_widget">';

        for (var i = 0; i < arrMenu.length; i++) {
            if (arrMenu[i].JOBAGREECONF_PARENT == cardId) {
                strHtml += `<small>&nbsp;&nbsp;<i class='fa fa-caret-right' style='color: red;'></i>&nbsp;&nbsp;<a href="javascript:$.loadPage('/${
                    arrMenu[i].JSONMODULE ? arrMenu[i].JSONMODULE.toLowerCase() : "xxxx"
                }/index?formType=${arrMenu[i].JOBAGREECONF_CODE}', '${arrMenu[i].JOBAGREECONF_CODE}');"> <span class="fixedfront">${arrMenu[i].JOBAGREECONF_NAME}</span></a></small>`;
            }
        }

        strHtml += "</ul>";
        strHtml += "</div>";
    }

    return strHtml;
}

function drawMenuLink(cardIDSub) {
    var strHtml = "";

    for (var i = 0; i < arrMenu.length; i++) {
        if (arrMenu[i].JOBAGREECONF_PARENT == cardIDSub) {
            // strHtml += `<small>&nbsp;&nbsp;<i class='fa fa-caret-right' style='color: red;'></i>&nbsp;&nbsp;<a href="javascript:$.loadPage('/${
            //     arrMenu[i].JSONMODULE ? arrMenu[i].JSONMODULE.toLowerCase() : "xxxx"
            // }/index?formType=${arrMenu[i].JOBAGREECONF_CODE}', '${arrMenu[i].JOBAGREECONF_NAME}');"> <span class="fixedfront">${arrMenu[i].JOBAGREECONF_NAME}</span></a></small>`;

            strHtml += `<small>&nbsp;&nbsp;<i class='fa fa-caret-right' style='color: red;'></i>&nbsp;&nbsp;<a href="javascript:$.loadPage('/${
                arrMenu[i].JSONMODULE ? arrMenu[i].JSONMODULE.toLowerCase() : "xxxx"
            }/index?formType=${arrMenu[i].JOBAGREECONF_CODE}', '${arrMenu[i].JOBAGREECONF_CODE}');"> <span class="fixedfront">${arrMenu[i].JOBAGREECONF_NAME}</span></a></small>`;
        }
    }

    return strHtml;
}
// !⁡⁣⁢⁣+++++++++++++++++++++++++++++++++++++++ :: END Action :: ++++++++++++++++++++++++++++++++++++
