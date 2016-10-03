<?php 
 namespace  common\models;
 
 use Yii;
use yii\web\Tool;
     
 /**
  * This is the model class for table "sd_carousel".
  *
  * @property integer $id
  * @property string $name
  * @property string $url
  * @property integer $add_time
  */
 class Carousel extends \yii\db\ActiveRecord
 {
     /**
      * @inheritdoc
      */
     public static function tableName()
     {
         return 'sd_carousel';
     }
 
     /**
      * @inheritdoc
      */
     public function rules()
     {
         return [
             ['name', 'required'],
             [['add_time'], 'integer'],
             [['name', 'url'], 'string', 'max' => 255],
         ];
     }
 
     /**
      * @inheritdoc
      */
     public function attributeLabels()
     {
         return [
             'id' => 'ID',
             'name' => '轮播名称',
             'url' => '图片地址',
             'add_time' => '添加时间',
         ];
     }
     
     public function insertCarousel()
     {
         if($this->validate())
         {             
            if($_FILES['file']['name'] != ''){
                 $src=  Tool::CarouselImg('file');
            }             
            $this->name=$_POST['Carousel']['name'];
            $this->url = $src;
            $this->add_time = time();
            if($this->save())
            {
                return  TRUE;
            }else{
                return  false;
            }            
         }
        
     }
     
    public function  updateCarousel($id)
    {
        if($this->validate())
        {
            $carousel = $this->find($id)->one();
            
            if($_FILES['file']['name'] != ''){
                $src=  Tool::CarouselImg('file');
                $carousel->url = $src;
            }
            $carousel->name=$_POST['Carousel']['name'];
                    
            if($carousel->save())
            {
                return  TRUE;
            }else{
                return  false;
            }
        }
    }
 }
 
 
 
?>