<script type="text/javascript">
    var ChannelCode = '';
    var arr_sku = [];
    var arr_sku_selected = [];
    var arr_sku_harga_detail = [];

    function chgLokasiKerja(value) {
        if (value != '') {
            $("#loadingdepo").show();
            $("#SKUHarga-depo_id").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Harga/search_depo_by_group') ?>",
                data: {
                    depo_group_nama: value
                },
                dataType: "JSON",
                async: false,
                success: function(response) {
                    $("#loadingdepo").hide();
                    $("#SKUHarga-depo_id").prop("disabled", false);

                    $("#SKUHarga-depo_id").html('');

                    if (response.length > 0) {
                        $.each(response, function(i, v) {
                            $("#SKUHarga-depo_id").append(`<option value="'${v.depo_id}'">${v.depo_nama}</option>`);
                        });

                        $("#SKUHarga-depo_id").selectpicker('refresh'); // Refresh selectpicker jika menggunakan plugin Bootstrap Select
                    }
                }
            });
        } else {
            $("#SKUHarga-depo_id").html('');
            $("#SKUHarga-depo_id").selectpicker('refresh'); // Refresh selectpicker jika menggunakan plugin Bootstrap Select
        }
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

    $('#select-with-tax').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="CheckboxWithTax"]:checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('[name="CheckboxWithTax"]:checkbox').each(function() {
                this.checked = false;
            });
        }
    });

    function message_custom(titleType, iconType, htmlType) {
        Swal.fire({
            title: titleType,
            icon: iconType,
            html: htmlType,
        });
    }

    function message2(msg, msgtext, msgtype) {
        Swal.fire(msg, msgtext, msgtype);
    }

    function message_topright2(titleType, iconType, htmlType) {
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
            title: titleType,
            icon: iconType,
            html: htmlType,
        });
    }

    $(document).ready(function() {
        $(".select2").select2();
        <?php foreach ($HargaDetail as $key => $detail) : ?>
            arr_sku.push("'<?= $detail['sku_id'] ?>'");

            arr_sku_harga_detail.push({
                'sku_id': "<?= $detail['sku_id'] ?>",
                'sku_qty': "<?= $detail['sku_qty'] ?>",
                'sku_with_tax': "<?= $detail['sku_with_tax'] ?>",
                'sku_nominal_harga': "<?= $detail['sku_nominal_harga'] ?>"
            });
        <?php endforeach; ?>
        // initDataSKU();

        $("#SKUHarga-client_wms_id").trigger('change');
    });

    $('#SKUHarga-sku_harga_is_need_approval').click(function(event) {
        if (this.checked) {
            $("#SKUHarga-sku_harga_status").val("In Progress Approval");
        } else {
            $("#SKUHarga-sku_harga_status").val("Draft");
        }
    });

    $("#SKUHarga-client_wms_id").change(function() {
        var value = $(this).val();

        if (value != "") {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Harga/getPrincipleByClientWMS') ?>",
                data: {
                    client_wms_id: value
                },
                dataType: "JSON",
                async: false,
                success: function(response) {

                    $("#filter-principle").html('');
                    $("#filter-principle").append(`<option value="">** Pilih **</option>`);

                    if (response.length > 0) {
                        $.each(response, function(i, v) {
                            $("#filter-principle").append(`<option value="${v.principle_id}">${v.principle_kode}</option>`);
                        });
                    }
                }
            });
        } else {
            $("#filter-principle").html('');
            $("#filter-principle").append(`<option value="">** Pilih **</option>`);
        }

        // initDataSKU();
    });

    $("#btn-choose-prod-delivery").on("click", function() {
        $("#table-sku tbody").empty();
    })

    $("#SKUHarga-depo_group_nama").change(function() {
        initDataDepo();
    });

    $("#SKUHarga-depo_id").change(function() {
        if ($("#SKUHarga-depo_id").val() === null) {
            $('#SKUHarga-depo_group_nama').selectpicker('val', '');
        }
    });

    $("#btn-search-sku").click(
        function() {
            var principle = $("#filter-principle").val();
            // console.log(principle);

            if (principle == '') {
                var alert = GetLanguageByKode('CAPTION-PILIHPRINCIPLE');
                message("Error!", alert, "error");
            } else {
                initDataSKU();
            }
        }
    );

    function initDataDepo() {
        var depo_group_nama = $("#SKUHarga-depo_group_nama").val();

        if (depo_group_nama !== null) {

            $("#loadingdepo").show();
            $("#SKUHarga-depo_id").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Harga/search_depo_by_group') ?>",
                data: {
                    depo_group_nama: depo_group_nama
                },
                dataType: "JSON",
                async: false,
                success: function(response) {
                    $("#loadingdepo").hide();
                    $("#SKUHarga-depo_id").prop("disabled", false);

                    $("#SKUHarga-depo_id").html('');

                    if (response.length > 0) {
                        $.each(response, function(i, v) {
                            $("#SKUHarga-depo_id").append(`<option value="'${v.depo_id}'">${v.depo_nama}</option>`);
                        });
                    }
                }
            });

        }
    }

    function initDataSKU() {
        var perusahaan = $("#SKUHarga-client_wms_id").val();
        var sku_induk = $("#filter-sku-induk").val();
        var sku_nama_produk = $("#filter-sku-nama-produk").val();
        var principle = $("#filter-principle").val();
        var brand = $("#filter-brand").val();

        if ($("#SKUHarga-client_wms_id").val() != "") {

            $("#loadingsku").show();
            $("#btn-choose-prod-delivery").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Harga/search_filter_chosen_sku_harga') ?>",
                data: {
                    perusahaan: perusahaan,
                    brand: brand,
                    principle: principle,
                    sku_induk: sku_induk,
                    sku_nama_produk: sku_nama_produk
                },
                dataType: "JSON",
                async: false,
                success: function(response) {
                    $("#loadingsku").hide();
                    $("#btn-choose-prod-delivery").prop("disabled", false);

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
                                targets: [0, 1, 2, 3, 4, 5, 6, 7]
                            }],
                            lengthMenu: [
                                [-1],
                                ['All']
                            ],
                        });
                    } else {
                        $("#table-sku > tbody").html(`<tr><td colspan="8" class="text-center text-danger">Data Kosong</td></tr>`);
                    }
                }
            });

        } else {
            var alert = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
            message("Error!", alert, "error");
        }

    }

    function pushToTableSKUDelivery() {

        var result = arr_sku_selected.reduce((unique, o) => {
            if (!unique.some(obj => obj.sku_id === o.sku_id)) {
                unique.push(o);
            }
            return unique;
        }, []);

        arr_sku_selected = result;

        $("#cek_sku").val(arr_sku_selected.length);
        // console.log(arr_sku_selected);

        if ($.fn.DataTable.isDataTable('#table-input-harga')) {
            $('#table-input-harga').DataTable().clear();
            $('#table-input-harga').DataTable().destroy();
        }

        $.each(arr_sku_selected, function(i, v) {
            if (arr_sku_selected[i] != "") {
                $("#table-input-harga > tbody").append(`
					<tr id="row-${i}">
						<td style="display: none">
							<input type="hidden" id="item-${i}-SKUHargaDetail-sku_id" value="${v.sku_id}" class="sku-id" />
						</td>
						<td class="text-center">${i+1}</td>
						<td class="text-center">${v.sku_kode}</td>
						<td class="text-center">${v.sku_nama_produk}</td>
						<td class="text-center">
							<input type="number" id="item-${i}-SKUHargaDetail-sku_qty" class="form-control" value="${v.sku_qty}" />
						</td>
						<td class="text-center">
							<span class="sku-satuan-label">${v.sku_satuan}</span>
						</td>
						<td class="text-center">
							<input type="checkbox" id="item-${i}-SKUHargaDetail-sku_with_tax" name="CheckboxWithTax" value="1" ${v.sku_with_tax == '1' ? 'checked' : '' } />
						</td>
						<td class="text-center">
							<input type="text" id="item-${i}-SKUHargaDetail-sku_nominal_harga" class="form-control" value="${v.sku_nominal_harga}" />
						</td>
						<td class="text-center">
							<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,${i},'${v.sku_id}')"><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				`);
            }

            var rupiah = document.getElementById('item-' + i + '-SKUHargaDetail-sku_nominal_harga');
            rupiah.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value);
            });

        });

        $('#table-input-harga').DataTable({
            'info': false,
            'paging': false,
            'searching': false,
            'pagination': false,
            'ordering': false,
            scrollX: true
        });
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

            GetSelectedSKU();

        } else {
            var alert = GetLanguageByKode('CAPTION-ALERT-PILIHSKUKONVERSI');

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message
            });
        }
    });

    function GetSelectedSKU() {

        arr_sku_selected = [];

        $('#table-input-harga > tbody').empty();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Harga/GetSelectedSKUEdit') ?>",
            data: {
                sku_harga_id: $("#SKUHarga-sku_harga_id").val(),
                sku_id: arr_sku
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response, function(i, v) {
                    arr_sku_selected.push({
                        'client_wms_id': v.client_wms_id,
                        'principle': v.principle,
                        'brand': v.brand,
                        'sku_id': v.sku_id,
                        'sku_kode': v.sku_kode,
                        'sku_nama_produk': v.sku_nama_produk,
                        'sku_harga_satuan': v.sku_harga_jual,
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
                        'sku_satuan': v.sku_satuan,
                        'sku_kemasan': v.sku_kemasan,
                        'sku_qty': v.sku_qty,
                        'sku_with_tax': v.sku_with_tax,
                        'sku_nominal_harga': parseInt(v.sku_nominal_harga)
                    });
                });

                pushToTableSKUDelivery();
            }
        });

    }

    $("#btnupdate").on("click", function() {
        var cek_error = 0;
        arr_sku_harga_detail = [];

        if ($('#SKUHarga-sku_harga_kode').val() == "") {
            var alert = GetLanguageByKode('CAPTION-ALERT-KODEHARGAKOSONG');
            message("Error!", alert, "error");

            cek_error++;

        }

        if ($('#SKUHarga-client_wms_id').val() == "") {
            var alert = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
            message("Error!", alert, "error");

            cek_error++;
        }

        if ($('#SKUHarga-depo_group_nama').val() == "") {
            var alert = GetLanguageByKode('CAPTION-ALERT-PILIHDEPOGROUP');
            message("Error!", alert, "error");

            cek_error++;
        }

        if ($('#SKUHarga-depo_id').val() == "") {
            var alert = GetLanguageByKode('CAPTION-ALERT-PILIHDEPO');
            message("Error!", alert, "error");

            cek_error++;
        }

        $("#table-input-harga > tbody tr").each(function(idx) {
            var is_Qty = $('#item-' + idx + '-SKUHargaDetail-sku_qty').val();
            // console.log(is_Qty);
            if (parseInt(is_Qty) == 0) {
                var alert = GetLanguageByKode('CAPTION-SKUQTYTIDAKBOLEH0');
                message("Error!", alert, "error");

                cek_error++;
            }
        });

        $("#table-input-harga > tbody tr").each(function(idx) {
            var is_Harga = $('#item-' + idx + '-SKUHargaDetail-sku_nominal_harga').val();
            // console.log(is_Qty);
            if (parseInt(is_Harga) == 0) {
                var alert = GetLanguageByKode('CAPTION-ALERT-SKUHARGATIDAKBOLEH0');
                message("Error!", alert, "error");

                cek_error++;
            }
        });

        $("#table-input-harga > tbody tr").each(function(idx) {
            arr_sku_harga_detail.push({
                'sku_id': $('#item-' + idx + '-SKUHargaDetail-sku_id').val(),
                'sku_qty': $('#item-' + idx + '-SKUHargaDetail-sku_qty').val(),
                'sku_with_tax': $('[id="item-' + idx + '-SKUHargaDetail-sku_with_tax"]:checked').length,
                'sku_nominal_harga': ($('#item-' + idx + '-SKUHargaDetail-sku_nominal_harga').val().replace(".", "").replace(".", "")).replace(",", ".")
            });
        });

        if (arr_sku_harga_detail.length > 0) {
            if (cek_error == 0) {
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
                        // $("#loadingview").show();
                        // $("#btnsave").prop("disabled", true);
                        $.ajax({
                            async: false,
                            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Harga/update_sku_harga'); ?>",
                            type: "POST",
                            data: {
                                sku_harga_id: $('#SKUHarga-sku_harga_id').val(),
                                client_wms_id: $('#SKUHarga-client_wms_id').val(),
                                depo_id: $('#SKUHarga-depo_id').val(),
                                depo_group_nama: $('#SKUHarga-depo_group_nama').val(),
                                sku_harga_kode: $('#SKUHarga-sku_harga_kode').val(),
                                sku_harga_keterangan: $('#SKUHarga-sku_harga_keterangan').val(),
                                sku_harga_startdate: $('#SKUHarga-sku_harga_startdate').val(),
                                sku_harga_enddate: $('#SKUHarga-sku_harga_enddate').val(),
                                sku_harga_status: $('#SKUHarga-sku_harga_status').val(),
                                sku_harga_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                                sku_harga_tgl_create: "",
                                sku_harga_who_approve: "",
                                sku_harga_tgl_approve: "",
                                sku_harga_is_aktif: 0,
                                sku_harga_is_delete: 0,
                                sku_harga_id_before: $('#SKUHarga-sku_harga_id_before').val(),
                                sku_harga_is_need_approval: $('[id="SKUHarga-sku_harga_is_need_approval"]:checked').length,
                                is_khusus: $('[id="SKUHarga-sku_harga_is_khusus"]:checked').length,
                                client_pt_segmen: $('#SKUHarga-client_pt_segmen').val(),
                                client_pt_id: $('#SKUHarga-client_pt_id').val(),
                                detail: arr_sku_harga_detail
                            },
                            dataType: "JSON",
                            success: function(data) {

                                $.each(data, function(i, v) {
                                    if (v.kode == "0") {

                                        $("#loadingview").hide();
                                        $("#btnsave").prop("disabled", false);

                                        var alert = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                        message_custom("Error", "error", alert);

                                    } else if (v.kode == "1") {

                                        $("#loadingview").hide();
                                        $("#btnsave").prop("disabled", false);

                                        var alert = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                        message_custom("Success", "success", alert);
                                        setTimeout(() => {
                                            location.href = "<?= base_url(); ?>FAS/MasterPricing/HargaDanPromo/Harga/HargaMenu";
                                        }, 500);

                                    } else if (v.kode == "2") {
                                        $("#loadingview").hide();
                                        $("#btnsave").prop("disabled", false);

                                        var msg = GetLanguageByKode('CAPTION-ALERT-HARGASUDAHADA') + " \n" + v.perusahaan + " , Start Date " + v.start_date + ", End Date " + v.end_date;
                                        var msgtype = 'error';

                                        //if (!window.__cfRLUnblockHandlers) return false;
                                        new PNotify
                                            ({
                                                title: 'Info',
                                                text: msg,
                                                type: msgtype,
                                                styling: 'bootstrap3',
                                                delay: 5000
                                            });
                                    }

                                });
                            }
                        });
                    }
                });
            }

        } else {
            var alert = GetLanguageByKode('CAPTION-PILIHSKU');
            message("Error!", alert, "error");
        }
    });

    $("#btnduplicate").on("click", function() {
        var cek_error = 0;
        arr_sku_harga_detail = [];

        if ($('#SKUHarga-sku_harga_kode').val() == "") {
            var alert = GetLanguageByKode('CAPTION-ALERT-KODEHARGAKOSONG');
            message("Error!", alert, "error");

            cek_error++;

        }

        if ($('#SKUHarga-client_wms_id').val() == "") {
            var alert = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
            message("Error!", alert, "error");

            cek_error++;
        }

        if ($('#SKUHarga-depo_group_nama').val() == "") {
            var alert = GetLanguageByKode('CAPTION-ALERT-PILIHDEPOGROUP');
            message("Error!", alert, "error");

            cek_error++;
        }

        if ($('#SKUHarga-depo_id').val() == "") {
            var alert = GetLanguageByKode('CAPTION-ALERT-PILIHDEPO');
            message("Error!", alert, "error");

            cek_error++;
        }

        $("#table-input-harga > tbody tr").each(function(idx) {
            var is_Qty = $('#item-' + idx + '-SKUHargaDetail-sku_qty').val();
            // console.log(is_Qty);
            if (parseInt(is_Qty) == 0) {
                var alert = GetLanguageByKode('CAPTION-SKUQTYTIDAKBOLEH0');
                message("Error!", alert, "error");

                cek_error++;
            }
        });

        $("#table-input-harga > tbody tr").each(function(idx) {
            var is_Harga = $('#item-' + idx + '-SKUHargaDetail-sku_nominal_harga').val();
            // console.log(is_Qty);
            if (parseInt(is_Harga) == 0) {
                var alert = GetLanguageByKode('CAPTION-ALERT-SKUHARGATIDAKBOLEH0');
                message("Error!", alert, "error");

                cek_error++;
            }
        });

        $("#table-input-harga > tbody tr").each(function(idx) {
            arr_sku_harga_detail.push({
                'sku_id': $('#item-' + idx + '-SKUHargaDetail-sku_id').val(),
                'sku_qty': $('#item-' + idx + '-SKUHargaDetail-sku_qty').val(),
                'sku_with_tax': $('[id="item-' + idx + '-SKUHargaDetail-sku_with_tax"]:checked').length,
                'sku_nominal_harga': ($('#item-' + idx + '-SKUHargaDetail-sku_nominal_harga').val().replace(".", "").replace(".", "")).replace(",", ".")
            });
        });

        if (arr_sku_harga_detail.length > 0) {
            if (cek_error == 0) {
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
                        // $("#loadingview").show();
                        // $("#btnsave").prop("disabled", true);
                        $.ajax({
                            async: false,
                            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Harga/insert_sku_harga'); ?>",
                            type: "POST",
                            data: {
                                sku_harga_id: $('#SKUHarga-sku_harga_id_new').val(),
                                client_wms_id: $('#SKUHarga-client_wms_id').val(),
                                depo_id: $('#SKUHarga-depo_id').val(),
                                depo_group_nama: $('#SKUHarga-depo_group_nama').val(),
                                sku_harga_kode: $('#SKUHarga-sku_harga_kode').val(),
                                sku_harga_keterangan: $('#SKUHarga-sku_harga_keterangan').val(),
                                sku_harga_startdate: $('#SKUHarga-sku_harga_startdate').val(),
                                sku_harga_enddate: $('#SKUHarga-sku_harga_enddate').val(),
                                sku_harga_status: $('#SKUHarga-sku_harga_status').val(),
                                sku_harga_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                                sku_harga_tgl_create: "",
                                sku_harga_who_approve: "",
                                sku_harga_tgl_approve: "",
                                sku_harga_is_aktif: 0,
                                sku_harga_is_delete: 0,
                                sku_harga_id_before: $('#SKUHarga-sku_harga_id').val(),
                                sku_harga_is_need_approval: $('[id="SKUHarga-sku_harga_is_need_approval"]:checked').length,
                                is_khusus: $('[id="SKUHarga-sku_harga_is_khusus"]:checked').length,
                                client_pt_segmen: $('#SKUHarga-client_pt_segmen').val(),
                                client_pt_id: $('#SKUHarga-client_pt_id').val(),
                                detail: arr_sku_harga_detail
                            },
                            dataType: "JSON",
                            success: function(data) {

                                $.each(data, function(i, v) {
                                    if (v.kode == "0") {

                                        $("#loadingview").hide();
                                        $("#btnsave").prop("disabled", false);

                                        var alert = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                        message_custom("Error", "error", alert);

                                    } else if (v.kode == "1") {

                                        $("#loadingview").hide();
                                        $("#btnsave").prop("disabled", false);

                                        var alert = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                        message_custom("Success", "success", alert);
                                        setTimeout(() => {
                                            location.href = "<?= base_url(); ?>FAS/MasterPricing/HargaDanPromo/Harga/HargaMenu";
                                        }, 500);

                                    } else if (v.kode == "2") {
                                        $("#loadingview").hide();
                                        $("#btnsave").prop("disabled", false);

                                        var msg = GetLanguageByKode('CAPTION-ALERT-HARGASUDAHADA') + " \n" + v.perusahaan + " , Start Date " + v.start_date + ", End Date " + v.end_date;
                                        var msgtype = 'error';

                                        //if (!window.__cfRLUnblockHandlers) return false;
                                        new PNotify
                                            ({
                                                title: 'Info',
                                                text: msg,
                                                type: msgtype,
                                                styling: 'bootstrap3',
                                                delay: 5000
                                            });
                                    }

                                });
                            }
                        });
                    }
                });
            }

        } else {
            var alert = GetLanguageByKode('CAPTION-PILIHSKU');
            message("Error!", alert, "error");
        }
    });

    function DeleteSKU(row, index) {
        var arr_sku_temp = [];
        var row = row.parentNode.parentNode;
        row.parentNode.removeChild(row);

        arr_sku[index] = "";
        arr_sku_temp = arr_sku;

        arr_sku = [];

        $.each(arr_sku_temp, function(i, v) {
            if (v != "") {
                arr_sku.push(v);
            }
        });

        GetSelectedSKU();

        // console.log(arr_sku_harga_detail);
    }

    $('#SKUHarga-sku_harga_is_khusus').click(function(event) {
        if (this.checked) {
            $("#SKUHarga-client_pt_id").prop("disabled", false);
            $("#SKUHarga-client_pt_id").selectpicker('refresh');
        } else {
            $("#SKUHarga-client_pt_id").prop("disabled", true);
            $("#SKUHarga-client_pt_id").selectpicker('refresh');
        }
    });

    function GetPelangganBySegmen() {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Harga/GetPelangganBySegmen') ?>",
            data: {
                segmen: $("#SKUHarga-client_pt_segmen").val()
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
                $("#SKUHarga-client_pt_id").html('');

                if (response.length > 0) {
                    $.each(response, function(i, v) {
                        $("#SKUHarga-client_pt_id").append(`<option value="'${v.client_pt_id}'">${v.client_pt_nama + " - " + v.client_pt_kelurahan}</option>`);
                    });

                    $('#SKUHarga-client_pt_id').selectpicker('refresh'); // Refresh selectpicker jika menggunakan plugin Bootstrap Select
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

    <?php
    if ($Menu_Access["D"] == 1) {
    ?> $("#btnnodeletechannel").click(
            function() {
                GetSalesOrderMenu();
            }
        );

    <?php
    }
    ?>

    <?php
    if ($Menu_Access["U"] == 1) {
    ?>

    <?php
    }
    ?>

    <?php
    if ($Menu_Access["C"] == 1) {
    ?>

    <?php
    }
    ?>

    function ResetForm() {
        <?php
        if ($Menu_Access["U"] == 1) {
        ?>
            $("#txtupdatechannelnama").val('');
            $("#cbupdatechanneljenis").prop('selectedIndex', 0);
            $("#chupdatechannelsppbr").prop('checked', false);
            $("#chupdatechanneltipeecomm").prop('checked', false);
            $("#chupdatechannelisactive").prop('checked', false);

            $("#loadingupdate").hide();
            $("#btnsaveupdatenewchannel").prop("disabled", false);
        <?php
        }
        ?>

        <?php
        if ($Menu_Access["C"] == 1) {
        ?>
            $("#txtchannelnama").val('');
            $("#cbchanneljenis").prop('selectedIndex', 0);
            $("#chchannelsppbr").prop('checked', false);
            $("#chchanneltipeecomm").prop('checked', false);
            $("#chchannelisactive").prop('checked', false);

            $("#loadingadd").hide();
            $("#btnsaveaddnewchannel").prop("disabled", false);
        <?php
        }
        ?>

    }
</script>