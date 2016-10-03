<?php

namespace common\models;
/**
 * This is the model class for table "{{%sd_vedio}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $url
 * @property string $title
 * @property string $notes
 * @property integer $category
 * @property string $username
 * @property string $email
 * @property integer $phone
 */
class video extends \yii\db\ActiveRecord
{
    public $onlyread;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sd_video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            [['uid', 'url', 'title', 'phone','email','username','categ'], 'required'],         
             ['onlyread','required','message'=>'请仔细阅读上传视频规则'],            
            ['email','email','message'=>'邮箱格式错误'],
            [['uid'], 'integer'],
            [['url'], 'string', 'max' => 200],
            [['title', 'notes'], 'string', 'max' => 200],
            [['username'], 'string', 'max' => 50],   
            ['phone','match','pattern'=>'/^1[0-9]{10}$/','message'=>'手机号格式不正确'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'url' => '视频地址',
            'title' => '标题',
            'notes' => '视频备注',
            'categ' => '分类',
            'username' => '名字',
            'email' => '电子邮箱',
            'phone' => '电话号码',
        ];
    }
    
    public function insertVideo()
    {
     
      if($this->validate())
      {                        
            $this->uid= $_POST['video']['uid'];
            $this->title= $_POST['video']['title'];
            $this->url = $_POST['video']['url'];
            $this->notes = $_POST['video']['notes'];
            $this->categ = $_POST['video']['categ'];
            $this->username = $_POST['video']['username'];
            $this->email = $_POST['video']['email'];
            $this->phone = $_POST['video']['phone'];
            $this->add_time = time();     
            if($this->save()){
                return true;               
            }else{
                return false;
            }         
        } 
    }
    
   
    
}