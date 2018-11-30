<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TicketValues */

$this->title = 'Create Ticket Value';
$this->params['breadcrumbs'][] = ['label' => 'Ticket Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-values-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
