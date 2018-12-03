<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TicketValues;

/**
 * TicketValuesSearch represents the model behind the search form of `app\models\TicketValues`.
 */
class TicketValuesSearch extends TicketValues
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_value_id', 'location_id', 'ticket_value'], 'integer'],
            [['date', 'time', 'created_at'], 'safe'],
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
        $query = TicketValues::find()->orderBy(['ticket_value_id' => SORT_DESC]);

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
            'ticket_value_id' => $this->ticket_value_id,
            'location_id' => $this->location_id,
            'ticket_value' => $this->ticket_value,
            'date' => $this->date,
            'time' => $this->time,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
