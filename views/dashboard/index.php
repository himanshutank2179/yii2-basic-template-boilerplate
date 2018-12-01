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
                    <div class="box-body">
                        <center><h4><label>Location : </label><label><?= $location['location_name'] ?></label></h4>
                        </center>
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