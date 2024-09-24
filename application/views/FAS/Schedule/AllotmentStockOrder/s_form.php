<script type="text/javascript">
    var arr_allotment_stock_order_detail = [];
    var arr_allotment_stock_order_detail2 = [];
    var arr_list_back_order = [];
    var arr_list_back_order_simulasi = [];
    var arr_simulasi_mps_temp2 = [];
    var arr_list_delete_back_order = [];
    var idx_detail_bo = 0;
    const karyawan_sales_id = "644A7B16-2038-4529-A0B9-EC549DD0E6BB";
    const karyawan_sales_nama = "ARI PURWANTO";

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });

        run_input_mask_money();

        <?php if ($act == "edit" || $act == "detail") { ?>
            <?php foreach ($DetailBO as $key => $value) : ?>
                arr_list_back_order.push({
                    'back_order_id': "<?= $value['back_order_id'] ?>",
                    'client_pt_id': "<?= $value['client_pt_id'] ?>"
                });
            <?php endforeach; ?>

            <?php foreach ($Detail3 as $key => $value) : ?>
                arr_list_back_order_simulasi.push({
                    'back_order_id': "<?= $value['back_order_id'] ?>",
                    'karyawan_sales_id': "<?= $value['karyawan_sales_id'] ?>",
                    'sku_id': "<?= $value['sku_id'] ?>",
                    'tahun': "<?= $value['tahun'] ?>",
                    'bulan': "<?= $value['bulan'] ?>",
                    'sku_qty_bo': "<?= $value['sku_qty_bo'] ?>",
                    'sku_qty': "<?= $value['sku_qty'] ?>",
                })
            <?php endforeach; ?>

            setTimeout(() => {
                Get_list_allotment_stock_order_detail();
                cek_disabled_header();
            }, 500);
        <?php } ?>
    });

    $('#chk-all-back-order').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="chk-data-back-order[]"]:checkbox').each(function() {
                this.checked = true;
                var back_order_id = this.getAttribute('data-back_order_id');
                var client_pt_id = this.getAttribute('data-client_pt_id');

                arr_list_back_order.push({
                    'back_order_id': back_order_id,
                    'client_pt_id': client_pt_id
                });
            });
        } else {
            $('[name="chk-data-back-order[]"]:checkbox').each(function() {
                this.checked = false;
                var back_order_id = this.getAttribute('data-back_order_id');
                var client_pt_id = this.getAttribute('data-client_pt_id');

                const findIndexData = arr_list_back_order.findIndex((value) => value.back_order_id == back_order_id);

                if (findIndexData > -1) {
                    arr_list_back_order.splice(findIndexData, 1);
                }
            });
        }
    });

    $('#chk-all-delete-back-order').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="chk-delete-back-order[]"]:checkbox').each(function() {
                this.checked = true;
                var back_order_id = this.getAttribute('data-back_order_id');

                arr_list_delete_back_order.push(back_order_id);
            });
        } else {
            $('[name="chk-delete-back-order[]"]:checkbox').each(function() {
                this.checked = false;
                var back_order_id = this.getAttribute('data-back_order_id');

                const findIndexData = arr_list_delete_back_order.findIndex((value) => value == back_order_id);

                if (findIndexData > -1) {
                    arr_list_delete_back_order.splice(findIndexData, 1);
                }
            });
        }
    });

    function message_custom(titleType, iconType, htmlType) {
        Swal.fire({
            title: titleType,
            icon: iconType,
            html: htmlType,
        })
    }

    function ViewModalListDataPilihBackOrder() {
        $("#modal_list_back_order").modal('show');
        Get_list_back_order();

        $('#filter_perusahaan_backorder').val($("#AllotmentStockOrder-client_wms_id").val()).trigger('change');
    }

    function Get_list_back_order() {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/Schedule/AllotmentStockOrder/Get_list_back_order') ?>",
            data: {
                tahun: $("#AllotmentStockOrder-allotment_stock_order_tahun").val(),
                perusahaan: $("#AllotmentStockOrder-client_wms_id").val(),
                temp_id: $("#AllotmentStockOrder-allotment_stock_order_id").val(),
                arr_list_back_order: arr_list_back_order
            },
            dataType: "JSON",
            success: function(response) {

                $('#table_list_back_order').fadeOut("fast", function() {
                    $(this).hide();

                    $("#table_list_back_order > tbody").html('');
                    $("#table_list_back_order > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table_list_back_order')) {
                        $('#table_list_back_order').DataTable().clear();
                        $('#table_list_back_order').DataTable().destroy();
                    }

                }).fadeIn("fast", function() {
                    $(this).show();

                    if (response.length > 0) {

                        $.each(response, function(i, v) {

                            $("#table_list_back_order > tbody").append(`
								<tr>
									<td class="text-center" style="text-align: center; vertical-align: middle;">
                                        <input type="checkbox" class="form-control" name="chk-data-back-order[]" style="transform: scale(1.0)" id="chk-item-${i}-back-order" data-back_order_id="${v.back_order_id}" data-client_pt_id="${v.client_pt_id}" value="${v.back_order_id}" onclick="AddListAllotmentStockOrderDetail('${i}','${v.back_order_id}','${v.client_pt_id}')" />
                                    </td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.back_order_kode}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.back_order_no_po}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.back_order_tgl}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.tipe}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_pt_nama}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_pt_alamat}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_pt_kecamatan}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_pt_kota}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_pt_propinsi}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.area_kode}</td>
								</tr>
							`);
                        });
                    }

                    $('#table_list_back_order').DataTable({
                        lengthMenu: [
                            [50, 100, 200, -1],
                            [50, 100, 200, 'All']
                        ],
                        ordering: false,
                        searching: true,
                        "scrollX": true
                    });
                });
            }
        });
    }

    function GetPrincipleByPerusahaan() {
        $.ajax({
            type: 'GET',
            url: "<?= base_url('FAS/Schedule/AllotmentStockOrder/GetPrincipleByPerusahaan') ?>",
            data: {
                perusahaan: $("#AllotmentStockOrder-client_wms_id").val()
            },
            dataType: "JSON",
            success: function(response) {

                $("#AllotmentStockOrder-principle_id").html('');
                $("#AllotmentStockOrder-principle_id").append(`<option value="">** <label name="CAPTION-PENYALURATAUPRINCIPLE">Penyalur / Principle</label> **</option>`);

                $.each(response, function(i, v) {
                    $("#AllotmentStockOrder-principle_id").append(`<option value="${v.principle_id}">${v.principle_kode}</option>`);
                });

            }
        });
    }

    function AddListAllotmentStockOrderDetail(index, back_order_id, client_pt_id) {

        if ($("#chk-item-" + index + "-back-order").is(":checked")) {

            arr_list_back_order.push({
                'back_order_id': back_order_id,
                'client_pt_id': client_pt_id
            });

        } else {
            DeleteListAllotmentStockOrderDetail(back_order_id);
        }

    }

    function AddListDeleteBackOrder(index, back_order_id) {

        if ($("#chk-item-" + index + "-delete-back-order").is(":checked")) {

            arr_list_delete_back_order.push(back_order_id);

        } else {
            const findIndexData = arr_list_delete_back_order.findIndex((value) => value == back_order_id);

            if (findIndexData > -1) {
                arr_list_delete_back_order.splice(findIndexData, 1);
            }
        }

    }

    function PilihBackOrder() {
        Get_list_allotment_stock_order_detail();
        $("#modal_list_back_order").modal('hide');
    }

    function PilihJadwal() {

        let cek_error = 0;
        let grand_total = 0;

        if (arr_allotment_stock_order_detail2.length == 0) {
            var alert = "Jadwal belum ditambahkan";
            message_custom("Error", "error", alert);

            return false;
        }

        $.each(arr_allotment_stock_order_detail2, function(i, v) {

            if (v.sku_id == $("#filter_sku_id_detail2").val()) {
                grand_total += parseInt(v.qty);
            }

            if (v.bulan == "" || v.bulan == 0) {
                var alert = "Bulan tidak boleh kosong";
                message_custom("Error", "error", alert);

                cek_error++;
            }

            if (v.tahun == "" || v.tahun == 0) {
                var alert = "Tahun tidak boleh kosong";
                message_custom("Error", "error", alert);

                cek_error++;
            }

            // if ((v.qty == "" || v.qty == 0) && $("#filter_sku_jumlah_barang_detail2").val() != "0") {
            //     var alert = "Qty tidak boleh kosong atau 0";
            //     message_custom("Error", "error", alert);

            //     cek_error++;
            // }

        });

        setTimeout(() => {

            if (grand_total != $("#filter_sku_jumlah_barang_detail2").val()) {
                var alert = "Grand total tidak sama dengan nilai maksimal jumlah barang";
                message_custom("Error", "error", alert);

                return false;
            }

            if (cek_error == 0) {
                $("#modal_list_data_pilih_jadwal_sku").modal('hide');

                const findIndexData = arr_allotment_stock_order_detail.findIndex((value) => value.sku_id == $("#filter_sku_id_detail2").val());

                if (findIndexData > -1) {
                    arr_allotment_stock_order_detail[findIndexData]['is_error'] = "0";
                }

                setTimeout(() => {
                    Get_list_allotment_stock_order_detail();
                }, 500);
            }
        }, 500);
    }

    function Get_list_allotment_stock_order_detail() {

        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/Schedule/AllotmentStockOrder/Get_list_allotment_stock_order_detail') ?>",
            data: {
                temp_id: $("#AllotmentStockOrder-allotment_stock_order_id").val(),
                tahun: $("#AllotmentStockOrder-allotment_stock_order_tahun").val(),
                arr_list_back_order: arr_list_back_order
            },
            dataType: "JSON",
            success: function(response) {
                $('#table_allotment_stock_order_detail3').fadeOut("fast", function() {
                    $(this).hide();

                    $("#table_allotment_stock_order_detail3 > tbody").html('');
                    $("#table_allotment_stock_order_detail3 > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table_allotment_stock_order_detail3')) {
                        $('#table_allotment_stock_order_detail3').DataTable().clear();
                        $('#table_allotment_stock_order_detail3').DataTable().destroy();
                    }

                }).fadeIn("fast", function() {
                    $(this).show();

                    if (response.Header.length > 0) {

                        $.each(response.Header, function(i, v) {

                            $("#table_allotment_stock_order_detail3 > tbody").append(`
								<tr>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_pt_nama}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_pt_alamat}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_pt_kecamatan}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_pt_kota}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.area_kode}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.client_pt_telepon}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.jml_bo}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">
                                        <button type="button" class="btn_tambah_jadwal_sku" style="border:none;background:transparent" onclick="ViewModalBackOrder('${v.client_pt_id}','${v.client_pt_nama}')"><i class="fas fa-eye text-primary" style="cursor: pointer"></i></button>
                                        <button type="button" class="btndeletesku" style="border:none;background:transparent" onclick="DeleteListBackOrderByCustomer('${v.client_pt_id}')"><i class="fas fa-trash text-danger" style="cursor: pointer"></i></button>
                                    </td>
								</tr>
							`);
                        });
                    }
                });

                $('#table_allotment_stock_order_detail').fadeOut("fast", function() {
                    $(this).hide();

                    $("#table_allotment_stock_order_detail > tbody").html('');
                    $("#table_allotment_stock_order_detail > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table_allotment_stock_order_detail')) {
                        $('#table_allotment_stock_order_detail').DataTable().clear();
                        $('#table_allotment_stock_order_detail').DataTable().destroy();
                    }

                }).fadeIn("fast", function() {
                    $(this).show();

                    if (response.Summary.length > 0) {

                        $.each(response.Summary, function(i, v) {

                            console.log(parseInt(v.sku_qty_sim) + " > " + parseInt(v.sku_qty));

                            if (parseInt(v.sku_qty_sim) == 0) {
                                $("#table_allotment_stock_order_detail > tbody").append(`
                                    <tr style="background: #FFFDB5">
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.principle}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.brand}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kode}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_nama_produk}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kemasan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_satuan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_qty}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button type="button" class="btn_tambah_jadwal_sku" style="border:none;background:transparent" onclick="ViewModalSimulasiSKU('${v.sku_id}','${v.sku_kode}','${v.sku_nama_produk}','${v.sku_kemasan}','${v.sku_satuan}','${v.sku_qty}')"><i class="fas fa-eye text-primary" style="cursor: pointer"></i></button>
                                        </td>
                                    </tr>
                                `);

                            } else if (parseInt(v.sku_qty_sim) > parseInt(v.sku_qty)) {
                                $("#table_allotment_stock_order_detail > tbody").append(`
                                    <tr style="background: #FF6868">
                                        <td class="text-center" style="text-align: center; vertical-align: middle;color:black;">${i+1}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;color:black;">${v.principle}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;color:black;">${v.brand}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;color:black;">${v.sku_kode}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;color:black;">${v.sku_nama_produk}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;color:black;">${v.sku_kemasan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;color:black;">${v.sku_satuan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;color:black;">${v.sku_qty}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;color:black;">
                                            <button type="button" class="btn_tambah_jadwal_sku" style="border:none;background:transparent" onclick="ViewModalSimulasiSKU('${v.sku_id}','${v.sku_kode}','${v.sku_nama_produk}','${v.sku_kemasan}','${v.sku_satuan}','${v.sku_qty}')"><i class="fas fa-eye text-primary" style="cursor: pointer"></i></button>
                                        </td>
                                    </tr>
                                `);
                            } else {
                                $("#table_allotment_stock_order_detail > tbody").append(`
                                    <tr>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.principle}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.brand}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kode}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_nama_produk}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kemasan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_satuan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_qty}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button type="button" class="btn_tambah_jadwal_sku" style="border:none;background:transparent" onclick="ViewModalSimulasiSKU('${v.sku_id}','${v.sku_kode}','${v.sku_nama_produk}','${v.sku_kemasan}','${v.sku_satuan}','${v.sku_qty}')"><i class="fas fa-eye text-primary" style="cursor: pointer"></i></button>
                                        </td>
                                    </tr>
                                `);
                            }
                        });
                    }
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");
            },
        });

    }

    function ViewModalBackOrder(client_pt_id, client_pt_nama) {

        arr_list_delete_back_order = [];
        $("#modal_list_back_order_by_customer").modal('show');
        $("#filter_pelanggan_back_order_by_customer").html(client_pt_nama);

        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/Schedule/AllotmentStockOrder/Get_list_back_order_by_customer') ?>",
            data: {
                tahun: $("#AllotmentStockOrder-allotment_stock_order_tahun").val(),
                perusahaan: $("#AllotmentStockOrder-client_wms_id").val(),
                arr_list_back_order: arr_list_back_order,
                client_pt_id: client_pt_id
            },
            dataType: "JSON",
            success: function(response) {
                $('#table_list_back_order_by_customer').fadeOut("fast", function() {
                    $(this).hide();

                    $("#table_list_back_order_by_customer > tbody").html('');
                    $("#table_list_back_order_by_customer > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table_list_back_order_by_customer')) {
                        $('#table_list_back_order_by_customer').DataTable().clear();
                        $('#table_list_back_order_by_customer').DataTable().destroy();
                    }

                }).fadeIn("fast", function() {
                    $(this).show();

                    if (response.length > 0) {

                        $.each(response, function(i, v) {

                            $("#table_list_back_order_by_customer > tbody").append(`
								<tr>
									<td class="text-center" style="text-align: center; vertical-align: middle;">
                                        <input type="checkbox" name="chk-delete-back-order[]" id="chk-item-${i}-delete-back-order" data-back_order_id="${v.back_order_id}" data-client_pt_id="${v.client_pt_id}" value="${v.back_order_id}" onclick="AddListDeleteBackOrder('${i}','${v.back_order_id}')" />
                                    </td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.back_order_kode}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.back_order_no_po}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.back_order_tgl}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.tipe}</td>
								</tr>
							`);
                        });
                    }
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");
            },
        });
    }

    function UpdateListAllotmentStockOrder(index, sku_id) {
        const findIndexData = arr_allotment_stock_order_detail.findIndex((value) => value.sku_id == sku_id);
        const sku_harga_total = 0;

        if (findIndexData > -1) {

            arr_allotment_stock_order_detail[findIndexData]['sku_jumlah_barang'] = parseInt($("#item-" + index + "-AllotmentStockOrder-sku_jumlah_barang").val());
            arr_allotment_stock_order_detail[findIndexData]['sku_exp_date'] = $("#item-" + index + "-AllotmentStockOrder-sku_exp_date").val();
        }
    }

    function DeleteListAllotmentStockOrderDetail(back_order_id) {
        const findIndexData = arr_list_back_order.findIndex((value) => value.back_order_id == back_order_id);
        const findIndexData2 = arr_list_back_order_simulasi.findIndex((value) => value.back_order_id == back_order_id);

        if (findIndexData > -1) {
            arr_list_back_order.splice(findIndexData, 1);
        }

        if (findIndexData2 > -1) {
            arr_list_back_order_simulasi.splice(findIndexData2, 1);
        }

    }

    function DeleteSelectedBackOrder() {

        Swal.fire({
            title: "Warning",
            text: "Apakah anda yakin ingin menghapus data yang dipilih ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan",
            cancelButtonText: "Tidak, Tutup"
        }).then((result) => {
            if (result.value == true) {

                if (arr_list_delete_back_order.length > 0) {

                    $.each(arr_list_delete_back_order, function(i, v) {
                        const findIndexData = arr_list_back_order.findIndex((value) => value.back_order_id == v);
                        const findIndexData2 = arr_list_back_order_simulasi.findIndex((value) => value.back_order_id == v);

                        if (findIndexData > -1) {
                            arr_list_back_order.splice(findIndexData, 1);
                        }

                        if (findIndexData2 > -1) {
                            arr_list_back_order_simulasi.splice(findIndexData2, 1);
                        }
                    });

                    setTimeout(() => {

                        $("#modal_list_back_order_by_customer").modal('hide');
                        Get_list_allotment_stock_order_detail();

                    }, 500);
                }
            }
        });
    }

    function ViewModalSimulasiSKU(sku_id, sku_kode, sku_nama_produk, sku_kemasan, sku_satuan, sku_qty) {
        $("#filter_tahun_detail_summary_sku").html($("#AllotmentStockOrder-allotment_stock_order_tahun").val());
        $("#filter_sku_id_detail_summary_sku").val(sku_id);
        $("#filter_sku_kode_detail_summary_sku").html(sku_kode);
        $("#filter_sku_nama_produk_detail_summary_sku").html(sku_nama_produk);
        $("#filter_sku_satuan_detail_summary_sku").html(sku_satuan);
        $("#filter_sku_kemasan_detail_summary_sku").html(sku_kemasan);

        $("#modal_simulasi_sku").modal('show');

        setTimeout(() => {
            Get_proses_simulasi_mps();
        }, 500);
    }

    function Get_proses_simulasi_mps() {

        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/Schedule/AllotmentStockOrder/Get_proses_simulasi_mps') ?>",
            data: {
                allotment_stock_order_id: $("#AllotmentStockOrder-allotment_stock_order_id").val(),
                tahun: $("#AllotmentStockOrder-allotment_stock_order_tahun").val(),
                sku_id: $("#filter_sku_id_detail_summary_sku").val()
            },
            dataType: "JSON",
            success: function(response) {
                $('#table_list_simulasi_sku').fadeOut("fast", function() {
                    $(this).hide();

                    $("#table_list_simulasi_sku > tbody").html('');
                    $("#table_list_simulasi_sku > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table_list_simulasi_sku')) {
                        $('#table_list_simulasi_sku').DataTable().clear();
                        $('#table_list_simulasi_sku').DataTable().destroy();
                    }

                }).fadeIn("fast", function() {
                    $(this).show();

                    if (response.length > 0) {

                        $.each(response, function(i, v) {

                            if (v.jenis == "Allotment Stock Order (Draft)") {

                                $("#table_list_simulasi_sku > tbody").append(`
                                    <tr>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.jenis}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['0']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','1',${v['1']})">${v['1']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','2',${v['2']})">${v['2']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','3','${v['3']}')">${v['3']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','4','${v['4']}')">${v['4']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','5','${v['5']}')">${v['5']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','6','${v['6']}')">${v['6']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','7','${v['7']}')">${v['7']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','8','${v['8']}')">${v['8']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','9','${v['9']}')">${v['9']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','10','${v['10']}')">${v['10']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','11','${v['11']}')">${v['11']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalSimulasiMpsTemp2('${v.jenis}','12','${v['12']}')">${v['12']}</button>
                                        </td>
                                    </tr>
                                `);

                            } else if (v.jenis == "Allotment Stock Order (Plan)") {

                                $("#table_list_simulasi_sku > tbody").append(`
                                    <tr>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.jenis}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['0']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','1',${v['1']})">${v['1']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','2',${v['2']})">${v['2']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','3','${v['3']}')">${v['3']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','4','${v['4']}')">${v['4']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','5','${v['5']}')">${v['5']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','6','${v['6']}')">${v['6']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','7','${v['7']}')">${v['7']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','8','${v['8']}')">${v['8']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','9','${v['9']}')">${v['9']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','10','${v['10']}')">${v['10']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','11','${v['11']}')">${v['11']}</button>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary btn-sm" onclick="ViewModalBackOrderSimulasiMPS('${v.jenis}','12','${v['12']}')">${v['12']}</button>
                                        </td>
                                    </tr>
                                `);

                            } else {

                                $("#table_list_simulasi_sku > tbody").append(`
                                    <tr>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.jenis}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['0']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['1']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['2']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['3']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['4']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['5']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['6']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['7']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['8']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['9']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['10']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['11']}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v['12']}</td>
                                    </tr>
                                `);

                            }
                        });
                    }

                    $('.select2').select2({
                        width: '100%'
                    });
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");
            },
        });
    }

    function UpdateListAllotmentStockOrder2(index, idx) {
        const findIndexData = arr_allotment_stock_order_detail2.findIndex((value) => value.idx == idx);

        if (findIndexData > -1) {

            // arr_allotment_stock_order_detail2[findIndexData]['tahun'] = $("#item-" + index + "-AllotmentStockOrder2-tahun").val();
            arr_allotment_stock_order_detail2[findIndexData]['bulan'] = $("#item-" + index + "-AllotmentStockOrder2-bulan").val();
            arr_allotment_stock_order_detail2[findIndexData]['qty'] = parseInt($("#item-" + index + "-AllotmentStockOrder2-qty").val());
        }

        HitungGrandTotalSchedule();
    }

    function UpdateTahunAllotmentStockOrder2() {
        $.each(arr_allotment_stock_order_detail2, function(i, v) {
            const findIndexData = arr_allotment_stock_order_detail2.findIndex((value) => value.idx == v.idx);

            if (findIndexData > -1) {

                arr_allotment_stock_order_detail2[findIndexData]['tahun'] = $("#filter_tahun_detail2").val();
            }

        });
    }

    function DeleteListBackOrderByCustomer(customer) {

        Swal.fire({
            title: "Warning",
            text: "Apakah anda yakin ingin menghapus data ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan",
            cancelButtonText: "Tidak, Tutup"
        }).then((result) => {
            if (result.value == true) {

                $.ajax({
                    type: "GET",
                    url: "<?= base_url('FAS/Schedule/AllotmentStockOrder/Get_back_order_by_customer') ?>",
                    data: {
                        customer: customer
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.length > 0) {
                            $.each(response, function(i, v) {
                                const findIndexData = arr_list_back_order.findIndex((value) => value.back_order_id == v.back_order_id);
                                const findIndexData2 = arr_list_delete_back_order.findIndex((value) => value.back_order_id == v.back_order_id);
                                const findIndexData3 = arr_list_back_order_simulasi.findIndex((value) => value.back_order_id == v.back_order_id);

                                if (findIndexData > -1) {
                                    arr_list_back_order.splice(findIndexData, 1);
                                }

                                if (findIndexData2 > -1) {
                                    arr_list_delete_back_order.splice(findIndexData2, 1);
                                }

                                if (findIndexData3 > -1) {
                                    arr_list_back_order_simulasi.splice(findIndexData3, 1);
                                }

                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        message("Error", "Error 500 Internal Server Connection Failure", "error");
                    }
                });

                setTimeout(() => {
                    Get_list_allotment_stock_order_detail();
                    cek_disabled_header();
                }, 500);
            }
        });
    }

    function DeleteAllBackOrder() {

        Swal.fire({
            title: "Warning",
            text: "Apakah anda yakin ingin menghapus semua data ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan",
            cancelButtonText: "Tidak, Tutup"
        }).then((result) => {
            if (result.value == true) {

                arr_list_back_order = [];
                arr_list_delete_back_order = [];
                arr_list_back_order_simulasi = [];

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('FAS/Schedule/AllotmentStockOrder/delete_allotment_stock_order_detail3_by_id') ?>",
                    data: {
                        id: $('#AllotmentStockOrder-allotment_stock_order_id').val()
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response == "1") {
                            console.log("delete_allotment_stock_order_detail3_by_id success");
                        } else {
                            console.log("delete_allotment_stock_order_detail3_by_id failed");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        message("Error", "Error 500 Internal Server Connection Failure", "error");
                    }
                });

                setTimeout(() => {
                    Get_list_allotment_stock_order_detail();
                    cek_disabled_header();
                }, 500);
            }
        });
    }

    function DeleteListAllotmentStockOrder2(idx) {
        const findIndexData = arr_allotment_stock_order_detail2.findIndex((value) => value.idx == idx);

        if (findIndexData > -1) {
            arr_allotment_stock_order_detail2.splice(findIndexData, 1);
        }

        Get_proses_simulasi_mps();
        HitungGrandTotalSchedule();
        cek_disabled_header();

    }

    function HitungGrandTotalSchedule() {
        let grand_total_schedule = 0;

        $.each(arr_allotment_stock_order_detail2, function(i, v) {
            if (v.sku_id == $("#filter_sku_id_detail2").val()) {
                grand_total_schedule += parseInt(v.qty);
            }
        });

        $("#grand_total_schedule").html(grand_total_schedule);
    }

    function cek_disabled_header() {
        // if (arr_list_back_order.length > 0) {
        //     $("#AllotmentStockOrder-client_wms_id").prop("disabled", true);
        //     $("#AllotmentStockOrder-allotment_stock_order_tahun").prop("disabled", true);
        // } else {
        //     $("#AllotmentStockOrder-client_wms_id").prop("disabled", false);
        //     $("#AllotmentStockOrder-allotment_stock_order_tahun").prop("disabled", false);
        // }
    }

    function saveData() {

        let cek_error = 0;

        if ($("#AllotmentStockOrder-client_wms_id").val() == "") {
            var alert = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
            message_custom("Error", "error", alert);
            return false;
        }

        if ($("#AllotmentStockOrder-allotment_stock_order_tahun").val() == "") {
            // var alert = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
            var alert = "Tahun masih kosong";
            message_custom("Error", "error", alert);
            return false;
        }

        setTimeout(() => {

            if (cek_error == 0) {

                <?php if ($act == "edit") { ?>
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('FAS/Schedule/AllotmentStockOrder/update_allotment_stock_order') ?>",
                        data: {
                            allotment_stock_order_id: $('#AllotmentStockOrder-allotment_stock_order_id').val(),
                            depo_id: "",
                            client_wms_id: $('#AllotmentStockOrder-client_wms_id').val(),
                            allotment_stock_order_kode: $('#AllotmentStockOrder-allotment_stock_order_kode').val(),
                            allotment_stock_order_tahun: $('#AllotmentStockOrder-allotment_stock_order_tahun').val(),
                            allotment_stock_order_status: $('#AllotmentStockOrder-allotment_stock_order_status').val(),
                            allotment_stock_order_keterangan: $('#AllotmentStockOrder-allotment_stock_order_keterangan').val(),
                            allotment_stock_order_who_create: "",
                            allotment_stock_order_tgl_create: "",
                            allotment_stock_order_tgl_update: $('#AllotmentStockOrder-allotment_stock_order_tgl_update').val(),
                            allotment_stock_order_who_update: $('#AllotmentStockOrder-allotment_stock_order_who_update').val(),
                            detail: arr_list_back_order,
                            back_order_simulasi: arr_list_back_order_simulasi
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Loading ...',
                                html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                                timerProgressBar: false,
                                showConfirmButton: false
                            });

                            $("#btn_simpan").prop("disabled", true);
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.kode == 1) {
                                var alert = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                message_custom("Success", "success", alert);

                                setTimeout(() => {
                                    location.href = "<?= base_url() ?>FAS/Schedule/AllotmentStockOrder/AllotmentStockOrderMenu";
                                }, 1000);

                            } else {
                                if (response.data.length > 0) {

                                    let arrayOfErrorsToDisplayEmptySku = [];
                                    let indexErrorEmptySku = [];
                                    arrayOfErrorsToDisplayEmptySku = []
                                    indexErrorEmptySku = []

                                    $.each(response.data, (index, item) => {
                                        let response = item;
                                        indexErrorEmptySku.push(index + 1);
                                        arrayOfErrorsToDisplayEmptySku.push({
                                            title: 'Data gagal disimpan!',
                                            html: `Simulasi allotment SKU <strong>${response.sku_nama_produk}</strong> masih kosong atau simulasi qty melebihi qty maksimal allotment`
                                        });
                                    });

                                    Swal.mixin({
                                        icon: 'error',
                                        confirmButtonText: 'Next &rarr;',
                                        showCancelButton: true,
                                        progressSteps: indexErrorEmptySku
                                    }).queue(arrayOfErrorsToDisplayEmptySku);

                                    setTimeout(() => {
                                        Get_list_allotment_stock_order_detail();
                                    }, 500);

                                } else {
                                    var alert = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                    message_custom("Error", "error", alert);
                                }
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            message("Error", "Error 500 Internal Server Connection Failure", "error");
                            $("#btn_simpan").prop("disabled", false);
                        },
                        complete: function() {
                            // Swal.close();
                            $("#btn_simpan").prop("disabled", false);
                        }
                    })
                <?php } ?>
            } else {
                return false;
            }

        }, 500);
    }

    function ViewModalSimulasiMpsTemp2(jenis, bulan, qty) {

        $("#modal_simulasi_mps_temp2").modal('show');
        $(".modal_title_simulasi_mps_temp2").html(jenis);

        const sku_id = $("#filter_sku_id_detail_summary_sku").val();
        const sku_kode = $("#filter_sku_kode_detail_summary_sku").text();
        const sku_nama_produk = $("#filter_sku_nama_produk_detail_summary_sku").text();
        const sku_satuan = $("#filter_sku_satuan_detail_summary_sku").text();
        const sku_kemasan = $("#filter_sku_kemasan_detail_summary_sku").text();
        const tahun = $("#AllotmentStockOrder-allotment_stock_order_tahun").val();
        let qty_max = 0;
        let total_qty_simulasi_mps_temp2 = 0;
        let qty_sisa = 0;

        let total_sku_qty_per_bulan = 0;
        let qty_sisa_per_bulan = 9;

        if (arr_list_back_order_simulasi.length > 0) {
            $.each(arr_list_back_order_simulasi, function(i, v) {
                if (v.bulan == bulan && v.tahun == tahun && v.sku_id == sku_id) {
                    total_sku_qty_per_bulan += parseInt(v.sku_qty);
                }
            });
        }

        $("#SimulasiMpsTemp2-sku_id").val(sku_id);
        $("#filter_sku_kode_simulasi_mps_temp2").html(sku_kode);
        $("#filter_sku_nama_produk_simulasi_mps_temp2").html(sku_nama_produk);
        $("#filter_sku_satuan_simulasi_mps_temp2").html(sku_satuan);
        $("#filter_sku_kemasan_simulasi_mps_temp2").html(sku_kemasan);

        $("#SimulasiMpsTemp2-bulan").val(bulan).trigger('change');
        $("#SimulasiMpsTemp2-tahun").val(tahun);
        $("#SimulasiMpsTemp2-qty").val(0);
        $("#SimulasiMpsTemp2-qty_sisa").val(0);
        $("#SimulasiMpsTemp2-qty_sisa_perbulan").val(0);

        $.ajax({
            type: "GET",
            url: "<?= base_url('FAS/Schedule/AllotmentStockOrder/Get_simulasi_mps_temp2') ?>",
            data: {
                allotment_stock_order_id: $('#AllotmentStockOrder-allotment_stock_order_id').val(),
                tahun: $('#AllotmentStockOrder-allotment_stock_order_tahun').val(),
                bulan: bulan,
                sku_id: sku_id,
            },
            dataType: "JSON",
            success: function(response) {

                if (response.Header.length > 0) {

                    $.each(response.Header, function(i, v) {

                        qty_sisa_per_bulan = parseInt(v.qty) - total_sku_qty_per_bulan;

                        $("#SimulasiMpsTemp2-qty").val(v.qty);
                        $("#SimulasiMpsTemp2-qty_sisa_perbulan").val(qty_sisa_per_bulan);
                    });

                } else {
                    qty_sisa = qty_max - total_qty_simulasi_mps_temp2;

                    $("#SimulasiMpsTemp2-qty_sisa").val(qty_sisa);
                }

                if (response.Total.length > 0) {

                    $.each(response.Total, function(i, v) {

                        total_qty_simulasi_mps_temp2 = v.qty;
                        qty_sisa = total_qty_simulasi_mps_temp2;

                        $("#SimulasiMpsTemp2-qty_max").val(total_qty_simulasi_mps_temp2);
                        $("#SimulasiMpsTemp2-qty_sisa").val(qty_sisa);
                    });
                } else {
                    qty_sisa = qty_max - total_qty_simulasi_mps_temp2;

                    $("#SimulasiMpsTemp2-qty_sisa").val(qty_sisa);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                qty_sisa = qty_max - total_qty_simulasi_mps_temp2;

                $("#SimulasiMpsTemp2-qty_sisa").val(qty_sisa);
            }
        });

        setTimeout(() => {

            Get_list_back_order_simulasi_mps(bulan, sku_id);

        }, 500);

    }

    function Get_list_back_order_simulasi_mps(bulan, sku_id) {

        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/Schedule/AllotmentStockOrder/Get_list_back_order_simulasi_mps') ?>",
            data: {
                temp_id: $('#AllotmentStockOrder-allotment_stock_order_id').val(),
                tahun: $('#AllotmentStockOrder-allotment_stock_order_tahun').val(),
                bulan: bulan,
                sku_id: sku_id,
                arr_list_back_order: arr_list_back_order,
                arr_list_back_order_simulasi: arr_list_back_order_simulasi
            },
            dataType: "JSON",
            success: function(response) {

                $("#table_list_back_order_simulasi_mps > tbody").html('');
                $("#table_list_back_order_simulasi_mps > tbody").empty();

                if (response.length > 0) {

                    $.each(response, function(i, v) {

                        const findIndexData = arr_list_back_order_simulasi.findIndex((value) => value.back_order_id == v.back_order_id && value.sku_id == v.sku_id && value.tahun == v.tahun && value.bulan == v.bulan);

                        if (v.sku_id != "" && v.tahun != "" && v.bulan != "") {

                            if (findIndexData == -1) {

                                arr_list_back_order_simulasi.push({
                                    'back_order_id': v.back_order_id,
                                    'karyawan_sales_id': $("#SimulasiMpsTemp2-karyawan_sales_id").val(),
                                    'sku_id': v.sku_id,
                                    'tahun': v.tahun,
                                    'bulan': v.bulan,
                                    'sku_qty_bo': parseInt(v.sku_qty_bo),
                                    'sku_qty': parseInt(v.sku_qty)
                                })
                            }

                        }

                        $("#table_list_back_order_simulasi_mps > tbody").append(`
								<tr style="background: ${v.sku_qty_sisa == "0" ? '#ADD899' : ''}">
									<td class="text-center" style="text-align: center; vertical-align: middle;">
                                        ${i+1}
                                        <input type="hidden" class="form-control" name="item-${i}-back_order_simulasi_mps-back_order_id" id="item-${i}-back_order_simulasi_mps-back_order_id" value="${v.back_order_id}" onchange="UpdateBackOrderSimulasiMPS('${i}','${v.back_order_id}','${v.sku_id}','${v.tahun}','${v.bulan}','${v.sku_qty_bo}')" />
                                    </td>
									<td class="text-center" style="text-align: center; vertical-align: middle;width:20%;">${v.back_order_kode}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;width:20%;">${v.back_order_tgl}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;width:20%;">${v.client_pt_nama}</td>
                                    <td class="text-center" style="text-align: center; vertical-align: middle;width:10%;">${v.sku_qty_bo}</td>
                                    <td class="text-center" style="text-align: center; vertical-align: middle;width:10%;">${v.sku_qty_sisa}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">
                                        <input type="text" class="form-control" name="item-${i}-back_order_simulasi_mps-sku_qty" id="item-${i}-back_order_simulasi_mps-sku_qty" value="${v.sku_qty}" onchange="UpdateBackOrderSimulasiMPS('${i}','${v.back_order_id}','${v.sku_id}','${v.tahun}','${v.bulan}','${v.sku_qty_bo}','${v.sku_qty_sisa}',${v.sku_qty})" />
                                    </td>
								</tr>
							`);
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");
            }
        })

    }

    function ViewModalBackOrderSimulasiMPS(jenis, bulan, qty) {

        $("#modal_back_order_simulasi_mps").modal('show');
        $(".modal_title_back_order_simulasi_mps").html(jenis);

        const sku_id = $("#filter_sku_id_detail_summary_sku").val();
        const sku_kode = $("#filter_sku_kode_detail_summary_sku").text();
        const sku_nama_produk = $("#filter_sku_nama_produk_detail_summary_sku").text();
        const sku_satuan = $("#filter_sku_satuan_detail_summary_sku").text();
        const sku_kemasan = $("#filter_sku_kemasan_detail_summary_sku").text();
        const tahun = $("#AllotmentStockOrder-allotment_stock_order_tahun").val();
        const qty_max = qty;
        let total_qty_simulasi_mps_temp2 = 0;
        let qty_sisa = 0;

        $("#BackOrderSimulasiMps-sku_id").val(sku_id);
        $("#filter_sku_kode_back_order_simulasi_mps").html(sku_kode);
        $("#filter_sku_nama_produk_back_order_simulasi_mps").html(sku_nama_produk);
        $("#filter_sku_satuan_back_order_simulasi_mps").html(sku_satuan);
        $("#filter_sku_kemasan_back_order_simulasi_mps").html(sku_kemasan);
        $("#BackOrderSimulasiMps-qty_max").val(qty);

        $("#BackOrderSimulasiMps-bulan").val(bulan).trigger('change');
        $("#BackOrderSimulasiMps-tahun").val(tahun);
        $("#BackOrderSimulasiMps-qty").val(0);
        $("#BackOrderSimulasiMps-qty_sisa").val(0);

        // $.ajax({
        //     type: "POST",
        //     url: "<?= base_url('FAS/Schedule/AllotmentStockOrder/Get_list_back_order_simulasi_mps') ?>",
        //     data: {
        //         temp_id: $('#AllotmentStockOrder-allotment_stock_order_id').val(),
        //         tahun: $('#AllotmentStockOrder-allotment_stock_order_tahun').val(),
        //         bulan: bulan,
        //         sku_id: sku_id,
        //         arr_list_back_order: arr_list_back_order
        //     },
        //     dataType: "JSON",
        //     success: function(response) {

        //         $('#table_list_back_order_simulasi_mps').fadeOut("fast", function() {
        //             $(this).hide();

        //             $("#table_list_back_order_simulasi_mps > tbody").html('');
        //             $("#table_list_back_order_simulasi_mps > tbody").empty();

        //         }).fadeIn("fast", function() {
        //             $(this).show();

        //             if (response.length > 0) {

        //                 $.each(response, function(i, v) {

        //                     $("#table_list_back_order_simulasi_mps > tbody").append(`
        // 						<tr>
        // 							<td class="text-center" style="text-align: center; vertical-align: middle;">
        //                                 ${i+1}
        //                                 <input type="hidden" class="form-control" name="item-${i}-back_order_simulasi_mps-back_order_id" id="item-${i}-back_order_simulasi_mps-back_order_id" value="${v.back_order_id}" onclick="UpdateBackOrderSimulasiMPS('${i}')" />
        //                             </td>
        // 							<td class="text-center" style="text-align: center; vertical-align: middle;width:60%;">${v.back_order_kode}</td>
        // 							<td class="text-center" style="text-align: center; vertical-align: middle;">
        //                                 <input type="text" class="form-control" name="item-${i}-back_order_simulasi_mps-sku_qty" id="item-${i}-back_order_simulasi_mps-sku_qty" value="${v.sku_qty}" onclick="UpdateBackOrderSimulasiMPS('${i}')" />
        //                             </td>
        // 						</tr>
        // 					`);
        //                 });
        //             }
        //         });
        //     },
        //     error: function(xhr, ajaxOptions, thrownError) {
        //         message("Error", "Error 500 Internal Server Connection Failure", "error");
        //     }
        // })

    }

    function UpdateBackOrderSimulasiMPS(index, back_order_id, sku_id, tahun, bulan, sku_qty_bo, sku_qty_bo_sisa, sku_qty_asli) {
        const findIndexData = arr_list_back_order_simulasi.findIndex((value) => value.back_order_id == back_order_id && value.sku_id == sku_id && value.tahun == tahun && value.bulan == bulan);
        const sku_qty = isNaN(parseInt($("#item-" + index + "-back_order_simulasi_mps-sku_qty").val())) ? 0 : parseInt($("#item-" + index + "-back_order_simulasi_mps-sku_qty").val());
        const sku_qty_max = isNaN(parseInt($("#SimulasiMpsTemp2-qty").val())) ? 0 : parseInt($("#SimulasiMpsTemp2-qty").val());
        let total_sku_qty_per_bulan = 0;
        let qty_sisa_per_bulan = 9;

        if (arr_list_back_order_simulasi.length > 0) {
            $.each(arr_list_back_order_simulasi, function(i, v) {
                if (v.bulan == bulan && v.tahun == tahun && v.sku_id == sku_id && v.back_order_id != back_order_id) {
                    total_sku_qty_per_bulan += parseInt(v.sku_qty);
                }
            });
        }

        if (findIndexData > -1) {

            if (sku_qty > parseInt(sku_qty_bo)) {
                let alert = "Qty tidak boleh lebih besar dari Qty Plan";
                message("Error", alert, "error");

                $("#item-" + index + "-back_order_simulasi_mps-sku_qty").val(sku_qty_asli);

                arr_list_back_order_simulasi[findIndexData]['sku_qty'] = sku_qty_asli;

                qty_sisa_per_bulan = sku_qty_max - total_sku_qty_per_bulan - sku_qty_asli;

                $("#SimulasiMpsTemp2-qty_sisa_perbulan").val(qty_sisa_per_bulan);

            } else if (sku_qty > sku_qty_max - total_sku_qty_per_bulan) {
                let alert = "Qty tidak boleh lebih besar dari Qty Sisa Per Bulan";
                message("Error", alert, "error");

                $("#item-" + index + "-back_order_simulasi_mps-sku_qty").val(sku_qty_asli);

                arr_list_back_order_simulasi[findIndexData]['sku_qty'] = sku_qty_asli;

                qty_sisa_per_bulan = sku_qty_max - total_sku_qty_per_bulan - sku_qty_asli;

                $("#SimulasiMpsTemp2-qty_sisa_perbulan").val(qty_sisa_per_bulan);

            } else {

                arr_list_back_order_simulasi[findIndexData]['sku_qty'] = sku_qty;

                qty_sisa_per_bulan = sku_qty_max - total_sku_qty_per_bulan - sku_qty;

                $("#SimulasiMpsTemp2-qty_sisa_perbulan").val(qty_sisa_per_bulan);

            }
        }

        Get_list_back_order_simulasi_mps(bulan, sku_id);

    }

    function CekQtySisa() {
        const qty_max = isNaN(parseInt($("#SimulasiMpsTemp2-qty_max").val())) ? 0 : parseInt($("#SimulasiMpsTemp2-qty_max").val());
        let qty = isNaN(parseInt($("#SimulasiMpsTemp2-qty").val())) ? 0 : parseInt($("#SimulasiMpsTemp2-qty").val());
        let qty_sisa = isNaN(parseInt($("#SimulasiMpsTemp2-qty_sisa").val())) ? 0 : parseInt($("#SimulasiMpsTemp2-qty_sisa").val());
        let total_qty_simulasi_mps_temp2 = 0;
        let total_sku_qty_per_bulan = 0;
        let qty_sisa_per_bulan = 0;

        if (arr_list_karyawan_manager_simulasi.length > 0) {
            $.each(arr_list_karyawan_manager_simulasi, function(i, v) {
                if (v.bulan == $("#SimulasiMpsTemp2-bulan").val() && v.tahun == $("#SimulasiMpsTemp2-tahun").val() && v.sku_id == $("#SimulasiMpsTemp2-sku_id").val()) {
                    total_sku_qty_per_bulan += parseInt(v.sku_qty);
                }
            });
        }

        $.ajax({
            type: "GET",
            url: "<?= base_url('FAS/Schedule/AllotmentStockOrderSupervisor/Get_total_qty_simulasi_mps_temp2_not_in_bulan') ?>",
            data: {
                allotment_stock_order_id: $('#AllotmentStockOrder-allotment_stock_order_id').val(),
                tahun: $('#AllotmentStockOrder-allotment_stock_order_tahun').val(),
                bulan: $("#SimulasiMpsTemp2-bulan").val(),
                sku_id: $("#SimulasiMpsTemp2-sku_id").val(),
            },
            dataType: "JSON",
            success: function(response) {

                if (response.length > 0) {

                    $.each(response, function(i, v) {

                        total_qty_simulasi_mps_temp2 = v.qty;

                        qty_sisa = qty_max - total_qty_simulasi_mps_temp2 - qty;
                        $("#SimulasiMpsTemp2-qty_sisa").val(qty_sisa);

                        if (qty_sisa < 0) {
                            $("#SimulasiMpsTemp2-qty_sisa").addClass("text-danger");
                        } else {
                            $("#SimulasiMpsTemp2-qty_sisa").removeClass("text-danger");
                        }

                    })

                } else {
                    qty_sisa = qty_max - total_qty_simulasi_mps_temp2 - qty;
                    $("#SimulasiMpsTemp2-qty_sisa").val(qty_sisa);

                    if (qty_sisa < 0) {
                        $("#SimulasiMpsTemp2-qty_sisa").addClass("text-danger");
                    } else {
                        $("#SimulasiMpsTemp2-qty_sisa").removeClass("text-danger");
                    }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                qty_sisa = qty_max - total_qty_simulasi_mps_temp2 - qty;

                $("#SimulasiMpsTemp2-qty_sisa").val(qty_sisa);

                if (qty_sisa < 0) {
                    $("#SimulasiMpsTemp2-qty_sisa").addClass("text-danger");
                } else {
                    $("#SimulasiMpsTemp2-qty_sisa").removeClass("text-danger");
                }
            }
        });

        qty_sisa_per_bulan = qty - total_sku_qty_per_bulan;
        $("#SimulasiMpsTemp2-qty_sisa").val(qty_sisa_per_bulan);

    }

    function SaveSimulasiMpsTemp2() {
        const qty = isNaN(parseInt($("#SimulasiMpsTemp2-qty").val())) ? 0 : parseInt($("#SimulasiMpsTemp2-qty").val());
        const qty_sisa = isNaN(parseInt($("#SimulasiMpsTemp2-qty_sisa").val())) ? 0 : parseInt($("#SimulasiMpsTemp2-qty_sisa").val());

        if (qty_sisa >= 0) {
            console.log("insert_simulasi_mps_temp2 success");
            $("#modal_simulasi_mps_temp2").modal('hide');
            Get_proses_simulasi_mps();
        } else {
            let alert = "Tidak ada sisa qty";
            message("Error", alert, "error");
        }
    }
</script>