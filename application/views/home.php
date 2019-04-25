
<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-green-haze bold uppercase">Dashboard</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body av">
                <h3 class="bold" style="margin-left: 10px;">Case Uploaded in last 10 days</h5>
                <div class="dataTables_length">
                    <table class="table table-striped table-bordered table-advance table-hover" id="item_list">
                        <thead>
                            <tr>
                                <th>
                                    <i class="fa"></i><b> # </b>
                                </th>
                                <th>
                                    <i class="fa"></i><b> Regular Number </b>
                                </th>
                                <th>
                                    <i class="fa"></i><b> Applicant Name </b>
                                </th>
                                <th>
                                    <i class="fa"></i><b> Date </b>
                                </th>
                                <th>
                                    <i class="fa "></i><b> Status </b>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($last_cases) > 0) { ?>
                            <?php $count = 1; ?>
                            <?php foreach($last_cases as $lc) { ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $lc['regular_number']; ?></td>
                                    <td><?php echo $lc['applicant_name']; ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($lc['filling_date'])); ?></td>
                                    <td><?php echo $lc['status']; ?></td>
                                </tr>
                            <?php $count = $count + 1; } } else { ?>
                                <tr><td colspan="5" align="center">No Record Found</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="portlet-body av">
                <h3 class="bold" style="margin-left: 10px;">Directive Status</h5>
                <div class="dataTables_length">
                    <table class="table table-striped table-bordered table-advance table-hover" id="item_list">
                        <thead>
                            <tr>
                                <th>
                                    <i class="fa"></i><b> # </b>
                                </th>
                                <th>
                                    <i class="fa"></i><b> Regular Number </b>
                                </th>
                                <th>
                                    <i class="fa"></i><b> Applicant Name </b>
                                </th>
                                <th>
                                    <i class="fa"></i><b> Status </b>
                                </th>
                                <th>
                                    <i class="fa "></i><b> End Date </b>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($directive) > 0) { ?>
                            <?php $count = 1; ?>
                            <?php foreach($directive as $d) { ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $d['regular_number']; ?></td>
                                    <td><?php echo $d['applicant_name']; ?></td>
                                    <td><?php echo $d['status']; ?></td>
                                    <td><?php echo $d['end_date']; ?></td>
                                </tr>
                            <?php $count = $count + 1; } } else { ?>
                                <tr><td colspan="5" align="center">No Record Found</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>