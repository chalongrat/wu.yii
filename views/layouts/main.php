<?php

use app\widgets\Alert;
use yii\bootstrap5\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/theme/assets/images/logo2.png')]);
$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'ie=edge']);
$this->registerMetaTag(['property' => 'metaIdentity', 'content' => Yii::$app->user->identity->USERNAME  ? base64_encode(Yii::$app->user->identity->USERNAME) : '']);
// $this->registerMetaTag(['property' => 'metaGender', 'content' => Yii::$app->user->identity->GENDER  ? base64_encode(Yii::$app->user->identity->GENDER) : '']);
$profile = Yii::$app->session->get("profile");
$lang = Yii::$app->session->get("sessionLang");

if (!isset($profile))
    return Yii::$app->response->redirect(['site/login']);
?>

<style>
    /* .signout {
        color: white;
    } */

    .signout:hover {
        color: #f0b144;
    }
</style>
<?php $this->beginPage() ?>
<!DOCTYPE html>

<head>
    <title>:: WU AWIS :: <?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>

<body class="font-montserrat sidebar_dark" id="body-app">

    <?php $this->beginBody() ?>

    <div class="page-loader-wrapper">
        <div class="loader">
        </div>
    </div>

    <div id="main_content">
        <div class="page">
            <div id="page_top" class="section-body" style="overflow-x: hidden;">
                <div class="page-header fixed-top" style="padding: 1px 1px 1px 1px; padding-left: 30px; padding-right: 50px; z-index: 1120;">
                    <div class="left" style="cursor:pointer;">
                        <a class="header-brand" href="<?= Url::to(['site/index']) ?>" id="cancel_module"><img src="/theme/assets/images/wu-logo-only.png" width="70px" /></a>
                    </div>
                    <div class="right">
                        <ul class="nav nav-pills">
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">ภาษา</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/index.php?r=cfg-menu%2Fpriv&amp;id=75&amp;language=en"><img class="w20 mr-2" src="theme/assets/images/flags/us.svg">&nbsp;&nbsp;อังกฤษ</a>
                                    <a class="dropdown-item" href="/index.php?r=cfg-menu%2Fpriv&amp;id=75&amp;language=th"><img class="w20 mr-2" src="theme/assets/images/flags/th.svg">&nbsp;&nbsp;ไทย</a>
                                </div>
                            </li> -->

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true"><span name="nav_1"></span></a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" onclick="switchLang('en',<?= $profile->person_id ?>);"><img class="w20 mr-2" src="theme/assets/images/flags/us.svg">&nbsp;&nbsp;English</a>
                                    <a class="dropdown-item" onclick="switchLang('th',<?= $profile->person_id ?>);"><img class="w20 mr-2" src="theme/assets/images/flags/th.svg">&nbsp;&nbsp;ไทย</a>
                                </div>
                            </li>
                        </ul>

                        <div class="notification d-flex">
                            <div class="dropdown d-flex">
                                <!-- <a class="nav-link icon d-flex btn btn-default btn-icon ml-1" data-toggle="dropdown"> -->
                                <a class="nav-link icon d-flex btn btn-default btn-icon ml-1">
                                    <?php if ($profile->person_id == 6500000064) { ?>
                                        <div class="content-cover img-thumbnail rounded-circle " width="10p">
                                            <img class="content-image avatar-xxxl" src="/theme/assets/images/batman.png" width="10p">
                                        </div>
                                    <?php } else { ?>
                                        <div class="content-cover img-thumbnail rounded-circle " width="10p">
                                            <img class="content-image avatar-xxxl" src="/theme/assets/images/user3.png" width="10p">
                                        </div>
                                    <?php } ?>

                                    <span class="user_name">&nbsp;<?= $profile->full_name ?></span>
                                </a>

                                <div class="nav-link icon d-flex btn btn-default btn-icon ml-1">
                                    <div class="content-cover">
                                        <!-- <span name="nav_2"></span> -->
                                        <!-- <i class="dropdown-icon fa fa-power-off"></i> -->
                                        <a class="signout" href="/site%2Flogout"><img src="/theme/assets/images/logout.png" width="20p" height="20p">&nbsp;<span name="nav_2"></span></a>
                                    </div>
                                </div>

                                <!-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <span class="dropdown-item" onclick="themeChange();" style="cursor: pointer;"><i class="dropdown-icon far fa-moon" id="icon-mode"></i> <span id="text-mode">Dark Mode</span></span>
                                    <a class="dropdown-item" href="/site%2Flogout"><i class="dropdown-icon fa fa-power-off"></i><span name="nav_2"></span></a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div style="padding-top: 65px;"></div>

                <div class="col-12" style="margin-left: 30px; margin-right: 800px;" id="divPath">
                    <a class="header-brand" href="<?= Url::to(['site/index']) ?>"><img src="<?= Url::base() ?>/theme/assets/images/home.png" width="25px" /> <span name="mcard_1"></span></a>
                </div>

                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs2']) ? $this->params['breadcrumbs2'] : [],
                    'homeLink' => [
                        'label' => (YII_DEBUG ? '<i class="fa fa-university"></i>' : '<i class="fas fa-home"></i>') . ' ' . Yii::t('app', 'Home'),
                        'url' => Yii::$app->homeUrl,
                        'encode' => false,
                    ],
                ]) ?>

                <?= Alert::widget([
                    'options' => [
                        'timer' => 1500,
                        'confirmButtonText' => Yii::t('app', 'OK'),
                    ],
                ]) ?>
            </div>

            <div>
                <!-- <div id="menuCard"> -->
                <?= $content ?>
                <!-- </div> -->
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

<script>
    renderLabel("aps-job", lang, "apsJob");

    function switchLang(lang, person_id) {
        $.ajax({
            url: `http://localhost:8080/users/updatelang?lang=${lang}&person_id=${person_id}`,
            // url: `${baseUrl}/users/updatelang?lang=${lang}&person_id=${person_id}`,

            type: "GET",
            success: function(data) {
                window.location.reload();
            },
            error: function(response) {
                console.log("check fail");
            },
        });
    }
</script>