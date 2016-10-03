<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use common\models\Nav;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
$navStr="";
$nav = new Nav();
$navs = $nav->find()->asArray()->all();

foreach ($navs  as $value){
    if($model->nav == $value['id'] ){
        $navStr .= '<option selected="selected" value="'.$value['id'].'">'.$value['name'].'</option>';
    }
   $navStr .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
}

$category =  new Category();
$categorys = $category->find()->asArray()->all();

$option ='';
$statu = '';
foreach ($categorys  as $value){
    if($model->cate_g == $value['id'] ){
        $option .= '<option selected="selected" value="'.$value['id'].'">'.$value['category'].'</option>';
    }
    $option .= '<option value="'.$value['id'].'">'.$value['category'].'</option>';
}

if($model->statu == 1){
    $statu = '<option value="0">未通过</option><option selected="selected" value="1">通过</option>';
}else{
    $statu = '<option value="0">未通过</option><option  value="1">通过</option>';
}

?>

<div class="article-form">

    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data']]
    ); ?>

    <?= $form->field($model, 'name')->textInput()->label("发布人") ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

   <span>缩略图建议600*400</span><input type="file" name="file"  onchange="previewImage(this)">
   <div id="preview">		    					
   		<?php 
   		if($model->thumbnail != '')
   		{
   		    echo '<img id="view" src="'.$model->thumbnail.'"  >';
   		}else{
   		   echo '<img id="view" src="" alt="缩略图" >';
   		}
    
    ?>
                					
   </div>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true])->label("文章描述") ?>
    
    <textarea id="TextArea1" name="Article[content]" class="ckeditor"><?= $model->content ?></textarea>
           

    <?= $form->field($model, 'tag')->textInput(['maxlength' => true])->label("标签　例如：金毛,搞笑") ?>
        

    <?= $form->field($model, 'cate_g',['template'=>'{label}　<select id="article-cate_g"  name="Article[cate_g]"><option>请选择....</option>'.$option.'</select>{error}'])?>

	<?= $form->field($model, 'nav',['template'=>'{label}　<select id="article-nav"  name="Article[nav]"><option>请选择....</option>'.$navStr.'</select>{error}'])?>
	
   <?= $form->field($model, 'statu',['template'=>'{label}　<select id="article-statu"  name="Article[statu]">'.$statu.'</select>{error}'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
