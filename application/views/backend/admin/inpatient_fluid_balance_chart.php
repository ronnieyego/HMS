<?php
    $fluid_list = $this->db->get_where("inpatient_fluid_balance",array("patient_id"=>$patient_id))->result_array();
?>
<form role="form" class="form-horizontal form-groups-bordered" >
    <h4 class="add-patient-sub-title pull-left"><?php echo get_phrase('fluid_balance_chart');?></h4>
    <div class="pull-right" style="margin-bottom:5px;margin-right:30px;">
        <a href="<?php echo base_url()."index.php?admin/$patient_type";?>" class="btn btn-danger btn-md">Exit</a>
    </div>
    <div style="clear:both;"></div>
    <div class="col-sm-12 col-md-12" >
        <a onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_inpatient_fluid_balance_chart/<?php echo $patient_id?>');" 
            class="btn btn-primary " >
                <?php echo get_phrase('add_data'); ?>
        </a>
        <div style="clear:both;"></div>
        <br>
        <table class="table table-bordered table-striped datatable" id="table-fb-list">
             
            <thead>
                <tr>
                    <th rowspan=2 style="text-align:center"><?php echo get_phrase('date');?></th>
                    <th rowspan=2 style="text-align:center"><?php echo get_phrase('time');?></th>
                    <th colspan = "2" style="text-align:center"><?php echo get_phrase('input');?></th>
                    <th colspan = "2" style="text-align:center"><?php echo get_phrase('output');?></th>
                    <th rowspan=2 style="text-align:center"><?php echo get_phrase('note');?></th>
                    <th rowspan=2 style="text-align:center"><?php echo get_phrase('done_by');?></th>
                    <th rowspan=2 style="text-align:center"><?php echo get_phrase('Options');?></th>
                </tr>
                <tr>
                    <th><?php echo get_phrase('fluid_type');?></th>
                    <th><?php echo get_phrase('amount');?></th>
                    <th><?php echo get_phrase('fluid_type');?></th>
                    <th><?php echo get_phrase('amount');?></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($fluid_list as $item){ ?>
                    <tr>
                        <td><?php echo $item['date'];?></td>
                        <td><?php echo $item['time'];?></td>
                        <td><?php echo $item['input_fluid_type'];?></td>
                        <td><?php echo $item['input_fluid_amount'];?></td>
                        <td><?php echo $item['output_fluid_type'];?></td>
                        <td><?php echo $item['output_fluid_amount'];?></td>
                        <td><?php echo $item['comment'];?></td>
                        <td><?php 
                            $actype = $item["doneby_account_type"];
                            $acid = $item["doneby_account_id"];
                            $doneby_name = $this->db->get_where($actype,array($actype."_id",$acid))->row()->name;
                            echo $doneby_name;
                        ?></td>
                        <td>
                            <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_inpatient_fluid_balance_chart/<?php echo $item["id"]; ?>');" 
                                class="btn btn-default btn-sm btn-icon icon-left">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit'); ?>

                            </a>
                            <a  href="<?php echo base_url();?>index.php?admin/inpatients/delete/<?php echo $item["id"].'/fluidbalchart'; ?>" 
                                class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();" >
                                    <i class="entypo-cancel"></i>
                                    <?php echo get_phrase('delete'); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</form>

<script type="text/javascript">
//admission tab process
    jQuery(window).load(function ()
    {
        var $ = jQuery;
        $("#table-fb-list").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-fb-list tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    
    });
</script>