<div class="row">
	<?php
	// echo "<pre>";
	// print_r($location_data);

	foreach ($location_data as $key => $location): ?>
		<div class="col-md-4">
			<?php //echo ($key != 0) ? 'collapsed-box' : '' ?>
			<div class="box box-primary collapsed-box" style="background-color: white;">
  				<div class="box-header with-border">
    				<h3 class="box-title">
    					<P><label>Loccation : </label><label><?= $location['location_name'] ?></label></P>
	  					<P><label>Date : </label><label><?= $location['date'] ?></label></P>
	  					<P><label>Time : </label><label><?= $location['time'] ?></label></P>
						<P><label>Previous No : </label><label><?= $location['ticket_value'] ?></label></P>
    				</h3>
    				<div class="box-tools pull-right">
		      			<button type="button" class="btn btn-box-tool" data-widget="collapse">
		        			<i class="fa fa-plus"></i>
		      			</button>
    				</div>
  				</div>
  				<div class="box-body" >
  					<input type="number" name="ticket-number-<?= $location['location_id'] ?>" placeholder="Enter Next Number">
  				</div>
			  <div class="box-footer">
			    The footer of the box
			  </div>
			</div>
		 </div>
	<?php endforeach; ?>
</div>