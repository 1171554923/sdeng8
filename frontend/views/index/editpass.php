<style>
    .main{ 
	   margin-top:50px;
    	min-height:360px;
    }
    .edit{width :300px; margin:0 auto;}
    .edit h3{text-align:  center; }
    .edit span input{ width:100%; height:40px; line-height:40px;margin:10px 0 ;}
    .error{color:red;display:none}
    
</style>
<div class="container main">
	<div class="edit">
		<h3>修改密码</h3>
		<input type="hidden" id="name" value="<?=$name ?>">
		<span><input type="password" id="password" placeholder="请输入密码"></span>
		<span><input type="password" id="confrimpassword" placeholder="请确认密码"></span>
		<p class="error pull-right length" >密码不能小于6位</p>
		<p class="error pull-right uniqu" >密码前后不一致</p>	
		<p class="pull-right system" style="color:red; display:none">系统错误 请联系管理员</p>	
		<button class="btn btn-success" id="submit">确认</button>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#submit').click(function(){
			if($('#password').val().length < 6)
			{	
				$('.length').css('display','block');
				return false;
			}
			
			
			if($('#password').val() == $('#confrimpassword').val())
			{				
			  	$.ajax({
	   	    		url: '/sendpass/editpass.html',	
	   	    		type: 'POST',			
	   	    		data: {        				
	   	    				name : $('#name').val(),
	   	    				password : $('#password').val()		
	   	    			},
	   	    		success : function(data)
	   	    		{	
	   	   	    		if(data != 1)
	   	   	    		{
							$('.system').css('display','block');
		   	   	    	}else{
			   	   	    	 			   	   	         
			   	   	    	 window.location.href="/login.html";
			   	   	    }
	   	    		}
	   	   	   	}) 
	   				
			}else{
				$('.length').css('display','none');
				$('.uniqu').css('display','block');
			}
		})
	})
</script>