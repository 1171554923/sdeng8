<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Arcrank */

$this->title = '修改会员等级: ' . $model->membername;
$this->params['breadcrumbs'][] = ['label' => 'Arcranks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="/arcrank">会员等级管理</a>
							</li>
							<li class="active">修改会员等级</li>
						</ul><!-- .breadcrumb -->
						
</div>
<div class="arcrank-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
