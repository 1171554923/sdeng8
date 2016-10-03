<?php

namespace frontend\controllers;

header("Content-Type:text/html;charset=utf-8");
/**
 * 个人中心类
 */
use Yii; 
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\widgets\imgupload\ImgMultUpload;
use app\models\Upload;
use common\models\Category;
use common\models\video;
use yii\web\Tool;

class PersonalController extends Controller
{
   public $layout ='front.layout.php';
   
   /**
    * @inheritdoc
    */
       public function behaviors()
    {
        return [
            'access' => [
            'class' => AccessControl::className(),
            'rules' => [
            [
                 'actions' => ['login', 'error'],
                    'allow' => true,
            ],
            [
//                 'actions' => ['logout', 'index'],
                'allow' => true,
                'roles' => ['@'],
            ],
            ],
            ],
            'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
            'logout' => ['post'],
            ],
            ],
        ];
    }
   
   /**
    * @inheritdoc
    */
   public function actions()
   {
       return [
           'error' => [
               'class' => 'yii\web\ErrorAction',
           ],
       ];
   } 
   
    /**个人中心首页
     * 
     */
    public function actionIndex()
    {            
        return $this->render('index');
    }
    
    public function actionUpload()
    {           
        $upload = new \common\widgets\ImgMultUpload();
        $model = new \common\models\Upload();
        $video = new video();
        $category = new Category();
              
                        
        if($model->load(Yii::$app->request->post()) )
        {          
            if($model->insertImg()){                    
                return $this->success(['/index']);
            }else{
                 return $this->error('上传图片失败!');
            }                         
        }
        return $this->render('upload', [  
            'model'=>$model,
            'video'=>$video,
            'category'=>$category->allCategory(),
            'initialPreview' => $upload->initialPreview,
            'initialPreviewConfig' => $upload->initialPreviewConfig
        ]);
    }
    
    public function actionVideo()
    {                
        $video = new video();
        if($video->load(Yii::$app->request->post()) )
        {
            if($video->insertVideo())
            {             
                return $this->success(['/index']);
            }else{
                 return $this->error('上传视频失败!');
            }
        } 
       
        $this->redirect(['/personal/upload']);
    }
    
    public function  actionBanner(){
        
    }
}
?>