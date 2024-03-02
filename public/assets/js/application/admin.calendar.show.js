$(document).ready(function() {
	var $upload_img = $("#upload-image"),
	$preview_img = $("#preview-image"),
	bpjt_token = $upload_img.attr('data-token'),
	doc_id = $upload_img.attr('data-id'),
	$btn_destroy = $("#btn-destroy");

	if($("#attachment").val()) {
		$preview_img.show();
	}else $preview_img.hide();

	jQuery("#start-date").datepicker();
	jQuery("#end-date").datepicker();
	
	$("#fileuploader").fileupload({
		url:'/admin/calendars/update_file/' + doc_id,
		dataType:'json',
		type:'POST',
		formData:{bpjt_token:bpjt_token},
		done:function(e, data) {
			var response = data.result;
			if (response.status == "success") {
				console.log(response.status);
				$("#filename").text(response.new_filename);
				$preview_img.show();
			}
		},
		progressall:function(e,data) {

		}
	});

	$btn_destroy.on('click', function(e) {
		e.preventDefault();

		jConfirm('Anda yakin ingin menghapus item terpilih?', 'Pertanyaan', function(r) {
			if (r) {
				$.ajax({
					url:'/admin/calendars/destroy',
					type:'POST',
					dataType:'json',
					data:{
						id:doc_id,
						bpjt_token:$("#token-name").val()
					},
					success:function(response) {
						if (response.status == "success") {
							location.href = '/admin/calendars';
						} else {
							jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
						}
					}
				});
			}
		});
	})

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