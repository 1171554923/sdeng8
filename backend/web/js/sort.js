$(document).ready(function(){
		for(var i=0; i< $('tr').length ; i++)
		{
			var str = $('tr').eq(i).find('td').eq(3).html();
			$('tr').eq(i).find('td').eq(3).html("<input type='text' class='sort'  value="+ str +" />");
		}

		$('.sort').change(function(event) {
			var id = $(this).parent().parent().find('td').eq(1).html();
			if(isNaN($(this).val()))
			{
				alert('必须是数字');
				return false;
			}

		$.ajax({
			url: '/nav/sort',	
			type: 'POST',			
			data: {
					id:id,
					val : $(this).val()				
				},
			success : function(data)
			{	
							
			}
		})	

		});
})
