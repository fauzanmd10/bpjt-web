jQuery(document).ready(function() {
	var dates = [],
	cur_date = new Date(),
	$datepicker = jQuery("#datepicker");

	jQuery.ajax({
		type:"GET",
		url:"/bpjt/admin/dashboard/get_calendars",
		data:{
			month:cur_date.getMonth()+1,
			year:cur_date.getFullYear()
		},
		dataType:"json",
		success:function(response) {
			if (response.status == 'success') {
				dates = response.dates;

	    		$datepicker.datepicker({
			    	dateFormat:'mm/dd/yy',
			    	beforeShowDay: function(date) {
			    		for (var i=0; i<dates.length; i++) {
							var highlight = new Date(dates[i].toString());
			    			if (highlight.toString() == date.toString()) {
			    				return [true, 'dp-highlight'];
			    			}
			    		}
			    		
			    		return [true, ''];
			    	},
			    	onChangeMonthYear:function(year, month, instance) {
			    		jQuery.ajax({
			    			type:"GET",
			    			url:"/admin/dashboard/get_calendars",
			    			data:{
			    				month:month,
			    				year:year
			    			},
			    			dataType:"json",
			    			success:function(response) {
			    				if (response.status == 'success') {
			    					dates = response.dates;

			    					var cells = jQuery("#"+instance.id).find('.ui-state-default');
			    					for(var i=0; i<cells.length; i++) {
			    						var cell_elm = jQuery(cells[i]);
			    						for (var j=0; j<dates.length; j++) {
			    							var highlight = new Date(dates[j].toString()),
			    							date = new Date(month + "/" + cell_elm.text() + "/" + year);
							    			if (highlight.toString() == date.toString()) {
							    				var elm = cell_elm.parent();
							    				console.log(elm);
							    				if (!elm.hasClass('dp-highlight')) {
							    					elm.addClass('dp-highlight');
							    				}
							    			}
			    						}
			    					}
			    				}
			    			}
			    		});
			    	},
			    	onSelect:function(date_text, instance) {
			    		window.location.href = '/admin/calendars';
			    	}
			    });
			}
		}
	});
    
    // tabbed widget
    jQuery('.tabbedwidget').tabs();
});