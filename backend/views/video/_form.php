<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Video */
/* @var $form yii\widgets\ActiveForm */
$category =  new Category();
$categorys = $category->find()->asArray()->all();
 $option ='';
foreach ($categorys  as $value){
         $option .= '<option value="'.$value['id'].'">'.$value['category'].'</option>';    
}  

?>
<style>
    .file-preview{display:none}
</style>

<div class="video-form">

    <?php $form = ActiveForm::begin(); ?>
    

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php 
				echo '<div class="well well-small">';
    				echo FileInput::widget([    				    
    				    'name' => 'attachment_30',    				    
    				    'pluginOptions' => [    	    				        
    				        'allowedPreviewTypes' => ['video'],
    				        'showPreview' => true,
    				        'showCaption' => false,
    				        'elCaptionText' => '#customCaption',
    				        'uploadUrl' => Url::to(['/upload/video']),  
    				        'uploadAsync' => true,
    				        'maxFileSize' => 102400,
    				        'maxFileCount' => 1,
    				        'allowedFileExtensions' =>['avi','rmvb','rm','asf','divx','mpg','mpeg','mpe','wmv','mp4','mkv','vob'],    				        
    				    ],    				        				        				       	
    				]);
    				echo '<span id="customCaption" class="text-success">No file selected</span>';
    				echo '</div>';
				?> 
	<?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>	
    <?= $form->field($model, 'notes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
 

    <?= $form->field($model, 'categ',['template'=>'{label}　<select id="video-categ"  name="video[categ]"><option>请选择....</option>'.$option.'</select>{error}'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
