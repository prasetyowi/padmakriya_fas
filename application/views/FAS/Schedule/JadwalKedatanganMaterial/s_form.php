<script type="text/javascript">
    var arr_production_schedule_detail = [];
    var arr_production_schedule_detail2 = [];
    var idx_detail2 = 0;

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });

        run_input_mask_money();

        <?php if ($act == "edit" || $act == "detail") { ?>
            <?php foreach ($Detail2 as $value) : ?>
                arr_production_schedule_detail.push({
                    'sku_id': "<?= $value['sku_id'] ?>",
                    'sku_jumlah_barang': <?= $value['sku_jumlah_barang'] ?>,
                    'sku_harga': <?= $value['sku_harga'] ?>,
                    'sku_diskon_percent': <?= $value['sku_diskon_percent'] ?>,
                    'sku_diskon_rp': <?= $value['sku_diskon_rp'] ?>,
                    'sku_harga_total': <?= $value['sku_harga_total'] ?>,
                    'sku_exp_date': "<?= $value['sku_exp_date'] ?>",
                    'is_default_sku_exp_date': "0",
                    'is_error': "0"
                });
            <?php endforeach; ?>

            <?php foreach ($Detail3 as $key => $value) : ?>
                arr_production_schedule_detail2.push({
                    'idx': idx_detail2,
                    'sku_id': "<?= $value['sku_id'] ?>",
                    'bulan': "<?= $value['bulan'] ?>",
                    'tahun': "<?= $value['tahun'] ?>",
                    'qty': <?= $value['qty'] ?>
                });

                idx_detail2++;
            <?php endforeach; ?>

            setTimeout(() => {
                Get_list_production_schedule_detail();
                cek_disabled_header();
            }, 500);
        <?php } ?>
    });

    $('#check-all-pilih-sku').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="chk-data-sku[]"]:checkbox').each(function() {
                this.checked = true;

                var sku_id = this.getAttribute('data-sku_id');

                arr_production_schedule_detail.push({
                    'sku_id': sku_id,
                    'sku_jumlah_barang': 0,
                    'sku_harga': 0,
                    'sku_diskon_percent': 0,
                    'sku_diskon_rp': 0,
                    'sku_harga_total': 0,
                    'sku_exp_date': '',
                    'is_default_sku_exp_date': "0",
                    'is_error': "0"
                });
                // console.log(this.getAttribute('data-customer'));
            });
        } else {
            $('[name="chk-data-sku[]"]:checkbox').each(function() {
                this.checked = false;

                var sku_id = this.getAttribute('data-sku_id');

                const findIndexData = arr_production_schedule_detail.findIndex((value) => value.sku_id == sku_id);

                if (findIndexData > -1) {
                    arr_production_schedule_detail.splice(findIndexData, 1);
                }
            });
        }
    });

    $('#check-all-pilih-sku-back-order').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="chk-data-sku-back-order[]"]:checkbox').each(function() {
                this.checked = true;

                var sku_id = this.getAttribute('data-sku_id-back_order');
                var index = this.getAttribute('data-index-back_order');

                arr_production_schedule_detail.push({
                    'sku_id': sku_id,
                    'sku_jumlah_barang': $(`#item-${index}-sku_back_order-total_sku_qty`).val(),
                    'sku_harga': 0,
                    'sku_diskon_percent': 0,
                    'sku_diskon_rp': 0,
                    'sku_harga_total': 0,
                    'sku_exp_date': '',
                    'is_default_sku_exp_date': "0",
                    'is_error': "0"
                });

                for (var idx = 1; idx <= 12; idx++) {
                    arr_production_schedule_detail2.push({
                        'idx': idx_detail2,
                        'sku_id': sku_id,
                        'bulan': idx,
                        'tahun': $("#ProductionShedule-production_schedule_tahun").val(),
                        'qty': $(`#item-${index}-sku_back_order-sku_qty_${idx}`).val()
                    });

                    idx_detail2++;
                }
                // console.log(this.getAttribute('data-customer'));
            });
        } else {
            $('[name="chk-data-sku-back-order[]"]:checkbox').each(function() {
                this.checked = false;

                var sku_id = this.getAttribute('data-sku_id-back_order');

                const findIndexData = arr_production_schedule_detail.findIndex((value) => value.sku_id == sku_id);

                if (findIndexData > -1) {
                    arr_production_schedule_detail.splice(findIndexData, 1);
                }

                $.each(arr_production_schedule_detail2, function(i, v) {
                    const findIndexData2 = arr_production_schedule_detail2.findIndex((value) => value.sku_id == sku_id);
                    if (findIndexData2 > -1) {
                        arr_production_schedule_detail2.splice(findIndexData2, 1);
                    }
                });
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

    function ViewModalListDataPilihSKUBackOrder() {
        $(".modal-title-bo").html('Pilih SKU Principle - ' + $("#ProductionShedule-principle_id option:selected").text());
        $("#modal_list_data_pilih_sku_back_order").modal('show');
        Get_list_data_sku_back_order();
    }

    function ViewModalListDataPilihSKU() {
        $(".modal-title").html('Pilih SKU Principle - ' + $("#ProductionShedule-principle_id option:selected").text());
        $("#modal_list_data_pilih_sku").modal('show');
        Get_list_data_sku();
    }

    function Get_list_data_sku() {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/Get_list_data_sku') ?>",
            data: {
                principle_id: $("#ProductionShedule-principle_id").val(),
                detail: arr_production_schedule_detail
            },
            dataType: "JSON",
            success: function(response) {

                $('#table_list_data_pilih_sku').fadeOut("fast", function() {
                    $(this).hide();

                    $("#table_list_data_pilih_sku > tbody").html('');
                    $("#table_list_data_pilih_sku > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table_list_data_pilih_sku')) {
                        $('#table_list_data_pilih_sku').DataTable().clear();
                        $('#table_list_data_pilih_sku').DataTable().destroy();
                    }

                }).fadeIn("fast", function() {
                    $(this).show();

                    if (response.length > 0) {

                        $.each(response, function(i, v) {

                            $("#table_list_data_pilih_sku > tbody").append(`
								<tr>
									<td class="text-center" style="text-align: center; vertical-align: middle;">
                                        <input type="checkbox" class="form-control" name="chk-data-sku[]" style="transform: scale(0.8)" id="chk-item-${i}-sku" data-sku_id="${v.sku_id}" value="${v.sku_id}" onclick="AddListProductionScheduleDetail('${i}','${v.sku_id}','sku')"/>
                                    </td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_induk_nama}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kode}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_nama_produk}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kemasan}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_satuan}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.principle}</td>
									<td class="text-center" style="text-align: center; vertical-align: middle;">${v.brand}</td>
								</tr>
							`);
                        });
                    }

                    $('#table_list_data_pilih_sku').DataTable({
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

    function Get_list_data_sku_back_order() {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/Get_list_data_sku_back_order') ?>",
            data: {
                tahun: $("#ProductionShedule-production_schedule_tahun").val(),
                principle_id: $("#ProductionShedule-principle_id").val(),
                detail: arr_production_schedule_detail
            },
            dataType: "JSON",
            success: function(response) {

                $('#table_list_data_pilih_sku_back_order').fadeOut("fast", function() {
                    $(this).hide();

                    $("#table_list_data_pilih_sku_back_order > tbody").html('');
                    $("#table_list_data_pilih_sku_back_order > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table_list_data_pilih_sku_back_order')) {
                        $('#table_list_data_pilih_sku_back_order').DataTable().clear();
                        $('#table_list_data_pilih_sku_back_order').DataTable().destroy();
                    }

                }).fadeIn("fast", function() {
                    $(this).show();

                    if (response.length > 0) {

                        $.each(response, function(i, v) {

                            let strcol = "";
                            let total_sku_qty = 0;

                            strcol = `<tr>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <input type="checkbox" class="form-control" name="chk-data-sku-back-order[]" style="transform: scale(0.8)" id="chk-item-${i}-sku-back_order" data-sku_id-back_order="${v.sku_id}" data-index-back_order="${i}" value="${v.sku_id}" onclick="AddListProductionScheduleDetail('${i}','${v.sku_id}','back_order')"/>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_induk_nama}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kode}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_nama_produk}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kemasan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_satuan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.principle}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.brand}</td>`;

                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                total_sku_qty += parseInt(v.sku_qty_<?= $i ?>);
                                strcol += `<td class="text-center" style="text-align: right; vertical-align: middle;">
                                                <input type="hidden" id="item-${i}-sku_back_order-sku_qty_<?= $i ?>" name="item-${i}-sku_back_order-sku_qty_<?= $i ?>" value="${parseInt(v.sku_qty_<?= $i ?>)}">
                                                ${parseInt(v.sku_qty_<?= $i ?>)}
                                            </td>`
                            <?php } ?>

                            strcol += `<td class="text-center" style="text-align: right; vertical-align: middle;">
                                            <input type="hidden" id="item-${i}-sku_back_order-total_sku_qty" name="item-${i}-sku_back_order-sku_qty" value="${total_sku_qty}">
                                            ${total_sku_qty}
                                        </td>
                            </tr>`;

                            $("#table_list_data_pilih_sku_back_order > tbody").append(strcol);
                        });
                    }

                    $('#table_list_data_pilih_sku_back_order').DataTable({
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
            url: "<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/GetPrincipleByPerusahaan') ?>",
            data: {
                perusahaan: $("#ProductionShedule-client_wms_id").val()
            },
            dataType: "JSON",
            success: function(response) {

                $("#ProductionShedule-principle_id").html('');
                $("#ProductionShedule-principle_id").append(`<option value="">** <label name="CAPTION-PENYALURATAUPRINCIPLE">Penyalur / Principle</label> **</option>`);

                $.each(response, function(i, v) {
                    $("#ProductionShedule-principle_id").append(`<option value="${v.principle_id}">${v.principle_kode}</option>`);
                });

            }
        });
    }

    function AddListProductionScheduleDetail(index, sku_id, tipe) {

        if (tipe == "sku") {

            if ($("#chk-item-" + index + "-sku").is(":checked")) {

                arr_production_schedule_detail.push({
                    'sku_id': sku_id,
                    'sku_jumlah_barang': 0,
                    'sku_harga': 0,
                    'sku_diskon_percent': 0,
                    'sku_diskon_rp': 0,
                    'sku_harga_total': 0,
                    'sku_exp_date': '',
                    'is_default_sku_exp_date': "0",
                    'is_error': "0"
                });

                cek_disabled_header();

            } else {
                DeleteListProductionScheduleDetail(sku_id);
            }

        } else if (tipe == "back_order") {

            if ($("#chk-item-" + index + "-sku-back_order").is(":checked")) {

                arr_production_schedule_detail.push({
                    'sku_id': sku_id,
                    'sku_jumlah_barang': $(`#item-${index}-sku_back_order-total_sku_qty`).val(),
                    'sku_harga': 0,
                    'sku_diskon_percent': 0,
                    'sku_diskon_rp': 0,
                    'sku_harga_total': 0,
                    'sku_exp_date': '',
                    'is_default_sku_exp_date': "0",
                    'is_error': "0"
                });

                for (var idx = 1; idx <= 12; idx++) {
                    arr_production_schedule_detail2.push({
                        'idx': idx_detail2,
                        'sku_id': sku_id,
                        'bulan': idx,
                        'tahun': $("#ProductionShedule-production_schedule_tahun").val(),
                        'qty': $(`#item-${index}-sku_back_order-sku_qty_${idx}`).val()
                    });

                    idx_detail2++;
                }

                cek_disabled_header();

            } else {
                DeleteListProductionScheduleDetail(sku_id);
            }

        }

    }

    function AddListProductionScheduleDetail2() {

        for (var i = 1; i <= 12; i++) {

            arr_production_schedule_detail2.push({
                'idx': idx_detail2,
                'sku_id': $("#filter_sku_id_detail2").val(),
                'bulan': i,
                'tahun': $("#filter_tahun_detail2").val(),
                'qty': 0
            });

            idx_detail2++;

        }

        setTimeout(() => {
            Get_list_production_schedule_detail2();
            cek_disabled_header();
        }, 500);

    }

    function PilihSKU() {

        if (arr_production_schedule_detail.length == 0) {
            let alert = "Belum memilih SKU back order";
            message("Error", alert, "error");

            return false;
        }

        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah anda ingin menggunakan sku expired date default ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.value == true) {

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/set_sku_stock_exp_date_default') ?>",
                    data: {
                        detail: arr_production_schedule_detail
                    },
                    dataType: "JSON",
                    success: function(response) {
                        arr_production_schedule_detail = [];

                        if (response.length > 0) {
                            $.each(response, function(i, v) {
                                arr_production_schedule_detail.push({
                                    'sku_id': v.sku_id,
                                    'sku_jumlah_barang': parseInt(v.sku_jumlah_barang),
                                    'sku_harga': parseInt(v.sku_harga),
                                    'sku_diskon_percent': parseInt(v.sku_diskon_percent),
                                    'sku_diskon_rp': parseInt(v.sku_diskon_rp),
                                    'sku_harga_total': parseInt(v.sku_harga_total),
                                    'sku_exp_date': v.sku_exp_date,
                                    'is_default_sku_exp_date': v.is_default_sku_exp_date,
                                    'is_error': "0"
                                });
                            });

                            setTimeout(() => {

                                Get_list_production_schedule_detail();

                            }, 500);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        message("Error", "Error 500 Internal Server Connection Failure", "error");
                    },
                });

            } else {
                Get_list_production_schedule_detail();
            }

            $("#modal_list_data_pilih_sku").modal('hide');
        });
    }

    function PilihSKUBackOrder() {

        if (arr_production_schedule_detail.length == 0) {
            let alert = "Belum memilih SKU back order";
            message("Error", alert, "error");

            return false;
        }

        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah anda ingin menggunakan sku expired date default ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.value == true) {

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/set_sku_stock_exp_date_default') ?>",
                    data: {
                        detail: arr_production_schedule_detail
                    },
                    dataType: "JSON",
                    success: function(response) {
                        arr_production_schedule_detail = [];

                        if (response.length > 0) {
                            $.each(response, function(i, v) {
                                arr_production_schedule_detail.push({
                                    'sku_id': v.sku_id,
                                    'sku_jumlah_barang': parseInt(v.sku_jumlah_barang),
                                    'sku_harga': parseInt(v.sku_harga),
                                    'sku_diskon_percent': parseInt(v.sku_diskon_percent),
                                    'sku_diskon_rp': parseInt(v.sku_diskon_rp),
                                    'sku_harga_total': parseInt(v.sku_harga_total),
                                    'sku_exp_date': v.sku_exp_date,
                                    'is_default_sku_exp_date': v.is_default_sku_exp_date,
                                    'is_error': "0"
                                });
                            });

                            setTimeout(() => {

                                Get_list_production_schedule_detail();

                            }, 500);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        message("Error", "Error 500 Internal Server Connection Failure", "error");
                    },
                });

            } else {
                Get_list_production_schedule_detail();
            }

            $("#modal_list_data_pilih_sku_back_order").modal('hide');
        });
    }

    function PilihJadwal() {

        let cek_error = 0;
        let grand_total = 0;

        if (arr_production_schedule_detail2.length == 0) {
            var alert = "Jadwal belum ditambahkan";
            message_custom("Error", "error", alert);

            return false;
        }

        $.each(arr_production_schedule_detail2, function(i, v) {

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

                const findIndexData = arr_production_schedule_detail.findIndex((value) => value.sku_id == $("#filter_sku_id_detail2").val());

                if (findIndexData > -1) {
                    arr_production_schedule_detail[findIndexData]['is_error'] = "0";
                }

                setTimeout(() => {
                    Get_list_production_schedule_detail();
                }, 500);
            }
        }, 500);
    }

    function Get_list_production_schedule_detail() {
        var warna = "";

        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/set_list_production_schedule_detail') ?>",
            data: {
                detail: arr_production_schedule_detail,
                detail2: arr_production_schedule_detail2,
            },
            dataType: "JSON",
            success: function(response) {
                $('#table_production_schedule_detail').fadeOut("fast", function() {
                    $(this).hide();

                    $("#table_production_schedule_detail > tbody").html('');
                    $("#table_production_schedule_detail > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table_production_schedule_detail')) {
                        $('#table_production_schedule_detail').DataTable().clear();
                        $('#table_production_schedule_detail').DataTable().destroy();
                    }

                }).fadeIn("fast", function() {
                    $(this).show();

                    if (response.length > 0) {

                        $.each(response, function(i, v) {

                            if (v.is_error == "1" && v.is_cocok == "0") {
                                warna = "#F48484";
                            } else if (v.is_error == "0" && v.is_cocok == "0") {
                                warna = "#FFFDB5";
                            } else if (v.is_error == "0" && v.is_cocok == "1") {
                                warna = "#B6E2A1";
                            }

                            if (parseInt(v.sku_jumlah_barang) != 0) {
                                $("#table_production_schedule_detail > tbody").append(`
                                    <tr style="background:${warna}">
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kode}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_nama_produk}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kemasan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_satuan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <input type="date" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail-sku_exp_date" id="item-${i}-ProductionScheduleDetail-sku_exp_date" value="${v.sku_exp_date}" onchange="UpdateListProductionScheduleDetail('${i}','${v.sku_id}')"/>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <input type="text" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail-sku_jumlah_barang" id="item-${i}-ProductionScheduleDetail-sku_jumlah_barang" value="${v.sku_jumlah_barang}" onchange="UpdateListProductionScheduleDetail('${i}','${v.sku_id}')"/>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button type="button" class="btn_tambah_jadwal_sku" style="border:none;background:transparent" onclick="ViewModalProductionScheduleDetail2('${i}','${v.sku_id}','${v.sku_kode}','${v.sku_nama_produk}')"><i class="fas fa-plus text-primary" style="cursor: pointer"></i></button>
                                            <button type="button" class="btndeletesku" style="border:none;background:transparent" onclick="DeleteListProductionScheduleDetail('${v.sku_id}')"><i class="fas fa-trash text-danger" style="cursor: pointer"></i></button>
                                        </td>
                                    </tr>
                                `);
                            } else {
                                $("#table_production_schedule_detail > tbody").append(`
                                    <tr style="background:${warna}">
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kode}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_nama_produk}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_kemasan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">${v.sku_satuan}</td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <input type="date" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail-sku_exp_date" id="item-${i}-ProductionScheduleDetail-sku_exp_date" value="${v.sku_exp_date}" onchange="UpdateListProductionScheduleDetail('${i}','${v.sku_id}')"/>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <input type="text" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail-sku_jumlah_barang" id="item-${i}-ProductionScheduleDetail-sku_jumlah_barang" value="" placeholder="0" onchange="UpdateListProductionScheduleDetail('${i}','${v.sku_id}')"/>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <button type="button" class="btn_tambah_jadwal_sku" style="border:none;background:transparent" onclick="ViewModalProductionScheduleDetail2('${i}','${v.sku_id}','${v.sku_kode}','${v.sku_nama_produk}')"><i class="fas fa-plus text-primary" style="cursor: pointer"></i></button>
                                            <button type="button" class="btndeletesku" style="border:none;background:transparent" onclick="DeleteListProductionScheduleDetail('${v.sku_id}')"><i class="fas fa-trash text-danger" style="cursor: pointer"></i></button>
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

    function UpdateListProductionScheduleDetail(index, sku_id) {
        const findIndexData = arr_production_schedule_detail.findIndex((value) => value.sku_id == sku_id);
        const sku_harga_total = 0;

        if (findIndexData > -1) {

            arr_production_schedule_detail[findIndexData]['sku_jumlah_barang'] = parseInt($("#item-" + index + "-ProductionScheduleDetail-sku_jumlah_barang").val());
            arr_production_schedule_detail[findIndexData]['sku_exp_date'] = $("#item-" + index + "-ProductionScheduleDetail-sku_exp_date").val();
        }
    }

    function DeleteListProductionScheduleDetail(sku_id) {
        const findIndexData = arr_production_schedule_detail.findIndex((value) => value.sku_id == sku_id);

        if (findIndexData > -1) {
            arr_production_schedule_detail.splice(findIndexData, 1);
        }

        $.each(arr_production_schedule_detail2, function(i, v) {
            const findIndexData2 = arr_production_schedule_detail2.findIndex((value) => value.sku_id == sku_id);
            if (findIndexData2 > -1) {
                arr_production_schedule_detail2.splice(findIndexData2, 1);
            }

        });

        setTimeout(() => {
            Get_list_production_schedule_detail();
            cek_disabled_header();
        }, 500);

    }

    function ViewModalProductionScheduleDetail2(index, sku_id, sku_kode, sku_nama_produk) {
        const sku_jumlah_barang = $("#item-" + index + "-ProductionScheduleDetail-sku_jumlah_barang").val();

        $(".modal-title-detail").html('Pilih Jadwal SKU - ' + sku_kode + " - " + sku_nama_produk);
        $("#title_sku_jumlah_barang").html(sku_jumlah_barang);
        $("#modal_list_data_pilih_jadwal_sku").modal('show');

        $("#filter_sku_id_detail2").val(sku_id);
        $("#filter_sku_kode_detail2").val(sku_kode);
        $("#filter_sku_nama_produk_detail2").val(sku_nama_produk);
        $("#filter_sku_jumlah_barang_detail2").val(sku_jumlah_barang);

        $("#table_list_data_pilih_jadwal > tfoot").html('');
        $("#table_list_data_pilih_jadwal > tfoot").empty();

        $("#table_list_data_pilih_jadwal > tfoot").append(`
			<tr>
                <td colspan="3" class="bg-success text-center" style="font-weight: bold;">Grand Total : <span id="grand_total_schedule">0</span></td>
			</tr>
		`);

        setTimeout(() => {

            const findIndexData = arr_production_schedule_detail2.findIndex((value) => value.sku_id == sku_id);

            if (findIndexData == -1) {
                AddListProductionScheduleDetail2();
            } else {
                Get_list_production_schedule_detail2();
            }
        }, 500);
    }

    function Get_list_production_schedule_detail2() {

        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/set_list_production_schedule_detail2') ?>",
            data: {
                sku_id: $("#filter_sku_id_detail2").val(),
                detail: arr_production_schedule_detail2
            },
            dataType: "JSON",
            success: function(response) {
                $('#table_list_data_pilih_jadwal').fadeOut("fast", function() {
                    $(this).hide();

                    $("#table_list_data_pilih_jadwal > tbody").html('');
                    $("#table_list_data_pilih_jadwal > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table_list_data_pilih_jadwal')) {
                        $('#table_list_data_pilih_jadwal').DataTable().clear();
                        $('#table_list_data_pilih_jadwal').DataTable().destroy();
                    }

                }).fadeIn("fast", function() {
                    $(this).show();

                    if (response.length > 0) {

                        $.each(response, function(i, v) {

                            $("#filter_tahun_detail2").val(v.tahun);

                            if (parseInt(v.qty) > 0) {
                                $("#table_list_data_pilih_jadwal > tbody").append(`
                                    <tr>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            ${i+1}
                                            <input type="hidden" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail2-idx" id="item-${i}-ProductionScheduleDetail2-idx" value="${v.idx}" onchange="UpdateListProductionScheduleDetail2('${i}','${v.idx}')"/>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <select class="form-control select2" name="item-${i}-ProductionScheduleDetail2-bulan" id="item-${i}-ProductionScheduleDetail2-bulan" onchange="UpdateListProductionScheduleDetail2('${i}','${v.idx}')" disabled>
                                                <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                <?php foreach ($Bulan as $key => $value) : ?>
                                                    <option value="<?= $key ?>" ${v.bulan == "<?= $key ?>" ? 'selected' : ''}><?= $value ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <input type="text" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail2-qty" id="item-${i}-ProductionScheduleDetail2-qty" value="${v.qty}" onchange="UpdateListProductionScheduleDetail2('${i}','${v.idx}')"/>
                                        </td>
                                    </tr>
                                `);

                            } else {
                                $("#table_list_data_pilih_jadwal > tbody").append(`
                                    <tr>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            ${i+1}
                                            <input type="hidden" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail2-idx" id="item-${i}-ProductionScheduleDetail2-idx" value="${v.idx}" onchange="UpdateListProductionScheduleDetail2('${i}','${v.idx}')"/>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <select class="form-control select2" name="item-${i}-ProductionScheduleDetail2-bulan" id="item-${i}-ProductionScheduleDetail2-bulan" onchange="UpdateListProductionScheduleDetail2('${i}','${v.idx}')" disabled>
                                                <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                <?php foreach ($Bulan as $key => $value) : ?>
                                                    <option value="<?= $key ?>" ${v.bulan == "<?= $key ?>" ? 'selected' : ''}><?= $value ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <input type="text" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail2-qty" id="item-${i}-ProductionScheduleDetail2-qty" value="" placeholder="0" onchange="UpdateListProductionScheduleDetail2('${i}','${v.idx}')"/>
                                        </td>
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

        setTimeout(() => {
            HitungGrandTotalSchedule();
        }, 500);

    }

    function UpdateListProductionScheduleDetail2(index, idx) {
        const findIndexData = arr_production_schedule_detail2.findIndex((value) => value.idx == idx);

        if (findIndexData > -1) {

            // arr_production_schedule_detail2[findIndexData]['tahun'] = $("#item-" + index + "-ProductionScheduleDetail2-tahun").val();
            arr_production_schedule_detail2[findIndexData]['bulan'] = $("#item-" + index + "-ProductionScheduleDetail2-bulan").val();
            arr_production_schedule_detail2[findIndexData]['qty'] = parseInt($("#item-" + index + "-ProductionScheduleDetail2-qty").val());
        }

        HitungGrandTotalSchedule();
    }

    function UpdateTahunProductionScheduleDetail2() {
        $.each(arr_production_schedule_detail2, function(i, v) {
            const findIndexData = arr_production_schedule_detail2.findIndex((value) => value.idx == v.idx);

            if (findIndexData > -1) {

                arr_production_schedule_detail2[findIndexData]['tahun'] = $("#filter_tahun_detail2").val();
            }

        });
    }

    function DeleteListProductionScheduleDetail2(idx) {
        const findIndexData = arr_production_schedule_detail2.findIndex((value) => value.idx == idx);

        if (findIndexData > -1) {
            arr_production_schedule_detail2.splice(findIndexData, 1);
        }

        Get_list_production_schedule_detail2();
        HitungGrandTotalSchedule();
        cek_disabled_header();

    }

    function HitungGrandTotalSchedule() {
        let grand_total_schedule = 0;

        $.each(arr_production_schedule_detail2, function(i, v) {
            if (v.sku_id == $("#filter_sku_id_detail2").val()) {
                grand_total_schedule += parseInt(v.qty);
            }
        });

        $("#grand_total_schedule").html(grand_total_schedule);
    }

    function cek_disabled_header() {
        if (arr_production_schedule_detail.length > 0) {
            $("#ProductionShedule-client_wms_id").prop("disabled", true);
            $("#ProductionShedule-principle_id").prop("disabled", true);
            $("#ProductionShedule-production_schedule_tahun").prop("disabled", true);
        } else {
            $("#ProductionShedule-client_wms_id").prop("disabled", false);
            $("#ProductionShedule-principle_id").prop("disabled", false);
            $("#ProductionShedule-production_schedule_tahun").prop("disabled", false);
        }
    }

    function saveData() {

        let cek_error = 0;

        if ($("#ProductionShedule-client_wms_id").val() == "") {
            var alert = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
            message_custom("Error", "error", alert);
            return false;
        }

        if ($("#ProductionShedule-principle_id").val() == "") {
            var alert = GetLanguageByKode('CAPTION-ALERT-PRINCIPLETIDAKDIPILIH');
            message_custom("Error", "error", alert);
            return false;
        }

        if ($("#ProductionShedule-production_schedule_tgl").val() == "") {
            // var alert = GetLanguageByKode('CAPTION-ALERT-PRINCIPLETIDAKDIPILIH');
            var alert = "Tanggal kedatangan material belum diisi";
            message_custom("Error", "error", alert);
            return false;
        }

        if (arr_production_schedule_detail.length == 0) {
            var alert = "Daftar SKU tidak boleh kosong";
            // var alert = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
            message_custom("Error", "error", alert);
            return false;
        }

        if (arr_production_schedule_detail2.length == 0) {
            var alert = "Ada SKU yang belum memiliki jadwal kedatangan";
            // var alert = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
            message_custom("Error", "error", alert);
            return false;
        }

        $.each(arr_production_schedule_detail, function(i, v) {
            if (v.sku_exp_date == "") {
                // var alert = GetLanguageByKode('CAPTION-ALERT-PRINCIPLETIDAKDIPILIH');
                var alert = "Tanggal expired SKU belum diisi";
                message_custom("Error", "error", alert);
                cek_error++;
            }

            if (v.sku_jumlah_barang == "" || v.sku_jumlah_barang == 0) {
                // var alert = GetLanguageByKode('CAPTION-ALERT-PRINCIPLETIDAKDIPILIH');
                var alert = "SKU jumlah barang belum diisi";
                message_custom("Error", "error", alert);
                cek_error++;
            }

        });

        setTimeout(() => {

            if (cek_error == 0) {

                if ($("#ProductionShedule-production_schedule_id").val() != "") {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/update_production_schedule') ?>",
                        data: {
                            production_schedule_id: $('#ProductionShedule-production_schedule_id').val(),
                            depo_id: "",
                            principle_id: $('#ProductionShedule-principle_id').val(),
                            client_wms_id: $('#ProductionShedule-client_wms_id').val(),
                            production_schedule_kode: $('#ProductionShedule-production_schedule_kode').val(),
                            production_schedule_tgl: $('#ProductionShedule-production_schedule_tgl').val(),
                            production_schedule_tahun: $('#ProductionShedule-production_schedule_tahun').val(),
                            production_schedule_status: $('#ProductionShedule-production_schedule_status').val(),
                            production_schedule_keterangan: $('#ProductionShedule-production_schedule_keterangan').val(),
                            production_schedule_who_create: "",
                            production_schedule_tgl_create: "",
                            production_schedule_tgl_update: $('#ProductionShedule-production_schedule_tgl_update').val(),
                            production_schedule_who_update: $('#ProductionShedule-production_schedule_who_update').val(),
                            detail: arr_production_schedule_detail,
                            detail2: arr_production_schedule_detail2
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
                                    location.href = "<?= base_url() ?>FAS/Schedule/JadwalKedatanganMaterial/JadwalKedatanganMaterialMenu";
                                }, 1000);

                            } else if (response.kode == 2) {
                                messageNotSameLastUpdated();
                                return false;
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
                                            html: `Grand total dari SKU <strong>${response.sku_nama_produk}</strong> tidak sama dengan nilai maksimal jumlah barang`
                                        });

                                        const findIndexData = arr_production_schedule_detail.findIndex((value) => value.sku_id == response.sku_id);

                                        if (findIndexData > -1) {
                                            arr_production_schedule_detail[findIndexData]['is_error'] = "1";
                                        }
                                    });

                                    Swal.mixin({
                                        icon: 'error',
                                        confirmButtonText: 'Next &rarr;',
                                        showCancelButton: true,
                                        progressSteps: indexErrorEmptySku
                                    }).queue(arrayOfErrorsToDisplayEmptySku);

                                    setTimeout(() => {
                                        Get_list_production_schedule_detail();
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
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/insert_production_schedule') ?>",
                        data: {
                            production_schedule_id: $('#ProductionShedule-production_schedule_id').val(),
                            depo_id: "",
                            principle_id: $('#ProductionShedule-principle_id').val(),
                            client_wms_id: $('#ProductionShedule-client_wms_id').val(),
                            production_schedule_kode: $('#ProductionShedule-production_schedule_kode').val(),
                            production_schedule_tgl: $('#ProductionShedule-production_schedule_tgl').val(),
                            production_schedule_tahun: $('#ProductionShedule-production_schedule_tahun').val(),
                            production_schedule_status: $('#ProductionShedule-production_schedule_status').val(),
                            production_schedule_keterangan: $('#ProductionShedule-production_schedule_keterangan').val(),
                            production_schedule_who_create: "",
                            production_schedule_tgl_create: "",
                            production_schedule_tgl_update: $('#ProductionShedule-production_schedule_tgl_update').val(),
                            production_schedule_who_update: $('#ProductionShedule-production_schedule_who_update').val(),
                            detail: arr_production_schedule_detail,
                            detail2: arr_production_schedule_detail2
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
                                    location.href = "<?= base_url() ?>FAS/Schedule/JadwalKedatanganMaterial/JadwalKedatanganMaterialMenu";
                                }, 1000);

                            } else if (response.kode == 3) {
                                // var alert = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                var alert = "Dokumen jadwal kedatangan material <br>tahun " + $('#ProductionShedule-production_schedule_tahun').val() + ", perusahaan " + $('#ProductionShedule-client_wms_id option:selected').text() + ", principle " + $('#ProductionShedule-principle_id option:selected').text() + " <br>sudah ada";

                                message_custom("Error", "error", alert);

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
                                            html: `Grand total dari SKU <strong>${response.sku_nama_produk}</strong> tidak sama dengan nilai maksimal jumlah barang`
                                        });

                                        const findIndexData = arr_production_schedule_detail.findIndex((value) => value.sku_id == response.sku_id);

                                        if (findIndexData > -1) {
                                            arr_production_schedule_detail[findIndexData]['is_error'] = "1";
                                        }
                                    });

                                    Swal.mixin({
                                        icon: 'error',
                                        confirmButtonText: 'Next &rarr;',
                                        showCancelButton: true,
                                        progressSteps: indexErrorEmptySku
                                    }).queue(arrayOfErrorsToDisplayEmptySku);

                                    setTimeout(() => {
                                        Get_list_production_schedule_detail();
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
                }
            } else {
                return false;
            }

        }, 500);
    }
</script>