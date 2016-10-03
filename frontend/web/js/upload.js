/**
 * 上传图片和上传视频库
 */
 $(document).ready(function() {
 	 

 	//图片描述 	
 	$('#discript').keyup(function(event) {
 		$('.number').css('display','block');
 		var str = $('#discript').val(); 	
 		  $('#number').html(200 - str.length);
 	});


 	$('#click_up').click(function(event) {
		$('#demo').css('display','block');
	});

 	//关闭上传图片
	$('#close_i').click(function(event) {
		var img = $('.kv-file-content img'); //上传图片的地址
		var str = '';  //存放地址
		for(var i=0; i < img.length ; i ++)
		{
			if(img[i].src.substring(0,4) == 'http')
			{
				str += 	img[i].src+',';
			}			
		}
		$('#upload-url').val(str);
		if(str.length != 0)
		{			
			$('#click_up').html('图片已上传完成')
		}else{
			
			$('#click_up').html('点击选择图片上传');
		}
		$('#form-group').css('display','none');
		hideOverlay();
	})

	//img的内容 
	//ps 上传冲突 清空
	var contentStr = $('.content').html();
	var contentVid = $('.vedio_content').html();

	//上传图片和视频切换
	$('#img_up').click(function(){
			$('#vedio_up').removeClass('check');
			$('#img_up').addClass('check');
			$('#upload_s').html("上传图片")	
			$('.content').css('display','block');
			$('.vedio_content').css('display','none')
	 })
	$('#vedio_up').click(function(){			
			$('#img_up').removeClass('check');
			$('#vedio_up').addClass('check');
			$('#upload_s').html("上传视频");			
			$('.content').css('display','none');				
			$('.vedio_content').css('display','block');
			$('.file-preview').css('display','none');
			$('.kv-upload-progress').css('display','block');
	 })


	//显示上传
	$('#click_up').click(function(event) {
		adjust('#form-group') 
		$('.form-group').css('display','block');
		showOverlay();
	});

 })
