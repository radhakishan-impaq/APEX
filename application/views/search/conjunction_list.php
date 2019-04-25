<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Search Case</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
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
            <div class="portlet-body form">
              
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form");
                    echo form_open_multipart(base_url('conjunction/search_case'), $attributes);
                ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Society Name :</label>
                            <div class="col-md-4">
                                <select name="society" id="society" class="form-control" required="">
                                    <option value="">Select</option>
                                    <?php foreach($society as $s){ ?>
                                        <option value="<?php echo $s['society_name']; ?>" <?php echo $this->input->post('society')==$s['society_name']?'selected':''; ?>><?php echo $s['society_name']; ?></option>
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
            <?php if(count($datalist) > 0){ ?>
            <div class="dataTables_length">
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add', 'role'=>"form");
                    echo form_open_multipart(base_url('conjunction/join_case'), $attributes);
                ?>
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th>
                                <i class="fa"></i><b> Select </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Regular Number </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Society Name </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Year </b>
                            </th>
                            <th>
                                <i class="fa"></i><b> Status </b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datalist as $d) { ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="id[]" value="<?php echo $d['id']; ?>">
                            </td>

                            <td><?php echo $d['regular_number']; ?></td>

                            <td><?php echo $d['society']; ?></td>

                            <td><?php echo $d['year']; ?></td>

                            <td><?php echo $d['status']; ?></td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <button type="submit" class="btn btn-success">Join</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <?php } else { ?>
            No Record Found.
            <?php } } ?>
        </div>
    </div>
</div>
<script type="text/javascript">


    $(document).ready(function () {
        $("#add").validate({
            rules: {
                'society': "required"
            },
            messages: {
                'society': "<span style='color: #FF0000;'>Please Select Society</span>"
            }
         });
    });

</script>