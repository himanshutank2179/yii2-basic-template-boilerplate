<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\fileupload\FileUpload;
use dosamigos\datetimepicker\DateTimePicker;
use app\helper\AppHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Location */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'location_name')->textInput(['maxlength' => true]) ?>

            <?php //$form->field($model, 'location_image')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'hour')->dropDownList(AppHelper::getHours(), ['prompt'=> 'Select Hours']); ?>

            <?= $form->field($model, 'minute')->dropDownList(AppHelper::getMinutes(), ['prompt'=> 'Select Minute']); ?>

            <label>Location Image</label>
            <br>

            <?php
            echo FileUpload::widget([
                'name' => 'Location[location_image]',
                'url' => [
                    '/location/common?attribute=Location[location_image]'
                ],
                'options' => [
                    'accept' => 'image/*',
                ],
                'clientOptions' => [
                    'dataType' => 'json',
                    'maxFileSize' => 2000000,
                ],
                'clientEvents' => [
                    'fileuploadprogressall' => "function (e, data) {
                                        var progress = parseInt(data.loaded / data.total * 100, 10);
                                        $('#progress').show();
                                        $('#progress .progress-bar').css(
                                            'width',
                                            progress + '%'
                                        );
                                     }",
                    'fileuploaddone' => 'function (e, data) {
                                        if(data.result.files.error==""){
                                            
                                            var img = \'<br/><img class="img-responsive" src="' . yii\helpers\BaseUrl::home() . 'uploads/\'+data.result.files.name+\'" alt="img" style="width:256px;"/>\';
                                            $("#profile_pic").html(img);
                                            $("#location-location_image").val(data.result.files.name);$("#progress .progress-bar").attr("style","width: 0%;");
                                            $("#progress").hide();
                                        }
                                        else{
                                           $("#progress .progress-bar").attr("style","width: 0%;");
                                           $("#progress").hide();
                                           var errorHtm = \'<span style="color:#dd4b39">\'+data.result.files.error+\'</span>\';
                                           $("#profile_pic").html(errorHtm);
                                           setTimeout(function(){
                                               $("#profile_pic span").remove();
                                           },3000)
                                        }
                                    }',
                ],
            ]);
            ?>
            <br>
            <div id="progress" class="progress" style="display: none;">
                <div class="progress-bar progress-bar-success"></div>
            </div>
            <div id="profile_pic">
                <?php
                if (!$model->isNewRecord) {
                    ?>
                    <br/><img
                            src="<?php echo yii\helpers\BaseUrl::home() ?>uploads/<?php echo $model->location_image ?>"
                            alt="img" style="width:256px;"/>
                    <?php
                }
                ?>
            </div>
            <?= $form->field($model, 'location_image')->hiddenInput()->label(false); ?>

            <?= $form->field($model, 'day_start_time')->widget(DateTimePicker::className(), [
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
                    'todayBtn' => true]
                ]);
            ?>

            <button class="btn-primary copy-time" >Copy Time</button>

            <?= $form->field($model, 'day_end_time')->widget(DateTimePicker::className(), [
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
                    'todayBtn' => true]
                ]);
            ?>

            <div class="form-group"><br>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
            
        </div>
        <div class="col-md-6"></div>
    </div>

    

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs("
    // $('#copt-btn').click({
    //     console.log('aaa');
    //     let ctime = $('#location-day_start_time').val();
    //     $('#location-day_end_time').val(ctime);
    // });

    $('.copy-time').click(function (e)
    {
        e.preventDefault(e);
        console.log('aaa');
        let ctime = $('#location-day_start_time').val();
        $('#location-day_end_time').val(ctime);
    });
", \yii\web\View::POS_END);
?>