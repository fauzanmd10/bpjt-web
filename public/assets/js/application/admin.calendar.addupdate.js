jQuery(document).ready(function() {
	jQuery('#btn-submit').attr('disabled',true);
	jQuery('#event-title').keyup(function(){
		if(jQuery(this).val().length !=0){
			jQuery('#btn-submit').attr('disabled', false);
		}else {
			jQuery('#btn-submit').attr('disabled', true);        
		}
	})

	jQuery("#start-date").datepicker();
	jQuery("#end-date").datepicker();

	function split( val ) {
		return val.split( /,\s*/ );
	}

	function extractLast( term ) {
		return split( term ).pop();
	}

	jQuery("#invitee" ).bind("keydown", function(event) {
		if ( event.keyCode === jQuery.ui.keyCode.TAB && jQuery(this).data( "ui-autocomplete" ).menu.active ) {
			event.preventDefault();
		}
	})
	.autocomplete({
		source:function(request, response) {
			jQuery.getJSON("/admin/calendars/api_get_all_employees", {
				term: extractLast(request.term)
			}, response );
		},
		search:function() {
			var term = extractLast(this.value);
			if (term.length < 2) {
				return false;
			}
		},
		focus: function() {
			return false;
		},
		select: function( event, ui ) {
			var terms = split(this.value);
			// remove the current input
			terms.pop();
			// add the selected item
			console.log(ui.item);
			terms.push(ui.item.value);
			// add placeholder to get the comma-and-space at the end
			terms.push("");
			this.value = terms.join(", ");
			return false;
		}
	});
});