<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Arcrank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="arcrank-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rank')->textInput() ?>

    <?= $form->field($model, 'membername')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'money')->textInput() ?>

    <?= $form->field($model, 'scores')->textInput() ?>

    <?= $form->field($model, 'purviews')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
