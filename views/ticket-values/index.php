<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\helper\AppHelper;
use dosamigos\datepicker\DatePicker;
use dosamigos\datetimepicker\DateTimePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketValuesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticket Value';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-values-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ticket Value', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'ticket_value_id',
            // 'location_id',
            [
                'attribute' => 'location_id',
                'value' => function ($data) {
                    return $data->location->location_name;
                },
                'filter' => Html::activeDropDownList($searchModel, 'location_id', AppHelper::GetLocations(), ['class' => 'form-control', 'prompt' => 'Filter By Location']),
            ],
            'ticket_value',
            //'date',
            [
                'attribute' => 'date',
                'label'=> 'Day',
                //'value' => date('Y-m-d'),
                'filter' =>DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date',
                   //'name' => 'created_at',
                    'value' => date('Y-m-d'),
                    'template' => '{addon}{input}',
                        'clientOptions' => [
                            'autoclose' => true,
                            'todayHighlight' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                ]),
                        //'format' => 'html',
            ],
            // 'time',
            [
                'attribute' => 'time',
                'label'=> 'Day',
                //'value' => date('Y-m-d'),
                'filter' =>DateTimePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'time',
                   //'name' => 'created_at',
                    'value' => date('hh:mm:i'),
                    'template' => '{addon}{input}',
                        'clientOptions' => [
                             'startView' => 1,
                               'minView' => 0,
                               'maxView' => 1,
                               'autoclose' => true,
                               //'linkFormat' => 'HH:ii P', // if inline = true
                               'format' => 'hh:ii:', // if inline = false
                               'todayBtn' => true
                        ]
                ]),
                        //'format' => 'html',
            ],
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
