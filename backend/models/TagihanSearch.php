<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Trx;

/**
 * TagihanSearch represents the model behind the search form of `common\models\Trx`.
 */
class TagihanSearch extends Trx
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'status', 'refund'], 'string'],
            [['price', 'profit', 'created_at', 'updated_at'], 'integer'],
            [['code_bill', 'user', 'code', 'name', 'costumer_name', 'trxtype', 'provider'], 'string', 'max' => 255],
            [['data', 'status', 'refund', 'code_bill', 'user', 'code', 'name', 'costumer_name', 'trxtype', 'provider'], 'safe'],
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
        $query = Trx::find();
        // $query->joinWith('layanan');

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
            'code_bill'  => $this->code_bill,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'data', $this->data]);
        $query->orderBy(['updated_at' => SORT_DESC]);
        return $dataProvider;
    }
}
