<?php

$profile = Yii::$app->session->get("profile");
$lang = Yii::$app->session->get("sessionLang");

use yii\web\View;

$this->registerJs('loadScript(["/app/cultureform/cultureForm.js"], function() { bypass("' . $formType . '", "' . $formListID . '", "' . $profile->person_id . '");});', View::POS_END);
$this->registerJs('buttonClass();', View::POS_END);
?>

<form id="formCultureForm">
    <div class="section-body">
        <div style="overflow-x: auto;">
            <div class="card-body">
                <div class="section-body" id="cultureForm">
                    <div class="card" id="indexDisp" style="overflow-x: auto;">

                        <input type="hidden" id="lang" class="form-control" value="<?= $lang ?>">

                        <div class="card-body">
                            <div class="row clearfix">
                                <div class="col-lg-8">
                                    <!-- <i class="fa fa-list"></i> <u><span name="jobtype_80"></span></u> -->
                                </div>
                            </div>

                            <br>

                            <div class="row flex justify-content-center">
                                <div class="col-md-10">
                                    <div class="from-group mb-3">
                                        <label class="form-label" name="culture_1"></label>
                                        <input class="form-control" type="text" id="cultureTitle" required />
                                    </div>

                                    <div class="row gx-1">
                                        <div class="col-md-6 from-group mb-3">
                                            <label class="form-label" name="culture_2"></label>
                                            <!-- <input type="date" id="cultureSdate" class="form-control" onchange="chkDate();" required> -->
                                            <input type="text" class="form-control datepicker_input" placeholder="<?= $lang == "th" ? 'วัน/เดือน/ปี' : 'dd/mm/yyyy' ?>" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-language="<?= $lang ?>-<?= $lang ?>" data-date-autoclose="true" id="cultureSdate" onchange="chkDate();" required />
                                            <small class="mt-1" id="alertTxtdate" style="display: none; color: red;">วันที่เริ่มต้นมากกว่าวันที่สิ้นสุด</small>
                                        </div>

                                        <div class="col from-group mb-3">
                                            <label class="form-label">&nbsp;</label>
                                            <!-- <input type="date" id="cultureEdate" class="form-control" onchange="chkDate();" required> -->
                                            <input type="text" class="form-control datepicker_input" placeholder="<?= $lang == "th" ? 'วัน/เดือน/ปี' : 'dd/mm/yyyy' ?>" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-language="<?= $lang ?>-<?= $lang ?>" data-date-autoclose="true" id="cultureEdate" onchange="chkDate();" required />
                                        </div>
                                    </div>

                                    <div class="from-group mb-3">
                                        <label class="form-label" name="culture_3"></label>
                                        <textarea id="cultureDesc" class="form-control" rows="5" value=""></textarea>
                                    </div>

                                    <div class="from-group mb-3" id="divDocfile">
                                        <label class="form-label" name="culture_4"></label>
                                        <!-- <input class="form-control" type="file" id="docFile" name="docFile" value="" accept=".pdf" /> -->
                                        <input class="form-control" type="file" id="docFile" name="docFile" value="" accept=".pdf" onchange="checkFileSize(this)" />
                                        <small id="alertFile" style="color: #113f50;">รองรับไฟล์ PDF ขนาดไม่เกิน 10 Mb.</small>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-4">
                                    <button type="button" class="bBack" onClick="$.loadPage('/cultureform/index', event);"></button>
                                </div>

                                <div class="col-lg-4 text-center">
                                    <button type="submit" id="bSave" class="bSave" onClick="saveData(<?= $formListID ?>)"></button>
                                </div>

                                <div class="col-lg-4"></div>
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
    });
</script>