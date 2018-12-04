<?= date('Y-m-d h:i:s'); ?>
<div class="row">
    <?php
    // echo "<pre>";
    // print_r($location_data);

    foreach ($location_data as $key => $location): ?>


        <div class="col-md-4">

            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-blue">
                    <div class="widget-user-image img-responsive">
                        <img class="img-circle" src="<?= $location['location_image'] ?>" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username"><?= $location['location_name'] ?></h3>
                    <h5 class="widget-user-desc">Previous Number: <?= $location['ticket_value'] ?></h5>
                    <h5 class="widget-user-desc">Previous Time: <?= $location['time'] ?></h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Next Upcomming Number time: <?= $next_time = $location['next_time'] ?></a></li>
                        <!--<li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                        <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                        <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>-->
                        <li>
                            <?php //echo ($key != 0) ? 'collapsed-box' : '' ?>
                            <div class="box box-primary collapsed-box" style="background-color: white;">
                                <div class="box-header with-border">
                                    <h3 class="box-title">


                                        <span for="number" class="small"> Enter Value </span>
                                        <div class="input-group input-group-sm">

                                            <input type="text" id="location-id-<?= $location['location_id'] ?>"
                                                   class="form-control" placeholder="Add New number" required>
                                            <span class="input-group-btn">
                                 <button type="submit" class="btn btn-info btn-flat single-data"
                                         data-value-time="<?= $location['next_time24'] ?>"" id="<?= $location['location_id'] ?>
                                                " data-location-id="<?= $location['location_id'] ?>">Add</button>
                               </span>
                                        </div>
                                    </h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>
                                                <button class="btn btn-sm btn-primary"
                                                        onclick='selectAll("<?= $location['location_id'] ?>")'>Select
                                                    All
                                                </button>
                                                <button class="btn btn-sm btn-primary"
                                                        onclick='UnSelectAll("<?= $location['location_id'] ?>")'>
                                                    Unselect All
                                                </button>

                                            </th>

                                        </tr>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        $maxDateInt = 1;
                                        $start = $location['day_start_time'];
                                        $end = $location['day_end_time'];
                                        $durationH = $location['hour'];
                                        $durationM = $location['minute'];
                                        $newTime = date('H:i:s', strtotime($start));
                                        $tr = '';
                                        ?>
                                        <?php for ($i = 1; $i <= $maxDateInt; $i++): ?>
                                            <?php

                                            $inputTd = '<td>
                                                    <input
                                                            type="text"
                                                            class="form-control ' . $location['location_id'] . '"
                                                            name=""
                                                            data-value-time="' . $newTime . '"
                                                            data-location-id="' . $location['location_id'] . '"
                                                    >
                                                </td><td> <input type="checkbox" name="' . $location['location_id'] . '"> </td>';

                                            $isRecordAvailable = \app\models\TicketValues::find()
                                                ->where(['date(date)' => date('Y-m-d')])
                                                ->andWhere(['time(time)' => date('H:i:s', strtotime($newTime))])
                                                ->andWhere(['location_id' => $location['location_id']])
                                                ->one();

                                            if ($isRecordAvailable) {
                                                $inputTd = '<td>
                                                    <input
                                                            type="text"
                                                            class="form-control ' . $location['location_id'] . '"
                                                            name=""
                                                            value = "' . $isRecordAvailable->ticket_value . '"
                                                            data-value-time="' . $newTime . '"
                                                            data-location-id="' . $location['location_id'] . '"
                                                            disabled
                                                    >
                                                </td><td> <input type="checkbox" checked disabled> </td>';
                                            }

                                            ?>
                                            <tr>
                                                <th scope="row"><?= $i ?></th>
                                                <td><?= date("g:i a", strtotime($newTime)) ?></td>

                                                <?= $inputTd ?>


                                            </tr>
                                            <?php if (date('H:i:s', strtotime($newTime)) < date('H:i:s', strtotime($end))): ?>
                                                <?php $newTime = date('H:i:s', strtotime('+' . $durationH . ' hour +' . $durationM . ' minutes', strtotime($newTime))); ?>

                                                <?php $maxDateInt++; ?>
                                            <?php else: ?>
                                                <?php $maxDateInt = -1; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        </tbody>
                                        <tfoot>
                                        <th>
                                            <button class="btn btn-primary add-all"
                                                    data-example-id="<?= $location['location_id'] ?>"> Add All
                                            </button>
                                        </th>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="box-footer">

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>


        </div>


    <?php endforeach; ?>
</div>

<?php
$spurl = \yii\helpers\Url::toRoute('single-data', true);
$save_time_slots_url = \yii\helpers\Url::toRoute('/ws/save-time-slots', true);
$this->registerJs("
    $('.single-data').click(function ()
        {
            //event.preventDefault();
            var lid = $(this).attr('data-location-id');
            var time = $(this).attr('data-value-time');
            var nvalue = $('#'+'location-id-'+lid).val();
            if (nvalue != null && nvalue != '')
            {
                console.log(lid,time,nvalue);
                $.ajax(
                {
                    url: '$spurl',
                    type: 'GET', 
                    data:
                    {
                        location_id: lid,
                        time: time,
                        value: nvalue,
                    },
                    success: function(response)
                    {
                        if(response == false || response == 0)
                        {
                            // $('#ticketvalues-time').prop('disabled', false);
                            console.log(response);
                        }
                        else
                        {
                            //$('#ticketvalues-time').val(response.day_start_time);
                            //$('#ticketvalues-time').prop('disabled', true);
                            console.log(response);
                        }
                    },
                    error: function(xhr)
                    {
                        //Do Something to handle error
                    }
                });
            }
            else{
                alert('please enter number');
            }
        });
", \yii\web\View::POS_END);
?>

<?php
$this->registerJs('
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-bottom-left",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    
    toastr.info("Info Message", "' . date('Y-m-d H:i:s') . '");

', \yii\web\View::POS_END);
$this->registerJs('
    
			function selectAll(name){
				var items=document.getElementsByName(name);
				for(var i=0; i<items.length; i++){
					if(items[i].type=="checkbox")
						items[i].checked=true;
				}
			}
			
			function UnSelectAll(name){
				var items=document.getElementsByName(name);
				for(var i=0; i<items.length; i++){
					if(items[i].type=="checkbox")
						items[i].checked=false;
				}
			}		
		

', \yii\web\View::POS_END);
$this->registerJs('
    
		
		$(".add-all").on("click",function(){
		
		    var className = $(this).attr("data-example-id");
		
		    var inputs = $("." + className);
		    var values = [];
		    var times = [];
		    var locations = [];
		    for(var i = 0; i < inputs.length; i++){
		        if($(inputs[i]).val()){
		            values.push($(inputs[i]).val());
		            times.push($(inputs[i]).attr("data-value-time"));
		            locations.push($(inputs[i]).attr("data-location-id"));		            
		        }
                
            }	            
            
            
            $.ajax(
            {
            type: "POST",
            url: "' . $save_time_slots_url . '",
            data: {
                "values": values,
                "times": times,
                "locations": locations
            },
            success: function (res)
            {
                if(res){
                    for(var i = 0; i < inputs.length; i++){
                        if($(inputs[i]).val()){
                            $(inputs[i]).attr("disabled",true);		                                                                                                                                                             		            
                        }                        
                    }                    
                   
                }   
            }
            });
            	
		});

', \yii\web\View::POS_END);
?>
