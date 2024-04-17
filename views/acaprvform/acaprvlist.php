<?php

use yii\helpers\Url;

$lang = (Yii::$app->users->getUserlanguage() == 'th') ? 'th' : 'en';
$profile = Yii::$app->session->get("profile");

$this->title = 'รายการภาระงาน';
?>

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
                                <i class="fa fa-list"></i> <u><span name="jobfrm1_5"></span></u>
                            </div>

                            <div class="col-lg-4 text-end">
                                <button type="button" class="bAdd" onClick="openForm('','<?= $formType ?>');"></button>
                            </div>
                        </div>

                        <br>

                        <table id="tbAcaprvform" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" name="acaprv_1"></th>
                                    <th class="text-center" name="acaprv_2"></th>
                                    <th class="text-center" name="acaprv_3"></th>
                                    <th class="text-center" name="acaprv_4"></th>
                                </tr>
                            </thead>
                        </table>

                        <div class="card-footer">
                            <div class="row">
                                <div>
                                    <a class="bBack" href="<?= Url::to(['site/index']) ?>">หน้าหลัก</a>
                                    <!-- <button class="button-85" role="button">Button 85</button> -->
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
    loadScript(["/app/acaprvform/acaprvform.js"], function() {
        loadData("<?= $formType ?>");
    });
</script>