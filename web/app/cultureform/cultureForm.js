// *⁡⁣⁣⁢++++++++++++++++++++++++++++++++++++ :: Label :: +++++++++++++++++++++++++++++++++++++⁡⁣⁣⁢+++++++
// var arrJob = [];
var lang = $("#lang").val();
renderLabel("aps-job", lang, "apsJob");
// *⁡⁣⁣⁢++++++++++++++++++++++++++++++++++++ :: End :: +++++++++++++++++++++++++++++++++⁡⁣⁣⁢+++++++++++++

function loadData(id = null) {
    localStorage.setItem("personid", $("#personid").val());

    // fortest
    // localStorage.setItem("personid", 4510070321);

    localStorage.setItem("formTypeid", id);

    if (id != null && id != "") localStorage.setItem("id", id);
    else id = localStorage.getItem("id");

    $.ajax({
        url: baseUrl + "aps/cultureform/index?PERSON_ID=4510070321&JOBAGREECONF_CODE=" + id,
        // url: baseUrl + `aps/cultureform/index?PERSON_ID=${$("#personid").val()}&JOBAGREECONF_CODE=` + id,
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
                            return formatDateENtoTH(row.CULTUREFORM_SDATE) + " - " + formatDateENtoTH(row.CULTUREFORM_EDATE);
                        },
                    },

                    {
                        data: "CULTUREFORM_FILE",
                        width: "30%",
                        render: function (data, type, row) {
                            return data ? '<a href="' + baseUrl + "aps/" + data + '" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;' + data + "</a>" : "";
                        },
                    },

                    {
                        data: "CULTUREFORM_ID",
                        width: "10%",
                        render: function (data, type, row) {
                            var strHtml = "";
                            strHtml += `<button type="button" class="btn btn-outline-secondary btn-sm btn-edit bEdit" onClick="editForm(${data});"><i class="fa fa-edit" title="แก้ไข"></i> แก้ไข</button>  `;
                            strHtml += `<button type="button" class="btn btn-outline-danger btn-sm btn-delete" onClick="deleteJob(${data});"><i class="fa fa-trash" title="ลบ"></i> ลบ</button>`;
                            return strHtml;
                        },
                    },
                ],
                columnDefs: [{ className: "text-center", targets: [3] }],
            });
        },
        error: function () {
            console.log("Error in Operation");
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
                formData.append("CULTUREFORM_SDATE", $("#cultureSdate").val());

                if (files.length > 0) formData.append("CULTUREFORM_FILE", files[0], files[0].name);

                formData.append("CULTUREFORM_DESC_ST", $("#cultureDesc").val());
                formData.append("CULTUREFORM_EDATE", $("#cultureEdate").val());
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
                $("#cultureSdate").val(i.CULTUREFORM_SDATE);
                $("#cultureEdate").val(i.CULTUREFORM_EDATE);
                $("#cultureDesc").val(i.CULTUREFORM_DESC_ST);

                if (i.CULTUREFORM_FILE)
                    $("#divDocfile").append(`<br><a href="${baseUrl}aps/${i.CULTUREFORM_FILE}" target="_blank"><i type="button" class="fa fa-print"></i>&nbsp;&nbsp;${i.CULTUREFORM_FILE}</a>`);
            }
        });
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
