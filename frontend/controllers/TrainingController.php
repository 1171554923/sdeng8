<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class TrainingController extends Controller
{
    public $layout= 'front.layout.php';
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionBasic($article)    
    {
        $commond = '';
        switch ($article)
        {
            case 'BasicCommandsSM' :
                $commond = 'BasicCommandsSM';
                break;
            
        }
        
        return  $this->render('basic',['command'=>$commond]);
//         return $this->redirect(['\index']);
    }
}
