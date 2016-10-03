<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Video */
/* @var $form yii\widgets\ActiveForm */
$category =  new Category();
$categorys = $category->find()->asArray()->all();

 $option ='';
 $statu = '';
foreach ($categorys  as $value){
        if($model->cate_g == $value['id'] ){
            $option .= '<option selected="selected" value="'.$value['id'].'">'.$value['category'].'</option>';
        }
         $option .= '<option value="'.$value['id'].'">'.$value['category'].'</option>';    
}

if($model->statu == 1){
   $statu = '<option value="0">未通过</option><option selected="selected" value="1">通过</option>'; 
}else{
    $statu = '<option value="0">未通过</option><option  value="1">通过</option>';
}

extension_loaded('ffmpeg');
$ffmpegInstance = new ffmpeg_movie('D:\Documents\Downloads\宾利斗牛犬小狗不快乐!.png');
echo "getDuration: " . $ffmpegInstance->getDuration()."<br>" .
    "getFrameCount: " . $ffmpegInstance->getFrameCount()."<br>" .
    "getFrameRate: " . $ffmpegInstance->getFrameRate()."<br>" .
    "getFilename: " . $ffmpegInstance->getFilename()."<br>" ;
    
/* function bigendian2int($byte_word, $signed = false) {
    $int_value = 0;
    $byte_wordlen = strlen($byte_word);
    for ($i = 0; $i < $byte_wordlen; $i++){
            $int_value += ord($byte_word{$i}) * pow(256, ($byte_wordlen - 1 - $i));
    }
     if ($signed){
         $sign_mask_bit = 0x80 << (8 * ($byte_wordlen - 1));
         if ($int_value & $sign_mask_bit)
         {
             $int_value = 0 - ($int_value & ($sign_mask_bit - 1));
         }
     }
     return $int_value;
}

function gettime($name){
  if(!file_exists($name)){
        return;
    }
  
    $flv_data_length=filesize($name);
    
    
    $fp = @fopen($name, 'rb');    
    $flv_header = fread($fp, 5);
    fseek($fp, 5, SEEK_SET);
    $frame_size_data_length =BigEndian2Int(fread($fp, 4));
    $flv_header_frame_length = 9;
    if ($frame_size_data_length > $flv_header_frame_length)
    {
        fseek($fp, $frame_size_data_length - $flv_header_frame_length, SEEK_CUR);
    }
    $duration = 0;
    while ((ftell($fp) + 1) < $flv_data_length)
    {
        $this_tag_header = fread($fp, 16);
    $data_length = BigEndian2Int(substr($this_tag_header, 5, 3));
    $timestamp = BigEndian2Int(substr($this_tag_header, 8, 3));
    $next_offset = ftell($fp) - 1 + $data_length;
    
    if ($timestamp > $duration) {
        $duration = $timestamp;}
        fseek($fp, $next_offset, SEEK_SET);
    }
        fclose($fp);

        return $duration;
}

echo getTime('D:\Documents\Downloads\1212.mp4'); */


return  false;
?>
<style>
    .file-preview{display:none}
</style>

<div class="video-form">

    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data']]
       ); ?>
    

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php 
				echo '<div class="well well-small">';
    				echo FileInput::widget([    				    
    				    'name' => 'attachment_30',    				    
    				    'pluginOptions' => [    	    				        
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
	<?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>	
	<span>缩略图建议600*400</span><input type="file" name="file"  onchange="previewImage(this)">
	<div id="preview">		    					
   		<?php 
   		if($model->thumbnail != '')
   		{
   		    echo '<img id="view" src="'.$model->thumbnail.'"  >';
   		}else{
   		   echo '<img id="view" src="" alt="缩略图" >';
   		}
    
    ?>
                					
   </div>
   
	<?= $form->field($model, 'url_type')->textInput(['maxlength' => true])->label('')->input('hidden') ?>	
    <?= $form->field($model, 'notes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
 

    <?= $form->field($model, 'cate_g',['template'=>'{label}　<select id="Adminvideo-cate_g"  name="AdminVideo[cate_g]"><option>请选择....</option>'.$option.'</select>{error}'])?>
	<?= $form->field($model, 'statu',['template'=>'{label}　<select id="Adminvideo-statu"  name="AdminVideo[statu]">'.$statu.'</select>{error}'])?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
