<?php

namespace romaloverboy\partner\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use romaloverboy\partner\models\Logo as LogoModel;
use yii\helpers\ArrayHelper;

/**
 * Logo represents the model behind the search form of `backend\models\landing\Logo`.
 */
class LogoSearch extends LogoModel
{
    /**
     * @inheritdoc
     */
	public function attributes(){
		
		return ArrayHelper::merge(parent::attributes(), ['price.name']);
		
	}
    public function rules()
    {
        return [
		    
            [['id'], 'integer'],
            [['logo_image'], 'safe'],
			[['photo.file'], 'safe'],
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
        $query = LogoModel::find();

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

        $query->andFilterWhere(['like', 'logo_image', $this->logo_image]);

        return $dataProvider;
    }
}
