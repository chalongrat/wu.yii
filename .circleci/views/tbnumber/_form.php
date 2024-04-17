<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tbnumber $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbnumber-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number_a')->textInput() ?>

    <?= $form->field($model, 'number_b')->textInput() ?>

    <?= $form->field($model, 'result')->textInput() ?>

    <?= $form->field($model, 'pk_number')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
