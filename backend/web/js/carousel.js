$(document).ready(function(event){
	
	$('#close').click(function(event) {
		
		$('#img').css('display','none');
	});

	$('.sort').change(function(event) {
			var id = $(this).parent().parent().find('td').eq(0).html();
			
			if(isNaN($(this).val()))
			{
				alert('必须是数字');
				return false;
			}

		$.ajax({
			url: '/carousel/sort',	
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

})
function showImg(_this){
	 var src = $(_this).html();
	 $('#img img').attr('src',src); 
	 $('#img').css('display','block');
}