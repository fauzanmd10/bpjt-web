jQuery(document).ready(function() {
	var $toll_road_id = $("#toll-road-id"),
		$input_toll_road_id = $("#input-toll-road-id"),
		$semester = $("#semester"),
		$input_semester = $("#input-semester"),
		$year = $("#year"),
		$input_year = $("#input-year"),
		$btn_show = $("#apply-filter");

	$btn_show.click(function(e) {
		e.preventDefault();

		$.ajax({
			type:"GET",
			url:"/bpjt/spm/get_spm_report",
			data:{
				toll_road_id:$toll_road_id.val(),
				semester:$semester.val(),
				year:$year.val()
			},
			dataType:"json",
			success:function(response) {
				if (response.status == 'success') {
					$("#kondisi_jalan_tol_kekesatan_condition").text(response.report.kondisi_jalan_tol_kekesatan.condition);
					$("#kondisi_jalan_tol_kekesatan_remarks").text(response.report.kondisi_jalan_tol_kekesatan.remarks);
					$("#kondisi_jalan_tol_kerataan_condition").text(response.report.kondisi_jalan_tol_kerataan.condition);
					$("#kondisi_jalan_tol_kerataan_remarks").text(response.report.kondisi_jalan_tol_kerataan.remarks);
					$("#kondisi_jalan_tol_lubang_condition").text(response.report.kondisi_jalan_tol_lubang.condition);
					$("#kondisi_jalan_tol_lubang_remarks").text(response.report.kondisi_jalan_tol_lubang.remarks);
					$("#kondisi_jalan_tol_rutting_condition").text(response.report.kondisi_jalan_tol_rutting.condition);
					$("#kondisi_jalan_tol_rutting_remarks").text(response.report.kondisi_jalan_tol_rutting.remarks);
					$("#kondisi_jalan_tol_retak_condition").text(response.report.kondisi_jalan_tol_retak.condition);
					$("#kondisi_jalan_tol_retak_remarks").text(response.report.kondisi_jalan_tol_retak.remarks);

					$("#kecepatan_tempuh_condition").text(response.report.kecepatan_tempuh.condition);
					$("#kecepatan_tempuh_remarks").text(response.report.kecepatan_tempuh.remarks);

					$("#aksesibilitas_kecepatan_transaksi_condition").text(response.report.aksesibilitas_kecepatan_transaksi.condition);
					$("#aksesibilitas_kecepatan_transaksi_remarks").text(response.report.aksesibilitas_kecepatan_transaksi.remarks);
					$("#aksesibilitas_kapasitas_gardu_condition").text(response.report.aksesibilitas_kapasitas_gardu.condition);
					$("#aksesibilitas_kapasitas_gardu_remarks").text(response.report.aksesibilitas_kapasitas_gardu.remarks);

					$("#mobilitas_wilayah_patroli_condition").text(response.report.mobilitas_wilayah_patroli.condition);
					$("#mobilitas_wilayah_patroli_remarks").text(response.report.mobilitas_wilayah_patroli.remarks);
					$("#mobilitas_informasi_condition").text(response.report.mobilitas_informasi.condition);
					$("#mobilitas_informasi_remarks").text(response.report.mobilitas_informasi.remarks);
					$("#mobilitas_kendaraan_mogok_condition").text(response.report.mobilitas_kendaraan_mogok.condition);
					$("#mobilitas_kendaraan_mogok_remarks").text(response.report.mobilitas_kendaraan_mogok.remarks);
					$("#mobilitas_derek_condition").text(response.report.mobilitas_derek.condition);
					$("#mobilitas_derek_remarks").text(response.report.mobilitas_derek.remarks);

					$("#keselamatan_perambuan_condition").text(response.report.keselamatan_perambuan.condition);
					$("#keselamatan_perambuan_remarks").text(response.report.keselamatan_perambuan.remarks);
					$("#keselamatan_marka_jalan_condition").text(response.report.keselamatan_marka_jalan.condition);
					$("#keselamatan_marka_jalan_remarks").text(response.report.keselamatan_marka_jalan.remarks);
					$("#keselamatan_guide_post_condition").text(response.report.keselamatan_guide_post.condition);
					$("#keselamatan_guide_post_remarks").text(response.report.keselamatan_guide_post.remarks);
					$("#keselamatan_patok_km_condition").text(response.report.keselamatan_patok_km.condition);
					$("#keselamatan_patok_km_remarks").text(response.report.keselamatan_patok_km.remarks);
					$("#keselamatan_penerangan_condition").text(response.report.keselamatan_penerangan.condition);
					$("#keselamatan_penerangan_remarks").text(response.report.keselamatan_penerangan.remarks);
					$("#keselamatan_pagar_rumija_condition").text(response.report.keselamatan_pagar_rumija.condition);
					$("#keselamatan_pagar_rumija_remarks").text(response.report.keselamatan_pagar_rumija.remarks);
					$("#keselamatan_penanganan_kecelakaan_condition").text(response.report.keselamatan_penanganan_kecelakaan.condition);
					$("#keselamatan_penanganan_kecelakaan_remarks").text(response.report.keselamatan_penanganan_kecelakaan.remarks);
					$("#keselamatan_pengamanan_condition").text(response.report.keselamatan_pengamanan.condition);
					$("#keselamatan_pengamanan_remarks").text(response.report.keselamatan_pengamanan.remarks);

					$("#pertolongan_ambulan_condition").text(response.report.pertolongan_ambulan.condition);
					$("#pertolongan_ambulan_remarks").text(response.report.pertolongan_ambulan.remarks);
					$("#pertolongan_derek_condition").text(response.report.pertolongan_derek.condition);
					$("#pertolongan_derek_remarks").text(response.report.pertolongan_derek.remarks);
					$("#pertolongan_polisi_pjr_condition").text(response.report.pertolongan_polisi_pjr.condition);
					$("#pertolongan_polisi_pjr_remarks").text(response.report.pertolongan_polisi_pjr.remarks);
					$("#pertolongan_patroli_condition").text(response.report.pertolongan_patroli.condition);
					$("#pertolongan_patroli_remarks").text(response.report.pertolongan_patroli.remarks);
					$("#pertolongan_rescue_condition").text(response.report.pertolongan_rescue.condition);
					$("#pertolongan_rescue_remarks").text(response.report.pertolongan_rescue.remarks);
					$("#pertolongan_sistem_informasi_condition").text(response.report.pertolongan_sistem_informasi.condition);
					$("#pertolongan_sistem_informasi_remarks").text(response.report.pertolongan_sistem_informasi.remarks);
                                        
                                        $("#lingkungan_kebersihan_condition").text(response.report.lingkungan_kebersihan.condition);
					$("#lingkungan_kebersihan_remarks").text(response.report.lingkungan_kebersihan.remarks);
                                        $("#lingkungan_tanaman_condition").text(response.report.lingkungan_tanaman.condition);
					$("#lingkungan_tanaman_remarks").text(response.report.lingkungan_tanaman.remarks);
                                        $("#lingkungan_rumput_condition").text(response.report.lingkungan_rumput.condition);
					$("#lingkungan_rumput_remarks").text(response.report.lingkungan_rumput.remarks);
                                        
                                        $("#ti_jalan_condition").text(response.report.ti_jalan.condition);
					$("#ti_jalan_remarks").text(response.report.ti_jalan.remarks);
                                        $("#ti_ramp_condition").text(response.report.ti_ramp.condition);
					$("#ti_ramp_remarks").text(response.report.ti_ramp.remarks);
                                        $("#ti_toilet_condition").text(response.report.ti_toilet.condition);
					$("#ti_toilet_remarks").text(response.report.ti_toilet.remarks);
                                        $("#ti_parkir_condition").text(response.report.ti_parkir.condition);
					$("#ti_parkir_remarks").text(response.report.ti_parkir.remarks);
                                        $("#ti_penerangan_condition").text(response.report.ti_penerangan.condition);
					$("#ti_penerangan_remarks").text(response.report.ti_penerangan.remarks);
                                        $("#ti_stasiun_condition").text(response.report.ti_stasiun.condition);
					$("#ti_stasiun_remarks").text(response.report.ti_stasiun.remarks);
                                        $("#ti_bengkel_condition").text(response.report.ti_bengkel.condition);
					$("#ti_bengkel_remarks").text(response.report.ti_bengkel.remarks);
                                        $("#ti_makan_condition").text(response.report.ti_makan.condition);
					$("#ti_makan_remarks").text(response.report.ti_makan.remarks);
                                        

					$input_toll_road_id.val($toll_road_id.val());
					$input_semester.val($semester.val());
					$input_year.val($year.val());
				} else {
					alert('Data tidak ditemukan.');

					$("#kondisi_jalan_tol_kekesatan_condition").text('');
					$("#kondisi_jalan_tol_kekesatan_remarks").text('');
					$("#kondisi_jalan_tol_kerataan_condition").text('');
					$("#kondisi_jalan_tol_kerataan_remarks").text('');
					$("#kondisi_jalan_tol_lubang_condition").text('');
					$("#kondisi_jalan_tol_lubang_remarks").text('');
					$("#kondisi_jalan_tol_rutting_remarks").text('');
					$("#kondisi_jalan_tol_rutting_condition").text('');
					$("#kondisi_jalan_tol_retak_remarks").text('');
					$("#kondisi_jalan_tol_retak_condition").text('');

					$("#kecepatan_tempuh_condition").text('');
					$("#kecepatan_tempuh_remarks").text('');

					$("#aksesibilitas_kecepatan_transaksi_condition").text('');
					$("#aksesibilitas_kecepatan_transaksi_remarks").text('');
					$("#aksesibilitas_kapasitas_gardu_condition").text('');
					$("#aksesibilitas_kapasitas_gardu_remarks").text('');

					$("#mobilitas_wilayah_patroli_condition").text('');
					$("#mobilitas_wilayah_patroli_remarks").text('');
					$("#mobilitas_informasi_condition").text('');
					$("#mobilitas_informasi_remarks").text('');
					$("#mobilitas_kendaraan_mogok_condition").text('');
					$("#mobilitas_kendaraan_mogok_remarks").text('');
					$("#mobilitas_derek_condition").text('');
					$("#mobilitas_derek_remarks").text('');

					$("#keselamatan_perambuan_condition").text('');
					$("#keselamatan_perambuan_remarks").text('');
					$("#keselamatan_marka_jalan_condition").text('');
					$("#keselamatan_marka_jalan_remarks").text('');
					$("#keselamatan_guide_post_condition").text('');
					$("#keselamatan_guide_post_remarks").text('');
					$("#keselamatan_patok_km_condition").text('');
					$("#keselamatan_patok_km_remarks").text('');
					$("#keselamatan_penerangan_condition").text('');
					$("#keselamatan_penerangan_remarks").text('');
					$("#keselamatan_pagar_rumija_condition").text('');
					$("#keselamatan_pagar_rumija_remarks").text('');
					$("#keselamatan_penanganan_kecelakaan_condition").text('');
					$("#keselamatan_penanganan_kecelakaan_remarks").text('');
					$("#keselamatan_pengamanan_condition").text('');
					$("#keselamatan_pengamanan_remarks").text('');

					$("#pertolongan_ambulan_condition").text('');
					$("#pertolongan_ambulan_remarks").text('');
					$("#pertolongan_derek_condition").text('');
					$("#pertolongan_derek_remarks").text('');
					$("#pertolongan_polisi_pjr_condition").text('');
					$("#pertolongan_polisi_pjr_remarks").text('');
					$("#pertolongan_patroli_condition").text('');
					$("#pertolongan_patroli_remarks").text('');
					$("#pertolongan_rescue_condition").text('');
					$("#pertolongan_rescue_remarks").text('');
					$("#pertolongan_sistem_informasi_condition").text('');
					$("#pertolongan_sistem_informasi_remarks").text('');
                                        
                                        $("#lingkungan_kebersihan_condition").text('');
					$("#lingkungan_kebersihan_remarks").text('');
                                        $("#lingkungan_tanaman_condition").text('');
					$("#lingkungan_tanaman_remarks").text('');
                                        $("#lingkungan_rumput_condition").text('');
					$("#lingkungan_rumput_remarks").text('');
                                        
                                        $("#ti_jalan_condition").text('');
					$("#ti_jalan_remarks").text('');
                                        $("#ti_ramp_condition").text('');
					$("#ti_ramp_remarks").text('');
                                        $("#ti_toilet_condition").text('');
					$("#ti_toilet_remarks").text('');
                                        $("#ti_parkir_condition").text('');
					$("#ti_parkir_remarks").text('');
                                        $("#ti_penerangan_condition").text('');
					$("#ti_penerangan_remarks").text('');
                                        $("#ti_stasiun_condition").text('');
					$("#ti_stasiun_remarks").text('');
                                        $("#ti_bengkel_condition").text('');
					$("#ti_bengkel_remarks").text('');
                                        $("#ti_makan_condition").text('');
					$("#ti_makan_remarks").text('');

					$input_toll_road_id.val('');
					$input_semester.val('');
					$input_year.val('');
				}
			}
		});
	});

	$("#print-to-pdf").click(function(e) {
		e.preventDefault();

		$.ajax({
			type:"POST",
			url:"/spm/spmtosession",
			data:{
				toll_road_id:$("#input-toll-road-id").val(),
				semester:$("#semester").val(),
				year:$("#year").val(),
				bpjt_token:$("#form-spm").find("input[name='bpjt_token']").val()
			},
			dataType:"json",
			success:function(response) {
				window.open('/spm/spmtopdf')
			}
		})
	})
});