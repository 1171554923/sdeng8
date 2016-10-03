<?php
header("Content-Type:text/html;charset=utf-8");
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
?>
	<?=Html::cssFile('@web/css/upload.css') ?>	
<div id="overlay"></div>	
<div class="form-group"  id="form-group" > 
	<span class="close_i" id="close_i"></span>       
    <div class="col-lg-6">  
      	 <?= FileInput::widget([  
            //'model' => $model,  
            //'attribute' => 'ListImgUrl',  
            'name' => 'ImgSelect',  
            'language' => 'zh-CN',  
            'options' => ['multiple' => true, 'accept' => 'image/*'],  
            'pluginOptions' => [  
                'initialPreview' => $initialPreview,  
                'initialPreviewConfig' => $initialPreviewConfig,  
                'allowedPreviewTypes' => ['image'],  
                'allowedFileExtensions' => ['jpg', 'gif', 'png'],  
                'previewFileType' => 'image',  
                'overwriteInitial' => false,  
                'browseLabel' => '选择图片',  
                'msgFilesTooMany' => "选择上传的图片数量({n}) 超过允许的最大图片数{m}！",  
                'maxFileCount' => 10,//允许上传最多的图片10张  
                'maxFileSize' => 300,//限制图片最大300kB                  
                'uploadUrl' => Url::to(['/upload/image']),  
                //'uploadExtraData' => ['testid' => 'listimg'],  
                'uploadAsync' => true,//配置异步上传还是同步上传  
            ],  
            'pluginEvents' => [  
                'filepredelete' => "function(event, key) {  
                        return (!confirm('确认要删除'));  
                   }",  
                'fileuploaded' => 'function(event, data, previewId, index) {  
                       $(event.currentTarget.closest("form")).append(data.response.imgfile);  
                    }',  
                'filedeleted' => 'function(event, key) {  
                        $(event.currentTarget.closest("form")).find("#"+key).remove();  
                        return alert("图片已经删除")  
                    }',  
            ]  
        ]); ?> 
    </div>  
</div>
  
	
<div class="main_upload">
          <div class="title"><span id="img_up" class="check" >图片</span><span id="vedio_up">视频</span></div>     	
    		      <h2 id="upload_s">上传图片</h2>
        
        
         <div class="content">    
              <div class="content_l">
                <div class="checkP">          
                  <span id="click_up">点击选择图片上传</span>
                </div>
              </div>                                            
                <div class="content_r">
                      <?php  $form = ActiveForm::begin([
                            
                      ])?>                      		
    						<?=  $form->field($model,'url',['template'=>' <input type="hidden"  id="upload-url"  name="Upload[url]" />{error}'])?>                  
                      		<?= $form->field($model,'uid',['template'=>'<input type="hidden" id="upload-uid"  value="'.Yii::$app->user->id.' " name="Upload[uid]" /> {error}'])?>
                      		<?= $form->field($model,'title',['template'=>'{label}<input type="text" id="upload-title" class="text" placeholder="填写标题" name="Upload[title]"/>  {error}'])?>
                      		<?= $form->field($model,'tag',['template'=>'<label for="tag">标签云 (例如 ： 美食, 有趣, 美女, 搞笑视频)</label><input type="text" id="tag" placeholder="最大不能超过5个"  class="text"  name="Upload[tag]"> {error}'])?>
                      		<?= $form->field($model,'description',['template'=>'<label for="discript">图片描述 <span class="number"  id="enterNumber">还可以输入<span id="number">200</span>个字</span></label><textarea  name="Upload[description]"  class="dsc_content" id="discript" maxlength="200"></textarea>'])?>
                      		<div class="submit">
                      			<?= Html::resetButton('重置',['class'=>'reset'])?>  
                      			<?= Html::submitButton('上传',['class'=>'sub_up'])?>
                      		</div>   
                      <?php ActiveForm::end() ?>
                </div>   
                </div>         
        <!-- end  content-->
        
        
        <div class="vedio_content"  id="vedio">
        	<h3>提交您的视频到水灯大赛将会赢得500甚至5000不等的人民币！</h3>
        	<p>
        		所有的视频将自动进入到我们的水灯系统 然后我们将进行每个月的评比 您将获得500到1000人民币 ！如果您的视频赢取季度的大赛 将会获得1000到2000的人民币  也许会是一个搞笑的视频 或许会是一个滑稽的笑话 ,一组性感的照片,更甚至是您的宠物的萌太 ，然而我们只是将它们展现给全中国13亿人！ 
        	</p>
        	<p>
        		即使您的视频没有获奖 那也会带给全中国的人一份欢乐！
        	</p>
        	<p>
        		很简单:提交你的视频到水灯和获得报酬!
        	</p>
        	<div class="line"></div>
        	<div class="vedio_form">
        		<div class="blank"></div>
        		 <?php  $form2 = ActiveForm::begin([
        		          'action'=>'/personal/video.html'
        		 ])?>
        		 <?= $form2->field($video,'uid',['template'=>'<input type="hidden" id="Video-uid"  value="'.Yii::$app->user->id.' " name="video[uid]" />'])?>
        		 <?= $form2->field($video,'url',['template'=>'{label}<input id="Video-url" class="form-control" type="text" name="video[url]" />{error}'])->label("填写视频播放地址或者浏览器的地址") ?>          	           	   
        	   <span class="or">或者</span>
				<?php 
				echo '<div class="well well-small">';
    				echo FileInput::widget([    				    
    				    'name' => 'attachment_30',    				    
    				    'pluginOptions' => [    	
    				        'initialPreview' => $initialPreview,
    				        'allowedPreviewTypes' => ['video'],
    				        'showPreview' => true,
    				        'showCaption' => false,
    				        'elCaptionText' => '#customCaption',
    				        'uploadUrl' => Url::to(['/upload/video']),  
    				        'uploadAsync' => true,
    				        'maxFileSize' => 102400,
    				        'maxFileCount' => 1,
    				        'allowedFileExtensions' =>['avi','rmvb','rm','asf','divx','mpg','mpeg','mpe','wmv','mp4','mkv','vob'],    				        
    				    ],    				        				        				       	
    				]);
    				echo '<span id="customCaption" class="text-success">No file selected</span>';
    				echo '</div>';
				?> 
				<?php
   				      $option ='';
				        foreach ($category  as $value){
           			     $option .= '<option value="'.$value['id'].'">'.$value['category'].'</option>';    
           			}           			               			   
           			?> 
           		 <?= $form2->field($video,'title')->label("标题*") ?>   
           		<?= $form2->field($video,'notes') ?> 
        		<?= $form2->field($video,'categ',['template'=>'{label}<select id="video-categ"  name="video[categ]"><option>请选择....</option>'.$option.'</select>{error}']) ?>            		        		           	
           		<?= $form2->field($video,'username')->label("名字*") ?> 
           		<?= $form2->field($video,'email')->label("电子邮箱*") ?>            		
               	<?= $form2->field($video,'phone')->label("电话号码*") ?> 
               	<?= $form2->field($video,'onlyread',['template'=>'<input type="checkbox" id="video-onlyread" checked="checked" value="12" class="onlyread" name="video[onlyread]"> 请同意并仔细阅读视频<a href="#">《上传规则》</a>{error}']) ?>            		
           		<div class="submit">
                      		<?= Html::resetButton('重置',['class'=>'reset'])?>  
                      	    <?= Html::submitButton('上传',['class'=>'sub_up'])?>
                 </div> 
                 <?php ActiveForm::end();?>
                 <div class="blank"></div>       	          		
        	</div>        	
		</div><!-- end   main_upload-->   

<div class="load" id="load"><img src="../images/load.gif" alt="加载图片"></div>	
</div><!-- end main_upload -->

<?=Html::JsFile('@web/js/upload.js') ?>	
	
  
  