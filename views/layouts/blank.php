<?php

use app\assets\AppAsset;
use app\widgets\Alert;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/theme/assets/images/logo2.png')]);
$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'ie=edge']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>" dir="ltr">

<head>
    <title>Walailak-Academic Works Information System</title>
    <?php $this->head() ?>
</head>

<body class="font-montserrat sidebar_dark" id="body-app">
    <?php $this->beginBody() ?>
    <?= Alert::widget() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>