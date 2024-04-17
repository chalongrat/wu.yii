<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbnumber $model */

$this->title = 'Create Tbnumber';
$this->params['breadcrumbs'][] = ['label' => 'Tbnumbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbnumber-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
