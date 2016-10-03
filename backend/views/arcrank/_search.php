<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArcrankSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="arcrank-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'rank') ?>

    <?= $form->field($model, 'membername') ?>


    <?= $form->field($model, 'money') ?>

    <?php // echo $form->field($model, 'scores') ?>

    <?php // echo $form->field($model, 'purviews') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
