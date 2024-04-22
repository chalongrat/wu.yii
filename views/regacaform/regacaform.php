<?php

$profile = Yii::$app->session->get("profile");
$lang = Yii::$app->session->get("sessionLang");

use yii\web\View;

$this->registerJs('loadScript(["/app/regacaform/regacaform.js"], function() { bypass("' . $formType . '", "' . $formListID . '", "' . $profile->person_id . '");});', View::POS_END);
$this->registerJs('buttonClass();', View::POS_END);
?>

<head>
    <style>
        /* version 1 */
        .accordion-item {
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .accordion-header {
            background-color: #f1f1f1;
            color: #333;
            cursor: pointer;
            border-radius: 10px;
            /* padding: 5px; */
            padding-left: 5px;
            padding-bottom: 5px;
            padding-top: 1px;
        }

        .accordion-body {
            padding: 15px;
        }

        .accordion-body p {
            margin-bottom: 0;
        }

        .accordion-button.collapsed {
            border-radius: 5px;
        }
    </style>
</head>

<form id="regacaForm">
    <div class="section-body">
        <div style="overflow-x: auto;">
            <div class="card-body">

                <input type="hidden" id="personid" class="form-control" value="<?= $profile->person_id ?>">

                <div class="section-body">
                    <input type="hidden" id="lang" class="form-control" value="<?= $lang ?>">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="overflow-x: auto;">
                                <div class="card-body">
                                    <div class="row clearfix">
                                        <div class="row flex justify-content-center mt-4">

                                            <!-- Div accordion -->
                                            <div class="accordion" id="accordionExample"></div>

                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <button type="button" class="bBack" onClick="$.loadPage('/regacaform/index?formType=<?= $formType ?>', event);"></button>
                                        </div>
                                        <div class="col-lg-4 text-center">
                                            <button type="submit" id="bSave" class="bSave" onClick="saveData('<?= $formListID ?>')"></button>
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


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    buttonClass();

    $(document).ready(function() {
        renderLabel("aps-job", lang, "apsJob");
    });
</script>