<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Arcrank;

/**
 * ArcrankSearch represents the model behind the search form about `common\models\Arcrank`.
 */
class ArcrankSearch extends Arcrank
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rank', 'money', 'scores'], 'integer'],
            [['membername', 'purviews'], 'safe'],
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
        $query = Arcrank::find();

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
            'rank' => $this->rank,        
            'money' => $this->money,
            'scores' => $this->scores,
        ]);

        $query->andFilterWhere(['like', 'membername', $this->membername])
            ->andFilterWhere(['like', 'purviews', $this->purviews]);

        return $dataProvider;
    }
}
