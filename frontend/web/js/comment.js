$(function(){
	var uid = $('#username').attr('data');
	var vid = $('#vid').val();	

	//加载评论条数
	$.ajax({
	 	url: '/comment/total.html',	
		type: 'POST',			
		data: {	
				vid : vid,					
			},
		success : function(data){																											
					$('#total').html(data)						
			}
 	})  
 	
 	$('#comments').html('<div class="load_comment"></div>');
 	loadComment(vid,uid) 


	//加载全部评论
	$('.allComment').click(function(event) {
		 $('#comments').html('<div class="load_comment"></div>');
 		 loadComment(vid,uid) 
	});

	$('.publish').click(function(event) {
		$('#saytext').focus();
	});

	 $("[data-toggle='popover']").popover();

	//关闭登陆
	$('.icon_close').click(function(event) {
			$('#logining').css('display','none');	
			hideOverlay();
	});

	//我的评论
	$('#mycomment').click(function(event) {
		$('#comments').html('<div class="load_comment"></div>');
		$.ajax({
				url: '/comment/page.html',
				type: 'POST',			
				data :{					
					vid : vid,
					uid : uid,									
					page : 1,
					type : 'mycomment'
				},
				success : function(data)
				{								
					$('#comments').html(data);
				}				
		})

	});



	//提交评论
	$('#submit').click(function(event) {		
		var content = $('#saytext').val();			
		if(uid == undefined)
		{	
			$('#logining').css('display','block');		
			 adjust('#logining')
			 showOverlay();
			 return false;
		}		
		if(content == '')
	{					
		$('#popover714594').css('display','block');
		setTimeout(function(){
			$('#popover714594').css('display','none');
		},1000)
		return false;      
	}else{
		if(content.length >300){
			$('#popover714594').css('display','block');
			$('#popover714594').html('评论内容不能大于300个字符');				
			setTimeout(function(){
				$('#popover714594').css('display','none');
			},1000)
			return false;
		}
	}
		$('#load').css('display','block');		
			 adjust('#load');
			 showOverlay();				 
		$.ajax({
						url: '/comment/index.html',	
						type: 'POST',			
						data: {
								text :content ,
								id :uid,
								vid : vid
						},
						success : function(data)
						{	
							if(data == 1)
							{
								$.ajax({
									 	url: '/comment/page.html',	
										type: 'POST',			
										data: {
												page : 1,
												vid : vid								
											},
												success : function(data)
											 {									
													$('#comments').html(data);
												}
									  })
								    setTimeout(function(){
								 		alert('发布成功');
									$('#load').css('display','none');		
									 adjust('#load')
									 hideOverlay();
								},500)
							}else{
								 setTimeout(function(){
								 	alert('发布失败');
									$('#load').css('display','none');		
									 adjust('#load')
									 hideOverlay();
								},500)
							}			
						}
				})
	});

   	//表情
	$('.emotion').qqFace({
				id : 'facebox', 
				assign: 'saytext', 
				path:'arclist/'	//表情存放的路径
	});
});

function loginEnter()
{
	$('#logining').css('display','block');		
	 adjust('#logining');
	 showOverlay();
}

//点赞
function goodsCheck(_this,type){		
		 var id = $(_this).attr('data');   		
   		 var number = 0;
   		 if($(_this).html() != '')
   		 {
   		 	number = parseInt($(_this).html());
   		 }
   		 $.ajax({
   		 	url: '/comment/addzan.html',	
						type: 'POST',			
						data: {
								id : id,
								type : type
						},
						success : function(data)
						{								
							if(data == 1)
							{													
								 $(_this).html(number  + 1);
								 if(type == 'zan'){
								 	$(_this).css('background','url("../images/tool.png") 0 -80px  no-repeat');
								 }else{
								 	$(_this).css('background','url("../images/tool.png")0 -108px no-repeat');
								 }
								 $(_this).removeAttr('onclick');
							}
						}
   		 })
}

//回复
function backMessage(_this)
{
	   $('.return').css('display','none');
	    var element = $(_this).parent().parent().parent().find('dd').eq(1);
   		var vid = $('#vid').val();
   		var uid = $('#username').attr('data');
   		var objectId = element.attr('data');   		
   		assign = 'saytext'+objectId;
					 //表情
		$('.emotion').qqFace({
				id : 'facebox', 
				assign: assign, 
				path:'arclist/'	//表情存放的路径
		});
   		
   		$.ajax({
				url: '/comment/page.html',
				type: 'POST',			
				data :{					
					vid : vid,
					uid : uid,
					objectId : 	objectId,					
					page : 1,
				},
				success : function(data)
				{								
					element.find('.return_list').html(data);
				}				
		})

   			
   		element.slideDown('slow');
}

//关闭回复
function close_back(_this)
{
	$(_this).parent().parent().css('display','none');
}

//回复别人
function backOhter(_this){
	if($(_this).parent().parent().parent().parent().find('div').eq(0).attr('data') == 'me')
		{
			alert('不能回复自己');
			return false ;
	}
	
	 var name = '回复 ：@'+$(_this).parent().parent().find('p span').eq(0).html()+'　'; 
	 $(_this).parent().parent().parent().parent().parent().find('textarea').val(name).focus();
}

//回复消息
function bakc_message(_this)
{	
	    var parent  =$(_this).parent().parent();
	    var Div = parent.find('.return_list').eq(0);	       	   
   		var objectId =  parent.attr('data');
   		var uid = $('#username').attr('data');
		var vid = $('#vid').val();
		var content = parent.find('textarea').eq(0).val();	
		if($(_this).parent().parent().parent().parent().find('div').eq(0).attr('data') == 'me')
		{
			alert('不能回复自己');
			return false ;
		}
		if(uid == undefined)
		{	
			loginEnter();
			 return false;
		}				
		if(content == '')
		{					
		alert('内容不能为空！')
		return false;      
		}else{
			if(content.length >300){
				alert('内容不能超过300个字符！')
				return false;
			}
		}
		$.ajax({
				url: '/comment/return.html',
				type: 'POST',			
				data :{					
					vid : vid,
					uid : uid,
					objectId : 	objectId,
					content : content
				},
				success : function(data)
				{									
					if(data == 1)	
					{
						assign = 'saytext'+objectId;
					 //表情
		$('.emotion').qqFace({
				id : 'facebox', 
				assign: assign, 
				path:'arclist/'	//表情存放的路径
		});
							$.ajax({
									url: '/comment/page.html',
									type: 'POST',			
									data :{					
										vid : vid,
										uid : uid,
										objectId : 	objectId,					
										page : 1,
									},
									success : function(data)
									{								
										Div.html(data);
									}				
							})
					}			
				}				
		})
}

//點擊分頁
function paging(data,objectId,_this)
{		
	var uid = $('#username').attr('data');	
	 if(objectId > 0){
	 	var element = $(_this).parent().parent();
	 	element.html('<div class="load_comment"></div>');
	 }else{
	 	$('#comments').html('<div class="load_comment"></div>');
	 	var element =$('#comments');
	 }
		var vid = $('#vid').val();
  		var page= $(this).attr('data');
  		 $.ajax({
  		 			url: '/comment/page.html',	
						type: 'POST',			
						data: {
								vid : vid,
								page : data,
								objectId: objectId,
								uid : uid								

						},
						success : function(content)
						{		

							 element.html(content);		
												
						}
  		  })
}

function loadComment(vid,uid)
{
	$.ajax({
 	url: '/comment/page.html',	
	type: 'POST',			
	data: {
			page : 1,
			vid : vid,
			uid : uid						
		},
			success : function(data)
			{		
																														
				$('#comments').html(data);
		
			}
  }) 
}