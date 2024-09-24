<script>
	let arrPenyelesaian = []
	let arrIskasbon = [];
	let arrTransaksiDana = [];

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
		let urinama = '<?= $this->uri->segment(4); ?>'
		console.log(urinama);
		if (urinama == 'PenyelesaianKasbonForm') {
			viewTablePermintaan()
			viewNameNotSame()
		}
		if (urinama == 'PenyelesaianKasbonEdit') {
			if ($.fn.DataTable.isDataTable('#tablePermintaan')) {
				$('#tablePermintaan').DataTable().destroy();
			}
			$('#tablePermintaan').DataTable({
				paging: false,
				ordering: false,
				info: false,
			});
			let nu = $('#tablePermintaan tbody tr').length;
			let total_qty_aktual = 0;
			let index = 0;
			let nominal = "";
			for (index = 1; index <= nu; index++) {
				total_qty_aktual += parseInt($('#qty-aktual-' + index).val());
			}
			$("#total_qty_aktual").val(total_qty_aktual);
			$("#span_qty_aktual").html(formatRupiah(parseInt(total_qty_aktual)));
			let total_nominal_aktual = 0;
			for (index = 1; index <= nu; index++) {
				total_nominal_aktual += parseInt($('#nominal-aktual-' + index).val());
				$(`#spanTotal-${index}`).html(formatRupiah(parseInt($('#nominal-aktual-' + index).val())));
			}
			$("#total_nominal_aktual").val(total_nominal_aktual);
			$("#span_nominal_aktual").html(formatRupiah(parseInt(total_nominal_aktual)));

		}
		if (urinama == 'PenyelesaianKasbonView') {
			if ($.fn.DataTable.isDataTable('#tablePermintaan')) {
				$('#tablePermintaan').DataTable().destroy();
			}
			$('#tablePermintaan').DataTable({
				paging: false,
				ordering: false,
				info: false,
			});
			let nu = $('#tablePermintaan tbody tr').length;
			let total_qty_aktual = 0;
			let index = 0;
			let nominal = "";
			for (index = 1; index <= nu; index++) {
				total_qty_aktual += parseInt($('#qty-aktual-' + index).val());
			}
			$("#total_qty_aktual").val(total_qty_aktual);
			$("#span_qty_aktual").html(formatRupiah(parseInt(total_qty_aktual)));
			let total_nominal_aktual = 0;
			for (index = 1; index <= nu; index++) {
				total_nominal_aktual += parseInt($('#nominal-aktual-' + index).val());
				$(`#spanTotal-${index}`).html(formatRupiah(parseInt($('#nominal-aktual-' + index).val())));
			}
			$("#total_nominal_aktual").val(total_nominal_aktual);
			$("#span_nominal_aktual").html(formatRupiah(parseInt(total_nominal_aktual)));

		}
	});

	function getDataSearch() {
		var filter_tanggal = $("#filter_tanggal").val()
		var filter_status = $("#filter_status").val()
		var filter_perusahaan = $("#filter_perusahaan").val()

		Swal.showLoading()
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/Transaksi/PenyelesaianKasbon/getDataSearch') ?>",
			data: {
				filter_status: filter_status,
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
						if (this.penyelesaian_kasbon_status == 'Draft') {

							$('#tablePengeluaran tbody').append(`
									<tr>
										<td style='vertical-align:middle; ' >${no}</td>
										<td style='vertical-align:middle; ' >${this.penyelesaian_kasbon_kode}</td>
										<td style='vertical-align:middle; ' >${this.tgl}</td>
										<td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(this.kasbon_value))}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.penyelesaian_kasbon_status}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.penyelesaian_kasbon_who_create}</td>
										<td style='vertical-align:middle; ' >
											<a class="btn btn-primary" tittle="lihat" target="_blank" href="<?php echo site_url('FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonEdit?id=') ?>${this.penyelesaian_kasbon_id}"><i class="fas fa-pencil"></i></a>
											<a class="btn btn-warning" tittle="lihat" target="_blank" href="<?php echo site_url('FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonView?id=') ?>${this.penyelesaian_kasbon_id}"><i class="fas fa-eye"></i></a>
										</td>
									</tr>
							`);
						} else if (this.penyelesaian_kasbon_status == 'Approved') {

							$('#tablePengeluaran tbody').append(`
									<tr>
										<td style='vertical-align:middle; ' >${no}</td>
										<td style='vertical-align:middle; ' >${this.penyelesaian_kasbon_kode}</td>
										<td style='vertical-align:middle; ' >${this.tgl}</td>
										<td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(this.kasbon_value))}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.penyelesaian_kasbon_status}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.penyelesaian_kasbon_who_create}</td>
										<td style='vertical-align:middle; ' >
											<a class="btn btn-warning" tittle="lihat" target="_blank" href="<?php echo site_url('FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonView?id=') ?>${this.penyelesaian_kasbon_id}"><i class="fas fa-eye"></i></a>
										</td>
									</tr>
							`);
						} else {

							$('#tablePengeluaran tbody').append(`
									<tr>
										<td style='vertical-align:middle; ' >${no}</td>
										<td style='vertical-align:middle; ' >${this.penyelesaian_kasbon_kode}</td>
										<td style='vertical-align:middle; ' >${this.tgl}</td>
										<td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(this.kasbon_value))}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.penyelesaian_kasbon_status}</td>
										<td style='vertical-align:middle; text-align: center;' >${this.penyelesaian_kasbon_who_create}</td>
										<td style='vertical-align:middle; ' >
											<a class="btn btn-warning" tittle="lihat" target="_blank" href="<?php echo site_url('FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonView?id=') ?>${this.penyelesaian_kasbon_id}"><i class="fas fa-eye"></i></a>
										</td>
									</tr>
							`);
						}
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

	function viewNameNotSame() {
		arrTransaksiDana = []
		$.ajax({
			type: 'GET',
			async: false,
			url: "<?= base_url('FAS/Transaksi/PenyelesaianKasbon/getAllDataPenyelesaianKasbon') ?>",
			dataType: 'JSON',
			success: function(response) {
				if (response != '') {
					$.each(response, function(i, v) {
						arrTransaksiDana.push(v.pemohon)
					})
				}

			}
		})
	}
	$("#add_perusahaan").change(function() {
		let pt = $("#add_perusahaan option:selected").val()
		if (pt != '') {
			$.ajax({
				type: 'POST',
				async: false,
				url: "<?= base_url('FAS/Transaksi/PenyelesaianKasbon/getDataPemohon') ?>",
				data: {
					add_perusahaan: pt,
				},
				dataType: 'JSON',
				success: function(response) {
					let add_nama_penyelesaian = $("#add_nama_penyelesaian").empty()
					add_nama_penyelesaian.append($("<option />").val(null).text("-- Pilih Pemohon --"));
					if (response != '') {

						$.each(response, function(i, v) {
							if (jQuery.inArray(v.pemohon, arrTransaksiDana) !== -1) {

							} else {

								add_nama_penyelesaian.append($("<option />").val(
									v.pemohon).text(v.pemohon));
							}
						})
					}

				}
			})
		}
	})
	$("#add_nama_penyelesaian").change(function() {
		let pt = $("#add_perusahaan option:selected").val()
		let who = $("#add_nama_penyelesaian option:selected").val()
		if (pt != '') {
			$.ajax({
				type: 'POST',
				async: false,
				url: "<?= base_url('FAS/Transaksi/PenyelesaianKasbon/getDataPermintaanPengeluaran') ?>",
				data: {
					add_perusahaan: pt,
					who_created: who,
				},
				dataType: 'JSON',
				success: function(response) {

					let add_no_transaksi = $("#add_no_transaksi").empty()
					add_no_transaksi.append($("<option />").val(null).text("-- Pilih Kode --"));
					if (response != '') {


						$.each(response, function(i, v) {

							add_no_transaksi.append($("<option />").val(
								v.transaksi_dana_id).text(v.transaksi_dana_kode));

						})
					}

				}
			})
		}
	})
	$("#add_no_transaksi").change(function() {
		let pt = $("#add_perusahaan option:selected").val()
		let who = $("#add_nama_penyelesaian option:selected").val()
		let no = $("#add_no_transaksi option:selected").val()
		if (pt != '') {
			$.ajax({
				type: 'POST',
				async: false,
				url: "<?= base_url('FAS/Transaksi/PenyelesaianKasbon/getSubTotal') ?>",
				data: {
					add_perusahaan: pt,
					who_created: who,
					no: no,
				},
				dataType: 'JSON',
				success: function(response) {
					$('#pengajuan_dana_id').val(response.pengajuan_dana_id)
					$('#add_value_kasbon').val(formatRupiah(parseInt(response.total)));
					$('#total_value_kasbon').val(formatRupiah(parseInt(response.total)));
					$('#hvaluekasbon').val(parseInt(response.total));


				}
			})
		}
	})
	$(document).on('click', '.HapusItemPaketAdd', function() {

		$(this).parent().parent().remove();
		$("#tablePermintaan tbody tr").each(function(i, v) {
			let no = $(this).find("td:eq(0)")
			let name = $(this).find("td:eq(1) input[type='text']")
			let qty = $(this).find("td:eq(2) input[type='text']")
			let nominal = $(this).find("td:eq(3) input[type='text']")
			let total = $(this).find("td:eq(4) span")
			no.html(i + 1)
			qty.attr('id', `qty-aktual-${i+1}`)
			name.attr('id', `txtname-${i+1}`)
			qty.attr('onkeyup', `ubahQty('${i+1}')`)
			nominal.attr('onkeyup', `ubahNominal('${i+1}')`)
			nominal.attr('id', `nominal-aktual-${i+1}`)
			total.attr('id', `spanTotal-${i+1}`)
		});

		let nu = $('#tablePermintaan tbody tr').length;
		let total_qty_aktual = 0;
		let index = 0;
		let nominal = "";
		for (index = 1; index <= nu; index++) {
			total_qty_aktual += parseInt($('#qty-aktual-' + index).val());
		}
		$("#total_qty_aktual").val(total_qty_aktual);
		$("#span_qty_aktual").html(formatRupiah(parseInt(total_qty_aktual)));
		let total_nominal_aktual = 0;
		for (index = 1; index <= nu; index++) {
			total_nominal_aktual += parseInt($('#nominal-aktual-' + index).val());
			$(`#spanTotal-${index}`).html(formatRupiah(parseInt($('#nominal-aktual-' + index).val())));
		}
		$("#total_nominal_aktual").val(total_nominal_aktual);
		$("#span_nominal_aktual").html(formatRupiah(parseInt(total_nominal_aktual)));
	});

	function viewTablePermintaan() {
		if ($.fn.DataTable.isDataTable('#tablePermintaan')) {
			$('#tablePermintaan').DataTable().destroy();
		}

		$("#tablePermintaan tbody").empty();
		$("#tablePermintaan tbody").html('');
		$('#tablePermintaan').DataTable({
			paging: false,
			ordering: false,
			info: false,
		});
	}

	function AppendToTable() {
		if ($.fn.DataTable.isDataTable('#tablePermintaan')) {
			$('#tablePermintaan').DataTable().destroy();
		}
		let nu = $('#tablePermintaan tbody tr').length;
		$('#tablePermintaan tbody').append(`
				<tr>
					<td style='vertical-align:middle; text-align: center;'>${nu+1}</td>
					<td style='vertical-align:middle; text-align: center;'><input type="text" id="txtname-${nu+1}" class="form-control" value=""></td>
					<td style='vertical-align:middle; text-align: center;'><input type="text" class="form-control" value="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="qty-aktual-${nu+1}" onkeyup="ubahQty('${nu+1}')"></td>
					<td style='vertical-align:middle; text-align: center;'><input type="text" class="form-control" value="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="nominal-aktual-${nu+1}" onkeyup="ubahNominal('${nu+1}')"></td>
					<td style='vertical-align:middle; text-align: center;'><span id="spanTotal-${nu+1}">0</span></td>
					<td style='vertical-align:middle; text-align: center;'><a class="btn btn-danger HapusItemPaketAdd" title="delete"  ><i class="fas fa-trash"></i></a></td>
				</tr>
			`);
	}

	function ubahQty(index) {
		let qty_aktual = $('#qty-aktual-' + index).val()
		let qty = $('#qty-aktual-' + index).val()
		if (qty_aktual < 0) {
			$('#qty-aktual-' + index).val(0)
		}
		let nu = $('#tablePermintaan tbody tr').length;
		let total_qty_aktual = 0;
		for (let index = 1; index <= nu; index++) {
			total_qty_aktual += parseInt($('#qty-aktual-' + index).val());
		}
		$("#total_qty_aktual").val(total_qty_aktual);
		$("#span_qty_aktual").html(formatRupiah(parseInt(total_qty_aktual)));
	}

	function ubahNominal(index) {
		let nominal_aktual = $('#nominal-aktual-' + index).val()
		let nominal = $('#nominal-aktual-' + index).val()
		if (nominal_aktual < 0) {
			$('#nominal-aktual-' + index).val(0)
		}
		let nu = $('#tablePermintaan tbody tr').length;
		let total_nominal_aktual = 0;
		for (let index = 1; index <= nu; index++) {
			total_nominal_aktual += parseInt($('#nominal-aktual-' + index).val());
		}
		$("#total_nominal_aktual").val(total_nominal_aktual);
		$(`#spanTotal-${index}`).html(formatRupiah(parseInt(nominal)));
		$("#span_nominal_aktual").html(formatRupiah(parseInt(total_nominal_aktual)));
		$("#total_pengeluaran_dana").val(formatRupiah(parseInt(total_nominal_aktual)));
		$("#hpengeluarandana").val(parseInt(total_nominal_aktual));
		let total_keluar = $('#hpengeluarandana').val()
		let total_kasbon = $('#hvaluekasbon').val()
		let total = total_kasbon - total_keluar
		$('#total_penyelesaian_kasbon').val(formatRupiah(parseInt(total)))
		$('#htotalkasbon').val(parseInt(total))
	}

	function formatRupiah(angka, prefix) {
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for (var i = 0; i < angkarev.length; i++)
			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
		return rupiah.split('', rupiah.length - 1).reverse().join('');
	}

	$(document).on('click', '#btnsaveData', function() {
		let perusahaan = $('#add_perusahaan option:selected').val();
		let nm_penyelesaian = $('#add_nama_penyelesaian option:selected').val();
		let no_transaksi = $('#add_no_transaksi option:selected').val();
		arrPenyelesaian = [];
		let nu = $('#tablePermintaan tbody tr').length;
		let name = "";
		let attachment = $('#add_file');
		let statusArr = 1;

		let typekasbon = "D";
		if ($('#htotalkasbon').val() > 0) {
			typekasbon = "K";
		}
		if (perusahaan == '') {
			alert('Mohon Pilih Perusahaan')
			return false;
		}
		if (nm_penyelesaian == '') {
			alert('Mohon Pilih Nama Penyelesaian Kasbon')
			return false;
		}
		if (no_transaksi == '') {
			alert('Mohon Pilih No Transaksi')
			return false;
		}
		for (let index = 1; index <= nu; index++) {
			let name = $(`#txtname-${index}`).val()
			let qty = $(`#qty-aktual-${index}`).val()
			let harga = $(`#nominal-aktual-${index}`).val()
			if (name == '') {
				alert(`Mohon Isi Nama Item ke-${index}`)
				return false;
			}
			if (parseInt(qty) == 0) {
				alert(`Mohon Isi Qty Item ke-${index}`)
				return false;
			}
			if (parseInt(harga) == 0) {
				alert(`Mohon Isi Harga Item ke-${index}`)
				return false
			}
			arrPenyelesaian.push({
				'name': $(`#txtname-${index}`).val(),
				'qty': $(`#qty-aktual-${index}`).val(),
				'harga': $(`#nominal-aktual-${index}`).val(),
			})

		}
		if (arrPenyelesaian.length == 0) {
			alert('Detail Masih Kosong, Mohon Isi')
		}
		if (attachment[0].files.length === 0) {
			alert('Harap upload file atachment dahulu !')
			return false;
		}
		let files = attachment[0].files[0];
		var formData = new FormData();
		let json_arr = JSON.stringify(arrPenyelesaian)
		formData.append('perusahaan', perusahaan);
		formData.append('add_nama_penyelesaian', nm_penyelesaian);
		formData.append('no_transaksi', no_transaksi);
		formData.append('keterangan', $('#add_keterangan').val());
		formData.append('file', files);
		formData.append('value_kasbon', $('#hvaluekasbon').val());
		formData.append('total_pengeluaran_dana', $('#hpengeluarandana').val());
		formData.append('total_penyelesaian_kasbon', $('#htotalkasbon').val());
		formData.append('type_kasbon', typekasbon);
		formData.append('dataPermintaan', json_arr);

		Swal.fire({
			title: "Apakah anda yakin?",
			text: "Pastikan data yang sudah anda input benar!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Ya, Simpan",
			cancelButtonText: "Tidak, Tutup"
		}).then((result) => {
			if (result.value == true) {
				$.ajax({
					type: "POST",
					async: false,
					contentType: false,
					processData: false,
					url: '<?= base_url('FAS/Transaksi/PenyelesaianKasbon/SavePenyelesaianKasbon') ?>',
					data: formData,
					dataType: "json",
					success: function(data) {

						if (data['status'] == 1) {
							$('#thispage').fadeOut('hide');
							$('#thispage').fadeIn('show');
							message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
							$('#btnsaveData').hide()
							$('#editbtnSaveData').fadeIn('show')
							$('#konfirmasibtnSaveData').fadeIn('show')
							$('#add_nama_penyelesaian').prop('disabled', true)
							$('#add_perusahaan').prop('disabled', true)
							$('#add_no_transaksi').prop('disabled', true)

							$('#penyelesaian_kasbon_id').val(data['penyelesaian_kasbon_id'])
							$('#hvaluekasbon').val(data['value_kasbon'])
							$('#no_transaksi_id').val(data['penyelesaian_kasbon_id'])
							$('#spanAttachment').empty()
							$('#divaddfile').empty()
							$('#divaddfile').append(`<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-FILE">File</label>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<input type="file" id="add_file" name="add_file" class="txtnilai form-control" accept="application/pdf,application/vnd.ms-excel" />
					</div>`);
							$('#spanAttachment').append(`
									<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-ATTACHMENT">
								Attachment</label>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">

									<a href=" base_url('FAS/Transaksi/Penyelesaia/ViewAttachment?file='${data['name_file']}" target="_blank" class="btn btn-info">${data['name_file']}</a>
									<input type="hidden" id="is_file" name="is_file" value="1" />
									<input type="hidden" id="name_file" name="name_file" value="${data['name_file']}" />
									<!-- <a class="btn btn-md btn-danger" title="Hapus File Attachment" onclick="delAttachment()"><i class="fa fa-trash"></i></a> -->
									<input type="hidden" id="is_file" name="is_file" value="0" />
								</div>
							`)
						} else {
							message_topright("gagal", "<span name='CAPTION-ALERT-GAGAL'>Data gagal disimpan</span>");
						}
					}
				})
			}
		})
	})

	$(document).on('click', '#editbtnSaveData', function() {
		let perusahaan = $('#add_perusahaan option:selected').val();
		let nm_penyelesaian = $('#add_nama_penyelesaian option:selected').val();
		let no_transaksi = $('#add_no_transaksi option:selected').val();
		arrPenyelesaian = [];
		let nu = $('#tablePermintaan tbody tr').length;
		let name = "";
		let attachment = $('#add_file');
		let statusArr = 1;
		for (let index = 1; index <= nu; index++) {
			let name = $(`#txtname-${index}`).val()
			let qty = $(`#qty-aktual-${index}`).val()
			let harga = $(`#nominal-aktual-${index}`).val()
			if (name == '') {
				alert(`Mohon Isi Nama Item ke-${index}`)
				return false;
			}
			if (parseInt(qty) == 0) {
				alert(`Mohon Isi Qty Item ke-${index}`)
				return false;
			}
			if (parseInt(harga) == 0) {
				alert(`Mohon Isi Harga Item ke-${index}`)
				return false
			}
			arrPenyelesaian.push({
				'name': $(`#txtname-${index}`).val(),
				'qty': $(`#qty-aktual-${index}`).val(),
				'harga': $(`#nominal-aktual-${index}`).val(),
			})

		}
		let typekasbon = "D";
		if ($('#htotalkasbon').val() > 0) {
			typekasbon = "K";
		}
		if (perusahaan == '') {
			alert('Mohon Pilih Perusahaan')
			return false;
		}
		if (nm_penyelesaian == '') {
			alert('Mohon Pilih Nama Penyelesaian Kasbon')
			return false;
		}
		if (no_transaksi == '') {
			alert('Mohon Pilih No Transaksi')
			return false;
		}
		if (arrPenyelesaian.length == 0) {
			alert('Detail Masih Kosong, Mohon Isi')
		}
		if (attachment[0].files.length === 0) {
			alert('Harap upload file atachment dahulu !')
			return false;
		}

		let name_file = $('#name_file').val()
		if (name_file === undefined) {
			name_file = "";
		}

		let files = attachment[0].files[0];
		var formData = new FormData();
		let json_arr = JSON.stringify(arrPenyelesaian)
		formData.append('perusahaan', perusahaan);
		formData.append('add_nama_penyelesaian', nm_penyelesaian);
		formData.append('no_transaksi', no_transaksi);
		formData.append('keterangan', $('#add_keterangan').val());
		formData.append('penyelesaian_kasbon_id', $('#penyelesaian_kasbon_id').val());
		formData.append('file', files);
		formData.append('value_kasbon', $('#hvaluekasbon').val());
		formData.append('total_pengeluaran_dana', $('#hpengeluarandana').val());
		formData.append('total_penyelesaian_kasbon', $('#htotalkasbon').val());
		formData.append('type_kasbon', typekasbon);
		formData.append('dataPermintaan', json_arr);
		formData.append('name_file', name_file);
		formData.append('penyelesaian_kasbon_id', $('#penyelesaian_kasbon_id').val());

		Swal.fire({
			title: "Apakah anda yakin?",
			text: "Pastikan data yang sudah anda input benar!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Ya, Simpan",
			cancelButtonText: "Tidak, Tutup"
		}).then((result) => {
			if (result.value == true) {
				$.ajax({
					type: "POST",
					async: false,
					contentType: false,
					processData: false,
					url: '<?= base_url('FAS/Transaksi/PenyelesaianKasbon/UpdatePenyelesaianKasbon') ?>',
					data: formData,
					dataType: "json",
					success: function(data) {

						if (data['status'] == 1) {
							$('#thispage').fadeOut('hide');
							$('#thispage').fadeIn('show');
							message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
							$('#btnsaveData').hide()
							// $('#editbtnSaveData').fadeIn('show')
							$('#konfirmasibtnSaveData').fadeIn('show')

							$('#spanAttachment').empty()
							$('#divaddfile').empty()
							$('#divaddfile').append(`<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-FILE">File</label>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<input type="file" id="add_file" name="add_file" class="txtnilai form-control" accept="application/pdf,application/vnd.ms-excel" />
					</div>`);
							$('#spanAttachment').append(`
									<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-ATTACHMENT">
								Attachment</label>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">

									<a href=" base_url('FAS/Transaksi/Penyelesaia/ViewAttachment?file='${data['name_file']}" target="_blank" class="btn btn-info">${data['name_file']}</a>
									<input type="hidden" id="is_file" name="is_file" value="1" />
									<input type="hidden" id="name_file" name="name_file" value="${data['name_file']}" />
									<!-- <a class="btn btn-md btn-danger" title="Hapus File Attachment" onclick="delAttachment()"><i class="fa fa-trash"></i></a> -->
									<input type="hidden" id="is_file" name="is_file" value="0" />
								</div>
							`)
						} else {
							message_topright("gagal", "<span name='CAPTION-ALERT-GAGAL'>Data Gagal disimpan</span>");
						}
					}
				})
			}
		})
	})
	$(document).on('click', '#konfirmasibtnSaveData', function() {
		let perusahaan = $('#add_perusahaan option:selected').val();
		let nm_penyelesaian = $('#add_nama_penyelesaian option:selected').val();
		let no_transaksi = $('#add_no_transaksi option:selected').val();
		arrPenyelesaian = [];
		let nu = $('#tablePermintaan tbody tr').length;
		let name = "";
		let attachment = $('#add_file');
		let statusArr = 1;
		for (let index = 1; index <= nu; index++) {
			let name = $(`#txtname-${index}`).val()
			let qty = $(`#qty-aktual-${index}`).val()
			let harga = $(`#nominal-aktual-${index}`).val()
			if (name == '') {
				alert(`Mohon Isi Nama Item ke-${index}`)
				return false;
			}
			if (parseInt(qty) == 0) {
				alert(`Mohon Isi Qty Item ke-${index}`)
				return false;
			}
			if (parseInt(harga) == 0) {
				alert(`Mohon Isi Harga Item ke-${index}`)
				return false
			}
			arrPenyelesaian.push({
				'name': $(`#txtname-${index}`).val(),
				'qty': $(`#qty-aktual-${index}`).val(),
				'harga': $(`#nominal-aktual-${index}`).val(),
			})

		}
		let typekasbon = "D";
		if ($('#htotalkasbon').val() > 0) {
			typekasbon = "K";
		}
		if (perusahaan == '') {
			alert('Mohon Pilih Perusahaan')
			return false;
		}
		if (nm_penyelesaian == '') {
			alert('Mohon Pilih Nama Penyelesaian Kasbon')
			return false;
		}
		if (no_transaksi == '') {
			alert('Mohon Pilih No Transaksi')
			return false;
		}
		if (arrPenyelesaian.length == 0) {
			alert('Detail Masih Kosong, Mohon Isi')
		}
		if (attachment[0].files.length === 0) {
			alert('Harap upload file atachment dahulu !')
			return false;
		}

		let name_file = $('#name_file').val()
		if (name_file === undefined) {
			name_file = "";
		}
		let files = attachment[0].files[0];
		var formData = new FormData();
		let json_arr = JSON.stringify(arrPenyelesaian)
		formData.append('perusahaan', perusahaan);
		formData.append('add_nama_penyelesaian', nm_penyelesaian);
		formData.append('no_transaksi', no_transaksi);
		formData.append('keterangan', $('#add_keterangan').val());
		formData.append('penyelesaian_kasbon_id', $('#penyelesaian_kasbon_id').val());
		formData.append('file', files);
		formData.append('value_kasbon', $('#hvaluekasbon').val());
		formData.append('total_pengeluaran_dana', $('#hpengeluarandana').val());
		formData.append('total_penyelesaian_kasbon', $('#htotalkasbon').val());
		formData.append('type_kasbon', typekasbon);
		formData.append('dataPermintaan', json_arr);
		formData.append('name_file', name_file);
		formData.append('penyelesaian_kasbon_id', $('#penyelesaian_kasbon_id').val());


		Swal.fire({
			title: "Apakah anda yakin?",
			text: "Pastikan data yang sudah anda input benar!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Ya, Simpan",
			cancelButtonText: "Tidak, Tutup"
		}).then((result) => {
			if (result.value == true) {
				$.ajax({
					type: "POST",
					async: false,
					contentType: false,
					processData: false,
					url: '<?= base_url('FAS/Transaksi/PenyelesaianKasbon/KonfirmasiPenyelesaianKasbon') ?>',
					data: formData,
					dataType: "json",
					success: function(data) {

						if (data['status'] == 1) {
							message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
							setTimeout(() => {
								location.href = "<?= base_url(); ?>FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonMenu";
							}, 500);

						} else {
							message_topright("gagal", "<span name='CAPTION-ALERT-GAGAL'>Data gagal disimpan</span>");
						}
					}
				})
			}
		})
	})

	function message(msg, msgtext, msgtype) {
		Swal.fire(msg, msgtext, msgtype);
	}

	function message_topright(type, msg) {
		const Toast = Swal.mixin({
			toast: true,
			position: "top-end",
			showConfirmButton: false,
			timer: 3000,
			didOpen: (toast) => {
				toast.addEventListener("mouseenter", Swal.stopTimer);
				toast.addEventListener("mouseleave", Swal.resumeTimer);
			},
		});

		Toast.fire({
			icon: type,
			title: msg,
		});
	}
</script>