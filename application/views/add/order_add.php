<script src="<?php echo base_url('resources/frontend'); ?>/js/chosen/chosen/chosen.jquery.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/frontend'); ?>/js/chosen/chosen/chosen.min.css">
<script type="text/javascript">
    $(document).ready(function(){
        $('#applicant').chosen({width:'324px',disable_search_threshold: 10});
        $('#advocates').chosen({width:'324px',disable_search_threshold: 10});
        $('#respondent').chosen({width:'324px',disable_search_threshold: 10});
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
                    echo form_open_multipart(base_url('order/add'), $attributes);
                ?>
                <input type="hidden" name="case_id" value="<?php echo $case_id; ?>">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Case Type :</label>
                            <div class="col-md-4">
                                <label id="label" for="file-upload" class="custom-file-upload form-control">
                                    <i class="fa fa-cloud-upload"></i> Upload Image
                                </label>
                                <input id="file-upload" name='file' type="file" style="display:none;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Date :</label>
                            <div class="col-md-4">
                                <input type="text" name="date" class="form-control datepicker" placeholder="Select Date" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Status :</label>
                            <div class="col-md-4">
                                <select name="status" id="status" class="form-control">
                                    <option value="Select">Select</option>
                                    <option value="Disposed">Disposed</option>
                                    <option value="Dismissed">Dismissed</option>
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