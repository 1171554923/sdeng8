<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sd_nav".
 *
 * @property integer $id
 * @property string $name
 */
class Nav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sd_nav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name','unique'],
            [['name','sort'], 'required'],
            ['url','string','max'=>50],
            [['name'], 'string', 'max' => 40],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '菜单名称',
            'url'=>'菜单地址'
        ];
    }
}
