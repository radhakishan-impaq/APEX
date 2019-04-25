<?php 
if($previous_attendance_data=='0'){
?><br><br>
    <div class="dataTables_length">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <tr>
                    <th rowspan="2">
                        <i class="fa"></i><b>Member Name</b>
                    </th>
                    <th rowspan="2">
                        <i class="fa"></i><b>Attendance</b>
                    </th>
                    <th rowspan="2">
                        <i class="fa"></i><b>Reason if Absent</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($current_attendance_data as $cad) { ?>
                <tr>
                    <td>
                        <input type="hidden" name="member[]" id="member" class="form-control" value="<?php echo $cad['id']; ?>">
                        <strong><?php echo $cad['member_name']; ?></strong>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="radio" name="<?php echo $cad['id']; ?>" id="present" value="1">Present
                            </div>
                            <div class="col-md-4">
                                <input type="radio" name="<?php echo $cad['id']; ?>" id="absent" value="0">Absent
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="text" name="reason[]" id="reason" class="form-control">
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
<div class="alert alert-danger">
    <strong>Error!</strong> Attendance already submitted.
</div>
<?php } ?>