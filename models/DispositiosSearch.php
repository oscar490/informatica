<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dispositivos;

/**
 * DispositiosSearch represents the model behind the search form of `app\models\Dispositivos`.
 */
class DispositiosSearch extends Dispositivos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tipo_id', 'ordenador_id', 'aula_id'], 'integer'],
            [['codigo'], 'number'],
            [['marca', 'modelo'], 'safe'],
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
        $query = Dispositivos::find();

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
            'codigo' => $this->codigo,
            'tipo_id' => $this->tipo_id,
            'ordenador_id' => $this->ordenador_id,
            'aula_id' => $this->aula_id,
        ]);

        $query->andFilterWhere(['ilike', 'marca', $this->marca])
            ->andFilterWhere(['ilike', 'modelo', $this->modelo]);

        return $dataProvider;
    }
}
