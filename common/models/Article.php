<?php

namespace common\models;


use yii\web\Tool;


/**
 * This is the model class for table "sd_article".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $title
 * @property string $thumbnail
 * @property string $description
 * @property string $content
 * @property string $tag
 * @property integer $release_time
 * @property integer $add_time
 * @property integer $cate_g
 * @property integer $nav
 * @property integer $statu
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sd_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ 'content', 'required'],
            [['uid', 'release_time', 'add_time', 'cate_g', 'nav', 'statu'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 60],
            [['thumbnail', 'description'], 'string', 'max' => 200],
            [['tag'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'title' => '标题',
            'thumbnail' => '缩略图',
            'description' => '描述',
            'content' => '内容',
            'tag' => '标签',
            'release_time' => '发布时间',
            'add_time' => '添加时间',
            'cate_g' => '分类',
            'nav' => '菜单栏',
            'statu' => '状态',
        ];
    }
    
    public function insertArticle()
    {
        if ($this->validate()) {
            
            if($_FILES['file']['name'] != ''){
                $src=  Tool::thumbImt($_FILES['file'], 640, 426) ;
            }
              $this->name = $_POST['Article']['name'];
              $this->title = $_POST['Article']['title'];
              $this->description = $_POST['Article']['description'];
              $this->content = $_POST['Article']['content'];
              $this->tag = $_POST['Article']['tag'];
              $this->cate_g = $_POST['Article']['cate_g'];
              $this->nav = $_POST['Article']['nav'];
              $this->statu = $_POST['Article']['statu'];
              $this->add_time = time();
              $this->thumbnail = $src;
              if($this->save())
              {
                  return  true;
              }else{
                  return  false;
              }
        }         
    }
    
    public function updateArticle($id)
    {
        if ($this->validate()) {
            $article = $this->findOne($id);
            $article->name = $_POST['Article']['name'];
            $article->title = $_POST['Article']['title'];
            $article->description = $_POST['Article']['description'];
            $article->content = $_POST['Article']['content'];
            $article->tag = $_POST['Article']['tag'];
            $article->cate_g = $_POST['Article']['cate_g'];
            $article->nav = $_POST['Article']['nav'];
            $article->statu = $_POST['Article']['statu'];
            if($_FILES['file']['name'] != ''){
                $article->thumbnail =  Tool::thumbImt($_FILES['file'], 640, 426) ;
            }
            if($article->save())
            {
                return  true;
            }else{
                return  false;
            }
        }
    }
    
}
