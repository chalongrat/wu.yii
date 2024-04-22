// *⁡⁣⁣⁢++++++++++++++++++++++++++++++++++++ :: Label :: +++++++++++++++++++++++++++++++++++++⁡⁣⁣⁢+++++++
// var arrJob = [];
var lang = $("#lang").val();

function labelRender() {
    renderLabel("aps-job", lang, "apsJob");
    renderLabel("set-btn", lang, "setBtn");
}

// *⁡⁣⁣⁢++++++++++++++++++++++++++++++++++++ :: End :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢+++++++++++++

// เรียกใช้งานฟังก์ชันเพื่อตรวจสอบไฟล์ JavaScript
$(document).ready(function () {
    // เรียกใช้งานฟังก์ชันเพื่อหา path ของไฟล์ที่ต้องการ
    var filePath = getFilePath("cultureForm.js");
});

function loadData(id = null) {
    localStorage.setItem("personid", $("#personid").val());
    localStorage.setItem("formTypeid", id);

    if (id != null && id != "") localStorage.setItem("id", id);
    else id = localStorage.getItem("id");

    console.log(baseUrl + `aps/cultureform/index?PERSON_ID=${$("#personid").val()}&JOBAGREECONF_CODE=` + id);

    $.ajax({
        url: baseUrl + `aps/cultureform/index?PERSON_ID=${$("#personid").val()}&JOBAGREECONF_CODE=` + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            localStorage.setItem("jsonCulture", JSON.stringify(data.dt));

            $("#tbCultureform").dataTable({
                data: data.dt,
                columns: [
                    { data: "CULTUREFORM_TITLE", width: "40%" },

                    {
                        data: "CULTUREFORM_ID",
                        width: "20%",
                        render: function (data, type, row) {
                            return formatDateByLang(row.CULTUREFORM_SDATE, lang) + " - " + formatDateByLang(row.CULTUREFORM_EDATE, lang);
                        },
                    },

                    {
                        data: "CULTUREFORM_FILE",
                        width: "10%",
                        render: function (data, type, row) {
                            return data
                                ? '<a href="' +
                                      baseUrl +
                                      "aps/unit/download?fileName=" +
                                      data +
                                      '" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;' +
                                      `<span name="render_1"></span>` +
                                      "</a>"
                                : "";
                        },
                    },

                    {
                        data: "ISUSED",
                        width: "10%",
                        render: function (data, type, row) {
                            return `${data ? `<i class="fa fa-check-square-o" style="color: #00c900"></i>` : `<i class="fa fa-square-o" style="color: gray"></i>`}`;
                        },
                    },

                    {
                        data: "CULTUREFORM_ID",
                        width: "10%",
                        render: function (data, type, row) {
                            let strHtml = "";
                            // if (row.ISUPDATE) {
                            //     strHtml += `<button type="button" class="btn btn-outline-secondary btn-sm btn-edit bEdit" onClick="editForm(${data});"><i class="fa fa-edit"></i>&nbsp;<span name="btn_20"></span></button>  `;
                            //     strHtml += `<button type="button" class="btn btn-outline-danger btn-sm btn-delete" onClick="deleteJob(${data});"><i class="fa fa-trash"></i>&nbsp;<span name="btn_40"></span></button>`;
                            // } else {
                            //     strHtml += `<button type="button" class="btn btn-outline-secondary btn-sm btn-edit bEdit" onClick="editForm(${data});"><i class="fa fa-edit"></i>&nbsp;<span name="btn_20"></span></button>  `;
                            // }

                            if (row.ISUPDATE)
                                strHtml += `<button type="button" class="btn btn-outline-secondary btn-sm btn-edit bEdit" onClick="editForm(${data});"><i class="fa fa-edit"></i>&nbsp;<span name="btn_20"></span></button>  `;

                            if (row.ISDELETE)
                                strHtml += `<button type="button" class="btn btn-outline-danger btn-sm btn-delete" onClick="deleteJob(${data});"><i class="fa fa-trash"></i>&nbsp;<span name="btn_40"></span></button>`;

                            return strHtml;
                        },
                    },
                ],
                columnDefs: [{ className: "text-center", targets: [1, 2, 3, 4] }],
                // ordering: false,
                order: [],
                drawCallback: function () {
                    labelRender();
                },
            });
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(xhr.status);
            console.log(status);
            console.log(error);

            console.log("error");
        },
    });
}

function saveData(formList) {
    let apiType = "aps/cultureform/";

    apiType += formList ? "updated" : "stored";

    $("#formCultureForm").submit(function (event) {
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
                var xobj = $("#docFile");
                var xobj2 = xobj[0];
                var files = xobj2.files;
                var formData = new FormData();

                formData.append("CULTUREFORM_TITLE", $("#cultureTitle").val());
                formData.append("CULTUREFORM_SDATE", dateByLangForSave($("#cultureSdate").val(), lang));
                formData.append("CULTUREFORM_DESC_ST", $("#cultureDesc").val());
                formData.append("CULTUREFORM_EDATE", dateByLangForSave($("#cultureEdate").val(), lang));

                if (files.length > 0) formData.append("CULTUREFORM_FILE", files[0], files[0].name);
                formData.append("PERSON_ID", localStorage.getItem("personid"));
                formData.append("USER_CREATED", localStorage.getItem("personid"));
                formData.append("JOBAGREECONF_CODE", localStorage.getItem("id"));

                if (formList) formData.append("CULTUREFORM_ID", formList);

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
                            $.loadPage(`/cultureform/index?id=${localStorage.getItem("formTypeid")}`, "callBack");
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
    $.loadPage(`/cultureform/culeditform?formListID=${key}`, "แก้ไขภาระงาน", function () {
        JSON.parse(localStorage.getItem("jsonCulture")).forEach(function (i) {
            if (i.CULTUREFORM_ID == key) {
                $("#cultureTitle").val(i.CULTUREFORM_TITLE);
                $("#cultureSdate").val(formatDateNumByLang(i.CULTUREFORM_SDATE, lang));
                $("#cultureEdate").val(formatDateNumByLang(i.CULTUREFORM_EDATE, lang));
                $("#cultureDesc").val(i.CULTUREFORM_DESC_ST);

                if (i.CULTUREFORM_FILE)
                    $("#divDocfile").append(
                        `<br><br><a href="${baseUrl}aps/unit/download?fileName=${i.CULTUREFORM_FILE}" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;<span name="render_1"></span></a>`
                    );

                if (!i.ISUPDATE) {
                    $("#cultureTitle").prop("disabled", true);
                    $("#cultureSdate").prop("disabled", true);
                    $("#cultureEdate").prop("disabled", true);
                    $("#cultureDesc").prop("disabled", true);
                    $("#docFile").prop("disabled", true);

                    document.getElementById("bSave").style.display = "none";
                }

                configDate();
                labelRender();
            }
        });
    });
}

function openForm(formListID, formType) {
    $.loadPage(`/cultureform/culeditform?formListID=${formListID}&formType=${formType}`, "", function () {
        configDate();
        labelRender();
    });
}

function configDate() {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth() + 1;

    let rangeDate = new Date(`${month >= 10 ? year + 1 : year}-${`0` + (month + 4)}-${new Date(month >= 10 ? year + 1 : year, month + 4, 0).getDate()}`);

    $(".datepicker_input").datepicker({
        // language: lang == "th" ? "th-th" : "en-en",
        autoclose: true,
        endDate: rangeDate,
    });
}

function deleteJob(idJob) {
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
                url: baseUrl + "aps/cultureform/destroyed",
                type: "DELETE",
                dataType: "json",
                data: {
                    CULTUREFORM_ID: idJob,
                },
                success: function () {
                    Swal.fire({
                        title: "บันทึกสำเร็จ !",
                        icon: "success",
                    });
                    $.loadPage(`/cultureform/index?id=${localStorage.getItem("formTypeid")}`, "callBack");
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

function getFilePath(filename) {
    var scripts = document.getElementsByTagName("script");
    for (var i = 0; i < scripts.length; i++) {
        var src = scripts[i].src;
        if (src.indexOf(filename) !== -1) {
            return src;
        }
    }
    // หากไม่พบไฟล์ที่ต้องการ
    return null;
}

function chkDate() {
    document.getElementById("alertTxtdate").style.display = "none";
    if ($("#cultureSdate").val() && $("#cultureEdate").val()) {
        if ($("#cultureSdate").val() <= $("#cultureEdate").val()) {
            // console.log("วันที่เริ่มต้นไม่น้อยกว่าหรือเท่ากับวันที่สิ้นสุด");
        } else {
            // console.log("วันที่เริ่มต้นมากกว่าวันที่สิ้นสุด");
            $("#cultureEdate").val("");
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

    $.ajax({
        url: baseUrl + `aps/cultureform/index?PERSON_ID=${personid}&JOBAGREECONF_CODE=` + formType,
        type: "GET",
        dataType: "json",
        success: function (data) {
            console.log(lang);
            console.log(data);

            for (i = 0; i < data.dt.length; i++) {
                if (data.dt[i].CULTUREFORM_ID == key) {
                    $("#cultureTitle").val(data.dt[i].CULTUREFORM_TITLE);
                    $("#cultureSdate").val(formatDateNumByLang(data.dt[i].CULTUREFORM_SDATE, lang));
                    $("#cultureEdate").val(formatDateNumByLang(data.dt[i].CULTUREFORM_EDATE, lang));

                    $("#cultureDesc").val(data.dt[i].CULTUREFORM_DESC_ST);

                    if (data.dt[i].CULTUREFORM_FILE)
                        $("#divDocfile").append(
                            `<br><br><a href="${baseUrl}aps/unit/download?fileName=${data.dt[i].CULTUREFORM_FILE}" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;<span name="render_1"></span></a>`
                        );

                    if (!data.dt[i].ISUPDATE) {
                        $("#cultureTitle").prop("disabled", true);
                        $("#cultureSdate").prop("disabled", true);
                        $("#cultureEdate").prop("disabled", true);
                        $("#cultureDesc").prop("disabled", true);
                        $("#docFile").prop("disabled", true);

                        document.getElementById("bSave").style.display = "none";
                    }

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

                    insertDiv("formCultureForm");
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
