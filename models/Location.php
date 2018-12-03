<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $location_id
 * @property string $location_name
 * @property string $location_image
 * @property string $day_start_time
 * @property string $day_end_time
 * @property string $created_at
 *
 * @property TicketValues[] $ticketValues
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location_name', 'location_image', 'day_start_time', 'day_end_time', 'created_at', 'hour', 'minute',], 'required'],
            [['day_start_time', 'hour', 'minute', 'day_end_time', 'created_at'], 'safe'],
            [['location_name', 'location_image'], 'string', 'max' => 255],
            [['location_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'location_id' => 'Location ID',
            'location_name' => 'Location Name',
            'location_image' => 'Location Image',
            'hour' => 'Hours',
            'minute' => 'Minutes',
            'day_start_time' => 'Day Start Time',
            'day_end_time' => 'Day End Time',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketValues()
    {
        return $this->hasOne(TicketValues::className(), ['location_id' => 'location_id']);
    }
}
