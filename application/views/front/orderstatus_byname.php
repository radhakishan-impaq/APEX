<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Search Order By Name</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">
              
               <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form");
                    echo form_open_multipart(base_url('orderstatus/byname'), $attributes);
                ?>
                    <?php echo validation_errors(); ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Case Type :</label>
                            <div class="col-md-4">
                                <select name="case_type" id="case_type" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($case_type as $ct) { ?>
                                    <option value="<?php echo $ct['case_name']; ?>" <?php echo $this->input->post('case_type')==$ct['case_name']?'selected':''; ?>><?php echo $ct['case_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Applicant Name :</label>
                            <div class="col-md-4">
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $this->input->post('name'); ?>" placeholder="Enter Applicant Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Year</label>
                            <div class="col-md-4">
                                <select name="year" id="year" class="form-control">
                                    <option value="">Select Year</option>
                                    <?php foreach($year as $y){ ?>
                                    <option value="<?php echo $y; ?>" <?php echo $this->input->post('year')==$y?'selected':''; ?>><?php echo $y; ?></option>
                                    <?php } ?>
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
            <?php if($record_found == 'asdfasdf') { ?>
            <?php if(count($detail) > 0){ ?>
            <div class="dataTables_length">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th>
                                <i class="fa"></i><b> Regular Number </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Date </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Order File </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Status </b>
                            </th>
                    </thead>
                    <tbody>
                        <?php foreach($detail as $d) { ?>
                        <tr>
                            <td><?php echo $d['regular_number']; ?></td>

                            <td><?php echo $d['date']; ?></td>


                            <td><?php echo '<a href="'. base_url('uploads/casefile/'.$d['order_file']) .'" target="_blank" class="btn btn-success btn-sm active"><span class="glyphicon glyphicon-download"></span> Download Pdf</a>'; ?></td>

                            <td><?php echo $d['status']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php } else { ?>
            <h3>No Record Found.</h3>
            <?php } } ?> 
        </div>
    </div>
</div>
<script type="text/javascript">


    $(document).ready(function () {
        $("#add").validate({
            rules: {
                'case_type': "required",
                'name' : "required",
                'year': "required"
            },
            messages: {
                'case_type': "<span style='color: #FF0000;'>Please Select Case Type</span>",
                'name': "<span style='color: #FF0000;'>Please Enter Name</span>",
                'year': "<span style='color: #FF0000;'>Please Select year</span>"
            }
         });
    });

</script>