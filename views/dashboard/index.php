<?php
use app\models\Location;
use app\models\TicketValues;
?>
<div class="row">
    <?php
    if($location_data)
    {
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
                                         data-value-time="<?= $location['next_time24'] ?>" data-value-time12="<?= $location['next_time'] ?>" id="<?= $location['location_id'] ?>
                                                " data-location-id="<?= $location['location_id'] ?>" data-location-name="<?= $location['location_name'] ?>">Add</button>
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
                                            </th>
                                            <th>
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
                                        <tr>
                                        <th>
                                            <button class="btn btn-primary add-all"
                                                    data-example-id="<?= $location['location_id'] ?>"> Add All
                                            </button>
                                        </th>
                                        <th>
                                            <button class="btn btn-sm btn-primary" onclick='selectAll("<?= $location['location_id'] ?>")'>Select 
                                                    All
                                            </button>
                                        </th>
                                        <th>
                                            <button class="btn btn-sm btn-primary" onclick='UnSelectAll("<?= $location['location_id'] ?>")'>
                                                    Unselect All
                                            </button>
                                        </th>
                                    </tr>
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


    <?php endforeach; 
}
?>
</div>
<div class="row">
<?php
    $locations = Location::find()->groupBy(['location_id'])->all();
    if($locations):
    foreach ($locations as $key => $location):
        $ticketdata = TicketValues::find()->where(['location_id' => $location->location_id])->orderBy(['ticket_value_id' => SORT_DESC])->limit(20)->all();
        if($location->day_start_time != $location->day_end_time):
        if($ticketdata):?>
        <div class="col-md-4">
            <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">All Numbers : <?= $location->location_name ?></h3>
                        <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                        </div>
                </div>
                <div class="box-body">
                    <label>Select Date</label>
                    <div class="input-group date datepicker" data-provide="datepicker">
                        <input type="text" class="form-control datepicker onchangedate" data-date-end-date="0d" location-id="<?= $location->location_id ?>">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                    <table class="table">
                        <center><caption><?= $location->location_name ?></caption></center>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Number</th>
                            </tr>
                        </thead>
                        <tbody id="locationss-id-<?= $location->location_id ?>">
                            <?php foreach ($ticketdata as $key => $ticket): ?>
                            <tr>
                                <th scope="row"><?= $key+1 ?></th>
                                <td><?= $ticket->date ?></td>
                                <td><?= date("g:i a", strtotime($ticket->time)) ?></td>
                                <td><?= $ticket->ticket_value ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif;
        else:
        if($ticketdata): ?>
        <div class="col-md-4">
            <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">All Numbers : <?= $location->location_name ?></h3>
                        <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                        </div>
                </div>
                <div class="box-body">
                    <label>Select Month</label>
                    <div class="input-group date date-picker" data-provide="datepicker">
                        <input type="text" class="form-control date-picker onchangemonth" data-date-end-date="0d" location-id="<?= $location->location_id ?>">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
        <table class="table">
            <caption><?= $location->location_name ?></caption>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col"><?= $location->location_name.'('.date("g:i a", strtotime($location->day_start_time)).')'; ?></th>
                </tr>
            </thead>
            <tbody id="locationss-id-<?= $location->location_id ?>">
                <?php foreach ($ticketdata as $key => $ticket): ?>
                <tr>
                    <th scope="row"><?= $key+1 ?></th>
                    <td><?= $ticket->date ?></td>
                    <td><?= $ticket->ticket_value ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
            </div>
        </div>

        <?php endif;
    endif;
    endforeach;
    endif;
?>
</div>
<?php
$spurl = \yii\helpers\Url::toRoute('single-data', true);
$save_time_slots_url = \yii\helpers\Url::toRoute('/ws/save-time-slots', true);
$get_notification = \yii\helpers\Url::toRoute('/ws/get-notification', true);
$getByDate = \yii\helpers\Url::toRoute('/ws/get-ticket-data', true);
$this->registerJs("
    $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    });

    $('.date-picker').datepicker( {
    format: 'mm-yyyy',
    viewMode: 'months', 
    minViewMode: 'months',
    });
    $('.onchangedate').on('change',function()
    {
        var date = $(this).val();
        var lid = $(this).attr('location-id');
        if (date != null && date != '')
            {
                $.ajax(
                {
                    url: '$getByDate',
                    type: 'GET', 
                    data:
                    {
                        location_id: lid,
                        bydate: date,
                    },
                    success: function(response)
                    {
                        if(response.status === 404)
                        {
                            $('#locationss-id-'+lid).html('<tr><td colspan=4><h4>No Data Found</h4></td></tr>');
                            console.log(response);
                        }
                        else
                        {
                            var responsedata = '';
                            $('#locationss-id-'+lid).html('');
                            $.each(response.data, function(k,v) {
                                responsedata = '<tr><th scope=row >'+(k+1)+'</th><td>'+v.date+'</td><td>'+v.time+'</td><td>'+v.ticket_value+'</td></tr>';
                                //console.log('sasa ',responsedata);
                                $('#locationss-id-'+lid).append(responsedata);
                            });
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

    $('.onchangemonth').on('change',function()
    {
        var date = $(this).val();
        date = date.split('-');
        var month = date[0];
        var year = date[1];
        var lid = $(this).attr('location-id');
        if (month != null && year != '')
            {
                $.ajax(
                {
                    url: '$getByDate',
                    type: 'GET', 
                    data:
                    {
                        location_id: lid,
                        month: month,
                        year: year,
                    },
                    success: function(response)
                    {
                        if(response.status === 404)
                        {
                            $('#locationss-id-'+lid).html('<tr><td colspan=4><h4>No Data Found</h4></td></tr>');
                        }
                        else
                        {
                            var responsedata = '';
                            $('#locationss-id-'+lid).html('');
                            $.each(response.data, function(k,v) {
                                responsedata = '<tr><th scope=row >'+(k+1)+'</th><td>'+v.date+'</td><td>'+v.ticket_value+'</td></tr>';
                                $('#locationss-id-'+lid).append(responsedata);
                            });
                        }

                    },
                    error: function(xhr)
                    {
                        //Do Something to handle error
                    }
                });
            }
            else{
                alert('please select month and year');
            }
    });

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
                            swal('Number Add', 'Number Already Added', 'success');
                        }
                        else
                        {
                            //$('#ticketvalues-time').val(response.day_start_time);
                            //$('#ticketvalues-time').prop('disabled', true);
                            console.log(response);
                            swal('Good job!', 'Number Added', 'success');
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
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php
$this->registerJs('
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-bottom-left",
      "preventDuplicates": false,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "180000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    // var lname = $(".single-data").attr("data-location-name");
    // var time = $(".single-data").attr("data-value-time12");
    // toastr.info("Please Enter The Number of Location : "+lname, "Next Number Result : "+time);
    
    var ajax_call = function()
    {
        $(".single-data").each(function(){
            var lid = $(this).attr("data-location-id");
            var time = $(this).attr("data-value-time");
            var time12 = $(this).attr("data-value-time12");
            var lname = $(this).attr("data-location-name");
            //var time = "13:50:00";
            var addedtime = moment.utc(time,"HH:mm:ss").subtract(03,"minutes").format("HH:mm:ss");
            var dt = new Date();
            var ctime = dt.getHours() + ":" + dt.getMinutes() + ":00";
            if(ctime === addedtime)
            {
                // alert("popup open");
                toastr.info("Please Enter The Number of Location : "+lname, "Next Number Result : "+time12);
            }
            console.log("subtract time : ",addedtime);
            console.log("current time : ",ctime);
            console.log(lid);
            console.log(time);
            });
    };
    var interval = 1000 * 60 * 1; // where X is your every X minutes
    setInterval(ajax_call, interval);
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
                swal("Good job!", "Number Added", "success");
            }
            });
            	
		});

', \yii\web\View::POS_END);
?>
