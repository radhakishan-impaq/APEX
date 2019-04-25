<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Applicant</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
              
               <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form");
                    echo form_open_multipart(base_url('applicant/add'), $attributes);
                ?>
                    <?php echo validation_errors(); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Applicant Name :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="applicant_name" name="applicant_name" placeholder="Applicant Name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Mobile :</label>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile" required>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email :</label>
                            <div class="col-md-4">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Address :</label>
                            <div class="col-md-4">
                                <textarea name="address" id="address" class="form-control" placeholder="Address..."></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Concern Department :</label>
                            <div class="col-md-4">
                                <textarea name="concern_person" id="concern_person" class="form-control" placeholder="Concern Person..."></textarea>
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
                'applicant_name': "required",
                'mobile' : "required",
                'email': "required",
                'concern_person' : "required"
            },
            messages: {
                'applicant_name': "<span style='color: #FF0000;'>Please Enter Applicant Name</span>",
                'mobile': "<span style='color: #FF0000;'>Please Enter Mobile Number</span>",
                'email': "<span style='color: #FF0000;'>Please Enter Valid Email</span>",
                'concern_person': "<span style='color: #FF0000;'>Please Enter Concern Person</span>"
            }
         });
    });

</script>