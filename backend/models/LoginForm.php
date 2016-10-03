<?php
namespace backend\models;
use Yii;
use yii\base\Model;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $captcha;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['username', 'required','message'=>'用户名不能为空'],
            ['password', 'required','message'=>'用户密码不能为空'],
            ['username','string','max'=>40,'min'=>2,'tooLong'=>'用户名不能大于40位','tooShort'=>'用户名不能小于2位'],
            ['password','string','max'=>40,'min'=>6,'tooLong'=>'密码不能大于40位','tooShort'=>'密码名不能小于6位'],
            
            ['captcha','captcha','message'=>'验证码错误','captchaAction'=>'index/captcha'],
            // rememberMe must be a boolean value
//             ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {                
        if (!$this->hasErrors()) {
            $user = $this->getUser();                       
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '密码或者账号错误.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {         
             return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);           
        } else {
            return false;
        }
        
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
