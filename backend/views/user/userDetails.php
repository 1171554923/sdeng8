<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$gander = '';//性别
if($UsersDetails->sex == '女')
{
   $gander= ' <input type="radio"  class="sex" name="UsersDetails[sex]" value="男" />男　<input type="radio"  checked="checked" name="UsersDetails[sex]" value="女" >女';
}else{
    $gander= ' <input type="radio" checked="checked" class="sex" name="UsersDetails[sex]" value="男" />男　<input type="radio" name="UsersDetails[sex]" value="女" >女';
}

$this->title = '会员详细信息  : ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="/user">会员管理</a>
							</li>
							<li class="active">详细信息</li>
						</ul><!-- .breadcrumb -->
</div>

<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>					    
				<?= $form->field($UsersDetails, 'nickname')->label("昵称")?>		
				<?= $form->field($UsersDetails, 'sex',['template'=>'{label}'.$gander.''])->label("性别")?>
				<?= $form->field($UsersDetails, 'birth_day',['template'=>'<div class="form-group field-usersdetails-birth_day has-success">{label}<input id="usersdetails-birth_day" class="form-control" type="text" 
name="UsersDetails[birth_day]" placeholder="例如：2016/9/2" /> {error}</div>'])->label("出生日期")?>								
				<?= $form->field($UsersDetails, 'email')->label("电子邮箱")?>								
				<?= $form->field($UsersDetails, 'phone_number')->label("电话号码")?>
				<?= $form->field($UsersDetails, 'qq')->label("qq")?>
				<?= $form->field($UsersDetails, 'weixin_url')->label("微信公众号")?>				
				<?= $form->field($UsersDetails, 'web_url')->label("网站地址")?>
				<?= $form->field($UsersDetails, 'weibo_url')->label("微博账号")?>								
			    <?= $form->field($UsersDetails, 'portrait_img')?>
			    <?= $form->field($UsersDetails, 'main_img')?>
			    <?= Html::submitButton('修改',['class'=>'btn btn-primary'])?>
	<?php ActiveForm::end()?>
</div>
