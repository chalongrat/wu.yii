// *⁢++++++++++++++++++++++++++++++++++++ :: Label :: +++++++++++++++++++++++++++++++++++++⁡⁣⁣⁢++++++++++
var lang = $("#lang").val();
// ใช้สำหรับการบันทึกข้อมูลตอนกด save

let arrPerson = [];

// *⁢++++++++++++++++++++++++++++++++++++ :: End :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢++++++++++++++++

// ?++++++++++++++++++++++++++++++++++++ :: Render :: +++++++++++++++++++++++++++++++++++⁡++++++++
$(document).ready(function () {
    // console.log($("#formID").val());
});
// ?⁢++++++++++++++++++++++++++++++++++++ :: End :: ++++++++++++++++++++++++++++++++++++++++++++++

// TODO+++++++++++++++++++++++++++++++++ :: View :: +++++++++++++++++++++++++++++++++++++++++++++
function loadData(id = null) {
    localStorage.setItem("personid", $("#personid").val());
    // localStorage.setItem("personid", 4510070321);

    localStorage.setItem("formTypeid", id);

    if (id != null && id != "") localStorage.setItem("id", id);
    else id = localStorage.getItem("id");

    $.ajax({
        url: baseUrl + `aps/researchform/index?PERSON_ID=${$("#personid").val()}&JOBAGREECONF_CODE=` + id,
        // url: baseUrl + `aps/researchform/index?PERSON_ID=4800000039&JOBAGREECONF_CODE=` + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            let i = 1;
            // โหลด data ใน dll
            setPerson(function () {
                $("#tbSubresformsocen").dataTable({
                    data: data.dt,
                    columns: [
                        // { data: "RES_ID", width: "5%", render: () => i++ },

                        {
                            data: "RES_TITLE",
                            width: "40%",
                            render: (data) => data,
                        },

                        {
                            data: "RES_SDATE",
                            width: "20%",
                            render: function (data, type, row) {
                                return formatDateENtoTH(data) + " - " + formatDateENtoTH(row.RES_EDATE);
                            },
                        },

                        {
                            data: "RES_ID",
                            width: "20%",
                            render: function (data, type, row) {
                                let strPath = "";
                                if (row.RES_DESC_ND) {
                                    let arrStr = JSON.parse(row.RES_DESC_ND);

                                    if (arrStr["PERSON"]) {
                                        for (let i = 0; i < arrStr["PERSON"].length; i++) {
                                            let currentItem = arrStr["PERSON"][i];
                                            strPath += `<div class="row">`;

                                            arrPerson.forEach(function (optionData) {
                                                if (optionData.PERSON_ID == currentItem.PERSON_ID) {
                                                    // strPath += `<div class="col-md-9">`;
                                                    // strPath += `<span>${optionData.FULL_NAME}</span>&nbsp;&nbsp;&nbsp;&nbsp;`;
                                                    // strPath += `</div>`;
                                                    strPath += `<div class="col-md-12">`;
                                                    strPath += `<span>${currentItem.RATIO}  %</span>&nbsp;&nbsp;&nbsp;&nbsp;`;
                                                    strPath += `</div>`;
                                                }
                                            });
                                            strPath += `</div>`;
                                        }
                                    }
                                }
                                return strPath;
                            },
                        },
                    ],
                    columnDefs: [{ className: "text-center", targets: [1, 2] }],
                    order: [],
                    drawCallback: function () {
                        renderLabel("aps-job", lang, "apsJob");
                    },
                });
            });
        },
        error: function () {
            console.log("Error in Operation");
        },
    });
}
// TODO⁣+++++++++++++++++++++++++++++++++ :: End :: ++++++++++++++++++++++++++++++++++++++++++++++

// !++++++++++++++++++++++++++++++++++++ :: set data :: +++++++++++++++++++++++++++++++++++⁡++++++
function setPerson(callBack) {
    $.ajax({
        url: baseUrl + "aps/researchform/dispperson",
        type: "GET",
        dataType: "json",
        success: function (data) {
            arrPerson = data.dt;
            callBack();
        },
        error: function () {
            console.log("Error in Operation");
        },
    });
}
// !++++++++++++++++++++++++++++++++++++ :: END :: +++++++++++++++++++++++++++++++++++⁡+++++++++++

function syncSocen() {
    $.ajax({
        // url: baseUrl + "aps/researchform/syncsocenbyper?PERSON_ID=4800000039",
        url: baseUrl + `aps/researchform/syncsocenbyper?PERSON_ID=${$("#personid").val()}`,
        type: "GET",
        dataType: "json",
        success: function (data) {
            Swal.fire({
                title: "บันทึกสำเร็จ !",
                text: data.rowAffeched > 0 ? `เพิ่มข้อมูลใหม่จำนวน ${data.rowAffeched} ผลงาน` : `ข้อมูลของท่านเป็นปัจจุบันแล้ว`,
                icon: "success",
                timer: 3000,
                showConfirmButton: false,
            });
            $.loadPage(`/subresformsocen/index?formType=${$("#formID").val()}`, "");
        },
        error: function () {
            Swal.fire({
                title: "ผิดพลาด !",
                icon: "error",
                timer: 2500,
                showConfirmButton: false,
            });
        },
    });
}
