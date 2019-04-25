<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Edit Department</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add');
                    echo form_open_multipart(base_url('department/edit/'.$id), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Name of Department :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="dept_name" name="department_name" placeholder="Department Name" required value="<?php echo $detail[0]['department_name']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Designation Name :</label>
                            <div class="col-md-4">
                                <select name="designation_name" class="form-control" id="designation_name" required>
                                    <option value="">Select</option>
                                    <?php foreach($designation as $d) { ?>
                                    <option value="<?php echo $d['designation_name']; ?>" <?php echo $detail[0]['designation_name']==$d['designation_name']?'selected':''; ?> ><?php echo $d['designation_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Person Name :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="person_name" name="person_name" placeholder="Person Name" value="<?php echo $detail[0]['person_name']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Mobile :</label>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="<?php echo $detail[0]['mobile']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Email :</label>
                            <div class="col-md-4">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $detail[0]['email']; ?>" required>
                            </div>
                        </div>  
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-4">
                                <select class="form-control" name="status" required>
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
                'department_name': "required",
                'designation_name' : "required",
                'person_name' : "required",
                'mobile' : "required",
                'email'  : "required"
            },
            messages: {
                'department_name': "<span style='color: #FF0000;'>Please Enter Department Name</span>",
                'designation_name': "<span style='color: #FF0000;'>Please Select Designation Name</span>",
                'person_name': "<span style='color: #FF0000;'>Please Person Name</span>",
                'mobile': "<span style='color: #FF0000;'>Please Enter Mobile Number</span>",
                'email': "<span style='color: #FF0000;'>Please Enter Valid Email</span>"
            }
         });
    });

</script>