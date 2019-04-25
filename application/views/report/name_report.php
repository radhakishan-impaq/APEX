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
                    <span class="caption-subject font-red-sunglo bold uppercase">By Name</span>
                    <span class="caption-helper">Report</span>
                </div>
            </div>
            <div class="portlet-body form">
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'report', 'role'=>"form");
                    echo form_open_multipart(base_url('report/name_report'), $attributes);
                ?>
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-3 control-label">Case Type :</label>
                            <div class="col-md-4">
                                <select name="case_type" id="case_type" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($case_type as $ct) { ?>
                                    <option value="<?php echo $ct['case_name']; ?>" <?php echo $this->input->post('case_type')==$ct['case_name']?'selected':''; ?>><?php echo $ct['case_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Society Name :</label>
                            <div class="col-md-4">
                                <select name="society_name" id="society_name" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($society_name as $s) { ?>
                                    <option value="<?php echo $s['society_name']; ?>" <?php echo $this->input->post('society_name')==$s['society_name']?'selected':''; ?>><?php echo $s['society_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Applicant Name :</label>
                            <div class="col-md-4">
                                <select name="applicant" id="applicant" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($applicant as $a) { ?>
                                    <option value="<?php echo $a['applicant_name']; ?>" <?php echo $this->input->post('applicant')==$a['applicant_name']?'selected':''; ?>><?php echo $a['applicant_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Year</label>
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
                                <i class="fa"></i><b> Society Name </b>
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
                    </thead>
                    <tbody>
                        <?php foreach($detail as $d) { ?>
                        <tr>
                            <td><?php echo $d['regular_number']; ?></td>

                            <td><?php echo $d['society']; ?></td>

                            <td><?php echo $d['applicant_name']; ?></td>

                            <td><?php echo $d['year']; ?></td>

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
                'case_type': "required",
                'society_name': "required",
                'applicant': "required",
                'year' : "required"
            },
            messages: {
                'case_type': "<span style='color: #FF0000;'>Please Select Case Type</span>",
                'society_name': "<span style='color: #FF0000;'>Please Select Society Name</span>",
                'applicant': "<span style='color: #FF0000;'>Please Select Applicant Name</span>",
                'year': "<span style='color: #FF0000;'>Please Select Year</span>"
            }
         });
    });

</script>