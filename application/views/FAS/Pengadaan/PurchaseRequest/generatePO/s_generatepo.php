<script type="text/javascript">
	let arrtempDisabledTbSupplier = [];
	$(document).ready(function() {
		$("#purchaserequest-purchase_request_tgl").attr("readonly", true);
		$("#purchaserequest-purchase_request_tgl_dibutuhkan").attr("readonly", true);
		$("#purchaserequest-purchase_request_pemohon").attr("readonly", true);
		$("#purchaserequest-purchase_request_keterangan").attr("readonly", true);
		$("#purchaserequest-client_wms_id").attr("disabled", true);
		$("#purchaserequest-karyawan_divisi_id").attr("disabled", true);
		$("#purchaserequest-tipe_pengadaan_id").attr("disabled", true);
		$("#purchaserequest-tipe_transaksi_id").attr("disabled", true);
		$("#purchaserequest-kategori_biaya_id").attr("disabled", true);
		$("#purchaserequest-tipe_biaya_id").attr("disabled", true);
		$("#purchaserequest-tipe_kepemilikan_id").attr("disabled", true);
		$("#purchaserequest-pr_is_need_approval").attr("disabled", true);

		// $('#tablelistpo').DataTable({
		//     'ordering': false
		// });
		appendToTableSupplier();
		appendToTablelistpo();

	})
	$('#select-po-supplier').click(function(event) {
		if (this.checked) {
			// Iterate each checkbox
			// $('[name="cbposupplier"]:checkbox').each(function() {
			//     this.checked = true;

			// });
			$('input[type="checkbox"]').filter(function() {
				if (!this.disabled) {
					this.checked = true;
				}
			})
		} else {
			$('[name="cbposupplier"]:checkbox').each(function() {
				this.checked = false;
			});
		}
	});

	$(document).on("click", "#btngeneratepo", function(event) {
		var jumlah = $('input[name="cbposupplier"]').length;
		var numberOfChecked = $('input[name="cbposupplier"]:checked').length;
		var no = 1;
		jumlah_sku = numberOfChecked;

		arr_supplierpo = [];

		if (numberOfChecked > 0) {
			for (var i = 0; i < jumlah; i++) {
				var checked = $('[id="itemposupplier-' + i + '"]:checked').length;
				var supplier_id = $("#itemposupplier-" + i).val();

				if (checked > 0) {

					arr_supplierpo.push(supplier_id);
				}
			}
			Swal.fire({
				title: "Apakah anda yakin?",
				text: "Pastikan data yang sudah anda pilih benar!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya, Simpan",
				cancelButtonText: "Tidak, Tutup"
			}).then((result) => {
				if (result.value == true) {
					$.ajax({
						async: false,
						url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/insert_purchase_order'); ?>",
						type: "POST",
						data: {
							pr_id: $('#pr_id').val(),
							karyawan_divisi_id: $('#purchaserequest-karyawan_divisi_id').val(),
							client_wms_id: $('#purchaserequest-client_wms_id').val(),
							detail: arr_supplierpo,
							purchase_request_keterangan: $('#purchaserequest-purchase_request_keterangan').val()
						},
						dataType: "JSON",
						success: function(data) {
							if (data == 1) {

								message_topright("success", "<span name='CAPTION-ALERT-BERHASIL'>Data berhasil disimpan</span>");
								$('#table-supplier').fadeOut("slow", function() {
									$(this).hide();
								}).fadeIn("slow", function() {
									$(this).show();
									cekdisabledtbsupplier();
									appendToTablelistpo();
								});

							} else {
								alert('Error');
							}
						}
					})
				}
			})
		} else {
			alert('Mohon Pilih Supplier');
		}

	});

	function cekdisabledtbsupplier() {
		arrtempDisabledTbSupplier = []
		$.ajax({
			url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/GetPurchaseRequestDetailSupplierByIdDisabled'); ?>",
			type: "POST",
			data: {
				pr_id: $('#pr_id').val()
			},
			dataType: "JSON",
			success: function(data) {
				$.each(data, function(i, v) {
					$(`.itemposupplier-${v.supplier_id}`).prop('disabled', true)
					arrtempDisabledTbSupplier.push(v.supplier_id);
					// $('[name="cbposupplier"]:checkbox').each(function() {
					//     this.checked = false;
					// });
					$("input[type=checkbox]").each(function() {
						this.checked = false;
					});
				})
			}
		})
	}

	function appendToTableSupplier() {

		let itemcount = $("#item-count-po").val();
		$.ajax({
			async: true,
			url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/GetPurchaseRequestDetailSupplierById'); ?>",
			type: "POST",
			data: {
				pr_id: $('#pr_id').val()
			},
			dataType: "JSON",
			success: function(data) {
				let response = data;
				let dis = "";
				$('#table-supplier tbody').empty();
				$.each(response, function(i, v) {
					dis = "";
					// if (jQuery.inArray(v.supplier_id, arrtempDisabledTbSupplier) == -1) {
					//     dis += "";
					// } else {
					//     dis += "disabled";
					// }
					// var seats = document.getElementsByClassName('seats');
					// for (var i = 0; i < seats.length; i++) {
					//     arrtempDisabledTbSupplier.map(function(v) {
					//         if (seats[i].value === v) {
					//             seats[i].setAttribute("disabled", "true");

					//         }
					//     });
					// }
					$('#table-supplier > tbody').append(`
                        <tr>
                            <td><input autocomplete="off" class="itemposupplier-${v.supplier_id}" type="checkbox" ${dis} name="cbposupplier" id="itemposupplier-${i}" value="${v.supplier_id}"></td>
                            <td><span>${ v.supplier_nama }</span></td>
                        </tr>
				    `);

				})
				cekdisabledtbsupplier();

				// $('#tablelistpo').DataTable({
				//     'ordering': false
				// });
			}
		})
	}


	function appendToTablelistpo() {
		if ($.fn.DataTable.isDataTable('#tablelistpo')) {
			$('#tablelistpo').DataTable().clear();
		}
		$('#tablelistpo > tbody').empty();
		$.ajax({
			url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/GetDataPobyId'); ?>",
			type: "POST",
			data: {
				pr_id: $('#pr_id').val()
			},
			dataType: "JSON",
			success: function(data) {
				let response = data;


				$.each(response, function(i, v) {

					$("#tablelistpo tbody").append(`
                    
					<tr id="row-${i}">
						<td>${i+1}<input type="hidden" id="hcountlistpo" value="${i}"></td>
						<td>
							<span id="item-${i}-purchase_order_kode" >${v.purchase_order_kode}</span> 
						</td>
						<td>
                            <span id="span-item-${i}-tgl-po">${v.tgl_po}</span>
						</td>
						<td><span id="span-item-${i}supplier_nama">${v.supplier_nama}</span></td>
                        <td><span id="span-item-${i}supplier_alamat">${v.supplier_alamat}</span></td>
						<td>${v.supplier_keterangan==null?'-':v.supplier_keterangan}</td>
						<td>
							<button class="btn btn-primary btn-small idx-${i} nm+${v.supplier_nama}" value="${v.purchase_order_id}" id="btnDetailPo"><i class="fa fa-eye"><label id="lbnmsupp" class="nm-${v.supplier_nama}"></label></i></button>
						</td>
				    </tr>
				    `);

				})

				// $('#tablelistpo').DataTable({
				//     'ordering': false
				// });
			}
		})
	}

	$(document).on('click', '#btnDetailPo', function() {

		let nama_supplier = $(this).attr('class').split('+')[1]
		let btnvalue = this.value;
		appendToTableSkuSupplier(btnvalue)
		// alert(sku_barang_id);
		$('#modal-sku-detail-po').modal('show');
		$('#labelspullier').text(nama_supplier);

	})

	function appendToTableSkuSupplier(btnvalue) {
		console.log(btnvalue)
		$('#table-sku-detail-po > tbody').empty();
		$.ajax({
			url: "<?= base_url('FAS/Pengadaan/PurchaseRequest/GetDataPOSupplierByIdPo'); ?>",
			type: "POST",
			data: {
				pr_id: $('#pr_id').val(),
				po_id: btnvalue
			},
			dataType: "JSON",
			success: function(data) {
				let response = data;
				console.log(response);
				$.each(response, function(i, v) {

					$("#table-sku-detail-po tbody").append(`
                    
                            <tr>
								<td width="5%" class="text-center" style="display:none">
									${v.purchase_order_detail_id}
								</td>
								<td width="25%" class="text-center">${v.sku_barang_kode}</td>
								<td class="text-center">${v.sku_barang_nama_produk}</td>
								<td width="35%" class="text-center">${v.sku_barang_deskripsi}</td>
								<td width="10%" class="text-center">${v.sku_barang_kemasan}</td>
								<td width="10%" class="text-center">${v.sku_barang_satuan}</td>
								<td width="10%" class="text-center">${v.qty}</td>
							</tr>
				    `);

				})
			}
		})
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
</script>