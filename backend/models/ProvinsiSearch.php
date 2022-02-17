<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Provinsi;

/**
 * ProvinsiSearch represents the model behind the search form of `common\models\Produk`.
 */
class ProvinsiSearch extends Provinsi
{
    public $nama_layanan;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['nama_provinsi'], 'safe'],
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
        $query = Provinsi::find();

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
            'provinsi_id'   => $this->provinsi_id,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'nama_provinsi', $this->nama_provinsi]);
            $query->orderBy(['nama_provinsi' => SORT_ASC]);

        return $dataProvider;
    }
}
