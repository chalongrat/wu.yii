<?php

use app\models\Tbnumber;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tbnumbers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbnumber-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbnumber', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'number_a',
            'number_b',
            'result',
            'pk_number',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tbnumber $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'pk_number' => $model->pk_number]);
                 }
            ],
        ],
    ]); ?>


</div>
