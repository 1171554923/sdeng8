<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminVideo */

$this->title = Yii::t('app', '修改 {modelClass}: ', [
    'modelClass' => '视频',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
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
								<a href="/manvideo">视频管理</a>
							</li>
							<li class="active">修改视频</li>
						</ul><!-- .breadcrumb -->
						
</div>

<div class="admin-video-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
