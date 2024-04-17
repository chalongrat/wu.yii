// *⁢++++++++++++++++++++++++++++++++++++ :: Label :: +++++++++++++++++++++++++++++++++++++⁡⁣⁣⁢++++++++++
var lang = $("#lang").val();
renderLabel("aps-job", lang, "apsJob");
// *⁢++++++++++++++++++++++++++++++++++++ :: End :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢++++++++++++++++

// todo⁢++++++++++++++++++++++++++++++++++++ :: Render Data :: +++++++++++++++++++++++++++++++++++++⁡⁣⁣⁢+
function loadData(id = null) {
    // localStorage.setItem("personid", $("#personid").val());
    localStorage.setItem("personid", 4510070321);

    localStorage.setItem("formTypeid", id);

    if (id != null && id != "") localStorage.setItem("id", id);
    else id = localStorage.getItem("id");

    $.ajax({
        url: baseUrl + "aps/acaprvform/index?PERSON_ID=4510070321&JOBAGREECONF_CODE=" + id,
        // url: baseUrl + `aps/acaprvform/index?PERSON_ID=${$("#personid").val()}&JOBAGREECONF_CODE=` + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            localStorage.setItem("jsonAcaprv", JSON.stringify(data.dt));

            $("#tbAcaprvform").dataTable({
                data: data.dt,
                columns: [
                    {
                        data: "ACAPRVFORM_TITLE",
                        width: "20%",
                        render: function (data, type, row) {
                            let strPath = "";
                            strPath += `<b><span name="acaprv_9"></span></b> ${data} <br>`;
                            strPath += `<b><span name="acaprv_10"></span></b><br>`;

                            row.PARENTTOCHILDTXT.split(" / ").forEach(function (item, index) {
                                for (var i = 0; i < index; i++) {
                                    strPath += `&nbsp;&nbsp;&nbsp;&nbsp;`;
                                }

                                strPath += `<i class="fa fa-caret-right" style="color: red;"></i>&nbsp;&nbsp;${item}<br>`;
                            });

                            return strPath;
                        },
                    },

                    {
                        data: "CULTUREFORM_ID",
                        width: "20%",
                        render: function (data, type, row) {
                            return formatDateENtoTH(row.ACAPRVFORM_SDATE) + " - " + formatDateENtoTH(row.ACAPRVFORM_EDATE);
                        },
                    },

                    {
                        data: "ACAPRVFORM_FILE",
                        width: "30%",
                        render: function (data, type, row) {
                            return data ? '<a href="' + baseUrl + "aps/" + data + '" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;' + data + "</a>" : "";
                        },
                    },

                    {
                        data: "ACAPRVFORM_ID",
                        width: "10%",
                        render: function (data, type, row) {
                            var strHtml = "";
                            strHtml += `<button type="button" class="btn btn-outline-secondary btn-sm btn-edit bEdit" onClick="editForm(${data});"><i class="fa fa-edit" title="แก้ไข"></i> <span name="button_1"></span></button>  `;
                            strHtml += `<button type="button" class="btn btn-outline-danger btn-sm btn-delete" onClick="deleteAcaprv(${data});"><i class="fa fa-trash" title="ลบ"></i> ลบ</button>`;
                            return strHtml;
                        },
                    },
                ],
                columnDefs: [{ className: "text-center", targets: [3] }],
            });

            renderLabel("aps-job", lang, "apsJob");
        },
        error: function () {
            console.log("Error in Operation");
        },
    });
}
// todo⁡⁣⁣⁢++++++++++++++++++++++++++++++++++++ :: End :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢+++++++++++++

// ?⁢++++++++++++++++++++++++++++++++++++ :: Action :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢+++++++++++++
function openForm(formListID, formType) {
    $.loadPage(`/acaprvform/acaprvform?formListID=${formListID}&formType=${formType}`, "", function () {
        drawLevel(formType);
    });
}

function drawLevel(formType, callBack) {
    console.log(baseUrl + "aps/acaprvform/dispddl?JOBAGREECONF_CODE=" + formType);

    $.ajax({
        url: baseUrl + "aps/acaprvform/dispddl?JOBAGREECONF_CODE=" + formType,
        type: "GET",
        dataType: "json",
        success: function (data) {
            let resultHtml = "";

            $("#nameJoblevel4").html(`<i class="fa fa-caret-right" style="color: red;"></i>&nbsp;&nbsp;${data.dt[0].JOBAGREECONF_NAME}`);
            // $("#nameJoblevel4").html(data.dt[0].PARENTTOCHILDTXT.replaceAll("/", '&nbsp;&nbsp;<i class="fa fa-caret-right" style="color: red;"></i>&nbsp;&nbsp;'));

            for (var i = 0; i < data.dt.length; i++) {
                if (data.dt[i].JOBAGREECONF_LEVEL == "5") {
                    resultHtml += `<li class="list-group-item">`;

                    // ตรวจสอบว่ามีลูกหรือไม่ true = มึลูก
                    let hasChildren = false;
                    for (var ji = 0; ji < data.dt.length; ji++) {
                        if (data.dt[i].JOBAGREECONF_ID == data.dt[ji].JOBAGREECONF_PARENT) {
                            hasChildren = true;
                            break;
                        }
                    }

                    if (hasChildren) {
                        resultHtml += `<i class="fa fa-caret-right" style="color: red;"></i>&nbsp;&nbsp;<label class="custom-control custom-radio custom-control-inline">${data.dt[i].JOBAGREECONF_NAME}</label><br>`;
                    } else {
                        resultHtml += `<label class="custom-control custom-radio custom-control-inline">`;
                        resultHtml += `<input type="radio" class="custom-control-input" name="formLevel" id="fid_${data.dt[i].JOBAGREECONF_CODE}" value="${data.dt[i].JOBAGREECONF_CODE}">`;
                        resultHtml += `&nbsp;&nbsp;&nbsp;<span class="mb-0">${data.dt[i].JOBAGREECONF_NAME}</span>`;
                        resultHtml += `</label>`;
                        resultHtml += `<br>`;
                    }

                    resultHtml += buildTree(data.dt, data.dt[i].JOBAGREECONF_ID);
                    resultHtml += `</li>`;
                }
            }
            $("#reaLevel").html(resultHtml);

            callBack();
        },
        error: function () {
            console.log("Error in Operation");
        },
    });
}

function buildTree(data, parentId) {
    var strHtml = "";

    for (var i = 0; i < data.length; i++) {
        if (data[i].JOBAGREECONF_PARENT === parentId) {
            // ตรวจสอบว่ามีลูกหรือไม่
            var hasChildren = false;
            for (var xi = 0; xi < data.length; xi++) {
                if (data[i].JOBAGREECONF_ID == data[xi].JOBAGREECONF_PARENT) {
                    hasChildren = true;
                    break;
                }
            }

            if (hasChildren) {
                strHtml += `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right" style="color: red;"></i>&nbsp;&nbsp;<label class="custom-control custom-radio custom-control-inline">${data[i].JOBAGREECONF_NAME}</label><br>`;

                strHtml += "<ul>";
                // เรียก buildTree ใหม่เพื่อหาลูก
                strHtml += buildTree(data, data[i].JOBAGREECONF_ID);
                strHtml += "</ul>";
            } else {
                strHtml += `<label class="custom-control custom-radio custom-control-inline">`;
                strHtml += `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="custom-control-input" name="formLevel" id="fid_${data[i].JOBAGREECONF_CODE}" value="${data[i].JOBAGREECONF_CODE}">`;
                strHtml += `&nbsp;&nbsp;&nbsp;<span class="mb-0">${data[i].JOBAGREECONF_NAME}</span>`;
                strHtml += `</label>`;
                strHtml += `<br>`;
            }
        }
    }

    return strHtml;
}

function saveData(formList) {
    let apiType = "aps/acaprvform/" + (formList ? "updated" : "stored");

    console.log(formList);

    $("#AcaprvForm").submit(function (event) {
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
                var xobj = $("#acaprvform_File");
                var xobj2 = xobj[0];
                var files = xobj2.files;
                var formData = new FormData();

                formData.append("ACAPRVFORM_EDATE", $("#acaprvform_edate").val());
                if (files.length > 0) formData.append("ACAPRVFORM_FILE", files[0], files[0].name);
                formData.append("ACAPRVFORM_SDATE", $("#acaprvform_sdate").val());
                formData.append("PERSON_ID", localStorage.getItem("personid"));
                formData.append("USER_CREATED", localStorage.getItem("personid"));
                formData.append("JOBAGREECONF_CODE", $("input[name='formLevel']:checked").val() ? $("input[name='formLevel']:checked").val() : localStorage.getItem("formTypeid"));
                formData.append("ACAPRVFORM_TITLE", $("#acaprvform_title").val());
                formData.append("ACAPRVFORM_DESC_ST", $("#acaprvform_desc_st").val());

                if (formList) formData.append("ACAPRVFORM_ID", formList);

                console.log(baseUrl + apiType);
                for (var pair of formData.entries()) console.log(pair[0] + ", " + pair[1]);

                fetch(baseUrl + apiType, {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.code == 200 || data.code == 201) {
                            Swal.fire({
                                title: "บันทึกสำเร็จ !",
                                icon: "success",
                            });
                            $.loadPage(`/acaprvform/index?formType=${localStorage.getItem("formTypeid")}`, "callBack");
                        } else {
                            Swal.fire({
                                title: "ผิดพลาด !",
                                icon: "error",
                            });
                        }
                    });
            }
        });
    });
}

function editForm(key) {
    $.loadPage(`/acaprvform/acaprvform?formListID=${key}&formType=${localStorage.getItem("formTypeid")}`, "แก้ไขภาระงาน", function () {
        // Draw Level
        drawLevel(localStorage.getItem("formTypeid"), function () {
            JSON.parse(localStorage.getItem("jsonAcaprv")).forEach(function (i) {
                if (i.ACAPRVFORM_ID == key) {
                    $("#acaprvform_title").val(i.ACAPRVFORM_TITLE);
                    $("#acaprvform_desc_st").val(i.ACAPRVFORM_DESC_ST);
                    $("#acaprvform_sdate").val(i.ACAPRVFORM_SDATE);
                    $("#acaprvform_edate").val(i.ACAPRVFORM_EDATE);

                    document.getElementById(`fid_${i.JOBAGREECONF_CODE}`).checked = true;

                    if (i.ACAPRVFORM_FILE)
                        $("#divDocfile").append(`<br><a href="${baseUrl}aps/${i.ACAPRVFORM_FILE}" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;${i.ACAPRVFORM_FILE}</a>`);
                }
            });
        });
    });
}

function deleteAcaprv(acaprvId) {
    Swal.fire({
        title: "ลบข้อมูล ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "OK",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseUrl + "aps/acaprvform/destroyed",
                type: "DELETE",
                dataType: "json",
                data: {
                    ACAPRVFORM_ID: acaprvId,
                },
                success: function () {
                    Swal.fire({
                        title: "บันทึกสำเร็จ !",
                        icon: "success",
                    });
                },
                error: function (data) {
                    Swal.fire({
                        title: "ผิดพลาด !",
                        text: data.message,
                        icon: "error",
                    });
                },
            });
        }
    });
}
// ?⁡⁣⁣⁢++++++++++++++++++++++++++++++++++++ :: End :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢++++++++++++++++
