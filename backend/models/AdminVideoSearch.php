<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AdminVideo;

/**
 * AdminVideoSearch represents the model behind the search form about `backend\models\AdminVideo`.
 */
class AdminVideoSearch extends AdminVideo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'add_time', 'cate_g', 'statu'], 'integer'],
            [['title', 'notes', 'url', 'username'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AdminVideo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'add_time' => $this->add_time,
            'cate_g' => $this->cate_g,
            'statu' => $this->statu,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
