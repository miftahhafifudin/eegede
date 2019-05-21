<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Makanan;

/**
 * MakananSearch represents the model behind the search form of `app\models\Makanan`.
 */
class MakananSearch extends Makanan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_food', 'id_kategori', 'stok'], 'integer'],
            [['nama', 'keterangan', 'img'], 'safe'],
            [['harga'], 'number'],
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
        $query = Makanan::find();

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
            'id_food' => $this->id_food,
            'id_kategori' => $this->id_kategori,
            'stok' => $this->stok,
            'harga' => $this->harga,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
