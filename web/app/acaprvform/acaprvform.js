// *⁢++++++++++++++++++++++++++++++++++++ :: Label :: +++++++++++++++++++++++++++++++++++++⁡⁣⁣⁢++++++++++
var lang = $("#lang").val();

function labelRender() {
    renderLabel("aps-job", lang, "apsJob");
    renderLabel("set-btn", lang, "setBtn");
}
// *⁢++++++++++++++++++++++++++++++++++++ :: End :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢++++++++++++++++

// todo⁢++++++++++++++++++++++++++++++++++++ :: Render Data :: +++++++++++++++++++++++++++++++++++++⁡⁣⁣⁢+
function loadData(id = null) {
    localStorage.setItem("personid", $("#personid").val());
    // localStorage.setItem("personid", 4510070321);

    localStorage.setItem("formTypeid", id);

    if (id != null && id != "") localStorage.setItem("id", id);
    else id = localStorage.getItem("id");

    $.ajax({
        // url: baseUrl + "aps/acaprvform/index?PERSON_ID=6400000064&JOBAGREECONF_CODE=" + id,
        url: baseUrl + `aps/acaprvform/index?PERSON_ID=${$("#personid").val()}&JOBAGREECONF_CODE=` + id,
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
                        data: "ACAPRVFORM_ID",
                        width: "20%",
                        render: function (data, type, row) {
                            return formatDateByLang(row.ACAPRVFORM_SDATE, lang) + " - " + formatDateByLang(row.ACAPRVFORM_EDATE, lang);
                        },
                    },

                    {
                        data: "ACAPRVFORM_FILE",
                        width: "30%",
                        render: function (data, type, row) {
                            return data
                                ? '<a href="' +
                                      baseUrl +
                                      "aps/unit/download?fileName=" +
                                      data +
                                      '" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;<span name="render_1"></span></a>'
                                : "";
                        },
                    },

                    {
                        data: "ISDELETE",
                        width: "10%",
                        render: function (data, type, row) {
                            return `${data ? `<i class="fa fa-check-square-o" style="color: #00c900"></i>` : `<i class="fa fa-square-o" style="color: gray"></i>`}`;
                        },
                    },

                    {
                        data: "ACAPRVFORM_ID",
                        width: "10%",
                        render: function (data, type, row) {
                            let strHtml = "";
                            if (row.ISUPDATE)
                                strHtml += `<button type="button" class="btn btn-outline-secondary btn-sm btn-edit bEdit" onClick="editForm(${data});"><i class="fa fa-edit"></i>&nbsp;<span name="btn_20"></span></button>  `;

                            if (row.ISDELETE)
                                strHtml += `<button type="button" class="btn btn-outline-danger btn-sm btn-delete" onClick="deleteAcaprv(${data});"><i class="fa fa-trash"></i>&nbsp;<span name="btn_40"></span></button>`;

                            return strHtml;
                        },
                    },
                ],
                columnDefs: [{ className: "text-center", targets: [1, 2, 3, 4] }],
                order: [],
                drawCallback: function () {
                    labelRender();
                },
            });
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
        drawLevel(formType, function () {
            configDate();
            labelRender();
        });
    });
}

function drawLevel(formType, callBack) {
    $.ajax({
        url: baseUrl + "aps/acaprvform/dispddl?JOBAGREECONF_CODE=" + formType,
        type: "GET",
        dataType: "json",
        success: function (data) {
            let resultHtml = "";

            // $("#nameJoblevel4").html(`<i class="fa fa-caret-right" style="color: red;"></i>&nbsp;&nbsp;${data.dt[0].JOBAGREECONF_NAME}`);
            $("#nameJoblevel4").html(`${data.dt[0].JOBAGREECONF_NAME}`);
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

                    resultHtml += `<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>`;

                    // resultHtml += `<div class="row">`;
                    // resultHtml += `<div class="col-1"></div>`;
                    // resultHtml += `<div class="col-11">`;

                    if (hasChildren) {
                        // resultHtml += `<i class="fa fa-caret-right" style="color: red;"></i>&nbsp;&nbsp;<label class="custom-control custom-radio custom-control-inline">${data.dt[i].JOBAGREECONF_NAME}</label><br>`;
                        resultHtml += `<label class="custom-control custom-radio custom-control-inline">${data.dt[i].JOBAGREECONF_NAME}</label><br>`;
                    } else {
                        resultHtml += `<label class="custom-control custom-radio custom-control-inline">`;
                        resultHtml += `<input type="radio" class="custom-control-input" name="formLevel" id="fid_${data.dt[i].JOBAGREECONF_CODE}" value="${data.dt[i].JOBAGREECONF_CODE}">`;
                        resultHtml += `&nbsp;&nbsp;&nbsp;<span class="mb-0">${data.dt[i].JOBAGREECONF_NAME}</span>`;
                        resultHtml += `</label>`;
                        resultHtml += `<br>`;
                    }

                    resultHtml += buildTree(data.dt, data.dt[i].JOBAGREECONF_ID);

                    // resultHtml += `</div>`;
                    // resultHtml += `</div>`;

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

            strHtml += `<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>`;

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

                formData.append("ACAPRVFORM_EDATE", dateByLangForSave($("#acaprvform_edate").val(), lang));
                if (files.length > 0) formData.append("ACAPRVFORM_FILE", files[0], files[0].name);
                formData.append("ACAPRVFORM_SDATE", dateByLangForSave($("#acaprvform_sdate").val(), lang));
                formData.append("PERSON_ID", localStorage.getItem("personid"));
                formData.append("USER_CREATED", localStorage.getItem("personid"));
                formData.append("JOBAGREECONF_CODE", $("input[name='formLevel']:checked").val() ? $("input[name='formLevel']:checked").val() : localStorage.getItem("formTypeid"));
                formData.append("ACAPRVFORM_TITLE", $("#acaprvform_title").val());
                formData.append("ACAPRVFORM_DESC_ST", $("#acaprvform_desc_st").val());

                if (formList) formData.append("ACAPRVFORM_ID", formList);

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
                    $("#acaprvform_sdate").val(formatDateNumByLang(i.ACAPRVFORM_SDATE, lang));
                    $("#acaprvform_edate").val(formatDateNumByLang(i.ACAPRVFORM_EDATE, lang));

                    if ($(`#fid_${i.JOBAGREECONF_CODE}`).length > 0) {
                        document.getElementById(`fid_${i.JOBAGREECONF_CODE}`).checked = true;
                    }

                    if (i.ACAPRVFORM_FILE)
                        $("#divDocfile").append(
                            `<br><br><a href="${baseUrl}aps/unit/download?fileName=${i.ACAPRVFORM_FILE}" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;<span name="render_1"></span></a>`
                        );

                    if (!i.ISUPDATE) {
                        $("#acaprvform_title").prop("disabled", true);
                        $("#acaprvform_desc_st").prop("disabled", true);
                        $("#acaprvform_sdate").prop("disabled", true);
                        $("#acaprvform_edate").prop("disabled", true);
                        $("#acaprvform_File").prop("disabled", true);

                        document.getElementById("bSave").style.display = "none";
                    }

                    configDate();
                    labelRender();
                }
            });
        });
    });
}

function configDate() {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth() + 1;

    let rangeDate = new Date(`${month >= 10 ? year + 1 : year}-${`0` + (month + 4)}-${new Date(month >= 10 ? year + 1 : year, month + 4, 0).getDate()}`);

    $(".datepicker_input").datepicker({
        autoclose: true,
        endDate: rangeDate,
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

function chkDate() {
    document.getElementById("alertTxtdate").style.display = "none";
    if ($("#acaprvform_sdate").val() && $("#acaprvform_edate").val()) {
        if ($("#acaprvform_sdate").val() <= $("#acaprvform_edate").val()) {
            // console.log("วันที่เริ่มต้นไม่น้อยกว่าหรือเท่ากับวันที่สิ้นสุด");
        } else {
            // console.log("วันที่เริ่มต้นมากกว่าวันที่สิ้นสุด");
            $("#acaprvform_edate").val("");
            document.getElementById("alertTxtdate").style.display = "block";
        }
    }
}

function checkFileSize(input) {
    if (input.files.length > 0) {
        var fileSizeInBytes = input.files[0].size;
        var fileSizeInMB = fileSizeInBytes / (1024 * 1024);
        if (fileSizeInMB > 10) {
            alert("ไฟล์ที่เลือกมีขนาดเกิน 10 MB");
            document.getElementById("alertFile").style.color = "red";
            input.value = "";
        } else {
            document.getElementById("alertFile").style.color = "#113f50";
        }
    }
}

function bypass(formType, key, personid) {
    localStorage.setItem("personid", personid);
    localStorage.setItem("id", formType);

    drawLevel(formType, function () {
        $.ajax({
            url: baseUrl + `aps/acaprvform/index?PERSON_ID=${personid}&JOBAGREECONF_CODE=` + formType,
            type: "GET",
            dataType: "json",
            success: function (data) {
                for (i = 0; i < data.dt.length; i++) {
                    if (data.dt[i].ACAPRVFORM_ID == key) {
                        $("#acaprvform_title").val(data.dt[i].ACAPRVFORM_TITLE);
                        $("#acaprvform_desc_st").val(data.dt[i].ACAPRVFORM_DESC_ST);
                        $("#acaprvform_sdate").val(formatDateNumByLang(data.dt[i].ACAPRVFORM_SDATE, lang));
                        $("#acaprvform_edate").val(formatDateNumByLang(data.dt[i].ACAPRVFORM_EDATE, lang));

                        if (data.dt[i].ACAPRVFORM_FILE)
                            $("#divDocfile").append(
                                `<br><br><a href="${baseUrl}aps/unit/download?fileName=${data.dt[i].ACAPRVFORM_FILE}" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;<span name="render_1"></span></a>`
                            );

                        if (!data.dt[i].ISUPDATE) {
                            $("#acaprvform_title").prop("disabled", true);
                            $("#acaprvform_desc_st").prop("disabled", true);
                            $("#acaprvform_sdate").prop("disabled", true);
                            $("#acaprvform_edate").prop("disabled", true);

                            $("#docFile").prop("disabled", true);

                            document.getElementById("bSave").style.display = "none";
                        }

                        if ($(`#fid_${data.dt[i].JOBAGREECONF_CODE}`).length > 0) document.getElementById(`fid_${data.dt[i].JOBAGREECONF_CODE}`).checked = true;

                        configDate();
                        labelRender();
                    }
                }

                $.ajax({
                    url: baseUrl + "aps/acaprvform/dispddl?JOBAGREECONF_CODE=" + formType,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.dt.length > 0) {
                            $("#divPath").append(
                                `&nbsp;<i class="fa fa-caret-right" style="color: red;"></i>&nbsp;&nbsp;<span>${data.dt[0].PARENTTOCHILDTXT.replaceAll(
                                    "/",
                                    `&nbsp;&nbsp;<i class="fa fa-caret-right" style="color: red;"></i>&nbsp;&nbsp;`
                                )}</span>`
                            );
                        }

                        insertDiv("AcaprvForm");
                    },
                    error: function () {
                        console.log("Error in Operation");
                    },
                });
            },
            error: function () {
                console.log("Error in Operation");
            },
        });
    });
}

function insertDiv(formName) {
    // เลือกแบบฟอร์มที่ต้องการครอบ
    var form = document.getElementById(formName);

    // สร้าง <div> ที่ต้องการแทรก
    var div = document.createElement("div");
    div.className = "site-index";
    div.id = "menuCard";

    // เลือกโหนดหรือตำแหน่งที่ต้องการแทรก div เข้าไป ซึ่งอาจเป็นตำแหน่งหลังแบบฟอร์มที่คุณต้องการครอบ
    var parentNode = form.parentNode;

    // ทำการแทรก div ลงในโครงสร้าง
    parentNode.insertBefore(div, form);

    // เพิ่มแบบฟอร์มเข้าไปใน div
    div.appendChild(form);
}
