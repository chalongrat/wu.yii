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
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>" dir="ltr">

<head>
    <title>:: WU STMS :: <?= Html::encode($this->title); ?></title>
    <link href="/manifest.json" rel="manifest">
    <?php $this->head(); ?>
</head>

<body class="font-montserrat sidebar_dark" id="body-app">
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/js/service-worker.js');
        }
    </script>
    <?php $this->beginBody() ?>

    <div class="page-loader-wrapper">
        <div class="loader">
        </div>
    </div>

    <div id="main_content">

        <div id="header_top" class="header_top">
            <div class="container" id="content-left">
                <div class="hleft">
                    <a class="header-brand" href="<?= Url::to(['site/index']) ?>" id="cancel_module"><img src="<?= Url::base() ?>/theme/assets/images/logo.png" width="50p" /></a>
                </div>
                <div class="hright py-1">
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa  fa-align-left"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <?php #include('_leftmenu.php'); 
        ?>

        <div class="page">
            <div id="page_top" class="section-body" style="min-height: 620px;">
                <div class="container-fluid px-2 page_top_container">
                    <div class="page-header" style="margin-top: -3px;">
                        <div class="left menu_toggle" style="cursor:pointer;">
                            <h1 class="page-title">
                            </h1>
                        </div>
                        <div class="right">

                            <div class="notification d-flex">
                                <div class="dropdown d-flex">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true"><?php echo Yii::t('app', 'Language'); ?></a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="<?= Url::current(['language' => 'en']) ?>"><img class="w20 mr-2" src="<?= Url::base() ?>/theme/assets/images/flags/us.svg"><?php echo Yii::t('app', 'English'); ?></a>
                                        <a class="dropdown-item" href="<?= Url::current(['language' => 'th']) ?>"><img class="w20 mr-2" src="<?= Url::base() ?>/theme/assets/images/flags/th.svg"><?php echo Yii::t('app', 'Thai'); ?></a>
                                    </div>
                                </div>
                            </div>

                            <div class="notification d-flex">
                                <div class="dropdown d-flex">

                                </div>
                            </div>

                        </div>
                    </div>
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
                <div class="section">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>