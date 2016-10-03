<?php 
use yii\helpers\Html;
use kartik\form\ActiveForm;

use yii\web\Tool;


$loginStr = '';

if(Yii::$app->user->isGuest)
{
    $loginStr = '<a onclick="loginEnter()">登陆&nbsp;</a><strong>|</strong>&nbsp;<a href="/register.html">注册</a>';
}else {
    $loginStr = '<div class="pull-left" id="username" data="'.Yii::$app->user->getId().'">@'.Yii::$app->user->identity->username.'</div>';
}


?>
<script>
//查看结果
function replace_em(str){
	str = str.replace(/\</g,'&lt;');
	str = str.replace(/\>/g,'&gt;');
	str = str.replace(/\n/g,'<br/>');
	str = str.replace(/\[em_([0-9]*)\]/g,'<img src="arclist/$1.gif" border="0" />');
	return str;
}
</script>

<?=Html::cssFile('@web/css/video-js.css') ?>
<?=Html::cssFile('@web/css/watch.css') ?>
<div class="load" id="load"><img src="../images/load.gif" alt="加载图片"></div>
 <div id="overlay"></div>  
 <div class="container player"> 
 	<div class="content_l">
 			<input type="hidden" id="vid" value="<?=$adminVideo['id']?>">
          <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="360"
          	poster="<?=$adminVideo['thumbnail']?>" data-setup="{}">
            <source src="<?=constant('ASSETS_URL').$adminVideo->url?>" type='<?=$adminVideo['url_type']?>' />	
            <track kind="captions" src="../demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
            <track kind="subtitles" src="../demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
          </video>
          <div class="content">
          	<h3><?=$adminVideo['title']?></h3>
          	<div  class="number">播放次数121 &nbsp;&nbsp;&nbsp; 14次评论<span class="pull-right text"><strong class="zan"></strong><strong class="callect"></strong><strong class="notzan"></strong></span></div>
          	<div class="bshare-custom icon-medium">
          		<a title="分享到QQ空间" class="bshare-qzone"></a>
          		<a title="分享到新浪微博" class="bshare-sinaminiblog"></a>
          		<a title="分享到人人网" class="bshare-renren"></a>
          		<a title="分享到腾讯微博" class="bshare-qqmb"></a>
          		<a title="分享到网易微博" class="bshare-neteasemb"></a>
          		<a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a>
          		<span class="BSHARE_COUNT bshare-share-count">0</span></div>
          		<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh">
          		</script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js">
          		</script>
          </div> 
           <div class="comment">
               <div class="login">
                  	<?=$loginStr?>
                	    <span class="pull-right" style="color:#cccccc">300个字符</span>                    		
                </div>                 
                  	<textarea id="saytext"  class="comment_content" placeholder="看点槽点 , 不吐不快 ！别憋着  ,马上写出来 ！"></textarea>
                  	<p><span class="emotion"></span><input type="button"    class="submit_btn"
                  	 id="submit"    value="提交"></p>
                  	 <div id="popover714594" class="popover fade top in" role="tooltip" style="top: 795.733px; left: 652.5px; display: none;">
<div class="arrow" style="left: 50%;"></div>
<h3 class="popover-title" style="display: none;"></h3>
<div class="popover-content">内容不能为空!</div>
</div>
               </div>  
            
          <div class="comment_write" >
     	 	<h3><a  class="allComment">全部评论(<strong id="total">12</strong>)</a> <span class="publish">发表评论</span><span id="mycomment">我的评论</span></h3>
     	 	<div class="comment_number" id="comments"> 
     	 		
     	  </div>        	 	
         	 	                                                   
            
     	 </div> 
                          
     	 </div><!-- end conten_l --> 
     	 
     
      
      <!-- <div class="content_r">
      		
      </div> -->
 </div> 
 
 
 <?=Html::jsFile('@web/js/video.js') ?>
<?=Html::jsFile('@web/js/comment.js') ?>

	<script>
    	videojs.options.flash.swf = "../video-js.swf";
  </script>  
<?php if($request == 'true'){
       echo  '<script>
                    $(document).ready(function(){
                             $("#logining").css("display","block");
                         adjust("#logining")
			            showOverlay();
                    })
                            
        </script>';
    }       
?>

<div class="logining" id="logining">
	<p class="icon_close"><span class="close">关闭</span></p>	
	<h3>账号登陆</h3>
  	<?php  $form = ActiveForm::begin()?>
  		<?= $form->field($model, 'username')->label('用户名') ?>
  		<?= $form->field($model, 'password')->input("password")->label("用户密码") ?>
  		<?php  if($loginNum >= 3): ?>															
					<?= $form->field($model,'captcha')->widget(yii\captcha\Captcha::className(),[											
                	    'captchaAction'=>'index/captcha',											
                	    'imageOptions'=>['alt'=>'点击换图',						
                	    'title'=>'点击换图',
                	    'style'=>'cursor:pointer'],'template'=>'<input type="text" class="captcha_text" name="LoginForm[captcha]"/>{image}',			        						
	           ])->label("验证码") ?>
	     <?php endif; ?>	
	     	 <?= $form->field($model,'rememberMe',['template'=>'
                <input  type="checkbox" value="1" name="LoginForm[rememberMe]">记住密码  <a href="/forget.html" class="login-fgetpwd" >忘记密码？</a>']) ?> 
  		<?= Html::submitButton("登陆",['class'=>'submit']) ?>
  		<div class="logins">
  			<span class="baidu"><img  src="../images/bd_login_short.png"></span>
  			<span class="qq"><img src="..\images\qq.png"/></span> 
  			<span class="account"><a href="/index/register.html">还没注册账号！</a></span>   
  		</div>
  	<?php ActiveForm::end()?>
</div>

