<?php

namespace common\models;



/**
 * This is the model class for table "sd_admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $add_time
 * @property integer $last_login
 * @property string $last_ip
 * @property integer $manage_level
 * @property integer $login_count
 * @property string $authKey
 * @property string $accessToken
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sd_admin';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username','unique'],
            ['email','email'],            
            ['password','string','min'=>6],
            [['add_time', 'last_login', 'manage_level', 'login_count'], 'integer'],
            [['username', 'password'], 'string', 'max' => 40],
            [['email', 'authKey', 'accessToken'], 'string', 'max' => 60],
            [['last_ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '用户密码',
            'email' => '电子邮箱',
            'add_time' => 'Add Time',
            'last_login' => 'Last Login',
            'last_ip' => '最后登陆 Ip',
            'manage_level' => '管理员等级',
            'login_count' => 'Login Count',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }
    
    public function insertAdmin()
    {
      if($this->validate())
      {
           $this->username =  $_POST['Admin']['username'];     
           $this->password = md5($_POST['Admin']['password']);
           $this->email = $_POST['Admin']['email'];
           $this->add_time = time();       
           $this->manage_level = $_POST['Admin']['manage_level'];
           $this->authKey = 'test'.$_POST['Admin']['username'].'13774578798';
           $this->accessToken = 'test-'.$_POST['Admin']['username'];   
           if($this->save())
           {
               return  true;
           }else {
               var_dump($this->errors);
               die();
               return  false;
           }
      }       
    }
    
   public function updateAdmin($id)
    {
            $admin = $this->find()->where(['id'=>$id])->one();
            if($admin->password ==$_POST['Admin']['password'] ){
                 $password = $admin->password;
            }else{
                $password = md5($_POST['Admin']['password']);
            }
            
            
            $admin->username =  $_POST['Admin']['username'];            
            $admin->email = $_POST['Admin']['email'];
            $admin->password = $password;
            $admin->manage_level = $_POST['Admin']['manage_level'];
            if($admin->save())
            {
                return  true;
            }else {           
                return  false;
            }       
   
    } 
}