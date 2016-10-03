<?php

namespace common\models;

use Yii;
use yii\web\Tool;

/**
 * This is the model class for table "{{%sd_admin_video}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $notes
 * @property string $url
 * @property string $username
 * @property integer $add_time
 * @property integer $cate_g
 * @property integer $statu
 */
class AdminVideo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sd_admin_video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url', 'cate_g','username'], 'required'],
            [['add_time', 'cate_g', 'statu'], 'integer'],
            [['title', 'notes'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 100],
            [['username'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'notes' => '提示',
            'url' => 'Url',
            'username' => '发布人',
            'add_time' => '添加时间',
            'cate_g' => '分类',
            'statu' => '状态',
        ];
    }
    
    public  function insertVideo()
    {
        if($this->validate())
        {
            if($_FILES['file']['name'] != ''){
                $src=  Tool::thumbImt($_FILES['file'], 640, 425) ;
            }
            
            $this->title =$_POST['AdminVideo']['title'];
            $this->url =$_POST['AdminVideo']['url'];
            $this->url_type =$_POST['AdminVideo']['url_type'];
            $this->notes =$_POST['AdminVideo']['notes'];
            $this->username =$_POST['AdminVideo']['username'];
            $this->cate_g =$_POST['AdminVideo']['cate_g'];
            $this->statu =$_POST['AdminVideo']['statu'];
            $this->add_time = time();
            $this->thumbnail = $src;
            if($this->save())
            {
                return  true;                
            }else {
                return  false;              
            }
        }
        
    }
    
    public  function updateVideo($id)
    {
        if($this->validate())
        {       
            $video = $this->findOne($id);
            $video->title =$_POST['AdminVideo']['title'];
            $video->url =$_POST['AdminVideo']['url'];
            $video->url_type =$_POST['AdminVideo']['url_type'];
            $video->notes =$_POST['AdminVideo']['notes'];
            $video->username =$_POST['AdminVideo']['username'];
            $video->cate_g =$_POST['AdminVideo']['cate_g'];
            $video->statu =$_POST['AdminVideo']['statu'];
           if($_FILES['file']['name'] != ''){
                $video->thumbnail =  Tool::thumbImt($_FILES['file'], 640, 425) ;
            }
            if($video->save())
            {
                return  true;
            }else{
                return  false;
            }
        }
    }
   
}
