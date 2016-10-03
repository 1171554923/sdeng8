<?php
    use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
    $this->title = "水灯注册页面";
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
        <head>
       	 <meta charset="<?= Yii::$app->charset ?>">       	 
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel = "Shortcut Icon" href="index\images\web_icon.ico" />
         <title><?=Html::encode($this->title) ?></title>
         <?=Html::cssFile('@web/css/common.css') ?>
         <?=Html::cssFile('@web/css/register.css') ?>                                                  
       	</head>       	
<body class="contain">  
	 <div class="main">
	 	<div class="title">
	 	 	<h2>水灯社区欢迎你</h2>
	 	 </div>
	 	 
    	 <div class="main_regster">
    	 		<div class="new_style">
    	 			<h3> 创建属于你的账号</h3>    	 			                  
    	 		</div>
    	 		<p class="detail">请填写您的详细信息</p>
    	 		<?php $form = ActiveForm::begin()?>
    	 				<?=$form->field($model,'email',['template'=>'<input id="users-email" class="form-control email " placeholder="请输入电子邮箱" type="text" name="Users[email]"> <div>{error}</div>      	 				    
                ']) ?>
                  		<?=$form->field($model,'username',['template'=>'<input id="users-username" class="form-control username " placeholder="请输入账号" type="text" name="Users[username]"><div>{error}</div>
                        ']) ?>
                        
                  		<?=$form->field($model,'password',['template'=>'<input id="users-password" class="form-control password " placeholder="请输入密码" type="password" name="Users[password]"><div>{error}</div>
                        ']) ?>                        
                  		<?=$form->field($model,'confrimpassword',['template'=>'<input id="users-confrimpassword" class="form-control confrimpassword " placeholder="请确认密码" type="password" name="Users[confrimpassword]"><div>{error}</div>
                        ']) ?>
                        
                      <?=$form->field($model,'check',['template'=>"<div class=\"accept\">                        	   
                        <input id=\"users-check\" type=\"checkbox\" name=\"Users[check]\" />                        	    
                         我已认真阅读并同意<a href=\"/tos.html\" target='new'>《服务条款》</a></div><div>{error}</div>"])
                    ?>                        
                       <div class="button_style">
                  		<?= Html::resetButton('<span class="reset">重置</span>')?>  <?= Html::submitInput('提交')?>
                  	  </div>                  
                <?php ActiveForm::end();?>
                <p class="back" >
                  	<a href="/login.html">返回到登陆</a>		
           	   </p>              
    	</div>        	 
   	 </div>	
   	 
</body>
</html>
						