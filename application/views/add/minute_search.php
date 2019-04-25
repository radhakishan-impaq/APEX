<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->

        <div class="portlet">
        <?php if($this->session->flashdata('success_message')){ ?>
        <div class="alert alert-success">
            <strong>Success!</strong> <?php echo $this->session->flashdata('success_message'); ?>
        </div>
        <?php } ?>
        <?php if($this->session->flashdata('delete_message')){ ?>
        <div class="alert alert-danger">
            <strong>Success!</strong> <?php echo $this->session->flashdata('delete_message'); ?>
        </div>
        <?php } ?>
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-green-haze bold uppercase">Minute</span>
                    <span class="caption-helper">Search</span>
                </div>
            </div>
            <div class="portlet-body form">
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add');
                    echo form_open_multipart(base_url('minutes/minutes_search'), $attributes);
                ?>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Case Type :</label>
                            <div class="col-md-4">
                                <select name="case_type" id="case_type" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($case_type as $ct) { ?>
                                    <option value="<?php echo $ct['case_name'] ?>" <?php echo $this->input->post('case_type')==$ct['case_name']?'selected':''; ?>><?php echo $ct['case_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Regular Number :</label>
                            <div class="col-md-4">
                                <input type="text" name="regular_no" id="" class="form-control" value="<?php echo $this->input->post('regular_no'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Year :</label>
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
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-6">
                                <button type="submit" class="btn green" name="submit">Submit </button>
                                <button type="reset" class="btn default">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php if($record_found == 'asdfasdf') { ?>
            <div class="portlet-title">
                <div class="actions">
                    <div class="btn-group">
                        <a class="btn green-haze btn-outline btn-circle btn-sm" href="<?php echo base_url('minutes/add/'.$fetch_case[0]['id']); ?>" > Add Minute
                        </a>
                    </div>
                </div>
            </div>
            <?php if(count($fetch_case) > 0) { ?>
            <?php if(count($datalist) > 0){ ?>
            <div class="dataTables_length">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th>
                                <i class="fa"></i><b> Regular Number </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Case Type </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Date </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Applicant Name </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Respondent Name </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Status </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Action </b>
                            </th>
                    </thead>
                    <tbody>
                        <?php foreach($datalist as $d) { ?>
                        <tr>
                            <td><?php echo $d['regular_number']; ?></td>

                            <td><?php echo $d['case_type']; ?></td>

                            <td><?php echo $d['date']; ?></td>

                            <td><?php echo $d['applicant_name']; ?></td>

                            <td><?php echo $d['respondent_name']; ?></td>

                            <td><?php echo $d['status']; ?></td>

                            <td>
                                <a href="<?php echo base_url('minutes/edit/'.$d['case_order_id']) ?>"><button type="button" class="btn btn-success">Edit File</button></a>
                                
                                <?=anchor("minutes/delete/".$d['case_order_id'],"Delete",array("onclick" => "return confirm('Do you really want to delete this record')", "class" => "btn btn-danger"))?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } else { ?>
            <h3>No Minutes Record Found.</h3>
            <?php } } else { ?>
            <div class="alert alert-danger">
                <strong>Wrong!</strong> Invalid Entry.
            </div>
            <?php } } ?>
        </div>
    </div>
</div>

<script type="text/javascript">


    $(document).ready(function () {
        $("#add").validate({
            rules: {
                'case_type': "required",
                'regular_no': "required",
                'year': "required",
            },
            messages: {
                'case_type': "<span style='color: #FF0000;'>Please Select Case Type</span>",
                'regular_no': "<span style='color: #FF0000;'>Please Enter Regular Name</span>",
                'year': "<span style='color: #FF0000;'>Please Select Date</span>"
                }
         });
    });

</script>