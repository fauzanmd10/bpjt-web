jQuery(document).ready(function() {
	var $upload_img = jQuery("#upload-image"),
	$preview_img = jQuery("#preview-image"),
	bpjt_token = $upload_img.attr('data-token'),
	media_id = $upload_img.attr('data-id'),
	$btn_destroy = jQuery("#btn-destroy");

	jQuery("#fileuploader").fileupload({
		url:'/index.php/admin/photo_galleries/update_image/' + media_id,
		dataType:'json',
		formData:{bpjt_token:bpjt_token},
		done:function(e, data) {
			var response = data.result
			if (response.status == "success") {
				var image_obj = new Image();
				image_obj.src = response.new_imgpath;

				image_obj.onload = function() {
					$preview_img.attr('src', image_obj.src);
				}
			} else {
				// show alert with bootstrap
			}
		},
		progressall:function(e,data) {

		}
	});

	$btn_destroy.on('click', function(e) {
		e.preventDefault();
		var media_id = $btn_destroy.attr('data-id');

		jConfirm('Anda yakin ingin menghapus item terpilih?', 'Pertanyaan', function(r) {
			if (r) {
				jQuery.ajax({
			url:'/index.php/admin/photo_galleries/destroy',
			type:'POST',
			dataType:'json',
			data:{
				media_id:media_id,
				bpjt_token:jQuery("#token-name").val()
			},
			success:function(response) {
				if (response.status == "success") {
					location.href = '/index.php/admin/photo_galleries';
				} else {
					jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
				}
			}
		});
			}
		});
	})
});