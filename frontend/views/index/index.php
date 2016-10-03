<?php 



function total($vid)
{
    $connection = Yii::$app->db;
    $command = $connection->createCommand("SELECT count(*) as count from sd_comment where vid=$vid ");
    $total = $command->queryOne();
    return $total['count'];
}

$AdminVideoStr = '';//管理员视频
    foreach ($AdminVideos   as $value)
    {
        $AdminVideoStr .='<div class="col-md-4 port-grids view ">
    					<a  href="/watch&'.$value['id'].'.html" target="new" >
    						<img src="'.$value['thumbnail'].'" class="img-responsive" alt=""/>    						
    					</a>    						        					   
    					<a href="/watch&'.$value['id'].'.html" target="new" class="title">'.$value['title'].'</a>
    					 <span  class="player">播放次数'.$value['play_count'].'&nbsp;&nbsp;&nbsp;'.total($value['id']).' 次评论</em></span>
				</div>';
    }        
?>


<!--banner-->
	<div class="banner">
	
		<div id="myCarousel" class="carousel slide">
           <!-- 轮播（Carousel）指标 -->
           <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
           </ol>   
           <!-- 轮播（Carousel）项目 -->
           <div class="carousel-inner">           		
              <div class="item active">
                 <img src="<?= $caruosel[0]['url']?> " alt="First slide">
              </div>
              <div class="item">
                 <img src="<?= $caruosel[1]['url']?> " alt="Second slide">
              </div>
              <div class="item">
                 <img src="<?= $caruosel[2]['url']?> " alt="Third slide">
              </div>
           </div>
           <!-- 轮播（Carousel）导航 -->
           <a class="carousel-control left prev_png " href="#myCarousel" 
              data-slide="prev"></a>
           <a class="carousel-control right next_png" href="#myCarousel" 
              data-slide="next"></a>
		</div> 
	</div>	
	<!--//banner-->
	<!--portfolio-->
	<div class="portfolio" id="gallery">		
		<div class="container">
			<h3 class="title">推荐的展区<a href="#" class="btn btn-link pull-right">更多</a></h3>			
			<div class="portfolio-grids">	
				<?=$AdminVideoStr?>		
				
				<div class="col-md-4 port-grids view view-fourth">
					<a class="example-image-link" href="images/img4.jpg" data-lightbox="example-set" data-title="">
						<img src="images/img4.jpg" class="img-responsive" alt=""/>
						<div class="mask">
							<p>A wonderful serenity has taken possession of my which I enjoy with my whole heart.</p>
						</div>
					</a>
				</div>
				<div class="col-md-4 port-grids view view-fourth">
					<a class="example-image-link" href="images/img1.jpg" data-lightbox="example-set" data-title="">
						<img src="images/img1.jpg" class="img-responsive" alt=""/>
						<div class="mask">
							<p>A wonderful serenity has taken possession of my which I enjoy with my whole heart.</p>
						</div>
					</a>
				</div>
				<div class="col-md-4 port-grids view view-fourth">
					<a class="example-image-link" href="images/img5.jpg" data-lightbox="example-set" data-title="">
						<img src="images/img5.jpg" class="img-responsive" alt=""/>
						<div class="mask">
							<p>A wonderful serenity has taken possession of my which I enjoy with my whole heart.</p>
						</div>
					</a>
				</div>
				<div class="clearfix"> </div>	
				<script src="js/lightbox-plus-jquery.min.js"> </script>
			</div>				
		</div>
	</div>	
	<!--//portfolio-->
	
	
	<!--team-->
	<div class="team" id="team">
		<div class="container">
			<h3 class="title">我们的成员</h3>
			<div class="team-info">
				<div class="col-md-3 team-grids wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">
					<a href="#">
						<img class="img-responsive" src="images/img8.jpg" alt="">
						<div class="captn">
							<h4>Tincidun</h4>
							<p>Aenean pulvinar ac enimet posuere tincidunt velit Utin tincidunt</p>
						</div>
					</a>
				</div>					
				<div class="col-md-3 team-grids wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">
					<a href="#">
						<img class="img-responsive" src="images/img9.jpg" alt="">
						<div class="captn">
							<h4>Velit uti</h4>
							<p>Aenean pulvinar ac enimet posuere tincidunt velit Utin tincidunt</p>
						</div>
					</a>
				</div>
				<div class="col-md-3 team-grids wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">
					<a href="#">
						<img class="img-responsive" src="images/img10.jpg" alt="">
						<div class="captn">
							<h4>Posuere</h4>
							<p>Aenean pulvinar ac enimet posuere tincidunt velit Utin tincidunt</p>
						</div>
					</a>
				</div>
				<div class="col-md-3 team-grids wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">
					<a href="#">
						<img class="img-responsive" src="images/img11.jpg" alt="">
						<div class="captn">
							<h4>Augc sfe</h4>
							<p>Aenean pulvinar ac enimet posuere tincidunt velit Utin tincidunt</p>
						</div>
					</a>
				</div>
				<div class="col-md-3 team-grids wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">
					<a href="#">
						<img class="img-responsive" src="images/img8.jpg" alt="">
						<div class="captn">
							<h4>Tincidun</h4>
							<p>Aenean pulvinar ac enimet posuere tincidunt velit Utin tincidunt</p>
						</div>
					</a>
				</div>					
				<div class="col-md-3 team-grids wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">
					<a href="#">
						<img class="img-responsive" src="images/img9.jpg" alt="">
						<div class="captn">
							<h4>Velit uti</h4>
							<p>Aenean pulvinar ac enimet posuere tincidunt velit Utin tincidunt</p>
						</div>
					</a>
				</div>
				<div class="col-md-3 team-grids wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">
					<a href="#">
						<img class="img-responsive" src="images/img10.jpg" alt="">
						<div class="captn">
							<h4>Posuere</h4>
							<p>Aenean pulvinar ac enimet posuere tincidunt velit Utin tincidunt</p>
						</div>
					</a>
				</div>
				<div class="col-md-3 team-grids wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">
					<a href="#">
						<img class="img-responsive" src="images/img11.jpg" alt="">
						<div class="captn">
							<h4>Augc sfe</h4>
							<p>Aenean pulvinar ac enimet posuere tincidunt velit Utin tincidunt</p>
						</div>
					</a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!--//team-->
	
	
	
		
	<!-- banner-text Slider starts Here -->
		<script src="js/responsiveslides.min.js"></script>
		 <script>
			// You can also use "$(window).load(function() {"
				$(function () {
				// Slideshow 3
					$("#slider3").responsiveSlides({
					auto: true,
					pager:true,
					nav:true,
					speed: 500,
					namespace: "callbacks",
					before: function () {
					$('.events').append("<li>before event fired.</li>");
					},
					after: function () {
						$('.events').append("<li>after event fired.</li>");
					}
				});	
			});
		</script>