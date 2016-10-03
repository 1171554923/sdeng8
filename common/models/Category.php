<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%sd_category}}".
 *
 * @property integer $id
 * @property string $category
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sd_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'required'],
            [['category'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
        ];
    }
    
    //获取所有的属性
    public function allCategory()
    {
        $categories = $this->find()->asArray()->all();
        return $categories;
    }
}