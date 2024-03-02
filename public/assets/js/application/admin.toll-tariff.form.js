jQuery(document).ready(function() {
	$toll_road = jQuery("#toll-road-id"),
	$enter_toll_gate = jQuery("#enter-toll-gate-id"),
	$exit_toll_gate = jQuery("#exit-toll-gate-id"),
	$kepmen = jQuery("#kepmen");

	$toll_road.on('change', function(e) {
		jQuery.ajax({
			type:"GET",
			url:"/admin/toll_tariffs/api_get_toll_gates",
			data:{toll_road_id:$toll_road.val()},
			dataType:"json",
			success:function(response) {
				if (response.status == 'success') {
					toll_gates = response.toll_gates;
					options = "";
					for(i=0; i<toll_gates.length; i++) {
						options += "<option value='" + toll_gates[i].id + "'>" + toll_gates[i].name + "</option>";
					}

					$enter_toll_gate.html(options);
					$exit_toll_gate.html(options);
				}
			}
		});

		jQuery.ajax({
			type:"GET",
			url:"/admin/toll_tariffs/api_get_kepmen",
			data:{toll_road_id:$toll_road.val()},
			dataType:"json",
			success:function(response) {
				if (response.status == 'success') {
					$kepmen.val(response.kepmen);
				}
			}
		});
	});


})