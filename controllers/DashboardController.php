<?php

namespace app\controllers;

use Yii;
use app\models\Location;
use app\models\TicketValues;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //$tickets = TicketValues::find()->where(['=', 'date(date)', date('Y-m-d')])->groupBy(['location_id'])->orderBy(['time' => SORT_ASC])->all();
        //$tickets = Location::find()->groupBy(['location_id'])->orderBy(['time' => SORT_ASC])->all();
        //$tickets = Location::find()->groupBy(['location_id'])->all();
        $data = [];
        $tickets = Location::find()->groupBy(['location_id'])->all();
        if($tickets)
        {
            foreach ($tickets as $key => $ticket) {
                $time ='';
                $nexttime ='';
                $location_id = $d['location_id'] = $ticket->location_id;
                $d['location_name'] = $ticket->location_name;
                $hour =$d['hour'] = $ticket->hour;
                $minute =$d['minute'] = $ticket->minute;
                $starttime = $d['day_start_time'] = $ticket->day_start_time;
                $d['day_start_time12'] = date("g:i a", strtotime($ticket->day_start_time));
                $d['day_end_time'] = $ticket->day_end_time;
                $d['day_end_time12'] = date("g:i a", strtotime($ticket->day_end_time));
                $d['location_image'] = !empty($ticket->location_image) ? Yii::$app->urlManager->createAbsoluteUrl('uploads/' . $ticket->location_image) : '';
                date_default_timezone_set('Asia/Kolkata');
                $ticketdata = TicketValues::find()->where(['location_id' => $location_id])->andwhere(['=', 'date(date)', date('Y-m-d')])->andwhere(['<=', 'time(time)', date('H:i:s')])->orderBy(['ticket_value_id' => SORT_DESC])->one();
                $d['ticket_value_id'] = !empty($ticketdata->ticket_value_id) ? $ticketdata->ticket_value_id : '';
                $d['ticket_value'] = !empty($ticketdata->ticket_value) ? $ticketdata->ticket_value : '';
                $d['ticket_date'] = !empty($ticketdata->date) ? $ticketdata->date : '';
                $time = $d['time'] = !empty($ticketdata->time) ? date("g:i A", strtotime($ticketdata->time)) : '';
                $nexttime = !empty($time) ? date('H:i:s', strtotime('+'. $hour.' hour +'. $minute . ' minutes', strtotime($time))) : date('H:i:s', strtotime('+'. $hour.' hour +'. $minute . ' minutes', strtotime($starttime)));
                $d['next_time24'] = !empty($nexttime)? $nexttime : '';
                $d['next_time'] = !empty($nexttime) ? date("g:i a", strtotime($nexttime)) : date("g:i a", strtotime($starttime));
               array_push($data, $d);
            }
        	return $this->render('index', ['location_data' => $data,]);
        }
        return $this->render('index', ['location_data' => $data]);        
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
