jQuery(document).ready(function() {
    $construction_tbl = jQuery("#construction-report");

	// dynamic table
    var construction_reports_table = jQuery('#dyntable').dataTable({
        "sPaginationType": "full_numbers",
        "aaSortingFixed": [[0,'asc']],
        "fnDrawCallback": function(oSettings) {
            jQuery.uniform.update();
        },
        "bProcessing": true,
        "sAjaxSource": '/admin/construction_reports/api_get_all_reports'
    });
    
    jQuery('#dyntable2').dataTable( {
        "bScrollInfinite": true,
        "bScrollCollapse": true,
        "sScrollY": "300px"
    });

    jQuery("#toll-road").chosen({})
    .change(function(instance, item) {
    	if (item.selected != undefined) {
    		jQuery.ajax({
    			type:"GET",
    			url:"/admin/construction_reports/api_get_all_reports_by_toll_road",
    			data:{toll_road_id:item.selected},
    			dataType:"json",
    			success:function(response) {
    				if (response.status == 'success') {
    					var reports = response.reports,
    					row;
    					for(var i=0; i<reports.length; i++) {
    						var report = reports[i];

    						row += "<tr class='rows-" + item.selected + "'>";
    						for(var j=0; j<report.length; j++) {
    							row += "<td>" + report[j] + "</td>";
    						}
    						row += "</tr>";
    					}

                        $construction_tbl.append(row);
    				} else {
    					jAlert(response.message);
    				}
    			}
    		});
    	} else {
    		jQuery('.rows-' + item.deselected).remove();
    	}
    });
})