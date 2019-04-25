 <script>
jQuery(document).ready(function(){
    
    "use strict";
  // Date Picker
  jQuery('.datepicker').datepicker({
          dateFormat: 'yy-mm-dd'
      });
  
});
</script>
<style type="text/css">
    .custom-file-upload {
  border: 1px solid #ccc;
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
}
</style>
<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Minutes</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
              
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form");
                    echo form_open_multipart(base_url('minutes/add'), $attributes);
                ?>
                <input type="hidden" name="case_id" value="<?php echo $case_id; ?>">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Case type :</label>
                            <div class="col-md-4">
                                <label id="label" for="file-upload" class="custom-file-upload form-control">
                                    <i class="fa fa-cloud-upload"></i> Upload File
                                </label>
                                <input id="file-upload" name='file' type="file" style="display:none;">
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label class="col-md-3 control-label">Year :</label>
                            <div class="col-md-4">
                                <select name="year" id="year" class="form-control">
                                    <option value="">Select Year</option>
                                    <?php foreach($year as $y){ ?>
                                    <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="col-md-3 control-label">Date :</label>
                            <div class="col-md-4">
                                <input type="text" name="date" class="form-control datepicker" readonly placeholder="Select Date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Status :</label>
                            <div class="col-md-4">
                                <select name="status" id="status" class="form-control">
                                    <option value="Select">Select</option>
                                    <option value="Close for order">Close for order</option>
                                    <option value="Pending">Pending</option>
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
        </div>
    </div>
</div>
<script type="text/javascript">


    $(document).ready(function () {
        $("#add").validate({
            rules: {
                'order_file': "required",
                'status': "required",
                'year': "required"
            },
            messages: {
                'order_file': "<span style='color: #FF0000;'>Please Select File</span>",
                'status': "<span style='color: #FF0000;'>Please Select Status</span>",
                'year': "<span style='color: #FF0000;'>Please Select Year</span>"
            }
         });

        $('#file-upload').change(function() {
            var i = $(this).prev('#label').clone();
            var file = $('#file-upload')[0].files[0].name;
            $(this).prev('#label').text(file);
        });
    });

</script>