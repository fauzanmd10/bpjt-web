jQuery(document).ready(function() {
	jQueryupload_img = jQuery("#upload-image"),
	jQuerypreview_img = jQuery("#preview-image"),
	bpjt_token = jQueryupload_img.attr('data-token'),
	media_id = jQueryupload_img.attr('data-id'),
	jQuerybtn_destroy = jQuery("#btn-destroy");

	jQuery("#fileuploader").fileupload({
		url:'/admin/employees/update_image/' + media_id,
		dataType:'json',
		formData:{bpjt_token:bpjt_token},
		done:function(e, data) {
			var response = data.result
			if (response.status == "success") {
				var image_obj = new Image();
				image_obj.src = response.new_imgpath;
				image_obj.onload = function() {
					jQuerypreview_img.attr('src', image_obj.src);
				}
			} else {
				// show alert with bootstrap
			}
		},
		progressall:function(e,data) {

		}
	});

	jQuerybtn_destroy.on('click', function(e) {
		e.preventDefault();
		
		jConfirm('Anda yakin ingin menghapus item terpilih?', 'Pertanyaan', function(r) {
			if (r) {
                jQuery.ajax({
                    type:"POST",
                    url:"/admin/employees/destroy_image",
                    data:{
                    	id:media_id,
                        bpjt_token:bpjt_token
                    },
                    dataType:"json",
                    success:function(response) {
						if (response.status == "success") {
							jQuerypreview_img.attr('src', response.new_imgpath);
						} else {
							jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
						}
                    },
                    error:function(response) {
                        jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
                    }
                });
			}
		});
	})
});
