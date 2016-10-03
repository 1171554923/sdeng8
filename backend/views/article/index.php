<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Nav;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '文章管理');
$this->params['breadcrumbs'][] = $this->title;

$nav = new Nav();
$navs = $nav->find()->asArray()->all();
function navFunction($value,$navs){
    foreach ($navs as $v)
    {
        if($value == $v['id'])
        {
          return $v['name'];
        }
    }
}

$cate = new Category();
$cates = $cate->find()->asArray()->all();
function cateFunction($value,$cates){
    foreach ($cates as $v)
    {
        if($value == $v['id'])
        {
            return $v['category'];
        }
    }
}

function  statu($value)
{
    if($value == 1){
        return "<span data='1'>通过</span>";
    }else{
        return "<span data='0' style='color:red;cursor:pointer'>未通过</span>";
    }
}

?>
<div id="declare" data="article"></div>
<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="/article">文章管理</a>
							</li>	
										
						</ul><!-- .breadcrumb -->
</div>

<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '创建文章'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   
   <table class="table table-striped table-bordered">
    <thead>
    	<tr>
    	<th><input type="checkbox" id="allCheck" data="1">　全选</th>
    	<th><a href="#" data-sort="title">发布人</a></th>
    	<th><a href="#" data-sort="notes">标题</a></th>    	
    	<th><a href="#" data-sort="username">标签</a></th>    	
    	<th><a href="#" data-sort="add_time">添加时间</a></th>
    	<th><a href="#" data-sort="add_time">菜单栏</a></th>
    	<th><a href="#" data-sort="add_time">分类</a></th>
    	<th><a href="#" data-sort="add_time">状态</a></th>
    	<th class="action-column">操作</th></tr>
    </thead>

    <tbody>
    	<?php foreach ($article as $value){
    	    echo '<tr>
                     <td><input type="checkbox" class="check" data="'.$value['id'].'" >　选中</td>
                     <td>'.$value['name'].'</td>
                     <td>'.mb_substr($value['title'],0,16,'utf-8').'...</td>
                     <td>'.$value['tag'].'</td>
                     <td>'.date("m/d h:i:s",$value['add_time']).'</td>
				     <td>'.navFunction($value['nav'],$navs).'</td>
					 <td>'.cateFunction($value['cate_g'],$cates).'</td>
                   <td><span class="sub_click" data="'.$value['id'].'"> '.statu($value['statu']).' </span></td>  
    
                    <td><a data-pjax="0" aria-label="查看" title="查看" href="/article/view?id='.$value['id'].'"><span class="glyphicon glyphicon-eye-open"></span>
</a><a data-pjax="0" aria-label="更新" title="更新" href="/article/update?id='.$value['id'].'"><span class="glyphicon glyphicon-pencil"></span>
</a><a data-pjax="0" data-method="post" data-confirm="您确定要删除此项吗？" aria-label="删除" title="删除" href="/article/delete?id='.$value['id'].'">
<span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>';
    	} ?>
    </tbody>
    	
    </table>    
     <span class="btn btn-primary" id="delete" >删除</span>　<span class="btn btn-primary" id="passCheck">通过</span>　<span class="btn btn-primary" id="notPass">未通过</span><br/>	
    <?=$pageshow?>     
</div>
<?=Html::jsFile('@web/js/manvideo.js') ?>