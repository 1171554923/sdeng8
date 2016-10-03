<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Carousel */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Carousel',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
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
							<li class="active">修改轮播</li>						
						</ul><!-- .breadcrumb -->
</div>

<div class="carousel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
