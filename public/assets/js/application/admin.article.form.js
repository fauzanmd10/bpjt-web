jQuery(function() {
	var $category_id = jQuery("#category-id")
	, $category_en = jQuery("#category-en")
	, $sub_category_id = jQuery("#sub-category-id")
	, $sub_category_en = jQuery("#sub-category-en");

	$category_id.on('change', function(e) {
		var category = $category_id.val();
		jQuery.ajax({
			type:"GET",
			url:"/index.php/admin/article_sub_categories/api_get_by_category_id",
			data:{
				category_id:category
			},
			dataType:"json",
			success:function(response) {
				if (response.status == "success") {
					var sub_categories = response.sub_categories
					, options = "";
					if (sub_categories.length > 0) {
						for (var i=0; i<sub_categories.length; i++) {
							options += "<option value=" + sub_categories[i].id + ">" + sub_categories[i].value + "</option>";
						}

						$sub_category_id.html(options);
					} else {
						$sub_category_id.html("<option value='0'>Pilih Sub Kategori</option>");
					}
				} else {
					jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
				}
			},
			error:function(response) {
				jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
			}
		});
	});

	$category_en.on('change', function(e) {
		var category = $category_en.val();
		jQuery.ajax({
			type:"GET",
			url:"/index.php/admin/article_sub_categories/api_get_by_category_id",
			data:{
				category_id:category
			},
			dataType:"json",
			success:function(response) {
				if (response.status == "success") {
					var sub_categories = response.sub_categories
					, options = "";
					if (sub_categories.length > 0) {
						for (var i=0; i<sub_categories.length; i++) {
							options += "<option value=" + sub_categories[i].id + ">" + sub_categories[i].value + "</option>";
						}

						$sub_category_en.html(options);
					} else {
						$sub_category_en.html("<option value='0'>Select Sub Category</option>");
					}
				} else {
					jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
				}
			},
			error:function(response) {
				jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
			}
		});
	});
});