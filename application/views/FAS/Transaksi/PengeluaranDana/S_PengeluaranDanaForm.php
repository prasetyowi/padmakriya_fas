<script>
	let arrPermintaan = []
	var total_nominal_aktual = 0;

	$(document).ready(function() {
		// alert('aaa')
		$(".select2").select2({
			width: "100%"
		});
		$(".custom-select").select2({
			width: "100%"
		});
		// $('#tablePermintaan').DataTable();
		$('#tableAddPermintaan').DataTable();
		$('#tablePermintaan').DataTable({
			paging: false,
			ordering: false,
			info: false,
		});
		viewTablePermintaan()

	});
	$("#add_perusahaan").change(function() {
		let pt = $("#add_perusahaan option:selected").val()
		if (pt != '') {
			$.ajax({
				type: 'POST',
				async: false,
				url: "<?= base_url('FAS/Transaksi/PengeluaranDana/getDataPemohon') ?>",
				data: {
					add_perusahaan: pt,
				},
				dataType: 'JSON',
				success: function(response) {
					let add_pemohon = $("#add_pemohon").empty()
					add_pemohon.append($("<option />").val(null).text("-- Pilih Pemohon --"));
					if (response != '') {

						$.each(response, function(i, v) {
							add_pemohon.append($("<option />").val(
								v.pemohon).text(v.pemohon));
						})
					}

				}
			})
		}
	})

	$("#add_default_pembayaran").change(function() {
		// alert('ass')
		if ($("#add_default_pembayaran").val() == "Tunai") {
			$(".add_bank").attr('disabled', true);
			$(".add_no_rekening").attr('disabled', true);
			$(".add_nama_penerima").attr('disabled', true);
			$("#view_default_pembayaran").val('Tunai');
		} else {
			$(".add_bank").attr('disabled', false);
			$(".add_no_rekening").attr('disabled', false);
			$(".add_nama_penerima").attr('disabled', false);
			$("#view_default_pembayaran").val('Non Tunai');
		}
		//reset data permntaan
		arrPermintaan = []
		// viewTablePermintaan();
	})

	$("#add_kategori_biaya").change(function() {
		//cari data yg dipilih/diselect
		var selected = $(this).find('option:selected');
		// cari data-nama
		var nama = selected.data('nama');
		// $("#add_kategori_biaya").val()
		$("#view_kategori_biaya").val(nama)
		//reset data permntaan
		arrPermintaan = []
		viewTablePermintaan();

	})

	$("#add_pemohon").change(function() {
		//cari data yg dipilih/diselect
		var selected = $(this).find('option:selected');
		// cari data-nama
		var nama = selected.data('nama');
		// $("#add_kategori_biaya").val()
		$("#view_pemohon").val($(this).val())
		//reset data permntaan
		arrPermintaan = []
		viewTablePermintaan();

	})

	function searchPermintaanPengeluaran() {

		var add_perusahaan = $("#add_perusahaan option:selected").val()
		var default_pembayaran = $("#add_default_pembayaran").val()
		var who_created = $("#add_pemohon option:selected").val()
		if (add_perusahaan == "") {
			alert("Harap pilih Perusahaan terlebih dahulu!")
			return false;
		}
		if (who_created == "") {
			alert("Harap pilih pemohon terlebih dahulu!")
			return false;
		}
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/Transaksi/PengeluaranDana/getDataPermintaanPengeluaran') ?>",
			data: {
				add_perusahaan: add_perusahaan,
				who_created: who_created
			},
			success: function(response) {

				let no = 1;
				let data = response;

				if ($.fn.DataTable.isDataTable('#tableAddPermintaan')) {
					$('#tableAddPermintaan').DataTable().destroy();
				}

				$("#tableAddPermintaan tbody").empty();
				$("#tableAddPermintaan tbody").html('');
				if (data.length > 0) {
					// alert('data ada')
					$.each(data, function() {
						//cek apakah ada data yg sudah ditambahkan
						let checked = "";
						let index_dataD = arrPermintaan.findIndex(item => item.id ==
							this.pengajuan_dana_id);
						if (index_dataD >= 0) {
							checked = "checked"
						}
						$('#tableAddPermintaan tbody').append(`
							<tr 
								data-id="${this.pengajuan_dana_id}"
								data-kode="${this.pengajuan_dana_kode}"
								data-tgl_pengajuan="${this.tgl_pengajuan}"
								data-tgl_dibutuhkan="${this.tgl_dibutuhkan}"
								data-judul="${this.pengajuan_dana_judul}"
								data-nominal="${parseInt(this.pengajuan_dana_value)}"
								data-anggaran="${this.anggaran_detail_2_nama_anggaran}"
								data-keterangan="${this.pengajuan_dana_keterangan}"
								data-attachment="${this.pengajuan_dana_attacment_1}"
								data-tipe_transaksi_id="${this.pengajuan_dana_tipe_transaksi}"
								data-tipe_transaksi_nama="${this.tipe_transaksi_nama}"
								>
									<td style='vertical-align:middle; text-align: center; ' ><input type="checkbox" class="" ${checked} style="width: 20px;height: 20px;"><input type="hidden" value="${this.pengajuan_dana_id}"></td>
									<td style='vertical-align:middle; ' >${this.pengajuan_dana_kode}</td>
									<td style='vertical-align:middle; ' >${this.tgl_pengajuan}</td>
									<td style='vertical-align:middle; ' >${this.tgl_dibutuhkan}</td>
									<td style='vertical-align:middle; ' >${this.pengajuan_dana_judul}</td>
									<td style='vertical-align:middle; ' >${this.anggaran_detail_2_nama_anggaran}</td>
									<td style='vertical-align:middle; ' >${this.tipe_transaksi_nama==null?'':this.tipe_transaksi_nama}</td>
									<td style='vertical-align:middle; ' >${this.pengajuan_dana_keterangan}</td>
									<td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(this.pengajuan_dana_value))}</td>
							</tr>
						`);
					});
				} else {
					$("#tableAddPermintaan tbody").html('');
				}
				$('#tableAddPermintaan').DataTable();
			}
		});
		$('#modalAddPermintaan').modal("show");
	}

	function addPermintaan() {

		$('#tableAddPermintaan input:checked').each(function() {
			let idPermintaan = $(this).closest('tr').attr('data-id');

			let index_dataD = arrPermintaan.findIndex(item => item.id == idPermintaan);
			// cek apakah data sudah pernah ada
			if (index_dataD >= 0) {
				// data sudah ada
			} else {
				arrPermintaan.push({
					id: $(this).closest('tr').attr('data-id'),
					kode: $(this).closest('tr').attr('data-kode'),
					tgl_pengajuan: $(this).closest('tr').attr('data-tgl_pengajuan'),
					tgl_dibutuhkan: $(this).closest('tr').attr('data-tgl_dibutuhkan'),
					judul: $(this).closest('tr').attr('data-judul'),
					anggaran: $(this).closest('tr').attr('data-anggaran'),
					tipe_transaksi_id: $(this).closest('tr').attr('data-tipe_transaksi_id'),
					tipe_transaksi_nama: $(this).closest('tr').attr('data-tipe_transaksi_nama'),
					nominal: $(this).closest('tr').attr('data-nominal'),
					nominal_aktual: 0,
					keterangan: $(this).closest('tr').attr('data-keterangan'),
					attachment: $(this).closest('tr').attr('data-attachment'),
				});
			}
		});
		// console.log(arrPermintaan);
		viewTablePermintaan()
		$('#modalAddPermintaan').modal("hide");

	}

	function viewTablePermintaan() {

		if ($.fn.DataTable.isDataTable('#tablePermintaan')) {
			$('#tablePermintaan').DataTable().destroy();
		}

		$("#tablePermintaan tbody").empty();
		$("#tablePermintaan tbody").html('');
		let no = 1;
		arrPermintaan.forEach(function(item, index) {
			total_nominal_aktual += item.nominal_aktual
			$('#tablePermintaan tbody').append(`
				<tr data-id="${item.id}">
					<td style='vertical-align:middle; ' >${no}</td>
					<td style='vertical-align:middle; ' >${item.kode}</td>
					<td style='vertical-align:middle; ' >${item.tgl_pengajuan}</td>
					<td style='vertical-align:middle; ' >${item.tgl_dibutuhkan}</td>
					<td style='vertical-align:middle; ' >${item.judul}</td>
					<td style='vertical-align:middle; ' >${item.anggaran}</td>
					<td style='vertical-align:middle; ' >${item.tipe_transaksi_nama}</td>
					<td style='vertical-align:middle; ' >${item.keterangan}</td>
					<td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(item.nominal))}<input type="hidden" id="nominal-${index}" value="parseInt(item.nominal)"></td>
					<td style='vertical-align:middle; text-align: center;' ><input type="text" name="nominal_aktual[]" id="nominal-aktual-${index}" onkeyup="ubahNominal('${index}')" class="txtnilai form-control" value="${item.nominal_aktual}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" /></td>
					<td style='vertical-align:middle; ' >			
						<a class="btn btn-primary" title="lihat Attachment" target="_blank" href="<?= base_url() . 'FAS/Barjas/PengajuanPengeluaranDana/ViewAttachment?file=' ?>${item.attachment}"><i class="fas fa-eye"></i></a>
						<a class="btn btn-danger" title="delete" onclick="deletePermintaan('${index}')" ><i class="fas fa-trash"></i></a>
					</td>
				</tr>
			`);
			no++
		});
		$('#tablePermintaan tbody').append(`
				<tr bgcolor="yellow" >
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style='vertical-align:middle; text-align: right;font-weight:bold' >TOTAL</td>
					<td style='vertical-align:middle; font-weight:bold ' ><span id="span_nominal_aktual" >${formatRupiah(parseInt(total_nominal_aktual))}</span> <input type="hidden" id="total_nominal_aktual" /></td>
					
					<td style='vertical-align:middle; ' ></td>			
				</tr>
		`);
		$('#tablePermintaan').DataTable({
			paging: false,
			ordering: false,
			info: false,
		});
	}

	function ubahNominal(index) {

		let nominal_aktual = $('#nominal-aktual-' + index).val()
		let nominal = $('#nominal-aktual-' + index).val()
		if (nominal_aktual < 0) {
			$('#nominal-aktual-' + index).val(0)
		}
		//jika nominal aktual melebihi nominL pengajuan
		// if (nominal_aktual > nominal) {
		//     alert("Nominal aktual tidak boleh m,elebihi nominal permintaan !")
		//     $('#nominal-aktual-' + index).val(0)
		// }
		// alert(nominal)
		// ubah nominal aktual di array
		arrPermintaan[index]['nominal_aktual'] = nominal_aktual

		let total_nominal_aktual = 0;
		arrPermintaan.forEach(item => {
			total_nominal_aktual += parseInt(item.nominal_aktual);
		});
		$("#total_nominal_aktual").val(total_nominal_aktual);
		$("#span_nominal_aktual").html(formatRupiah(parseInt(total_nominal_aktual)));

	}

	function deletePermintaan(index) {
		arrPermintaan.splice(index, 1);
		viewTablePermintaan()
	}

	function inputNominalKasir() {
		let nominal_kasir = $('#input_nominal').val()
		let total_nominal_aktual = $('#total_nominal_aktual').val();
		if (nominal_kasir != total_nominal_aktual) {
			alert('Nilai input harus sama dengan total nominal aktual!')
			$('#input_nominal').val(0)
		}

	}

	//save Pengeluaran
	$('#PengeluaranDana').submit(function(e) {
		e.preventDefault();
		// let add_kategori_biaya_id = $("#add_kategori_biaya").val();

		let add_judul = $("#add_judul").val();
		let add_keterangan = $("#add_keterangan").val();

		let add_nilai = $("#input_nominal").val();
		let add_default_pembayaran = $("#add_default_pembayaran").val();
		let bank_account_id_penerima = $("#add_bank_penerima").val();
		let bank_account_id_pengirim = $("#add_bank_pengirim").val();
		let add_no_rekening_pengirim = $("#add_no_rekening_rekening").val();
		let add_no_rekening_penerima = $("#add_no_rekening_penerima").val();
		let add_nama_penerima = $("#add_nama_penerima").val();
		let add_nama_pengirim = $("#add_nama_pengirim").val();
		let add_perusahaan = $("#add_perusahaan").val();
		let input_nominal = $("#input_nominal").val();

		// let Pengeluaran_dana_attacment_1 = $('#approval_file').val();
		let attachment = $('#add_file');

		if (add_perusahaan == "") {
			alert('Harap pilih perusahaan !')
			return false;
		}
		if (arrPermintaan.length === 0) {
			alert('Harap tambahkan data permintaan pengeluaran dana terlebih dahulu !')
			return false;
		}
		if (input_nominal == 0) {
			alert('Harap input jumlah pengeluaran !')
			return false;
		}
		if (attachment[0].files.length === 0) {
			alert('Harap upload file atachment dahulu !')
			return false;
		}

		if (add_default_pembayaran == "Tunai") {
			if (add_judul == "" ||
				add_nilai == "" ||
				add_default_pembayaran == ""
				// || add_nama_penerima == ""
			) {
				alert('Harap Lengkapi data dahulu !')
				return false;
			}
			bank_account_id = null;
			add_no_rekening = null;
		} else {
			if (add_judul == "" ||
				add_nilai == "" ||
				add_default_pembayaran == "" ||
				bank_account_id_penerima == "" || bank_account_id_pengirim == "" ||
				add_no_rekening_pengirim == "" || add_no_rekening_penerima == "" ||
				add_nama_penerima == "" || add_nama_pengirim == "") {
				alert('Harap Lengkapi data dahulu !')
				return false;
			}
		}

		let files = attachment[0].files[0];
		var formData = new FormData(this);
		let json_arr = JSON.stringify(arrPermintaan)
		formData.append('file', files);
		formData.append('dataPermintaan', json_arr);
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
					url: "<?= base_url('FAS/Transaksi/PengeluaranDana/SavePengeluaranDana') ?>",
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
									"<?= base_url('FAS/Transaksi/PengeluaranDana/PengeluaranDanaMenu') ?>";
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

	function formatRupiah(angka, prefix) {
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for (var i = 0; i < angkarev.length; i++)
			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
		return rupiah.split('', rupiah.length - 1).reverse().join('');
	}
</script>