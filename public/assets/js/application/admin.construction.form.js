jQuery(document).ready(function() {
	var $toll_road_id = jQuery("#toll-road-id"),
	$toll_road_section_id = jQuery("#toll-road-section-id");

	$toll_road_id.on('change', function(e) {
		var toll_road_id = jQuery(this).val();
		jQuery.ajax({
			type:"GET",
			url:"/admin/constructions/api_get_all_toll_road_sections",
			data:{toll_road_id:toll_road_id},
			dataType:"json",
			success:function(response) {
				if (response.status == 'success') {
					var toll_road_sections = response.toll_road_sections,
					options = "";
					for(var i=0; i<toll_road_sections.length; i++) {
						options += "<option value='" + toll_road_sections[i].id + "'>" + toll_road_sections[i].name + "</option>"
					}
					$toll_road_section_id.html(options);
				} else {
					jAlert('Data tidak ditemukan.');	
				}
			},
			error:function(response) {
				jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
			}
		})
	});
})