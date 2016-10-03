<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\CropAvatar;
use yii\web\Tool;



class UploadController extends Controller
{
    public $enableCsrfValidation = false;//禁用Csrf验证
    
    public function actionPortrait()
    {
        if (Yii::$app->request->isPost) {
            $crop =  new CropAvatar($_POST['avatar_src'], $_POST['avatar_data'], $_FILES['avatar_file']);
            $response = array(
                'state'  => 200,
                'message' => $crop -> getMsg(),
                 'result' => $crop -> getResult()
            );
            
               echo json_encode($response);

        }
    }
    /**
     * 上传视频
     * @return string
     */
    public function actionVideo()
    {
        $res = [];         
        if (Yii::$app->request->isPost) {
            $initialPreview=[];
           $video=  UploadedFile::getInstancesByName("attachment_30"); 
           
           $dir = '/uploads/video/';                                
           $pickey = Tool::genuuid();;        
           $type = $video[0]->type;
           
           $name = explode('/',$type);
           $filename = $pickey .'.'.$name[1];
                               
           //如果文件夹不存在，则新建文件夹
           if (!file_exists(Yii::getAlias('@frontend') . '/web' . $dir)) {
               FileHelper::createDirectory(Yii::getAlias('@frontend') . '/web' . $dir, 777);
           }
           $filepath = realpath(Yii::getAlias('@frontend') . '/web' . $dir) . '/';
           
           $file = $filepath . $filename;
           if ($video[0]->saveAs($file)) {   
               $name =  $filepath . $filename;  
               array_push($initialPreview,$name);
                $res = [                          
                            "initialPreview" => $initialPreview,
                        ];                          
           }             
           return json_encode($res);
        }
        

    }
    /**
     * 上传图片到临时目录
     * @return string
     * @throws \yii\base\Exception
     */
    
    public function actionImage()
    {
        if (Yii::$app->request->isPost) {           
            $res = [];
            $initialPreview = [];
            $initialPreviewConfig = [];
            $images = UploadedFile::getInstancesByName("ImgSelect");            
            if (count($images) > 0) {
                foreach ($images as $key => $image) {
                    if ($image->size > 2048 * 1024) {
                        $res = ['error' => '图片最大不可超过2M'];
                        return json_encode($res);
                    }
                    if (!in_array(strtolower($image->extension), array('gif', 'jpg', 'jpeg', 'png'))) {
                        $res = ['error' => '请上传标准图片文件, 支持gif,jpg,png和jpeg.'];
                        return json_encode($res);
                    }
                    $dir = '/uploads/temp/';
                    //生成唯一uuid用来保存到服务器上图片名称
                    $pickey = Tool::genuuid();
                    $filename = $pickey . '.' . $image->getExtension();

                    //如果文件夹不存在，则新建文件夹
                    if (!file_exists(Yii::getAlias('@frontend') . '/web' . $dir)) {
                        FileHelper::createDirectory(Yii::getAlias('@frontend') . '/web' . $dir, 777);
                    }
                    $filepath = realpath(Yii::getAlias('@frontend') . '/web' . $dir) . '/';
                    $file = $filepath . $filename;

                    if ($image->saveAs($file)) {
                        $imgpath = $dir . $filename;
                        /*Image::thumbnail($file, 100, 100)
                         ->save($file . '_100x100.jpg', ['quality' => 80]);
                         */
                        array_push($initialPreview, "<img src='" . $imgpath . "' class='file-preview-image' alt='" . $filename . "' title='" . $filename . "'>");
                        $config = [
                            'caption' => $filename,
                            'width' => '120px',
                            'url' => '/upload/delete.html', // server delete action
                            'key' => $pickey,
                            'extra' => ['filename' => $filename]
                        ];
                        array_push($initialPreviewConfig, $config);

                        $res = [
                            "initialPreview" => $initialPreview,
                            "initialPreviewConfig" => $initialPreviewConfig,
                            "imgfile" => "<input name='ImageFilesPath[]' id='" . $pickey . "' type='hidden' value='" . $imgpath . "'/>"
                        ];
                    }
                }
            }
        
            return json_encode($res);
        }
    }
    
    
    
   
    
   
    
    
    
    /**
     * 删除上传到临时目录的图片
     * @return string
     */
    public function actionDelete()
    {
         $error = '';
        if (Yii::$app->request->isPost) {
            $dir = '/uploads/temp/';
            $filename = yii::$app->request->post("filename");
            $filename = $dir . $filename;
            if (file_exists(Yii::getAlias('@frontend') . '/web' . $filename)) {
                unlink(Yii::getAlias('@frontend') . '/web' . $filename);
            }

            if (file_exists(Yii::getAlias('@frontend') . '/web' . $filename . '_100x100.jpg')) {
                unlink(Yii::getAlias('@frontend') . '/web' . $filename . '_100x100.jpg');
            }
        }
        return json_encode($error); 
    } 
}