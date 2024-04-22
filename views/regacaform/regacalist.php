<?php

use yii\helpers\Url;

$profile = Yii::$app->session->get("profile");
$lang = Yii::$app->session->get("sessionLang");

$this->title = 'รายการภาระงาน';
?>

<form id="RegacalistForm">
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
                        </div>

                        <br>

                        <table id="tbRegacaform" class="table table-striped table-bordered dt-responsive" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" name="regaca_1"></th>
                                    <!-- <th class="text-center" name="regaca_2"></th> -->
                                    <th class="text-center" name="regaca_3"></th>
                                    <th class="text-center" name="regaca_4"></th>
                                    <th class="text-center" name="regaca_5"></th>
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
</form>

<script>
    loadScript(["/app/regacaform/regacaform.js"], function() {
        loadData("<?= $formType ?>");
    });
</script>