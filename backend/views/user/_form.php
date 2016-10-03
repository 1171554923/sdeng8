<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Arcrank;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $form yii\widgets\ActiveForm */
$Arcrank = new Arcrank(); //用户等级
$Arcranks = $Arcrank->findBySql("select id,membername from sd_arcrank order by rank ASC")->asArray()->all();
$option = '' ; 
foreach ($Arcranks as $value)
{
        if($model->user_type == $value['id']){
            $option .= '<option selected="selected" value="'.$value['id'].'">'.$value['membername'].'</option>';
        }
       $option .= '<option value="'.$value['id'].'">'.$value['membername'].'</option>';
}
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

	<div class="form-group field-users-user_type">
    	<?= $form->field($model, 'user_type',['template'=>'{label}　<select id="users-user_type" name="Users[user_type]">'.$option.'</select>']) ?>    
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
