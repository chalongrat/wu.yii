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

if (!isset($profile))
    return Yii::$app->response->redirect(['site/login']);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>" dir="ltr">

<head>
    <title>:: WU AWIS :: <?= Html::encode($this->title); ?></title>
    <!-- <link href="/manifest.json" rel="manifest"> -->
    <?php $this->head(); ?>
</head>

<body class="font-montserrat sidebar_dark" id="body-app">
    <script>
        // if ('serviceWorker' in navigator) {
        //     navigator.serviceWorker.register('/js/service-worker.js');
        // }
    </script>
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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">ภาษา</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/index.php?r=cfg-menu%2Fpriv&amp;id=75&amp;language=en"><img class="w20 mr-2" src="theme/assets/images/flags/us.svg">&nbsp;&nbsp;อังกฤษ</a>
                                    <!--div class="dropdown-divider"></div-->
                                    <a class="dropdown-item" href="/index.php?r=cfg-menu%2Fpriv&amp;id=75&amp;language=th"><img class="w20 mr-2" src="theme/assets/images/flags/th.svg">&nbsp;&nbsp;ไทย</a>
                                </div>
                            </li>
                        </ul>

                        <div class="notification d-flex">
                            <div class="dropdown d-flex">
                                <a class="nav-link icon d-flex btn btn-default btn-icon ml-1" data-toggle="dropdown">

                                    <!-- <img src="/uploads/perperson/dc22f02ebb10a68b583d24cd2af350f8.jpg" onerror="this.src='/img/avatar.jpeg'" class="avatar"> -->
                                    <!-- <img src="/uploads/perperson/dc22f02ebb10a68b583d24cd2af350f8.jpg" class="avatar"> -->

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

                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                    <!-- <a class="dropdown-item" href="/index.php?r=per-person%2Fpersonalsetting"><i class="dropdown-icon fa fa-address-card-o"></i>ตั้งค่าส่วนบุคคล </a> -->
                                    <span class="dropdown-item" onclick="themeChange();" style="cursor: pointer;"><i class="dropdown-icon far fa-moon" id="icon-mode"></i> <span id="text-mode">Dark Mode</span></span>
                                    <a class="dropdown-item" href="/site%2Flogout"><i class="dropdown-icon fa fa-power-off"></i>ออกจากระบบ </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="padding-top: 65px;"></div>

                <div class="col-12" style="margin-left: 30px; margin-right: 800px;" id="divPath">
                    <a class="header-brand" href="<?= Url::to(['site/index']) ?>"><img src="<?= Url::base() ?>/theme/assets/images/home.png" width="25px" /> หน้าหลัก</a>
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