jQuery(document).ready(function() {
	var $upload_img = jQuery("#upload-image"),
	$preview_img = jQuery("#preview-image"),
	bpjt_token = $upload_img.attr('data-token'),
	doc_id = $upload_img.attr('data-id'),
	$btn_destroy = jQuery("#btn-destroy");

	jQuery("#fileuploader").fileupload({
		url:'/admin/spm_recaps/update_file/' + doc_id,
		dataType:'json',
		formData:{bpjt_token:bpjt_token},
		done:function(e, data) {
			var response = data.result
			if (response.status == "success") {
				location.href = '/admin/spm_recaps';
			} else {
				// show alert with bootstrap
			}
		},
		progressall:function(e,data) {

		}
	});

	$btn_destroy.on('click', function(e) {
		e.preventDefault();
		var doc_id = $btn_destroy.attr('data-id');

		jConfirm('Anda yakin ingin menghapus item terpilih?', 'Pertanyaan', function(r) {
			if (r) {
				jQuery.ajax({
			url:'/admin/spm_recaps/destroy',
			type:'POST',
			dataType:'json',
			data:{
				document_id:doc_id,
				bpjt_token:jQuery("#token-name").val()
			},
			success:function(response) {
				if (response.status == "success") {
					location.href = '/admin/spm_recaps';
				} else {
					jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
				}
			}
		});
			}
		});
	})
});