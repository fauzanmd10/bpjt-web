jQuery(document).ready(function() {
	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
		
	var calendar = jQuery('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		buttonText: {
			prev: '&laquo;',
			next: '&raquo;',
			prevYear: '&nbsp;&lt;&lt;&nbsp;',
			nextYear: '&nbsp;&gt;&gt;&nbsp;',
			today: 'today',
			month: 'month',
			week: 'week',
			day: 'day'
		},
		selectable: false,
		selectHelper: false,
		editable: true,
		eventSources: [
		    {
		        url: '/admin/calendars/api_get_all_events'
		    }
		],
		eventClick: function(calEvent, jsEvent, view) {
			
        },
        eventDataTransform: function(eventData) {
        	if(eventData.status != "published") {
        		eventData.color = "red";
        	}
        	eventData.textColor = "white";
        	eventData.className = "cboxElement";
        	return eventData;
        }
	});
		
    jQuery("#medialist a").colorbox();
    
    jQuery("#btn-edit").colorbox();
	
	jQuery(window).load(function(){
		jQuery('#medialist').isotope({
			itemSelector : 'li',
			layoutMode : 'fitRows'
		});
	});

});