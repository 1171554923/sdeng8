<?php
namespace frontend\controllers;

use Yii;
use yii\base\Controller;
use common\models\Comment;
use common\models\Users;
use common\models\UsersDetails;
use yii\web\Tool;

/**
 * Site controller
 */
class CommentController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       if(Yii::$app->request->ispost)
      { 
         $model =  new Comment();
         $model->vid = $_POST['vid'];
         $model->uid = $_POST['id'];
         $model->content = $_POST['text'];
         $model->add_time = time();
         if($model->save())             
         {
            return  1;                         
         }else{
             return 2;
         } 
      }else{
           $this->redirect(['/index']);
      }
    }
    
    /**
     * 添加赞
     */
    public function actionAddzan(){
      if(Yii::$app->request->ispost){
            if($_POST['type'] == 'zan')
            { 
                $model =  new Comment();
                $comment = $model->findOne($_POST['id']);
                $comment->good   =  $comment->good + 1;
                if($comment->save())
                {
                    return  1;
                }
            }else{
                $model =  new Comment();
                $comment = $model->findOne($_POST['id']);
                $comment->nogood   =  $comment->nogood + 1;
                if($comment->save())
                {
                    return  1;
                }
            }
        }else{
           $this->redirect(['/index']);
      }            
    }
        
    public  function actionTotal(){
        $connection = Yii::$app->db;
        $vid = $_POST['vid'];            
        $command = $connection->createCommand("SELECT count(*) as count from sd_comment where vid=$vid ");
        $total = $command->queryOne();
        return $total['count'];
    }
    
    
    public  function actionPage()
    {        
        
        $vid = $_POST['vid'];
        if(@$_POST['uid']){
            $uid =  $_POST['uid'];
        }else{
            $uid = 0;
        }
        if(@$_POST['objectId']){
            $objectId = $_POST['objectId'];
        }else{
            $objectId = 0;
        }
        
        if(@$_POST['type'] == 'mycomment')
        {
            $mycomment = "AND uid=$uid";
        }else{
            $mycomment ='';
        }
        $connection = Yii::$app->db;
        $command = $connection->createCommand("SELECT count(*) as count from sd_comment where vid=$vid AND object_id=$objectId $mycomment");
        $total = $command->queryOne();
        $page_size = 10;
        $page = new \yii\web\PageFront($total['count'], $page_size,$objectId);
        $limit= $page->getLimit();
                         
        $command  =$connection->createCommand("SELECT * FROM sd_comment where vid=$vid AND object_id=$objectId $mycomment ORDER BY  add_time DESC LIMIT $limit ");
        $comments = $command->queryAll();
        
        $loginStr = '';
        
        if(Yii::$app->user->isGuest)
        {
            $loginStr = '<a onclick="loginEnter()">登陆&nbsp;</a><strong>|</strong>&nbsp;<a href="/register.html">注册</a>';
        }else {
            $loginStr = '<div class="pull-left" id="username" data="'.Yii::$app->user->getId().'">@'.Yii::$app->user->identity->username.'</div>';
        } 
        
        
       $str = '';
        if(count($comments) == 0){
            $str.='<div style="color:#999999;text-align: center; margin:10px 0">没有任何评论!</div>';
        }else{
            $str .= $page->showpage();
        }
        
        foreach ($comments as $value)
        {
            $str.= '<dl>
                        <dt><a href="#" class="thumbnail">'.$this->thumb($value['uid']).'</a></dt>
                         <dd>
                                <p>'.$this->namechek($value['uid'],$uid).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.Tool::T($value['add_time']).'</p>
                                <p>'.Tool::qqFace($value['content']).'</p>
                                <p>
                                    <span class="zan"   onclick="goodsCheck(this,\'zan\')" data="'.$value['id'].'">'.$value['good'].'</span>
                                   <span class="notzan" onclick="goodsCheck(this,\'notzan\')"  data="'.$value['id'].'" >'.$value['nogood'].'</span>
                                   '.$this->backMessage($vid, $value['id'], $objectId).'
                               </p>
                       </dd>
                          <dd class="return" data="'.$value['id'].'">
                              <div class="login">'.$loginStr.'<span class="pull-right" style="color:#cccccc">300个字符</span></div><textarea id="saytext'.$value['id'].'"  class="comment_content"></textarea><p><span class="emotion"></span><input type="button"    class="submit_btn submit" onclick="bakc_message(this)"   value="回复"><input type="button"   class="submit_btn" onclick="close_back(this)" value="取消"> </p><div class="return_list">
                           </div>
                         </dd>     
                    </dl>';
        }
       $str.='<div class="blank"></div><div class="blank"></div>';
        return $str; 
    }
   
    public function backMessage($vid,$id,$objectId){
        if($objectId > 0)
        {
            return  '<a  onclick="backOhter(this)" style="cursor: pointer;" >回复</a>';
        }else{
            $connection = Yii::$app->db;
            $command = $connection->createCommand("SELECT count(*) as count from sd_comment where vid=$vid AND object_id=$id");
            $total = $command->queryOne();
            
            return '<span onclick="backMessage(this)" class="message">('.$total['count'].')</span>';
        }
    }
    
   
    
    //查找名字
   public function namechek($id,$uid)
    {
        $users =  new Users();
        $user = $users->findOne($id);
        if($id ==  $uid )
        {
            return  '<div data="me" style="color:red">我</div>';
        }else{
            return '<span>'.$user['username'].'</span>';
        }

    }
    
   public function thumb($id)
    {
        $user_details = new UsersDetails();
        $user_detail = $user_details->findOne(['uid'=>$id]);
        if($user_detail['portrait_img']){
            return  '<img src="'.$user_detail['portrait_img'].'" alt="图片">';
        }else{
            return  '<img src="../images/default_profile_image_thumb.png" alt="图片">';
        }
    }
    
    
    //登陆
   /*  
    
    /**
     *加载评论 
     */   
    public function actionReback()
    {
        $model =  new Comment();
    }
    
    /**
     * 评论回复
     */
    public function actionReturn()
    {
        if(Yii::$app->request->ispost){
           $model =  new Comment();         
           $model->vid = $_POST['vid'];
           $model->uid = $_POST['uid'];
           $model->content = $_POST['content'];
           $model->object_id = $_POST['objectId'];
           $model->add_time = time();
           if($model->save()){
               return 1;               
           }else{
               return 2;
           }
        }else{
           $this->redirect(['/index']);
          }
    }

}
