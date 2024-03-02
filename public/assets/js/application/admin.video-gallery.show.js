jQuery(document).ready(function() {
	var $upload_img = jQuery("#upload-video"),
	$preview_img = jQuery("#preview-video"),
	bpjt_token = $upload_img.attr('data-token'),
	media_id = $upload_img.attr('data-id'),
	$btn_destroy = jQuery("#btn-destroy");

	jQuery("#fileuploader").fileupload({
		url:'/bpjt_ci3/index.php/admin/video_galleries/update_video/' + media_id,
		dataType:'json',
		formData:{bpjt_token:bpjt_token},
		done:function(e, data) {
			var response = data.result
			if (response.status == "success") {
				// var image_obj = new Image();
				// image_obj.src = response.new_imgpath;

				// image_obj.onload = function() {
				// 	$preview_img.attr('src', image_obj.src);
				// }
				location.href = '/bpjt_ci3/index.php/admin/video_galleries';
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
			url:'/bpjt_ci3/index.php/admin/video_galleries/destroy',
			type:'POST',
			dataType:'json',
			data:{
				media_id:media_id,
				bpjt_token:jQuery("#token-name").val()
			},
			success:function(response) {
				if (response.status == "success") {
					location.href = '/bpjt_ci3/index.php/admin/video_galleries';
				} else {
					jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
				}
			}
		});
			}
		});
	})
});