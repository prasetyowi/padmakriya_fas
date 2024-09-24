<script type="text/javascript">
	$(document).ready(function() {
		$('.select2').select2({
			width: '100%'
		});

		if ($('#filter_tanggal').length > 0) {
			$('#filter_tanggal').daterangepicker({
				'applyClass': 'btn-sm btn-success',
				'cancelClass': 'btn-sm btn-default',
				locale: {
					"format": "DD/MM/YYYY",
					applyLabel: 'Apply',
					cancelLabel: 'Cancel',
				},
				'startDate': '<?= date("01-m-Y") ?>',
				'endDate': '<?= date("t-m-Y") ?>'
			});
		}
	});

	function message_custom(titleType, iconType, htmlType) {
		Swal.fire({
			title: titleType,
			icon: iconType,
			html: htmlType,
		})
	}

	function Get_production_schedule_by_filter() {
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/Get_production_schedule_by_filter') ?>",
			data: {
				tahun: $("#filter_tahun").val(),
				perusahaan: $("#filter_perusahaan").val(),
				status: $("#filter_status").val()
			},
			dataType: "JSON",
			success: function(response) {

				$('#table_list_production_schedule').fadeOut("slow", function() {
					$(this).hide();

					$("#table_list_production_schedule > tbody").html('');
					$("#table_list_production_schedule > tbody").empty();

					if ($.fn.DataTable.isDataTable('#table_list_production_schedule')) {
						$('#table_list_production_schedule').DataTable().clear();
						$('#table_list_production_schedule').DataTable().destroy();
					}

				}).fadeIn("slow", function() {
					$(this).show();

					if (response.length > 0) {

						$.each(response, function(i, v) {

							$("#table_list_production_schedule > tbody").append(`
								<tr>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.production_schedule_tahun}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_wms_nama}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.principle}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.production_schedule_kode}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.production_schedule_status}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">
										<a href="<?= base_url() ?>FAS/Schedule/JadwalKedatanganMaterial/edit/?id=${v.production_schedule_id}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
										<button class="btn btn-primary btn-sm" onclick="ViewDetail('${v.production_schedule_id}','${v.production_schedule_kode}','${v.production_schedule_tahun}','${v.client_wms_nama}','${v.principle}')"><i class="fa fa-eye"></i></button>
									</td>
								</tr>
							`);
						});
					}

					$('#table_list_production_schedule').DataTable({
						lengthMenu: [
							[50, 100, 200, -1],
							[50, 100, 200, 'All']
						],
						ordering: false,
						searching: false,
						"scrollX": true
					});
				});

			}
		});
	}

	function ViewDetail(production_schedule_id, production_schedule_kode, tahun, perusahaan, principle) {

		$("#modal_detail_jadwal_kedatangan_material").modal('show');
		$("#filter_tahun_detail").html(tahun);
		$("#filter_kode_detail").html(production_schedule_kode);
		$("#filter_perusahaan_detail").html(perusahaan);
		$("#filter_principle_detail").html(principle);

		$.ajax({
			type: "GET",
			url: "<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/proses_view_jadwal_kedatangan') ?>",
			data: {
				production_schedule_id: production_schedule_id
			},
			dataType: "JSON",
			success: function(response) {
				$('#table_production_schedule_detail').fadeOut("slow", function() {
					$(this).hide();

					$("#table_production_schedule_detail > tbody").html('');
					$("#table_production_schedule_detail > tbody").empty();

					if ($.fn.DataTable.isDataTable('#table_production_schedule_detail')) {
						$('#table_production_schedule_detail').DataTable().clear();
						$('#table_production_schedule_detail').DataTable().destroy();
					}

				}).fadeIn("slow", function() {
					$(this).show();

					if (response.length > 0) {

						$.each(response, function(i, v) {

							$("#table_production_schedule_detail > tbody").append(`
								<tr>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kode}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.satuan}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['1']}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['2']}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['3']}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['4']}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['5']}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['6']}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['7']}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['8']}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['9']}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['10']}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['11']}</td>
									<td class="text-center" style="text-align: right; vertical-align: middle;">${v['12']}</td>
								</tr>
							`);
						});
					}
				});
			},
			error: function(xhr, ajaxOptions, thrownError) {
				message("Error", "Error 500 Internal Server Connection Failure", "error");
			},
		});

	}
</script>