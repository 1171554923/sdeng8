<?php

namespace backend\controllers;

use Yii;
use \common\models\AdminVideo;
use backend\models\AdminVideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\page;


/**
 * AdminVideoController implements the CRUD actions for AdminVideo model.
 */
class ManvideoController extends Controller
{
    /**
     * @inheritdoc
     */
  

    /**
     * Lists all AdminVideo models.
     * @return mixed
     */
    public function actionIndex()
    {      
        $model = new AdminVideo();
        $connection = Yii::$app->db;
        $command = $connection->createCommand("SELECT count(*) as count from sd_admin_video");
        $total = $command->queryOne();
        $page_size = 3;         
        
        $page = new \yii\web\Page($total['count'], $page_size);
        $limit= $page->getLimit();
        
        $command  =$connection->createCommand("SELECT * FROM sd_admin_video LIMIT $limit ");
        $video = $command->queryAll();
       
               
        
        return $this->render('index', ['model'=>$model,'video'=>$video,'pageshow'=>$page->showpage()]);        
    }
    
    public function actionPlay($id){
        $model = $this->findModel($id);               
        return $this->render('play',['model'=>$model]);
    }
    
    /**
     * 获取 id 
     * 判断是否通过
     */
    public function actionCheck()
    {        
        $id = $_POST['id'];
        $idArr = explode(',',$id);
        
        if(count($idArr) >= 2)
        {
            if($_POST['check'] == 0)
            {
                $check = 0;
            }else {
                $check = 1;
            }
            for ($x=0; $x<count($idArr)-1; $x++) {                 
                $model = $this->findModel($idArr[$x]);
                $model->statu = $check;
                $model->save();              
            }
           return  0;
           die();
        }
        
        $val = $_POST['val'];
        $model = $this->findModel($id);
        if($val == 1)
        {
            $model->statu = 0;
            if($model->save())
            {
                return 0;
            }else{
                return false;
            }            
        }else {
            $model->statu = 1;
            if($model->save())
            {
                return 1;
            }else{
                return false;
            } 
        }
    }
    
    /*
     * 排序
     */
    public function actionSort()
    {
        $id = $_POST['id'];
        $val = $_POST['val'];
        $model = $this->findModel($id);
        $model->sort = $val;
        if($model->save())
        {
            return  true;
        }else{
            return  false;
        }
    }
    
    /**
     * Displays a single AdminVideo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminVideo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
 public function actionCreate()
    {
        $model = new AdminVideo();                       
        if ($model->load(Yii::$app->request->post()) && $model->insertVideo()) {           
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,                
            ]);
        }
    }

    /**
     * Updates an existing AdminVideo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->updateVideo($id)) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminVideo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {        
        $idArr = explode(',',$id);
       
         if(count($idArr) < 2)
         {
             $this->findModel($id)->delete();
             return $this->redirect(['index']);
         }                
          for ($x=0; $x<count($idArr)-1; $x++) {               
               $this->findModel($idArr[$x])->delete();
            }          
          return $this->redirect(['index']);
    }

    /**
     * Finds the AdminVideo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminVideo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminVideo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
      
}
