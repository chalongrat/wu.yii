// *⁢++++++++++++++++++++++++++++++++++++ :: Label :: +++++++++++++++++++++++++++++++++++++⁡⁣⁣⁢++++++++++
var lang = $("#lang").val();

function labelRender() {
    renderLabel("aps-job", lang, "apsJob");
    renderLabel("set-btn", lang, "setBtn");
}

// *⁢++++++++++++++++++++++++++++++++++++ :: End :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢++++++++++++++++

// ?++++++++++++++++++++++++++++++++++++ :: Render :: +++++++++++++++++++++++++++++++++++⁡++++++++
$(document).ready(function () {
    // console.log($("#formID").val());
});
// ?⁢++++++++++++++++++++++++++++++++++++ :: End :: ++++++++++++++++++++++++++++++++++++++++++++++

// TODO+++++++++++++++++++++++++++++++++ :: View :: +++++++++++++++++++++++++++++++++++++++++++++
function loadData(id = null) {
    localStorage.setItem("personid", $("#personid").val());
    localStorage.setItem("formTypeid", id);

    if (id != null && id != "") localStorage.setItem("id", id);
    else id = localStorage.getItem("id");

    $.ajax({
        // url: baseUrl + "aps/researchform/index?PERSON_ID=4510070321&JOBAGREECONF_CODE=" + id,
        url: baseUrl + `aps/researchform/index?PERSON_ID=${$("#personid").val()}&JOBAGREECONF_CODE=` + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            localStorage.setItem("jsonXxxx", JSON.stringify(data.dt));

            // โหลด data ใน dll
            setPerson();

            let i = 1;
            $("#tbSubresformoth").dataTable({
                data: data.dt,
                columns: [
                    { data: "RES_ID", width: "5%", render: () => i++ },

                    {
                        data: "RES_TITLE",
                        width: "20%",
                        render: function (data, type, row) {
                            let strPath = "";
                            strPath += `<b><span name="subres_15"></span></b> ${data ? data : ""} <br>`;
                            strPath += `<b><span name="subres_13"></span></b> ${row.RES_DESC ? row.RES_DESC : ""} <br>`;
                            strPath += `<b><span name="subres_14"></span></b> ${
                                row.RES_FILE != null
                                    ? `<a href="${baseUrl}aps/unit/download?fileName=${row.RES_FILE}" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;<span name="render_1"></span></a>`
                                    : ""
                            }`;

                            return strPath;
                        },
                    },

                    {
                        data: "RES_SDATE",
                        width: "10%",
                        render: function (data, type, row) {
                            // return formatDateENtoTH(data) + " - " + formatDateENtoTH(row.RES_EDATE);
                            return formatDateByLang(row.RES_SDATE, lang) + " - " + formatDateByLang(row.RES_EDATE, lang);
                        },
                    },

                    {
                        data: "RES_ID",
                        width: "20%",
                        render: function (data, type, row) {
                            let strPath = "";
                            let sumRatio = 0;

                            if (row.RES_DESC_ND) {
                                let arrStr = JSON.parse(row.RES_DESC_ND);

                                for (let i = 0; i < arrStr["PERSON"].length; i++) {
                                    let currentItem = arrStr["PERSON"][i];
                                    strPath += `<div class="row rowRes_${data}" id="idJob_${data}_${i}" person="${currentItem.PERSON_ID}" ratio="${currentItem.RATIO}">`;

                                    strPath += `<div class="col-md-8">`;
                                    strPath += `<span>${currentItem.FULLNAME}</span>&nbsp;&nbsp;&nbsp;&nbsp;`;
                                    strPath += `</div>`;

                                    strPath += `<div class="col-md-2">`;
                                    strPath += `<span>${currentItem.RATIO}  %</span>&nbsp;&nbsp;&nbsp;&nbsp;`;
                                    sumRatio += parseInt(currentItem.RATIO);
                                    strPath += `</div>`;

                                    strPath += `<div class="col-md-2 text-left">`;
                                    strPath += `<i type="button" class="fa fa-trash" style="color: red;" title="ลบ" onClick="deletePerson(${data},${currentItem.PERSON_ID});"></i><br>`;
                                    strPath += `</div>`;

                                    strPath += `</div>`;
                                }
                            }

                            strPath += `<br>`;
                            strPath += `<div class="text-center">`;
                            strPath += `<button type="button" class="btn btn-warning" id="openModalBtn" onClick="editResdesc(${data},${sumRatio});"><span name="render_3"></span></button>`;

                            strPath += `<input type="hidden" id="sumRatio_${data}" value="${sumRatio}">`;

                            strPath += `<br><small id="alertRatioBT_${data}" style="color: red; display: none;">**สัดส่วนการเขียน 100% แล้ว</small>`;
                            strPath += `</div>`;

                            return strPath;
                        },
                    },

                    {
                        data: "FULL_PERSON",
                        width: "10%",
                        render: function (data, type, row) {
                            return data.replaceAll("\n", "<br>");
                        },
                    },

                    {
                        data: "RES_STATUS",
                        width: "10%",
                        render: function (data, type, row) {
                            return `${data ? `<i class="fa fa-check-square-o" style="color: #00c900"></i>` : `<i class="fa fa-square-o" style="color: gray"></i>`}`;
                        },
                    },

                    {
                        data: "RES_ID",
                        width: "10%",
                        render: function (data, type, row) {
                            var strHtml = "";
                            // if (row.RES_STATUS != 1) {
                            //     strHtml += `<button type="button" class="btn btn-outline-secondary btn-sm btn-edit bEdit" onClick="editForm(${data});"><i class="fa fa-edit"></i>&nbsp;<span name="btn_20"></span></button>  `;
                            //     strHtml += `<button type="button" class="btn btn-outline-danger btn-sm btn-delete" onClick="deleteSubres(${data});"><i class="fa fa-trash"></i>&nbsp;<span name="btn_40"></span></button>`;
                            // } else
                            //     strHtml += `<button type="button" class="btn btn-outline-info btn-sm btn-delete" onClick="editForm(${data});"><i class="fa fa-eye" ></i>&nbsp;<span name="btn_130"></span></button>`;

                            if (row.ISUPDATE)
                                strHtml += `<button type="button" class="btn btn-outline-secondary btn-sm btn-edit bEdit" onClick="editForm(${data});"><i class="fa fa-edit"></i>&nbsp;<span name="btn_20"></span></button>  `;

                            if (row.ISDELETE)
                                strHtml += `<button type="button" class="btn btn-outline-danger btn-sm btn-delete" onClick="deleteSubres(${data});"><i class="fa fa-trash"></i>&nbsp;<span name="btn_40"></span></button>`;

                            if (row.ISDELETE != 1 || row.ISUPDATE != 1)
                                strHtml += `<button type="button" class="btn btn-outline-info btn-sm btn-delete" onClick="editForm(${data});"><i class="fa fa-eye" ></i>&nbsp;<span name="btn_130"></span></button>`;

                            return strHtml;
                        },
                    },
                ],
                columnDefs: [{ className: "text-center", targets: [0, 2, 5, 6] }],
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
// TODO⁣+++++++++++++++++++++++++++++++++ :: End :: ++++++++++++++++++++++++++++++++++++++++++++++
function deleteSubres(subresId) {
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
                url: baseUrl + "aps/researchform/destroyed",
                type: "DELETE",
                dataType: "json",
                data: {
                    RES_ID: subresId,
                },
                success: function () {
                    Swal.fire({
                        title: "บันทึกสำเร็จ !",
                        icon: "success",
                    });
                    $.loadPage(`/subresformoth/?formType=${$("#formID").val()}`, "");
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

function editForm(key) {
    $.loadPage(`/subresformoth/subresform?formListID=${key}&formType=${localStorage.getItem("formTypeid")}`, "แก้ไขภาระงาน", function () {
        drawLevel(localStorage.getItem("formTypeid"), function () {
            JSON.parse(localStorage.getItem("jsonXxxx")).forEach(function (i) {
                if (i.RES_ID == key) {
                    document.getElementById(`fid_${i.JOBAGREECONF_CODE}`).checked = true;
                    $("#subres_title").val(i.RES_TITLE);
                    $("#subres_desc_st").val(i.RES_DESC);
                    $("#subres_sdate").val(formatDateNumByLang(i.RES_SDATE, lang));
                    $("#subres_edate").val(formatDateNumByLang(i.RES_EDATE, lang));
                    $("#subres_desc_publish").val(i.RES_DESC_PUBLISH);

                    drawPerson(JSON.parse(i.RES_DESC_ND));

                    $("#subres_desc").val(i.RES_DESC_PUBLISH);

                    if (i.RES_FILE)
                        $("#divDocfile").append(
                            `<br><br><a href="${baseUrl}aps/unit/download?fileName=${i.RES_FILE}" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;<span name="render_1"></span></a>`
                        );

                    if (i.RES_STATUS == 1) {
                        $("#subres_title").prop("disabled", true);
                        $("#subres_desc_st").prop("disabled", true);
                        $("#subres_sdate").prop("disabled", true);
                        $("#subres_edate").prop("disabled", true);
                        $("#subres_desc_publish").prop("disabled", true);
                        $("#slPersonForm").prop("disabled", true);
                        $(".inputratio").prop("disabled", true);
                        $("#subres_File").prop("disabled", true);

                        var elements = document.getElementsByClassName("fa-trash");
                        for (var i = 0; i < elements.length; i++) {
                            elements[i].style.display = "none";
                        }

                        var redioElements = document.getElementsByClassName("custom-control-input");
                        for (var i = 0; i < redioElements.length; i++) {
                            redioElements[i].disabled = true;
                        }

                        document.getElementById("bSaveForm").style.display = "none";
                    }

                    labelRender();
                    setDDLperson();
                    configDate();
                }
            });
        });
    });
}

function drawPerson(personList) {
    for (var i = 0; i < personList["PERSON"].length; i++) {
        drawListgroup(personList["PERSON"][i].FULLNAME, personList["PERSON"][i].PERSON_ID, personList["PERSON"][i].RATIO);
    }
}

function setPerson(callback) {
    $.ajax({
        url: baseUrl + "aps/researchform/dispperson",
        type: "GET",
        dataType: "json",
        success: function (data) {
            localStorage.setItem("jsonPerson", JSON.stringify(data.dt));
            callback();
        },
        error: function () {
            console.log("Error in Operation");
        },
    });
}

function editResdesc(resId, sumRatio) {
    if (sumRatio >= 100) {
        $("#alertRatioBT_" + resId).show();
        return;
    }

    let strHtml = `<div class="text-left">`;
    strHtml += `<span>ชื่อผู้เขียน</span>`;

    strHtml += `<select class="form-select" aria-label="Default select example" id="slPersonForm" onchange="ocPerson(this);"></select>`;
    strHtml += `<small id="alertModalperson" style="color: red; display: none;">**ไม่สามารถเพิ่มซ้ำได้</small>`;
    strHtml += `<small id="alertModalpersonNull" style="color: red; display: none;">**โปรดเลือกผู้ร่วมสร้างผลงาน</small>`;

    strHtml += `<br>`;
    strHtml += `<br>`;
    strHtml += `<span>สัดส่วนการเขียน </span> <sapn style="color: #0a950a;">กรอกไปแล้ว ${sumRatio}%</span> <sapn style="color: red;">ขาด ${100 - sumRatio}%</span>`;
    strHtml += `<input type="number" id="subres_retio" class="form-control" oninput="checkInput(this, ${sumRatio != 0 ? sumRatio : null})" required>`;
    strHtml += `<small id="alertModalratio" style="color: red; display: none;">**กรอกได้เฉพาะตัวเลข</small>`;
    strHtml += `<small id="alertModalratio100" style="color: red; display: none;">**สัดส่วนการเขียนไม่เกิน 100</span></small>`;
    strHtml += `<small id="alertModalratiosumRatio" style="color: red; display: none;">**สัดส่วนการเขียนไม่เกิน <span id="idMaxratio"></span></small>`;

    strHtml += `<br>`;
    strHtml += `</div>`;

    $("#modalDiv").html(strHtml);
    setDDLperson();

    let strModalBtn = "";

    strModalBtn += `<button type="button" class="btn btn-primary" onClick="savePerson(${resId});" id="btnSave">บันทึก</button> `;
    strModalBtn += `<button type="button" class="btn btn-secondary" onClick='document.getElementById("myModal").style.display = "none"' id="btnCancel">ยกเลิก</button>`;

    $("#modalBtn").html(strModalBtn);

    $("#slPersonForm").select2({
        width: "100%", // ปรับเป็นค่าที่ต้องการ
    });

    document.getElementById("myModal").style.display = "block";
    document.getElementById("myModal").classList.add("animate__animated", "animate__fadeIn");
    // document.getElementById("myModal").classList.add("animate__animated", "animate__bounceIn");
}

function savePerson(resID) {
    // Verify ------------------------------------------------------------------------------------------------
    if (!$("#slPersonForm").val()) {
        $("#alertModalpersonNull").show();
        return;
    }

    for (i = 0; i < $(".rowRes_" + resID).length; i++) {
        if ($("#slPersonForm").val() == $(`#idJob_${resID}_${i}`).attr("person")) {
            $("#alertModalperson").show();
            return;
        }
    }

    var regex = /^[0-9]+$/;
    if (!regex.test($("#subres_retio").val())) {
        $("#alertModalratio").show();
        return;
    }

    if ($("#subres_retio").val() > 100 - $("#sumRatio_" + resID).val()) return;
    if ($("#subres_retio").val() > 100) return;

    Swal.fire({
        title: "ยืนยันการบันทึกข้อมูล ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "OK",
    }).then((result) => {
        if (result.isConfirmed) {
            let attStr = [];
            JSON.parse(localStorage.getItem("jsonXxxx")).forEach(function (i) {
                if (i.RES_ID == resID) {
                    let strGify = [];
                    if (i.RES_DESC_ND) {
                        strGify = JSON.parse(i.RES_DESC_ND);

                        JSON.parse(localStorage.getItem("jsonPerson")).forEach(function (j) {
                            if (j.PERSON_ID == $("#slPersonForm").val()) {
                                strGify["PERSON"].push({
                                    FULLNAME: j.FULL_NAME,
                                    PERSON_ID: $("#slPersonForm").val(),
                                    RATIO: $("#subres_retio").val(),
                                });
                            }
                        });
                    } else {
                        JSON.parse(localStorage.getItem("jsonPerson")).forEach(function (j) {
                            if (j.PERSON_ID == $("#slPersonForm").val()) {
                                strGify = {
                                    PERSON: [],
                                };

                                let personData = [];

                                personData = {
                                    FULLNAME: j.FULL_NAME,
                                    PERSON_ID: $("#slPersonForm").val(),
                                    RATIO: $("#subres_retio").val(),
                                };

                                strGify["PERSON"].push(personData);
                            }
                        });
                    }

                    i.RES_DESC_ND = JSON.stringify(strGify);
                    attStr = i;
                }
            });

            $.ajax({
                url: baseUrl + "aps/researchform/stored",
                type: "POST",
                data: attStr,
                success: function (response) {
                    Swal.fire({
                        title: "บันทึกสำเร็จ !",
                        icon: "success",
                    });
                    $.loadPage(`/subresformoth/?formType=${$("#formID").val()}`, "");
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
    // End ------------------------------------------------------------------------------------------------

    // let attStr = [];
    // JSON.parse(localStorage.getItem("jsonXxxx")).forEach(function (i) {
    //     if (i.RES_ID == resID) {
    //         let strGify = [];
    //         if (i.RES_DESC_ND) {
    //             strGify = JSON.parse(i.RES_DESC_ND);

    //             JSON.parse(localStorage.getItem("jsonPerson")).forEach(function (j) {
    //                 if (j.PERSON_ID == $("#slPerson").val()) {
    //                     strGify["PERSON"].push({
    //                         FULLNAME: j.FULL_NAME,
    //                         PERSON_ID: $("#slPerson").val(),
    //                         RATIO: $("#subres_retio").val(),
    //                     });
    //                 }
    //             });
    //         } else {
    //             JSON.parse(localStorage.getItem("jsonPerson")).forEach(function (j) {
    //                 if (j.PERSON_ID == $("#slPerson").val()) {
    //                     strGify = {
    //                         PERSON: [],
    //                     };

    //                     let personData = [];

    //                     personData = {
    //                         FULLNAME: j.FULL_NAME,
    //                         PERSON_ID: $("#slPerson").val(),
    //                         RATIO: $("#subres_retio").val(),
    //                     };

    //                     strGify["PERSON"].push(personData);
    //                 }
    //             });
    //         }

    //         i.RES_DESC_ND = JSON.stringify(strGify);

    //         attStr = i;
    //     }
    // });

    // $.ajax({
    //     url: baseUrl + "aps/researchform/updated",
    //     type: "POST",
    //     data: attStr,
    //     success: function (response) {
    //         $.loadPage(`/subresformoth/?formType=${$("#formID").val()}`, "");
    //     },
    //     error: function (xhr, status, error) {
    //         console.error("XHR status:", xhr.status);
    //         console.error("Status:", status);
    //         console.error("Error:", error);
    //     },
    // });
}

function ocPerson() {
    $("#alertModalperson").hide();
    $("#alertModalpersonNull").hide();
}

function deletePerson(resID, personid) {
    let setFullname = "";
    JSON.parse(localStorage.getItem("jsonPerson")).forEach(function (optionData) {
        if (optionData.PERSON_ID == personid) setFullname = optionData.FULL_NAME;
    });

    Swal.fire({
        title: "ยืนยันการลบผู้สร้างผลงาน ?",
        text: `ต้องการลบ ${setFullname}`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "OK",
    }).then((result) => {
        if (result.isConfirmed) {
            let attStr = [];
            JSON.parse(localStorage.getItem("jsonXxxx")).forEach(function (i) {
                if (i.RES_ID == resID) {
                    let strGify = JSON.parse(i.RES_DESC_ND);

                    var indexToDelete = strGify["PERSON"].findIndex(function (item) {
                        return item.PERSON_ID === personid;
                    });

                    strGify["PERSON"].splice(indexToDelete, 1);
                    i.RES_DESC_ND = JSON.stringify(strGify);
                    attStr = i;
                }
            });

            $.ajax({
                url: baseUrl + "aps/researchform/stored",
                type: "POST",
                data: attStr,
                success: function (response) {
                    Swal.fire({
                        title: "บันทึกสำเร็จ !",
                        icon: "success",
                    });
                    $.loadPage(`/subresformoth/?formType=${$("#formID").val()}`, "");
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

    // let attStr = [];
    // JSON.parse(localStorage.getItem("jsonXxxx")).forEach(function (i) {
    //     if (i.RES_ID == resID) {
    //         let strGify = JSON.parse(i.RES_DESC_ND);

    //         var indexToDelete = strGify["PERSON"].findIndex(function (item) {
    //             return item.PERSON_ID === personid;
    //         });

    //         // if (indexToDelete !== -1) {
    //         //     strGify["PERSON"].splice(indexToDelete, 1);
    //         // }

    //         strGify["PERSON"].splice(indexToDelete, 1);
    //         i.RES_DESC_ND = JSON.stringify(strGify);
    //         attStr = i;
    //     }
    // });

    // $.ajax({
    //     url: baseUrl + "aps/researchform/updated",
    //     type: "POST",
    //     data: attStr,
    //     success: function (response) {
    //         $.loadPage(`/subresformoth/?formType=${$("#formID").val()}`, "");
    //     },
    //     error: function (xhr, status, error) {
    //         console.error("XHR status:", xhr.status);
    //         console.error("Status:", status);
    //         console.error("Error:", error);
    //     },
    // });
}

function openForm(formListID, formType) {
    $.loadPage(`/subresformoth/subresform?formListID=${formListID}&formType=${formType}`, "", function () {
        drawLevel(formType, function () {
            setDDLperson();
            configDate();

            JSON.parse(localStorage.getItem("jsonPerson")).forEach(function (i) {
                if (i.PERSON_ID == localStorage.getItem("personid")) {
                    drawListgroup(i.FULL_NAME, i.PERSON_ID, 100);
                }
            });
        });
    });
}

function configDate() {
    // $.ajax({
    //     url: baseUrl + "aps/schedule/dispbudgetyear",
    //     type: "GET",
    //     dataType: "json",
    //     success: function (data) {
    //         document.getElementById("subres_sdate").setAttribute("min", `${data.dt[0].BUDGETYEAR - 544}-10-01`);
    //         document.getElementById("subres_sdate").setAttribute("max", `${data.dt[0].BUDGETYEAR - 543}-12-31`);

    //         document.getElementById("subres_edate").setAttribute("min", `${data.dt[0].BUDGETYEAR - 544}-10-01`);
    //         document.getElementById("subres_edate").setAttribute("max", `${data.dt[0].BUDGETYEAR - 543}-12-31`);
    //     },
    //     error: function () {
    //         console.log("Error in Operation");
    //     },
    // });

    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth() + 1;

    document.getElementById("subres_edate").setAttribute("max", `${month >= 10 ? year + 1 : year}-${`0` + (month + 4)}-${new Date(month >= 10 ? year + 1 : year, month + 4, 0).getDate()}`);
}

function drawLevel(formType, callBack) {
    $.ajax({
        url: baseUrl + "aps/acaprvform/dispddl?JOBAGREECONF_CODE=" + formType,
        type: "GET",
        dataType: "json",
        success: function (data) {
            let resultHtml = "";

            $("#nameJoblevel4").html(`<i class="fa fa-caret-right" style="color: red;"></i>&nbsp;&nbsp;${data.dt[0].JOBAGREECONF_NAME}`);

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

// ?++++++++++++++++++++++++++++++++++++ :: Form :: +++++++++++++++++++++++++++++++++++⁡++++++++
function saveData(formList) {
    let result = 0;

    $(".inputratio").each(function () {
        result += parseInt($(this).val());
    });

    if (result > 100) return;

    // let apiType = "aps/researchform/" + (formList ? "updated" : "stored");
    let apiType = "aps/researchform/stored";

    $("#subresForm").submit(function (event) {
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
                var xobj = $("#subres_File");
                var xobj2 = xobj[0];
                var files = xobj2.files;
                var formData = new FormData();

                // Cast to stringify
                let arrDesc_nd = {
                    PERSON: [],
                    DES: [],
                };

                if ($(".dynamiclist").length > 0) {
                    $(".dynamiclist").each(function () {
                        let id = $(this).attr("person");

                        if (id) {
                            let personData = {
                                FULLNAME: $(this).attr("fullname"),
                                PERSON_ID: id,
                                RATIO: $("#ratio_" + id).val(),
                            };

                            let project = {
                                PROJECT_ID: generateRandomNumber(),
                            };

                            arrDesc_nd["PERSON"].push(personData);
                            arrDesc_nd["DES"].push(project);
                        }
                    });
                }

                //-------------------------Form Data------------------------
                formData.append("RES_ID", formList ? formList : "");
                formData.append("JOBAGREECONF_CODE", $("input[name='formLevel']:checked").val() ? $("input[name='formLevel']:checked").val() : localStorage.getItem("formTypeid"));
                formData.append("PERSON_ID", localStorage.getItem("personid"));
                formData.append("RES_TITLE", $("#subres_title").val());
                formData.append("RES_DESC", $("#subres_desc_st").val());

                if (files.length > 0) formData.append("RES_FILE", files[0], files[0].name);

                formData.append("RES_FILEENG", "");
                formData.append("RES_SDATE", dateByLangForSave($("#subres_sdate").val(), lang));
                formData.append("RES_EDATE", dateByLangForSave($("#subres_edate").val(), lang));

                formData.append("RES_DESC_PUBLISH", $("#subres_desc_publish").val());
                formData.append("RES_STATUS", "0");
                formData.append("RES_DESC_ND", JSON.stringify(arrDesc_nd));
                formData.append("USER_CREATED", localStorage.getItem("personid"));

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
                            $.loadPage(`/subresformoth/?formType=${$("#formID").val()}`, "");
                        } else {
                            Swal.fire({
                                title: "ผิดพลาด !",
                                icon: "error",
                            });
                        }
                    });

                //----------------------------------------------------------------

                //--------------------------array data----------------------------------
                // let arrSubres = {
                //     RES_ID: formList ? formList : null,
                //     JOBAGREECONF_CODE: $("input[name='formLevel']:checked").val() ? $("input[name='formLevel']:checked").val() : localStorage.getItem("formTypeid"),
                //     PERSON_ID: localStorage.getItem("personid"),
                //     RES_TITLE: $("#subres_title").val(),
                //     RES_DESC: $("#subres_desc_st").val(),

                //     RES_FILE: "",
                // RES_FILE: $("#subres_File")[0].files[0],

                //     RES_FILEENG: "",
                //     RES_SDATE: $("#subres_sdate").val(),
                //     RES_EDATE: $("#subres_edate").val(),
                //     RES_DESC_PUBLISH: $("#subres_desc_publish").val(),
                //     RES_AMOUNT: "0",
                //     RES_DESC_ND: JSON.stringify(arrDesc_nd),
                //     USER_CREATED: localStorage.getItem("personid"),
                // };

                // $.ajax({
                //     url: baseUrl + "aps/researchform/stored",
                //     type: "POST",
                //     data: arrSubres,
                //     success: function (response) {
                //         $.loadPage(`/subresformoth/?formType=${$("#formID").val()}`, "");
                //     },
                //     error: function (xhr, status, error) {
                //         console.error("XHR status:", xhr.status);
                //         console.error("Status:", status);
                //         console.error("Error:", error);
                //     },
                // });
                //----------------------------------------------------------------
            }
        });
    });
}

function ddlPerson() {
    JSON.parse(localStorage.getItem("jsonPerson")).forEach(function (i) {
        if (i.PERSON_ID == $("#slPersonForm").val()) {
            drawListgroup(i.FULL_NAME, i.PERSON_ID, null);
        }
    });
}

function drawListgroup(fullname, personid, ratio) {
    document.getElementById("chkDup").style.display = "none";
    if ($("#pID_" + personid).length > 0) {
        $("#chkDup").show();
        return;
    }

    let strHtml = "";
    strHtml += `<li class="list-group-item dynamiclist" style="padding-left: 10px; padding-top: 5px; padding-bottom: 5px;" fullname="${fullname}" person="${personid}" id="pID_${personid}">`;
    strHtml += `<div class="row">`;
    strHtml += `<div class="col-md-8" style="display: flex; align-items: center;">`;
    strHtml += `<i class="fa fa-check-square-o" style="color: #03cd03;">&nbsp;&nbsp;</i><span>${fullname}</span>`;
    strHtml += `</div>`;

    strHtml += `<div class="col-md-2">`;
    strHtml += `<input class="form-control inputratio" type="number" oninput="checkInput(this)" id="ratio_${personid}" value="${ratio ? ratio : ""}" required />`;
    strHtml += `</div>`;

    strHtml += `<div class="col-md-1" style="display: flex; align-items: center;">`;
    strHtml += `<span>%</span>`;
    strHtml += `</div>`;

    strHtml += `<div class="col-md-1" style="display: flex; justify-content: center; align-items: center;">`;
    strHtml += `<i type="button" class="fa fa-trash" style="color: red;" title="ลบ" onClick="deleteListgroup(${personid});"></i>`;
    strHtml += `</div>`;

    strHtml += `</div>`;

    strHtml += `<div class="row">`;
    strHtml += `<div class="col-md-8">`;
    strHtml += `</div>`;

    strHtml += `<div class="col-md-4">`;
    strHtml += `<small id="alertModalratio100_ratio_${personid}" style="color: red; display: none;">**สัดส่วนการเขียนไม่เกิน 100%</span></small>`;
    strHtml += `<small id="alertModalratiosumRatio_ratio_${personid}" style="color: red; display: none;">**สัดส่วนรวมกันไม่เกิน 100% <span id="idMaxratio"></span></small>`;
    strHtml += `</div>`;

    strHtml += `</li>`;

    $("#dynamicUL").append(strHtml);
}

function deleteListgroup(pesonid) {
    var strXid = "#pID_" + String(pesonid);
    $(strXid).remove();
}
// ?⁢++++++++++++++++++++++++++++++++++++ :: End :: ++++++++++++++++++++++++++++++++++++++++++++++

// !++++++++++++++++++++++++++++++++++++ :: set data :: +++++++++++++++++++++++++++++++++++⁡++++++
function setDDLperson() {
    var defaultOption = document.createElement("option");
    defaultOption.text = "---------- เลือกผู้สร้างผลงาน ----------";
    defaultOption.value = "";
    document.getElementById("slPersonForm").add(defaultOption);

    JSON.parse(localStorage.getItem("jsonPerson")).forEach(function (optionData) {
        var option = document.createElement("option");
        option.text = optionData.FULL_NAME;
        option.value = optionData.PERSON_ID;
        document.getElementById("slPersonForm").add(option);
    });
}

// !⁢++++++++++++++++++++++++++++++++++++ :: End :: ++++++++++++++++++++++++++++++++++++++++++++++
function chkDate() {
    document.getElementById("alertTxtdate").style.display = "none";
    if ($("#subres_sdate").val() && $("#subres_edate").val()) {
        if ($("#subres_sdate").val() <= $("#subres_edate").val()) {
            // console.log("วันที่เริ่มต้นไม่น้อยกว่าหรือเท่ากับวันที่สิ้นสุด");
        } else {
            // console.log("วันที่เริ่มต้นมากกว่าวันที่สิ้นสุด");
            $("#subres_edate").val("");
            document.getElementById("alertTxtdate").style.display = "block";
        }
    }
}

function checkInput(input, sumRatio = null) {
    // ตรวจสอบว่ามีตัวเลข 0 อยู่ด้านหน้าหรือไม่
    if (input.value.length > 0 && input.value.charAt(0) === "0") {
        // ถ้ามี 0 อยู่ด้านหน้า ให้ลบ 0 ออก
        input.value = input.value.slice(1);
    }
    // ตรวจสอบว่าค่าที่กรอกเป็นตัวเลขหรือไม่
    if (!/^\d*$/.test(input.value)) {
        // ถ้าไม่ใช่ตัวเลข ให้ลบตัวอักษรที่ไม่ใช่ตัวเลขทิ้งทั้งหมด
        input.value = input.value.replace(/[^\d]/g, "");
    }
    // ตรวจสอบว่ามีเครื่องหมายลบ (-) อยู่หน้าสุดหรือไม่
    if (input.value.length > 0 && input.value.charAt(0) === "-") {
        // ถ้ามี - อยู่หน้าสุด ให้ลบ -
        input.value = input.value.slice(1);
    }

    // ตรวจสอบว่าค่าที่กรอกไม่เกิน 100
    $("#alertModalratio").hide();
    $("#alertModalratio100").hide();
    $("#alertModalratiosumRatio").hide();
    $(`#alertModalratio100_${input.id}`).hide();
    $(`#alertModalratiosumRatio_${input.id}`).hide();

    if ($(`#${input.id}`).val() > 100) $(`#alertModalratio100_${input.id}`).show();

    if (sumRatio) {
        if (parseInt(input.value) > 100 - sumRatio) {
            $("#idMaxratio").html(100 - sumRatio);
            $("#alertModalratiosumRatio").show();
        }
    } else {
        if (parseInt(input.value) > 100) $("#alertModalratio100").show();
    }

    let result = 0;

    $(".inputratio").each(function () {
        result += parseInt($(this).val());
    });

    if (result > 100) {
        $("#alertModalratio").hide();
        $("#alertModalratio100").hide();
        $("#alertModalratiosumRatio").hide();
        $(`#alertModalratio100_${input.id}`).hide();
        $(`#alertModalratiosumRatio_${input.id}`).show();
        document.querySelector("#bSaveForm").type = "button";
    } else {
        document.querySelector("#bSaveForm").type = "submit";
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

function generateID() {
    // สร้างวันที่ปัจจุบัน
    const currentDate = new Date();

    // ดึงข้อมูลปี พ.ศ. 4 หลัก
    const thaiYear = currentDate.getFullYear() + 543;
    console.log("year : " + thaiYear);

    // ดึงข้อมูลเดือน
    const month = currentDate.getMonth() + 1; // เดือนเริ่มที่ 0
    console.log("month : " + month);

    // ดึงข้อมูลวันที่
    const date = currentDate.getDate();
    console.log("date : " + date);

    // สร้างรูปแบบให้เป็น 2 หลัก
    const twoDigitFormat = (num) => num.toString().padStart(2, "0");

    // ดึงข้อมูลเวลา
    const hours = twoDigitFormat(currentDate.getHours());
    console.log("hours : " + hours);

    const minutes = twoDigitFormat(currentDate.getMinutes());
    console.log("minutes : " + minutes);

    const seconds = twoDigitFormat(currentDate.getSeconds());
    console.log("seconds : " + seconds);

    const milliseconds = twoDigitFormat(currentDate.getMilliseconds());
    console.log("milliseconds : " + milliseconds);

    // สร้าง ID โดยรวมข้อมูลทั้งหมดเข้าด้วยกัน
    // const id = `${thaiYear.toString().substring(2, 4)}${twoDigitFormat(month)}${twoDigitFormat(date)}${hours}${minutes}${seconds}${milliseconds}`;
    const id = `${thaiYear.toString().substring(2, 4)}${twoDigitFormat(month)}${twoDigitFormat(date)}${hours}${minutes}${milliseconds}`;

    return id;
}

function generateRandomNumber() {
    var randomNumber = "";
    for (var i = 0; i < 8; i++) {
        randomNumber += Math.floor(Math.random() * 10); // สร้างตัวเลขสุ่มระหว่าง 0 ถึง 9
    }

    const currentDate = new Date();

    // ดึงข้อมูลปี พ.ศ. 4 หลัก
    const thaiYear = currentDate.getFullYear() + 543;

    return thaiYear.toString().substring(2, 4) + randomNumber.toString();
}

function bypass(formType, key, personid) {
    localStorage.setItem("personid", personid);
    localStorage.setItem("id", formType);

    setPerson(function () {
        setDDLperson();
    });

    drawLevel(formType, function () {
        $.ajax({
            url: baseUrl + `aps/researchform/index?PERSON_ID=${personid}&JOBAGREECONF_CODE=` + formType,
            type: "GET",
            dataType: "json",
            success: function (data) {
                for (i = 0; i < data.dt.length; i++) {
                    if (data.dt[i].RES_ID == key) {
                        $("#subres_title").val(data.dt[i].RES_TITLE);
                        $("#subres_desc_st").val(data.dt[i].RES_DESC);
                        $("#subres_sdate").val(data.dt[i].RES_SDATE);
                        $("#subres_edate").val(data.dt[i].RES_EDATE);
                        $("#subres_desc_publish").val(data.dt[i].RES_DESC_PUBLISH);

                        if (data.dt[i].RES_FILE)
                            $("#divDocfile").append(
                                `<br><br><a href="${baseUrl}aps/unit/download?fileName=${data.dt[i].RES_FILE}" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;ข้อมูลประกอบ</a>`
                            );

                        if ($(`#fid_${data.dt[i].JOBAGREECONF_CODE}`).length > 0) document.getElementById(`fid_${data.dt[i].JOBAGREECONF_CODE}`).checked = true;

                        drawPerson(JSON.parse(data.dt[i].RES_DESC_ND));

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

                        insertDiv("subresForm");
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
