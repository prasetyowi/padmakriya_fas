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

	function Get_allotment_stock_order_by_filter() {
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/Schedule/AllotmentStockOrderManager/Get_allotment_stock_order_by_filter') ?>",
			data: {
				tahun: $("#filter_tahun").val(),
				perusahaan: $("#filter_perusahaan").val(),
				status: $("#filter_status").val()
			},
			dataType: "JSON",
			success: function(response) {

				$('#table_list_allotment_stock_order').fadeOut("slow", function() {
					$(this).hide();

					$("#table_list_allotment_stock_order > tbody").html('');
					$("#table_list_allotment_stock_order > tbody").empty();

					if ($.fn.DataTable.isDataTable('#table_list_allotment_stock_order')) {
						$('#table_list_allotment_stock_order').DataTable().clear();
						$('#table_list_allotment_stock_order').DataTable().destroy();
					}

				}).fadeIn("slow", function() {
					$(this).show();

					if (response.length > 0) {

						$.each(response, function(i, v) {

							if (v.is_berubah != "0") {
								$("#table_list_allotment_stock_order > tbody").append(`
									<tr style="background:#FF8787">
										<td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
										<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_wms_nama}</td>
										<td class="text-center" style="text-align: center; vertical-align: middle;">${v.allotment_stock_order_tahun}</td>
										<td class="text-center" style="text-align: center; vertical-align: middle;">${v.allotment_stock_order_kode}</td>
										<td class="text-center" style="text-align: center; vertical-align: middle;">SKU sub total qty tidak cocok</td>
										<td class="text-center" style="text-align: center; vertical-align: middle;">${v.allotment_stock_order_status}</td>
										<td class="text-center" style="text-align: center; vertical-align: middle;">
											<a href="<?= base_url() ?>FAS/Schedule/AllotmentStockOrderManager/edit/?id=${v.allotment_stock_order_id}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
										</td>
									</tr>
								`);
							} else {

								$("#table_list_allotment_stock_order > tbody").append(`
									<tr>
										<td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
										<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_wms_nama}</td>
										<td class="text-center" style="text-align: center; vertical-align: middle;">${v.allotment_stock_order_tahun}</td>
										<td class="text-center" style="text-align: center; vertical-align: middle;">${v.allotment_stock_order_kode}</td>
										<td class="text-center" style="text-align: center; vertical-align: middle;"></td>
										<td class="text-center" style="text-align: center; vertical-align: middle;">${v.allotment_stock_order_status}</td>
										<td class="text-center" style="text-align: center; vertical-align: middle;">
											<a href="<?= base_url() ?>FAS/Schedule/AllotmentStockOrderManager/edit/?id=${v.allotment_stock_order_id}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
										</td>
									</tr>
								`);

							}
						});
					}

					$('#table_list_allotment_stock_order').DataTable({
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
</script>