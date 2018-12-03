<div class="row">
    <?php
    // echo "<pre>";
    // print_r($location_data);

    foreach ($location_data as $key => $location): ?>


        <div class="col-md-4">

            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                    <div class="widget-user-image img-responsive">
                        <img class="img-circle" src="<?= $location['location_image'] ?>" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username"><?= $location['location_name'] ?></h3>
                    <h5 class="widget-user-desc">Lead Developer</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                        <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                        <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                        <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
                    </ul>
                </div>
            </div>

            <?php //echo ($key != 0) ? 'collapsed-box' : '' ?>
            <div class="box box-primary collapsed-box" style="background-color: white;">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <P><label>Location : </label><label><?= $location['location_name'] ?></label></P>
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <p>Previous Value: 53</p>
                                <p>Previous Time: 01-12-2018 9:00 AM</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>

                        <span for="number" class="small">Please Enter Value For : 01-12-2018 9:15 AM</span>
                        <div class="input-group input-group-sm">

                            <input type="number" class="form-control" placeholder="Add New number">
                            <span class="input-group-btn">
                                 <button type="button" class="btn btn-info btn-flat">Add</button>
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
                            <th scope="col">#</th>
                            <th scope="col">Time</th>
                            <th scope="col">Number</th>
                            <th scope="col">&nbsp;</th>
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
                            <tr>
                                <th scope="row">1</th>
                                <td><?= $newTime ?></td>
                                <td><input type="text" class="form-control" name="number"></td>
                                <td><input type="checkbox" name="name" checked></td>
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
                            <button class="btn btn-primary">Save All</button>
                        </th>
                        </tfoot>
                    </table>
                </div>
                <div class="box-footer">

                </div>
            </div>
        </div>


    <?php endforeach; ?>
</div>