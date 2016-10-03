<?php
namespace frontend\controllers;
use Yii;
use yii\base\Controller;
use common\models\Users;
use yii\web\Smtp;
use backend\models\User;


class SendpassController extends Controller
{
    
    public function actionVerifi()
    {
        if(Yii::$app->request->isPost)
        {
             $name =  $_POST['name'];
             
             $model = new Users();
             $user = $model->find()->where(['username'=>$name])->one();             
             if($user)
             {
                 return  1;
             }else{
                 return  2;     
             }
             
        }
        return false;        
    }
   
    
   public function actionEditpass()
   {
       if(Yii::$app->request->isPost)
       {
           $name =  $_POST['name'];
           $pass =  $_POST['password'];
           
           $users= new Users();           
           $user= $users->find()->where(['username'=>$name])->one();
            $user->check = true;
           $user->password = md5($pass);                     
           if($user->save())
           {                            
              return 1;
           }else{
               return 2;              
           }
       }
   }
    
    
    public function actionEmail()
       
    {                
        if(Yii::$app->request->isPost)
        {
            $name =  $_POST['name'];             
            $model = new Users();
            $user = $model->find()->where(['username'=>$name])->one();
            
            if($user->email == $_POST['email'])
            {
          
                $username = $user->username ;
                $password =  $user->password;
               
                $mailto = $user->email;  //收件人 */

                $x = md5($username.'+'.$password);
                $string = base64_encode($username.".".$x);
                
                
                
                $subject= "水灯--社区"; //邮件主题            
                  $body= "尊敬的<a href='javascript:void(0)'>".$username.'</a>先生/女士：<br />    取回密码邮件<br />请点击下面的链接，按流程进行密码重设。<a href="http://sdeng8.com/editpass.html?p='.$string.'">
 http://sdeng8.com/editpass.html?p='.$string.'</a><br>(如果上面不是链接形式，请将地址手工粘贴到浏览器地址栏再访问)
                                                        上面的页面打开后，输入新的密码后提交，之后您即可使用新的密码登录了。<br><br>此邮件为系统邮件，请勿直接回复  
                      ';  //邮件内容  
                
                
                $smtpserver     = "smtp.163.com"; //SMTP服务器
                $smtpserverport = 25; //SMTP服务器端口
                $smtpusermail   = "m15388197069_1@163.com"; //SMTP服务器的用户邮箱
                $smtpemailto    = $mailto;
                $smtpuser       = "15388197069@163.com"; //SMTP服务器的用户帐号
                $smtppass       = "liao13774578798"; //SMTP服务器的用户密码
                $mailsubject    = $subject; //邮件主题
                $mailsubject    = "=?UTF-8?B?" . base64_encode($mailsubject) . "?="; //防止乱码
                $mailbody       = $body; //邮件内容
                //$mailbody = "=?UTF-8?B?".base64_encode($mailbody)."?="; //防止乱码
                $mailtype       = "HTML"; //邮件格式（HTML/TXT）,TXT为文本邮件. 139邮箱的短信提醒要设置为HTML才正常
                ##########################################
                
                $smtp = new Smtp();
                $smtp->smtpa($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
                $smtp->debug    = true; //是否显示发送的调试信息
                $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); 
                                              
            }else {
                return  2;
            }
        }
    }
    
}
?>