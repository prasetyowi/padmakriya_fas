<script>
	$(document).ready(function() {
		// alert('aaa')
		$(".select2").select2({
			width: "100%"
		});
		$(".custom-select").select2({
			width: "100%"
		});
		$('#tableKreditLimit').DataTable();
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


	function getDataSearch() {
		var filter_tanggal = $("#filter_tanggal").val()
		var filter_status = $("#filter_status").val()
		Swal.showLoading()
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getDataSearch') ?>",
			data: {
				filter_status: filter_status,
				filter_tanggal: filter_tanggal
			},
			success: function(response) {

				let no = 1;
				let data = response;

				if ($.fn.DataTable.isDataTable('#tableKreditLimit')) {
					$('#tableKreditLimit').DataTable().destroy();
				}

				$("#tableKreditLimit tbody").empty();
				$("#tableKreditLimit tbody").html('');
				if (data.length > 0) {
					$.each(data, function() {
						let edit = '';
						if (this.pengajuan_kredit_status == 'Draft') {
							edit =
								'<a class="btn btn-warning" tittle="Edit" target="_blank" href="<?php echo site_url('FAS/ManagementPelanggan/PengaturanKreditLimit/PengaturanKreditLimitEdit?kode=') ?>' +
								this.pengajuan_kredit_kode + '"><i class="fas fa-edit"></i></a>'
						}
						$('#tableKreditLimit tbody').append(`
									<tr>
										<td style='vertical-align:middle; text-align: center;' >${no}</td>
										<td style='vertical-align:middle;text-align: center; ' >${this.pengajuan_kredit_kode}</td>
										<td style='vertical-align:middle;text-align: center; ' >${this.tgl}</td>
										<td style='vertical-align:middle;text-align: center; ' >${this.pelanggan_nama}</td>
										<td style='vertical-align:middle; ' >${this.pelanggan_alamat}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.pengajuan_kredit_status}</td>
										<td style='vertical-align:middle;text-align: center; ' >
											<a class="btn btn-primary" tittle="lihat" target="_blank" href="<?php echo site_url('FAS/ManagementPelanggan/PengaturanKreditLimit/PengaturanKreditLimitView?kode=') ?>${this.pengajuan_kredit_kode}"><i class="fas fa-eye"></i></a>
											${edit}
										</td>
									</tr>
						`);
						no++;
					});
				} else {
					$("#tableKreditLimit tbody").html('');
				}

				$('#tableKreditLimit').DataTable();
				swal.close();
				// $('#tableKreditLimit').DataTable();
			}
		});
	}



	function formatRupiah(angka, prefix) {
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for (var i = 0; i < angkarev.length; i++)
			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
		return rupiah.split('', rupiah.length - 1).reverse().join('');
	}
</script>