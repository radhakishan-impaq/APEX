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
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Edit Case</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add');
                    echo form_open_multipart(base_url('cases/edit/'.$id), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Case Type :</label>
                            <div class="col-md-4">
                                <select name="case_type" id="case_type" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($case_type as $ct) { ?>
                                    <option value="<?php echo $ct['case_name'] ?>" <?php echo $case_detail[0]['case_type']==$ct['case_name']?'selected':'' ?>><?php echo $ct['case_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Regular Number :</label>
                            <div class="col-md-4">
                                <input type="text" name="regular_number" id="regular_number" class="form-control" value="<?php echo $case_detail[0]['regular_number']; ?>">
                            </div>

                            <label class="col-md-2 control-label">Lodging Number :</label>
                            <div class="col-md-4">
                                <input type="text" name="lodging_number" id="lodging_number" class="form-control" value="<?php echo $case_detail[0]['lodging_number']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Date :</label>
                            <div class="col-md-4">
                                <!-- <select name="year" id="year" class="form-control">
                                    <option value="">Select Year</option>
                                    <?php foreach($year as $y){ ?>
                                    <option value="<?php echo $y; ?>" <?php echo $case_detail[0]['year']==$y?'selected':''; ?>><?php echo $y; ?></option>
                                    <?php } ?>
                                </select> -->
                                <input type="text" class="form-control datepicker" name="filling_date" id="filling_date" readonly placeholder="dd/mm/yyyy" value="<?php echo $case_detail[0]['filling_date']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Concern Department :</label>
                            <div class="col-md-4">
                                <select name="department_name" id="department_name" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($department as $ct) { ?>
                                    <option value="<?php echo $ct['department_name'] ?>" <?php echo $case_detail[0]['department_name']==$ct['department_name']?'selected':'' ?>><?php echo $ct['department_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">Bench :</label>
                            <div class="col-md-4">
                                <select name="bench" id="bench" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($bench as $be) { ?>
                                    <option value="<?php echo $be['bench_name'] ?>" <?php echo $case_detail[0]['bench']==$be['bench_name']?'selected':'' ?>><?php echo $be['bench_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Complaint Details :</label>
                            <div class="col-md-4">
                                <select name="complaint_detail" id="complaint_detail" class="form-control">
                                    <option value="">Select</option>
                                    <option value="text" <?php echo $case_detail[0]['complaint_detail']=='text'?'selected':'' ?>>text</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Applicant/Appellant :</label>
                            <div class="col-md-4">
                                <select name="applicant_name[]" id="applicant" multiple="multiple">
                                    <?php foreach($applicant as $us) { ?>
                                    <option value="<?php echo $us['applicant_name'] ?>"
                                    <?php foreach ($app_res_detail as $ard) {
                                        echo $ard['applicant_name']==$us['applicant_name']?'selected':''; } ?>
                                    ><?php echo $us['applicant_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">Applicant Advocates :</label>
                            <div class="col-md-4">
                                <select name="advocate_name"  class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($advocate as $adv) { ?>
                                    <option value="<?php echo $adv['advocate_name'] ?>" <?php echo $case_detail[0]['advocate_name']==$adv['advocate_name']?'selected':'' ?>><?php echo $adv['advocate_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Respondent :</label>
                            <div class="col-md-4">
                                <select name="respondent_name[]" id="respondent" multiple="multiple" class="form-control">
                                    <?php foreach($respondent as $us) { ?>
                                    <option value="<?php echo $us['respondent_name'] ?>" <?php foreach ($app_res_detail as $ard) {
                                        echo $ard['respondent_name']==$us['respondent_name']?'selected':''; } ?>><?php echo $us['respondent_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">Society :</label>
                            <div class="col-md-4">
                                <select name="society" id="society" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($society as $sty) { ?>
                                    <option value="<?php echo $sty['society_name'] ?>" <?php echo $case_detail[0]['society']==$sty['society_name']?'selected':''; ?>><?php echo $sty['society_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Status :</label>
                            <div class="col-md-4">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Disposed" <?php echo $case_detail[0]['status']=='Disposed'?'selected':''; ?>>Disposed</option>
                                    <option value="Close for order" <?php echo $case_detail[0]['status']=='Close for order'?'selected':''; ?>>Close for order</option>
                                    <option value="Dismissed" <?php echo $case_detail[0]['status']=='Dismissed'?'selected':''; ?>>Dismissed</option>
                                    <option value="Pending" <?php echo $case_detail[0]['status']=='Pending'?'selected':''; ?>>Pending</option>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">CTS No :</label>
                            <div class="col-md-4">
                                <select name="cts_no" id="cts_no" class="form-control">
                                    <option value="Select">Select</option>
                                    <?php foreach($ctsno as $cts) { ?>
                                    <option value="<?php echo $cts['cts_number'] ?>" <?php echo $case_detail[0]['cts_no']==$cts['cts_number']?'selected':''; ?>><?php echo $cts['cts_number'] ?></option>
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
                                    <option value="<?php echo $a['name'] ?>" <?php echo $case_detail[0]['area']==$a['name']?'selected':''; ?>><?php echo $a['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">Village :</label>
                            <div class="col-md-4">
                                <select name="village" id="village" class="form-control">
                                    <option value="Select">Select</option>
                                    <?php foreach($village as $v) { ?>
                                    <option value="<?php echo $v['village_name'] ?>" <?php echo $case_detail[0]['village']==$v['village_name']?'selected':''; ?>><?php echo $v['village_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Discription of Property :</label>
                            <div class="col-md-10">
                                <textarea name="description" class="form-control" rows="3"><?php echo $case_detail[0]['description']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-4">
                                <button type="submit" class="btn green">Update</button>
                                <button type="reset" class="btn default">Reset</button>
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