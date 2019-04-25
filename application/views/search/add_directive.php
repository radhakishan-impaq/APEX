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
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Directive</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
              
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form");
                    echo form_open_multipart(base_url('directive/add'), $attributes);
                ?>
                <input type="hidden" name="case_id" value="<?php echo $case_id; ?>">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Department :</label>
                            <div class="col-md-4">
                                <select name="department" id="department" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($department as $d) { ?>
                                    <option value="<?php echo $d['department_name']; ?>"><?php echo $d['department_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Start Date :</label>
                            <div class="col-md-4">
                                <input type="text" name="start_date" id="start_date" readonly class="form-control datepicker" placeholder="Select Start Date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Duration :</label>
                            <div class="col-md-4">
                                <input type="text" name="duration" id="duration" class="form-control" placeholder="Enter Duration">
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-md-3 control-label">End Date :</label>
                            <div class="col-md-4">
                                <input type="text" name="end_date" id="end_date" readonly class="form-control datepicker" placeholder="Select End Date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Subject :</label>
                            <div class="col-md-4">
                                <textarea name="subject" id="subject" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Body :</label>
                            <div class="col-md-4">
                                <textarea name="body" id="body" class="form-control"></textarea>
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
                'department': "required",
                'start_date': "required",
                'duration': "required",
                'end_date': "required",
                'subject': "required",
                'body': "required"
            },
            messages: {
                'department': "<span style='color: #FF0000;'>Please Select Department Name</span>",
                'start_date': "<span style='color: #FF0000;'>Please Select Start Date</span>",
                'duration': "<span style='color: #FF0000;'>Please Enter Duration</span>",
                'end_date': "<span style='color: #FF0000;'>Please Select End Date</span>"
            }
         });
    });

</script>