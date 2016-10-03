<?php 
use yii\helpers\Html;
use kartik\form\ActiveForm;
$gander = '';//性别
/* if($UsersDetails->sex == '女')
{
    $gander= ' <input type="radio"  class="sex" name="UsersDetails[sex]" value="男" />男　<input type="radio"  checked="checked" name="UsersDetails[sex]" value="女" >女';
}else{
    $gander= ' <input type="radio" checked="checked" class="sex" name="UsersDetails[sex]" value="男" />男　<input type="radio" name="UsersDetails[sex]" value="女" >女';
} */

?>
	
	<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../cropper/cropper.min.css" rel="stylesheet">
	<link href="../sitelogo/sitelogo.css" rel="stylesheet">
	<?=HTML::cssFile('@web/css/profile.css')?>
	<script src="../cropper/cropper.min.js"></script>
	<script src="../sitelogo/sitelogo.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../js/profile.js"></script>

<div class="main_profile">
		<h4>个人信息<a href="/personal.html" class="back_pe">返回个人中心 </a></h4>
		<div class="blank"></div>
		<div class="info">
			<div class="info_l">
				<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>		
			    
				<?= $form->field($model, 'nickname')->label("昵称")?>		
				<?= $form->field($UsersDetails, 'sex',['template'=>'{label}'.$gander.''])->label("性别")?>
				<?= $form->field($model, 'birth_day',['template'=>'<div class="form-group field-usersdetails-birth_day has-success">{label}<input id="usersdetails-birth_day" class="form-control" type="text" 
name="UsersDetails[birth_day]" placeholder="例如：2016/9/2" /> {error}</div>'])->label("出生日期")?>
				
				
				<h5>个人详细信息</h5>
						
				<?= $form->field($model, 'email')->label("电子邮箱")?>								
				<?= $form->field($model, 'phone_number')->label("电话号码")?>
				<?= $form->field($model, 'qq')->label("qq")?>
				<?= $form->field($model, 'weixin_url')->label("微信公众号")?>				
				<?= $form->field($model, 'web_url')->label("网站地址")?>
				<?= $form->field($model, 'weibo_url')->label("微博账号")?>								
			    <?= $form->field($model, 'portrait_img')->input('hidden')->label('')?>
			     <?= $form->field($model, 'main_img')->input('hidden')->label('')?>
			</div>
			
			<div class="info_r">
				
        	<div class="ibox-content">
        		<div class="row">
        			<div id="crop-avatar" class="col-md-6">
        				<div class="avatar-view" title="点击更改头像">
        					<?php if($model->portrait_img == ""){ 
        						echo '<img src="../images/default_profile_image_thumb.png" alt="个人头像">';
        					 }else {
        					     echo '<img src="'.$model->portrait_img.'" alt="个人头像">';
        					 }
        					?>	
        			    </div>
        			    <span class="click_notice">点击图片更改头像</span>
        			</div>        			
        		</div>        		
        	</div>
				
				
				<div class="banner">
					<h5>主页模板</h5>
					<p class="notice">提示：建议你选择的主页模板应该在 1270px 宽 和 220px 高 </p>
					<div class="choces"><span class="system_c">系统推荐</span><a href="javascript:;" class="file">选择文件
                        <input type="file" name="file"  onchange="previewImage(this)">
                    </a> <span class="clear_img" id="clear_img">清除</span></div>
										                    
    				<div id="preview">		
    						<?php if($model->main_img == ""){ 
        						echo '<img id="view" src="../banner/8.png" alt="banner" width=100%  height=88px>';
        					 }else {
        					     echo '<img  id="view" src="'.$model->main_img.'" alt="banner" width=100%  height=88px>';
        					 }	
        					 ?>
    				</div>
				</div>				
			</div>								
</div>
		
		<div class="blank save"><?=Html::submitButton('保存',['class'=>'save_style']) ?></div>
	</div>
		<?php ActiveForm::end()?>			
<div class="style_check" id="style_check">
	<div class="banner_main"><img id="big_view" src="../banner/10.png" alt="banner"></div>
	<ul>
		<li class="check"><img src="../banner/10.png" alt="banner"></li>
		<li><img src="../banner/6.png" alt="banner"></li>
		<li><img src="../banner/5.png" alt="banner"></li>
		<li><img src="../banner/7.png" alt="banner"></li>
		<li><img src="../banner/8.png" alt="banner"></li>
		<li><img src="../banner/1.png" alt="banner"></li>
		<li><img src="../banner/1.jpg" alt="banner"></li>
		<li><img src="../banner/4.png" alt="banner"></li>
		<li><img src="../banner/4.png" alt="banner"></li>
		<li><img src="../banner/4.png" alt="banner"></li>
		<li><img src="../banner/4.png" alt="banner"></li>
		<li><img src="../banner/4.png" alt="banner"></li>
	</ul>
	<div class="finish"><span class="cancel">取消</span><span id="confirm">确认</span></div>
</div>
<div id="overlay"></div>
<div class="load" id="load"><img src="../images/load.gif" alt="加载图片"></div>	

<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="avatar-form" action="/upload/portrait.html" enctype="multipart/form-data" method="post">
				<div class="modal-header">
					<button class="close" data-dismiss="modal" type="button">&times;</button>
					<h4 class="modal-title" id="avatar-modal-label">更改头像</h4>
				</div>
				<div class="modal-body">
					<div class="avatar-body">
						<div class="avatar-upload">
							<input class="avatar-src" name="avatar_src" type="hidden">
							<input class="avatar-data" name="avatar_data" type="hidden">
							<label for="avatarInput">图片上传</label>
							<input class="avatar-input" id="avatarInput" name="avatar_file" type="file"></div>
						<div class="row">
							<div class="col-md-9">
								<div class="avatar-wrapper"></div>
							</div>
							<div class="col-md-3">
								<div class="avatar-preview preview-lg"></div>
								<div class="avatar-preview preview-md"></div>
								<div class="avatar-preview preview-sm"></div>
							</div>
						</div>
						<div class="row avatar-btns">
							<div class="col-md-9">
								<div class="btn-group">
									<button class="btn" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees"><i class="fa fa-undo"></i> 向左旋转</button>
								</div>
								<div class="btn-group">
									<button class="btn" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees"><i class="fa fa-repeat"></i> 向右旋转</button>
								</div>
							</div>
							<div class="col-md-3">
								<button class="btn btn-success btn-block avatar-save" type="submit"><i class="fa fa-save"></i> 保存修改</button>
							</div>
						</div>
					</div>
				</div>
  		</form>
  	</div>
  </div>
</div>

<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</body>
</html>