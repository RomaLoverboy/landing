<?php

namespace romaloverboy\partner\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use romaloverboy\partner\models\Reviews;
use yii\helpers\ArrayHelper;

/**
 * ReviewsSearch represents the model behind the search form of `backend\models\landing\Reviews`.
 */
class ReviewsSearch extends Reviews
{
    /**
     * @inheritdoc
     */
		
	
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'surname', 'status', 'text', 'image'], 'safe'],
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
        $query = Reviews::find();

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
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
		      ->andFilterWhere(['like', 'name', $this->name])
			  ->andFilterWhere(['like', 'surname', $this->surname])
			  ->andFilterWhere(['like', 'status', $this->status])
              ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
