jQuery(document).ready(function() {
	var $instance = jQuery("#instance-id"),
	$building = jQuery("#building-id"),
	$building_room = jQuery("#building-room-id");

	$instance.on('change', function() {
		jQuery.ajax({
			type:"GET",
			url:"/admin/applied_inventories/api_get_all_buildings",
			dataType:"json",
			data:{instance_id:$instance.val()},
			success:function(response) {
				if (response.length > 0) {
					var first_row = response[0],
					options;

					for(var i=0; i<response.length; i++) {
						options += "<option value='"+response[i].id+"'>"+response[i].name+"</option>";
					}
					$building.html(options);

					jQuery.ajax({
						type:"GET",
						url:"/admin/applied_inventories/api_get_all_building_rooms",
						dataType:"json",
						data:{building_id:first_row.id},
						success:function(response) {
							if (response.length > 0) {
								var options;

								for(var i=0; i<response.length; i++) {
									options += "<option value='"+response[i].id+"'>"+response[i].name+"</option>";
								}
								$building_room.html(options);
							} else {
								jAlert('Tidak ada data ruangan bangunan ditemukan.');
							}
						},
						error:function(response) {
							jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
						}
					});
				} else {
					jAlert('Tidak ada data bangunan ditemukan.');
				}
			},
			error:function(response) {
				jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
			}
		});
	});

	$building.on('change', function() {
		jQuery.ajax({
			type:"GET",
			url:"/admin/applied_inventories/api_get_all_building_rooms",
			dataType:"json",
			data:{building_id:$building.val()},
			success:function(response) {
				if (response.length > 0) {
					var options;

					for(var i=0; i<response.length; i++) {
						options += "<option value='"+response[i].id+"'>"+response[i].name+"</option>";
					}
					$building_room.html(options);
				} else {
					jAlert('Tidak ada data ruangan bangunan ditemukan.');
				}
			},
			error:function(response) {
				jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
			}
		});
	});
})