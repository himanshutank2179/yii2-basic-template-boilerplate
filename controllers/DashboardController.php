<?php

namespace app\controllers;

use Yii;
use app\models\Location;
use app\models\TicketValues;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSingleData($location_id,$time,$value)
    {
        $model = new TicketValues();

        if (!empty($location_id)&& !empty($time) && !empty($value))
        {
            $isRecordAvailable = \app\models\TicketValues::find()
                ->where(['date(date)' => date('Y-m-d')])
                ->andWhere(['time' => $time])
                ->andWhere(['location_id' => $location_id])
                ->one();
            if (empty($isRecordAvailable)) {
                $newTicket = new TicketValues();
                $newTicket->location_id = $location_id;
                $newTicket->time = $time;
                $newTicket->ticket_value = $value;
                $newTicket->date = date("Y-m-d");
                $newTicket->created_at = date('Y-m-d h:i:s');
                $newTicket->save(false);
                return "data inserted";
            }
            return 0;
        }
        return 0;
    }
}
