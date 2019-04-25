<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Edit Village</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add');
                    echo form_open_multipart(base_url('village/edit/'.$id), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Village Name :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="village_name" name="village_name" placeholder="Village Name" required value="<?php echo $detail[0]['village_name']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Taluka :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="taluka" name="taluka" placeholder="Taluka" required value="<?php echo $detail[0]['taluka']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">District :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="district" name="district" placeholder="District" required value="<?php echo $detail[0]['district']; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-4">
                                <select class="form-control" name="status" >
                                    <option value="">Select</option>
                                    <option value="1" <?php echo $detail[0]['status']=='1'?'selected':''; ?>>Active</option>
                                    <option value="0" <?php echo $detail[0]['status']=='0'?'selected':''; ?>>Inactive</option>
                                </select>
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