<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrdenadoresSearch represents the model behind the search form of `app\models\Ordenadores`.
 */
class OrdenadoresSearch extends Ordenadores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'aula_id'], 'integer'],
            [['codigo'], 'number'],
            [['marca', 'modelo', 'aula.denominacion'], 'safe'],
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

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'aula.denominacion',
        ]);
    }

    /**
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ordenadores::find()
            ->joinWith('aula');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['aula.denominacion'] = [
            'asc' => ['aulas.denominacion' => SORT_ASC],
            'desc' => ['aulas.denominacion' => SORT_DESC],
        ];

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
            'aula_id' => $this->aula_id,
        ]);

        $query->andFilterWhere(['ilike', 'marca', $this->marca])
            ->andFilterWhere(['ilike', 'modelo', $this->modelo])
            ->andFilterWhere([
                'ilike',
                'aulas.denominacion',
                $this->getAttribute('aula.denominacion'),
            ]);

        return $dataProvider;
    }
}
