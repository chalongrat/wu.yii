<?php

use yii\helpers\Url;

$profile = Yii::$app->session->get("profile");
$lang = Yii::$app->session->get("sessionLang");

$this->title = 'รายการภาระงาน';

use yii\web\View;

$this->registerJs('loadScript(["/app/cultureform/cultureForm.js"], function() { loadData("' . $formType . '", "' .  $bypass . '");});', View::POS_END);
?>
<style>
    /* CSS */
    .button-85 {
        padding: 0.6em 2em;
        border: none;
        outline: none;
        color: rgb(255, 255, 255);
        background: #111;
        cursor: pointer;
        position: relative;
        z-index: 0;
        border-radius: 10px;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button-85:before {
        content: "";
        background: linear-gradient(45deg,
                #ff0000,
                #ff7300,
                #fffb00,
                #48ff00,
                #00ffd5,
                #002bff,
                #7a00ff,
                #ff00c8,
                #ff0000);
        position: absolute;
        top: -2px;
        left: -2px;
        background-size: 400%;
        z-index: -1;
        filter: blur(5px);
        -webkit-filter: blur(5px);
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        animation: glowing-button-85 20s linear infinite;
        transition: opacity 0.3s ease-in-out;
        border-radius: 10px;
    }

    @keyframes glowing-button-85 {
        0% {
            background-position: 0 0;
        }

        50% {
            background-position: 400% 0;
        }

        100% {
            background-position: 0 0;
        }
    }

    .button-85:after {
        z-index: -1;
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: #222;
        left: 0;
        top: 0;
        border-radius: 10px;
    }
</style>

<form id="formFormList">
    <div class="section-body">
        <div>
            <div class="card-body">

                <input type="hidden" id="lang" class="form-control" value="<?= $lang ?>">
                <input type="hidden" id="personid" class="form-control" value="<?= $profile->person_id ?>">
                <input type="hidden" id="formID" class="form-control" value="<?= $formType ?>">

                <div class="card" id="indexDisp">
                    <div class="card-body">
                        <div class="row clearfix">
                            <div class="col-lg-8">
                                <i class="fa fa-list"></i> <u><span name="jobfrm1_5"></span></u>
                            </div>

                            <div class="col-lg-4 text-end">
                                <button type="button" class="bAdd" onClick="openForm('','');"></button>
                            </div>
                        </div>

                        <br>

                        <table id="tbCultureform" class="table table-striped table-bordered dt-responsive" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" name="jobfrm1_20"></th>
                                    <th class="text-center" name="jobfrm1_30"></th>
                                    <th class="text-center" name="joba2_20"></th>
                                    <th class="text-center" name="culture_5"></th>
                                    <th class="text-center" name="jobfrm1_60"></th>
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
    loadScript(["/app/cultureform/cultureForm.js"], function() {
        loadData("<?= $formType ?>");
    });
</script>