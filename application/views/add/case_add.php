<script src="<?php echo base_url('resources/frontend'); ?>/js/chosen/chosen/chosen.jquery.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/frontend'); ?>/js/chosen/chosen/chosen.min.css">
<script type="text/javascript">
    $(document).ready(function(){
        $('#applicant').chosen({width:'324px',disable_search_threshold: 10});
        $('#advocates').chosen({width:'324px',disable_search_threshold: 10});
        $('#respondent').chosen({width:'324px',disable_search_threshold: 10});
    });
</script>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Case</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
              
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form");
                    echo form_open_multipart(base_url('cases/add'), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Case Type :</label>
                            <div class="col-md-4">
                                <select name="case_type" id="case_type" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($case_type as $ct) { ?>
                                    <option value="<?php echo $ct['case_name'] ?>"><?php echo $ct['case_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Regular Number :</label>
                            <div class="col-md-4">
                                <input type="text" name="regular_number" id="regular_number" class="form-control">
                            </div>

                            <label class="col-md-2 control-label">Lodging Number :</label>
                            <div class="col-md-4">
                                <input type="text" name="lodging_number" id="lodging_number" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Date :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control datepicker" name="filling_date" id="filling_date" readonly placeholder="dd/mm/yyyy">

                                <!-- <select name="year" id="year" class="form-control">
                                    <option value="">Select Year</option>
                                    <?php foreach($year as $y){ ?>
                                    <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                    <?php } ?>
                                </select> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Concern Department :</label>
                            <div class="col-md-4">
                                <select name="department_name" id="department_name" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($department as $ct) { ?>
                                    <option value="<?php echo $ct['department_name'] ?>"><?php echo $ct['department_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">Bench :</label>
                            <div class="col-md-4">
                                <select name="bench" id="bench" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($bench as $be) { ?>
                                    <option value="<?php echo $be['bench_name'] ?>"><?php echo $be['bench_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Complaint Details :</label>
                            <div class="col-md-4">
                                <select name="complaint_detail" id="complaint_detail" class="form-control">
                                    <option value="text">text</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Applicant/Appellant :</label>
                            <div class="col-md-4">
                                <select name="applicant_name[]" id="applicant" multiple="multiple">
                                    <?php foreach($applicant as $app) { ?>
                                    <option value="<?php echo $app['applicant_name'] ?>"><?php echo $app['applicant_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">Applicant Advocates :</label>
                            <div class="col-md-4">
                                <select name="advocate_name"  class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($advocate as $adv) { ?>
                                    <option value="<?php echo $adv['advocate_name'] ?>"><?php echo $adv['advocate_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Respondent :</label>
                            <div class="col-md-4">
                                <select name="respondent_name[]" id="respondent" multiple="multiple" class="form-control">
                                    <?php foreach($respondent as $res) { ?>
                                    <option value="<?php echo $res['respondent_name'] ?>"><?php echo $res['respondent_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">Society :</label>
                            <div class="col-md-4">
                                <select name="society" id="society" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($society as $sty) { ?>
                                    <option value="<?php echo $sty['society_name'] ?>"><?php echo $sty['society_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Status :</label>
                            <div class="col-md-4">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Disposed">Disposed</option>
                                    <option value="Close for order">Close for order</option>
                                    <option value="Dismissed">Dismissed</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">CTS No :</label>
                            <div class="col-md-4">
                                <select name="cts_no" id="cts_no" class="form-control">
                                    <option value="Select">Select</option>
                                    <?php foreach($ctsno as $cts) { ?>
                                    <option value="<?php echo $cts['cts_number'] ?>"><?php echo $cts['cts_number'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Area :</label>
                            <div class="col-md-4">
                                <select name="area" id="area" class="form-control">
                                    <option value="Select">Select</option>
                                    <?php foreach($area as $a) { ?>
                                    <option value="<?php echo $a['name'] ?>"><?php echo $a['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">Village :</label>
                            <div class="col-md-4">
                                <select name="village" id="village" class="form-control">
                                    <option value="Select">Select</option>
                                    <?php foreach($village as $v) { ?>
                                    <option value="<?php echo $v['village_name'] ?>"><?php echo $v['village_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Discription of Property :</label>
                            <div class="col-md-10">
                                <textarea name="description" class="form-control" rows="3"></textarea>
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
        </div>
    </div>
</div>

<script type="text/javascript">


    $(document).ready(function () {
        $("#add").validate({
            rules: {
                'case_type': "required",
                'regular_number': "required",
                'lodging_number': "required",
                'filling_date': "required",
                'department_name': "required",
                'bench': "required",
                'complaint_detail': "required",
                'applicant_name': "required",
                'advocate_name': "required",
                'respondent_name': "required",
                'status': "required",
                'cts_no': "required",
                'area': "required",
                'village': "required"
            },
            messages: {
                'case_type': "<span style='color: #FF0000;'>Please Select Case Type</span>",
                'regular_number': "<span style='color: #FF0000;'>Please Enter Regular Name</span>",
                'lodging_number': "<span style='color: #FF0000;'>Please Enter Lodging Number</span>",
                'filling_date': "<span style='color: #FF0000;'>Please Select Date</span>",
                'department_name': "<span style='color: #FF0000;'>Please Select Department</span>",
                'bench': "<span style='color: #FF0000;'>Please Select Bench</span>",
                'complaint_detail': "<span style='color: #FF0000;'>Please Select Complaint Detail</span>",
                'applicant_name': "<span style='color: #FF0000;'>Please Select Applicant Name</span>",
                'advocate_name': "<span style='color: #FF0000;'>Please Select Advocate Name</span>",
                'respondent_name': "<span style='color: #FF0000;'>Please Select Respondent Name</span>",
                'status': "<span style='color: #FF0000;'>Please Select Status</span>",
                'cts_no': "<span style='color: #FF0000;'>Please Enter CTS No</span>",
                'area': "<span style='color: #FF0000;'>Please Enter Area Name</span>",
                'village': "<span style='color: #FF0000;'>Please Enter Village Name</span>"
            }
         });
    });

</script>