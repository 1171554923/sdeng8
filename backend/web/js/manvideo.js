$(document).ready(function(){

	//排序
	$('.sort').change(function(event) {
			var id = $(this).attr('data');		
			if(isNaN($(this).val()))
			{
				alert('必须是数字');
				return false;
			}
			$.ajax({
				url: '/manvideo/sort',	
				type: 'POST',			
				data: {
						id:id,
						val : $(this).val()				
				},
				success : function(data)
				{	
								
				}
		})
	})	


	if($('#declare').attr('data'))
	{
		var url = '/article';
	}else{
		var url = '/manvideo';
	}

	//删除选中
	$('#delete').click(function(event) {
	if(confirm("确定要清空数据吗？")){
			var idStr= '';
		for(var i=0 ;i<$('.check').length;i++)
		{
			if($('.check').eq(i).is(':checked')){
				idStr += $('.check').eq(i).attr('data')+',';
			} 			
		}
		if(idStr == ''){
			alert('未选中任何对象！');
			return false;
		}
		$.ajax({
			url: url+'/delete?id='+idStr,
			type: 'get',			
			success : function(data)
			{				
				
			}
		})
	}
	});

	$('#notPass').click(function(event) {
		var idStr= '';
		for(var i=0 ;i<$('.check').length;i++)
		{
			if($('.check').eq(i).is(':checked')){
				if($('.check').eq(i).parent().parent().find('.sub_click span').attr('data') == 1){ //查找同级通过							
						idStr += $('.check').eq(i).parent().parent().find('.sub_click').attr('data')+",";
						$('.check').eq(i).parent().parent().find('.sub_click').html("<span data='0' style='color:red;cursor:pointer'>未通过</span>");										
				}
			}
		}		
		$.ajax({
			url: url+'/check',
			type: 'POST',			
			data: {
					id:idStr,
					check : 0					
				},
			success : function(data)
			{				
			}
		})
	});


	$('#passCheck').click(function(event) {		

		var idStr= '';
		for(var i=0 ;i<$('.check').length;i++)
		{
			if($('.check').eq(i).is(':checked')){
				if($('.check').eq(i).parent().parent().find('.sub_click span').attr('data') == 0){ //查找同级通过												
						idStr += $('.check').eq(i).parent().parent().find('.sub_click').attr('data')+",";
						$('.check').eq(i).parent().parent().find('.sub_click').html('<span  data="1">通过</span>');					
				}
			}
		}
		$.ajax({
			url: url+'/check',
			type: 'POST',			
			data: {
					id:idStr,
					check : 1					
				},
			success : function(data)
			{				
			}
		})
	});

	$('#allCheck').click(function(event) {

		if($('#allCheck').is(':checked'))
			{			
				for(var i=0 ;i<$('.check').length;i++)
				{
					$('.check').prop("checked",true);
				}							
			}else{				
				for(var i=0 ;i<$('.check').length;i++)
				{
					$('.check').eq(i).removeAttr('checked');
				}
			}	
		
		
	});
	
	$('.sub_click').click(function(event) {
		var id = $(this).attr('data');
		var val = $(this).find('span').eq(0).attr('data');

		_this = this;
		$.ajax({
			url: url+'/check',
			type: 'POST',			
			data: {
					id:id,
					val:val
				},
			success : function(data)
			{				
				if(data == 1)
				{							
					$(_this).html('<span  data="1">通过</span>')				
				}else{					
					$(_this).html("<span data='0' style='color:red;cursor:pointer'>未通过</span>")
				}
			}
		})
	
		
	});
})