<?php
    use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
    $this->title = "找回密码";
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
        <head>
       	 <meta charset="<?= Yii::$app->charset ?>">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel = "Shortcut Icon" href="..\web_icon.ico" />
         <title><?=Html::encode($this->title) ?></title>
         <?=Html::cssFile('@web/css/common.css') ?>
         <?=Html::cssFile('@web/css/register.css') ?>
         <?=Html::jsFile('@web/js/jquery-2.0.3.min.js') ?>
                                                  
       	</head>
       	
<body class="contain">  
	 <div class="main">
	 	<div class="title">
	 	 	<h2>水灯 有趣有料的社区</h2>
	 	 </div>
	 	 
        	 <div class="main_regster">
        	 		<div class="Retrieve">
        	 			<h3>重新得到你的密码</h3>    	 			                  
        	 		</div>
        	 		<?php     
        	 	
        	 		if($tag == 1){
        	 		    echo '<p class="detail">请填写您的用户名</p>
        	 		<div class="blank"></div>
        	 			<input class="form-control email " id="username" placeholder="请输入用户账号" type="text" >
        	 			<p class="error" style="font-size:14px;display:none">用户行号不存在</p>
        	 			<button  class="send" id="send">确认</button>
        	 			<div class="blank"></div>
                    <p class="back back_red" >
                      	<a href="/login.html"><img src="..\images\arrow_l.png">返回到登陆</a>
               	   </p>';
        	 		    
        	 		}else{
        	 		    echo '<p class="detail">请填写您的电子邮箱</p>
        	 		<div class="blank"></div>
                        <input type="hidden" value="'.$tag.'" id="name">                               
        	 			<input class="form-control email " id="email" placeholder="请输入邮箱账号" type="text" name="email">
        	 			<p class="error" style="font-size:14px;display:none">电子邮箱不正确</p>
        	 			<button  class="send" id="sendEmail">发送</button>					
        	 			<div class="blank"></div> 
                    <p class="back back_red" >
                      	<a href="/login.html"><img src="..\images\arrow_l.png">返回到登陆</a>		
               	   </p>';
        	 		}
        	 		?>
        	 		           
        	</div>        	 
   	 </div>	
   	 <script>
   	 $(document).ready(function(){
   	   	 $('#sendEmail').click(function(){   	   	   	 
   	   	   	$.ajax({
   	    		url: '/sendpass/email.html',	
   	    		type: 'POST',			
   	    		data: {        				
   	    				name : $('#name').val(),
   	    				email : $('#email').val()		
   	    			},
   	    		success : function(data)
   	    		{	
   	   	    		if(data == 2)
   	   	    		{
   	   	   	    		$('.error').css('display','block');
   	   	   	    	}else{
   	     	   	   	   window.location.href="/succemail.html?email=" + $('#email').val();		
   	   	   	   	    }
   	    		}
   	   	   	}) 
   	    })

   	    $('#send').click(function(){
   	   	   	 
   	   	   	$.ajax({
   	    		url: '/sendpass/verifi.html',	
   	    		type: 'POST',			
   	    		data: {        				
   	    				name : $('#username').val()		
   	    			},
   	    		success : function(data)
   	    		{	
   	   	    		if(data == 2)
   	   	    		{
						$('.error').css('display','block');						
   	   	   	    	}else{
   	   	   	   	    	
   	     	   	   	   window.location.href="/forget.html?tag="+ $('#username').val()	
   	   	   	   	    }  	    					
   	    		}
   	    	})
   	   	 })    		
   	  })
    	
   	 </script>
</body>
</html>
						