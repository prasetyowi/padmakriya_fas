<script>
	let arrSkuBarangPO = [];
	let arr_detail_push = [];
	let arrcountitempo = [];
	let item_pn_count = $("#item-count-purchaserequestdetail").val();
	let arrKodetemp = [];
	let arrKodeInFaktur = [];
	let arrKodePenerimaanBarang = [];
	let arrKodeKonfirmasiJasa = [];

	$(document).ready(
		function() {
			$(".select2").select2({
				width: "100%"
			});
			if ($('#filter-pf-date').length > 0) {
				$('#filter-pf-date').daterangepicker({
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
			let urinama = '<?= $this->uri->segment(3); ?>'
			if (urinama == 'create') {
				arrKodeKonfirmasiJasa = [];
				arrKodePenerimaanBarang = []
				let html = '';
				let pf_kode1 = $('#pemasukanfaktur_kode').empty()
				html += '<option value="">--Pilih Kode--</option>';
				let pf_kode = $('#pemasukanfaktur_kode')
				$.ajax({
					type: 'GET',
					url: "<?= base_url('FAS/PemasukanFaktur/GetKodePenerimaanInFaktur') ?>",
					dataType: "JSON",
					async: false,
					success: function(response) {
						$.each(response, function(i, v) {
							arrKodeKonfirmasiJasa.push(v.konfirmasi_jasa_id)
							arrKodePenerimaanBarang.push(v.penerimaan_sku_barang_id)
						})
					}
				})
				$.ajax({
					type: 'GET',
					url: "<?= base_url('FAS/PemasukanFaktur/GetKodePenerimaan') ?>",
					dataType: "JSON",
					success: function(response) {


						if (response != '') {
							$.each(response, function(i, v) {
								if (jQuery.inArray(v.penerimaan_sku_barang_id, arrKodePenerimaanBarang) !== -1) {

								} else {
									html += '<option value="' + v.penerimaan_sku_barang_id + '" data-type="1">' + v.penerimaan_sku_barang_kode + '</option>';
									pf_kode.html(html);
									console.log("2", v.penerimaan_sku_barang_id);
								}
							})
						}

					}
				})
				$.ajax({
					type: 'GET',
					url: "<?= base_url('FAS/PemasukanFaktur/GetKodeKonfirmasi') ?>",

					dataType: "JSON",
					success: function(response) {
						if (response != '') {
							$.each(response, function(i, v) {
								if (jQuery.inArray(v.konfirmasi_sku_jasa_id, arrKodeKonfirmasiJasa) !== -1) {

								} else {
									html += '<option value="' + v.konfirmasi_sku_jasa_id + '" data-type="2">' + v.konfirmasi_sku_jasa_kode + '</option>';
									pf_kode.html(html);
									console.log("2", v.konfirmasi_sku_jasa_id);
								}
							})

						}
					}
				})
			}
			<?php if ($act == "edit") { ?>
				if ($('#pemasukanfaktur_status').val() == 'Completed') {
					$('#add_file').hide()
					$('.dis').prop('disabled', true)
				}

				if (item_pn_count > 0) {
					arrSkuBarangPO = [];
					arrcountitempo = [];
					arrcountitempo.push(item_pn_count);
					for (var i = 0; i < item_pn_count; i++) {
						arrSkuBarangPO.push({
							sku_barang_satuan: $(`#span-item-${i}-sku_barang_satuan`).text(),
							sku_barang_nama_produk: $(`#span-item-${i}-sku_barang_nama_produk`).text(),
							sku_barang_kode: $(`#span-item-${i}-sku_barang_kode`).text(),
							sku_barang_kemasan: $(`#span-item-${i}-sku_barang_kemasan`).text(),
							sku_barang_id: $(`#span-item-${i}-sku_barang_id`).text(),
							sku_barang_harga: $(`#edititem-${i}-sku_barang_harga`).val(),
							purchase_order_detail_qty: $(`#span-item-${i}-purchase_order_detail_qty`).text(),
							supplier_id: $(`#span-item-${i}-supplier_id`).text(),
							purchase_order_id: $("#hpo_id").val(),
						});
					}
				}
			<?php } ?>
		}
	)

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



	$("#btn-search-data-pf").on("click", function() {
		$("#loadingviewpf").show();
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/PemasukanFaktur/search_hutang_by_filter') ?>",
			data: {
				tgl: $("#filter-pf-date").val(),
				perusahaan: $("#filter-pf-perusahaan").val(),
				divisi: $("#filter-pf-divisi").val(),
				tptransaksi: $("#tipe_transaksi_id").val()
			},
			dataType: "JSON",
			success: function(response) {

				$("#table_list_data_pf > tbody").empty();

				if ($.fn.DataTable.isDataTable('#table_list_data_pf')) {
					$('#table_list_data_pf').DataTable().clear();
					$('#table_list_data_pf').DataTable().destroy();
				}

				if (response != 0) {

					$.each(response, function(i, v) {
						let idbarangjasa = '';
						let typeid = 0;
						if (v.penerimaan_sku_barang_id != null) {
							idbarangjasa = v.penerimaan_sku_barang_id;
							typeid = 1;

						}
						if (v.konfirmasi_jasa_id != null) {
							typeid = 2;
							idbarangjasa = v.konfirmasi_jasa_id;

						}
						if (v.konfirmasi_hutang_status == "In Progress Approval") {
							$("#table_list_data_pf > tbody").append(`
							<tr>
								<td class="text-center">${v.konfirmasi_hutang_kode}</td>
								<td class="text-center">${v.tgl_create}</td>
								<td class="text-center">${v.konfirmasi_hutang_status}</td>
								<td class="text-center">${v.konfirmasi_hutang_who_create}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/PemasukanFaktur/detail/?id=${v.konfirmasi_hutang_id}&idbarangjasa=${idbarangjasa}&typeid=${typeid}" class="btn btn-warning btn-small btn-delete-sku"><i class="fa fa-search"></i></a></td>
							</tr>
						`);
						} else if (v.konfirmasi_hutang_status == "Approved") {
							$("#table_list_data_pf > tbody").append(`
							<tr>
								<td class="text-center">${v.konfirmasi_hutang_kode}</td>
								<td class="text-center">${v.tgl_create}</td>
								<td class="text-center">${v.konfirmasi_hutang_status}</td>
								<td class="text-center">${v.konfirmasi_hutang_who_create}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/PemasukanFaktur/detail/?id=${v.konfirmasi_hutang_id}&idbarangjasa=${idbarangjasa}&typeid=${typeid}" class="btn btn-success btn-small btn-delete-sku"><i class="fa fa-search"></i></a></td>
							</tr>
						`);

						} else if (v.konfirmasi_hutang_status == "Completed") {
							$("#table_list_data_pf > tbody").append(`
							<tr>
								<td class="text-center">${v.konfirmasi_hutang_kode}</td>
								<td class="text-center">${v.tgl_create}</td>
								<td class="text-center">${v.konfirmasi_hutang_status}</td>
								<td class="text-center">${v.konfirmasi_hutang_who_create}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/PemasukanFaktur/detail/?id=${v.konfirmasi_hutang_id}&idbarangjasa=${idbarangjasa}&typeid=${typeid}" class="btn btn-success btn-small btn-delete-sku"><i class="fa fa-search"></i></a></td>
							</tr>
						`);

						} else {
							$("#table_list_data_pf > tbody").append(`
							<tr>
								<td class="text-center">${v.konfirmasi_hutang_kode}</td>
								<td class="text-center">${v.tgl_create}</td>
								<td class="text-center">${v.konfirmasi_hutang_status}</td>
								<td class="text-center">${v.konfirmasi_hutang_who_create}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/PemasukanFaktur/edit/?id=${v.konfirmasi_hutang_id}&idbarangjasa=${idbarangjasa}&typeid=${typeid}" class="btn btn-primary btn-small btn-delete-sku"><i class="fa fa-pencil"></i></a></td>
							</tr>
						`);

						}
					});
					$('#table_list_data_pf').DataTable({
						'ordering': false
					});
				} else {
					$("#table_list_data_pf > tbody").append(`
								<tr>
									<td colspan="13" class="text-danger text-center">
										Data Kosong
									</td>
								</tr>
					`);
				}

				$("#loadingviewpf").hide();
			}
		});
	});

	$(document).on('change', '#pemasukanfaktur_kode', function() {
		let pf_id = $('#pemasukanfaktur_kode option:selected');
		let data_type = pf_id.attr('data-type');

		if (pf_id.val() != '') {
			$.ajax({
				type: 'POST',
				url: "<?= base_url('FAS/PemasukanFaktur/GetDetailDataByKodePO') ?>",
				data: {
					id: pf_id.val(),
					type: data_type
				},
				dataType: "JSON",
				success: function(response) {
					if (data_type == 2 || data_type == '2') {
						$('#pemasukanfaktur_tgl_dibutuhkan').val(response.formatkonfirmasi_jasa_tgl_create)
						$('#pemasukanfaktur_client_wms_id').val(response.client_wms_id).change()
						$('#pemasukanfaktur_karyawan_divisi_id').val(response.karyawan_divisi_id).change()
						$('#pemasukanfaktur_status_penerimaankonfirmasi').val(response.konfirmasi_jasa_status)
						$('#pemasukanfaktur_nm_penerima').val(response.purchase_request_pemohon)
						$('#pemasukanfaktur_nm_supplier').val(response.supplier_nama)
						$('#pemasukanfaktur_tipe_pengadaan_id').val(response.tipe_pengadaan_id).change()
						$('#hpf_id').val(response.konfirmasi_sku_jasa_id)
					} else {
						$('#pemasukanfaktur_tgl_dibutuhkan').val(response.formatpenerimaan_sku_barang_tgl_create)
						$('#pemasukanfaktur_client_wms_id').val(response.client_wms_id).change()
						$('#pemasukanfaktur_karyawan_divisi_id').val(response.karyawan_divisi_id).change()
						$('#pemasukanfaktur_status_penerimaankonfirmasi').val(response.penerimaan_sku_barang_status)
						$('#pemasukanfaktur_nm_penerima').val(response.purchase_request_pemohon)
						$('#pemasukanfaktur_nm_supplier').val(response.supplier_nama)
						$('#pemasukanfaktur_tipe_pengadaan_id').val(response.tipe_pengadaan_id).change()
						$('#hpf_id').val(response.penerimaan_sku_barang_id)
					}

					appendTableKonfirmasi(data_type);
				}
			})
		}
	})

	function appendTableKonfirmasi(type) {
		let typepo = $('#typepo').val(type);
		if ($.fn.DataTable.isDataTable('#tablekonfirmasihutang')) {
			$('#tablekonfirmasihutang').DataTable().clear();
		}
		$('#tablekonfirmasihutang > tbody').empty();
		$('#tablekonfirmasihutang').fadeOut("slow", function() {
			$(this).hide();

		}).fadeIn("slow", function() {
			$.ajax({
				url: "<?= base_url('FAS/PemasukanFaktur/GetDetailTableByIdKode'); ?>",
				type: "POST",
				data: {
					pemasukan_id: $('#hpf_id').val(),
					type: type
				},
				dataType: "JSON",
				success: function(data) {
					let response = data;
					console.log("data", response);
					arrcountitempo.push(data.length);
					let subtotalawal = '';
					arrSkuBarangPO = []

					$.each(response, function(i, v) {
						arrSkuBarangPO.push({
							sku_barang_satuan: v.sku_barang_satuan,
							sku_barang_nama_produk: v.sku_barang_nama_produk,
							sku_barang_kode: v.sku_barang_kode,
							sku_barang_kemasan: v.sku_barang_kemasan,
							sku_barang_id: v.sku_barang_id,
							sku_barang_harga: v.sku_barang_harga,
							purchase_order_detail_qty: v.purchase_order_detail_qty,
							penerimaan_sku_barang_detail_qty: v.penerimaan_sku_barang_detail_qty,
							supplier_id: v.supplier_id,
							purchase_order_id: v.purchase_order_id,
						});

						subtotalawal = parseInt(Math.round(v.sku_barang_harga)) * parseInt(v.penerimaan_sku_barang_detail_qty_terima);


						$("#tablekonfirmasihutang tbody").append(`
                    
						<tr id="row-${i}">
							<td>${i+1}<input type="hidden" id="hcountlistpo" value="${i}"></td>
							<td>
								<span id="span-item-${i}-sku_barang_kode" >${v.sku_barang_kode}</span> 
							</td>
							<td>
								<span id="span-item-${i}-sku_barang_nama_produk" >${v.sku_barang_nama_produk}</span> 
							</td>
							<td>
								<span id="span-item-${i}-sku_barang_satuan">${v.sku_barang_satuan}</span>
							</td>
							<td><span id="span-item-${i}-sku_barang_kemasan">${v.sku_barang_kemasan==null?'-':v.sku_barang_kemasan}</span></td>
							<td><input id="span-item-${i}-purchase_order_detail_qty" type="number" class="form-control numeric dis" type="text" value="${v.penerimaan_sku_barang_detail_qty_terima}" onchange="SumSubTotalReqQty(this.value,${i})"></td>
							<td style="display: none;"><span id="span-item-${i}-purchase_order_detail_qty_sisa">${v.penerimaan_sku_barang_detail_qty_sisa==null? v.penerimaan_sku_barang_detail_qty : v.penerimaan_sku_barang_detail_qty_sisa}</span></td>
							<td style="display: none;"><span id="span-item-${i}-purchase_order_detail_qty_terima">${v.penerimaan_sku_barang_detail_qty_terima==null? 0 : v.penerimaan_sku_barang_detail_qty_terima}</span></td>
							<td style="display:none;"><input type="number" class="form-control numeric" id="item-${i}-purchase_order_detail_qty_akan_terima" ${v.penerimaan_sku_barang_detail_qty_sisa==0? 'disabled' : ''} value="0"></td>
							<td style="display:none;"><input type="text" class="form-control numeric" id="item-${i}-sku_barang_harga" ${v.purchase_order_detail_qty_sisa==0? 'disabled' : ''}  onchange="SumSubTotalReqQtyq(this.value,${i})" disabled value="${Math.round(v.sku_barang_harga)}"></td>
							<td><input type="number" class="form-control numeric rupeah dolars-${i} dis" id="span-item-${i}-sku_barang_harga" value="${Math.round(v.sku_barang_harga)}" onchange="SumSubTotalReqHarga(this.value,${i})" ></td>
							<td><span id="span-item-${i}-purchase_order_sub_total"></span></td>
							<td><span id="span-item-${i}-keterangan">${v.purchase_order_detail_keterangan==null?'-':v.purchase_order_detail_keterangan}</span></td>
							<td style="display: none;">
								<button class="btn btn-danger btn-small HapusItemPaketAddPO idx-${i} ${v.sku_barang_id}" value="${v.purchase_order_id}" id="btnDetailPo"><i class="fa fa-trash"><label id="lbnmsupp" class="nm-${v.supplier_nama}"></label></i></button>
							</td>
							<td style="display:none;"><span id="span-item-${i}-supplier_id">${v.supplier_id}</span></td>
							<td style="display:none;"><span id="span-item-${i}-sku_barang_id">${v.sku_barang_id}</span></td>
						</tr>
						`);

					})
					arrSkuBarangPO.forEach((element, idx) => {
						let subtotalawal = parseInt(Math.round(element.sku_barang_harga)) * parseInt(element.penerimaan_sku_barang_detail_qty);

						console.log(subtotalawal);

						$("#span-item-" + idx + "-purchase_order_sub_total").html(numberFormat(parseInt(subtotalawal)))

					});
				}
			})
		})
	}

	function SumSubTotalReqQty(qty, index) {
		let hrg = $(`#span-item-${index}-sku_barang_harga`).val();


		var total = parseFloat(qty) * parseFloat(hrg);

		$("#span-item-" + index + "-purchase_order_sub_total").html('');
		$("#span-item-" + index + "-purchase_order_sub_total").append(numberFormat(parseInt(total)));


	}

	function SumSubTotalReqHarga(hrg, index) {
		let qty = $(`#span-item-${index}-purchase_order_detail_qty`).val();


		var total = parseFloat(qty) * parseFloat(hrg);

		$("#span-item-" + index + "-purchase_order_sub_total").html('');
		$("#span-item-" + index + "-purchase_order_sub_total").append(numberFormat(parseInt(total)));


	}
	const numberFormat = (number) => {
		return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
	$('#pemasukanfaktur_is_need_approval').click(function(event) {
		if (this.checked) {
			$("#pemasukanfaktur_status").val("In Progress Approval");
		} else {
			$("#pemasukanfaktur_status").val("Draft");
		}
	});

	$('#btnsavepemasukanfaktur').on('click', function() {
		let kode_id = $('#pemasukanfaktur_kode option:selected').val();
		if (kode_id == '') {
			alert("Mohon Pilih Kode Penerimaan & Barang")
			return false;
		}

		console.log("arrSkuBarangPO", arrSkuBarangPO);
		arr_detail_push = [];
		for (var index = 0; index < arrSkuBarangPO.length; index++) {
			if (arrSkuBarangPO[index] != "") {
				if (parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) != 0) {
					if (parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) > parseInt($("#span-item-" + index + "-purchase_order_detail_qty").text()) || parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) > parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text())) {
						alert(`Qty Sku ke ${index+1} Melebihi kapasitas`);
						return false;
					}
				}
				arr_detail_push.push({
					'sku_barang_satuan': $("#span-item-" + index + "-sku_barang_satuan").text(),
					'sku_barang_nama_produk': $("#span-item-" + index + "-sku_barang_nama_produk").text(),
					'sku_barang_kode': $("#span-item-" + index + "-sku_barang_kode").text(),
					'sku_barang_kemasan': $("#span-item-" + index + "-sku_barang_kemasan").text(),
					'sku_barang_id': $("#span-item-" + index + "-sku_barang_id").text(),
					'sku_barang_harga': $("#item-" + index + "-sku_barang_harga").val().replaceAll(',', ''),
					'purchase_order_detail_qty': $("#span-item-" + index + "-purchase_order_detail_qty").val(),
					'purchase_order_detail_qty_terima': $("#item-" + index + "-purchase_order_detail_qty_akan_terima").val(),
					'purchase_order_detail_qty_sisa': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? 0 : parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) - parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()),
					'supplier_id': $("#span-item-" + index + "-supplier_id").text(),
					'sku_barang_stock_awal': $("#span-item-" + index + "-purchase_order_detail_qty").text(),

					'sku_barang_stock_masuk': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()),
					'sku_barang_stock_keluar': 0,
					'sku_barang_stock_akhir': 0,
					'purchase_order_id': $("#hpo_id").val(),
					'penerimaan_sku_barang_qty_sum': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()),
					'keterangan': $(`#span-item-${index}-keterangan`).html()
				});
			}

		}


		var json_arr = JSON.stringify(arr_detail_push);
		let nm_file = $('#add_file');
		let files = nm_file[0].files[0];
		if (nm_file[0].files.length == 0) {
			alert('Harap upload file atachment dahulu !')
			return false;
		}

		let formData = new FormData();
		formData.append('hpf_id', $('#hpf_id').val());
		formData.append('typepo', $('#typepo').val());
		formData.append('client_wms_id', $('#pemasukanfaktur_client_wms_id option:selected').val());
		formData.append('tipe_pengadaan_id', $('#pemasukanfaktur_tipe_pengadaan_id  option:selected').val());
		formData.append('pemasukanfaktur_tgl', $('#pemasukanfaktur_tgl').val());
		formData.append('pemasukanfaktur_tgl_dibutuhkan', $('#pemasukanfaktur_tgl_dibutuhkan').val());
		formData.append('pemasukanfaktur_status', $('#pemasukanfaktur_status').val());
		formData.append('pemasukanfaktur_keterangan', $('#pemasukanfaktur_keterangan').val());
		formData.append('detail', json_arr);
		formData.append('file', files);

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
				//fungsi insert nanti
				$.ajax({
					async: false,
					contentType: false,
					processData: false,
					url: "<?= base_url('FAS/PemasukanFaktur/save_pemasukan_faktur'); ?>",
					type: "POST",
					data: formData,
					dataType: "JSON",
					success: function(data) {
						if (data['respon'] == 1) {
							message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
							$('#thispage').fadeOut('hide');
							$('#thispage').fadeIn('show');
							$('#btnkonfirmasipemasukanfaktur').fadeIn('show');
							// setTimeout(() => {
							// 	location.href = "<?= base_url(); ?>FAS/PemasukanFaktur/PemasukanFakturMenu";
							// }, 500);
							$('#pemasukanfaktur_client_wms_id option:selected').prop('disabled', true)
							$('#pemasukanfaktur_tipe_pengadaan_id option:selected').prop('disabled', true)
							$('#pemasukanfaktur_tgl_dibutuhkan').prop('disabled', true)
							$('#pemasukanfaktur_tgl').prop('disabled', true)
							// $('#add_file').hide()
							$('#btnsavepemasukanfaktur').hide()
							$('#editbtnsavepemasukanfaktur').show()
							$('#btnkonfirmasipemasukanfaktur').show()
							$('#pemasukanfaktur_kode').prop('disabled', true)
							$('#pemasukanfaktur_kode').prop('readonly', true)
							$('#konfirmasi_hutang_id').val(data['konfirmasi_hutang_id'])
							$('#purchase_request_id').val(data['purchase_request_id'])
							$('#po_kode').val(data['purchase_order_id'])
							// $('.dis').prop('disabled', true)
							// $('#divaddfile').hide()	

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
									<a href=" base_url('FAS/PemasukanFaktur/ViewAttachment?file='${data['konfirmasi_hutang_attachment_1']}" target="_blank" class="btn btn-info">${data['konfirmasi_hutang_attachment_1']}</a>
									<input type="hidden" id="is_file" name="is_file" value="1" />
									<input type="hidden" id="name_file" name="name_file" value="${data['konfirmasi_hutang_attachment_1']}" />
									<!-- <a class="btn btn-md btn-danger" title="Hapus File Attachment" onclick="delAttachment()"><i class="fa fa-trash"></i></a> -->
									<input type="hidden" id="is_file" name="is_file" value="0" />
								</div>
							`)
							$('#pemasukanfaktur_keterangan').prop('disabled', true)
							$('#pemasukanfaktur_keterangan').val(data['konfirmasi_hutang_attachment_1'])
						} else {
							message_topright("error", "<span name='CAPTION-ALERT-GAGAL'>Data gagal disimpan</span>");
						}
					}
				});
			}
		})
	})
	$('#editbtnsavepemasukanfaktur').on('click', function() {
		let kode_id = $('#pemasukanfaktur_kode option:selected').val();

		console.log("arrSkuBarangPO", arrSkuBarangPO);
		arr_detail_push = [];
		for (var index = 0; index < arrSkuBarangPO.length; index++) {
			if (arrSkuBarangPO[index] != "") {
				if (parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) != 0) {
					if (parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) > parseInt($("#span-item-" + index + "-purchase_order_detail_qty").text()) || parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) > parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text())) {
						alert(`Qty Sku ke ${index+1} Melebihi kapasitas`);
						return false;
					}
				}
				arr_detail_push.push({
					'sku_barang_satuan': $("#span-item-" + index + "-sku_barang_satuan").text(),
					'sku_barang_nama_produk': $("#span-item-" + index + "-sku_barang_nama_produk").text(),
					'sku_barang_kode': $("#span-item-" + index + "-sku_barang_kode").text(),
					'sku_barang_kemasan': $("#span-item-" + index + "-sku_barang_kemasan").text(),
					'sku_barang_id': $("#span-item-" + index + "-sku_barang_id").text(),
					'sku_barang_harga': $("#span-item-" + index + "-sku_barang_harga").val(),
					'purchase_order_detail_qty': $("#span-item-" + index + "-purchase_order_detail_qty").val(),
					'purchase_order_detail_qty_terima': $("#item-" + index + "-purchase_order_detail_qty_akan_terima").val(),
					'purchase_order_detail_qty_sisa': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? 0 : parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) - parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()),
					'supplier_id': $("#span-item-" + index + "-supplier_id").text(),
					'sku_barang_stock_awal': $("#span-item-" + index + "-purchase_order_detail_qty").text(),

					'sku_barang_stock_masuk': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()),
					'sku_barang_stock_keluar': 0,
					'sku_barang_stock_akhir': 0,
					'purchase_order_id': $("#hpo_id").val(),
					'penerimaan_sku_barang_qty_sum': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()),
					'keterangan': $(`#span-item-${index}-keterangan`).html()
				});
			}

		}
		var json_arr = JSON.stringify(arr_detail_push);
		let nm_file = $('#add_file');
		let files = nm_file[0].files[0];

		let formData = new FormData();
		formData.append('hpf_id', $('#hpf_id').val());
		formData.append('typepo', $('#typepo').val());
		formData.append('client_wms_id', $('#pemasukanfaktur_client_wms_id option:selected').val());
		formData.append('tipe_pengadaan_id', $('#pemasukanfaktur_tipe_pengadaan_id  option:selected').val());
		formData.append('pemasukanfaktur_tgl', $('#pemasukanfaktur_tgl').val());
		formData.append('pemasukanfaktur_tgl_dibutuhkan', $('#pemasukanfaktur_tgl_dibutuhkan').val());
		formData.append('pemasukanfaktur_status', $('#pemasukanfaktur_status').val());
		formData.append('pemasukanfaktur_keterangan', $('#pemasukanfaktur_keterangan').val());
		formData.append('detail', json_arr);
		formData.append('file', files);
		formData.append('name_file', $('#name_file').val());
		formData.append('konfirmasi_hutang_id', $('#konfirmasi_hutang_id').val());

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
				//fungsi insert nanti
				$.ajax({
					async: false,
					contentType: false,
					processData: false,
					url: "<?= base_url('FAS/PemasukanFaktur/update_pemasukan_faktur'); ?>",
					type: "POST",
					data: formData,
					dataType: "JSON",
					success: function(data) {
						if (data['respon'] == 1) {
							message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");

							$('#thispage').fadeOut('hide');
							$('#thispage').fadeIn('show');
							$('#btnkonfirmasipemasukanfaktur').fadeIn('show');
							// setTimeout(() => {
							// 	location.href = "<?= base_url(); ?>FAS/PemasukanFaktur/PemasukanFakturMenu";
							// }, 500);
							$('#pemasukanfaktur_client_wms_id option:selected').prop('disabled', true)
							$('#pemasukanfaktur_tipe_pengadaan_id option:selected').prop('disabled', true)
							$('#pemasukanfaktur_tgl_dibutuhkan').prop('disabled', true)
							$('#pemasukanfaktur_tgl').prop('disabled', true)
							// $('#add_file').hide()
							// $('#btnsavepemasukanfaktur').hide()
							$('#editbtnsavepemasukanfaktur').show()
							$('#btnkonfirmasipemasukanfaktur').show()
							// $('.dis').prop('disabled', true)
							// $('#divaddfile').hide()
							$('#pemasukanfaktur_kode').prop('disabled', true)
							$('#pemasukanfaktur_kode').prop('readonly', true)
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

									<a href=" base_url('FAS/PemasukanFaktur/ViewAttachment?file='${data['konfirmasi_hutang_attachment_1']}" target="_blank" class="btn btn-info">${data['konfirmasi_hutang_attachment_1']}</a>
									<input type="hidden" id="is_file" name="is_file" value="1" />
									<input type="hidden" id="name_file" name="name_file" value="${data['konfirmasi_hutang_attachment_1']}" />
									<!-- <a class="btn btn-md btn-danger" title="Hapus File Attachment" onclick="delAttachment()"><i class="fa fa-trash"></i></a> -->
									<input type="hidden" id="is_file" name="is_file" value="0" />
								</div>
							`)
							$('#pemasukanfaktur_keterangan').prop('disabled', true)
							// setTimeout(() => {
							// 	location.href = "<?= base_url(); ?>FAS/PemasukanFaktur/PemasukanFakturMenu";
							// }, 500);

						} else {
							message_topright("error", "<span name='CAPTION-ALERT-GAGAL'>Data gagal disimpan</span>");
						}
					}
				});
			}
		})
	})

	$('#btnkonfirmasipemasukanfaktur').on('click', function() {
		let kode_id = $('#pemasukanfaktur_kode option:selected').val();


		arr_detail_push = [];
		for (var index = 0; index < arrSkuBarangPO.length; index++) {
			if (arrSkuBarangPO[index] != "") {
				if (parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) != 0) {
					if (parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) > parseInt($("#span-item-" + index + "-purchase_order_detail_qty").text()) || parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) > parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text())) {
						alert(`Qty Sku ke ${index+1} Melebihi kapasitas`);
						return false;
					}
				}
				arr_detail_push.push({
					'sku_barang_satuan': $("#span-item-" + index + "-sku_barang_satuan").text(),
					'sku_barang_nama_produk': $("#span-item-" + index + "-sku_barang_nama_produk").text(),
					'sku_barang_kode': $("#span-item-" + index + "-sku_barang_kode").text(),
					'sku_barang_kemasan': $("#span-item-" + index + "-sku_barang_kemasan").text(),
					'sku_barang_id': $("#span-item-" + index + "-sku_barang_id").text(),
					'sku_barang_harga': $("#span-item-" + index + "-sku_barang_harga").val(),
					'purchase_order_detail_qty': $("#span-item-" + index + "-purchase_order_detail_qty").val(),
					'purchase_order_detail_qty_terima': $("#item-" + index + "-purchase_order_detail_qty_akan_terima").val(),
					'purchase_order_detail_qty_sisa': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? 0 : parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) - parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()),
					'supplier_id': $("#span-item-" + index + "-supplier_id").text(),
					'sku_barang_stock_awal': $("#span-item-" + index + "-purchase_order_detail_qty").text(),

					'sku_barang_stock_masuk': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()),
					'sku_barang_stock_keluar': 0,
					'sku_barang_stock_akhir': 0,
					'purchase_order_id': $("#hpo_id").val(),
					'penerimaan_sku_barang_qty_sum': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()),
					'keterangan': $(`#span-item-${index}-keterangan`).html()
				});
			}

		}
		var json_arr = JSON.stringify(arr_detail_push);
		let nm_file = $('#add_file');
		let files = nm_file[0].files[0];

		let formData = new FormData();
		formData.append('hpf_id', $('#hpf_id').val());
		formData.append('typepo', $('#typepo').val());
		formData.append('client_wms_id', $('#pemasukanfaktur_client_wms_id option:selected').val());
		formData.append('tipe_pengadaan_id', $('#pemasukanfaktur_tipe_pengadaan_id option:selected').val());
		formData.append('pemasukanfaktur_tgl', $('#pemasukanfaktur_tgl').val());
		formData.append('pemasukanfaktur_tgl_dibutuhkan', $('#pemasukanfaktur_tgl_dibutuhkan').val());
		formData.append('pemasukanfaktur_status', 'Completed');
		formData.append('pemasukanfaktur_keterangan', $('#pemasukanfaktur_keterangan').val());
		formData.append('detail', json_arr);
		formData.append('file', files);
		formData.append('name_file', $('#name_file').val());
		formData.append('konfirmasi_hutang_id', $('#konfirmasi_hutang_id').val());
		formData.append('purchase_request_id', $('#purchase_request_id').val());
		formData.append('po_kode', $('#po_kode').val());


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
				//fungsi insert nanti
				$.ajax({
					async: false,
					contentType: false,
					processData: false,
					url: "<?= base_url('FAS/PemasukanFaktur/konfirmasi_update_pemasukan_faktur'); ?>",
					type: "POST",
					data: formData,
					dataType: "JSON",
					success: function(data) {
						if (data['respon'] == 1) {
							message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
							setTimeout(() => {
								location.href = "<?= base_url(); ?>FAS/PemasukanFaktur/PemasukanFakturMenu";
							}, 500);
							// $('#pemasukanfaktur_client_wms_id option:selected').prop('disabled', true)
							// $('#pemasukanfaktur_tipe_pengadaan_id option:selected').prop('disabled', true)
							// $('#pemasukanfaktur_tgl_dibutuhkan').prop('disabled', true)
							// $('#pemasukanfaktur_tgl').prop('disabled', true)
							// $('#add_file').hide()
							// $('#editbtnsavepemasukanfaktur').hide()
							// $('#btnkonfirmasipemasukanfaktur').hide()
							// $('.dis').prop('disabled', true)
							// $('#divaddfile').hide()
							// $('#spanAttachment').empty()
							// $('#spanAttachment').append(`
							// 		<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-ATTACHMENT">
							// 	Attachment</label>
							// 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">

							// 		<a href=" base_url('FAS/PemasukanFaktur/ViewAttachment?file='${data['konfirmasi_hutang_attachment_1']}" target="_blank" class="btn btn-info">${data['konfirmasi_hutang_attachment_1']}</a>
							// 		<input type="hidden" id="is_file" name="is_file" value="1" />
							// 		<input type="hidden" id="name_file" name="name_file" value="${data['konfirmasi_hutang_attachment_1']}" />
							// 		<!-- <a class="btn btn-md btn-danger" title="Hapus File Attachment" onclick="delAttachment()"><i class="fa fa-trash"></i></a> -->
							// 		<input type="hidden" id="is_file" name="is_file" value="0" />
							// 	</div>
							// `)
							// $('#pemasukanfaktur_keterangan').prop('disabled', true)
						} else {
							message_topright("error", "<span name='CAPTION-ALERT-GAGAL'>Data gagal disimpan</span>");
						}
					}
				});
			}
		})
	})
</script>