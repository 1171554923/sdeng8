<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%sd_users_details}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $phone_number
 * @property string $birth_day
 * @property string $sex
 * @property string $web_url
 * @property string $main_url
 * @property string $portrait_url
 * @property integer $qq
 * @property string $weibo_url
 * @property string $weixin_url
 */
class UsersDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sd_users_details}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['nickname','unique','message'=>'昵称已被人使用'],
            [['uid'], 'required'],
            ['email','email'],
            ['birth_day','match','pattern'=>'/\d{4}\/\d{1,2}\/\d{1,2}/','message'=>'出生日期不正确'],
            ['email','unique','message'=>'邮箱已被人使用'],
            [['phone_number','qq'], 'filter', 'filter' => 'trim','message'=>'电话号码格式错误'],
            ['phone_number', 'string', 'min' => 11,'tooShort'=>'电话号码格式错误'],
            ['phone_number','unique','message'=>'电话号码被占用'],
            ['qq','match','pattern'=>'/[1-9]\d{4,}/','message'=>'qq号码格式不正确'],
            [['uid', 'qq'], 'integer'],
            [['sex'], 'string'],
            [['birth_day', 'web_url', 'main_img'], 'string', 'max' => 255],
            [['portrait_img', 'weibo_url'], 'string', 'max' => 100],
            [['weixin_url'], 'string', 'max' => 11],
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
            'phone_number' => 'Phone Number',
            'birth_day' => 'Birth Day',
            'sex' => 'Sex',
            'web_url' => 'Web Url',           
            'qq' => 'Qq',
            'weibo_url' => 'Weibo Url',
            'weixin_url' => 'Weixin Url',
        ];
    }
    
    public function UsersDetails($id,$src)
    {    
        $src =  $_POST['UsersDetails']['main_img'] ?  $_POST['UsersDetails']['main_img']  : $src;
        $UsersDetails = $this->find(['uid'=>$id])->one();
        $UsersDetails->nickname = $_POST['UsersDetails']['nickname'];
        $UsersDetails->phone_number =$_POST['UsersDetails']['phone_number'];
        $UsersDetails->birth_day =$_POST['UsersDetails']['birth_day'];
        $UsersDetails->sex =$_POST['UsersDetails']['sex'];
        $UsersDetails->web_url =$_POST['UsersDetails']['web_url'];
        $UsersDetails->main_img = $src;
        $UsersDetails->portrait_img = $_POST['UsersDetails']['portrait_img'];
        $UsersDetails->qq = $_POST['UsersDetails']['qq'];
        $UsersDetails->weibo_url = $_POST['UsersDetails']['weibo_url'];
        $UsersDetails->weixin_url = $_POST['UsersDetails']['weixin_url'];
        $UsersDetails->email = $_POST['UsersDetails']['email'];
        if($UsersDetails->save()){
            return  true;    
        }else{
            return false;              
        }        
        
    }
}
