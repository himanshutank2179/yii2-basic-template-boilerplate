<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TicketValues */

$this->title = $model->ticket_value;
$this->params['breadcrumbs'][] = ['label' => 'Ticket Value', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-values-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ticket_value_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ticket_value_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'ticket_value_id',
            // 'location_id',
            [
                'attribute' => 'location_id',
                'value' => function ($data) {
                    return $data->location->location_name;
                },
            ],
            'ticket_value',
            'date',
            'time',
            'created_at',
        ],
    ]) ?>

</div>
