// *⁢++++++++++++++++++++++++++++++++++++ :: Label :: +++++++++++++++++++++++++++++++++++++⁡⁣⁣⁢++++++++++
var lang = $("#lang").val();
let arrJobMenu = [];
let jsonJbyid = [];
// *⁢++++++++++++++++++++++++++++++++++++ :: End :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢++++++++++++++++

// todo⁢++++++++++++++++++++++++++++++++++++ :: Render Data :: +++++++++++++++++++++++++++++++++++++⁡⁣⁣⁢+
function loadData(id = null) {
    localStorage.setItem("personid", $("#personid").val());
    // localStorage.setItem("personid", 6400000064);

    localStorage.setItem("formTypeid", id);

    if (id != null && id != "") localStorage.setItem("id", id);
    else id = localStorage.getItem("id");

    console.log(baseUrl + `aps/acaprvform/dispacaprojbyperid?PERSON_ID=${$("#personid").val()}`);

    let i = 1;
    $.ajax({
        // url: baseUrl + `aps/acaprvform/dispacaprojbyperid?PERSON_ID=6400000064`,
        url: baseUrl + `aps/acaprvform/dispacaprojbyperid?PERSON_ID=${$("#personid").val()}`,
        type: "GET",
        dataType: "json",
        success: function (data) {
            localStorage.setItem("jsonRegaca", JSON.stringify(data.dt));

            $("#tbRegacaform").dataTable({
                data: data.dt,
                columns: [
                    { data: "ACADACTID", width: "5%", render: () => i++ },

                    {
                        data: "ACADPROJNAMETH",
                        width: "20%",
                        render: function (data, type, row) {
                            let strPath = "";
                            strPath += `<b><span name="regaca_6"></span></b> ${data} <br>`;
                            strPath += `<b><span name="regaca_7"></span></b> ${row.ACADACTIVITYNAME} <br>`;
                            strPath += `<b><span name="regaca_8"></span></b> ${row.ACADPRIVATETOPIC} <br>`;

                            if (row.PARENTTOCHILDTXT) {
                                strPath += `<b><span name="acaprv_10"></span></b><br>`;

                                row.PARENTTOCHILDTXT.split(" / ").forEach(function (item, index) {
                                    for (var i = 0; i < index; i++) {
                                        strPath += `&nbsp;&nbsp;&nbsp;&nbsp;`;
                                    }

                                    strPath += `<i class="fa fa-caret-right" style="color: red;"></i>&nbsp;&nbsp;${item}<br>`;
                                });
                            } else {
                                strPath += `<b><span name="regaca_10"></span></b> <span style="color: red;">ยังไม่ระบุ</span> <br>`;
                            }

                            return strPath;
                        },
                    },

                    {
                        data: "ACADACTID",
                        width: "20%",
                        render: function (data, type, row) {
                            return formatDateENtoTH(row.ACADACTSTDATE) + " - " + formatDateENtoTH(row.ACADACTENDDATE);
                        },
                    },

                    {
                        data: "ACADACTID",
                        width: "10%",
                        render: function (data, type, row) {
                            let strHtml = `<button type="button" class="btn btn-outline-secondary btn-sm btn-edit bEdit" onClick="editForm('${data}','${row.JOBAGREECONF_CODE}');"><i class="fa fa-edit" title="แก้ไข"></i> แก้ไข</button>  `;
                            return strHtml;
                        },
                    },
                ],
                columnDefs: [{ className: "text-center", targets: [0, 2, 3] }],
                order: [],
                drawCallback: function () {
                    renderLabel("aps-job", lang, "apsJob");
                },
            });
        },
        error: function () {
            console.log("Error in Operation");
        },
    });
}
// todo⁡⁣⁣⁢++++++++++++++++++++++++++++++++++++ :: End :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢+++++++++++++

function editForm(key, confCode) {
    $.loadPage(`/regacaform/regacaform?formListID=${key}&formType=${localStorage.getItem("formTypeid")}`, "แก้ไขภาระงาน", function () {
        getTree(confCode);
        $.ajax({
            url: baseUrl + `aps/acaprvform/findacaprojbyid?PERSON_ID=${$("#personid").val()}&ACADACTID=${key}`,
            type: "GET",
            dataType: "json",
            success: function (data) {
                jsonJbyid = data.dt;
                console.log(jsonJbyid);
            },
            error: function () {
                console.log("Error in Operation");
            },
        });
    });
}

function getTree(confCode) {
    $.ajax({
        url: baseUrl + "aps/acaprvform/dispddl?JOBAGREECONF_CODE=ACA20001",
        type: "GET",
        dataType: "json",
        success: function (data) {
            arrJobMenu = data.dt;
            // Draw Accrodion
            for (var i = 0; i < data.dt.length; i++) {
                if (data.dt[i].JOBAGREECONF_LEVEL == 3) drawAccrodion(i, data.dt[i].JOBAGREECONF_NAME, data.dt[i].JOBAGREECONF_ID);
            }

            document.getElementById("fid_" + confCode).checked = true;
        },
        error: function () {
            console.log("Error in Operation");
        },
    });
}

function drawAccrodion(i, jobTitle, jobId) {
    let strAcc = "";
    strAcc += `<div class="accordion-item">`;
    strAcc += `<h2 class="accordion-header" id="heading_${i + 1}">`;
    strAcc += `<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_${i + 1}" aria-expanded="false" aria-controls="collapse_${i + 1}">`;
    strAcc += `<img src="theme/assets/images/main-menu.png" width="20px">&nbsp;&nbsp;&nbsp;<b>${jobTitle}</b>`;
    strAcc += `</button>`;
    strAcc += `</h2>`;

    strAcc += `<div id="collapse_${i + 1}" class="accordion-collapse collapse" aria-labelledby="heading_${i + 1}" data-bs-parent="#accordionExample">`;
    strAcc += `<div class="accordion-body">`;
    strAcc += getChild(jobId);
    strAcc += `</div>`;
    strAcc += `</div>`;
    strAcc += `</div>`;

    $("#accordionExample").append(strAcc);
}

function getChild(jobId, level = 0) {
    let strHtml = "";
    for (var i = 0; i < arrJobMenu.length; i++) {
        if (arrJobMenu[i].JOBAGREECONF_PARENT == jobId) {
            // ตรวจสอบว่ามีลูกหรือไม่
            var hasChildren = false;
            for (var xi = 0; xi < arrJobMenu.length; xi++) {
                if (arrJobMenu[i].JOBAGREECONF_ID == arrJobMenu[xi].JOBAGREECONF_PARENT) {
                    hasChildren = true;
                    break;
                }
            }

            let indent = "&nbsp;".repeat(level * 8);
            if (hasChildren) {
                strHtml += `<span>${indent}&nbsp;${arrJobMenu[i].JOBAGREECONF_NAME}</span><br>`;
                strHtml += getChild(arrJobMenu[i].JOBAGREECONF_ID, level + 1);
            } else {
                strHtml += `${indent}&nbsp;<label class="custom-control custom-radio custom-control-inline"><input type="radio" class="custom-control-input" name="formLevel" id="fid_${arrJobMenu[i].JOBAGREECONF_CODE}" value="${arrJobMenu[i].JOBAGREECONF_CODE}">&nbsp;<span>${arrJobMenu[i].JOBAGREECONF_NAME}</span></label><br>`;
            }
        }
    }
    return strHtml;
}

function saveData(formList) {
    $("#regacaForm").submit(function (event) {
        event.preventDefault();
        Swal.fire({
            title: "บันทึกข้อมูล ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK",
        }).then((result) => {
            if (result.isConfirmed) {
                if ($("input[name='formLevel']:checked").val()) {
                    let strGify = {
                        ACADPROJID: formList,
                    };

                    var formData = {
                        ACAPRVFORM_EDATE: jsonJbyid[0].ACADACTENDDATE,
                        ACAPRVFORM_SDATE: jsonJbyid[0].ACADACTSTDATE,
                        PERSON_ID: localStorage.getItem("personid"),
                        USER_CREATED: localStorage.getItem("personid"),
                        JOBAGREECONF_CODE: $("input[name='formLevel']:checked").val(),
                        ACAPRVFORM_TITLE: jsonJbyid[0].ACADPROJNAMETH,
                        ACAPRVFORM_DESC_ST: jsonJbyid[0].ACADACTIVITYNAME + " " + jsonJbyid[0].ACADPRIVATETOPIC,
                        ACAPRVFORM_DESC_RD: JSON.stringify(strGify),
                    };
                    $.ajax({
                        url: baseUrl + "aps/acaprvform/stored",
                        type: "POST",
                        dataType: "json",
                        data: formData,
                        success: function (data) {
                            Swal.fire({
                                title: "บันทึกสำเร็จ !",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000,
                            });
                            $.loadPage(`/regacaform/index?formType=ACA20001`, "callBack");
                        },
                        error: function (data) {
                            Swal.fire({
                                title: "ผิดพลาด !",
                                text: data.message,
                                showConfirmButton: false,
                                icon: "error",
                                timer: 2000,
                            });
                        },
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "กรุณาเลือกโครงการบริการวิชาการ",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    return false;
                }
            }
        });
    });
}
