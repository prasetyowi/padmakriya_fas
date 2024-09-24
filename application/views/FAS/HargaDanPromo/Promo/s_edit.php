<script type="text/javascript">
    var ChannelCode = '';
    var arr_sku = [];
    var arr_sku_detail1 = [];
    var arr_pengaturan_detail = [];
    var arr_sku_promo_detail2_bonus = [];
    var arr_sku_promo_detail2_diskon = [];
    var arr_sku_promo_detail2_bonus_detail = [];
    var arr_sku_promo_lokasi = [];
    var arr_pengaturan_header = [];
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

    $('#select-sku-detail').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="CheckboxSKUDetail1"]:checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('[name="CheckboxSKUDetail1"]:checkbox').each(function() {
                this.checked = false;
            });
        }
    });

    $('#select-sku-pengecualian').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="CheckboxSKUPengecualian"]:checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('[name="CheckboxSKUPengecualian"]:checkbox').each(function() {
                this.checked = false;
            });
        }
    });

    $('#SKUPromo-sku_promo_is_khusus').click(function(event) {
        if (this.checked) {
            $("#SKUPromo-client_pt_id").prop("disabled", false);
            $("#SKUPromo-client_pt_id").selectpicker('refresh');
        } else {
            $("#SKUPromo-client_pt_id").prop("disabled", true);
            $("#SKUPromo-client_pt_id").selectpicker('refresh');
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

    $(document).ready(
        function() {
            $('.select2').select2();

            $.ajax({
                async: false,
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_all_sku_promo_temp_tanpa_id') ?>",
                // data: {
                //     sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                //     sku_promo_id_new: $("#SKUPromo-sku_promo_id_new").val()
                // },
                dataType: "JSON",
                success: function(response) {
                    console.log("delete_all_sku_promo_temp_tanpa_id success");
                    // GetPromoDetail();
                }
            });

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

        var sku_group_id = $.trim($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_grup").children("option:selected").text());
        var sku_group_nama = $.trim($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").children("option:selected").text());
        var kategori_id = $("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").val();
        var principle_id = $("#SKUPromoDetail-principle_id_" + idx).val();

        // alert(sku_group_nama)

        if (principle_id != "") {

            if (kategori_id != "") {

                $("#modal-pengaturan-by-one").modal('show');
                $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val('');
                $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val('');
                $("#Filter-principle_id_by_one").val('');
                $("#FilterPengaturan-kategori_id_by_one").val('');

                $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val(sku_promo_detail1_id);
                $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val(sku_promo_detail2_id);
                $("#Filter-principle_id_by_one").val(principle_id);
                $("#FilterPengaturan-sku_group_id_by_one").val(sku_group_id);
                $("#FilterPengaturan-sku_group_nama_by_one").val(sku_group_nama);
                $("#FilterPengaturan-kategori_id_by_one").val(kategori_id);

                $("#panel-pengaturan-detail-by-one").hide();
                $("#table-pengaturan-detail-by-one tbody").empty();

                var checked = $(`#SKUPromoDetail-sku_promo_detail1_use_value_order_${idx}`).prop('checked');

                if (checked) {
                    $("#dasar_jumlah_order").val('value order')
                } else {
                    $("#dasar_jumlah_order").val('qty order')
                }

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

        var sku_group_id = $.trim($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_grup").children("option:selected").text());
        var sku_group_nama = $.trim($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").children("option:selected").text());
        var kategori_id = $("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").val();
        var principle_id = $("#SKUPromoDetail-principle_id_" + idx).val();

        // alert(kategori_id)

        if (principle_id != "") {

            if (kategori_id != "") {

                $("#modal-pengaturan-diskon-by-one").modal('show');
                $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val('');
                $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val('');
                $("#Filter-principle_id_by_one").val('');
                $("#FilterPengaturanDiskon-sku_group_id_by_one").val('');
                $("#FilterPengaturanDiskon-sku_group_nama_by_one").val('');
                $("#FilterPengaturanDiskon-kategori_id").val('');
                $("#SKUPromoDetail2Diskon-check_pilihan").val('by_one');

                $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val(sku_promo_detail1_id);
                $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val(sku_promo_detail2_id);
                $("#Filter-principle_id_by_one").val(principle_id);
                $("#FilterPengaturanDiskon-sku_group_id_by_one").val(sku_group_id);
                $("#FilterPengaturanDiskon-sku_group_nama_by_one").val(sku_group_nama);
                $("#FilterPengaturanDiskon-kategori_id").val(kategori_id);
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

                // GetPromoDetail2Bonus();
                GetPromoDetail2BonusBySKU();
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

        $("#table-pengaturan-header tbody").empty();
        $("#table-pengaturan-detail tbody").empty();
        $("#panel-pengaturan-detail").hide();

        if (principle_id != "") {

            if (use_group == 1) {

                if (check == 0 && $("#table-product-promo-" + idx + " > tbody tr ").length > 0) {
                    $("#modal-pengaturan").modal('show');
                    $("#SKUPromoDetail-sku_promo_detail1_id").val('');
                    $("#SKUPromoDetail-sku_promo_detail2_id").val('');

                    $("#SKUPromoDetail-sku_promo_detail1_id").val(sku_promo_detail1_id);
                    $("#SKUPromoDetail-sku_promo_detail2_id").val(sku_promo_detail2_id);
                    $("#Filter-principle_id").val(principle_id);

                    var checked = $(`#SKUPromoDetail-sku_promo_detail1_use_value_order_${idx}`).prop('checked');

                    if (checked) {
                        $("#dasar_jumlah_order").val('value order')
                        $("#thMinimumGlobal").html("<span name='CAPTION-VALUEMININUM'>Value Minimum</span>")
                    } else {
                        $("#dasar_jumlah_order").val('qty order')
                        $("#thMinimumGlobal").html("<span name='CAPTION-QTYMINIMUM'>Qty Minimum</span>")
                    }

                    // GetPromoDetail2Bonus();

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

                var checked = $(`#SKUPromoDetail-sku_promo_detail1_use_value_order_${idx}`).prop('checked');

                if (checked) {
                    $("#dasar_jumlah_order").val('value order')
                    $("#thMinimumGlobal").html("<span name='CAPTION-VALUEMININUM'>Value Minimum</span>")
                } else {
                    $("#dasar_jumlah_order").val('qty order')
                    $("#thMinimumGlobal").html("<span name='CAPTION-QTYMINIMUM'>Qty Minimum</span>")
                }

                // GetPromoDetail2Bonus();
            }

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHPRINCIPLE');
            message_custom("Error", "error", msg);

        }

        arr_pengaturan_header = [];
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
									<td class="text-center" style="width:10%;display:none;">
										<select id="item-${i}-SKUPromoDetail2BonusDetail-sku_tipe_id" class="form-control input-sm" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','all')">
											<option value="">**Pilih**</option>
										</select>
									</td>
									<td class="text-center" style="width:10%;">
										<select id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon_id" class="form-control select2"  onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','all')">
											<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
											<?php if ($ReferensiDiskon != "0") {
                                                foreach ($ReferensiDiskon as $value) : ?>
													<option value="<?= $value['referensi_diskon_id']; ?>" ${v.referensi_diskon_id == '<?= $value['referensi_diskon_id'] ?>' ? 'selected' : ''}><?= $value['referensi_diskon_kode']; ?></option>
											<?php endforeach;
                                            } ?>
										</select>
									</td>
									<td class="text-center">
										<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,${i},'${v.sku_id}','${v.sku_promo_detail2_bonus2_id}')"><i class="fa fa-trash"></i></button>
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

                        $(".select2").select2();
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
									<td class="text-center" style="width:10%;display:none;">
										<select id="item-${i}-SKUPromoDetail2BonusDetail-sku_tipe_id_by_one" class="form-control input-sm" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_one')">
											<option value="">**Pilih**</option>
										</select>
									</td>
									<td class="text-center" style="width:10%;">
										<select id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_one" class="form-control select2" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_one')">
											<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
										</select>
									</td>
									<td class="text-center">
										<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,${i},'${v.sku_id}','${v.sku_promo_detail2_bonus2_id}')"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
							`);
                        });

                        $.each(response, function(i, v) {

                            $("item-" + i + "-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_one").html('');

                            $.ajax({
                                type: 'GET',
                                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetReferensiDiskonByKategori') ?>",
                                data: {
                                    kategori: $("#FilterPengaturan-kategori_id_by_one").val()
                                },
                                dataType: "JSON",
                                success: function(response2) {
                                    if (response2 != 0) {
                                        $.each(response2, function(idx, val) {
                                            $("item-" + i + "-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_one").append(`<option value="${val.referensi_diskon_id}" ${val.referensi_diskon_id == v.referensi_diskon_id}>${val.referensi_diskon_kode}</option>`);
                                        })
                                    }

                                }
                            });
                        });

                        $(".select2").select2({
                            width: '100%'
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

                        $(".select2").select2();
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
								<td class="text-center" style="width:10%;display:none;">
									<select id="item-${i}-SKUPromoDetail2BonusDetail-sku_tipe_id_by_sku" class="form-control input-sm" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_sku')">
										<option value="">**Pilih**</option>
									</select>
								</td>
								<td class="text-center" style="width:10%;">
                                    <select id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_sku" class="form-control select2" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_sku')">
										<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
                                    </select>
								</td>
								<td class="text-center">
									<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,${i},'${v.sku_id}','${v.sku_promo_detail2_bonus2_id}')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						`);
                        });

                        $("item-" + i + "-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_sku").html('');

                        $.ajax({
                            type: 'GET',
                            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetReferensiDiskonByKategori') ?>",
                            dataType: "JSON",
                            data: {
                                kategori: $("#FilterPengaturanDiskon-kategori_id_by_one").val()
                            },
                            success: function(response2) {
                                if (response2 != 0) {
                                    $.each(response2, function(idx, val) {
                                        $("item-" + i + "-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_sku").append(`<option value="${val.referensi_diskon_id}" ${val.referensi_diskon_id == v.referensi_diskon_id}>${val.referensi_diskon_kode}</option>`);
                                    })
                                }

                            }
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

                        $(".select2").select2();
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
    // 						<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,${i},'${v.sku_id}','${v.sku_promo_detail2_bonus2_id}')"><i class="fa fa-trash"></i></button>
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

        var no_urut = $("#item-" + index + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut").val();
        $("#SKUPromoDetail2Bonus-no_urut").html('');
        $("#SKUPromoDetail2Bonus-check_pilihan").val('');

        $("#panel-pengaturan-detail").show();
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id").val(sku_promo_detail2_bonus_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_id").val(sku_promo_detail2_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail1_id").val(sku_promo_detail1_id);
        $("#SKUPromoDetail2Bonus-sku_promo_id").val(sku_promo_id);
        $("#SKUPromoDetail2Bonus-index").val(index);
        $("#SKUPromoDetail2Bonus-check_pilihan").val("all");
        $("#SKUPromoDetail2Bonus-no_urut").append(no_urut);

        pushToTablePengaturanDetail();

    }

    function ViewBonusDetail2ByOne(sku_promo_detail2_bonus_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, index) {

        var no_urut = $("#item-" + index + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut_by_one").val();
        $("#SKUPromoDetail2Bonus-no_urut_by_one").html('');
        $("#SKUPromoDetail2Bonus-check_pilihan").val('');

        $("#panel-pengaturan-detail-by-one").show();
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one").val(sku_promo_detail2_bonus_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one").val(sku_promo_detail2_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one").val(sku_promo_detail1_id);
        $("#SKUPromoDetail2Bonus-sku_promo_id").val(sku_promo_id);
        $("#SKUPromoDetail2Bonus-index").val(index);
        $("#SKUPromoDetail2Bonus-check_pilihan").val("by_one");
        $("#SKUPromoDetail2Bonus-no_urut_by_one").append(no_urut);

        pushToTablePengaturanDetail();

    }

    function ViewBonusDetail2BySKU(sku_promo_detail2_bonus_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, index) {
        var no_urut = $("#item-" + index + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut_by_sku").val();
        $("#SKUPromoDetail2Bonus-no_urut_by_sku").html('');
        $("#SKUPromoDetail2Bonus-check_pilihan").val('');

        $("#panel-pengaturan-detail-by-sku").show();
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_sku").val(sku_promo_detail2_bonus_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_id_by_sku").val(sku_promo_detail2_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail1_id_by_sku").val(sku_promo_detail1_id);
        $("#SKUPromoDetail2Bonus-sku_promo_id").val(sku_promo_id);
        $("#SKUPromoDetail2Bonus-index").val(index);
        $("#SKUPromoDetail2Bonus-check_pilihan").val("by_sku");
        $("#SKUPromoDetail2Bonus-no_urut_by_sku").append(no_urut);

        pushToTablePengaturanDetail();

    }

    function DeleteSKU(row, index, sku_id, sku_promo_detail2_bonus2_id) {
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
                //ajax save data
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_detail2_bonus_detail_temp') ?>",
                    data: {
                        sku_promo_detail2_bonus2_id: sku_promo_detail2_bonus2_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log("delete_sku_promo_detail2_bonus_detail_temp success");
                        pushToTablePengaturanDetail();
                    }
                });
            }
        });

        // var row = row.parentNode.parentNode;
        // row.parentNode.removeChild(row);

        // arr_sku[index] = "";
        // arr_pengaturan_detail[index] = "";
    }

    function DeletePromoDetail2Bonus(sku_promo_detail2_bonus_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, index) {

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
                var dasarJumlahOrder = $("#dasar_jumlah_order").val();

                //ajax save data
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_detail2_bonus_temp') ?>",
                    data: {
                        sku_promo_detail2_bonus_id: sku_promo_detail2_bonus_id,
                        sku_promo_detail2_id: sku_promo_detail2_id,
                        sku_promo_detail1_id: sku_promo_detail1_id,
                        sku_promo_id: sku_promo_id,
                        dasarJumlahOrder: dasarJumlahOrder
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log("delete_sku_promo_detail2_bonus_temp success");
                        GetPromoDetail2Bonus();
                    }
                });
            }
        });

        // var row = row.parentNode.parentNode;
        // row.parentNode.removeChild(row);

        // arr_sku[index] = "";
        // arr_pengaturan_detail[index] = "";

    }

    function DeletePromoDetail2BonusByOne(sku_promo_detail2_bonus_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, index) {
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
                //ajax save data
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
                        GetPromoDetail2BonusByOne();
                    }
                });
            }
        });

        // var row = row.parentNode.parentNode;
        // row.parentNode.removeChild(row);

        // arr_sku[index] = "";
        // arr_pengaturan_detail[index] = "";

    }

    function DeletePromoDetail2BonusBySKU(sku_promo_detail2_bonus_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, index) {
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
                //ajax save data

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
                        GetPromoDetail2BonusBySKU();
                    }
                });
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
                                            <input type="hidden" id="item-${i}-SKUPromoDetail2-sku_promo_detail2_id" value="${v.sku_promo_detail2_id}">
                                        </td>
                                        <td style="vertical-align:middle; text-align:center;">
                                            <select name="FilterPencarianSKU[principle_id]" class="input-sm form-control select2" id="item-${idx}-${i}-SKUPromoDetail2-kategori_grup" onchange="GetKategoriByGroup('${v.sku_promo_detail2_id}',this.value,'${idx}','${i}','${principle_id}')">
                                                <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                <?php foreach ($KategoriGroup as $row) : ?>
                                                    <option value="<?= $row['kategori_grup'] ?>" ${v.kategori_grup == '<?= $row['kategori_grup'] ?>' ? 'selected' : ''}><?= $row['kategori_grup'] ?></option>
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
                                            <button class="btn btn-info btn-sm">${v.count_bonus}</button>
                                            <button class="btn ${parseInt(v.count_bonus) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_bonus_${idx}" id="item-${i}-SKUPromoDetail2-atur_bonus" onclick="AturBonus('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${idx}','${i}')" ${ checked_bonus > 0 ? '' : 'disabled' }><i class="fa fa-pencil"></i></button>
                                        </td>
                                        <td style="vertical-align:middle; text-align:center;">
                                            <button class="btn btn-info btn-sm">${v.count_diskon}</button>
                                            <button class="btn ${parseInt(v.count_diskon) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_diskon_${idx}" id="item-${i}-SKUPromoDetail2-atur_diskon" onclick="AturDiskon('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${idx}','${i}')" ${ checked_diskon > 0 ? '' : 'disabled' }><i class="fa fa-pencil"></i></button>
                                        </td>
                                        <td style="vertical-align:middle; text-align:center;">
                                            <button class="btn btn-primary btn-small" id="item-${idx}-SKUPromoDetail2-atur_pengecualian" onclick="AturPengecualian('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${idx}','${i}')"><i class="fa fa-pencil"></i></button>
                                        </td>
                                        <td style="vertical-align:middle; text-align:center;">
                                            <button class="btn btn-danger btn-small" onclick="DeleteSKUPromoDetail2('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${i}')"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>';
                                `);
                            });

                            $.each(response, function(i, v) {
                                $.ajax({
                                    async: false,
                                    type: 'GET',
                                    url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetKategoriByPrincipleKategori') ?>",
                                    data: {
                                        principle_id: principle_id,
                                        kategori_grup: $("#item-" + idx + "-" + i + "-SKUPromoDetail2-kategori_grup").val()
                                    },
                                    dataType: "JSON",
                                    success: function(response) {
                                        $("#item-" + idx + "-" + i + "-SKUPromoDetail2-kategori_id").html('');
                                        $("#item-" + idx + "-" + i + "-SKUPromoDetail2-kategori_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);

                                        $.each(response, function(i2, v2) {
                                            $("#item-" + idx + "-" + i + "-SKUPromoDetail2-kategori_id").append(`<option value="${v2.kategori_id}" ${v.kategori_id == v2.kategori_id ? 'selected' : '' }>${v2.kategori_nama}</option>`);
                                        });
                                    }
                                });
                            });

                            $(".select2").select2();
                        }
                    }
                });

            } else if (use_group == 0) {
                $("#modal-sku-detail1").modal('show');
                $('#table-sku-detail > tbody').empty();
                // $('#table-product-promo-by-sku-' + idx + ' > tbody').empty();
                $("#FilterPencarianSKUDetail1-index").val(idx);
                $("#FilterPencarianSKUDetail1-checked_bonus").val(checked_bonus);
                $("#FilterPencarianSKUDetail1-checked_diskon").val(checked_diskon);

                $("#FilterPencarianSKUDetail1-principle_id").html('');
                $("#FilterPencarianSKUDetail1-principle_id").prop('disabled', true);
                <?php foreach ($Principle as $row) : ?>
                    $("#FilterPencarianSKUDetail1-principle_id").append(`<option value="<?= $row['principle_id'] ?>" ${ principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>`);
                <?php endforeach; ?>

                $.ajax({
                    type: 'GET',
                    url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_brand_by_principle') ?>",
                    data: {
                        principle_id: $("#FilterPencarianSKUDetail1-principle_id").val()
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $("#FilterPencarianSKUDetail1-brand_id").html('');

                        $("#FilterPencarianSKUDetail1-brand_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
                        $.each(response, function(i, v) {
                            $("#FilterPencarianSKUDetail1-brand_id").append(`<option value="${v.principle_brand_id}">${v.principle_brand_nama}</option>`);
                        });
                    }
                });

            }

        } else {
            var msg = GetLanguageByKode('CAPTION-PILIHPRINCIPLE');
            message_custom("Error", "error", msg);

        }

    }

    function GetKategoriByGroup(sku_promo_detail2_id, group, idx, idx2, principle_id) {
        // alert(idx)
        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetKategoriByGroup') ?>",
            data: {
                sku_promo_detail2_id: sku_promo_detail2_id,
                group: group,
                principle_id: principle_id
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
                //ajax save data

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
                        arr_sku_detail1 = arr_sku_detail1.filter(function(item) {
                            return item.idx != idx;
                        });

                        console.log("delete_sku_promo_detail_temp success");
                        GetPromoDetail();
                    }
                });
            }
        });

    }

    // function GetPromoDetail() {
    //     $.ajax({
    //         async: false,
    //         type: 'GET',
    //         url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail1_temp') ?>",
    //         data: {
    //             sku_promo_id: $("#SKUPromo-sku_promo_id_new").val()
    //         },
    //         dataType: "JSON",
    //         success: function(response) {
    //             $('#span_promo_detail').html('');

    //             if (response != 0) {

    //                 $.each(response, function(i, v) {

    //                     if (v.sku_promo_detail1_use_groupsku == 1) {
    //                         $('#span_promo_detail').append(`
    //                             <div class="row" id="panel-promo-detail-${i}">
    //                                 <div class="col-md-12 col-sm-12 col-xs-12">
    //                                     <div class="x_panel">
    //                                         <div class="x_title">
    //                                             <h4 class="pull-left" name="CAPTION-SKUDKIRIM">Table Input Harga #${v.sku_promo_detail1_nourut}</h4>
    //                                             <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_nourut_${i}" value="${v.sku_promo_detail1_nourut}">
    //                                             <div class="clearfix"></div>
    //                                         </div>
    //                                         <div class="row">
    //                                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    //                                                 <div class="form-group field-SKUPromoDetail-principle_id">
    //                                                     <label class="control-label" for="SKUPromoDetail-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
    //                                                     <select name="SKUPromoDetail[principle_id_${i}]" class="form-control select2" id="SKUPromoDetail-principle_id_${i}" onChange="UpdateSKUDetailPromo1('${i}')">
    //                                                         <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
    // php foreach ($Principle as $row) : ?>
    //                                                             <option value="= $row['principle_id'] ?>" ${v.principle_id=='= $row['principle_id'] ?>' ? 'selected' : '' }>= $row['principle_kode'] ?></option>
    //                                                         php endforeach; ?>
    //                                                     </select>
    //                                                 </div>
    //                                             </div>
    //                                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    //                                                 <div class="form-group field-SKUPromoDetail-sku_group_filter">
    //                                                     <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
    //                                                     <select name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
    //                                                         <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
    //                                                         <option value="1" ${v.sku_promo_detail1_use_groupsku=='1' ?'selected':''}>Ya</option>
    //                                                         <option value="0" ${v.sku_promo_detail1_use_groupsku=='0' ?'selected':''}>Tidak</option>
    //                                                     </select>
    //                                                 </div>
    //                                             </div>
    //                                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    //                                                 <div class="form-group field-SKUPromoDetail-sku_group_filter">
    //                                                     <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU"> </label><br>
    //                                                     <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_${i}" value="${v.sku_promo_detail1_id}">
    //                                                     <button class="btn btn-primary" onclick="AddSKUPromoDetail2('${i}')"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHPROMODETAIL">Tambah Promo Detail</span></button>
    //                                                 </div>
    //                                             </div>
    //                                         </div><br>
    //                                         <div class="row">
    //                                             <div class="col-xs-4">
    //                                                 <table class="table table-bordered" id="table-syarat-item-${i}" style="width:100%;height: 250px;">
    //                                                     <thead>
    //                                                         <tr>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-SYARATITEMS">Syarat Items</span></th>
    //                                                         </tr>
    //                                                     </thead>
    //                                                     <tbody>
    //                                                         <tr>
    //                                                             <td colspan="2">
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_qty_order=='1' ?'checked':''}> Dasar Jumlah Qty Order
    //                                                             </td>
    //                                                         </tr>
    //                                                         <tr>
    //                                                             <td colspan="2">
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_value_order=='1' ?'checked':''}> Dasar Jumlah Value Order
    //                                                             </td>
    //                                                         </tr>
    //                                                         <tr>
    //                                                             <td colspan="2">
    //                                                                 Min Order Product :
    //                                                                 <select class="form-control" name="SKUPromoDetail[sku_promo_detail1_min_order_sku_${i}]" id="SKUPromoDetail-sku_promo_detail1_min_order_sku_${i}" style="width:20%;" onChange="UpdateSKUDetailPromo1('${i}')">
    //                                                                     <option value="1" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>1</option>
    //                                                                     <option value="0" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>0</option>
    //                                                                 </select>
    //                                                             </td>
    //                                                         </tr>
    //                                                         <tr>
    //                                                             <td>
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_bonus_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_bonus_${i}" value="1" onClick="SetPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus=='1' ?'checked':''}> Bonus
    //                                                             </td>
    //                                                             <td>
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_diskon_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_diskon_${i}" value="1" onClick="SetPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon=='1' ?'checked':''}> Diskon
    //                                                             </td>
    //                                                         </tr>
    //                                                     </tbody>
    //                                                 </table>
    //                                             </div>
    //                                             <div class="col-xs-8">
    //                                                 <table class="table table-bordered" id="table-product-promo-${i}" style="width:100%;height: 250px;">
    //                                                     <thead>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="3"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
    //                                                         </tr>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPSKU">Group SKU</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPNAMA">Group Nama</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PENGECUALIAN">Pengecualian</span></th>
    //                                                         </tr>
    //                                                     </thead>
    //                                                     <tbody>

    //                                                     </tbody>
    //                                                 </table>
    //                                                 <table class="table table-bordered" id="table-product-promo-by-sku-${i}" style="width:100%;height: 250px;display:none;">
    //                                                     <thead>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="4"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
    //                                                         </tr>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKODE">Kode SKU</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKU">SKU</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
    //                                                         </tr>
    //                                                     </thead>
    //                                                     <tbody>

    //                                                     </tbody>
    //                                                 </table>
    //                                             </div>
    //                                         </div>
    //                                         <div class="row" style="float: right">
    //                                             <input type="hidden" id="promo_detail_index" value="0">
    //                                             <button class="btn btn-primary" id="btn_atur_bonus_semua_sku_group_${i}" onclick="ViewModalPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus=='1' ?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Bonus Semua Group SKU</span></button>
    //                                             <button class="btn btn-primary" id="btn_atur_diskon_semua_sku_group_${i}" onclick="ViewModalPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon=='1' ?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Diskon Semua Group SKU</span></button>
    //                                             <button class="btn btn-danger" id="btn_delete_promo_detail_${i}" onclick="DeletePromoDetail('${i}')"><i class="fa fa-trash"></i> <span name="CAPTION-HAPUSPROMODETAIL">Hapus Promo Detail</span></button>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                             `);

    //                         var principle_id = $("#SKUPromoDetail-principle_id_" + i).val();
    //                         var checked_bonus = $('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + i + '"]:checked').length;
    //                         var checked_diskon = $('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + i + '"]:checked').length;

    //                         $.ajax({
    //                             async: false,
    //                             type: 'GET',
    //                             url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_temp') ?>",
    //                             data: {
    //                                 sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
    //                                 sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + i).val()
    //                             },
    //                             dataType: "JSON",
    //                             success: function(response) {
    //                                 $('#table-product-promo-' + i + ' > tbody').empty();

    //                                 // if ($.fn.DataTable.isDataTable('#table-sku')) {
    //                                 // $('#table-product-promo-' + i).DataTable().clear();
    //                                 // $('#table-product-promo-' + i).DataTable().destroy();
    //                                 // }

    //                                 if (response.length > 0) {
    //                                     $.each(response, function(idx, val) {
    //                                         $('#table-product-promo-' + i + ' > tbody').append(`
    //                                             <tr id="row-${idx}">
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     ${idx+1}
    //                                                     <input type="hidden" id="item-${idx}-SKUPromoDetail2-sku_promo_detail2_id" value="${val.sku_promo_detail2_id}">
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     <select name="FilterPencarianSKU[principle_id]" class="input-sm form-control select2" id="item-${i}-${idx}-SKUPromoDetail2-kategori_grup" onchange="GetKategoriByGroup('${val.sku_promo_detail2_id}',this.value,'${i}','${idx}','${principle_id}')">
    //                                                         <option value="">** <span name="CAPTION-PILIH">Pilih</span> **${val.kategori_grup}</option>
    //                                                         php foreach ($KategoriGroup as $row) : ?>
    //                                                             <option value="= $row['kategori_grup'] ?>" ${val.kategori_grup == '= $row['kategori_grup'] ?>' ? 'selected' : '' }>= $row['kategori_grup'] ?></option>
    //                                                         php endforeach; ?>
    //                                                     </select>
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     <select name="FilterPencarianSKU[principle_id]" class="input-sm form-control select2" id="item-${i}-${idx}-SKUPromoDetail2-kategori_id" onChange="UpdateSKUDetailPromo2('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}',this.value,'0')">
    //                                                         <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
    //                                                         php foreach ($Kategori as $row) : ?>
    //                                                             <option value="= $row['kategori_id'] ?>" ${val.kategori_id=='= $row['kategori_id'] ?>' ? 'selected' : '' }>= $row['kategori_nama'] ?></option>
    //                                                         php endforeach; ?>
    //                                                     </select>
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;display:none;">
    //                                                     <span id="item-${idx}-SKUPromoDetail2-qty">0</span>
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     <button class="btn btn-info btn-sm">${val.count_bonus}</button>
    //                                                     <button class="btn ${parseInt(val.count_bonus) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_bonus_${i}" id="item-${idx}-SKUPromoDetail2-atur_bonus" onclick="AturBonus('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}')" ${checked_bonus> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     <button class="btn btn-info btn-sm">${val.count_diskon}</button>
    //                                                     <button class="btn ${parseInt(val.count_diskon) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_diskon_${i}" id="item-${idx}-SKUPromoDetail2-atur_diskon" onclick="AturDiskon('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}')" ${checked_diskon> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     <button class="btn btn-primary btn-small" id="item-${idx}-SKUPromoDetail2-atur_pengecualian" onclick="AturPengecualian('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}')"><i class="fa fa-pencil"></i></button>
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     <button class="btn btn-danger btn-small" onclick="DeleteSKUPromoDetail2('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${idx}')"><i class="fa fa-trash"></i></button>
    //                                                 </td>
    //                                             </tr>';
    //                                         `);
    //                                     });

    //                                     $.each(response, function(idx, val) {
    //                                         $.ajax({
    //                                             async: false,
    //                                             type: 'GET',
    //                                             url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetKategoriByPrincipleKategori') ?>",
    //                                             data: {
    //                                                 principle_id: principle_id,
    //                                                 kategori_grup: $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_grup").val()
    //                                             },
    //                                             dataType: "JSON",
    //                                             success: function(response) {
    //                                                 $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_id").html('');
    //                                                 $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);

    //                                                 $.each(response, function(i2, v2) {
    //                                                     $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_id").append(`<option value="${v2.kategori_id}" ${val.kategori_id == v2.kategori_id ? 'selected' : '' }>${v2.kategori_nama}</option>`);
    //                                                 });
    //                                             }
    //                                         });
    //                                     });

    //                                     // $('#table-product-promo-' + i).DataTable({
    //                                     // "lengthMenu": [
    //                                     // [-1],
    //                                     // ["All"]
    //                                     // ],
    //                                     // "paging": false,
    //                                     // "ordering": false,
    //                                     // "searching": false,
    //                                     // "info": false,
    //                                     // scrollY: '300px',
    //                                     // scrollCollapse: true
    //                                     // });
    //                                 }
    //                             }
    //                         });
    //                     } else if (v.sku_promo_detail1_use_groupsku == 0) {
    //                         $('#span_promo_detail').append(`
    //                             <div class="row" id="panel-promo-detail-${i}">
    //                                 <div class="col-md-12 col-sm-12 col-xs-12">
    //                                     <div class="x_panel">
    //                                         <div class="x_title">
    //                                             <h4 class="pull-left" name="CAPTION-SKUDKIRIM">Table Input Harga #${v.sku_promo_detail1_nourut}</h4>
    //                                             <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_nourut_${i}" value="${v.sku_promo_detail1_nourut}">
    //                                             <div class="clearfix"></div>
    //                                         </div>
    //                                         <div class="row">
    //                                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    //                                                 <div class="form-group field-SKUPromoDetail-principle_id">
    //                                                     <label class="control-label" for="SKUPromoDetail-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
    //                                                     <select name="SKUPromoDetail[principle_id_${i}]" class="form-control select2" id="SKUPromoDetail-principle_id_${i}" onChange="UpdateSKUDetailPromo1('${i}')">
    //                                                         <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
    //                                                         php foreach ($Principle as $row) : ?>
    //                                                             <option value="= $row['principle_id'] ?>" ${v.principle_id=='= $row['principle_id'] ?>' ? 'selected' : '' }>= $row['principle_kode'] ?></option>
    //                                                         php endforeach; ?>
    //                                                     </select>
    //                                                 </div>
    //                                             </div>
    //                                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    //                                                 <div class="form-group field-SKUPromoDetail-sku_group_filter">
    //                                                     <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
    //                                                     <select name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
    //                                                         <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
    //                                                         <option value="1" ${v.sku_promo_detail1_use_groupsku=='1' ?'selected':''}>Ya</option>
    //                                                         <option value="0" ${v.sku_promo_detail1_use_groupsku=='0' ?'selected':''}>Tidak</option>
    //                                                     </select>
    //                                                 </div>
    //                                             </div>
    //                                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    //                                                 <div class="form-group field-SKUPromoDetail-sku_group_filter">
    //                                                     <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU"> </label><br>
    //                                                     <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_${i}" value="${v.sku_promo_detail1_id}">
    //                                                     <button class="btn btn-primary" onclick="AddSKUPromoDetail2('${i}')"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHPROMODETAIL">Tambah Promo Detail</span></button>
    //                                                 </div>
    //                                             </div>
    //                                         </div><br>
    //                                         <div class="row">
    //                                             <div class="col-xs-4">
    //                                                 <table class="table table-bordered" id="table-syarat-item-${i}" style="width:100%;height: 250px;">
    //                                                     <thead>
    //                                                         <tr>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-SYARATITEMS">Syarat Items</span></th>
    //                                                         </tr>
    //                                                     </thead>
    //                                                     <tbody>
    //                                                         <tr>
    //                                                             <td colspan="2">
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_qty_order=='1' ?'checked':''}> Dasar Jumlah Qty Order
    //                                                             </td>
    //                                                         </tr>
    //                                                         <tr>
    //                                                             <td colspan="2">
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_value_order=='1' ?'checked':''}> Dasar Jumlah Value Order
    //                                                             </td>
    //                                                         </tr>
    //                                                         <tr>
    //                                                             <td colspan="2">
    //                                                                 Min Order Product :
    //                                                                 <select class="form-control" name="SKUPromoDetail[sku_promo_detail1_min_order_sku_${i}]" id="SKUPromoDetail-sku_promo_detail1_min_order_sku_${i}" style="width:20%;" onChange="UpdateSKUDetailPromo1('${i}')">
    //                                                                     <option value="1" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>1</option>
    //                                                                     <option value="0" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>0</option>
    //                                                                 </select>
    //                                                             </td>
    //                                                         </tr>
    //                                                         <tr>
    //                                                             <td>
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_bonus_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_bonus_${i}" value="1" onClick="SetPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus=='1' ?'checked':''}> Bonus
    //                                                             </td>
    //                                                             <td>
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_diskon_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_diskon_${i}" value="1" onClick="SetPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon=='1' ?'checked':''}> Diskon
    //                                                             </td>
    //                                                         </tr>
    //                                                     </tbody>
    //                                                 </table>
    //                                             </div>
    //                                             <div class="col-xs-8">
    //                                                 <table class="table table-bordered" id="table-product-promo-${i}" style="width:100%;height: 250px;display:none;">
    //                                                     <thead>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="3"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
    //                                                         </tr>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPSKU">Group SKU</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPNAMA">Group Nama</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PENGECUALIAN">Pengecualian</span></th>
    //                                                         </tr>
    //                                                     </thead>
    //                                                     <tbody>

    //                                                     </tbody>
    //                                                 </table>
    //                                                 <table class="table table-bordered" id="table-product-promo-by-sku-${i}" style="width:100%;height: 250px;">
    //                                                     <thead>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="4"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
    //                                                         </tr>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKODE">Kode SKU</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKU">SKU</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
    //                                                         </tr>
    //                                                     </thead>
    //                                                     <tbody>

    //                                                     </tbody>
    //                                                 </table>
    //                                             </div>
    //                                         </div>
    //                                         <div class="row" style="float: right">
    //                                             <input type="hidden" id="promo_detail_index" value="0">
    //                                             <button class="btn btn-primary" id="btn_atur_bonus_semua_sku_group_${i}" onclick="ViewModalPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus=='1' ?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Bonus Semua Group SKU</span></button>
    //                                             <button class="btn btn-primary" id="btn_atur_diskon_semua_sku_group_${i}" onclick="ViewModalPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon=='1' ?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Diskon Semua Group SKU</span></button>
    //                                             <button class="btn btn-danger" id="btn_delete_promo_detail_${i}" onclick="DeletePromoDetail('${i}')"><i class="fa fa-trash"></i> <span name="CAPTION-HAPUSPROMODETAIL">Hapus Promo Detail</span></button>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         `);

    //                         var checked_bonus = $('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + i + '"]:checked').length;
    //                         var checked_diskon = $('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + i + '"]:checked').length;

    //                         $.ajax({
    //                             async: false,
    //                             type: 'GET',
    //                             url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_temp') ?>",
    //                             data: {
    //                                 sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
    //                                 sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + i).val()
    //                             },
    //                             dataType: "JSON",
    //                             success: function(response) {
    //                                 $('#table-product-promo-by-sku-' + i + ' > tbody').empty();

    //                                 // if ($.fn.DataTable.isDataTable('#table-sku')) {
    //                                 // $('#table-product-promo-' + i).DataTable().clear();
    //                                 // $('#table-product-promo-' + i).DataTable().destroy();
    //                                 // }

    //                                 if (response.length > 0) {
    //                                     $.each(response, function(idx, val) {
    //                                         $('#table-product-promo-by-sku-' + i + ' > tbody').append(`
    //                                             <tr id="row-${idx}">
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     ${idx+1}
    //                                                     <input type="hidden" id="item-${idx}-SKUPromoDetail2-sku_promo_detail2_id" value="${val.sku_promo_detail2_id}">
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     ${val.sku_kode}
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     ${val.sku_nama_produk}
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     ${val.sku_kemasan}
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     ${val.sku_satuan}
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;display:none;">
    //                                                     <span id="item-${idx}-SKUPromoDetail2-qty">0</span>
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     <button class="btn btn-info btn-sm">${val.count_bonus}</button>
    //                                                     <button class="btn ${parseInt(val.count_bonus) > 0 ? 'btn-success' : 'btn-warning'}  btn-small btn_atur_bonus_${idx}" id="item-${idx}-SKUPromoDetail2-atur_bonus" onclick="AturBonusBySKU('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}','${val.sku_id}','${val.sku_kode}','${val.sku_nama_produk}','${val.sku_kemasan}','${val.sku_satuan}')" ${checked_bonus> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     ${val.count_diskon}
    //                                                     <button class="btn ${parseInt(val.count_diskon) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_diskon_${idx}" id="item-${idx}-SKUPromoDetail2-atur_diskon" onclick="AturDiskonBySKU('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}','${val.sku_id}','${val.sku_kode}','${val.sku_nama_produk}','${val.sku_kemasan}','${val.sku_satuan}')" ${checked_diskon> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
    //                                                 </td>
    //                                                 <td style="vertical-align:middle; text-align:center;">
    //                                                     <button class="btn btn-danger btn-small" onclick="DeleteSKUPromoDetail2('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${idx}')"><i class="fa fa-trash"></i></button>
    //                                                 </td>
    //                                             </tr>';
    //                                         `);
    //                                     });

    //                                     // $('#table-product-promo-' + i).DataTable({
    //                                     // "lengthMenu": [
    //                                     // [-1],
    //                                     // ["All"]
    //                                     // ],
    //                                     // "paging": false,
    //                                     // "ordering": false,
    //                                     // "searching": false,
    //                                     // "info": false,
    //                                     // scrollY: '300px',
    //                                     // scrollCollapse: true
    //                                     // });
    //                                 }
    //                             }
    //                         });

    //                     } else {
    //                         $('#span_promo_detail').append(`
    //                             <div class="row" id="panel-promo-detail-${i}">
    //                                 <div class="col-md-12 col-sm-12 col-xs-12">
    //                                     <div class="x_panel">
    //                                         <div class="x_title">
    //                                             <h4 class="pull-left" name="CAPTION-SKUDKIRIM">Table Input Harga #${v.sku_promo_detail1_nourut}</h4>
    //                                             <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_nourut_${i}" value="${v.sku_promo_detail1_nourut}">
    //                                             <div class="clearfix"></div>
    //                                         </div>
    //                                         <div class="row">
    //                                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    //                                                 <div class="form-group field-SKUPromoDetail-principle_id">
    //                                                     <label class="control-label" for="SKUPromoDetail-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
    //                                                     <select name="SKUPromoDetail[principle_id_${i}]" class="form-control select2" id="SKUPromoDetail-principle_id_${i}" onChange="UpdateSKUDetailPromo1('${i}')">
    //                                                         <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
    //                                                         php foreach ($Principle as $row) : ?>
    //                                                             <option value="= $row['principle_id'] ?>" ${v.principle_id=='= $row['principle_id'] ?>' ? 'selected' : '' }>= $row['principle_kode'] ?></option>
    //                                                         php endforeach; ?>
    //                                                     </select>
    //                                                 </div>
    //                                             </div>
    //                                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    //                                                 <div class="form-group field-SKUPromoDetail-sku_group_filter">
    //                                                     <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
    //                                                     <select name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
    //                                                         <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
    //                                                         <option value="1" ${v.sku_promo_detail1_use_groupsku=='1' ?'selected':''}>Ya</option>
    //                                                         <option value="0" ${v.sku_promo_detail1_use_groupsku=='0' ?'selected':''}>Tidak</option>
    //                                                     </select>
    //                                                 </div>
    //                                             </div>
    //                                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    //                                                 <div class="form-group field-SKUPromoDetail-sku_group_filter">
    //                                                     <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU"> </label><br>
    //                                                     <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_${i}" value="${v.sku_promo_detail1_id}">
    //                                                     <button class="btn btn-primary" onclick="AddSKUPromoDetail2('${i}')"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHPROMODETAIL">Tambah Promo Detail</span></button>
    //                                                 </div>
    //                                             </div>
    //                                         </div><br>
    //                                         <div class="row">
    //                                             <div class="col-xs-4">
    //                                                 <table class="table table-bordered" id="table-syarat-item-${i}" style="width:100%;height: 250px;">
    //                                                     <thead>
    //                                                         <tr>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-SYARATITEMS">Syarat Items</span></th>
    //                                                         </tr>
    //                                                     </thead>
    //                                                     <tbody>
    //                                                         <tr>
    //                                                             <td colspan="2">
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')"> Dasar Jumlah Qty Order
    //                                                             </td>
    //                                                         </tr>
    //                                                         <tr>
    //                                                             <td colspan="2">
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')"> Dasar Jumlah Value Order
    //                                                             </td>
    //                                                         </tr>
    //                                                         <tr>
    //                                                             <td colspan="2">
    //                                                                 Min Order Product :
    //                                                                 <select class="form-control" name="SKUPromoDetail[sku_promo_detail1_min_order_sku_${i}]" id="SKUPromoDetail-sku_promo_detail1_min_order_sku_${i}" style="width:20%;" onChange="UpdateSKUDetailPromo1('${i}')">
    //                                                                     <option value="1">1</option>
    //                                                                     <option value="0">0</option>
    //                                                                 </select>
    //                                                             </td>
    //                                                         </tr>
    //                                                         <tr>
    //                                                             <td>
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_bonus_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_bonus_${i}" value="1" onClick="SetPengaturanBonus('${i}')"> Bonus
    //                                                             </td>
    //                                                             <td>
    //                                                                 <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_diskon_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_diskon_${i}" value="1" onClick="SetPengaturanDiskon('${i}')"> Diskon
    //                                                             </td>
    //                                                         </tr>
    //                                                     </tbody>
    //                                                 </table>
    //                                             </div>
    //                                             <div class="col-xs-8">
    //                                                 <table class="table table-bordered" id="table-product-promo-${i}" style="width:100%;height: 250px;display:none;">
    //                                                     <thead>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="3"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
    //                                                         </tr>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPSKU">Group SKU</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPNAMA">Group Nama</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PENGECUALIAN">Pengecualian</span></th>
    //                                                         </tr>
    //                                                     </thead>
    //                                                     <tbody>

    //                                                     </tbody>
    //                                                 </table>
    //                                                 <table class="table table-bordered" id="table-product-promo-by-sku-${i}" style="width:100%;height: 250px;display:none;">
    //                                                     <thead>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="4"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
    //                                                         </tr>
    //                                                         <tr style="height: 40px;">
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKODE">Kode SKU</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKU">SKU</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
    //                                                             <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
    //                                                         </tr>
    //                                                     </thead>
    //                                                     <tbody>

    //                                                     </tbody>
    //                                                 </table>
    //                                             </div>
    //                                         </div>
    //                                         <div class="row" style="float: right">
    //                                             <input type="hidden" id="promo_detail_index" value="0">
    //                                             <button class="btn btn-primary" id="btn_atur_bonus_semua_sku_group_${i}" onclick="ViewModalPengaturanBonus('${i}')" disabled><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Bonus Semua Group SKU</span></button>
    //                                             <button class="btn btn-primary" id="btn_atur_diskon_semua_sku_group_${i}" onclick="ViewModalPengaturanDiskon('${i}')" disabled><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Diskon Semua Group SKU</span></button>
    //                                             <button class="btn btn-danger" id="btn_delete_promo_detail_${i}" onclick="DeletePromoDetail('${i}')"><i class="fa fa-trash"></i> <span name="CAPTION-HAPUSPROMODETAIL">Hapus Promo Detail</span></button>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         `);
    //                     }
    //                 });

    //                 $(".select2").select2();
    //             }
    //         }
    //     });
    // }

    function GetPromoDetail() {
        var headerPerusahaan = $("#headerPerusahaan").val();

        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail1_temp') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                perusahaan: headerPerusahaan
            },
            dataType: "JSON",
            success: function(response) {
                $('#span_promo_detail').html('');

                if (response.data != 0) {
                    $("#headerPerusahaan").prop("disabled", true);

                    $.each(response.data, function(i, v) {
                        var slc = ''
                        $.each(response.principle, function(ii, vv) {
                            slc += `<option value="${vv.principle_id}" ${v.principle_id == vv.principle_id ? 'selected' : ''}>${vv.principle_kode}</option>`
                        });

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
                                                            ${slc}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-sku_group_filter">
                                                        <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
                                                        <select name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
                                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                            <option value="1" ${v.sku_promo_detail1_use_groupsku=='1' ?'selected':''}>Ya</option>
                                                            <option value="0" ${v.sku_promo_detail1_use_groupsku=='0' ?'selected':''}>Tidak</option>
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
                                                                    <input onclick="chgQtyOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_qty_order=='1' ?'checked':''}> Dasar Jumlah Qty Order
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <input onclick="chgValueOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_value_order=='1' ?'checked':''}> Dasar Jumlah Value Order
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    Min Order Product :
                                                                    <select class="form-control" name="SKUPromoDetail[sku_promo_detail1_min_order_sku_${i}]" id="SKUPromoDetail-sku_promo_detail1_min_order_sku_${i}" style="width:20%;" onChange="UpdateSKUDetailPromo1('${i}')">
                                                                        <option value="1" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>1</option>
                                                                        <option value="0" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>0</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_bonus_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_bonus_${i}" value="1" onClick="SetPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus=='1' ?'checked':''}> Bonus
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_diskon_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_diskon_${i}" value="1" onClick="SetPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon=='1' ?'checked':''}> Diskon
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
                                                <button class="btn btn-primary" id="btn_atur_bonus_semua_sku_group_${i}" onclick="ViewModalPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus=='1' ?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Bonus Semua Group SKU</span></button>
                                                <button class="btn btn-primary" id="btn_atur_diskon_semua_sku_group_${i}" onclick="ViewModalPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon=='1' ?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Diskon Semua Group SKU</span></button>
                                                <button class="btn btn-danger" id="btn_delete_promo_detail_${i}" onclick="DeletePromoDetail('${i}')"><i class="fa fa-trash"></i> <span name="CAPTION-HAPUSPROMODETAIL">Hapus Promo Detail</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `);

                            var principle_id = $("#SKUPromoDetail-principle_id_" + i).val();
                            var checked_bonus = $('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + i + '"]:checked').length;
                            var checked_diskon = $('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + i + '"]:checked').length;

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

                                    if (response.length > 0) {
                                        $.each(response, function(idx, val) {
                                            $('#table-product-promo-' + i + ' > tbody').append(`
                                                <tr id="row-${idx}">
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        ${idx+1}
                                                        <input type="hidden" id="item-${idx}-SKUPromoDetail2-sku_promo_detail2_id" value="${val.sku_promo_detail2_id}">
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        <select name="FilterPencarianSKU[principle_id]" class="input-sm form-control select2" id="item-${i}-${idx}-SKUPromoDetail2-kategori_grup" onchange="GetKategoriByGroup('${val.sku_promo_detail2_id}',this.value,'${i}','${idx}','${principle_id}')">
                                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **${val.kategori_grup}</option>
                                                            <?php foreach ($KategoriGroup as $row) : ?>
                                                                <option value="<?= $row['kategori_grup'] ?>" ${val.kategori_grup == '<?= $row['kategori_grup'] ?>' ? 'selected' : '' }><?= $row['kategori_grup'] ?></option>
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
                                                        <button class="btn btn-info btn-sm">${val.count_bonus}</button>
                                                        <button class="btn ${parseInt(val.count_bonus) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_bonus_${i}" id="item-${idx}-SKUPromoDetail2-atur_bonus" onclick="AturBonus('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}')" ${checked_bonus> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        <button class="btn btn-info btn-sm">${val.count_diskon}</button>
                                                        <button class="btn ${parseInt(val.count_diskon) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_diskon_${i}" id="item-${idx}-SKUPromoDetail2-atur_diskon" onclick="AturDiskon('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}')" ${checked_diskon> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
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

                                        $.each(response, function(idx, val) {
                                            $.ajax({
                                                async: false,
                                                type: 'GET',
                                                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetKategoriByPrincipleKategori') ?>",
                                                data: {
                                                    principle_id: principle_id,
                                                    kategori_grup: $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_grup").val()
                                                },
                                                dataType: "JSON",
                                                success: function(response) {
                                                    $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_id").html('');
                                                    $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);

                                                    $.each(response, function(i2, v2) {
                                                        $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_id").append(`<option value="${v2.kategori_id}" ${val.kategori_id == v2.kategori_id ? 'selected' : '' }>${v2.kategori_nama}</option>`);
                                                    });
                                                }
                                            });
                                        });

                                        // $('#table-product-promo-' + i).DataTable({
                                        // "lengthMenu": [
                                        // [-1],
                                        // ["All"]
                                        // ],
                                        // "paging": false,
                                        // "ordering": false,
                                        // "searching": false,
                                        // "info": false,
                                        // scrollY: '300px',
                                        // scrollCollapse: true
                                        // });
                                    }
                                }
                            });
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
                                                            ${slc}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-sku_group_filter">
                                                        <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
                                                        <select name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
                                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                            <option value="1" ${v.sku_promo_detail1_use_groupsku=='1' ?'selected':''}>Ya</option>
                                                            <option value="0" ${v.sku_promo_detail1_use_groupsku=='0' ?'selected':''}>Tidak</option>
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
                                                                    <input onclick="chgQtyOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_qty_order=='1' ?'checked':''}> Dasar Jumlah Qty Order
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <input onclick="chgValueOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_value_order=='1' ?'checked':''}> Dasar Jumlah Value Order
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    Min Order Product :
                                                                    <select class="form-control" name="SKUPromoDetail[sku_promo_detail1_min_order_sku_${i}]" id="SKUPromoDetail-sku_promo_detail1_min_order_sku_${i}" style="width:20%;" onChange="UpdateSKUDetailPromo1('${i}')">
                                                                        <option value="1" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>1</option>
                                                                        <option value="0" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>0</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_bonus_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_bonus_${i}" value="1" onClick="SetPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus=='1' ?'checked':''}> Bonus
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_diskon_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_diskon_${i}" value="1" onClick="SetPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon=='1' ?'checked':''}> Diskon
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
                                                <button class="btn btn-primary" id="btn_atur_bonus_semua_sku_group_${i}" onclick="ViewModalPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus=='1' ?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Bonus Semua Group SKU</span></button>
                                                <button class="btn btn-primary" id="btn_atur_diskon_semua_sku_group_${i}" onclick="ViewModalPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon=='1' ?'':'disabled'}><i class="fa fa-search"></i> <span name="CAPTION-HAPUSPROMODETAIL">Atur Diskon Semua Group SKU</span></button>
                                                <button class="btn btn-danger" id="btn_delete_promo_detail_${i}" onclick="DeletePromoDetail('${i}')"><i class="fa fa-trash"></i> <span name="CAPTION-HAPUSPROMODETAIL">Hapus Promo Detail</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);

                            var checked_bonus = $('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + i + '"]:checked').length;
                            var checked_diskon = $('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + i + '"]:checked').length;

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
                                    $('#table-product-promo-by-sku-' + i + ' > tbody').empty();

                                    // if ($.fn.DataTable.isDataTable('#table-sku')) {
                                    // $('#table-product-promo-' + i).DataTable().clear();
                                    // $('#table-product-promo-' + i).DataTable().destroy();
                                    // }

                                    arr_sku_detail1 = arr_sku_detail1.filter(function(item) {
                                        return item.idx != i;
                                    });

                                    if (response.length > 0) {
                                        $.each(response, function(idx, val) {
                                            arr_sku_detail1.push({
                                                sku_id: val.sku_id,
                                                idx: i
                                            })

                                            $('#table-product-promo-by-sku-' + i + ' > tbody').append(`
                                                <tr id="row-${idx}">
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        ${idx+1}
                                                        <input type="hidden" id="item-${idx}-SKUPromoDetail2-sku_promo_detail2_id" value="${val.sku_promo_detail2_id}">
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
                                                        <button class="btn btn-info btn-sm">${val.count_bonus}</button>
                                                        <button class="btn ${parseInt(val.count_bonus) > 0 ? 'btn-success' : 'btn-warning'}  btn-small btn_atur_bonus_${idx}" id="item-${idx}-SKUPromoDetail2-atur_bonus" onclick="AturBonusBySKU('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}','${val.sku_id}','${val.sku_kode}','${val.sku_nama_produk}','${val.sku_kemasan}','${val.sku_satuan}')" ${checked_bonus> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        <button class="btn btn-info btn-sm">${val.count_diskon}</button>
                                                        <button class="btn ${parseInt(val.count_diskon) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_diskon_${idx}" id="item-${idx}-SKUPromoDetail2-atur_diskon" onclick="AturDiskonBySKU('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}','${val.sku_id}','${val.sku_kode}','${val.sku_nama_produk}','${val.sku_kemasan}','${val.sku_satuan}')" ${checked_diskon> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        <button class="btn btn-danger btn-small" onclick="DeleteSKUPromoDetail2('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${idx}')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>';
                                            `);
                                        });

                                        // $('#table-product-promo-' + i).DataTable({
                                        // "lengthMenu": [
                                        // [-1],
                                        // ["All"]
                                        // ],
                                        // "paging": false,
                                        // "ordering": false,
                                        // "searching": false,
                                        // "info": false,
                                        // scrollY: '300px',
                                        // scrollCollapse: true
                                        // });
                                    }
                                }
                            });

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
                                                            ${slc}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-sku_group_filter">
                                                        <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
                                                        <select name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
                                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                            <option value="1" ${v.sku_promo_detail1_use_groupsku=='1' ?'selected':''}>Ya</option>
                                                            <option value="0" ${v.sku_promo_detail1_use_groupsku=='0' ?'selected':''}>Tidak</option>
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
                                                                    <input onclick="chgQtyOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')"> Dasar Jumlah Qty Order
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <input onclick="chgValueOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')"> Dasar Jumlah Value Order
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
                    });

                    $(".select2").select2();
                }
            }
        });
    }


    function DeleteSKUPromoDetail2(sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, idx) {
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
                //ajax save data
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
        });
    }

    function chgQtyOrder(checked, index) {
        $(`#SKUPromoDetail-sku_promo_detail1_use_value_order_${index}`).prop('checked', false);
    }

    function chgValueOrder(checked, index) {
        $(`#SKUPromoDetail-sku_promo_detail1_use_qty_order_${index}`).prop('checked', false);
    }

    function SetPengaturanBonus(idx) {
        var checked = $('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + idx + '"]:checked').length;
        var sku_promo_id = $('#SKUPromo-sku_promo_id').val();
        var sku_promo_detail1_id = $('#SKUPromoDetail-sku_promo_detail1_id_' + idx).val();

        Swal.fire({
            title: GetLanguageByKode('CAPTION-APAANDAYAKIN'),
            text: GetLanguageByKode('CAPTION-MENGGANTIKEBONUS'),
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: GetLanguageByKode('CAPTION-LANJUT'),
            cancelButtonText: GetLanguageByKode('CAPTION-CLOSE')
        }).then((result) => {
            if (result.value == true) {

                UpdateSKUDetailPromo1(idx);

                if (checked > 0) {
                    $("#btn_atur_bonus_semua_sku_group_" + idx).prop("disabled", false);
                    $(".btn_atur_bonus_" + idx).prop("disabled", false);
                } else {
                    $("#btn_atur_bonus_semua_sku_group_" + idx).prop("disabled", true);
                    $(".btn_atur_bonus_" + idx).prop("disabled", true);

                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_detail2_bonus_temp_by_detail1') ?>",
                        data: {
                            sku_promo_id: sku_promo_id,
                            sku_promo_detail1_id: sku_promo_detail1_id
                        },
                        dataType: "JSON",
                        success: function(response) {
                            console.log("delete_sku_promo_detail2_bonus_temp_by_detail1 success");
                            GetPromoDetail();
                        }
                    });
                }
            }
        });
    }

    function SetPengaturanDiskon(idx) {
        var checked = $('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + idx + '"]:checked').length;
        var sku_promo_id = $('#SKUPromo-sku_promo_id').val();
        var sku_promo_detail1_id = $('#SKUPromoDetail-sku_promo_detail1_id_' + idx).val();

        Swal.fire({
            title: GetLanguageByKode('CAPTION-APAANDAYAKIN'),
            text: GetLanguageByKode('CAPTION-MENGGANTIKEDISKON'),
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: GetLanguageByKode('CAPTION-LANJUT'),
            cancelButtonText: GetLanguageByKode('CAPTION-CLOSE')
        }).then((result) => {
            if (result.value == true) {

                UpdateSKUDetailPromo1(idx);

                if (checked > 0) {
                    $("#btn_atur_diskon_semua_sku_group_" + idx).prop("disabled", false);
                    $(".btn_atur_diskon_" + idx).prop("disabled", false);
                } else {
                    $("#btn_atur_diskon_semua_sku_group_" + idx).prop("disabled", true);
                    $(".btn_atur_diskon_" + idx).prop("disabled", true);

                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_detail2_diskon_temp_by_detail1') ?>",
                        data: {
                            sku_promo_id: sku_promo_id,
                            sku_promo_detail1_id: sku_promo_detail1_id
                        },
                        dataType: "JSON",
                        success: function(response) {
                            console.log("delete_sku_promo_detail2_diskon_temp_by_detail1 success");

                            GetPromoDetail();
                        }
                    });
                }
            }
        });
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
                //ajax save data

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
                        // 	message_custom("Success", "success", msg);

                        // } else {
                        // 	var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDIHAPUS');
                        // 	message_custom("Error", "error", msg);

                        // }
                    }
                });
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
                //ajax save data
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
        });
    }

    function AturPengecualian(sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, idx, idx2) {
        $("#modal-sku-pengecualian").modal('show');

        var sku_group_id = $("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_grup").val();
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

    function UpdateSKUPromoDetail2Bonus(idx, act) {

        var sku_promo_detail2_bonus_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id").val();
        var sku_promo_detail2_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_id").val();
        var sku_promo_detail1_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail1_id").val();
        var sku_promo_id = $("#SKUPromo-sku_promo_id_new").val();
        var sku_min_qty = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty").val();
        var is_berkelipatan = $("#item-" + idx + "-SKUPromoDetail2Bonus-is_berkelipatan").prop('checked');
        var sku_promo_detail2_bonus_nourut = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut").val();
        var dasarJumlahOrder = $("#dasar_jumlah_order").val();

        if (act == "all") {
            sku_promo_detail2_bonus_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id").val();
            sku_promo_detail2_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_id").val();
            sku_promo_detail1_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail1_id").val();
            sku_promo_id = $("#SKUPromo-sku_promo_id_new").val();
            sku_min_qty = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty").val();
            is_berkelipatan = $("#item-" + idx + "-SKUPromoDetail2Bonus-is_berkelipatan").prop('checked');
            sku_promo_detail2_bonus_nourut = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut").val();

        } else if (act == "by_one") {
            sku_promo_detail2_bonus_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one").val();
            sku_promo_detail2_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one").val();
            sku_promo_detail1_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one").val();
            sku_promo_id = $("#SKUPromo-sku_promo_id_new").val();
            sku_min_qty = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty_by_one").val().replaceAll(",", "");
            is_berkelipatan = $("#item-" + idx + "-SKUPromoDetail2Bonus-is_berkelipatan_by_one").prop('checked');
            sku_promo_detail2_bonus_nourut = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut_by_one").val();

        } else if (act == "by_sku") {
            sku_promo_detail2_bonus_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_sku").val();
            sku_promo_detail2_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_id_by_sku").val();
            sku_promo_detail1_id = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail1_id_by_sku").val();
            sku_promo_id = $("#SKUPromo-sku_promo_id_new").val();
            sku_min_qty = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty_by_sku").val().replaceAll(",", "");;
            is_berkelipatan = $("#item-" + idx + "-SKUPromoDetail2Bonus-is_berkelipatan_by_sku").prop('checked');
            sku_promo_detail2_bonus_nourut = $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut_by_sku").val();
        }

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/update_sku_promo_detail2_bonus_temp') ?>",
            data: {
                sku_promo_detail2_bonus_id: sku_promo_detail2_bonus_id,
                sku_promo_detail2_id: sku_promo_detail2_id,
                sku_promo_detail1_id: sku_promo_detail1_id,
                sku_promo_id: sku_promo_id,
                sku_min_qty: sku_min_qty,
                is_berkelipatan: is_berkelipatan == true ? '1' : '0',
                sku_promo_detail2_bonus_nourut: sku_promo_detail2_bonus_nourut,
                dasarJumlahOrder: dasarJumlahOrder
            },
            dataType: "JSON",
            success: function(response) {

                if (response == 1) {
                    console.log("update_sku_promo_detail2_bonus_temp berhasil");
                    // GetPromoDetail();

                } else {
                    console.log("update_sku_promo_detail2_bonus_temp gagal");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log("update_sku_promo_detail2_bonus_temp gagal");
            }
        });


    }

    //end function group

    //start button group
    $("#btn_search_sku").click(function() {
        var principle_id = $("#Filter-principle_id").val();

        $("#table-sku tbody").empty();

        $("#modal-sku").modal('show');

        $("#FilterPencarianSKU-principle_id").html('');

        <?php foreach ($Principle as $row) : ?>
            $("#FilterPencarianSKU-principle_id").append(`<option value="<?= $row['principle_id'] ?>" ${ principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>`);
        <?php endforeach; ?>

        $("#FilterPencarianSKU-brand_id").html('');
        $("#FilterPencarianSKU-brand_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_brand_by_principle') ?>",
            data: {
                principle_id: principle_id
            },
            dataType: "JSON",
            success: function(response) {
                if (response != 0) {
                    $.each(response, function(i, v) {
                        $("#FilterPencarianSKU-brand_id").append(`<option value="${v.principle_brand_id}">${v.principle_brand_nama}</option>`);
                    });
                }
            }
        });
    });

    $("#btn_search_sku_by_one").click(function() {
        var principle_id = $("#Filter-principle_id_by_one").val();

        $("#modal-sku").modal('show');

        $("#table-sku > tbody").empty();

        $("#FilterPencarianSKU-principle_id").html('');
        $("#FilterPencarianSKU-principle_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
        <?php foreach ($Principle as $row) : ?>
            $("#FilterPencarianSKU-principle_id").append(`<option value="<?= $row['principle_id'] ?>" ${ principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>`);
        <?php endforeach; ?>

        $("#FilterPencarianSKU-brand_id").html('');
        $("#FilterPencarianSKU-brand_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_brand_by_principle') ?>",
            data: {
                principle_id: principle_id
            },
            dataType: "JSON",
            success: function(response) {
                if (response != 0) {
                    $.each(response, function(i, v) {
                        $("#FilterPencarianSKU-brand_id").append(`<option value="${v.principle_brand_id}">${v.principle_brand_nama}</option>`);
                    });
                }
            }
        });
    });

    $("#btn_search_sku_by_sku").click(function() {
        var principle_id = $("#Filter-principle_id_by_sku").val();

        $("#modal-sku").modal('show');

        $("#FilterPencarianSKU-principle_id").html('');
        <?php foreach ($Principle as $row) : ?>
            $("#FilterPencarianSKU-principle_id").append(`<option value="<?= $row['principle_id'] ?>" ${ principle_id == '<?= $row['principle_id'] ?>' ? 'selected' : ''}><?= $row['principle_kode'] ?></option>`);
        <?php endforeach; ?>

        $("#FilterPencarianSKU-brand_id").html('');
        $("#FilterPencarianSKU-brand_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_brand_by_principle') ?>",
            data: {
                principle_id: principle_id
            },
            dataType: "JSON",
            success: function(response) {
                if (response != 0) {
                    $.each(response, function(i, v) {
                        $("#FilterPencarianSKU-brand_id").append(`<option value="${v.principle_brand_id}">${v.principle_brand_nama}</option>`);
                    });
                }
            }
        });
    });

    $("#btn_tambah_promo_detail2").click(function() {

        // $.ajax({
        //     async: false,
        //     type: 'POST',
        //     url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_bonus_temp') ?>",
        //     data: {
        //         sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
        //         sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id").val()
        //     },
        //     dataType: "JSON",
        //     success: function(response) {
        //         console.log("insert_sku_promo_detail2_bonus_temp success");
        //     }
        // });

        // GetPromoDetail2Bonus();

        var totalData = $("#table-pengaturan-header tbody tr").length
        if (totalData == 0) {
            var no = 1;
        } else {
            var no = totalData + 1;
        }

        var randomId = generateRandomId(10); // Panjang ID acak 10 karakter

        var stringValue = $("#dasar_jumlah_order").val();
        if (stringValue == 'value order') {
            str = `<input type="text" onkeyup="formatNominal(this)" id="item-${no}-SKUPromoDetail2Bonus-sku_min_qty" class="form-control input-sm" value="" onChange="UpdateSKUPromoDetail2Bonus2('${randomId}', this.value, 'minQty')" />`
        } else {
            str = `<input type="number" id="item-${no}-SKUPromoDetail2Bonus-sku_min_qty" class="form-control input-sm" value="" onChange="UpdateSKUPromoDetail2Bonus2('${randomId}', this.value, 'minQty')" />`
        }

        // $('#table-pengaturan-header > tbody').empty();

        $('#table-pengaturan-header > tbody').append(`
						<tr>
							<td class="text-center">
								${no}
							</td>
							<td class="text-center">
								${str}
							</td>
							<td class="text-center">
								<input type="checkbox" id="item-${no}-SKUPromoDetail2Bonus-is_berkelipatan" value="" onChange="UpdateSKUPromoDetail2Bonus2('${randomId}', this.checked, 'kelipatan')"/>
							</td>
							<td class="text-center">
								<button class="btn btn-primary btn-sm" onclick="ViewBonusDetail22('${randomId}')"><i class="fa fa-pencil"></i></button>
								<button class="btn btn-danger btn-sm" onclick="DeletePromoDetail2Bonus2(this, '${randomId}')"><i class="fa fa-trash"></i></button>
							</td>
						</tr>';
		`);

        arr_pengaturan_header.push({
            sku_min_qty: '',
            kelipatan: '',
            random_id: randomId,
            detail: []
        })
    });

    function DeletePromoDetail2Bonus2(event, randomId) {

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
                var row = event.parentNode.parentNode;
                row.parentNode.removeChild(row);

                $("#table-pengaturan-header tbody tr").each(function(i) {
                    $(this).find('td:eq(0)').html(i + 1);
                })

                arr_pengaturan_header = arr_pengaturan_header.filter(function(item) {
                    return item.random_id != randomId;
                });
            }
        });

    }

    function ViewBonusDetail22(random_id) {
        $("#SKUPromoDetail2Bonus-check_pilihan").val("all");
        $("#random_id").val(random_id);
        $("#panel-pengaturan-detail").show();
        $("#table-pengaturan-detail tbody").empty();

        var dataSKU = arr_pengaturan_header
            .filter(item => item.random_id == random_id) // Filter untuk mendapatkan item dengan random_id yang sesuai
            .flatMap(item => item.detail.map(detail => "'" + detail.sku_id + "'")); // FlatMap untuk mengambil sku_id dari setiap detail

        if (dataSKU.length > 0) {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetSelectedSKU') ?>",
                data: {
                    sku_id: dataSKU
                },
                dataType: "JSON",
                success: function(response) {
                    $.each(response, function(i, v) {
                        var header = arr_pengaturan_header.find(item => item.random_id === random_id);
                        var detail = header.detail.find(detailItem => detailItem.sku_id === v.sku_id);

                        $("#table-pengaturan-detail > tbody").append(`
							<tr id="row-${i}">
								<td class="text-center">
									${i+1}
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
									<input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-sku_qty_bonus" class="form-control input-sm" value="${detail.qty_bonus}" onChange="UpdateSKUPromoDetail2BonusDetail2('${v.sku_id}', '${random_id}','qty_bonus', this.value)"/>
								</td>
								<td class="text-center" style="width:10%;display:none;">
									<select id="item-${i}-SKUPromoDetail2BonusDetail-sku_tipe_id" class="form-control input-sm">
										<option value="">**Pilih**</option>
									</select>
								</td>
								<td class="text-center" style="width:10%;">
									<select id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon_id" class="form-control select2" onChange="UpdateSKUPromoDetail2BonusDetail2('${v.sku_id}', '${random_id}', 'referensi_diskon', this.value)">
										<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
										<?php if ($ReferensiDiskon != "0") {
                                            foreach ($ReferensiDiskon as $value) : ?>
												<option value="<?= $value['referensi_diskon_id']; ?>" ${detail.referensi_diskon == '<?= $value['referensi_diskon_id']; ?>' ? 'selected' : ''}><?= $value['referensi_diskon_kode']; ?></option>
										<?php endforeach;
                                        } ?>
									</select>
								</td>
								<td class="text-center">
									<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU2(this,${i},'${v.sku_id}','${random_id}')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						`);

                        $(".select2").select2();

                    });
                }
            });
        }
    }

    function UpdateSKUPromoDetail2BonusDetail2(sku_id, random_id, mode, value) {
        var item = arr_pengaturan_header.find(function(element) {
            return element.random_id == random_id;
        })

        var detailItem = item.detail.find(detailElement => detailElement.sku_id == sku_id);

        if (mode == 'qty_bonus') {
            detailItem.qty_bonus = value;
        } else {
            detailItem.referensi_diskon = value;
        }
    }

    function DeleteSKU2(event, index, sku_id, random_id) {
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
                var row = event.parentNode.parentNode;
                row.parentNode.removeChild(row);

                $("#table-pengaturan-detail tbody tr").each(function(i) {
                    $(this).find('td:eq(0)').html(i + 1);
                })

                arr_pengaturan_header = arr_pengaturan_header.map(item => {
                    if (item.random_id == random_id) {
                        item.detail = item.detail.filter(detailItem => detailItem.sku_id != sku_id);
                    }
                    return item;
                });
            }
        });
    }


    function UpdateSKUPromoDetail2Bonus2(random_id, value, mode) {
        // Mencari objek yang memiliki random_id yang cocok
        var item = arr_pengaturan_header.find(function(element) {
            return element.random_id == random_id;
        });

        if (mode == 'minQty') {
            item.sku_min_qty = value.replaceAll(",", '');
        } else {
            if (value) {
                item.kelipatan = 1;
            } else {
                item.kelipatan = 0;
            }
        }
    }

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
								${v.sku_promo_detail2_bonus_nourut}
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut" value="${v.sku_promo_detail2_bonus_nourut}">
							</td>
							<td class="text-center">
								<input type="number" id="item-${i}-SKUPromoDetail2Bonus-sku_min_qty" class="form-control input-sm" value="${v.sku_min_qty}" onChange="UpdateSKUPromoDetail2Bonus('${i}','all')" />
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id" value="${v.sku_promo_detail2_bonus_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_id" value="${v.sku_promo_detail2_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail1_id" value="${v.sku_promo_detail1_id}">
							</td>
							<td class="text-center">
								<input type="checkbox" id="item-${i}-SKUPromoDetail2Bonus-is_berkelipatan" value="1" ${v.is_berkelipatan == '1' ? 'checked' : ''} onChange="UpdateSKUPromoDetail2Bonus('${i}','all')"/>
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
                sku_promo_detail2_id: $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val(),
                dasar_jumlah_order: $("#dasar_jumlah_order").val()
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
                var stringValue = $("#dasar_jumlah_order").val();
                var str = '';

                if (stringValue == 'value order') {
                    $("#thMinimum").html("<span name='CAPTION-VALUEMININUM'>Value Minimum</span>")
                } else {
                    $("#thMinimum").html("<span name='CAPTION-QTYMINIMUM'>Qty Minimum</span>")
                }

                if (response != "0") {

                    $.each(response, function(i, v) {
                        if (stringValue == 'value order') {
                            str = `<input type="text" onkeyup="formatNominal(this)" id="item-${i}-SKUPromoDetail2Bonus-sku_min_qty_by_one" class="form-control input-sm" value="${v.sku_min_value == 0 ? '' : formatNumber(parseFloat(v.sku_min_value))}" onChange="UpdateSKUPromoDetail2Bonus('${i}','by_one')" />`
                        } else {
                            str = `<input type="number" id="item-${i}-SKUPromoDetail2Bonus-sku_min_qty_by_one" class="form-control input-sm" value="${v.sku_min_qty}" onChange="UpdateSKUPromoDetail2Bonus('${i}','by_one')" />`
                        }

                        $('#table-pengaturan-header-by-one > tbody').append(`
						<tr>
							<td class="text-center">
								${v.sku_promo_detail2_bonus_nourut}
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut_by_one" value="${v.sku_promo_detail2_bonus_nourut}">
							</td>
							<td class="text-center">
                                ${str}
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one" value="${v.sku_promo_detail2_bonus_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one" value="${v.sku_promo_detail2_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one" value="${v.sku_promo_detail1_id}">
							</td>
							<td class="text-center">
								<input type="checkbox" id="item-${i}-SKUPromoDetail2Bonus-is_berkelipatan_by_one" value="1" ${v.is_berkelipatan == '1' ? 'checked' : ''} onChange="UpdateSKUPromoDetail2Bonus('${i}','by_one')"/>
							</td>
							<td class="text-center">
                                <button class="btn btn-info btn-sm">${v.jml_detail}</button>
								<button class="btn btn-primary btn-sm" onclick="ViewBonusDetail2ByOne('${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-pencil"></i></button>
								<button class="btn btn-danger btn-sm" onclick="DeletePromoDetail2BonusByOne('${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-trash"></i></button>
							</td>
						</tr>';
					`);
                    });
                }
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

                if (response != "0") {

                    $.each(response, function(i, v) {
                        $('#table-pengaturan-header-by-sku > tbody').append(`
							<tr>
								<td class="text-center">
									${v.sku_promo_detail2_bonus_nourut}
									<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut_by_sku" value="${v.sku_promo_detail2_bonus_nourut}">
								</td>
								<td class="text-center">
									<input type="number" id="item-${i}-SKUPromoDetail2Bonus-sku_min_qty_by_sku" class="form-control input-sm" value="${v.sku_min_qty}" onChange="UpdateSKUPromoDetail2Bonus('${i}','by_sku')" />
									<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_sku" value="${v.sku_promo_detail2_bonus_id}">
									<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_id_by_sku" value="${v.sku_promo_detail2_id}">
									<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail1_id_by_sku" value="${v.sku_promo_detail1_id}">
								</td>
								<td class="text-center">
									<input type="checkbox" id="item-${i}-SKUPromoDetail2Bonus-is_berkelipatan_by_sku" value="1" ${v.is_berkelipatan == '1' ? 'checked' : ''} onChange="UpdateSKUPromoDetail2Bonus('${i}','by_sku')"/>
								</td>
								<td class="text-center">
                                    <button class="btn btn-info btn-sm">${v.jml_detail}</button>
									<button class="btn btn-primary btn-sm" onclick="ViewBonusDetail2BySKU('${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-pencil"></i></button>
									<button class="btn btn-danger btn-sm" onclick="DeletePromoDetail2BonusBySKU('${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-trash"></i></button>
								</td>
							</tr>';
						`);
                    });
                }
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
									<select id="item-${i}-SKUPromoDetail2Diskon-tipe_diskon_id" class="form-control select2">
										<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
										<?php foreach ($TipeDiskon as $value) : ?>
											<option value="<?= $value['tipe_diskon_id']; ?>" ${v.tipe_diskon_id == '<?= $value['tipe_diskon_id'] ?>' ? 'selected' : ''}><?= $value['tipe_diskon_nama']; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
								<td class="text-center">
									<input type="number" id="item-${i}-SKUPromoDetail2Diskon-value_diskon" class="form-control input-sm" value="${v.value_diskon}" />
								</td>
								<td class="text-center">
									<select id="item-${i}-SKUPromoDetail2Diskon-referensi_diskon_id" class="form-control select2">
										<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
										<?php if ($ReferensiDiskon != "0") {
                                            foreach ($ReferensiDiskon as $value) : ?>
											<option value="<?= $value['referensi_diskon_id']; ?>" ${v.referensi_diskon_id == '<?= $value['referensi_diskon_id'] ?>' ? 'selected' : ''}><?= $value['referensi_diskon_kode']; ?></option>
										<?php endforeach;
                                        } ?>
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
                    $(".select2").select2();
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
									<select id="item-${i}-SKUPromoDetail2Diskon-tipe_diskon_id_by_one" class="form-control select2">
										<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
										<?php foreach ($TipeDiskon as $value) : ?>
											<option value="<?= $value['tipe_diskon_id']; ?>" ${v.tipe_diskon_id == '<?= $value['tipe_diskon_id'] ?>' ? 'selected' : ''}><?= $value['tipe_diskon_nama']; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
								<td class="text-center">
									<input type="number" id="item-${i}-SKUPromoDetail2Diskon-value_diskon_by_one" class="form-control input-sm" value="${v.value_diskon}" />
								</td>
								<td class="text-center">
									<select id="item-${i}-SKUPromoDetail2Diskon-referensi_diskon_id_by_one" class="form-control select2">
											<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
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

                    $.each(response, function(i, v) {

                        $("item-" + i + "-SKUPromoDetail2Diskon-referensi_diskon_id_by_one").html('');

                        $.ajax({
                            type: 'GET',
                            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetReferensiDiskonByKategori') ?>",
                            data: {
                                kategori: $("#FilterPengaturanDiskon-kategori_id_by_one").val()
                            },
                            dataType: "JSON",
                            success: function(response2) {
                                if (response2 != 0) {
                                    $.each(response2, function(idx, val) {
                                        $("item-" + i + "-SKUPromoDetail2Diskon-referensi_diskon_id_by_one").append(`<option value="${val.referensi_diskon_id}" ${val.referensi_diskon_id == v.referensi_diskon_id}>${val.referensi_diskon_kode}</option>`);
                                    })
                                }

                            }
                        });
                    });

                    $(".select2").select2({
                        width: '100%'
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
								<select id="item-${i}-SKUPromoDetail2Diskon-tipe_diskon_id_by_sku" class="form-control select2">
									<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
									<?php foreach ($TipeDiskon as $value) : ?>
										<option value="<?= $value['tipe_diskon_id']; ?>" ${v.tipe_diskon_id == '<?= $value['tipe_diskon_id'] ?>' ? 'selected' : ''}><?= $value['tipe_diskon_nama']; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
							<td class="text-center">
								<input type="number" id="item-${i}-SKUPromoDetail2Diskon-value_diskon_by_sku" class="form-control input-sm" value="${v.value_diskon}" />
							</td>
							<td class="text-center">
								<select id="item-${i}-SKUPromoDetail2Diskon-referensi_diskon_id_by_sku" class="form-control select2">
										<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
										<?php if ($ReferensiDiskon != "0") {
                                            foreach ($ReferensiDiskon as $value) : ?>
													<option value="<?= $value['referensi_diskon_id']; ?>" ${v.referensi_diskon_id=='<?= $value['referensi_diskon_id'] ?>' ? 'selected' : '' }><?= $value['referensi_diskon_kode']; ?></option>
										<?php endforeach;
                                        } ?>
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
                    $(".select2").select2();
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

                        // $.each(response, function(i, v) {
                        //     $.ajax({
                        //         async: false,
                        //         type: 'POST',
                        //         url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_bonus_detail_temp') ?>",
                        //         data: {
                        //             sku_promo_detail2_bonus_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id").val(),
                        //             sku_promo_detail2_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_id").val(),
                        //             sku_promo_detail1_id: $("#SKUPromoDetail2Bonus-sku_promo_detail1_id").val(),
                        //             sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val(),
                        //             sku_id: v.sku_id
                        //         },
                        //         dataType: "JSON",
                        //         success: function(response) {
                        //             console.log("insert_sku_promo_detail2_bonus_detail_temp success");
                        //         }
                        //     });
                        // });

                        // pushToTablePengaturanDetail();
                        pushToTablePengaturanDetail2(response);

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

    function pushToTablePengaturanDetail2(response) {
        var random_id = $('#random_id').val();
        // $('#table-pengaturan-detail > tbody').empty('');

        // if ($.fn.DataTable.isDataTable('#table-pengaturan-detail')) {
        // 	$('#table-pengaturan-detail').DataTable().clear();
        // 	$('#table-pengaturan-detail').DataTable().destroy();
        // }

        $.each(response, function(i, v) {
            $("#table-pengaturan-detail > tbody").append(`
							<tr id="row-${i}">
								<td class="text-center">
									${i+1}
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
									<input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-sku_qty_bonus" class="form-control input-sm" value="" onChange="UpdateSKUPromoDetail2BonusDetail2('${v.sku_id}', '${random_id}','qty_bonus', this.value)"/>
								</td>
								<td class="text-center" style="width:10%;display:none;">
									<select id="item-${i}-SKUPromoDetail2BonusDetail-sku_tipe_id" class="form-control input-sm">
										<option value="">**Pilih**</option>
									</select>
								</td>
								<td class="text-center" style="width:10%;">
									<select id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon_id" class="form-control select2" onChange="UpdateSKUPromoDetail2BonusDetail2('${v.sku_id}', '${random_id}', 'referensi_diskon', this.value)">
										<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
										<?php if ($ReferensiDiskon != "0") {
                                            foreach ($ReferensiDiskon as $value) : ?>
												<option value="<?= $value['referensi_diskon_id']; ?>"><?= $value['referensi_diskon_kode']; ?></option>
										<?php endforeach;
                                        } ?>
									</select>
								</td>
								<td class="text-center">
									<button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU2(this,${i},'${v.sku_id}','${random_id}')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						`);

            var item = arr_pengaturan_header.find(function(element) {
                return element.random_id == random_id;
            })

            item.detail.push({
                sku_id: v.sku_id,
                qty_bonus: '',
                referensi_diskon: ''
            })

        });

        console.log(arr_pengaturan_header);

        // $('#table-pengaturan-detail').DataTable({
        // 	'info': false,
        // 	'paging': false,
        // 	'searching': false,
        // 	'pagination': false,
        // 	'ordering': false,
        // 	scrollX: true,
        // 	scrollY: '300px',
        // 	scrollCollapse: true
        // });

        $(".select2").select2();
    }

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

                        var random_id = $('#random_id').val();
                        var arrBaru = arr_pengaturan_header
                            .filter(item => item.random_id == random_id) // Filter untuk mendapatkan item dengan random_id yang sesuai
                            .flatMap(item => item.detail.map(detail => detail.sku_id)); // FlatMap untuk mengambil sku_id dari setiap detail

                        if (response.length > 0) {
                            $.each(response, function(i, v) {
                                var checked = '';
                                if (arrBaru.length > 0) {
                                    $.each(arrBaru, function(i2, v2) {
                                        if (v.sku_id == v2) {
                                            checked = 'checked disabled';
                                            return false;
                                        } else {
                                            checked = '';
                                        }
                                    })
                                }

                                $('#table-sku > tbody').append(`
								<tr>
									<td width="5%" class="text-center">
										<input ${checked} type="checkbox" name="CheckboxSKU" id="check-sku-${i}" value="${v.sku_id}">
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
        var targetIdx = $("#FilterPencarianSKUDetail1-index").val();
        console.log(arr_sku_detail1);

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
                            var result = arr_sku_detail1.find(function(item) {
                                return item.idx == targetIdx && item.sku_id == v.sku_id;
                            });

                            if (result) {
                                var checkedDisabled = 'checked disabled';
                            } else {
                                var checkedDisabled = '';
                            }

                            $('#table-sku-detail > tbody').append(`
								<tr>
									<td width="5%" class="text-center">
										<input type="checkbox" ${checkedDisabled} name="CheckboxSKUDetail1" id="check-sku-detail1-${i}" value="${v.sku_id}">
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
        var headerPerusahaan = $("#headerPerusahaan").val();

        if (headerPerusahaan == '') {
            message2('Error', 'Harap Pilih Perusahaan!', 'error');
            return false;
        }

        var headerPerusahaan = $("#headerPerusahaan").prop("disabled", true);

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
                        'is_berkelipatan': $('[id="item-' + idx + '-SKUPromoDetail2Bonus-is_berkelipatan"]:checked').length,
                        'sku_promo_detail2_bonus_nourut': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut").val()
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
                        message_custom("Success", "success", msg);

                        $("#loadingpengaturan").hide();
                        $("#btn_save_pengaturan_bonus").prop("disabled", false);

                        $("#modal-pengaturan").modal('hide');

                        GetPromoDetail();

                    } else {
                        var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                        message_custom("Error", "error", msg);

                        $("#loadingpengaturan").hide();
                        $("#btn_save_pengaturan_bonus").prop("disabled", false);

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                    message_custom("Error", "error", msg);

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

    $("#btn_save_pengaturan_bonus2").click(function() {
        var sku_min_qty_before = 0;
        var cek_sku_min_qty_before = 0;
        var cek_sku_min_qty = 0;
        var cek_error = 0;
        var cek_qty_bonus = 0;

        $("#loadingpengaturan").show();
        $("#btn_save_pengaturan_bonus2").prop("disabled", true);

        if (arr_pengaturan_header.length > 0) {
            $.each(arr_pengaturan_header, function(i, v) {
                if (v.sku_min_qty != '') {
                    if (v.sku_min_qty != "0") {
                        if (parseInt(v.sku_min_qty) < parseInt(sku_min_qty_before)) {
                            cek_sku_min_qty_before++;
                            return false;
                        }
                    } else {
                        cek_sku_min_qty++;
                        return false;
                    }
                } else {
                    cek_sku_min_qty++;
                    return false;
                }

                sku_min_qty_before = v.sku_min_qty

                if (v.detail.length > 0) {
                    $.each(v.detail, function(i2, v2) {
                        if (v2.qty_bonus == '') {
                            cek_qty_bonus++;
                            return false;
                        } else if (v2.qty_bonus == "0") {
                            cek_qty_bonus++;
                            return false;
                        }
                    })
                } else {
                    cek_qty_bonus++;
                }
            })
        } else {
            cek_error++;
        }

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

            cek_error++;
        }

        if (cek_qty_bonus > 0) {
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
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_bonus_temp_bonus_detail_temp') ?>",
                data: {
                    dasar_jumlah_order: $("#dasar_jumlah_order").val(),
                    sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                    sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id").val(),
                    arr_data: arr_pengaturan_header
                },
                dataType: "JSON",
                success: function(response) {

                    if (response == 1) {

                        var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                        message_custom("Success", "success", msg);

                        $("#loadingpengaturan").hide();
                        $("#btn_save_pengaturan_bonus2").prop("disabled", false);

                        $("#modal-pengaturan").modal('hide');

                        GetPromoDetail();

                    } else {
                        var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                        message_custom("Error", "error", msg);

                        $("#loadingpengaturan").hide();
                        $("#btn_save_pengaturan_bonus2").prop("disabled", false);

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                    message_custom("Error", "error", msg);

                    $("#loadingpengaturan").hide();
                    $("#btn_save_pengaturan_bonus2").prop("disabled", false);
                }
            });
        } else {
            $("#loadingpengaturan").hide();
            $("#btn_save_pengaturan_bonus2").prop("disabled", false);
        }
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
                        'sku_min_qty': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_min_qty_by_one").val().replaceAll(",", ""),
                        'is_berkelipatan': $('[id="item-' + idx + '-SKUPromoDetail2Bonus-is_berkelipatan_by_one"]:checked').length,
                        'sku_promo_detail2_bonus_nourut': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut_by_one").val()
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
                    arr_header: arr_sku_promo_detail2_bonus,
                    dasarJumlahOrder: $("#dasar_jumlah_order").val()
                },
                dataType: "JSON",
                success: function(response) {

                    if (response == 1) {

                        var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                        message_custom("Success", "success", msg);

                        $("#loadingpengaturanbyone").hide();
                        $("#btn_save_pengaturan_bonus_by_one").prop("disabled", false);

                        $("#modal-pengaturan-by-one").modal('hide');

                        GetPromoDetail();

                    } else {
                        var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                        message_custom("Error", "error", msg);

                        $("#loadingpengaturanbyone").hide();
                        $("#btn_save_pengaturan_bonus_by_one").prop("disabled", false);

                        $("#modal-pengaturan-by-one").modal('hide');

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                    message_custom("Error", "error", msg);

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
                        'is_berkelipatan': $('[id="item-' + idx + '-SKUPromoDetail2Bonus-is_berkelipatan_by_sku"]:checked').length,
                        'sku_promo_detail2_bonus_nourut': $("#item-" + idx + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut_by_sku").val()
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
                        message_custom("Success", "success", msg);

                        $("#loadingpengaturanbysku").hide();
                        $("#btn_save_pengaturan_bonus_by_sku").prop("disabled", false);

                        $("#modal-pengaturan-by-sku").modal('hide');

                        GetPromoDetail();

                    } else {
                        var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                        message_custom("Error", "error", msg);

                        $("#loadingpengaturanbysku").hide();
                        $("#btn_save_pengaturan_bonus_by_sku").prop("disabled", false);

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                    message_custom("Error", "error", msg);

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
                                message_custom("Success", "success", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon").prop("disabled", false);

                                $("#modal-pengaturan-diskon").modal('hide');

                                GetPromoDetail();

                            } else {
                                var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                message_custom("Error", "error", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon").prop("disabled", false);

                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                            message_custom("Error", "error", msg);

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
                                message_custom("Success", "success", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon_by_one").prop("disabled", false);

                                $("#modal-pengaturan-diskon-by-one").modal('hide');

                                GetPromoDetail();

                            } else {
                                var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                message_custom("Error", "error", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon_by_one").prop("disabled", false);

                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                            message_custom("Error", "error", msg);

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
                                message_custom("Success", "success", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon_by_sku").prop("disabled", false);

                                $("#modal-pengaturan-diskon-by-sku").modal('hide');

                                GetPromoDetail();

                            } else {
                                var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                message_custom("Error", "error", msg);

                                $("#loadingpengaturanbysku").hide();
                                $("#btn_save_pengaturan_diskon_by_sku").prop("disabled", false);

                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                            message_custom("Error", "error", msg);

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

        // arr_sku_detail1 = [];

        if (numberOfChecked > 0) {
            $("#modal-sku-detail1").modal('hide');

            arr_sku_detail1 = arr_sku_detail1.filter(function(item) {
                return item.idx != idx;
            });

            for (var i = 0; i < jumlah; i++) {
                var checked = $('[id="check-sku-detail1-' + i + '"]:checked').length;
                var sku_id = $("#check-sku-detail1-" + i).val();

                if (checked > 0) {
                    // arr_sku_detail1.push(sku_id);

                    arr_sku_detail1.push({
                        sku_id: sku_id,
                        idx: idx
                    });
                }
            }

            $.each(arr_sku_detail1, function(i, v) {
                // $.ajax({
                //     async: false,
                //     type: 'POST',
                //     url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_temp_by_sku') ?>",
                //     data: {
                //         sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                //         sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + idx).val(),
                //         sku_id: v
                //     },
                //     dataType: "JSON",
                //     success: function(response) {
                //         console.log("insert_sku_promo_detail2_temp_by_sku success");
                //     }
                // });

                if (v.idx == idx) {
                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/insert_sku_promo_detail2_temp_by_sku') ?>",
                        data: {
                            sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                            sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + idx).val(),
                            sku_id: v.sku_id
                        },
                        dataType: "JSON",
                        success: function(response) {
                            console.log("insert_sku_promo_detail2_temp_by_sku success");
                        }
                    });
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

                    $('#table-product-promo-by-sku-' + idx + ' > tbody').empty();

                    $.each(response, function(i, v) {
                        $('#table-product-promo-by-sku-' + idx + ' > tbody').append(`
							<tr id="row-${i}">
								<td style="vertical-align:middle; text-align:center;">
									${i+1}
									<input type="hidden" id="item-${i}-SKUPromoDetail2-sku_promo_detail2_id" value="${v.sku_promo_detail2_id}">
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
									<button class="btn btn-info btn-sm">${v.count_bonus}</button>
									<button class="btn ${parseInt(v.count_bonus) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_bonus_${idx}" id="item-${i}-SKUPromoDetail2-atur_bonus" onclick="AturBonusBySKU('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${idx}','${i}','${v.sku_id}','${v.sku_kode}','${v.sku_nama_produk}','${v.sku_kemasan}','${v.sku_satuan}')" ${ checked_bonus > 0 ? '' : 'disabled' }><i class="fa fa-pencil"></i></button>
								</td>
								<td style="vertical-align:middle; text-align:center;">
									<button class="btn btn-info btn-sm">${v.count_diskon}</button>
									<button class="btn ${parseInt(v.count_diskon) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_diskon_${idx}" id="item-${i}-SKUPromoDetail2-atur_diskon" onclick="AturDiskonBySKU('${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${idx}','${i}','${v.sku_id}','${v.sku_kode}','${v.sku_nama_produk}','${v.sku_kemasan}','${v.sku_satuan}')" ${ checked_diskon > 0 ? '' : 'disabled' }><i class="fa fa-pencil"></i></button>
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
        var headerPerusahaan = $("#headerPerusahaan").val();

        // console.log($("#SKUPromo-depo_group_id").val());
        // console.log($("#SKUPromo-depo_id").val());

        if (headerPerusahaan == '') {
            message2('Error', 'Harap Pilih Perusahaan!', 'error');
            return false;
        }

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
                            sku_promo_kode: $("#SKUPromo-sku_promo_id").val()
                        },
                        dataType: "JSON",
                        success: function(response) {
                            console.log("delete_sku_promo_lokasi success");
                        }
                    });

                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_segmen') ?>",
                        data: {
                            sku_promo_kode: $("#SKUPromo-sku_promo_id").val()
                        },
                        dataType: "JSON",
                        success: function(response) {
                            console.log("delete_sku_promo_segmen success");
                        }
                    });

                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/delete_sku_promo_segmen_detail') ?>",
                        data: {
                            sku_promo_kode: $("#SKUPromo-sku_promo_id").val()
                        },
                        dataType: "JSON",
                        success: function(response) {
                            console.log("delete_sku_promo_segmen_detail success");
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
                            // client_wms_id: $("#SKUPromo-client_wms_id").val(),
                            client_wms_id: headerPerusahaan,
                            sku_promo_kode: $("#SKUPromo-sku_promo_kode").val(),
                            sku_promo_tgl_berlaku_awal: $("#SKUPromo-sku_promo_tgl_berlaku_awal").val(),
                            sku_promo_tgl_berlaku_akhir: $("#SKUPromo-sku_promo_tgl_berlaku_akhir").val(),
                            sku_promo_keterangan: $("#SKUPromo-sku_promo_keterangan").val(),
                            sku_promo_status: $("#SKUPromo-sku_promo_status").val(),
                            sku_promo_tgl_create: "",
                            sku_promo_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                            client_pt_segmen: $('#SKUPromo-client_pt_segmen').val(),
                            client_pt_id: $('#SKUPromo-client_pt_id').val(),
                            is_khusus: $('[id="SKUPromo-sku_promo_is_khusus"]:checked').length
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
                                message_custom("Success", "success", msg);

                                setTimeout(() => {
                                    location.href = "<?= base_url() ?>FAS/MasterPricing/HargaDanPromo/Promo/PromoMenu";
                                }, 500);

                            } else {
                                var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                message_custom("Error", "error", msg);

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
                    //             message_custom("Success", "success", msg);

                    //             setTimeout(() => {
                    //                 location.href = "<?= base_url() ?>FAS/MasterPricing/HargaDanPromo/Promo/PromoMenu";
                    //             }, 500);

                    //         } else {
                    //             var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                    //             message_custom("Error", "error", msg);

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

    function formatNominal(input) {
        var nStr = input.value + '';
        nStr = nStr.replace(/\,/g, "");
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        input.value = x1 + x2;
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
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

    function GetPelangganBySegmen() {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetPelangganBySegmen') ?>",
            data: {
                segmen: $("#SKUPromo-client_pt_segmen").val()
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
                $("#SKUPromo-client_pt_id").html('');

                if (response.length > 0) {
                    $.each(response, function(i, v) {
                        $("#SKUPromo-client_pt_id").append(`<option value="'${v.client_pt_id}'">${v.client_pt_nama + " - " + v.client_pt_kelurahan}</option>`);
                    });

                    $('#SKUPromo-client_pt_id').selectpicker('refresh'); // Refresh selectpicker jika menggunakan plugin Bootstrap Select
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