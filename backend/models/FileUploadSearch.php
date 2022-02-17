<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FileUpload;

/**
 * GambarProdukSearch represents the model behind the search form of `common\models\GambarProduk`.
 */
class FileUploadSearch extends FileUpload
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_upload_id', 'created_at', 'updated_at'], 'integer'],
            [['file_name'], 'safe'],
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
        $query = FileUpload::find();

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
            'session_upload_id' => $this->session_upload_id,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name]);

        return $dataProvider;
    }
}