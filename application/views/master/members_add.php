<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Member</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
              
               <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form");
                    echo form_open_multipart(base_url('members/add'), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Member Name :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="member_name" name="member_name" placeholder="Member Name" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Designation Name :</label>
                            <div class="col-md-4">
                                <select name="designation_name" class="form-control" id="designation_name" required="">
                                    <option value="">Select</option>
                                    <?php foreach($designation as $d) { ?>
                                    <option value="<?php echo $d['designation_name']; ?>"><?php echo $d['designation_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Department Name :</label>
                            <div class="col-md-4">
                                <select name="department_name" class="form-control" id="department_name" required="">
                                    <option value="">Select</option>
                                    <?php foreach($department as $d) { ?>
                                    <option value="<?php echo $d['department_name']; ?>"><?php echo $d['department_name']; ?></option>
                                    <?php } ?>
                                </select>
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
                'member_name': "required",
                'department_name' : "required",
                'designation_name': "required",
                'status' : "required"
            },
            messages: {
                'member_name': "<span style='color: #FF0000;'>Please Enter Member Name</span>",
                'department_name': "<span style='color: #FF0000;'>Please Select Department</span>",
                'designation_name': "<span style='color: #FF0000;'>Please Select Designation</span>",
                'status': "<span style='color: #FF0000;'>Please Select Status</span>"
            }
         });
    });

</script>