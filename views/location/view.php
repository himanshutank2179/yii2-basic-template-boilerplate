<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Location */

$this->title = $model->location_name;
$this->params['breadcrumbs'][] = ['label' => 'Location', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->location_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->location_id], [
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
            // 'location_id',
            'location_name',
            // 'location_image',
            [
                'attribute' => 'location_image',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@web') . '/uploads/' . $data['location_image'], ['width' => '200px', 'class' => 'img-thumbnail']);
                },
            ],
            'hour',
            'minute',
            'day_start_time',
            'day_end_time',
            // 'created_at',
        ],
    ]) ?>

</div>
