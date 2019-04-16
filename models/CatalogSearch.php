<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Catalog;

/**
 * CatalogSearch represents the model behind the search form of `app\models\Catalog`.
 */
class CatalogSearch extends Catalog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'category_id', 'middle_id', 'subcategory_id', 'manufacture_id', 'status_id', 'i1', 'i2', 'i3', 'subtype1', 'subtype2', 'subtype3'], 'integer'],
            [['name', 'description', 'sys_id', 'title', 'keyword', 'vch1', 'vch2'], 'safe'],
            [['price', 'd1', 'd2', 'd3'], 'number'],
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
        $query = Catalog::find();

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
            'goods_id' => $this->goods_id,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'middle_id' => $this->middle_id,
            'subcategory_id' => $this->subcategory_id,
            'manufacture_id' => $this->manufacture_id,
            'status_id' => $this->status_id,
            'i1' => $this->i1,
            'i2' => $this->i2,
            'i3' => $this->i3,
            'd1' => $this->d1,
            'd2' => $this->d2,
            'd3' => $this->d3,
            'subtype1' => $this->subtype1,
            'subtype2' => $this->subtype2,
            'subtype3' => $this->subtype3,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'description', $this->description])
            ->andFilterWhere(['ilike', 'sys_id', $this->sys_id])
            ->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'keyword', $this->keyword])
            ->andFilterWhere(['ilike', 'vch1', $this->vch1])
            ->andFilterWhere(['ilike', 'vch2', $this->vch2]);

        return $dataProvider;
    }
}
