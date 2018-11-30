<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helper\AppHelper;
use app\models\Location;
use dosamigos\datetimepicker\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\TicketValues */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-values-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'location_id')->dropDownList(AppHelper::getLocations(), ['prompt'=> 'Select Location']); ?>

    <?= $form->field($model, 'ticket_value')->textInput() ?>

    <?= $form->field($model, 'time')->widget(DateTimePicker::className(), [
    'language' => Yii::$app->language,
    'size' => 'ms',
    'template' => '{input}',
    'pickButtonIcon' => 'glyphicon glyphicon-time',
    // 'inline' => true,
    'clientOptions' => [
        // 'autoclose' => true,
        'startView' => 1,
        'minView' => 0,
        'maxView' => 1,
        'autoclose' => true,
        //'linkFormat' => 'HH:ii P', // if inline = true
        'format' => 'h:i', // if inline = false
        'todayBtn' => true
    ]
]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
