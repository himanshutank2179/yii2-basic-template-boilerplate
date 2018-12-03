<?php
namespace app\helper;

use yii;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\TicketValues;

class AppHelper
{

    static public function getLocations()
    {
        $locations = Location::find()->all();
        return ArrayHelper::map($locations, 'location_id', 'location_name');
    }

    static public function getHours()
    {
        $hours = [
            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            // '5' => '5',
            '6' => '6',
            // '7' => '7',
            '8' => '8',
            // '9' => '9',
            // '10' => '10',
            // '11' => '11',
            '12' => '12',
            // '13' => '13',
            // '14' => '14',
            // '15' => '15',
            // '16' => '16',
            // '17' => '17',
            // '18' => '18',
            // '19' => '19',
            // '20' => '20',
            // '21' => '21',
            // '22' => '22',
            // '23' => '23',
            // '24' => '24',
        ];
        return $hours;
    }

    static public function getMinutes()
    {
        $hours = [
            '0' => '0',
            // '1' => '1',
            // '2' => '2',
            // '3' => '3',
            // '4' => '4',
            '5' => '5',
            // '6' => '6',
            // '7' => '7',
            // '8' => '8',
            // '9' => '9',
            '10' => '10',
            // '11' => '11',
            // '12' => '12',
            // '13' => '13',
            // '14' => '14',
            '15' => '15',
            // '16' => '16',
            // '17' => '17',
            // '18' => '18',
            // '19' => '19',
            '20' => '20',
            // '21' => '21',
            // '22' => '22',
            // '23' => '23',
            // '24' => '24',
            '25' => '25',
            // '26' => '26',
            // '27' => '27',
            // '28' => '28',
            // '29' => '29',
            '30' => '30',
            // '31' => '31',
            // '32' => '32',
            // '33' => '33',
            // '34' => '34',
            // '35' => '35',
            // '36' => '36',
            // '37' => '37',
            // '38' => '38',
            // '39' => '39',
            // '40' => '40',
            // '41' => '41',
            // '42' => '42',
            // '43' => '43',
            // '44' => '44',
            // '45' => '45',
            // '46' => '46',
            // '47' => '47',
            // '48' => '48',
            // '49' => '49',
            // '50' => '50',
            // '51' => '51',
            // '52' => '52',
            // '53' => '53',
            // '54' => '54',
            // '55' => '55',
            // '56' => '56',
            // '57' => '57',
            // '58' => '58',
            // '59' => '59',
        ];
        return $hours;
    }

    static public function getTime()
    {
        $time = [
            '00:00:00' => '12:00 AM',
            '00:30:00' => '12.30 AM',
            '01:00:00' => '01:00 AM',
            '01:30:00' => '01:30 AM',
            '02:00:00' => '02:00 AM',
            '02:30:00' => '02:30 AM',
            '03:00:00' => '03:00 AM',
            '03:30:00' => '03:30 AM',
            '04:00:00' => '04:00 AM',
            '04:30:00' => '04:30 AM',
            '05:00:00' => '05:00 AM',
            '05:30:00' => '05:30 AM',
            '06:00:00' => '06:00 AM',
            '06:30:00' => '06:30 AM',
            '07:00:00' => '07:00 AM',
            '07:30:00' => '07:30 AM',
            '08:00:00' => '08:00 AM',
            '08:30:00' => '08:30 AM',
            '09:00:00' => '09:00 AM',
            '09:30:00' => '09:30 AM',
            '10:00:00' => '10:00 AM',
            '10:30:00' => '10:30 AM',
            '11:00:00' => '11:00 AM',
            '11:30:00' => '11:30 AM',
            '12:00:00' => '12:00 AM',
            '12:30:00' => '12:30 AM',
            '13:00:00' => '01:00 PM',
            '13:30:00' => '01:30 PM',
            '14:00:00' => '02:00 PM',
            '14:30:00' => '02:30 PM',
            '15:00:00' => '03:00 PM',
            '15:30:00' => '03:30 PM',
            '16:00:00' => '04:00 PM',
            '16:30:00' => '04:30 PM',
            '17:00:00' => '05:00 PM',
            '17:30:00' => '05:30 PM',
            '18:00:00' => '06:00 PM',
            '18:30:00' => '06:30 PM',
            '19:00:00' => '07:00 PM',
            '19:30:00' => '07:30 PM',
            '20:00:00' => '08:00 PM',
            '20:30:00' => '08:30 PM',
            '21:00:00' => '09:00 PM',
            '21:30:00' => '09:30 PM',
            '22:00:00' => '10:00 PM',
            '22:30:00' => '10:30 PM',
            '23:00:00' => '11:00 PM',
            '23:30:00' => '11:30 PM',
        ];
        return $time;
    }

    static public function SendNotification($message)
    {
        //$reg_ids = Devices::find()->select(['device_hardware_id'])->asArray()->all();
        $regIdsArray = [];
        $reg_ids = Devices::find()->select(['notification_id'])->all();
        foreach ($reg_ids as $key => $value) {
            # code...
            array_push($regIdsArray,$value->notification_id);
        }



        /* echo '<pre>';
         print_r($regIdsArray); exit();*/
        $API_KEY = 'AAAAE1juTr0:APA91bH3oD9WmlBXrpTq_S0pTsjg0own9Va8rMpicPD0J3QN4YC_ucfA1lMYNlVQNLz_tVU9oE9KpYV-vod7uIiVsv0C__a6VRNBPMvX2tkGLR9EKK9Tj7fAD76gLVvapz67KBQNsY0V';

        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

        $fields =  array(
            'registration_ids' => $regIdsArray,
            'notification' => array('title' => 'New Image update', 'body' => $message),
            'data' =>  array('message' =>$message,
                'click_action' => 'com.arastu.connectutility_Notification'),

        );


        $headers = array(
            'Authorization:key=' . $API_KEY,
            'Content-Type:application/json'
        );
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;

    }
}

?>
