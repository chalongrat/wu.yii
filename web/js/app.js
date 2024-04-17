// $.loadPage = (url, e) => {
//     $("#menuCard").empty().load(url);

//     if (e != undefined) setPath(url, e);
// };

$.loadPage = (url, e, callback) => {
    $("#menuCard")
        .empty()
        .load(url, function (response, status, xhr) {
            if (status == "success" && typeof callback === "function") {
                callback(); // เรียกใช้ callback function ที่ถูกส่งเข้ามา
            }
        });

    if (e !== undefined) setPath(url, e);
};

// function loadScript(filepath, callback) {
//     var body = document.getElementsByTagName("body")[0];

//     let i = 0;
//     while (i < filepath.length) {
//         $(`script[src$='${filepath[i]}']`).remove();

//         var script = document.createElement("script");
//         script.type = "text/javascript";
//         script.src = filepath[i];

//         script.onreadystatechange = callback;
//         script.onload = callback;

//         body.appendChild(script);

//         i++;
//     }
//     buttonClass();

//     return true;
// }

function loadScript(filepath, callback) {
    var body = document.getElementsByTagName("body")[0];
    let loadedCount = 0;

    function scriptLoaded() {
        loadedCount++;
        if (loadedCount === filepath.length) {
            // เมื่อทุกสคริปต์โหลดเสร็จสิ้นแล้ว
            buttonClass();
            callback(); // เรียก callback หลังจากที่โหลดสคริปต์เสร็จสิ้น
        }
    }

    let i = 0;
    while (i < filepath.length) {
        $(`script[src$='${filepath[i]}']`).remove();

        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = filepath[i];

        script.onreadystatechange = script.onload = scriptLoaded;

        body.appendChild(script);

        i++;
    }

    // ไม่ควร return true ตรงนี้เพราะการโหลดสคริปต์เป็นแบบ asynchronous
    // ค่า true อาจจะถูก return ก่อนที่สคริปต์จะโหลดเสร็จสิ้นทั้งหมด
    // ในกรณีที่คุณต้องการทำงานเสร็จจริงๆ หลังจากการโหลดสคริปต์สมบูรณ์แล้ว
    // ควรเรียกใช้ callback ในฟังก์ชัน scriptLoaded()
}

function setPath(url, str) {
    $.ajax({
        url: baseUrl + "aps/acaprvform/dispddl?JOBAGREECONF_CODE=" + str,
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
        },
        error: function () {
            console.log("Error in Operation");
        },
    });
}
