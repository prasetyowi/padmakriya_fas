<script type="text/javascript">
	$(document).ready(function() {
		$(".select2").select2({
			width: "100%"
		});
		if ($('#filter-pr-date').length > 0) {
			$('#filter-pr-date').daterangepicker({
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
	})


	$("#btn-search-data-pr").on("click", function() {

		$("#loadingviewpr").show();
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Pengadaan/PurchaseOrder/search_purchase_request_by_filter') ?>",
			data: {
				tgl: $("#filter-pr-date").val(),
				perusahaan: $("#filter-pr-perusahaan").val(),
				divisi: $("#filter-pr-divisi").val()
			},
			dataType: "JSON",
			success: function(response) {

				$("#table_list_data_pr > tbody").empty();

				if ($.fn.DataTable.isDataTable('#table_list_data_pr')) {
					$('#table_list_data_pr').DataTable().clear();
					$('#table_list_data_pr').DataTable().destroy();
				}

				if (response != 0) {
					$.each(response, function(i, v) {
						if (v.purchase_request_status == "In Progress Approval") {
							$("#table_list_data_pr > tbody").append(`
							<tr>
							<td class="text-center">${v.supplier_nama}</td>
								<td class="text-center">${v.karyawan_divisi_nama}</td>
								<td class="text-center">${v.purchase_order_kode}</td>
								<td class="text-center">${v.purchase_order_tgl_create}</td>
								<td class="text-center">${v.purchase_order_status}</td>
								
								<td class="text-center">${v.purchase_order_tgl}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseOrder/detail/?id=${v.purchase_order_id}" class="btn btn-warning btn-small btn-delete-sku"><i class="fa fa-search"></i></a></td>
							</tr>
						`);
						} else if (v.purchase_request_status == "Approved") {
							$("#table_list_data_pr > tbody").append(`
							<tr>
                            <td class="text-center">${v.supplier_nama}</td>
                            <td class="text-center">${v.karyawan_divisi_nama}</td>
								<td class="text-center">${v.purchase_order_kode}</td>
                                <td class="text-center">${v.purchase_request_kode}</td>
								<td class="text-center">${v.purchase_order_tgl_create}</td>
								<td class="text-center">${v.purchase_order_status}</td>
								
								<td class="text-center">${v.purchase_order_tgl}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseOrder/detail/?id=${v.purchase_order_id}" class="btn btn-warning btn-small btn-delete-sku"><i class="fa fa-search"></i></a></td>
                                <td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseOrder/CetakPdf/?id=${v.purchase_order_id}" class="btn btn-warning btn-small btn-delete-sku"><i class="fa fa-book"></i></a></td>
							</tr>
						`);
						} else if (v.purchase_request_status == "Rejected") {
							$("#table_list_data_pr > tbody").append(`
							<tr>
                            <td class="text-center">${v.supplier_nama}</td>
                            <td class="text-center">${v.karyawan_divisi_nama}</td>
								<td class="text-center">${v.purchase_order_kode}</td>
								<td class="text-center">${v.purchase_request_kode}</td>
								<td class="text-center">${v.purchase_order_tgl_create}</td>
								<td class="text-center">${v.purchase_order_status}</td>
								
								<td class="text-center">${v.purchase_order_tgl}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseOrder/detail/?id=${v.purchase_order_id}" class="btn btn-warning btn-small btn-delete-sku"><i class="fa fa-search"></i></a></td>
                                <td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseOrder/CetakPdf/?id=${v.purchase_order_id}" class="btn btn-warning btn-small btn-delete-sku"><i class="fa fa-book"></i></a></td>
							</tr>
						`);
						} else {
							$("#table_list_data_pr > tbody").append(`
							<tr>
                            <td class="text-center">${v.supplier_nama}</td>
                            <td class="text-center">${v.karyawan_divisi_nama}</td>
								<td class="text-center">${v.purchase_order_kode}</td>
                                <td class="text-center">${v.purchase_request_kode}</td>
								<td class="text-center">${v.purchase_order_tgl_create}</td>
								<td class="text-center">${v.purchase_order_status}</td>
							
								<td class="text-center">${v.purchase_order_tgl}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseOrder/detail/?id=${v.purchase_order_id}" class="btn btn-warning btn-small btn-delete-sku"><i class="fa fa-search"></i></a>
                                <a href="<?= base_url() ?>FAS/Pengadaan/PurchaseOrder/CetakPdf/?id=${v.purchase_order_id}" target="_blank" class="btn btn-success btn-small btn-delete-sku"><i class="fa fa-book"></i></a></td>
							</tr>
						`);

						}
					});
					$('#table_list_data_pr').DataTable({
						'ordering': false
					});
				} else {
					$("#table_list_data_pr > tbody").append(`
								<tr>
									<td colspan="13" class="text-danger text-center">
										Data Kosong
									</td>
								</tr>
					`);
				}

				$("#loadingviewpr").hide();
			}
		});
	});
</script>