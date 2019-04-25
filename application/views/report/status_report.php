<script>
jQuery(document).ready(function(){
    
    "use strict";
  // Date Picker
  jQuery('.datepicker').datepicker({
          dateFormat: 'yy-mm-dd'
      });
  
});
</script>
<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Status</span>
                    <span class="caption-helper">Report</span>
                </div>
            </div>
            <div class="portlet-body form">
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'report', 'role'=>"form");
                    echo form_open_multipart(base_url('report/status_report'), $attributes);
                ?>
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-3 control-label">Start Date :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control datepicker" name="start_date" id="start_date" readonly placeholder="dd/mm/yyyy" value="<?php echo $this->input->post('start_date'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">End Date :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control datepicker" name="end_date" id="end_date" readonly placeholder="dd/mm/yyyy" value="<?php echo $this->input->post('end_date'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-4">
                                <select class="form-control" name="status" required>
                                    <option value="">Select</option>
                                    <option value="Disposed" <?php echo $this->input->post('status')=='Disposed'?'selected':''; ?>>Disposed</option>
                                    <option value="Close for order" <?php echo $this->input->post('status')=='Close for order'?'selected':''; ?>>Close for order</option>
                                    <option value="Dismissed" <?php echo $this->input->post('status')=='Dismissed'?'selected':''; ?>>Dismissed</option>
                                    <option value="Pending" <?php echo $this->input->post('status')=='Pending'?'selected':''; ?>>Pending</option>
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
                    </div>
                </form>
            </div>
            <?php if($record_found == 'asdfasdf') { ?>
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
                                <i class="fa"></i><b> Date </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Status </b>
                            </th>
                    </thead>
                    <tbody>
                        <?php foreach($detail as $d) { ?>
                        <tr>
                            <td><?php echo $d['regular_number']; ?></td>

                            <td><?php echo $d['applicant_name']; ?></td>

                            <td><?php echo $d['filling_date']; ?></td>

                            <td><?php echo $d['status']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php } else { ?>
            <h3>No Record Found.</h3>
            <?php } } ?>
        </div>
    </div>
</div>
<script type="text/javascript">


    $(document).ready(function () {
        $("#report").validate({
            rules: {
                'start_date': "required",
                'end_date': "required",
                'status' : "required"
            },
            messages: {
                'start_date': "<span style='color: #FF0000;'>Please Select Date</span>",
                'end_date': "<span style='color: #FF0000;'>Please Select Date</span>",
                'status': "<span style='color: #FF0000;'>Please Select Status</span>"
            }
         });
    });

</script>