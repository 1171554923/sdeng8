<?php

Yii::$classMap['ToolExtend']= '@app/common/tool/ToolExtend.php';

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
    ],
    
];
