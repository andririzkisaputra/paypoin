<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Layanan;

/**
 * LayananSearch represents the model behind the search form of `common\models\Layanan`.
 */
class LayananSearch extends Layanan
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['layanan_id', 'session_upload_id', 'created_by', 'created_at', 'updated_at', 'kategori_id'], 'integer'],
            [['nama_layanan', 'is_delete'], 'safe'],
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
        $query = Layanan::find();
        $query->joinWith('kategori');

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

        // grid where conditions
        $query->where([
            'layanan.is_delete' => '1',
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'layanan_id'  => $this->layanan_id,
            'layanan.kategori_id'  => $this->kategori_id,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'nama_layanan', $this->nama_layanan]);
        $query->orderBy(['updated_at' => SORT_DESC]);

        return $dataProvider;
    }
}
