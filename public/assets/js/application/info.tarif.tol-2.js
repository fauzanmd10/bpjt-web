Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
    	if (key === 'length') {

    	} else if (obj.hasOwnProperty(key)) {
        	size++;	
        } 
    }
    return size;
};

jQuery(document).ready(function() {
	var $toll_roads = jQuery("#toll-roads"),
	$get_image = jQuery("#get-image"),
	$tariffs_table = jQuery("#tariffs-table"),
	$kepmen = jQuery("#kepmen");

	$get_image.click(function(e) {
		var toll_road_id = $toll_roads.val();
		$.ajax({
			type:"GET",
			url:"toll_roads/show",
			data:{toll_road_id:toll_road_id},
			dataType:"json",
			success:function(response) {
				var rows = "";

				if (response.status == "success") {
					var toll_tariffs = response.toll_tariffs,
					toll_gates = response.toll_gates,
					vehicle_groups = response.vehicle_groups;
					$kepmen.text(response.kepmen);
					for (var key in toll_tariffs) {
						if (key === 'length' || !toll_tariffs.hasOwnProperty(key)) continue;
						var exit_gates = toll_tariffs[key],
						enter_gate_name = toll_gates[key];

						rows += "<tr>";
						rows += "<td rowspan='" + Object.size(exit_gates) + "'>" + enter_gate_name + "</td>";
						idx = 0;
						for (var subkey in exit_gates) {
							if (subkey === 'length' || !exit_gates.hasOwnProperty(subkey)) continue;
							var exit_gate_name = toll_gates[subkey];

							if (idx != 0) {
								rows += "<tr>";
							}
							rows += "<td>" + exit_gate_name + "</td>";

							for (var subsubkey in vehicle_groups) {
								if (subsubkey === 'length' || !vehicle_groups.hasOwnProperty(subsubkey)) continue;
								if (exit_gates[subkey][subsubkey] != undefined) {
									rows += "<td>" + exit_gates[subkey][subsubkey] + "</td>";
								} else {
									rows += "<td>-</td>";
								}
							}

							rows += "</tr>";

							idx++;
						}
					}
				} else {
					$kepmen.text('');
					alert("Tidak ada data tarif tol ditemukan untuk ruas tol yang dipilih.")
				}

				$tariffs_table.find("tbody").html(rows);
			}
		});
	});
})