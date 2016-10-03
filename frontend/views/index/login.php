<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use backend\assets\AppAsset;
use yii\web\Baidu;
use yii\web\BaiduCookieStore;
use yii\web\BaiduUtils;





/* $clientId = 'YnFYNQ69goRI0G0e3AUbWhOr';
$clientSecret = 'rfVo521OuTb6xpLoofpRpiMgZWgmwcoa';
$redirectUri = 'http://sdeng8.com/index/callback.html';
$domain = '.sdeng8.com'; */
$clientId = 'llYR1Ba1cZ3uwEX4tcbO6QL5';
$clientSecret = 'obh5DcqzusMmhxrlh8tlGYjHYt5px5OS';
$redirectUri = 'http://robin928.sinaapp.com/demos/website/login_callback.php';
$domain = '.robin928.sinaapp.com';



$baidu = new Baidu($clientId, $clientSecret, $redirectUri,new BaiduCookieStore($clientId));
$user = $baidu->getLoggedInUser();

// Login or logout url will be needed depending on current user state.
if ($user) {
    $logoutUrl = $baidu->getLogoutUrl('http://robin928.sinaapp.com/index/login_callback.html?u=' .
        urlencode(BaiduUtils::getCurrentUrl()));
} else {
    $loginUrl = $baidu->getLoginUrl('', 'popup');
}



$this->title="水灯登录";
//引入css界面
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>" />
		<title><?=  Html::encode($this->title)?></title>			
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php $this->head() ?>
		<?=Html::cssFile('@web/css/common.css') ?>                       
        <?=Html::cssFile('@web/css/login.css') ?>
        <?=Html::jsFile('@web/js/jquery-1.7.2.min.js')?>
	</head>
<body>	
<?php $this->beginBody() ?>
	<div class="back"><a href="/"><img src="../images/arrow_ll.png" width=12%/> 返

回</a></div>                                
            <div class="logo_box">
            	<h3>水灯社区欢迎你</h3>
            	<?php  $form = ActiveForm::begin()?>
            		<div class="input_outer">
            			<span class="u_user"></span><?= $form->field($model, 'username',
            			    ['template'=>"<input id=\"loginform-username\" name=\"LoginForm[username]\"
            			        class=\"text\" placeholder=\"输入ID或用户名登录\"
            			        style=\"color: #FFFFFF !
                        important\" type=\"text\"><div class=\"error\">{error}</div>"])?>											
            		</div>            		
				<div class="input_outer">            			
	<span class="u_user"></span><?= $form->field($model, 'password',
            			    ['template'=>"<input id=\"loginform-password\" 
                                name=\"LoginForm[password]\"
            			        placeholder=\"输入用户密码\"
            			        class=\"text\" 
            			        style=\"color: #FFFFFF !
                        important\" type=\"password\"><div class=\"error\">{error}
</div>"])?>
            		</div>		
            		<?php  if($loginNum >= 3): ?>															
					<?= $form->field($model,'captcha')->widget(yii\captcha\Captcha::className(),[											
                	    'captchaAction'=>'index/captcha',											
                	    'imageOptions'=>['alt'=>'点击换图',						
                	    'title'=>'点击换图',
                	    'style'=>'cursor:pointer'],'template'=>'<input type="text" class="captcha_text" name="LoginForm[captcha]"/>{image}',			        						
	           ])->label("验证码") ?>
	          	  <?php endif; ?>																						
            		<div class="mb2">
            		<?= Html::submitButton('登陆',['class'=>'submit'])?>            		 
            		 </div>
            		 
            		 <?= $form->field($model,'rememberMe',['template'=>'
<input id="loginform-rememberme" class="form-control" type="checkbox" value="1" 
name="LoginForm[rememberMe]">记住密码  <a href="/forget.html" class="login-fgetpwd" >忘记密码？</a>']) ?>            		 
            	<?php ActiveForm::end()?>
            	
            	
            	<div class="logins">
            		
            			   <?php if ($user): ?>                     
                      	<img id="logoutfrombaidu" src="../images/bd_logout_short.png">                      
                    <?php else: ?>                    
                      	<img id="loginwithbaidu" src="../images/bd_login_short.png">                     
                    <?php endif ?>            		
            		<div class="wx">
            			<img src="..\images\qq.png"/>
            		</div>
                		<div class="sas">
                		<a href="/index/register.html">还没注册账号！</a>
                		</div>
            	</div>            	            	
            </div>  
            
        <script type="text/javascript" src="../js/mootools-1.3.js"></script>
	<script type="text/javascript" src="../js/LightFace.js"></script>
	<script type="text/javascript" src="../js/LightFace.IFrame.js"></script>
            <script>    
    <?php if (!$user): ?>
    document.id('loginwithbaidu').addEvent('click',function() {
    	//获得窗口的垂直位置
        var iTop = (window.screen.availHeight-30-320)/2;        
        //获得窗口的水平位置
        var iLeft = (window.screen.availWidth-10-500)/2;
        window.open('<?php echo $loginUrl; ?>', 'newwindow',
            'height=320, width=500, top=' + iTop + ', left=' + iLeft +
            ', toolbar=no, menubar=no, ' +
            'scrollbars=no, resizable=no, location=no, status=no');
    });
    <?php else: ?>
      function onTranslate(is_success, result) {
        if (is_success) {
          var result = result.trans_result;
          var str = '';
          for ( var i = 0; i < result.length; i++) {
            if ( i != 0) { str += '<br/>'; }
            str += result[i].dst;
          }
          document.id('translate_result').innerHTML = '<span style="color:blue">' + str + '</span>';
        } else {
          document.id('translate_result').innerHTML = 'Translate failed: <span style="color:red;">' + result + '</span>';
        }
         return false;
      }
      function onUploadFailed(error) {
      	document.id('tip').innerHTML = 'Upload failed: <span style="color:red">' + error + '</span>';
        return false;
      }
      
      function onUploadSuccess(pic_url) {
      	document.id('tip').innerHTML = 'Upload success, your can see it by this url: <a href="' + pic_url + '" target="_blank">' + pic_url + '</a>';
        return false;
      }
      
      document.id('logoutfrombaidu').addEvent('click', function() {
		window.location.href = "<?php echo $logoutUrl; ?>";
      });
    <?php endif ?>
    </script>
       
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>