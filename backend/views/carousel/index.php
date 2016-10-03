<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CarouselSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '轮播管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .img_show{
        width:700px;
        position: absolute;
    	display:none;    	       
    	margin-left:200px;
    	z-indent:10000;    
  }
  .img_show h4{background:#7F7F7F;margin:0px; }
  .img_show img{width:100%}
  
</style>
<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="/caruosel">轮播管理</a>
							</li>	
													
						</ul><!-- .breadcrumb -->
</div>

<div id="img"  class="img_show">
	<h4>　<strong id="close" style="color:#ffffff;float:right;margin-right:10px;cursor: pointer;">x</strong></h4>
	<img src="#" />
</div>
<div class="carousel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '添加轮轮播'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>    
    
    <div id="w0" class="grid-view">
<table class="table table-striped table-bordered">
    <thead>
    	<tr>    	
    	<th><a href="#" data-sort="title">Id</a></th>
    	<th><a href="#" data-sort="notes">名字</a></th>
    	<th><a href="#" data-sort="username">上传时间</a></th>
    	<th><a href="#" data-sort="username">地址</a></th>    	
    	<th><a href="#" data-sort="add_time">排序</a></th>
    	<th class="action-column">操作</th></tr>
    </thead>

    <tbody>
    	   <?php foreach ($model as $value){
    	       echo '<tr>
                           <td>'.$value['id'].'</td>
                           <td>'.$value['name'].'</td>
                           <td>'.date("m/d h:i:s",$value['add_time']).'</td>
                           <td onClick="showImg(this)" >'.$value['url'].'</td>
                            <td><input type="text" class="sort" value="'.$value['sort'].'"></td>
						    <td><a data-pjax="0" aria-label="查看" title="查看" href="/carousel/view?id='.$value['id'].'"><span class="glyphicon glyphicon-eye-open"></span>
</a><a data-pjax="0" aria-label="更新" title="更新" href="/carousel/update?id='.$value['id'].'"><span class="glyphicon glyphicon-pencil"></span>
</a><a data-pjax="0" data-method="post" data-confirm="您确定要删除此项吗？" aria-label="删除" title="删除" href="/carousel/delete?id='.$value['id'].'">
<span class="glyphicon glyphicon-trash"></span></a></td>
                    </tr>';
    	   
    	   }?> 	
    </tbody>
    	
    </table>
    	
    
</div>
    
</div>


<?=Html::jsFile('@web/js/carousel.js') ?>