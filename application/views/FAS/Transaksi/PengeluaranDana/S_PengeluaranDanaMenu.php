<script>
	$(document).ready(function() {
		// alert('aaa')
		$(".select2").select2({
			width: "100%"
		});
		$(".custom-select").select2({
			width: "100%"
		});
		$('#tablePengeluaran').DataTable();
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
		var filter_kategori_biaya = $("#filter_kategori_biaya").val()
		var filter_tanggal = $("#filter_tanggal").val()
		var filter_status = $("#filter_status").val()
		var filter_perusahaan = $("#filter_perusahaan").val()

		Swal.showLoading()
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/Transaksi/PengeluaranDana/getDataSearch') ?>",
			data: {
				filter_status: filter_status,
				filter_kategori_biaya: filter_kategori_biaya,
				filter_tanggal: filter_tanggal,
				filter_perusahaan: filter_perusahaan
			},
			success: function(response) {

				let no = 1;
				let data = response;

				if ($.fn.DataTable.isDataTable('#tablePengeluaran')) {
					$('#tablePengeluaran').DataTable().destroy();
				}

				$("#tablePengeluaran tbody").empty();
				$("#tablePengeluaran tbody").html('');
				if (data.length > 0) {
					// alert('aaa')
					$.each(data, function() {
						$('#tablePengeluaran tbody').append(`
									<tr>
										<td style='vertical-align:middle; ' >${no}</td>
										<td style='vertical-align:middle; ' >${this.transaksi_dana_kode}</td>
										<td style='vertical-align:middle; ' >${this.tgl}</td>
										
										<td style='vertical-align:middle; ' >${this.transaksi_dana_pembayaran}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.transaksi_dana_nama_pemohon}</td>
										<td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(this.transaksi_dana_jumlah))}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.transaksi_dana_who_create}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.transaksi_dana_status}</td>
										<td style='vertical-align:middle; text-align: center;' ></td>
										<td style='vertical-align:middle; ' >
											<a class="btn btn-primary" tittle="lihat" target="_blank" href="<?php echo site_url('FAS/Transaksi/PengeluaranDana/PengeluaranDanaView?kode=') ?>${this.transaksi_dana_kode}"><i class="fas fa-eye"></i></a>
										</td>
									</tr>
						`);
						no++;
					});
				} else {
					$("#tablePengeluaran tbody").html('');
				}

				$('#tablePengeluaran').DataTable();
				swal.close();
				// $('#tablePengeluaran').DataTable();
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