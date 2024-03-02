jQuery(document).ready(function() {
	$ = jQuery;
	var $table_cont = $("#tableDiv_Arrays"),
	$table_cont_1 = $("#Open_Text_Arrays_1"),
	$table_cont_2 = $("#Open_Text_Arrays_2"),
	$table_cont_3 = $("#Open_Text_Arrays_3"),
	$toll_road = $("#toll-road"),
	$semester = $("#semester"),
	$year = $("#year"),
	$apply_btn = $("#apply-filter"),
	selected_data = [];

	$apply_btn.click(function(e) {
		var toll_road_id = $toll_road.val(),
		semester_id = $semester.val(),
		year_id = $year.val(),
		classification_ids = $table_cont.attr("data-classifications");
		
		if (parseInt(toll_road_id) == 0 || parseInt(semester_id) == 0 || parseInt(year_id) == 0) {
			alert("Ruas Tol, Semester, dan Tahun harus dipilih terlebih dahulu.");
		} else {
			$.ajax({
				type:"GET",
				url:"/bpjt/admin/spm/get_score",
				data:{
					classifications: classification_ids,
					toll_road_id: toll_road_id,
					semester_id: semester_id,
					year_id: year_id
				},
				dataType:"json",
				success:function(response) {
					if (response.status == "success") {

						var row = "<tr><td><a href='#' class='remove-spm remove-spm-"+toll_road_id+"-"+year_id+"-"+semester_id+"' data-toll-road='" + toll_road_id + "' data-semester='" + semester_id + "' data-year='" + year_id + "'><i class='icon-remove'></i></a></td>",
						pdf_row = "<tr>";

						row += "<td>" + $("#toll-road option:selected").text() + " - (Semester " + semester_id + "/" + year_id + ")</td>";
						pdf_row += "<td>" + $("#toll-road option:selected").text() + " - (Semester " + semester_id + "/" + year_id + ")</td>";
						row += "<td>" + response.developer + "</td>";
						pdf_row += "<td>" + response.developer + "</td>";
						row += "<td>" + response.road_length + "</td>";
						pdf_row += "<td>" + response.road_length + "</td>";
						for(i=0;i<response.scores.length;i++) {
							style = "";
							if (response.scores[i].score_status == 1) {
								style = "style='background-color:#ff0000;'";
							} else if (response.scores[i].score_status == 2) {
								style = "style='background-color:#00ff00;'";
							} else if (response.scores[i].score_status == 3) {
								style = "style='background-color:#0000ff;'";
							}

							row += "<td " + style + ">";
							pdf_row += "<td " + style + ">";
							row += response.scores[i].score;
							pdf_row += response.scores[i].score;
							row += "</td>";
							pdf_row += "</td>";
						}
						row += "<td>" + response.remarks_evaluation + "</td>";
						pdf_row += "<td>" + response.remarks_evaluation + "</td>";
						row += "<td>" + response.remarks_report + "</td>";
						pdf_row += "<td>" + response.remarks_report + "</td>";
						row += "</tr>";
						pdf_row += "</tr>";

						$table_cont_1.append(row);
						$table_cont_2.append(row);
						$table_cont_3.append(pdf_row);
					}
				}
			});
		}
	});

	$('.remove-spm').live('click', function(e) {
		e.preventDefault();
		var $this = $(this),
		toll_road_id = $this.data('toll-road'),
		year_id = $this.data('year'),
		semester_id = $this.data('semester'),
		$spm_btn = $(".remove-spm-" + toll_road_id + "-" + year_id + "-" + semester_id);
		$tr = $spm_btn.parent().parent();
		$tr.remove();
	});

	$("#print-to-pdf").click(function(e) {
		e.preventDefault();

		$.ajax({
			type:"POST",
			url:"/admin/spm/spmtosession",
			data:{
				table_structure:$("#table-to-pdf").html(),
				bpjt_token:$("#form-spm").find("input[name='bpjt_token']").val()
			},
			dataType:"json",
			success:function(response) {
				window.open('/admin/spm/spmtopdf')
			}
		})
	})
})