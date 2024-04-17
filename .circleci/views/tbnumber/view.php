<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tbnumber $model */

$this->title = $model->pk_number;
$this->params['breadcrumbs'][] = ['label' => 'Tbnumbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbnumber-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'pk_number' => $model->pk_number], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'pk_number' => $model->pk_number], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'number_a',
            'number_b',
            'result',
            'pk_number',
        ],
    ]) ?>

</div>
