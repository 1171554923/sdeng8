$(document).ready(function(){
  //显示系统推荐
  $('.system_c').click(function(event) {
      $('#style_check').css('display','block');
       adjust('#style_check'); 
       showOverlay();
  });

  //取消系统推荐
  $('.cancel').click(function(event) {
      $('#style_check').css('display','none');
      hideOverlay();
  });
  
  //确认系统推荐
  $('#confirm').click(function(event) {    
    var src = $('#big_view').attr('src');
    $('#view').attr('src',src);
    $('#style_check').css('display','none');
    $('#usersdetails-main_img').val(src)
    hideOverlay();
  });

  //还原默认图片
  $('#clear_img').click(function(event) {  
       $('#view').attr('src','../banner/8.png');
  });

//更改系统的图片选择
  $('.style_check ul li').click(function(event) {     
    for(var i=0; i<$('.style_check ul li').length ; i++){
        $('.style_check ul li').eq(i).removeClass('check');    
    }
      $(this).addClass('check') 
    var src = $(this).find('img').eq(0).attr('src')
       $('#big_view').attr('src',src)
  });   
   

})


 //图片上传预览    IE是用了滤镜。
        function previewImage(file)
        {           

          var MAXWIDTH  = 507; 
          var MAXHEIGHT = 88;
          var div = document.getElementById('preview');
          if (file.files && file.files[0])
          {
              div.innerHTML ='<img id=imghead>';
              var img = document.getElementById('imghead');
              img.onload = function(){
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width  =  rect.width;
                img.height =  rect.height;
//                 img.style.marginLeft = rect.left+'px';
                img.style.marginTop = rect.top+'px';
              }
              var reader = new FileReader();
              reader.onload = function(evt){img.src = evt.target.result;}
              reader.readAsDataURL(file.files[0]);
          }
          else //兼容IE
          {
            var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            var src = document.selection.createRange().text;
            div.innerHTML = '<img id=imghead>';
            var img = document.getElementById('imghead');
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
            div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
          }
        }
        function clacImgZoomParam( maxWidth, maxHeight, width, height ){
            var param = {top:0, left:0, width:width, height:height};
            if( width>maxWidth || height>maxHeight )
            {
                rateWidth = width / maxWidth;
                rateHeight = height / maxHeight;
                 
                if( rateWidth > rateHeight )
                {
                    param.width =  maxWidth;
                    param.height = Math.round(height / rateWidth);
                }else
                {
                    param.width = Math.round(width / rateHeight);
                    param.height = maxHeight;
                }
            }
            param.left = Math.round((maxWidth - param.width) / 2);
            param.top = Math.round((maxHeight - param.height) / 2);            
            return param;
        }