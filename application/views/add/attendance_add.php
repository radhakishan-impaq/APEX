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
                    echo form_open_multipart(base_url('attendance/add'), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Attendance Date :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control datepicker" name="date" id="date" readonly placeholder="Select Attendance Date">
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div id="member_add_ajax">
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
                'date': "required"
            },
            messages: {
                'date': "<span style='color: #FF0000;'>Please Select Date</span>"
            }
         });
    });

</script>
<script type="text/javascript">
jQuery(document).ready(function () {

    $(document).on('change', "#date", function () {
        console.log($("#date").val());
        if ($("#date").val() != ''){
            $.ajax({
                url: baseurl + 'attendance/members_for_attendance',
                type: 'get',
                data: { date: $("#date").val() },
                dataType: 'html',
                success: function (result) {
                    $("#member_add_ajax").html(result);
                },
                error: function (error) {
                }
            });
        }
    });
});

</script>