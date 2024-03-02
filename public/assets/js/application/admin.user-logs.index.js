jQuery(function() {
	// dynamic table
    var user_logs_table = jQuery('#dyntable').dataTable({
        "sPaginationType": "full_numbers",
        "aaSortingFixed": [[0,'asc']],
        "fnDrawCallback": function(oSettings) {
            jQuery.uniform.update();
        },
        "bProcessing": true,
        "sAjaxSource": '/admin/user_logs/api_get_all_logs'
    });
    
    jQuery('#dyntable2').dataTable( {
        "bScrollInfinite": true,
        "bScrollCollapse": true,
        "sScrollY": "300px"
    });

    var checked_count = 0
    , checked_group = new Array()
    , $check_all = jQuery("#checkall")
    , $btn_edit = jQuery("#btn-edit")
    , $btn_show = jQuery("#btn-show");

    
});