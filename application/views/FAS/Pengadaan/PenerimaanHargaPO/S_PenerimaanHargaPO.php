<script text="text/javascript">
	let arrSkuBarangPO = [];
	let arr_detail_push = [];
	let arrcountitempo = [];
	let item_pn_count = $("#item-count-penerimaanhargapodetail").val();
	$(document).ready(
		function() {
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
			$("#penerimaanorder-penerimaan_order_tgl").attr("readonly", true);
			// $("#penerimaanorder-penerimaan_kode").attr("readonly", true);
			$("#penerimaanorder-penerimaan_order_tgl_dibutuhkan").attr("readonly", true);
			$("#penerimaanorder-penerimaan_order_pemohon").attr("readonly", true);
			$("#penerimaanorder-penerimaan_order_keterangan").attr("readonly", true);
			$("#penerimaanorder-client_wms_id").attr("disabled", true);
			$("#penerimaanorder-karyawan_divisi_id").attr("disabled", true);
			$("#penerimaanorder-tipe_pengadaan_id").attr("disabled", true);
			$("#penerimaanorder-tipe_transaksi_id").attr("disabled", true);
			$("#penerimaanorder-kategori_biaya_id").attr("disabled", true);
			$("#penerimaanorder-tipe_biaya_id").attr("disabled", true);
			$("#penerimaanorder-tipe_kepemilikan_id").attr("disabled", true);


			// ////////////////// UPDATE
			<?php if ($act == "edit") { ?>

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
		})

	$(document).on('click', '#btn-search-data-pn', function() {
		$("#loadingviewpr").show();
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Pengadaan/PenerimaanHargaPO/search_penerimaan_by_filter') ?>",
			data: {
				tgl: $("#filter-pr-date").val(),
				perusahaan: $("#filter-pr-perusahaan").val(),
				divisi: $("#filter-pr-divisi").val()
			},
			dataType: "JSON",
			success: function(response) {
				console.log(response);

				$("#table_list_data_pn > tbody").empty();

				if ($.fn.DataTable.isDataTable('#table_list_data_pn')) {
					$('#table_list_data_pn').DataTable().clear();
					$('#table_list_data_pn').DataTable().destroy();
				}

				if (response != 0) {
					$.each(response, function(i, v) {
						if (v.penerimaan_sku_barang_status_harga == 'Draft') {
							$("#table_list_data_pn > tbody").append(`
							<tr>
								<td class="text-center">${v.penerimaan_sku_barang_kode}</td>
								<td class="text-center">${v.purchase_order_kode}</td>
								<td class="text-center">${v.supplier_nama}</td>
								<td class="text-center">${v.tgl_create_po}</td>
								<td class="text-center">${v.tgl_create_penerimaan}</td>
								<td class="text-center">${v.penerimaan_sku_barang_who_create}</td>
								<td class="text-center">${v.penerimaan_sku_barang_status_harga}</td>
								<td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PenerimaanHargaPO/edit/?id=${v.purchase_order_id}&pnid=${v.penerimaan_sku_barang_id}" class="btn btn-primary btn-small btn-delete-sku"><i class="fa fa-pencil"></i></a></td>
							</tr>
						`);
						}
						if (v.penerimaan_sku_barang_status_harga == 'Completed') {
							$("#table_list_data_pn > tbody").append(`
                                <tr>
                                    <td class="text-center">${v.penerimaan_sku_barang_kode}</td>
                                    <td class="text-center">${v.purchase_order_kode}</td>
                                    <td class="text-center">${v.supplier_nama}</td>
                                    <td class="text-center">${v.tgl_create_po}</td>
                                    <td class="text-center">${v.tgl_create_penerimaan}</td>
                                    <td class="text-center">${v.penerimaan_sku_barang_who_create}</td>
                                    <td class="text-center">${v.penerimaan_sku_barang_status_harga}</td>
                                    <td class="text-center"><a href="<?= base_url() ?>FAS/Pengadaan/PenerimaanHargaPO/view/?id=${v.purchase_order_id}&pnid=${v.penerimaan_sku_barang_id}" class="btn btn-warning btn-small btn-delete-sku"><i class="fa fa-search"></i></a></td>
                                </tr>
                            `);
						}
						if (v.penerimaan_sku_barang_status_harga == 'Partially Received') {
							$("#table_list_data_pn > tbody").append(`
                                <tr>
                                    <td class="text-center">${v.penerimaan_sku_barang_kode}</td>
                                    <td class="text-center">${v.purchase_order_kode}</td>
                                    <td class="text-center">${v.supplier_nama}</td>
                                    <td class="text-center">${v.tgl_create_po}</td>
                                    <td class="text-center">${v.tgl_create_penerimaan}</td>
                                    <td class="text-center">${v.penerimaan_sku_barang_who_create}</td>
                                    <td class="text-center">${v.penerimaan_sku_barang_status_harga}</td>
                                    <td class="text-center">-</td>
                                </tr>
                            `);
						}

					});
					$('#table_list_data_pn').DataTable({
						'ordering': false
					});
				} else {
					$("#table_list_data_pn > tbody").append(`
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

	$(document).on('change', '#penerimaanorder-penerimaan_kode', function() {
		let pn_id = $('#penerimaanorder-penerimaan_kode option:selected').val();
		$('#header').fadeOut("slow", function() {
			$(this).hide();
		}).fadeIn("slow", function() {
			$.ajax({
				type: 'POST',
				data: {
					penerimaan_id: pn_id,
				},
				url: "<?= base_url('FAS/Pengadaan/PenerimaanHargaPO/GetDataDetailByKodePo') ?>",
				dataType: "json",
				// data: "PrincipleId=" + id,
				success: function(response) {
					if (response) {

						$.each(response, function(i, v) {
							console.log(v);
							$("#penerimaanorder-penerimaan_order_keterangan").val(v.purchase_order_keterangan == null ? '' : v.purchase_order_keterangan);
							$("#penerimaanorder-client_wms_id").val(v.client_wms_id).change();
							$("#penerimaanorder-penerimaan_order_tgl").val(v.purchase_order_tgl_create);
							$("#penerimaanorder-penerimaan_order_tgl_dibutuhkan").val(v.purchase_request_tgl_dibutuhkan);
							$("#penerimaanorder-karyawan_divisi_id").val(v.karyawan_divisi_id).change();
							$("#penerimaanorder-tipe_pengadaan_id").val(v.tipe_pengadaan_id).change();
							$("#penerimaanorder-tipe_transaksi_id").val(v.tipe_transaksi_id).change();
							$("#penerimaanorder-kategori_biaya_id").val(v.kategori_biaya_id).change();
							$("#penerimaanorder-tipe_biaya_id").val(v.tipe_biaya_id).change();
							$("#penerimaanorder-gudang_id").val(v.gudang_id).change();
							$("#penerimaan-po_kode").val(v.purchase_order_kode);
							$("#hpr_id").val(v.purchase_request_id);
							$("#hpo_id").val(v.purchase_order_id);
							$("#hsp_id").val(v.supplier_id);
							$("#hpn_id").val(v.penerimaan_sku_barang_id);
							$("#penerimaanorder-penerimaan_order_status").val(v.purchase_order_status);
							$("#penerimaanorder-penerimaan_nm_supplier").val(v.supplier_nama);
						})
						AppendToTableDetail();
					}
				}
			});
			$(this).show();
		});

	})

	function AppendToTableDetail() {
		arrSkuBarangPO = [];
		if ($.fn.DataTable.isDataTable('#tablebarangpo')) {
			$('#tablebarangpo').DataTable().clear();
		}
		$('#tablebarangpo > tbody').empty();
		$('#tablebarangpo').fadeOut("slow", function() {
			$(this).hide();

		}).fadeIn("slow", function() {
			$.ajax({
				url: "<?= base_url('FAS/Pengadaan/PenerimaanHargaPO/GetPurchaseRequestDetailById'); ?>",
				type: "POST",
				data: {
					penerimaan_id: $('#hpn_id').val()
				},
				dataType: "JSON",
				success: function(data) {
					let response = data;
					arrcountitempo.push(data.length);
					let subtotalawal = '';

					$.each(response, function(i, v) {
						arrSkuBarangPO.push({
							sku_barang_satuan: v.sku_barang_satuan,
							sku_barang_nama_produk: v.sku_barang_nama_produk,
							sku_barang_kode: v.sku_barang_kode,
							sku_barang_kemasan: v.sku_barang_kemasan,
							sku_barang_id: v.sku_barang_id,
							sku_barang_harga: v.sku_barang_harga,
							purchase_order_detail_qty: v.purchase_order_detail_qty,
							supplier_id: v.supplier_id,
							purchase_order_id: v.purchase_order_id,
						});

						subtotalawal = parseInt(Math.round(v.sku_barang_harga)) * parseInt(v.penerimaan_sku_barang_detail_qty_terima);


						$("#tablebarangpo tbody").append(`
                    
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
                        <td><span id="span-item-${i}-purchase_order_detail_qty">${v.penerimaan_sku_barang_detail_qty}</span></td>
                        <td><span id="span-item-${i}-purchase_order_detail_qty_sisa">${v.penerimaan_sku_barang_detail_qty_sisa==null? v.penerimaan_sku_barang_detail_qty : v.penerimaan_sku_barang_detail_qty_sisa}</span></td>
                        <td><span id="span-item-${i}-purchase_order_detail_qty_terima">${v.penerimaan_sku_barang_detail_qty_terima==null? 0 : v.penerimaan_sku_barang_detail_qty_terima}</span></td>
                        <td style="display:none;"><input type="number" class="form-control numeric" id="item-${i}-purchase_order_detail_qty_akan_terima" ${v.penerimaan_sku_barang_detail_qty_sisa==0? 'disabled' : ''} value="0"></td>
                        <td><input type="text" class="form-control numeric" id="item-${i}-sku_barang_harga" ${v.purchase_order_detail_qty_sisa==0? 'disabled' : ''}  onchange="SumSubTotalReqQty(this.value,${i},0)" value="${Math.round(v.sku_barang_harga)}"></td>
						<td><span id="span-item-${i}-purchase_order_sub_total">${subtotalawal}</span></td>
						<td>${v.purchase_order_detail_keterangan==null?'-':v.purchase_order_detail_keterangan}</td>
						<td style="display: none;">
							<button class="btn btn-danger btn-small HapusItemPaketAddPO idx-${i} ${v.sku_barang_id}" value="${v.purchase_order_id}" id="btnDetailPo"><i class="fa fa-trash"><label id="lbnmsupp" class="nm-${v.supplier_nama}"></label></i></button>
						</td>
                        <td style="display:none;"><span id="span-item-${i}-supplier_id">${v.supplier_id}</span></td>
                        <td style="display:none;"><span id="span-item-${i}-sku_barang_id">${v.sku_barang_id}</span></td>
				    </tr>
				    `);

					})
				}
			})
		})
	}
	$(document).on("input", ".numeric", function(event) {
		this.value = this.value.replace(/[^\d.]+/g, '');
	});
	$(document).on('click', '.HapusItemPaketAddPO', function() {
		let idx = $(this).attr('class').split(' ')[4].split('-')[1]
		let sku_barang_id = $(this).attr('class').split(' ')[5]
		const fil = arrSkuBarangPO.filter((data, index) => data.sku_barang_id !== sku_barang_id);
		arrSkuBarangPO.length = 0;
		$.each(fil, function(i, v) {
			arrSkuBarangPO.push(v);
		})

		$(this).parent().parent().remove();
		$("#tablebarangpo tbody tr").each(function(i, v) {
			let tridx = $(this)
			let it0 = $(this).find("td:eq(0)")
			// console.log(it2val);
			let it1span = $(this).find("td:eq(1) span")
			let it2span = $(this).find("td:eq(2) span")
			let it3span = $(this).find("td:eq(3) span")
			let it4span = $(this).find("td:eq(4) span")
			let it5span = $(this).find("td:eq(5) span")
			let it6span = $(this).find("td:eq(6) span")
			let it7span = $(this).find("td:eq(7) span")
			let it8 = $(this).find("td:eq(8) input")
			let it9span = $(this).find("td:eq(9) input")
			let it10span = $(this).find("td:eq(10) span")
			let it11btn = $(this).find("td:eq(11) button")
			let it12span = $(this).find("td:eq(12) span")
			let it13span = $(this).find("td:eq(13) span")


			it0.html(`${i+1}`);
			it1span.attr('id', `span-item-${i}-sku_barang_kode`);
			it2span.attr('id', `span-item-${i}-sku_barang_nama_produk`);
			it3span.attr('id', `span-item-${i}-sku_barang_satuan`);
			it4span.attr('id', `span-item-${i}-sku_barang_kemasan`);
			it5span.attr('id', `span-item-${i}-purchase_order_detail_qty`);
			it6span.attr('id', `span-item-${i}-purchase_order_detail_qty_sisa`);
			it7span.attr('id', `span-item-${i}-purchase_order_detail_qty_terima`);
			it8.attr('id', `item-${i}-purchase_order_detail_qty_akan_terima`);

			it9span.attr('id', `item-${i}-sku_barang_harga`);
			// it9btn.attr('id', `item-${i}-sku_barang_nama_produk`);
			it12span.attr('id', `span-item-${i}-supplier_id`);
			it13span.attr('id', `span-item-${i}-sku_barang_id`);

			tridx.attr('id', `row-${i}`)
		});

	});
	$(document).on('click', '.HapusItemPaketEditPO', function() {
		let idx = $(this).attr('class').split(' ')[4].split('-')[1]
		let sku_barang_id = $(this).attr('class').split(' ')[5]
		const fil = arrSkuBarangPO.filter((data, index) => data.sku_barang_id !== sku_barang_id);
		arrSkuBarangPO.length = 0;
		$.each(fil, function(i, v) {
			arrSkuBarangPO.push(v);
		})

		$(this).parent().parent().remove();
		$("#tablebarangpoedit tbody tr").each(function(i, v) {
			let tridx = $(this)
			let it0 = $(this).find("td:eq(0)")
			// console.log(it2val);
			let it1span = $(this).find("td:eq(1) span")
			let it2span = $(this).find("td:eq(2) span")
			let it3span = $(this).find("td:eq(3) span")
			let it4span = $(this).find("td:eq(4) span")
			let it5span = $(this).find("td:eq(5) span")
			let it6span = $(this).find("td:eq(6) span")
			let it7span = $(this).find("td:eq(7) span")
			let it8 = $(this).find("td:eq(8) input")
			let it9span = $(this).find("td:eq(9) input")
			let it10span = $(this).find("td:eq(10) span")
			let it11btn = $(this).find("td:eq(11) button")
			let it12span = $(this).find("td:eq(12) span")
			let it13span = $(this).find("td:eq(13) span")


			it0.html(`${i+1}`);
			it1span.attr('id', `span-item-${i}-sku_barang_kode`);
			it2span.attr('id', `span-item-${i}-sku_barang_nama_produk`);
			it3span.attr('id', `span-item-${i}-sku_barang_satuan`);
			it4span.attr('id', `span-item-${i}-sku_barang_kemasan`);
			it5span.attr('id', `span-item-${i}-purchase_order_detail_qty`);
			it6span.attr('id', `span-item-${i}-purchase_order_detail_qty_sisa`);
			it7span.attr('id', `span-item-${i}-purchase_order_detail_qty_terima`);
			it8.attr('id', `item-${i}-purchase_order_detail_qty_akan_terima`);

			it9span.attr('id', `item-${i}-sku_barang_harga`);
			// it9btn.attr('id', `item-${i}-sku_barang_nama_produk`);
			it12span.attr('id', `span-item-${i}-supplier_id`);
			it13span.attr('id', `span-item-${i}-sku_barang_id`);

			tridx.attr('id', `row-${i}`)
		});

	});

	// const handlerChangeNominal = (event, counter) => {
	// 	console.log(event.currentTarget.value);
	// 	$(`#item-${counter}-sku_barang_harga`).val(numberFormat(parseInt(event.currentTarget.value)));
	// }
	const numberFormat = (number) => {
		return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	function SumSubTotalReqQty(hrg, index, type) {
		console.log(hrg);
		let qty = $(`#span-item-${index}-purchase_order_detail_qty_terima`).text();
		if (type == 1) {
			$(`#edititem-${index}-sku_barang_harga`).val(numberFormat(parseInt(hrg)));
		} else {

			$(`#item-${index}-sku_barang_harga`).val(numberFormat(parseInt(hrg)));
		}


		var total = parseFloat(qty) * parseFloat(hrg);

		$("#span-item-" + index + "-purchase_order_sub_total").html('');
		$("#span-item-" + index + "-purchase_order_sub_total").append(numberFormat(parseInt(total)));


	}

	// function EditSumSubTotalReqQty(hrg, index) {
	// 	console.log(hrg);
	// 	let qty = $(`#span-item-${index}-purchase_order_detail_qty_terima`).text();

	// 	let hrg2 = $(`#edititem-${index}-sku_barang_harga`).val(numberFormat(parseInt(hrg)))

	// 	var total = parseFloat(hrg2) * parseFloat(qty);

	// 	$("#span-item-" + index + "-purchase_order_sub_total").html('');
	// 	$("#span-item-" + index + "-purchase_order_sub_total").append(numberFormat(parseInt(total)));


	// }
	$(document).on('click', '#btnsavepenerimaanpo', function() {

		let gudang_id = $('#penerimaanorder-gudang_id option:selected').val();
		let kode_po = $('#penerimaanorder-penerimaan_kode option:selected').val();
		let clietn_wms_id = $('#penerimaanorder-client_wms_id option:selected').val();
		if (kode_po == null || kode_po == '') {
			message("Error!", "Mohon Pilih Kode PO", "error");
			return false;
		}
		if (clietn_wms_id == null || clietn_wms_id == '') {
			message("Error!", "Perusahaan tidak boleh kosong", "error");
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
					// 'sku_barang_harga': $("#item-" + index + "-purchaserequestdetail-sku_barang_harga").val(),
					'sku_barang_id': $("#span-item-" + index + "-sku_barang_id").text(),
					'sku_barang_harga': $("#item-" + index + "-sku_barang_harga").val().replaceAll(',', ''),
					'purchase_order_detail_qty': $("#span-item-" + index + "-purchase_order_detail_qty").text(),
					'purchase_order_detail_qty_terima': $("#item-" + index + "-purchase_order_detail_qty_akan_terima").val(),
					'purchase_order_detail_qty_sisa': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? 0 : parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) - parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()),
					'supplier_id': $("#span-item-" + index + "-supplier_id").text(),
					'sku_barang_stock_awal': $("#span-item-" + index + "-purchase_order_detail_qty").text(),
					// 'sku_barang_stock_masuk': parseInt($("#span-item-" + index + "-purchase_order_detail_qty").text()) - parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()),
					'sku_barang_stock_masuk': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()),
					'sku_barang_stock_keluar': 0,
					'sku_barang_stock_akhir': 0,
					'purchase_order_id': $("#hpo_id").val(),
					// 'penerimaan_sku_barang_qty_sum': $("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()
					'penerimaan_sku_barang_qty_sum': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text())
				});
			}

		}

		// return false;
		if (arrSkuBarangPO.length == 0) {
			message("Erorr", "Mohon pilih ulang kode po", "warning!")
			return;
		}
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
					url: "<?= base_url('FAS/Pengadaan/PenerimaanHargaPO/update_harga_penerimaan_sku_barang_detail'); ?>",
					type: "POST",
					data: {
						pn_id: $('#hpn_id').val(),
						client_wms_id: $('#penerimaanorder-client_wms_id option:selected').val(),
						gudang_id: gudang_id,
						button: 'simpan',
						detail: arr_detail_push,
						type: 0,
						status: 'Draft'

					},
					dataType: "JSON",
					success: function(data) {
						if (data == 1) {
							message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
							setTimeout(() => {
								location.href = "<?= base_url(); ?>FAS/Pengadaan/PenerimaanHargaPO/PenerimaanHargaPOMenu";
							}, 500);
						} else {
							message_topright("error", "<span name='CAPTION-ALERT-GAGAL'>Data gagal disimpan</span>");
						}
					}
				});
			}
		})

	})

	$(document).on('click', '#btnkonfirmasipenerimaanpo', function() {
		let gudang_id = $('#penerimaanorder-gudang_id option:selected').val();
		let kode_po = $('#penerimaanorder-penerimaan_kode option:selected').val();
		let clietn_wms_id = $('#penerimaanorder-client_wms_id option:selected').val();
		if (kode_po == null || kode_po == '') {
			message("Error!", "Mohon Pilih Kode PO", "error");
			return false;
		}
		if (clietn_wms_id == null || clietn_wms_id == '') {
			message("Error!", "Perusahaan tidak boleh kosong", "error");
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
					// 'sku_barang_harga': $("#item-" + index + "-purchaserequestdetail-sku_barang_harga").val(),
					'sku_barang_id': $("#span-item-" + index + "-sku_barang_id").text(),
					'sku_barang_harga': $("#item-" + index + "-sku_barang_harga").val().replaceAll(',', ''),
					'purchase_order_detail_qty': $("#span-item-" + index + "-purchase_order_detail_qty").text(),
					'purchase_order_detail_qty_terima': $("#item-" + index + "-purchase_order_detail_qty_akan_terima").val(),
					'purchase_order_detail_qty_sisa': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? 0 : parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) - parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()),
					'supplier_id': $("#span-item-" + index + "-supplier_id").text(),
					'sku_barang_stock_awal': $("#span-item-" + index + "-purchase_order_detail_qty").text(),
					// 'sku_barang_stock_masuk': parseInt($("#span-item-" + index + "-purchase_order_detail_qty").text()) - parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()),
					'sku_barang_stock_masuk': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()),
					'sku_barang_stock_keluar': 0,
					'sku_barang_stock_akhir': 0,
					'purchase_order_id': $("#hpo_id").val(),
					// 'penerimaan_sku_barang_qty_sum': $("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()
					'penerimaan_sku_barang_qty_sum': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text())
				});
			}

		}

		// return false;
		if (arrSkuBarangPO.length == 0) {
			message("Erorr", "Mohon pilih ulang kode po", "warning!")
			return;
		}
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
					url: "<?= base_url('FAS/Pengadaan/PenerimaanHargaPO/update_harga_penerimaan_sku_barang_detail'); ?>",
					type: "POST",
					data: {
						pn_id: $('#hpn_id').val(),
						client_wms_id: $('#penerimaanorder-client_wms_id option:selected').val(),
						gudang_id: gudang_id,
						button: 'konfirmasi',
						detail: arr_detail_push,
						type: 1,
						status: 'Completed'

					},
					dataType: "JSON",
					success: function(data) {
						if (data == 1) {
							message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
							setTimeout(() => {
								location.href = "<?= base_url(); ?>FAS/Pengadaan/PenerimaanHargaPO/PenerimaanHargaPOMenu";
							}, 500);
						} else {
							message_topright("error", "<span name='CAPTION-ALERT-GAGAL'>Data gagal disimpan</span>");
						}
					}
				});
			}
		})

	})


	//////////////////////////////////////////////////////UPDATE
	$(document).on('click', '#btneditpenerimaanpo', function() {
		let gudang_id = $('#editpenerimaanorder-gudang_id option:selected').val();
		let kode_po = $('#editpenerimaanorder-penerimaan_kode option:selected').val();


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
					// 'sku_barang_harga': $("#item-" + index + "-purchaserequestdetail-sku_barang_harga").val(),
					'sku_barang_id': $("#span-item-" + index + "-sku_barang_id").text(),
					'sku_barang_harga': $("#edititem-" + index + "-sku_barang_harga").val().replaceAll(',', ''),
					'purchase_order_detail_qty': $("#span-item-" + index + "-purchase_order_detail_qty").text(),
					'purchase_order_detail_qty_terima': $("#item-" + index + "-purchase_order_detail_qty_akan_terima").val(),
					'purchase_order_detail_qty_sisa': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? 0 : parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) - parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()),
					// 'supplier_id': $("#span-item-" + index + "-supplier_id").text(),
					'sku_barang_stock_awal': $("#span-item-" + index + "-purchase_order_detail_qty").text(),
					// 'sku_barang_stock_masuk': parseInt($("#span-item-" + index + "-purchase_order_detail_qty").text()) - parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()),
					'sku_barang_stock_masuk': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()),
					'sku_barang_stock_keluar': 0,
					'sku_barang_stock_akhir': 0,
					'purchase_order_id': $("#hpo_id").val(),
					// 'penerimaan_sku_barang_qty_sum': $("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()
					'penerimaan_sku_barang_qty_sum': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text())
				});
			}

		}
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
					url: "<?= base_url('FAS/Pengadaan/PenerimaanHargaPO/update_harga_penerimaan_sku_barang_detail'); ?>",
					type: "POST",
					data: {
						pn_id: $('#hpn_id').val(),
						client_wms_id: $('#editpenerimaanorder-client_wms_id option:selected').val(),
						gudang_id: gudang_id,
						button: 'simpan',
						detail: arr_detail_push,
						type: 0,
						status: 'Draft'

					},
					dataType: "JSON",
					success: function(data) {
						if (data == 1) {
							message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
							setTimeout(() => {
								location.href = "<?= base_url(); ?>FAS/Pengadaan/PenerimaanHargaPO/PenerimaanHargaPOMenu";
							}, 500);
						} else {
							message_topright("error", "<span name='CAPTION-ALERT-GAGAL'>Data gagal disimpan</span>");
						}
					}
				});
			}
		})
	})

	$(document).on('click', '#btneditkonfirmasipenerimaanpo', function() {
		let gudang_id = $('#editpenerimaanorder-gudang_id option:selected').val();
		let kode_po = $('#editpenerimaanorder-penerimaan_kode option:selected').val();


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
					// 'sku_barang_harga': $("#item-" + index + "-purchaserequestdetail-sku_barang_harga").val(),
					'sku_barang_id': $("#span-item-" + index + "-sku_barang_id").text(),
					'sku_barang_harga': $("#edititem-" + index + "-sku_barang_harga").val().replaceAll(',', ''),
					'purchase_order_detail_qty': $("#span-item-" + index + "-purchase_order_detail_qty").text(),
					'purchase_order_detail_qty_terima': $("#item-" + index + "-purchase_order_detail_qty_akan_terima").val(),
					'purchase_order_detail_qty_sisa': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? 0 : parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) - parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()),
					// 'supplier_id': $("#span-item-" + index + "-supplier_id").text(),
					'sku_barang_stock_awal': $("#span-item-" + index + "-purchase_order_detail_qty").text(),
					// 'sku_barang_stock_masuk': parseInt($("#span-item-" + index + "-purchase_order_detail_qty").text()) - parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()),
					'sku_barang_stock_masuk': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()),
					'sku_barang_stock_keluar': 0,
					'sku_barang_stock_akhir': 0,
					'purchase_order_id': $("#hpo_id").val(),
					// 'penerimaan_sku_barang_qty_sum': $("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()
					'penerimaan_sku_barang_qty_sum': parseInt($("#span-item-" + index + "-purchase_order_detail_qty_sisa").text()) == 0 ? parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text()) : parseInt($("#item-" + index + "-purchase_order_detail_qty_akan_terima").val()) + parseInt($("#span-item-" + index + "-purchase_order_detail_qty_terima").text())
				});
			}

		}
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
					url: "<?= base_url('FAS/Pengadaan/PenerimaanHargaPO/update_harga_penerimaan_sku_barang_detail'); ?>",
					type: "POST",
					data: {
						pn_id: $('#hpn_id').val(),
						client_wms_id: $('#editpenerimaanorder-client_wms_id option:selected').val(),
						gudang_id: gudang_id,
						button: 'simpan',
						detail: arr_detail_push,
						type: 1,
						status: 'Completed'

					},
					dataType: "JSON",
					success: function(data) {
						if (data == 1) {
							message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
							setTimeout(() => {
								location.href = "<?= base_url(); ?>FAS/Pengadaan/PenerimaanHargaPO/PenerimaanHargaPOMenu";
							}, 500);
						} else {
							message_topright("error", "<span name='CAPTION-ALERT-GAGAL'>Data gagal disimpan</span>");
						}
					}
				});
			}
		})
	})
</script>