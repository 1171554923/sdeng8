<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Carousel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carousel-form">

    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data']] 
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>        
	 <span>缩略图建议1600*600</span><input type="file" name="file"  onchange="previewImage(this)">	 
	 <div id="preview">	
	 
	 <?php 
   		if($model->url != '')
   		{
   		    echo '<img id="view" src="'.$model->url.'"  width="400px">';
   		}else{
   		   echo '<img id="view" src="#">';
   		}
    
    ?>
  
	 </div>	     


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
