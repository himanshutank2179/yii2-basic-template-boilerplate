<?php

namespace app\controllers;

use Yii;
use app\models\Location;
use app\models\TicketValues;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //return $this->render('index');
        //$tickets = TicketValues::find()->where(['=', 'date(date)', date('Y-m-d')])->groupBy(['location_id'])->orderBy(['time' => SORT_ASC])->all();
        //$tickets = Location::find()->groupBy(['location_id'])->orderBy(['time' => SORT_ASC])->all();
        $tickets = Location::find()->groupBy(['location_id'])->all();

        // echo "<pre>";
        // print_r($tickets);
        // exit();
        $data = [];
        if($tickets)
        {
        	
            foreach ($tickets as $key => $ticket) {
                $d['location_id'] = $ticket->location_id;
                $d['location_name'] = $ticket->location_name;
                $d['hour'] = $ticket->hour;
                $d['minute'] = $ticket->minute;
                $d['day_start_time'] = $ticket->day_start_time;
                $d['day_end_time'] = $ticket->day_end_time;
                $d['location_image'] = !empty($ticket->location_image) ? Yii::$app->urlManager->createAbsoluteUrl('uploads/' . $ticket->location_image) : '';
                // $d['ticket_value_id'] = $ticket->ticket_value_id;
                // $d['ticket_value'] = $ticket->ticket_value;
                // $d['time'] = date("g:i a", strtotime($ticket->time));
                // $d['date'] = $ticket->date;
                array_push($data, $d);
            }
            // echo "<pre>";
            // print_r($data);
            // exit();
        	return $this->render('index', ['location_data' => $data,]);
        }
        return $this->render('index', ['location_data' => $data,]);        
    }

}
