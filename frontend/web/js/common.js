//公共类
$(document).ready(function() {
	//菜单样式
	$('.menu li').hover(function() {
		$('.menu li').eq(0).removeClass('check');
		$(this).addClass('check').css('color','#C9B010');
	}, function() {
		$('.menu li').eq(0).addClass('check');
		$(this).removeClass('check');
	});

	//滚动事件
	$(document).scroll(function(event) {
		if($(document).scrollTop() > 100)
		{
			$('header').css('position','fixed');
		}else{
			$('header').css('position','');
		}
	});

	$('#click_up').click(function(event) {
		$('#demo').css('display','block');
	});

	//隐藏个人信息
	$('body').click(function(event) {	
		$('#enterNumber').css('display','none');
		if($('#down').attr('data') == '0')
		{
			$('.profile').css('display','none');
			$('#down').attr('data',"1");
		}

	});

	//显示个人信息
	$('#down').click(function(event) {	

		if($('#down').attr('data') == '1')
		{
			
			$('.profile').css('display','block');
			$('#down').attr('data',"0");
		}
		
		event.stopPropagation(); 
	});

});


/* 显示遮罩层 */
function showOverlay() {
    $("#overlay").height(pageHeight());
    $("#overlay").width(pageWidth());

    // fadeTo第一个参数为速度，第二个为透明度
    // 多重方式控制透明度，保证兼容性，但也带来修改麻烦的问题
    $("#overlay").fadeTo(200, 0.5);
}

/* 隐藏覆盖层 */
function hideOverlay() {
    $("#overlay").fadeOut(200);
}

/* 当前页面高度 */
function pageHeight() {
    return document.body.scrollHeight;
}

/* 当前页面宽度 */
function pageWidth() {
    return document.body.scrollWidth;
}

/* 定位到页面中心 */
function adjust(id) {		
    var w = $(id).width();
    var h = $(id).height();       
    var t = scrollY() + (windowHeight()/2) - (h/2);
    if(t < 0) t = 0;
    
    var l = scrollX() + (windowWidth()/2) - (w/2);
    if(l < 0) l = 0;   
    $(id).css({left: l+'px', top: t+'px'});
}

//浏览器视口的高度
function windowHeight() {
    var de = document.documentElement;

    return self.innerHeight || (de && de.clientHeight) || document.body.clientHeight;
}

//浏览器视口的宽度
function windowWidth() {
    var de = document.documentElement;

    return self.innerWidth || (de && de.clientWidth) || document.body.clientWidth
}

/* 浏览器垂直滚动位置 */
function scrollY() {
    var de = document.documentElement;

    return self.pageYOffset || (de && de.scrollTop) || document.body.scrollTop;
}

/* 浏览器水平滚动位置 */
function scrollX() {
    var de = document.documentElement;

    return self.pageXOffset || (de && de.scrollLeft) || document.body.scrollLeft;
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
			$('#logining').css('display','block');		
			 adjust('#logining')
			 showOverlay();
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