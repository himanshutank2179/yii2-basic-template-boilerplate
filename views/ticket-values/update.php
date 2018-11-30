<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TicketValues */

$this->title = 'Update Ticket Value';
$this->params['breadcrumbs'][] = ['label' => 'Ticket Value', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ticket_value_id, 'url' => ['view', 'id' => $model->ticket_value_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ticket-values-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
