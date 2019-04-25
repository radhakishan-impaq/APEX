<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Department</span>
                    <span class="caption-helper"></span>
                </div>
            </div>

            <div class="portlet-body form">
              
               <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form");
                    echo form_open_multipart(base_url('department/add'), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Name of Department :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="department_name" placeholder="Department Name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Designation Name :</label>
                            <div class="col-md-4">
                                <select name="designation_name" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($designation as $d) { ?>
                                    <option value="<?php echo $d['designation_name']; ?>"><?php echo $d['designation_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Person Name :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  name="person_name" placeholder="Person Name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Mobile :</label>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="mobile" placeholder="Mobile">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-3 control-label">Email :</label>
                            <div class="col-md-4">
                                <input type="email" class="form-control"  name="email" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-4">
                                <select class="form-control" name="status" >
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div id="cases_add_ajax">
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