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
                <span class="caption-subject font-green-haze bold uppercase">Attendace</span>
                <span class="caption-helper">List</span>
            </div>
            <div class="actions">
                <div class="btn-group">
                    <a class="btn green-haze btn-outline btn-circle btn-sm" href="<?php echo base_url('attendance/add'); ?>" > Add Attendance
                    </a>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="dataTables_length">
                <table class="table table-striped table-bordered table-advance table-hover" id="item_list">
                    <thead>
                        <tr>
                            <th>
                                <i class="fa "></i><b> Attendance Date </b>
                            </th>
                            <th>
                                <i class="fa "></i><b> Total Present </b>
                            </th>
                            <th>
                                <i class="fa "></i><b> Total Absent </b>
                            </th>
                            <th>
                                <i class="fa "></i><b> Action </b>
                            </th> 
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
   
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#item_list').DataTable({
        "ajax": {
            url : "<?php echo site_url("attendance/ajaxlist") ?>",
            type : 'GET'
        },
    });     
});
</script>
<script src="<?php echo base_url('resources/frontend'); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('resources/frontend'); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<!-- <script type="text/javascript">
    var url="<?php echo base_url();?>";
    function delete(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = url+"attendance/delete/"+id;
        else
          return false;
        } 
</script> -->