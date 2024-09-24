<script type="text/javascript">
    var ChannelCode = '';
    var arr_sku = [];
    var arr_sku_detail1 = [];
    var arr_pengaturan_detail = [];
    var arr_sku_promo_detail2_bonus = [];
    var arr_sku_promo_detail2_diskon = [];
    var arr_sku_promo_detail2_bonus_detail = [];
    var arr_sku_promo_lokasi = [];
    var idx_table_pengaturan_header = 0;
    var idx_promo_detail = 0;

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

    function message_custom(titleType, iconType, htmlType) {
        Swal.fire({
            title: titleType,
            icon: iconType,
            html: htmlType,
        });
    }

    function message(msg, msgtext, msgtype) {
        Swal.fire(msg, msgtext, msgtype);
    }

    function message_topright(titleType, iconType, htmlType) {
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

    $(document).ready(
        function() {
            $('.select2').select2();

            // $.ajax({
            //     async: false,
            //     type: 'POST',
            //     url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_all_sku_promo_temp_tanpa_id') ?>",
            //     // data: {
            //     //     sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
            //     //     sku_promo_id_new: $("#SKUPromo-sku_promo_id_new").val()
            //     // },
            //     dataType: "JSON",
            //     success: function(response) {
            //         console.log("delete_all_sku_promo_temp_tanpa_id success");
            //         // GetPromoDetail();
            //     }
            // });

            <?php if ($act == "duplicate") { ?>
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_from_temp_duplicate') ?>",
                    data: {
                        sku_promo_id: $("#SKUPromo-sku_promo_id").val(),
                        sku_promo_id_new: $("#SKUPromo-sku_promo_id_new").val()
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log("insert_sku_promo_from_temp success");
                        GetPromoDetail();
                    }
                });
            <?php } else if ($act == "edit") { ?>
                GetPromoDetail();
            <?php } ?>
        }
    );

    //start function group

    function AturBonus(sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, idx, idx2) {

        var sku_group_id = $.trim($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_induk_id").children("option:selected").text());
        var sku_group_nama = $.trim($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").children("option:selected").text());
        var sku_group_nama_val = $("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").val();
        var principle_id = $("#SKUPromoDetail-principle_id_" + idx).val();

        // alert(sku_group_nama)

        if (principle_id != "") {

            if (sku_group_nama_val != "") {

                $("#modal-pengaturan-by-one").modal('show');
                $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val('');
                $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val('');
                $("#Filter-principle_id_by_one").val('');

                $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val(sku_promo_detail1_id);
                $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val(sku_promo_detail2_id);
                $("#Filter-principle_id_by_one").val(principle_id);
                $("#FilterPengaturan-sku_group_id_by_one").val(sku_group_id);
                $("#FilterPengaturan-sku_group_nama_by_one").val(sku_group_nama);

                GetPromoDetail2BonusByOne();

            } else {
                var msg = GetLanguageByKode('CAPTION-ALERT-ADAKATEGORIYANGBELUMDIPILIH');
                message_custom("Error", "error", msg);
            }

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHPRINCIPLE');
            message_custom("Error", "error", msg);

        }
    }

    function AturDiskon(sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, idx, idx2) {

        var sku_group_id = $.trim($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_induk_id").children("option:selected").text());
        var sku_group_nama = $.trim($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").children("option:selected").text());
        var sku_group_nama_val = $("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").val();
        var principle_id = $("#SKUPromoDetail-principle_id_" + idx).val();

        // alert(sku_group_nama_val)

        if (principle_id != "") {

            if (sku_group_nama_val != "") {

                $("#modal-pengaturan-diskon-by-one").modal('show');
                $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val('');
                $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val('');
                $("#Filter-principle_id_by_one").val('');
                $("#FilterPengaturanDiskon-sku_group_id_by_one").val('');
                $("#FilterPengaturanDiskon-sku_group_nama_by_one").val('');
                $("#SKUPromoDetail2Diskon-check_pilihan").val('by_one');

                $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val(sku_promo_detail1_id);
                $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val(sku_promo_detail2_id);
                $("#Filter-principle_id_by_one").val(principle_id);
                $("#FilterPengaturanDiskon-sku_group_id_by_one").val(sku_group_id);
                $("#FilterPengaturanDiskon-sku_group_nama_by_one").val(sku_group_nama);
                $("#SKUPromoDetail2Diskon-check_pilihan").val('by_one');

                GetPromoDetail2Diskon();

            } else {
                var msg = GetLanguageByKode('CAPTION-ALERT-ADAKATEGORIYANGBELUMDIPILIH');
                message_custom("Error", "error", msg);
            }

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHPRINCIPLE');
            message_custom("Error", "error", msg);

        }
    }

    function AturBonusBySKU(sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, idx, idx2, sku_id, sku_kode, sku_nama_produk, sku_kemasan, sku_satuan) {

        var principle_id = $("#SKUPromoDetail-principle_id_" + idx).val();

        if (principle_id != "") {

            if (sku_kode != "") {

                $("#modal-pengaturan-by-sku").modal('show');
                $("#SKUPromoDetail-sku_promo_detail1_id_by_sku").val('');
                $("#SKUPromoDetail-sku_promo_detail2_id_by_sku").val('');
                $("#Filter-principle_id_by_sku").val('');
                $("#FilterPengaturan-sku_id_by_sku").val('');
                $("#FilterPengaturan-sku_kode_by_sku").val('');
                $("#FilterPengaturan-sku_nama_produk_by_sku").val('');
                $("#FilterPengaturan-sku_kemasan_by_sku").val('');
                $("#FilterPengaturan-sku_satuan_by_sku").val('');

                $("#SKUPromoDetail-sku_promo_detail1_id_by_sku").val(sku_promo_detail1_id);
                $("#SKUPromoDetail-sku_promo_detail2_id_by_sku").val(sku_promo_detail2_id);
                $("#Filter-principle_id_by_sku").val(principle_id);
                $("#FilterPengaturan-sku_id_by_sku").val(sku_id);
                $("#FilterPengaturan-sku_kode_by_sku").val(sku_kode);
                $("#FilterPengaturan-sku_nama_produk_by_sku").val(sku_nama_produk);
                $("#FilterPengaturan-sku_kemasan_by_sku").val(sku_kemasan);
                $("#FilterPengaturan-sku_satuan_by_sku").val(sku_satuan);

                GetPromoDetail2Bonus();
            } else {
                var msg = GetLanguageByKode('CAPTION-ALERT-ADAKATEGORIYANGBELUMDIPILIH');
                message_custom("Error", "error", msg);
            }

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHPRINCIPLE');
            message_custom("Error", "error", msg);

        }
    }

    function AturDiskonBySKU(sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, idx, idx2, sku_id, sku_kode, sku_nama_produk, sku_kemasan, sku_satuan) {

        // alert(sku_id)

        var principle_id = $("#SKUPromoDetail-principle_id_" + idx).val();

        if (principle_id != "") {

            if (sku_kode != "") {

                $("#modal-pengaturan-diskon-by-sku").modal('show');
                $("#SKUPromoDetail-sku_promo_detail1_id_by_sku").val('');
                $("#SKUPromoDetail-sku_promo_detail2_id_by_sku").val('');
                $("#Filter-principle_id_by_sku").val('');
                $("#SKUPromoDetail2Diskon-check_pilihan").val('');

                $("#SKUPromoDetail-sku_promo_detail1_id_by_sku").val(sku_promo_detail1_id);
                $("#SKUPromoDetail-sku_promo_detail2_id_by_sku").val(sku_promo_detail2_id);
                $("#Filter-principle_id_by_sku").val(principle_id);
                $("#FilterPengaturanDiskon-sku_id_by_sku").val(sku_id);
                $("#FilterPengaturanDiskon-sku_kode_by_sku").val(sku_kode);
                $("#FilterPengaturanDiskon-sku_nama_produk_by_sku").val(sku_nama_produk);
                $("#FilterPengaturanDiskon-sku_kemasan_by_sku").val(sku_kemasan);
                $("#FilterPengaturanDiskon-sku_satuan_by_sku").val(sku_satuan);
                $("#SKUPromoDetail2Diskon-check_pilihan").val('by_sku');

                GetPromoDetail2Diskon();

            } else {
                var msg = GetLanguageByKode('CAPTION-ALERT-ADAKATEGORIYANGBELUMDIPILIH');
                message_custom("Error", "error", msg);
            }

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHPRINCIPLE');
            message_custom("Error", "error", msg);

        }
    }

    function ViewModalPengaturanBonus(idx) {

        var check = 0;
        var principle_id = $("#SKUPromoDetail-principle_id_" + idx).val();
        var sku_promo_detail1_id = $("#SKUPromoDetail-sku_promo_detail1_id_" + idx).val();
        var sku_promo_detail2_id = $("#SKUPromoDetail-sku_promo_detail2_id_" + idx).val();
        var use_group = $("#SKUPromoDetail-sku_promo_detail1_use_groupsku_" + idx).val();

        $("#table-product-promo-" + idx + " > tbody tr ").each(function(idx2) {
            // console.log($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").val());
            if ($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").val() == "") {
                check++;
            }
        });

        if (principle_id != "") {

            if (use_group == 1) {

                if (check == 0 && $("#table-product-promo-" + idx + " > tbody tr ").length > 0) {
                    $("#modal-pengaturan").modal('show');
                    $("#SKUPromoDetail-sku_promo_detail1_id").val('');
                    $("#SKUPromoDetail-sku_promo_detail2_id").val('');

                    $("#SKUPromoDetail-sku_promo_detail1_id").val(sku_promo_detail1_id);
                    $("#SKUPromoDetail-sku_promo_detail2_id").val(sku_promo_detail2_id);
                    $("#Filter-principle_id").val(principle_id);

                    GetPromoDetail2Bonus();

                } else {
                    var msg = GetLanguageByKode('CAPTION-ALERT-ADAKATEGORIYANGBELUMDIPILIH');
                    message_custom("Error", "error", msg);
                }

            } else if (use_group == 0) {
                $("#modal-pengaturan").modal('show');
                $("#SKUPromoDetail-sku_promo_detail1_id").val('');
                $("#SKUPromoDetail-sku_promo_detail2_id").val('');

                $("#SKUPromoDetail-sku_promo_detail1_id").val(sku_promo_detail1_id);
                $("#SKUPromoDetail-sku_promo_detail2_id").val(sku_promo_detail2_id);
                $("#Filter-principle_id").val(principle_id);

                GetPromoDetail2Bonus();
            }

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHPRINCIPLE');
            message_custom("Error", "error", msg);

        }
    }

    function ViewModalPengaturanDiskon(idx) {

        var check = 0;
        var principle_id = $("#SKUPromoDetail-principle_id_" + idx).val();
        var sku_promo_detail1_id = $("#SKUPromoDetail-sku_promo_detail1_id_" + idx).val();
        var sku_promo_detail2_id = $("#SKUPromoDetail-sku_promo_detail2_id_" + idx).val();
        var use_group = $("#SKUPromoDetail-sku_promo_detail1_use_groupsku_" + idx).val();

        $("#table-product-promo-" + idx + " > tbody tr ").each(function(idx2) {
            // console.log($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").val());
            if ($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").val() == "") {
                check++;
            }
        });

        if (principle_id != "") {

            if (use_group == 1) {

                if (check == 0 && $("#table-product-promo-" + idx + " > tbody tr ").length > 0) {
                    $("#modal-pengaturan-diskon").modal('show');
                    $("#SKUPromoDetail-sku_promo_detail1_id").val('');
                    $("#SKUPromoDetail-sku_promo_detail2_id").val('');
                    $("#SKUPromoDetail2Diskon-check_pilihan").val('');

                    $("#SKUPromoDetail-sku_promo_detail1_id").val(sku_promo_detail1_id);
                    $("#SKUPromoDetail-sku_promo_detail2_id").val(sku_promo_detail2_id);
                    $("#Filter-principle_id").val(principle_id);
                    $("#SKUPromoDetail2Diskon-check_pilihan").val('all');

                    GetPromoDetail2Diskon();
                } else {
                    var msg = GetLanguageByKode('CAPTION-ALERT-ADAKATEGORIYANGBELUMDIPILIH');
                    message_custom("Error", "error", msg);
                }

            } else if (use_group == 0) {
                $("#modal-pengaturan-diskon").modal('show');
                $("#SKUPromoDetail-sku_promo_detail1_id").val('');
                $("#SKUPromoDetail-sku_promo_detail2_id").val('');
                $("#SKUPromoDetail2Diskon-check_pilihan").val('');

                $("#SKUPromoDetail-sku_promo_detail1_id").val(sku_promo_detail1_id);
                $("#SKUPromoDetail-sku_promo_detail2_id").val(sku_promo_detail2_id);
                $("#Filter-principle_id").val(principle_id);
                $("#SKUPromoDetail2Diskon-check_pilihan").val('all');

                GetPromoDetail2Diskon();
            }

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHPRINCIPLE');
            message_custom("Error", "error", msg);

        }
    }

    function pushToTablePengaturanDetail() {

        var check_pilihan = $("#SKUPromoDetail2Bonus-check_pilihan").val();

        if (check_pilihan == "all") {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_bonus_detail_temp') ?>",
                data: {
                    sku_promo_detail2_bonus_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id").val(),
                    sku_promo_detail2_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_id").val(),
                    sku_promo_detail1_id: $("#SKUPromoDetail2Bonus-sku_promo_detail1_id").val(),
                    sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val()
                },
                dataType: "JSON",
                success: function(response) {
                    $('#table-pengaturan-detail > tbody').empty('');

                    if ($.fn.DataTable.isDataTable('#table-pengaturan-detail')) {
                        $('#table-pengaturan-detail').DataTable().clear();
                        $('#table-pengaturan-detail').DataTable().destroy();
                    }

                    if (response != 0) {
                        $.each(response, function(i, v) {
                            $("#table-pengaturan-detail > tbody").append(`
							<tr id="row-${i}">
								<td class="text-center">
									${i+1}
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus2_id" value="${v.sku_promo_detail2_bonus2_id}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus_id" value="${v.sku_promo_detail2_bonus_id}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_id" value="${v.sku_id}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_nama_produk" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_kemasan" class="form-control sku-kemasan" value="${v.sku_kemasan}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_satuan" class="form-control sku-satuan" value="${v.sku_satuan}" />
								</td>
								<td class="text-center">
									<span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
								</td>
								<td class="text-center">
									<span class="sku-kemasan-label">${v.sku_kemasan}</span>
								</td>
								<td class="text-center">
									<span class="sku-satuan-label">${v.sku_satuan}</span>
								</td>
								<td class="text-center" style="width:10%;">
									<input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-sku_qty_bonus" class="form-control input-sm" value="${v.sku_qty_bonus}" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','all')"/>
								</td>
								<td class="text-center" style="width:10%;">
									<select id="item-${i}-SKUPromoDetail2BonusDetail-sku_tipe_id" class="form-control input-sm" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','all')">
										<option value="">**Pilih**</option>
									</select>
								</td>
								<td class="text-center" style="width:10%;">
									<input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon_id" class="form-control input-sm" value="" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','all')"/>
								</td>
								<td class="text-center">
									<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,${i},'${v.sku_id}')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						`);
                        });

                        $('#table-pengaturan-detail').DataTable({
                            'info': false,
                            'paging': false,
                            'searching': false,
                            'pagination': false,
                            'ordering': false,
                            scrollX: true,
                            scrollY: '300px',
                            scrollCollapse: true
                        });
                    }
                }
            });
        } else if (check_pilihan == "by_one") {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_bonus_detail_temp') ?>",
                data: {
                    sku_promo_detail2_bonus_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one").val(),
                    sku_promo_detail2_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one").val(),
                    sku_promo_detail1_id: $("#SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one").val(),
                    sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val()
                },
                dataType: "JSON",
                success: function(response) {
                    $('#table-pengaturan-detail-by-one > tbody').empty('');

                    if ($.fn.DataTable.isDataTable('#table-pengaturan-detail-by-one')) {
                        $('#table-pengaturan-detail-by-one').DataTable().clear();
                        $('#table-pengaturan-detail-by-one').DataTable().destroy();
                    }

                    if (response != 0) {
                        $.each(response, function(i, v) {
                            $("#table-pengaturan-detail-by-one > tbody").append(`
							<tr id="row-${i}">
								<td class="text-center">
									${i+1}
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus2_id_by_one" value="${v.sku_promo_detail2_bonus2_id}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus_id_by_one" value="${v.sku_promo_detail2_bonus_id}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_id_by_one" value="${v.sku_id}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_nama_produk_by_one" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_kemasan_by_one" class="form-control sku-kemasan" value="${v.sku_kemasan}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_satuan_by_one" class="form-control sku-satuan" value="${v.sku_satuan}" />
								</td>
								<td class="text-center">
									<span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
								</td>
								<td class="text-center">
									<span class="sku-kemasan-label">${v.sku_kemasan}</span>
								</td>
								<td class="text-center">
									<span class="sku-satuan-label">${v.sku_satuan}</span>
								</td>
								<td class="text-center" style="width:10%;">
									<input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-sku_qty_bonus_by_one" class="form-control input-sm" value="${v.sku_qty_bonus}" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_one')"/>
								</td>
								<td class="text-center" style="width:10%;">
									<select id="item-${i}-SKUPromoDetail2BonusDetail-sku_tipe_id_by_one" class="form-control input-sm" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_one')">
										<option value="">**Pilih**</option>
									</select>
								</td>
								<td class="text-center" style="width:10%;">
									<input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_one" class="form-control input-sm" value="" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_one')"/>
								</td>
								<td class="text-center">
									<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,${i},'${v.sku_id}')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						`);
                        });

                        $('#table-pengaturan-detail-by-one').DataTable({
                            'info': false,
                            'paging': false,
                            'searching': false,
                            'pagination': false,
                            'ordering': false,
                            scrollX: true,
                            scrollY: '300px',
                            scrollCollapse: true
                        });
                    }
                }
            });
        } else if (check_pilihan == "by_sku") {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_bonus_detail_temp') ?>",
                data: {
                    sku_promo_detail2_bonus_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_sku").val(),
                    sku_promo_detail2_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_id_by_sku").val(),
                    sku_promo_detail1_id: $("#SKUPromoDetail2Bonus-sku_promo_detail1_id_by_sku").val(),
                    sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val()
                },
                dataType: "JSON",
                success: function(response) {
                    $('#table-pengaturan-detail-by-sku > tbody').empty('');

                    if ($.fn.DataTable.isDataTable('#table-pengaturan-detail-by-sku')) {
                        $('#table-pengaturan-detail-by-sku').DataTable().clear();
                        $('#table-pengaturan-detail-by-sku').DataTable().destroy();
                    }

                    if (response != 0) {
                        $.each(response, function(i, v) {
                            $("#table-pengaturan-detail-by-sku > tbody").append(`
							<tr id="row-${i}">
								<td class="text-center">
									${i+1}
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus2_id_by_sku" value="${v.sku_promo_detail2_bonus2_id}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus_id_by_sku" value="${v.sku_promo_detail2_bonus_id}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_id_by_sku" value="${v.sku_id}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_nama_produk_by_sku" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_kemasan_by_sku" class="form-control sku-kemasan" value="${v.sku_kemasan}" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_satuan_by_sku" class="form-control sku-satuan" value="${v.sku_satuan}" />
								</td>
								<td class="text-center">
									<span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
								</td>
								<td class="text-center">
									<span class="sku-kemasan-label">${v.sku_kemasan}</span>
								</td>
								<td class="text-center">
									<span class="sku-satuan-label">${v.sku_satuan}</span>
								</td>
								<td class="text-center" style="width:10%;">
									<input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-sku_qty_bonus_by_sku" class="form-control input-sm" value="${v.sku_qty_bonus}" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_sku')"/>
								</td>
								<td class="text-center" style="width:10%;">
									<select id="item-${i}-SKUPromoDetail2BonusDetail-sku_tipe_id_by_sku" class="form-control input-sm" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_sku')">
										<option value="">**Pilih**</option>
									</select>
								</td>
								<td class="text-center" style="width:10%;">
									<input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_sku" class="form-control input-sm" value="" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_sku')"/>
								</td>
								<td class="text-center">
									<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,${i},'${v.sku_id}')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						`);
                        });

                        $('#table-pengaturan-detail-by-sku').DataTable({
                            'info': false,
                            'paging': false,
                            'searching': false,
                            'pagination': false,
                            'ordering': false,
                            scrollX: true,
                            scrollY: '300px',
                            scrollCollapse: true
                        });
                    }
                }
            });
        }
    }

    // function pushToTablePengaturanDetail() {

    // 	var result = arr_pengaturan_detail.reduce((unique, o) => {
    // 		if (!unique.some(obj => obj.sku_id === o.sku_id)) {
    // 			unique.push(o);
    // 		}
    // 		return unique;
    // 	}, []);

    // 	arr_pengaturan_detail = result;

    // 	$("#cek_sku").val(arr_pengaturan_detail.length);
    // 	// console.log(arr_pengaturan_detail);

    // 	if ($.fn.DataTable.isDataTable('#table-pengaturan-detail')) {
    // 		$('#table-pengaturan-detail').DataTable().clear();
    // 		$('#table-pengaturan-detail').DataTable().destroy();
    // 	}

    // 	$.each(arr_pengaturan_detail, function(i, v) {

    // 		if (arr_pengaturan_detail[i] != "") {
    // 			$("#table-pengaturan-detail > tbody").append(`
    // 				<tr id="row-${i}">
    // 					<td class="text-center">
    // 						${i+1}
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-client_wms_id" value="${v.client_wms_id}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-principle" value="${v.principle}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-brand" value="${v.brand}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_id" value="${v.sku_id}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_kode" value="${v.sku_kode}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_nama_produk" value="${v.sku_nama_produk}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_harga_satuan" value="${v.sku_harga_satuan}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_disc_percent" value="${v.sku_disc_percent}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_disc_rp" value="${v.sku_disc_rp}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_harga_nett" value="${v.sku_harga_nett}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_weight" value="${v.sku_weight}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_weight_unit" value="${v.sku_weight_unit}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_length" value="${v.sku_length}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_length_unit" value="${v.sku_length_unit}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_width" value="${v.sku_width}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_width_unit" value="${v.sku_width_unit}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_height" value="${v.sku_height}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_height_unit" value="${v.sku_height_unit}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_volume" value="${v.sku_volume}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_volume_unit" value="${v.sku_volume_unit}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_keterangan" value="${v.sku_keterangan}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_satuan" value="${v.sku_satuan}" />
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_kemasan" value="${v.sku_kemasan}" />
    // 					</td>
    // 					<td class="text-center">
    // 						<span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_nama_produk" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
    // 					</td>
    // 					<td class="text-center">
    // 						<span class="sku-kemasan-label">${v.sku_kemasan}</span>
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_kemasan" class="form-control sku-kemasan" value="${v.sku_kemasan}" />
    // 					</td>
    // 					<td class="text-center">
    // 						<span class="sku-satuan-label">${v.sku_satuan}</span>
    // 						<input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_satuan" class="form-control sku-satuan" value="${v.sku_satuan}" />
    // 					</td>
    // 					<td class="text-center" style="width:10%;">
    // 						<input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-sku_qty_bonus" class="form-control input-sm" value="" />
    // 					</td>
    // 					<td class="text-center" style="width:10%;">
    // 						<select id="item-${i}-SKUPromoDetail2BonusDetail-tipe" class="form-control input-sm">
    // 							<option value="">**Pilih**</option>
    // 						</select>
    // 					</td>
    // 					<td class="text-center" style="width:10%;">
    // 						<input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon" class="form-control input-sm" value="" />
    // 					</td>
    // 					<td class="text-center">
    // 						<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,${i},'${v.sku_id}')"><i class="fa fa-trash"></i></button>
    // 					</td>
    // 				</tr>
    // 			`);
    // 		}

    // 	});

    // 	$('#table-pengaturan-detail').DataTable({
    // 		'info': false,
    // 		'paging': false,
    // 		'searching': false,
    // 		'pagination': false,
    // 		'ordering': false,
    // 		scrollX: true,
    // 		scrollY: '300px',
    // 		scrollCollapse: true
    // 	});
    // }

    function ViewBonusDetail2(sku_promo_detail2_bonus_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, index) {

        $("#SKUPromoDetail2Bonus-check_pilihan").val('');

        $("#panel-pengaturan-detail").show();
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id").val(sku_promo_detail2_bonus_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_id").val(sku_promo_detail2_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail1_id").val(sku_promo_detail1_id);
        $("#SKUPromoDetail2Bonus-sku_promo_id").val(sku_promo_id);
        $("#SKUPromoDetail2Bonus-index").val(index);
        $("#SKUPromoDetail2Bonus-check_pilihan").val("all");

        pushToTablePengaturanDetail();

    }

    function ViewBonusDetail2ByOne(sku_promo_detail2_bonus_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, index) {
        $("#SKUPromoDetail2Bonus-check_pilihan").val('');

        $("#panel-pengaturan-detail-by-one").show();
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one").val(sku_promo_detail2_bonus_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one").val(sku_promo_detail2_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one").val(sku_promo_detail1_id);
        $("#SKUPromoDetail2Bonus-sku_promo_id").val(sku_promo_id);
        $("#SKUPromoDetail2Bonus-index").val(index);
        $("#SKUPromoDetail2Bonus-check_pilihan").val("by_one");

        pushToTablePengaturanDetail();

    }

    function ViewBonusDetail2BySKU(sku_promo_detail2_bonus_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, index) {
        $("#SKUPromoDetail2Bonus-check_pilihan").val('');

        $("#panel-pengaturan-detail-by-sku").show();
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_sku").val(sku_promo_detail2_bonus_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_id_by_sku").val(sku_promo_detail2_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail1_id_by_sku").val(sku_promo_detail1_id);
        $("#SKUPromoDetail2Bonus-sku_promo_id").val(sku_promo_id);
        $("#SKUPromoDetail2Bonus-index").val(index);
        $("#SKUPromoDetail2Bonus-check_pilihan").val("by_sku");

        pushToTablePengaturanDetail();

    }

    function DeleteSKU(row, index, sku_id) {
        var row = row.parentNode.parentNode;
        row.parentNode.removeChild(row);

        arr_sku[index] = "";
        arr_pengaturan_detail[index] = "";
    }

    function DeletePromoDetail2Bonus(sku_promo_detail2_bonus_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, index) {

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_detail2_bonus_temp') ?>",
            data: {
                sku_promo_detail2_bonus_id: sku_promo_detail2_bonus_id,
                sku_promo_detail2_id: sku_promo_detail2_id,
                sku_promo_detail1_id: sku_promo_detail1_id,
                sku_promo_id: sku_promo_id
            },
            dataType: "JSON",
            success: function(response) {
                console.log("delete_sku_promo_detail2_bonus_temp success");
                GetPromoDetail2Bonus();
            }
        });

        // var row = row.parentNode.parentNode;
        // row.parentNode.removeChild(row);

        // arr_sku[index] = "";
        // arr_pengaturan_detail[index] = "";

    }

    function GetSalesOrderMenu() {
        $("#loadingview").show();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/GetSalesOrderMenu') ?>",
            //data: "Location="+ Location,
            success: function(response) {
                if (response) {
                    $("#loadingview").hide();
                    ChSalesOrderBosnetMenu(response);
                }
            }
        });
    }

    //var DTABLE;

    function ChSalesOrderBosnetMenu(JSONChannel) {
        var Channel = JSON.parse(JSONChannel);

        var StatusC = Channel.AuthorityMenu[0].menu_c;
        var StatusU = Channel.AuthorityMenu[0].menu_u;
        var StatusD = Channel.AuthorityMenu[0].menu_d;

        if (StatusC == 1) {
            $("#btnsavesobosnet").attr('style', 'display: ;');
        }

    }

    function AddSKUPromoDetail2(idx) {
        var checked_bonus = $('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + idx + '"]:checked').length;
        var checked_diskon = $('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + idx + '"]:checked').length;
        var principle_id = $("#SKUPromoDetail-principle_id_" + idx).val();
        var use_group = $("#SKUPromoDetail-sku_promo_detail1_use_groupsku_" + idx).val();

        // alert(use_group)

        if (principle_id !== "") {

            if (use_group == 1) {

                $.ajax({
                    async: false,
                    type: 'POST',
                    url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_temp') ?>",
                    data: {
                        sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                        sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + idx).val()
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log("insert_sku_promo_detail2_temp success");
                    }
                });

                $.ajax({
                    async: false,
                    type: 'GET',
                    url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_temp') ?>",
                    data: {
                        sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                        sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + idx).val()
                    },
                    dataType: "JSON",
                    success: function(response) {

                        $('#table-product-promo-' + idx + ' > tbody').empty();

                        if (response.length > 0) {
                            $.each(response, function(i, v) {
                                $('#table-product-promo-' + idx + ' > tbody').append(`
							<tr id="row-${i}">
								<td style="vertical-align:middle; text-align:center;">
									${i+1}
									<input type="hidden" id="" value="item-${i}-SKUPromoDetail2-sku_promo_detail2_id" value="${v.sku_promo_detail2_id}">
								</td>
								<td style="vertical-align:middle; text-align:center;">
									<select name="FilterPencarianSKU[principle_id]" class="input-sm form-control select2" id="item-${idx}-${i}-SKUPromoDetail2-kategori_induk_id" onchange="GetKategoriByGroup(this.value,'${idx}','${i}')">
										<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
										<?php foreach ($KategoriGroup as $row) : ?>
											<option value="<?= $row['kategori_grup'] ?>" ${v.kategori_id == '<?= $row['kategori_grup'] ?>' ? 'selected' : ''}><?= $row['kategori_grup'] ?></option>
										<?php endforeach; ?>
									</select>
								</td>
								<td style="vertical-align:middle; text-align:center;">
									<select name="FilterPencarianSKU[principle_id]" class="input-sm form-control select2" id="item-${idx}-${i}-SKUPromoDetail2-kategori_id" onChange="UpdateSKUDetailPromo2('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',this.value,'0')">
										<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
										<?php foreach ($Kategori as $row) : ?>
											<option value="<?= $row['kategori_id'] ?>" ${v.kategori_id == '<?= $row['kategori_id'] ?>' ? 'selected' : ''}><?= $row['kategori_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</td>
								<td style="vertical-align:middle; text-align:center;display:none;">
									<span id="item-${i}-SKUPromoDetail2-qty">0</span>
								</td>
								<td style="vertical-align:middle; text-align:center;">
									<button class="btn btn-primary btn-small btn_atur_bonus_${idx}" id="item-${i}-SKUPromoDetail2-atur_bonus" onclick="AturBonus('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${idx}','${i}')" ${ checked_bonus > 0 ? '' : 'disabled' }><i class="fa fa-pencil"></i></button>
								</td>
								<td style="vertical-align:middle; text-align:center;">
									<button class="btn btn-primary btn-small btn_atur_diskon_${idx}" id="item-${i}-SKUPromoDetail2-atur_diskon" onclick="AturDiskon('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${idx}','${i}')" ${ checked_diskon > 0 ? '' : 'disabled' }><i class="fa fa-pencil"></i></button>
								</td>
								<td style="vertical-align:middle; text-align:center;">
									<button class="btn btn-primary btn-small" id="item-${i}-SKUPromoDetail2-atur_pengecualian" onclick="AturPengecualian('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${idx}','${i}')"><i class="fa fa-pencil"></i></button>
								</td>
								<td style="vertical-align:middle; text-align:center;">
									<button class="btn btn-danger btn-small" onclick="DeleteSKUPromoDetail2('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${i}')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>';
						`);
                            });

                            $(".select2").select2();
                        }
                    }
                });

            } else if (use_group == 0) {
                $("#modal-sku-detail1").modal('show');
                $('#table-product-promo-by-sku-' + idx + ' > tbody').empty();
                $("#FilterPencarianSKUDetail1-index").val(idx);
                $("#FilterPencarianSKUDetail1-checked_bonus").val(checked_bonus);
                $("#FilterPencarianSKUDetail1-checked_diskon").val(checked_diskon);

                $("#FilterPencarianSKUDetail1-principle_id").html('');

                <?php foreach ($Principle as $row) : ?>
                    $("#FilterPencarianSKUDetail1-principle_id").append(`<option value="<?= $row['principle_id'] ?>" ${ principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>`);
                <?php endforeach; ?>

            }

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHPRINCIPLE');
            message_custom("Error", "error", msg);

        }

    }

    function GetKategoriByGroup(group, idx, idx2) {
        // alert(idx)
        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetKategoriByGroup') ?>",
            data: {
                group: group
            },
            dataType: "JSON",
            success: function(response) {
                $("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").html('');

                $("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
                $.each(response, function(i, v) {
                    $("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").append(`<option value="${v.kategori_id}">${v.kategori_nama}</option>`);
                });
            }
        });
    }

    function DeletePromoDetail(idx) {

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_detail_temp') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + idx).val()
            },
            dataType: "JSON",
            success: function(response) {
                console.log("delete_sku_promo_detail_temp success");
                GetPromoDetail();
            }
        });

    }

    function GetPromoDetail() {
        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail1_temp') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val()
            },
            dataType: "JSON",
            success: function(response) {
                $('#span_promo_detail').html('');

                $.each(response, function(i, v) {

                    if (v.sku_promo_detail1_use_groupsku == 1) {
                        $('#span_promo_detail').append(`
							<div class="row" id="panel-promo-detail-${i}">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="x_panel">
										<div class="x_title">
											<h4 class="pull-left" name="CAPTION-SKUDKIRIM">Table Input Harga #${v.sku_promo_detail1_nourut}</h4>
											<input type="hidden" id="SKUPromoDetail-sku_promo_detail1_nourut_${i}" value="${v.sku_promo_detail1_nourut}">
											<div class="clearfix"></div>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group field-SKUPromoDetail-principle_id">
													<label class="control-label" for="SKUPromoDetail-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
													<select name="SKUPromoDetail[principle_id_${i}]" class="form-control select2" id="SKUPromoDetail-principle_id_${i}" onChange="UpdateSKUDetailPromo1('${i}')">
														<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
														<?php foreach ($Principle as $row) : ?>
															<option value="<?= $row['principle_id'] ?>" ${v.principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group field-SKUPromoDetail-sku_group_filter">
													<label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
													<select name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
														<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
														<option value="1" ${v.sku_promo_detail1_use_groupsku == '1'?'selected':''}>Ya</option>
														<option value="0" ${v.sku_promo_detail1_use_groupsku == '0'?'selected':''}>Tidak</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group field-SKUPromoDetail-sku_group_filter">
													<label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU"> </label><br>
													<input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_${i}" value="${v.sku_promo_detail1_id}">
													<button class="btn btn-primary" onclick="AddSKUPromoDetail2('${i}')"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHPROMODETAIL">Tambah Promo Detail</span></button>
												</div>
											</div>
										</div><br>
										<div class="row">
											<div class="col-xs-4">
												<table class="table table-bordered" id="table-syarat-item-${i}" style="width:100%;height: 250px;">
													<thead>
														<tr>
															<th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-SYARATITEMS">Syarat Items</span></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td colspan="2">
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_qty_order == '1'?'checked':''}> Dasar Jumlah Qty Order
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_value_order == '1'?'checked':''}> Dasar Jumlah Value Order
															</td>
														</tr>
														<tr>
															<td colspan="2">
																Min Order Product : 
																<select class="form-control" name="SKUPromoDetail[sku_promo_detail1_min_order_sku_${i}]" id="SKUPromoDetail-sku_promo_detail1_min_order_sku_${i}" style="width:20%;" onChange="UpdateSKUDetailPromo1('${i}')">
																	<option value="1" ${v.sku_promo_detail1_min_order_sku == '1'?'selected':''}>1</option>
																	<option value="0" ${v.sku_promo_detail1_min_order_sku == '1'?'selected':''}>0</option>
																</select>
															</td>
														</tr>
														<tr>
															<td>
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_bonus_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_bonus_${i}" value="1" onClick="SetPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus == '1'?'checked':''}> Bonus
															</td>
															<td>
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_diskon_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_diskon_${i}" value="1" onClick="SetPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon == '1'?'checked':''}> Diskon
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="col-xs-8">
												<table class="table table-bordered" id="table-product-promo-${i}" style="width:100%;height: 250px;">
													<thead>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
															<th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="3"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
														</tr>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPSKU">Group SKU</span></th>
															<th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPNAMA">Group Nama</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PENGECUALIAN">Pengecualian</span></th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
												<table class="table table-bordered" id="table-product-promo-by-sku-${i}" style="width:100%;height: 250px;display:none;">
													<thead>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="4"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
															<th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
														</tr>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKODE">Kode SKU</span></th>
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKU">SKU</span></th>
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
										</div>
										<div class="row" style="float: right">
											<input type="hidden" id="promo_detail_index" value="0">
											<button class="btn btn-primary" id="btn_atur_bonus_semua_sku_group_${i}" onclick="ViewModalPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus == '1'?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Bonus Semua Group SKU</span></button>
											<button class="btn btn-primary" id="btn_atur_diskon_semua_sku_group_${i}" onclick="ViewModalPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon == '1'?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Diskon Semua Group SKU</span></button>
											<button class="btn btn-danger" id="btn_delete_promo_detail_${i}" onclick="DeletePromoDetail('${i}')"><i class="fa fa-trash"></i> <span name="CAPTION-HAPUSPROMODETAIL">Hapus Promo Detail</span></button>
										</div>
									</div>
								</div>
							</div>
						`);
                    } else if (v.sku_promo_detail1_use_groupsku == 0) {
                        $('#span_promo_detail').append(`
							<div class="row" id="panel-promo-detail-${i}">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="x_panel">
										<div class="x_title">
											<h4 class="pull-left" name="CAPTION-SKUDKIRIM">Table Input Harga #${v.sku_promo_detail1_nourut}</h4>
											<input type="hidden" id="SKUPromoDetail-sku_promo_detail1_nourut_${i}" value="${v.sku_promo_detail1_nourut}">
											<div class="clearfix"></div>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group field-SKUPromoDetail-principle_id">
													<label class="control-label" for="SKUPromoDetail-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
													<select name="SKUPromoDetail[principle_id_${i}]" class="form-control select2" id="SKUPromoDetail-principle_id_${i}" onChange="UpdateSKUDetailPromo1('${i}')">
														<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
														<?php foreach ($Principle as $row) : ?>
															<option value="<?= $row['principle_id'] ?>" ${v.principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group field-SKUPromoDetail-sku_group_filter">
													<label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
													<select name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
														<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
														<option value="1" ${v.sku_promo_detail1_use_groupsku == '1'?'selected':''}>Ya</option>
														<option value="0" ${v.sku_promo_detail1_use_groupsku == '0'?'selected':''}>Tidak</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group field-SKUPromoDetail-sku_group_filter">
													<label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU"> </label><br>
													<input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_${i}" value="${v.sku_promo_detail1_id}">
													<button class="btn btn-primary" onclick="AddSKUPromoDetail2('${i}')"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHPROMODETAIL">Tambah Promo Detail</span></button>
												</div>
											</div>
										</div><br>
										<div class="row">
											<div class="col-xs-4">
												<table class="table table-bordered" id="table-syarat-item-${i}" style="width:100%;height: 250px;">
													<thead>
														<tr>
															<th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-SYARATITEMS">Syarat Items</span></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td colspan="2">
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_qty_order == '1'?'checked':''}> Dasar Jumlah Qty Order
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_value_order == '1'?'checked':''}> Dasar Jumlah Value Order
															</td>
														</tr>
														<tr>
															<td colspan="2">
																Min Order Product : 
																<select class="form-control" name="SKUPromoDetail[sku_promo_detail1_min_order_sku_${i}]" id="SKUPromoDetail-sku_promo_detail1_min_order_sku_${i}" style="width:20%;" onChange="UpdateSKUDetailPromo1('${i}')">
																	<option value="1" ${v.sku_promo_detail1_min_order_sku == '1'?'selected':''}>1</option>
																	<option value="0" ${v.sku_promo_detail1_min_order_sku == '1'?'selected':''}>0</option>
																</select>
															</td>
														</tr>
														<tr>
															<td>
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_bonus_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_bonus_${i}" value="1" onClick="SetPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus == '1'?'checked':''}> Bonus
															</td>
															<td>
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_diskon_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_diskon_${i}" value="1" onClick="SetPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon == '1'?'checked':''}> Diskon
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="col-xs-8">
												<table class="table table-bordered" id="table-product-promo-${i}" style="width:100%;height: 250px;display:none;">
													<thead>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
															<th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="3"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
														</tr>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPSKU">Group SKU</span></th>
															<th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPNAMA">Group Nama</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PENGECUALIAN">Pengecualian</span></th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
												<table class="table table-bordered" id="table-product-promo-by-sku-${i}" style="width:100%;height: 250px;">
													<thead>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="4"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
															<th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
														</tr>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKODE">Kode SKU</span></th>
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKU">SKU</span></th>
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
										</div>
										<div class="row" style="float: right">
											<input type="hidden" id="promo_detail_index" value="0">
											<button class="btn btn-primary" id="btn_atur_bonus_semua_sku_group_${i}" onclick="ViewModalPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus == '1'?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Bonus Semua Group SKU</span></button>
											<button class="btn btn-primary" id="btn_atur_diskon_semua_sku_group_${i}" onclick="ViewModalPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon == '1'?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Diskon Semua Group SKU</span></button>
											<button class="btn btn-danger" id="btn_delete_promo_detail_${i}" onclick="DeletePromoDetail('${i}')"><i class="fa fa-trash"></i> <span name="CAPTION-HAPUSPROMODETAIL">Hapus Promo Detail</span></button>
										</div>
									</div>
								</div>
							</div>
						`);

                    } else {
                        $('#span_promo_detail').append(`
							<div class="row" id="panel-promo-detail-${i}">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="x_panel">
										<div class="x_title">
											<h4 class="pull-left" name="CAPTION-SKUDKIRIM">Table Input Harga #${v.sku_promo_detail1_nourut}</h4>
											<input type="hidden" id="SKUPromoDetail-sku_promo_detail1_nourut_${i}" value="${v.sku_promo_detail1_nourut}">
											<div class="clearfix"></div>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group field-SKUPromoDetail-principle_id">
													<label class="control-label" for="SKUPromoDetail-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
													<select name="SKUPromoDetail[principle_id_${i}]" class="form-control select2" id="SKUPromoDetail-principle_id_${i}" onChange="UpdateSKUDetailPromo1('${i}')">
														<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
														<?php foreach ($Principle as $row) : ?>
															<option value="<?= $row['principle_id'] ?>" ${v.principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group field-SKUPromoDetail-sku_group_filter">
													<label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
													<select name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
														<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
														<option value="1" ${v.sku_promo_detail1_use_groupsku == '1'?'selected':''}>Ya</option>
														<option value="0" ${v.sku_promo_detail1_use_groupsku == '0'?'selected':''}>Tidak</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<div class="form-group field-SKUPromoDetail-sku_group_filter">
													<label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU"> </label><br>
													<input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_${i}" value="${v.sku_promo_detail1_id}">
													<button class="btn btn-primary" onclick="AddSKUPromoDetail2('${i}')"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHPROMODETAIL">Tambah Promo Detail</span></button>
												</div>
											</div>
										</div><br>
										<div class="row">
											<div class="col-xs-4">
												<table class="table table-bordered" id="table-syarat-item-${i}" style="width:100%;height: 250px;">
													<thead>
														<tr>
															<th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-SYARATITEMS">Syarat Items</span></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td colspan="2">
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')"> Dasar Jumlah Qty Order
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')"> Dasar Jumlah Value Order
															</td>
														</tr>
														<tr>
															<td colspan="2">
																Min Order Product : 
																<select class="form-control" name="SKUPromoDetail[sku_promo_detail1_min_order_sku_${i}]" id="SKUPromoDetail-sku_promo_detail1_min_order_sku_${i}" style="width:20%;" onChange="UpdateSKUDetailPromo1('${i}')">
																	<option value="1">1</option>
																	<option value="0">0</option>
																</select>
															</td>
														</tr>
														<tr>
															<td>
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_bonus_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_bonus_${i}" value="1" onClick="SetPengaturanBonus('${i}')"> Bonus
															</td>
															<td>
																<input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_diskon_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_diskon_${i}" value="1" onClick="SetPengaturanDiskon('${i}')"> Diskon
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="col-xs-8">
												<table class="table table-bordered" id="table-product-promo-${i}" style="width:100%;height: 250px;display:none;">
													<thead>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
															<th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="3"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
														</tr>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPSKU">Group SKU</span></th>
															<th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPNAMA">Group Nama</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PENGECUALIAN">Pengecualian</span></th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
												<table class="table table-bordered" id="table-product-promo-by-sku-${i}" style="width:100%;height: 250px;display:none;">
													<thead>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="4"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
															<th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
															<th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
															<th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
														</tr>
														<tr style="height: 40px;">
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKODE">Kode SKU</span></th>
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKU">SKU</span></th>
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
															<th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
															<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
										</div>
										<div class="row" style="float: right">
											<input type="hidden" id="promo_detail_index" value="0">
											<button class="btn btn-primary" id="btn_atur_bonus_semua_sku_group_${i}" onclick="ViewModalPengaturanBonus('${i}')" disabled><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Bonus Semua Group SKU</span></button>
											<button class="btn btn-primary" id="btn_atur_diskon_semua_sku_group_${i}" onclick="ViewModalPengaturanDiskon('${i}')" disabled><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Diskon Semua Group SKU</span></button>
											<button class="btn btn-danger" id="btn_delete_promo_detail_${i}" onclick="DeletePromoDetail('${i}')"><i class="fa fa-trash"></i> <span name="CAPTION-HAPUSPROMODETAIL">Hapus Promo Detail</span></button>
										</div>
									</div>
								</div>
							</div>
						`);
                    }

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_temp') ?>",
                        data: {
                            sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                            sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + i).val()
                        },
                        dataType: "JSON",
                        success: function(response) {
                            $('#table-product-promo-' + i + ' > tbody').empty();

                            // if ($.fn.DataTable.isDataTable('#table-sku')) {
                            // $('#table-product-promo-' + i).DataTable().clear();
                            // $('#table-product-promo-' + i).DataTable().destroy();
                            // }

                            // console.log(v.sku_promo_detail1_use_groupsku);

                            if (response.length > 0) {
                                if (v.sku_promo_detail1_use_groupsku == 1) {

                                    $.each(response, function(idx, val) {
                                        $('#table-product-promo-' + i + ' > tbody').append(`
										    <tr id="row-${idx}">
                                                <td style="vertical-align:middle; text-align:center;">
                                                    ${idx+1}
                                                    <input type="hidden" id="item-${idx}-SKUPromoDetail2-sku_promo_detail2_id" value="${val.sku_promo_detail2_id}">
                                                </td>
                                                <td style="vertical-align:middle; text-align:center;">
                                                    <select name="FilterPencarianSKU[principle_id]" class="input-sm form-control select2" id="item-${i}-${idx}-SKUPromoDetail2-kategori_induk_id" onchange="GetKategoriByGroup(this.value,'${i}','${idx}')">
                                                        <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                        <?php foreach ($KategoriGroup as $row) : ?>
                                                            <option value="<?= $row['kategori_grup'] ?>" ${val.kategori_id == '<?= $row['kategori_grup'] ?>' ? 'selected' : ''}><?= $row['kategori_grup'] ?></option>
                                                        <?php endforeach; ?>		
                                                    </select>
                                                </td>
												<td style="vertical-align:middle; text-align:center;">
													<select name="FilterPencarianSKU[principle_id]" class="input-sm form-control select2" id="item-${i}-${idx}-SKUPromoDetail2-kategori_id" onChange="UpdateSKUDetailPromo2('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}',this.value,'0')">
														<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
														<?php foreach ($Kategori as $row) : ?>
															<option value="<?= $row['kategori_id'] ?>" ${val.kategori_id=='<?= $row['kategori_id'] ?>' ? 'selected' : '' }><?= $row['kategori_nama'] ?></option>
														<?php endforeach; ?>
													</select>
												</td>
												<td style="vertical-align:middle; text-align:center;display:none;">
													<span id="item-${idx}-SKUPromoDetail2-qty">0</span>
												</td>
												<td style="vertical-align:middle; text-align:center;">
													<button class="btn btn-primary btn-small btn_atur_bonus_${i}" id="item-${idx}-SKUPromoDetail2-atur_bonus" onclick="AturBonus('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}')" ${$('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + i + '"]:checked').length > 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
												</td>
												<td style="vertical-align:middle; text-align:center;">
													<button class="btn btn-primary btn-small btn_atur_diskon_${i}" id="item-${idx}-SKUPromoDetail2-atur_diskon" onclick="AturDiskon('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}')" ${$('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + i + '"]:checked').length > 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
												</td>
												<td style="vertical-align:middle; text-align:center;">
													<button class="btn btn-primary btn-small" id="item-${idx}-SKUPromoDetail2-atur_pengecualian" onclick="AturPengecualian('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}')"><i class="fa fa-pencil"></i></button>
												</td>
												<td style="vertical-align:middle; text-align:center;">
													<button class="btn btn-danger btn-small" onclick="DeleteSKUPromoDetail2('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${idx}')"><i class="fa fa-trash"></i></button>
												</td>
											</tr>';
										`);
                                    });
                                } else if (v.sku_promo_detail1_use_groupsku == 0) {
                                    $.each(response, function(idx, val) {
                                        $('#table-product-promo-by-sku-' + i + ' > tbody').append(`
											<tr id="row-${idx}">
												<td style="vertical-align:middle; text-align:center;">
													${idx+1}
													<input type="hidden" id="" value="item-${idx}-SKUPromoDetail2-sku_promo_detail2_id" value="${val.sku_promo_detail2_id}">
												</td>
												<td style="vertical-align:middle; text-align:center;">
													${val.sku_kode}
												</td>
												<td style="vertical-align:middle; text-align:center;">
													${val.sku_nama_produk}
												</td>
												<td style="vertical-align:middle; text-align:center;">
													${val.sku_kemasan}
												</td>
												<td style="vertical-align:middle; text-align:center;">
													${val.sku_satuan}
												</td>
												<td style="vertical-align:middle; text-align:center;display:none;">
													<span id="item-${idx}-SKUPromoDetail2-qty">0</span>
												</td>
												<td style="vertical-align:middle; text-align:center;">
													<button class="btn btn-primary btn-small btn_atur_bonus_${idx}" id="item-${idx}-SKUPromoDetail2-atur_bonus" onclick="AturBonusBySKU('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}','${val.sku_id}','${val.sku_kode}','${val.sku_nama_produk}','${val.sku_kemasan}','${val.sku_satuan}')" ${$('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + i + '"]:checked').length > 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
												</td>
												<td style="vertical-align:middle; text-align:center;">
													<button class="btn btn-primary btn-small btn_atur_diskon_${idx}" id="item-${idx}-SKUPromoDetail2-atur_diskon" onclick="AturDiskonBySKU('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}','${val.sku_id}','${val.sku_kode}','${val.sku_nama_produk}','${val.sku_kemasan}','${val.sku_satuan}')" ${$('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + i + '"]:checked').length > 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
												</td>
												<td style="vertical-align:middle; text-align:center;">
													<button class="btn btn-danger btn-small" onclick="DeleteSKUPromoDetail2('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${idx}')"><i class="fa fa-trash"></i></button>
												</td>
											</tr>';
										`);
                                    });
                                }
                            }
                        }
                    });
                });

                $(".select2").select2();
            }
        });
    }

    function DeleteSKUPromoDetail2(sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, idx) {
        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_detail2_temp_by_id') ?>",
            data: {
                sku_promo_id: sku_promo_id,
                sku_promo_detail1_id: sku_promo_detail1_id,
                sku_promo_detail2_id: sku_promo_detail2_id
            },
            dataType: "JSON",
            success: function(response) {
                console.log("delete_sku_promo_detail2_temp_by_id success");
                GetPromoDetail();
            }
        });
    }

    function SetPengaturanBonus(idx) {
        var checked = $('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + idx + '"]:checked').length;
        var sku_promo_id = $('#SKUPromo-sku_promo_id').val();
        var sku_promo_detail1_id = $('#SKUPromoDetail-sku_promo_detail1_id_' + idx).val();

        if (checked > 0) {
            $("#btn_atur_bonus_semua_sku_group_" + idx).prop("disabled", false);
            $(".btn_atur_bonus_" + idx).prop("disabled", false);
        } else {
            $("#btn_atur_bonus_semua_sku_group_" + idx).prop("disabled", true);
            $(".btn_atur_bonus_" + idx).prop("disabled", true);

            $.ajax({
                async: false,
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_detail2_temp') ?>",
                data: {
                    sku_promo_id: sku_promo_id,
                    sku_promo_detail1_id: sku_promo_detail1_id
                },
                dataType: "JSON",
                success: function(response) {
                    console.log("delete_sku_promo_detail2_temp success");
                }
            });
        }

        UpdateSKUDetailPromo1(idx);
    }

    function SetPengaturanDiskon(idx) {
        var checked = $('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + idx + '"]:checked').length;
        var sku_promo_id = $('#SKUPromo-sku_promo_id').val();
        var sku_promo_detail1_id = $('#SKUPromoDetail-sku_promo_detail1_id_' + idx).val();

        if (checked > 0) {
            $("#btn_atur_diskon_semua_sku_group_" + idx).prop("disabled", false);
            $(".btn_atur_diskon_" + idx).prop("disabled", false);
        } else {
            $("#btn_atur_diskon_semua_sku_group_" + idx).prop("disabled", true);
            $(".btn_atur_diskon_" + idx).prop("disabled", true);

            $.ajax({
                async: false,
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_detail2_temp') ?>",
                data: {
                    sku_promo_id: sku_promo_id,
                    sku_promo_detail1_id: sku_promo_detail1_id
                },
                dataType: "JSON",
                success: function(response) {
                    console.log("delete_sku_promo_detail2_temp success");
                }
            });
        }

        UpdateSKUDetailPromo1(idx);
    }

    function UpdateSKUPromoDetail2BonusDetail(sku_promo_detail2_bonus2_id, sku_promo_detail2_bonus_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, sku_id, idx, type) {

        arr_sku_promo_detail2_bonus_detail = [];

        if (type == "all") {
            arr_sku_promo_detail2_bonus_detail.push({
                'sku_promo_detail2_bonus2_id': sku_promo_detail2_bonus2_id,
                'sku_promo_detail2_bonus_id': sku_promo_detail2_bonus_id,
                'sku_promo_detail2_id': sku_promo_detail2_id,
                'sku_promo_detail1_id': sku_promo_detail1_id,
                'sku_promo_id': sku_promo_id,
                'sku_id': sku_id,
                'sku_qty_bonus': $("#item-" + idx + "-SKUPromoDetail2BonusDetail-sku_qty_bonus").val(),
                'sku_tipe_id': $("#item-" + idx + "-SKUPromoDetail2BonusDetail-sku_tipe_id").val(),
                'referensi_diskon_id': $("#item-" + idx + "-SKUPromoDetail2BonusDetail-referensi_diskon_id").val()
            });
        } else if (type == "by_one") {

            arr_sku_promo_detail2_bonus_detail.push({
                'sku_promo_detail2_bonus2_id': sku_promo_detail2_bonus2_id,
                'sku_promo_detail2_bonus_id': sku_promo_detail2_bonus_id,
                'sku_promo_detail2_id': sku_promo_detail2_id,
                'sku_promo_detail1_id': sku_promo_detail1_id,
                'sku_promo_id': sku_promo_id,
                'sku_id': sku_id,
                'sku_qty_bonus': $("#item-" + idx + "-SKUPromoDetail2BonusDetail-sku_qty_bonus_by_one").val(),
                'sku_tipe_id': $("#item-" + idx + "-SKUPromoDetail2BonusDetail-sku_tipe_id_by_one").val(),
                'referensi_diskon_id': $("#item-" + idx + "-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_one").val()
            });

        } else if (type == "by_sku") {

            arr_sku_promo_detail2_bonus_detail.push({
                'sku_promo_detail2_bonus2_id': sku_promo_detail2_bonus2_id,
                'sku_promo_detail2_bonus_id': sku_promo_detail2_bonus_id,
                'sku_promo_detail2_id': sku_promo_detail2_id,
                'sku_promo_detail1_id': sku_promo_detail1_id,
                'sku_promo_id': sku_promo_id,
                'sku_id': sku_id,
                'sku_qty_bonus': $("#item-" + idx + "-SKUPromoDetail2BonusDetail-sku_qty_bonus_by_sku").val(),
                'sku_tipe_id': $("#item-" + idx + "-SKUPromoDetail2BonusDetail-sku_tipe_id_by_sku").val(),
                'referensi_diskon_id': $("#item-" + idx + "-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_sku").val()
            });

        }

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/update_sku_promo_detail2_bonus_detail_temp') ?>",
            data: {
                arr_detail: arr_sku_promo_detail2_bonus_detail
            },
            dataType: "JSON",
            success: function(response) {

                if (response == 1) {

                    console.log("update_sku_promo_detail2_bonus_detail_temp berhasil");

                } else {
                    console.log("update_sku_promo_detail2_bonus_detail_temp gagal");

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log("update_sku_promo_detail2_bonus_detail_temp gagal");
            }
        });

    }

    function UpdateSKUDetailPromo2(sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, kategori_id, qty) {
        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/update_sku_promo_detail2_temp') ?>",
            data: {
                sku_promo_detail2_id: sku_promo_detail2_id,
                sku_promo_detail1_id: sku_promo_detail1_id,
                sku_promo_id: sku_promo_id,
                kategori_id: kategori_id,
                qty: qty
            },
            dataType: "JSON",
            success: function(response) {

                if (response == 1) {

                    console.log("update_sku_promo_detail2_temp berhasil");

                } else {
                    console.log("update_sku_promo_detail2_temp gagal");

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log("update_sku_promo_detail2_temp gagal");
            }
        });
    }

    function UpdateSKUDetailPromo1(idx) {

        var sku_promo_detail1_id = $('#SKUPromoDetail-sku_promo_detail1_id_' + idx).val();
        var sku_promo_id = $('#SKUPromo-sku_promo_id').val();
        var principle_id = $('#SKUPromoDetail-principle_id_' + idx).val();
        var sku_promo_detail1_use_groupsku = $('#SKUPromoDetail-sku_promo_detail1_use_groupsku_' + idx).val();
        var sku_promo_detail1_jenis_groupsku = $('#SKUPromoDetail-sku_promo_detail1_use_groupsku_' + idx).val();
        var sku_promo_detail1_use_qty_order = $('[id="SKUPromoDetail-sku_promo_detail1_use_qty_order_' + idx + '"]:checked').length;
        var sku_promo_detail1_use_value_order = $('[id="SKUPromoDetail-sku_promo_detail1_use_value_order_' + idx + '"]:checked').length;
        var sku_promo_detail1_min_order_sku = $('#SKUPromoDetail-sku_promo_detail1_min_order_sku_' + idx).val();
        var sku_promo_detail1_use_bonus = $('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + idx + '"]:checked').length;
        var sku_promo_detail1_use_diskon = $('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + idx + '"]:checked').length;
        var sku_promo_detail1_nourut = $('#SKUPromoDetail-sku_promo_detail1_nourut_' + idx).val();

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/update_sku_promo_detail1_temp') ?>",
            data: {
                sku_promo_detail1_id: sku_promo_detail1_id,
                sku_promo_id: sku_promo_id,
                principle_id: principle_id,
                sku_promo_detail1_use_groupsku: sku_promo_detail1_use_groupsku,
                sku_promo_detail1_jenis_groupsku: sku_promo_detail1_jenis_groupsku,
                sku_promo_detail1_use_qty_order: sku_promo_detail1_use_qty_order,
                sku_promo_detail1_use_value_order: sku_promo_detail1_use_value_order,
                sku_promo_detail1_min_order_sku: sku_promo_detail1_min_order_sku,
                sku_promo_detail1_use_bonus: sku_promo_detail1_use_bonus,
                sku_promo_detail1_use_diskon: sku_promo_detail1_use_diskon,
                sku_promo_detail1_nourut: sku_promo_detail1_nourut
            },
            dataType: "JSON",
            success: function(response) {

                if (response == 1) {

                    console.log("update_sku_promo_detail2_temp berhasil");
                    // GetPromoDetail();

                } else {
                    console.log("update_sku_promo_detail2_temp gagal");

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log("update_sku_promo_detail2_temp gagal");
            }
        });
    }

    function DeleteSKUDetailPromo2(idx) {

        var sku_promo_detail1_id = $('#SKUPromoDetail-sku_promo_detail1_id_' + idx).val();
        var sku_promo_id = $('#SKUPromo-sku_promo_id').val();

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_detail2_temp') ?>",
            data: {
                sku_promo_id: sku_promo_id,
                sku_promo_detail1_id: sku_promo_detail1_id
            },
            dataType: "JSON",
            success: function(response) {
                console.log("delete_sku_promo_detail2_temp success");

                // if (response == 1) {

                // 	var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDIHAPUS');
                // 	message_topright("Success", "success", msg);

                // } else {
                // 	var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDIHAPUS');
                // 	message_topright("Error", "error", msg);

                // }
            }
        });
    }

    function UseGroupSKU(use, sku_promo_detail1_use_groupsku, idx) {

        Swal.fire({
            title: GetLanguageByKode('CAPTION-APAANDAYAKIN'),
            text: GetLanguageByKode('CAPTION-MENGGANTIGUNAKANGROUPSKU'),
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: GetLanguageByKode('CAPTION-LANJUT'),
            cancelButtonText: GetLanguageByKode('CAPTION-CLOSE')
        }).then((result) => {
            if (result.value == true) {

                if (use == 1) {
                    $("#table-product-promo-" + idx).show();
                    $("#table-product-promo-by-sku-" + idx).hide();
                } else if (use == 0) {
                    $("#table-product-promo-" + idx).hide();
                    $("#table-product-promo-by-sku-" + idx).show();
                } else {
                    $("#table-product-promo-" + idx).hide();
                    $("#table-product-promo-by-sku-" + idx).hide();
                }

                UpdateSKUDetailPromo1(idx);
                DeleteSKUDetailPromo2(idx);
            } else {
                if (sku_promo_detail1_use_groupsku == "null") {
                    $("#SKUPromoDetail-sku_promo_detail1_use_groupsku_" + idx).val('');
                } else {
                    $("#SKUPromoDetail-sku_promo_detail1_use_groupsku_" + idx).val(sku_promo_detail1_use_groupsku);
                }
            }
        });
    }

    function DeletePromoDetail2DiskonBySKU(sku_promo_detail2_diskon_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, idx) {
        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_detail2_diskon_temp') ?>",
            data: {
                sku_promo_detail2_diskon_id: sku_promo_detail2_diskon_id,
                sku_promo_detail2_id: sku_promo_detail2_id,
                sku_promo_detail1_id: sku_promo_detail1_id
            },
            dataType: "JSON",
            success: function(response) {
                console.log("delete_sku_promo_detail2_diskon_temp success");
                GetPromoDetail2Diskon();
            }
        });
    }

    function AturPengecualian(sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, idx, idx2) {
        $("#modal-sku-pengecualian").modal('show');

        var sku_group_id = $("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_induk_id").val();
        var sku_group_nama = $("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").val();
        var principle_id = $("#SKUPromoDetail-principle_id_" + idx).val();

        $("#FilterPencarianSKUPengecualian-index").val(idx);
        $("#FilterPencarianSKUPengecualian-sku_promo_detail2_id").val(sku_promo_detail2_id);
        $("#FilterPencarianSKUPengecualian-sku_promo_detail1_id").val(sku_promo_detail1_id);
        $("#FilterPencarianSKUPengecualian-sku_promo_id").val(sku_promo_id);
        $("#FilterPencarianSKUPengecualian-sku_group_id").val(sku_group_id);
        $("#FilterPencarianSKUPengecualian-sku_group_nama").val(sku_group_nama);

        $("#FilterPencarianSKUPengecualian-principle_id").html('');

        <?php foreach ($Principle as $row) : ?>
            $("#FilterPencarianSKUPengecualian-principle_id").append(`<option value="<?= $row['principle_id'] ?>" ${ principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>`);
        <?php endforeach; ?>
    }

    //end function group

    //start button group
    $("#btn_search_sku").click(function() {
        var principle_id = $("#Filter-principle_id").val();

        $("#modal-sku").modal('show');

        $("#FilterPencarianSKU-principle_id").html('');

        <?php foreach ($Principle as $row) : ?>
            $("#FilterPencarianSKU-principle_id").append(`<option value="<?= $row['principle_id'] ?>" ${ principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>`);
        <?php endforeach; ?>
    });

    $("#btn_search_sku_by_one").click(function() {
        var principle_id = $("#Filter-principle_id_by_one").val();

        $("#modal-sku").modal('show');

        $("#FilterPencarianSKU-principle_id").html('');
        <?php foreach ($Principle as $row) : ?>
            $("#FilterPencarianSKU-principle_id").append(`<option value="<?= $row['principle_id'] ?>" ${ principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>`);
        <?php endforeach; ?>
    });

    $("#btn_search_sku_by_sku").click(function() {
        var principle_id = $("#Filter-principle_id_by_sku").val();

        $("#modal-sku").modal('show');

        $("#FilterPencarianSKU-principle_id").html('');
        <?php foreach ($Principle as $row) : ?>
            $("#FilterPencarianSKU-principle_id").append(`<option value="<?= $row['principle_id'] ?>" ${ principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>`);
        <?php endforeach; ?>
    });

    $("#btn_tambah_promo_detail2").click(function() {

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_bonus_temp') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id").val()
            },
            dataType: "JSON",
            success: function(response) {
                console.log("insert_sku_promo_detail2_bonus_temp success");
            }
        });

        GetPromoDetail2Bonus();
    });

    function GetPromoDetail2Bonus() {
        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_bonus_temp') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id").val()
            },
            dataType: "JSON",
            success: function(response) {
                $('#table-pengaturan-header > tbody').empty();
                console.log(response);

                $.each(response, function(i, v) {
                    $('#table-pengaturan-header > tbody').append(`
						<tr>
							<td class="text-center">
								<input type="number" id="item-${i}-SKUPromoDetail2Bonus-sku_min_qty" class="form-control input-sm" value="${v.sku_min_qty}" />
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id" value="${v.sku_promo_detail2_bonus_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_id" value="${v.sku_promo_detail2_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail1_id" value="${v.sku_promo_detail1_id}">
							</td>
							<td class="text-center">
								<input type="checkbox" id="item-${i}-SKUPromoDetail2Bonus-is_berkelipatan" value="1" ${v.is_berkelipatan == '1' ? 'checked' : ''}/>
							</td>
							<td class="text-center">
								<button class="btn btn-primary btn-sm" onclick="ViewBonusDetail2('${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-pencil"></i></button>
								<button class="btn btn-danger btn-sm" onclick="DeletePromoDetail2Bonus('${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-trash"></i></button>
							</td>
						</tr>';
					`);
                });
            }
        });
    }

    $("#btn_tambah_promo_detail2_by_one").click(function() {

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_bonus_temp_by_one') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val(),
                sku_promo_detail2_id: $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val()
            },
            dataType: "JSON",
            success: function(response) {
                console.log("insert_sku_promo_detail2_bonus_temp_by_one success");
            }
        });

        GetPromoDetail2BonusByOne();
    });

    function GetPromoDetail2BonusByOne() {
        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_bonus_temp_by_one') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val(),
                sku_promo_detail2_id: $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val(),
            },
            dataType: "JSON",
            success: function(response) {
                $('#table-pengaturan-header-by-one > tbody').empty();

                $.each(response, function(i, v) {
                    $('#table-pengaturan-header-by-one > tbody').append(`
						<tr>
							<td class="text-center">
								<input type="number" id="item-${i}-SKUPromoDetail2Bonus-sku_min_qty_by_one" class="form-control input-sm" value="${v.sku_min_qty}" />
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one" value="${v.sku_promo_detail2_bonus_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one" value="${v.sku_promo_detail2_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one" value="${v.sku_promo_detail1_id}">
							</td>
							<td class="text-center">
								<input type="checkbox" id="item-${i}-SKUPromoDetail2Bonus-is_berkelipatan_by_one" value="1" ${v.is_berkelipatan == '1' ? 'checked' : ''}/>
							</td>
							<td class="text-center">
								<button class="btn btn-primary btn-sm" onclick="ViewBonusDetail2ByOne('${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-pencil"></i></button>
								<button class="btn btn-danger btn-sm" onclick="DeletePromoDetail2BonusByOne('${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-trash"></i></button>
							</td>
						</tr>';
					`);
                });
            }
        });
    }

    $("#btn_tambah_promo_detail2_by_sku").click(function() {

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_bonus_temp_by_one') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_by_sku").val(),
                sku_promo_detail2_id: $("#SKUPromoDetail-sku_promo_detail2_id_by_sku").val()
            },
            dataType: "JSON",
            success: function(response) {
                console.log("insert_sku_promo_detail2_bonus_temp_by_sku success");
            }
        });

        GetPromoDetail2BonusBySKU();
    });

    function GetPromoDetail2BonusBySKU() {
        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_bonus_temp_by_one') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_by_sku").val(),
                sku_promo_detail2_id: $("#SKUPromoDetail-sku_promo_detail2_id_by_sku").val(),
            },
            dataType: "JSON",
            success: function(response) {
                $('#table-pengaturan-header-by-sku > tbody').empty();

                $.each(response, function(i, v) {
                    $('#table-pengaturan-header-by-sku > tbody').append(`
						<tr>
							<td class="text-center">
								<input type="number" id="item-${i}-SKUPromoDetail2Bonus-sku_min_qty_by_sku" class="form-control input-sm" value="${v.sku_min_qty}" />
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_sku" value="${v.sku_promo_detail2_bonus_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_id_by_sku" value="${v.sku_promo_detail2_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail1_id_by_sku" value="${v.sku_promo_detail1_id}">
							</td>
							<td class="text-center">
								<input type="checkbox" id="item-${i}-SKUPromoDetail2Bonus-is_berkelipatan_by_sku" value="1" ${v.is_berkelipatan == '1' ? 'checked' : ''}/>
							</td>
							<td class="text-center">
								<button class="btn btn-primary btn-sm" onclick="ViewBonusDetail2BySKU('${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-pencil"></i></button>
								<button class="btn btn-danger btn-sm" onclick="DeletePromoDetail2BonusBySKU('${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-trash"></i></button>
							</td>
						</tr>';
					`);
                });
            }
        });
    }

    $("#btn_tambah_promo_detail2_diskon").click(function() {

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_diskon_temp_all_kategori') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id").val()
            },
            dataType: "JSON",
            success: function(response) {
                console.log("insert_sku_promo_detail2_bonus_temp success");
            }
        });

        GetPromoDetail2Diskon();
    });

    $("#btn_tambah_promo_detail2_diskon_by_one").click(function() {

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_diskon_temp') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val(),
                sku_promo_detail2_id: $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val(),
            },
            dataType: "JSON",
            success: function(response) {
                console.log("insert_sku_promo_detail2_diskon_temp success");
            }
        });

        GetPromoDetail2Diskon();
    });

    $("#btn_tambah_promo_detail2_diskon_by_sku").click(function() {

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_diskon_temp') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_by_sku").val(),
                sku_promo_detail2_id: $("#SKUPromoDetail-sku_promo_detail2_id_by_sku").val(),
            },
            dataType: "JSON",
            success: function(response) {
                console.log("insert_sku_promo_detail2_diskon_temp success");
            }
        });

        GetPromoDetail2Diskon();
    });

    function GetPromoDetail2Diskon() {
        var check_pilihan = $("#SKUPromoDetail2Diskon-check_pilihan").val();

        if (check_pilihan == "all") {

            $.ajax({
                async: false,
                type: 'GET',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_diskon_temp_all_kategori') ?>",
                data: {
                    sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                    sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id").val()
                },
                dataType: "JSON",
                success: function(response) {
                    $('#table-pengaturan-diskon > tbody').empty();

                    $.each(response, function(i, v) {
                        $('#table-pengaturan-diskon > tbody').append(`
						<tr>
							<td class="text-center">${v.sku_promo_detail2_diskon_nourut}</td>
							<td class="text-center">
								<input type="number" id="item-${i}-SKUPromoDetail2Diskon-sku_qty_diskon" class="form-control input-sm" value="${v.sku_qty_diskon}" />
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_id" value="${v.sku_promo_detail2_diskon_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail2_id" value="${v.sku_promo_detail2_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail1_id" value="${v.sku_promo_detail1_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_nourut" value="${v.sku_promo_detail2_diskon_nourut}">
							</td>
							<td class="text-center">
								<select id="item-${i}-SKUPromoDetail2Diskon-tipe_diskon_id" class="form-control input-sm">
									<option value="">**Pilih**</option>
								</select>
							</td>
							<td class="text-center">
								<input type="number" id="item-${i}-SKUPromoDetail2Diskon-value_diskon" class="form-control input-sm" value="${v.value_diskon}" />
							</td>
							<td class="text-center">
								<select id="item-${i}-SKUPromoDetail2Diskon-referensi_diskon_id" class="form-control input-sm">
									<option value="">**Pilih**</option>
								</select>
							</td>
							<td class="text-center">
								<input type="checkbox" id="item-${i}-SKUPromoDetail2Diskon-is_hitung_diskon" value="1" ${v.is_hitung_diskon=='1' ? 'checked' : ''}>
							</td>
							<td class="text-center">
								<button class="btn btn-danger btn-sm" onclick="DeletePromoDetail2DiskonBySKU('${v.sku_promo_detail2_diskon_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-trash"></i></button>
							</td>
						</tr>';
					`);
                    });
                }
            });

        } else if (check_pilihan == "by_one") {

            $.ajax({
                async: false,
                type: 'GET',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_diskon_temp') ?>",
                data: {
                    sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                    sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val(),
                    sku_promo_detail2_id: $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val(),
                },
                dataType: "JSON",
                success: function(response) {
                    $('#table-pengaturan-diskon-by-one > tbody').empty();

                    $.each(response, function(i, v) {
                        $('#table-pengaturan-diskon-by-one > tbody').append(`
						<tr>
							<td class="text-center">${v.sku_promo_detail2_diskon_nourut}</td>
							<td class="text-center">
								<input type="number" id="item-${i}-SKUPromoDetail2Diskon-sku_qty_diskon_by_one" class="form-control input-sm" value="${v.sku_qty_diskon}" />
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_id_by_one" value="${v.sku_promo_detail2_diskon_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail2_id_by_one" value="${v.sku_promo_detail2_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail1_id_by_one" value="${v.sku_promo_detail1_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_nourut_by_one" value="${v.sku_promo_detail2_diskon_nourut}">
							</td>
							<td class="text-center">
								<select id="item-${i}-SKUPromoDetail2Diskon-tipe_diskon_id_by_one" class="form-control input-sm">
									<option value="">**Pilih**</option>
								</select>
							</td>
							<td class="text-center">
								<input type="number" id="item-${i}-SKUPromoDetail2Diskon-value_diskon_by_one" class="form-control input-sm" value="${v.value_diskon}" />
							</td>
							<td class="text-center">
								<select id="item-${i}-SKUPromoDetail2Diskon-referensi_diskon_id_by_one" class="form-control input-sm">
									<option value="">**Pilih**</option>
								</select>
							</td>
							<td class="text-center">
								<input type="checkbox" id="item-${i}-SKUPromoDetail2Diskon-is_hitung_diskon_by_one" value="1" ${v.is_hitung_diskon=='1' ? 'checked' : ''}>
							</td>
							<td class="text-center">
								<button class="btn btn-danger btn-sm" onclick="DeletePromoDetail2DiskonBySKU('${v.sku_promo_detail2_diskon_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-trash"></i></button>
							</td>
						</tr>';
					`);
                    });
                }
            });

        } else if (check_pilihan == "by_sku") {

            $.ajax({
                async: false,
                type: 'GET',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_diskon_temp') ?>",
                data: {
                    sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                    sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_by_sku").val(),
                    sku_promo_detail2_id: $("#SKUPromoDetail-sku_promo_detail2_id_by_sku").val(),
                },
                dataType: "JSON",
                success: function(response) {
                    $('#table-pengaturan-diskon-by-sku > tbody').empty();

                    $.each(response, function(i, v) {
                        $('#table-pengaturan-diskon-by-sku > tbody').append(`
						<tr>
							<td class="text-center">${v.sku_promo_detail2_diskon_nourut}</td>
							<td class="text-center">
								<input type="number" id="item-${i}-SKUPromoDetail2Diskon-sku_qty_diskon_by_sku" class="form-control input-sm" value="${v.sku_qty_diskon}" />
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_id_by_sku" value="${v.sku_promo_detail2_diskon_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail2_id_by_sku" value="${v.sku_promo_detail2_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail1_id_by_sku" value="${v.sku_promo_detail1_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_nourut_by_sku" value="${v.sku_promo_detail2_diskon_nourut}">
							</td>
							<td class="text-center">
								<select id="item-${i}-SKUPromoDetail2Diskon-tipe_diskon_id_by_sku" class="form-control input-sm">
									<option value="">**Pilih**</option>
								</select>
							</td>
							<td class="text-center">
								<input type="number" id="item-${i}-SKUPromoDetail2Diskon-value_diskon_by_sku" class="form-control input-sm" value="${v.value_diskon}" />
							</td>
							<td class="text-center">
								<select id="item-${i}-SKUPromoDetail2Diskon-referensi_diskon_id_by_sku" class="form-control input-sm">
									<option value="">**Pilih**</option>
								</select>
							</td>
							<td class="text-center">
								<input type="checkbox" id="item-${i}-SKUPromoDetail2Diskon-is_hitung_diskon_by_sku" value="1" ${v.is_hitung_diskon=='1' ? 'checked' : ''}>
							</td>
							<td class="text-center">
								<button class="btn btn-danger btn-sm" onclick="DeletePromoDetail2DiskonBySKU('${v.sku_promo_detail2_diskon_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-trash"></i></button>
							</td>
						</tr>';
					`);
                    });
                }
            });
        }
    }

    $(document).on("click", ".btn-choose-sku-multi", function() {
        var jumlah = $('input[name="CheckboxSKU"]').length;
        var numberOfChecked = $('input[name="CheckboxSKU"]:checked').length;
        var no = 1;
        var check_pilihan = $("#SKUPromoDetail2Bonus-check_pilihan").val();

        jumlah_sku = numberOfChecked;

        arr_sku = [];

        if (numberOfChecked > 0) {
            $("#modal-sku").modal('hide');

            for (var i = 0; i < jumlah; i++) {
                var checked = $('[id="check-sku-' + i + '"]:checked').length;
                var sku_id = "'" + $("#check-sku-" + i).val() + "'";

                if (checked > 0) {
                    arr_sku.push(sku_id);
                }
            }

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetSelectedSKU') ?>",
                data: {
                    sku_id: arr_sku
                },
                dataType: "JSON",
                success: function(response) {

                    if (check_pilihan == "all") {

                        $.each(response, function(i, v) {
                            $.ajax({
                                async: false,
                                type: 'POST',
                                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_bonus_detail_temp') ?>",
                                data: {
                                    sku_promo_detail2_bonus_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id").val(),
                                    sku_promo_detail2_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_id").val(),
                                    sku_promo_detail1_id: $("#SKUPromoDetail2Bonus-sku_promo_detail1_id").val(),
                                    sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val(),
                                    sku_id: v.sku_id
                                },
                                dataType: "JSON",
                                success: function(response) {
                                    console.log("insert_sku_promo_detail2_bonus_detail_temp success");
                                }
                            });
                        });

                        pushToTablePengaturanDetail();

                    } else if (check_pilihan == "by_one") {
                        $.each(response, function(i, v) {
                            $.ajax({
                                async: false,
                                type: 'POST',
                                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_bonus_detail_temp') ?>",
                                data: {
                                    sku_promo_detail2_bonus_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one").val(),
                                    sku_promo_detail2_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one").val(),
                                    sku_promo_detail1_id: $("#SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one").val(),
                                    sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val(),
                                    sku_id: v.sku_id
                                },
                                dataType: "JSON",
                                success: function(response) {
                                    console.log("insert_sku_promo_detail2_bonus_detail_temp success");
                                }
                            });
                        });

                        pushToTablePengaturanDetail();
                    } else if (check_pilihan == "by_sku") {
                        $.each(response, function(i, v) {
                            $.ajax({
                                async: false,
                                type: 'POST',
                                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_bonus_detail_temp') ?>",
                                data: {
                                    sku_promo_detail2_bonus_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_sku").val(),
                                    sku_promo_detail2_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_id_by_sku").val(),
                                    sku_promo_detail1_id: $("#SKUPromoDetail2Bonus-sku_promo_detail1_id_by_sku").val(),
                                    sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val(),
                                    sku_id: v.sku_id
                                },
                                dataType: "JSON",
                                success: function(response) {
                                    console.log("insert_sku_promo_detail2_bonus_detail_temp success");
                                }
                            });
                        });

                        pushToTablePengaturanDetail();
                    }

                    // arr_pengaturan_detail.push({
                    // 	'client_wms_id': v.client_wms_id,
                    // 	'principle': v.principle,
                    // 	'brand': v.brand,
                    // 	'sku_id': v.sku_id,
                    // 	'sku_kode': v.sku_kode,
                    // 	'sku_nama_produk': v.sku_nama_produk,
                    // 	'sku_harga_satuan': v.sku_harga_jual,
                    // 	'sku_disc_percent': 0,
                    // 	'sku_disc_rp': 0,
                    // 	'sku_harga_nett': v.sku_harga_jual,
                    // 	'sku_weight': v.sku_weight,
                    // 	'sku_weight_unit': v.sku_weight_unit,
                    // 	'sku_length': v.sku_length,
                    // 	'sku_length_unit': v.sku_length_unit,
                    // 	'sku_width': v.sku_width,
                    // 	'sku_width_unit': v.sku_width_unit,
                    // 	'sku_height': v.sku_height,
                    // 	'sku_height_unit': v.sku_height_unit,
                    // 	'sku_volume': v.sku_volume,
                    // 	'sku_volume_unit': v.sku_volume_unit,
                    // 	'sku_qty': v.so_sku_qty,
                    // 	'sku_keterangan': "",
                    // 	'sku_satuan': v.sku_satuan,
                    // 	'sku_kemasan': v.sku_kemasan
                    // });
                }
            });

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHSKU');

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: msg
            });
        }
    });

    $("#btn_cari_sku").click(function() {
        var check_pilihan = $("#SKUPromoDetail2Bonus-check_pilihan").val();

        $("#loadingsku").show();
        $("#btn_cari_sku").prop('disabled', true);


        if (check_pilihan == "all") {

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/search_filter_chosen_sku') ?>",
                data: {
                    sku_kode_wms: $("#FilterPencarianSKU-kode_sku_wms").val(),
                    sku_kode_pabrik: $("#FilterPencarianSKU-kode_sku_pabrik").val(),
                    principle: $("#FilterPencarianSKU-principle_id").val(),
                    brand: $("#FilterPencarianSKU-brand_id").val(),
                    sku_induk: $("#FilterPencarianSKU-sku_induk").val(),
                    sku_nama_produk: $("#FilterPencarianSKU-sku_nama").val(),
                    sku_group_id: "",
                    sku_group_nama: ""
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response != 0) {
                        $("#loadingsku").hide();
                        $("#btn_cari_sku").prop('disabled', false);

                        $("#table-sku > tbody").empty();

                        if ($.fn.DataTable.isDataTable('#table-sku')) {
                            $('#table-sku').DataTable().clear();
                            $('#table-sku').DataTable().destroy();
                        }

                        if (response.length > 0) {
                            $.each(response, function(i, v) {
                                $('#table-sku > tbody').append(`
								<tr>
									<td width="5%" class="text-center">
										<input type="checkbox" name="CheckboxSKU" id="check-sku-${i}" value="${v.sku_id}">
									</td>
									<td class="text-center">${v.sku_kode}</td>
									<td class="text-center">${v.sku_induk}</td>
									<td width="20%" class="text-center">${v.sku_nama_produk}</td>
									<td class="text-center">${v.sku_kemasan}</td>
									<td class="text-center">${v.sku_satuan}</td>
									<td class="text-center">${v.principle}</td>
									<td class="text-center">${v.brand}</td>
								</tr>';	
							`);
                            });

                            $('#table-sku').DataTable({
                                "lengthMenu": [
                                    [-1],
                                    ["All"]
                                ],
                                "paging": false,
                                "ordering": false,
                                "searching": false,
                                "info": false
                            });
                        }
                    } else {
                        $("#loadingsku").hide();
                        $("#btn_cari_sku").prop('disabled', false);
                    }
                }
            });
        } else if (check_pilihan == "by_one") {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/search_filter_chosen_sku') ?>",
                data: {
                    sku_kode_wms: $("#FilterPencarianSKU-kode_sku_wms").val(),
                    sku_kode_pabrik: $("#FilterPencarianSKU-kode_sku_pabrik").val(),
                    principle: $("#FilterPencarianSKU-principle_id").val(),
                    brand: $("#FilterPencarianSKU-brand_id").val(),
                    sku_induk: $("#FilterPencarianSKU-sku_induk").val(),
                    sku_nama_produk: $("#FilterPencarianSKU-sku_nama").val(),
                    sku_group_id: "",
                    sku_group_nama: ""
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response != 0) {
                        $("#loadingsku").hide();
                        $("#btn_cari_sku").prop('disabled', false);

                        $("#table-sku > tbody").empty();

                        if ($.fn.DataTable.isDataTable('#table-sku')) {
                            $('#table-sku').DataTable().clear();
                            $('#table-sku').DataTable().destroy();
                        }

                        if (response.length > 0) {
                            $.each(response, function(i, v) {
                                $('#table-sku > tbody').append(`
								<tr>
									<td width="5%" class="text-center">
										<input type="checkbox" name="CheckboxSKU" id="check-sku-${i}" value="${v.sku_id}">
									</td>
									<td class="text-center">${v.sku_kode}</td>
									<td class="text-center">${v.sku_induk}</td>
									<td width="20%" class="text-center">${v.sku_nama_produk}</td>
									<td class="text-center">${v.sku_kemasan}</td>
									<td class="text-center">${v.sku_satuan}</td>
									<td class="text-center">${v.principle}</td>
									<td class="text-center">${v.brand}</td>
								</tr>';	
							`);
                            });

                            $('#table-sku').DataTable({
                                "lengthMenu": [
                                    [-1],
                                    ["All"]
                                ],
                                "paging": false,
                                "ordering": false,
                                "searching": false,
                                "info": false
                            });
                        }
                    } else {
                        $("#loadingsku").hide();
                        $("#btn_cari_sku").prop('disabled', false);
                    }
                }
            });
        } else if (check_pilihan == "by_sku") {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/search_filter_chosen_sku') ?>",
                data: {
                    sku_kode_wms: $("#FilterPencarianSKU-kode_sku_wms").val(),
                    sku_kode_pabrik: $("#FilterPencarianSKU-kode_sku_pabrik").val(),
                    principle: $("#FilterPencarianSKU-principle_id").val(),
                    brand: $("#FilterPencarianSKU-brand_id").val(),
                    sku_induk: $("#FilterPencarianSKU-sku_induk").val(),
                    sku_nama_produk: $("#FilterPencarianSKU-sku_nama").val(),
                    sku_group_id: "",
                    sku_group_nama: ""
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response != 0) {
                        $("#loadingsku").hide();
                        $("#btn_cari_sku").prop('disabled', false);

                        $("#table-sku > tbody").empty();

                        if ($.fn.DataTable.isDataTable('#table-sku')) {
                            $('#table-sku').DataTable().clear();
                            $('#table-sku').DataTable().destroy();
                        }

                        if (response.length > 0) {
                            $.each(response, function(i, v) {
                                $('#table-sku > tbody').append(`
								<tr>
									<td width="5%" class="text-center">
										<input type="checkbox" name="CheckboxSKU" id="check-sku-${i}" value="${v.sku_id}">
									</td>
									<td class="text-center">${v.sku_kode}</td>
									<td class="text-center">${v.sku_induk}</td>
									<td width="20%" class="text-center">${v.sku_nama_produk}</td>
									<td class="text-center">${v.sku_kemasan}</td>
									<td class="text-center">${v.sku_satuan}</td>
									<td class="text-center">${v.principle}</td>
									<td class="text-center">${v.brand}</td>
								</tr>';	
							`);
                            });

                            $('#table-sku').DataTable({
                                "lengthMenu": [
                                    [-1],
                                    ["All"]
                                ],
                                "paging": false,
                                "ordering": false,
                                "searching": false,
                                "info": false
                            });
                        }
                    } else {
                        $("#loadingsku").hide();
                        $("#btn_cari_sku").prop('disabled', false);
                    }
                }
            });
        }
    });

    $("#btn_cari_sku_2").click(function() {

        $("#loadingsku2").show();
        $("#btn_cari_sku_2").prop('disabled', true);

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/search_filter_chosen_sku') ?>",
            data: {
                sku_kode_wms: $("#FilterPencarianSKUDetail1-kode_sku_wms").val(),
                sku_kode_pabrik: $("#FilterPencarianSKUDetail1-kode_sku_pabrik").val(),
                principle: $("#FilterPencarianSKUDetail1-principle_id").val(),
                brand: $("#FilterPencarianSKUDetail1-brand_id").val(),
                sku_induk: $("#FilterPencarianSKUDetail1-sku_induk").val(),
                sku_nama_produk: $("#FilterPencarianSKUDetail1-sku_nama").val(),
                sku_group_id: "",
                sku_group_nama: ""
            },
            dataType: 'JSON',
            success: function(response) {
                if (response != 0) {
                    $("#loadingsku2").hide();
                    $("#btn_cari_sku_2").prop('disabled', false);

                    $("#table-sku-detail > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table-sku-detail')) {
                        $('#table-sku-detail').DataTable().clear();
                        $('#table-sku-detail').DataTable().destroy();
                    }

                    if (response.length > 0) {
                        $.each(response, function(i, v) {
                            $('#table-sku-detail > tbody').append(`
								<tr>
									<td width="5%" class="text-center">
										<input type="checkbox" name="CheckboxSKUDetail1" id="check-sku-detail1-${i}" value="${v.sku_id}">
									</td>
									<td class="text-center">${v.sku_kode}</td>
									<td class="text-center">${v.sku_induk}</td>
									<td width="20%" class="text-center">${v.sku_nama_produk}</td>
									<td class="text-center">${v.sku_kemasan}</td>
									<td class="text-center">${v.sku_satuan}</td>
									<td class="text-center">${v.principle}</td>
									<td class="text-center">${v.brand}</td>
								</tr>';	
							`);
                        });

                        $('#table-sku-detail').DataTable({
                            "lengthMenu": [
                                [-1],
                                ["All"]
                            ],
                            "paging": false,
                            "ordering": false,
                            "searching": false,
                            "info": false
                        });
                    }
                } else {
                    $("#loadingsku2").hide();
                    $("#btn_cari_sku_2").prop('disabled', false);
                }
            }
        });
    });

    $("#btn_cari_sku_pengecualian").click(function() {

        $("#loadingsku3").show();
        $("#btn_cari_sku_pengecualian").prop('disabled', true);

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/search_filter_chosen_sku') ?>",
            data: {
                sku_kode_wms: $("#FilterPencarianSKUPengecualian-kode_sku_wms").val(),
                sku_kode_pabrik: $("#FilterPencarianSKUPengecualian-kode_sku_pabrik").val(),
                principle: $("#FilterPencarianSKUPengecualian-principle_id").val(),
                brand: $("#FilterPencarianSKUPengecualian-brand_id").val(),
                sku_induk: $("#FilterPencarianSKUPengecualian-sku_induk").val(),
                sku_nama_produk: $("#FilterPencarianSKUPengecualian-sku_nama").val(),
                sku_group_id: $("#FilterPencarianSKUPengecualian-sku_group_id").val(),
                sku_group_nama: $("#FilterPencarianSKUPengecualian-sku_group_nama").val()
            },
            dataType: 'JSON',
            success: function(response) {
                if (response != 0) {
                    $("#loadingsku3").hide();
                    $("#btn_cari_sku_pengecualian").prop('disabled', false);

                    $("#table-sku-pengecualian > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table-sku-pengecualian')) {
                        $('#table-sku-pengecualian').DataTable().clear();
                        $('#table-sku-pengecualian').DataTable().destroy();
                    }

                    if (response.length > 0) {
                        $.each(response, function(i, v) {
                            $('#table-sku-pengecualian > tbody').append(`
								<tr>
									<td width="5%" class="text-center">
										<input type="checkbox" name="CheckboxSKUPengecualian" id="check-sku-pengecualian-${i}" value="${v.sku_id}">
									</td>
									<td class="text-center">${v.sku_kode}</td>
									<td class="text-center">${v.sku_induk}</td>
									<td width="20%" class="text-center">${v.sku_nama_produk}</td>
									<td class="text-center">${v.sku_kemasan}</td>
									<td class="text-center">${v.sku_satuan}</td>
									<td class="text-center">${v.principle}</td>
									<td class="text-center">${v.brand}</td>
								</tr>';	
							`);
                        });

                        $('#table-sku-pengecualian').DataTable({
                            "lengthMenu": [
                                [-1],
                                ["All"]
                            ],
                            "paging": false,
                            "ordering": false,
                            "searching": false,
                            "info": false
                        });
                    }
                } else {
                    $("#loadingsku3").hide();
                    $("#btn_cari_sku_pengecualian").prop('disabled', false);
                }
            }
        });
    });

    $("#btn_tambah_promo_detail").click(function() {

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail1_temp') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val()
            },
            dataType: "JSON",
            success: function(response) {
                console.log("insert_sku_promo_detail_temp success");
            }
        });

        GetPromoDetail();
    });

    $("#btn_save_pengaturan_bonus").click(function() {
        var sku_min_qty_before = 0;
        var cek_sku_min_qty_before = 0;
        var cek_sku_min_qty = 0;
        var cek_error = 0;

        $("#loadingpengaturan").show();
        $("#btn_save_pengaturan_bonus").prop("disabled", true);

        arr_sku_promo_detail2_bonus = [];

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/cek_qty_bonus') ?>",
            data: {
                sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val()
            },
            dataType: "JSON",
            success: function(response) {
                $("#cek_qty_bonus").val(response);
            }
        });

        $("#table-pengaturan-header > tbody tr").each(function(idx) {

            sku_min_qty_before = idx > 0 ? parseInt($("#item-" + (idx - 1) + "-SKUPromoDetail2Bonus-sku_min_qty").val()) : '0';

            // alert(parseInt($("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty").val()) + ">" + sku_min_qty_before)

            if ($("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty").val() != "" || $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty").val() != "0") {
                if (parseInt($("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty").val()) > sku_min_qty_before) {
                    arr_sku_promo_detail2_bonus.push({
                        'sku_promo_detail2_bonus_id': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id").val(),
                        'sku_promo_detail2_id': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_id").val(),
                        'sku_promo_detail1_id': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail1_id").val(),
                        'sku_promo_id': $("#SKUPromoDetail2Bonus-sku_promo_id").val(),
                        'sku_min_qty': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty").val(),
                        'is_berkelipatan': $('[id="item-' + idx + '-SKUPromoDetail2Bonus-is_berkelipatan"]:checked').length
                    });
                } else {
                    cek_sku_min_qty_before++;
                }
            } else {
                cek_sku_min_qty++;
            }
        });

        if (cek_sku_min_qty_before > 0) {
            var msg = GetLanguageByKode('CAPTION-ALERT-QTYMINIMUMHARUSLEBIHBESARDARIQTYSEBELUMNYA');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if (cek_sku_min_qty > 0) {
            var msg = GetLanguageByKode('CAPTION-SKUQTYTIDAKBOLEH0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if (parseInt($("#cek_qty_bonus").val()) > 0) {
            var msg = GetLanguageByKode('CAPTION-ALERT-SKUQTYBONUSADA0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if (cek_error == 0) {

            $.ajax({
                async: false,
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/update_sku_promo_detail2_bonus_header_temp') ?>",
                data: {
                    arr_header: arr_sku_promo_detail2_bonus
                },
                dataType: "JSON",
                success: function(response) {

                    if (response == 1) {

                        var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                        message_topright("Success", "success", msg);

                        $("#loadingpengaturan").hide();
                        $("#btn_save_pengaturan_bonus").prop("disabled", false);

                        $("#modal-pengaturan").modal('hide');

                    } else {
                        var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                        message_topright("Error", "error", msg);

                        $("#loadingpengaturan").hide();
                        $("#btn_save_pengaturan_bonus").prop("disabled", false);

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                    message_topright("Error", "error", msg);

                    $("#loadingpengaturan").hide();
                    $("#btn_save_pengaturan_bonus").prop("disabled", false);
                }
            });
        } else {
            arr_sku_promo_detail2_bonus = [];

            $("#loadingpengaturan").hide();
            $("#btn_save_pengaturan_bonus").prop("disabled", false);
        }

        // console.log(arr_sku_promo_detail2_bonus);
    });

    $("#btn_save_pengaturan_bonus_by_one").click(function() {
        var sku_min_qty_before = 0;
        var cek_sku_min_qty_before = 0;
        var cek_sku_min_qty = 0;
        var cek_error = 0;

        $("#loadingpengaturanbyone").show();
        $("#btn_save_pengaturan_bonus_by_one").prop("disabled", true);

        arr_sku_promo_detail2_bonus = [];

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/cek_qty_bonus') ?>",
            data: {
                sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val()
            },
            dataType: "JSON",
            success: function(response) {
                $("#cek_qty_bonus_by_one").val(response);
            }
        });

        $("#table-pengaturan-header-by-one > tbody tr").each(function(idx) {
            sku_min_qty_before = idx > 0 ? parseInt($("#item-" + (idx - 1) + "-SKUPromoDetail2Bonus-sku_min_qty_by_one").val()) : '0';

            if ($("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty_by_one").val() != "" || $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty_by_one").val() != "0") {
                if (parseInt($("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty_by_one").val()) > sku_min_qty_before) {
                    arr_sku_promo_detail2_bonus.push({
                        'sku_promo_detail2_bonus_id': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one").val(),
                        'sku_promo_detail2_id': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one").val(),
                        'sku_promo_detail1_id': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one").val(),
                        'sku_promo_id': $("#SKUPromoDetail2Bonus-sku_promo_id").val(),
                        'sku_min_qty': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty_by_one").val(),
                        'is_berkelipatan': $('[id="item-' + idx + '-SKUPromoDetail2Bonus-is_berkelipatan_by_one"]:checked').length
                    });
                } else {
                    cek_sku_min_qty_before++;
                }
            } else {
                cek_sku_min_qty++;
            }
        });

        if (cek_sku_min_qty_before > 0) {
            var msg = GetLanguageByKode('CAPTION-ALERT-QTYMINIMUMHARUSLEBIHBESARDARIQTYSEBELUMNYA');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if (cek_sku_min_qty > 0) {
            var msg = GetLanguageByKode('CAPTION-SKUQTYTIDAKBOLEH0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if (parseInt($("#cek_qty_bonus_by_one").val()) > 0) {
            var msg = GetLanguageByKode('CAPTION-ALERT-SKUQTYBONUSADA0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if (cek_error == 0) {
            $.ajax({
                async: false,
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/update_sku_promo_detail2_bonus_header_temp') ?>",
                data: {
                    arr_header: arr_sku_promo_detail2_bonus
                },
                dataType: "JSON",
                success: function(response) {

                    if (response == 1) {

                        var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                        message_topright("Success", "success", msg);

                        $("#loadingpengaturanbyone").hide();
                        $("#btn_save_pengaturan_bonus_by_one").prop("disabled", false);

                        $("#modal-pengaturan-by-one").modal('hide');

                    } else {
                        var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                        message_topright("Error", "error", msg);

                        $("#loadingpengaturanbyone").hide();
                        $("#btn_save_pengaturan_bonus_by_one").prop("disabled", false);

                        $("#modal-pengaturan-by-one").modal('hide');

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                    message_topright("Error", "error", msg);

                    $("#loadingpengaturanbyone").hide();
                    $("#btn_save_pengaturan_bonus_by_one").prop("disabled", false);
                }
            });
        } else {
            arr_sku_promo_detail2_bonus = [];

            $("#loadingpengaturanbyone").hide();
            $("#btn_save_pengaturan_bonus_by_one").prop("disabled", false);
        }
    });

    $("#btn_save_pengaturan_bonus_by_sku").click(function() {
        var sku_min_qty_before = 0;
        var cek_sku_min_qty_before = 0;
        var cek_sku_min_qty = 0;
        var cek_error = 0;

        $("#loadingpengaturanbysku").show();
        $("#btn_save_pengaturan_bonus_by_sku").prop("disabled", true);

        arr_sku_promo_detail2_bonus = [];

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/cek_qty_bonus') ?>",
            data: {
                sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val()
            },
            dataType: "JSON",
            success: function(response) {
                $("#cek_qty_bonus_by_sku").val(response);
            }
        });

        $("#table-pengaturan-header-by-sku > tbody tr").each(function(idx) {
            sku_min_qty_before = idx > 0 ? parseInt($("#item-" + (idx - 1) + "-SKUPromoDetail2Bonus-sku_min_qty_by_sku").val()) : '0';

            if ($("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty_by_sku").val() != "" || $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty_by_sku").val() != "0") {
                if (parseInt($("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty_by_sku").val()) > sku_min_qty_before) {
                    arr_sku_promo_detail2_bonus.push({
                        'sku_promo_detail2_bonus_id': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_sku").val(),
                        'sku_promo_detail2_id': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_id_by_sku").val(),
                        'sku_promo_detail1_id': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail1_id_by_sku").val(),
                        'sku_promo_id': $("#SKUPromoDetail2Bonus-sku_promo_id").val(),
                        'sku_min_qty': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty_by_sku").val(),
                        'is_berkelipatan': $('[id="item-' + idx + '-SKUPromoDetail2Bonus-is_berkelipatan_by_sku"]:checked').length
                    });
                } else {
                    cek_sku_min_qty_before++;
                }
            } else {
                cek_sku_min_qty++;
            }
        });

        if (cek_sku_min_qty_before > 0) {
            var msg = GetLanguageByKode('CAPTION-ALERT-QTYMINIMUMHARUSLEBIHBESARDARIQTYSEBELUMNYA');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if (cek_sku_min_qty > 0) {
            var msg = GetLanguageByKode('CAPTION-SKUQTYTIDAKBOLEH0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if (parseInt($("#cek_qty_bonus_by_sku").val()) > 0) {
            var msg = GetLanguageByKode('CAPTION-ALERT-SKUQTYBONUSADA0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if (cek_error == 0) {
            $.ajax({
                async: false,
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/update_sku_promo_detail2_bonus_header_temp') ?>",
                data: {
                    arr_header: arr_sku_promo_detail2_bonus
                },
                dataType: "JSON",
                success: function(response) {

                    if (response == 1) {

                        var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                        message_topright("Success", "success", msg);

                        $("#loadingpengaturanbysku").hide();
                        $("#btn_save_pengaturan_bonus_by_sku").prop("disabled", false);

                        $("#modal-pengaturan-by-sku").modal('hide');

                    } else {
                        var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                        message_topright("Error", "error", msg);

                        $("#loadingpengaturanbysku").hide();
                        $("#btn_save_pengaturan_bonus_by_sku").prop("disabled", false);

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                    message_topright("Error", "error", msg);

                    $("#loadingpengaturanbysku").hide();
                    $("#btn_save_pengaturan_bonus_by_sku").prop("disabled", false);
                }
            });
        } else {
            arr_sku_promo_detail2_bonus = [];

            $("#loadingpengaturanbysku").hide();
            $("#btn_save_pengaturan_bonus_by_sku").prop("disabled", false);
        }
    });

    $("#btn_save_pengaturan_diskon").click(function() {
        var cek_error = 0;
        var cek_error_qty = 0;
        var cek_error_value = 0;

        $("#loadingpengaturanbysku").show();
        $("#btn_save_pengaturan_diskon").prop("disabled", true);

        arr_sku_promo_detail2_diskon = [];

        $("#table-pengaturan-diskon > tbody tr").each(function(idx) {
            if ($("#item-" + idx + "-SKUPromoDetail2Diskon-sku_qty_diskon").val() == "" || $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_qty_diskon").val() == "0") {
                cek_error_qty++;
            } else if ($("#item-" + idx + "-SKUPromoDetail2Diskon-value_diskon").val() == "" || $("#item-" + idx + "-SKUPromoDetail2Diskon-value_diskon").val() == "0") {
                cek_error_value++;
            } else {
                arr_sku_promo_detail2_diskon.push({
                    'sku_promo_detail2_diskon_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_id").val(),
                    'sku_promo_detail2_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail2_id").val(),
                    'sku_promo_detail1_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail1_id").val(),
                    'sku_qty_diskon': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_qty_diskon").val(),
                    'tipe_diskon_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-tipe_diskon_id").val(),
                    'value_diskon': $("#item-" + idx + "-SKUPromoDetail2Diskon-value_diskon").val(),
                    'referensi_diskon_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-referensi_diskon_id").val(),
                    'is_hitung_diskon': $('[id="item-' + idx + '-SKUPromoDetail2Diskon-is_hitung_diskon"]:checked').length,
                    'sku_promo_detail2_diskon_nourut': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_nourut").val()
                });
            }
        });

        if (cek_error_qty > 0) {
            cek_error++;

            var msg = GetLanguageByKode('CAPTION-ALERT-SKUQTYTIDAKBOLEH0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

        }

        if (cek_error_value > 0) {
            cek_error++;

            var msg = GetLanguageByKode('CAPTION-ALERT-NILAITIDAKBOLEH0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

        }

        if (cek_error == 0) {

            Swal.fire({
                title: GetLanguageByKode('CAPTION-APAANDAYAKIN'),
                text: GetLanguageByKode('CAPTION-PASTIKANDATAINPUTBENAR'),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: GetLanguageByKode('CAPTION-LANJUT'),
                cancelButtonText: GetLanguageByKode('CAPTION-CLOSE')
            }).then((result) => {
                if (result.value == true) {
                    //ajax save data
                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/update_sku_promo_detail2_diskon_temp') ?>",
                        data: {
                            arr_detail: arr_sku_promo_detail2_diskon
                        },
                        dataType: "JSON",
                        success: function(response) {

                            if (response == 1) {

                                var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                message_topright("Success", "success", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon").prop("disabled", false);

                                $("#modal-pengaturan-diskon").modal('hide');

                            } else {
                                var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                message_topright("Error", "error", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon").prop("disabled", false);

                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                            message_topright("Error", "error", msg);

                            $("#loadingpengaturanbysku").hide();
                            $("#btn_save_pengaturan_diskon").prop("disabled", false);
                        }
                    });
                }
            });
        } else {
            arr_sku_promo_detail2_diskon = [];

            $("#loadingpengaturanbysku").hide();
            $("#btn_save_pengaturan_diskon").prop("disabled", false);
        }
    });

    $("#btn_save_pengaturan_diskon_by_one").click(function() {
        var cek_error = 0;
        var cek_error_qty = 0;
        var cek_error_value = 0;

        $("#loadingpengaturanbysku").show();
        $("#btn_save_pengaturan_diskon_by_one").prop("disabled", true);

        arr_sku_promo_detail2_diskon = [];

        $("#table-pengaturan-diskon-by-one > tbody tr").each(function(idx) {
            if ($("#item-" + idx + "-SKUPromoDetail2Diskon-sku_qty_diskon_by_one").val() == "" || $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_qty_diskon_by_one").val() == "0") {
                cek_error_qty++;
            } else if ($("#item-" + idx + "-SKUPromoDetail2Diskon-value_diskon_by_one").val() == "" || $("#item-" + idx + "-SKUPromoDetail2Diskon-value_diskon_by_one").val() == "0") {
                cek_error_value++;
            } else {
                arr_sku_promo_detail2_diskon.push({
                    'sku_promo_detail2_diskon_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_id_by_one").val(),
                    'sku_promo_detail2_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail2_id_by_one").val(),
                    'sku_promo_detail1_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail1_id_by_one").val(),
                    'sku_qty_diskon': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_qty_diskon_by_one").val(),
                    'tipe_diskon_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-tipe_diskon_id_by_one").val(),
                    'value_diskon': $("#item-" + idx + "-SKUPromoDetail2Diskon-value_diskon_by_one").val(),
                    'referensi_diskon_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-referensi_diskon_id_by_one").val(),
                    'is_hitung_diskon': $('[id="item-' + idx + '-SKUPromoDetail2Diskon-is_hitung_diskon_by_one"]:checked').length,
                    'sku_promo_detail2_diskon_nourut': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_nourut_by_one").val()
                });
            }
        });

        if (cek_error_qty > 0) {
            cek_error++;

            var msg = GetLanguageByKode('CAPTION-ALERT-SKUQTYTIDAKBOLEH0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

        }

        if (cek_error_value > 0) {
            cek_error++;

            var msg = GetLanguageByKode('CAPTION-ALERT-NILAITIDAKBOLEH0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

        }

        if (cek_error == 0) {

            Swal.fire({
                title: GetLanguageByKode('CAPTION-APAANDAYAKIN'),
                text: GetLanguageByKode('CAPTION-PASTIKANDATAINPUTBENAR'),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: GetLanguageByKode('CAPTION-LANJUT'),
                cancelButtonText: GetLanguageByKode('CAPTION-CLOSE')
            }).then((result) => {
                if (result.value == true) {
                    //ajax save data
                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/update_sku_promo_detail2_diskon_temp') ?>",
                        data: {
                            arr_detail: arr_sku_promo_detail2_diskon
                        },
                        dataType: "JSON",
                        success: function(response) {

                            if (response == 1) {

                                var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                message_topright("Success", "success", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon_by_one").prop("disabled", false);

                                $("#modal-pengaturan-diskon-by-one").modal('hide');

                            } else {
                                var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                message_topright("Error", "error", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon_by_one").prop("disabled", false);

                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                            message_topright("Error", "error", msg);

                            $("#loadingpengaturanbysku").hide();
                            $("#btn_save_pengaturan_diskon_by_one").prop("disabled", false);
                        }
                    });
                }
            });
        } else {
            arr_sku_promo_detail2_diskon = [];

            $("#loadingpengaturanbysku").hide();
            $("#btn_save_pengaturan_diskon_by_one").prop("disabled", false);
        }
    });

    $("#btn_save_pengaturan_diskon_by_sku").click(function() {
        var cek_error = 0;
        var cek_error_qty = 0;
        var cek_error_value = 0;

        $("#loadingpengaturanbysku").show();
        $("#btn_save_pengaturan_diskon_by_sku").prop("disabled", true);

        arr_sku_promo_detail2_diskon = [];

        $("#table-pengaturan-diskon-by-sku > tbody tr").each(function(idx) {
            if ($("#item-" + idx + "-SKUPromoDetail2Diskon-sku_qty_diskon_by_sku").val() == "" || $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_qty_diskon_by_sku").val() == "0") {
                cek_error_qty++;
            } else if ($("#item-" + idx + "-SKUPromoDetail2Diskon-value_diskon_by_sku").val() == "" || $("#item-" + idx + "-SKUPromoDetail2Diskon-value_diskon_by_sku").val() == "0") {
                cek_error_value++;
            } else {
                arr_sku_promo_detail2_diskon.push({
                    'sku_promo_detail2_diskon_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_id_by_sku").val(),
                    'sku_promo_detail2_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail2_id_by_sku").val(),
                    'sku_promo_detail1_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail1_id_by_sku").val(),
                    'sku_qty_diskon': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_qty_diskon_by_sku").val(),
                    'tipe_diskon_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-tipe_diskon_id_by_sku").val(),
                    'value_diskon': $("#item-" + idx + "-SKUPromoDetail2Diskon-value_diskon_by_sku").val(),
                    'referensi_diskon_id': $("#item-" + idx + "-SKUPromoDetail2Diskon-referensi_diskon_id_by_sku").val(),
                    'is_hitung_diskon': $('[id="item-' + idx + '-SKUPromoDetail2Diskon-is_hitung_diskon_by_sku"]:checked').length,
                    'sku_promo_detail2_diskon_nourut': $("#item-" + idx + "-SKUPromoDetail2Diskon-sku_promo_detail2_diskon_nourut_by_sku").val()
                });
            }
        });

        if (cek_error_qty > 0) {
            cek_error++;

            var msg = GetLanguageByKode('CAPTION-ALERT-SKUQTYTIDAKBOLEH0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

        }

        if (cek_error_value > 0) {
            cek_error++;

            var msg = GetLanguageByKode('CAPTION-ALERT-NILAITIDAKBOLEH0');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

        }

        if (cek_error == 0) {

            Swal.fire({
                title: GetLanguageByKode('CAPTION-APAANDAYAKIN'),
                text: GetLanguageByKode('CAPTION-PASTIKANDATAINPUTBENAR'),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: GetLanguageByKode('CAPTION-LANJUT'),
                cancelButtonText: GetLanguageByKode('CAPTION-CLOSE')
            }).then((result) => {
                if (result.value == true) {
                    //ajax save data
                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/update_sku_promo_detail2_diskon_temp') ?>",
                        data: {
                            arr_detail: arr_sku_promo_detail2_diskon
                        },
                        dataType: "JSON",
                        success: function(response) {

                            if (response == 1) {

                                var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                message_topright("Success", "success", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon_by_sku").prop("disabled", false);

                                $("#modal-pengaturan-diskon-by-sku").modal('hide');

                            } else {
                                var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                message_topright("Error", "error", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon_by_sku").prop("disabled", false);

                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                            message_topright("Error", "error", msg);

                            $("#loadingpengaturanbysku").hide();
                            $("#btn_save_pengaturan_diskon_by_sku").prop("disabled", false);
                        }
                    });
                }
            });
        } else {
            arr_sku_promo_detail2_diskon = [];

            $("#loadingpengaturanbysku").hide();
            $("#btn_save_pengaturan_diskon_by_sku").prop("disabled", false);
        }
    });

    $("#btn_tutup_pengaturan_bonus").click(function() {
        $("#panel-pengaturan-detail").hide();
    });

    $('#SKUPromo-sku_promo_is_need_approval').click(function(event) {
        if (this.checked) {
            $("#SKUPromo-sku_promo_status").val("In Progress Approval");
        } else {
            $("#SKUPromo-sku_promo_status").val("Draft");
        }
    });

    $("#btn_save_promo_detail2_by_sku").click(function() {
        var jumlah = $('input[name="CheckboxSKUDetail1"]').length;
        var numberOfChecked = $('input[name="CheckboxSKUDetail1"]:checked').length;
        var no = 1;
        var check_pilihan = $("#SKUPromoDetail2Bonus-check_pilihan").val();
        var idx = $("#FilterPencarianSKUDetail1-index").val();
        var checked_bonus = $("#FilterPencarianSKUDetail1-checked_bonus").val();
        var checked_diskon = $("#FilterPencarianSKUDetail1-checked_diskon").val();
        var principle_id = $("#FilterPencarianSKUDetail1-principle_id").val();

        jumlah_sku = numberOfChecked;

        arr_sku_detail1 = [];

        if (numberOfChecked > 0) {
            $("#modal-sku-detail1").modal('hide');

            for (var i = 0; i < jumlah; i++) {
                var checked = $('[id="check-sku-detail1-' + i + '"]:checked').length;
                var sku_id = $("#check-sku-detail1-" + i).val();

                if (checked > 0) {
                    arr_sku_detail1.push(sku_id);
                }
            }

            $.each(arr_sku_detail1, function(i, v) {
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_temp_by_sku') ?>",
                    data: {
                        sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                        sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + idx).val(),
                        sku_id: v
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log("insert_sku_promo_detail2_temp_by_sku success");
                    }
                });
            });

            $.ajax({
                async: false,
                type: 'GET',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_temp') ?>",
                data: {
                    sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                    sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + idx).val()
                },
                dataType: "JSON",
                success: function(response) {

                    $('#table-product-promo-by-sku-' + idx + ' > tbody').empty();

                    $.each(response, function(i, v) {
                        $('#table-product-promo-by-sku-' + idx + ' > tbody').append(`
							<tr id="row-${i}">
								<td style="vertical-align:middle; text-align:center;">
									${i+1}
									<input type="hidden" id="" value="item-${i}-SKUPromoDetail2-sku_promo_detail2_id" value="${v.sku_promo_detail2_id}">
								</td>
								<td style="vertical-align:middle; text-align:center;">
									${v.sku_kode}
								</td>
								<td style="vertical-align:middle; text-align:center;">
									${v.sku_nama_produk}
								</td>
								<td style="vertical-align:middle; text-align:center;">
									${v.sku_kemasan}
								</td>
								<td style="vertical-align:middle; text-align:center;">
									${v.sku_satuan}
								</td>
								<td style="vertical-align:middle; text-align:center;display:none;">
									<span id="item-${i}-SKUPromoDetail2-qty">0</span>
								</td>
								<td style="vertical-align:middle; text-align:center;">
									<button class="btn btn-primary btn-small btn_atur_bonus_${idx}" id="item-${i}-SKUPromoDetail2-atur_bonus" onclick="AturBonusBySKU('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${idx}','${i}','${v.sku_id}','${v.sku_kode}','${v.sku_nama_produk}','${v.sku_kemasan}','${v.sku_satuan}')" ${ checked_bonus > 0 ? '' : 'disabled' }><i class="fa fa-pencil"></i></button>
								</td>
								<td style="vertical-align:middle; text-align:center;">
									<button class="btn btn-primary btn-small btn_atur_diskon_${idx}" id="item-${i}-SKUPromoDetail2-atur_diskon" onclick="AturDiskonBySKU('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${idx}','${i}','${v.sku_id}','${v.sku_kode}','${v.sku_nama_produk}','${v.sku_kemasan}','${v.sku_satuan}')" ${ checked_diskon > 0 ? '' : 'disabled' }><i class="fa fa-pencil"></i></button>
								</td>
								<td style="vertical-align:middle; text-align:center;">
									<button class="btn btn-danger btn-small" onclick="DeleteSKUPromoDetail2('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${i}')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>';
						`);
                    });
                }
            });

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHSKU');

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: msg
            });
        }
    });

    $("#btn_save_pengecualian_sku").click(function() {
        var jumlah = $('input[name="CheckboxSKUPengecualian"]').length;
        var numberOfChecked = $('input[name="CheckboxSKUPengecualian"]:checked').length;
        var no = 1;
        var check_pilihan = $("#SKUPromoDetail2Bonus-check_pilihan").val();
        var idx = $("#FilterPencarianSKUPengecualian-index").val();

        jumlah_sku = numberOfChecked;

        arr_sku_Pengecualian = [];

        if (numberOfChecked > 0) {
            $("#modal-sku-pengecualian").modal('hide');

            for (var i = 0; i < jumlah; i++) {
                var checked = $('[id="check-sku-pengecualian-' + i + '"]:checked').length;
                var sku_id = $("#check-sku-pengecualian-" + i).val();

                if (checked > 0) {
                    arr_sku_Pengecualian.push(sku_id);
                }
            }

            $.each(arr_sku_Pengecualian, function(i, v) {
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_sku_temp') ?>",
                    data: {
                        sku_promo_id: $("#FilterPencarianSKUPengecualian-sku_promo_id").val(),
                        sku_promo_detail1_id: $("#FilterPencarianSKUPengecualian-sku_promo_detail1_id").val(),
                        sku_promo_detail2_id: $("#FilterPencarianSKUPengecualian-sku_promo_detail2_id").val(),
                        sku_id: v,
                        is_pengecualian: 1
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log("insert_sku_promo_detail2_sku_temp success");
                    }
                });
            });

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHSKU');

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: msg
            });
        }
    });

    $("#btn_save_sku_promo").on("click", function() {
        var cek_error = 0;

        // console.log($("#SKUPromo-depo_group_id").val());
        // console.log($("#SKUPromo-depo_id").val());

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/cek_sku_promo_detail2_bonus') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val()
            },
            dataType: "JSON",
            success: function(response) {
                $("#cek_sku_promo_detail_bonus").val(response);
            }
        });

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/cek_sku_promo_detail2_diskon') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val()
            },
            dataType: "JSON",
            success: function(response) {
                $("#cek_sku_promo_detail_diskon").val(response);
            }
        });

        if ($("#SKUPromo-sku_promo_kode").val() == "") {
            var msg = GetLanguageByKode('CAPTION-ALERT-SKUPROMOKODEKOSONG');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if ($("#SKUPromo-depo_id").val() == "") {
            var msg = GetLanguageByKode('CAPTION-ALERT-PILIHDEPO');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if ($("#SKUPromo-sku_promo_keterangan").val() == "") {
            var msg = GetLanguageByKode('CAPTION-ALERT-KETERANGANKOSONG');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if ($("#SKUPromo-depo_group_id").val() == "") {
            var msg = GetLanguageByKode('CAPTION-ALERT-PILIHDEPOGROUP');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if ($("#SKUPromo-sku_promo_tgl_berlaku_awal").val() == "") {
            var msg = GetLanguageByKode('CAPTION-ALERT-TGLBERLAKUAWALKOSONG');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if ($("#SKUPromo-sku_promo_tgl_berlaku_akhir").val() == "") {
            var msg = GetLanguageByKode('CAPTION-ALERT-TGLBERLAKUAKHIRKOSONG');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if ($("#SKUPromo-sku_promo_status").val() == "") {
            var msg = GetLanguageByKode('CAPTION-ALERT-STATUSTIDAKDIPILIH');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if (parseInt($("#cek_sku_promo_detail_bonus").val()) == 0 && parseInt($("#cek_sku_promo_detail_diskon").val()) == 0) {
            var msg = GetLanguageByKode('CAPTION-ALERT-HARUSSETTINGDISKONATAUBONUS');
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

            cek_error++;
        }

        if (cek_error == 0) {
            Swal.fire({
                title: GetLanguageByKode('CAPTION-APAANDAYAKIN'),
                text: GetLanguageByKode('CAPTION-MENGGANTIGUNAKANGROUPSKU'),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: GetLanguageByKode('CAPTION-LANJUT'),
                cancelButtonText: GetLanguageByKode('CAPTION-CLOSE')
            }).then((result) => {
                if (result.value == true) {

                    $("#loading").show();
                    $("#btn_save_sku_promo").prop("disabled", true);

                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_lokasi') ?>",
                        data: {
                            sku_promo_kode: $("#SKUPromo-sku_promo_kode").val()
                        },
                        dataType: "JSON",
                        success: function(response) {
                            console.log("delete_sku_promo_lokasi success");
                        }
                    });

                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/update_sku_promo') ?>",
                        data: {
                            sku_promo_id: $("#SKUPromo-sku_promo_id").val(),
                            depo_group_id: $("#SKUPromo-depo_group_id").val(),
                            depo_id: $("#SKUPromo-depo_id").val(),
                            client_wms_id: $("#SKUPromo-client_wms_id").val(),
                            sku_promo_kode: $("#SKUPromo-sku_promo_kode").val(),
                            sku_promo_tgl_berlaku_awal: $("#SKUPromo-sku_promo_tgl_berlaku_awal").val(),
                            sku_promo_tgl_berlaku_akhir: $("#SKUPromo-sku_promo_tgl_berlaku_akhir").val(),
                            sku_promo_keterangan: $("#SKUPromo-sku_promo_keterangan").val(),
                            sku_promo_status: $("#SKUPromo-sku_promo_status").val(),
                            sku_promo_tgl_create: "",
                            sku_promo_who_create: "<?= $this->session->userdata('pengguna_username') ?>"
                        },
                        dataType: "JSON",
                        success: function(response) {

                            $("#loading").hide();
                            $("#btn_save_sku_promo").prop("disabled", false);

                            if (response == 1) {

                                // $.ajax({
                                // 	async: false,
                                // 	type: 'POST',
                                // 	url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_all_sku_promo_temp') ?>",
                                // 	data: {
                                // 		sku_promo_id: $("#SKUPromo-sku_promo_id").val()
                                // 	},
                                // 	dataType: "JSON",
                                // 	success: function(response) {
                                // 		console.log("delete_all_sku_promo_temp success");
                                // 	}
                                // });

                                var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                message_topright("Success", "success", msg);

                                setTimeout(() => {
                                    location.href = "<?= base_url() ?>FAS/MasterPricing/HargaDanPromo/Promo/PromoMenu";
                                }, 500);

                            } else {
                                var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                message_topright("Error", "error", msg);

                            }
                        }
                    });

                    // $.ajax({
                    //     async: false,
                    //     type: 'POST',
                    //     url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo') ?>",
                    //     data: {
                    //         sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                    //         depo_group_id: $("#SKUPromo-depo_group_id").val(),
                    //         depo_id: $("#SKUPromo-depo_id").val(),
                    //         client_wms_id: $("#SKUPromo-client_wms_id").val(),
                    //         sku_promo_kode: $("#SKUPromo-sku_promo_kode").val(),
                    //         sku_promo_tgl_berlaku_awal: $("#SKUPromo-sku_promo_tgl_berlaku_awal").val(),
                    //         sku_promo_tgl_berlaku_akhir: $("#SKUPromo-sku_promo_tgl_berlaku_akhir").val(),
                    //         sku_promo_keterangan: $("#SKUPromo-sku_promo_keterangan").val(),
                    //         sku_promo_status: $("#SKUPromo-sku_promo_status").val(),
                    //         sku_promo_tgl_create: "",
                    //         sku_promo_who_create: "<?= $this->session->userdata('pengguna_username') ?>"
                    //     },
                    //     dataType: "JSON",
                    //     success: function(response) {

                    //         $("#loading").hide();
                    //         $("#btn_save_sku_promo").prop("disabled", false);

                    //         if (response == 1) {

                    //             $.ajax({
                    //                 async: false,
                    //                 type: 'POST',
                    //                 url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_all_sku_promo_temp') ?>",
                    //                 data: {
                    //                     sku_promo_id: $("#SKUPromo-sku_promo_id_new").val()
                    //                 },
                    //                 dataType: "JSON",
                    //                 success: function(response) {
                    //                     console.log("delete_all_sku_promo_temp success");
                    //                 }
                    //             });

                    //             var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                    //             message_topright("Success", "success", msg);

                    //             setTimeout(() => {
                    //                 location.href = "<?= base_url() ?>FAS/MasterPricing/HargaDanPromo/Promo/PromoMenu";
                    //             }, 500);

                    //         } else {
                    //             var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                    //             message_topright("Error", "error", msg);

                    //         }
                    //     }
                    // });
                }
            });
        }


    });

    $("#SKUPromo-depo_group_id").change(function() {
        initDataDepo();
    });

    function initDataDepo() {
        var depo_group_id = $("#SKUPromo-depo_group_id").val();

        $("#loadingdepo").show();
        $("#SKUPromo-depo_id").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/search_depo_by_multi_group') ?>",
            data: {
                depo_group_nama: depo_group_id
            },
            dataType: "JSON",
            async: false,
            success: function(response) {
                $("#loadingdepo").hide();
                $("#SKUPromo-depo_id").prop("disabled", false);

                $("#SKUPromo-depo_id").html('');

                if (response.length > 0) {
                    $.each(response, function(i, v) {
                        $("#SKUPromo-depo_id").append(`<option value="'${v.depo_id}'">${v.depo_nama}</option>`);
                    });
                }
            }
        });
    }

    //end button group

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
        // $("#btnsavesobosnet").removeAttr('style');

        // $("#btnsavesobosnet").click
        // (
        // 	function()
        // 	{	
        // 		var totalCheckboxes = $('[name="CheckboxSO"]').length;
        // 		var numberOfChecked = $('[name="CheckboxSO"]:checked').length;
        // 		var numberNotChecked = totalCheckboxes - numberOfChecked;
        // 		var count_checkbox = 0;


        // 		$("#loadingview").show();
        // 		$("#btnsavesobosnet").prop("disabled",true);

        // 		for(var x = 0; x < totalCheckboxes; x++){
        // 			var checkbox = $('[id="chk_so_'+ x +'"]:checked').length;
        // 			var SO_ID = $("#chk_so_"+x).val();

        // 			if(checkbox > 0)
        // 			{
        // 				$.ajax(
        // 				{
        // 					async: false,
        // 					type: 'POST',    
        // 					url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/SaveSalesOrderBosnet') ?>",
        // 					data: {	
        // 							SO_ID : SO_ID
        // 						},
        // 					success: function( response )
        // 					{

        // 					},
        // 					error: function(xhr, ajaxOptions, thrownError) {

        // 						$("#loadingview").hide();
        // 						$("#btnsavesobosnet").prop("disabled",false);
        // 					}
        // 				});

        // 				count_checkbox++;
        // 			}
        // 		}

        // 		if (count_checkbox == numberOfChecked) {
        // 			response = 1;
        // 			$("#loadingview").hide();
        // 			$("#btnsavesobosnet").prop("disabled",false);
        // 			if(response == 1)
        // 			{
        // 				var msg = 'Generate SO Bosnet Berhasil!';
        // 				var msgtype = 'success';

        // 				//if (!window.__cfRLUnblockHandlers) return false;
        // 				new PNotify
        // 				({
        // 					title: 'Info',
        // 					text: msg,
        // 					type: msgtype,
        // 					styling: 'bootstrap3',
        // 					delay: 3000,
        // 					stack: stack_center
        // 				});
        // 			}
        // 		}
        // 	}
        // );

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