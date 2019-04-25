<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Edit Respondent</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add');
                    echo form_open_multipart(base_url('respondent/edit/'.$id), $attributes);
                ?>
                    <?php echo validation_errors(); ?>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Respondent Name :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="respondent_name" name="respondent_name" placeholder="Respondent Name" required value="<?php echo $detail[0]['respondent_name']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Mobile :</label>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile" required value="<?php echo $detail[0]['mobile']; ?>">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email :</label>
                            <div class="col-md-4">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="<?php echo $detail[0]['email']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Address :</label>
                            <div class="col-md-4">
                                <textarea name="address" id="address" class="form-control" placeholder="Address..."><?php echo $detail[0]['address']; ?></textarea>
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
                'applicant_name': "required",
                'mobile' : "required",
                'email': "required"
            },
            messages: {
                'applicant_name': "<span style='color: #FF0000;'>Please Enter Applicant Name</span>",
                'mobile': "<span style='color: #FF0000;'>Please Enter Mobile Number</span>",
                'email': "<span style='color: #FF0000;'>Please Enter Valid Email</span>"
            }
         });
    });

</script>