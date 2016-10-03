<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%sd_arcrank}}".
 *
 * @property integer $id
 * @property integer $rank
 * @property string $membername
 * @property integer $money
 * @property integer $scores
 * @property string $purviews
 */
class Arcrank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sd_arcrank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['membername','unique'],
            [['rank', 'membername'], 'required'],
            [['rank', 'money', 'scores'], 'integer'],
            [['purviews'], 'string'],
            [['membername'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rank' => '等级',
            'membername' => '等级名称',            
            'money' => '等级金币',
            'scores' => '等级分数',
            'purviews' => '等级权限',
        ];
    }
}
