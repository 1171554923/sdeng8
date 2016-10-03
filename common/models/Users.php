<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%sd_users}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $last_login
 * @property string $last_ip
 * @property integer $reg_time
 * @property integer $login_count
 * @property integer $user_type
 * @property string $authKey
 * @property string $accessToken
 */
class Users extends \yii\db\ActiveRecord
{   
    public $confrimpassword;
    public $check;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sd_users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username','unique'],
            [['username','email', 'password'], 'required'],
            ['email','unique','message'=>'邮箱已被注册'],
            ['email','email','message'=>'电子邮箱格式不正确'],
            [['last_login', 'reg_time', 'login_count', 'user_type'], 'integer'],
            [['username', 'password', 'authKey', 'accessToken'], 'string', 'max' => 40],
            [['last_ip'], 'string', 'max' => 15],
            ['confrimpassword','checkPass'],
            ['check','required','message'=>'请阅读同意水灯的《服务条款》']
        ];
    }
    
    
    public function checkPass($attribute, $params)
    {
        if($this->confrimpassword !==  $_POST['Users']['password']){
            $this->addError($attribute, '密码前后不一致');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'last_login' => '最后登陆时间',
            'last_ip' => '最后登陆 Ip',
            'reg_time' => '注册时间 ',
            'login_count' => '登陆次数 ',
            'user_type' => '用户等级',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }
    
    /**
     * 添加用户
     */
    public function createUser()
    {
        if($this->validate())
        {
            if(!@$_POST['Users']['user_type'])
            {
                $level = 1;
            }else{
                $level = $_POST['Users']['user_type'];
            }
            $name  = $_POST['Users']['username'];
            $this->username = $name; 
            $this->email =  $_POST['Users']['email'];
            $this->password = md5($_POST['Users']['password']);
            $this->user_type = $level ;
            $this->authKey = 'test'.$name.'key';
            $this->accessToken = $name.'-token';  
            $this->reg_time = time();
            if($this->save())
            {   
                return true;                
            }else{
               return  false;
            }
                    
        }
    }
    /**
     * 修改用户名
     * @param unknown $id
     */
    public function  updateUser($id)
    {
        if($this->validate())
        {
            $pass = '' ;
            $user = $this->find(['id'=>$id])->one();
            if($user->password == $_POST['Users']['password'])
            {
                $pass = $user->password;
            }else{
                $pass = md5($_POST['Users']['password']);
                
            }                       
            $user->username =$_POST['Users']['username'];
            $user->password = $pass;
            $user->user_type = $_POST['Users']['user_type'];
            if($this->save())
            {
                return true;
            }else{
                return  false;
            }
        }
    }
    
}

 