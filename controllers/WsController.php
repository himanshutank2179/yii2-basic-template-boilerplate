<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

/**
 * Description of WsController
 *
 * @author Himanshu tank <himanshutank1111@gmail.com>
 */

use Yii;
use yii\db\Expression;
use yii\helpers\Url;
use yii\rest\Controller;

use app\helpers\AppHelper;
use app\models\Location;
use app\models\TicketValues;


class WsController extends Controller
{

    public $data;
    public $message = "";
    public $response_code;
    public $user;
    public $isTokenValid = true;
    public static $SUPER_ADMIN = 'SUPER ADMIN';
    public static $BUSINESS_OWNER = 2;
    public static $SERVICE_PROVIDER = 3;
    public static $CUSTOMER = 4;
    public static $TOKEN_INVALID = 'Invalid token';

    public function init()
    {
        $headers = Yii::$app->response->headers;
        $headers->add("Cache-Control", "no-cache, no-store, must-revalidate");
        $headers->add("Pragma", "no-cache");
        $headers->add("Expires", 0);
        $headers->add("Access-Control-Allow-Origin", "*");
        $headers->add("Access-Control-Allow-Credentials", true);
        $headers->add("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT");
        $headers->add("Access-Control-Allow-Headers", "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");


        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    }


    public function beforeAction($action)
    {
        if (
            $action->id == 'login' ||
            $action->id == 'submit-survey' ||
            $action->id == 'save-place-visited' ||
            $action->id == 'save-time-slots' ||
            $action->id == 'update-profile'
        ) {

            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }


    /**
     * @inheritdoc
     */


    /**
     *
     * @param type $action
     * @return mixed
     */

    public function actionGetTickets()
    {
        //$tickets = TicketValues::find()->select(['location_id'])->orderBy(['ticket_value_id' => SORT_DESC])->distinct()->all();
        //$tickets = TicketValues::find()->where(['=', 'date(date)', date('Y-m-d')])->groupBy(['location_id'])->orderBy(['ticket_value_id' => SORT_DESC])->all();
        //$tickets = TicketValues::find()->select('location_id')->distinct()->all();
        $tickets = Location::find()->groupBy(['location_id'])->all();
        if ($tickets) {
            $data = [];
            foreach ($tickets as $key => $ticket) {
                $time = '';
                $nexttime = '';
                $location_id = $d['location_id'] = $ticket->location_id;
                $d['location_name'] = $ticket->location_name;
                $hour = $d['hour'] = $ticket->hour;
                $minute = $d['minute'] = $ticket->minute;
                $starttime = $d['day_start_time'] = $ticket->day_start_time;
                $d['day_start_time12'] = date("g:i a", strtotime($ticket->day_start_time));
                $d['day_end_time'] = $ticket->day_end_time;
                $d['day_end_time12'] = date("g:i a", strtotime($ticket->day_end_time));
                $d['location_image'] = !empty($ticket->location_image) ? Yii::$app->urlManager->createAbsoluteUrl('uploads/' . $ticket->location_image) : '';
                //date_default_timezone_set('Asia/Kolkata');
                $ticketdata = TicketValues::find()->where(['location_id' => $location_id])->andwhere(['=', 'date(date)', date('Y-m-d')])->andwhere(['<=', 'time(time)', date('H:i:s')])->orderBy(['ticket_value_id' => SORT_DESC])->one();
                $d['ticket_value_id'] = !empty($ticketdata->ticket_value_id) ? $ticketdata->ticket_value_id : '';
                $d['ticket_value'] = !empty($ticketdata->ticket_value) ? $ticketdata->ticket_value : '';
                $d['ticket_date'] = !empty($ticketdata->date) ? $ticketdata->date : '';
                $time = $d['time'] = !empty($ticketdata->time) ? date("g:i A", strtotime($ticketdata->time)) : '';
                $nexttime = !empty($time) ? date('H:i:s', strtotime('+' . $hour . ' hour +' . $minute . ' minutes', strtotime($time))) : '';
                $d['next_time'] = !empty($nexttime) ? date("g:i a", strtotime($nexttime)) : date("g:i a", strtotime($starttime));
                array_push($data, $d);
            }
            // echo "<pre>";
            // print_r($data);
            // exit();
            return ['status' => 200, 'data' => $data];
        } else {
            return ['status' => 404, 'data' => 'No Data Found.'];
        }
    }

    public function actionGetTicketData($location_id, $bydate = null, $month = null, $year = null)
    {
        if (!empty($location_id) && !empty($bydate)) {
            if($bydate == date('Y-m-d'))
            {
            $tickets = TicketValues::find()->where(['location_id' => $location_id, 'date' => $bydate])->andwhere(['<=', 'time(time)', date('H:i:s')])->orderBy(['time' => SORT_ASC])->all();
            }
            else
            {
                $tickets = TicketValues::find()->where(['location_id' => $location_id, 'date' => $bydate])->orderBy(['time' => SORT_ASC])->all();
            }
            if ($tickets) {
                $data = [];
                foreach ($tickets as $key => $ticket) {
                    $location_name = $ticket->location->location_name;
                    $d['date'] = $ticket->date;
                    $d['time'] = date("g:i a", strtotime($ticket->time));
                    $d['ticket_value'] = $ticket->ticket_value;
                    array_push($data, $d);
                }
                return ['status' => 200, 'data' => $data, 'location_name' => $location_name];
            } else {
                return ['status' => 404, 'data' => 'No Data Found.'];
            }
        }

        if (!empty($location_id) && !empty($month) && !empty($year)) {
            
            $tickets = TicketValues::find()->where(['location_id' => $location_id])->andWhere(['=', 'month(date)', $month])->andWhere(['=', 'year(date)', $year])->all();

            if ($tickets) {
                $data = [];
                $today = date('Y-m-d');
                $todaytime = date('H:i:s'); 
                foreach ($tickets as $key => $ticket) {
                    
                    $location_name = $ticket->location->location_name;
                    $location_time = $ticket->location->day_start_time;
                    $date =$d['date'] = $ticket->date;
                    ($today == $date && $todaytime <= $location_time) ? $d['ticket_value'] = '' : $d['ticket_value'] = $ticket->ticket_value;
                    
                    array_push($data, $d);
                }
                // echo "<pre>";
                // print_r($data);
                // exit();
                $time = date("g:i a", strtotime($location_time));
                $location_name = $location_name . "(" . $time . ")";

                return ['status' => 200, 'data' => $data, 'location_name' => $location_name];
            } else {
                return ['status' => 404, 'data' => 'No Data Found...'];
            }
        } else {
            return ['status' => 404, 'data' => 'No Data Found.'];
        }
    }


    public function actionSaveTimeSlots()
    {
        $request = Yii::$app->request->post();
        $values = !empty($request['values']) ? $request['values'] : '';
        $locations = !empty($request['locations']) ? $request['locations'] : '';
        $times = !empty($request['times']) ? $request['times'] : '';
        foreach ($values as $key => $value) {
            $isRecordAvailable = \app\models\TicketValues::find()
                ->where(['date(date)' => date('Y-m-d')])
                ->andWhere(['time(time)' => date('H:i:s', strtotime($times[$key]))])
                ->andWhere(['location_id' => $locations[$key]])
                ->one();
            if (empty($isRecordAvailable)) {
                $newTicket = new TicketValues();
                $newTicket->location_id = $locations[$key];
                $newTicket->ticket_value = $value;
                $newTicket->time = date('H:i:s', strtotime($times[$key]));
                $newTicket->date = date('Y-m-d');
                $newTicket->created_at = date('Y-m-d H:i:s');
                $newTicket->save(false);
                // return 1;
            }
        }
        return 1;
    }

    public function actionGetNotification()
    {
        //$ticketdata = TicketValues::find()->where(['=', 'date(date)', date('Y-m-d')])->andwhere(['<=', 'DATE_SUB(time)', date('H:i:s')])->orderBy(['ticket_value_id' => SORT_DESC])->all(); 
        //DATE_SUB( '2016-02-23 20:55:58', INTERVAL 2 MINUTE )
        $ticketdata = TicketValues::find()->where(['=', 'date(date)', date('Y-m-d')])->andWhere(['>', 'DATE_SUB(time, INTERVAL 2 MINUTE)', date('H:i:s')])->andWhere(['<', 'DATE_SUB(time, INTERVAL 2 MINUTE)', date('H:i:s')])->all();
        echo "<pre>";
        print_r($ticketdata);
        exit();

        return $ticketdata;
    }


}