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
    var sku_katalog_setting_detail = [];

    $(document).ready(
        function() {
            $('.select2').select2();

            <?php foreach ($KonfigurasiDetail as $key => $value) : ?>
                sku_katalog_setting_detail.push({
                    'index': "<?= $key ?>",
                    'tipe_kategori1': "<?= $value['tipe_kategori1'] ?>",
                    'kategori1_id': "<?= $value['kategori1_id'] ?>",
                    'tipe_kategori2': "<?= $value['tipe_kategori2'] ?>",
                    'kategori2_id': "<?= $value['kategori2_id'] ?>",
                    'tipe_kategori3': "<?= $value['tipe_kategori3'] ?>",
                    'kategori3_id': "<?= $value['kategori3_id'] ?>",
                    'tipe_kategori4': "<?= $value['tipe_kategori4'] ?>",
                    'kategori4_id': "<?= $value['kategori4_id'] ?>",
                    'tipe_kategori5': "<?= $value['tipe_kategori5'] ?>",
                    'kategori5_id': "<?= $value['kategori5_id'] ?>",
                    'tipe_kategori6': "<?= $value['tipe_kategori6'] ?>",
                    'kategori6_id': "<?= $value['kategori6_id'] ?>",
                    'sku_harga_id': "<?= $value['sku_harga_id'] ?>",
                    'sku_promo_id': "<?= $value['sku_promo_id'] ?>"
                });
            <?php endforeach; ?>

            GetSKUKatalogSettingDetail();
        }
    );

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

    //start function group

    function GetSKUKatalogSettingDetail() {

        var table_katalog_header = "";
        var table_katalog_body = "";

        $("#loadingdetail").show();
        $("#btn_update_sku_katalog_setting").prop("disabled", true);
        $("#btn_delete_sku_katalog_setting").prop("disabled", true);
        $("#btn_tambah_sku_katalog_setting_detail").prop("disabled", true);

        $('#table-katalog-detail > thead').html('');
        $('#table-katalog-detail > tbody').html('');

        table_katalog_header = `<tr><th style="vertical-align:middle; text-align:center;">#</th>`

        if ($("#SKUKatalogSettingDetail-tipe_kategori1").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori1").val()) {
            table_katalog_header += `<th style="vertical-align:middle; text-align:center;">${$("#SKUKatalogSettingDetail-tipe_kategori1").val()}</th>`
        }

        if ($("#SKUKatalogSettingDetail-tipe_kategori2").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori2").val() != null) {
            table_katalog_header += `<th style="vertical-align:middle; text-align:center;">${$("#SKUKatalogSettingDetail-tipe_kategori2").val()}</th>`
        }

        if ($("#SKUKatalogSettingDetail-tipe_kategori3").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori3").val() != null) {
            table_katalog_header += `<th style="vertical-align:middle; text-align:center;">${$("#SKUKatalogSettingDetail-tipe_kategori3").val()}</th>`
        }

        if ($("#SKUKatalogSettingDetail-tipe_kategori4").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori4").val() != null) {
            table_katalog_header += `<th style="vertical-align:middle; text-align:center;">${$("#SKUKatalogSettingDetail-tipe_kategori4").val()}</th>`
        }

        if ($("#SKUKatalogSettingDetail-tipe_kategori5").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori5").val() != null) {
            table_katalog_header += `<th style="vertical-align:middle; text-align:center;">${$("#SKUKatalogSettingDetail-tipe_kategori5").val()}</th>`
        }

        if ($("#SKUKatalogSettingDetail-tipe_kategori6").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori6").val() != null) {
            table_katalog_header += `<th style="vertical-align:middle; text-align:center;">${$("#SKUKatalogSettingDetail-tipe_kategori6").val()}</th>`
        }

        table_katalog_header += `<th style="vertical-align:middle; text-align:center;"><span name="CAPTION-KATALOGHARGA">Katalog Harga</span></th>
                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-KATALOGPROMO">Katalog Promo</span></th>
                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-ACTION">Action</span></th>
                            </tr>`;

        $('#table-katalog-detail > thead').append(table_katalog_header);

        $.each(sku_katalog_setting_detail, function(i, v) {

            table_katalog_body = `<tr id="row-${i}"><td style="vertical-align:middle; text-align:center;">${i+1}</td>`

            if ($("#SKUKatalogSettingDetail-tipe_kategori1").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori1").val()) {
                table_katalog_body += `<td style="vertical-align:middle; text-align:center;">
                                            <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori1_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
                                            </select>
                                        </td>`
            }

            if ($("#SKUKatalogSettingDetail-tipe_kategori2").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori2").val() != null) {
                table_katalog_body += `<td style="vertical-align:middle; text-align:center;">
                                            <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori2_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
                                            </select>
                                        </td>`
            }

            if ($("#SKUKatalogSettingDetail-tipe_kategori3").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori3").val() != null) {
                table_katalog_body += `<td style="vertical-align:middle; text-align:center;">
                                            <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori3_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
                                            </select>
                                        </td>`
            }

            if ($("#SKUKatalogSettingDetail-tipe_kategori4").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori4").val() != null) {
                table_katalog_body += `<td style="vertical-align:middle; text-align:center;">
                                            <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori4_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
                                            </select>
                                        </td>`
            }

            if ($("#SKUKatalogSettingDetail-tipe_kategori5").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori5").val() != null) {
                table_katalog_body += `<td style="vertical-align:middle; text-align:center;">
                                            <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori5_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
                                            </select>
                                        </td>`
            }

            if ($("#SKUKatalogSettingDetail-tipe_kategori6").val() != "" && $("#SKUKatalogSettingDetail-tipe_kategori6").val() != null) {
                table_katalog_body += `<td style="vertical-align:middle; text-align:center;">
                                            <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori6_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
                                            </select>
                                        </td>`
            }

            table_katalog_body += `<td style="vertical-align:middle; text-align:center;">
                                        <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-sku_harga_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
                                        </select>
                                    </td>
                                    <td style="vertical-align:middle; text-align:center;">
                                        <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-sku_promo_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
                                        </select>
                                    </td>
                                    <td style="vertical-align:middle; text-align:center;">
                                        <button class="btn btn-danger btn-small" onclick="DeleteSKUKatalogSettingDetail(this,'${i}')"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>`;

            $('#table-katalog-detail > tbody').append(table_katalog_body);

            // $('#table-katalog-detail > tbody').append(`
            //     <tr id="row-${i}">
            // 	    <td style="vertical-align:middle; text-align:center;">${i+1}</td>
            // 		<td style="vertical-align:middle; text-align:center;">
            // 		    <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori1_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
            //             </select>
            // 		</td>
            //         <td style="vertical-align:middle; text-align:center;">
            // 		    <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori2_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
            //             </select>
            // 		</td>
            //         <td style="vertical-align:middle; text-align:center;">
            // 		    <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori3_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
            //             </select>
            // 		</td>
            //         <td style="vertical-align:middle; text-align:center;">
            // 		    <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori4_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
            //             </select>
            // 		</td>
            //         <td style="vertical-align:middle; text-align:center;">
            // 		    <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori5_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
            //             </select>
            // 		</td>
            //         <td style="vertical-align:middle; text-align:center;">
            // 		    <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-kategori6_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
            //             </select>
            // 		</td>
            //         <td style="vertical-align:middle; text-align:center;">
            //             <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-sku_harga_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
            //             </select>
            // 		</td>
            //         <td style="vertical-align:middle; text-align:center;">
            //             <select class="input-sm form-control select2" id="item-${i}-SKUKatalogSettingDetail-sku_promo_id" style="width:100%;" onChange="UpdateSKUKatalogSettingDetail(${i})">
            //             </select>
            // 		</td>
            //         <td style="vertical-align:middle; text-align:center;">
            // 		    <button class="btn btn-danger btn-small" onclick="DeleteSKUKatalogSettingDetail(this,'${i}')"><i class="fa fa-trash"></i></button>
            // 		</td>
            // 	</tr>';
            // `);
        });

        $.each(sku_katalog_setting_detail, function(i, v) {

            $("#item-" + i + "-SKUKatalogSettingDetail-kategori1_id").html('');
            $("#item-" + i + "-SKUKatalogSettingDetail-kategori2_id").html('');
            $("#item-" + i + "-SKUKatalogSettingDetail-kategori3_id").html('');
            $("#item-" + i + "-SKUKatalogSettingDetail-kategori4_id").html('');
            $("#item-" + i + "-SKUKatalogSettingDetail-kategori5_id").html('');
            $("#item-" + i + "-SKUKatalogSettingDetail-kategori6_id").html('');
            $("#item-" + i + "-SKUKatalogSettingDetail-sku_harga_id").html('');
            $("#item-" + i + "-SKUKatalogSettingDetail-sku_promo_id").html('');

            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/GetKategoriByTipeKategori') ?>",
                data: {
                    tipe_kategori: $("#SKUKatalogSettingDetail-tipe_kategori1").val()
                },
                dataType: "JSON",
                success: function(response) {
                    if (response != 0) {
                        $("#item-" + i + "-SKUKatalogSettingDetail-kategori1_id").append(`<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>`);
                        $.each(response, function(idx, val) {
                            $("#item-" + i + "-SKUKatalogSettingDetail-kategori1_id").append(`<option value="${val.kategori_id}" ${val.kategori_id == v.kategori1_id ? 'selected' : ''}>${val.kategori_nama}</option>`);
                        })
                    }

                }
            });

            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/GetKategoriByTipeKategori') ?>",
                data: {
                    tipe_kategori: $("#SKUKatalogSettingDetail-tipe_kategori2").val()
                },
                dataType: "JSON",
                success: function(response) {
                    if (response != 0) {
                        $("#item-" + i + "-SKUKatalogSettingDetail-kategori2_id").append(`<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>`);
                        $.each(response, function(idx, val) {
                            $("#item-" + i + "-SKUKatalogSettingDetail-kategori2_id").append(`<option value="${val.kategori_id}" ${val.kategori_id == v.kategori2_id ? 'selected' : ''}>${val.kategori_nama}</option>`);
                        })
                    }

                }
            });

            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/GetKategoriByTipeKategori') ?>",
                data: {
                    tipe_kategori: $("#SKUKatalogSettingDetail-tipe_kategori3").val()
                },
                dataType: "JSON",
                success: function(response) {
                    if (response != 0) {
                        $("#item-" + i + "-SKUKatalogSettingDetail-kategori3_id").append(`<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>`);
                        $.each(response, function(idx, val) {
                            $("#item-" + i + "-SKUKatalogSettingDetail-kategori3_id").append(`<option value="${val.kategori_id}" ${val.kategori_id == v.kategori3_id ? 'selected' : ''}>${val.kategori_nama}</option>`);
                        })
                    }

                }
            });

            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/GetKategoriByTipeKategori') ?>",
                data: {
                    tipe_kategori: $("#SKUKatalogSettingDetail-tipe_kategori4").val()
                },
                dataType: "JSON",
                success: function(response) {
                    if (response != 0) {
                        $("#item-" + i + "-SKUKatalogSettingDetail-kategori4_id").append(`<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>`);
                        $.each(response, function(idx, val) {
                            $("#item-" + i + "-SKUKatalogSettingDetail-kategori4_id").append(`<option value="${val.kategori_id}" ${val.kategori_id == v.kategori4_id ? 'selected' : ''}>${val.kategori_nama}</option>`);
                        })
                    }

                }
            });

            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/GetKategoriByTipeKategori') ?>",
                data: {
                    tipe_kategori: $("#SKUKatalogSettingDetail-tipe_kategori5").val()
                },
                dataType: "JSON",
                success: function(response) {
                    if (response != 0) {
                        $("#item-" + i + "-SKUKatalogSettingDetail-kategori5_id").append(`<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>`);
                        $.each(response, function(idx, val) {
                            $("#item-" + i + "-SKUKatalogSettingDetail-kategori5_id").append(`<option value="${val.kategori_id}" ${val.kategori_id == v.kategori5_id ? 'selected' : ''}>${val.kategori_nama}</option>`);
                        })
                    }

                }
            });

            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/GetKategoriByTipeKategori') ?>",
                data: {
                    tipe_kategori: $("#SKUKatalogSettingDetail-tipe_kategori6").val()
                },
                dataType: "JSON",
                success: function(response) {
                    if (response != 0) {
                        $("#item-" + i + "-SKUKatalogSettingDetail-kategori6_id").append(`<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>`);
                        $.each(response, function(idx, val) {
                            $("#item-" + i + "-SKUKatalogSettingDetail-kategori6_id").append(`<option value="${val.kategori_id}" ${val.kategori_id == v.kategori6_id ? 'selected' : ''}>${val.kategori_nama}</option>`);
                        })
                    }

                }
            });

            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/GetAllSKUHarga') ?>",
                // data: {
                //     tipe_kategori: $("#SKUKatalogSettingDetail-tipe_kategori6").val()
                // },
                dataType: "JSON",
                success: function(response) {
                    if (response != 0) {
                        $("#item-" + i + "-SKUKatalogSettingDetail-sku_harga_id").append(`<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>`);
                        $.each(response, function(idx, val) {
                            $("#item-" + i + "-SKUKatalogSettingDetail-sku_harga_id").append(`<option value="${val.sku_harga_id}" ${val.sku_harga_id == v.sku_harga_id ? 'selected' : ''}>${val.sku_harga_kode}</option>`);
                        })
                    }

                }
            });

            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/GetAllSKUPromo') ?>",
                // data: {
                //     tipe_kategori: $("#SKUKatalogSettingDetail-tipe_kategori6").val()
                // },
                dataType: "JSON",
                success: function(response) {
                    if (response != 0) {
                        $("#item-" + i + "-SKUKatalogSettingDetail-sku_promo_id").append(`<option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>`);
                        $.each(response, function(idx, val) {
                            $("#item-" + i + "-SKUKatalogSettingDetail-sku_promo_id").append(`<option value="${val.sku_promo_id}" ${val.sku_promo_id == v.sku_promo_id ? 'selected' : ''}>${val.sku_promo_kode}</option>`);
                        })
                    }

                }
            });

        });

        $(".select2").select2();

        $("#loadingdetail").hide();
        $("#btn_update_sku_katalog_setting").prop("disabled", false);
        $("#btn_delete_sku_katalog_setting").prop("disabled", false);
        $("#btn_tambah_sku_katalog_setting_detail").prop("disabled", false);
    }

    function UpdateKategori1SKUKatalogSettingDetail(kategori_grup) {

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
                $.each(sku_katalog_setting_detail, function(i, v) {
                    sku_katalog_setting_detail[i] = {
                        'index': i,
                        'tipe_kategori1': $("#SKUKatalogSettingDetail-tipe_kategori1").val(),
                        'kategori1_id': "",
                        'tipe_kategori2': v.tipe_kategori2,
                        'kategori2_id': v.kategori2_id,
                        'tipe_kategori3': v.tipe_kategori3,
                        'kategori3_id': v.kategori3_id,
                        'tipe_kategori4': v.tipe_kategori4,
                        'kategori4_id': v.kategori4_id,
                        'tipe_kategori5': v.tipe_kategori5,
                        'kategori5_id': v.kategori5_id,
                        'tipe_kategori6': v.tipe_kategori6,
                        'kategori6_id': v.kategori6_id,
                        'sku_harga_id': v.sku_harga_id,
                        'sku_promo_id': v.sku_promo_id
                    };
                });

                GetSKUKatalogSettingDetail();
            } else {
                $("#SKUKatalogSettingDetail-tipe_kategori1").val("");
            }
        });
    }

    function UpdateKategori2SKUKatalogSettingDetail(kategori_grup) {
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

                $.each(sku_katalog_setting_detail, function(i, v) {
                    sku_katalog_setting_detail[i] = {
                        'index': i,
                        'tipe_kategori1': v.tipe_kategori1,
                        'kategori1_id': v.kategori1_id,
                        'tipe_kategori2': $("#SKUKatalogSettingDetail-tipe_kategori2").val(),
                        'kategori2_id': "",
                        'tipe_kategori3': v.tipe_kategori3,
                        'kategori3_id': v.kategori3_id,
                        'tipe_kategori4': v.tipe_kategori4,
                        'kategori4_id': v.kategori4_id,
                        'tipe_kategori5': v.tipe_kategori5,
                        'kategori5_id': v.kategori5_id,
                        'tipe_kategori6': v.tipe_kategori6,
                        'kategori6_id': v.kategori6_id,
                        'sku_harga_id': v.sku_harga_id,
                        'sku_promo_id': v.sku_promo_id
                    };
                });

                GetSKUKatalogSettingDetail();
            } else {
                $("#SKUKatalogSettingDetail-tipe_kategori2").val("");
            }
        });
    }

    function UpdateKategori3SKUKatalogSettingDetail(kategori_grup) {
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
                $.each(sku_katalog_setting_detail, function(i, v) {
                    sku_katalog_setting_detail[i] = {
                        'index': i,
                        'tipe_kategori1': v.tipe_kategori1,
                        'kategori1_id': v.kategori1_id,
                        'tipe_kategori2': v.tipe_kategori2,
                        'kategori2_id': v.kategori2_id,
                        'tipe_kategori3': $("#SKUKatalogSettingDetail-tipe_kategori3").val(),
                        'kategori3_id': "",
                        'tipe_kategori4': v.tipe_kategori4,
                        'kategori4_id': v.kategori4_id,
                        'tipe_kategori5': v.tipe_kategori5,
                        'kategori5_id': v.kategori5_id,
                        'tipe_kategori6': v.tipe_kategori6,
                        'kategori6_id': v.kategori6_id,
                        'sku_harga_id': v.sku_harga_id,
                        'sku_promo_id': v.sku_promo_id
                    };
                });

                GetSKUKatalogSettingDetail();
            } else {
                $("#SKUKatalogSettingDetail-tipe_kategori3").val("");
            }
        });
    }

    function UpdateKategori4SKUKatalogSettingDetail(kategori_grup) {
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
                $.each(sku_katalog_setting_detail, function(i, v) {
                    sku_katalog_setting_detail[i] = {
                        'index': i,
                        'tipe_kategori1': v.tipe_kategori1,
                        'kategori1_id': v.kategori1_id,
                        'tipe_kategori2': v.tipe_kategori2,
                        'kategori2_id': v.kategori2_id,
                        'tipe_kategori3': v.tipe_kategori3,
                        'kategori3_id': v.kategori3_id,
                        'tipe_kategori4': $("#SKUKatalogSettingDetail-tipe_kategori4").val(),
                        'kategori4_id': "",
                        'tipe_kategori5': v.tipe_kategori5,
                        'kategori5_id': v.kategori5_id,
                        'tipe_kategori6': v.tipe_kategori6,
                        'kategori6_id': v.kategori6_id,
                        'sku_harga_id': v.sku_harga_id,
                        'sku_promo_id': v.sku_promo_id
                    };
                });

                GetSKUKatalogSettingDetail();
            } else {
                $("#SKUKatalogSettingDetail-tipe_kategori4").val("");
            }
        });
    }

    function UpdateKategori5SKUKatalogSettingDetail(kategori_grup) {
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

                $.each(sku_katalog_setting_detail, function(i, v) {
                    sku_katalog_setting_detail[i] = {
                        'index': i,
                        'tipe_kategori1': v.tipe_kategori1,
                        'kategori1_id': v.kategori1_id,
                        'tipe_kategori2': v.tipe_kategori2,
                        'kategori2_id': v.kategori2_id,
                        'tipe_kategori3': v.tipe_kategori3,
                        'kategori3_id': v.kategori3_id,
                        'tipe_kategori4': v.tipe_kategori4,
                        'kategori4_id': v.kategori4_id,
                        'tipe_kategori5': $("#SKUKatalogSettingDetail-tipe_kategori5").val(),
                        'kategori5_id': "",
                        'tipe_kategori6': v.tipe_kategori6,
                        'kategori6_id': v.kategori6_id,
                        'sku_harga_id': v.sku_harga_id,
                        'sku_promo_id': v.sku_promo_id
                    };
                });

                GetSKUKatalogSettingDetail();
            } else {
                $("#SKUKatalogSettingDetail-tipe_kategori5").val("");
            }
        });
    }

    function UpdateKategori6SKUKatalogSettingDetail(kategori_grup) {
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
                $.each(sku_katalog_setting_detail, function(i, v) {
                    sku_katalog_setting_detail[i] = {
                        'index': i,
                        'tipe_kategori1': v.tipe_kategori1,
                        'kategori1_id': v.kategori1_id,
                        'tipe_kategori2': v.tipe_kategori2,
                        'kategori2_id': v.kategori2_id,
                        'tipe_kategori3': v.tipe_kategori3,
                        'kategori3_id': v.kategori3_id,
                        'tipe_kategori4': v.tipe_kategori4,
                        'kategori4_id': v.kategori4_id,
                        'tipe_kategori5': v.tipe_kategori5,
                        'kategori5_id': v.kategori5_id,
                        'tipe_kategori6': $("#SKUKatalogSettingDetail-tipe_kategori6").val(),
                        'kategori6_id': "",
                        'sku_harga_id': v.sku_harga_id,
                        'sku_promo_id': v.sku_promo_id
                    };
                });

                GetSKUKatalogSettingDetail();
            } else {
                $("#SKUKatalogSettingDetail-tipe_kategori5").val("");
            }
        });
    }

    function UpdateSKUKatalogSettingDetail(index) {
        sku_katalog_setting_detail[index] = {
            'index': index,
            'tipe_kategori1': $("#SKUKatalogSettingDetail-tipe_kategori1").val(),
            'kategori1_id': $("#item-" + index + "-SKUKatalogSettingDetail-kategori1_id").val() !== undefined ? $("#item-" + index + "-SKUKatalogSettingDetail-kategori1_id").val() : '',
            'tipe_kategori2': $("#SKUKatalogSettingDetail-tipe_kategori2").val(),
            'kategori2_id': $("#item-" + index + "-SKUKatalogSettingDetail-kategori2_id").val() !== undefined ? $("#item-" + index + "-SKUKatalogSettingDetail-kategori2_id").val() : '',
            'tipe_kategori3': $("#SKUKatalogSettingDetail-tipe_kategori3").val(),
            'kategori3_id': $("#item-" + index + "-SKUKatalogSettingDetail-kategori3_id").val() !== undefined ? $("#item-" + index + "-SKUKatalogSettingDetail-kategori3_id").val() : '',
            'tipe_kategori4': $("#SKUKatalogSettingDetail-tipe_kategori4").val(),
            'kategori4_id': $("#item-" + index + "-SKUKatalogSettingDetail-kategori4_id").val() !== undefined ? $("#item-" + index + "-SKUKatalogSettingDetail-kategori4_id").val() : '',
            'tipe_kategori5': $("#SKUKatalogSettingDetail-tipe_kategori5").val(),
            'kategori5_id': $("#item-" + index + "-SKUKatalogSettingDetail-kategori5_id").val() !== undefined ? $("#item-" + index + "-SKUKatalogSettingDetail-kategori5_id").val() : '',
            'tipe_kategori6': $("#SKUKatalogSettingDetail-tipe_kategori6").val(),
            'kategori6_id': $("#item-" + index + "-SKUKatalogSettingDetail-kategori6_id").val() !== undefined ? $("#item-" + index + "-SKUKatalogSettingDetail-kategori6_id").val() : '',
            'sku_harga_id': $("#item-" + index + "-SKUKatalogSettingDetail-sku_harga_id").val(),
            'sku_promo_id': $("#item-" + index + "-SKUKatalogSettingDetail-sku_promo_id").val()
        };

        GetSKUKatalogSettingDetail();
    }

    function DeleteSKUKatalogSettingDetail(row, index) {
        var sku_katalog_setting_detail_temp = [];

        var row = row.parentNode.parentNode;
        row.parentNode.removeChild(row);

        sku_katalog_setting_detail[index] = "";
        sku_katalog_setting_detail_temp = sku_katalog_setting_detail;

        sku_katalog_setting_detail = [];

        $.each(sku_katalog_setting_detail_temp, function(i, v) {
            if (v != "") {
                sku_katalog_setting_detail.push(v);
            }
        });

        GetSKUKatalogSettingDetail();
    }

    //end function group

    //start button group

    $("#btn_tambah_sku_katalog_setting_detail").click(function() {

        var idx = sku_katalog_setting_detail.length;
        var cek_error = 0;

        if ($("#SKUKatalogSettingDetail-tipe_kategori1").val() == "" && $("#SKUKatalogSettingDetail-tipe_kategori2").val() == "" && $("#SKUKatalogSettingDetail-tipe_kategori3").val() == "" && $("#SKUKatalogSettingDetail-tipe_kategori4").val() == "" && $("#SKUKatalogSettingDetail-tipe_kategori5").val() == "" && $("#SKUKatalogSettingDetail-tipe_kategori6").val() == "") {

            var msg = GetLanguageByKode('CAPTION-ALERT-SETTINGKATEGORIKATALOGKOSONG');
            message("Error", msg, "error");

        } else {

            for (var i = 1; i <= 6; i++) {
                if ($("#SKUKatalogSettingDetail-tipe_kategori" + i).val() == $("#SKUKatalogSettingDetail-tipe_kategori1").val() && $("#SKUKatalogSettingDetail-tipe_kategori1").val() != "" && i != 1) {
                    cek_error++;
                }

                if ($("#SKUKatalogSettingDetail-tipe_kategori" + i).val() == $("#SKUKatalogSettingDetail-tipe_kategori2").val() && $("#SKUKatalogSettingDetail-tipe_kategori2").val() != "" && i != 2) {
                    cek_error++;
                }

                if ($("#SKUKatalogSettingDetail-tipe_kategori" + i).val() == $("#SKUKatalogSettingDetail-tipe_kategori3").val() && $("#SKUKatalogSettingDetail-tipe_kategori3").val() != "" && i != 3) {
                    cek_error++;
                }

                if ($("#SKUKatalogSettingDetail-tipe_kategori" + i).val() == $("#SKUKatalogSettingDetail-tipe_kategori4").val() && $("#SKUKatalogSettingDetail-tipe_kategori4").val() != "" && i != 4) {
                    cek_error++;
                }

                if ($("#SKUKatalogSettingDetail-tipe_kategori" + i).val() == $("#SKUKatalogSettingDetail-tipe_kategori5").val() && $("#SKUKatalogSettingDetail-tipe_kategori5").val() != "" && i != 5) {
                    cek_error++;
                }

                if ($("#SKUKatalogSettingDetail-tipe_kategori" + i).val() == $("#SKUKatalogSettingDetail-tipe_kategori6").val() && $("#SKUKatalogSettingDetail-tipe_kategori6").val() != "" && i != 6) {
                    cek_error++;
                }
            }

            if (cek_error == 0) {
                sku_katalog_setting_detail.push({
                    'index': idx,
                    'tipe_kategori1': $("#SKUKatalogSettingDetail-tipe_kategori1").val(),
                    'kategori1_id': "",
                    'tipe_kategori2': $("#SKUKatalogSettingDetail-tipe_kategori2").val(),
                    'kategori2_id': "",
                    'tipe_kategori3': $("#SKUKatalogSettingDetail-tipe_kategori3").val(),
                    'kategori3_id': "",
                    'tipe_kategori4': $("#SKUKatalogSettingDetail-tipe_kategori4").val(),
                    'kategori4_id': "",
                    'tipe_kategori5': $("#SKUKatalogSettingDetail-tipe_kategori5").val(),
                    'kategori5_id': "",
                    'tipe_kategori6': $("#SKUKatalogSettingDetail-tipe_kategori6").val(),
                    'kategori6_id': "",
                    'sku_harga_id': "",
                    'sku_promo_id': ""
                });

                GetSKUKatalogSettingDetail();
            } else {

                var msg = GetLanguageByKode('CAPTION-ALERT-SETTINGKATEGORIHARUSBERBEDA');
                var msgtype = 'error';

                //if (!window.__cfRLUnblockHandlers) return false;
                new PNotify
                    ({
                        title: 'Error',
                        text: msg,
                        type: msgtype,
                        styling: 'bootstrap3',
                        delay: 3000,
                        stack: stack_center
                    });
            }

        }

        // if ($("#SKUKatalogSettingDetail-tipe_kategori1").val() == "") {

        //     var msg = GetLanguageByKode('CAPTION-ALERT-SETTINGTIPEKATEGORI1TIDAKBOLEHKOSONG');
        //     var msgtype = 'error';

        //     //if (!window.__cfRLUnblockHandlers) return false;
        //     new PNotify
        //         ({
        //             title: 'Error',
        //             text: msg,
        //             type: msgtype,
        //             styling: 'bootstrap3',
        //             delay: 3000,
        //             stack: stack_center
        //         });

        // } else if ($("#SKUKatalogSettingDetail-tipe_kategori2").val() == "") {
        //     var msg = GetLanguageByKode('CAPTION-ALERT-SETTINGTIPEKATEGORI2TIDAKBOLEHKOSONG');
        //     var msgtype = 'error';

        //     //if (!window.__cfRLUnblockHandlers) return false;
        //     new PNotify
        //         ({
        //             title: 'Error',
        //             text: msg,
        //             type: msgtype,
        //             styling: 'bootstrap3',
        //             delay: 3000,
        //             stack: stack_center
        //         });

        // } else if ($("#SKUKatalogSettingDetail-tipe_kategori3").val() == "") {
        //     var msg = GetLanguageByKode('CAPTION-ALERT-SETTINGTIPEKATEGORI3TIDAKBOLEHKOSONG');
        //     var msgtype = 'error';

        //     //if (!window.__cfRLUnblockHandlers) return false;
        //     new PNotify
        //         ({
        //             title: 'Error',
        //             text: msg,
        //             type: msgtype,
        //             styling: 'bootstrap3',
        //             delay: 3000,
        //             stack: stack_center
        //         });

        // } else if ($("#SKUKatalogSettingDetail-tipe_kategori4").val() == "") {
        //     var msg = GetLanguageByKode('CAPTION-ALERT-SETTINGTIPEKATEGORI4TIDAKBOLEHKOSONG');
        //     var msgtype = 'error';

        //     //if (!window.__cfRLUnblockHandlers) return false;
        //     new PNotify
        //         ({
        //             title: 'Error',
        //             text: msg,
        //             type: msgtype,
        //             styling: 'bootstrap3',
        //             delay: 3000,
        //             stack: stack_center
        //         });

        // } else if ($("#SKUKatalogSettingDetail-tipe_kategori5").val() == "") {
        //     var msg = GetLanguageByKode('CAPTION-ALERT-SETTINGTIPEKATEGORI5TIDAKBOLEHKOSONG');
        //     var msgtype = 'error';

        //     //if (!window.__cfRLUnblockHandlers) return false;
        //     new PNotify
        //         ({
        //             title: 'Error',
        //             text: msg,
        //             type: msgtype,
        //             styling: 'bootstrap3',
        //             delay: 3000,
        //             stack: stack_center
        //         });

        // } else if ($("#SKUKatalogSettingDetail-tipe_kategori6").val() == "") {
        //     var msg = GetLanguageByKode('CAPTION-ALERT-SETTINGTIPEKATEGORI6TIDAKBOLEHKOSONG');
        //     var msgtype = 'error';

        //     //if (!window.__cfRLUnblockHandlers) return false;
        //     new PNotify
        //         ({
        //             title: 'Error',
        //             text: msg,
        //             type: msgtype,
        //             styling: 'bootstrap3',
        //             delay: 3000,
        //             stack: stack_center
        //         });

        // } else {

        //     sku_katalog_setting_detail.push({
        //         'index': idx,
        //         'tipe_kategori1': $("#SKUKatalogSettingDetail-tipe_kategori1").val(),
        //         'kategori1_id': "",
        //         'tipe_kategori2': $("#SKUKatalogSettingDetail-tipe_kategori2").val(),
        //         'kategori2_id': "",
        //         'tipe_kategori3': $("#SKUKatalogSettingDetail-tipe_kategori3").val(),
        //         'kategori3_id': "",
        //         'tipe_kategori4': $("#SKUKatalogSettingDetail-tipe_kategori4").val(),
        //         'kategori4_id': "",
        //         'tipe_kategori5': $("#SKUKatalogSettingDetail-tipe_kategori5").val(),
        //         'kategori5_id': "",
        //         'tipe_kategori6': $("#SKUKatalogSettingDetail-tipe_kategori6").val(),
        //         'kategori6_id': "",
        //         'sku_harga_id': "",
        //         'sku_promo_id': ""
        //     });

        //     GetSKUKatalogSettingDetail();

        // }

    });

    $("#btn_update_sku_katalog_setting").click(function() {
        var cek_error = 0;

        if (sku_katalog_setting_detail.length > 0) {

            $.each(sku_katalog_setting_detail, function(i, v) {
                if (v.kategori1_id == "" && v.kategori2_id == "" && v.kategori3_id == "" && v.kategori4_id == "" && v.kategori5_id == "" && v.kategori6_id == "") {

                    var msg = GetLanguageByKode('CAPTION-ALERT-SETTINGKATEGORIKATALOGDETAILKOSONG');
                    var msgtype = 'error';

                    //if (!window.__cfRLUnblockHandlers) return false;
                    new PNotify
                        ({
                            title: 'Error',
                            text: msg,
                            type: msgtype,
                            styling: 'bootstrap3',
                            delay: 3000,
                            stack: stack_center
                        });

                    cek_error++;

                }

                if ((v.sku_harga_id == "" || v.sku_harga_id === null) && (v.sku_promo_id == "" || v.sku_promo_id === null)) {
                    var msg = GetLanguageByKode('CAPTION-ALERT-SETTINGKATALOGHARGAPROMOKOSONG');
                    var msgtype = 'error';

                    //if (!window.__cfRLUnblockHandlers) return false;
                    new PNotify
                        ({
                            title: 'Error',
                            text: msg,
                            type: msgtype,
                            styling: 'bootstrap3',
                            delay: 3000,
                            stack: stack_center
                        });

                    cek_error++;
                }
            });

            if ($("#SKUKatalogSetting-sku_katalog_setting_kode").val() == "") {
                var msg = GetLanguageByKode('CAPTION-CHECKKODE');
                var msgtype = 'error';

                //if (!window.__cfRLUnblockHandlers) return false;
                new PNotify
                    ({
                        title: 'Error',
                        text: msg,
                        type: msgtype,
                        styling: 'bootstrap3',
                        delay: 3000,
                        stack: stack_center
                    });

            }

            if ($("#SKUKatalogSetting-sku_katalog_setting_keterangan").val() == "") {
                var msg = GetLanguageByKode('CAPTION-ALERT-KETERANGANKOSONG');
                var msgtype = 'error';

                //if (!window.__cfRLUnblockHandlers) return false;
                new PNotify
                    ({
                        title: 'Error',
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

                        $("#loading").show();
                        $("#btn_update_sku_katalog_setting").prop("disabled", true);
                        $("#btn_delete_sku_katalog_setting").prop("disabled", true);
                        $("#btn_tambah_sku_katalog_setting_detail").prop("disabled", true);

                        $.ajax({
                            async: false,
                            type: 'POST',
                            url: "<?= base_url('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/update_sku_katalog_setting') ?>",
                            data: {
                                sku_katalog_setting_id: $("#SKUKatalogSetting-sku_katalog_setting_id").val(),
                                sku_katalog_setting_kode: $("#SKUKatalogSetting-sku_katalog_setting_kode").val(),
                                client_wms_id: "<?= $this->session->userdata('client_wms_id') ?>",
                                depo_id: "<?= $this->session->userdata('depo_id') ?>",
                                sku_katalog_setting_keterangan: $("#SKUKatalogSetting-sku_katalog_setting_keterangan").val(),
                                sku_katalog_setting_status: "Draft",
                                sku_katalog_setting_who_create: "<?= $this->session->userdata('pengguna_username') ?>",
                                sku_katalog_setting_tgl_create: "<?= date('Y-m-d H:i:s') ?>",
                                sku_katalog_setting_who_approve: "",
                                sku_katalog_setting_tgl_approve: "",
                                sku_katalog_setting_is_aktif: "1",
                                detail: sku_katalog_setting_detail
                            },
                            dataType: "JSON",
                            success: function(response) {

                                if (response.kode == 1) {
                                    $("#loading").hide();
                                    $("#btn_update_sku_katalog_setting").prop("disabled", false);
                                    $("#btn_delete_sku_katalog_setting").prop("disabled", false);
                                    $("#btn_tambah_sku_katalog_setting_detail").prop("disabled", false);

                                    var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                    message_topright("Success", "success", msg);

                                    setTimeout(() => {
                                        location.href = "<?= base_url() ?>FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/KonfigurasiKatalogMenu";
                                    }, 500);

                                } else if (response.kode == 2) {
                                    var msg = GetLanguageByKode('CAPTION-ALERT-KODEKEMBAR');
                                    message_topright("Error", "error", msg);

                                    $("#loading").hide();
                                    $("#btn_update_sku_katalog_setting").prop("disabled", false);
                                    $("#btn_delete_sku_katalog_setting").prop("disabled", false);
                                    $("#btn_tambah_sku_katalog_setting_detail").prop("disabled", false);

                                } else {
                                    var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                    message_topright("Error", "error", msg);

                                    $("#loading").hide();
                                    $("#btn_update_sku_katalog_setting").prop("disabled", false);
                                    $("#btn_delete_sku_katalog_setting").prop("disabled", false);
                                    $("#btn_tambah_sku_katalog_setting_detail").prop("disabled", false);

                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                message_topright("Error", "error", msg);

                                $("#loading").hide();
                                $("#btn_update_sku_katalog_setting").prop("disabled", false);
                                $("#btn_delete_sku_katalog_setting").prop("disabled", false);
                                $("#btn_tambah_sku_katalog_setting_detail").prop("disabled", false);
                            }
                        });
                    }
                });
            }

        } else {
            var msg = GetLanguageByKode('CAPTION-ALERT-SETTINGKATALOGDETAILKOSONG');
            message("Error", msg, "error");
            cek_error++;
        }

    });

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
        // 					title: 'Error',
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