<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rekomendasi;

/**
 * RekomendasiSearch represents the model behind the search form of `app\models\Rekomendasi`.
 */
class RekomendasiSearch extends Rekomendasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Judul', 'Kategori'], 'safe'],
            [['Rating'], 'integer'],
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
        $query = Rekomendasi::find();

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
            'Rating' => $this->Rating,
        ]);

        $query->andFilterWhere(['like', 'Judul', $this->Judul])
            ->andFilterWhere(['like', 'Kategori', $this->Kategori]);

        return $dataProvider;
    }
}
