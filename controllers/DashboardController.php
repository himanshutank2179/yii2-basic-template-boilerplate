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
                $d['ticket_value_id'] = !empty($ticket->ticketValues->ticket_value_id) ? $ticket->ticketValues->ticket_value_id : '';
                $d['ticket_value'] = !empty($ticket->ticketValues->ticket_value) ? $ticket->ticketValues->ticket_value : '';
                $d['time'] = date("g:i a", strtotime(!empty($ticket->ticketValues->ticket_value_id) ? $ticket->ticketValues->ticket_value_id : ''));
                $nexttime = date('H:i:s', strtotime('+'. $ticket->hour.' hour +'. $ticket->minute . ' minutes', strtotime(!empty($ticket->ticketValues->ticket_value_id) ? $ticket->ticketValues->ticket_value_id : '')));
                $d['next_time24'] =$nexttime;
                $d['next_time'] =date("g:i a", strtotime($nexttime));
                array_push($data, $d);
            }
            // echo "<pre>";
            // print_r($data);
            // exit();
        	return $this->render('index', ['location_data' => $data,]);
        }
        return $this->render('index', ['location_data' => $data,]);        
    }

    public function actionSingleData($location_id,$time,$value)
    {
        $model = new TicketValues();

        if (!empty($location_id)&& !empty($time) && !empty($value))
        {
            date_default_timezone_set('Asia/Kolkata');
            $model->location_id = $location_id;
            $model->time = $time;
            $model->ticket_value = $value;
            $model->date = date("Y-m-d");
            $model->created_at = date('Y-m-d h:i:s');
            $model->save();
            return "data inserted";
        }
        return 0;
    }

}
