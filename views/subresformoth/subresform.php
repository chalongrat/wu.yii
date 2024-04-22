<?php
$profile = Yii::$app->session->get("profile");
$lang = Yii::$app->session->get("sessionLang");

use yii\web\View;

use app\assets\AppAsset;

$this->registerJs('loadScript(["/app/subresformoth/subresformoth.js"], function() { bypass("' . $formType . '", "' . $formListID . '", "' . $profile->person_id . '");});', View::POS_END);
$this->registerJs('buttonClass();', View::POS_END);
$this->registerJs('$("#slPersonForm").select2({width: "100%"});', View::POS_END);
?>

<form id="subresForm">
    <div class="section-body">
        <div style="overflow-x: auto;">
            <div class="card-body">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="overflow-x: auto;">
                                <div class="card-body">
                                    <input type="hidden" id="formID" class="form-control" value="<?= $formType ?>">
                                    <input type="hidden" id="lang" class="form-control" value="<?= $lang ?>">
                                    <div class="row clearfix">
                                        <div class="row flex justify-content-center">
                                            <div class="row col-md-10">
                                                <label class="form-label" name="render_2"></label>
                                                <span id="nameJoblevel4"></span>
                                                <ul class="list-group mt-2" id="reaLevel"></ul>
                                            </div>
                                        </div>

                                        <div class="row flex justify-content-center mt-4">
                                            <div class="col-md-10">
                                                <div class="from-group mb-3">
                                                    <label class="form-label" name="subres_8"></label>
                                                    <input class="form-control" type="text" id="subres_title" required />
                                                </div>

                                                <div class="from-group mb-3">
                                                    <label class="form-label" name="subres_9"></label>
                                                    <textarea id="subres_desc_st" class="form-control" rows="5" value=""></textarea>
                                                </div>

                                                <div class="row gx-1">
                                                    <div class="col-md-6 from-group mb-3">
                                                        <label class="form-label" name="subres_10"></label>
                                                        <input type="text" class="form-control datepicker_input" placeholder="<?= $lang == "th" ? 'วัน/เดือน/ปี' : 'dd/mm/yyyy' ?>" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-language="<?= $lang ?>-<?= $lang ?>" data-date-autoclose="true" id="subres_sdate" onchange="chkDate();" required />
                                                        <small class="mt-1" id="alertTxtdate" style="display: none; color: red;">วันที่เริ่มต้นมากกว่าวันที่สิ้นสุด</small>
                                                    </div>

                                                    <div class="col from-group mb-3">
                                                        <label class="form-label">&nbsp;</label>
                                                        <input type="text" class="form-control datepicker_input" placeholder="<?= $lang == "th" ? 'วัน/เดือน/ปี' : 'dd/mm/yyyy' ?>" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-language="<?= $lang ?>-<?= $lang ?>" data-date-autoclose="true" id="subres_edate" onchange="chkDate();" required />
                                                    </div>
                                                </div>

                                                <div class="from-group mb-3">
                                                    <label class="form-label" name="subres_4"></label>
                                                    <select class="form-select" aria-label="Default select example" onchange="ddlPerson();" id="slPersonForm"></select>
                                                    <small id="chkDup" style="display: none; color: red;">**ไม่สามารถเพิ่มซ้ำได้</small>
                                                    <br>

                                                    <ul class="list-group mt-2" id="dynamicUL">
                                                        <li class="list-group-item dynamiclist" style="padding-left: 10px; padding-top: 5px; padding-bottom: 5px; background-color: #dfe2e7;">
                                                            <div class="row">
                                                                <div class="col-md-8" style="display: flex; justify-content: center; align-items: center;" name="subres_19"></div>
                                                                <div class="col-md-3" style="display: flex; justify-content: center; align-items: center;" name="subres_18"></div>
                                                                <div class="col-md-1" style="display: flex; justify-content: center; align-items: center;" name="subres_20"></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="from-group mb-3">
                                                    <label class="form-label" name="subres_12"></label>
                                                    <textarea id="subres_desc_publish" class="form-control" rows="5" value="" required></textarea>
                                                </div>

                                                <div class="from-group mb-3" id="divDocfile">
                                                    <label class="form-label" name="subres_11"></label>
                                                    <input class="form-control" type="file" id="subres_File" name="docFile" value="" accept=".pdf" onchange="checkFileSize(this)" />
                                                    <small id="alertFile" style="color: #113f50;">รองรับไฟล์ PDF ขนาดไม่เกิน 10 Mb.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <button type="button" class="bBack" onClick="$.loadPage('/subresformoth/index?formType=<?= $formType ?>', event);"></button>
                                        </div>

                                        <div class="col-lg-4 text-center">
                                            <button type="submit" class="bSave" id="bSaveForm" onClick="saveData(<?= $formListID ?>)"></button>
                                        </div>
                                        <div class="col-lg-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    buttonClass();

    $(document).ready(function() {
        renderLabel("aps-job", lang, "apsJob");

        $("#slPersonForm").select2({
            width: "100%"
        });
    });
</script>

<?php
