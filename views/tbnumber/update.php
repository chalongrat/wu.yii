<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tbnumber $model */

$this->title = 'Update Tbnumber: ' . $model->pk_number;
$this->params['breadcrumbs'][] = ['label' => 'Tbnumbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk_number, 'url' => ['view', 'pk_number' => $model->pk_number]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbnumber-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
