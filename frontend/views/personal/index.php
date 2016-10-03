<?php
    use yii\helpers\Html;
    use common\models\UsersDetails;
   $id = Yii::$app->user->getId();
    $portrait_img = ''; //个人头像
    $name = '' ; //名字
       $UsersDetails = UsersDetails::findOne(['uid'=>$id]); 
       
       if($UsersDetails->portrait_img != ''){
           $portrait_img ='<img src="'.$UsersDetails->portrait_img.'" alt="默认头像图片"/>';
       }else{
           $portrait_img ='<img src="../images/custom.png" alt="默认头像图片"/>';
       }
       
       if($UsersDetails->nickname != ''){
           $name = $UsersDetails->nickname; 
       }else{
           $name = Yii::$app->user->identity->username;
        }
    
 ?>
 <?=Html::cssFile('@web/css/personal.css') ?>  
 
 <div class="main_per">
     	<div class="img_sign">
     		<span class="upload">上传封面图</span>
     	</div>
     	 <div class="pre_s">
        	<div class="pre_img">
        		<?= $portrait_img?>       		 		
        	</div>
        	<div class="pre_t">
        		<span></span>
        		<ul>
        			<li><a href="#">相册</a></li>
        			<li><a href="#">相册</a></li>
        			<li><a href="#">相册</a></li>    		    		
        		</ul>  
        	<a href="/index/profile.html" class="edit">编辑</a>
        	</div>	    	     
        </div> 
        <div class="main_info">
        	<div class="info">
        		<ul>
        			<li class="check"><a href="#">首页</a></li>
        			<li><a href="#">我的收藏</a></li>
        			<li><a href="#">我的赞</a></li>
        			<li><a href="#">我的分享</a></li>	
        		</ul>
    		</div>
    		<div class="content">
    			<div class="write">
        			<h5>@分享有趣的图片和最搞笑的视频给大家</h5>
        			<textarea></textarea>
        			<span class="photo"><em></em></span>
        			<span class="vedio"><em></em></span>
        			<span class="music"><em></em></span>
        			<P>
        				<span class="send">发布</span>
        			</P>
    			</div>
    			
    			<div class="main">
    				<dl>
    					<dt>
    						<p><span class="title">标题 : </span>大家都知道少女是个面包控，而现在，最火的面包连锁店应！</p>
    						<span class="name">@廖自然</span>
    					 </dt> 
    					 <dd>
    						<div class="img"><img src="../images_content/photo1.jpg"></div>    					
    					</dd> 
    					<span class="label"></span>
    			<ul>
            			<li><a href="#">#搞笑视频</a></li>
            			<li><a href="#">#搞笑图片</a></li>
            			<li><a href="#">#有趣</a></li>            		

	
            		</ul>
            		<div class="blank"></div>	
            		<div class="buttom">
            			<span class="zan"></span>
            			<span class="notzan"></span>
            			<span class="love"></span>
            			<span class="comment"></span>                 			       			                 
            		</div>	
            		<div class="bshare-custom icon-medium"><a title="分享到QQ空间" class="bshare-qzone"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a title="分享到人人网" class="bshare-renren"></a><a title="分享到腾讯微博" class="bshare-qqmb"></a><a title="分享到网易微博" class="bshare-neteasemb"></a><a 
title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a><span class="BSHARE_COUNT bshare-share-count">0</span></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script><script type="text/javascript" 
charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
            		</dl>    
    			
    		</div>
    		</div>	<!-- end content -->
    		
    		<div class="tag">
    	 	<span class="title">热门搜索</span>
    		<ul>
    			<li class="blue"><a href="#">搞笑视频</a></li>
    			<li class="green"><a href="#">#搞笑图片</a></li>
    			<li class="blue"><a href="#">#有趣</a></li>
    			<li class="yellow"><a href="#">#王宝强</a></li>
    			<li class="blue"><a href="#">逗比</a></li>
    			<li class="yellow"><a href="#">#搞笑视频</a></li>
    			<li class="purple"><a href="#">#搞笑图片</a></li>
    			<li class="yellow"><a href="#">#有趣</a></li>    		

	
    		</ul>
    		<div class="line"></div>
    		<span class="super_user">超级用户<span class="ss">人气</span></span>
    		<ol>
    			<li><em>1</em><a href="#">会飞的猪</a><span>106 粉丝</span></li>
    			<li><em>2</em><a href="#">笨猪都上树</a><span>1016 粉丝</span></li>
    			<li><em>3</em><a href="#">猪都会飞</a><span>666 粉丝</span></li>
    			<li><em>4</em><a href="#">骑猪看书</a><span>9919 粉丝</span></li>
    			<li><em>5</em><a href="#">看猪撞树</a><span>1212 粉丝</span></li>
    		</ol>
    	</div><!-- end tag -->
    		
    		
    			</div><!-- end main -->    		
        </div><!-- end main_info  -->
 	
 </div> <!-- end main_per -->
 
 <?=Html::jsFile('@web/js/personal.js') ?>  