<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Nav */

$this->title = Yii::t('app', '创建菜单栏');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Navs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="/nav">菜单管理</a>
							</li>	
							<li class="active">创建菜单</li>						
						</ul><!-- .breadcrumb -->
</div>
<div class="nav-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
