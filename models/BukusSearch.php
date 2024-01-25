<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bukus;

/**
 * BukusSearch represents the model behind the search form of `app\models\Bukus`.
 */
class BukusSearch extends Bukus
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'Tahun_Terbit', 'Jumlah_Salinan', 'Kategori_id', 'admin_id'], 'integer'],
            [['Sampul', 'Judul', 'Penulis', 'Penerbit', 'created_at', 'updated_at'], 'safe'],
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
        $query = Bukus::find();

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
            'Tahun_Terbit' => $this->Tahun_Terbit,
            'Jumlah_Salinan' => $this->Jumlah_Salinan,
            'Kategori_id' => $this->Kategori_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'admin_id' => $this->admin_id,
        ]);

        $query->andFilterWhere(['like', 'Sampul', $this->Sampul])
            ->andFilterWhere(['like', 'Judul', $this->Judul])
            ->andFilterWhere(['like', 'Penulis', $this->Penulis])
            ->andFilterWhere(['like', 'Penerbit', $this->Penerbit]);

        return $dataProvider;
    }
}
