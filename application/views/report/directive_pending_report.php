<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Directive</span>
                    <span class="caption-helper">Report</span>
                </div>
            </div>
            <!-- <div class="portlet-body form"> -->
                <!-- <?php
                    // $attributes = array('class' => 'form-horizontal', 'id' => 'report', 'role'=>"form");
                    // echo form_open_multipart(base_url('report/area_report'), $attributes);
                ?> -->
                    <!-- <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date</label>
                            <div class="col-md-4">
                                <select name="year" id="year" class="form-control">
                                    <option value="">Select Year</option>
                                    <?php foreach($year as $y){ ?>
                                    <option value="<?php echo $y; ?>" <?php echo $this->input->post('year')==$y?'selected':''; ?>><?php echo $y; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                                <button type="submit" name="submit" class="btn blue">Submit</button>
                            </div>
                        </div>
                    </div> -->
                <!-- </form> -->
            <!-- </div> -->
            <?php if(count($detail) > 0){ ?>
            <div class="dataTables_length">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th>
                                <i class="fa"></i><b> Regular Number </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Applicant Name </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Year </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Status </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Directive Department </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Directive End Date </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Pending Days </b>
                            </th>
                    </thead>
                    <tbody>
                        <?php foreach($detail as $d) { ?>
                        <tr>
                            <td><?php echo $d['regular_number']; ?></td>

                            <td><?php echo $d['applicant_name']; ?></td>

                            <td><?php echo $d['year']; ?></td>

                            <td><?php echo $d['status']; ?></td>

                            <td><?php echo $d['department']; ?></td>

                            <td><?php echo $d['end_date']; ?></td>

                            <td><?php 
                            // $now = time(); // or your date as well
                            $your_date = strtotime($d['end_date']);
                            $datediff = $your_date - strtotime($date);

                            $pending = abs(round($datediff / 86400));

                            if($pending > 1)
                            {
                                echo $pending;
                            }
                            else
                            {
                                echo "Expire Today";
                            }
                            ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php } ?>
        </div>
    </div>
</div>
