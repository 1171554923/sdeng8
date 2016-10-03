<?php

namespace backend\models;


use common\models\Admin;
class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $add_time;
    public $email;
    public $last_login;
    public $last_ip;
    public $manage_level;
    public $login_count;
    public $authKey;
    public $accessToken;
    
    
   
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = self::findById($id);
        if ($user) {
            return new static($user);
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
       $user = Admin::find()->where(array('accessToken' => $token))->one();
       if ($user) {
           return new static($user);
       }
       return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
       $user = Admin::find()->where(array('username' => $username))->one();         
       if ($user) {
            return new static($user);       
       }
       
       return null;
    }
    
   
    
    /**
     * 
     * @param unknown $id
     * @return \app\models\User|NULL
     */
    
    public static function findById($id) {
        $user = Admin::find()->where(array('id' => $id))->asArray()->one();
        if ($user) {
            return new static($user);
        }
    
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        
       if($this->password === md5($password))
       {
           return true;           
       }else{
           return false;
       }
       
   
    }
}
