<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%upload}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $title
 * @property string $url
 * @property string $description
 * @property string $tag
 * @property integer $filesize
 * @property integer $add_time
 * @property integer $file_type
 */
class Upload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sd_upload';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'url','title'], 'required'],
            [['uid', 'filesize', 'add_time', 'file_type'], 'integer'],
            ['title', 'string', 'max' => 60],
            [['description'], 'string', 'max' => 200],
            [['tag'], 'string', 'max' => 100], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', '用户id'),
            'title' => Yii::t('app', '标题'),
            'url' => Yii::t('app', '图片不能为空'),
            'description' => Yii::t('app', '内容描述'),
            'tag' => Yii::t('app', '标签云'),
            'add_time' => Yii::t('app', '添加时间'),
            'file_type' => Yii::t('app', '文件类型'),
        ];
    }
    
    public function  insertImg()
    {
        if($this->validate()){                 
            $this->uid= $_POST['Upload']['uid'];
            $this->title= $_POST['Upload']['title'];
            $this->url = $_POST['Upload']['url'];
            $this->tag = $_POST['Upload']['tag'];            
            $this->add_time = time();                     
             if($this->save()){
                    return true;               
                }else{
                    return  false;
                }   
        }
    }               
}
