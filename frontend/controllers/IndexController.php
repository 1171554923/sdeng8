<?php
namespace frontend\controllers;

use Yii; 
use yii\web\Controller;
use common\models\LoginForm;
use common\models\UsersDetails;
use yii\web\NotFoundHttpException;
use yii\web\Tool;
use common\models\Users;
use common\models\Carousel;
use common\models\video;
use backend\models\AdminVideo;
use common\models\Comment;



/**
 * Site controller
 */
class IndexController extends Controller
{
    
   public $layout= 'front.layout.php';    
    /**
     * @inheritdoc
     */
    public function actions()
    {        
        return  [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor'=>0x000000,//背景颜色
                'maxLength'=>4,
                'minLength'=>4,
                'padding' => 5,//间距
                'height'=>40,//高度
                'width' => 130,  //宽度
                'foreColor'=>0xffffff,     //字体颜色
                'offset'=>10,        //设置字符偏移量 有效果
                //'controller'=>'login',        //拥有这个动作的controller
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Carousel();
        $caruosel = $model->find()->orderBy('sort ASC')->limit(3)->asArray()->all();
        
        $video = new \common\models\AdminVideo();
        $Adminvideos = $video->find()->where(['statu'=>'1'])->limit('0,6')->orderBy('sort ASC')->asArray()->all();
        
        
        return $this->render('index',['caruosel'=>$caruosel,'AdminVideos'=>$Adminvideos]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {                     
        $session = Yii::$app->session;
        $session->open();
        if(empty($session->get('loginNum')))
        {
            $session->set('loginNum','0');
        }             
 
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['/personal/index']);
        }              
        
        $model = new LoginForm();        
        if ($model->load(Yii::$app->request->post()) ) {            
            if($model->login()){
                
                $this->redirect(['/personal']);
            }else{
               
                 $session->set('loginNum',$session->get('loginNum')+1); 
            }
        } else {
            return $this->renderPartial('login', [
                'loginNum'=>$session->get('loginNum'),
                'model' => $model,
                'loginNum'=>$session->get('loginNum')
            ]);
        }    
    }
    
    
    /**
     * 注册页面
     */
    public function actionRegister()
    {
        $model = new Users();
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate() && $model->createUser()){
                return $this->redirect(['/login']);
            }
        }
        return $this->renderPartial('register',['model'=>$model]);
    }
    
    /**
     * 找回密码
     */
    public function actionForget()
    {     
        if(@$_GET['tag'])
        {
            $tag = $_GET['tag'];
        }else{
            $tag = 1;
        }
       
        return $this->renderPartial('forget',['tag'=>$tag]);
    }  
    
    /**
     * 验证邮箱
     */
    public function actionSend(){
        if(Yii::$app->request->post())
        {
            $_POST['email'];
        }
        
    }
    
    /**
     * 服务条款
     */
    public function actionTos()
    {        
        return $this->render('tos');
    }
    /**
     * 邮箱发送成功
     */
    
    public function actionSuccessemail($email)
    {
       return $this->render('sucemail',['email'=>$email]);
    }
    
    
    //播放页
    public function actionWatch($id)
    {
        $session = Yii::$app->session;
        $session->open();
        if(empty($session->get('loginNum')))
        {
            $session->set('loginNum','0');
        }
  
        
       $adminVideos =  new \common\models\AdminVideo();
       $adminVideo =  $adminVideos->findOne($id);
       
       
       //评论
       /* $comment = new Comment();       
       $comments = $comment->find()->where(['vid'=>$id])->orderBy("add_time DESC")->asArray()->all(); */
       
      /*  $connection = Yii::$app->db;
       $command = $connection->createCommand("SELECT count(*) as count from sd_comment where vid=$id AND object_id=0");
       $total = $command->queryOne();
       $page_size = 3;
       $page = new \yii\web\PageFront($total['count'], $page_size);
       $limit= $page->getLimit();
       
       
       $command  =$connection->createCommand("SELECT * FROM sd_comment where vid=$id AND object_id=0  ORDER BY  add_time DESC LIMIT $limit ");
       $comments = $command->queryAll(); */
       
       
       
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
       
            if($model->validate())
            {
               $model->login();
            }else{                
                $session->set('loginNum',$session->get('loginNum')+1);
                return  $this->render('watch',[
                    'adminVideo'=>$adminVideo,
                    'model'=>$model,
                    'loginNum'=>$session->get('loginNum'),
                    'request'=> 'true'
                     ]
                    );
            }

        } 
        
        
        return  $this->render('watch',[
                        'adminVideo'=>$adminVideo,
                        'model'=>$model,
                        'loginNum'=>$session->get('loginNum'),                        
                        'request'=> 'false',                      
                     ]
         );
    }
    
    
    /**
     * 修改密码
     */
    public function actionEditpass($p)
    {
        $p=$_GET['p'];   //获取url值   
        $array = explode('.',base64_decode($p));
        
        $users = new Users();
        $user= $users->find()->where(['username'=>$array[0]])->one();
        
        $checkCode = md5($array['0'].'+'.$user->password);
               
        if($checkCode == $array[1]){ //解析
            return  $this->render('editpass',['name'=>$array[0]]);
        }else{
           $this->redirect(['/index']);
        } 
        
  
    }
    
    
  /*   public function actionCallback()
    {
        
        return $this->redirect('login_callback');
    } */
    
    
    
    /**
     * 个人信息中心
     */
    public function actionProfile()
    {
        $src = false;
        $id = Yii::$app->user->getId();
        $model = $this->findModel($id);
       
        if(Yii::$app->request->post())
        {
           $UsersDetails = new UsersDetails();
            $file = $_FILES['file'] ;
            if($file['name'] != '')
             {              
                  $src  = Tool::uploadMainImg($file);
             }    
             
            if($UsersDetails->UsersDetails($id,$src))
            {
                Tool::scriptAlert('修改资料成功');              
            }else{
                Tool::scriptAlert('修改资料失败');
            }
       }
                
        return  $this->render('profile',['model'=>$model]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        Tool::comeback();        
    }
    
    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsersDetails::findOne(['uid'=>$id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
