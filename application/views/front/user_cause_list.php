<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        
        <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">Cause</span>
                <span class="caption-helper">List</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="dataTables_length">
                <table class="table table-striped table-bordered table-advance table-hover" id="item_list">
                    <thead>
                        <tr>
                            <th>
                                <i class="fa "></i><b> Upload Date </b>
                            </th> 
                            <th>
                                <i class="fa "></i><b> Cause List PDF </b>
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
            url : "<?php echo site_url("user_cause_list/ajaxlist") ?>",
            type : 'GET'
        },
    });     
});
</script>
<script src="<?php echo base_url('resources/frontend'); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('resources/frontend'); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">