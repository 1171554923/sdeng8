<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Carousel */

$this->title = Yii::t('app', '创建轮播');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?=Html::jsFile('@web/js/articel.js') ?>


<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="/carousel">轮播管理</a>
							</li>	
							<li class="active">创建轮播</li>						
						</ul><!-- .breadcrumb -->
</div>


<div class="carousel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
