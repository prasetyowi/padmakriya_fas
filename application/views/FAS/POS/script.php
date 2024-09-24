<script type="text/javascript">
    var jumlah_sku = 0;
    var layanan = "";
    let arr_sku = [];
    let arr_header = [];
    let arr_detail = [];
    var cek_qty = 0;
    var cek_tipe_stock = 0;
    var arr_sales_order = [];
    var arr_sales_order_detail = [];
    var arr_sales_order_payment = [];
    var arr_so_detail2_ed = [];
    var sku_id = "85FBCEB7-0253-4030-8190-042BEF9BA247";
    var sku_expdate = "2022-06-30";
    var total_qty_SKU_ED = 0;
    var item_so_count = parseInt($("#item-count-SalesOrderDetail").val());
    var item_so2_count = parseInt($("#item-count-SalesOrderDetail2").val());
    var index_sku_ed = 0;
    var total_so_detail2_qty = 0;
    var arr_do_id_detail2 = [];
    var idx_so_detail = 0;
    var idx_so_payment = 0;

    $('#select-so').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="CheckboxSO"]:checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('[name="CheckboxSO"]:checkbox').each(function() {
                this.checked = false;
            });
        }
    });

    $(document).ready(function() {
        $('.select2').select2();
        if ($('#filter-so-date').length > 0) {
            $('#filter-so-date').daterangepicker({
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

        <?php if (isset($act)) { ?>
            <?php if ($act == "edit") { ?>

                <?php foreach ($SODetail as $detail) : ?>
                    arr_sales_order_detail.push({
                        'idx': idx_so_detail,
                        'sku_id': "<?= $detail['sku_id'] ?>",
                        'sku_stock_id': "<?= $detail['sku_stock_id'] ?>",
                        'sku_expdate': "<?= $detail['sku_expdate'] ?>",
                        'sku_qty': <?= $detail['sku_qty'] ?>,
                        'sku_disc_rp': <?= $detail['sku_disc_rp'] ?>,
                        'sku_harga_nett': <?= $detail['sku_harga_nett'] ?>,
                        'delivery_order_reff_id': "<?= $detail['delivery_order_reff_id'] ?>"
                    });

                    idx_so_detail++;
                <?php endforeach; ?>

                <?php foreach ($SOPayment as $payment) : ?>
                    arr_sales_order_payment.push({
                        'idx': idx_so_payment,
                        'sales_order_detail_payment_tipe': "<?= $payment['sales_order_detail_payment_tipe'] ?>",
                        'sales_order_detail_payment_nominal': <?= $payment['sales_order_detail_payment_nominal'] ?>,
                    });
                    idx_so_payment++;
                <?php endforeach; ?>

                pushToTableSKUDelivery();
                pushToTableSOPayment();
                GetTotalPayment();

            <?php } else if ($act == "detail") { ?>

                <?php foreach ($SODetail as $detail) : ?>
                    arr_sales_order_detail.push({
                        'idx': idx_so_detail,
                        'sku_id': "<?= $detail['sku_id'] ?>",
                        'sku_stock_id': "<?= $detail['sku_stock_id'] ?>",
                        'sku_expdate': "<?= $detail['sku_expdate'] ?>",
                        'sku_qty': <?= $detail['sku_qty'] ?>,
                        'sku_disc_rp': <?= $detail['sku_disc_rp'] ?>,
                        'sku_harga_nett': <?= $detail['sku_harga_nett'] ?>,
                        'delivery_order_reff_id': "<?= $detail['delivery_order_reff_id'] ?>"
                    });

                    idx_so_detail++;
                <?php endforeach; ?>

                <?php foreach ($SOPayment as $payment) : ?>
                    arr_sales_order_payment.push({
                        'idx': idx_so_payment,
                        'sales_order_detail_payment_tipe': "<?= $payment['sales_order_detail_payment_tipe'] ?>",
                        'sales_order_detail_payment_nominal': <?= $payment['sales_order_detail_payment_nominal'] ?>,
                    });
                    idx_so_payment++;
                <?php endforeach; ?>

                pushToTableSKUDeliveryDetail();
                pushToTableSOPaymentDetail();
                GetTotalPayment();
            <?php } ?>
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
                var sku_id = this.getAttribute('data-sku_id');
                var sku_stock_id = this.getAttribute('data-sku_stock_id');
                var sku_expdate = this.getAttribute('data-sku_expdate');

                arr_sales_order_detail.push({
                    'idx': idx_so_detail,
                    'sku_id': sku_id,
                    'sku_stock_id': sku_stock_id,
                    'sku_expdate': sku_expdate,
                    'sku_qty': 0,
                    'sku_disc_rp': 0,
                    'sku_harga_nett': 0,
                    'delivery_order_reff_id': ""
                });

                idx_so_detail++;
            });
        } else {
            $('[name="CheckboxSKU"]:checkbox').each(function() {
                this.checked = false;
            });
        }
    });

    function getCustomer() {
        initDataCustomer();
        $("#panel-customer").show();
    }

    $("#btn-choose-customer").on("click", function() {
        getCustomer();
    });


    $("#btn-choose-prod-delivery").on("click", function() {
        $("#modal-sku").modal('show');
        initDataSKU();
    });

    $("#btn-search-sku").on("click", function() {
        initDataSKU();
    });

    $("#btn-search-customer").on("click", function() {
        getCustomer();
    });

    $("#btn-search-data-so").on("click", function() {
        GetDataSO();
    });

    function GetDataSO() {
        const load_start = () => {

            Swal.fire({
                title: 'Loading ...',
                html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                timerProgressBar: false,
                showConfirmButton: false
            });

            $("#btn-approv-so").prop("disabled", true);
            $("#btn-search-data-so").prop("disabled", true);
            $('#select-do').prop("checked", false);

        };

        const proses = () => {

            $('#table_list_data_so').DataTable().clear();
            $('#table_list_data_so').DataTable().destroy();

            $('#table_list_data_so').DataTable({
                "scrollX": true,
                'paging': true,
                'searching': false,
                'ordering': true,
                'processing': true,
                'serverSide': true,
                'ajax': {
                    url: "<?= base_url('FAS/POS/search_so_by_filter') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        tgl: $("#filter-so-date").val(),
                        tgl_kirim: $("#filter-so-date-kirim").val(),
                        perusahaan: $("#filter-perusahaan").val(),
                        status: $("#filter-status").val(),
                        kode: $("#filter-so-number").val(),
                        tipe: $("#filter-tipe").val(),
                        sales: $("#filter-sales").val(),
                        principle: $("#filter-principle").val(),
                        is_priority: $("#filter-priority").val()
                    }
                },
                "drawCallback": function(response) {
                    // Here the response
                    var resp = response.json;
                    $("#jml_so").val(resp.recordsTotal);
                },
                'columns': [{
                        data: 'no_urut',
                    },
                    {
                        data: 'sales_order_tgl'
                    },
                    {
                        data: 'sales_order_kode'
                    },
                    {
                        data: 'sales_order_status'
                    },
                    {
                        data: 'tipe_sales_order_nama'
                    },
                    {
                        data: 'tipe_sales_order_nama'
                    },
                    {
                        data: 'client_pt_nama'
                    },
                    {
                        data: 'client_pt_alamat'
                    },
                    {
                        data: 'client_pt_telepon'
                    },
                    {
                        render: function(data, type, row) {
                            return Math.round(row.sku_harga_nett);
                        },
                        data: null,
                        targets: 9
                    }, {
                        render: function(data, type, row) {
                            return Math.round(row.sales_order_detail_payment_nominal);
                        },
                        data: null,
                        targets: 10
                    },
                    {
                        render: function(data, type, row) {
                            if (row.sales_order_status == "Approved") {
                                return `<button onclick="btnAction('${row.sales_order_id}', '${row.tglUpdate}', '${row.sales_order_status}')" class="btn btn-success btn-small"><i class="fa fa-search"></i></button>`;
                            } else if (row.sales_order_status == "In Progress Approval") {
                                return `<button onclick="btnAction('${row.sales_order_id}', '${row.tglUpdate}', '${row.sales_order_status}')" class="btn btn-warning btn-small"><i class="fa fa-search"></i></button>`;
                            } else if (row.sales_order_status == "Rejected") {
                                return `<button onclick="btnAction('${row.sales_order_id}', '${row.tglUpdate}', '${row.sales_order_status}')" class="btn btn-danger btn-small"><i class="fa fa-search"></i></button>`;
                            } else {
                                return `<button onclick="btnAction('${row.sales_order_id}', '${row.tglUpdate}', '${row.sales_order_status}')" class="btn btn-primary btn-small"><i class="fa fa-pencil"></i></button>`;
                            }
                        },
                        data: null,
                        targets: 16
                    },
                ]
            });

        };

        const load_end = () => {
            $("#btn-approv-so").prop("disabled", false);
            $("#btn-search-data-so").prop("disabled", false);
            Swal.close();
        };

        load_start();

        setTimeout(() => {
            proses()
            load_end();
        }, 1000);
    }

    function btnAction(id, tglUpdate, status) {
        requestAjax("<?= base_url('FAS/POS/checkLastUpdate'); ?>", {
            id: id,
            tglUpdate: tglUpdate == 'null' ? '' : tglUpdate
        }, "POST", "JSON", function(response) {
            if (response == 1) {
                if (status == 'In Progress Approval') {
                    window.location.href = "<?= base_url('FAS/POS/detail/?id=') ?>" + id + ""
                } else if (status == 'Approved') {
                    window.location.href = "<?= base_url('FAS/POS/detail/?id=') ?>" + id + ""
                } else if (status == 'Rejected') {
                    window.location.href = "<?= base_url('FAS/POS/detail/?id=') ?>" + id + ""
                } else {
                    window.location.href = "<?= base_url('FAS/POS/edit/?id=') ?>" + id + ""
                }
            } else {
                return messageNotSameLastUpdated();
            }
        })

    }

    function getSelectedCustomer(customer) {

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
            url: "<?= base_url('FAS/POS/GetSelectedCustomer') ?>",
            data: {
                customer: customer
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

                });
            }
        });
    }

    $("#btn-choose-sku-multi").on("click", function() {
        if (arr_sales_order_detail.length > 0) {
            $("#modal-sku").modal('hide');
            pushToTableSKUDelivery();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Pilih SKU!'
            });
        }

    });

    function PushArraySOPayment() {
        arr_sales_order_payment.push({
            'idx': idx_so_payment,
            'sales_order_detail_payment_tipe': "",
            'sales_order_detail_payment_nominal': 0,
        });

        const uniqueArray = [];
        const seenIds = {};

        for (const obj of arr_sales_order_payment) {
            if (!seenIds[obj.sales_order_detail_payment_tipe]) {
                seenIds[obj.sales_order_detail_payment_tipe] = true;
                uniqueArray.push(obj);
            }
        }
        arr_sales_order_payment = uniqueArray;

        idx_so_payment++;

        pushToTableSOPayment();
    }

    function PushArraySODetail(index, sku_id, sku_stock_id, sku_expdate) {
        $("#select-sku").prop("checked", false);

        if ($('[id="check-sku-' + index + '"]:checked').length > 0) {
            arr_sales_order_detail.push({
                'idx': idx_so_detail,
                'sku_id': sku_id,
                'sku_stock_id': sku_stock_id,
                'sku_expdate': sku_expdate,
                'sku_qty': 0,
                'sku_disc_rp': 0,
                'sku_harga_nett': 0,
                'delivery_order_reff_id': ""
            });

            idx_so_detail++;

            const uniqueArray = [];
            const seenIds = {};

            for (const obj of arr_sales_order_detail) {
                if (!seenIds[obj.sku_stock_id]) {
                    seenIds[obj.sku_stock_id] = true;
                    uniqueArray.push(obj);
                }
            }
            arr_sales_order_detail = uniqueArray;
        } else {
            const findIndexData = arr_sales_order_detail.findIndex((value) => value.sku_stock_id == sku_stock_id);
            if (findIndexData > -1) { // only splice array when item is found
                arr_sales_order_detail.splice(findIndexData, 1); // 2nd parameter means remove one item only
            }
        }
    }

    function initDataCustomer() {

        $("#panel-customer").show();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/POS/GetCustomerByTypePelayanan') ?>",
            data: {
                nama: $("#filter-client-name").val(),
                alamat: $("#filter-client-address").val(),
                telp: $("#filter-client-phone").val(),
                client_pt_id: $("#salesorder-client_pt_id").val(),
            },
            dataType: "JSON",
            success: function(response) {

                $("#table-customer > tbody").empty();

                if (response != 0) {
                    $.each(response, function(i, v) {

                        $("#table-customer > tbody").append(`
                            <tr id="row-${i}">
                                <td style="display: none">
                                    <input type="hidden" id="item-${i}-SalesOrder-client_pt_id" value="${v.client_pt_id}" />
                                    <input type="hidden" id="item-${i}-SalesOrder-client_pt_propinsi" value="${v.client_pt_propinsi}" />
                                    <input type="hidden" id="item-${i}-SalesOrder-client_pt_kota" value="${v.client_pt_kota}" />
                                    <input type="hidden" id="item-${i}-SalesOrder-client_pt_kecamatan" value="${v.client_pt_kecamatan}" />
                                    <input type="hidden" id="item-${i}-SalesOrder-client_pt_kelurahan" value="${v.client_pt_kelurahan}" />
                                    <input type="hidden" id="item-${i}-SalesOrder-client_pt_kodepos" value="${v.client_pt_kodepos}" />
                                    <input type="hidden" id="item-${i}-SalesOrderDetail-area_id" value="${v.area_id}" />
                                </td>
                                <td class="text-center">
                                    <span class="client-pt-nama-label">${v.client_pt_nama}</span>
                                    <input type="hidden" id="item-${i}-SalesOrder-client_pt_nama" class="form-control client-pt-nama" value="${v.client_pt_nama}" />
                                </td>
                                <td class="text-center">
                                    <span class="client-pt-alamat-label">${v.client_pt_alamat}</span>
                                    <input type="hidden" id="item-${i}-SalesOrder-client_pt_alamat" class="form-control client-pt-alamat" value="${v.client_pt_alamat}" />
                                </td>
                                <td class="text-center">
                                    <span class="client-pt-telepon-label">${v.client_pt_telepon}</span>
                                    <input type="hidden" id="item-${i}-SalesOrder-client_pt_telepon" class="form-control client-pt-telepon" value="${v.client_pt_telepon}" />
                                </td>
                                <td class="text-center">
                                    <span class="area-nama-label">${v.area_nama}</span>
                                    <input type="hidden" id="item-${i}-SalesOrder-area_nama" class="form-control area-nama" value="${v.area_nama}" />
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-small btn-select-customer" onclick="getSelectedCustomer('${v.client_pt_id}')"><i class="fa fa-angle-down"></i></button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $("#table-customer > tbody").append(`
					    <tr>
						    <td colspan="5" class="text-danger text-center">Data Koson</td>
						</tr>
					`);
                }
            }
        });
    }

    function initDataSKU() {
        // var perusahaan = $("#filter-perusahaan-sku").val();
        var sku_induk = $("#filter-sku-induk").val();
        var sku_nama_produk = $("#filter-sku-nama-produk").val();
        var sku_kemasan = $("#filter-sku-kemasan").val();
        var sku_satuan = $("#filter-sku-satuan").val();
        var principle = $("#filter-principle").val();
        var brand = $("#filter-brand").val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/POS/search_filter_chosen_sku') ?>",
            data: {
                brand: brand,
                principle: principle,
                sku_induk: sku_induk,
                sku_nama_produk: sku_nama_produk,
                sku_kemasan: sku_kemasan,
                sku_satuan: sku_satuan,
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
                                    <input type="checkbox" name="CheckboxSKU" data-sku_id="${v.sku_id}" data-sku_stock_id="${v.sku_stock_id}" data-sku_expdate="${v.sku_expdate}" id="check-sku-${i}" value="${v.sku_id}" onclick="PushArraySODetail('${i}','${v.sku_id}', '${v.sku_stock_id}', '${v.sku_expdate}')">
                                </td>
                                <td class="text-left">${v.sku_kode}</td>
                                <td class="text-left">${v.sku_induk}</td>
                                <td class="text-left">${v.sku_nama_produk}</td>
                                <td class="text-left">${v.sku_kemasan}</td>
                                <td class="text-left">${v.sku_satuan}</td>
                                <td class="text-left">${v.principle}</td>
                                <td class="text-left">${v.brand}</td>
                                <td class="text-left">${v.sku_expdate}</td>
                                <td class="text-right">${v.sku_stock_qty}</td>
                            </tr>
                        `);
                    });

                    $('#table-sku').DataTable({
                        "searching": false,
                        "ordering": false,
                        lengthMenu: [
                            [-1],
                            ['All']
                        ],
                    });
                } else {
                    $("#table-sku > tbody").html(`<tr><td colspan="10" class="text-center text-danger">Data Kosong</td></tr>`);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log("Error", "Error 500 Internal Server Connection Failure", "error");
                Swal.close();
            },
            complete: function() {
                Swal.close();
            }
        });

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
        arr_sales_order_detail2 = [];
        arr_so_detail2_ed = [];

        $("#table-sku-delivery-only > tbody").empty();
        $("#table-sku > tbody").empty();
        $("#table-ed-sku > tbody").empty();
        $("#table-ed-sku-retur > tbody").empty();
        // initDataSKU();
    }

    function pushToTableSKUDelivery() {

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/POS/Get_list_sales_order_detail') ?>",
            data: {
                arr_sales_order_detail: arr_sales_order_detail
            },
            dataType: "JSON",
            async: false,
            success: function(response) {

                $('#table-sku-delivery-only').fadeOut("slow", function() {
                    $(this).hide();
                    $('#table-sku-delivery-only > tbody').html('');
                    $('#table-sku-delivery-only > tbody').empty('');

                }).fadeIn("slow", function() {
                    $(this).show();

                    if (response.length > 0) {

                        $.each(response, function(i, v) {
                            $("#table-sku-delivery-only > tbody").append(`
                                <tr id="row-${i}">
                                    <td class="text-center">
                                        ${i+1}
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-idx" class="form-control" value="${v.idx}"/>
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-sku_id" class="form-control" value="${v.sku_id}"/>
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-sku_stock_id" class="form-control" value="${v.sku_stock_id}"/>
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-sku_expdate" class="form-control" value="${v.sku_expdate}"/>
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-sku_harga_satuan" class="form-control" value="${v.sku_harga_satuan}"/>
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-delivery_order_reff_id" class="form-control" value="${v.delivery_order_reff_id}"/>
                                    </td>
                                    <td class="text-left">${v.sku_kode}</td>
                                    <td class="text-left">${v.sku_nama_produk}</td>
                                    <td class="text-left">${v.sku_kemasan}</td>
                                    <td class="text-left">${v.sku_satuan}</td>
                                    <td class="text-left">${v.sku_expdate}</td>
                                    <td class="text-right">${formatRupiah(v.sku_harga_satuan.toString())}</td>
                                    <td class="text-center">
                                        <input type="text" id="item-${i}-SalesOrderDetail-sku_qty" class="form-control text-right mask-money" value="${v.sku_qty}" onchange="UpdateSODetail('${v.sku_stock_id}', '${i}')" />
                                    </td>
                                    <td class="text-center">
                                        <input type="text" id="item-${i}-SalesOrderDetail-sku_disc_rp" class="form-control text-right mask-money" value="${v.sku_disc_rp}" onchange="UpdateSODetail('${v.sku_stock_id}', '${i}')" />
                                    </td>
                                    <td class="text-center">
                                        <input type="text" id="item-${i}-SalesOrderDetail-sku_harga_nett" class="form-control text-right mask-money" value="${v.sku_harga_nett}" disabled/>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSODetail('${i}','${v.sku_stock_id}')"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            `);
                        });

                        run_input_mask_money();

                    }
                });
            }
        });
    }

    function pushToTableSKUDeliveryDetail() {

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/POS/Get_list_sales_order_detail') ?>",
            data: {
                arr_sales_order_detail: arr_sales_order_detail
            },
            dataType: "JSON",
            async: false,
            success: function(response) {

                $('#table-sku-delivery-only').fadeOut("slow", function() {
                    $(this).hide();
                    $('#table-sku-delivery-only > tbody').html('');
                    $('#table-sku-delivery-only > tbody').empty('');

                }).fadeIn("slow", function() {
                    $(this).show();

                    if (response.length > 0) {

                        $.each(response, function(i, v) {
                            $("#table-sku-delivery-only > tbody").append(`
                                <tr id="row-${i}">
                                    <td class="text-center">
                                        ${i+1}
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-idx" class="form-control" value="${v.idx}"/>
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-sku_id" class="form-control" value="${v.sku_id}"/>
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-sku_stock_id" class="form-control" value="${v.sku_stock_id}"/>
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-sku_expdate" class="form-control" value="${v.sku_expdate}"/>
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-sku_harga_satuan" class="form-control" value="${v.sku_harga_satuan}"/>
                                        <input type="hidden" id="item-${i}-SalesOrderDetail-delivery_order_reff_id" class="form-control" value="${v.delivery_order_reff_id}"/>
                                    </td>
                                    <td class="text-left">${v.sku_kode}</td>
                                    <td class="text-left">${v.sku_nama_produk}</td>
                                    <td class="text-left">${v.sku_kemasan}</td>
                                    <td class="text-left">${v.sku_satuan}</td>
                                    <td class="text-left">${v.sku_expdate}</td>
                                    <td class="text-right">${formatRupiah(v.sku_harga_satuan.toString())}</td>
                                    <td class="text-right">${formatRupiah(v.sku_qty.toString())}</td>
                                    <td class="text-right">${formatRupiah(v.sku_disc_rp.toString())}</td>
                                    <td class="text-right">${formatRupiah(v.sku_harga_nett.toString())}</td>
                                </tr>
                            `);
                        });

                    }
                });
            }
        });
    }

    function pushToTableSOPayment() {

        $('#table-so-payment > tbody').html('');
        $('#table-so-payment > tbody').empty('');

        if (arr_sales_order_payment.length > 0) {

            $.each(arr_sales_order_payment, function(i, v) {
                $("#table-so-payment > tbody").append(`
                        <tr id="row-${i}">
                            <td class="text-center">
                                ${i+1}
                                <input type="hidden" id="item-${i}-SalesOrderPayment-idx" class="form-control" value="${v.idx}" />
                            </td>
                            <td class="text-center">
                                <select id="item-${i}-SalesOrderPayment-sales_order_detail_payment_tipe" class="form-control" value="${v.sku_qty}" onchange="UpdateSOPayment('${v.sales_order_detail_payment_tipe}','${i}')">
                                    <option value="Tunai" selected>Tunai</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <input type="text" id="item-${i}-SalesOrderPayment-sales_order_detail_payment_nominal" class="form-control text-right mask-money" value="${v.sales_order_detail_payment_nominal}" onchange="UpdateSOPayment('${v.sales_order_detail_payment_tipe}', '${i}')" />
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSOPayment('${i}','${v.sales_order_detail_payment_tipe}')"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    `);
            });

            run_input_mask_money();
        }
    }

    function pushToTableSOPaymentDetail() {

        $('#table-so-payment').fadeOut("slow", function() {
            $(this).hide();

            $('#table-so-payment > tbody').html('');
            $('#table-so-payment > tbody').empty('');

        }).fadeIn("slow", function() {
            $(this).show();

            if (arr_sales_order_payment.length > 0) {

                $.each(arr_sales_order_payment, function(i, v) {
                    $("#table-so-payment > tbody").append(`
                        <tr id="row-${i}">
                            <td class="text-center">
                                ${i+1}
                                <input type="hidden" id="item-${i}-SalesOrderPayment-idx" class="form-control" value="${v.idx}" />
                            </td>
                            <td class="text-left">${v.sales_order_detail_payment_tipe}</td>
                            <td class="text-right">${formatRupiah(v.sales_order_detail_payment_nominal.toString())}</td>
                        </tr>
                    `);
                });
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
        }
    }

    function UpdateSODetail(sku_stock_id, index) {

        const findIndexData = arr_sales_order_detail.findIndex((value) => value.sku_stock_id == sku_stock_id);
        var sku_harga_nett = 0;

        sku_harga_nett = (parseInt($('#item-' + index + '-SalesOrderDetail-sku_harga_satuan').val()) * parseInt($('#item-' + index + '-SalesOrderDetail-sku_qty').val().replaceAll(".", ""))) - parseInt($('#item-' + index + '-SalesOrderDetail-sku_disc_rp').val().replaceAll(".", ""));

        if (findIndexData > -1) {

            arr_sales_order_detail[findIndexData] = ({
                'idx': $('#item-' + index + '-SalesOrderDetail-idx').val(),
                'sku_id': $('#item-' + index + '-SalesOrderDetail-sku_id').val(),
                'sku_stock_id': $('#item-' + index + '-SalesOrderDetail-sku_stock_id').val(),
                'sku_expdate': $('#item-' + index + '-SalesOrderDetail-sku_expdate').val(),
                'sku_qty': $('#item-' + index + '-SalesOrderDetail-sku_qty').val().replaceAll(".", ""),
                'sku_disc_rp': $('#item-' + index + '-SalesOrderDetail-sku_disc_rp').val().replaceAll(".", ""),
                'sku_harga_nett': sku_harga_nett,
                'delivery_order_reff_id': $('#item-' + index + '-SalesOrderDetail-delivery_order_reff_id').val()
            });

            $('#item-' + index + '-SalesOrderDetail-sku_harga_nett').val(sku_harga_nett);

            GetTotalPayment();

        }
    }

    function UpdateSOPayment(sales_order_detail_payment_tipe, index) {
        const findIndexData = arr_sales_order_payment.findIndex((value) => value.sales_order_detail_payment_tipe == sales_order_detail_payment_tipe);
        var sku_harga_nett = 0;

        sku_harga_nett = (parseInt($('#item-' + index + '-SalesOrderDetail-sku_harga_satuan').val()) * parseInt($('#item-' + index + '-SalesOrderDetail-sku_qty').val().replaceAll(".", ""))) - parseInt($('#item-' + index + '-SalesOrderDetail-sku_disc_rp').val().replaceAll(".", ""));

        if (findIndexData > -1) {

            arr_sales_order_payment[findIndexData] = ({
                'idx': $('#item-' + index + '-SalesOrderPayment-idx').val(),
                'sales_order_detail_payment_tipe': $('#item-' + index + '-SalesOrderPayment-sales_order_detail_payment_tipe').val(),
                'sales_order_detail_payment_nominal': $('#item-' + index + '-SalesOrderPayment-sales_order_detail_payment_nominal').val().replaceAll(".", "")
            });

        }

        console.log(arr_sales_order_payment);
        pushToTableSOPayment();
        GetTotalPayment();
    }

    function DeleteSODetail(index, sku_stock_id) {

        const findIndexData = arr_sales_order_detail.findIndex((value) => value.sku_stock_id == sku_stock_id);

        if (findIndexData > -1) { // only splice array when item is found
            arr_sales_order_detail.splice(findIndexData, 1); // 2nd parameter means remove one item only
        }

        // console.log(arr_sales_order_detail);

        pushToTableSKUDelivery();
        GetTotalPayment();

    }

    function DeleteSOPayment(index, sales_order_detail_payment_tipe) {

        const findIndexData = arr_sales_order_payment.findIndex((value) => value.sales_order_detail_payment_tipe == sales_order_detail_payment_tipe);

        if (findIndexData > -1) { // only splice array when item is found
            arr_sales_order_payment.splice(findIndexData, 1); // 2nd parameter means remove one item only
        }

        // console.log(arr_sales_order_detail);

        pushToTableSOPayment();
        GetTotalPayment();

    }

    $("#btn_save_sales_order").click(function() {
        cek_error = 0;

        if (arr_sales_order_detail.length == 0) {

            let alert = "Belum Adam Barang Yang Dipilih";
            message("Error", alert, "error");

            return false;
        }

        $.each(arr_sales_order_detail, function(i, v) {
            if (parseInt(v.sku_qty) == 0) {
                let alert = "Qty SKU Tidak Boleh 0";
                message("Error", alert, "error");

                cek_error++;

                return false;
            }

        });

        setTimeout(() => {

            // console.log(arr_list_faktur_klaim);

            if ($("#salesorder-tipe_sales_order_id").val() == "") {

                let alert = "Tipe SO Tidak Dipilih";
                message("Error", alert, "error");

                return false;
            }

            if ($("#salesorder-tipe_delivery_order_id").val() == "") {

                let alert = "Tipe Pengiriman Tidak Dipilih";
                message("Error", alert, "error");

                return false;
            }

            if (cek_error == 0) {

                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Pastikan data yang sudah anda input benar!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak"
                }).then((result) => {
                    if (result.value == true) {

                        $.ajax({
                            async: false,
                            url: "<?= base_url('FAS/POS/insert_sales_order'); ?>",
                            type: "POST",
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Loading ...',
                                    html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                                    timerProgressBar: false,
                                    showConfirmButton: false
                                });

                                $("#btn_save_sales_order").prop("disabled", true);
                            },
                            data: {
                                sales_order_id: "",
                                depo_id: "<?= $this->session->userdata('depo_id') ?>",
                                sales_order_kode: "",
                                client_wms_id: "",
                                channel_id: "",
                                sales_order_is_handheld: 0,
                                sales_order_status: "Approved",
                                sales_order_approved_by: "",
                                sales_id: "",
                                client_pt_id: $("#salesorder-client_pt_id").val(),
                                sales_order_tgl: $("#salesorder-sales_order_tgl").val(),
                                sales_order_tgl_exp: "",
                                sales_order_tgl_harga: "",
                                sales_order_tgl_sj: "",
                                sales_order_tgl_kirim: $("#salesorder-sales_order_tgl").val(),
                                sales_order_tipe_pembayaran: "",
                                // sales_order_tipe_pembayaran: document.querySelector('input[id="salesorder-sales_order_tipe_pembayaran"]:checked').value,
                                tipe_sales_order_id: $("#salesorder-tipe_sales_order_id").val(),
                                sales_order_no_po: "",
                                sales_order_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                                sales_order_tgl_create: "",
                                sales_order_is_downloaded: 0,
                                so_is_need_approval: "",
                                tipe_delivery_order_id: $("#salesorder-tipe_delivery_order_id").val(),
                                sales_order_is_uploaded: 0,
                                total_kurang_bayar: $("#Payment-total_kurang_bayar").val().replaceAll(".", ""),
                                detail: arr_sales_order_detail,
                                payment: arr_sales_order_payment
                            },
                            dataType: "JSON",
                            success: function(response) {

                                if (response == 1) {
                                    var alert = "Data Berhasil Disimpan";
                                    message("Success", alert, "success");
                                    setTimeout(() => {
                                        location.href = "<?= base_url() ?>FAS/POS/POSMenu";
                                    }, 500);

                                    ResetForm();
                                } else if (response == "2") {

                                    var msg = "Mutasi Stock sudah ada";
                                    message("Error", alert, "error");
                                } else {
                                    var alert = "Data Gagal Disimpan";
                                    message("Error", alert, "error");
                                }

                                $("#btn_save_sales_order").prop("disabled", false);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                var alert = "Error 500 Internal Server Connection Failure";
                                message("Error", alert, "error");

                                $("#btn_save_sales_order").prop("disabled", false);
                            },
                            complete: function() {
                                // Swal.close();
                                $("#btn_save_sales_order").prop("disabled", false);
                            }
                        });
                    }
                });

            }

        }, 1000);
    });

    $("#btn_update_sales_order").click(function() {
        cek_error = 0;

        if (arr_sales_order_detail.length == 0) {

            let alert = "Belum Adam Barang Yang Dipilih";
            message("Error", alert, "error");

            return false;
        }

        $.each(arr_sales_order_detail, function(i, v) {
            if (parseInt(v.sku_qty) == 0) {
                let alert = "Qty SKU Tidak Boleh 0";
                message("Error", alert, "error");

                cek_error++;

                return false;
            }

        });

        setTimeout(() => {

            // console.log(arr_list_faktur_klaim);

            if ($("#salesorder-tipe_sales_order_id").val() == "") {

                let alert = "Tipe SO Tidak Dipilih";
                message("Error", alert, "error");

                return false;
            }

            if ($("#salesorder-tipe_delivery_order_id").val() == "") {

                let alert = "Tipe Pengiriman Tidak Dipilih";
                message("Error", alert, "error");

                return false;
            }

            if (cek_error == 0) {

                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Pastikan data yang sudah anda input benar!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak"
                }).then((result) => {
                    if (result.value == true) {

                        $.ajax({
                            async: false,
                            url: "<?= base_url('FAS/POS/update_sales_order'); ?>",
                            type: "POST",
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Loading ...',
                                    html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                                    timerProgressBar: false,
                                    showConfirmButton: false
                                });

                                $("#btn_save_sales_order").prop("disabled", true);
                            },
                            data: {
                                sales_order_id: $("#so_id").val(),
                                depo_id: "<?= $this->session->userdata('depo_id') ?>",
                                sales_order_kode: $("#salesorder-sales_order_kode").val(),
                                client_wms_id: "",
                                channel_id: "",
                                sales_order_is_handheld: 0,
                                sales_order_status: "Draft",
                                sales_order_approved_by: "",
                                sales_id: "",
                                client_pt_id: $("#salesorder-client_pt_id").val(),
                                sales_order_tgl: $("#salesorder-sales_order_tgl").val(),
                                sales_order_tgl_exp: "",
                                sales_order_tgl_harga: "",
                                sales_order_tgl_sj: "",
                                sales_order_tgl_kirim: $("#salesorder-sales_order_tgl").val(),
                                sales_order_tipe_pembayaran: "",
                                // sales_order_tipe_pembayaran: document.querySelector('input[id="salesorder-sales_order_tipe_pembayaran"]:checked').value,
                                tipe_sales_order_id: $("#salesorder-tipe_sales_order_id").val(),
                                sales_order_no_po: "",
                                sales_order_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                                sales_order_tgl_create: "",
                                sales_order_is_downloaded: 0,
                                so_is_need_approval: "",
                                tipe_delivery_order_id: $("#salesorder-tipe_delivery_order_id").val(),
                                sales_order_is_uploaded: 0,
                                total_kurang_bayar: $("#Payment-total_kurang_bayar").val().replaceAll(".", ""),
                                tgl_update: $("#tgl_update").val(),
                                detail: arr_sales_order_detail,
                                payment: arr_sales_order_payment
                            },
                            dataType: "JSON",
                            success: function(response) {

                                if (response == 1) {
                                    var alert = "Data Berhasil Disimpan";
                                    message("Success", alert, "success");
                                    setTimeout(() => {
                                        location.href = "<?= base_url() ?>FAS/POS/POSMenu";
                                    }, 500);

                                    ResetForm();
                                } else if (response == "2") {

                                    var msg = "Mutasi Stock sudah ada";
                                    message("Error", alert, "error");
                                } else {
                                    var alert = "Data Gagal Disimpan";
                                    message("Error", alert, "error");
                                }

                                $("#btn_save_sales_order").prop("disabled", false);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                var alert = "Error 500 Internal Server Connection Failure";
                                message("Error", alert, "error");

                                $("#btn_save_sales_order").prop("disabled", false);
                            },
                            complete: function() {
                                // Swal.close();
                                $("#btn_save_sales_order").prop("disabled", false);
                            }
                        });
                    }
                });

            }

        }, 1000);
    });

    function GetTotalPayment() {
        var sub_total = 0;
        var total_diskon = 0;
        var total_akhir = 0;
        var total_bayar = 0;
        var total_kurang_bayar = 0;
        var total_kembalian = 0;

        $.each(arr_sales_order_detail, function(i, v) {
            sub_total += isNaN(parseInt(v.sku_harga_nett)) ? 0 : parseInt(v.sku_harga_nett);
            total_diskon += isNaN(parseInt(v.sku_disc_rp)) ? 0 : parseInt(v.sku_disc_rp);
        });

        $.each(arr_sales_order_payment, function(i, v) {
            total_bayar += isNaN(parseInt(v.sales_order_detail_payment_nominal)) ? 0 : parseInt(v.sales_order_detail_payment_nominal);
        });

        total_akhir = sub_total - total_diskon;
        total_kurang_bayar = total_akhir - total_bayar;
        total_kembalian = total_bayar - total_akhir;

        $("#Payment-subtotal").val(sub_total);
        $("#Payment-diskon").val(total_diskon);
        $("#Payment-total_akhir").val(total_akhir);
        $("#Payment-total_bayar").val(total_bayar);
        $("#Payment-total_kurang_bayar").val(total_kurang_bayar);
        $("#Payment-total_kembalian").val(total_kembalian);

    }
</script>