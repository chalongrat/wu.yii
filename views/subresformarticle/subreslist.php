<?php

use yii\helpers\Url;

$profile = Yii::$app->session->get("profile");
$lang = Yii::$app->session->get("sessionLang");

$this->title = 'รายการภาระงาน';
?>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
    }

    .close {
        color: #aaaaaa;
        /* float: right; */
        text-align: right;
        /* เลื่อนปุ่มปิดไปทางขวา */
        /* font-size: 28px; */
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    #searchInput {
        margin-bottom: 10px;
        padding: 5px;
        width: 200px;
    }

    /* Style the dropdown button */
    .select-dropdown {
        position: relative;
        display: inline-block;
    }

    /* Style the dropdown content (hidden by default) */
    .select-dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        z-index: 1;
    }

    /* Style the options inside the dropdown */
    .select-option {
        padding: 12px 16px;
        display: block;
        cursor: pointer;
    }

    /* Change color of dropdown links on hover */
    .select-option:hover {
        background-color: #ddd;
    }
</style>

<form id="acaprvlistForm">
    <div class="section-body">
        <div style="overflow-x: auto;">
            <div class="card-body">

                <input type="hidden" id="lang" class="form-control" value="<?= $lang ?>">
                <input type="hidden" id="personid" class="form-control" value="<?= $profile->person_id ?>">
                <input type="hidden" id="formID" class="form-control" value="<?= $formType ?>">

                <div class="card" style="overflow-x: auto;">
                    <div class="card-body">
                        <div class="row clearfix">
                            <div class="col-lg-8">
                                <i class="fa fa-list"></i> <u><span name="subres_23"></span></u>
                            </div>

                            <div class="col-lg-4 text-end">
                                <button type="button" class="btn btn-info" style="color: white;" onClick="syncArticle();"><i class="fa fa-download"></i>&nbsp;บทความวิจัย/บทความวิชาการที่ตีพิมพ์</button>
                            </div>

                            <div class="col-lg-12"><br>
                            </div>

                            <div class="alert alert-warning col-lg-12" role="alert">
                                <span style="color: red;">**กรณีไม่ปรากฏข้อมูลบทความวิจัย/บทความวิชาการที่ตีพิมพ์ ให้กดปุ่ม <b>"ดึงข้อมูลผลงานบทความวิจัย/บทความวิชาการ"</b> ผลงานวิจัยที่นำมาแสดงผลในการบันทึกภาระงานต้องเป็นผลงานวิจัยที่ได้รับการตีพิมพ์หรือตอบรับให้ตีพิมพ์โดยไม่มีการแก้ไขแล้ว
                                    โดยต้องผ่านการพิจารณารับรองจากหัวหน้าสถานวิจัย ในระบบ WU-Research Support System (https://iriedoc.wu.ac.th) ซึ่งดูแลโดยสถาบันวิจัยและนวัตกรรม การบันทึกข้อมูลในระบบ WU-Research Support System ติดต่อคุณฐิติกร ทองเอียด สถาบันวิจัยและนวัตกรรม โทร. 73558</span>
                            </div>
                        </div>

                        <br>

                        <table id="tbSubresformarticle" class="table table-striped table-bordered dt-responsive" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <!-- <th class="text-center" name="subres_1"></th> -->
                                    <th class="text-center" name="subres_16"></th>
                                    <th class="text-center" name="subres_22"></th>
                                    <th class="text-center" name="subres_18"></th>
                                </tr>
                            </thead>
                        </table>

                        <div class="card-footer">
                            <div class="row">
                                <div>
                                    <a class="bBack" href="<?= Url::to(['site/index']) ?>">หน้าหลัก</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="close text-right" onClick='document.getElementById("myModal").style.display = "none"'></div>

            <p class="text-center" name="subres_4"></p>

            <div id="modalDiv"></div>

            <br>

            <div class="text-center" id="modalBtn"></div>
        </div>
    </div>

</form>

<script>
    loadScript(["/app/subresformarticle/subresformarticle.js"], function() {
        loadData("<?= $formType ?>");
    });
</script>