<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProdukSearch represents the model behind the search form of `common\models\Produk`.
 */
class ProdukSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fund', 'fee', 'price', 'price_basic', 'created_at', 'updated_at'], 'integer'],
            [['note', 'bill', 'status'], 'string'],
            [['type', 'code', 'name', 'brand', 'category', 'provider'], 'string', 'max' => 255],
            [['note', 'bill', 'status', 'type', 'code', 'name', 'brand', 'category', 'provider'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Product::find();

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
            'id'         => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'code', $this->code])
              ->andFilterWhere(['like', 'type', $this->type])
              ->andFilterWhere(['like', 'brand', $this->brand]);
            $query->orderBy(['brand' => SORT_DESC]);

        return $dataProvider;
    }
}
