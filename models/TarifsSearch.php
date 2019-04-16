<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tarifs;

/**
 * TarifsSearch represents the model behind the search form of `app\models\Tarifs`.
 */
class TarifsSearch extends Tarifs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarif_id'], 'integer'],
            [['name', 'amount', 'price'], 'safe'],
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
        $query = Tarifs::find();

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
            'tarif_id' => $this->tarif_id,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'amount', $this->amount])
            ->andFilterWhere(['ilike', 'price', $this->price]);

        return $dataProvider;
    }
}
