<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Filters;

/**
 * FiltersSearch represents the model behind the search form of `app\models\Filters`.
 */
class FiltersSearch extends Filters
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filter_id', 'category_id', 'middle_id', 'subcategory_id', 'sort'], 'integer'],
            [['name', 'param'], 'safe'],
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
        $query = Filters::find();

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
            'filter_id' => $this->filter_id,
            'category_id' => $this->category_id,
            'middle_id' => $this->middle_id,
            'subcategory_id' => $this->subcategory_id,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'param', $this->param]);

        return $dataProvider;
    }
}
