<script>
jQuery(document).ready(function(){

    "use strict";
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Edit Directive Status</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
              
               <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form" ,'enctype' => 'multipart/form-data');
                    echo form_open_multipart(base_url('directive/edit/'.$id), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="case_id" value="<?php echo $detail[0]['case_id']; ?>">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Select Status :</label>
                        <div class="col-md-4">
                            <select name="status" id="status" class="form-control">
                                <option value="">Select</option>
                                <option value="Disposed" <?php echo $detail[0]['status']=='Disposed'?'selected':''; ?>>Disposed</option>
                                <option value="Close for order" <?php echo $detail[0]['status']=='Close for order'?'selected':''; ?>>Close for order</option>
                                <option value="Dismissed" <?php echo $detail[0]['status']=='Dismissed'?'selected':''; ?>>Dismissed</option>
                                <option value="Pending" <?php echo $detail[0]['status']=='Pending'?'selected':''; ?>>Pending</option>
                            </select>
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
                'end_date': "required"
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