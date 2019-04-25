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
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Cause List</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
              
               <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form" ,'enctype' => 'multipart/form-data');
                    echo form_open_multipart(base_url('cause/add'), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Cause List</label>
                            <div class="col-md-4">
                                <label id="label" for="file-upload" class="custom-file-upload form-control">
                                    <i class="fa fa-cloud-upload"></i> Upload Image
                                </label>
                                <input id="file-upload" name='file' type="file" style="display:none;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Date</label>
                            <div class="col-md-4">
                            <input type="text" name="date" id="date" class="form-control datepicker" readonly placeholder="yyyy-mm-dd">
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
                'name': "required",
                'status' : "required"
            },
            messages: {
                'name': "<span style='color: #FF0000;'>Please Enter Area Name</span>",
                'status': "<span style='color: #FF0000;'>Please Select Status</span>"
            }
         });

        $('#file-upload').change(function() {
            var i = $(this).prev('#label').clone();
            var file = $('#file-upload')[0].files[0].name;
            $(this).prev('#label').text(file);
        });

    });

</script>