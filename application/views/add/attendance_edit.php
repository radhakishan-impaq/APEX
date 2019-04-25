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
                    echo form_open_multipart(base_url('attendance/edit'), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Attendance Date :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control datepicker" name="date" id="date" readonly placeholder="Select Attendance Date" value="<?php echo $detail[0]['date']; ?>">
                            </div>
                        </div>
                        <br><br>
                        <?php if(count($detail) > 0) { ?>
                        <div class="dataTables_length">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan="2">
                                            <i class="fa"></i><b>Attendance</b>
                                        </th>
                                        <th rowspan="2">
                                            <i class="fa"></i><b>Member Name</b>
                                        </th>
                                        <th rowspan="2">
                                            <i class="fa"></i><b>Reason if Absent</b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($detail as $d) { ?>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="radio" name="<?php echo $d['id']; ?>" id="present" value="1" <?php echo $d['attendance']=='1'?'checked':''; ?>>Present
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="radio" name="<?php echo $d['id']; ?>" id="absent" value="0" <?php echo $d['attendance']=='0'?'checked':''; ?>>Absent
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="member[]" id="member" class="form-control" value="<?php echo $d['member_id']; ?>">
                                            <strong><?php echo $d['member_name']; ?></strong>
                                        </td>
                                        <td>
                                            <input type="text" name="reason[]" id="reason" class="form-control" value="<?php echo $d['reason']; ?>">
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                                <button type="submit" name="submit" class="btn blue">Update</button>
                                <a href="<?php echo base_url('attendance/lists') ?>"><button type="button" class="btn default">Cancel</button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>