<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sd_comment".
 *
 * @property string $id
 * @property string $username
 * @property string $content
 * @property integer $add_time
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sd_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            [['content'], 'string'],
            [['add_time'], 'integer'],             
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',           
            'content' => 'Content',
            'add_time' => 'Add Time',
        ];
    }
}
