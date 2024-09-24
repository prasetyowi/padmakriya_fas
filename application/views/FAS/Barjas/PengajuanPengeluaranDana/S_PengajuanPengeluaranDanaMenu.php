<script>
	$(document).ready(function() {
		// alert('aaa')
		$(".select2").select2({
			width: "100%"
		});
		$(".custom-select").select2({
			width: "100%"
		});
		$('#tablePengajuan').DataTable();
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



	function viewModalAdd() {
		let idAnggaranDetail = $('#add_anggaran_detail_2');
		idAnggaranDetail.append($("<option />").val(null).text("-- PILIH ANGGARAN DAHULU --"));
		// idAnggaranDetail.empty()
		// $.ajax({
		//     type: 'GET',
		//     url: "<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/GetAnggaranBudget') ?>",
		//     data: {
		//         client_wms_id: null,
		//     },
		//     async: false,
		//     success: function(response) {
		//         let data = response;
		//         idAnggaranDetail.empty();
		//         idAnggaranDetail.append($("<option />").val(null).text("-- PILIH ANGGARAN DAHULU --"));
		//         if (data.length > 0) {
		//             $.each(data, function() {
		//                 idAnggaranDetail.append($("<option />").val(
		//                     this.anggaran_detail_2_id).text(this.anggaran_detail_2_kode +
		//                     ' - ' +
		//                     this.anggaran_detail_2_nama_anggaran));
		//             })
		//         }
		//     }
		// });
		$('#modalPengajuanDana').modal("show");
		let client = $('#add_perusahaan option:selected').val();
		if (client != '') {

			getAnggaran();
		}
		let add_tipe_transaksi = $('#add_tipe_transaksi')
		let id_jenis_pengadaan = $('#add_jenis_pengadaan option:selected').val();
		if (id_jenis_pengadaan != null) {
			$.ajax({
				type: 'POST',
				url: "<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/GetTipeTransaksiByTipePengadaanID') ?>",
				data: {
					id_jenis_pengadaan: id_jenis_pengadaan
				},
				dataType: "json",
				success: function(response) {
					add_tipe_transaksi.empty();
					let data = response;
					add_tipe_transaksi.append($("<option />").val(null).text("-- PILIH --"));
					if (data.length > 0) {
						$.each(data, function(i, v) {
							add_tipe_transaksi.append($("<option />").val(
								v.tipe_transaksi_id).text(v.tipe_transaksi_nama));
						})
					}
				}
			});
		}
	}
	$('#add_perusahaan').change(function() {
		let idAnggaranDetail = $('#add_anggaran_detail_2');
		let client = $('#add_perusahaan').val();
		let tahun = $('#approval_anggaran_detail_tahun').val() == "" ? <?= date("Y"); ?> : $('#approval_anggaran_detail_tahun').val();
		if (client != null) {
			$.ajax({
				type: 'POST',
				url: "<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/GetAnggaranDetail2ByYearDepoClient') ?>",
				data: {
					client_wms_id: client,
					tahun: tahun
				},
				success: function(response) {
					idAnggaranDetail.empty();
					let data = response;
					idAnggaranDetail.append($("<option />").val(null).text("-- PILIH ANGGARAN DAHULU --"));
					if (data.length > 0) {
						$.each(data, function() {
							idAnggaranDetail.append($("<option />").val(
								this.anggaran_detail_2_id).text(this.anggaran_detail_2_kode +
								' - ' +
								this.anggaran_detail_2_nama_anggaran));
						})
					}
				}
			});
		}
	})

	$('#add_jenis_pengadaan').change(function() {
		let add_tipe_transaksi = $('#add_tipe_transaksi')
		let id_jenis_pengadaan = $('#add_jenis_pengadaan option:selected').val();
		if (id_jenis_pengadaan != null) {
			$.ajax({
				type: 'POST',
				url: "<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/GetTipeTransaksiByTipePengadaanID') ?>",
				data: {
					id_jenis_pengadaan: id_jenis_pengadaan
				},
				dataType: "json",
				success: function(response) {
					add_tipe_transaksi.empty();
					let data = response;
					add_tipe_transaksi.append($("<option />").val(null).text("-- PILIH --"));
					if (data.length > 0) {
						$.each(data, function(i, v) {
							add_tipe_transaksi.append($("<option />").val(
								v.tipe_transaksi_id).text(v.tipe_transaksi_nama));
						})
					}
				}
			});
		}
	})

	function getAnggaran() {
		let idAnggaranDetail = $('#add_anggaran_detail_2')
		let client = $('#add_perusahaan option:selected').val();
		let tahun = $('#approval_anggaran_detail_tahun').val() == "" ? <?= date("Y"); ?> : $('#approval_anggaran_detail_tahun').val();
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/GetAnggaranDetail2ByYearDepoClient') ?>",
			data: {
				client_wms_id: client,
				tahun: tahun
			},
			success: function(response) {
				idAnggaranDetail.empty();
				let data = response;
				idAnggaranDetail.append($("<option />").val(null).text("-- PILIH ANGGARAN DAHULU --"));
				if (data.length > 0) {
					$.each(data, function() {
						idAnggaranDetail.append($("<option />").val(
							this.anggaran_detail_2_id).text(this.anggaran_detail_2_kode +
							' - ' +
							this.anggaran_detail_2_nama_anggaran));
					})
				}
			}
		});
	}


	$('#add_tanggal').change(function() {
		console.log($(this).val());
		let splittgl = $(this).val().split("-");
		let thanggaran = $("#approval_anggaran_detail_tahun").val(splittgl[0]).change();
	});
	$('#approval_anggaran_detail_tahun').change(function() {
		let idAnggaranDetail = $('#add_anggaran_detail_2');
		let client = $('#add_perusahaan').val();
		let tahun = $('#approval_anggaran_detail_tahun').val() == "" ? <?= date("Y"); ?> : $('#approval_anggaran_detail_tahun').val();
		if (client == "" || client == " " || client == null) {
			return;
		} else {
			$.ajax({
				type: 'POST',
				url: "<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/GetAnggaranDetail2ByYearDepoClient') ?>",
				data: {
					client_wms_id: client,
					tahun: tahun
				},
				success: function(response) {
					idAnggaranDetail.empty();
					let data = response;
					idAnggaranDetail.append($("<option />").val(null).text("-- PILIH ANGGARAN DAHULU --"));
					if (data.length > 0) {
						$.each(data, function() {
							idAnggaranDetail.append($("<option />").val(
								this.anggaran_detail_2_id).text(this.anggaran_detail_2_kode +
								' - ' +
								this.anggaran_detail_2_nama_anggaran));
						})
					}
				}
			});
		}
	})

	$("#add_default_pembayaran").change(function() {
		// alert('ass')
		if ($("#add_default_pembayaran").val() == "Tunai") {
			$("#add_bank").attr('disabled', true);
			$("#add_no_rekening").attr('disabled', true);
		} else {
			$("#add_bank").attr('disabled', false);
			$("#add_no_rekening").attr('disabled', false);
		}
	})
	$("#add_jenis_pengadaan").change(function() {
		if ($(this).val() == "PO" || $(this).val() == "Po" || $(this).val() == "po") {
			$("#formnodocpo").show();
			$("#add_nodocpo").val("");
		} else {
			$("#add_nodocpo").val("");
			$("#formnodocpo").hide();
		}
	})

	function getDataSearch() {
		var filter_status = $("#filter_status").val()
		var filter_biaya_id = $("#filter_biaya_id").val()
		var filter_tanggal = $("#filter_tanggal").val()
		var filter_perusahaan = $("#filter_perusahaan").val()
		Swal.showLoading()
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/getDataSearch') ?>",
			data: {
				filter_status: filter_status,
				filter_biaya_id: filter_biaya_id,
				filter_tanggal: filter_tanggal,
				filter_perusahaan: filter_perusahaan
			},
			success: function(response) {

				let no = 1;
				let data = response;

				if ($.fn.DataTable.isDataTable('#tablePengajuan')) {
					$('#tablePengajuan').DataTable().destroy();
				}

				$("#tablePengajuan tbody").empty();
				$("#tablePengajuan tbody").html('');
				if (data.length > 0) {
					$.each(data, function() {
						if (this.pengajuan_dana_status == 'Draft') {
							$('#tablePengajuan tbody').append(`
									<tr>
										<td style='vertical-align:middle; ' >${no}</td>
										<td style='vertical-align:middle; ' >${this.pengajuan_dana_kode}</td>
										<td style='vertical-align:middle; ' >${this.tgl_pengajuan}</td>
										<td style='vertical-align:middle; ' >${this.tgl_dibutuhkan}</td>
										<td style='vertical-align:middle; ' >${this.pengajuan_dana_judul}</td>
										<td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(this.pengajuan_dana_value))}</td>
										<td style='vertical-align:middle; ' >${this.pengajuan_dana_default_pembayaran}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.pengajuan_dana_who_create}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.pengajuan_dana_status}</td>
										<td style='vertical-align:middle; ' >
										<a class="btn btn-info" tittle="edit" target="_blank" href="<?php echo site_url('FAS/Barjas/PengajuanPengeluaranDana/PengajuanPengeluaranDanaEdit?kode=') ?>${this.pengajuan_dana_kode}"><i class="fas fa-edit"></i></a>
										<a class="btn btn-primary" tittle="lihat" target="_blank" href="<?php echo site_url('FAS/Barjas/PengajuanPengeluaranDana/PengajuanPengeluaranDanaView?kode=') ?>${this.pengajuan_dana_kode}"><i class="fas fa-eye"></i></a>
										</td>
									</tr>
						`);
						} else {
							$('#tablePengajuan tbody').append(`
									<tr>
										<td style='vertical-align:middle; ' >${no}</td>
										<td style='vertical-align:middle; ' >${this.pengajuan_dana_kode}</td>
										<td style='vertical-align:middle; ' >${this.tgl_pengajuan}</td>
										<td style='vertical-align:middle; ' >${this.tgl_dibutuhkan}</td>
										<td style='vertical-align:middle; ' >${this.pengajuan_dana_judul}</td>
										<td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(this.pengajuan_dana_value))}</td>
										<td style='vertical-align:middle; ' >${this.pengajuan_dana_default_pembayaran}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.pengajuan_dana_who_create}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.pengajuan_dana_status}</td>
										<td style='vertical-align:middle; ' >
										
										<a class="btn btn-primary" tittle="lihat" target="_blank" href="<?php echo site_url('FAS/Barjas/PengajuanPengeluaranDana/PengajuanPengeluaranDanaView?kode=') ?>${this.pengajuan_dana_kode}"><i class="fas fa-eye"></i></a>
										</td>
									</tr>
						`);

						}
						no++;
					});
				} else {
					$("#tablePengajuan tbody").html('');
				}

				$('#tablePengajuan').DataTable();
				swal.close();
				// $('#tablePengajuan').DataTable();
			}
		});
	}
	//save pengajuan
	$('#PengajuanDana').submit(function(e) {
		e.preventDefault();
		let add_kategori_biaya_id = $("#add_kategori_biaya").val();
		let add_tipe_biaya_id = $("#add_tipe_biaya").val();
		let add_judul = $("#add_judul").val();
		let add_keterangan = $("#add_keterangan").val();
		let add_selected_date = $("#add_selected_date").val();
		let add_nilai = $("#add_nilai").val();
		let add_default_pembayaran = $("#add_default_pembayaran").val();
		let bank_account_id = $("#bank").val();
		let add_no_rekening = $("#add_no_rekening").val();
		let add_nama_penerima = $("#add_nama_penerima").val();
		let anggaran_detail_2_id = $('#add_anggaran_detail_2').val();
		let add_perusahaan = $('#add_perusahaan').val();
		let add_jenis_pengadaan = $('#add_jenis_pengadaan option:selected').val();
		let add_nodocpo = $('#add_nodocpo').val();
		let add_jenis_asset = $('#add_jenis_asset').val();
		let add_tipe_transaksi = $('#add_tipe_transaksi').val();
		// let pengajuan_dana_attacment_1 = $('#approval_file').val();
		let attachment = $('#add_file');
		console.log($('#add_file_file'));
		if (add_jenis_pengadaan == "Po" || add_jenis_pengadaan == "PO") {
			if (add_nodocpo == "" || add_nodocpo == null) {
				alert('No PO Kosong');
				return false;
			}
		}
		if (add_status != 'Draft') {
			if (attachment[0].files.length === 0) {
				alert('Harap upload file atachment dahulu !')
				return false;
			}
		}

		// console.log(pengajuan_dana_attacment_1);
		if (anggaran_detail_2_id == '') {
			alert('Harap pilih anggaran terlebih dahulu!')
			return false;
		}
		if (add_default_pembayaran == "Tunai") {
			if (add_judul == "" || add_selected_date ==
				"" ||
				add_nilai == "" ||
				add_default_pembayaran == "" ||
				add_nama_penerima == "") {
				alert('Harap Lengkapi data dahulu !')
				return false;
			}
			bank_account_id = null;
			add_no_rekening = null;
		} else {
			if (add_judul == "" || add_selected_date ==
				"" ||
				add_nilai == "" ||
				add_default_pembayaran == "" || bank_account_id == "" || add_no_rekening == "" ||
				add_nama_penerima == "") {
				alert('Harap Lengkapi data dahulu !')
				return false;
			}
		}

		let files = attachment[0].files[0];
		var formData = new FormData(this);
		formData.append('file', files);
		formData.append('add_jenis_pengadaan', add_jenis_pengadaan);
		Swal.fire({
			title: 'Apakah Anda yakin?',
			text: "Pastikan data yang diinput sudah benar!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya!'
		}).then((result) => {
			if (result.value == true) {
				$.ajax({
					url: "<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/SavePengajuanDana') ?>",
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					cache: false,
					dataType: "JSON",
					async: false,
					success: function(response) {
						if (response.status == 1) {
							Swal.fire(
								'Success!',
								'Data has been saved.',
								'success'
							)
							setTimeout(function() {
								window.location.href =
									"<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/PengajuanPengeluaranDanaMenu') ?>";
							}, 3000);
						} else {
							Swal.fire(
								'Error!',
								response.message,
								'warning'
							)
						}
					},
				});
			}
		})
	});

	function addApproval() {
		if ($('#chk_approval').is(':checked')) {
			$('#add_status').val('In progress approval')
		} else {
			$('#add_status').val('Draft')
		}
	}

	function formatRupiah(angka, prefix) {
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for (var i = 0; i < angkarev.length; i++)
			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
		return rupiah.split('', rupiah.length - 1).reverse().join('');
	}
</script>