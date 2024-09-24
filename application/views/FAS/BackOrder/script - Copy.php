<script type="text/javascript">
	var jumlah_sku = 0;
	var layanan = "";
	let arr_sku = [];
	let arr_header = [];
	let arr_detail = [];
	var cek_qty = 0;

	$(document).ready(
		function() {
			$('.select2').select2();
			if ($('#filter-do-date').length > 0) {
				$('#filter-do-date').daterangepicker({
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
		}
	);

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

	function getCustomer() {
		initDataCustomer()
	}

	// $("#btn-choose-prod-delivery").on("click", function() {
	// 	initDataSKU();
	// });

	$("#btn-search-sku").on("click", function() {
		initDataSKU();
	});

	$("#btn-search-customer").on("click", function() {
		getCustomer();
	});

	$("#btn-search-factory").on("click", function() {
		getCustomer();
	});

	$("#btn-search-data-do-draft").on("click", function() {

		$.ajax({
			type: 'POST',
			url: "<?= base_url('WMS/Distribusi/DeliveryOrderDraft/GetDeliveryOrderDraftByFilter') ?>",
			data: {
				tgl: $("#filter-do-date").val(),
				do_no: $("#filter-do-number").val(),
				customer: $("#filter-customer").val(),
				alamat: $("#filter-address").val(),
				tipe_pembayaran: $("#filter-payment-type").val(),
				tipe_layanan: $("#filter-service-type").val(),
				status: $("#filter-status").val(),
				tipe: $("#filter-do-type").val()
			},
			dataType: "JSON",
			success: function(response) {

				$("#table_list_data_do_draft > tbody").empty();

				if ($.fn.DataTable.isDataTable('#table_list_data_do_draft')) {
					$('#table_list_data_do_draft').DataTable().clear();
					$('#table_list_data_do_draft').DataTable().destroy();
				}

				if (response != 0) {
					$.each(response, function(i, v) {
						$("#table_list_data_do_draft > tbody").append(`
							<tr>
								<td class="text-center">${v.delivery_order_draft_tgl_buat_do}</td>
								<td class="text-center">${v.delivery_order_draft_kode}</td>
								<td class="text-center">${v.delivery_order_draft_kirim_nama}</td>
								<td class="text-center" style="width:25%;">${v.delivery_order_draft_kirim_alamat}</td>
								<td class="text-center" style="width:10%;">${v.delivery_order_draft_tipe_pembayaran}</td>
								<td class="text-center">${v.delivery_order_draft_tipe_layanan}</td>
								<td class="text-center">${v.tipe_delivery_order_nama}</td>
								<td class="text-center">${v.delivery_order_draft_status}</td>
								<td class="text-center"><a href="<?= base_url() ?>WMS/Distribusi/DeliveryOrderDraft/edit/?id=${v.delivery_order_draft_id}" class="btn btn-primary btn-small btn-delete-sku"><i class="fa fa-pencil"></i></a></td>
							</tr>
						`);
					});
					$('#table_list_data_do_draft').DataTable({
						'ordering': false
					});
				} else {
					$("#table_list_data_do_draft > tbody").append(`
								<tr>
									<td colspan="9" class="text-danger text-center">
										Data Kosong
									</td>
								</tr>
					`);
				}
			}
		});
	});

	function getSelectedCustomer(customer, tipe_layanan) {

		$(".factory-name").html('');
		$(".factory-address").html('');
		$(".factory-name").html('');

		$("#deliveryorderdraft-delivery_order_draft_ambil_nama").val('');
		$("#deliveryorderdraft-delivery_order_draft_ambil_alamat").val('');
		$("#deliveryorderdraft-delivery_order_draft_ambil_provinsi").val('');
		$("#deliveryorderdraft-delivery_order_draft_ambil_kota").val('');
		$("#deliveryorderdraft-delivery_order_draft_ambil_kecamatan").val('');
		$("#deliveryorderdraft-delivery_order_draft_ambil_kelurahan").val('');
		$("#deliveryorderdraft-delivery_order_draft_ambil_kodepos").val('');
		$("#deliveryorderdraft-delivery_order_draft_ambil_telepon").val('');
		$("#deliveryorderdraft-delivery_order_draft_ambil_area").val('');

		$(".customer-name").html('');
		$(".customer-address").html('');
		$(".customer-name").html('');

		$("#deliveryorderdraft-delivery_order_draft_kirim_nama").val('');
		$("#deliveryorderdraft-delivery_order_draft_kirim_alamat").val('');
		$("#deliveryorderdraft-delivery_order_draft_kirim_provinsi").val('');
		$("#deliveryorderdraft-delivery_order_draft_kirim_kota").val('');
		$("#deliveryorderdraft-delivery_order_draft_kirim_kecamatan").val('');
		$("#deliveryorderdraft-delivery_order_draft_kirim_kelurahan").val('');
		$("#deliveryorderdraft-delivery_order_draft_kirim_kodepos").val('');
		$("#deliveryorderdraft-delivery_order_draft_kirim_telepon").val('');
		$("#deliveryorderdraft-delivery_order_draft_kirim_area").val('');

		$("#modal-factory").modal('hide');
		$("#modal-customer").modal('hide');

		$("#cek_customer").val(0);


		if (tipe_layanan == "Pickup Only") {
			$.ajax({
				type: 'POST',
				url: "<?= base_url('WMS/Distribusi/DeliveryOrderDraft/GetSelectedPrinciple') ?>",
				data: {
					customer: customer
				},
				dataType: "JSON",
				success: function(response) {

					$('#panel-factory').fadeOut("slow", function() {
						$(this).hide();
					}).fadeIn("slow", function() {
						$.each(response, function(i, v) {
							$(this).show();
							$(".factory-name").append(v.principle_nama);
							$(".factory-address").append(v.principle_alamat);
							$(".factory-area").append(v.area_nama);

							$("#deliveryorderdraft-pabrik_id").val(v.principle_id);
							$("#deliveryorderdraft-delivery_order_draft_ambil_nama").val(v.principle_nama);
							$("#deliveryorderdraft-delivery_order_draft_ambil_alamat").val(v.principle_alamat);
							$("#deliveryorderdraft-delivery_order_draft_ambil_provinsi").val(v.principle_propinsi);
							$("#deliveryorderdraft-delivery_order_draft_ambil_kota").val(v.principle_kota);
							$("#deliveryorderdraft-delivery_order_draft_ambil_kecamatan").val(v.principle_kecamatan);
							$("#deliveryorderdraft-delivery_order_draft_ambil_kelurahan").val(v.principle_kelurahan);
							$("#deliveryorderdraft-delivery_order_draft_ambil_kodepos").val(v.principle_kodepos);
							$("#deliveryorderdraft-delivery_order_draft_ambil_telepon").val(v.principle_telepon);
							$("#deliveryorderdraft-delivery_order_draft_ambil_area").val(v.area_nama);

						});
					});

					arr_sku = [];
					$("#table-sku-delivery-only > tbody").empty();
					initDataSKU();
					$("#cek_customer").val(1);
				}
			});
		} else {
			$.ajax({
				type: 'POST',
				url: "<?= base_url('WMS/Distribusi/DeliveryOrderDraft/GetSelectedCustomer') ?>",
				data: {
					customer: customer
				},
				dataType: "JSON",
				success: function(response) {
					$.each(response, function(i, v) {
						$(".customer-name").append(v.client_pt_nama);
						$(".customer-address").append(v.client_pt_alamat);
						$(".customer-area").append(v.area_nama);

						$("#deliveryorderdraft-client_pt_id").val(v.client_pt_id);
						$("#deliveryorderdraft-delivery_order_draft_kirim_nama").val(v.client_pt_nama);
						$("#deliveryorderdraft-delivery_order_draft_kirim_nama").val(v.client_pt_nama);
						$("#deliveryorderdraft-delivery_order_draft_kirim_alamat").val(v.client_pt_alamat);
						$("#deliveryorderdraft-delivery_order_draft_kirim_provinsi").val(v.client_pt_propinsi);
						$("#deliveryorderdraft-delivery_order_draft_kirim_kota").val(v.client_pt_kota);
						$("#deliveryorderdraft-delivery_order_draft_kirim_kecamatan").val(v.client_pt_kecamatan);
						$("#deliveryorderdraft-delivery_order_draft_kirim_kelurahan").val(v.client_pt_kelurahan);
						$("#deliveryorderdraft-delivery_order_draft_kirim_kodepos").val(v.client_pt_kodepos);
						$("#deliveryorderdraft-delivery_order_draft_kirim_telepon").val(v.client_pt_telepon);
						$("#deliveryorderdraft-delivery_order_draft_kirim_area").val(v.area_nama);

					});

					arr_sku = [];
					$("#table-sku-delivery-only > tbody").empty();
					initDataSKU();
					$("#cek_customer").val(1);
				}
			});

		}
	}

	$(document).on("click", ".btn-choose-sku-multi", function() {
		var jumlah = $('input[name="CheckboxSKU"]').length;
		var numberOfChecked = $('input[name="CheckboxSKU"]:checked').length;
		var no = 1;
		jumlah_sku = numberOfChecked;

		if (numberOfChecked > 0) {
			for (var i = 0; i < jumlah; i++) {
				var checked = $('[id="check-sku-' + i + '"]:checked').length;
				var sku_id = "'" + $("#check-sku-" + i).val() + "'";

				if (checked > 0) {
					arr_sku.push(sku_id);
				}
			}

			$("#table-sku-delivery-only > tbody").empty();

			$.ajax({
				type: 'POST',
				url: "<?= base_url('WMS/Distribusi/DeliveryOrderDraft/GetSelectedSKU') ?>",
				data: {
					sku_id: arr_sku
				},
				dataType: "JSON",
				success: function(response) {
					$.each(response, function(i, v) {
						$("#table-sku-delivery-only > tbody").append(`
							<tr id="row-${i}">
								<td style="display: none">
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_id" value="${v.sku_id}" class="sku-id" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-gudang_id" class="gudang-id" value="${v.gudang_id}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-gudang_detail_id" class="gudang-detail-id" value="${v.gudang_detail_id}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_harga_satuan" class="sku-harga-satuan" value="${v.sku_harga_jual}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_disc_percent" class="sku-disc-percent" value="0" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_disc_rp" class="sku-disc-rp" value="0" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_harga_nett" class="sku-harga-nett" value="${v.sku_harga_jual}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_weight" class="sku-weight" value="${v.sku_weight}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_weight_unit" class="sku-weight-unit" value="${v.sku_weight_unit}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_length" class="sku-length" value="${v.sku_length}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_length_unit" class="sku-length-unit" value="${v.sku_length_unit}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_width" class="sku-width" value="${v.sku_width}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_width_unit" class="sku-width-unit" value="${v.sku_width_unit}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_height" class="sku-height" value="${v.sku_height}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_height_unit" class="sku-height-unit" value="${v.sku_height_unit}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_volume" class="sku-volume" value="${v.sku_volume}" />
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_volume_unit" class="sku-volume-unit" value="${v.sku_volume_unit}" />
								</td>
								<td class="text-center">
									<span class="sku-kode-label">${v.sku_kode}</span>
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_kode" class="form-control sku-kode" value="${v.sku_kode}" />
								</td>
								<td class="text-center"></td>
								<td class="text-center">
									<span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_nama_produk" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
								</td>
								<td class="text-center">
									<span class="sku-kemasan-label">${v.sku_kemasan}</span>
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_kemasan" class="form-control sku-kemasan" value="${v.sku_kemasan}" />
								</td>
								<td class="text-center">
									<span class="sku-satuan-label">${v.sku_satuan}</span>
									<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-sku_satuan" class="form-control sku-satuan" value="${v.sku_satuan}" />
								</td>
								<td class="text-center">
									<select id="item-${i}-DeliveryOrderDetailDraft-sku_request_expdate" class="form-control sku-request-expdate">
										<option value="0">Tidak</option>
										<option value="1">Ya</option>
									</select>
								</td>
								<td class="text-center"><input type="text" id="item-${i}-DeliveryOrderDetailDraft-sku_keterangan" class="form-control sku-keterangan" value="" /></td>
								<td class="text-center"><input type="number" id="item-${i}-DeliveryOrderDetailDraft-sku_qty" class="form-control sku-qty" value="0" /></td>
								<td class="text-center">
									<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,${i})"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						`);
					});
				}
			});

		} else {
			Swal.fire({
				icon: 'error',
				title: 'Error',
				text: 'Pilih SKU!'
			});

			arr_sku = [];
		}
	});

	function initDataCustomer() {
		var perusahaan = $("#deliveryorderdraft-client_wms_id").val();
		var tipe_layanan = document.querySelector('input[id="deliveryorderdraft-delivery_order_draft_tipe_layanan"]:checked').value;
		var tipe_pembayaran = document.querySelector('input[id="deliveryorderdraft-delivery_order_draft_tipe_pembayaran"]:checked').value;

		$("#table-sku-delivery-only > tbody").empty();

		if (tipe_layanan == "Pickup Only") {
			$("#panel-customer").hide();
			$("#panel-factory").show();

			var nama = $("#filter-principle-name").val();
			var alamat = $("#filter-principle-address").val();
			var telp = $("#filter-principle-phone").val();
			var area = $("#filter-area-principle").val();

			$.ajax({
				type: 'POST',
				url: "<?= base_url('WMS/Distribusi/DeliveryOrderDraft/GetFactoryByTypePelayanan') ?>",
				data: {
					perusahaan: perusahaan,
					tipe_pembayaran: tipe_pembayaran,
					tipe_layanan: tipe_layanan,
					nama: nama,
					alamat: alamat,
					telp: telp,
					area: area
				},
				dataType: "JSON",
				success: function(response) {
					$("#table-factory > tbody").empty();
					if (response != 0) {
						$.each(response, function(i, v) {
							$("#table-factory > tbody").append(`
								<tr id="row-${i}">
									<td style="display: none">
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-principle_id" value="${v.principle_id}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-principle_propinsi" value="${v.principle_propinsi}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-principle_kota" value="${v.principle_kota}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-principle_kecamatan" value="${v.principle_kecamatan}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-principle_kelurahan" value="${v.principle_kelurahan}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-principle_kodepos" value="${v.principle_kodepos}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-area_id" value="${v.area_id}" />
									</td>
									<td class="text-center">
										<span class="client-pt-nama-label">${v.principle_nama}</span>
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-principle_nama" class="form-control client-pt-nama" value="${v.principle_nama}" />
									</td>
									<td class="text-center">
										<span class="client-pt-alamat-label">${v.principle_alamat}</span>
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-principle_alamat" class="form-control client-pt-alamat" value="${v.principle_alamat}" />
									</td>
									<td class="text-center">
										<span class="client-pt-telepon-label">${v.principle_telepon}</span>
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-principle_telepon" class="form-control client-pt-telepon" value="${v.principle_telepon}" />
									</td>
									<td class="text-center">
										<span class="area-nama-label">${v.area_nama}</span>
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-area_nama" class="form-control area-nama" value="${v.area_nama}" />
									</td>
									<td class="text-center">
										<button class="btn btn-primary btn-small btn-select-customer" onclick="getSelectedCustomer('${v.principle_id}','${tipe_layanan}')"><i class="fa fa-angle-down"></i></button>
									</td>
								</tr>
							`);
						});
					} else {
						$("#table-factory > tbody").append(`
								<tr>
									<td colspan="5" class="text-danger text-center">
										Data Kosong
									</td>
								</tr>
						`);
					}
				}
			});

		} else {
			$("#panel-customer").show();
			$("#panel-factory").hide();

			var nama = $("#filter-client-name").val();
			var alamat = $("#filter-client-address").val();
			var telp = $("#filter-client-phone").val();
			var area = $("#filter-area").val();

			$.ajax({
				type: 'POST',
				url: "<?= base_url('WMS/Distribusi/DeliveryOrderDraft/GetCustomerByTypePelayanan') ?>",
				data: {
					perusahaan: perusahaan,
					tipe_pembayaran: tipe_pembayaran,
					tipe_layanan: tipe_layanan,
					nama: nama,
					alamat: alamat,
					telp: telp,
					area: area
				},
				dataType: "JSON",
				success: function(response) {

					$("#table-customer > tbody").empty();

					if (response != 0) {
						$.each(response, function(i, v) {

							$("#table-customer > tbody").append(`
								<tr id="row-${i}">
									<td style="display: none">
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-client_pt_id" value="${v.client_pt_id}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-client_pt_propinsi" value="${v.client_pt_propinsi}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-client_pt_kota" value="${v.client_pt_kota}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-client_pt_kecamatan" value="${v.client_pt_kecamatan}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-client_pt_kelurahan" value="${v.client_pt_kelurahan}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-client_pt_kodepos" value="${v.client_pt_kodepos}" />
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-area_id" value="${v.area_id}" />
									</td>
									<td class="text-center">
										<span class="client-pt-nama-label">${v.client_pt_nama}</span>
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-client_pt_nama" class="form-control client-pt-nama" value="${v.client_pt_nama}" />
									</td>
									<td class="text-center">
										<span class="client-pt-alamat-label">${v.client_pt_alamat}</span>
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-client_pt_alamat" class="form-control client-pt-alamat" value="${v.client_pt_alamat}" />
									</td>
									<td class="text-center">
										<span class="client-pt-telepon-label">${v.client_pt_telepon}</span>
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-client_pt_telepon" class="form-control client-pt-telepon" value="${v.client_pt_telepon}" />
									</td>
									<td class="text-center">
										<span class="area-nama-label">${v.area_nama}</span>
										<input type="hidden" id="item-${i}-DeliveryOrderDetailDraft-area_nama" class="form-control area-nama" value="${v.area_nama}" />
									</td>
									<td class="text-center">
										<button class="btn btn-primary btn-small btn-select-customer" onclick="getSelectedCustomer('${v.client_pt_id}','${tipe_layanan}')"><i class="fa fa-angle-down"></i></button>
									</td>
								</tr>
							`);
						});
					} else {
						$("#table-customer > tbody").append(`
								<tr>
									<td colspan="5" class="text-danger text-center">
										Data Kosong
									</td>
								</tr>
						`);
					}
				}
			});
		}
	}

	function initDataSKU() {
		var client_pt = "";
		var tipe_layanan = document.querySelector('input[id="deliveryorderdraft-delivery_order_draft_tipe_layanan"]:checked').value;
		var tipe_pembayaran = document.querySelector('input[id="deliveryorderdraft-delivery_order_draft_tipe_pembayaran"]:checked').value;
		var sku_induk = $("#filter-sku-induk").val();
		var sku_nama_produk = $("#filter-sku-nama-produk").val();
		var sku_kemasan = $("#filter-sku-kemasan").val();
		var sku_satuan = $("#filter-sku-satuan").val();
		var principle = $("#filter-principle").val();
		var brand = $("#filter-brand").val();

		if (tipe_layanan == "Pickup Only") {
			client_pt = $("#deliveryorderdraft-pabrik_id").val();

			$("#loadingsku").show();

			$.ajax({
				type: 'POST',
				url: "<?= base_url('WMS/Distribusi/DeliveryOrderDraft/search_filter_chosen_sku_by_pabrik') ?>",
				data: {
					client_pt: client_pt,
					tipe_pembayaran: tipe_pembayaran,
					brand: brand,
					principle: principle,
					sku_induk: sku_induk,
					sku_nama_produk: sku_nama_produk,
					sku_kemasan: sku_kemasan,
					sku_satuan: sku_satuan
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
									<input type="checkbox" name="CheckboxSKU" id="check-sku-${i}" value="${v.sku_id}">
								</td>
								<td width="15%" class="text-center">${v.sku_induk}</td>
								<td width="25%" class="text-center">${v.sku_nama_produk}</td>
								<td width="8%" class="text-center">${v.sku_kemasan}</td>
								<td width="8%" class="text-center">${v.sku_satuan}</td>
								<td width="10%" class="text-center">${v.principle}</td>
								<td width="10%" class="text-center">${v.brand}</td>
							</tr>
						`);
						});

						$('#table-sku').DataTable({
							columnDefs: [{
								sortable: false,
								targets: [0, 1, 2, 3, 4, 5, 6]
							}],
							lengthMenu: [
								[-1],
								['All']
							],
						});
					} else {
						$("#table-sku > tbody").html(`<tr><td colspan="7" class="text-center text-danger">Data Kosong</td></tr>`);
					}
				}
			});
		} else {
			client_pt = $("#deliveryorderdraft-client_pt_id").val();

			$("#loadingsku").show();

			$.ajax({
				type: 'POST',
				url: "<?= base_url('WMS/Distribusi/DeliveryOrderDraft/search_filter_chosen_sku') ?>",
				data: {
					client_pt: client_pt,
					tipe_pembayaran: tipe_pembayaran,
					brand: brand,
					principle: principle,
					sku_induk: sku_induk,
					sku_nama_produk: sku_nama_produk,
					sku_kemasan: sku_kemasan,
					sku_satuan: sku_satuan
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
									<input type="checkbox" name="CheckboxSKU" id="check-sku-${i}" value="${v.sku_id}">
								</td>
								<td width="15%" class="text-center">${v.sku_induk}</td>
								<td width="25%" class="text-center">${v.sku_nama_produk}</td>
								<td width="8%" class="text-center">${v.sku_kemasan}</td>
								<td width="8%" class="text-center">${v.sku_satuan}</td>
								<td width="10%" class="text-center">${v.principle}</td>
								<td width="10%" class="text-center">${v.brand}</td>
							</tr>
						`);
						});

						$('#table-sku').DataTable({
							columnDefs: [{
								sortable: false,
								targets: [0, 1, 2, 3, 4, 5, 6]
							}],
							lengthMenu: [
								[-1],
								['All']
							],
						});
					} else {
						$("#table-sku > tbody").html(`<tr><td colspan="7" class="text-center text-danger">Data Kosong</td></tr>`);
					}
				}
			});
		}


	}

	$("#btnsavedodraft").on("click", function() {
		var cek_customer = $("#cek_customer").val();
		var tipe_do = $("#deliveryorderdraft-tipe_delivery_order_id").val();

		console.log(arr_sku);

		if (tipe_do != "") {

			if (cek_customer > 0) {

				if (arr_sku.length > 0) {
					$("#table-sku-delivery-only > tbody tr").each(function() {
						var is_Qty = $(this).find("td:eq(8) input[type='number']");
						console.log(is_Qty);
						if (is_Qty.val() == 0) {
							cek_qty++;
						}
					});

					if (cek_qty == 0) {
						arr_header = [];
						arr_detail = [];

						// var sales_order_id = "";
						// var delivery_order_draft_kode = "";
						// var delivery_order_draft_yourref = "";
						// var client_wms_id = $("#deliveryorderdraft-client_wms_id").val();
						// var delivery_order_draft_tgl_buat_do = $("#deliveryorderdraft-delivery_order_draft_tgl_buat_do").val();
						// var delivery_order_draft_tgl_expired_do = $("#deliveryorderdraft-delivery_order_draft_tgl_expired_do").val();
						// var delivery_order_draft_tgl_surat_jalan = $("#deliveryorderdraft-delivery_order_draft_tgl_surat_jalan").val();
						// var delivery_order_draft_tgl_rencana_kirim = $("#deliveryorderdraft-delivery_order_draft_tgl_rencana_kirim").val();
						// var delivery_order_draft_tgl_aktual_kirim = "";
						// var delivery_order_draft_keterangan = $("#deliveryorderdraft-delivery_order_draft_keterangan").val();
						// var delivery_order_draft_status = "Draft";
						// var delivery_order_draft_is_prioritas = 0;
						// var delivery_order_draft_is_need_packing = 0;
						// var delivery_order_draft_tipe_layanan = $("#deliveryorderdraft-delivery_order_draft_tipe_layanan").val();
						// var delivery_order_draft_tipe_pembayaran = $("#deliveryorderdraft-delivery_order_draft_tipe_pembayaran").val();
						// var delivery_order_draft_sesi_pengiriman = 0;
						// var delivery_order_draft_request_tgl_kirim = "";
						// var delivery_order_draft_request_jam_kirim = "";
						// var tipe_pengiriman_id = "";
						// var nama_tipe = "";
						// var confirm_rate = "";
						// var delivery_order_draft_reff_id = "";
						// var delivery_order_draft_reff_no = "";
						// var delivery_order_draft_total = "";
						// var unit_mandiri_id = "<?= $this->session->userdata('unit_mandiri_id') ?>";
						// var depo_id = "<?= $this->session->userdata('depo_id') ?>";
						// var client_pt_id = $("#deliveryorderdraft-client_pt_id").val();
						// var delivery_order_draft_kirim_nama = $("#deliveryorderdraft-delivery_order_draft_kirim_nama").val();
						// var delivery_order_draft_kirim_alamat = $("#deliveryorderdraft-delivery_order_draft_kirim_alamat").val();
						// var delivery_order_draft_kirim_telp = $("#deliveryorderdraft-delivery_order_draft_kirim_telepon").val();
						// var delivery_order_draft_kirim_provinsi = $("#deliveryorderdraft-delivery_order_draft_kirim_provinsi").val();
						// var delivery_order_draft_kirim_kota = $("#deliveryorderdraft-delivery_order_draft_kirim_kota").val();
						// var delivery_order_draft_kirim_kecamatan = $("#deliveryorderdraft-delivery_order_draft_kirim_kecamatan").val();
						// var delivery_order_draft_kirim_kelurahan = $("#deliveryorderdraft-delivery_order_draft_kirim_kelurahan").val();
						// var delivery_order_draft_kirim_kodepos = $("#deliveryorderdraft-delivery_order_draft_kirim_kodepos").val();
						// var delivery_order_draft_kirim_area = $("#deliveryorderdraft-delivery_order_draft_kirim_area").val();
						// var delivery_order_draft_kirim_invoice_pdf = "";
						// var delivery_order_draft_kirim_invoice_dir = "";
						// var pabrik_id = $("#deliveryorderdraft-pabrik_id").val();
						// var delivery_order_draft_ambil_nama = $("#deliveryorderdraft-delivery_order_draft_ambil_nama").val();
						// var delivery_order_draft_ambil_alamat = $("#deliveryorderdraft-delivery_order_draft_ambil_alamat").val();
						// var delivery_order_draft_ambil_telp = $("#deliveryorderdraft-delivery_order_draft_ambil_telepon").val();
						// var delivery_order_draft_ambil_provinsi = $("#deliveryorderdraft-delivery_order_draft_ambil_provinsi").val();
						// var delivery_order_draft_ambil_kota = $("#deliveryorderdraft-delivery_order_draft_ambil_kota").val();
						// var delivery_order_draft_ambil_kecamatan = $("#deliveryorderdraft-delivery_order_draft_ambil_kecamatan").val();
						// var delivery_order_draft_ambil_kelurahan = $("#deliveryorderdraft-delivery_order_draft_ambil_kelurahan").val();
						// var delivery_order_draft_ambil_kodepos = $("#deliveryorderdraft-delivery_order_draft_ambil_kodepos").val();
						// var delivery_order_draft_ambil_area = $("#deliveryorderdraft-delivery_order_draft_ambil_area").val();
						// var delivery_order_draft_update_who = "<?= $this->session->userdata('pengguna_id') ?>";;
						// var delivery_order_draft_update_tgl = "";
						// var delivery_order_draft_approve_who = "";
						// var delivery_order_draft_approve_tgl = "";
						// var delivery_order_draft_reject_who = "";
						// var delivery_order_draft_reject_tgl = "";
						// var delivery_order_draft_reject_reason = "";
						// var tipe_delivery_order_id = $("#deliveryorderdraft-tipe_delivery_order_id").val();

						// arr_header.push({
						// 	'sales_order_id': "",
						// 	'delivery_order_draft_kode': "",
						// 	'delivery_order_draft_yourref': "",
						// 	'client_wms_id': $("#deliveryorderdraft-client_wms_id").val(),
						// 	'delivery_order_draft_tgl_buat_do': $("#deliveryorderdraft-delivery_order_draft_tgl_buat_do").val(),
						// 	'delivery_order_draft_tgl_expired_do': $("#deliveryorderdraft-delivery_order_draft_tgl_expired_do").val(),
						// 	'delivery_order_draft_tgl_surat_jalan': $("#deliveryorderdraft-delivery_order_draft_tgl_surat_jalan").val(),
						// 	'delivery_order_draft_tgl_rencana_kirim': $("#deliveryorderdraft-delivery_order_draft_tgl_rencana_kirim").val(),
						// 	'delivery_order_draft_tgl_aktual_kirim': "",
						// 	'delivery_order_draft_keterangan': $("#deliveryorderdraft-delivery_order_draft_keterangan").val(),
						// 	'delivery_order_draft_status': "Draft",
						// 	'delivery_order_draft_is_prioritas': 0,
						// 	'delivery_order_draft_is_need_packing': 0,
						// 	'delivery_order_draft_tipe_layanan': $("#deliveryorderdraft-delivery_order_draft_tipe_layanan").val(),
						// 	'delivery_order_draft_tipe_pembayaran': $("#deliveryorderdraft-delivery_order_draft_tipe_pembayaran").val(),
						// 	'delivery_order_draft_sesi_pengiriman': 0,
						// 	'delivery_order_draft_request_tgl_kirim': "",
						// 	'delivery_order_draft_request_jam_kirim': "",
						// 	'tipe_pengiriman_id': "",
						// 	'nama_tipe': "",
						// 	'confirm_rate': "",
						// 	'delivery_order_draft_reff_id': "",
						// 	'delivery_order_draft_reff_no': "",
						// 	'delivery_order_draft_total': "",
						// 	'unit_mandiri_id': "<?= $this->session->userdata('unit_mandiri_id') ?>",
						// 	'depo_id': "<?= $this->session->userdata('depo_id') ?>",
						// 	'client_pt_id': $("#deliveryorderdraft-client_pt_id").val(),
						// 	'delivery_order_draft_kirim_nama': $("#deliveryorderdraft-delivery_order_draft_kirim_nama").val(),
						// 	'delivery_order_draft_kirim_alamat': $("#deliveryorderdraft-delivery_order_draft_kirim_alamat").val(),
						// 	'delivery_order_draft_kirim_telp': $("#deliveryorderdraft-delivery_order_draft_kirim_telepon").val(),
						// 	'delivery_order_draft_kirim_provinsi': $("#deliveryorderdraft-delivery_order_draft_kirim_provinsi").val(),
						// 	'delivery_order_draft_kirim_kota': $("#deliveryorderdraft-delivery_order_draft_kirim_kota").val(),
						// 	'delivery_order_draft_kirim_kecamatan': $("#deliveryorderdraft-delivery_order_draft_kirim_kecamatan").val(),
						// 	'delivery_order_draft_kirim_kelurahan': $("#deliveryorderdraft-delivery_order_draft_kirim_kelurahan").val(),
						// 	'delivery_order_draft_kirim_kodepos': $("#deliveryorderdraft-delivery_order_draft_kirim_kodepos").val(),
						// 	'delivery_order_draft_kirim_area': $("#deliveryorderdraft-delivery_order_draft_kirim_area").val(),
						// 	'delivery_order_draft_kirim_invoice_pdf': "",
						// 	'delivery_order_draft_kirim_invoice_dir': "",
						// 	'pabrik_id': $("#deliveryorderdraft-pabrik_id").val(),
						// 	'delivery_order_draft_ambil_nama': $("#deliveryorderdraft-delivery_order_draft_ambil_nama").val(),
						// 	'delivery_order_draft_ambil_alamat': $("#deliveryorderdraft-delivery_order_draft_ambil_alamat").val(),
						// 	'delivery_order_draft_ambil_telp': $("#deliveryorderdraft-delivery_order_draft_ambil_telepon").val(),
						// 	'delivery_order_draft_ambil_provinsi': $("#deliveryorderdraft-delivery_order_draft_ambil_provinsi").val(),
						// 	'delivery_order_draft_ambil_kota': $("#deliveryorderdraft-delivery_order_draft_ambil_kota").val(),
						// 	'delivery_order_draft_ambil_kecamatan': $("#deliveryorderdraft-delivery_order_draft_ambil_kecamatan").val(),
						// 	'delivery_order_draft_ambil_kelurahan': $("#deliveryorderdraft-delivery_order_draft_ambil_kelurahan").val(),
						// 	'delivery_order_draft_ambil_kodepos': $("#deliveryorderdraft-delivery_order_draft_ambil_kodepos").val(),
						// 	'delivery_order_draft_ambil_area': $("#deliveryorderdraft-delivery_order_draft_ambil_area").val(),
						// 	'delivery_order_draft_update_who': "",
						// 	'delivery_order_draft_update_tgl': "",
						// 	'delivery_order_draft_approve_who': "",
						// 	'delivery_order_draft_approve_tgl': "",
						// 	'delivery_order_draft_reject_who': "",
						// 	'delivery_order_draft_reject_tgl': "",
						// 	'delivery_order_draft_reject_reason': "",
						// 	'tipe_delivery_order_id': $("#deliveryorderdraft-tipe_delivery_order_id").val()
						// });

						for (var index = 0; index < arr_sku.length; index++) {
							if (arr_sku[index] != "") {
								arr_detail.push({
									'sku_id': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_id").val(),
									'sku_kode': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_kode").val(),
									'sku_nama_produk': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_nama_produk").val(),
									'sku_harga_satuan': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_harga_satuan").val(),
									'sku_disc_percent': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_disc_percent").val(),
									'sku_disc_rp': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_disc_rp").val(),
									'sku_harga_nett': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_harga_nett").val(),
									'sku_weight': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_weight").val(),
									'sku_weight_unit': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_weight_unit").val(),
									'sku_length': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_length").val(),
									'sku_length_unit': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_length_unit").val(),
									'sku_width': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_width").val(),
									'sku_width_unit': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_width_unit").val(),
									'sku_height': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_height").val(),
									'sku_height_unit': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_height_unit").val(),
									'sku_volume': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_volume").val(),
									'sku_volume_unit': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_volume_unit").val(),
									'sku_qty': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_qty").val(),
									'sku_keterangan': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_keterangan").val(),
									'sku_request_expdate': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_request_expdate").val(),
									'sku_satuan': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_satuan").val(),
									'sku_kemasan': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_kemasan").val()
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
								//ajax save data
								$.ajax({
									async: false,
									url: "<?= base_url('WMS/Distribusi/DeliveryOrderDraft/insert_delivery_order_draft'); ?>",
									type: "POST",
									data: {
										sales_order_id: "",
										delivery_order_draft_kode: "",
										delivery_order_draft_yourref: "",
										client_wms_id: $("#deliveryorderdraft-client_wms_id").val(),
										delivery_order_draft_tgl_buat_do: $("#deliveryorderdraft-delivery_order_draft_tgl_buat_do").val(),
										delivery_order_draft_tgl_expired_do: $("#deliveryorderdraft-delivery_order_draft_tgl_expired_do").val(),
										delivery_order_draft_tgl_surat_jalan: $("#deliveryorderdraft-delivery_order_draft_tgl_surat_jalan").val(),
										delivery_order_draft_tgl_rencana_kirim: $("#deliveryorderdraft-delivery_order_draft_tgl_rencana_kirim").val(),
										delivery_order_draft_tgl_aktual_kirim: "",
										delivery_order_draft_keterangan: $("#deliveryorderdraft-delivery_order_draft_keterangan").val(),
										delivery_order_draft_status: "Draft",
										delivery_order_draft_is_prioritas: 0,
										delivery_order_draft_is_need_packing: 0,
										delivery_order_draft_tipe_layanan: $("#deliveryorderdraft-delivery_order_draft_tipe_layanan").val(),
										delivery_order_draft_tipe_pembayaran: $("#deliveryorderdraft-delivery_order_draft_tipe_pembayaran").val(),
										delivery_order_draft_sesi_pengiriman: 0,
										delivery_order_draft_request_tgl_kirim: "",
										delivery_order_draft_request_jam_kirim: "",
										tipe_pengiriman_id: "",
										nama_tipe: "",
										confirm_rate: "",
										delivery_order_draft_reff_id: "",
										delivery_order_draft_reff_no: "",
										delivery_order_draft_total: "",
										unit_mandiri_id: "<?= $this->session->userdata('unit_mandiri_id') ?>",
										depo_id: "<?= $this->session->userdata('depo_id') ?>",
										client_pt_id: $("#deliveryorderdraft-client_pt_id").val(),
										delivery_order_draft_kirim_nama: $("#deliveryorderdraft-delivery_order_draft_kirim_nama").val(),
										delivery_order_draft_kirim_alamat: $("#deliveryorderdraft-delivery_order_draft_kirim_alamat").val(),
										delivery_order_draft_kirim_telp: $("#deliveryorderdraft-delivery_order_draft_kirim_telepon").val(),
										delivery_order_draft_kirim_provinsi: $("#deliveryorderdraft-delivery_order_draft_kirim_provinsi").val(),
										delivery_order_draft_kirim_kota: $("#deliveryorderdraft-delivery_order_draft_kirim_kota").val(),
										delivery_order_draft_kirim_kecamatan: $("#deliveryorderdraft-delivery_order_draft_kirim_kecamatan").val(),
										delivery_order_draft_kirim_kelurahan: $("#deliveryorderdraft-delivery_order_draft_kirim_kelurahan").val(),
										delivery_order_draft_kirim_kodepos: $("#deliveryorderdraft-delivery_order_draft_kirim_kodepos").val(),
										delivery_order_draft_kirim_area: $("#deliveryorderdraft-delivery_order_draft_kirim_area").val(),
										delivery_order_draft_kirim_invoice_pdf: "",
										delivery_order_draft_kirim_invoice_dir: "",
										pabrik_id: $("#deliveryorderdraft-pabrik_id").val(),
										delivery_order_draft_ambil_nama: $("#deliveryorderdraft-delivery_order_draft_ambil_nama").val(),
										delivery_order_draft_ambil_alamat: $("#deliveryorderdraft-delivery_order_draft_ambil_alamat").val(),
										delivery_order_draft_ambil_telp: $("#deliveryorderdraft-delivery_order_draft_ambil_telepon").val(),
										delivery_order_draft_ambil_provinsi: $("#deliveryorderdraft-delivery_order_draft_ambil_provinsi").val(),
										delivery_order_draft_ambil_kota: $("#deliveryorderdraft-delivery_order_draft_ambil_kota").val(),
										delivery_order_draft_ambil_kecamatan: $("#deliveryorderdraft-delivery_order_draft_ambil_kecamatan").val(),
										delivery_order_draft_ambil_kelurahan: $("#deliveryorderdraft-delivery_order_draft_ambil_kelurahan").val(),
										delivery_order_draft_ambil_kodepos: $("#deliveryorderdraft-delivery_order_draft_ambil_kodepos").val(),
										delivery_order_draft_ambil_area: $("#deliveryorderdraft-delivery_order_draft_ambil_area").val(),
										delivery_order_draft_update_who: "",
										delivery_order_draft_update_tgl: "",
										delivery_order_draft_approve_who: "",
										delivery_order_draft_approve_tgl: "",
										delivery_order_draft_reject_who: "",
										delivery_order_draft_reject_tgl: "",
										delivery_order_draft_reject_reason: "",
										tipe_delivery_order_id: $("#deliveryorderdraft-tipe_delivery_order_id").val(),
										detail: arr_detail
									},
									dataType: "JSON",
									success: function(data) {
										// if (data == 1) {
										// 	message_topright("success", "Data berhasil disimpan");
										// 	setTimeout(() => {
										// 		location.href = "<?= base_url(); ?>WMS/Distribusi/DeliveryOrderDraft/";
										// 	}, 500);
										// } else {
										// 	message_topright("error", "Data gagal disimpan");
										// }
									}
								});
							}
						});

						// console.log(arr_header);
						// console.log(arr_detail);

					} else {
						cek_qty = 0;
						message("Error!", "Qty tidak boleh 0!", "error");
					}

				} else {
					message("Pilih SKU!", "SKU belum dipilih", "error");
				}
			} else {
				message("Pilih Customer!", "Customer belum dipilih", "error");

			}

		} else {
			message("Pilih Tipe DO!", "Tipe delivery order draft belum dipilih", "error");
		}
	});

	$("#btnupdatedodraft").on("click", function() {
		var cek_customer = $("#cek_customer").val();
		var tipe_do = $("#deliveryorderdraft-edit-tipe_delivery_order_id").val();
		var dod_id = $("#deliveryorderdraft-edit-delivery_order_draft_id").val();

		console.log(arr_sku);

		if (tipe_do != "") {

			if (cek_customer > 0) {

				if (arr_sku.length > 0) {
					$("#table-sku-delivery-only > tbody tr").each(function() {
						var is_Qty = $(this).find("td:eq(8) input[type='number']");
						console.log(is_Qty);
						if (is_Qty.val() == 0) {
							cek_qty++;
						}
					});

					if (cek_qty == 0) {
						arr_header = [];
						arr_detail = [];

						for (var index = 0; index < arr_sku.length; index++) {
							if (arr_sku[index] != "") {
								arr_detail.push({
									'sku_id': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_id").val(),
									'sku_kode': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_kode").val(),
									'sku_nama_produk': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_nama_produk").val(),
									'sku_harga_satuan': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_harga_satuan").val(),
									'sku_disc_percent': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_disc_percent").val(),
									'sku_disc_rp': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_disc_rp").val(),
									'sku_harga_nett': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_harga_nett").val(),
									'sku_weight': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_weight").val(),
									'sku_weight_unit': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_weight_unit").val(),
									'sku_length': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_length").val(),
									'sku_length_unit': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_length_unit").val(),
									'sku_width': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_width").val(),
									'sku_width_unit': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_width_unit").val(),
									'sku_height': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_height").val(),
									'sku_height_unit': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_height_unit").val(),
									'sku_volume': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_volume").val(),
									'sku_volume_unit': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_volume_unit").val(),
									'sku_qty': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_qty").val(),
									'sku_keterangan': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_keterangan").val(),
									'sku_request_expdate': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_request_expdate").val(),
									'sku_satuan': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_satuan").val(),
									'sku_kemasan': $("#item-" + index + "-DeliveryOrderDetailDraft-sku_kemasan").val()
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
								//ajax save data
								$.ajax({
									async: false,
									url: "<?= base_url('WMS/Distribusi/DeliveryOrderDraft/update_delivery_order_draft'); ?>",
									type: "POST",
									data: {
										delivery_order_draft_id: dod_id,
										sales_order_id: "",
										delivery_order_draft_kode: $("#deliveryorderdraft-edit-delivery_order_draft_kode").val(),
										delivery_order_draft_yourref: "",
										client_wms_id: $("#deliveryorderdraft-edit-client_wms_id").val(),
										delivery_order_draft_tgl_buat_do: $("#deliveryorderdraft-edit-delivery_order_draft_tgl_buat_do").val(),
										delivery_order_draft_tgl_expired_do: $("#deliveryorderdraft-edit-delivery_order_draft_tgl_expired_do").val(),
										delivery_order_draft_tgl_surat_jalan: $("#deliveryorderdraft-edit-delivery_order_draft_tgl_surat_jalan").val(),
										delivery_order_draft_tgl_rencana_kirim: $("#deliveryorderdraft-edit-delivery_order_draft_tgl_rencana_kirim").val(),
										delivery_order_draft_tgl_aktual_kirim: "",
										delivery_order_draft_keterangan: $("#deliveryorderdraft-edit-delivery_order_draft_keterangan").val(),
										delivery_order_draft_status: "Draft",
										delivery_order_draft_is_prioritas: 0,
										delivery_order_draft_is_need_packing: 0,
										delivery_order_draft_tipe_layanan: $("#deliveryorderdraft-edit-delivery_order_draft_tipe_layanan").val(),
										delivery_order_draft_tipe_pembayaran: $("#deliveryorderdraft-edit-delivery_order_draft_tipe_pembayaran").val(),
										delivery_order_draft_sesi_pengiriman: 0,
										delivery_order_draft_request_tgl_kirim: "",
										delivery_order_draft_request_jam_kirim: "",
										tipe_pengiriman_id: "",
										nama_tipe: "",
										confirm_rate: "",
										delivery_order_draft_reff_id: "",
										delivery_order_draft_reff_no: "",
										delivery_order_draft_total: "",
										unit_mandiri_id: "<?= $this->session->userdata('unit_mandiri_id') ?>",
										depo_id: "<?= $this->session->userdata('depo_id') ?>",
										client_pt_id: $("#deliveryorderdraft-edit-client_pt_id").val(),
										delivery_order_draft_kirim_nama: $("#deliveryorderdraft-edit-delivery_order_draft_kirim_nama").val(),
										delivery_order_draft_kirim_alamat: $("#deliveryorderdraft-edit-delivery_order_draft_kirim_alamat").val(),
										delivery_order_draft_kirim_telp: $("#deliveryorderdraft-edit-delivery_order_draft_kirim_telepon").val(),
										delivery_order_draft_kirim_provinsi: $("#deliveryorderdraft-edit-delivery_order_draft_kirim_provinsi").val(),
										delivery_order_draft_kirim_kota: $("#deliveryorderdraft-edit-delivery_order_draft_kirim_kota").val(),
										delivery_order_draft_kirim_kecamatan: $("#deliveryorderdraft-edit-delivery_order_draft_kirim_kecamatan").val(),
										delivery_order_draft_kirim_kelurahan: $("#deliveryorderdraft-edit-delivery_order_draft_kirim_kelurahan").val(),
										delivery_order_draft_kirim_kodepos: $("#deliveryorderdraft-edit-delivery_order_draft_kirim_kodepos").val(),
										delivery_order_draft_kirim_area: $("#deliveryorderdraft-edit-delivery_order_draft_kirim_area").val(),
										delivery_order_draft_kirim_invoice_pdf: "",
										delivery_order_draft_kirim_invoice_dir: "",
										pabrik_id: $("#deliveryorderdraft-edit-pabrik_id").val(),
										delivery_order_draft_ambil_nama: $("#deliveryorderdraft-edit-delivery_order_draft_ambil_nama").val(),
										delivery_order_draft_ambil_alamat: $("#deliveryorderdraft-edit-delivery_order_draft_ambil_alamat").val(),
										delivery_order_draft_ambil_telp: $("#deliveryorderdraft-edit-delivery_order_draft_ambil_telepon").val(),
										delivery_order_draft_ambil_provinsi: $("#deliveryorderdraft-edit-delivery_order_draft_ambil_provinsi").val(),
										delivery_order_draft_ambil_kota: $("#deliveryorderdraft-edit-delivery_order_draft_ambil_kota").val(),
										delivery_order_draft_ambil_kecamatan: $("#deliveryorderdraft-edit-delivery_order_draft_ambil_kecamatan").val(),
										delivery_order_draft_ambil_kelurahan: $("#deliveryorderdraft-edit-delivery_order_draft_ambil_kelurahan").val(),
										delivery_order_draft_ambil_kodepos: $("#deliveryorderdraft-edit-delivery_order_draft_ambil_kodepos").val(),
										delivery_order_draft_ambil_area: $("#deliveryorderdraft-edit-delivery_order_draft_ambil_area").val(),
										delivery_order_draft_update_who: "",
										delivery_order_draft_update_tgl: "",
										delivery_order_draft_approve_who: "",
										delivery_order_draft_approve_tgl: "",
										delivery_order_draft_reject_who: "",
										delivery_order_draft_reject_tgl: "",
										delivery_order_draft_reject_reason: "",
										tipe_delivery_order_id: $("#deliveryorderdraft-edit-tipe_delivery_order_id").val(),
										detail: arr_detail
									},
									dataType: "JSON",
									success: function(data) {
										if (data == 1) {
											message_topright("success", "Data berhasil disimpan");
											setTimeout(() => {
												location.href = "<?= base_url(); ?>WMS/Distribusi/DeliveryOrderDraft/edit/?id=" + delivery_order_draft_id;
											}, 500);
										} else {
											message_topright("error", "Data gagal disimpan");
										}
									}
								});
							}
						});

						// console.log(arr_header);
						// console.log(arr_detail);

					} else {
						cek_qty = 0;
						message("Error!", "Qty tidak boleh 0!", "error");
					}

				} else {
					message("Pilih SKU!", "SKU belum dipilih", "error");
				}
			} else {
				message("Pilih Customer!", "Customer belum dipilih", "error");

			}

		} else {
			message("Pilih Tipe DO!", "Tipe delivery order draft belum dipilih", "error");
		}
	});

	function DeleteSKU(row, index) {
		var row = row.parentNode.parentNode;
		row.parentNode.removeChild(row);

		arr_sku[index] = "";
	}
</script>