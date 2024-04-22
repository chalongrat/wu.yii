// const baseUrl1 = 'http://192.168.117.200/apis/';
// const baseUrl1 = "https://apisprd.wu.ac.th/apis/";
// const baseUrl1 = "https://apisqas.wu.ac.th/apis/";
// const baseUrl1 = "https://apisqas.wu.ac.th/";
//  const baseUrl1 = "http://192.168.42.112/apis/";
const baseUrl1 = "http://10.250.2.9/apis/";

function buttonClass() {
    var formData = {
        lang: $("#lang").length === 0 ? "th" : $("#lang").val(),
        // lang: "th",
    };

    $.ajax({
        url: baseUrl1 + "lng/" + formData.lang + "/?mod=set-btn",
        type: "GET",
        dataType: "json",
        success: function (data) {
            for (var key in data.setBtn) {
                let name = data.setBtn;
                $("[name='btn_10']").text(name.button.btn_10);
                $("[name='btn_20']").text(name.button.btn_20);
                $("[name='btn_30']").text(name.button.btn_30);
                $("[name='btn_40']").text(name.button.btn_40);
                $("[name='btn_45']").text(name.button.btn_45);
                $("[name='btn_50']").text(name.button.btn_50);
                $("[name='btn_60']").text(name.button.btn_60);
                $("[name='btn_70']").text(name.button.btn_70);
                $("[name='btn_80']").text(name.button.btn_80);
                $("[name='btn_90']").text(name.button.btn_90);
                $("[name='btn_100']").text(name.button.btn_100);
                $("[name='btn_110']").text(name.button.btn_110);
                $("[name='btn_120']").text(name.button.btn_120);
                $("[name='btn_130']").text(name.button.btn_130);
                $("[name='btn_140']").text(name.button.btn_140);
                $("[name='btn_150']").text(name.button.btn_150);
                $("[name='btn_160']").text(name.button.btn_160);
                $("[name='btn_170']").text(name.button.btn_170);
                $("[name='btn_180']").text(name.button.btn_180);
                $("[name='btn_190']").text(name.button.btn_190);
                $("[name='btn_200']").text(name.button.btn_200);
                $("[name='btn_210']").text(name.button.btn_210);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(xhr.status);
            console.log(status);
            console.log(error);

            console.log("Error in Operation");
        },
    });

    //บันทึก
    const listSaves = document.querySelectorAll(".bSave");
    listSaves.forEach((listSave) => {
        listSave.innerHTML = '<i class="fa fa-floppy-o"></i> <span name="btn_10"></span>';
        listSave.className = "btn btn-primary";
    });

    //เพิ่ม
    const listAdds = document.querySelectorAll(".bAdd");
    listAdds.forEach((listAdd) => {
        listAdd.innerHTML = '<i class="fa fa-plus-circle"></i> <span name="btn_30"></span>';
        listAdd.className = "btn btn-primary bAdd";
    });

    //แก้ไข
    const listEdits = document.querySelectorAll(".bEdit");
    listEdits.forEach((listEdit) => {
        listEdit.innerHTML = '<i class="fa fa-pencil-square-o"></i> <span name="btn_20"></span>';
        listEdit.className = "btn btn-primary bEdit";
    });

    //ลบ
    const listDels = document.querySelectorAll(".bDel");
    listDels.forEach((listDel) => {
        listDel.innerHTML = '<i class="fa fa-trash-o" aria-hidden="true"></i> <span name="btn_40"></span>';
        listDel.className = "btn btn-danger";
    });

    //ยกเลิก
    const listCancels = document.querySelectorAll(".bCancel");
    listCancels.forEach((listCancel) => {
        listCancel.innerHTML = '<i class="fa fa-times-circle"></i> <span name="btn_50"></span>';
        listCancel.className = "btn btn-danger";
    });

    //ยืนยัน
    const listConfirms = document.querySelectorAll(".bConfirm");
    listConfirms.forEach((listConfirm) => {
        listConfirm.innerHTML = '<i class="fa fa-check-circle"></i> <span name="btn_60"></span>';
        listConfirm.className = "btn btn-primary";
    });

    //ค้นหา
    const listSearchs = document.querySelectorAll(".bSearch");
    listSearchs.forEach((listSearch) => {
        listSearch.innerHTML = '<i class="fa fa-search"></i> <span name="btn_70"></span>';
        listSearch.className = "btn btn-secondary";
    });

    //ย้อนกลับ
    const listBacks = document.querySelectorAll(".bBack");
    listBacks.forEach((listBack) => {
        listBack.innerHTML = '<i class="fa fa-chevron-circle-left"></i> <span name="btn_80"></span>';
        listBack.className = "btn btn-secondary bBack";
    });

    //ถัดไป
    const listNexts = document.querySelectorAll(".bNext");
    listNexts.forEach((listNext) => {
        listNext.innerHTML = '<span name="btn_90"></span>  <i class="fa fa-chevron-circle-right"></i>';
        listNext.className = "btn btn-secondary";
    });

    //ส่ง
    const listSends = document.querySelectorAll(".bSend");
    listSends.forEach((listSend) => {
        listSend.innerHTML = '<i class="fa fa-paper-plane"></i> <span name="btn_100"></span>';
        listSend.className = "btn btn-secondary";
    });

    //อัพโหลด
    const listUploads = document.querySelectorAll(".bUpload");
    listUploads.forEach((listUpload) => {
        listUpload.innerHTML = '<i class="fa fa-upload"></i> <span name="btn_110"></span>';
        listUpload.className = "btn btn-warning";
    });

    //ดาวโหลด
    const listDownloads = document.querySelectorAll(".bDownload");
    listDownloads.forEach((listDownload) => {
        listDownload.innerHTML = '<i class="fa fa-download"></i> <span name="btn_120"></span>';
        listDownload.className = "btn btn-warning";
    });

    //รายละเอียด
    const listDetails = document.querySelectorAll(".bDetail");
    listDetails.forEach((listDetail) => {
        listDetail.innerHTML = '<span name="btn_130"></span>';
        listDetail.className = "btn btn-secondary";
    });

    //คืนค่า
    const listResets = document.querySelectorAll(".bReset");
    listResets.forEach((listReset) => {
        listReset.innerHTML = '<i class="fa fa-retweet"></i> <span name="btn_140"></span>';
        listReset.className = "btn btn-secondary";
    });

    //รีเฟรช
    const listRefreshs = document.querySelectorAll(".bRefresh");
    listRefreshs.forEach((listRefresh) => {
        listRefresh.innerHTML = '<i class="fa fa-refresh"></i> <span name="btn_150"></span>';
        listRefresh.className = "btn btn-secondary";
    });

    //ตีกลับ
    const listReturns = document.querySelectorAll(".bReturn");
    listReturns.forEach((listReturn) => {
        listReturn.innerHTML = '<i class="fa fa-reply"></i>  <span name="btn_160"></span>';
        listReturn.className = "btn btn-info";
    });

    //process
    const listProcesss = document.querySelectorAll(".bProcess");
    listProcesss.forEach((listProcess) => {
        listProcess.innerHTML = '<i class="fa fa-spinner"></i>  <span name="btn_170"></span>';
        listProcess.className = "btn btn-primary";
    });

    //print
    const listPrints = document.querySelectorAll(".bPrint");
    listPrints.forEach((listPrint) => {
        listPrint.innerHTML = '<i class="fa fa-print"></i>  <span name="btn_180"></span>';
        listPrint.className = "btn btn-primary";
    });

    //approve
    const listApproves = document.querySelectorAll(".bApprove");
    listApproves.forEach((listApprove) => {
        listApprove.innerHTML = '<i class="fa fa-check-circle"></i>  <span name="btn_190"></span>';
        listApprove.className = "btn btn-primary";
    });

    //excel
    const listExcels = document.querySelectorAll(".bExcel");
    listExcels.forEach((listExcel) => {
        listExcel.innerHTML = '<i class="fa fa-file-excel-o"></i>  <span name="btn_210"></span>';
        listExcel.className = "btn btn-success";
    });

    //export excel in datatable
    var textExcel = '<span><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export excel </span>';
    var classExcel = "btn btn-success";

    //export pdf in datatable
    var textPdf = '<span style="color: white;" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Pdf </span>';
    var classPdf = "btn btn-success";
}

buttonClass();
