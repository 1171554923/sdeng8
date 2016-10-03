<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AdminVideo */

$this->title = Yii::t('app', '创建视频');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Videos'), 'url' => ['index']];
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
								<a href="/manvideo">视频管理</a>
							</li>
							<li class="active">创建视频</li>
						</ul><!-- .breadcrumb -->
						
</div>

<div class="admin-video-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
