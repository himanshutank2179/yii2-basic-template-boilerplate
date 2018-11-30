<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket_values".
 *
 * @property int $ticket_value_id
 * @property int $location_id
 * @property int $ticket_value
 * @property string $date
 * @property string $time
 * @property string $created_at
 *
 * @property Location $location
 */
class TicketValues extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location_id', 'date', 'time', 'created_at'], 'required'],
            [['location_id', 'ticket_value'], 'integer'],
            [['date', 'time', 'created_at','ticket_value'], 'safe'],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['location_id' => 'location_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ticket_value_id' => 'Ticket Value ID',
            'location_id' => 'Location',
            'ticket_value' => 'Ticket Value',
            'date' => 'Date',
            'time' => 'Time',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['location_id' => 'location_id']);
    }
}
