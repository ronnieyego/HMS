<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_bank/');" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_bank'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('bank_id');?></th>
            <th><?php echo get_phrase('bank_name');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($bank_info as $row) { ?>   
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_bank/<?php echo $row['id']?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="entypo-pencil"></i>
                            Edit
                    </a>
                    <a href="<?php echo base_url();?>index.php?admin/bank_settings/delete/<?php echo $row['id']?>" 
                        class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                            <i class="entypo-cancel"></i>
                            Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            aaSorting:[["1","asc"]],
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
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