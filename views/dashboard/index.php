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
    					<P><label>Location : </label><label><?= $location['location_name'] ?></label></P>
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
  					<center><h4><label>Location : </label><label><?= $location['location_name'] ?></label></h4></center>
  					<table class="table">
						  <thead class="thead-dark">
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Time</th>
						      <th scope="col">Number</th>
						      <th scope="col">&nbsp;</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th scope="row">1</th>
						      <td>09:00 AM</td>
						      <td><input type="text" class="form-control" name="number"></td>
						      <td><input type="checkbox" name="name" checked></td>
						    </tr>
						    <tr>
						      <th scope="row">2</th>
						      <td>09:15 AM</td>
						      <td><input type="text" class="form-control" name="number"></td>
						      <td><input type="checkbox" name="name" checked></td>
						    </tr>
						    <tr>
						      <th scope="row">3</th>
						      <td>09:30 AM</td>
						      <td><input type="text" class="form-control" name="number"></td>
						      <td><input type="checkbox" name="name" checked></td>
						    </tr>
						    <tr>
						      <th scope="row">4</th>
						      <td>09:45 AM</td>
						      <td><input type="text" class="form-control" name="number"></td>
						      <td><input type="checkbox" name="name" checked></td>
						    </tr>
						    <tr>
						      <th scope="row">5</th>
						      <td>10:00 AM</td>
						      <td><input type="text" class="form-control" name="number"></td>
						      <td><input type="checkbox" name="name" checked></td>
						    </tr>
						  </tbody>
						  <tfoot>
						  	<th><button class="btn btn-primary">Save All</button></th>
						  	<th></th>
						  	<th></th>
						  	<th></th>						  	
						  </tfoot>
						</table>
  				</div>
			  <div class="box-footer">
			    The footer of the box
			  </div>
			</div>
		 </div>
	<?php endforeach; ?>
</div>