<script type="text/javascript">
    var jumlah_sku = 0;
    var layanan = "";
    let arr_sku = [];
    let arr_header = [];
    let arr_detail = [];
    var cek_qty = 0;
    var cek_tipe_stock = 0;
    var cek_tipe_sod = 0;
    var arr_sales_order = [];
    var arr_sales_order_detail = [];
    var sku_id = "85FBCEB7-0253-4030-8190-042BEF9BA247";
    var sku_expdate = "2022-06-30";
    var total_qty_SKU_ED = 0;
    var item_so_count = parseInt($("#item-count-SalesOrderDetail").val());
    var index_sku_ed = 0;
    var cek_total_arr_sales_order_detail = 0;

    $(document).ready(
        function() {
            $('.select2').select2();

            <?php if ($act == "edit") { ?>
                if (item_so_count > 0) {
                    for (var i = 0; i < item_so_count; i++) {
                        var randomId = generateRandomId(10);
                        var sku_id = $("#item-" + i + "-SalesOrderDetail-sku_id").val();

                        $(`#btn_delete_sku-${i}`).attr('onclick', `DeleteSKU(this,'${i}','${sku_id}', '${randomId}')`);

                        arr_sales_order_detail.push({
                            'client_wms_id': $("#item-" + i + "-SalesOrderDetail-client_wms_id").val(),
                            'client_wms_tax': $("#ppn_global_percent").val(),
                            'principle_id': $("#item-" + i + "-SalesOrderDetail-principle_id").val(),
                            'principle': $("#item-" + i + "-SalesOrderDetail-principle").val(),
                            'brand': $("#item-" + i + "-SalesOrderDetail-brand").val(),
                            'sku_id': $("#item-" + i + "-SalesOrderDetail-sku_id").val(),
                            'sku_kode': $("#item-" + i + "-SalesOrderDetail-sku_kode").val(),
                            'sku_nama_produk': $("#item-" + i + "-SalesOrderDetail-sku_nama_produk").val(),
                            // 'sku_harga_satuan': $("#item-" + i + "-SalesOrderDetail-sku_harga_satuan").val(),
                            'sku_harga_satuan': $("#input-item-" + i + "-SalesOrderDetail-sku_harga_satuan").val(),
                            // 'sku_disc_percent': $("#item-" + i + "-SalesOrderDetail-sku_disc_percent").val(),
                            'sku_disc_percent': $("#input-item-" + i + "-SalesOrderDetail-sku_disc_percent").val(),
                            // 'sku_disc_rp': $("#item-" + i + "-SalesOrderDetail-sku_disc_rp").val(),
                            'sku_disc_rp': $("#caption-" + i + "-SalesOrderDetail-sku_disc_rp").text(),
                            // 'sku_harga_nett': $("#item-" + i + "-SalesOrderDetail-sku_harga_nett").val(),
                            'sku_harga_nett': $("#caption-" + i + "-SalesOrderDetail-sku_harga_nett").text(),
                            'sku_weight': $("#item-" + i + "-SalesOrderDetail-sku_weight").val(),
                            'sku_weight_unit': $("#item-" + i + "-SalesOrderDetail-sku_weight_unit").val(),
                            'sku_length': $("#item-" + i + "-SalesOrderDetail-sku_length").val(),
                            'sku_length_unit': $("#item-" + i + "-SalesOrderDetail-sku_length_unit").val(),
                            'sku_width': $("#item-" + i + "-SalesOrderDetail-sku_width").val(),
                            'sku_width_unit': $("#item-" + i + "-SalesOrderDetail-sku_width_unit").val(),
                            'sku_height': $("#item-" + i + "-SalesOrderDetail-sku_height").val(),
                            'sku_height_unit': $("#item-" + i + "-SalesOrderDetail-sku_height_unit").val(),
                            'sku_volume': $("#item-" + i + "-SalesOrderDetail-sku_volume").val(),
                            'sku_volume_unit': $("#item-" + i + "-SalesOrderDetail-sku_volume_unit").val(),
                            'sku_qty': $("#item-" + i + "-SalesOrderDetail-sku_qty").val(),
                            'sku_keterangan': $("#item-" + i + "-SalesOrderDetail-sku_keterangan").val(),
                            'sku_request_expdate': $("#item-" + i + "-SalesOrderDetail-sku_request_expdate").val(),
                            'sku_filter_expdate': $("#item-" + i + "-SalesOrderDetail-sku_filter_expdate").val(),
                            'sku_filter_expdatebulan': $("#item-" + i + "-SalesOrderDetail-sku_filter_expdatebulan").val(),
                            'sku_satuan': $("#item-" + i + "-SalesOrderDetail-sku_satuan").val(),
                            'sku_kemasan': $("#item-" + i + "-SalesOrderDetail-sku_kemasan").val(),
                            'tipe_stock_nama': $("#item-" + i + "-SalesOrderDetail-tipe_stock_nama").val(),
                            'sku_ppn_percent': $("#input-item-" + i + "-SalesOrderDetail-ppn_percent").val(),
                            'sku_ppn_rp': $("#caption-" + i + "-SalesOrderDetail-ppn_rp").text(),
                            'random_id': randomId,
                            'sku_diskon_global_percent': $("#caption-" + i + "-SalesOrderDetail-sku_disc_global_percent").text(),
                            'sku_diskon_global_rp': $("#caption-" + i + "-SalesOrderDetail-sku_disc_global_rupiah").text(),
                            'sales_order_detail_tipe': $("#item-" + i + "-SalesOrderDetail-sales_order_detail_tipe").val(),
                        });

                        console.log(arr_sales_order_detail);

                    }
                }

                $('#table-sku-delivery-only').DataTable({
                    'info': false,
                    'paging': false,
                    'searching': false,
                    'pagination': false,
                    'ordering': false,
                    scrollX: true
                });

                HeaderReadonly();
            <?php } ?>

            <?php if ($act == "detail") { ?>

                $('#table-sku-delivery-only').DataTable({
                    'info': false,
                    'paging': false,
                    'searching': false,
                    'pagination': false,
                    'ordering': false,
                    scrollX: true
                });
                HeaderReadonly();
            <?php } ?>

            run_input_mask_money();
        });

    // function message(msg, msgtext, msgtype) {
    //     Swal.fire(msg, msgtext, msgtype);
    // }

    // function message_topright(type, msg) {
    //     const Toast = Swal.mixin({
    //         toast: true,
    //         position: "top-end",
    //         showConfirmButton: false,
    //         timer: 3000,
    //         didOpen: (toast) => {
    //             toast.addEventListener("mouseenter", Swal.stopTimer);
    //             toast.addEventListener("mouseleave", Swal.resumeTimer);
    //         },
    //     });

    //     Toast.fire({
    //         icon: type,
    //         title: msg,
    //     });
    // }

    $('#salesorder-so_is_need_approval').click(function(event) {
        if (this.checked) {
            $("#salesorder-sales_order_status").val("In Progress Approval");
        } else {
            $("#salesorder-sales_order_status").val("Draft");
        }
    });

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

        // if ($("#filter-area").val() != "") {
        $("#cek_customer").val(0);

        // $(".customer-name").html('');
        // $(".customer-address").html('');
        // $(".customer-area").html('');

        $("#salesorder-sales_order_kirim_nama").val('');
        $("#salesorder-sales_order_kirim_alamat").val('');
        $("#salesorder-sales_order_kirim_provinsi").val('');
        $("#salesorder-sales_order_kirim_kota").val('');
        $("#salesorder-sales_order_kirim_kecamatan").val('');
        $("#salesorder-sales_order_kirim_kelurahan").val('');
        $("#salesorder-sales_order_kirim_kodepos").val('');
        $("#salesorder-sales_order_kirim_telepon").val('');
        $("#salesorder-sales_order_kirim_area").val('');

        // $("#table-sku-delivery-only > tbody").empty();

        initDataCustomer();
        // reset_table_sku();
        // initDataSKU();

        // } else {
        //     var alert = GetLanguageByKode('CAPTION-PILIHAREA');
        //     message("Error!", alert, "error");
        // }
    }

    $("#btn-choose-customer").on("click", function() {
        getCustomer();
    });


    $("#btn-choose-prod-delivery").on("click", function() {
        Get_sales_order_by_top();
        initDataSKU();
    });

    $("#btn-search-sku").on("click", function() {
        initDataSKU();
    });

    $("#btn-search-customer").on("click", function() {
        getCustomer();
    });

    $("#salesorder-sales_id").on("change", function() {
        $("#cek_customer").val(0);

        $(".customer-name").html('');
        $(".customer-address").html('');
        $(".customer-area").html('');

        $("#salesorder-sales_order_kirim_nama").val('');
        $("#salesorder-sales_order_kirim_alamat").val('');
        $("#salesorder-sales_order_kirim_provinsi").val('');
        $("#salesorder-sales_order_kirim_kota").val('');
        $("#salesorder-sales_order_kirim_kecamatan").val('');
        $("#salesorder-sales_order_kirim_kelurahan").val('');
        $("#salesorder-sales_order_kirim_kodepos").val('');
        $("#salesorder-sales_order_kirim_telepon").val('');
        $("#salesorder-sales_order_kirim_area").val('');

        reset_table_customer();
        reset_table_sku();
    });

    function getPrinciple(value) {
        if (value == "") {
            $("#filter-principle").html('');
            $("#filter-principle").append(`
            <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
            `);
        } else {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/SalesOrderDropshipper/getPrinciple') ?>",
                data: {
                    perusahaanID: value
                },
                dataType: "JSON",
                success: function(response) {
                    if (response != 0) {
                        $("#filter-principle").html('');
                        $("#filter-principle").append(`
                        <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                        `);

                        $.each(response, function(i, v) {
                            $("#filter-principle").append(`
                            <option value="${v.principle_id}">${v.principle_nama}</option>
                            `);
                        });
                    } else {
                        $("#filter-principle").html('');
                        $("#filter-principle").append(`
                        <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                        `);
                    }
                }
            });
        }
    }

    function getPrincipleEdit(value) {
        if (value == "") {
            $("#filter-principle-edit").html('');
            $("#filter-principle-edit").append(`
            <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
            `);
        } else {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/SalesOrderDropshipper/getPrinciple') ?>",
                data: {
                    perusahaanID: value
                },
                dataType: "JSON",
                success: function(response) {
                    if (response != 0) {
                        $("#filter-principle-edit").html('');
                        $("#filter-principle-edit").append(`
                        <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                        `);

                        $.each(response, function(i, v) {
                            $("#filter-principle-edit").append(`
                            <option value="${v.principle_id}">${v.principle_nama}</option>
                            `);
                        });
                    } else {
                        $("#filter-principle-edit").html('');
                        $("#filter-principle-edit").append(`
                        <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                        `);
                    }
                }
            });
        }
    }

    function getSelectedCustomer(customer, sales) {

        $(".customer-name").html('');
        $(".customer-address").html('');
        $(".customer-area").html('');

        $("#salesorder-sales_order_kirim_nama").val('');
        $("#salesorder-sales_order_kirim_alamat").val('');
        $("#salesorder-sales_order_kirim_provinsi").val('');
        $("#salesorder-sales_order_kirim_kota").val('');
        $("#salesorder-sales_order_kirim_kecamatan").val('');
        $("#salesorder-sales_order_kirim_kelurahan").val('');
        $("#salesorder-sales_order_kirim_kodepos").val('');
        $("#salesorder-sales_order_kirim_telepon").val('');
        $("#salesorder-sales_order_kirim_area").val('');

        $("#modal-factory").modal('hide');
        $("#modal-customer").modal('hide');

        $("#cek_customer").val(0);

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/SalesOrderDropshipper/GetSelectedCustomer') ?>",
            data: {
                customer: customer,
                sales: sales
            },
            dataType: "JSON",
            success: function(response) {
                $('#panel-customer').fadeOut("slow", function() {
                    $(this).hide();
                }).fadeIn("slow", function() {
                    $.each(response, function(i, v) {
                        $(".customer-name").append(v.client_pt_nama);
                        $(".customer-address").append(v.client_pt_alamat);
                        $(".customer-area").append(v.area_nama);

                        $("#salesorder-client_pt_id").val(v.client_pt_id);
                        $("#salesorder-sales_order_kirim_nama").val(v.client_pt_nama);
                        $("#salesorder-sales_order_kirim_nama").val(v.client_pt_nama);
                        $("#salesorder-sales_order_kirim_alamat").val(v.client_pt_alamat);
                        $("#salesorder-sales_order_kirim_provinsi").val(v.client_pt_propinsi);
                        $("#salesorder-sales_order_kirim_kota").val(v.client_pt_kota);
                        $("#salesorder-sales_order_kirim_kecamatan").val(v.client_pt_kecamatan);
                        $("#salesorder-sales_order_kirim_kelurahan").val(v.client_pt_kelurahan);
                        $("#salesorder-sales_order_kirim_kodepos").val(v.client_pt_kodepos);
                        $("#salesorder-sales_order_kirim_telepon").val(v.client_pt_telepon);
                        $("#salesorder-sales_order_kirim_area").val(v.area_nama);

                    });

                    arr_sku = [];
                    // reset_table_sku();

                    if ($("#salesorder-client_pt_id").val() != "") {
                        $("#cek_customer").val(1);
                    }

                });
            }
        });

        Get_sales_order_by_top();
    }

    $(document).on("click", ".btn-choose-sku-multi", function() {
        var so_id = $("#so_id").val();
        var so_drop_id = $("#salesorder-sales_order_no_reff").val();
        var jumlah = $('input[name="CheckboxSKU"]').length;
        var numberOfChecked = $('input[name="CheckboxSKU"]:checked').length;
        var no = 1;
        jumlah_sku = numberOfChecked;

        arr_sku = [];

        if (numberOfChecked > 0) {
            for (var i = 0; i < jumlah; i++) {
                var checked = $('[id="check-sku-' + i + '"]:checked').length;
                var sku_id = "'" + $("#check-sku-" + i).val() + "'";

                if (checked > 0) {
                    arr_sku.push(sku_id);
                }
            }

            // $("#table-sku-delivery-only > tbody").empty();

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/SalesOrderDropshipper/GetSelectedSKU') ?>",
                data: {
                    so_id: so_id,
                    so_drop_id: so_drop_id,
                    sku_id: arr_sku,
                    arr_sales_order_detail: arr_sales_order_detail,
                    tgl_harga: $("#salesorder-back_order_tgl_harga").val()
                },
                dataType: "JSON",
                success: function(response) {
                    cek_total_arr_sales_order_detail = arr_sales_order_detail.length;
                    $.each(response, function(i, v) {
                        arr_sales_order_detail.push({
                            'client_wms_id': v.client_wms_id,
                            'client_wms_tax': v.client_wms_tax,
                            'principle_id': v.principle_id,
                            'principle': v.principle,
                            'brand': v.brand,
                            'sku_id': v.sku_id,
                            'sku_kode': v.sku_kode,
                            'sku_nama_produk': v.sku_nama_produk,
                            // 'sku_harga_satuan': v.sku_harga_jual,
                            'sku_harga_satuan': v.sku_nominal_harga,
                            'sku_disc_percent': 0,
                            'sku_disc_rp': 0,
                            'sku_harga_nett': v.sku_harga_jual,
                            'sku_weight': v.sku_weight,
                            'sku_weight_unit': v.sku_weight_unit,
                            'sku_length': v.sku_length,
                            'sku_length_unit': v.sku_length_unit,
                            'sku_width': v.sku_width,
                            'sku_width_unit': v.sku_width_unit,
                            'sku_height': v.sku_height,
                            'sku_height_unit': v.sku_height_unit,
                            'sku_volume': v.sku_volume,
                            'sku_volume_unit': v.sku_volume_unit,
                            'sku_qty': v.so_sku_qty,
                            'sku_qty_so': v.sku_qty_so,
                            'sku_qty_sisa': v.sku_qty_sisa,
                            'sku_keterangan': "",
                            'sku_request_expdate': "",
                            'sku_filter_expdate': "",
                            'sku_filter_expdatebulan': "",
                            'sku_satuan': v.sku_satuan,
                            'sku_kemasan': v.sku_kemasan,
                            'tipe_stock_nama': "",
                            'sku_ppn_percent': 0,
                            'sku_ppn_rp': 0,
                            'random_id': generateRandomId(10),
                            'sku_diskon_global_percent': 0,
                            'sku_diskon_global_rp': 0,
                            'sales_order_detail_tipe': v.sales_order_detail_tipe
                        });
                    });

                    pushToTableSKUDelivery();
                    <?php if ($act == "edit") { ?>
                        HeaderReadonly();
                    <?php } ?>
                }
            });

            $('#salesorder-client_wms_id').prop('disabled', true);
            $('#salesorder-principle_id').prop('disabled', true);

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Pilih SKU!'
            });
        }
    });

    function initDataCustomer() {
        var tipe_pembayaran = document.querySelector('input[id="salesorder-sales_order_tipe_pembayaran"]:checked').value;

        $("#panel-customer").show();

        // var perusahaan = $("#filter-perusahaan-customer").val();
        var perusahaan = $("#salesorder-client_wms_id").val();
        var sales = $("#salesorder-sales_id").val();
        var nama = $("#filter-client-name").val();
        var alamat = $("#filter-client-address").val();
        var telp = $("#filter-client-phone").val();
        var area = $("#filter-area").val();

        if (sales == "") {
            $("#modal-customer").modal('hide');
            message('Warning!', 'Pilih Sales!', 'error');
            return false;
        }

        if ($.fn.DataTable.isDataTable('#table-customer')) {
            $('#table-customer').DataTable().clear();
            $('#table-customer').DataTable().destroy();
        }

        console.log(area);

        $('#table-customer').DataTable({
            // "scrollX": true,
            'paging': true,
            'searching': true,
            'ordering': true,
            'order': [
                [0, 'asc']
            ],
            'lengthMenu': [
                [50, 100, 150, -1], // -1 untuk menunjukkan opsi "All"
                [50, 100, 150, "All"]
            ],
            'processing': true,
            'serverSide': true,
            // 'deferLoading': 0,
            'ajax': {
                url: "<?= base_url('FAS/SalesOrderDropshipper/GetCustomerByTypePelayanan') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    perusahaan: perusahaan,
                    sales: sales,
                    tipe_pembayaran: tipe_pembayaran,
                    nama: nama,
                    alamat: alamat,
                    telp: telp,
                    area: area
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading ...',
                        html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                        timerProgressBar: false,
                        showConfirmButton: false
                    });
                },
                complete: function() {
                    Swal.close();
                },
            },
            'columns': [{
                    render: function(data, type, row, meta) {
                        var i = meta.row;
                        var str = '';
                        str += `<input type="hidden" id="item-${i}-SalesOrder-client_pt_id" value="${row.client_pt_id}" />
                                <input type="hidden" id="item-${i}-SalesOrder-client_pt_propinsi" value="${row.client_pt_propinsi}" />
                                <input type="hidden" id="item-${i}-SalesOrder-client_pt_kota" value="${row.client_pt_kota}" />
                                <input type="hidden" id="item-${i}-SalesOrder-client_pt_kecamatan" value="${row.client_pt_kecamatan}" />
                                <input type="hidden" id="item-${i}-SalesOrder-client_pt_kelurahan" value="${row.client_pt_kelurahan}" />
                                <input type="hidden" id="item-${i}-SalesOrder-client_pt_kodepos" value="${row.client_pt_kodepos}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-area_id" value="${row.area_id}" />
                                <span class="client-pt-nama-label">${row.client_pt_nama}</span>
								<input type="hidden" id="item-${i}-SalesOrder-client_pt_nama" class="form-control client-pt-nama" value="${row.client_pt_nama}" />`

                        return str;
                    },
                    data: 'client_pt_nama'
                },
                {
                    render: function(data, type, row, meta) {
                        var i = meta.row;
                        var str = '';
                        str += `	<span class="client-pt-alamat-label">${row.client_pt_alamat}</span>
									<input type="hidden" id="item-${i}-SalesOrder-client_pt_alamat" class="form-control client-pt-alamat" value="${row.client_pt_alamat}" />`

                        return str;
                    },
                    data: 'client_pt_alamat'
                },
                {
                    render: function(data, type, row, meta) {
                        var i = meta.row;
                        var str = '';
                        str += `	<span class="client-pt-telepon-label">${row.client_pt_telepon}</span>
									<input type="hidden" id="item-${i}-SalesOrder-client_pt_telepon" class="form-control client-pt-telepon" value="${row.client_pt_telepon}" />`

                        return str;
                    },
                    data: 'client_pt_telepon'
                },
                {
                    render: function(data, type, row, meta) {
                        var str = '';
                        str += `<span class="area-nama-label">${row.area_nama}</span>
								<input type="hidden" id="item-${i}-SalesOrder-area_nama" class="form-control area-nama" value="${row.area_nama}" />`

                        return str;
                    },
                    data: 'area_nama'
                },
                {
                    render: function(data, type, row, meta) {
                        var str = '';
                        str += `<button class="btn btn-primary btn-small btn-select-customer" onclick="getSelectedCustomer('${row.client_pt_id}','${sales}')"><i class="fa fa-angle-down"></i></button>`

                        return str;
                    },
                    data: null
                },
            ],
            "columnDefs": [{
                    targets: 0,
                    className: 'text-center',

                },
                {
                    targets: 1,
                    className: 'text-center'
                },
                {
                    targets: 2,
                    className: 'text-center'
                },
                {
                    targets: 3,
                    className: 'text-center'
                },
                {
                    targets: 4,
                    className: 'text-center',
                    searchable: false
                },
            ],
            initComplete: function() {
                parent_dt = $('#table-customer').closest('.dataTables_wrapper')
                parent_dt.find('.dataTables_filter').css('width', 'auto')
                var input = parent_dt.find('.dataTables_filter input').unbind(),
                    self = this.api(),
                    $searchButton = $('<button class="btn btn-flat btn-success btn-sm mb-0 mr-0 ml-5 btn-search-dt">')
                    .html('<i class="fa fa-fw fa-search">')
                    .click(function() {
                        self.search(input.val()).draw();
                    }),
                    $clearButton = $('<button class="btn btn-flat btn-warning btn-sm mb-0 mr-0 ml-5 btn-reset-dt">')
                    .html('<i class="fa fa-fw fa-recycle">')
                    .click(function() {
                        input.val('');
                        $searchButton.click();

                    })
                parent_dt.find('.dataTables_filter').append($searchButton, $clearButton);
                parent_dt.find('.dataTables_filter input').keypress(function(e) {
                    var key = e.which;
                    if (key == 13) {
                        $searchButton.click();
                        return false;
                    }
                });
            },
        });
    }

    function initDataSKU() {
        // var perusahaan = $("#filter-perusahaan-sku").val();
        var sales_order_id = $("#salesorder-sales_order_no_reff").val();
        var perusahaan = $("#salesorder-client_wms_id").val();
        var sales = $("#salesorder-sales_id").val();
        var client_pt = $("#salesorder-client_pt_id").val();
        var tipe_pembayaran = document.querySelector('input[id="salesorder-sales_order_tipe_pembayaran"]:checked').value;
        var sku_induk = $("#filter-sku-induk").val();
        var sku_nama_produk = $("#filter-sku-nama-produk").val();
        var sku_kemasan = $("#filter-sku-kemasan").val();
        var sku_satuan = $("#filter-sku-satuan").val();
        var principle = $("#salesorder-principle_id").val();
        // var principle = $("#filter-principle").val();
        var brand = $("#filter-brand").val();

        if (perusahaan == "") {
            message("Error", "Perusahaan belum dipilih", "error");
            return false;
        }

        if ($("#salesorder-tipe_sales_order_id").val() != "") {

            if ($("#salesorder-tipe_sales_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/SalesOrderDropshipper/search_filter_chosen_sku') ?>",
                    data: {
                        perusahaan: perusahaan,
                        sales: sales,
                        client_pt: client_pt,
                        tipe_pembayaran: tipe_pembayaran,
                        brand: brand,
                        principle: principle,
                        sku_induk: sku_induk,
                        sku_nama_produk: sku_nama_produk,
                        sku_kemasan: sku_kemasan,
                        sku_satuan: sku_satuan,
                        sales_order_id: sales_order_id
                    },
                    dataType: "JSON",
                    beforeSend: function() {

                        Swal.fire({
                            title: 'Loading ...',
                            html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                            timerProgressBar: false,
                            showConfirmButton: false
                        });
                    },
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
                                    <td width="15%" class="text-center">${v.client_wms_nama}</td>
                                    <td class="text-center">${v.sku_kode}</td>
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
                                "searching": false,
                                columnDefs: [{
                                    sortable: false,
                                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }],
                                lengthMenu: [
                                    [-1],
                                    ['All']
                                ],
                            });
                        } else {
                            $("#table-sku > tbody").html(
                                `<tr><td colspan="9" class="text-center text-danger">Data Kosong</td></tr>`);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        message("Error", "Error 500 Internal Server Connection Failure", "error");
                    },
                    complete: function() {
                        Swal.close();
                    }
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/SalesOrderDropshipper/search_filter_chosen_sku') ?>",
                    data: {
                        perusahaan: perusahaan,
                        sales: sales,
                        client_pt: client_pt,
                        tipe_pembayaran: tipe_pembayaran,
                        brand: brand,
                        principle: principle,
                        sku_induk: sku_induk,
                        sku_nama_produk: sku_nama_produk,
                        sku_kemasan: sku_kemasan,
                        sku_satuan: sku_satuan,
                        sales_order_id: sales_order_id,
                        arr_sales_order_detail: arr_sales_order_detail
                    },
                    dataType: "JSON",
                    beforeSend: function() {

                        Swal.fire({
                            title: 'Loading ...',
                            html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                            timerProgressBar: false,
                            showConfirmButton: false
                        });
                    },
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
                                    <td width="15%" class="text-center">${v.client_wms_nama}</td>
                                    <td class="text-center">${v.sku_kode}</td>
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
                                "searching": false,
                                columnDefs: [{
                                    sortable: false,
                                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }],
                                lengthMenu: [
                                    [-1],
                                    ['All']
                                ],
                            });
                        } else {
                            $("#table-sku > tbody").html(
                                `<tr><td colspan="9" class="text-center text-danger">Data Kosong</td></tr>`);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        message("Error", "Error 500 Internal Server Connection Failure", "error");
                    },
                    complete: function() {
                        Swal.close();
                    }
                });
            }

        } else {
            message("Pilih Tipe SO!", "Tipe Sales order belum dipilih", "error");
        }

    }

    $("#btnsaveso").on("click", function() {
        var cek_customer = $("#cek_customer").val();
        var tipe_so = $("#salesorder-tipe_sales_order_id").val();
        var tipe_do = $("#salesorder-tipe_delivery_order_id").val();
        var x = 0;
        arr_header = [];
        arr_detail = [];
        // console.log(arr_so_detail2_ed);
        $.each(arr_detail, function(i2, v2) {
            $('#row-' + i2).css('background', '');
            $('#row-' + i2).css('color', '');
        });
        for (var index = 0; index < arr_sales_order_detail.length; index++) {
            if (arr_sales_order_detail[index] != "") {
                arr_detail.push({
                    'client_wms_id': $("#item-" + index + "-SalesOrderDetail-client_wms_id").val(),
                    'sku_id': $("#item-" + index + "-SalesOrderDetail-sku_id").val(),
                    'sku_kode': $("#item-" + index + "-SalesOrderDetail-sku_kode").val(),
                    'sku_nama_produk': $("#item-" + index + "-SalesOrderDetail-sku_nama_produk").val(),
                    'sku_harga_satuan': $("#input-item-" + index + "-SalesOrderDetail-sku_harga_satuan").val().replaceAll(".", ""),
                    // 'sku_disc_percent': $("#item-" + index + "-SalesOrderDetail-sku_disc_percent").val(),
                    'sku_disc_percent': $("#input-item-" + index + "-SalesOrderDetail-sku_disc_percent").val(),
                    // 'sku_disc_rp': $("#item-" + index + "-SalesOrderDetail-sku_disc_rp").val(),
                    'sku_disc_rp': $("#caption-" + index + "-SalesOrderDetail-sku_disc_rp").text().replaceAll(".", ""),
                    // 'sku_harga_nett': $("#item-" + index + "-SalesOrderDetail-sku_harga_nett").val(),
                    'sku_harga_nett': $("#caption-" + index + "-SalesOrderDetail-sku_harga_nett").text().replaceAll(".", ""),
                    'sku_weight': $("#item-" + index + "-SalesOrderDetail-sku_weight").val(),
                    'sku_weight_unit': $("#item-" + index + "-SalesOrderDetail-sku_weight_unit").val(),
                    'sku_length': $("#item-" + index + "-SalesOrderDetail-sku_length").val(),
                    'sku_length_unit': $("#item-" + index + "-SalesOrderDetail-sku_length_unit").val(),
                    'sku_width': $("#item-" + index + "-SalesOrderDetail-sku_width").val(),
                    'sku_width_unit': $("#item-" + index + "-SalesOrderDetail-sku_width_unit").val(),
                    'sku_height': $("#item-" + index + "-SalesOrderDetail-sku_height").val(),
                    'sku_height_unit': $("#item-" + index + "-SalesOrderDetail-sku_height_unit").val(),
                    'sku_volume': $("#item-" + index + "-SalesOrderDetail-sku_volume").val(),
                    'sku_volume_unit': $("#item-" + index + "-SalesOrderDetail-sku_volume_unit").val(),
                    'sku_qty': $("#item-" + index + "-SalesOrderDetail-sku_qty").val().replaceAll(".", ""),
                    'sku_keterangan': $("#item-" + index + "-SalesOrderDetail-sku_keterangan").val(),
                    'sku_request_expdate': $("#item-" + index + "-SalesOrderDetail-sku_request_expdate").val(),
                    'sku_filter_expdate': $("#item-" + index + "-SalesOrderDetail-sku_filter_expdate").val(),
                    'sku_filter_expdatebulan': $("#item-" + index + "-SalesOrderDetail-sku_filter_expdatebulan").val(),
                    'sku_satuan': $("#item-" + index + "-SalesOrderDetail-sku_satuan").val(),
                    'sku_kemasan': $("#item-" + index + "-SalesOrderDetail-sku_kemasan").val(),
                    'tipe_stock_nama': $("#item-" + index + "-SalesOrderDetail-tipe_stock_nama").val(),
                    'sku_ppn_percent': $("#input-item-" + index + "-SalesOrderDetail-ppn_percent").val(),
                    'sku_ppn_rp': $("#caption-" + index + "-SalesOrderDetail-ppn_rp").text().replaceAll(".", ""),
                    'sku_diskon_global_percent': $("#caption-" + index + "-SalesOrderDetail-sku_disc_global_percent").text(),
                    'sku_diskon_global_rp': $("#caption-" + index + "-SalesOrderDetail-sku_disc_global_rupiah").text().replaceAll(".", ""),
                    'sales_order_detail_tipe': $("#item-" + index + "-SalesOrderDetail-sales_order_detail_tipe").val(),
                });
            }
        }

        if (tipe_so == "") {
            message("Pilih Tipe SO!", "Tipe Sales order belum dipilih", "error");
            return false;
        }

        if (tipe_do == "") {
            message("Pilih Tipe DO!", "Tipe Delivery order belum dipilih", "error");
            return false;
        }

        if (cek_customer == "0" || cek_customer == 0) {
            message("Pilih Customer!", "Customer belum dipilih", "error");
            return false;
        }

        if (arr_detail.length == 0) {
            message("Pilih SKU!", "SKU belum dipilih", "error");
            return false;
        }

        $("#table-sku-delivery-only > tbody tr").each(function() {
            var is_Qty = 0;
            var is_tipe = 0;

            if ($("#salesorder-tipe_sales_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                // is_Qty = $(this).find("td:eq(7)").text();
                is_Qty = $(this).find("td:eq(8) input").val();
                is_tipe = $(this).find("td:eq(6) input").val();
            } else {
                is_Qty = $(this).find("td:eq(8) input").val();
                is_tipe = $(this).find("td:eq(6) input").val();
            }

            if (is_tipe == "") {
                cek_tipe_sod++;
            }

            // console.log(is_Qty);
            if (is_Qty == 0) {
                cek_qty++;
            }
        });

        $("#table-sku-delivery-only > tbody tr").each(function() {
            var is_tipe_stock = $("#item-" + x + "-SalesOrderDetail-tipe_stock_nama").val();
            // console.log(is_tipe_stock);
            if (is_tipe_stock == "") {
                cek_tipe_stock++;
            }
            x++;
        });

        setTimeout(() => {

            if (cek_qty > 0) {
                cek_qty = 0;
                message("Error!", "Qty tidak boleh 0", "error");
                return false;
            }

            if (cek_tipe_sod > 0) {
                cek_tipe_sod = 0;
                message("Error!", "Tipe sales Order detail tidak boleh kosong", "error");
                return false;
            }

            if (cek_tipe_stock > 0) {
                cek_tipe_stock = 0;
                message("Error!", "Tipe stock tidak boleh kosong!", "error");
                return false;
            }

            setTimeout(() => {

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
                            async: false,
                            url: "<?= base_url('FAS/SalesOrderDropshipper/insert_sales_order'); ?>",
                            type: "POST",
                            data: {
                                sales_order_id: "",
                                depo_id: "<?= $this->session->userdata('depo_id') ?>",
                                sales_order_kode: "",
                                client_wms_id: $("#salesorder-client_wms_id").val(),
                                sales_order_no_reff: $("#salesorder-sales_order_no_reff").val(),
                                // client_wms_id: "",
                                // channel_id: $("#salesorder-channel_id").val(),
                                channel_id: "",
                                sales_order_is_handheld: 0,
                                sales_order_status: $("#salesorder-sales_order_status").val(),
                                sales_order_approved_by: "",
                                sales_id: $("#salesorder-sales_id").val(),
                                client_pt_id: $("#salesorder-client_pt_id").val(),
                                sales_order_tgl: $("#salesorder-sales_order_tgl").val(),
                                sales_order_tgl_exp: $("#salesorder-sales_order_tgl_exp").val(),
                                sales_order_tgl_harga: $("#salesorder-sales_order_tgl_harga").val(),
                                sales_order_tgl_sj: $("#salesorder-sales_order_tgl_sj").val(),
                                sales_order_tgl_kirim: $("#salesorder-sales_order_tgl_kirim").val(),
                                sales_order_tipe_pembayaran: document.querySelector('input[id="salesorder-sales_order_tipe_pembayaran"]:checked').value,
                                tipe_sales_order_id: $("#salesorder-tipe_sales_order_id").val(),
                                sales_order_no_po: $("#salesorder-sales_order_no_po").val(),
                                sales_order_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                                sales_order_tgl_create: "",
                                sales_order_is_downloaded: 0,
                                so_is_need_approval: $("#salesorder-so_is_need_approval:checked").val(),
                                tipe_delivery_order_id: $("#salesorder-tipe_delivery_order_id").val(),
                                sales_order_is_uploaded: 0,
                                principle_id: $("#salesorder-principle_id").val(),
                                total_diskon_item: $("#total_diskon_item").val().replaceAll(".", ""),
                                total_global: $("#total_rp").val().replaceAll(".", ""),
                                diskon_global_percent: $("#diskon_global_percent").val(),
                                diskon_global_rp: $("#diskon_global_rp").val().replaceAll(".", ""),
                                dasar_kena_pajak: $("#dasar_kena_pajak").val().replaceAll(".", ""),
                                ppn_global_percent: $("#ppn_global_percent").val(),
                                ppn_global_rp: $("#ppn_global_rp").val().replaceAll(".", ""),
                                adjustment: $("#adjustment").val().replaceAll(".", ""),
                                total_faktur: $("#total_faktur").val().replaceAll(".", ""),
                                // sales_order_no_reff: $("#filter-delivery_order_id option:selected").text(),
                                detail: arr_detail,
                                tipe_ppn: $("#backorder-back_order_tipe_ppn:checked").val(),
                                keterangan: $("#keterangan_detail").val()
                            },
                            dataType: "JSON",
                            beforeSend: function() {

                                Swal.fire({
                                    title: 'Loading ...',
                                    html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                                    timerProgressBar: false,
                                    showConfirmButton: false
                                });
                            },
                            success: function(response) {
                                if (response.kode == "200") {
                                    message_topright("success", "Data berhasil disimpan");
                                    setTimeout(() => {
                                        location.href = "<?= base_url(); ?>FAS/SalesOrderDropshipper/SalesOrderDropshipperMenu";
                                    }, 500);
                                } else if (response.kode == "400") {
                                    let arrayOfErrorsToDisplay = [];
                                    let indexError = [];
                                    indexError = 0;
                                    $.each(response.data, function(i, v) {
                                        arrayOfErrorsToDisplay.push({
                                            title: 'Data Gagal Disimpan!',
                                            html: `Jumlah sku <strong>${v.sku_kode} ${v.sku_nama_produk}</strong> melebihi jumlah sku sales order utama`
                                        });

                                        $.each(arr_detail, function(i2, v2) {
                                            if (v.sku_id == v2.sku_id) {
                                                $('#row-' + i2).css('background', 'red');
                                                $('#row-' + i2).css('color', 'white');
                                            }
                                        });
                                    });
                                    Swal.mixin({
                                        icon: 'error',
                                        confirmButtonText: 'Next &rarr;',
                                        showCancelButton: true,
                                        progressSteps: indexError
                                    }).queue(arrayOfErrorsToDisplay)
                                } else {
                                    message_topright("error", "Data gagal disimpan");
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                message("Error", "Error 500 Internal Server Connection Failure", "error");
                            },
                            complete: function() {
                                // Swal.close();
                            }
                        });
                    }
                });

            }, 500);

        }, 500);
    });

    $("#btnupdateso").on("click", function() {
        var so_id = $("#so_id").val();
        var cek_customer = $("#cek_customer").val();
        var tipe_so = $("#salesorder-tipe_sales_order_id").val();
        var tipe_do = $("#salesorder-tipe_delivery_order_id").val();
        var x = 0;
        arr_header = [];
        arr_detail = [];
        $.each(arr_detail, function(i2, v2) {
            $('#row-' + i2).css('background', '');
            $('#row-' + i2).css('color', '');
        });
        for (var index = 0; index < arr_sales_order_detail.length; index++) {
            if (arr_sales_order_detail[index] != "") {
                arr_detail.push({
                    'client_wms_id': $("#item-" + index + "-SalesOrderDetail-client_wms_id").val(),
                    'sku_id': $("#item-" + index + "-SalesOrderDetail-sku_id").val(),
                    'sku_kode': $("#item-" + index + "-SalesOrderDetail-sku_kode").val(),
                    'sku_nama_produk': $("#item-" + index + "-SalesOrderDetail-sku_nama_produk").val(),
                    'sku_harga_satuan': $("#input-item-" + index + "-SalesOrderDetail-sku_harga_satuan").val().replaceAll(".", ""),
                    // 'sku_disc_percent': $("#item-" + index + "-SalesOrderDetail-sku_disc_percent").val(),
                    'sku_disc_percent': $("#input-item-" + index + "-SalesOrderDetail-sku_disc_percent").val(),
                    // 'sku_disc_rp': $("#item-" + index + "-SalesOrderDetail-sku_disc_rp").val(),
                    'sku_disc_rp': $("#caption-" + index + "-SalesOrderDetail-sku_disc_rp").text().replaceAll(".", ""),
                    // 'sku_harga_nett': $("#item-" + index + "-SalesOrderDetail-sku_harga_nett").val(),
                    'sku_harga_nett': $("#caption-" + index + "-SalesOrderDetail-sku_harga_nett").text().replaceAll(".", ""),
                    'sku_weight': $("#item-" + index + "-SalesOrderDetail-sku_weight").val(),
                    'sku_weight_unit': $("#item-" + index + "-SalesOrderDetail-sku_weight_unit").val(),
                    'sku_length': $("#item-" + index + "-SalesOrderDetail-sku_length").val(),
                    'sku_length_unit': $("#item-" + index + "-SalesOrderDetail-sku_length_unit").val(),
                    'sku_width': $("#item-" + index + "-SalesOrderDetail-sku_width").val(),
                    'sku_width_unit': $("#item-" + index + "-SalesOrderDetail-sku_width_unit").val(),
                    'sku_height': $("#item-" + index + "-SalesOrderDetail-sku_height").val(),
                    'sku_height_unit': $("#item-" + index + "-SalesOrderDetail-sku_height_unit").val(),
                    'sku_volume': $("#item-" + index + "-SalesOrderDetail-sku_volume").val(),
                    'sku_volume_unit': $("#item-" + index + "-SalesOrderDetail-sku_volume_unit").val(),
                    'sku_qty': $("#item-" + index + "-SalesOrderDetail-sku_qty").val().replaceAll(".", ""),
                    'sku_keterangan': $("#item-" + index + "-SalesOrderDetail-sku_keterangan").val(),
                    'sku_request_expdate': $("#item-" + index + "-SalesOrderDetail-sku_request_expdate").val(),
                    'sku_filter_expdate': $("#item-" + index + "-SalesOrderDetail-sku_filter_expdate").val(),
                    'sku_filter_expdatebulan': $("#item-" + index + "-SalesOrderDetail-sku_filter_expdatebulan").val(),
                    'sku_satuan': $("#item-" + index + "-SalesOrderDetail-sku_satuan").val(),
                    'sku_kemasan': $("#item-" + index + "-SalesOrderDetail-sku_kemasan").val(),
                    'tipe_stock_nama': $("#item-" + index + "-SalesOrderDetail-tipe_stock_nama").val(),
                    'sku_ppn_percent': $("#input-item-" + index + "-SalesOrderDetail-ppn_percent").val(),
                    'sku_ppn_rp': $("#caption-" + index + "-SalesOrderDetail-ppn_rp").text().replaceAll(".", ""),
                    'sku_diskon_global_percent': $("#caption-" + index + "-SalesOrderDetail-sku_disc_global_percent").text(),
                    'sku_diskon_global_rp': $("#caption-" + index + "-SalesOrderDetail-sku_disc_global_rupiah").text().replaceAll(".", ""),
                    'sales_order_detail_tipe': $("#item-" + index + "-SalesOrderDetail-sales_order_detail_tipe").val(),
                });
            }
        }

        if (tipe_so == "") {
            message("Pilih Tipe SO!", "Tipe Sales order belum dipilih", "error");
            return false;
        }

        if (tipe_do == "") {
            message("Pilih Tipe DO!", "Tipe Delivery order belum dipilih", "error");
            return false;
        }

        if (cek_customer == "0" || cek_customer == 0) {
            message("Pilih Customer!", "Customer belum dipilih", "error");
            return false;
        }

        if (arr_detail.length == 0) {
            message("Pilih SKU!", "SKU belum dipilih", "error");
            return false;
        }

        $("#table-sku-delivery-only > tbody tr").each(function() {
            var is_Qty = 0;
            var is_tipe = 0;

            if ($("#salesorder-tipe_sales_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                // is_Qty = $(this).find("td:eq(7)").text();
                is_Qty = $(this).find("td:eq(8) input").val();
                is_tipe = $(this).find("td:eq(6) input").val();
            } else {
                is_Qty = $(this).find("td:eq(8) input").val();
                is_tipe = $(this).find("td:eq(6) input").val();
            }

            if (is_tipe == "") {
                cek_tipe_sod++;
            }

            // console.log(is_Qty);
            if (is_Qty == 0) {
                cek_qty++;
            }
        });

        $("#table-sku-delivery-only > tbody tr").each(function() {
            var is_tipe_stock = $("#item-" + x + "-SalesOrderDetail-tipe_stock_nama").val();
            // console.log(is_tipe_stock);
            if (is_tipe_stock == "") {
                cek_tipe_stock++;
            }
            x++;
        });

        setTimeout(() => {

            if (cek_qty > 0) {
                cek_qty = 0;
                message("Error!", "Qty tidak boleh 0", "error");
                return false;
            }

            if (cek_tipe_sod > 0) {
                cek_tipe_sod = 0;
                message("Error!", "Tipe sales Order detail tidak boleh kosong", "error");
                return false;
            }

            if (cek_tipe_stock > 0) {
                cek_tipe_stock = 0;
                message("Error!", "Tipe stock tidak boleh kosong!", "error");
                return false;
            }

            setTimeout(() => {

                messageBoxBeforeRequest('Pastikan data yang sudah anda input benar!', 'Iya, Simpan', 'Tidak, Tutup').then((result) => {
                    if (result.value == true) {

                        requestAjax("<?= base_url('FAS/SalesOrderDropshipper/update_sales_order'); ?>", {
                            sales_order_id: so_id,
                            depo_id: "<?= $this->session->userdata('depo_id') ?>",
                            sales_order_kode: $("#salesorder-sales_order_kode").val(),
                            client_wms_id: $("#salesorder-client_wms_id").val(),
                            sales_order_no_reff: $("#salesorder-sales_order_no_reff").val(),
                            // client_wms_id: "",
                            // channel_id: $("#salesorder-channel_id").val(),
                            channel_id: "",
                            sales_order_is_handheld: 0,
                            sales_order_status: $("#salesorder-sales_order_status").val(),
                            sales_order_approved_by: "",
                            sales_id: $("#salesorder-sales_id").val(),
                            client_pt_id: $("#salesorder-client_pt_id").val(),
                            sales_order_tgl: $("#salesorder-sales_order_tgl").val(),
                            sales_order_tgl_exp: $("#salesorder-sales_order_tgl_exp").val(),
                            sales_order_tgl_harga: $("#salesorder-sales_order_tgl_harga").val(),
                            sales_order_tgl_sj: $("#salesorder-sales_order_tgl_sj").val(),
                            sales_order_tgl_kirim: $("#salesorder-sales_order_tgl_kirim").val(),
                            sales_order_tipe_pembayaran: document.querySelector('input[id="salesorder-sales_order_tipe_pembayaran"]:checked').value,
                            tipe_sales_order_id: $("#salesorder-tipe_sales_order_id").val(),
                            sales_order_no_po: $("#salesorder-sales_order_no_po").val(),
                            sales_order_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                            sales_order_tgl_create: "",
                            sales_order_is_downloaded: 0,
                            so_is_need_approval: $("#salesorder-so_is_need_approval:checked").val(),
                            tipe_delivery_order_id: $("#salesorder-tipe_delivery_order_id").val(),
                            // sales_order_no_reff: $("#filter-delivery_order_id option:selected").text(),
                            sales_order_is_uploaded: 0,
                            principle_id: $("#salesorder-principle_id").val(),
                            total_diskon_item: $("#total_diskon_item").val().replaceAll(".", ""),
                            total_global: $("#total_rp").val().replaceAll(".", ""),
                            diskon_global_percent: $("#diskon_global_percent").val(),
                            diskon_global_rp: $("#diskon_global_rp").val().replaceAll(".", ""),
                            dasar_kena_pajak: $("#dasar_kena_pajak").val().replaceAll(".", ""),
                            ppn_global_percent: $("#ppn_global_percent").val(),
                            ppn_global_rp: $("#ppn_global_rp").val().replaceAll(".", ""),
                            adjustment: $("#adjustment").val().replaceAll(".", ""),
                            total_faktur: $("#total_faktur").val().replaceAll(".", ""),
                            detail: arr_detail,
                            tipe_ppn: $("#backorder-back_order_tipe_ppn:checked").val(),
                            keterangan: $("#keterangan_detail").val(),
                            tgl_update: $("#tgl_update").val() == 'null' ? '' : $("#tgl_update").val()
                        }, "POST", "JSON", function(response) {

                            if (response.status == 400) {
                                return messageNotSameLastUpdated('FAS/SalesOrderDropshipper/SalesOrderDropshipperMenu');
                            }
                            if (response.status == 200) {
                                message_topright("success", "Data berhasil disimpan");
                                setTimeout(() => {
                                    location.href = "<?= base_url(); ?>FAS/SalesOrderDropshipper/SalesOrderDropshipperMenu";
                                }, 500);
                            } else if (response.kode == "401") {
                                let arrayOfErrorsToDisplay = [];
                                let indexError = [];
                                indexError = 0;
                                $.each(response.data, function(i, v) {
                                    arrayOfErrorsToDisplay.push({
                                        title: 'Data Gagal Disimpan!',
                                        html: `Jumlah sku <strong>${v.sku_kode} ${v.sku_nama_produk}</strong> melebihi jumlah sku sales order utama`
                                    });

                                    $.each(arr_detail, function(i2, v2) {
                                        if (v.sku_id == v2.sku_id) {
                                            $('#row-' + i2).css('background', 'red');
                                            $('#row-' + i2).css('color', 'white');
                                        }
                                    });
                                });
                                Swal.mixin({
                                    icon: 'error',
                                    confirmButtonText: 'Next &rarr;',
                                    showCancelButton: true,
                                    progressSteps: indexError
                                }).queue(arrayOfErrorsToDisplay)
                            } else {
                                message_topright("error", "Data gagal disimpan");
                            }
                        });
                    }
                });

            }, 500);

        }, 500);
    });

    function DeleteSKU(row, index, sku_id, random_id) {
        var so_id = $("#so_id").val();
        var row = row.parentNode.parentNode;
        row.parentNode.removeChild(row);

        arr_sku[index] = "";
        arr_sales_order_detail[index] = "";

        if ($("#table-sku-delivery-only tbody tr").length == 0) {
            $("#salesorder-client_wms_id").prop("disabled", false);
            $("#salesorder-principle_id").prop("disabled", false);
        }

        <?php if ($act == "edit") { ?>
            HeaderReadonly();
        <?php } ?>

        triggerDetail();
    }

    function reset_table_customer() {
        $("#salesorder-client_pt_id").val('');
        $("#salesorder-sales_order_kirim_nama").val('');
        $("#salesorder-sales_order_kirim_alamat").val('');
        $("#salesorder-sales_order_kirim_provinsi").val('');
        $("#salesorder-sales_order_kirim_kota").val('');
        $("#salesorder-sales_order_kirim_kecamatan").val('');
        $("#salesorder-sales_order_kirim_kelurahan").val('');
        $("#salesorder-sales_order_kirim_kodepos").val('');
        $("#salesorder-sales_order_kirim_area").val('');
        $("#salesorder-sales_order_kirim_telepon").val('');

        $(".customer-name").html('');
        $(".customer-address").html('');
        $(".customer-area").html('');

        $("#table-customer > tbody").empty();
        // initDataCustomer();
    }

    function reset_table_sku() {
        arr_sales_order_detail = [];

        $("#table-sku-delivery-only > tbody").empty();
        $("#table-sku > tbody").empty();
        $("#table-ed-sku > tbody").empty();
        // initDataSKU();
    }

    function reqFilter(val, i) {
        if (val == 1) {
            $("#item-" + i + "-SalesOrderDetail-sku_filter_expdate").prop('disabled', false);
            $("#item-" + i + "-SalesOrderDetail-sku_filter_expdatebulan").prop('disabled', false);
        } else {
            $("#item-" + i + "-SalesOrderDetail-sku_filter_expdate").val(0).change();
            $("#item-" + i + "-SalesOrderDetail-sku_filter_expdatebulan").val(0).change();

            $("#item-" + i + "-SalesOrderDetail-sku_filter_expdate").prop('disabled', true);
            $("#item-" + i + "-SalesOrderDetail-sku_filter_expdatebulan").prop('disabled', true);
        }
    }

    function pushToTableSKUDelivery() {

        // var result = arr_sales_order_detail.reduce((unique, o) => {
        //     if (!unique.some(obj => obj.sku_id === o.sku_id)) {
        //         unique.push(o);
        //     }
        //     return unique;
        // }, []);

        // arr_sales_order_detail = result;

        $("#cek_sku").val(arr_sales_order_detail.length);
        // console.log(arr_sales_order_detail);

        if (cek_total_arr_sales_order_detail == 0) {
            $("#table-sku-delivery-only > tbody").empty();

            if ($.fn.DataTable.isDataTable('#table-sku-delivery-only')) {
                $('#table-sku-delivery-only').DataTable().clear();
                $('#table-sku-delivery-only').DataTable().destroy();
            }
        }

        // if ($.fn.DataTable.isDataTable('#table-sku-delivery-only')) {
        //     $('#table-sku-delivery-only').DataTable().clear();
        //     $('#table-sku-delivery-only').DataTable().destroy();
        // }

        var tipe_ppn = $("#salesorder-sales_order_tipe_ppn:checked").val();
        var diskon_global_percent = $("#diskon_global_percent").val();
        // var diskon_global_rp = $("#diskon_global_rp").val();
        var ppn = 0;

        $.each(arr_sales_order_detail, function(i, v) {
            if (cek_total_arr_sales_order_detail <= i) {
                if (arr_sales_order_detail[i] != "") {
                    ppn = parseFloat(v.client_wms_tax);

                    $("#table-sku-delivery-only > tbody").append(`
                        <tr id="row-${i}">
                            <td style="display: none">
                                <input type="hidden" id="item-${i}-SalesOrderDetail-client_wms_id" value="${v.client_wms_id}" class="client-wms-id" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-principle_id" value="${v.principle_id}" class="client-principle-id" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_id" value="${v.sku_id}" class="sku-id" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_harga_satuan" class="sku-harga-satuan" value="${v.sku_harga_satuan}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_disc_percent" class="sku-disc-percent" value="0" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_disc_rp" class="sku-disc-rp" value="0" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_harga_nett" class="sku-harga-nett" value="${v.sku_harga_nett}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_weight" class="sku-weight" value="${v.sku_weight}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_weight_unit" class="sku-weight-unit" value="${v.sku_weight_unit}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_length" class="sku-length" value="${v.sku_length}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_length_unit" class="sku-length-unit" value="${v.sku_length_unit}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_width" class="sku-width" value="${v.sku_width}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_width_unit" class="sku-width-unit" value="${v.sku_width_unit}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_height" class="sku-height" value="${v.sku_height}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_height_unit" class="sku-height-unit" value="${v.sku_height_unit}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_volume" class="sku-volume" value="${v.sku_volume}" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_volume_unit" class="sku-volume-unit" value="${v.sku_volume_unit}" />
                            </td>
                            <td class="text-center">
                                <span class="sku-kode-label">${v.brand}</span>
                            </td>
                            <td class="text-center">
                                <span class="sku-kode-label">${v.sku_kode}</span>
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_kode" class="form-control sku-kode" value="${v.sku_kode}" />
                            </td>
                            <td class="text-center" style="display: none"></td>
                            <td class="text-center">
                                <span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_nama_produk" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
                            </td>
                            <td class="text-center">
                                <span class="sku-satuan-label">${v.sku_satuan}</span>
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_satuan" class="form-control sku-satuan" value="${v.sku_satuan}" />
                            </td>
                            <td class="text-center">
                                <select class="form-control" id="item-${i}-SalesOrderDetail-sales_order_detail_tipe" name="item-${i}-SalesOrderDetail-sales_order_detail_tipe" onchange="chgSubJumlah(this.value, '${i}', 'sales_order_detail_tipe')">
                                    <option value="">** <span name="CAPTION-TIPE">Tipe</span> **</option>
                                    <?php if ($act != "index") { ?>
                                        <?php foreach ($TipeSOD as $value) { ?>
                                            <option value="<?= $value['tipe_sales_order_detail'] ?>" ${v.sales_order_detail_tipe == '<?= $value['tipe_sales_order_detail'] ?>' ? 'selected' : ''}><?= $value['tipe_sales_order_detail'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="text-center">
                                <input onchange="chgSubJumlah(this.value, '${i}', 'sku_harga_satuan')" type="text" id="input-item-${i}-SalesOrderDetail-sku_harga_satuan" class="form-control mask-money text-right" value="${v.sku_harga_satuan == '.0000' ? 0 : formatRupiahCurr(v.sku_harga_satuan.toString().replaceAll(".", ","))}" disabled/>
                            </td>
                            <td class="text-center">
                                <input onchange="chgSubJumlah(this.value, '${i}', 'jumlah_barang')" type="text" id="item-${i}-SalesOrderDetail-sku_qty" class="form-control sku-qty mask-money text-right" value="${formatRupiahCurr(v.sku_qty.toString().replaceAll(".", ","))}" placeholder="0" />
                                <input type="hidden" id="item-${i}-SalesOrderDetail-sku_qty_so" class="form-control sku-qty" value="${v.sku_qty_so}" />
                            </td>
                            <td class="text-center">
                                <span id="caption-${i}-SalesOrderDetail-sku_qty_sisa">${v.sku_qty_sisa == '.0000' ? 0 : parseFloat(v.sku_qty_sisa)}</span>
                            </td>
                            <td class="text-center">
                                <input onchange="chgSubJumlah(this.value, '${i}', 'disc_item')" type="text" id="input-item-${i}-SalesOrderDetail-sku_disc_percent" class="form-control mask-money text-right" value="${formatNumber(0)}" />
                            </td>
                            <td class="text-center">
                                <span id="caption-${i}-SalesOrderDetail-sku_disc_rp">0</span>
                            </td>
                            <td class="text-center">
                                <span id="caption-${i}-SalesOrderDetail-sku_harga_nett">${v.sku_harga_nett == '.0000' ? 0 : formatRupiahCurr(v.sku_harga_nett.toString().replaceAll(".", ","))}</span>
                            </td>
                            <td class="text-center">
                                <span id="caption-${i}-SalesOrderDetail-sku_disc_global_percent">${diskon_global_percent}</span>
                            </td>
                            <td class="text-center">
                                <span id="caption-${i}-SalesOrderDetail-sku_disc_global_rupiah">0</span>
                            </td>
                            <td class="text-center">
                                <input ${tipe_ppn == '1' ? '' : 'checked disabled'} onchange="chgPPNPercent(this.checked, '${i}', '${parseFloat(v.client_wms_tax)}')" style="transform: scale(1.5)" type="checkbox" id="checkbox-item-${i}-SalesOrderDetail-ppn" value="" />
                            </td>
                            <td class="text-center">
                                <input onchange="chgPPNRP(this.value, '${i}')" disabled type="text" id="input-item-${i}-SalesOrderDetail-ppn_percent" class="form-control mask-money text-right" value="${tipe_ppn == '0' ? parseFloat(v.client_wms_tax) : '0'}" />
                            </td>
                            <td class="text-center">
                                <span id="caption-${i}-SalesOrderDetail-ppn_rp">0</span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-success btn-small btn-get-ed-sku" style="${$("#salesorder-tipe_sales_order_id").val() != 'AD89E05B-46A6-453B-8F19-886514234A21' ? 'display:none' : ''}" onclick="GetEDSKU('${v.sku_id}',${i},'add','${v.principle_id}')"><i class="fa fa-plus"></i></button>
                            </td>
                            <td class="text-center">
                                <input type="text" id="item-${i}-SalesOrderDetail-sku_keterangan" class="form-control input-sm" value="" />
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,${i},'${v.sku_id}', '${v.random_id}')"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    `);
                }
            }

        });

        run_input_mask_money();

        $('#ppn_global_percent').val(ppn)

        if (cek_total_arr_sales_order_detail == 0) {
            $('#table-sku-delivery-only').DataTable({
                'info': false,
                'paging': false,
                'searching': false,
                'pagination': false,
                'ordering': false,
                scrollX: true
            });
        }
    }

    function chgSubJumlah(value, index, mode) {
        value = value.replaceAll(",", ".");

        var harga = $(`#input-item-${index}-SalesOrderDetail-sku_harga_satuan`).val().replaceAll(",", ".");

        if (mode == 'jumlah_barang') {
            // SUB JUMLAH
            chgSubJumlah($(`#input-item-${index}-SalesOrderDetail-sku_disc_percent`).val().replaceAll(",", "."), index, 'disc_item');

            setTimeout(() => {
                var disc_rp = parseFloat($(`#caption-${index}-SalesOrderDetail-sku_disc_rp`).text().replaceAll(".", "").replaceAll(",", "."));
                var hasil = parseFloat(value) * parseFloat(harga) - disc_rp;
                var sku_qty_so = parseInt($("#item-" + index + "-SalesOrderDetail-sku_qty_so").val());
                var sku_qty_sisa = sku_qty_so - value;

                if (sku_qty_sisa >= 0) {
                    arr_sales_order_detail[index]['sku_qty'] = value;
                    $(`#caption-${index}-SalesOrderDetail-sku_qty_sisa`).text(formatNumber(parseInt(sku_qty_sisa)));
                } else {
                    let alert = "Sisa qty so dropshipper tidak mencukupi";
                    $(`#item-${index}-SalesOrderDetail-sku_qty`).val('');
                    $(`#caption-${index}-SalesOrderDetail-sku_qty_sisa`).text(formatNumber(parseInt(sku_qty_so)));
                    message("Error", alert, "error");
                }

                if ($("#salesorder-tipe_sales_order_id").val() == 'AD89E05B-46A6-453B-8F19-886514234A21') {
                    $(`#caption-${index}-SalesOrderDetail-sku_harga_nett_view`).text('-' + formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
                    $(`#caption-${index}-SalesOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
                } else {
                    $(`#caption-${index}-SalesOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil.toString().replaceAll(".", ",")));

                }

                // DISKON GLOBAL DETAIL RP
                var diskon_global_percent = $(`#caption-${index}-SalesOrderDetail-sku_disc_global_percent`).text();
                var disc_global_detail_rp = hasil * parseFloat(diskon_global_percent) / 100
                $(`#caption-${index}-SalesOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(disc_global_detail_rp.toString().replaceAll(".", ",")))

                // PPN
                var checkbox_ppn = $(`#checkbox-item-${index}-SalesOrderDetail-ppn`).prop('checked');
                if (checkbox_ppn) {
                    var ppn_percent = $(`#input-item-${index}-SalesOrderDetail-ppn_percent`).val().replaceAll(",", ".");
                    var diskon_global_rp = $(`#caption-${index}-SalesOrderDetail-sku_disc_global_rupiah`).text().replaceAll(",", ".");
                    var ppn_rp = (parseFloat(hasil) - parseFloat(diskon_global_rp)) * parseFloat(ppn_percent) / 100;
                    $(`#caption-${index}-SalesOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_rp.toString().replaceAll(".", ",")));
                }

            }, 500);

        } else if (mode == 'sku_harga_satuan') {
            // SUB JUMLAH
            chgSubJumlah($(`#input-item-${index}-SalesOrderDetail-sku_disc_percent`).val().replaceAll(",", "."), index, 'disc_item');

            setTimeout(() => {
                var jumlah_barang = parseFloat($(`#item-${index}-SalesOrderDetail-sku_qty`).val().replaceAll(",", "."));
                var disc_rp = parseFloat($(`#caption-${index}-SalesOrderDetail-sku_disc_rp`).text().replaceAll(".", "").replaceAll(",", "."));
                var hasil = parseFloat(jumlah_barang) * parseFloat(harga) - disc_rp;

                if ($("#salesorder-tipe_sales_order_id").val() == 'AD89E05B-46A6-453B-8F19-886514234A21') {
                    $(`#caption-${index}-SalesOrderDetail-sku_harga_nett_view`).text('-' + formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
                    $(`#caption-${index}-SalesOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
                } else {
                    $(`#caption-${index}-SalesOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil.toString().replaceAll(".", ",")));

                }

                // DISKON GLOBAL DETAIL RP
                var diskon_global_percent = $(`#caption-${index}-SalesOrderDetail-sku_disc_global_percent`).text();
                var disc_global_detail_rp = hasil * parseFloat(diskon_global_percent) / 100
                $(`#caption-${index}-SalesOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(disc_global_detail_rp.toString().replaceAll(".", ",")))

                // PPN
                var checkbox_ppn = $(`#checkbox-item-${index}-SalesOrderDetail-ppn`).prop('checked');
                if (checkbox_ppn) {
                    var ppn_percent = $(`#input-item-${index}-SalesOrderDetail-ppn_percent`).val().replaceAll(",", ".");
                    var diskon_global_rp = $(`#caption-${index}-SalesOrderDetail-sku_disc_global_rupiah`).text().replaceAll(",", ".");
                    var ppn_rp = (parseFloat(hasil) - parseFloat(diskon_global_rp)) * parseFloat(ppn_percent) / 100;
                    $(`#caption-${index}-SalesOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_rp.toString().replaceAll(".", ",")));
                }

            }, 500);

        } else if (mode == 'sales_order_detail_tipe') {
            // SUB JUMLAH
            if ($(`#item-${index}-SalesOrderDetail-sales_order_detail_tipe`).val() == "BONUS") {
                $(`#input-item-${index}-SalesOrderDetail-sku_harga_satuan`).prop("disabled", true);
                $(`#input-item-${index}-SalesOrderDetail-sku_disc_percent`).prop("disabled", true);

                $(`#input-item-${index}-SalesOrderDetail-sku_harga_satuan`).val(0);
                var jumlah_barang = parseFloat($(`#item-${index}-SalesOrderDetail-sku_qty`).val().replaceAll(",", "."));
                var hasil = parseFloat(jumlah_barang) * parseFloat(0) - 0;

                if ($("#salesorder-tipe_sales_order_id").val() == 'AD89E05B-46A6-453B-8F19-886514234A21') {
                    $(`#caption-${index}-SalesOrderDetail-sku_harga_nett_view`).text(formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
                    $(`#caption-${index}-SalesOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
                } else {
                    $(`#caption-${index}-SalesOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
                }

                // DISKON GLOBAL DETAIL RP
                var diskon_global_percent = $(`#caption-${index}-SalesOrderDetail-sku_disc_global_percent`).text();
                var disc_global_detail_rp = hasil * parseFloat(diskon_global_percent) / 100
                $(`#caption-${index}-SalesOrderDetail-sku_disc_global_rupiah`).text(0)

                // PPN
                var checkbox_ppn = $(`#checkbox-item-${index}-SalesOrderDetail-ppn`).prop('checked');
                if (checkbox_ppn) {
                    var ppn_percent = $(`#input-item-${index}-SalesOrderDetail-ppn_percent`).val().replaceAll(",", ".");
                    var diskon_global_rp = $(`#caption-${index}-SalesOrderDetail-sku_disc_global_rupiah`).text().replaceAll(",", ".");
                    var ppn_rp = (parseFloat(hasil) - parseFloat(diskon_global_rp)) * parseFloat(ppn_percent) / 100;
                    $(`#caption-${index}-SalesOrderDetail-ppn_rp`).text(0);
                }

            } else if ($(`#item-${index}-SalesOrderDetail-sales_order_detail_tipe`).val() == "JUAL") {
                $(`#input-item-${index}-SalesOrderDetail-sku_harga_satuan`).prop("disabled", false);
                $(`#input-item-${index}-SalesOrderDetail-sku_disc_percent`).prop("disabled", false);

                chgSubJumlah($(`#input-item-${index}-SalesOrderDetail-sku_disc_percent`).val().replaceAll(",", "."), index, 'disc_item');

                setTimeout(() => {
                    var jumlah_barang = parseFloat($(`#item-${index}-SalesOrderDetail-sku_qty`).val().replaceAll(",", "."));
                    var disc_rp = parseFloat($(`#caption-${index}-SalesOrderDetail-sku_disc_rp`).text().replaceAll(".", "").replaceAll(",", "."));
                    var hasil = parseFloat(jumlah_barang) * parseFloat(harga) - disc_rp;

                    console.log(hasil);

                    if ($("#salesorder-tipe_sales_order_id").val() == 'AD89E05B-46A6-453B-8F19-886514234A21') {
                        $(`#caption-${index}-SalesOrderDetail-sku_harga_nett_view`).text('-' + formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
                        $(`#caption-${index}-SalesOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
                    } else {
                        $(`#caption-${index}-SalesOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil.toString().replaceAll(".", ",")));

                    }

                    // DISKON GLOBAL DETAIL RP
                    var diskon_global_percent = $(`#caption-${index}-SalesOrderDetail-sku_disc_global_percent`).text();
                    var disc_global_detail_rp = hasil * parseFloat(diskon_global_percent) / 100
                    $(`#caption-${index}-SalesOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(disc_global_detail_rp.toString().replaceAll(".", ",")))

                    // PPN
                    var checkbox_ppn = $(`#checkbox-item-${index}-SalesOrderDetail-ppn`).prop('checked');
                    if (checkbox_ppn) {
                        var ppn_percent = $(`#input-item-${index}-SalesOrderDetail-ppn_percent`).val().replaceAll(",", ".");
                        var diskon_global_rp = $(`#caption-${index}-SalesOrderDetail-sku_disc_global_rupiah`).text().replaceAll(",", ".");
                        var ppn_rp = (parseFloat(hasil) - parseFloat(diskon_global_rp)) * parseFloat(ppn_percent) / 100;
                        $(`#caption-${index}-SalesOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_rp.toString().replaceAll(".", ",")));
                    }

                }, 500);

            }

        } else { // mode disc_item
            // DISKON RP dan SUB JUMLAH
            var jumlah_barang = parseFloat($(`#item-${index}-SalesOrderDetail-sku_qty`).val().replaceAll(",", "."));
            var jumlah_harga = jumlah_barang * parseFloat(harga);
            var disc_rp = parseFloat(jumlah_harga) * parseFloat(value) / 100;
            $(`#caption-${index}-SalesOrderDetail-sku_disc_rp`).text(formatRupiahCurr(disc_rp.toString().replaceAll(".", ",")));
            var hasil = parseFloat(jumlah_harga) - parseFloat(disc_rp);
            if ($("#salesorder-tipe_sales_order_id").val() == 'AD89E05B-46A6-453B-8F19-886514234A21') {
                $(`#caption-${index}-SalesOrderDetail-sku_harga_nett_view`).text('-' + formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
                $(`#caption-${index}-SalesOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
            } else {
                $(`#caption-${index}-SalesOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil.toString().replaceAll(".", ",")));
            }

            // DISKON GLOBAL DETAIL RP
            var diskon_global_percent = $(`#caption-${index}-SalesOrderDetail-sku_disc_global_percent`).text();
            var disc_global_detail_rp = hasil * parseFloat(diskon_global_percent) / 100;
            $(`#caption-${index}-SalesOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(disc_global_detail_rp.toString().replaceAll(".", ",")))

            var checkbox_ppn = $(`#checkbox-item-${index}-SalesOrderDetail-ppn`).prop('checked');
            if (checkbox_ppn) {
                var ppn_percent = $(`#input-item-${index}-SalesOrderDetail-ppn_percent`).val().replaceAll(",", ".");
                var diskon_global_rp = $(`#caption-${index}-SalesOrderDetail-sku_disc_global_rupiah`).text().replaceAll(",", ".");
                var ppn_rp = (parseFloat(hasil) - parseFloat(diskon_global_rp)) * parseFloat(ppn_percent) / 100;
                $(`#caption-${index}-SalesOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_rp.toString().replaceAll(".", ",")));
            }
        }

        triggerDetail();
    }

    function chgPPNPercent(checked, index, ppn_percent) {
        if (checked) {
            $(`#input-item-${index}-SalesOrderDetail-ppn_percent`).val(ppn_percent);

            var sub_jumlah = $(`#caption-${index}-SalesOrderDetail-sku_harga_nett`).text().replaceAll(".", "").replaceAll(",", ".");
            var diskon_global_rp = $(`#caption-${index}-SalesOrderDetail-sku_disc_global_rupiah`).text().replaceAll(".", "").replaceAll(",", ".");
            var ppn_rp = (parseFloat(sub_jumlah) - parseFloat(diskon_global_rp)) * (parseFloat(ppn_percent) / 100);
            // var total_harga = parseFloat(sub_jumlah) + parseFloat(ppn_rp);

            $(`#caption-${index}-SalesOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_rp.toString().replaceAll(".", ",")));

        } else {
            $(`#input-item-${index}-SalesOrderDetail-ppn_percent`).val(0);
            $(`#caption-${index}-SalesOrderDetail-ppn_rp`).text(0);
        }

        triggerDetail()
    }

    function chgDiskonGlobal(value, mode) {
        value = value.replaceAll(".", "")

        if (mode == 'percent') {
            // DISKON GLOBAL RP
            var total_rp = $("#total_rp").val().replaceAll(",", ".");
            var diskon_global_rp = parseFloat(total_rp) * parseFloat(value) / 100
            $("#diskon_global_rp").val(formatRupiahCurr(diskon_global_rp.toString().replaceAll(".", ",")));

            if (arr_sales_order_detail.length > 0) {
                var index = 0;
                $.each(arr_sales_order_detail, function(i, v) {
                    if (arr_sales_order_detail[i] != "") {
                        $(`#table-sku-delivery-only tbody tr:eq(${index})`).each(function(i2) {
                            // DISKON GLOBAL DETAIL PERCENT
                            $(`#caption-${i}-SalesOrderDetail-sku_disc_global_percent`).text(value);

                            // DISKON GLOBAL DETAIL RUPIAH
                            var sub_jumlah = $(`#caption-${i}-SalesOrderDetail-sku_harga_nett`).text().replaceAll(".", "").replaceAll(",", ".");
                            var diskon_global_rp_detail = parseFloat(sub_jumlah) * parseFloat(value) / 100
                            $(`#caption-${i}-SalesOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(diskon_global_rp_detail.toString().replaceAll(".", ",")));

                            // PPN DETAIL RP
                            var checkbox_ppn_detail = $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop("checked");
                            var ppn_percent_detail = $(`#input-item-${i}-SalesOrderDetail-ppn_percent`).val().replaceAll(",", ".");
                            if (checkbox_ppn_detail) {
                                var ppn_detail_rp = (parseFloat(sub_jumlah) - parseFloat(diskon_global_rp_detail)) * ppn_percent_detail / 100
                                $(`#caption-${i}-SalesOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_detail_rp.toString().replaceAll(".", ",")));
                            }
                        });

                        index++;
                    }
                })
            }
            // $("#table-sku-delivery-only tbody tr").each(function(i) {
            //     // DISKON GLOBAL DETAIL PERCENT
            //     $(`#caption-${i}-SalesOrderDetail-sku_disc_global_percent`).text(value);

            //     // DISKON GLOBAL DETAIL RUPIAH
            //     var sub_jumlah = $(`#caption-${i}-SalesOrderDetail-sku_harga_nett`).text().replaceAll(".", "");
            //     var diskon_global_rp_detail = parseFloat(sub_jumlah) * parseFloat(value) / 100
            //     $(`#caption-${i}-SalesOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(diskon_global_rp_detail.toString().replaceAll(".", ",")));

            //     // PPN DETAIL RP
            //     var checkbox_ppn_detail = $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop("checked");
            //     var ppn_percent_detail = $(`#input-item-${i}-SalesOrderDetail-ppn_percent`).val();
            //     if (checkbox_ppn_detail) {
            //         var ppn_detail_rp = (parseFloat(sub_jumlah) - parseFloat(diskon_global_rp_detail)) * ppn_percent_detail / 100
            //         $(`#caption-${i}-SalesOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_detail_rp.toString().replaceAll(".", ",")));
            //     }
            // });

            // var hasil = parseFloat(total_rp) - parseFloat(diskon_global_rp);
            // $(`#dasar_kena_pajak`).val(hasil);
        } else {
            var total_rp = $("#total_rp").val().replaceAll(",", ".");
            var discont_global_percent = parseFloat(value) / parseFloat(total_rp) * 100;

            // Memeriksa apakah nilai memiliki desimal
            // if (discont_global_percent % 1 !== 0) {
            //     discont_global_percent = discont_global_percent.toFixed(2);
            // }

            $("#diskon_global_percent").val(formatNumber(discont_global_percent));

            if (arr_sales_order_detail.length > 0) {
                var index = 0;
                $.each(arr_sales_order_detail, function(i, v) {
                    if (arr_sales_order_detail[i] != "") {
                        $(`#table-sku-delivery-only tbody tr:eq(${index})`).each(function(i) {
                            $(`#caption-${i}-SalesOrderDetail-sku_disc_global_percent`).text(formatRupiahCurr(discont_global_percent.toString().replaceAll(".", ",")));
                            var sub_jumlah = $(`#caption-${i}-SalesOrderDetail-sku_harga_nett`).text().replaceAll(".", "");

                            var diskon_global_rp_detail = parseFloat(sub_jumlah) * parseFloat(discont_global_percent) / 100
                            $(`#caption-${i}-SalesOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(diskon_global_rp_detail.toString().replaceAll(".", ",")));

                            // PPN DETAIL RP
                            var checkbox_ppn_detail = $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop("checked");
                            var ppn_percent_detail = $(`#input-item-${i}-SalesOrderDetail-ppn_percent`).val().replaceAll(",", ".");
                            if (checkbox_ppn_detail) {
                                var ppn_detail_rp = (parseFloat(sub_jumlah) - parseFloat(diskon_global_rp_detail)) * ppn_percent_detail / 100
                                $(`#caption-${i}-SalesOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_detail_rp.toString().replaceAll(".", ",")));
                            }
                        });

                        index++;
                    }
                })
            }
            // $("#table-sku-delivery-only tbody tr").each(function(i) {
            //     $(`#caption-${i}-SalesOrderDetail-sku_disc_global_percent`).text(discont_global_percent);
            //     var sub_jumlah = $(`#caption-${i}-SalesOrderDetail-sku_harga_nett`).text().replaceAll(".", "");

            //     var diskon_global_rp_detail = parseFloat(sub_jumlah) * parseFloat(discont_global_percent) / 100
            //     $(`#caption-${i}-SalesOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(diskon_global_rp_detail.toString().replaceAll(".", ",")));

            //     // PPN DETAIL RP
            //     var checkbox_ppn_detail = $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop("checked");
            //     var ppn_percent_detail = $(`#input-item-${i}-SalesOrderDetail-ppn_percent`).val();
            //     if (checkbox_ppn_detail) {
            //         var ppn_detail_rp = (parseFloat(sub_jumlah) - parseFloat(diskon_global_rp_detail)) * ppn_percent_detail / 100
            //         $(`#caption-${i}-SalesOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_detail_rp.toString().replaceAll(".", ",")));
            //     }
            // });

            // var hasil = parseFloat(total_rp) - parseFloat(value);
            // $(`#dasar_kena_pajak`).val(hasil);
        }

        triggerDetail();
    }

    function chgPPNGlobal(checked, value) {
        if (checked) {
            $("#ppn_global_percent").val(value);

            // ppn global rp
            var dasar_kena_pajak = $(`#dasar_kena_pajak`).val();
            var ppn_global_rp = parseFloat(dasar_kena_pajak) * (parseFloat(value) / 100)
            $(`#ppn_global_rp`).val(ppn_global_rp)

            //total faktur
            // var adjustment = parseFloat($(`#adjustment`).val());
            // var total_faktur = parseFloat(dasar_kena_pajak) + ppn_global_rp + adjustment;
            // $(`#total_faktur`).val(total_faktur);
        } else {
            $("#ppn_global_percent").val(0);
            $(`#ppn_global_rp`).val(0)

            //total faktur
            // var dasar_kena_pajak = $(`#dasar_kena_pajak`).val();
            // var adjustment = parseFloat($(`#adjustment`).val());
            // var total_faktur = parseFloat(dasar_kena_pajak) + adjustment;
            // $(`#total_faktur`).val(total_faktur);
        }

        triggerDetail();
    }

    function chgTipePPN(value) {
        if (value == '0') { // global
            var total = 0;

            if (arr_sales_order_detail.length > 0) {
                var index = 0;
                $.each(arr_sales_order_detail, function(i, v) {
                    if (arr_sales_order_detail[i] != "") {
                        $(`#table-sku-delivery-only tbody tr:eq(${index})`).each(function(i2) {
                            $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop('checked', true);
                            $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop('disabled', true);
                            $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).trigger('change');
                        });

                        index++;
                    }
                })
            }
            // $("#table-sku-delivery-only tbody tr").each(function(i) {
            //     $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop('checked', true);
            //     $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop('disabled', true);
            //     $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).trigger('change');
            //     // $(`#input-item-${i}-SalesOrderDetail-ppn_percent`).val(0);
            //     // $(`#caption-${i}-SalesOrderDetail-ppn_rp`).text(0);

            //     // var sub_jumlah = $(`#caption-${i}-SalesOrderDetail-sku_harga_nett`).text();
            //     // var diskon_global_rupiah = $(`#caption-${i}-SalesOrderDetail-sku_disc_global_rupiah`).text();

            //     // total += parseFloat(sub_jumlah) - parseFloat(diskon_global_rupiah)
            // });

            // $(`#dasar_kena_pajak`).val(total);

            // $(`#checkbox_ppn_global`).prop('checked', true)
            // $(`#checkbox_ppn_global`).prop('disabled', true)
            // $(`#checkbox_ppn_global`).trigger('change');

            //total faktur
            // var dasar_kena_pajak = parseFloat($(`#dasar_kena_pajak`).val());
            // var ppn_global_rp = parseFloat($(`#ppn_global_rp`).val());
            // var adjustment = parseFloat($(`#adjustment`).val());
            // var total_faktur = dasar_kena_pajak + ppn_global_rp + adjustment;
            // $(`#total_faktur`).val(total_faktur);

        } else { // detail
            var total_ppn_rp_detail = 0;

            if (arr_sales_order_detail.length > 0) {
                var index = 0;
                $.each(arr_sales_order_detail, function(i, v) {
                    if (arr_sales_order_detail[i] != "") {
                        $(`#table-sku-delivery-only tbody tr:eq(${index})`).each(function(i2) {
                            $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop('checked', false);
                            $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop('disabled', false);
                            $(`#input-item-${i}-SalesOrderDetail-ppn_percent`).val(0)
                            $(`#caption-${i}-SalesOrderDetail-ppn_rp`).text(0)
                        });

                        index++;
                    }
                })
            }
            // $("#table-sku-delivery-only tbody tr").each(function(i) {
            //     $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop('checked', false);
            //     $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop('disabled', false);
            //     $(`#input-item-${i}-SalesOrderDetail-ppn_percent`).val(0)
            //     $(`#caption-${i}-SalesOrderDetail-ppn_rp`).text(0)
            //     // $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).trigger('change');

            //     // var ppn_rp = $(`#caption-${i}-SalesOrderDetail-ppn_rp`).text();
            //     // total_ppn_rp_detail += parseFloat(ppn_rp);
            // });

            // $(`#checkbox_ppn_global`).prop('checked', false)
            // $(`#checkbox_ppn_global`).prop('disabled', true)
            // $(`#ppn_global_percent`).val(0);
            // $(`#ppn_global_rp`).val(0);

            // $(`#ppn_global_rp`).val(total_ppn_rp_detail);

            //total faktur
            // var dasar_kena_pajak = parseFloat($(`#dasar_kena_pajak`).val());
            // var ppn_global_rp = parseFloat($(`#ppn_global_rp`).val());
            // var adjustment = parseFloat($(`#adjustment`).val());
            // var total_faktur = dasar_kena_pajak + ppn_global_rp + adjustment;
            // $(`#total_faktur`).val(total_faktur);
        }

        triggerDetail()
    }

    function triggerDetail() {
        // TRIGGER DETAIL
        var total_diskon_item = 0;
        var total_rp = 0;
        var dasar_kena_pajak_detail = 0;
        var ppn_detail_rp = 0;
        var diskon_global_detail_rp2 = 0;

        if (arr_sales_order_detail.length > 0) {
            var index = 0;
            $.each(arr_sales_order_detail, function(i, v) {
                if (arr_sales_order_detail[i] != "") {
                    $(`#table-sku-delivery-only tbody tr:eq(${index})`).each(function(i2) {
                        // TOTAL DISKON ITEM
                        total_diskon_item += parseFloat($(this).find("td:eq(11)").text().trim().replaceAll(".", "").replaceAll(",", "."));

                        // TOTAL RP
                        var sub_jumlah = $(`#caption-${i}-SalesOrderDetail-sku_harga_nett`).text().replaceAll(".", "").replaceAll(",", ".");
                        total_rp += parseFloat(sub_jumlah);

                        // DISKON GLOBAL RP
                        diskon_global_detail_rp2 += parseFloat($(`#caption-${i}-SalesOrderDetail-sku_disc_global_rupiah`).text().replaceAll(".", "").replaceAll(",", "."));

                        // DASAR KENA PAJAK
                        var checkbox_ppn_detail = $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop("checked");
                        var diskon_global_detail_rp = $(`#caption-${i}-SalesOrderDetail-sku_disc_global_rupiah`).text().replaceAll(".", "").replaceAll(",", ".");
                        if (checkbox_ppn_detail) {
                            dasar_kena_pajak_detail += parseFloat(sub_jumlah) - parseFloat(diskon_global_detail_rp)
                        }

                        // PPN GLOBAL RP
                        ppn_detail_rp += parseFloat($(`#caption-${i}-SalesOrderDetail-ppn_rp`).text().replaceAll(".", "").replaceAll(",", "."));
                    })

                    index++;
                }
            })

            $(`#total_diskon_item`).val(formatRupiahCurr(total_diskon_item.toString().replaceAll(".", ",")));
            $(`#total_rp`).val(formatRupiahCurr(total_rp.toString().replaceAll(".", ",")))
            $(`#diskon_global_rp`).val(formatRupiahCurr(diskon_global_detail_rp2.toString().replaceAll(".", ",")))

            $(`#dasar_kena_pajak`).val(formatRupiahCurr(dasar_kena_pajak_detail.toString().replaceAll(".", ",")));

            $(`#ppn_global_rp`).val(formatRupiahCurr(ppn_detail_rp.toString().replaceAll(".", ",")))

            var ppn_global_rp = parseFloat($(`#ppn_global_rp`).val().replaceAll(",", "."));

            console.log($(`#adjustment`).val());


            //total faktur
            var diskon_global_rp = parseFloat($(`#diskon_global_rp`).val().replaceAll(",", "."));
            var adjustment = parseFloat($(`#adjustment`).val().replaceAll(",", "."));
            var total_faktur = total_rp - diskon_global_rp + ppn_detail_rp + adjustment;
            $(`#total_faktur`).val(formatRupiahCurr(total_faktur.toString().replaceAll(".", ",")));
        } else {
            $(`#total_diskon_item`).val(0);
            $(`#total_rp`).val(0)
            $(`#diskon_global_percent`).val(0)
            $(`#diskon_global_rp`).val(0)
            $(`#dasar_kena_pajak`).val(0);
            $(`#ppn_global_rp`).val(0)
            $(`#adjustment`).val(0)
            $(`#total_faktur`).val(0)
        }

        // $("#table-sku-delivery-only tbody tr:eq").each(function(i) {
        //     if (arr_back_order_detail[i] != "") {
        //         // TOTAL DISKON ITEM
        //         total_diskon_item += parseFloat($(this).find("td:eq(9)").text().trim().replaceAll(".", ""));

        //         // TOTAL RP
        //         var sub_jumlah = $(`#caption-${i}-SalesOrderDetail-sku_harga_nett`).text().replaceAll(".", "");
        //         total_rp += parseFloat(sub_jumlah);

        //         // DISKON GLOBAL RP
        //         diskon_global_detail_rp2 += parseFloat($(`#caption-${i}-SalesOrderDetail-sku_disc_global_rupiah`).text().replaceAll(".", ""));

        //         // DASAR KENA PAJAK
        //         var checkbox_ppn_detail = $(`#checkbox-item-${i}-SalesOrderDetail-ppn`).prop("checked");
        //         var diskon_global_detail_rp = $(`#caption-${i}-SalesOrderDetail-sku_disc_global_rupiah`).text().replaceAll(".", "");
        //         if (checkbox_ppn_detail) {
        //             dasar_kena_pajak_detail += parseFloat(sub_jumlah) - parseFloat(diskon_global_detail_rp)
        //         }

        //         // PPN GLOBAL RP
        //         ppn_detail_rp += parseFloat($(`#caption-${i}-SalesOrderDetail-ppn_rp`).text().replaceAll(".", "").replaceAll(",", "."));
        //     }
        // });

        // total diskon item, total rp, diskon global
        // $(`#total_diskon_item`).val(formatRupiahCurr(total_diskon_item.toString().replaceAll(".", ",")));
        // $(`#total_rp`).val(formatRupiahCurr(total_rp.toString().replaceAll(".", ",")))
        // $(`#diskon_global_rp`).val(formatRupiahCurr(diskon_global_detail_rp2.toString().replaceAll(".", ",")))

        // $(`#dasar_kena_pajak`).val(formatRupiahCurr(dasar_kena_pajak_detail.toString().replaceAll(".", ",")));

        // $(`#ppn_global_rp`).val(formatRupiahCurr(ppn_detail_rp.toString().replaceAll(".", ",")))

        // var ppn_global_rp = parseFloat($(`#ppn_global_rp`).val().replaceAll(",", "."));

        // //total faktur
        // var diskon_global_rp = parseFloat($(`#diskon_global_rp`).val().replaceAll(",", "."));
        // var adjustment = parseFloat($(`#adjustment`).val().replaceAll(",", "."));
        // var total_faktur = total_rp - diskon_global_rp + ppn_detail_rp + adjustment;
        // $(`#total_faktur`).val(formatRupiahCurr(total_faktur.toString().replaceAll(".", ",")));
    }


    function GetPerusahaanBySales(sales) {

        $("#filter-perusahaan-sku").empty();
        $("#filter-perusahaan-customer").empty();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/SalesOrderDropshipper/GetPerusahaanBySales') ?>",
            data: {
                sales: sales
            },
            dataType: "JSON",
            async: false,
            success: function(response) {
                if (response.length > 0) {

                    $("#filter-perusahaan-sku").append(`<option value="">Semua</option>`);
                    $("#filter-perusahaan-customer").append(`<option value="">Semua</option>`);

                    $.each(response, function(i, v) {
                        $("#filter-perusahaan-sku").append(
                            `<option value="${v.client_wms_id}">${v.client_wms_nama}</option>`);
                        $("#filter-perusahaan-customer").append(
                            `<option value="${v.client_wms_id}">${v.client_wms_nama}</option>`);
                    });
                }
            }
        });
    }

    function HeaderReadonly() {
        var count_arr_sales_order_detail = 0;

        for (var i = 0; i < arr_sales_order_detail.length; i++) {
            if (arr_sales_order_detail[i] != "") {
                count_arr_sales_order_detail++;
            }
        }

        if (count_arr_sales_order_detail > 0) {
            $("#salesorder-sales_order_no_po").attr("readonly", true);
            $("#salesorder-sales_order_tgl").attr("readonly", true);
            $("#salesorder-sales_order_tgl_exp").attr("readonly", true);
            $("#salesorder-sales_order_tgl_harga").attr("readonly", true);
            $("#salesorder-sales_order_tgl_sj").attr("readonly", true);
            $("#salesorder-sales_order_tgl_kirim").attr("readonly", true);
            // $("#salesorder-tipe_sales_order_id").attr("disabled", true);
            $("#salesorder-sales_id").attr("disabled", true);
            $("#salesorder-sales_order_tipe_pembayaran").attr("disabled", true);
            $("#salesorder-tipe_delivery_order_id").attr("disabled", true);
            $("#salesorder-client_wms_id").attr("disabled", true);
            $("#salesorder-principle_id").attr("disabled", true);
        } else {
            $("#salesorder-sales_order_no_po").attr("readonly", false);
            $("#salesorder-sales_order_tgl").attr("readonly", false);
            $("#salesorder-sales_order_tgl_exp").attr("readonly", false);
            $("#salesorder-sales_order_tgl_harga").attr("readonly", false);
            $("#salesorder-sales_order_tgl_sj").attr("readonly", false);
            $("#salesorder-sales_order_tgl_kirim").attr("readonly", false);
            // $("#salesorder-tipe_sales_order_id").attr("disabled", false);
            $("#salesorder-sales_id").attr("disabled", false);
            $("#salesorder-sales_order_tipe_pembayaran").attr("disabled", false);
            $("#salesorder-tipe_delivery_order_id").attr("disabled", false);
            $("#salesorder-client_wms_id").attr("disabled", false);
            $("#salesorder-principle_id").attr("disabled", false);
        }
    }

    $("#salesorder-client_wms_id").on("change", function() {
        reset_table_customer();
        reset_table_sku();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/SalesOrderDropshipper/getPrinciple') ?>",
            data: {
                perusahaanID: $("#salesorder-client_wms_id").val()
            },
            dataType: "JSON",
            async: false,
            success: function(response) {

                $("#filter-principle").html('');
                $("#salesorder-principle_id").html('');

                $("#filter-principle").append(`<option value="">Semua</option>`);
                $("#salesorder-principle_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);

                if (response.length > 0) {
                    var ppn = 0;
                    $.each(response, function(i, v) {
                        $("#filter-principle").append(
                            `<option value="${v.principle_id}">${v.principle_kode}</option>`
                        );

                        $("#salesorder-principle_id").append(
                            `<option value="${v.principle_id}">${v.principle_kode}</option>`
                        );

                        $(`#checkbox_ppn_global`).val(parseFloat(v.client_wms_tax))
                        ppn = v.client_wms_tax;
                    });
                }
            }
        });
    });

    $("#btnAvaibilityCheckProcess").on("click", function() {
        var tableSKUDO = $("#table-sku-delivery-only > tbody").length
        var tgl_kirim = $("#salesorder-sales_order_tgl_kirim").val();
        var id_temp2 = $("#so_id").val();
        var arrSKUCheck = [];
        var boolean = true;

        if (tableSKUDO > 0) {
            $("#table-sku-delivery-only tbody tr").each(function() {
                var sku_id = $(this).find("td:eq(0) input[class='sku-id']").val();
                var qty = $(this).find("td:eq(9) input").val();

                if (qty == '0' || qty == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'QTY SKU tidak boleh 0 atau kosong!'
                    });
                    boolean = false;
                    return false;
                } else {
                    arrSKUCheck.push({
                        sku_id: sku_id,
                        qty: qty
                    })
                }
            });

            if (boolean) {
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/SalesOrderDropshipper/insertExecProsesSimulasiMPS') ?>",
                    data: {
                        tgl_kirim: tgl_kirim,
                        arrSKUCheck: arrSKUCheck,
                        id_temp2: id_temp2
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Loading ...',
                            html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                            timerProgressBar: false,
                            showConfirmButton: false
                        });
                    },
                    dataType: "JSON",
                    success: function(response) {
                        message("Success!", "Selesai Avaibility Check Process", 'success');

                        if (response != 0) {
                            $("#table-sku-delivery-only tbody tr").each(function(i) {
                                $(this).find("td:eq(15)").text(response[i]);
                            });
                        }
                    }
                });
            }

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Pilih SKU terlebih dahulu!'
            });
        }
    })

    function modalDetailSKU(i, sku_id, sku_nama_produk) {
        var id_temp = $("#so_id").val();
        var tgl_kirim = $("#salesorder-sales_order_tgl_kirim").val();
        var qty = $(`#item-${i}-SalesOrderDetail-sku_qty`).val();

        if (qty == '0' || qty == '' || qty == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'QTY SKU tidak boleh 0 atau kosong!'
            });

            return false;
        }

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/SalesOrderDropshipper/execProsesSimulasiMPSSingle') ?>",
            data: {
                id_temp: id_temp,
                tgl_kirim: tgl_kirim,
                sku_id: sku_id,
                qty: qty
            },
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading ...',
                    html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                    timerProgressBar: false,
                    showConfirmButton: false
                });
            },
            dataType: "JSON",
            success: function(response) {
                $("#sku_nama_produk").html(sku_nama_produk);

                $("#table-stock-availability-check tbody").html('')

                $(response).each(function(i, v) {
                    $("#table-stock-availability-check tbody").append(`
                    <tr>
                        <td class="text-center">${v.jenis}</td>
                        <td class="text-center">${v['0']}</td>
                        <td class="text-center">${v['1']}</td>
                        <td class="text-center">${v['2']}</td>
                        <td class="text-center">${v['3']}</td>
                        <td class="text-center">${v['4']}</td>
                        <td class="text-center">${v['5']}</td>
                        <td class="text-center">${v['6']}</td>
                        <td class="text-center">${v['7']}</td>
                        <td class="text-center">${v['8']}</td>
                        <td class="text-center">${v['9']}</td>
                        <td class="text-center">${v['10']}</td>
                        <td class="text-center">${v['11']}</td>
                        <td class="text-center">${v['12']}</td>
                    </tr>
                     `)
                });

                $("#modal-stock-avaibility-check").modal("show");
            },
            complete: function() {
                Swal.close(); // Menutup SweetAlert
            }
        });
    }

    function generateRandomId(length) {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        var randomId = '';
        for (var i = 0; i < length; i++) {
            randomId += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return randomId;
    }

    function formatNominal(input) {
        var nStr = input.value + '';
        nStr = nStr.replace(/\D/g, "");
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        input.value = x1 + x2;
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }

    function GetDataSalesOrderDropshipper() {
        $.ajax({
            type: 'GET',
            url: "<?= base_url('FAS/SalesOrderDropshipper/Get_data_sales_order_dropshipper_by_id') ?>",
            data: {
                sales_order_id: $("#salesorder-sales_order_no_reff").val()
            },
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading ...',
                    html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                    timerProgressBar: false,
                    showConfirmButton: false
                });
            },
            dataType: "JSON",
            success: function(response) {

                if (response.length > 0) {
                    $.each(response, function(i, v) {
                        $("#salesorder-sales_order_no_po").val(v.sales_order_no_po);
                        $("#salesorder-sales_order_tgl").val(v.sales_order_tgl);
                        $("#salesorder-sales_order_tgl_exp").val(v.sales_order_tgl_exp);
                        $("#salesorder-sales_order_tgl_harga").val(v.sales_order_tgl_harga);
                        $("#salesorder-sales_order_tgl_sj").val(v.sales_order_tgl_sj);
                        $("#salesorder-sales_order_tgl_kirim").val(v.sales_order_tgl_kirim);

                        $('#salesorder-client_wms_id').val(v.client_wms_id).trigger('change');
                        $('#salesorder-principle_id').val(v.principle_id).trigger('change');
                        $('#salesorder-sales_id').val(v.sales_id).trigger('change');
                        $('#salesorder-tipe_sales_order_id').val(v.tipe_sales_order_id).trigger('change');
                        $('#salesorder-tipe_delivery_order_id').val(v.tipe_delivery_order_id).trigger('change');

                        $(".customer-name").append(v.client_pt_nama);
                        $(".customer-address").append(v.client_pt_alamat);
                        $(".customer-area").append(v.area_nama);

                        $("#salesorder-client_pt_id").val(v.client_pt_id);
                        $("#salesorder-sales_order_kirim_nama").val(v.client_pt_nama);
                        $("#salesorder-sales_order_kirim_nama").val(v.client_pt_nama);
                        $("#salesorder-sales_order_kirim_alamat").val(v.client_pt_alamat);
                        $("#salesorder-sales_order_kirim_provinsi").val(v.client_pt_propinsi);
                        $("#salesorder-sales_order_kirim_kota").val(v.client_pt_kota);
                        $("#salesorder-sales_order_kirim_kecamatan").val(v.client_pt_kecamatan);
                        $("#salesorder-sales_order_kirim_kelurahan").val(v.client_pt_kelurahan);
                        $("#salesorder-sales_order_kirim_kodepos").val(v.client_pt_kodepos);
                        $("#salesorder-sales_order_kirim_telepon").val(v.client_pt_telepon);
                        $("#salesorder-sales_order_kirim_area").val(v.area_nama);

                        $('input[id="salesorder-sales_order_tipe_pembayaran"][value="' + v.sales_order_tipe_pembayaran + '"]').prop('checked', true);
                        $('input[id="salesorder-sales_order_tipe_ppn"][value="' + v.sales_order_tipe_ppn + '"]').prop('checked', true);

                        $("#cek_customer").val(1);
                    });
                } else {
                    $("#salesorder-sales_order_no_po").val('');
                    $("#salesorder-sales_order_tgl").val('');
                    $("#salesorder-sales_order_tgl_exp").val('');
                    $("#salesorder-sales_order_tgl_harga").val('');
                    $("#salesorder-sales_order_tgl_sj").val('');
                    $("#salesorder-sales_order_tgl_kirim").val('');

                    $('#salesorder-client_wms_id').val('').trigger('change');
                    $('#salesorder-principle_id').val('').trigger('change');
                    $('#salesorder-sales_id').val('').trigger('change');
                    $('#salesorder-tipe_sales_order_id').val('').trigger('change');
                    $('#salesorder-tipe_delivery_order_id').val('').trigger('change');

                    $(".customer-name").append('');
                    $(".customer-address").append('');
                    $(".customer-area").append('');

                    $("#salesorder-client_pt_id").val('');
                    $("#salesorder-sales_order_kirim_nama").val('');
                    $("#salesorder-sales_order_kirim_nama").val('');
                    $("#salesorder-sales_order_kirim_alamat").val('');
                    $("#salesorder-sales_order_kirim_provinsi").val('');
                    $("#salesorder-sales_order_kirim_kota").val('');
                    $("#salesorder-sales_order_kirim_kecamatan").val('');
                    $("#salesorder-sales_order_kirim_kelurahan").val('');
                    $("#salesorder-sales_order_kirim_kodepos").val('');
                    $("#salesorder-sales_order_kirim_telepon").val('');
                    $("#salesorder-sales_order_kirim_area").val('');

                    $('input[id="salesorder-sales_order_tipe_pembayaran"][value="0"]').prop('checked', true);
                    $('input[id="salesorder-sales_order_tipe_ppn"][value="0"]').prop('checked', true);

                    $("#cek_customer").val(0);

                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");
            },
            complete: function() {
                Swal.close();
            }
        });
    }

    function Get_sales_order_by_top() {
        <?php if ($act == "add") { ?>
            $("#filter-delivery_order_id").html('');
            $("#filter-delivery_order_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
            $("#filter-delivery_order_id").hide();
        <?php } else if ($act == "edit") { ?>
            $("#filter-delivery_order_id").html('');
            $("#filter-delivery_order_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
            $("#filter-delivery_order_id").hide();
        <?php } ?>
    }
</script>