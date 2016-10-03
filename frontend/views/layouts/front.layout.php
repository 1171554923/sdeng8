<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\bootstrap\NavBar;
use common\models\UsersDetails;
use common\models\Nav;
    
AppAsset::register($this);
$this->title='水灯社区  - 专门做狗社区的平台';
$id = Yii::$app->user->getId();
$UsersDetails = UsersDetails::findOne(['uid'=>$id]); 

$navStr = ''; //菜单分类
$nav = new Nav();
$navs= $nav->find()->orderBy('sort ASC')->limit('5')->asArray()->all();

foreach ($navs as $value)
{
   $navStr.= '<li class="hvr-bounce-to-bottom"><a href="'.$value['url'] .'" class="scroll">'.$value['name'].'</a></li>';
}

?>
<?php $this->beginBody()?>
<!DOCTYPE html>
<html>
<head>
<title><?=$this->title ?></title>
 <?php $this->head();?>
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Ramble Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<?=Html::jsFile('@web/js/jquery-2.0.3.min.js') ?>
	<!-- //Custom Theme files -->
	<!--[if IE]>
	   <?=Html::jsFile('@web/js/jquery-1.11.3.min.js') ?>   	   
    	<![endif]-->
    <!-- js -->

	<?=Html::jsFile('@web/bootstrap/js/bootstrap.min.js') ?>
	<?=Html::jsFile('@web/js/common.js') ?>
        
<!-- //js -->	
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
</head>
<body>


<?php $this->beginBody()?>
	<!--header-->
	
	<div class="header">
		<div class="container">
			<ol class="profile">                				
                					<li class="name">用户名</li>
                					<li class="name_c">@<?php if(!Yii::$app->user->isGuest){ echo Yii::$app->user->identity->username ;} ?></li>
                					<li><a href="/personal.html">个人中心</a></li>                					
                					<li><a href="/index/profile.html">设&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;置</a></li>
                					<li><a href="/logout">帮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;助</a></li>
                					<li><a href="/logout.html">退&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;出</a></li>                					
              </ol>
			<div class="header-info navbar-left wow fadeInLeft animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">
					<?php  
                		  if(Yii::$app->user->isGuest)
                	      {
                	          echo '<a href="/login.html" class="login">请,请登录</a>  <a href="/index/register.html" class="register">免费注册</a>';
                	      }else {
                	           echo '<div class="username pull-left" id="down" data="1">廖自然  <span class="down"></span></div>';
                	      }
					?>														
					<a href="/personal/upload.html" class="btn btn-primary" >上传</a>	
			</div>				
			<form class="navbar-form navbar-right wow fadeInRight animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
					<button type="submit" class="btn btn-default" aria-label="Left Align">
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					</button>
				</div>
			</form>	
		</div>	
	</div>
	<!--//header-->
	<!--navigation-->
	<div class="top-nav">
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand logo" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;" href="/index.html"></a></h1>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-left">
						<li class="hvr-bounce-to-bottom active"><a href="index.html">首页</a></li>						
						<?=$navStr ?>
					</ul>	
					<div class="clearfix"> </div>
				</div>
			</div>	
		</nav>		
	</div>	
	<!--navigation-->
	
	<?php echo $content; ?>
	
		
	
		
	
	<!--footer-->
	<div class="footer wow fadeInRight animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">
		<div class="container">
			<p>Copyright &copy; 2015.Company name All rights reserved.<a target="_blank" href="http://www.cssmoban.com/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a></p>
		</div>
	</div>
	<!--//footer-->

		<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
		<!--//smooth-scrolling-of-move-up-->	
    <?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>