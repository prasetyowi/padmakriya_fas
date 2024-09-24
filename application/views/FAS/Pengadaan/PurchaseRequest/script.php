<script type="text/javascript">
	var jumlah_sku = 0;
	var layanan = "";
	let arr_sku = [];
	let arr_header = [];
	let arr_detail = [];
	var cek_qty = 0;
	var cek_supplier = 0;
	var arr_purchase_request_detail = [];
	// var arr_purchase_request_detail = [];
	let arrtempSupplierid = [];
	var sku_id = "85FBCEB7-0253-4030-8190-042BEF9BA247";
	var sku_expdate = "2022-06-30";
	var total_qty_SKU_ED = 0;
	var item_pr_count = parseInt($("#item-count-purchaserequestdetail").val());
	const name_url = '<?= $this->uri->segment('4') ?>';

	$(document).ready(
		function() {
			// $('.select2').select2();
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

			if (name_url == 'create') {
				let client = $('#purchaserequest-client_wms_id option:selected').val();
				if (client != '') {

					getAnggaran()
				}
			}

			<?php if ($act == "edit") { ?>
				if (item_pr_count > 0) {
					for (var i = 0; i < item_pr_count; i++) {
						arr_purchase_request_detail.push({
							'principle_id': $("#item-" + i + "-purchaserequestdetail-principle_id").val(),
							'supplier_nama': $("#span-item-" + i + "-purchaserequestdetail-principle_id").text(),
							'sku_barang_id': $("#item-" + i + "-purchaserequestdetail-sku_barang_id").val(),
							'sku_barang_kode': $("#item-" + i + "-purchaserequestdetail-sku_barang_kode").val(),
							'sku_barang_nama_produk': $("#item-" + i + "-purchaserequestdetail-sku_barang_nama_produk").val(),
							'sku_barang_harga': $("#item-" + i + "-purchaserequestdetail-purchase_request_detailhargasatuan").val(),
							'sku_barang_satuan': $("#item-" + i + "-purchaserequestdetail-satuan").text(),
							'purchase_request_detail_qty_req': $("#item-" + i + "-purchaserequestdetail-purchase_request_detail_qty_req").val(),
							'purchase_request_detail_qty_approve': $("#item-" + i + "-purchaserequestdetail-purchase_request_detail_qty_approve").val(),
							'purchase_request_detail_qty_po': $("#item-" + i + "-purchaserequestdetail-purchase_request_detail_qty_po").val(),
							'purchase_request_detail_qty_terima': $("#item-" + i + "-purchaserequestdetail-purchase_request_detail_qty_terima").val(),
							'purchase_order_id': $("#item-" + i + "-purchaserequestdetail-purchase_order_id").val(),
							'purchase_order_kode': $("#item-" + i + "-purchaserequestdetail-purchase_order_kode").val(),
							'purchase_request_detail_qty_subtotal': $("#span-item-" + i + "-purchaserequestdetail-sub_total_req").text(),
							'purchase_request_detail_keterangan': $("#item-" + i + "-purchaserequestdetail-purchase_request_detail_keterangan").val()
						});
						arrSkuBarangSupplier.push({
							index: i,
							sku_barang_supplier_id: '',
							supplier_id: $("#item-" + i + "-purchaserequestdetail-principle_id").val(),
							sku_barang_id: $("#item-" + i + "-purchaserequestdetail-sku_barang_id").val(),
							sku_barang_harga: $("#item-" + i + "-purchaserequestdetail-purchase_request_detailhargasatuan").val(),
							supplier_nama: $("#span-item-" + i + "-purchaserequestdetail-principle_id").text(),
							req_qty: $("#item-" + i + "-purchaserequestdetail-purchase_request_detail_qty_req").val(),
							req_sub_total: $("#span-item-" + i + "-purchaserequestdetail-sub_total_req").text(),
							keterangan: $("#item-" + i + "-purchaserequestdetail-purchase_request_detail_keterangan").val()

						});
					}
				}
				console.log("arr_purchase_request_detail", arr_purchase_request_detail);
				console.log("arrSkuBarangSupplier", arrSkuBarangSupplier);

				HeaderReadonly();
			<?php } ?>
		});

	$(document).on("input", ".numeric", function(event) {
		this.value = this.value.replace(/[^\d.]+/g, '');
	});


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

	$('#select-sku').click(function(event) {
		if (this.checked) {
			// Iterate each checkbox
			$('[name="CheckboxSKU"]:checkbox').each(function() {
				this.checked = true;
			});
		} else {
			$('[name="CheckboxSKU"]:checkbox').each(function() {
				this.checked = false;
			});
		}
	});

	$('#purchaserequest-pr_is_need_approval').click(function(event) {
		if (this.checked) {
			$("#purchaserequest-purchase_request_status").val("In Progress Approval");
		} else {
			$("#purchaserequest-purchase_request_status").val("Draft");
		}
	});

	$("#btn-search-data-pr").on("click", function() {
		$("#loadingviewpr").show();
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/search_purchase_request_by_filter') ?>",
			data: {
				tgl: $("#filter-pr-date").val(),
				perusahaan: $("#filter-pr-perusahaan").val(),
				divisi: $("#filter-pr-divisi").val(),
				tptransaksi: $("#tipe_transaksi_id").val()
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
								<td class="text-center">${v.karyawan_divisi_nama}</td>
								<td class="text-center">${v.purchase_request_kode}</td>
								<td class="text-center">${v.purchase_request_tgl_create}</td>
								<td class="text-center">${v.purchase_request_tgl}</td>
								<td class="text-center">${v.purchase_request_status}</td>
								<td class="text-center">${v.tipe_pengadaan_nama}</td>
								<td class="text-center">${v.approval_by_nama}</td>
								<td class="text-center">${v.approval_tanggal}</td>
								<td class="text-center">${v.jabatan}</td>
								<td class="text-center">${v.purchase_request_pemohon}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseRequest/detail/?id=${v.purchase_request_id}" class="btn btn-warning btn-small btn-delete-sku"><i class="fa fa-search"></i></a></td>
							</tr>
						`);
						} else if (v.purchase_request_status == "Approved") {

							if (v.tipe_pengadaan_nama == "Non PO") {
								$("#table_list_data_pr > tbody").append(`
							<tr>
								<td class="text-center">${v.karyawan_divisi_nama}</td>
								<td class="text-center">${v.purchase_request_kode}</td>
								<td class="text-center">${v.purchase_request_tgl_create}</td>
								<td class="text-center">${v.purchase_request_tgl}</td>
								<td class="text-center">${v.purchase_request_status}</td>
								<td class="text-center">${v.tipe_pengadaan_nama}</td>
								<td class="text-center">${v.approval_by_nama}</td>
								<td class="text-center">${v.approval_tanggal}</td>
								<td class="text-center">${v.jabatan}</td>
								<td class="text-center">${v.purchase_request_pemohon}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseRequest/detail/?id=${v.purchase_request_id}" class="btn btn-success btn-small btn-delete-sku"><i class="fa fa-search"></i></a></td>
							</tr>
						`);
							} else {
								$("#table_list_data_pr > tbody").append(`
							<tr>
								<td class="text-center">${v.karyawan_divisi_nama}</td>
								<td class="text-center">${v.purchase_request_kode}</td>
								<td class="text-center">${v.purchase_request_tgl_create}</td>
								<td class="text-center">${v.purchase_request_tgl}</td>
								<td class="text-center">${v.purchase_request_status}</td>
								<td class="text-center">${v.tipe_pengadaan_nama}</td>
								<td class="text-center">${v.approval_by_nama}</td>
								<td class="text-center">${v.approval_tanggal}</td>
								<td class="text-center">${v.jabatan}</td>
								<td class="text-center">${v.purchase_request_pemohon}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseRequest/detail/?id=${v.purchase_request_id}" class="btn btn-success btn-small btn-delete-sku"><i class="fa fa-search"></i></a><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseRequest/generatepo/?id=${v.purchase_request_id}" title="Generate PO" class="btn btn-danger btn-small btn-delete-sku"><i class="fa fa-arrow-right"></i></a></td>
							</tr>
						`);
							}

						} else if (v.purchase_request_status == "Rejected") {
							$("#table_list_data_pr > tbody").append(`
							<tr>
								<td class="text-center">${v.karyawan_divisi_nama}</td>
								<td class="text-center">${v.purchase_request_kode}</td>
								<td class="text-center">${v.purchase_request_tgl_create}</td>
								<td class="text-center">${v.purchase_request_tgl}</td>
								<td class="text-center">${v.purchase_request_status}</td>
								<td class="text-center">${v.tipe_pengadaan_nama}</td>
								<td class="text-center">${v.approval_by_nama}</td>
								<td class="text-center">${v.approval_tanggal}</td>
								<td class="text-center">${v.jabatan}</td>
								<td class="text-center">${v.purchase_request_pemohon}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseRequest/detail/?id=${v.purchase_request_id}" class="btn btn-danger btn-small btn-delete-sku"><i class="fa fa-search"></i></a></td>
							</tr>
						`);
						} else {
							$("#table_list_data_pr > tbody").append(`
							<tr>
								<td class="text-center">${v.karyawan_divisi_nama}</td>
								<td class="text-center">${v.purchase_request_kode}</td>
								<td class="text-center">${v.purchase_request_tgl_create}</td>
								<td class="text-center">${v.purchase_request_tgl}</td>
								<td class="text-center">${v.purchase_request_status}</td>
								<td class="text-center">${v.tipe_pengadaan_nama}</td>
								<td class="text-center">${v.approval_by_nama}</td>
								<td class="text-center">${v.approval_tanggal}</td>
								<td class="text-center">${v.jabatan}</td>
								<td class="text-center">${v.purchase_request_pemohon}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PurchaseRequest/edit/?id=${v.purchase_request_id}" class="btn btn-primary btn-small btn-delete-sku"><i class="fa fa-pencil"></i></a></td>
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

	$('#purchaserequest-tipe_pengadaan_id').change(function() {
		let tipe_transaksi_id = $('#purchaserequest-tipe_transaksi_id')
		let id_jenis_pengadaan = $('#purchaserequest-tipe_pengadaan_id option:selected').val();
		if (id_jenis_pengadaan != null) {
			$.ajax({
				type: 'POST',
				url: "<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/GetTipeTransaksiByTipePengadaanID') ?>",
				data: {
					id_jenis_pengadaan: id_jenis_pengadaan
				},
				dataType: "json",
				success: function(response) {
					tipe_transaksi_id.empty();
					let data = response;
					tipe_transaksi_id.append($("<option />").val(null).text("-- PILIH --"));
					if (data.length > 0) {
						$.each(data, function(i, v) {
							tipe_transaksi_id.append($("<option />").val(
								v.tipe_transaksi_id).text(v.tipe_transaksi_nama));
						})
					}
				}
			});
		}
	})
	$("#purchaserequest-purchase_request_add_default_pembayaran").change(function() {
		// alert('ass')
		if ($("#purchaserequest-purchase_request_add_default_pembayaran").val() == "Tunai") {
			$("#purchaserequest-purchase_request_add_bank").attr('disabled', true);
			$("#purchaserequest-purchase_request_add_no_rekening").attr('disabled', true);
		} else {
			$("#purchaserequest-purchase_request_add_bank").attr('disabled', false);
			$("#purchaserequest-purchase_request_add_no_rekening").attr('disabled', false);
		}
	})
	$(document).on('change', '#purchaserequest-client_wms_id', function() {
		let client = $('#purchaserequest-client_wms_id option:selected').val();
		if (client != '') {
			getAnggaran();
		}
	})

	function getAnggaran() {

		let idAnggaranDetail = $('#purchaserequest-purchase_request_add_anggaran_detail_2');
		let client = $('#purchaserequest-client_wms_id option:selected').val();
		let tahun = $('#purchaserequest-purchase_request_anggaran_detail_tahun').val() == "" ? <?= date("Y"); ?> : $('#purchaserequest-purchase_request_anggaran_detail_tahun').val();
		$.ajax({
			type: 'POST',
			async: false,
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

	function initDataSKU() {
		var perusahaan = $("#filter-perusahaan-sku").val();
		var sku_barang_kode = $("#filter-sku-kode").val();
		var sku_barang_nama_produk = $("#filter-sku-nama-produk").val();
		var tipe_pengadaan = $('#purchaserequest-tipe_pengadaan_id option:selected').val()
		if (tipe_pengadaan == "") {
			$('#modal-sku').modal('hide');
			message("Error!", "<span name='CAPTION-ALERT-TIPEPENGADAAN'>Tipe Pengadaan tidak boleh kosong!</span>", "error");
			return false;
		}

		$('#modal-sku').modal('show');
		$("#loadingsku").show();

		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/search_filter_chosen_sku') ?>",
			data: {
				perusahaan: perusahaan,
				sku_barang_kode: sku_barang_kode,
				sku_barang_nama_produk: sku_barang_nama_produk,
				tipe_pengadaan: tipe_pengadaan
			},
			dataType: "JSON",
			async: false,
			success: function(response) {
				$("#loadingsku").hide();

				if (response.length > 0) {
					if ($.fn.DataTable.isDataTable('#table-sku')) {
						$('#table-sku').DataTable().destroy();
					}
					$("#table-sku > tbody").empty();

					$.each(response, function(i, v) {
						$("#table-sku > tbody").append(`
							<tr>
								<td width="5%" class="text-center">
									<input type="checkbox" name="CheckboxSKU" id="check-sku-${i}" value="${v.sku_barang_id}">
								</td>
								<td width="25%" class="text-center">${v.sku_barang_kode}</td>
								<td class="text-center">${v.sku_barang_nama_produk}</td>
								<td width="35%" class="text-center">${v.sku_barang_deskripsi}</td>
								<td width="10%" class="text-center">${v.sku_barang_kemasan}</td>
								<td width="10%" class="text-center">${v.sku_barang_satuan}</td>
							</tr>
						`);
					});

					$('#table-sku').DataTable({
						"searching": false,
						columnDefs: [{
							sortable: false,
							targets: [0, 1, 2, 3, 4, 5]
						}],
						lengthMenu: [
							[-1],
							['All']
						],
					});
				} else {
					$("#table-sku > tbody").html(`<tr><td colspan="6" class="text-center text-danger">Data Kosong</td></tr>`);
				}
			}
		});

	}

	function pushToTableSKUDelivery() {

		var result = arr_purchase_request_detail.reduce((unique, o) => {
			if (!unique.some(obj => obj.sku_barang_id === o.sku_barang_id)) {
				unique.push(o);
			}
			return unique;
		}, []);

		arr_purchase_request_detail = result;

		console.log("arr_purchase_request_detail", arr_purchase_request_detail);
		console.log("arrSkuBarangSupplier", arrSkuBarangSupplier);



		// $("#cek_sku").val(arr_purchase_request_detail.length);

		if ($.fn.DataTable.isDataTable('#table-req-barang')) {
			$('#table-req-barang').DataTable().clear();
			$('#table-req-barang').DataTable().destroy();
		}
		$.each(arr_purchase_request_detail, function(i, v) {
			let new_harga = "";
			let nm_supplier = "";
			let id_supplier = "";
			let req_qty = "";
			let req_sub_total = "";
			let keterangan = "";
			if (arrSkuBarangSupplier.length !== 0) {
				const findData = arrSkuBarangSupplier.find((item) => item.sku_barang_id == v.sku_barang_id)
				if (typeof findData !== 'undefined') {
					new_harga += findData.sku_barang_harga
					nm_supplier += findData.supplier_nama
					id_supplier += findData.supplier_id
					req_qty += findData.req_qty;
					req_sub_total += findData.req_sub_total;
					keterangan += findData.keterangan;

				} else {
					new_harga += ""
					nm_supplier += ""
					id_supplier += ""
					new_harga += "";
					req_qty += "";
					req_sub_total += "";
					keterangan += "";
				}
			}
			if (arr_purchase_request_detail[i] != "") {
				$("#table-req-barang > tbody").append(`
					<tr id="row-${i}">
						<td>${i+1}</td>
						<td style="display: none">
							<input type="hidden" id="item-${i}-purchaserequestdetail-principle_id" value="${id_supplier==  '' ? v.principle_id : id_supplier == ''&&v.principle_id=='' ?'': id_supplier}" />
						</td>
						<td class="text-center">
							<input type="hidden" id="item-${i}-purchaserequestdetail-sku_barang_id" value="${v.sku_barang_id}" />
							<span id="span-item-${i}-purchaserequestdetail-principle_id">${nm_supplier ==  '' ? v.supplier_nama : nm_supplier == ''&&v.supplier_nama=='' ?'': nm_supplier}</span>
						</td>
						<td class="text-center">
							<input type="hidden" id="item-${i}-purchaserequestdetail-sku_barang_kode" value="${v.sku_barang_kode}" />
							<button class="btn btn-primary btn-small" onclick="AddSupplier(${i},'${v.sku_barang_id}')"><i class="fa fa-plus"></i></button>
						</td>
						<td class="text-center">
							<input type="hidden" id="item-${i}-purchaserequestdetail-sku_barang_nama_produk" value="${v.sku_barang_nama_produk}" />
							<span class="sku-kode-label">${v.sku_barang_kode}</span>
						</td>
						<td class="text-center">
							<input type="hidden" id="item-${i}-purchaserequestdetail-sku_barang_harga" value="${v.sku_barang_harga}" />
							<span class="sku-nama-produk-label">${v.sku_barang_nama_produk}</span>
						</td>
						<td class="text-center">
							<span class="sku-satuan-label">${v.sku_barang_satuan}</span>
						</td>
						<td class="text-center">
							<input type="text" id="item-${i}-purchaserequestdetail-purchase_request_detail_keterangan" class="form-control input-sm" value="${ keterangan ==  '' ? v.purchase_request_detail_keterangan : keterangan == ''&&v.purchase_request_detail_keterangan=='' ?'': keterangan}" onchange="ChangeKeterangan(this.value,'${i}','${v.sku_barang_id}')"/>
						</td>
						<td class="text-center">
							<input type="text" style="width:80px;" id="item-${i}-purchaserequestdetail-purchase_request_detailhargasatuan" class="numeric form-control input-sm numeric" value="${new_harga ==  '' ? v.sku_barang_harga : new_harga == '' && v.sku_barang_harga=='' ? '': new_harga}" onchange="SumSubTotalReqHarga(this.value,'${i}','${v.sku_barang_id}')" />
						</td>
						<td class="text-center">
							<input type="number" style="width:50px;" id="item-${i}-purchaserequestdetail-purchase_request_detail_qty_req" class="form-control input-sm numeric" min="0" value="${req_qty ==  '' ? v.purchase_request_detail_qty_req  : req_qty == ''&&v.purchase_request_detail_qty_req =='' ?v.purchase_request_detail_qty_req: req_qty}" onchange="SumSubTotalReqQty(this.value,'${i}','${v.sku_barang_id}')" />
						</td>
						<td class="text-center">
							<span id="span-item-${i}-purchaserequestdetail-sub_total_req">${req_sub_total ==  '' ? v.purchase_request_detail_qty_subtotal  : req_sub_total }</span>
						</td>
						<td class="text-center">
							<input type="number" style="width:80px;" id="item-${i}-purchaserequestdetail-purchase_request_detail_qty_approve" class="form-control input-sm" value="0" readonly/>
						</td>
						<td class="text-center">
							
						</td>
						<td class="text-center">
							<input type="number" style="width:80px;" id="item-${i}-purchaserequestdetail-purchase_request_detail_qty_po" class="form-control input-sm" value="0" readonly/>
						</td>
						<td class="text-center">
							<input type="number" style="width:80px;" id="item-${i}-purchaserequestdetail-purchase_request_detail_qty_terima" class="form-control input-sm" value="0" readonly />
						</td>
						<td class="text-center" style="width:10%;">${v.purchase_order_kode==null || v.purchase_order_kode=="" ?'':v.purchase_order_kode}</td>
						<td class="text-center">
							<button class="btn btn-danger btn-small btn-delete-sku HapusItemPaketAdd idx-${i} ${v.sku_barang_id}" ><i class="fa fa-trash"></i></button>
						</td>
							</tr>
				`);
			}
			//add
		});
	}

	function pushToTableSKUDeliveryUpdate() {

		var result = arr_purchase_request_detail.reduce((unique, o) => {
			if (!unique.some(obj => obj.sku_barang_id === o.sku_barang_id)) {
				unique.push(o);
			}
			return unique;
		}, []);

		arr_purchase_request_detail = result;

		if ($.fn.DataTable.isDataTable('#table-req-barang-update')) {
			$('#table-req-barang').DataTable().clear();
			$('#table-req-barang').DataTable().destroy();
		}

		$.each(arr_purchase_request_detail, function(i, v) {
			let new_harga = "";
			let nm_supplier = "";
			let id_supplier = "";
			let req_qty = "";
			let req_sub_total = "";
			let keterangan = "";
			if (arrSkuBarangSupplier.length !== 0) {
				// const findData = arrSkuBarangSupplier.find((item) => (item.sku_barang_id == v.sku_barang_id) && (parseInt(item.index) == i))
				const findData = arrSkuBarangSupplier.find((item) => item.sku_barang_id == v.sku_barang_id)
				if (typeof findData !== 'undefined') {
					new_harga += findData.sku_barang_harga
					nm_supplier += findData.supplier_nama
					id_supplier += findData.supplier_id
					req_qty += findData.req_qty;
					req_sub_total += findData.req_sub_total;
					keterangan += findData.keterangan;

				} else {
					new_harga += ""
					nm_supplier += ""
					id_supplier += ""
					new_harga += "";
					req_qty += "";
					req_sub_total += "";
					keterangan += "";
				}
			}
			if (arr_purchase_request_detail[i] != "") {
				$("#table-req-barang-update > tbody").append(`
					<tr id="row-${i}">
						<td>${i+1}</td>
						<td style="display: none">
							<input type="hidden" id="item-${i}-purchaserequestdetail-principle_id" value="${id_supplier==  '' ? v.principle_id : id_supplier == ''&&v.principle_id=='' ?'': id_supplier}" />
						</td>
						<td class="text-center">
							<input type="hidden" id="item-${i}-purchaserequestdetail-sku_barang_id" value="${v.sku_barang_id}" />
							<span id="span-item-${i}-purchaserequestdetail-principle_id">${nm_supplier ==  '' ? v.supplier_nama : nm_supplier == ''&&v.supplier_nama=='' ?'': nm_supplier}</span>
						</td>
						<td class="text-center">
							<input type="hidden" id="item-${i}-purchaserequestdetail-sku_barang_kode" value="${v.sku_barang_kode}" />
							<button class="btn btn-primary btn-small" onclick="AddSupplierUpdate(${i},'${v.sku_barang_id}')"><i class="fa fa-plus"></i></button>
						</td>
						<td class="text-center">
							<input type="hidden" id="item-${i}-purchaserequestdetail-sku_barang_nama_produk" value="${v.sku_barang_nama_produk}" />
							<span class="sku-kode-label">${v.sku_barang_kode}</span>
						</td>
						<td class="text-center">
							<input type="hidden" id="item-${i}-purchaserequestdetail-sku_barang_harga" value="${v.sku_barang_harga}" />
							<span class="sku-nama-produk-label">${v.sku_barang_nama_produk}</span>
						</td>
						<td class="text-center">
							<span class="sku-satuan-label">${v.sku_barang_satuan}</span>
						</td>
						<td class="text-center">
							<input type="text" id="item-${i}-purchaserequestdetail-purchase_request_detail_keterangan" class="form-control input-sm" value="${ keterangan ==  '' ? v.purchase_request_detail_keterangan : keterangan == ''}" onchange="ChangeKeterangan(this.value,'${i}','${v.sku_barang_id}')"/>
						</td>
						<td class="text-center">
							<input type="text" style="width:80px;" id="item-${i}-purchaserequestdetail-purchase_request_detailhargasatuan" class="numeric form-control input-sm numeric" value="${new_harga ==  '' ? v.sku_barang_harga : new_harga == '' && v.sku_barang_harga=='' ? '': new_harga}" onchange="SumSubTotalReqHarga(this.value,'${i}',,'${v.sku_barang_id}')" />
						</td>
						<td class="text-center">
							<input type="number" style="width:50px;" id="item-${i}-purchaserequestdetail-purchase_request_detail_qty_req" class="form-control input-sm numeric" min="0" value="${req_qty ==  '' ? v.purchase_request_detail_qty_req  : req_qty == ''&&v.purchase_request_detail_qty_req =='' ?v.purchase_request_detail_qty_req: req_qty}" onchange="SumSubTotalReqQty(this.value,'${i}','${v.sku_barang_id}')" />
						</td>
						<td class="text-center">
							<span id="span-item-${i}-purchaserequestdetail-sub_total_req">${req_sub_total ==  '' ? v.purchase_request_detail_qty_subtotal  : req_sub_total}</span>
						</td>
						<td class="text-center">
							<input type="number" style="width:80px;" id="item-${i}-purchaserequestdetail-purchase_request_detail_qty_approve" class="form-control input-sm" value="0" readonly/>
						</td>
						<td class="text-center">
							
						</td>
						<td class="text-center">
							<input type="number" style="width:80px;" id="item-${i}-purchaserequestdetail-purchase_request_detail_qty_po" class="form-control input-sm" value="0" readonly/>
						</td>
						<td class="text-center">
							<input type="number" style="width:80px;" id="item-${i}-purchaserequestdetail-purchase_request_detail_qty_terima" class="form-control input-sm" value="0" readonly />
						</td>
						<td class="text-center" style="width:10%;">${v.purchase_order_kode==null || v.purchase_order_kode=="" ?'':v.purchase_order_kode}</td>
						<td class="text-center">
							<button class="btn btn-danger btn-small btn-delete-sku HapusItemPaketUpdate idx-${i} ${v.sku_barang_id}" ><i class="fa fa-trash"></i></button>
						</td>
					</tr>
		`);
			}

		});
	}

	$("#btn-choose-prod-delivery").on("click", function() {
		initDataSKU();
	});

	$("#btn-search-sku").on("click", function() {
		initDataSKU();
	});

	$(document).on("click", ".btn-choose-sku-multi", function() {
		var jumlah = $('input[name="CheckboxSKU"]').length;
		var numberOfChecked = $('input[name="CheckboxSKU"]:checked').length;
		var no = 1;
		jumlah_sku = numberOfChecked;

		arr_sku = [];

		if (numberOfChecked > 0) {
			for (var i = 0; i < jumlah; i++) {
				var checked = $('[id="check-sku-' + i + '"]:checked').length;
				var sku_barang_id = "'" + $("#check-sku-" + i).val() + "'";

				if (checked > 0) {
					arr_sku.push(sku_barang_id);
				}
			}

			$("#table-req-barang > tbody").empty();

			$.ajax({
				type: 'POST',
				url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/GetSelectedSKU') ?>",
				data: {
					sku_id: arr_sku
				},
				dataType: "JSON",
				success: function(response) {
					$.each(response, function(i, v) {
						arr_purchase_request_detail.push({
							'principle_id': "",
							'supplier_nama': "",
							'sku_barang_id': v.sku_barang_id,
							'sku_barang_kode': v.sku_barang_kode,
							'sku_barang_nama_produk': v.sku_barang_nama_produk,
							'sku_barang_harga': v.sku_barang_harga_jual,
							'sku_barang_satuan': v.sku_barang_satuan,
							'sku_barang_kemasan': v.sku_barang_kemasan,
							'purchase_request_detail_qty_subtotal': "",
							'purchase_request_detail_qty_req': 1,
							'purchase_request_detail_qty_approve': 0,
							'purchase_request_detail_qty_po': 0,
							'purchase_request_detail_qty_terima': 0,
							'purchase_order_id': "",
							'purchase_order_kode': "",
							'purchase_request_detail_keterangan': ""
						});
					});

					// console.log(arr_purchase_request_detail);

					pushToTableSKUDelivery();
					<?php if ($act == "edit") { ?>
						$("#table-req-barang-update > tbody").empty()
						pushToTableSKUDeliveryUpdate();
						HeaderReadonly();
					<?php } ?>
				}
			});

		} else {
			Swal.fire({
				icon: 'error',
				title: 'Error',
				text: 'Pilih SKU!'
			});
		}
	});


	$("#btnsavepr").on("click", function() {
		let attachment = $('#add_file');

		var perusahaan = $("#purchaserequest-client_wms_id").val();
		var divisi = $("#purchaserequest-karyawan_divisi_id").val();
		var tipe_pengadaan = $("#purchaserequest-tipe_pengadaan_id").val();
		var tipe_pembayaran = $("#purchaserequest-tipe_pembayaran_id").val();
		var pemohon = $("#purchaserequest-purchase_request_pemohon").val();
		let nm_file = $('#add_file');
		let files = attachment[0].files[0];

		var x = 0;
		var y = 0;

		// arr_header = [];
		arr_detail = [];

		for (var index = 0; index < arr_purchase_request_detail.length; index++) {
			if (arr_purchase_request_detail[index] != "") {
				if ($("#item-" + index + "-purchaserequestdetail-principle_id").val() == null || $("#item-" + index + "-purchaserequestdetail-principle_id").val() == "null" || $("#item-" + index + "-purchaserequestdetail-principle_id").val() == "") {
					alert(`Supplier ke ${index+1} kosong`);
					return false;
				}
				if ($("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == null || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == "null" || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == "" || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == 0 || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == "0") {
					alert(`Qty Request ke ${index+1} kosong, mohon isi`);
					return false;
				}
				if ($("#item-" + index + "-purchaserequestdetail-purchase_request_detailhargasatuan").val() == null || $("#item-" + index + "-purchaserequestdetail-purchase_request_detailhargasatuan").val() == "") {
					alert(`Harga Satuan ke ${index+1} tidak ditemukan, mohon isi`);
					return false;
				}
				arr_detail.push({
					'principle_id': $("#item-" + index + "-purchaserequestdetail-principle_id").val(),
					'sku_barang_id': $("#item-" + index + "-purchaserequestdetail-sku_barang_id").val(),
					'sku_barang_kode': $("#item-" + index + "-purchaserequestdetail-sku_barang_kode").val(),
					'sku_barang_nama_produk': $("#item-" + index + "-purchaserequestdetail-sku_barang_nama_produk").val(),
					// 'sku_barang_harga': $("#item-" + index + "-purchaserequestdetail-sku_barang_harga").val(),
					'sku_barang_harga': $("#item-" + index + "-purchaserequestdetail-purchase_request_detailhargasatuan").val(),
					'purchase_request_detail_qty_req': $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val(),
					'purchase_request_detail_qty_approve': $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_approve").val(),
					'purchase_request_detail_qty_po': $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_po").val(),
					'purchase_request_detail_qty_terima': $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_terima").val(),
					'purchase_order_id': $("#item-" + index + "-purchaserequestdetail-purchase_order_id").val(),
					'purchase_order_kode': $("#item-" + index + "-purchaserequestdetail-purchase_order_kode").val(),
					'purchase_request_detail_keterangan': $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_keterangan").val()
				});
			}
		}


		var json_arr = JSON.stringify(arr_detail);

		let formData = new FormData();
		formData.append('purchase_request_id', '');
		formData.append('purchase_request_kode', '');
		formData.append('depo_id', '');
		formData.append('gudang_id', '');
		formData.append('client_wms_id', $('#purchaserequest-client_wms_id').val());
		formData.append('tipe_pengadaan_id', $('#purchaserequest-tipe_pengadaan_id').val());
		formData.append('tipe_transaksi_id', $('#purchaserequest-tipe_transaksi_id').val());
		formData.append('tipe_kepemilikan_id', $('#purchaserequest-tipe_kepemilikan_id').val());
		formData.append('kategori_biaya_id', $('#purchaserequest-kategori_biaya_id').val());
		formData.append('tipe_biaya_id', $('#purchaserequest-tipe_biaya_id').val());
		formData.append('purchase_request_status', $('#purchaserequest-purchase_request_status').val());
		formData.append('purchase_request_tgl', $('#purchaserequest-purchase_request_tgl').val());
		formData.append('purchase_request_tgl_dibutuhkan', $('#purchaserequest-purchase_request_tgl_dibutuhkan').val());
		formData.append('purchase_request_tgl_create', $('#purchaserequest-purchase_request_tgl_create').val());
		formData.append('purchase_request_who_create', $('#purchaserequest-purchase_request_who_create').val());
		formData.append('purchase_request_keterangan', $('#purchaserequest-purchase_request_keterangan').val());
		formData.append('purchase_request_pemohon', $('#purchaserequest-purchase_request_pemohon').val());
		formData.append('karyawan_divisi_id', $('#purchaserequest-karyawan_divisi_id').val());
		formData.append('anggaran_detail_2_id', $('#purchaserequest-purchase_request_add_anggaran_detail_2').val());
		formData.append('nama_penerima', $('#purchaserequest-purchase_request_add_nama_penerima').val());
		formData.append('default_pembayaran', $('#purchaserequest-purchase_request_add_default_pembayaran').val());
		formData.append('bank_penerima', $('#purchaserequest-purchase_request_add_bank').val());
		formData.append('no_rekening', $('#purchaserequest-purchase_request_add_no_rekening').val());
		formData.append('judul', $('#purchaserequest-purchase_request_add_judul').val());
		formData.append('detail', json_arr);
		formData.append('file', files);
		// if ($('#purchaserequest-purchase_request_add_anggaran_detail_2').val() == '') {
		// 	alert('Mohon Pilih Anggaran')
		// }
		// if ($('#purchaserequest-purchase_request_add_nama_penerima').val() == '') {
		// 	alert('Mohon Pilih Anggaran')
		// }
		// if ($('#purchaserequest-purchase_request_add_default_pembayaran').val() == 'Non Tunai') {
		// 	if ($('#purchaserequest-purchase_request_add_bank').val() == '') {
		// 		alert('Mohon Pilih Bank Penerima');
		// 	}
		// 	if ($('#purchaserequest-purchase_request_add_no_rekening').val() == '') {
		// 		alert('Mohon Isi Nomor Rekening');
		// 	}
		// }
		if (perusahaan != "") {

			if (divisi != "") {

				if (tipe_pengadaan != "") {

					// if (tipe_pembayaran != "") {

					if (pemohon != "") {

						if (arr_detail.length > 0) {

							$("#table-req-barang > tbody tr").each(function() {
								var is_Qty = $("#item-" + x + "-purchaserequestdetail-purchase_request_detail_qty_req").val();
								// console.log(is_tipe_stock);
								if (is_Qty == 0) {
									cek_qty++;
								}

								x++;
							});

							$("#table-req-barang > tbody tr").each(function() {
								var is_Supplier = $("#item-" + y + "-purchaserequestdetail-principle_id").val();
								// console.log(is_Supplier);
								if (is_Supplier == "") {
									cek_supplier++;
								}

								y++;
							});

							if (cek_supplier == 0) {

								if (cek_qty == 0) {

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
											//ajax save data
											$.ajax({
												// async: false,
												type: "POST",
												contentType: false,
												processData: false,
												url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/insert_purchase_request'); ?>",
												// data: {
												// 	purchase_request_id: "",
												// 	purchase_request_kode: "",
												// 	depo_id: "",
												// 	gudang_id: "",
												// 	client_wms_id: $('#purchaserequest-client_wms_id').val(),
												// 	tipe_pengadaan_id: $('#purchaserequest-tipe_pengadaan_id').val(),
												// 	tipe_transaksi_id: $('#purchaserequest-tipe_transaksi_id').val(),
												// 	tipe_kepemilikan_id: $('#purchaserequest-tipe_kepemilikan_id').val(),
												// 	kategori_biaya_id: $('#purchaserequest-kategori_biaya_id').val(),
												// 	tipe_biaya_id: $('#purchaserequest-tipe_biaya_id').val(),
												// 	purchase_request_status: $('#purchaserequest-purchase_request_status').val(),
												// 	purchase_request_tgl: $('#purchaserequest-purchase_request_tgl').val(),
												// 	purchase_request_tgl_dibutuhkan: $('#purchaserequest-purchase_request_tgl_dibutuhkan').val(),
												// 	purchase_request_tgl_create: $('#purchaserequest-purchase_request_tgl_create').val(),
												// 	purchase_request_who_create: $('#purchaserequest-purchase_request_who_create').val(),
												// 	purchase_request_keterangan: $('#purchaserequest-purchase_request_keterangan').val(),
												// 	purchase_request_pemohon: $('#purchaserequest-purchase_request_pemohon').val(),
												// 	karyawan_divisi_id: $('#purchaserequest-karyawan_divisi_id').val(),
												// 	// file: files,
												// 	detail: arr_detail
												// },
												data: formData,
												dataType: "JSON",
												success: function(data) {
													if (data == 1) {
														message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
														setTimeout(() => {
															location.href = "<?= base_url(); ?>FAS/Pengadaan/PurchaseRequest/PurchaseRequestMenu";
														}, 500);
													} else {
														message_topright("error", "<span name='CAPTION-ALERT-GAGAL'>Data gagal disimpan</span>");
													}
												}
											});
										}
									});

								} else {
									cek_qty = 0;
									message("Error!", "<span name='CAPTION-ALERT-QTY'>Qty tidak boleh 0!</span>", "error");
								}

							} else {
								cek_supplier = 0;
								message("Error!", "<span name='CAPTION-ALERT-SUPPLIER'>Supplier tidak boleh kosong!</span>", "error");

							}

						} else {
							message("Error!", "<span name='CAPTION-ALERT-PILIHSKU'>Mohon pilih SKU</span>", "error");
						}

					} else {
						message("Error!", "<span name='CAPTION-ALERT-PEMOHON'>Pemohon tidak boleh kosong!</span>", "error");
					}

					// } else {
					// 	message("Error!", "<span name='CAPTION-ALERT-TIPEPEMBAYARAN'>Tipe Pembayaran tidak boleh kosong!</span>", "error");
					// }

				} else {
					message("Error!", "<span name='CAPTION-ALERT-TIPEPENGADAAN'>Tipe Pengadaan tidak boleh kosong!</span>", "error");
				}

			} else {
				message("Error!", "<span name='CAPTION-ALERT-DIVISI'>Divisi tidak boleh kosong!</span>", "error");
			}

		} else {
			message("Error!", "<span name='CAPTION-ALERT-PERUSAHAAN'>Perusahaan tidak boleh kosong!</span>", "error");
		}
	});

	$("#btnupdatepr").on("click", function() {
		var perusahaan = $("#purchaserequest-client_wms_id").val();
		var divisi = $("#purchaserequest-karyawan_divisi_id").val();
		var tipe_pengadaan = $("#purchaserequest-tipe_pengadaan_id").val();
		var tipe_pembayaran = $("#purchaserequest-tipe_pembayaran_id").val();
		var pemohon = $("#purchaserequest-purchase_request_pemohon").val();
		let attachment = $('#add_file');
		let nm_file = $('#add_file');
		let files = attachment[0].files[0];

		var x = 0;
		var y = 0;

		// arr_header = [];
		arr_detail = [];

		for (var index = 0; index < arr_purchase_request_detail.length; index++) {
			if (arr_purchase_request_detail[index] != "") {
				if ($("#item-" + index + "-purchaserequestdetail-principle_id").val() == null || $("#item-" + index + "-purchaserequestdetail-principle_id").val() == "null" || $("#item-" + index + "-purchaserequestdetail-principle_id").val() == "") {
					alert(`Supllier ke ${index+1} kosong`);
					return false;
				}
				if ($("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == null || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == "null" || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == "" || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == 0 || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == "0") {
					alert(`Qty Request ke ${index+1} kosong, mohon isi`);
					return false;
				}
				if ($("#item-" + index + "-purchaserequestdetail-purchase_request_detailhargasatuan").val() == null || $("#item-" + index + "-purchaserequestdetail-purchase_request_detailhargasatuan").val() == "") {
					alert(`Harga Satuan ke ${index+1} tidak ditemukan, mohon isi`);
					return false;
				}
				arr_detail.push({
					'principle_id': $("#item-" + index + "-purchaserequestdetail-principle_id").val(),
					'sku_barang_id': $("#item-" + index + "-purchaserequestdetail-sku_barang_id").val(),
					'sku_barang_kode': $("#item-" + index + "-purchaserequestdetail-sku_barang_kode").val(),
					'sku_barang_nama_produk': $("#item-" + index + "-purchaserequestdetail-sku_barang_nama_produk").val(),
					// 'sku_barang_harga': $("#item-" + index + "-purchaserequestdetail-sku_barang_harga").val(),
					'sku_barang_harga': $("#item-" + index + "-purchaserequestdetail-purchase_request_detailhargasatuan").val(),
					'purchase_request_detail_qty_req': $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val(),
					'purchase_request_detail_qty_approve': $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_approve").val(),
					'purchase_request_detail_qty_po': $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_po").val(),
					'purchase_request_detail_qty_terima': $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_terima").val(),
					'purchase_order_id': $("#item-" + index + "-purchaserequestdetail-purchase_order_id").val(),
					'purchase_order_kode': $("#item-" + index + "-purchaserequestdetail-purchase_order_kode").val(),
					'purchase_request_detail_keterangan': $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_keterangan").val()
				});
			}
		}

		// console.log(arr_sku);
		var json_arr = JSON.stringify(arr_detail);

		let formData = new FormData();
		formData.append('purchase_request_id', $('#purchaserequest-purchase_request_id').val());
		formData.append('purchase_request_kode', $('#purchaserequest-purchase_request_kode').val());
		formData.append('depo_id', '');
		formData.append('gudang_id', '');
		formData.append('client_wms_id', $('#purchaserequest-client_wms_id').val());
		formData.append('tipe_pengadaan_id', $('#purchaserequest-tipe_pengadaan_id').val());
		formData.append('tipe_transaksi_id', $('#purchaserequest-tipe_transaksi_id').val());
		formData.append('tipe_kepemilikan_id', $('#purchaserequest-tipe_kepemilikan_id').val());
		formData.append('kategori_biaya_id', $('#purchaserequest-kategori_biaya_id').val());
		formData.append('tipe_biaya_id', $('#purchaserequest-tipe_biaya_id').val());
		formData.append('purchase_request_status', $('#purchaserequest-purchase_request_status').val());
		formData.append('purchase_request_tgl', $('#purchaserequest-purchase_request_tgl').val());
		formData.append('purchase_request_tgl_dibutuhkan', $('#purchaserequest-purchase_request_tgl_dibutuhkan').val());
		formData.append('purchase_request_tgl_create', $('#purchaserequest-purchase_request_tgl_create').val());
		formData.append('purchase_request_who_create', $('#purchaserequest-purchase_request_who_create').val());
		formData.append('purchase_request_keterangan', $('#purchaserequest-purchase_request_keterangan').val());
		formData.append('purchase_request_pemohon', $('#purchaserequest-purchase_request_pemohon').val());
		formData.append('karyawan_divisi_id', $('#purchaserequest-karyawan_divisi_id').val());
		formData.append('anggaran_detail_2_id', $('#purchaserequest-purchase_request_add_anggaran_detail_2').val());
		formData.append('nama_penerima', $('#purchaserequest-purchase_request_add_nama_penerima').val());
		formData.append('default_pembayaran', $('#purchaserequest-purchase_request_add_default_pembayaran').val());
		formData.append('bank_penerima', $('#purchaserequest-purchase_request_add_bank').val());
		formData.append('no_rekening', $('#purchaserequest-purchase_request_add_no_rekening').val());
		formData.append('judul', $('#purchaserequest-purchase_request_add_judul').val());
		formData.append('detail', json_arr);
		formData.append('file', attachment.val() == '' ? 0 : files);
		formData.append('is_name_file', $('#is_name_file').val());
		console.log($('#is_name_file').val());
		// if ($('#purchaserequest-purchase_request_add_anggaran_detail_2').val() == '') {
		// 	alert('Mohon Pilih Anggaran')
		// }
		// if ($('#purchaserequest-purchase_request_add_nama_penerima').val() == '') {
		// 	alert('Mohon Pilih Anggaran')
		// }
		// if ($('#purchaserequest-purchase_request_add_default_pembayaran').val() == 'Non Tunai') {
		// 	if ($('#purchaserequest-purchase_request_add_bank').val() == '') {
		// 		alert('Mohon Pilih Bank Penerima');
		// 	}
		// 	if ($('#purchaserequest-purchase_request_add_no_rekening').val() == '') {
		// 		alert('Mohon Isi Nomor Rekening');
		// 	}
		// }

		if (perusahaan != "") {

			if (divisi != "") {

				if (tipe_pengadaan != "") {

					if (tipe_pembayaran != "") {

						if (pemohon != "") {

							if (arr_detail.length > 0) {

								$("#table-req-barang > tbody tr").each(function() {
									var is_Qty = $("#item-" + x + "-purchaserequestdetail-purchase_request_detail_qty_req").val();
									// console.log(is_tipe_stock);
									if (is_Qty == 0) {
										cek_qty++;
									}

									x++;
								});

								$("#table-req-barang > tbody tr").each(function() {
									var is_Supplier = $("#item-" + y + "-purchaserequestdetail-principle_id").val();
									// console.log(is_Supplier);
									if (is_Supplier == "") {
										cek_supplier++;
									}

									y++;
								});

								if (cek_supplier == 0) {

									if (cek_qty == 0) {

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
												//ajax save data
												$.ajax({
													async: false,
													url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/update_purchase_request'); ?>",
													type: "POST",
													contentType: false,
													processData: false,
													// data: {
													// 	purchase_request_id: $('#purchaserequest-purchase_request_id').val(),
													// 	purchase_request_kode: $('#purchaserequest-purchase_request_kode').val(),
													// 	depo_id: "",
													// 	gudang_id: "",
													// 	client_wms_id: $('#purchaserequest-client_wms_id').val(),
													// 	tipe_pengadaan_id: $('#purchaserequest-tipe_pengadaan_id').val(),
													// 	tipe_transaksi_id: $('#purchaserequest-tipe_transaksi_id').val(),
													// 	tipe_kepemilikan_id: $('#purchaserequest-tipe_kepemilikan_id').val(),
													// 	kategori_biaya_id: $('#purchaserequest-kategori_biaya_id').val(),
													// 	tipe_biaya_id: $('#purchaserequest-tipe_biaya_id').val(),
													// 	purchase_request_status: $('#purchaserequest-purchase_request_status').val(),
													// 	purchase_request_tgl: $('#purchaserequest-purchase_request_tgl').val(),
													// 	purchase_request_tgl_dibutuhkan: $('#purchaserequest-purchase_request_tgl_dibutuhkan').val(),
													// 	purchase_request_tgl_create: $('#purchaserequest-purchase_request_tgl_create').val(),
													// 	purchase_request_who_create: $('#purchaserequest-purchase_request_who_create').val(),
													// 	purchase_request_keterangan: $('#purchaserequest-purchase_request_keterangan').val(),
													// 	purchase_request_pemohon: $('#purchaserequest-purchase_request_pemohon').val(),
													// 	karyawan_divisi_id: $('#purchaserequest-karyawan_divisi_id').val(),
													// 	detail: arr_detail
													// },
													data: formData,
													dataType: "JSON",
													success: function(data) {
														if (data == 1) {
															message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
															setTimeout(() => {
																location.href = "<?= base_url(); ?>FAS/Pengadaan/PurchaseRequest/PurchaseRequestMenu";
															}, 500);
														} else {
															message_topright("error", "<span name='CAPTION-ALERT-GAGAL'>Data gagal disimpan</span>");
														}
													}
												});
											}
										});

									} else {
										cek_qty = 0;
										message("Error!", "<span name='CAPTION-ALERT-QTY'>Qty tidak boleh 0!</span>", "error");
									}

								} else {
									cek_supplier = 0;
									message("Error!", "<span name='CAPTION-ALERT-SUPPLIER'>Supplier tidak boleh kosong!</span>", "error");

								}

							} else {
								message("Error!", "<span name='CAPTION-ALERT-PILIHSKU'>Mohon pilih SKU</span>", "error");
							}

						} else {
							message("Error!", "<span name='CAPTION-ALERT-PEMOHON'>Pemohon tidak boleh kosong!</span>", "error");
						}

					} else {
						message("Error!", "<span name='CAPTION-ALERT-TIPEPEMBAYARAN'>Tipe Pembayaran tidak boleh kosong!</span>", "error");
					}

				} else {
					message("Error!", "<span name='CAPTION-ALERT-TIPEPENGADAAN'>Tipe Pengadaan tidak boleh kosong!</span>", "error");
				}

			} else {
				message("Error!", "<span name='CAPTION-ALERT-DIVISI'>Divisi tidak boleh kosong!</span>", "error");
			}

		} else {
			message("Error!", "<span name='CAPTION-ALERT-PERUSAHAAN'>Perusahaan tidak boleh kosong!</span>", "error");
		}
	});

	function SumSubTotalReqQty(qty, index, sku_barang_id) {

		// console.log(arr_purchase_request_detail);
		let hrg = $(`#item-${index}-purchaserequestdetail-purchase_request_detailhargasatuan`).val();

		var total = parseFloat(qty) * parseFloat(hrg);

		$("#span-item-" + index + "-purchaserequestdetail-sub_total_req").html('');
		$("#span-item-" + index + "-purchaserequestdetail-sub_total_req").append(total);
		const findIndexData = arr_purchase_request_detail.findIndex((item) => (item.sku_barang_id == sku_barang_id));
		console.log(findIndexData);
		arr_purchase_request_detail[findIndexData]['purchase_request_detail_qty_req'] = qty;
		arr_purchase_request_detail[findIndexData]['purchase_request_detail_qty_subtotal'] = total;
		if (arrSkuBarangSupplier.length != 0) {
			const findIndexData2 = arrSkuBarangSupplier.findIndex((item) => (item.sku_barang_id == sku_barang_id));
			if (findIndexData2 > 0) {

				arrSkuBarangSupplier[findIndexData]['req_qty'] = qty;
				arrSkuBarangSupplier[findIndexData]['req_sub_total'] = total;
			}
		}

	}

	function SumSubTotalReqHarga(harga, index, sku_barang_id) {

		let qty = $(`#item-${index}-purchaserequestdetail-purchase_request_detail_qty_req`).val();
		var total = parseFloat(harga) * parseFloat(qty);

		$("#span-item-" + index + "-purchaserequestdetail-sub_total_req").html('');
		$("#span-item-" + index + "-purchaserequestdetail-sub_total_req").append(total);

		const findIndexData = arr_purchase_request_detail.findIndex((item) => (item.sku_barang_id == sku_barang_id));
		arr_purchase_request_detail[findIndexData]['sku_barang_harga'] = harga;
		arr_purchase_request_detail[findIndexData]['purchase_request_detail_qty_subtotal'] = total;
		if (arrSkuBarangSupplier.length != 0) {
			const findIndexData2 = arrSkuBarangSupplier.findIndex((item) => (item.sku_barang_id == sku_barang_id));
			if (findIndexData2 > 0) {
				arrSkuBarangSupplier[findIndexData]['sku_barang_harga'] = harga;
				arrSkuBarangSupplier[findIndexData]['req_sub_total'] = total;
			}
		}
	}

	function ChangeKeterangan(isi, index, sku_barang_id) {
		const findIndexData = arr_purchase_request_detail.findIndex((item) => (item.sku_barang_id == sku_barang_id));
		arr_purchase_request_detail[findIndexData]['purchase_request_detail_keterangan'] = isi;
		if (arrSkuBarangSupplier.length != 0) {
			const findIndexData2 = arrSkuBarangSupplier.findIndex((item) => (item.sku_barang_id == sku_barang_id));
			if (findIndexData2 > 0) {
				arrSkuBarangSupplier[findIndexData]['keterangan'] = isi;
			}
		}
		console.log(arr_purchase_request_detail);
		console.log(arrSkuBarangSupplier);

	}
	$(document).on('click', '.HapusItemPaketAdd', function() {
		let idx = $(this).attr('class').split(' ')[5].split('-')[1]
		let sku_barang_id = $(this).attr('class').split(' ')[6]
		// const fil = arr_purchase_request_detail.filter((data, index) => index !== parseInt(idx));
		const fil = arr_purchase_request_detail.filter((data, index) => data.sku_barang_id !== sku_barang_id);
		const fil2 = arrSkuBarangSupplier.filter((data, index) => data.sku_barang_id !== sku_barang_id)
		arr_purchase_request_detail.length = 0;
		$.each(fil, function(i, v) {
			arr_purchase_request_detail.push(v);
		})
		arrSkuBarangSupplier.length = 0;
		$.each(fil2, function(i, v) {
			arrSkuBarangSupplier.push(v);
		})

		$(this).parent().parent().remove();
		$("#table-req-barang tbody tr").each(function(i, v) {
			let tridx = $(this)
			let it0 = $(this).find("td:eq(0)")
			let it1 = $(this).find("td:eq(1) input[type='hidden']")
			let it2 = $(this).find("td:eq(2) input[type='hidden']")
			let it2val = $(this).find("td:eq(2) input[type='hidden']").val();
			// console.log(it2val);
			let it2span = $(this).find("td:eq(2) span")
			let it3 = $(this).find("td:eq(3) input[type='hidden']")
			let it3btn = $(this).find("td:eq(3) button")
			let it4 = $(this).find("td:eq(4) input[type='hidden']")
			let it5 = $(this).find("td:eq(5) input[type='hidden']")
			let it6 = $(this).find("td:eq(6) input[type='text']")
			let it7 = $(this).find("td:eq(7) input[type='text']")
			let it8 = $(this).find("td:eq(8) input[type='text']")
			let it9 = $(this).find("td:eq(9) input[type='number']")
			let it10 = $(this).find("td:eq(10) span")
			let it11 = $(this).find("td:eq(11) input[type='number']")
			let it12 = $(this).find("td:eq(12) input[type='number']")
			let it13 = $(this).find("td:eq(13) input[type='number']")
			let it14 = $(this).find("td:eq(14) input[type='number']")
			let it15 = $(this).find("td:eq(15)")
			let it16 = $(this).find("td:eq(16)")

			it0.html(`${i+1}`);
			it1.attr('id', `item-${i}-purchaserequestdetail-principle_id`);
			it2.attr('id', `item-${i}-purchaserequestdetail-sku_barang_id`);
			it2span.attr('id', `span-item-${i}-purchaserequestdetail-principle_id`);
			it3.attr('id', `item-${i}-purchaserequestdetail-sku_barang_kode`);
			it3btn.attr('onclick', `AddSupplier('${i}','${it2val}')`)
			it4.attr('id', `item-${i}-purchaserequestdetail-sku_barang_nama_produk`);
			it5.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);
			it7.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detail_keterangan`);
			it8.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detailhargasatuan`);
			it9.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detail_qty_req`);
			it8.attr('onchange', `SumSubTotalReqHarga(this.value,'${i}','${it2.val()}')`);
			it9.attr('onchange', `SumSubTotalReqQty(this.value,'${i}','${it2.val()}')`);
			it10.attr('id', `span-item-${i}-purchaserequestdetail-sub_total_req`);
			it11.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detail_qty_approve`);
			it13.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detail_qty_po`);
			it14.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detail_qty_terima`);
			// it12.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);
			// it13.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);
			// it14.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);
			// it15.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);
			// it16.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);


			tridx.attr('id', `row-${i}`)
		});

	});
	$(document).on('click', '.HapusItemPaketUpdate', function() {
		let idx = $(this).attr('class').split(' ')[5].split('-')[1]
		let sku_barang_id = $(this).attr('class').split(' ')[6]
		// const fil = arr_purchase_request_detail.filter((data, index) => index !== parseInt(idx));
		const fil = arr_purchase_request_detail.filter((data, index) => data.sku_barang_id !== sku_barang_id);
		const fil2 = arrSkuBarangSupplier.filter((data, index) => data.sku_barang_id !== sku_barang_id)

		arr_purchase_request_detail.length = 0;
		$.each(fil, function(i, v) {
			arr_purchase_request_detail.push(v);
		})
		arrSkuBarangSupplier.length = 0;
		$.each(fil2, function(i, v) {
			arrSkuBarangSupplier.push(v);
		})
		$(this).parent().parent().remove();
		$("#table-req-barang-update tbody tr").each(function(i, v) {
			let tridx = $(this)
			let it0 = $(this).find("td:eq(0)")
			let it1 = $(this).find("td:eq(1) input[type='hidden']")
			let it2 = $(this).find("td:eq(2) input[type='hidden']")
			let it2val = $(this).find("td:eq(2) input[type='hidden']").val();
			// console.log(it2val);
			let it2span = $(this).find("td:eq(2) span")
			let it3 = $(this).find("td:eq(3) input[type='hidden']")
			let it3btn = $(this).find("td:eq(3) button")
			let it4 = $(this).find("td:eq(4) input[type='hidden']")
			let it5 = $(this).find("td:eq(5) input[type='hidden']")
			let it6 = $(this).find("td:eq(6) input[type='text']")
			let it7 = $(this).find("td:eq(7) input[type='text']")
			let it8 = $(this).find("td:eq(8) input[type='text']")
			let it9 = $(this).find("td:eq(9) input[type='number']")
			let it10 = $(this).find("td:eq(10) span")
			let it11 = $(this).find("td:eq(11) input[type='number']")
			let it12 = $(this).find("td:eq(12) input[type='number']")
			let it13 = $(this).find("td:eq(13) input[type='number']")
			let it14 = $(this).find("td:eq(14) input[type='number']")
			let it15 = $(this).find("td:eq(15)")
			let it16 = $(this).find("td:eq(16)")

			it0.html(`${i+1}`);
			it1.attr('id', `item-${i}-purchaserequestdetail-principle_id`);
			it2.attr('id', `item-${i}-purchaserequestdetail-sku_barang_id`);
			it2span.attr('id', `span-item-${i}-purchaserequestdetail-principle_id`);
			it3.attr('id', `item-${i}-purchaserequestdetail-sku_barang_kode`);
			it3btn.attr('onclick', `AddSupplierUpdate('${i}','${it2val}')`)
			it4.attr('id', `item-${i}-purchaserequestdetail-sku_barang_nama_produk`);
			it5.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);
			it7.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detail_keterangan`);
			it8.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detailhargasatuan`);
			it9.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detail_qty_req`);
			it8.attr('onchange', `SumSubTotalReqHarga(this.value,'${i}','${it2.val()}')`);
			it9.attr('onchange', `SumSubTotalReqQty(this.value,'${i}','${it2.val()}')`);
			it10.attr('id', `span-item-${i}-purchaserequestdetail-sub_total_req`);
			it11.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detail_qty_approve`);
			it13.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detail_qty_po`);
			it14.attr('id', `item-${i}-purchaserequestdetail-purchase_request_detail_qty_terima`);
			// it12.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);
			// it13.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);
			// it14.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);
			// it15.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);
			// it16.attr('id', `item-${i}-purchaserequestdetail-sku_barang_harga`);


			tridx.attr('id', `row-${i}`)

		});

	});

	function DeleteSKU(row, index, sku_barang_id) {
		// const fil = arr_purchase_request_detail.filter((data, index) => index !== parseInt(index));
		arr_sku[index] = "";
		arr_purchase_request_detail[index] = "";
		// arr_purchase_request_detail.length = 0;
		// $.each(fil, function(i, v) {
		// 	arr_purchase_request_detail.push(v);
		// })
		var row = row.parentNode.parentNode;
		row.parentNode.removeChild(row);

		// console.log(arr_purchase_request_detail);

		<?php if ($act == "edit") { ?>
			HeaderReadonly();
		<?php } ?>
	}

	$("#btn-history-approval").click(
		function() {
			var dokumen_kode = $('#purchaserequest-purchase_request_kode').val();

			$.ajax({
				type: 'GET',
				url: "<?= base_url('FAS/Approval/getHistoryApproval') ?>",
				data: {
					dokumen_kode: dokumen_kode
				},
				success: function(response) {

					let no = 1;
					let data = response;

					if ($.fn.DataTable.isDataTable('#table-history-approval')) {
						$('#table-history-approval').DataTable().destroy();
					}

					$("#table-history-approval tbody").empty();
					$("#table-history-approval tbody").html('');
					if (data.length > 0) {
						$.each(data, function() {
							if (this.approval_status == "Approved") {
								var color = "style='background-color:green;color:white'"
							} else {
								var color = "style='background-color:red;color:white'"
							}
							$("#txt_jenis_pengajuan").val(`${this.approval_reff_dokumen_jenis}`);

							$('#table-history-approval tbody').append(`
                                <tr>
                                    <td style='vertical-align:middle; text-align: center; ' >${no}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.tgl}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.approval_reff_dokumen_kode}</td>
                                    <td style='vertical-align:middle; text-align: center;' ><a ${color} class="btn btn-md">${this.approval_status}<a/></td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.karyawan_nama}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.approval_keterangan}</td>
                                </tr>
                            `);
							no++;
						});
					} else {
						$("#table-history-approval tbody").html('');
					}

					$('#table-history-approval').DataTable({
						paging: false
					});

				}
			});
			$('#modalHistoryApproval').modal('show');
		}
	);

	function HeaderReadonly() {
		var count_arr_purchase_request_detail = 0;

		for (var i = 0; i < arr_purchase_request_detail.length; i++) {
			if (arr_purchase_request_detail[i] != "") {
				count_arr_purchase_request_detail++;
			}
		}

		if (count_arr_purchase_request_detail > 0) {
			$("#purchaserequest-purchase_request_tgl").attr("readonly", false);
			$("#purchaserequest-purchase_request_tgl_dibutuhkan").attr("readonly", false);
			$("#purchaserequest-purchase_request_pemohon").attr("readonly", false);
			$("#purchaserequest-purchase_request_keterangan").attr("readonly", false);
			// $("#purchaserequest-client_wms_id").attr("disabled", false);
			$("#purchaserequest-karyawan_divisi_id").attr("disabled", false);
			// $("#purchaserequest-tipe_pengadaan_id").attr("disabled", false);
			$("#purchaserequest-tipe_transaksi_id").attr("disabled", false);
			$("#purchaserequest-kategori_biaya_id").attr("disabled", false);
			$("#purchaserequest-tipe_biaya_id").attr("disabled", false);
			$("#purchaserequest-tipe_kepemilikan_id").attr("disabled", false);
			// $("#purchaserequest-pr_is_need_approval").attr("disabled", true);
		} else {
			$("#purchaserequest-purchase_request_tgl").attr("readonly", false);
			$("#purchaserequest-purchase_request_tgl_dibutuhkan").attr("readonly", false);
			$("#purchaserequest-purchase_request_pemohon").attr("readonly", false);
			$("#purchaserequest-purchase_request_keterangan").attr("readonly", false);
			// $("#purchaserequest-client_wms_id").attr("disabled", false);
			$("#purchaserequest-karyawan_divisi_id").attr("disabled", false);
			// $("#purchaserequest-tipe_pengadaan_id").attr("disabled", false);
			$("#purchaserequest-tipe_transaksi_id").attr("disabled", false);
			$("#purchaserequest-kategori_biaya_id").attr("disabled", false);
			$("#purchaserequest-tipe_biaya_id").attr("disabled", false);
			$("#purchaserequest-tipe_kepemilikan_id").attr("disabled", false);
			// $("#purchaserequest-pr_is_need_approval").attr("disabled", false);
		}
	}

	// Pindahan dari S_principle
	function AddSupplier(index, skubid) {
		$("#modal-supplier").modal('show');
		let as = $(`#item-${index}-purchaserequestdetail-sku_barang_nama_produk`).val();
		$('#labelnamasku').text(as)
		$("#txtindex").val(index);
		$("#txtskubid").val(skubid);
		$("#txtskubidplsupplier").val(skubid);
		initDataSupplier(index, skubid);
	}

	function AddSupplierUpdate(index, skubid) {
		$("#modal-supplier").modal('show');
		let as = $(`#item-${index}-purchaserequestdetail-sku_barang_nama_produk`).val();
		$('#labelnamasku').text(as)
		$("#txtindex").val('');
		$("#txtskubid").val('');
		$("#txtindex").val(index);
		$("#txtskubid").val(skubid);
		initDataSupplierUpdate(index, skubid);
	}

	function initDataSupplier(index, skubid) {

		$.ajax({
			type: 'POST',
			data: {
				skubid: skubid,
			},
			url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/GetSupplierMenu') ?>",
			// data: "PrincipleId=" + id,
			success: function(response) {
				if (response) {
					ChPrincipleMenu(response, index, skubid);
				}
			}
		});
	}

	function initDataSupplierUpdate(index, skubid) {

		$.ajax({
			type: 'POST',
			data: {
				skubid: skubid,
			},
			url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/GetSupplierMenu') ?>",
			// data: "PrincipleId=" + id,
			success: function(response) {
				if (response) {
					ChPrincipleMenu(response, index, skubid);
				}
			}
		});
	}

	//var DTABLE;

	function ChPrincipleMenu(JSONPrinciple, index, skubid) {
		$("#tableprinciplemenu > tbody").html('');

		var Principle = JSON.parse(JSONPrinciple);

		$("#cbprinciplejenis").html('');
		$("#cbupdateprinciplejenis").html('');
		if ($.fn.DataTable.isDataTable('#tableprinciplemenu')) {
			$('#tableprinciplemenu').DataTable().destroy();
		}

		$('#tableprinciplemenu tbody').empty();

		AppendProvince(Principle);

		//append dropdow kelas jalan
		AppendStreetClass(Principle);
		AppendStreetClass2(Principle);
		AppendWilayah(Principle)

		//append dropdown area
		AppendArea(Principle);
		AppendSegment1(Principle);
		CheckIsValidKoordinat();

		AppendTimeOperasional(Principle);
		arrtempSupplierid = [];


		if (Principle.PrincipleMenu != 0) {

			if ($.fn.DataTable.isDataTable('#tableprinciplemenu')) {
				$('#tableprinciplemenu').DataTable().destroy();
			}

			$('#tableprinciplemenu tbody').empty();

			// console.log($Menu_Access);
			let no = 1;
			// for (i = 0; i < Principle.PrincipleMenu.length; i++) {
			//     var principle_id = Principle.PrincipleMenu[i].principle_id;
			//     var principle_kode = Principle.PrincipleMenu[i].principle_kode;
			//     var principle_nama = Principle.PrincipleMenu[i].principle_nama;
			//     var principle_alamat = Principle.PrincipleMenu[i].principle_alamat;
			//     var principle_telepon = Principle.PrincipleMenu[i].principle_telepon;
			//     var principle_nama_contact_person = Principle.PrincipleMenu[i].principle_nama_contact_person;
			//     var principle_email_contact_person = Principle.PrincipleMenu[i].principle_email_contact_person;
			//     var principle_telepon_contact_person = Principle.PrincipleMenu[i].principle_telepon_contact_person;

			//     var supplier_id = Principle.PrincipleMenu[i].principle_id;

			//     var isAktif = Principle.PrincipleMenu[i].principle_is_aktif;

			//     if (isAktif == 0) {
			//         Status_PT = 'Non Aktif';
			//     } else {
			//         Status_PT = 'Aktif';
			//     }

			//     var strmenu = '';

			//     strmenu = strmenu + '<tr>';
			//     strmenu = strmenu + '	<td><button class="btn btn-primary btn-small" onclick="getSelectedSupplier(\'' + principle_id + '\',\'' + principle_kode + '\',\'' + index + '\')"><i class="fa fa-angle-down"></i></button></td>';
			//     strmenu = strmenu + '	<td>' + principle_kode + '</td>';
			//     strmenu = strmenu + '	<td>' + principle_nama + '</td>';
			//     // strmenu = strmenu + '	<td>' + principle_alamat + '</td>';
			//     // strmenu = strmenu + '	<td>' + principle_telepon + '</td>';
			//     // strmenu = strmenu + '	<td>' + principle_nama_contact_person + '</td>';
			//     // strmenu = strmenu + '	<td>' + principle_telepon_contact_person + '</td>';
			//     // strmenu = strmenu + '	<td>' + Status_PT + '</td>';
			//     strmenu = strmenu + '</tr>';

			//     $("#tableprinciplemenu > tbody").append(strmenu);
			// }
			// console.log(Principle.SupplierBySkuBarangId);

			// if (Principle.SupplierBySkuBarangId == 0 || null) {
			//     var strmenu = '';


			//     strmenu = strmenu + '<tr>';
			//     strmenu = strmenu + '	<td colspan="5" class="text-center"><b>--Sku Tidak Memiliki Supplier--</b></td>';
			//     strmenu = strmenu + '	<td style="display:none;"></td>';
			//     strmenu = strmenu + '	<td style="display:none;"></td>';
			//     strmenu = strmenu + '	<td style="display:none;"></td>';
			//     strmenu = strmenu + '	<td style="display:none;"></td>';
			//     strmenu = strmenu + '</tr>';

			//     $("#tableprinciplemenu > tbody").append(strmenu);
			// }
			for (i = 0; i < Principle.SupplierBySkuBarangId.length; i++) {

				var sku_barang_supplier_id = Principle.SupplierBySkuBarangId[i].sku_barang_supplier_id;
				var sku_barang_id = Principle.SupplierBySkuBarangId[i].sku_barang_id;
				var supplier_nama = Principle.SupplierBySkuBarangId[i].supplier_nama;
				var supplier_alamat = Principle.SupplierBySkuBarangId[i].supplier_alamat;
				var supplier_kota = Principle.SupplierBySkuBarangId[i].supplier_kota;
				var Status_supplier = Principle.SupplierBySkuBarangId[i].supplier_is_aktif;
				var sku_barang_harga = Principle.SupplierBySkuBarangId[i].sku_barang_harga;
				var supplier_id = Principle.SupplierBySkuBarangId[i].supplier_id_asli;
				var who_last_update = Principle.SupplierBySkuBarangId[i].who_last_update;
				var tgl_last_update = Principle.SupplierBySkuBarangId[i].tglformat;
				let tglsplit = tgl_last_update.split(' ')[0]
				let hargasplit = '';
				if (sku_barang_harga != null) {
					hargasplit = sku_barang_harga.split('.')[0]

				} else {
					hargasplit = 0
				}

				// var supplier_id = Principle.Supplier[i].supplier_id_asli;

				arrtempSupplierid.push(supplier_id);
				var isAktif = Status_supplier
				let disb = "";

				if (isAktif == 0) {
					Status_PT = 'Non Aktif';
				} else {
					Status_PT = 'Aktif';
				}
				if (sku_barang_harga == null || sku_barang_harga == 0 || sku_barang_harga == "null") {
					disb = `<td class="sku_barang_harga" data-sort="${format(Math.round(sku_barang_harga))}" data-filter="${format(Math.round(sku_barang_harga))}"><input type="text" class="form-control numeric txt_harga_${supplier_id} txtharga"  name="nm-${supplier_nama}" disabled value="${format(Math.round(sku_barang_harga))}"</td>`;
				} else {
					disb = `<td class="sku_barang_harga" data-sort="${format(Math.round(sku_barang_harga))}" data-filter="${format(Math.round(sku_barang_harga))}"><input type="text" class="form-control numeric txt_harga_${supplier_id} txtharga"  name="nm-${supplier_nama}" disabled readonly value="${format(Math.round(sku_barang_harga))}"</td>`;
					// disb += `<td class="sku_barang_harga">${hargasplit}</td>`
				}

				var strmenu = '';


				strmenu = strmenu + '<tr>';
				// strmenu = strmenu + '	<td><button class="btn btn-primary btn-small" onclick="getSelectedSupplier(\'' + sku_barang_supplier_id + '\',\'' + sku_barang_harga + '\',\'' + supplier_nama + '\',\'' + index + '\')"><i class="fa fa-angle-down"></i></button></td>';
				strmenu = strmenu + `	<td><input type="radio" name="rd" onchange="handlerdqty('${supplier_id}','${sku_barang_harga}',event)" value="${supplier_id}"></td>`;
				strmenu = strmenu + '	<td class="supplier_nama">' + supplier_nama + '</td>';
				strmenu = strmenu + '	<td class="supplier_alamat">' + supplier_alamat + '</td>';
				strmenu = strmenu + '	<td>' + supplier_kota + '</td>';
				strmenu = strmenu + `	${disb}`;
				strmenu = strmenu + '	<td style="display:none;" class="sku_barang_id">' + skubid + '</td>';
				strmenu = strmenu + '	<td style="display:none;" class="supplier_id">' + supplier_id + '</td>';
				strmenu = strmenu + '	<td style="display:none;" class="sku_barang_supplier_id">' + sku_barang_supplier_id + '</td>';
				strmenu = strmenu + '	<td style="display:none;" class="sku_barang_kode">' + supplier_nama + '</td>';
				strmenu = strmenu + '	<td style="display:none;" class="indexes">' + index + '</td>';
				strmenu = strmenu + '	<td style="display:none;" class="sku_barang_harga_temp">' + sku_barang_harga + '</td>';
				// strmenu = strmenu + '	<td>' + principle_telepon + '</td>';
				// strmenu = strmenu + '	<td>' + principle_nama_contact_person + '</td>';
				// strmenu = strmenu + '	<td>' + principle_telepon_contact_person + '</td>';
				strmenu = strmenu + '	<td>' + who_last_update + '</td>';
				strmenu = strmenu + '	<td>' + tgl_last_update + '</td>';
				strmenu = strmenu + '	<td>' + Status_PT + '</td>';
				strmenu = strmenu + '</tr>';

				$("#tableprinciplemenu > tbody").append(strmenu);
			}
		}
		$('#tableprinciplemenu').DataTable({

		});
		// $('#tablePrinciplemenu').DataTable({
		//     retrieve: true,
		//     "dom": '<"left"f>rtp'
		// });
	}
	const format = num =>
		String(num).replace(/(?<!\..*)(\d)(?=(?:\d{3})+(?:\.|$))/g, '$1,')

	function formatRupiah(angka, prefix) {
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for (var i = 0; i < angkarev.length; i++)
			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
		return rupiah.split('', rupiah.length - 1).reverse().join('');
	}
	const handlerdqty = (supplier_id, harga, event) => {
		$(`.txtharga`).prop("disabled", true);
		if (event.currentTarget.value == supplier_id && harga != 'null') {
			$(`.txt_harga_${supplier_id}`).prop("disabled", true);

		} else {
			$(`.txt_harga_${supplier_id}`).prop("disabled", false);
		}
	}

	$(document).on('click', '.btn-choose-supplier-multi', function() {

		// arrSkuBarangSupplier.length = 0;
		var jumlah = $('input[name="rd"]:checked').length;
		let sku_barang_supplier_id = $("input[name=rd]:checked").parent().siblings("td.sku_barang_supplier_id").text();
		let supplier_id = $("input[name=rd]:checked").parent().siblings("td.supplier_id").text();
		let sku_barang_id = $("input[name=rd]:checked").parent().siblings("td.sku_barang_id").text();
		let sku_barang_harga_temp = $("input[name=rd]:checked").parent().siblings("td.sku_barang_harga_temp").text();
		let sku_barang_harga = $("input[name=rd]:checked").parent().siblings("td.sku_barang_harga").children('input').val() == undefined ? $("input[name=rd]:checked").parent().siblings("td.sku_barang_harga").text() : $("input[name=rd]:checked").parent().siblings("td.sku_barang_harga").children('input').val();
		// let sku_barang_harga = $("input[name=rd]:checked").parent().siblings("td.sku_barang_harga").text() == null || 0 || "" ? $("input[name=rd]:checked").parent().siblings("td.sku_barang_harga").children('input').val() : $("input[name=rd]:checked").parent().siblings("td.sku_barang_harga").text();
		let index = $("input[name=rd]:checked").parent().siblings("td.indexes").text();
		let supplier_nama = $("input[name=rd]:checked").parent().siblings("td.supplier_nama").text();
		let indexasli = $("#txtindex").val();
		let skubid = $("#txtskubid").val();
		let req_qty = $(`#item-${indexasli}-purchaserequestdetail-purchase_request_detail_qty_req`).val();
		let req_sub_total = $(`#span-item-${indexasli}-purchaserequestdetail-sub_total_req`).text();
		let keterangan = $(`#item-${indexasli}-purchaserequestdetail-purchase_request_detail_keterangan`).val();
		let sku_barang_harga_replace = sku_barang_harga.replace(',', '')
		let xsubtotal = parseFloat(sku_barang_harga_replace) * parseFloat(req_qty);
		if (jumlah <= 0 || jumlah == 0) {
			alert('Pilih Supplier');
			return false;
		}
		if (sku_barang_harga == undefined || sku_barang_harga == "undefined" || sku_barang_harga == " " || sku_barang_harga == '' || sku_barang_harga == null || sku_barang_harga == "null" || sku_barang_harga == "0" || sku_barang_harga == 0) {
			alert('Harga Belum Ditentukan');
			return false;
		}

		if (arrSkuBarangSupplier.length === 0) {
			arrSkuBarangSupplier.push({
				index: indexasli,
				sku_barang_supplier_id: sku_barang_supplier_id,
				supplier_id: supplier_id,
				sku_barang_id: skubid,
				sku_barang_harga: sku_barang_harga_replace,
				supplier_nama: supplier_nama,
				req_qty: req_qty,
				req_sub_total: xsubtotal,
				keterangan: keterangan

			});
		} else {
			const findData = arrSkuBarangSupplier.find((item) => (item.sku_barang_id == skubid))

			if (typeof findData === 'undefined') {
				arrSkuBarangSupplier.push({
					index: indexasli,
					sku_barang_supplier_id: sku_barang_supplier_id,
					supplier_id: supplier_id,
					sku_barang_id: skubid,
					sku_barang_harga: sku_barang_harga_replace,
					supplier_nama: supplier_nama,
					req_qty: req_qty,
					req_sub_total: xsubtotal,
					keterangan: keterangan
				});
			} else {
				const findIndexData = arrSkuBarangSupplier.findIndex((item) => (item.sku_barang_id == skubid))

				arrSkuBarangSupplier[findIndexData]['index'] = indexasli;
				arrSkuBarangSupplier[findIndexData]['sku_barang_id'] = skubid;
				arrSkuBarangSupplier[findIndexData]['supplier_id'] = supplier_id;
				arrSkuBarangSupplier[findIndexData]['supplier_nama'] = supplier_nama;
				arrSkuBarangSupplier[findIndexData]['sku_barang_harga'] = sku_barang_harga_replace;
				arrSkuBarangSupplier[findIndexData]['req_qty'] = req_qty;
				arrSkuBarangSupplier[findIndexData]['req_sub_total'] = xsubtotal;
			}
		}
		// return false;
		if (sku_barang_harga_temp == undefined || sku_barang_harga_temp == "undefined" || sku_barang_harga_temp == " " || sku_barang_harga_temp == '' || sku_barang_harga_temp == null || sku_barang_harga_temp == "null" || sku_barang_harga_temp == "0" || sku_barang_harga_temp == 0) {
			$.ajax({
				type: "POST",
				url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/InsertSkuBarangSupplier') ?>",
				data: {
					arrSkuBarangSupplier: arrSkuBarangSupplier,
					sku_barang_supplier_id: sku_barang_supplier_id == '' ? '' : sku_barang_supplier_id
				},
				dataType: "json",
				success: function(response) {

					let fix_sku_barang_supplier_id = sku_barang_supplier_id == null || sku_barang_supplier_id == "null" || sku_barang_supplier_id == "" ? response['sku_barang_supplier_id'] : sku_barang_supplier_id;
					// getSelectedSupplier(supplier_id, sku_barang_harga, supplier_nama, index);
					$("#table-req-barang > tbody").empty()
					$("#table-req-barang-update > tbody").empty()
					<?php if ($act == "add") { ?>
						console.log("add");


						pushToTableSKUDelivery();
						SumSubTotalReqHarga(sku_barang_harga_replace, `${indexasli}`, skubid)
					<?php } ?>
					<?php if ($act == "edit") { ?>
						console.log("ed");

						pushToTableSKUDeliveryUpdate();
						SumSubTotalReqHarga(sku_barang_harga_replace, `${indexasli}`, skubid)
					<?php } ?>
					$("#modal-supplier").modal('hide');
				}
			})
		} else {
			$("#table-req-barang > tbody").empty()
			$("#table-req-barang-update > tbody").empty()
			<?php if ($act == "add") { ?>
				pushToTableSKUDelivery();
				SumSubTotalReqHarga(sku_barang_harga_replace, `${indexasli}`, skubid)
			<?php } ?>
			<?php if ($act == "edit") { ?>
				pushToTableSKUDeliveryUpdate();
				SumSubTotalReqHarga(sku_barang_harga_replace, `${indexasli}`, skubid)
			<?php } ?>
			$("#modal-supplier").modal('hide');

		}

	});


	function getSelectedSupplier(principle_id, suplier_sku_barang_harga, principle_kode, index) {

		$("#span-item-" + index + "-purchaserequestdetail-principle_id").html('');
		$("#item-" + index + "-purchaserequestdetail-principle_id").val('');
		$("#item-" + index + "-purchaserequestdetail-purchase_request_detailhargasatuan").val('');

		$("#span-item-" + index + "-purchaserequestdetail-principle_id").append(principle_kode);
		$("#item-" + index + "-purchaserequestdetail-principle_id").val(principle_id);
		$("#item-" + index + "-purchaserequestdetail-purchase_request_detailhargasatuan").val(suplier_sku_barang_harga);

		$("#modal-supplier").modal('hide');

	}

	$(document).ready(function() {
		$("#listsupplier-province").change(function() {
			let provinsi = $(this).val();
			AppendCity(provinsi);

		});

		$("#listsupplier-city").change(function() {
			let provinsi = $("#listsupplier-province").val();
			let kota = $(this).val();
			AppendDistrict(provinsi, kota);
		});


		$("#listsupplier-districts").on("change", function() {
			let kecamatan = $(this).val();
			let nama_kecamatan = $('#listsupplier-districts option').filter(':selected').text();
			$("#data_districts").val(nama_kecamatan);
			AppendWard(kecamatan);
		});

		$("#listsupplier-ward").on("change", function() {
			let kelurahan = $(this).val();
			let nama_kelurahan = $('#listsupplier-ward option').filter(':selected').text();
			$("#data-ward").val(nama_kelurahan);
			$("#txtpostalcode-supplier").val(kelurahan);
		});

		$("#tambah_principle_brand").on("keypress", function(event) {
			let text = $(this);
			AppendListPrincipleBrand(event, text);
		});
		$("#listcontactperson-segment1").on("change", function() {
			let segment1 = $(this).val();
			AppendSegment2(segment1);
		});

		$("#listcontactperson-segment2").on("change", function() {
			let segment2 = $(this).val();
			AppendSegment3(segment2);
		});

	})

	function AppendProvince(Principle) {
		if (Principle.Provinsi != null) {
			$("#listsupplier-province").empty();
			let html = '';
			html += '<option value="">--Pilih Provinsi--</option>';
			$.each(Principle.Provinsi, function(i, v) {
				html += '<option value="' + v.reffregion_nama + '">' + v.reffregion_nama + '</option>';
				$("#listsupplier-province").html(html);
			});
		} else {
			$("#listsupplier-province").append('<option value="">--Pilih Provinsi--</option>');
		}
	}

	function AppendCity(provinsi) {
		$.ajax({
			type: "POST",
			url: "<?= base_url('FAS/Pengadaan/Principle/Get_Request_Data_Kota') ?>",
			data: {
				id: provinsi
			},
			dataType: "json",
			success: function(response) {
				$("#listsupplier-city").html(response);
			}
		});
	}


	function AppendDistrict(provinsi, kota) {
		$.ajax({
			type: "POST",
			url: "<?= base_url('FAS/Pengadaan/Principle/Get_Request_Data_Kecamatan') ?>",
			data: {
				provinsi: provinsi,
				id: kota
			},
			dataType: "json",
			success: function(response) {
				$("#listsupplier-districts").html(response);
			}
		});
	}


	function AppendWard(kecamatan) {
		$.ajax({
			type: "POST",
			url: "<?= base_url('FAS/Pengadaan/Principle/Get_Request_Data_Kelurahan') ?>",
			data: {
				id: kecamatan
			},
			dataType: "json",
			success: function(response) {
				$("#listsupplier-ward").html(response);
			}
		});
	}

	function AppendStreetClass(Principle) {
		if (Principle.KelasJalan != null) {
			$("#listsupplier-stretclass").empty();
			let html = '';
			html += '<option value="">--Pilih Kelas jalan--</option>';
			$.each(Principle.KelasJalan, function(i, v) {
				html += '<option value="' + v.id + '">' + v.nama + '</option>';
				$("#listsupplier-stretclass").html(html);
			});
		} else {
			$("#listsupplier-stretclass").append('<option value="">--Pilih Kelas Jalan--</option>');
		}
	}

	function AppendStreetClass2(Principle) {
		if (Principle.KelasJalan2 != null) {
			$("#listsupplier-stretclass2").empty();
			// $("#listsupplier-stretclass2_update").empty();
			let html = '';
			html += '<option value="">--Pilih Kelas jalan--</option>';
			$.each(Principle.KelasJalan2, function(i, v) {
				html += '<option value="' + v.id + '">' + v.nama + '</option>';
				$("#listsupplier-stretclass2").html(html);
			});
		} else {
			$("#listsupplier-stretclass2").append('<option value="">--Pilih Kelas Jalan--</option>');
		}
	}

	function AppendWilayah(Principle) {
		if (Principle.AreaHeader != null) {
			$("#listarea-header").empty();
			let html = '';
			html += '<option value="">--Pilih Wilayah--</option>';
			$.each(Principle.AreaHeader, function(i, v) {

				html += '<option value="' + v.id + '">' + v.nama + '</option>';
				$("#listarea-header").html(html);
			});
			// $("#listcoorporate-area-update").trigger('change');
		} else {
			$("#listarea-header").append('<option value="">--Pilih Wilayah--</option>');
		}
	}

	function AppendArea(Principle, area) {
		if (Principle.Area != null) {
			$("#listsupplier-area").empty();
			// $("#listsupplier-area_update").empty();
			let html = '';
			html += '<option value="">--Pilih Area--</option>';
			$.each(Principle.Area, function(i, v) {
				html += '<option value="' + v.id + '">' + v.nama + '</option>';
				$("#listsupplier-area").html(html);
			});
		} else {
			$("#listsupplier-area").append('<option value="">--Pilih Area--</option>');
		}
	}

	function AppendSegment1(Outlet) {
		if (Outlet.Segment1 != null) {
			$("#listcontactperson-segment1").empty();
			let html = '';
			html += '<option value="">--Pilih Segmentasi 1--</option>';
			$.each(Outlet.Segment1, function(i, v) {
				html += '<option value="' + v.id + '">' + v.nama + '</option>';
				$("#listcontactperson-segment1").html(html);
			});
		} else {
			$("#listcontactperson-segment1").append('<option value="">--Pilih Segmentasi 1--</option>');
		}
	}

	function AppendSegment2(id) {
		$.ajax({
			type: "POST",
			url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Segment2') ?>",
			data: {
				id: id
			},
			dataType: "json",
			async: "true",
			success: function(response) {
				$("#listcontactperson-segment2").html(response);
			}
		});
	}


	function AppendSegment3(SegmentId2) {
		$.ajax({
			type: "POST",
			url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Segment3') ?>",
			data: {
				SegmentId2: SegmentId2
			},
			dataType: "json",
			success: function(response) {
				$("#listcontactperson-segment3").html(response);
			}
		});
	}


	//function check checklist sesuai atau tidak titik lokasi untuk principle
	function CheckIsValidKoordinat() {
		$("#iskoordinat_principle").on("click", function() {
			if ($("#iskoordinat_principle").prop('checked') == true) {
				$("#showiskoordinat_principle").hide("slow");
			} else {
				$("#showiskoordinat_principle").show("slow");
			}
		});
	}
	$("#listarea-header").change(
		function() {
			var area_header_id = $("#listarea-header option:selected").val();

			$.ajax({
				type: "POST",
				url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Area') ?>",

				data: {
					id: area_header_id
				},
				dataType: "JSON",
				success: function(response) {
					$("#listsupplier-area").html(response);
				}
			});
		}
	);

	// function AppendTimeOperasional(Principle) {
	//     $('#list_day_operasional_principle tbody').empty();

	//     $.each(Principle.Day, function(i, v) {
	//         var html = '';

	//         var Jam_Buka = '<input type="time" class="from-control" id="jam_buka_principle" name="jam_buka_principle"/>';
	//         var Jam_Tutup = '<input type="time" class="from-control" id="jam_tutup_principle" name="jam_tutup_principle"/>';
	//         var status = `<select class="form-control" id="status_operasional_principle" name="status_operasional_principle">
	//                         <option value="1" selected>BUKA</option>
	//                         <option value="0">TUTUP</option>
	//                     </select>`;

	//         html = html + '<tr>';
	//         html = html + '	<td>' + i + ' <input type="hidden" id="no_urut_hari_principle" name="no_urut_hari_principle" value="' + i + '"/></td>';
	//         html = html + '	<td>' + v + ' <input type="hidden" id="nama_hari_principle" name="nama_hari_principle" value="' + v + '"/></td>';
	//         html = html + '	<td>' + Jam_Buka + '</td>';
	//         html = html + '	<td>' + Jam_Tutup + '</td>';
	//         html = html + '	<td>' + status + '</td>';
	//         html = html + '</tr>';

	//         $("#list_day_operasional_principle > tbody").append(html);
	//     });
	// }

	function AppendTimeOperasional(Outlet) {
		$('#list-day-operasional tbody').empty();

		$.each(Outlet.Day, function(i, v) {
			var html = '';

			var Jam_Buka = '<input type="time" class="from-control" id="jam-buka" name="jam-buka"/>';
			var Jam_Tutup = '<input type="time" class="from-control" id="jam-tutup" name="jam-tutup"/>';
			var status = `<select class="form-control" id="status-operasional" name="status-operasional">
                            <option value="1" selected>BUKA</option>
                            <option value="0">TUTUP</option>
                        </select>`;

			html = html + '<tr>';
			html = html + '	<td>' + i + ' <input type="hidden" id="no-urut-hari" name="no-urut-hari" value="' + i +
				'"/></td>';
			html = html + '	<td>' + v + ' <input type="hidden" id="nama-hari" name="nama-hari" value="' + v +
				'"/></td>';
			html = html + '	<td>' + Jam_Buka + '</td>';
			html = html + '	<td>' + Jam_Tutup + '</td>';
			html = html + '	<td>' + status + '</td>';
			html = html +
				'	<td style="vertical-align:middle; text-align: center;" ><input type="checkbox" id="chk_pengiriman" name="chk_pengiriman"/></td>';
			html = html +
				'	<td style="vertical-align:middle; text-align: center;"><input type="checkbox" id="chk_penagihan" name="chk_penagihan"/></td>';
			html = html + '</tr>';

			$("#list-day-operasional > tbody").append(html);
		});
	}

	$("#btnbackprinciple").click(
		function() {
			ResetFormSupplier();
		}
	);

	function AppendListPrincipleBrand(event, text) {
		let text_ = text;
		if (event.key == "Enter") {
			event.preventDefault();
			$("#list_principle_brand").append(`
                <div class="new-row">
                    <button type="button" class="principle-brand-btn">
                        <span></span><text class="check-length">` + text.val() + `</text>
                    </button><input type="hidden" name="data_principle_brand" class="form-control" value="` + text.val() + `" />
                </div>
            `);
			WidthDynamicAppend();

			// WidthDynamicAppend();
			text.val("");
			text.focus();
			text[0].scrollIntoView({
				behavior: "smooth",
			});
		}
	}

	function WidthDynamicAppend() {
		let length_text_btn = $(".check-length");
		let arr = [];
		$(".new-row").each(function() {
			let currentRow = $(this);
			let element = currentRow.find(".principle-brand-btn");
			arr.push(element);
		});
		check_lenght_principle(arr);
	}

	function check_lenght_principle(length_text_btn) {
		let data = length_text_btn;
		$.each(data, function(i, v) {
			if (v.length >= 0) {
				let row = $(this).find(".check-length");
				let width = row.width() + 100;
				$(this).css("width", width + "px");
			}
		});

	}

	$("#list_principle_brand").on("click", '.principle-brand-btn', function() {
		$(this).addClass("active");
		setTimeout(() => {
			$(this).removeClass("active");
			$(this).parents(".new-row").remove();
		}, 1000);
	});

	<?php
	if ($Menu_Access["D"] == 1) {
	?> $("#btndeleteprinciplemenu").click(
			function() {
				GetPrincipleMenu();
			}
		);

		// Delete Channel
		function DeletePrincipleMenu(PrincipleID) {
			// $("#lbdeletePrinciplename").html(ChannelName);
			$("#hddeleteprincipleid").val(PrincipleID);

			$("#previewdeleteprinciple").modal('show');
		}

		$("#btnyesdeleteprinciple").click(
			function() {
				var PrincipleID = $("#hddeleteprincipleid").val();

				$("#loadingdeleteprinciple").show();
				$("#btnyesdeleteprinciple").prop("disabled", true);

				$.ajax({
					type: 'POST',
					url: "<?= base_url('FAS/Pengadaan/Principle/DeletePrincipleMenu') ?>",
					data: {
						PrincipleID: PrincipleID
					},
					success: function(response) {
						$("#loadingdeleteprinciple").hide();
						$("#btnyesdeleteprinciple").prop("disabled", false);

						if (response == 1) {
							var msg = 'Data Principle berhasil dihapus.';
							var msgtype = 'success';

							Swal.fire(
								'Success!',
								msg,
								msgtype
							)

						} else {
							var ErrMsg = response.split('$$$');
							ErrMsg = ErrMsg[1];

							var msg = ErrMsg;
							var msgtype = 'error';

							Swal.fire(
								'Error!',
								msg,
								msgtype
							)
						}

						$("#previewdeleteprinciple").modal('hide');
						GetPrincipleMenu();

					},
					error: function(xhr, ajaxOptions, thrownError) {

						$("#loadingdeleteprinciple").hide();
						$("#btnyesdeleteprinciple").prop("disabled", false);
					}
				});
			}
		);
	<?php
	}
	?>
	// Add New Channel
	$("#btnaddnewprinciple").click(
		function() {
			ResetFormSupplier();
			// $("#previewaddnewprinciple").modal('show');
			$("#previewaddnewsupplier").modal('show');
			// $("#modal-supplier").modal('hide');
		}
	);


	$("#btnsaveaddnewsupplier").click(
		function() {
			let index = $("#txtindex").val();
			let skubid = $("#txtskubid").val();

			let name_supplier = $("#txtname-supplier");
			let address_supplier = $("#txtaddress-supplier");
			let phone_supplier = $("#txtphone-supplier");
			// let supplier_group = $("#listsupplier-group");
			let lattitude_supplier = $("#txtlattitude-supplier");
			let longitude_supplier = $("#txtlongitude-supplier");
			let stretclass_supplier = $("#listsupplier-stretclass");
			let stretclass2_supplier = $("#listsupplier-stretclass2");
			let area_supplier = $("#listsupplier-area");
			let province = $("#listsupplier-province");
			let city = $("#listsupplier-city");
			// let districts = $("#listsupplier-districts");
			let districts = $("#data-district");
			// let ward = $("#listsupplier-ward");
			let ward = $("#data-ward");
			let kodepos_supplier = $("#txtpostalcode-supplier");

			let name_contact_person = $("#txtname-contact-person");
			let phone_contact_person = $("#txtphone-contact-person");
			let kreditlimit_contact_person = $("#txtkreditlimit-contact-person");
			let segment1_contact_person = $("#listcontactperson-segment1").val();
			let segment2_contact_person = $("#listcontactperson-segment2").val();
			let segment3_contact_person = $("#listcontactperson-segment3").val();
			let listcontactperson_location = $("#listcontactperson-location");

			let isValidMultiLocation = '';
			if ($("#multilocation").is(':checked')) {
				isValidMultiLocation = 1;
			} else {
				isValidMultiLocation = 0;
			}

			let status = '';
			if ($("#txtstatus-supplier").is(':checked')) {
				status = 1;
			} else {
				status = 0;
			}

			let modesave = '';
			if ($("#rbcabang").prop('checked') == true) {
				modesave = 'CB';
			} else {
				modesave = 'HO';
			}

			let no_urut_hari = [];
			let nama_hari = [];
			let jam_buka = [];
			let jam_tutup = [];
			let status_operasional = [];
			let chk_penagihan = [];
			let chk_pengiriman = [];

			$("input[name='no-urut-hari']").each(function(i, v) {
				no_urut_hari.push($(this).val());
			});

			$("input[name='nama-hari']").each(function(i, v) {
				nama_hari.push($(this).val());
			});

			$("input[name='jam-buka']").each(function(i, v) {
				jam_buka.push($(this).val());
			});

			$("input[name='jam-tutup']").each(function(i, v) {
				jam_tutup.push($(this).val());
			});

			$("select[name='status-operasional']").each(function(i, v) {
				status_operasional.push($(this).val());
			});

			$("input[name='chk_pengiriman']").each(function(i, v) {
				if ($(this).is(':checked')) {
					chk_pengiriman.push(1);
				} else {
					chk_pengiriman.push(0);
				}
			});

			$("input[name='chk_penagihan']").each(function(i, v) {
				if ($(this).is(':checked')) {
					chk_penagihan.push(1);
				} else {
					chk_penagihan.push(0);
				}
			});

			let final_arr = [];
			for (let i = 0; i < no_urut_hari.length; i++) {
				final_arr.push({
					no_urut: no_urut_hari[i],
					hari: nama_hari[i],
					buka: jam_buka[i],
					tutup: jam_tutup[i],
					status: status_operasional[i],
					penagihan: chk_penagihan[i],
					pengiriman: chk_pengiriman[i]
				});
			}
			// console.log(c  hk_pengiriman);

			// console.log(
			// 	index,
			// 	skubid,
			// 	modesave,

			// 	name_supplier.val(),
			// 	address_supplier.val(),
			// 	phone_supplier.val(),

			// 	lattitude_supplier.val(),
			// 	longitude_supplier.val(),
			// 	stretclass_supplier.val(),
			// 	stretclass2_supplier.val(),
			// 	area_supplier.val(),
			// 	province.val(),
			// 	city.val(),
			// 	districts.val(),
			// 	ward.val(),
			// 	kodepos_supplier.val(),
			// 	name_contact_person.val(),
			// 	phone_contact_person.val(),
			// 	kreditlimit_contact_person.val(),
			// 	segment1_contact_person,
			// 	segment2_contact_person,
			// 	segment3_contact_person,
			// 	isValidMultiLocation,
			// 	listcontactperson_location.val(),
			// 	final_arr,
			// 	status);
			validasi_supplier(name_supplier, address_supplier, phone_supplier, lattitude_supplier, longitude_supplier,
				stretclass_supplier, stretclass2_supplier, area_supplier, province, city, districts, ward,
				kodepos_supplier, name_contact_person, phone_contact_person);

			$("#loadingadd").show();
			$("#btnsaveaddnewsupplier").prop("disabled", true);

			$.ajax({
				type: 'POST',
				url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/SaveAddNewSupplier') ?>",
				dataType: "json",
				// async: "true",
				data: {
					modesave: modesave,

					name_supplier: name_supplier.val(),
					address_supplier: address_supplier.val(),
					phone_supplier: phone_supplier.val(),
					// supplier_group: supplier_group.val(),
					lattitude_supplier: lattitude_supplier.val(),
					longitude_supplier: longitude_supplier.val(),
					stretclass_supplier: stretclass_supplier.val(),
					stretclass2_supplier: stretclass2_supplier.val(),
					area_supplier: area_supplier.val(),
					province: province.val(),
					city: city.val(),
					districts: districts.val(),
					ward: ward.val(),
					kodepos_supplier: kodepos_supplier.val(),
					name_contact_person: name_contact_person.val(),
					phone_contact_person: phone_contact_person.val(),
					kreditlimit_contact_person: kreditlimit_contact_person.val(),
					segment1_contact_person: segment1_contact_person,
					segment2_contact_person: segment2_contact_person,
					segment3_contact_person: segment3_contact_person,
					isValidMultiLocation: isValidMultiLocation,
					listcontactperson_location: listcontactperson_location.val(),
					timeoperasional: final_arr,
					status: status
				},

				success: function(response) {
					$("#loadingadd").hide();
					$("#btnsaveaddnewsupplier").prop("disabled", false);
					if (response == 1) {
						var msg = 'Data Supplier berhasil ditambah';
						var msgtype = 'success';
						initDataSupplier(index, skubid);
						Swal.fire(
							'Success!',
							msg,
							msgtype
						)


						// SetDataAwal();
						initDataSupplier(index, skubid);

						$("#previewaddnewsupplier").modal('hide');
						// ResetForm();
					} else {
						var msg = 'Data Supplier gagal ditambah';
						var msgtype = 'error';

						Swal.fire(
							'Error!',
							msg,
							msgtype
						)
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					$("#loadingadd").hide();
					$("#btnsaveaddnewsupplier").prop("disabled", false);
				}
			});
		}
	);


	$("#btnpilihsupplier").click(
		function() {
			ResetFormSupplier();
			// $("#previewaddnewprinciple").modal('show');
			$("#modal-pilihsupplier").modal('show');
			// $("#modal-supplier").modal('hide');

			AllSupplier();

		}
	);
	$(document).on('click', '#btn-search-supplier', function() {
		let area_id = $('#filter-area option:selected').val();
		let nama_supplier = $('#txtnamasupplier').val();
		// console.log(arrtempSupplierid);

		if (nama_supplier == '') {
			message("Error!", "<span name='CAPTION-ALERT-NAMATIDAKBOLEHKOSONG'>Nama Supplier tidak ditemukan!</span>", "error");
			return false;
		}
		$.ajax({
			type: "POST",
			url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/GetSupplierByArea') ?>",
			data: {
				area_id: area_id == '' ? '' : area_id,
				nama_supplier: nama_supplier,
				arrtempSupplierid: arrtempSupplierid == '' ? '' : arrtempSupplierid
			},
			async: false,
			dataType: "json",
			success: function(response) {
				$("#tablepilihsupplier > tbody").empty();

				if ($.fn.DataTable.isDataTable('#tablepilihsupplier')) {
					$('#tablepilihsupplier').DataTable().clear();
				}
				$.each(response, function(i, v) {

					// const findData = arrtempSupplierid.find((item) => (item.supplier_id != v.supplier_id))
					// console.log(findData);

					let sku_barang_supplier_id = v.sku_barang_supplier_id;
					let sku_barang_id = v.sku_barang_id;
					let supplier_nama = v.supplier_nama;
					let supplier_alamat = v.supplier_alamat;
					let supplier_kota = v.supplier_kota;
					let Status_supplier = v.supplier_is_aktif;
					let sku_barang_harga = v.sku_barang_harga;
					let supplier_id = v.supplier_id;
					// var supplier_id = Principle.Supplier[i].supplier_id_asli;

					var isAktif = v.supplier_is_aktif;
					let disb = "";

					if (isAktif == 0) {
						Status_PT = 'Non Aktif';
					} else {
						Status_PT = 'Aktif';
					}
					var strmenu = '';
					strmenu = strmenu + '<tr>';
					strmenu = strmenu + `	<td><input type="checkbox" name="cbpilihsupplier" id="check-supplier-${i}" value="${supplier_id}"></td>`;
					strmenu = strmenu + '	<td>' + supplier_nama + '</td>';
					strmenu = strmenu + '	<td>' + supplier_alamat + '</td>';
					strmenu = strmenu + '	<td>' + supplier_kota + '</td>';
					strmenu = strmenu + '	<td>' + Status_PT + '</td>';
					strmenu = strmenu + '</tr>';

					$("#tablepilihsupplier > tbody").append(strmenu);

				})
				$("#tablepilihsupplier").DataTable();
			}
		})

	})

	function AllSupplier() {

		// console.log(response);

		$("#tablepilihsupplier > tbody").empty();

		if ($.fn.DataTable.isDataTable('#tablepilihsupplier')) {
			$('#tablepilihsupplier').DataTable().clear();
			$('#tablepilihsupplier').DataTable().destroy();
		}
		var strmenu = '';
		strmenu = strmenu + '<tr>';
		strmenu = strmenu + `	<td class="text-center" colspan='5'>Data Kosong</td>`;
		strmenu = strmenu + '	<td style="display:none;"></td>';
		strmenu = strmenu + '	<td style="display:none;"></td>';
		strmenu = strmenu + '	<td style="display:none;"></td>';
		strmenu = strmenu + '	<td style="display:none;"></td>';
		strmenu = strmenu + '</tr>';

		$("#tablepilihsupplier > tbody").append(strmenu);

	};

	$(document).on("click", ".btn-choose-supplier-insert", function() {
		// var jumlah = $('input[name="cbpilihsupplier"]').length;
		// var numberOfChecked = $('input[name="cbpilihsupplier"]:checked').length;
		var jumlah = $('#tablepilihsupplier').DataTable().$('input[type=checkbox]').length;
		var numberOfChecked = $('#tablepilihsupplier').DataTable().$('input[type=checkbox]:checked').length;
		var no = 1;
		jumlah_sku = numberOfChecked;
		let skubid = $('#txtskubid').val();
		let index = $("#txtindex").val();
		let namasku = $('#labelnamasku').text();

		arr_supplier = [];

		if (numberOfChecked > 0) {
			// for (var i = 0; i < jumlah; i++) {
			// 	var checked = $('[id="check-supplier-' + i + '"]:checked').length;
			// 	var supplier_id = $("#check-supplier-" + i).val();

			// 	console.log(checked, supplier_id);
			// 	if (checked > 0) {
			// 		arr_supplier.push({
			// 			supplier_id: supplier_id,
			// 			sku_barang_id: skubid,
			// 			sku_barang_supplier_id: '',
			// 			sku_barang_harga: ''
			// 		});
			// 	}
			// }
			$("#tablepilihsupplier").DataTable().rows().nodes().to$().find('input[type="checkbox"]:checked').each(function(idx, item) {

				arr_supplier.push({
					supplier_id: this.value,
					sku_barang_id: skubid,
					sku_barang_supplier_id: '',
					sku_barang_harga: ''
				});
			})
			$.ajax({
				type: 'POST',
				url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/InsertSkuBarangSupplier') ?>",
				data: {
					arrSkuBarangSupplier: arr_supplier,
					sku_barang_supplier_id: ''
				},
				dataType: "JSON",
				success: function(response) {

					if (response['respon_insert'] == true) {
						var msg = `Data Supplier berhasil ditambah ke produk ${namasku} `;
						var msgtype = 'success';
						initDataSupplier(index, skubid);
						Swal.fire(
							'Success!',
							msg,
							msgtype
						)
						// SetDataAwal();
						initDataSupplier(index, skubid);

						$("#modal-pilihsupplier").modal('hide');
						// ResetForm();
					} else {
						var msg = 'Data Supplier gagal ditambah';
						var msgtype = 'error';

						Swal.fire(
							'Error!',
							msg,
							msgtype
						)
					}
				}
			})
		}
	})

	function ResetFormSupplier() {

		$("#txtname-supplier, #txtaddress-supplier, #txtphone-supplier,  #data-district, #data-ward, #txtpostalcode-supplier, #txtlattitude-supplier, #txtlongitude-supplier,#txtname-contact-person,#txtphone-contact-person,#txtkreditlimit-contact-person").each(function() {
			$(this).val("");
		});

		$("#listsupplier-stretclass, #listsupplier-stretclass2,#listarea-header,#listsupplier-province, #listsupplier-city, #listsupplier-districts,#listsupplier-ward,#listsupplier-area,#listcontactperson-segment1,#listcontactperson-segment2,#listcontactperson-segment3").each(function() {
			// $(this).prop('selectedIndex', 0);
			$(this).val("");
		});


	}




	function validasi_supplier(name_supplier, address_supplier, phone_supplier, lattitude_supplier, longitude_supplier,
		stretclass_supplier, stretclass2_supplier, area_supplier, province, city, districts, ward,
		kodepos_supplier, name_contact_person, phone_contact_person
	) {

		name_supplier.prop("required", true);
		address_supplier.prop("required", true);
		phone_supplier.prop("required", true);
		lattitude_supplier.prop("required", true);
		longitude_supplier.prop("required", true);
		stretclass_supplier.prop("required", true);
		stretclass2_supplier.prop("required", true);
		area_supplier.prop("required", true);
		province.prop("required", true);
		city.prop("required", true);
		districts.prop("required", true);
		ward.prop("required", true);
		kodepos_supplier.prop("required", true);
		name_contact_person.prop("required", true);
		phone_contact_person.prop("required", true);


		if (name_supplier.val() == "") {
			$(".txtname-supplier").addClass("has-error");
			$(".invalid-nama-supplier").html("Nama Principle tidak boleh kosong");
			name_supplier.focus();
		} else {
			$(".txtname-supplier").removeClass("has-error");
			$(".invalid-nama-supplier").html("");
		}

		if (address_supplier.val() == "") {
			$(".txtaddress-supplier").addClass("has-error");
			$(".invalid-alamat-supplier").html("Alamat Principle tidak boleh kosong");
			address_supplier.focus();
		} else {
			$(".txtaddress-supplier").removeClass("has-error");
			$(".invalid-alamat-supplier").html("");
		}

		// if (phone_supplier.val() == "") {
		// 	$(".txtphone-supplier").addClass("has-error");
		// 	$(".invalid-telepon-supplier").html("Telephon Principle tidak boleh kosong");
		// 	phone_supplier.focus();
		// } else {
		// 	$(".txtphone-supplier").removeClass("has-error");
		// 	$(".invalid-telepon-supplier").html("");
		// }

		// if (lattitude_supplier.val() == "") {
		// 	$(".txtlattitude-supplier").addClass("has-error");
		// 	$(".invalid-lattitude-supplier").html("Lattitude Principle tidak boleh kosong");
		// 	lattitude_supplier.focus();
		// } else {
		// 	$(".txtlattitude-supplier").removeClass("has-error");
		// 	$(".invalid-lattitude-supplier").html("");
		// }

		// if (longitude_supplier.val() == "") {
		// 	$(".txtlongitude-supplier").addClass("has-error");
		// 	$(".invalid-longitude-supplier").html("Longitude Principle tidak boleh kosong");
		// 	longitude_supplier.focus();
		// } else {
		// 	$(".txtlongitude-supplier").removeClass("has-error");
		// 	$(".invalid-longitude-supplier").html("");
		// }

		if (stretclass_supplier.val() == "") {
			$(".listsupplier-stretclass").addClass("has-error");
			$(".invalid-kelas_jalan-supplier").html("Kelas Jalan berdasarkan barang muatan tidak boleh kosong");
			stretclass_supplier.focus();
		} else {
			$(".listsupplier-stretclass").removeClass("has-error");
			$(".invalid-kelas_jalan-supplier").html("");
		}

		if (stretclass2_supplier.val() == "") {
			$(".listsupplier-stretclass2").addClass("has-error");
			$(".invalid-kelas_jalan2-supplier").html("Kelas Jalan berdasarkan fungsi barang tidak boleh kosong");
			stretclass2_supplier.focus();
		} else {
			$(".listsupplier-stretclass2").removeClass("has-error");
			$(".invalid-kelas_jalan2-supplier").html("");
		}

		if (area_supplier.val() == "") {
			$(".listsupplier-area").addClass("has-error");
			$(".invalid-area-supplier").html("Area Principle tidak boleh kosong");
			area_supplier.focus();
		} else {
			$(".listsupplier-area").removeClass("has-error");
			$(".invalid-area-supplier").html("");
		}

		if (province.val() == "") {
			$(".listsupplier-province").addClass("has-error");
			$(".invalid-provinsi-supplier").html("Provinsi Principle tidak boleh kosong");
			province.focus();
		} else {
			$(".listsupplier-province").removeClass("has-error");
			$(".invalid-provinsi-supplier").html("");
		}

		if (city.val() == "") {
			$(".listsupplier-city").addClass("has-error");
			$(".invalid-kota-supplier").html("Kota Principle tidak boleh kosong");
			city.focus();
		} else {
			$(".listsupplier-city").removeClass("has-error");
			$(".invalid-kota-supplier").html("");
		}

		if (districts.val() == "") {
			$(".listsupplier-districts").addClass("has-error");
			$(".invalid-kecamatan-supplier").html("Kecamatan Principle tidak boleh kosong");
			districts.focus();
		} else {
			$(".listsupplier-districts").removeClass("has-error");
			$(".invalid-kecamatan-supplier").html("");
		}

		if (ward.val() == "") {
			$(".listsupplier-ward").addClass("has-error");
			$(".invalid-kelurahan-supplier").html("Kelurahan Principle tidak boleh kosong");
			ward.focus();
		} else {
			$(".listsupplier-ward").removeClass("has-error");
			$(".invalid-kelurahan-supplier").html("");
		}

		if (kodepos_supplier.val() == "") {
			$(".txtpostalcode-supplier").addClass("has-error");
			$(".invalid-kode-pos-supplier").html("Kode Pos Principle tidak boleh kosong");
			kodepos_supplier.focus();
		} else {
			$(".txtpostalcode-supplier").removeClass("has-error");
			$(".invalid-kode-pos-supplier").html("");
		}

		// if (name_contact_person.val() == "") {
		// 	$(".txtname-contact-person").addClass("has-error");
		// 	$(".invalid-nama-contact-person").html("Nama Contact Person tidak boleh kosong");
		// 	name_contact_person.focus();
		// } else {
		// 	$(".txtname-contact-person").removeClass("has-error");
		// 	$(".invalid-nama-contact-person").html("");
		// }

		// if (phone_contact_person.val() == "") {
		// 	$(".txtphone-contact-person").addClass("has-error");
		// 	$(".invalid-telepon-contact-person").html("Telepon Contact Person tidak boleh kosong");
		// 	phone_contact_person.focus();
		// } else {
		// 	$(".txtphone-contact-person").removeClass("has-error");
		// 	$(".invalid-telepon-contact-person").html("");
		// }

	}

	// update
</script>