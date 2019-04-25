<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Village</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
              
               <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form");
                    echo form_open_multipart(base_url('village/add'), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Village Name :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="village_name" name="village_name" placeholder="Village Name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Taluka :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="taluka" name="taluka" placeholder="taluka" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">District :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="district" name="district" placeholder="District">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-4">
                                <select class="form-control" name="status" required>
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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

                'village_name': "required",
                'taluka' : "required",
                'district' : "required",
                'status'  : "required"
            },
            messages: {
                'village_name': "<span style='color: #FF0000;'>Please Enter Village Name</span>",
                'taluka': "<span style='color: #FF0000;'>Please Enter Taluka Name</span>",
                'district': "<span style='color: #FF0000;'>Please Enter District Name</span>",
                'status': "<span style='color: #FF0000;'>Please Select Status</span>"
            }
         });
    });

</script>