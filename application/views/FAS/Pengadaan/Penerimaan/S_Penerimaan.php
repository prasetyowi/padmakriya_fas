<script text="text/javascript">
    let arrSkuBarangPO = [];
    let arr_detail_push = [];
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
            $("#penerimaanorder-penerimaan_order_tgl").attr("readonly", true);
            // $("#penerimaanorder-purchase_order_kode").attr("readonly", true);
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
        })

    $(document).on('change', '#penerimaanorder-purchase_order_kode', function() {
        let po_id = $('#penerimaanorder-purchase_order_kode option:selected').val();
        $('#header').fadeOut("slow", function() {
            $(this).hide();



        }).fadeIn("slow", function() {
            $.ajax({
                type: 'POST',
                data: {
                    purchase_order_id: po_id,
                },
                url: "<?= base_url('FAS/Pengadaan/Penerimaan/GetDataDetailByKodePo') ?>",
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
                            $("#hpr_id").val(v.purchase_request_id);
                            $("#hpo_id").val(v.purchase_order_id);
                            $("#hsp_id").val(v.supplier_id);
                        })
                        AppendToTableDetail();
                    }
                }
            });
            $(this).show();
        });

    })

    function AppendToTableDetail() {
        if ($.fn.DataTable.isDataTable('#tablebarangpo')) {
            $('#tablebarangpo').DataTable().clear();
        }
        $('#tablebarangpo > tbody').empty();
        $('#tablebarangpo').fadeOut("slow", function() {
            $(this).hide();

        }).fadeIn("slow", function() {


            $.ajax({
                url: "<?= base_url('FAS/Pengadaan/Penerimaan/GetPurchaseRequestDetailById'); ?>",
                type: "POST",
                data: {
                    po_id: $('#hpo_id').val()
                },
                dataType: "JSON",
                success: function(data) {
                    let response = data;


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
                            purchase_order_id: v.purchase_order_id
                        });

                        $("#tablebarangpo tbody").append(`
                    
					<tr id="row-${i}">
						<td>${i+1}<input type="hidden" id="hcountlistpo" value="${i}"></td>
						<td>
							<span id="item-${i}-sku_barang_kode" >${v.sku_barang_kode}</span> 
						</td>
						<td>
							<span id="item-${i}-sku_barang_nama_produk" >${v.sku_barang_nama_produk}</span> 
						</td>
						<td>
                            <span id="span-item-${i}-sku_barang_satuan">${v.sku_barang_satuan}</span>
						</td>
						<td><span id="span-item-${i}-sku_barang_kemasan">${v.sku_barang_kemasan}</span></td>
                        <td><span id="span-item-${i}-purchase_order_detail_qty">${v.purchase_order_detail_qty}</span></td>
                        <td><input type="number" class="form-control numeric" id="item-${i}-purchase_order_detail_qty" value="${v.purchase_order_detail_qty}" "></td>
                        <td><input type="number" class="form-control numeric" id="item-${i}-sku_barang_harga" onchange="handleChecKodeByEnter(event,this.value)" value="${Math.round(v.sku_barang_harga)}"></td>
						<td>${v.supplier_keterangan==null?'-':v.supplier_keterangan}</td>
						<td>
							<button class="btn btn-danger btn-small HapusItemPaketAddPO idx-${i} ${v.sku_barang_id}" value="${v.purchase_order_id}" id="btnDetailPo"><i class="fa fa-trash"><label id="lbnmsupp" class="nm-${v.supplier_nama}"></label></i></button>
						</td>
                        <td><span id="span-item-${i}-supplier_id">${v.supplier_id}</span></td>
				    </tr>
				    `);

                    })
                    console.log(arrSkuBarangPO);
                }
            })
        })
    }

    function handleChecKodeByEnter(e, value) {
        console.log(value);
        return false;

        let typeScan = $("#tempValForScan").val();

        if (typeScan === "lokasi") {
            if (e.keyCode == 13) {
                if (kode == "") {
                    message("Error!", "Kode Lokasi tidak boleh kosong", "error");
                    return false;
                } else {
                    handlereRquestToCheckKodePallet(kode, typeScan);
                }
            }
        }

        if (typeScan === "pallet") {
            if (e.keyCode == 13) {
                if (kode == "") {
                    message("Error!", "Kode Pallet tidak boleh kosong", "error");
                    return false;
                } else {
                    handlereRquestToCheckKodePallet(kode, typeScan);
                }
            }
        }
    }
    $(document).on("input", ".numeric", function(event) {
        this.value = this.value.replace(/[^\d.]+/g, '');
    });
    $(document).on('click', '.HapusItemPaketAddPO', function() {
        let idx = $(this).attr('class').split(' ')[4].split('-')[1]
        let sku_barang_id = $(this).attr('class').split(' ')[5]
        // const fil = arr_purchase_request_detail.filter((data, index) => index !== parseInt(idx));
        const fil = arrSkuBarangPO.filter((data, index) => data.sku_barang_id !== sku_barang_id);
        // const fil2 = arrSkuBarangSupplier.filter((data, index) => data.sku_barang_id !== sku_barang_id)
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
            let it6 = $(this).find("td:eq(6) input[type='text']")
            let it7span = $(this).find("td:eq(7) span")
            let it8span = $(this).find("td:eq(8) span")
            let it9btn = $(this).find("td:eq(9) button")


            it0.html(`${i+1}`);
            it1span.attr('id', `item-${i}-sku_barang_kode`);
            it2span.attr('id', `item-${i}-sku_barang_nama_produk`);
            it3span.attr('id', `item-${i}-sku_barang_satuan`);
            it4span.attr('id', `item-${i}-sku_barang_kemasan`);
            it5span.attr('id', `item-${i}-purchase_order_detail_qty`);
            it6.attr('id', `item-${i}-purchase_order_detail_qty`);
            it7span.attr('id', `item-${i}-sku_barang_harga`);
            it9btn.attr('id', `item-${i}-sku_barang_nama_produk`);

            tridx.attr('id', `row-${i}`)
        });

    });
    $(document).on('click', '#btnsavepenerimaanpo', function() {
        arr_detail_push = [];
        for (var index = 0; index < arrSkuBarangPO.length; index++) {
            if (arrSkuBarangPO[index] != "") {
                // if ($("#item-" + index + "-purchaserequestdetail-principle_id").val() == null || $("#item-" + index + "-purchaserequestdetail-principle_id").val() == "null" || $("#item-" + index + "-purchaserequestdetail-principle_id").val() == "") {
                //     alert(`Supplier ke ${index+1} kosong`);
                //     return false;
                // }
                // if ($("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == null || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == "null" || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == "" || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == 0 || $("#item-" + index + "-purchaserequestdetail-purchase_request_detail_qty_req").val() == "0") {
                //     alert(`Qty Request ke ${index+1} kosong, mohon isi`);
                //     return false;
                // }
                // if ($("#item-" + index + "-purchaserequestdetail-purchase_request_detailhargasatuan").val() == null || $("#item-" + index + "-purchaserequestdetail-purchase_request_detailhargasatuan").val() == "") {
                //     alert(`Harga Satuan ke ${index+1} tidak ditemukan, mohon isi`);
                //     return false;
                // }
                arr_detail_push.push({
                    'sku_barang_satuan': $("#item-" + index + "-sku_barang_satuan").val(),
                    'sku_barang_nama_produk': $("#item-" + index + "-sku_barang_nama_produk").val(),
                    'sku_barang_kode': $("#item-" + index + "-sku_barang_kode").val(),
                    'sku_barang_kemasan': $("#item-" + index + "-sku_barang_kemasan").val(),
                    // 'sku_barang_harga': $("#item-" + index + "-purchaserequestdetail-sku_barang_harga").val(),
                    'sku_barang_id': $("#item-" + index + "-purchase_order_detail_qty").val(),
                    'sku_barang_harga': $("#item-" + index + "-sku_barang_harga").val(),
                    'purchase_order_detail_qty': $("#item-" + index + "-purchase_order_detail_qty").val(),
                    'purchase_order_detail_qty_terima': $("#item-" + index + "-purchase_order_detail_qty_terima").val(),
                    'supplier_id': $("#item-" + index + "-supplier_id").val()
                });
            }
        }

        console.log(arr_detail_push);

        if (arrSkuBarangPO.length == 0) {
            alert('kosong');
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
            }
        })

    })
</script>