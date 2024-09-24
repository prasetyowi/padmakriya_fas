<script type="text/javascript">
    var jumlah_sku = 0;
    var layanan = "";
    let arr_sku = [];
    let arr_header = [];
    let arr_detail = [];
    var cek_qty = 0;
    var cek_tipe_stock = 0;
    var arr_back_order = [];
    var arr_back_order_detail = [];
    var arr_back_order_detail2 = [];
    var arr_back_order_detail22 = [];
    var arr_so_detail2_ed = [];
    var sku_id = "85FBCEB7-0253-4030-8190-042BEF9BA247";
    var sku_expdate = "2022-06-30";
    var total_qty_SKU_ED = 0;
    var item_so_count = parseInt($("#item-count-BackOrderDetail").val());
    var item_so2_count = parseInt($("#item-count-BackOrderDetail2").val());
    var index_sku_ed = 0;
    var idx_detail2 = 0;
    var total_so_detail2_qty = 0;
    var arr_do_id_detail2 = [];
    var cek_total_arr_back_order_detail = 0;
    var arr_list_schedule_sku = [];

    function message_custom(titleType, iconType, htmlType) {
        Swal.fire({
            title: titleType,
            icon: iconType,
            html: htmlType,
        });
    }

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

    $(document).ready(
        function() {

            run_input_mask_money();

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

            delete_back_order_detail_2_temp_all();

            <?php if ($act == "edit") { ?>
                // if (item_so_count > 0) {
                //     for (var i = 0; i < item_so_count; i++) {
                //         var randomId = generateRandomId(10);
                //         var sku_id = $("#item-" + i + "-BackOrderDetail-sku_id").val();

                //         $(`#btn_delete_sku-${i}`).attr('onclick', `DeleteSKU(this,'${i}','${sku_id}', '${randomId}')`);

                //         arr_back_order_detail.push({
                //             'client_wms_id': $("#item-" + i + "-BackOrderDetail-client_wms_id").val(),
                //             'client_wms_tax': $("#ppn_global_percent").val(),
                //             'principle_id': $("#item-" + i + "-BackOrderDetail-principle_id").val(),
                //             'principle': $("#item-" + i + "-BackOrderDetail-principle").val(),
                //             'brand': $("#item-" + i + "-BackOrderDetail-brand").val(),
                //             'sku_id': $("#item-" + i + "-BackOrderDetail-sku_id").val(),
                //             'sku_kode': $("#item-" + i + "-BackOrderDetail-sku_kode").val(),
                //             'sku_nama_produk': $("#item-" + i + "-BackOrderDetail-sku_nama_produk").val(),
                //             // 'sku_harga_satuan': $("#item-" + i + "-BackOrderDetail-sku_harga_satuan").val(),
                //             'sku_harga_satuan': $("#item-" + i + "-BackOrderDetail-sku_harga_satuan").val(),
                //             // 'sku_disc_percent': $("#item-" + i + "-BackOrderDetail-sku_disc_percent").val(),
                //             'sku_disc_percent': $("#item-" + i + "-BackOrderDetail-sku_disc_percent").val(),
                //             // 'sku_disc_rp': $("#item-" + i + "-BackOrderDetail-sku_disc_rp").val(),
                //             'sku_disc_rp': $("#caption-" + i + "-BackOrderDetail-sku_disc_rp").text(),
                //             // 'sku_harga_nett': $("#item-" + i + "-BackOrderDetail-sku_harga_nett").val(),
                //             'sku_harga_nett': $("#caption-" + i + "-BackOrderDetail-sku_harga_nett").text(),
                //             'sku_weight': $("#item-" + i + "-BackOrderDetail-sku_weight").val(),
                //             'sku_weight_unit': $("#item-" + i + "-BackOrderDetail-sku_weight_unit").val(),
                //             'sku_length': $("#item-" + i + "-BackOrderDetail-sku_length").val(),
                //             'sku_length_unit': $("#item-" + i + "-BackOrderDetail-sku_length_unit").val(),
                //             'sku_width': $("#item-" + i + "-BackOrderDetail-sku_width").val(),
                //             'sku_width_unit': $("#item-" + i + "-BackOrderDetail-sku_width_unit").val(),
                //             'sku_height': $("#item-" + i + "-BackOrderDetail-sku_height").val(),
                //             'sku_height_unit': $("#item-" + i + "-BackOrderDetail-sku_height_unit").val(),
                //             'sku_volume': $("#item-" + i + "-BackOrderDetail-sku_volume").val(),
                //             'sku_volume_unit': $("#item-" + i + "-BackOrderDetail-sku_volume_unit").val(),
                //             'sku_qty': $("#item-" + i + "-BackOrderDetail-sku_qty").val(),
                //             'sku_keterangan': $("#item-" + i + "-BackOrderDetail-sku_keterangan").val(),
                //             'sku_request_expdate': $("#item-" + i + "-BackOrderDetail-sku_request_expdate").val(),
                //             'sku_filter_expdate': $("#item-" + i + "-BackOrderDetail-sku_filter_expdate").val(),
                //             'sku_filter_expdatebulan': $("#item-" + i + "-BackOrderDetail-sku_filter_expdatebulan").val(),
                //             'sku_satuan': $("#item-" + i + "-BackOrderDetail-sku_satuan").val(),
                //             'sku_kemasan': $("#item-" + i + "-BackOrderDetail-sku_kemasan").val(),
                //             'tipe_stock_nama': $("#item-" + i + "-BackOrderDetail-tipe_stock_nama").val(),
                //             'sku_ppn_percent': $("#item-" + i + "-BackOrderDetail-ppn_percent").val(),
                //             'sku_ppn_rp': $("#caption-" + i + "-BackOrderDetail-ppn_rp").text(),
                //             'random_id': randomId,
                //             'sku_diskon_global_percent': $("#caption-" + i + "-BackOrderDetail-sku_disc_global_percent").text(),
                //             'sku_diskon_global_rp': $("#caption-" + i + "-BackOrderDetail-sku_disc_global_rupiah").text()
                //         });
                //     }
                // }

                // if (item_so2_count > 0) {

                //     for (var i = 0; i < item_so2_count; i++) {
                //         $.ajax({
                //             async: false,
                //             type: 'POST',
                //             url: "<?= base_url('FAS/BackOrder/insert_back_order_detail_2_temp') ?>",
                //             data: {
                //                 so_id: $("#so_id").val(),
                //                 sku_stock_id: $("#item-" + i + "-BackOrderDetail2-sku_stock_id").val(),
                //                 sku_id: $("#item-" + i + "-BackOrderDetail2-sku_id").val(),
                //                 sku_expdate: $("#item-" + i + "-BackOrderDetail2-sku_expdate").val(),
                //                 sku_qty: $("#item-" + i + "-BackOrderDetail2-sku_qty").val()
                //             },
                //             dataType: "JSON",
                //             success: function(response) {
                //                 // console.log('success');
                //             }
                //         });

                //         arr_back_order_detail2.push({
                //             'sku_stock_id': $("#item-" + i + "-BackOrderDetail2-sku_stock_id").val(),
                //             'sku_id': $("#item-" + i + "-BackOrderDetail2-sku_id").val(),
                //             'sku_expdate': $("#item-" + i + "-BackOrderDetail2-sku_expdate").val(),
                //             'sku_qty': $("#item-" + i + "-BackOrderDetail2-sku_qty").val()
                //         });
                //     }

                //     // arr_back_order_detail22.push({
                //     // 	'sku_stock_id': $("#item-0-BackOrderDetail2-sku_stock_id").val(),
                //     // 	'sku_id': $("#item-0-BackOrderDetail2-sku_id").val(),
                //     // 	'sku_expdate': $("#item-0-BackOrderDetail2-sku_expdate").val(),
                //     // 	'sku_qty': $("#item-0-BackOrderDetail2-sku_qty").val()
                //     // })
                // }

                <?php foreach ($SODetail as $key => $val) { ?>
                    arr_back_order_detail.push({
                        'client_wms_id': "<?= $val['client_wms_id'] ?>",
                        'client_wms_tax': "<?= $val['client_wms_tax'] ?>",
                        'principle_id': "<?= $val['principle_id'] ?>",
                        'principle': "<?= $val['principle'] ?>",
                        'brand': "<?= $val['brand'] ?>",
                        'sku_id': "<?= $val['sku_id'] ?>",
                        'sku_kode': "<?= $val['sku_kode'] ?>",
                        'sku_nama_produk': "<?= $val['sku_nama_produk'] ?>",
                        'sku_harga_satuan': parseFloat("<?= $val['sku_harga_satuan'] ?>"),
                        'sku_disc_percent': parseFloat("<?= $val['sku_disc_percent'] ?>"),
                        'sku_disc_rp': parseFloat("<?= $val['sku_disc_rp'] ?>"),
                        'sku_harga_nett': parseFloat("<?= $val['sub_total'] ?>"),
                        'sku_weight': "<?= $val['sku_weight'] ?>",
                        'sku_weight_unit': "<?= $val['sku_weight_unit'] ?>",
                        'sku_length': "<?= $val['sku_length'] ?>",
                        'sku_length_unit': "<?= $val['sku_length_unit'] ?>",
                        'sku_width': "<?= $val['sku_width'] ?>",
                        'sku_width_unit': "<?= $val['sku_width_unit'] ?>",
                        'sku_height': "<?= $val['sku_height'] ?>",
                        'sku_height_unit': "<?= $val['sku_height_unit'] ?>",
                        'sku_volume': "<?= $val['sku_volume'] ?>",
                        'sku_volume_unit': "<?= $val['sku_volume_unit'] ?>",
                        'sku_qty': "<?= $val['sku_qty'] ?>",
                        'sku_keterangan': "<?= $val['sku_keterangan'] ?>",
                        'sku_request_expdate': "<?= $val['sku_request_expdate'] ?>",
                        'sku_filter_expdate': "<?= $val['sku_filter_expdate'] ?>",
                        'sku_filter_expdatebulan': "<?= $val['sku_filter_expdatebulan'] ?>",
                        'sku_satuan': "<?= $val['sku_satuan'] ?>",
                        'sku_kemasan': "<?= $val['sku_kemasan'] ?>",
                        'tipe_stock_nama': "<?= $val['tipe_stock_nama'] ?>",
                        'sku_ppn_percent': parseFloat("<?= $val['sku_ppn_percent'] ?>"),
                        'sku_ppn_rp': parseFloat("<?= $val['sku_ppn_rp'] ?>"),
                        'sku_diskon_global_percent': parseFloat("<?= $val['sku_diskon_global_percent'] ?>"),
                        'sku_diskon_global_rp': parseFloat("<?= $val['sku_diskon_global_rp'] ?>"),
                        'random_id': generateRandomId(10)
                    });
                <?php } ?>

                <?php foreach ($SODetail2 as $key => $val) { ?>
                    arr_so_detail2_ed.push({
                        'idx': '<?= $key ?>',
                        'index_so_detail': '',
                        'depo_detail_id': '<?= $val['depo_detail_id'] ?>',
                        'sku_id': '<?= $val['sku_id'] ?>',
                        'sku_stock_expired_date': '<?= $val['sku_expdate'] ?>',
                        'sku_qty': '<?= $val['sku_qty'] ?>',
                        'delivery_order_reff_id': '<?= $val['delivery_order_reff_id'] ?>'
                    });
                <?php } ?>

                <?php foreach ($SODetail2 as $detail2) : ?>
                    arr_do_id_detail2.push('<?= $detail2['delivery_order_reff_id'] ?>');
                <?php endforeach; ?>

                <?php foreach ($DetailSchedule as $key => $value) : ?>
                    arr_list_schedule_sku.push({
                        'idx': idx_detail2,
                        'sku_id': "<?= $value['sku_id'] ?>",
                        'bulan': "<?= $value['bulan'] ?>",
                        'tahun': "<?= $value['tahun'] ?>",
                        'qty': <?= $value['qty'] ?>
                    });

                    idx_detail2++;
                <?php endforeach; ?>

                HeaderReadonly();
                pushToTableSKUDelivery();
            <?php } ?>

            <?php if ($act == "detail") { ?>

                <?php foreach ($SODetail2 as $key => $val) { ?>
                    arr_so_detail2_ed.push({
                        'idx': '<?= $key ?>',
                        'index_so_detail': '',
                        'depo_detail_id': '<?= $val['depo_detail_id'] ?>',
                        'sku_id': '<?= $val['sku_id'] ?>',
                        'sku_stock_expired_date': '<?= $val['sku_expdate'] ?>',
                        'sku_qty': '<?= $val['sku_qty'] ?>',
                        'delivery_order_reff_id': '<?= $val['delivery_order_reff_id'] ?>'
                    });
                <?php } ?>

                <?php foreach ($SODetail2 as $detail2) : ?>
                    arr_do_id_detail2.push('<?= $detail2['delivery_order_reff_id'] ?>');
                <?php endforeach; ?>

                <?php foreach ($DetailSchedule as $key => $value) : ?>
                    arr_list_schedule_sku.push({
                        'idx': idx_detail2,
                        'sku_id': "<?= $value['sku_id'] ?>",
                        'bulan': "<?= $value['bulan'] ?>",
                        'tahun': "<?= $value['tahun'] ?>",
                        'qty': <?= $value['qty'] ?>
                    });

                    idx_detail2++;
                <?php endforeach; ?>

                HeaderReadonly();
            <?php } ?>

            // let uuu = [];
            // let new_data = [];
            // $.each(arr_back_order_detail22, function(i, v) {
            // 	const data_la = arr_back_order_detail2.filter((value) => value.sku_id == sku_id);
            // 	uuu.push(data_la);
            // });

            // console.log(uuu[0]);


            // let new_data = uuu[0].findIndex((value) => value.sku_id == sku_id && value.sku_expdate == sku_expdate);
            // let new_data = arr_back_order_detail2.findIndex((value) => value.sku_id == sku_id && value.sku_expdate == sku_expdate);
            // console.log(arr_back_order_detail2);
            // console.log(new_data);
            // arr_back_order_detail2[new_data]['sku_id'] = "KONTOL";
            // console.log(arr_back_order_detail2);
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

    $('#backorder-so_is_need_approval').click(function(event) {
        if (this.checked) {
            $("#backorder-back_order_status").val("In Progress Approval");
        } else {
            $("#backorder-back_order_status").val("Draft");
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

        $("#backorder-back_order_kirim_nama").val('');
        $("#backorder-back_order_kirim_alamat").val('');
        $("#backorder-back_order_kirim_provinsi").val('');
        $("#backorder-back_order_kirim_kota").val('');
        $("#backorder-back_order_kirim_kecamatan").val('');
        $("#backorder-back_order_kirim_kelurahan").val('');
        $("#backorder-back_order_kirim_kodepos").val('');
        $("#backorder-back_order_kirim_telepon").val('');
        $("#backorder-back_order_kirim_area").val('');

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
        Get_back_order_by_top();
        initDataSKU();
    });

    $("#btn-search-sku").on("click", function() {
        initDataSKU();
    });

    $("#btn-search-customer").on("click", function() {
        getCustomer();
    });

    $("#backorder-sales_id").on("change", function() {
        $("#cek_customer").val(0);

        $(".customer-name").html('');
        $(".customer-address").html('');
        $(".customer-area").html('');

        $("#backorder-back_order_kirim_nama").val('');
        $("#backorder-back_order_kirim_alamat").val('');
        $("#backorder-back_order_kirim_provinsi").val('');
        $("#backorder-back_order_kirim_kota").val('');
        $("#backorder-back_order_kirim_kecamatan").val('');
        $("#backorder-back_order_kirim_kelurahan").val('');
        $("#backorder-back_order_kirim_kodepos").val('');
        $("#backorder-back_order_kirim_telepon").val('');
        $("#backorder-back_order_kirim_area").val('');

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
                url: "<?= base_url('FAS/BackOrder/getPrinciple') ?>",
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
                url: "<?= base_url('FAS/BackOrder/getPrinciple') ?>",
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
                    url: "<?= base_url('FAS/BackOrder/search_so_by_filter') ?>",
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
                        render: function(data, type, row) {
                            if (row.back_order_status == "Approved") {
                                return `<input type="checkbox" name="CheckboxSOApproved" data-tgl-update="${row.tglUpdate}" id="check-so-${row.idx}" value="${row.back_order_id}" disabled checked>
                                <input type="hidden" id="item-${row.idx}-ListSO-back_order_status" value="${row.back_order_status}">
								<input type="hidden" id="counter" value="${row.idx}">`;
                            } else if (row.back_order_status == "In Progress Approval") {
                                return ` <input type="checkbox" name="CheckboxSO" data-tgl-update="${row.tglUpdate}" id="check-so-${row.idx}" value="${row.back_order_id}" checked disabled>
                                <input type="hidden" id="item-${row.idx}-ListSO-back_order_status" value="${row.back_order_status}">
								<input type="hidden" id="counter" value="${row.idx}">`;
                            } else if (row.back_order_status == "Rejected") {
                                return `<input type="checkbox" name="CheckboxSORejected" data-tgl-update="${row.tglUpdate}" id="check-so-${row.idx}" value="${row.back_order_id}" disabled>
                                <input type="hidden" id="item-${row.idx}-ListSO-back_order_status" value="${row.back_order_status}">
								<input type="hidden" id="counter" value="${row.idx}">`;
                            } else if (row.tipe_back_order_nama == "RETUR") {
                                return `<input type="hidden" id="counter" value="${row.idx}">`;
                            } else {
                                return `<input type="checkbox" name="CheckboxSO" data-tgl-update="${row.tglUpdate}" id="check-so-${row.idx}" value="${row.back_order_id}">
                                <input type="hidden" id="item-${row.idx}-ListSO-back_order_status" value="${row.back_order_status}">
								<input type="hidden" id="counter" value="${row.idx}">`;
                            }
                        },
                        data: null,
                        targets: 0,
                        orderable: false
                    },
                    {
                        data: 'back_order_tgl'
                    },
                    {
                        data: 'back_order_tgl_kirim'
                        // render: function(v) {
                        //     v.back_order_tgl_kirim == null ? '-' : v.back_order_tgl_kirim;
                        // },
                        // data: null,
                        // targets: 2
                    },
                    {
                        data: 'back_order_kode'
                    },
                    {
                        data: 'back_order_no_po'
                    },
                    {
                        data: 'kode_sales'
                    },
                    {
                        data: 'karyawan_nama'
                    },
                    {
                        data: 'kode_customer_eksternal'
                    },
                    {
                        data: 'principle_kode'
                    },
                    {
                        data: 'client_wms_nama'
                    },
                    {
                        data: 'client_pt_nama'
                    },
                    {
                        data: 'client_pt_alamat'
                    },
                    {
                        data: 'tipe_back_order_nama'
                    },
                    {
                        data: 'back_order_status'
                    },
                    {
                        render: function(data, type, row) {
                            return Math.round(row.sku_harga_nett);
                        },
                        data: null,
                        targets: 14
                    },
                    {
                        data: 'back_order_keterangan'
                    },
                    {
                        data: 'is_priority'
                    },
                    {
                        render: function(data, type, row) {
                            if (row.back_order_status == "Approved") {
                                return `<button onclick="btnAction('${row.back_order_id}', '${row.tglUpdate}', '${row.back_order_status}')" class="btn btn-success btn-small"><i class="fa fa-search"></i></button>`;
                            } else if (row.back_order_status == "In Progress Approval") {
                                return `<button onclick="btnAction('${row.back_order_id}', '${row.tglUpdate}', '${row.back_order_status}')" class="btn btn-warning btn-small"><i class="fa fa-search"></i></button>`;
                            } else if (row.back_order_status == "Rejected") {
                                return `<button onclick="btnAction('${row.back_order_id}', '${row.tglUpdate}', '${row.back_order_status}')" class="btn btn-danger btn-small"><i class="fa fa-search"></i></button>`;
                            } else {
                                return `<button onclick="btnAction('${row.back_order_id}', '${row.tglUpdate}', '${row.back_order_status}')" class="btn btn-primary btn-small"><i class="fa fa-pencil"></i></button>`;
                            }
                        },
                        data: null,
                        targets: 16
                    },
                    {
                        render: function(data, type, row) {
                            if (row.back_order_status == "Draft" && row.tipe_back_order_nama == "PERMINTAAN CANVAS") {
                                return `<button onclick="GenerateCanvas('${row.back_order_id}')" class="btn btn-success btn-small"><i class="fa fa-save"></i> <span name="CAPTION-GENERATE">Generate</span></button>`;
                            } else {
                                return ``;
                            }
                        },
                        data: null,
                        targets: 17
                    }
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

        // $("#loadingviewso").show();
        // $.ajax({
        //     type: 'POST',
        //     url: "<?= base_url('FAS/BackOrder/search_so_by_filter') ?>",
        //     data: {
        //         tgl: $("#filter-so-date").val(),
        //         tgl_kirim: $("#filter-so-date-kirim").val(),
        //         perusahaan: $("#filter-perusahaan").val(),
        //         status: $("#filter-status").val(),
        //         kode: $("#filter-so-number").val(),
        //         tipe: $("#filter-tipe").val(),
        //         sales: $("#filter-sales").val(),
        //         principle: $("#filter-principle").val()
        //     },
        //     dataType: "JSON",
        //     success: function(response) {

        //         $("#table_list_data_so > tbody").empty();

        //         if ($.fn.DataTable.isDataTable('#table_list_data_so')) {
        //             $('#table_list_data_so').DataTable().clear();
        //             $('#table_list_data_so').DataTable().destroy();
        //         }

        //         if (response.data != 0) {
        //             $("#jml_so").val(response.data.length);
        //             $.each(response.data, function(i, v) {
        //                 if (v.back_order_status == "In Progress Approval") {
        //                     // <a href="<?= base_url() ?>FAS/BackOrder/detail/?id=${v.back_order_id}" class="btn btn-warning btn-small"><i class="fa fa-search"></i></a>
        //                     $("#table_list_data_so > tbody").append(`
        // 					<tr>
        // 						<td class="text-center">
        //                             <input type="checkbox" name="CheckboxSO" data-tgl-update="${v.tglUpdate}" id="check-so-${i}" value="${v.back_order_id}" checked disabled>
        //                             <input type="hidden" id="item-${i}-ListSO-back_order_status" value="${v.back_order_status}">
        //                         </td>
        // 						<td class="text-center">${v.back_order_tgl}</td>
        // 						<td class="text-center">${v.back_order_tgl_kirim == null ? '-' :v.back_order_tgl_kirim}</td>
        // 						<td class="text-center">${v.back_order_kode}</td>
        // 						<td class="text-center">${v.back_order_no_po}</td>
        // 						<td class="text-center">${v.kode_sales}</td>
        // 						<td class="text-center">${v.karyawan_nama}</td>
        // 						<td class="text-center">${v.kode_customer_eksternal}</td>
        // 						<td class="text-center">${v.principle_kode}</td>
        // 						<td class="text-center">${v.client_wms_nama}</td>
        // 						<td class="text-center">${v.client_pt_nama}</td>
        // 						<td class="text-center" style="width:25%;">${v.client_pt_alamat}</td>
        // 						<td class="text-center">${v.tipe_back_order_nama}</td>
        // 						<td class="text-center">${v.back_order_status}</td>
        // 						<td class="text-center">Rp. ${Number(v.sku_harga_nett).toLocaleString()}</td>
        // 						<td class="text-center">${v.back_order_keterangan}</td>
        // 						<td class="text-center"><button onclick="btnAction('${v.back_order_id}', '${v.tglUpdate}', '${v.back_order_status}')" class="btn btn-warning btn-small"><i class="fa fa-search"></i></button></td>
        // 					</tr>
        // 				`);
        //                 } else if (v.back_order_status == "Approved") {
        //                     // <a href="<?= base_url() ?>FAS/BackOrder/detail/?id=${v.back_order_id}" class="btn btn-success btn-small"><i class="fa fa-search"></i></a>
        //                     $("#table_list_data_so > tbody").append(`
        // 					<tr>
        // 						<td class="text-center">
        //                             <input type="checkbox" name="CheckboxSOApproved" data-tgl-update="${v.tglUpdate}" id="check-so-${i}" value="${v.back_order_id}" disabled checked>
        //                             <input type="hidden" id="item-${i}-ListSO-back_order_status" value="${v.back_order_status}">
        //                         </td>
        // 						<td class="text-center">${v.back_order_tgl}</td>
        // 						<td class="text-center">${v.back_order_tgl_kirim == null ? '-' :v.back_order_tgl_kirim}</td>
        // 						<td class="text-center">${v.back_order_kode}</td>
        // 						<td class="text-center">${v.back_order_no_po}</td>
        // 						<td class="text-center">${v.kode_sales}</td>
        // 						<td class="text-center">${v.karyawan_nama}</td>
        // 						<td class="text-center">${v.kode_customer_eksternal}</td>
        // 						<td class="text-center">${v.principle_kode}</td>
        // 						<td class="text-center">${v.client_wms_nama}</td>
        // 						<td class="text-center">${v.client_pt_nama}</td>
        // 						<td class="text-center" style="width:25%;">${v.client_pt_alamat}</td>
        // 						<td class="text-center">${v.tipe_back_order_nama}</td>
        // 						<td class="text-center">${v.back_order_status}</td>
        // 						<td class="text-center">Rp. ${Number(v.sku_harga_nett).toLocaleString()}</td>
        // 						<td class="text-center">${v.back_order_keterangan}</td>
        // 						<td class="text-center"><button onclick="btnAction('${v.back_order_id}', '${v.tglUpdate}', '${v.back_order_status}')" class="btn btn-success btn-small"><i class="fa fa-search"></i></button></td>
        // 					</tr>
        // 				`);
        //                 } else if (v.back_order_status == "Rejected") {
        //                     // <a href="<?= base_url() ?>FAS/BackOrder/detail/?id=${v.back_order_id}" class="btn btn-danger btn-small"><i class="fa fa-search"></i></a>
        //                     $("#table_list_data_so > tbody").append(`
        // 					<tr>
        // 						<td class="text-center">
        //                             <input type="checkbox" name="CheckboxSORejected" data-tgl-update="${v.tglUpdate}" id="check-so-${i}" value="${v.back_order_id}" disabled>
        //                             <input type="hidden" id="item-${i}-ListSO-back_order_status" value="${v.back_order_status}">
        //                         </td>
        // 						<td class="text-center">${v.back_order_tgl}</td>
        // 						<td class="text-center">${v.back_order_tgl_kirim == null ? '-' :v.back_order_tgl_kirim}</td>
        // 						<td class="text-center">${v.back_order_kode}</td>
        // 						<td class="text-center">${v.back_order_no_po}</td>
        // 						<td class="text-center">${v.kode_sales}</td>
        // 						<td class="text-center">${v.karyawan_nama}</td>
        // 						<td class="text-center">${v.kode_customer_eksternal}</td>
        // 						<td class="text-center">${v.principle_kode}</td>
        // 						<td class="text-center">${v.client_wms_nama}</td>
        // 						<td class="text-center">${v.client_pt_nama}</td>
        // 						<td class="text-center" style="width:25%;">${v.client_pt_alamat}</td>
        // 						<td class="text-center">${v.tipe_back_order_nama}</td>
        // 						<td class="text-center">${v.back_order_status}</td>
        // 						<td class="text-center">Rp. ${Number(v.sku_harga_nett).toLocaleString()}</td>
        // 						<td class="text-center">${v.back_order_keterangan}</td>
        // 						<td class="text-center"><button onclick="btnAction('${v.back_order_id}', '${v.tglUpdate}', '${v.back_order_status}')" class="btn btn-danger btn-small"><i class="fa fa-search"></i></button></td>
        // 					</tr>
        // 				`);
        //                 } else {
        //                     // <a href="<?= base_url() ?>FAS/BackOrder/edit/?id=${v.back_order_id}" class="btn btn-primary btn-small"><i class="fa fa-pencil"></i></a>
        //                     $("#table_list_data_so > tbody").append(`
        // 					<tr>
        // 						<td class="text-center">
        //                             <input type="checkbox" name="CheckboxSO" data-tgl-update="${v.tglUpdate}" id="check-so-${i}" value="${v.back_order_id}">
        //                             <input type="hidden" id="item-${i}-ListSO-back_order_status" value="${v.back_order_status}">
        //                         </td>
        // 						<td class="text-center">${v.back_order_tgl}</td>
        // 						<td class="text-center">${v.back_order_tgl_kirim == null ? '-' :v.back_order_tgl_kirim}</td>
        // 						<td class="text-center">${v.back_order_kode}</td>
        // 						<td class="text-center">${v.back_order_no_po}</td>
        // 						<td class="text-center">${v.kode_sales}</td>
        // 						<td class="text-center">${v.karyawan_nama}</td>
        // 						<td class="text-center">${v.kode_customer_eksternal}</td>
        // 						<td class="text-center">${v.principle_kode}</td>
        // 						<td class="text-center">${v.client_wms_nama}</td>
        // 						<td class="text-center">${v.client_pt_nama}</td>
        // 						<td class="text-center" style="width:25%;">${v.client_pt_alamat}</td>
        // 						<td class="text-center">${v.tipe_back_order_nama}</td>
        // 						<td class="text-center">${v.back_order_status}</td>
        // 						<td class="text-center">Rp. ${Number(v.sku_harga_nett).toLocaleString()}</td>
        // 						<td class="text-center">${v.back_order_keterangan}</td>
        // 						<td class="text-center"><button onclick="btnAction('${v.back_order_id}', '${v.tglUpdate}', '${v.back_order_status}')" class="btn btn-primary btn-small"><i class="fa fa-pencil"></i></button></td>
        // 					</tr>
        // 				`);

        //                 }
        //             });
        //             $('#table_list_data_so').DataTable({
        //                 'lengthMenu': [
        //                     [100, 200, 250, -1],
        //                     [100, 200, 250, 'All']
        //                 ],
        //                 'ordering': false,
        //                 "scrollX": true
        //             });
        //         } else {
        //             $("#table_list_data_so > tbody").append(`
        // 				<tr>
        // 					<td colspan="17" class="text-danger text-center">Data Is Empty</td>
        // 				</tr>
        // 			`);
        //         }

        //         $("#loadingviewso").hide();
        //     }
        // });
    }

    function btnAction(id, tglUpdate, status) {
        requestAjax("<?= base_url('FAS/BackOrder/checkLastUpdate'); ?>", {
            id: id,
            tglUpdate: tglUpdate == 'null' ? '' : tglUpdate
        }, "POST", "JSON", function(response) {
            if (response == 1) {
                if (status == 'In Progress Approval') {
                    window.location.href = "<?= base_url('FAS/BackOrder/detail/?id=') ?>" + id + ""
                } else if (status == 'Approved') {
                    window.location.href = "<?= base_url('FAS/BackOrder/detail/?id=') ?>" + id + ""
                } else if (status == 'Rejected') {
                    window.location.href = "<?= base_url('FAS/BackOrder/detail/?id=') ?>" + id + ""
                } else {
                    window.location.href = "<?= base_url('FAS/BackOrder/edit/?id=') ?>" + id + ""
                }
            } else {
                return messageNotSameLastUpdated();
            }
        })

    }

    function getSelectedCustomer(customer, sales) {

        $(".customer-name").html('');
        $(".customer-address").html('');
        $(".customer-area").html('');

        $("#backorder-back_order_kirim_nama").val('');
        $("#backorder-back_order_kirim_alamat").val('');
        $("#backorder-back_order_kirim_provinsi").val('');
        $("#backorder-back_order_kirim_kota").val('');
        $("#backorder-back_order_kirim_kecamatan").val('');
        $("#backorder-back_order_kirim_kelurahan").val('');
        $("#backorder-back_order_kirim_kodepos").val('');
        $("#backorder-back_order_kirim_telepon").val('');
        $("#backorder-back_order_kirim_area").val('');

        $("#modal-factory").modal('hide');
        $("#modal-customer").modal('hide');

        $("#cek_customer").val(0);

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/BackOrder/GetSelectedCustomer') ?>",
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

                        $("#backorder-client_pt_id").val(v.client_pt_id);
                        $("#backorder-back_order_kirim_nama").val(v.client_pt_nama);
                        $("#backorder-back_order_kirim_nama").val(v.client_pt_nama);
                        $("#backorder-back_order_kirim_alamat").val(v.client_pt_alamat);
                        $("#backorder-back_order_kirim_provinsi").val(v.client_pt_propinsi);
                        $("#backorder-back_order_kirim_kota").val(v.client_pt_kota);
                        $("#backorder-back_order_kirim_kecamatan").val(v.client_pt_kecamatan);
                        $("#backorder-back_order_kirim_kelurahan").val(v.client_pt_kelurahan);
                        $("#backorder-back_order_kirim_kodepos").val(v.client_pt_kodepos);
                        $("#backorder-back_order_kirim_telepon").val(v.client_pt_telepon);
                        $("#backorder-back_order_kirim_area").val(v.area_nama);

                    });

                    arr_sku = [];
                    // reset_table_sku();

                    if ($("#backorder-client_pt_id").val() != "") {
                        $("#cek_customer").val(1);
                    }

                });
            }
        });

        Get_back_order_by_top();
    }

    $(document).on("click", ".btn-choose-sku-multi", function() {
        var so_id = $("#so_id").val();
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
                url: "<?= base_url('FAS/BackOrder/GetSelectedSKU') ?>",
                data: {
                    so_id: so_id,
                    sku_id: arr_sku,
                    tgl_harga: $("#backorder-back_order_tgl_harga").val()
                },
                dataType: "JSON",
                success: function(response) {
                    cek_total_arr_back_order_detail = arr_back_order_detail.length;
                    $.each(response, function(i, v) {
                        arr_back_order_detail.push({
                            // 'sku_id': v.sku_id,
                            // 'sku_kode': v.sku_kode,
                            // 'sku_varian': v.sku_varian,
                            // 'sku_induk_id': v.sku_induk_id,
                            // 'sku_weight': v.sku_weight,
                            // 'sku_weight_unit': v.sku_weight_unit,
                            // 'sku_length': v.sku_length,
                            // 'sku_length_unit': v.sku_length_unit,
                            // 'sku_width': v.sku_width,
                            // 'sku_width_unit': v.sku_width_unit,
                            // 'sku_height': v.sku_height,
                            // 'sku_height_unit': v.sku_height_unit,
                            // 'sku_volume': v.sku_volume,
                            // 'sku_volume_unit': v.sku_volume_unit,
                            // 'sku_satuan': v.sku_satuan,
                            // 'sku_kemasan': v.sku_kemasan,
                            // 'kemasan_id': v.kemasan_id,
                            // 'sku_harga_jual': v.sku_harga_jual,
                            // 'kategori1_id': v.kategori1_id,
                            // 'kategori2_id': v.kategori2_id,
                            // 'kategori3_id': v.kategori3_id,
                            // 'kategori4_id': v.kategori4_id,
                            // 'kategori5_id': v.kategori5_id,
                            // 'kategori6_id': v.kategori6_id,
                            // 'kategori7_id': v.kategori7_id,
                            // 'kategori8_id': v.kategori8_id,
                            // 'principle_id': v.principle_id,
                            // 'principle_brand_id': v.principle_brand_id,
                            // 'sku_nama_produk': v.sku_nama_produk,
                            // 'sku_deskripsi': v.sku_deskripsi,
                            // 'sku_origin': v.sku_origin,
                            // 'sku_kondisi': v.sku_kondisi,
                            // 'sku_sales_min_qty': v.sku_sales_min_qty,
                            // 'sku_ppnbm_persen': v.sku_ppnbm_persen,
                            // 'sku_ppn_persen': v.sku_ppn_persen,
                            // 'sku_pph': v.sku_pph,
                            // 'sku_is_aktif': v.sku_is_aktif,
                            // 'sku_is_jual': v.sku_is_jual,
                            // 'sku_is_paket': v.sku_is_paket,
                            // 'sku_is_deleted': v.sku_is_deleted,
                            // 'sku_weight_netto': v.sku_weight_netto,
                            // 'sku_weight_netto_unit': v.sku_weight_netto_unit,
                            // 'sku_weight_product': v.sku_weight_product,
                            // 'sku_weight_product_unit': v.sku_weight_product_unit,
                            // 'sku_weight_packaging': v.sku_weight_packaging,
                            // 'sku_weight_packaging_unit': v.sku_weight_packaging_unit,
                            // 'sku_weight_gift': v.sku_weight_gift,
                            // 'sku_weight_gift_unit': v.sku_weight_gift_unit,
                            // 'sku_bosnet_id': v.sku_bosnet_id,
                            // 'sku_is_hadiah': v.sku_is_hadiah,
                            // 'sku_is_from_import': v.sku_is_from_import,
                            // 'sku_kode_sku_principle': v.sku_kode_sku_principle,
                            // 'client_wms_id': v.client_wms_id,
                            // 'client_wms_nama': v.client_wms_nama,
                            // 'principle': v.principle,
                            // 'brand': v.brand,
                            // 'so_sku_qty': v.so_sku_qty,
                            // 'sub_total': v.sub_total

                            'client_wms_id': v.client_wms_id,
                            'client_wms_tax': v.client_wms_tax,
                            'principle_id': v.principle_id,
                            'principle': v.principle,
                            'brand': v.brand,
                            'sku_id': v.sku_id,
                            'sku_kode': v.sku_kode,
                            'sku_nama_produk': v.sku_nama_produk,
                            // 'sku_harga_satuan': v.sku_harga_jual,
                            'sku_harga_satuan': parseFloat(v.sku_nominal_harga),
                            'sku_disc_percent': 0,
                            'sku_disc_rp': 0,
                            'sku_harga_nett': parseFloat(v.sku_harga_jual),
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
                            'sku_diskon_global_rp': 0
                        });
                    });

                    pushToTableSKUDelivery();
                    <?php if ($act == "edit") { ?>
                        HeaderReadonly();
                    <?php } ?>
                }
            });

            $('#backorder-client_wms_id').prop('disabled', true);
            $('#backorder-principle_id').prop('disabled', true);

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Pilih SKU!'
            });
        }
    });

    $(document).on("click", "#btn-choose-ed-sku-multi", function() {
        var i = 0;
        var x = 0;
        var cek_sku_ed = 0;
        var total_qty = 0;
        var sub_jumlah = 0;
        var harga = parseInt($("#caption-ed-sku-harga").val());
        var index = $("#caption-ed-sku-index").val();
        var so_id = $("#so_id").val();
        var sku_id = $("#caption-ed-sku-id").val();

        $("#caption-" + index + "-BackOrderDetail-sku_qty").html('');
        $("#caption-" + index + "-BackOrderDetail-sku_harga_nett").html('');

        arr_sku = []
        arr_sku.push("'" + sku_id + "'");

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/BackOrder/delete_back_order_detail_2_temp') ?>",
            data: {
                so_id: so_id,
                sku_id: sku_id
            },
            dataType: "JSON",
            success: function(response) {
                // console.log('delete');
            }
        });

        $("#table-ed-sku > tbody tr").each(function() {
            var is_sku_id = $(this).find("td:eq(0) input[id='item-" + i + "-BackOrderDetail2-sku_id']")
                .val();
            var is_sku_stock_id = $(this).find("td:eq(0) input[id='item-" + i +
                "-BackOrderDetail2-sku_stock_id']").val();
            var is_sku_expdate = $(this).find("td:eq(0) input[id='item-" + i +
                "-BackOrderDetail2-sku_expdate']").val();
            var is_Qty = $(this).find("td:eq(4) input[id='item-" + i + "-BackOrderDetail2-sku_qty']")
                .val();

            if (is_Qty != 0) {
                arr_back_order_detail2.push({
                    'sku_stock_id': is_sku_stock_id,
                    'sku_id': is_sku_id,
                    'sku_expdate': is_sku_expdate,
                    'sku_qty': is_Qty
                });

                total_qty += parseInt(is_Qty);

                $.ajax({
                    async: false,
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/insert_back_order_detail_2_temp') ?>",
                    data: {
                        so_id: so_id,
                        sku_stock_id: is_sku_stock_id,
                        sku_id: is_sku_id,
                        sku_expdate: is_sku_expdate,
                        sku_qty: is_Qty
                    },
                    dataType: "JSON",
                    success: function(response) {
                        // console.log('success');
                    }
                });
            }

            i++;
        });

        if (arr_back_order_detail2.length == 0) {
            message("Error", "Pilih ED SKU!", "error");
        } else {

            // console.log(index);

            $("#table-sku-delivery-only > tbody").empty();

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/BackOrder/GetSelectedSKU') ?>",
                data: {
                    so_id: so_id,
                    sku_id: arr_sku
                },
                dataType: "JSON",
                success: function(response) {
                    $.each(response, function(i, v) {
                        arr_back_order_detail[index] = ({
                            // 'sku_id': v.sku_id,
                            // 'sku_kode': v.sku_kode,
                            // 'sku_varian': v.sku_varian,
                            // 'sku_induk_id': v.sku_induk_id,
                            // 'sku_weight': v.sku_weight,
                            // 'sku_weight_unit': v.sku_weight_unit,
                            // 'sku_length': v.sku_length,
                            // 'sku_length_unit': v.sku_length_unit,
                            // 'sku_width': v.sku_width,
                            // 'sku_width_unit': v.sku_width_unit,
                            // 'sku_height': v.sku_height,
                            // 'sku_height_unit': v.sku_height_unit,
                            // 'sku_volume': v.sku_volume,
                            // 'sku_volume_unit': v.sku_volume_unit,
                            // 'sku_satuan': v.sku_satuan,
                            // 'sku_kemasan': v.sku_kemasan,
                            // 'kemasan_id': v.kemasan_id,
                            // 'sku_harga_jual': v.sku_harga_jual,
                            // 'kategori1_id': v.kategori1_id,
                            // 'kategori2_id': v.kategori2_id,
                            // 'kategori3_id': v.kategori3_id,
                            // 'kategori4_id': v.kategori4_id,
                            // 'kategori5_id': v.kategori5_id,
                            // 'kategori6_id': v.kategori6_id,
                            // 'kategori7_id': v.kategori7_id,
                            // 'kategori8_id': v.kategori8_id,
                            // 'principle_id': v.principle_id,
                            // 'principle_brand_id': v.principle_brand_id,
                            // 'sku_nama_produk': v.sku_nama_produk,
                            // 'sku_deskripsi': v.sku_deskripsi,
                            // 'sku_origin': v.sku_origin,
                            // 'sku_kondisi': v.sku_kondisi,
                            // 'sku_sales_min_qty': v.sku_sales_min_qty,
                            // 'sku_ppnbm_persen': v.sku_ppnbm_persen,
                            // 'sku_ppn_persen': v.sku_ppn_persen,
                            // 'sku_pph': v.sku_pph,
                            // 'sku_is_aktif': v.sku_is_aktif,
                            // 'sku_is_jual': v.sku_is_jual,
                            // 'sku_is_paket': v.sku_is_paket,
                            // 'sku_is_deleted': v.sku_is_deleted,
                            // 'sku_weight_netto': v.sku_weight_netto,
                            // 'sku_weight_netto_unit': v.sku_weight_netto_unit,
                            // 'sku_weight_product': v.sku_weight_product,
                            // 'sku_weight_product_unit': v.sku_weight_product_unit,
                            // 'sku_weight_packaging': v.sku_weight_packaging,
                            // 'sku_weight_packaging_unit': v.sku_weight_packaging_unit,
                            // 'sku_weight_gift': v.sku_weight_gift,
                            // 'sku_weight_gift_unit': v.sku_weight_gift_unit,
                            // 'sku_bosnet_id': v.sku_bosnet_id,
                            // 'sku_is_hadiah': v.sku_is_hadiah,
                            // 'sku_is_from_import': v.sku_is_from_import,
                            // 'sku_kode_sku_principle': v.sku_kode_sku_principle,
                            // 'client_wms_id': v.client_wms_id,
                            // 'client_wms_nama': v.client_wms_nama,
                            // 'principle': v.principle,
                            // 'brand': v.brand,
                            // 'so_sku_qty': v.so_sku_qty,
                            // 'sub_total': v.sub_total

                            'client_wms_id': v.client_wms_id,
                            'principle_id': v.principle_id,
                            'principle': v.principle,
                            'brand': v.brand,
                            'sku_id': v.sku_id,
                            'sku_kode': v.sku_kode,
                            'sku_nama_produk': v.sku_nama_produk,
                            'sku_harga_satuan': v.sku_harga_jual,
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
                            'sku_keterangan': "",
                            'sku_request_expdate': "",
                            'sku_filter_expdate': "",
                            'sku_filter_expdatebulan': "",
                            'sku_satuan': v.sku_satuan,
                            'sku_kemasan': v.sku_kemasan,
                            'tipe_stock_nama': ""
                        });
                    });

                    pushToTableSKUDelivery();
                }
            });

            sub_jumlah = harga * total_qty;
            $("#caption-" + index + "-BackOrderDetail-sku_qty").html(total_qty);
            $("#caption-" + index + "-BackOrderDetail-sku_harga_nett").html(sub_jumlah);
            $("#modal-ed-sku").modal('hide');
        }
    });

    $(document).on("click", "#btn-choose-ed-sku-multi-edit", function() {
        var i = 0;
        var x = 0;
        var cek_sku_ed = 0;
        var total_qty = 0;
        var sub_jumlah = 0;
        var harga = parseInt($("#caption-ed-sku-harga").val());
        var index = $("#caption-ed-sku-index").val();
        var so_id = $("#so_id").val();
        var sku_id = $("#caption-ed-sku-id").val();

        $("#caption-" + index + "-BackOrderDetail-sku_qty").html('');
        $("#caption-" + index + "-BackOrderDetail-sku_harga_nett").html('');

        arr_sku = []
        arr_sku.push("'" + sku_id + "'");

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/BackOrder/delete_back_order_detail_2_temp') ?>",
            data: {
                so_id: so_id,
                sku_id: sku_id
            },
            dataType: "JSON",
            success: function(response) {
                // console.log('delete');
            }
        });

        $("#table-ed-sku > tbody tr").each(function() {
            var is_sku_id = $(this).find("td:eq(0) input[id='item-" + i + "-BackOrderDetail2-sku_id']")
                .val();
            var is_sku_stock_id = $(this).find("td:eq(0) input[id='item-" + i +
                "-BackOrderDetail2-sku_stock_id']").val();
            var is_sku_expdate = $(this).find("td:eq(0) input[id='item-" + i +
                "-BackOrderDetail2-sku_expdate']").val();
            var is_Qty = $(this).find("td:eq(4) input[id='item-" + i + "-BackOrderDetail2-sku_qty']")
                .val();

            if (is_Qty != 0) {
                arr_back_order_detail2.push({
                    'sku_stock_id': is_sku_stock_id,
                    'sku_id': is_sku_id,
                    'sku_expdate': is_sku_expdate,
                    'sku_qty': is_Qty
                });

                total_qty += parseInt(is_Qty);

                $.ajax({
                    async: false,
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/insert_back_order_detail_2_temp') ?>",
                    data: {
                        so_id: so_id,
                        sku_stock_id: is_sku_stock_id,
                        sku_id: is_sku_id,
                        sku_expdate: is_sku_expdate,
                        sku_qty: is_Qty
                    },
                    dataType: "JSON",
                    success: function(response) {
                        // console.log('success');
                    }
                });
            }

            i++;
        });

        if (arr_back_order_detail2.length == 0) {
            message("Error", "Pilih ED SKU!", "error");
        } else {

            // console.log(index);

            $("#table-sku-delivery-only > tbody").empty();

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/BackOrder/GetSelectedSKU') ?>",
                data: {
                    so_id: so_id,
                    sku_id: arr_sku
                },
                dataType: "JSON",
                success: function(response) {
                    $.each(response, function(i, v) {
                        arr_back_order_detail[index] = ({
                            // 'sku_id': v.sku_id,
                            // 'sku_kode': v.sku_kode,
                            // 'sku_varian': v.sku_varian,
                            // 'sku_induk_id': v.sku_induk_id,
                            // 'sku_weight': v.sku_weight,
                            // 'sku_weight_unit': v.sku_weight_unit,
                            // 'sku_length': v.sku_length,
                            // 'sku_length_unit': v.sku_length_unit,
                            // 'sku_width': v.sku_width,
                            // 'sku_width_unit': v.sku_width_unit,
                            // 'sku_height': v.sku_height,
                            // 'sku_height_unit': v.sku_height_unit,
                            // 'sku_volume': v.sku_volume,
                            // 'sku_volume_unit': v.sku_volume_unit,
                            // 'sku_satuan': v.sku_satuan,
                            // 'sku_kemasan': v.sku_kemasan,
                            // 'kemasan_id': v.kemasan_id,
                            // 'sku_harga_jual': v.sku_harga_jual,
                            // 'kategori1_id': v.kategori1_id,
                            // 'kategori2_id': v.kategori2_id,
                            // 'kategori3_id': v.kategori3_id,
                            // 'kategori4_id': v.kategori4_id,
                            // 'kategori5_id': v.kategori5_id,
                            // 'kategori6_id': v.kategori6_id,
                            // 'kategori7_id': v.kategori7_id,
                            // 'kategori8_id': v.kategori8_id,
                            // 'principle_id': v.principle_id,
                            // 'principle_brand_id': v.principle_brand_id,
                            // 'sku_nama_produk': v.sku_nama_produk,
                            // 'sku_deskripsi': v.sku_deskripsi,
                            // 'sku_origin': v.sku_origin,
                            // 'sku_kondisi': v.sku_kondisi,
                            // 'sku_sales_min_qty': v.sku_sales_min_qty,
                            // 'sku_ppnbm_persen': v.sku_ppnbm_persen,
                            // 'sku_ppn_persen': v.sku_ppn_persen,
                            // 'sku_pph': v.sku_pph,
                            // 'sku_is_aktif': v.sku_is_aktif,
                            // 'sku_is_jual': v.sku_is_jual,
                            // 'sku_is_paket': v.sku_is_paket,
                            // 'sku_is_deleted': v.sku_is_deleted,
                            // 'sku_weight_netto': v.sku_weight_netto,
                            // 'sku_weight_netto_unit': v.sku_weight_netto_unit,
                            // 'sku_weight_product': v.sku_weight_product,
                            // 'sku_weight_product_unit': v.sku_weight_product_unit,
                            // 'sku_weight_packaging': v.sku_weight_packaging,
                            // 'sku_weight_packaging_unit': v.sku_weight_packaging_unit,
                            // 'sku_weight_gift': v.sku_weight_gift,
                            // 'sku_weight_gift_unit': v.sku_weight_gift_unit,
                            // 'sku_bosnet_id': v.sku_bosnet_id,
                            // 'sku_is_hadiah': v.sku_is_hadiah,
                            // 'sku_is_from_import': v.sku_is_from_import,
                            // 'sku_kode_sku_principle': v.sku_kode_sku_principle,
                            // 'client_wms_id': v.client_wms_id,
                            // 'client_wms_nama': v.client_wms_nama,
                            // 'principle': v.principle,
                            // 'brand': v.brand,
                            // 'so_sku_qty': v.so_sku_qty,
                            // 'sub_total': v.sub_total

                            'client_wms_id': v.client_wms_id,
                            'principle_id': v.principle_id,
                            'principle': v.principle,
                            'brand': v.brand,
                            'sku_id': v.sku_id,
                            'sku_kode': v.sku_kode,
                            'sku_nama_produk': v.sku_nama_produk,
                            'sku_harga_satuan': v.sku_harga_jual,
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
                            'sku_diskon_global_rp': 0
                        });
                    });

                    pushToTableSKUDelivery();
                }
            });

            sub_jumlah = harga * total_qty;
            $("#caption-sku-qty-retur").val(total_qty);
            $("#caption-" + index + "-BackOrderDetail-sku_qty").html(total_qty);
            $("#caption-" + index + "-BackOrderDetail-sku_harga_nett").html(sub_jumlah);
            $("#modal-ed-sku").modal('hide');
        }
    });

    // function initDataCustomer() {
    //     var tipe_pembayaran = document.querySelector('input[id="backorder-back_order_tipe_pembayaran"]:checked').value;

    //     $("#panel-customer").show();

    //     // var perusahaan = $("#filter-perusahaan-customer").val();
    //     var perusahaan = $("#backorder-client_wms_id").val();
    //     var sales = $("#backorder-sales_id").val();
    //     var nama = $("#filter-client-name").val();
    //     var alamat = $("#filter-client-address").val();
    //     var telp = $("#filter-client-phone").val();
    //     var area = $("#filter-area").val();

    //     if (sales == "") {
    //         $("#modal-customer").modal('hide');
    //         message('Warning!', 'Pilih Sales!', 'error');
    //         return false;
    //     }

    //     $.ajax({
    //         type: 'POST',
    //         url: "<?= base_url('FAS/BackOrder/GetCustomerByTypePelayanan') ?>",
    //         data: {
    //             perusahaan: perusahaan,
    //             sales: sales,
    //             tipe_pembayaran: tipe_pembayaran,
    //             nama: nama,
    //             alamat: alamat,
    //             telp: telp,
    //             area: area
    //         },
    //         dataType: "JSON",
    //         success: function(response) {

    //             $("#table-customer > tbody").empty();

    //             if (response != 0) {
    //                 $.each(response, function(i, v) {

    //                     $("#table-customer > tbody").append(`
    // 							<tr id="row-${i}">
    // 								<td style="display: none">
    // 									<input type="hidden" id="item-${i}-BackOrder-client_pt_id" value="${v.client_pt_id}" />
    // 									<input type="hidden" id="item-${i}-BackOrder-client_pt_propinsi" value="${v.client_pt_propinsi}" />
    // 									<input type="hidden" id="item-${i}-BackOrder-client_pt_kota" value="${v.client_pt_kota}" />
    // 									<input type="hidden" id="item-${i}-BackOrder-client_pt_kecamatan" value="${v.client_pt_kecamatan}" />
    // 									<input type="hidden" id="item-${i}-BackOrder-client_pt_kelurahan" value="${v.client_pt_kelurahan}" />
    // 									<input type="hidden" id="item-${i}-BackOrder-client_pt_kodepos" value="${v.client_pt_kodepos}" />
    // 									<input type="hidden" id="item-${i}-BackOrderDetail-area_id" value="${v.area_id}" />
    // 								</td>
    // 								<td class="text-center">
    // 									<span class="client-pt-nama-label">${v.client_pt_nama}</span>
    // 									<input type="hidden" id="item-${i}-BackOrder-client_pt_nama" class="form-control client-pt-nama" value="${v.client_pt_nama}" />
    // 								</td>
    // 								<td class="text-center">
    // 									<span class="client-pt-alamat-label">${v.client_pt_alamat}</span>
    // 									<input type="hidden" id="item-${i}-BackOrder-client_pt_alamat" class="form-control client-pt-alamat" value="${v.client_pt_alamat}" />
    // 								</td>
    // 								<td class="text-center">
    // 									<span class="client-pt-telepon-label">${v.client_pt_telepon}</span>
    // 									<input type="hidden" id="item-${i}-BackOrder-client_pt_telepon" class="form-control client-pt-telepon" value="${v.client_pt_telepon}" />
    // 								</td>
    // 								<td class="text-center">
    // 									<span class="area-nama-label">${v.area_nama}</span>
    // 									<input type="hidden" id="item-${i}-BackOrder-area_nama" class="form-control area-nama" value="${v.area_nama}" />
    // 								</td>
    // 								<td class="text-center">
    // 									<button class="btn btn-primary btn-small btn-select-customer" onclick="getSelectedCustomer('${v.client_pt_id}','${sales}')"><i class="fa fa-angle-down"></i></button>
    // 								</td>
    // 							</tr>
    // 						`);
    //                 });
    //             } else {
    //                 $("#table-customer > tbody").append(`
    // 							<tr>
    // 								<td colspan="5" class="text-danger text-center">
    // 									Data Kosong
    // 								</td>
    // 							</tr>
    // 					`);
    //             }
    //         }
    //     });
    // }

    function initDataCustomer() {
        console.log('a');
        var tipe_pembayaran = document.querySelector('input[id="backorder-back_order_tipe_pembayaran"]:checked').value;

        $("#panel-customer").show();

        // var perusahaan = $("#filter-perusahaan-customer").val();
        var perusahaan = $("#backorder-client_wms_id").val();
        var sales = $("#backorder-sales_id").val();
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
                url: "<?= base_url('FAS/BackOrder/GetCustomerByTypePelayanan') ?>",
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
                        str += `<input type="hidden" id="item-${i}-BackOrder-client_pt_id" value="${row.client_pt_id}" />
                                <input type="hidden" id="item-${i}-BackOrder-client_pt_propinsi" value="${row.client_pt_propinsi}" />
                                <input type="hidden" id="item-${i}-BackOrder-client_pt_kota" value="${row.client_pt_kota}" />
                                <input type="hidden" id="item-${i}-BackOrder-client_pt_kecamatan" value="${row.client_pt_kecamatan}" />
                                <input type="hidden" id="item-${i}-BackOrder-client_pt_kelurahan" value="${row.client_pt_kelurahan}" />
                                <input type="hidden" id="item-${i}-BackOrder-client_pt_kodepos" value="${row.client_pt_kodepos}" />
                                <input type="hidden" id="item-${i}-BackOrderDetail-area_id" value="${row.area_id}" />
                                <span class="client-pt-nama-label">${row.client_pt_nama}</span>
								<input type="hidden" id="item-${i}-BackOrder-client_pt_nama" class="form-control client-pt-nama" value="${row.client_pt_nama}" />`

                        return str;
                    },
                    data: 'client_pt_nama'
                },
                {
                    render: function(data, type, row, meta) {
                        var i = meta.row;
                        var str = '';
                        str += `	<span class="client-pt-alamat-label">${row.client_pt_alamat}</span>
									<input type="hidden" id="item-${i}-BackOrder-client_pt_alamat" class="form-control client-pt-alamat" value="${row.client_pt_alamat}" />`

                        return str;
                    },
                    data: 'client_pt_alamat'
                },
                {
                    render: function(data, type, row, meta) {
                        var i = meta.row;
                        var str = '';
                        str += `	<span class="client-pt-telepon-label">${row.client_pt_telepon}</span>
									<input type="hidden" id="item-${i}-BackOrder-client_pt_telepon" class="form-control client-pt-telepon" value="${row.client_pt_telepon}" />`

                        return str;
                    },
                    data: 'client_pt_telepon'
                },
                {
                    render: function(data, type, row, meta) {
                        var str = '';
                        str += `<span class="area-nama-label">${row.area_nama}</span>
								<input type="hidden" id="item-${i}-BackOrder-area_nama" class="form-control area-nama" value="${row.area_nama}" />`

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
        var perusahaan = $("#backorder-client_wms_id").val();
        var sales = $("#backorder-sales_id").val();
        var client_pt = $("#backorder-client_pt_id").val();
        var tipe_pembayaran = document.querySelector('input[id="backorder-back_order_tipe_pembayaran"]:checked').value;
        var sku_induk = $("#filter-sku-induk").val();
        var sku_nama_produk = $("#filter-sku-nama-produk").val();
        var sku_kemasan = $("#filter-sku-kemasan").val();
        var sku_satuan = $("#filter-sku-satuan").val();
        var principle = $("#backorder-principle_id").val();
        // var principle = $("#filter-principle").val();
        var brand = $("#filter-brand").val();

        if (perusahaan == "") {
            message("Error", "Perusahaan belum dipilih", "error");
            return false;
        }

        if ($("#backorder-tipe_back_order_id").val() != "") {

            if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                // $.ajax({
                //     type: 'POST',
                //     url: "<?= base_url('FAS/BackOrder/search_filter_chosen_sku_retur') ?>",
                //     data: {
                //         back_order_id: $("#filter-delivery_order_id").val()
                //     },
                //     dataType: "JSON",
                //     beforeSend: function() {

                //         Swal.fire({
                //             title: 'Loading ...',
                //             html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                //             timerProgressBar: false,
                //             showConfirmButton: false
                //         });
                //     },
                //     success: function(response) {
                //         $("#loadingsku").hide();

                //         if (response.length > 0) {
                //             if ($.fn.DataTable.isDataTable('#table-sku')) {
                //                 $('#table-sku').DataTable().destroy();
                //             }
                //             $("#table-sku > tbody").empty();

                //             $.each(response, function(i, v) {
                //                 $("#table-sku > tbody").append(`
                //                         <tr>
                //                             <td width="5%" class="text-center">
                //                                 <input type="checkbox" name="CheckboxSKU" id="check-sku-${i}" value="${v.sku_id}">
                //                             </td>
                //                             <td width="15%" class="text-center">${v.client_wms_nama}</td>
                //                             <td class="text-center">${v.sku_kode}</td>
                //                             <td width="15%" class="text-center">${v.sku_induk}</td>
                //                             <td width="25%" class="text-center">${v.sku_nama_produk}</td>
                //                             <td width="8%" class="text-center">${v.sku_kemasan}</td>
                //                             <td width="8%" class="text-center">${v.sku_satuan}</td>
                //                             <td width="10%" class="text-center">${v.principle}</td>
                //                             <td width="10%" class="text-center">${v.brand}</td>
                //                         </tr>
                //                     `);
                //             });

                //             $('#table-sku').DataTable({
                //                 "searching": false,
                //                 columnDefs: [{
                //                     sortable: false,
                //                     targets: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                //                 }],
                //                 lengthMenu: [
                //                     [-1],
                //                     ['All']
                //                 ],
                //             });
                //         } else {
                //             $("#table-sku > tbody").html(
                //                 `<tr><td colspan="9" class="text-center text-danger">Data Kosong</td></tr>`);
                //         }
                //     },
                //     error: function(xhr, ajaxOptions, thrownError) {
                //         message("Error", "Error 500 Internal Server Connection Failure", "error");
                //     },
                //     complete: function() {
                //         Swal.close();
                //     }
                // });

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/search_filter_chosen_sku') ?>",
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
                        arr_back_order_detail: arr_back_order_detail
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
                    url: "<?= base_url('FAS/BackOrder/search_filter_chosen_sku') ?>",
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
                        arr_back_order_detail: arr_back_order_detail
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
            message("Pilih Tipe BO!", "Tipe Back Order belum dipilih", "error");
        }

        // if (sales != "") {

        //     if (client_pt != "") {
        //         $("#loadingsku").show();

        //         $.ajax({
        //             type: 'POST',
        //             url: "<?= base_url('FAS/BackOrder/search_filter_chosen_sku') ?>",
        //             data: {
        //                 perusahaan: perusahaan,
        //                 sales: sales,
        //                 client_pt: client_pt,
        //                 tipe_pembayaran: tipe_pembayaran,
        //                 brand: brand,
        //                 principle: principle,
        //                 sku_induk: sku_induk,
        //                 sku_nama_produk: sku_nama_produk,
        //                 sku_kemasan: sku_kemasan,
        //                 sku_satuan: sku_satuan
        //             },
        //             dataType: "JSON",
        //             async: false,
        //             success: function(response) {
        //                 $("#loadingsku").hide();

        //                 if (response.length > 0) {
        //                     if ($.fn.DataTable.isDataTable('#table-sku')) {
        //                         $('#table-sku').DataTable().destroy();
        //                     }
        //                     $("#table-sku > tbody").empty();

        //                     $.each(response, function(i, v) {
        //                         $("#table-sku > tbody").append(`
        // 					<tr>
        // 						<td width="5%" class="text-center">
        // 							<input type="checkbox" name="CheckboxSKU" id="check-sku-${i}" value="${v.sku_id}">
        // 						</td>
        // 						<td width="15%" class="text-center">${v.client_wms_nama}</td>
        // 						<td class="text-center">${v.sku_kode}</td>
        // 						<td width="15%" class="text-center">${v.sku_induk}</td>
        // 						<td width="25%" class="text-center">${v.sku_nama_produk}</td>
        // 						<td width="8%" class="text-center">${v.sku_kemasan}</td>
        // 						<td width="8%" class="text-center">${v.sku_satuan}</td>
        // 						<td width="10%" class="text-center">${v.principle}</td>
        // 						<td width="10%" class="text-center">${v.brand}</td>
        // 					</tr>
        // 				`);
        //                     });

        //                     $('#table-sku').DataTable({
        //                         "searching": false,
        //                         columnDefs: [{
        //                             sortable: false,
        //                             targets: [0, 1, 2, 3, 4, 5, 6, 7]
        //                         }],
        //                         lengthMenu: [
        //                             [-1],
        //                             ['All']
        //                         ],
        //                     });
        //                 } else {
        //                     $("#table-sku > tbody").html(
        //                         `<tr><td colspan="8" class="text-center text-danger">Data Kosong</td></tr>`);
        //                 }
        //             }
        //         });
        //     }
        // } else {
        //     $("#modal-sku").modal('hide');
        //     message('Warning!', 'Pilih Sales!', 'error');
        // }

    }

    $("#btn-edit-all-so").on("click", function() {
        $('#filter-so-date-edit').daterangepicker({
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

        $("#filter-so-number-edit").val('');
        $("#tipe_back_order_id_edit").val('D5A2AB04-0236-424D-859C-1888B46D6F50').trigger('change');
        $("#filter-perusahaan-edit").val('').trigger('change');
        $("#filter-status-edit").val('').trigger('change');
        $("#allChangeTglKirim").val(new Date().toISOString().split("T")[0]);
        $("#tableDataBOEdit > tbody").empty();
        $("#check-all-pilih-so").attr('checked', false);

        $("#modalEditDataBO").modal('show')
    })

    function handlerCloseEditBO() {
        $("#fieldChangeFormEditModal").hide();
        $("#modalEditDataBO").modal('hide');
    }

    function checkAllSJ(e) {
        var checkboxes = $("input[name='chk-data[]']");
        if (e.checked) {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true;
                    $(".tglKirimEdit").val($("#allChangeTglKirim").val() == '' ? '' : $("#allChangeTglKirim").val())
                    $(".tglKirimEdit").prop('disabled', false)
                    $(".tipe_back_order_edit").val($("#tipe_back_order_id_edit").val() == '' ? '' : $(
                        "#tipe_back_order_id_edit").val()).trigger('change')
                    $(".tipe_back_order_edit").prop('disabled', false)
                }
            }
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = false;
                    $(".tglKirimEdit").val('')
                    $(".tglKirimEdit").prop('disabled', true)
                    $(".tipe_back_order_edit").val('').trigger('change')
                    $(".tipe_back_order_edit").prop('disabled', true)
                }
            }
        }
    }

    function handlerRemoveAktualWhenUnchecked(event) {
        if (event.currentTarget.checked == false) {
            $(`#tglKirimEdit-${event.currentTarget.value}`).val('');
            $(`#tglKirimEdit-${event.currentTarget.value}`).prop('disabled', true);
            $(`#tipe_back_order_edit_${event.currentTarget.value}`).val('').trigger('change')
            $(`#tipe_back_order_edit_${event.currentTarget.value}`).prop('disabled', true)
            $(`#chk-priority-${event.currentTarget.value}`).prop('disabled', true)
        } else {
            $(`#tglKirimEdit-${event.currentTarget.value}`).val($("#allChangeTglKirim").val() == '' ? '' : $(
                "#allChangeTglKirim").val())
            $(`#tglKirimEdit-${event.currentTarget.value}`).prop('disabled', false);
            $(`#tipe_back_order_edit_${event.currentTarget.value}`).val($("#tipe_back_order_id_edit").val() == '' ? '' :
                $("#tipe_back_order_id_edit").val()).trigger('change')
            $(`#tipe_back_order_edit_${event.currentTarget.value}`).prop('disabled', false)

            $(`#chk-priority-${event.currentTarget.value}`).prop('disabled', false)
        }
    }

    function setTanggal(e) {
        var tgl = e.value;

        var checkboxes = $("input[name='chk-data[]']");

        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
                if (checkboxes[i].checked == true) {
                    $(`#tglKirimEdit-${checkboxes[i].value}`).val(tgl == '' ? '' : tgl)
                }
            }
        }
    }

    function setTipe(e) {
        var tipe = e.value;

        var checkboxes = $("input[name='chk-data[]']");

        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
                if (checkboxes[i].checked == true) {
                    $(`#tipe_back_order_edit_${checkboxes[i].value}`).val(tipe == '' ? '' : tipe).trigger('change')
                }
            }
        }
    }

    function handlerDataSearchEditBO() {
        $("#fieldChangeFormEditModal").show();

        $("#loadingviewsoedit").show();
        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/BackOrder/searchEdit_so_by_filter') ?>",
            data: {
                tgl: $("#filter-so-date-edit").val(),
                perusahaan: $("#filter-perusahaan-edit").val(),
                principle: $("#filter-principle-edit").val(),
                status: $("#filter-status-edit").val(),
                kode: $("#filter-so-number-edit").val(),
                sales: $("#filter-sales-edit").val(),
                tipe: $("#filter-tipe-edit").val(),
                status: $("#filter-status-edit").val()
            },
            dataType: "JSON",
            success: function(response) {

                $("#tableDataBOEdit > tbody").empty();

                if ($.fn.DataTable.isDataTable('#tableDataBOEdit')) {
                    $('#tableDataBOEdit').DataTable().clear();
                    $('#tableDataBOEdit').DataTable().destroy();
                }

                if (response.data != 0) {
                    var optionTipe = '';
                    optionTipe += `<option value="">** <label name="CAPTION-TIPEBO">Tipe BO</label> **</option>`

                    $.each(response.tipeBackOrder, function(i, v) {
                        optionTipe +=
                            `<option value="${v.tipe_back_order_id}">${v.tipe_back_order_nama}</option>`
                    })

                    $.each(response.data, function(i, v) {
                        $("#tableDataBOEdit > tbody").append(`
							<tr>
								<td class="text-center">
                                    <input type="checkbox" name="chk-data[]" id="chk-data[]" data-tgl-update="${v.tglUpdate}" value="${v.back_order_id}" onchange="handlerRemoveAktualWhenUnchecked(event)">
                                </td>
								<td class="text-center">${v.back_order_kode}</td>
								<td class="text-center">${v.back_order_no_po}</td>
								<td class="text-center">${v.client_pt_nama}</td>
								<td class="text-center">${v.karyawan_nama}</td>
								<td class="text-center">${v.client_wms_nama}</td>
								<td class="text-center">${v.principle_kode}</td>
								<td class="text-center">${v.client_pt_alamat}</td>
								<td class="text-center"><input type="date" value="${v.back_order_tgl_kirim2}" class="form-control" disabled/></td>
								<td class="text-center">${v.tipe_back_order_nama}</td>
								<td class="text-center">Rp. ${Number(v.sku_harga_nett).toLocaleString()}</td>
								<td class="text-center"><input type="date" class="form-control tglKirimEdit" disabled id="tglKirimEdit-${v.back_order_id}"/></td>
								<td class="text-center">
                                    <select disabled name="tipe_back_order_edit" class="input-sm form-control select2 tipe_back_order_edit" id="tipe_back_order_edit_${v.back_order_id}">
                                        ${optionTipe}
                                    </select>
								</td>
                                <td class="text-center">
                                    <input type="checkbox" class="chk-priority" name="chk-priority[]" id="chk-priority-${v.back_order_id}" ${v.is_priority == 1 ? 'checked' : ''} disabled>
                                </td>
								<td class="text-center">${v.back_order_keterangan}</td>
							</tr>
						`);
                    });
                    $('#tableDataBOEdit').DataTable({
                        'lengthMenu': [
                            [100, 200, 250, -1],
                            [100, 200, 250, 'All']
                        ],
                        'ordering': false,
                        "scrollX": true
                    });
                } else {
                    $("#tableDataBOEdit > tbody").append(`
						<tr>
							<td colspan="14" class="text-danger text-center">Data Is Empty</td>
						</tr>
					`);
                }

                $("#loadingviewsoedit").hide();
            }
        });
    }

    function handlerSaveEditBO() {
        const checkboxes = $("input[name='chk-data[]']");

        let arrData = [];

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked == true) {
                const valueId = checkboxes[i].value;
                const tglUpdate = checkboxes[i].getAttribute('data-tgl-update');
                const tglKirimEdit = $(`#tglKirimEdit-${valueId}`).val();
                const tipe_back_order_edit = $(`#tipe_back_order_edit_${valueId}`).val();
                const is_priority = $(`#chk-priority-${valueId}`).prop('checked') ? 1 : 0;

                if (tglKirimEdit == "" && tipe_back_order_edit == "") {
                    message("Error!", "Salah satu dari Tanggal Kirim atau Tipe tidak boleh kosong yang sudah dichecked",
                        'error')
                    return false;
                } else {
                    arrData.push({
                        id: valueId,
                        tgl_kirim: tglKirimEdit,
                        tipe: tipe_back_order_edit,
                        tglUpdate: tglUpdate == 'null' ? '' : tglUpdate,
                        is_priority: is_priority
                    })
                }
            }
        }

        if (arrData.length <= 0) {
            message("Error!", "Pilih data yang akan diubah", 'error');
            return false;
        }

        messageBoxBeforeRequest('Pastikan data yang sudah anda input benar!', 'Iya, Simpan', 'Tidak, Tutup').then((
            result) => {
            if (result.value == true) {
                requestAjax("<?= base_url('FAS/BackOrder/updateDataBackOrder'); ?>", {
                    arrData
                }, "POST", "JSON", function(response) {
                    if (response == 400) {
                        return messageNotSameLastUpdated();
                    }

                    if (response == true) {
                        message_topright("success", "Data berhasil Disimpan");
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        message_topright("error", "Data gagal disimpan");
                    }
                })
            }
        });

        // Swal.fire({
        // 	title: "Apakah anda yakin?",
        // 	text: "Ingin Simpan data ini!",
        // 	icon: "warning",
        // 	showCancelButton: true,
        // 	confirmButtonColor: "#3085d6",
        // 	cancelButtonColor: "#d33",
        // 	confirmButtonText: "Ya, Simpan",
        // 	cancelButtonText: "Tidak, Tutup"
        // }).then((result) => {
        // 	if (result.value == true) {
        // 		//ajax save data
        // 		$.ajax({
        // 			url: "<?= base_url('FAS/BackOrder/updateDataBackOrder'); ?>",
        // 			type: "POST",
        // 			data: {
        // 				arrData
        // 			},
        // 			beforeSend: function() {

        // 				//Alert memuat data
        // 				Swal.fire({
        // 					title: '<span ><i class="fa fa-spinner fa-spin"></i> Proses Simpan Data!</span> ',
        // 					text: 'Mohon tunggu sebentar...',
        // 					icon: 'warning',
        // 					showCancelButton: false,
        // 					showConfirmButton: false,
        // 					allowOutsideClick: false
        // 				})
        // 			},
        // 			dataType: "JSON",
        // 			success: function(response) {
        // 				if (response == 400) {
        // 					return messageNotSameLastUpdated();
        // 				}

        // 				if (response == true) {
        // 					message_topright("success", "Data berhasil Disimpan");
        // 					setTimeout(() => {
        // 						location.reload();
        // 					}, 2000);
        // 				} else {
        // 					message_topright("error", "Data gagal disimpan");
        // 				}
        // 			}
        // 		});
        // 	}
        // });


    }

    $("#btnsaveso").on("click", function() {
        var cek_customer = $("#cek_customer").val();
        var tipe_so = $("#backorder-tipe_back_order_id").val();
        var tipe_do = $("#backorder-tipe_delivery_order_id").val();
        var x = 0;
        arr_header = [];
        arr_detail = [];
        // console.log(arr_so_detail2_ed);
        $.each(arr_detail, function(i2, v2) {
            $('#row-' + i2).css('background', '');
            $('#row-' + i2).css('color', '');
        });

        $.each(arr_back_order_detail, function(i, v) {
            arr_detail.push({
                'client_wms_id': $("#item-" + i + "-BackOrderDetail-client_wms_id").val(),
                'sku_id': $("#item-" + i + "-BackOrderDetail-sku_id").val(),
                'sku_kode': $("#item-" + i + "-BackOrderDetail-sku_kode").val(),
                'sku_nama_produk': $("#item-" + i + "-BackOrderDetail-sku_nama_produk").val(),
                'sku_harga_satuan': $("#item-" + i + "-BackOrderDetail-sku_harga_satuan").val().replaceAll(".", ""),
                // 'sku_disc_percent': $("#item-" + i + "-BackOrderDetail-sku_disc_percent").val(),
                'sku_disc_percent': $("#item-" + i + "-BackOrderDetail-sku_disc_percent").val(),
                // 'sku_disc_rp': $("#item-" + i + "-BackOrderDetail-sku_disc_rp").val(),
                'sku_disc_rp': $("#caption-" + i + "-BackOrderDetail-sku_disc_rp").text().replaceAll(".", ""),
                // 'sku_harga_nett': $("#item-" + i + "-BackOrderDetail-sku_harga_nett").val(),
                'sku_harga_nett': $("#caption-" + i + "-BackOrderDetail-sku_harga_nett").text().replaceAll(".", ""),
                'sku_weight': $("#item-" + i + "-BackOrderDetail-sku_weight").val(),
                'sku_weight_unit': $("#item-" + i + "-BackOrderDetail-sku_weight_unit").val(),
                'sku_length': $("#item-" + i + "-BackOrderDetail-sku_length").val(),
                'sku_length_unit': $("#item-" + i + "-BackOrderDetail-sku_length_unit").val(),
                'sku_width': $("#item-" + i + "-BackOrderDetail-sku_width").val(),
                'sku_width_unit': $("#item-" + i + "-BackOrderDetail-sku_width_unit").val(),
                'sku_height': $("#item-" + i + "-BackOrderDetail-sku_height").val(),
                'sku_height_unit': $("#item-" + i + "-BackOrderDetail-sku_height_unit").val(),
                'sku_volume': $("#item-" + i + "-BackOrderDetail-sku_volume").val(),
                'sku_volume_unit': $("#item-" + i + "-BackOrderDetail-sku_volume_unit").val(),
                'sku_qty': $("#item-" + i + "-BackOrderDetail-sku_qty").val().replaceAll(".", ""),
                'sku_keterangan': $("#item-" + i + "-BackOrderDetail-sku_keterangan").val(),
                'sku_request_expdate': $("#item-" + i + "-BackOrderDetail-sku_request_expdate").val(),
                'sku_filter_expdate': $("#item-" + i + "-BackOrderDetail-sku_filter_expdate").val(),
                'sku_filter_expdatebulan': $("#item-" + i + "-BackOrderDetail-sku_filter_expdatebulan").val(),
                'sku_satuan': $("#item-" + i + "-BackOrderDetail-sku_satuan").val(),
                'sku_kemasan': $("#item-" + i + "-BackOrderDetail-sku_kemasan").val(),
                'tipe_stock_nama': $("#item-" + i + "-BackOrderDetail-tipe_stock_nama").val(),
                'sku_ppn_percent': $("#item-" + i + "-BackOrderDetail-ppn_percent").val(),
                'sku_ppn_rp': $("#caption-" + i + "-BackOrderDetail-ppn_rp").text().replaceAll(".", ""),
                'sku_diskon_global_percent': $("#caption-" + i + "-BackOrderDetail-sku_disc_global_percent").text(),
                'sku_diskon_global_rp': $("#caption-" + i + "-BackOrderDetail-sku_disc_global_rupiah").text().replaceAll(".", "")
            });
        });

        // for (var index = 0; index < arr_back_order_detail.length; index++) {
        //     if (arr_back_order_detail[index] != "") {
        //         arr_detail.push({
        //             'client_wms_id': $("#item-" + index + "-BackOrderDetail-client_wms_id").val(),
        //             'sku_id': $("#item-" + index + "-BackOrderDetail-sku_id").val(),
        //             'sku_kode': $("#item-" + index + "-BackOrderDetail-sku_kode").val(),
        //             'sku_nama_produk': $("#item-" + index + "-BackOrderDetail-sku_nama_produk").val(),
        //             'sku_harga_satuan': $("#item-" + index + "-BackOrderDetail-sku_harga_satuan").val().replaceAll(".", ""),
        //             // 'sku_disc_percent': $("#item-" + index + "-BackOrderDetail-sku_disc_percent").val(),
        //             'sku_disc_percent': $("#item-" + index + "-BackOrderDetail-sku_disc_percent").val(),
        //             // 'sku_disc_rp': $("#item-" + index + "-BackOrderDetail-sku_disc_rp").val(),
        //             'sku_disc_rp': $("#caption-" + index + "-BackOrderDetail-sku_disc_rp").text().replaceAll(".", ""),
        //             // 'sku_harga_nett': $("#item-" + index + "-BackOrderDetail-sku_harga_nett").val(),
        //             'sku_harga_nett': $("#caption-" + index + "-BackOrderDetail-sku_harga_nett").text().replaceAll(".", ""),
        //             'sku_weight': $("#item-" + index + "-BackOrderDetail-sku_weight").val(),
        //             'sku_weight_unit': $("#item-" + index + "-BackOrderDetail-sku_weight_unit").val(),
        //             'sku_length': $("#item-" + index + "-BackOrderDetail-sku_length").val(),
        //             'sku_length_unit': $("#item-" + index + "-BackOrderDetail-sku_length_unit").val(),
        //             'sku_width': $("#item-" + index + "-BackOrderDetail-sku_width").val(),
        //             'sku_width_unit': $("#item-" + index + "-BackOrderDetail-sku_width_unit").val(),
        //             'sku_height': $("#item-" + index + "-BackOrderDetail-sku_height").val(),
        //             'sku_height_unit': $("#item-" + index + "-BackOrderDetail-sku_height_unit").val(),
        //             'sku_volume': $("#item-" + index + "-BackOrderDetail-sku_volume").val(),
        //             'sku_volume_unit': $("#item-" + index + "-BackOrderDetail-sku_volume_unit").val(),
        //             'sku_qty': $("#item-" + index + "-BackOrderDetail-sku_qty").val().replaceAll(".", ""),
        //             'sku_keterangan': $("#item-" + index + "-BackOrderDetail-sku_keterangan").val(),
        //             'sku_request_expdate': $("#item-" + index + "-BackOrderDetail-sku_request_expdate").val(),
        //             'sku_filter_expdate': $("#item-" + index + "-BackOrderDetail-sku_filter_expdate").val(),
        //             'sku_filter_expdatebulan': $("#item-" + index + "-BackOrderDetail-sku_filter_expdatebulan").val(),
        //             'sku_satuan': $("#item-" + index + "-BackOrderDetail-sku_satuan").val(),
        //             'sku_kemasan': $("#item-" + index + "-BackOrderDetail-sku_kemasan").val(),
        //             'tipe_stock_nama': $("#item-" + index + "-BackOrderDetail-tipe_stock_nama").val(),
        //             'sku_ppn_percent': $("#item-" + index + "-BackOrderDetail-ppn_percent").val(),
        //             'sku_ppn_rp': $("#caption-" + index + "-BackOrderDetail-ppn_rp").text().replaceAll(".", ""),
        //             'sku_diskon_global_percent': $("#caption-" + index + "-BackOrderDetail-sku_disc_global_percent").text(),
        //             'sku_diskon_global_rp': $("#caption-" + index + "-BackOrderDetail-sku_disc_global_rupiah").text().replaceAll(".", "")
        //         });
        //     }
        // }

        if (tipe_so != "") {
            if (tipe_do != "") {
                if (cek_customer > 0) {
                    if (arr_detail.length > 0) {
                        $("#table-sku-delivery-only > tbody tr").each(function() {
                            var is_Qty = 0;
                            if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                                is_Qty = $(this).find("td:eq(7)").text();
                            } else {
                                is_Qty = $(this).find("td:eq(7) input").val().replaceAll(".", "");
                            }
                            // console.log(is_Qty);
                            if (is_Qty == 0) {
                                cek_qty++;
                            }
                        });
                        $("#table-sku-delivery-only > tbody tr").each(function() {
                            var is_tipe_stock = $("#item-" + x + "-BackOrderDetail-tipe_stock_nama").val();
                            // console.log(is_tipe_stock);
                            if (is_tipe_stock == "") {
                                cek_tipe_stock++;
                            }
                            x++;
                        });
                        if (cek_qty == 0) {
                            if (cek_tipe_stock == 0) {
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
                                        if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                                            $.ajax({
                                                async: false,
                                                url: "<?= base_url('FAS/BackOrder/insert_back_order_retur'); ?>",
                                                type: "POST",
                                                data: {
                                                    back_order_id: "",
                                                    depo_id: "<?= $this->session->userdata('depo_id') ?>",
                                                    back_order_kode: "",
                                                    client_wms_id: $("#backorder-client_wms_id").val(),
                                                    // client_wms_id: "",
                                                    // channel_id: $("#backorder-channel_id").val(),
                                                    channel_id: "",
                                                    back_order_is_handheld: 0,
                                                    back_order_status: $("#backorder-back_order_status").val(),
                                                    back_order_approved_by: "",
                                                    sales_id: $("#backorder-sales_id").val(),
                                                    client_pt_id: $("#backorder-client_pt_id").val(),
                                                    back_order_tgl: $("#backorder-back_order_tgl").val(),
                                                    back_order_tgl_exp: $("#backorder-back_order_tgl_exp").val(),
                                                    back_order_tgl_harga: $("#backorder-back_order_tgl_harga").val(),
                                                    back_order_tgl_sj: $("#backorder-back_order_tgl_sj").val(),
                                                    back_order_tgl_kirim: $("#backorder-back_order_tgl_kirim").val(),
                                                    back_order_tipe_pembayaran: document.querySelector('input[id="backorder-back_order_tipe_pembayaran"]:checked').value,
                                                    tipe_back_order_id: $("#backorder-tipe_back_order_id").val(),
                                                    back_order_no_po: $("#backorder-back_order_no_po").val(),
                                                    back_order_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                                                    back_order_tgl_create: "",
                                                    back_order_is_downloaded: 0,
                                                    so_is_need_approval: $("#backorder-so_is_need_approval:checked").val(),
                                                    tipe_delivery_order_id: $("#backorder-tipe_delivery_order_id").val(),
                                                    back_order_is_uploaded: 0,
                                                    principle_id: $("#backorder-principle_id").val(),
                                                    // back_order_no_reff: $("#filter-delivery_order_id option:selected").text(),
                                                    detail: arr_detail,
                                                    detail2: arr_so_detail2_ed,
                                                    detail_schedule: arr_list_schedule_sku
                                                },
                                                dataType: "JSON",
                                                success: function(data) {
                                                    if (data == 1) {
                                                        message_topright("success", "Data berhasil disimpan");
                                                        setTimeout(() => {
                                                            location.href = "<?= base_url(); ?>FAS/BackOrder/BackOrderMenu";
                                                        }, 500);
                                                    } else if (data == 2) {
                                                        message("Error!", "SKU Stock Insert Failed!", "error");
                                                    } else {
                                                        message_topright("error", "Data gagal disimpan");
                                                        if (data.length > 0) {
                                                            let arrayOfErrorsToDisplay = [];
                                                            let indexError = [];
                                                            indexError = 0;
                                                            $.each(data, function(i, v) {
                                                                arrayOfErrorsToDisplay.push({
                                                                    title: 'Data Gagal Disimpan!',
                                                                    html: `<strong>${v.sku_kode} ${v.sku_nama_produk}</strong> tidak memiliki ED produk !`
                                                                });
                                                            });
                                                            $.each(arr_detail, function(i2, v2) {
                                                                if (v.sku_id == v2.sku_id) {
                                                                    $('#row-' + i2).css('background', 'red');
                                                                    $('#row-' + i2).css('color', 'white');
                                                                }
                                                            });
                                                            Swal.mixin({
                                                                icon: 'error',
                                                                confirmButtonText: 'Next &rarr;',
                                                                showCancelButton: true,
                                                                progressSteps: indexError
                                                            }).queue(arrayOfErrorsToDisplay)
                                                        }
                                                    }
                                                }
                                            });
                                        } else {
                                            $.ajax({
                                                async: false,
                                                url: "<?= base_url('FAS/BackOrder/insert_back_order'); ?>",
                                                type: "POST",
                                                data: {
                                                    back_order_id: "",
                                                    depo_id: "<?= $this->session->userdata('depo_id') ?>",
                                                    back_order_kode: "",
                                                    client_wms_id: $("#backorder-client_wms_id").val(),
                                                    // client_wms_id: "",
                                                    // channel_id: $("#backorder-channel_id").val(),
                                                    channel_id: "",
                                                    back_order_is_handheld: 0,
                                                    back_order_status: $("#backorder-back_order_status").val(),
                                                    back_order_approved_by: "",
                                                    sales_id: $("#backorder-sales_id").val(),
                                                    client_pt_id: $("#backorder-client_pt_id").val(),
                                                    back_order_tgl: $("#backorder-back_order_tgl").val(),
                                                    back_order_tgl_exp: $("#backorder-back_order_tgl_exp").val(),
                                                    back_order_tgl_harga: $("#backorder-back_order_tgl_harga").val(),
                                                    back_order_tgl_sj: $("#backorder-back_order_tgl_sj").val(),
                                                    back_order_tgl_kirim: $("#backorder-back_order_tgl_kirim").val(),
                                                    back_order_tipe_pembayaran: document.querySelector('input[id="backorder-back_order_tipe_pembayaran"]:checked').value,
                                                    tipe_back_order_id: $("#backorder-tipe_back_order_id").val(),
                                                    back_order_no_po: $("#backorder-back_order_no_po").val(),
                                                    back_order_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                                                    back_order_tgl_create: "",
                                                    back_order_is_downloaded: 0,
                                                    so_is_need_approval: $("#backorder-so_is_need_approval:checked").val(),
                                                    tipe_delivery_order_id: $("#backorder-tipe_delivery_order_id").val(),
                                                    back_order_is_uploaded: 0,
                                                    principle_id: $("#backorder-principle_id").val(),
                                                    total_diskon_item: $("#total_diskon_item").val().replaceAll(".", ""),
                                                    total_global: $("#total_rp").val().replaceAll(".", ""),
                                                    diskon_global_percent: $("#diskon_global_percent").val(),
                                                    diskon_global_rp: $("#diskon_global_rp").val().replaceAll(".", ""),
                                                    dasar_kena_pajak: $("#dasar_kena_pajak").val().replaceAll(".", ""),
                                                    ppn_global_percent: $("#ppn_global_percent").val(),
                                                    ppn_global_rp: $("#ppn_global_rp").val().replaceAll(".", ""),
                                                    adjustment: $("#adjustment").val().replaceAll(".", ""),
                                                    total_faktur: $("#total_faktur").val().replaceAll(".", ""),
                                                    // back_order_no_reff: $("#filter-delivery_order_id option:selected").text(),
                                                    detail: arr_detail,
                                                    detail_schedule: arr_list_schedule_sku,
                                                    tipe_ppn: $("#backorder-back_order_tipe_ppn:checked").val(),
                                                    keterangan: $("#keterangan_detail").val()
                                                },
                                                dataType: "JSON",
                                                success: function(data) {
                                                    if (data == 1) {
                                                        message_topright("success", "Data berhasil disimpan");
                                                        setTimeout(() => {
                                                            location.href = "<?= base_url(); ?>FAS/BackOrder/BackOrderMenu";
                                                        }, 500);
                                                    } else {
                                                        message_topright("error", "Data gagal disimpan");
                                                    }
                                                }
                                            });
                                        }
                                        //ajax save data
                                    }
                                });
                                // console.log(arr_header);
                                // console.log(arr_detail);
                                // console.log(arr_back_order_detail2);
                            } else {
                                cek_tipe_stock = 0;
                                message("Error!", "Tipe stock tidak boleh kosong!", "error");
                            }
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
                message("Pilih Tipe DO!", "Tipe Delivery order belum dipilih", "error");
            }
        } else {
            message("Pilih Tipe BO!", "Tipe Back Order belum dipilih", "error");
        }
    });

    $("#btnupdateso").on("click", function() {
        var so_id = $("#so_id").val();
        var cek_customer = $("#cek_customer").val();
        var tipe_so = $("#backorder-tipe_back_order_id").val();
        var tipe_do = $("#backorder-tipe_delivery_order_id").val();
        var x = 0;
        arr_header = [];
        arr_detail = [];
        $.each(arr_detail, function(i2, v2) {
            $('#row-' + i2).css('background', '');
            $('#row-' + i2).css('color', '');
        });

        $.each(arr_back_order_detail, function(i, v) {
            arr_detail.push({
                'client_wms_id': $("#item-" + i + "-BackOrderDetail-client_wms_id").val(),
                'sku_id': $("#item-" + i + "-BackOrderDetail-sku_id").val(),
                'sku_kode': $("#item-" + i + "-BackOrderDetail-sku_kode").val(),
                'sku_nama_produk': $("#item-" + i + "-BackOrderDetail-sku_nama_produk").val(),
                'sku_harga_satuan': $("#item-" + i + "-BackOrderDetail-sku_harga_satuan").val().replaceAll(".", ""),
                // 'sku_disc_percent': $("#item-" + i + "-BackOrderDetail-sku_disc_percent").val(),
                'sku_disc_percent': $("#item-" + i + "-BackOrderDetail-sku_disc_percent").val(),
                // 'sku_disc_rp': $("#item-" + i + "-BackOrderDetail-sku_disc_rp").val(),
                'sku_disc_rp': $("#caption-" + i + "-BackOrderDetail-sku_disc_rp").text().replaceAll(".", ""),
                // 'sku_harga_nett': $("#item-" + i + "-BackOrderDetail-sku_harga_nett").val(),
                'sku_harga_nett': $("#caption-" + i + "-BackOrderDetail-sku_harga_nett").text().replaceAll(".", ""),
                'sku_weight': $("#item-" + i + "-BackOrderDetail-sku_weight").val(),
                'sku_weight_unit': $("#item-" + i + "-BackOrderDetail-sku_weight_unit").val(),
                'sku_length': $("#item-" + i + "-BackOrderDetail-sku_length").val(),
                'sku_length_unit': $("#item-" + i + "-BackOrderDetail-sku_length_unit").val(),
                'sku_width': $("#item-" + i + "-BackOrderDetail-sku_width").val(),
                'sku_width_unit': $("#item-" + i + "-BackOrderDetail-sku_width_unit").val(),
                'sku_height': $("#item-" + i + "-BackOrderDetail-sku_height").val(),
                'sku_height_unit': $("#item-" + i + "-BackOrderDetail-sku_height_unit").val(),
                'sku_volume': $("#item-" + i + "-BackOrderDetail-sku_volume").val(),
                'sku_volume_unit': $("#item-" + i + "-BackOrderDetail-sku_volume_unit").val(),
                'sku_qty': $("#item-" + i + "-BackOrderDetail-sku_qty").val().replaceAll(".", ""),
                'sku_keterangan': $("#item-" + i + "-BackOrderDetail-sku_keterangan").val(),
                'sku_request_expdate': $("#item-" + i + "-BackOrderDetail-sku_request_expdate").val(),
                'sku_filter_expdate': $("#item-" + i + "-BackOrderDetail-sku_filter_expdate").val(),
                'sku_filter_expdatebulan': $("#item-" + i + "-BackOrderDetail-sku_filter_expdatebulan").val(),
                'sku_satuan': $("#item-" + i + "-BackOrderDetail-sku_satuan").val(),
                'sku_kemasan': $("#item-" + i + "-BackOrderDetail-sku_kemasan").val(),
                'tipe_stock_nama': $("#item-" + i + "-BackOrderDetail-tipe_stock_nama").val(),
                'sku_ppn_percent': $("#item-" + i + "-BackOrderDetail-ppn_percent").val(),
                'sku_ppn_rp': $("#caption-" + i + "-BackOrderDetail-ppn_rp").text().replaceAll(".", ""),
                'sku_diskon_global_percent': $("#caption-" + i + "-BackOrderDetail-sku_disc_global_percent").text(),
                'sku_diskon_global_rp': $("#caption-" + i + "-BackOrderDetail-sku_disc_global_rupiah").text().replaceAll(".", "")
            });
        });

        // for (var index = 0; index < arr_back_order_detail.length; index++) {
        //     if (arr_back_order_detail[index] != "") {
        //         arr_detail.push({
        //             'client_wms_id': $("#item-" + index + "-BackOrderDetail-client_wms_id").val(),
        //             'sku_id': $("#item-" + index + "-BackOrderDetail-sku_id").val(),
        //             'sku_kode': $("#item-" + index + "-BackOrderDetail-sku_kode").val(),
        //             'sku_nama_produk': $("#item-" + index + "-BackOrderDetail-sku_nama_produk").val(),
        //             'sku_harga_satuan': $("#item-" + index + "-BackOrderDetail-sku_harga_satuan").val().replaceAll(".", ""),
        //             // 'sku_disc_percent': $("#item-" + index + "-BackOrderDetail-sku_disc_percent").val(),
        //             'sku_disc_percent': $("#item-" + index + "-BackOrderDetail-sku_disc_percent").val(),
        //             // 'sku_disc_rp': $("#item-" + index + "-BackOrderDetail-sku_disc_rp").val(),
        //             'sku_disc_rp': $("#caption-" + index + "-BackOrderDetail-sku_disc_rp").text().replaceAll(".", ""),
        //             // 'sku_harga_nett': $("#item-" + index + "-BackOrderDetail-sku_harga_nett").val(),
        //             'sku_harga_nett': $("#caption-" + index + "-BackOrderDetail-sku_harga_nett").text().replaceAll(".", ""),
        //             'sku_weight': $("#item-" + index + "-BackOrderDetail-sku_weight").val(),
        //             'sku_weight_unit': $("#item-" + index + "-BackOrderDetail-sku_weight_unit").val(),
        //             'sku_length': $("#item-" + index + "-BackOrderDetail-sku_length").val(),
        //             'sku_length_unit': $("#item-" + index + "-BackOrderDetail-sku_length_unit").val(),
        //             'sku_width': $("#item-" + index + "-BackOrderDetail-sku_width").val(),
        //             'sku_width_unit': $("#item-" + index + "-BackOrderDetail-sku_width_unit").val(),
        //             'sku_height': $("#item-" + index + "-BackOrderDetail-sku_height").val(),
        //             'sku_height_unit': $("#item-" + index + "-BackOrderDetail-sku_height_unit").val(),
        //             'sku_volume': $("#item-" + index + "-BackOrderDetail-sku_volume").val(),
        //             'sku_volume_unit': $("#item-" + index + "-BackOrderDetail-sku_volume_unit").val(),
        //             'sku_qty': $("#item-" + index + "-BackOrderDetail-sku_qty").val().replaceAll(".", ""),
        //             'sku_keterangan': $("#item-" + index + "-BackOrderDetail-sku_keterangan").val(),
        //             'sku_request_expdate': $("#item-" + index + "-BackOrderDetail-sku_request_expdate").val(),
        //             'sku_filter_expdate': $("#item-" + index + "-BackOrderDetail-sku_filter_expdate").val(),
        //             'sku_filter_expdatebulan': $("#item-" + index + "-BackOrderDetail-sku_filter_expdatebulan").val(),
        //             'sku_satuan': $("#item-" + index + "-BackOrderDetail-sku_satuan").val(),
        //             'sku_kemasan': $("#item-" + index + "-BackOrderDetail-sku_kemasan").val(),
        //             'tipe_stock_nama': $("#item-" + index + "-BackOrderDetail-tipe_stock_nama").val(),
        //             'sku_ppn_percent': $("#item-" + index + "-BackOrderDetail-ppn_percent").val(),
        //             'sku_ppn_rp': $("#caption-" + index + "-BackOrderDetail-ppn_rp").text().replaceAll(".", ""),
        //             'sku_diskon_global_percent': $("#caption-" + index + "-BackOrderDetail-sku_disc_global_percent").text(),
        //             'sku_diskon_global_rp': $("#caption-" + index + "-BackOrderDetail-sku_disc_global_rupiah").text().replaceAll(".", "")
        //         });
        //     }
        // }
        // console.log(arr_sku);
        if (tipe_so != "") {
            if (tipe_do != "") {
                if (cek_customer > 0) {
                    if (arr_detail.length > 0) {
                        $("#table-sku-delivery-only > tbody tr").each(function() {
                            var is_Qty = 0;
                            // console.log(is_Qty);
                            if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                                is_Qty = $(this).find("td:eq(7)").text();
                            } else {
                                is_Qty = $(this).find("td:eq(7) input").val().replaceAll(".", "");
                            }
                            if (is_Qty == 0) {
                                cek_qty++;
                            }
                        });
                        $("#table-sku-delivery-only > tbody tr").each(function() {
                            var is_tipe_stock = $("#item-" + x + "-BackOrderDetail-tipe_stock_nama").val();
                            // console.log(is_tipe_stock);
                            if (is_tipe_stock == "") {
                                cek_tipe_stock++;
                            }
                            x++;
                        });
                        if (cek_qty == 0) {
                            if (cek_tipe_stock == 0) {
                                messageBoxBeforeRequest('Pastikan data yang sudah anda input benar!', 'Iya, Simpan', 'Tidak, Tutup').then((result) => {
                                    if (result.value == true) {
                                        if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                                            requestAjax("<?= base_url('FAS/BackOrder/update_back_order_retur'); ?>", {
                                                back_order_id: so_id,
                                                depo_id: "<?= $this->session->userdata('depo_id') ?>",
                                                back_order_kode: $("#backorder-back_order_kode").val(),
                                                client_wms_id: $("#backorder-client_wms_id").val(),
                                                // client_wms_id: "",
                                                // channel_id: $("#backorder-channel_id").val(),
                                                channel_id: "",
                                                back_order_is_handheld: 0,
                                                back_order_status: $("#backorder-back_order_status").val(),
                                                back_order_approved_by: "",
                                                sales_id: $("#backorder-sales_id").val(),
                                                client_pt_id: $("#backorder-client_pt_id").val(),
                                                back_order_tgl: $("#backorder-back_order_tgl").val(),
                                                back_order_tgl_exp: $("#backorder-back_order_tgl_exp").val(),
                                                back_order_tgl_harga: $("#backorder-back_order_tgl_harga").val(),
                                                back_order_tgl_sj: $("#backorder-back_order_tgl_sj").val(),
                                                back_order_tgl_kirim: $("#backorder-back_order_tgl_kirim").val(),
                                                back_order_tipe_pembayaran: document.querySelector('input[id="backorder-back_order_tipe_pembayaran"]:checked').value,
                                                tipe_back_order_id: $("#backorder-tipe_back_order_id").val(),
                                                back_order_no_po: $("#backorder-back_order_no_po").val(),
                                                back_order_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                                                back_order_tgl_create: "",
                                                back_order_is_downloaded: 0,
                                                so_is_need_approval: $("#backorder-so_is_need_approval:checked").val(),
                                                tipe_delivery_order_id: $("#backorder-tipe_delivery_order_id").val(),
                                                back_order_is_uploaded: 0,
                                                principle_id: $("#backorder-principle_id").val(),
                                                // back_order_no_reff: $("#filter-delivery_order_id option:selected").text(),
                                                detail: arr_detail,
                                                detail2: arr_so_detail2_ed,
                                                detail_schedule: arr_list_schedule_sku,
                                                tgl_update: $("#tgl_update").val() == 'null' ? '' : $("#tgl_update").val()
                                            }, "POST", "JSON", function(data) {
                                                if (data.status == 400) {
                                                    return messageNotSameLastUpdated('FAS/BackOrder/BackOrderMenu');
                                                }
                                                if (data.status == 200) {
                                                    message_topright("success", "Data berhasil disimpan");
                                                    setTimeout(() => {
                                                        location.href = "<?= base_url(); ?>FAS/BackOrder/BackOrderMenu";
                                                    }, 500);
                                                } else {
                                                    message_topright("error", "Data gagal disimpan");
                                                    if (data.length > 0) {
                                                        let arrayOfErrorsToDisplay = [];
                                                        let indexError = [];
                                                        indexError = 0;
                                                        $.each(data, function(i, v) {
                                                            arrayOfErrorsToDisplay.push({
                                                                title: 'Data Gagal Disimpan!',
                                                                html: `<strong>${v.sku_kode} ${v.sku_nama_produk}</strong> tidak memiliki ED produk !`
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
                                                    }
                                                }
                                            })
                                        } else {
                                            requestAjax("<?= base_url('FAS/BackOrder/update_back_order'); ?>", {
                                                back_order_id: so_id,
                                                depo_id: "<?= $this->session->userdata('depo_id') ?>",
                                                back_order_kode: $("#backorder-back_order_kode").val(),
                                                client_wms_id: $("#backorder-client_wms_id").val(),
                                                // client_wms_id: "",
                                                // channel_id: $("#backorder-channel_id").val(),
                                                channel_id: "",
                                                back_order_is_handheld: 0,
                                                back_order_status: $("#backorder-back_order_status").val(),
                                                back_order_approved_by: "",
                                                sales_id: $("#backorder-sales_id").val(),
                                                client_pt_id: $("#backorder-client_pt_id").val(),
                                                back_order_tgl: $("#backorder-back_order_tgl").val(),
                                                back_order_tgl_exp: $("#backorder-back_order_tgl_exp").val(),
                                                back_order_tgl_harga: $("#backorder-back_order_tgl_harga").val(),
                                                back_order_tgl_sj: $("#backorder-back_order_tgl_sj").val(),
                                                back_order_tgl_kirim: $("#backorder-back_order_tgl_kirim").val(),
                                                back_order_tipe_pembayaran: document.querySelector('input[id="backorder-back_order_tipe_pembayaran"]:checked').value,
                                                tipe_back_order_id: $("#backorder-tipe_back_order_id").val(),
                                                back_order_no_po: $("#backorder-back_order_no_po").val(),
                                                back_order_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                                                back_order_tgl_create: "",
                                                back_order_is_downloaded: 0,
                                                so_is_need_approval: $("#backorder-so_is_need_approval:checked").val(),
                                                tipe_delivery_order_id: $("#backorder-tipe_delivery_order_id").val(),
                                                // back_order_no_reff: $("#filter-delivery_order_id option:selected").text(),
                                                back_order_is_uploaded: 0,
                                                principle_id: $("#backorder-principle_id").val(),
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
                                                detail_schedule: arr_list_schedule_sku,
                                                tipe_ppn: $("#backorder-back_order_tipe_ppn:checked").val(),
                                                keterangan: $("#keterangan_detail").val(),
                                                tgl_update: $("#tgl_update").val() == 'null' ? '' : $("#tgl_update").val()
                                            }, "POST", "JSON", function(data) {
                                                if (data.status == 400) {
                                                    return messageNotSameLastUpdated('FAS/BackOrder/BackOrderMenu');
                                                } else if (data.status == 401) {
                                                    var alert = "Jadwal SKU belum ditentukan";
                                                    message("Error", alert, "error");
                                                } else if (data.status == 200) {
                                                    message_topright("success", "Data berhasil disimpan");
                                                    setTimeout(() => {
                                                        location.href = "<?= base_url(); ?>FAS/BackOrder/BackOrderMenu";
                                                    }, 500);
                                                } else {
                                                    message_topright("error", "Data gagal disimpan");
                                                }
                                            })
                                        }
                                    }
                                });
                                // Swal.fire({
                                // 	title: "Apakah anda yakin?",
                                // 	text: "Pastikan data yang sudah anda input benar!",
                                // 	icon: "warning",
                                // 	showCancelButton: true,
                                // 	confirmButtonColor: "#3085d6",
                                // 	cancelButtonColor: "#d33",
                                // 	confirmButtonText: "Ya, Simpan",
                                // 	cancelButtonText: "Tidak, Tutup"
                                // }).then((result) => {
                                // 	if (result.value == true) {
                                // 		//ajax save data
                                // 		$.ajax({
                                // 			async: false,
                                // 			url: "<?= base_url('FAS/BackOrder/update_back_order'); ?>",
                                // 			type: "POST",
                                // 			data: {
                                // 				back_order_id: so_id,
                                // 				depo_id: "<?= $this->session->userdata('depo_id') ?>",
                                // 				back_order_kode: $("#backorder-back_order_kode").val(),
                                // 				// client_wms_id: $("#backorder-client_wms_id").val(),
                                // 				client_wms_id: "",
                                // 				// channel_id: $("#backorder-channel_id").val(),
                                // 				channel_id: "",
                                // 				back_order_is_handheld: 0,
                                // 				back_order_status: $("#backorder-back_order_status").val(),
                                // 				back_order_approved_by: "",
                                // 				sales_id: $("#backorder-sales_id").val(),
                                // 				client_pt_id: $("#backorder-client_pt_id").val(),
                                // 				back_order_tgl: $("#backorder-back_order_tgl").val(),
                                // 				back_order_tgl_exp: $("#backorder-back_order_tgl_exp").val(),
                                // 				back_order_tgl_harga: $("#backorder-back_order_tgl_harga").val(),
                                // 				back_order_tgl_sj: $("#backorder-back_order_tgl_sj").val(),
                                // 				back_order_tgl_kirim: $("#backorder-back_order_tgl_kirim").val(),
                                // 				back_order_tipe_pembayaran: document.querySelector('input[id="backorder-back_order_tipe_pembayaran"]:checked').value,
                                // 				tipe_back_order_id: $("#backorder-tipe_back_order_id").val(),
                                // 				back_order_no_po: $("#backorder-back_order_no_po").val(),
                                // 				back_order_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                                // 				back_order_tgl_create: "",
                                // 				back_order_is_downloaded: 0,
                                // 				so_is_need_approval: $("#backorder-so_is_need_approval:checked").val(),
                                // 				tipe_delivery_order_id: $("#backorder-tipe_delivery_order_id").val(),
                                // 				back_order_is_uploaded: 0,
                                // 				detail: arr_detail,
                                // 				tgl_update: $("#tgl_update").val() == 'null' ? '' : $("#tgl_update").val()
                                // 			},
                                // 			dataType: "JSON",
                                // 			success: function(data) {
                                // 				if (data.status == 400) {
                                // 					return messageNotSameLastUpdated('FAS/BackOrder/BackOrderMenu');
                                // 				}
                                // 				if (data.status == 200) {
                                // 					message_topright("success", "Data berhasil disimpan");
                                // 					setTimeout(() => {
                                // 						location.href = "<?= base_url(); ?>FAS/BackOrder/BackOrderMenu";
                                // 					}, 500);
                                // 				} else {
                                // 					message_topright("error", "Data gagal disimpan");
                                // 				}
                                // 			}
                                // 		});
                                // 	}
                                // });
                                // console.log(arr_header);
                                // console.log(arr_detail);
                                // console.log(arr_back_order_detail2);
                            } else {
                                cek_tipe_stock = 0;
                                message("Error!", "Tipe stock tidak boleh kosong!", "error");
                            }
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
                message("Pilih Tipe DO!", "Tipe Delivery order belum dipilih", "error");
            }
        } else {
            message("Pilih Tipe BO!", "Tipe Back Order belum dipilih", "error");
        }
    });

    $("#btn-approv-so").on("click", function() {
        var arrayOfErrorsToDisplay = [];
        var indexError = [];

        var count_so_list = $("#jml_so").val();
        var list_msg = [];
        var cek_complete = [];
        var count_so = 0;
        // var count_so_list = $("#table_list_data_so > tbody tr").length;
        if (count_so_list > 0) {
            var arr_temp = [];
            for (var i = 0; i < count_so_list; i++) {
                var checked = $('[id="check-so-' + i + '"]:checked').length;
                var so_id = "'" + $("#check-so-" + i).val() + "'";
                var so_status = $("#item-" + i + "-ListSO-back_order_status").val();
                var check_so_id = $("#check-so-" + i).val();
                var tglUpdate = $("#check-so-" + i).attr('data-tgl-update') == 'null' ? '' : $("#check-so-" + i).attr('data-tgl-update');
                if (checked > 0 && so_status == "Draft") {
                    arr_back_order.push(so_id);
                    arr_temp.push({
                        so_id: check_so_id,
                        tglUpdate: tglUpdate
                    })
                }
            }
            var result = arr_back_order.reduce((unique, o) => {
                if (!unique.some(obj => obj === o)) {
                    unique.push(o);
                }
                return unique;
            }, []);
            arr_back_order = result;
            // alert(arr_back_order.length);
            if (arr_back_order.length > 0) {
                Swal.fire({
                    title: GetLanguageByKode('CAPTION-APAANDAYAKIN'),
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: GetLanguageByKode('CAPTION-LANJUT'),
                    cancelButtonText: GetLanguageByKode('CAPTION-CLOSE')
                }).then((result) => {
                    if (result.value == true) {
                        $("#loadingviewso").show();
                        $("#btn-approv-so").prop("disabled", true);
                        $("#btn-search-data-so").prop("disabled", true);
                        Swal.fire({
                            title: '<span ><i class="fa fa-spinner fa-spin"></i> Proses Confirm Data!</span> ',
                            text: 'Mohon tunggu sebentar...',
                            icon: 'warning',
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                        //ajax save data
                        setTimeout(() => {
                            $.ajax({
                                async: false,
                                type: 'POST',
                                url: "<?= base_url('FAS/BackOrder/GetBackOrderByListId'); ?>",
                                data: {
                                    arr_back_order: arr_back_order,
                                    arr_temp: arr_temp
                                },
                                dataType: "JSON",
                                success: function(response) {
                                    if (response == 400) {
                                        return messageNotSameLastUpdated();
                                    }
                                    if (response.SOHeader != 0) {
                                        count_so = response.SOHeader.length;
                                        $.each(response.SOHeader, function(i, v) {
                                            $.ajax({
                                                async: false,
                                                url: "<?= base_url('FAS/BackOrder/GetBackOrderDetailByListId'); ?>",
                                                type: "POST",
                                                data: {
                                                    id: v.back_order_id
                                                },
                                                dataType: "JSON",
                                                success: function(response) {
                                                    arr_detail = [];
                                                    arr_list_schedule_sku = [];

                                                    if (response.SODetail != 0) {
                                                        $.each(response.SODetail, function(i2, v2) {
                                                            arr_detail.push({
                                                                'client_wms_id': v2.client_wms_id,
                                                                'sku_id': v2.sku_id,
                                                                'sku_kode': v2.sku_kode,
                                                                'sku_nama_produk': v2.sku_nama_produk,
                                                                'sku_harga_satuan': v2.sku_harga_satuan,
                                                                'sku_disc_percent': v2.sku_disc_percent,
                                                                'sku_disc_rp': v2.sku_disc_rp,
                                                                'sku_harga_nett': v2.sku_harga_nett,
                                                                'sku_weight': v2.sku_weight,
                                                                'sku_weight_unit': v2.sku_weight_unit,
                                                                'sku_length': v2.sku_length,
                                                                'sku_length_unit': v2.sku_length_unit,
                                                                'sku_width': v2.sku_width,
                                                                'sku_width_unit': v2.sku_width_unit,
                                                                'sku_height': v2.sku_height,
                                                                'sku_height_unit': v2.sku_height_unit,
                                                                'sku_volume': v2.sku_volume,
                                                                'sku_volume_unit': v2.sku_volume_unit,
                                                                'sku_qty': v2.sku_qty,
                                                                'sku_keterangan': v2.sku_keterangan,
                                                                'sku_request_expdate': v2.sku_request_expdate,
                                                                'sku_filter_expdate': v2.sku_filter_expdate,
                                                                'sku_filter_expdatebulan': v2.sku_filter_expdatebulan,
                                                                'sku_satuan': v2.sku_satuan,
                                                                'sku_kemasan': v2.sku_kemasan,
                                                                'tipe_stock_nama': v2.tipe_stock_nama,
                                                                'sku_ppn_percent': v2.sku_ppn_percent,
                                                                'sku_ppn_rp': v2.sku_ppn_rp,
                                                                'sku_diskon_global_percent': v2.sku_diskon_global_percent,
                                                                'sku_diskon_global_rp': v2.sku_diskon_global_rp
                                                            });
                                                        });
                                                    }

                                                    if (response.SOSchedule != 0) {
                                                        $.each(response.SOSchedule, function(i, v) {
                                                            arr_list_schedule_sku.push({
                                                                'idx': v.back_order_detail3_id,
                                                                'sku_id': v.sku_id,
                                                                'bulan': v.bulan,
                                                                'tahun': v.tahun,
                                                                'qty': v.sku_qty
                                                            });
                                                        });
                                                    }
                                                }
                                            });

                                            if (arr_detail.length > 0) {
                                                if (v.back_order_status == "Draft") {
                                                    // requestAjax("<?= base_url('FAS/BackOrder/update_back_order'); ?>", {
                                                    // 	back_order_id: v.back_order_id,
                                                    // 	depo_id: v.depo_id,
                                                    // 	back_order_kode: v.back_order_kode,
                                                    // 	client_wms_id: v.client_wms_id,
                                                    // 	channel_id: v.channel_id,
                                                    // 	back_order_is_handheld: v.back_order_is_handheld,
                                                    // 	back_order_status: "Approved",
                                                    // 	back_order_approved_by: v.back_order_approved_by,
                                                    // 	sales_id: v.sales_id,
                                                    // 	client_pt_id: v.client_pt_id,
                                                    // 	back_order_tgl: v.back_order_tgl,
                                                    // 	back_order_tgl_exp: v.back_order_tgl_exp,
                                                    // 	back_order_tgl_harga: v.back_order_tgl_harga,
                                                    // 	back_order_tgl_sj: v.back_order_tgl_sj,
                                                    // 	back_order_tgl_kirim: v.back_order_tgl_kirim,
                                                    // 	back_order_tipe_pembayaran: v.back_order_tipe_pembayaran,
                                                    // 	tipe_back_order_id: v.tipe_back_order_id,
                                                    // 	back_order_no_po: v.back_order_no_po,
                                                    // 	back_order_who_create: v.back_order_who_create,
                                                    // 	back_order_tgl_create: v.back_order_tgl_create,
                                                    // 	back_order_is_downloaded: v.back_order_is_downloaded,
                                                    // 	so_is_need_approval: v.so_is_need_approval,
                                                    // 	tipe_delivery_order_id: v.tipe_delivery_order_id,
                                                    // 	back_order_is_uploaded: v.back_order_is_uploaded,
                                                    // 	detail: arr_detail,
                                                    // 	tgl_update: v.tglUpdate
                                                    // }, "POST", "JSON", function(response) {
                                                    // 	if (response.status == 200) {
                                                    // 		list_msg.push({
                                                    // 			"kode": "200",
                                                    // 			"so_kode": v.back_order_kode
                                                    // 		});
                                                    // 	} else {
                                                    // 		list_msg.push({
                                                    // 			"kode": "500",
                                                    // 			"so_kode": v.back_order_kode
                                                    // 		});
                                                    // 	}
                                                    // })
                                                    $.ajax({
                                                        async: false,
                                                        url: "<?= base_url('FAS/BackOrder/update_back_order'); ?>",
                                                        type: "POST",
                                                        data: {
                                                            back_order_id: v.back_order_id,
                                                            depo_id: v.depo_id,
                                                            back_order_kode: v.back_order_kode,
                                                            client_wms_id: v.client_wms_id,
                                                            channel_id: v.channel_id,
                                                            back_order_is_handheld: v.back_order_is_handheld,
                                                            back_order_status: "Approved",
                                                            back_order_approved_by: v.back_order_approved_by,
                                                            sales_id: v.sales_id,
                                                            client_pt_id: v.client_pt_id,
                                                            back_order_tgl: v.back_order_tgl,
                                                            back_order_tgl_exp: v.back_order_tgl_exp,
                                                            back_order_tgl_harga: v.back_order_tgl_harga,
                                                            back_order_tgl_sj: v.back_order_tgl_sj,
                                                            back_order_tgl_kirim: v.back_order_tgl_kirim,
                                                            back_order_tipe_pembayaran: v.back_order_tipe_pembayaran,
                                                            tipe_back_order_id: v.tipe_back_order_id,
                                                            back_order_no_po: v.back_order_no_po,
                                                            back_order_who_create: v.back_order_who_create,
                                                            back_order_tgl_create: v.back_order_tgl_create,
                                                            back_order_is_downloaded: v.back_order_is_downloaded,
                                                            so_is_need_approval: v.so_is_need_approval,
                                                            tipe_delivery_order_id: v.tipe_delivery_order_id,
                                                            back_order_is_uploaded: v.back_order_is_uploaded,
                                                            principle_id: v.principle_id,
                                                            // back_order_no_reff: v.back_order_no_reff,
                                                            detail: arr_detail,
                                                            detail_schedule: arr_list_schedule_sku,
                                                            tgl_update: v.tglUpdate,
                                                            total_global: v.total,
                                                            diskon_global_percent: v.diskon_global_percent,
                                                            diskon_global_rp: v.diskon_global_rp,
                                                            dasar_kena_pajak: v.dasar_kena_pajak,
                                                            ppn_global_percent: v.ppn_global_percent,
                                                            ppn_global_rp: v.ppn_global_rp,
                                                            adjustment: v.adjustment,
                                                            total_faktur: v.total_faktur,
                                                            total_diskon_item: v.total_diskon_item,
                                                            tipe_ppn: v.tipe_ppn,
                                                            keterangan: v.keterangan
                                                        },
                                                        dataType: "JSON",
                                                        success: function(response) {
                                                            cek_complete++;
                                                            // Swal.close();
                                                            if (response.status == 200) {
                                                                indexError.push(i + 1);
                                                                arrayOfErrorsToDisplay.push({
                                                                    title: 'Success',
                                                                    html: `Backorder <strong>${v.back_order_kode}</strong> berhasil diapproved`
                                                                });
                                                            } else if (response.status == 401) {
                                                                indexError.push(i + 1);
                                                                arrayOfErrorsToDisplay.push({
                                                                    title: 'Error',
                                                                    html: `Backorder <strong>${v.back_order_kode}</strong> belum melakukan pengaturan jadwal SKU`
                                                                });
                                                            } else {
                                                                let alert = GetLanguageByKode('CAPTION-ALERT-BOGAGALCONFIRM');
                                                                indexError.push(i + 1);
                                                                arrayOfErrorsToDisplay.push({
                                                                    title: 'Error',
                                                                    html: `Backorder <strong>${v.back_order_kode}</strong> ${alert}`
                                                                });
                                                            }
                                                        }
                                                    });
                                                }
                                            } else {
                                                let alert = GetLanguageByKode('CAPTION-ALERT-BOGAGALCONFIRM');
                                                indexError.push(i + 1);
                                                arrayOfErrorsToDisplay.push({
                                                    title: 'Error',
                                                    html: `Backorder <strong>${v.back_order_kode}</strong> ${alert}`
                                                });
                                            }
                                        })
                                    }
                                    // alert(count_so + "==" + cek_complete);
                                    if (count_so == cek_complete) {
                                        // Swal.close();
                                        // let alert_tes = GetLanguageByKode('CAPTION-ALERT-SOBERHASILAPPROVE');
                                        // message('Success', alert_tes, 'success');

                                        Swal.mixin({
                                            icon: 'info',
                                            confirmButtonText: 'Next &rarr;',
                                            showCancelButton: true,
                                            progressSteps: indexError
                                        }).queue(arrayOfErrorsToDisplay).then((result) => {
                                            // Setelah queue selesai, lakukan sesuatu
                                            if (result.value) {
                                                setTimeout(() => {
                                                    GetDataSO();
                                                }, 500);
                                            }
                                        });
                                    } else {
                                        // Swal.close();
                                        // let alert_tes = GetLanguageByKode('CAPTION-ALERT-SOGAGALAPPROVE');
                                        // message('Error', alert_tes, 'error');

                                        Swal.mixin({
                                            icon: 'info',
                                            confirmButtonText: 'Next &rarr;',
                                            showCancelButton: true,
                                            progressSteps: indexError
                                        }).queue(arrayOfErrorsToDisplay).then((result) => {
                                            // Setelah queue selesai, lakukan sesuatu
                                            if (result.value) {
                                                setTimeout(() => {
                                                    GetDataSO();
                                                }, 500);
                                            }
                                        });

                                        // setTimeout(() => {
                                        //     GetDataSO();
                                        // }, 500);
                                    }
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    message("Error", "Error 500 Internal Server Connection Failure", "error");

                                    $("#loadingviewso").hide();
                                    $("#btn-approv-so").prop("disabled", false);
                                    $("#btn-search-data-so").prop("disabled", false);
                                },
                                complete: function() {
                                    $("#loadingviewso").hide();
                                    $("#btn-approv-so").prop("disabled", false);
                                    $("#btn-search-data-so").prop("disabled", false);
                                }
                            });
                        }, 1000);
                        // $.each(list_msg, function(i, v) {
                        // 	if (v.kode == "200") {
                        // 		let alert_tes = GetLanguageByKode('CAPTION-ALERT-SOBERHASILAPPROVE');
                        // 		var msg = "<span style='font-weight:bold'>SO " + v.so_kode + "</span> " + alert_tes;
                        // 		var msgtype = 'success';
                        // 		//if (!window.__cfRLUnblockHandlers) return false;
                        // 		new PNotify
                        // 			({
                        // 				title: 'Info',
                        // 				text: msg,
                        // 				type: msgtype,
                        // 				styling: 'bootstrap3',
                        // 				delay: 3000,
                        // 				stack: stack_center
                        // 			});
                        // 	} else {
                        // 		let alert_tes = GetLanguageByKode('CAPTION-ALERT-SOGAGALAPPROVE');
                        // 		var msg = "<span style='font-weight:bold'>SO " + v.so_kode + "</span> " + alert_tes;
                        // 		var msgtype = 'error';
                        // 		//if (!window.__cfRLUnblockHandlers) return false;
                        // 		new PNotify
                        // 			({
                        // 				title: 'Info',
                        // 				text: msg,
                        // 				type: msgtype,
                        // 				styling: 'bootstrap3',
                        // 				delay: 3000,
                        // 				stack: stack_center
                        // 			});
                        // 	}
                        // });

                        // setTimeout(() => {
                        //     $("#loadingviewso").hide();
                        //     $("#btn-approv-so").prop("disabled", false);
                        //     $("#btn-search-data-so").prop("disabled", false);
                        //     GetDataSO();
                        // }, 500);
                    }
                });
            } else {
                let alert_tes = GetLanguageByKode("CAPTION-ALERT-CHECKBOXSOHRSDIPILIH");
                message("Error", alert_tes, "error");
            }
        } else {
            let alert_tes = GetLanguageByKode("CAPTION-ALERT-CHECKBOXSOHRSDIPILIH");
            message("Error", alert_tes, "error");
        }
    });

    function DeleteSKU(row, index, sku_id, random_id) {
        var so_id = $("#so_id").val();
        var row = row.parentNode.parentNode;
        row.parentNode.removeChild(row);

        // arr_sku[index] = "";
        // arr_back_order_detail[index] = "";

        const findIndexData = arr_sku.findIndex((value) => value.sku_id == sku_id);
        const findIndexData2 = arr_back_order_detail.findIndex((value) => value.sku_id == sku_id);

        if (findIndexData > -1) {
            arr_sku.splice(findIndexData, 1);
        }

        if (findIndexData2 > -1) {
            arr_back_order_detail.splice(findIndexData2, 1);
        }

        // arr_back_order_detail = jQuery.grep(arr_back_order_detail, function(value) {
        //     return value.random_id != random_id;
        // });

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/BackOrder/delete_back_order_detail_2_temp') ?>",
            data: {
                so_id: so_id,
                sku_id: sku_id
            },
            dataType: "JSON",
            success: function(response) {
                // console.log('delete');
            }
        });

        arr_so_detail2_ed = jQuery.grep(arr_so_detail2_ed, function(value) {
            return value.sku_id != sku_id && value.random_id != random_id;
        });

        if ($("#table-sku-delivery-only tbody tr").length == 0) {
            $("#backorder-client_wms_id").prop("disabled", false);
            $("#backorder-principle_id").prop("disabled", false);
        }

        <?php if ($act == "edit") { ?>
            HeaderReadonly();
        <?php } ?>

        pushToTableSKUDelivery();
        triggerDetail();
    }

    function ScheduleSKU(row, index, sku_id, sku_kode, sku_nama_produk, sku_satuan, sku_kemasan, principle, brand) {
        $("#modal_list_data_pilih_jadwal_sku").modal('show');

        var dateStr = $('#backorder-back_order_tgl').val(); // Ambil teks tanggal
        var dateParts = dateStr.split('/'); // Pisahkan tanggal berdasarkan '/'
        var newDateStr = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0]; // Susun ulang format

        let dateInput = newDateStr;
        let date = new Date(dateInput);
        let year = date.getFullYear();

        var total_sku_qty = 0;

        $.each(arr_back_order_detail, function(i, v) {
            if (v.sku_id == sku_id) {
                total_sku_qty += parseInt(v.sku_qty);
            }
        });

        $("#filter_schedule_sku_id").val(sku_id);
        $("#filter_schedule_sku_kode").html(sku_kode);
        $("#filter_schedule_sku_nama_produk").html(sku_nama_produk);
        $("#filter_schedule_sku_satuan").html(sku_satuan);
        $("#filter_schedule_sku_kemasan").html(sku_kemasan);
        $("#filter_schedule_principle").html(principle);
        $("#filter_schedule_brand").html(brand);
        $("#filter_schedule_sku_qty").val($("#item-" + index + "-BackOrderDetail-sku_qty").val());
        $("#filter_schedule_tahun").val(year);

        setTimeout(() => {
            $("#filter_schedule_sku_qty").val(total_sku_qty);
        }, 500);

        $("#table_list_data_pilih_jadwal > tfoot").html('');
        $("#table_list_data_pilih_jadwal > tfoot").empty();

        $("#table_list_data_pilih_jadwal > tfoot").append(`
			<tr>
                <td colspan="3" class="bg-success text-center" style="font-weight: bold;">Grand Total : <span id="grand_total_schedule">0</span></td>
			</tr>
		`);

        setTimeout(() => {

            const findIndexData = arr_list_schedule_sku.findIndex((value) => value.sku_id == sku_id);

            if (findIndexData == -1) {
                AddListSKUSchedule();
            } else {
                GetListSKUSchedule();
            }
        }, 500);
    }

    function AddListSKUSchedule() {

        for (var i = 1; i <= 12; i++) {

            arr_list_schedule_sku.push({
                'idx': idx_detail2,
                'sku_id': $("#filter_schedule_sku_id").val(),
                'bulan': i,
                'tahun': $("#filter_schedule_tahun").val(),
                'qty': 0
            });

            idx_detail2++;

        }

        setTimeout(() => {
            GetListSKUSchedule();
        }, 500);

    }

    function GetListSKUSchedule() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/backorder/GetListSKUSchedule') ?>",
            data: {
                sku_id: $("#filter_schedule_sku_id").val(),
                detail: arr_list_schedule_sku
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

                        <?php if ($act == "detail") { ?>

                            $.each(response, function(i, v) {
                                $("#table_list_data_pilih_jadwal > tbody").append(`
                                    <tr>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            ${i+1}
                                            <input type="hidden" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail2-idx" id="item-${i}-ProductionScheduleDetail2-idx" value="${v.idx}" onchange="UpdateListProductionScheduleDetail2('${i}','${v.idx}')"/>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <select class="form-control select2" name="item-${i}-ProductionScheduleDetail2-bulan" id="item-${i}-ProductionScheduleDetail2-bulan" disabled>
                                                <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                <?php foreach ($Bulan as $key => $value) : ?>
                                                    <option value="<?= $key ?>" ${v.bulan == "<?= $key ?>" ? 'selected' : ''}><?= $value ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td class="text-center" style="text-align: center; vertical-align: middle;">
                                            <input type="text" onkeyup="formatNominal(this)" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail2-qty" id="item-${i}-ProductionScheduleDetail2-qty" value="${formatNumber(parseInt(v.qty))}" disabled/>
                                        </td>
                                    </tr>
                                `);
                            });
                        <?php } else { ?>

                            $.each(response, function(i, v) {

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
                                                <input type="text" onkeyup="formatNominal(this)" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail2-qty" id="item-${i}-ProductionScheduleDetail2-qty" value="${formatNumber(parseInt(v.qty))}" onchange="UpdateListProductionScheduleDetail2('${i}','${v.idx}')"/>
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
                                                <input type="text" onkeyup="formatNominal(this)" style="width:100%" class="form-control" name="item-${i}-ProductionScheduleDetail2-qty" id="item-${i}-ProductionScheduleDetail2-qty" value="" placeholder="0" onchange="UpdateListProductionScheduleDetail2('${i}','${v.idx}')"/>
                                            </td>
                                        </tr>
                                    `);

                                }
                            });
                        <?php } ?>
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
        const findIndexData = arr_list_schedule_sku.findIndex((value) => value.idx == idx);

        if (findIndexData > -1) {

            // arr_list_schedule_sku[findIndexData]['tahun'] = $("#item-" + index + "-ProductionScheduleDetail2-tahun").val();
            // arr_list_schedule_sku[findIndexData]['bulan'] = $("#item-" + index + "-ProductionScheduleDetail2-bulan").val();
            arr_list_schedule_sku[findIndexData]['qty'] = parseInt($("#item-" + index + "-ProductionScheduleDetail2-qty").val().replaceAll(".", ""));
        }

        HitungGrandTotalSchedule();
    }

    function HitungGrandTotalSchedule() {
        let grand_total_schedule = 0;

        $.each(arr_list_schedule_sku, function(i, v) {
            if (v.sku_id == $("#filter_schedule_sku_id").val()) {
                grand_total_schedule += parseInt(v.qty);
            }
        });

        $("#grand_total_schedule").html(grand_total_schedule);
    }

    function GetEDSKU(sku_id, index, act, principle_id) {
        var no = 1;
        var so_id = $("#so_id").val();

        if (act == "add") {

            if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                $("#modal-ed-sku-retur").modal('show');

                $("#caption-ed-sku-id-retur").val('');
                $("#caption-ed-sku-kode-retur").val('');
                $("#caption-ed-sku-kemasan-retur").val('');
                $("#caption-ed-sku-satuan-retur").val('');
                $("#caption-ed-sku-retur").val('');
                $("#caption-ed-sku-harga-retur").val('');
                $("#caption-sku-qty-retur").val('');
                $("#caption-ed-sku-index-retur").val('');

                $("#btn-choose-ed-sku-multi-retur").show();
                $("#btn-choose-ed-sku-multi-retur-edit").hide();

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/get_ed_sku_header_by_id') ?>",
                    data: {
                        back_order_id: so_id,
                        sku_id: sku_id
                    },
                    dataType: "JSON",
                    async: false,
                    beforeSend: function() {

                        Swal.fire({
                            title: 'Loading ...',
                            html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                            timerProgressBar: false,
                            showConfirmButton: false
                        });
                    },
                    success: function(response) {
                        $.each(response, function(i, v) {
                            $("#caption-ed-sku-id-retur").val(v.sku_id);
                            $("#caption-ed-sku-kode-retur").val(v.sku_kode);
                            $("#caption-ed-sku-kemasan-retur").val(v.sku_kemasan);
                            $("#caption-ed-sku-satuan-retur").val(v.sku_satuan);
                            $("#caption-ed-sku-retur").val(v.sku_nama_produk);
                            $("#caption-ed-sku-harga-retur").val(v.sku_harga_jual);
                            $("#caption-sku-qty-retur").val(v.sku_qty_so);
                            $("#caption-ed-sku-index-retur").val(index);
                            $("#caption-ed-principle-id-retur").val(v.principle_id);
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        message("Error", "Error 500 Internal Server Connection Failure", "error");
                    },
                    complete: function() {
                        Swal.close();
                    }
                });

                get_so_detail2_ed();
            } else {

                $("#modal-ed-sku").modal('show');
                $("#loadingedsku").show();

                $("#caption-ed-sku-id").val('');
                $("#caption-ed-sku-kode").val('');
                $("#caption-ed-sku-kemasan").val('');
                $("#caption-ed-sku-satuan").val('');
                $("#caption-ed-sku").val('');
                $("#caption-ed-sku-harga").val('');
                $("#caption-sku-qty").val('');
                $("#caption-ed-sku-index").val('');

                $("#btn-choose-ed-sku-multi").show();
                $("#btn-choose-ed-sku-multi-edit").hide();

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/get_ed_sku_header_by_id') ?>",
                    data: {
                        back_order_id: so_id,
                        sku_id: sku_id
                    },
                    dataType: "JSON",
                    async: false,
                    success: function(response) {
                        $.each(response, function(i, v) {
                            $("#caption-ed-sku-id").val(v.sku_id);
                            $("#caption-ed-sku-kode").val(v.sku_kode);
                            $("#caption-ed-sku-kemasan").val(v.sku_kemasan);
                            $("#caption-ed-sku-satuan").val(v.sku_satuan);
                            $("#caption-ed-sku").val(v.sku_nama_produk);
                            $("#caption-ed-sku-harga").val(v.sku_harga_jual);
                            $("#caption-sku-qty").val(v.sku_qty_so);
                            $("#caption-ed-sku-index").val(index);
                            $("#caption-ed-principle-id-retur").val(v.principle_id);
                        });
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/get_ed_sku_by_id') ?>",
                    data: {
                        sku_id: sku_id
                    },
                    dataType: "JSON",
                    async: false,
                    success: function(response) {
                        $("#loadingedsku").hide();

                        if (response.length > 0) {
                            $("#table-ed-sku > tbody").empty();

                            $.each(response, function(i, v) {
                                $("#table-ed-sku > tbody").append(`
                                    <tr>
                                        <td width="10%" class="text-center">
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-sku_id" value="${v.sku_id}">
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-sku_stock_id" value="${v.sku_stock_id}">
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-sku_expdate" value="${v.sku_stock_expired_date}">
                                            ${no}
                                        </td>
                                        <td width="30%" class="text-center">${v.depo_detail_nama}</td>
                                        <td width="20%" class="text-center">${v.sku_stock_expired_date}</td>
                                        <td width="20%" class="text-center">${v.sku_stock_akhir}</td>
                                        <td width="20%" class="text-center">
                                            <input type="number" class="form-control" id="item-${i}-BackOrderDetail2-sku_qty" value="${v.sku_qty_so}" onchange="TotalQtySKUED('${i}',this.value,'${v.sku_stock_akhir}')">
                                        </td>
                                    </tr>
                                `);

                                no++;
                            });
                        } else {
                            $("#table-ed-sku > tbody").html(
                                `<tr><td colspan="5" class="text-center text-danger">Data Kosong</td></tr>`);
                        }
                    }
                });

            }

        } else if (act == "edit") {

            if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                $("#modal-ed-sku-retur").modal('show');

                $("#caption-ed-sku-id-retur").val('');
                $("#caption-ed-sku-kode-retur").val('');
                $("#caption-ed-sku-kemasan-retur").val('');
                $("#caption-ed-sku-satuan-retur").val('');
                $("#caption-ed-sku-retur").val('');
                $("#caption-ed-sku-harga-retur").val('');
                $("#caption-sku-qty-retur").val('');
                $("#caption-ed-sku-index-retur").val('');

                $("#btn-choose-ed-sku-multi-retur").show();
                $("#btn-choose-ed-sku-multi-retur-edit").hide();

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/get_ed_sku_header_by_id') ?>",
                    data: {
                        back_order_id: so_id,
                        sku_id: sku_id
                    },
                    dataType: "JSON",
                    async: false,
                    beforeSend: function() {

                        Swal.fire({
                            title: 'Loading ...',
                            html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                            timerProgressBar: false,
                            showConfirmButton: false
                        });
                    },
                    success: function(response) {
                        $.each(response, function(i, v) {
                            $("#caption-ed-sku-id-retur").val(v.sku_id);
                            $("#caption-ed-sku-kode-retur").val(v.sku_kode);
                            $("#caption-ed-sku-kemasan-retur").val(v.sku_kemasan);
                            $("#caption-ed-sku-satuan-retur").val(v.sku_satuan);
                            $("#caption-ed-sku-retur").val(v.sku_nama_produk);
                            $("#caption-ed-sku-harga-retur").val(v.sku_harga_jual);
                            $("#caption-sku-qty-retur").val(v.sku_qty_so);
                            $("#caption-ed-sku-index-retur").val(index);
                            $("#caption-ed-principle-id-retur").val(v.principle_id);
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        message("Error", "Error 500 Internal Server Connection Failure", "error");
                    },
                    complete: function() {
                        Swal.close();
                    }
                });

                get_so_detail2_ed();
            } else {

                $("#btn-choose-ed-sku-multi").hide();
                $("#btn-choose-ed-sku-multi-edit").show();

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/get_ed_sku_header_by_id2') ?>",
                    data: {
                        so_id: so_id,
                        sku_id: sku_id
                    },
                    dataType: "JSON",
                    async: false,
                    success: function(response) {
                        $.each(response, function(i, v) {
                            $("#caption-ed-sku-id").val(v.sku_id);
                            $("#caption-ed-sku-kode").val(v.sku_kode);
                            $("#caption-ed-sku-kemasan").val(v.sku_kemasan);
                            $("#caption-ed-sku-satuan").val(v.sku_satuan);
                            $("#caption-ed-sku").val(v.sku_nama_produk);
                            $("#caption-ed-sku-harga").val(v.sku_harga_jual);
                            $("#caption-sku-qty").val(v.sku_qty_so);
                            $("#caption-ed-sku-index").val(index);
                            $("#caption-ed-principle-id-retur").val(v.principle_id);
                        });
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/get_ed_sku_by_id2') ?>",
                    data: {
                        so_id: so_id,
                        sku_id: sku_id
                    },
                    dataType: "JSON",
                    async: false,
                    success: function(response) {
                        $("#loadingedsku").hide();

                        if (response.length > 0) {
                            $("#table-ed-sku > tbody").empty();

                            $.each(response, function(i, v) {
                                $("#table-ed-sku > tbody").append(`
                                    <tr>
                                        <td width="10%" class="text-center">
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-sku_id" value="${v.sku_id}">
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-sku_stock_id" value="${v.sku_stock_id}">
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-sku_expdate" value="${v.sku_stock_expired_date}">
                                            ${no}
                                        </td>
                                        <td width="30%" class="text-center">${v.depo_detail_nama}</td>
                                        <td width="20%" class="text-center">${v.sku_stock_expired_date}</td>
                                        <td width="20%" class="text-center">${v.sku_stock_akhir}</td>
                                        <td width="20%" class="text-center">
                                            <input type="number" class="form-control" id="item-${i}-BackOrderDetail2-sku_qty" value="${v.sku_qty_so}" onchange="TotalQtySKUED('${i}',this.value,'${v.sku_stock_akhir}')">
                                        </td>
                                    </tr>
                                `);
                                no++;
                            });
                        } else {
                            $("#table-ed-sku > tbody").html(
                                `<tr><td colspan="5" class="text-center text-danger">Data Kosong</td></tr>`);
                        }
                    }
                });

            }
        } else if (act == "detail") {

            if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                $("#modal-ed-sku-retur").modal('show');

                $("#caption-ed-sku-id-retur").val('');
                $("#caption-ed-sku-kode-retur").val('');
                $("#caption-ed-sku-kemasan-retur").val('');
                $("#caption-ed-sku-satuan-retur").val('');
                $("#caption-ed-sku-retur").val('');
                $("#caption-ed-sku-harga-retur").val('');
                $("#caption-sku-qty-retur").val('');
                $("#caption-ed-sku-index-retur").val('');

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/get_ed_sku_header_by_id3') ?>",
                    data: {
                        so_id: so_id,
                        sku_id: sku_id
                    },
                    dataType: "JSON",
                    async: false,
                    success: function(response) {
                        $.each(response, function(i, v) {
                            $("#caption-ed-sku-id-retur").val(v.sku_id);
                            $("#caption-ed-sku-kode-retur").val(v.sku_kode);
                            $("#caption-ed-sku-kemasan-retur").val(v.sku_kemasan);
                            $("#caption-ed-sku-satuan-retur").val(v.sku_satuan);
                            $("#caption-ed-sku-retur").val(v.sku_nama_produk);
                            $("#caption-ed-sku-harga-retur").val(v.sku_harga_jual);
                            $("#caption-sku-qty-retur").val(v.sku_qty_so);
                            $("#caption-ed-sku-index-retur").val(index);
                            $("#caption-ed-principle-id-retur").val(v.principle_id);
                        });
                    }
                });

                get_so_detail2_ed();
            } else {

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/get_ed_sku_header_by_id3') ?>",
                    data: {
                        so_id: so_id,
                        sku_id: sku_id
                    },
                    dataType: "JSON",
                    async: false,
                    success: function(response) {
                        $.each(response, function(i, v) {
                            $("#caption-ed-sku-id").val(v.sku_id);
                            $("#caption-ed-sku-kode").val(v.sku_kode);
                            $("#caption-ed-sku-kemasan").val(v.sku_kemasan);
                            $("#caption-ed-sku-satuan").val(v.sku_satuan);
                            $("#caption-ed-sku").val(v.sku_nama_produk);
                            $("#caption-ed-sku-harga").val(v.sku_harga_jual);
                            $("#caption-sku-qty").val(v.sku_qty_so);
                            $("#caption-ed-sku-index").val(index);
                            $("#caption-ed-principle-id-retur").val(v.principle_id);
                        });
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/get_ed_sku_by_id3') ?>",
                    data: {
                        so_id: so_id,
                        sku_id: sku_id
                    },
                    dataType: "JSON",
                    async: false,
                    success: function(response) {
                        $("#loadingedsku").hide();

                        if (response.length > 0) {
                            $("#table-ed-sku > tbody").empty();

                            $.each(response, function(i, v) {
                                $("#table-ed-sku > tbody").append(`
                                    <tr>
                                        <td width="10%" class="text-center">
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-sku_id" value="${v.sku_id}">
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-sku_stock_id" value="${v.sku_stock_id}">
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-sku_expdate" value="${v.sku_stock_expired_date}">
                                            ${no}
                                        </td>
                                        <td width="30%" class="text-center">${v.depo_detail_nama}</td>
                                        <td width="20%" class="text-center">${v.sku_stock_expired_date}</td>
                                        <td width="20%" class="text-center">${v.sku_stock_akhir}</td>
                                        <td width="20%" class="text-center">${v.sku_qty_so}</td>
                                    </tr>
                                `);

                                no++;
                            });
                        } else {
                            $("#table-ed-sku > tbody").html(
                                `<tr><td colspan="5" class="text-center text-danger">Data Kosong</td></tr>`);
                        }
                    }
                });

            }

        }

        <?php if ($act == "add") { ?>
            if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                $("#filter-delivery_order_id").show();
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/Get_back_order_by_top_retur') ?>",
                    data: {
                        client_pt_id: $("#backorder-client_pt_id").val(),
                        principle_id: principle_id,
                        sku_id: sku_id
                    },
                    dataType: "JSON",
                    success: function(response) {

                        $("#filter-delivery_order_id").empty();

                        if (response != 0) {
                            $('#filter-delivery_order_id').fadeOut("slow", function() {
                                $(this).hide();
                            }).fadeIn("slow", function() {
                                $.each(response, function(i, v) {
                                    $("#filter-delivery_order_id").append(
                                        `<option value="'${v.delivery_order_id}'">${v.delivery_order_kode}</option>`
                                    );
                                });

                                $('#filter-delivery_order_id').val(arr_do_id_detail2);

                                // console.log(arr_do_id_detail2);

                                $('.selectpicker').selectpicker('refresh');
                            });

                        }
                    }
                });
            } else {
                $("#filter-delivery_order_id").html('');
                $("#filter-delivery_order_id").append(
                    `<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
                $("#filter-delivery_order_id").hide();
            }

        <?php } else if ($act == "edit") { ?>

            if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                $("#filter-delivery_order_id").show();

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/Get_back_order_by_top_retur') ?>",
                    data: {
                        client_pt_id: $("#backorder-client_pt_id").val(),
                        principle_id: principle_id,
                        sku_id: sku_id
                    },
                    dataType: "JSON",
                    success: function(response) {

                        $("#filter-delivery_order_id").empty();

                        if (response != 0) {
                            $('#filter-delivery_order_id').fadeOut("slow", function() {
                                $(this).hide();
                            }).fadeIn("slow", function() {
                                $.each(response, function(i, v) {
                                    $("#filter-delivery_order_id").append(
                                        `<option value="'${v.delivery_order_id}'">${v.delivery_order_kode}</option>`
                                    );
                                });

                                $('#filter-delivery_order_id').val(arr_do_id_detail2);

                                // console.log(arr_do_id_detail2);

                                $('.selectpicker').selectpicker('refresh');
                            });

                        }
                    }
                });
            } else {
                $("#filter-delivery_order_id").html('');
                $("#filter-delivery_order_id").append(
                    `<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
                $("#filter-delivery_order_id").hide();
            }
        <?php } ?>
    }

    function TotalQtySKUED(index, jumlah, stock_akhir) {
        jumlah = parseInt(jumlah);
        stock_akhir = parseInt(stock_akhir);

        if (jumlah <= stock_akhir) {
            // $("#caption-" + index + "-BackOrderDetail-sku_qty").append('');
            $("#caption-sku-qty").val('0');

            total_qty_SKU_ED += jumlah;
            $("#caption-sku-qty").val(total_qty_SKU_ED);
            // $("#caption-" + index + "-BackOrderDetail-sku_qty").append(total_qty_SKU_ED);

        } else {
            $("#item-" + index + "-BackOrderDetail2-sku_qty").val(0);
            message("Error", "Stok Tidak Cukup!", "error");
        }
    }

    function reset_table_customer() {
        $("#backorder-client_pt_id").val('');
        $("#backorder-back_order_kirim_nama").val('');
        $("#backorder-back_order_kirim_alamat").val('');
        $("#backorder-back_order_kirim_provinsi").val('');
        $("#backorder-back_order_kirim_kota").val('');
        $("#backorder-back_order_kirim_kecamatan").val('');
        $("#backorder-back_order_kirim_kelurahan").val('');
        $("#backorder-back_order_kirim_kodepos").val('');
        $("#backorder-back_order_kirim_area").val('');
        $("#backorder-back_order_kirim_telepon").val('');

        $(".customer-name").html('');
        $(".customer-address").html('');
        $(".customer-area").html('');

        $("#table-customer > tbody").empty();
        // initDataCustomer();
    }

    function reset_table_sku() {
        arr_back_order_detail = [];
        arr_back_order_detail2 = [];
        arr_so_detail2_ed = [];

        $("#table-sku-delivery-only > tbody").empty();
        $("#table-sku > tbody").empty();
        $("#table-ed-sku > tbody").empty();
        $("#table-ed-sku-retur > tbody").empty();
        delete_back_order_detail_2_temp_all();

        triggerDetail();
        // initDataSKU();
    }

    function reqFilter(val, i) {
        if (val == 1) {
            $("#item-" + i + "-BackOrderDetail-sku_filter_expdate").prop('disabled', false);
            $("#item-" + i + "-BackOrderDetail-sku_filter_expdatebulan").prop('disabled', false);
        } else {
            $("#item-" + i + "-BackOrderDetail-sku_filter_expdate").val(0).change();
            $("#item-" + i + "-BackOrderDetail-sku_filter_expdatebulan").val(0).change();

            $("#item-" + i + "-BackOrderDetail-sku_filter_expdate").prop('disabled', true);
            $("#item-" + i + "-BackOrderDetail-sku_filter_expdatebulan").prop('disabled', true);
        }
    }

    function pushToTableSKUDelivery() {

        console.log(arr_back_order_detail);

        // var result = arr_back_order_detail.reduce((unique, o) => {
        //     if (!unique.some(obj => obj.sku_id === o.sku_id)) {
        //         unique.push(o);
        //     }
        //     return unique;
        // }, []);

        // arr_back_order_detail = result;

        $("#cek_sku").val(arr_back_order_detail.length);
        // console.log(arr_back_order_detail);

        $("#table-sku-delivery-only > tbody").empty();

        if ($.fn.DataTable.isDataTable('#table-sku-delivery-only')) {
            $('#table-sku-delivery-only').DataTable().clear();
            $('#table-sku-delivery-only').DataTable().destroy();
        }

        // if ($.fn.DataTable.isDataTable('#table-sku-delivery-only')) {
        //     $('#table-sku-delivery-only').DataTable().clear();
        //     $('#table-sku-delivery-only').DataTable().destroy();
        // }

        var tipe_ppn = $("#backorder-back_order_tipe_ppn:checked").val();
        var diskon_global_percent = $("#diskon_global_percent").val();
        // var diskon_global_rp = $("#diskon_global_rp").val();
        var ppn = 0;
        var bg_color = "";

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/BackOrder/Get_list_back_order_detail') ?>",
            data: {
                arr_back_order_detail: arr_back_order_detail,
                arr_list_schedule_sku: arr_list_schedule_sku
            },
            dataType: "JSON",
            async: false,
            success: function(response) {

                if (response.length > 0) {

                    $.each(response, function(i, v) {

                        if (parseInt(v.sum_sku_qty) > 0 && parseInt(v.sum_sku_qty) == parseInt(v.sku_qty_sch)) {
                            bg_color = "#BFF6C3";

                        } else if (parseInt(v.sum_sku_qty) != parseInt(v.sku_qty_sch)) {
                            bg_color = "#F9D689";

                        } else if (parseInt(v.sku_qty_sch) == 0) {
                            bg_color = "#FF8080";
                        }

                        ppn = parseFloat(v.client_wms_tax);

                        if ($("#backorder-tipe_back_order_id").val() == 'AD89E05B-46A6-453B-8F19-886514234A21') {
                            $("#table-sku-delivery-only > tbody").append(`
                                <tr id="row-${i}" style="background:${bg_color}">
                                    <td style="display: none">
                                        <input type="hidden" id="item-${i}-BackOrderDetail-client_wms_id" value="${v.client_wms_id}" class="client-wms-id" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-principle_id" value="${v.principle_id}" class="client-principle-id" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_id" value="${v.sku_id}" class="sku-id" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_harga_satuan" class="sku-harga-satuan" value="${v.sku_harga_satuan}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_disc_percent" class="sku-disc-percent" value="0" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_disc_rp" class="sku-disc-rp" value="0" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_harga_nett" class="sku-harga-nett" value="${v.sku_harga_nett}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_weight" class="sku-weight" value="${v.sku_weight}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_weight_unit" class="sku-weight-unit" value="${v.sku_weight_unit}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_length" class="sku-length" value="${v.sku_length}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_length_unit" class="sku-length-unit" value="${v.sku_length_unit}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_width" class="sku-width" value="${v.sku_width}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_width_unit" class="sku-width-unit" value="${v.sku_width_unit}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_height" class="sku-height" value="${v.sku_height}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_height_unit" class="sku-height-unit" value="${v.sku_height_unit}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_volume" class="sku-volume" value="${v.sku_volume}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_volume_unit" class="sku-volume-unit" value="${v.sku_volume_unit}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_qty" class="form-control sku-qty" value="${v.sku_qty}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-random_id" class="form-control" value="${v.random_id}" />
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-kode-label">${v.principle}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-kode-label">${v.brand}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-kode-label">${v.sku_kode}</span>
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_kode" class="form-control sku-kode" value="${v.sku_kode}" />
                                    </td>
                                    <td class="text-center" style="display: none"></td>
                                    <td class="text-center">
                                        <span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_nama_produk" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-kemasan-label">${v.sku_kemasan}</span>
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_kemasan" class="form-control sku-kemasan" value="${v.sku_kemasan}" />
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-satuan-label">${v.sku_satuan}</span>
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_satuan" class="form-control sku-satuan" value="${v.sku_satuan}" />
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-satuan-label">${v.sku_harga_satuan == '.0000' ? 0 : parseFloat(v.sku_harga_satuan)}</span>
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-${i}-BackOrderDetail-sku_qty">${parseInt(v.sku_qty)}</span>
                                    </td>
                                    <td class="text-center">
                                        <input onkeyup="formatNumber(this.value)" type="text" id="item-${i}-BackOrderDetail-sku_disc_percent" class="form-control" value="0" />
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-${i}-BackOrderDetail-sku_disc_rp">0</span>
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-${i}-BackOrderDetail-sku_harga_nett">${v.sku_harga_nett == '.0000' ? 0 : parseFloat(v.sku_harga_nett)}</span>
                                    </td>
                                    <td class="text-center">
                                        <input style="transform: scale(1.5)" type="checkbox" id="checkbox-item-${i}-BackOrderDetail-ppn" value="" />
                                    </td>
                                    <td class="text-center">
                                        <input type="text" id="item-${i}-BackOrderDetail-ppn_percent" class="form-control numericInput" value="0" />
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-${i}-BackOrderDetail-ppn_rp">0</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-small btn-get-ed-sku" style="${$("#backorder-tipe_back_order_id").val() != 'AD89E05B-46A6-453B-8F19-886514234A21' ? 'display:none' : ''}" onclick="GetEDSKU('${v.sku_id}',${i},'add','${v.principle_id}')"><i class="fa fa-plus"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" id="item-${i}-BackOrderDetail-sku_keterangan" class="form-control input-sm" value="" style="width:150px;"/>
                                    </td>
                                    <td class="text-center">
                                        <select id="item-${i}-BackOrderDetail-tipe_stock_nama" class="form-control input-sm" style="width:150px;">
                                            <option value="">**Pilih**</option>
                                            <?php foreach ($TipeStock as $row) : ?>
                                                <option value="<?= $row['tipe_stock_nama'] ?>" <?= $row['tipe_stock_nama'] == "Quality Assurance" ? 'selected' : '' ?> ><?= $row['tipe_stock_nama'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" style="border:none;background:transparent" onclick="ScheduleSKU(this,${i},'${v.sku_id}','${v.sku_kode}','${v.sku_nama_produk}','${v.sku_satuan}','${v.sku_kemasan}','${v.principle}','${v.brand}')"><i class="fas fa-plus text-primary" style="cursor: pointer"></i></button>
                                        <button type="button" style="border:none;background:transparent" onclick="DeleteSKU(this,${i},'${v.sku_id}')"><i class="fas fa-trash text-danger" style="cursor: pointer"></i></button>
                                    </td>
                                </tr>
                            `);
                            // <button class="btn btn-success btn-small btn-modal-detail-sku" onclick="modalDetailSKU(${i}, '${v.sku_id}', '${v.sku_nama_produk}')"><i class="fa fa-search"></i></button>
                        } else {
                            $("#table-sku-delivery-only > tbody").append(`
                                <tr id="row-${i}" style="background:${bg_color}">
                                    <td style="display: none">
                                        <input type="hidden" id="item-${i}-BackOrderDetail-client_wms_id" value="${v.client_wms_id}" class="client-wms-id" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-principle_id" value="${v.principle_id}" class="client-principle-id" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_id" value="${v.sku_id}" class="sku-id" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_weight" class="sku-weight" value="${v.sku_weight}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_weight_unit" class="sku-weight-unit" value="${v.sku_weight_unit}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_length" class="sku-length" value="${v.sku_length}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_length_unit" class="sku-length-unit" value="${v.sku_length_unit}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_width" class="sku-width" value="${v.sku_width}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_width_unit" class="sku-width-unit" value="${v.sku_width_unit}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_height" class="sku-height" value="${v.sku_height}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_height_unit" class="sku-height-unit" value="${v.sku_height_unit}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_volume" class="sku-volume" value="${v.sku_volume}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_volume_unit" class="sku-volume-unit" value="${v.sku_volume_unit}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_qty_sch" class="form-control sku-qty" value="${v.sku_qty_sch}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail-random_id" class="form-control" value="${v.random_id}" />
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-kode-label">${v.brand}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-kode-label">${v.sku_kode}</span>
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_kode" class="form-control sku-kode" value="${v.sku_kode}" />
                                    </td>
                                    <td class="text-center" style="display: none"></td>
                                    <td class="text-center">
                                        <span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_nama_produk" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-satuan-label">${v.sku_satuan}</span>
                                        <input type="hidden" id="item-${i}-BackOrderDetail-sku_satuan" class="form-control sku-satuan" value="${v.sku_satuan}" />
                                    </td>
                                    <td class="text-center">
                                        <input type="text" id="item-${i}-BackOrderDetail-sku_harga_satuan" class="form-control text-right mask-money" value="${v.sku_harga_satuan}" onchange="chgSubJumlah(this.value, '${i}', 'sku_harga_satuan')" />
                                    </td>
                                    <td class="text-center">
                                        <input onchange="chgSubJumlah(this.value, '${i}', 'jumlah_barang')" type="text" id="item-${i}-BackOrderDetail-sku_qty" class="form-control text-right mask-money" value="${v.sku_qty}" />
                                    </td>
                                    <td class="text-center">
                                        <input onchange="chgSubJumlah(this.value, '${i}', 'disc_item')" type="text" id="item-${i}-BackOrderDetail-sku_disc_percent" class="form-control text-right mask-money" value="${v.sku_disc_percent}" />
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-${i}-BackOrderDetail-sku_disc_rp">${formatRupiahCurr(v.sku_disc_rp)}</span>
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-${i}-BackOrderDetail-sku_harga_nett">${formatRupiahCurr(v.sku_harga_nett)}</span>
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-${i}-BackOrderDetail-sku_disc_global_percent">${formatRupiahCurr(v.sku_diskon_global_percent)}</span>
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-${i}-BackOrderDetail-sku_disc_global_rupiah">${formatRupiahCurr(v.sku_diskon_global_rp)}</span>
                                    </td>
                                    <td class="text-center">
                                        <input ${tipe_ppn == '1' ? '' : 'checked disabled'} onchange="chgPPNPercent(this.checked, '${i}', '${parseFloat(v.client_wms_tax)}')" style="transform: scale(1.5)" type="checkbox" id="checkbox-item-${i}-BackOrderDetail-ppn" value="1" />
                                    </td>
                                    <td class="text-center">
                                        <input onchange="chgPPNRP(this.value, '${i}')" disabled type="text" id="item-${i}-BackOrderDetail-ppn_percent" class="form-control numericInput" value="${tipe_ppn == '0' ? parseFloat(v.client_wms_tax) : '0'}" />
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-${i}-BackOrderDetail-ppn_rp">${formatRupiahCurr(v.sku_ppn_rp)}</span>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" id="item-${i}-BackOrderDetail-sku_keterangan" class="form-control input-sm" value="${v.sku_keterangan}" onchange="chgSubJumlah(this.value, '${i}', 'sku_keterangan')"/>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" style="border:none;background:transparent" onclick="ScheduleSKU(this,${i},'${v.sku_id}','${v.sku_kode}','${v.sku_nama_produk}','${v.sku_satuan}','${v.sku_kemasan}','${v.principle}','${v.brand}')"><i class="fas fa-plus text-primary" style="cursor: pointer"></i></button>
                                        <button type="button" style="border:none;background:transparent" onclick="DeleteSKU(this,${i},'${v.sku_id}')"><i class="fas fa-trash text-danger" style="cursor: pointer"></i></button>
                                    </td>
                                </tr>
                            `);

                            // <button class="btn btn-success btn-small btn-modal-detail-sku" onclick="modalDetailSKU(${i}, '${v.sku_id}', '${v.sku_nama_produk}')"><i class="fa fa-search"></i></button>
                        }

                        run_input_mask_money();
                    });

                    $('#ppn_global_percent').val(ppn)

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
        });
    }

    function chgSubJumlah(value, index, mode) {
        value = value.replaceAll(".", "");
        var checkbox_ppn = $(`#checkbox-item-${index}-BackOrderDetail-ppn`).prop('checked');
        var sku_qty_sch = isNaN(parseInt($("#item-" + index + "-BackOrderDetail-sku_qty_sch").val())) ? 0 : parseInt($("#item-" + index + "-BackOrderDetail-sku_qty_sch").val());

        var disc_rp = 0;
        var hasil = 0;
        var diskon_global_percent = 0;
        var disc_global_detail_rp = 0;
        var diskon_global_rp = 0;
        var ppn_rp = 0;

        var harga = $(`#item-${index}-BackOrderDetail-sku_harga_satuan`).val().replaceAll(".", "");
        var ppn_percent = $(`#item-${index}-BackOrderDetail-ppn_percent`).val();
        var random_id = $(`#item-${index}-BackOrderDetail-random_id`).val();

        const findIndexData = arr_back_order_detail.findIndex((value) => value.sku_id == $("#item-" + index + "-BackOrderDetail-sku_id").val() && value.random_id == random_id);
        const sku_harga_total = 0;

        if (mode == 'jumlah_barang') {
            // SUB JUMLAH
            sku_disc_percent = parseFloat($(`#caption-${index}-BackOrderDetail-sku_disc_percent`).text().replaceAll(".", ""));
            disc_rp = parseFloat($(`#caption-${index}-BackOrderDetail-sku_disc_rp`).text().replaceAll(".", ""));
            hasil = parseFloat(value) * parseFloat(harga) - disc_rp;
            $(`#caption-${index}-BackOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil));

            // DISKON GLOBAL DETAIL RP
            diskon_global_percent = $(`#caption-${index}-BackOrderDetail-sku_disc_global_percent`).text();
            disc_global_detail_rp = hasil * parseFloat(diskon_global_percent) / 100
            $(`#caption-${index}-BackOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(disc_global_detail_rp))

            arr_back_order_detail[findIndexData]['sku_harga_satuan'] = harga;
            arr_back_order_detail[findIndexData]['sku_qty'] = parseInt(value);
            arr_back_order_detail[findIndexData]['sku_harga_nett'] = hasil;
            arr_back_order_detail[findIndexData]['sku_disc_percent'] = sku_disc_percent;
            arr_back_order_detail[findIndexData]['sku_disc_rp'] = disc_rp;
            arr_back_order_detail[findIndexData]['sku_diskon_global_percent'] = diskon_global_percent;
            arr_back_order_detail[findIndexData]['sku_diskon_global_rp'] = disc_global_detail_rp;

            // PPN
            if (checkbox_ppn) {
                ppn_rp = (parseFloat(hasil) - parseFloat(disc_global_detail_rp)) * parseFloat(ppn_percent) / 100;
                $(`#caption-${index}-BackOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_rp));
                arr_back_order_detail[findIndexData]['sku_ppn_rp'] = ppn_rp;
            }

            if (parseInt(value) != sku_qty_sch) {
                document.getElementById("row-" + index).style.background = "#F9D689";
            } else if (parseInt(value) == sku_qty_sch) {
                document.getElementById("row-" + index).style.background = "#BFF6C3";
            }

        } else if (mode == 'sku_harga_satuan') {
            // SUB JUMLAH
            var sku_qty = $(`#item-${index}-BackOrderDetail-sku_qty`).val().replaceAll(".", "");

            sku_disc_percent = parseFloat($(`#caption-${index}-BackOrderDetail-sku_disc_percent`).text().replaceAll(".", ""));
            disc_rp = parseFloat($(`#caption-${index}-BackOrderDetail-sku_disc_rp`).text().replaceAll(".", ""));
            hasil = parseFloat(sku_qty) * parseFloat(harga) - disc_rp;
            $(`#caption-${index}-BackOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil));

            // DISKON GLOBAL DETAIL RP
            diskon_global_percent = $(`#caption-${index}-BackOrderDetail-sku_disc_global_percent`).text();
            disc_global_detail_rp = hasil * parseFloat(diskon_global_percent) / 100
            $(`#caption-${index}-BackOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(disc_global_detail_rp))

            arr_back_order_detail[findIndexData]['sku_harga_satuan'] = harga;
            arr_back_order_detail[findIndexData]['sku_qty'] = parseInt(sku_qty);
            arr_back_order_detail[findIndexData]['sku_harga_nett'] = hasil;
            arr_back_order_detail[findIndexData]['sku_disc_percent'] = sku_disc_percent;
            arr_back_order_detail[findIndexData]['sku_disc_rp'] = disc_rp;
            arr_back_order_detail[findIndexData]['sku_diskon_global_percent'] = diskon_global_percent;
            arr_back_order_detail[findIndexData]['sku_diskon_global_rp'] = disc_global_detail_rp;

            // PPN
            if (checkbox_ppn) {
                ppn_rp = (parseFloat(hasil) - parseFloat(disc_global_detail_rp)) * parseFloat(ppn_percent) / 100;
                $(`#caption-${index}-BackOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_rp));
                arr_back_order_detail[findIndexData]['sku_ppn_rp'] = ppn_rp;
            }

        } else if (mode == 'disc_item') { // mode disc_item
            // DISKON RP dan SUB JUMLAH
            var jumlah_barang = parseFloat($(`#item-${index}-BackOrderDetail-sku_qty`).val().replaceAll(".", ""));
            var jumlah_harga = jumlah_barang * parseFloat(harga);

            disc_rp = parseFloat(jumlah_harga) * parseFloat(value) / 100;
            $(`#caption-${index}-BackOrderDetail-sku_disc_rp`).text(formatRupiahCurr(disc_rp));
            hasil = parseFloat(jumlah_harga) - parseFloat(disc_rp);
            $(`#caption-${index}-BackOrderDetail-sku_harga_nett`).text(formatRupiahCurr(hasil));

            // DISKON GLOBAL DETAIL RP
            diskon_global_percent = $(`#caption-${index}-BackOrderDetail-sku_disc_global_percent`).text();
            disc_global_detail_rp = hasil * parseFloat(diskon_global_percent) / 100;
            $(`#caption-${index}-BackOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(disc_global_detail_rp));

            arr_back_order_detail[findIndexData]['sku_harga_satuan'] = harga;
            arr_back_order_detail[findIndexData]['sku_harga_nett'] = hasil;
            arr_back_order_detail[findIndexData]['sku_disc_percent'] = parseFloat(value);
            arr_back_order_detail[findIndexData]['sku_disc_rp'] = disc_rp;
            arr_back_order_detail[findIndexData]['sku_diskon_global_percent'] = diskon_global_percent;
            arr_back_order_detail[findIndexData]['sku_diskon_global_rp'] = disc_global_detail_rp;

            if (checkbox_ppn) {
                ppn_rp = (parseFloat(hasil) - parseFloat(diskon_global_rp)) * parseFloat(ppn_percent) / 100;
                $(`#caption-${index}-BackOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_rp));
                arr_back_order_detail[findIndexData]['sku_ppn_rp'] = ppn_rp;
            }
        } else if (mode == 'sku_keterangan') { // mode sku_keterangan
            arr_back_order_detail[findIndexData]['sku_keterangan'] = value;
        }

        console.log(arr_back_order_detail);

        triggerDetail();
    }

    function chgPPNPercent(checked, index, ppn_percent) {
        if (checked) {
            $(`#item-${index}-BackOrderDetail-ppn_percent`).val(ppn_percent);

            var sub_jumlah = $(`#caption-${index}-BackOrderDetail-sku_harga_nett`).text().replaceAll(".", "");
            var diskon_global_rp = $(`#caption-${index}-BackOrderDetail-sku_disc_global_rupiah`).text().replaceAll(".", "");
            var ppn_rp = (parseFloat(sub_jumlah) - parseFloat(diskon_global_rp)) * (parseFloat(ppn_percent) / 100);
            // var total_harga = parseFloat(sub_jumlah) + parseFloat(ppn_rp);

            $(`#caption-${index}-BackOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_rp));

        } else {
            $(`#item-${index}-BackOrderDetail-ppn_percent`).val(0);
            $(`#caption-${index}-BackOrderDetail-ppn_rp`).text(0);
        }

        triggerDetail()
    }

    function chgDiskonGlobal(value, mode) {
        value = value.replaceAll(".", "")

        if (mode == 'percent') {
            // DISKON GLOBAL RP
            var total_rp = $("#total_rp").val().replaceAll(".", "");
            var diskon_global_rp = parseFloat(total_rp) * parseFloat(value) / 100
            $("#diskon_global_rp").val(formatRupiahCurr(diskon_global_rp));

            if (arr_back_order_detail.length > 0) {
                var index = 0;
                $.each(arr_back_order_detail, function(i, v) {
                    if (arr_back_order_detail[i] != "") {
                        $(`#table-sku-delivery-only tbody tr:eq(${index})`).each(function(i2) {
                            // DISKON GLOBAL DETAIL PERCENT
                            $(`#caption-${i}-BackOrderDetail-sku_disc_global_percent`).text(value);

                            // DISKON GLOBAL DETAIL RUPIAH
                            var sub_jumlah = $(`#caption-${i}-BackOrderDetail-sku_harga_nett`).text().replaceAll(".", "");
                            var diskon_global_rp_detail = parseFloat(sub_jumlah) * parseFloat(value) / 100
                            $(`#caption-${i}-BackOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(diskon_global_rp_detail));

                            // PPN DETAIL RP
                            var checkbox_ppn_detail = $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop("checked");
                            var ppn_percent_detail = $(`#item-${i}-BackOrderDetail-ppn_percent`).val();
                            if (checkbox_ppn_detail) {
                                var ppn_detail_rp = (parseFloat(sub_jumlah) - parseFloat(diskon_global_rp_detail)) * ppn_percent_detail / 100
                                $(`#caption-${i}-BackOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_detail_rp));
                            }
                        });

                        index++;
                    }
                })
            }
            // $("#table-sku-delivery-only tbody tr").each(function(i) {
            //     // DISKON GLOBAL DETAIL PERCENT
            //     $(`#caption-${i}-BackOrderDetail-sku_disc_global_percent`).text(value);

            //     // DISKON GLOBAL DETAIL RUPIAH
            //     var sub_jumlah = $(`#caption-${i}-BackOrderDetail-sku_harga_nett`).text().replaceAll(".", "");
            //     var diskon_global_rp_detail = parseFloat(sub_jumlah) * parseFloat(value) / 100
            //     $(`#caption-${i}-BackOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(diskon_global_rp_detail));

            //     // PPN DETAIL RP
            //     var checkbox_ppn_detail = $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop("checked");
            //     var ppn_percent_detail = $(`#item-${i}-BackOrderDetail-ppn_percent`).val();
            //     if (checkbox_ppn_detail) {
            //         var ppn_detail_rp = (parseFloat(sub_jumlah) - parseFloat(diskon_global_rp_detail)) * ppn_percent_detail / 100
            //         $(`#caption-${i}-BackOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_detail_rp));
            //     }
            // });

            // var hasil = parseFloat(total_rp) - parseFloat(diskon_global_rp);
            // $(`#dasar_kena_pajak`).val(hasil);
        } else {
            var total_rp = $("#total_rp").val().replaceAll(".", "");
            var discont_global_percent = parseFloat(value) / parseFloat(total_rp) * 100;

            // Memeriksa apakah nilai memiliki desimal
            // if (discont_global_percent % 1 !== 0) {
            //     discont_global_percent = discont_global_percent.toFixed(2);
            // }

            $("#diskon_global_percent").val(formatRupiahCurr(discont_global_percent));

            if (arr_back_order_detail.length > 0) {
                var index = 0;
                $.each(arr_back_order_detail, function(i, v) {
                    if (arr_back_order_detail[i] != "") {
                        $(`#table-sku-delivery-only tbody tr:eq(${index})`).each(function(i) {
                            $(`#caption-${i}-BackOrderDetail-sku_disc_global_percent`).text(discont_global_percent);
                            var sub_jumlah = $(`#caption-${i}-BackOrderDetail-sku_harga_nett`).text().replaceAll(".", "");

                            var diskon_global_rp_detail = parseFloat(sub_jumlah) * parseFloat(discont_global_percent) / 100
                            $(`#caption-${i}-BackOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(diskon_global_rp_detail));

                            // PPN DETAIL RP
                            var checkbox_ppn_detail = $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop("checked");
                            var ppn_percent_detail = $(`#item-${i}-BackOrderDetail-ppn_percent`).val();
                            if (checkbox_ppn_detail) {
                                var ppn_detail_rp = (parseFloat(sub_jumlah) - parseFloat(diskon_global_rp_detail)) * ppn_percent_detail / 100
                                $(`#caption-${i}-BackOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_detail_rp));
                            }
                        });

                        index++;
                    }
                })
            }
            // $("#table-sku-delivery-only tbody tr").each(function(i) {
            //     $(`#caption-${i}-BackOrderDetail-sku_disc_global_percent`).text(discont_global_percent);
            //     var sub_jumlah = $(`#caption-${i}-BackOrderDetail-sku_harga_nett`).text().replaceAll(".", "");

            //     var diskon_global_rp_detail = parseFloat(sub_jumlah) * parseFloat(discont_global_percent) / 100
            //     $(`#caption-${i}-BackOrderDetail-sku_disc_global_rupiah`).text(formatRupiahCurr(diskon_global_rp_detail));

            //     // PPN DETAIL RP
            //     var checkbox_ppn_detail = $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop("checked");
            //     var ppn_percent_detail = $(`#item-${i}-BackOrderDetail-ppn_percent`).val();
            //     if (checkbox_ppn_detail) {
            //         var ppn_detail_rp = (parseFloat(sub_jumlah) - parseFloat(diskon_global_rp_detail)) * ppn_percent_detail / 100
            //         $(`#caption-${i}-BackOrderDetail-ppn_rp`).text(formatRupiahCurr(ppn_detail_rp));
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

            if (arr_back_order_detail.length > 0) {
                var index = 0;
                $.each(arr_back_order_detail, function(i, v) {
                    if (arr_back_order_detail[i] != "") {
                        $(`#table-sku-delivery-only tbody tr:eq(${index})`).each(function(i2) {
                            $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop('checked', true);
                            $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop('disabled', true);
                            $(`#checkbox-item-${i}-BackOrderDetail-ppn`).trigger('change');
                        });

                        index++;
                    }
                })
            }
            // $("#table-sku-delivery-only tbody tr").each(function(i) {
            //     $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop('checked', true);
            //     $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop('disabled', true);
            //     $(`#checkbox-item-${i}-BackOrderDetail-ppn`).trigger('change');
            //     // $(`#item-${i}-BackOrderDetail-ppn_percent`).val(0);
            //     // $(`#caption-${i}-BackOrderDetail-ppn_rp`).text(0);

            //     // var sub_jumlah = $(`#caption-${i}-BackOrderDetail-sku_harga_nett`).text();
            //     // var diskon_global_rupiah = $(`#caption-${i}-BackOrderDetail-sku_disc_global_rupiah`).text();

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

            if (arr_back_order_detail.length > 0) {
                var index = 0;
                $.each(arr_back_order_detail, function(i, v) {
                    if (arr_back_order_detail[i] != "") {
                        $(`#table-sku-delivery-only tbody tr:eq(${index})`).each(function(i2) {
                            $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop('checked', false);
                            $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop('disabled', false);
                            $(`#item-${i}-BackOrderDetail-ppn_percent`).val(0)
                            $(`#caption-${i}-BackOrderDetail-ppn_rp`).text(0)
                        });

                        index++;
                    }
                })
            }
            // $("#table-sku-delivery-only tbody tr").each(function(i) {
            //     $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop('checked', false);
            //     $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop('disabled', false);
            //     $(`#item-${i}-BackOrderDetail-ppn_percent`).val(0)
            //     $(`#caption-${i}-BackOrderDetail-ppn_rp`).text(0)
            //     // $(`#checkbox-item-${i}-BackOrderDetail-ppn`).trigger('change');

            //     // var ppn_rp = $(`#caption-${i}-BackOrderDetail-ppn_rp`).text();
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

        if (arr_back_order_detail.length > 0) {
            var index = 0;
            $.each(arr_back_order_detail, function(i, v) {
                if (arr_back_order_detail[i] != "") {
                    $(`#table-sku-delivery-only tbody tr:eq(${index})`).each(function(i2) {
                        // TOTAL DISKON ITEM
                        total_diskon_item += parseFloat($(this).find("td:eq(9)").text().trim().replaceAll(".", ""));

                        // TOTAL RP
                        var sub_jumlah = $(`#caption-${i}-BackOrderDetail-sku_harga_nett`).text().replaceAll(".", "");
                        total_rp += parseFloat(sub_jumlah);

                        // DISKON GLOBAL RP
                        diskon_global_detail_rp2 += parseFloat($(`#caption-${i}-BackOrderDetail-sku_disc_global_rupiah`).text().replaceAll(".", ""));

                        // DASAR KENA PAJAK
                        var checkbox_ppn_detail = $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop("checked");
                        var diskon_global_detail_rp = $(`#caption-${i}-BackOrderDetail-sku_disc_global_rupiah`).text().replaceAll(".", "");
                        if (checkbox_ppn_detail) {
                            dasar_kena_pajak_detail += parseFloat(sub_jumlah) - parseFloat(diskon_global_detail_rp)
                        }

                        // PPN GLOBAL RP
                        ppn_detail_rp += parseFloat($(`#caption-${i}-BackOrderDetail-ppn_rp`).text().replaceAll(".", ""));
                    })

                    index++;
                }
            })

            $(`#total_diskon_item`).val(formatNumber(total_diskon_item));
            $(`#total_rp`).val(formatNumber(total_rp))
            $(`#diskon_global_rp`).val(formatNumber(diskon_global_detail_rp2))

            $(`#dasar_kena_pajak`).val(formatNumber(dasar_kena_pajak_detail));

            $(`#ppn_global_rp`).val(formatNumber(ppn_detail_rp))

            var ppn_global_rp = parseFloat($(`#ppn_global_rp`).val().replaceAll(".", ""));

            //total faktur
            var diskon_global_rp = parseFloat($(`#diskon_global_rp`).val().replaceAll(".", ""));
            var adjustment = parseFloat($(`#adjustment`).val().replaceAll(".", ""));
            var total_faktur = total_rp - diskon_global_rp + ppn_detail_rp + adjustment;
            $(`#total_faktur`).val(formatNumber(total_faktur));
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
        //         var sub_jumlah = $(`#caption-${i}-BackOrderDetail-sku_harga_nett`).text().replaceAll(".", "");
        //         total_rp += parseFloat(sub_jumlah);

        //         // DISKON GLOBAL RP
        //         diskon_global_detail_rp2 += parseFloat($(`#caption-${i}-BackOrderDetail-sku_disc_global_rupiah`).text().replaceAll(".", ""));

        //         // DASAR KENA PAJAK
        //         var checkbox_ppn_detail = $(`#checkbox-item-${i}-BackOrderDetail-ppn`).prop("checked");
        //         var diskon_global_detail_rp = $(`#caption-${i}-BackOrderDetail-sku_disc_global_rupiah`).text().replaceAll(".", "");
        //         if (checkbox_ppn_detail) {
        //             dasar_kena_pajak_detail += parseFloat(sub_jumlah) - parseFloat(diskon_global_detail_rp)
        //         }

        //         // PPN GLOBAL RP
        //         ppn_detail_rp += parseFloat($(`#caption-${i}-BackOrderDetail-ppn_rp`).text().replaceAll(".", ""));
        //     }
        // });

        // total diskon item, total rp, diskon global
        // $(`#total_diskon_item`).val(formatNumber(total_diskon_item));
        // $(`#total_rp`).val(formatNumber(total_rp))
        // $(`#diskon_global_rp`).val(formatNumber(diskon_global_detail_rp2))

        // $(`#dasar_kena_pajak`).val(formatNumber(dasar_kena_pajak_detail));

        // $(`#ppn_global_rp`).val(formatNumber(ppn_detail_rp))

        // var ppn_global_rp = parseFloat($(`#ppn_global_rp`).val().replaceAll(".", ""));

        // //total faktur
        // var diskon_global_rp = parseFloat($(`#diskon_global_rp`).val().replaceAll(".", ""));
        // var adjustment = parseFloat($(`#adjustment`).val().replaceAll(".", ""));
        // var total_faktur = total_rp - diskon_global_rp + ppn_detail_rp + adjustment;
        // $(`#total_faktur`).val(formatNumber(total_faktur));
    }

    function GetPerusahaanBySales(sales) {

        $("#filter-perusahaan-sku").empty();
        $("#filter-perusahaan-customer").empty();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/BackOrder/GetPerusahaanBySales') ?>",
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

    function delete_back_order_detail_2_temp_all() {
        $.ajax({
            url: "<?= base_url('FAS/BackOrder/delete_back_order_detail_2_temp_all') ?>",
            dataType: "JSON",
            success: function(response) {

            }
        });
    }

    function HeaderReadonly() {
        var count_arr_back_order_detail = 0;

        for (var i = 0; i < arr_back_order_detail.length; i++) {
            if (arr_back_order_detail[i] != "") {
                count_arr_back_order_detail++;
            }
        }

        if (count_arr_back_order_detail > 0) {
            $("#backorder-back_order_no_po").attr("readonly", true);
            $("#backorder-back_order_tgl").attr("readonly", true);
            $("#backorder-back_order_tgl_exp").attr("readonly", true);
            $("#backorder-back_order_tgl_harga").attr("readonly", true);
            $("#backorder-back_order_tgl_sj").attr("readonly", true);
            $("#backorder-back_order_tgl_kirim").attr("readonly", true);
            // $("#backorder-tipe_back_order_id").attr("disabled", true);
            $("#backorder-sales_id").attr("disabled", true);
            $("#backorder-back_order_tipe_pembayaran").attr("disabled", true);
            $("#backorder-tipe_delivery_order_id").attr("disabled", true);
            $("#backorder-client_wms_id").attr("disabled", true);
            $("#backorder-principle_id").attr("disabled", true);
        } else {
            $("#backorder-back_order_no_po").attr("readonly", false);
            $("#backorder-back_order_tgl").attr("readonly", false);
            $("#backorder-back_order_tgl_exp").attr("readonly", false);
            $("#backorder-back_order_tgl_harga").attr("readonly", false);
            $("#backorder-back_order_tgl_sj").attr("readonly", false);
            $("#backorder-back_order_tgl_kirim").attr("readonly", false);
            // $("#backorder-tipe_back_order_id").attr("disabled", false);
            $("#backorder-sales_id").attr("disabled", false);
            $("#backorder-back_order_tipe_pembayaran").attr("disabled", false);
            $("#backorder-tipe_delivery_order_id").attr("disabled", false);
            $("#backorder-client_wms_id").attr("disabled", false);
            $("#backorder-principle_id").attr("disabled", false);
        }
    }

    function add_so_detail2_ed() {
        var depo_detail_id = "";

        <?php foreach ($Gudang as $row) : ?>
            depo_detail_id = "<?= $row['depo_detail_id'] ?>";
        <?php endforeach; ?>

        arr_so_detail2_ed.push({
            'idx': arr_so_detail2_ed.length,
            'index_so_detail': $("#caption-ed-sku-index-retur").val(),
            'depo_detail_id': depo_detail_id,
            'sku_id': $("#caption-ed-sku-id-retur").val(),
            'sku_stock_expired_date': '',
            'sku_qty': 0,
            'delivery_order_reff_id': ''
        });

        get_so_detail2_ed()
    }

    function add_so_detail2_ed_by_do_detail2() {
        var depo_detail_id = "";

        <?php foreach ($Gudang as $row) : ?>
            depo_detail_id = "<?= $row['depo_detail_id'] ?>";
        <?php endforeach; ?>

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/BackOrder/Get_delivery_order_detail2_by_filter') ?>",
            data: {
                delivery_order_id: $("#filter-delivery_order_id").val(),
                sku_id: $("#caption-ed-sku-id-retur").val(),
                arr_so_detail2_ed: arr_so_detail2_ed
            },
            dataType: "JSON",
            async: false,
            success: function(response) {
                if (response.length > 0) {

                    $.each(response, function(i, v) {
                        arr_so_detail2_ed.push({
                            'idx': arr_so_detail2_ed.length,
                            'index_so_detail': $("#caption-ed-sku-index-retur").val(),
                            'depo_detail_id': depo_detail_id,
                            'sku_id': v.sku_id,
                            'sku_stock_expired_date': v.sku_expdate,
                            'sku_qty': v.sku_qty,
                            'delivery_order_reff_id': v.delivery_order_id
                        })
                    });

                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });

        get_so_detail2_ed()
    }

    function get_so_detail2_ed() {
        let index_so_detail = "";

        // console.log(arr_so_detail2_ed);

        total_so_detail2_qty = 0;

        if (arr_so_detail2_ed.length > 0) {
            $.ajax({
                async: false,
                type: 'POST',
                url: "<?= base_url('FAS/BackOrder/get_so_detail2_sementara') ?>",
                dataType: "JSON",
                data: {
                    sku_id: $("#caption-ed-sku-id-retur").val(),
                    arr_so_detail2: arr_so_detail2_ed
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading ...',
                        html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                        timerProgressBar: false,
                        showConfirmButton: false
                    });
                },
                success: function(response) {

                    $('#table-ed-sku-retur').fadeOut("fast", function() {
                        $(this).hide();

                        $("#table-ed-sku-retur > tbody").html('');
                        $("#table-ed-sku-retur > tbody").empty();

                    }).fadeIn("fast", function() {
                        $(this).show();

                        <?php if ($act == "detail") { ?>

                            $.each(response, function(i, v) {
                                index_so_detail = v.index_so_detail;
                                total_so_detail2_qty += parseInt(v.sku_qty);

                                $("#table-ed-sku-retur > tbody").append(`
                                    <tr id="row-${i}">
                                        <td class="text-center">${i+1}</td>
                                        <td class="text-center">
                                            ${v.delivery_order_reff_kode}
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-idx-retur" value="${v.idx}" />
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-sku_id-retur" value="${v.sku_id}" />
                                            <input type="hidden" id="item-${i}-BackOrderDetail2-delivery_order_reff_id-retur" value="${v.delivery_order_reff_id}" />
                                        </td>
                                        <td class="text-center">
                                            <select id="item-${i}-BackOrderDetail2-depo_detail_id-retur" class="input-sm form-control select_detail2" name="CAPTION-SALES" style="width:100%;" disabled>
                                                <?php foreach ($Gudang as $row) : ?>
                                                    <option value="<?= $row['depo_detail_id'] ?>" ${v.depo_detail_id == '<?= $row['depo_detail_id'] ?>' ? 'selected' : ''}><?= $row['depo_detail_nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td class="text-center">${v.sku_stock_expired_date}</td>
                                        <td class="text-center">${v.sku_qty}</td>
                                    </tr>
                                `);
                            });
                        <?php } else { ?>

                            $.each(response, function(i, v) {
                                index_so_detail = v.index_so_detail;
                                total_so_detail2_qty += parseInt(v.sku_qty);

                                $("#table-ed-sku-retur > tbody").append(`
                                <tr id="row-${i}">
                                    <td class="text-center">${i+1}</td>
                                    <td class="text-center">
                                        ${v.delivery_order_reff_kode}
                                        <input type="hidden" id="item-${i}-BackOrderDetail2-idx-retur" value="${v.idx}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail2-sku_id-retur" value="${v.sku_id}" />
                                        <input type="hidden" id="item-${i}-BackOrderDetail2-delivery_order_reff_id-retur" value="${v.delivery_order_reff_id}" />
                                    </td>
                                    <td class="text-center">
                                        <select id="item-${i}-BackOrderDetail2-depo_detail_id-retur" class="input-sm form-control select_detail2" name="CAPTION-SALES" onchange="update_so_detail2_ed('${v.sku_id}','${v.idx}','${i}')" style="width:100%;" disabled>
                                            <?php foreach ($Gudang as $row) : ?>
                                                <option value="<?= $row['depo_detail_id'] ?>" ${v.depo_detail_id == '<?= $row['depo_detail_id'] ?>' ? 'selected' : ''}><?= $row['depo_detail_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="date" class="form-control" id="item-${i}-BackOrderDetail2-sku_stock_expired_date-retur" value="${v.sku_stock_expired_date}" onchange="update_so_detail2_ed('${v.sku_id}','${v.idx}','${i}')" ${v.delivery_order_reff_id != '' ? 'disabled' : ''}/>
                                    </td>
                                    <td class="text-center">
                                        <input type="number" class="form-control" id="item-${i}-BackOrderDetail2-sku_qty-retur" value="${v.sku_qty}" onchange="update_so_detail2_ed('${v.sku_id}','${v.idx}','${i}')"/>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm" onclick="delete_so_detail2_ed('${v.sku_id}','${v.idx}','${i}')"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            `);
                            });
                        <?php } ?>

                        setTimeout(() => {
                            let sku_harga_nett = 0;

                            $("#total_so_detail2_qty").val(total_so_detail2_qty);
                            $("#caption-" + index_so_detail + "-BackOrderDetail-sku_qty").html('');
                            $("#caption-" + index_so_detail + "-BackOrderDetail-sku_qty").append(total_so_detail2_qty);
                            $("#item-" + index_so_detail + "-BackOrderDetail-sku_qty").val(total_so_detail2_qty);

                            sku_harga_nett = parseInt($("#caption-ed-sku-harga-retur").val()) * total_so_detail2_qty;

                            // $("#caption-" + index_so_detail + "-BackOrderDetail-sku_harga_nett").html(sku_harga_nett);

                            $("#caption-sku-qty-retur").val(total_so_detail2_qty);
                        }, 100);

                        $(".select_detail2").select2();
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    message("Error", "Error 500 Internal Server Connection Failure", "error");
                },
                complete: function() {
                    Swal.close();
                }
            });
        } else {
            $("#table-ed-sku-retur > tbody").html('');
            $("#table-ed-sku-retur > tbody").empty();
        }
    }

    function update_so_detail2_ed(sku_id, id, idx) {
        var sku_id = $("#caption-ed-sku-id-retur").val();
        var index_so_detail = $("#caption-ed-sku-index-retur").val();
        var sku_stock_expired_date = $("#item-" + idx + "-BackOrderDetail2-sku_stock_expired_date-retur").val();
        var sku_qty = $("#item-" + idx + "-BackOrderDetail2-sku_qty-retur").val();
        var depo_detail_id = $("#item-" + idx + "-BackOrderDetail2-depo_detail_id-retur").val();
        var delivery_order_reff_id = $("#item-" + idx + "-BackOrderDetail2-delivery_order_reff_id-retur").val();
        var index = -1;

        sku_qty = sku_qty == '' ? 0 : sku_qty;

        $.each(arr_so_detail2_ed, function(i, obj) {
            if (obj.idx == id) {
                index = i;
                return false; // Exit the loop once the desired object is found
            }
        });

        arr_so_detail2_ed[index] = ({
            'idx': id,
            'index_so_detail': index_so_detail,
            'depo_detail_id': depo_detail_id,
            'sku_id': sku_id,
            'sku_stock_expired_date': sku_stock_expired_date,
            'sku_qty': sku_qty,
            'delivery_order_reff_id': delivery_order_reff_id
        });

        console.log(arr_so_detail2_ed);

        get_so_detail2_ed();

    }

    function delete_so_detail2_ed(sku_id, id, idx) {
        // var sku_stock_expired_date = $("#item-" + idx + "-BackOrderDetail2-sku_stock_expired_date-retur").val();
        // var depo_detail_id = $("#item-" + idx + "-BackOrderDetail2-depo_detail_id-retur").val();

        arr_so_detail2_ed = jQuery.grep(arr_so_detail2_ed, function(value) {
            return value.idx != id;
        });

        get_so_detail2_ed();

    }

    function Get_back_order_by_top() {
        <?php if ($act == "add") { ?>

            if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                $("#filter-delivery_order_id").show();

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/Get_back_order_by_top_retur_default') ?>",
                    data: {
                        client_pt_id: $("#backorder-client_pt_id").val()
                    },
                    dataType: "JSON",
                    success: function(response) {

                        $("#filter-delivery_order_id").empty();

                        if (response != 0) {
                            $('#filter-delivery_order_id').fadeOut("slow", function() {
                                $(this).hide();
                            }).fadeIn("slow", function() {
                                $.each(response, function(i, v) {
                                    $("#filter-delivery_order_id").append(
                                        `<option value="'${v.delivery_order_id}'">${v.delivery_order_kode}</option>`
                                    );
                                });

                                $('#filter-delivery_order_id').val(arr_do_id_detail2);

                                // console.log(arr_do_id_detail2);

                                $('.selectpicker').selectpicker('refresh');
                            });

                        }
                    }
                });
            } else {
                $("#filter-delivery_order_id").html('');
                $("#filter-delivery_order_id").append(
                    `<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
                $("#filter-delivery_order_id").hide();
            }
        <?php } else if ($act == "edit") { ?>
            if ($("#backorder-tipe_back_order_id").val() == "AD89E05B-46A6-453B-8F19-886514234A21") {
                $("#filter-delivery_order_id").show();

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/BackOrder/Get_back_order_by_top_retur_default') ?>",
                    data: {
                        client_pt_id: $("#backorder-client_pt_id").val()
                    },
                    dataType: "JSON",
                    success: function(response) {

                        $("#filter-delivery_order_id").empty();

                        if (response != 0) {
                            $('#filter-delivery_order_id').fadeOut("slow", function() {
                                $(this).hide();
                            }).fadeIn("slow", function() {
                                $.each(response, function(i, v) {
                                    $("#filter-delivery_order_id").append(
                                        `<option value="'${v.delivery_order_id}'">${v.delivery_order_kode}</option>`
                                    );
                                });

                                $('#filter-delivery_order_id').val(arr_do_id_detail2);

                                // console.log(arr_do_id_detail2);

                                $('.selectpicker').selectpicker('refresh');
                            });

                        }
                    }
                });
            } else {
                $("#filter-delivery_order_id").html('');
                $("#filter-delivery_order_id").append(
                    `<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
                $("#filter-delivery_order_id").hide();
            }
        <?php } ?>
    }

    $("#backorder-client_wms_id").on("change", function() {
        reset_table_customer();
        reset_table_sku();
        reset_so_detail2_ed();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/BackOrder/getPrinciple') ?>",
            data: {
                perusahaanID: $("#backorder-client_wms_id").val()
            },
            dataType: "JSON",
            async: false,
            success: function(response) {

                $("#filter-principle").html('');
                $("#backorder-principle_id").html('');

                $("#filter-principle").append(`<option value="">Semua</option>`);
                $("#backorder-principle_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);

                if (response.length > 0) {
                    var ppn = 0;
                    $.each(response, function(i, v) {
                        $("#filter-principle").append(
                            `<option value="${v.principle_id}">${v.principle_kode}</option>`
                        );

                        $("#backorder-principle_id").append(
                            `<option value="${v.principle_id}">${v.principle_kode}</option>`
                        );

                        $(`#checkbox_ppn_global`).val(parseFloat(v.client_wms_tax))
                        ppn = v.client_wms_tax;
                    });
                }
            }
        });
    });

    function reset_so_detail2_ed() {
        arr_so_detail2_ed = [];
        get_so_detail2_ed();
    }

    function GenerateCanvas(back_order_id) {

        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Pastikan SO yang anda pilih benar!",
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
                    url: "<?= base_url('FAS/BackOrder/generate_canvas'); ?>",
                    type: "POST",
                    data: {
                        back_order_id: back_order_id
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
                    success: function(data) {
                        if (data == 1) {
                            message_topright("success", "SO Canvas Berhasil Generated");

                            setTimeout(() => {
                                GetDataSO();
                            }, 500);
                        } else {
                            message("Error!", "SO Canvas Gagal Generated", "error");
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
        });

    }

    $("#btnAvaibilityCheckProcess").on("click", function() {
        var tableSKUDO = $("#table-sku-delivery-only > tbody").length
        var tgl_kirim = $("#backorder-back_order_tgl_kirim").val();
        var id_temp2 = $("#so_id").val();
        var arrSKUCheck = [];
        var boolean = true;

        if (tableSKUDO > 0) {
            $("#table-sku-delivery-only tbody tr").each(function() {
                var sku_id = $(this).find("td:eq(0) input[class='sku-id']").val();
                var qty = $(this).find("td:eq(7) input").val();

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
                    url: "<?= base_url('FAS/BackOrder/insertExecProsesSimulasiMPS') ?>",
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
        var tgl_kirim = $("#backorder-back_order_tgl_kirim").val();
        var qty = $(`#item-${i}-BackOrderDetail-sku_qty`).val();

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
            url: "<?= base_url('FAS/BackOrder/execProsesSimulasiMPSSingle') ?>",
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

    function PilihJadwal() {

        let cek_error = 0;
        let grand_total = 0;

        if (arr_list_schedule_sku.length == 0) {
            var alert = "Jadwal belum ditambahkan";
            message_custom("Error", "error", alert);

            return false;
        }

        $.each(arr_list_schedule_sku, function(i, v) {

            if (v.sku_id == $("#filter_schedule_sku_id").val()) {
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

            // if ((v.qty == "" || v.qty == 0) && $("#filter_schedule_sku_qty").val() != "0") {
            //     var alert = "Qty tidak boleh kosong atau 0";
            //     message_custom("Error", "error", alert);

            //     cek_error++;
            // }

        });

        setTimeout(() => {

            if (grand_total != parseInt($("#filter_schedule_sku_qty").val().replaceAll(".", ""))) {
                var alert = "Grand total tidak sama dengan nilai maksimal jumlah barang";
                message_custom("Error", "error", alert);

                return false;
            }

            if (cek_error == 0) {
                $("#modal_list_data_pilih_jadwal_sku").modal('hide');
                pushToTableSKUDelivery();
            }
        }, 500);
    }
</script>