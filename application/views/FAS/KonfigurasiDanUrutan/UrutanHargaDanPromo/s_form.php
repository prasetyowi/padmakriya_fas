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
    var arr_urutan = [];

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

            <?php if ($UrutanDepo > 0) { ?>
                <?php foreach ($UrutanHargaPromo as $key => $value) : ?>
                    arr_urutan.push({
                        'index': "<?= $key ?>",
                        'katalog': "<?= $value['sku_katalog_setting_id'] ?>",
                        'perhitungan': "<?= $value['is_perhitungan'] ?>"
                    });
                <?php endforeach; ?>
            <?php } ?>

            GetUrutan();

            // console.log(arr_urutan);
        }
    );

    //start function group

    function GetUrutan() {

        var table_katalog_header = "";
        var table_katalog_body = "";

        $("#loading").show();
        $("#btn_save_urutan").prop("disabled", true);
        $("#btn_tambah_urutan").prop("disabled", true);

        $('#table-urutan > tbody').html('');

        $.each(arr_urutan, function(i, v) {

            $('#table-urutan > tbody').append(`
                <tr id="row-${i}">
            	    <td style="vertical-align:middle; text-align:center;">${i+1}</td>
            		<td style="vertical-align:middle; text-align:center;"><span id="item-${i}-Urutan-keterangan"></span></td>
                    <td style="vertical-align:middle; text-align:center;width:35%">
            		    <select class="input-sm form-control select2" id="item-${i}-Urutan-katalog" style="width:100%;" onChange="UpdateUrutan(${i})">
                            <option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
                            <?php if (isset($KatalogHeader)) {
                                foreach ($KatalogHeader as $row) :
                            ?>
                                <option value="<?= $row['sku_katalog_setting_id'] ?>" ${v.katalog == '<?= $row['sku_katalog_setting_id'] ?>' ? 'selected' : ''}><?= $row['sku_katalog_setting_kode'] ?></option>
                            <?php endforeach;
                            } ?>
                        </select>
            		</td>
                    <td style="vertical-align:middle; text-align:center;">
                        <input type="checkbox" id="item-${i}-Urutan-perhitungan" value="1" onChange="UpdateUrutan(${i})" ${v.perhitungan == '1' ? 'checked' : ''}>
            		</td>
                    <td style="vertical-align:middle; text-align:center;">
            		    <a class="btn btn-primary btn-small" href="<?= base_url() ?>/FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/detail/${v.sku_katalog_setting_id}"><i class="fa fa-search"></i></a>
            		    <button class="btn btn-danger btn-small" onclick="DeleteUrutan(this,'${i}')"><i class="fa fa-trash"></i></button>
            		</td>
            	</tr>';
            `);
        });

        $.each(arr_urutan, function(i, v) {

            $("#item-" + i + "-Urutan-keterangan").html('');

            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/GetKeteranganKatalogSetting') ?>",
                data: {
                    sku_katalog_setting_id: v.katalog
                },
                dataType: "JSON",
                success: function(response) {
                    if (response != 0) {
                        $.each(response, function(idx, val) {
                            $("#item-" + i + "-Urutan-keterangan").append(`${val.sku_harga_id}${val.sku_harga_id != '' && val.sku_promo_id != '' ? ',' : '' } ${val.sku_promo_id}`);
                        })
                    }

                }
            });
        });

        $(".select2").select2();

        $("#loading").hide();
        $("#btn_save_urutan").prop("disabled", false);
        $("#btn_tambah_urutan").prop("disabled", false);
    }

    function UpdateUrutan(index) {
        arr_urutan[index] = {
            'index': index,
            'katalog': $("#item-" + index + "-Urutan-katalog").val(),
            'perhitungan': $("#item-" + index + "-Urutan-perhitungan").prop('checked') == true ? $("#item-" + index + "-Urutan-perhitungan").val() : ''
        };

        GetUrutan();
    }

    function DeleteUrutan(row, index) {
        var arr_urutan_temp = [];

        var row = row.parentNode.parentNode;
        row.parentNode.removeChild(row);

        arr_urutan[index] = "";
        arr_urutan_temp = arr_urutan;

        arr_urutan = [];

        $.each(arr_urutan_temp, function(i, v) {
            if (v != "") {
                arr_urutan.push({
                    'index': i,
                    'katalog': v.katalog,
                    'perhitungan': v.perhitungan
                });
            }
        });

        GetUrutan();
    }

    //end function group

    //start button group

    $("#btn_tambah_urutan").click(function() {

        var idx = arr_urutan.length;
        var cek_error = 0;

        arr_urutan.push({
            'index': idx,
            'katalog': "",
            'perhitungan': ""
        });

        GetUrutan();

    });

    $("#btn_save_sku_urutan_harga_promo").click(function() {
        var cek_error = 0;

        if (arr_urutan.length > 0) {

            $.each(arr_urutan, function(i, v) {

                if (v.katalog == "") {
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
                        $("#btn_save_sku_urutan_harga_promo").prop("disabled", true);
                        $("#btn_update_sku_urutan_harga_promo").prop("disabled", true);
                        $("#btn_delete_sku_urutan_harga_promo").prop("disabled", true);
                        $("#btn_tambah_arr_urutan").prop("disabled", true);

                        $.ajax({
                            async: false,
                            type: 'POST',
                            url: "<?= base_url('FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/insert_sku_urutan_harga_promo') ?>",
                            data: {
                                detail: arr_urutan
                            },
                            dataType: "JSON",
                            success: function(response) {

                                $.each(response, function(i, v) {

                                    if (v == 1) {
                                        $("#loading").hide();
                                        $("#btn_save_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_update_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_delete_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_tambah_arr_urutan").prop("disabled", false);

                                        var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                        message_topright("Success", "success", msg);

                                        setTimeout(() => {
                                            location.href = "<?= base_url() ?>FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/UrutanHargaDanPromoMenu";
                                        }, 500);

                                    } else if (v == 2) {
                                        var msg = GetLanguageByKode('CAPTION-ALERT-KODEKEMBAR');
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
                                            })
                                        // message_topright("Error", "error", msg);

                                        $("#loading").hide();
                                        $("#btn_save_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_update_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_delete_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_tambah_arr_urutan").prop("disabled", false);

                                        return false;

                                    } else {
                                        var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                        message_topright("Error", "error", msg);

                                        $("#loading").hide();
                                        $("#btn_save_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_update_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_delete_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_tambah_arr_urutan").prop("disabled", false);

                                        return false;

                                    }

                                });
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                message_topright("Error", "error", msg);

                                $("#loading").hide();
                                $("#btn_save_sku_urutan_harga_promo").prop("disabled", false);
                                $("#btn_update_sku_urutan_harga_promo").prop("disabled", false);
                                $("#btn_delete_sku_urutan_harga_promo").prop("disabled", false);
                                $("#btn_tambah_arr_urutan").prop("disabled", false);
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

    $("#btn_update_sku_urutan_harga_promo").click(function() {
        var cek_error = 0;

        if (arr_urutan.length > 0) {

            $.each(arr_urutan, function(i, v) {

                if (v.katalog == "") {
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
                        $("#btn_save_sku_urutan_harga_promo").prop("disabled", true);
                        $("#btn_update_sku_urutan_harga_promo").prop("disabled", true);
                        $("#btn_delete_sku_urutan_harga_promo").prop("disabled", true);
                        $("#btn_tambah_arr_urutan").prop("disabled", true);

                        $.ajax({
                            async: false,
                            type: 'POST',
                            url: "<?= base_url('FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/update_sku_urutan_harga_promo') ?>",
                            data: {
                                detail: arr_urutan
                            },
                            dataType: "JSON",
                            success: function(response) {

                                $.each(response, function(i, v) {

                                    if (v == 1) {
                                        $("#loading").hide();
                                        $("#btn_save_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_update_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_delete_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_tambah_arr_urutan").prop("disabled", false);

                                        var msg = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                        message_topright("Success", "success", msg);

                                        setTimeout(() => {
                                            location.href = "<?= base_url() ?>FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/UrutanHargaDanPromoMenu";
                                        }, 500);

                                    } else if (v == 2) {
                                        var msg = GetLanguageByKode('CAPTION-ALERT-KODEKEMBAR');
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
                                            })
                                        // message_topright("Error", "error", msg);

                                        $("#loading").hide();
                                        $("#btn_save_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_update_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_delete_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_tambah_arr_urutan").prop("disabled", false);

                                        return false;

                                    } else {
                                        var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                        message_topright("Error", "error", msg);

                                        $("#loading").hide();
                                        $("#btn_save_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_update_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_delete_sku_urutan_harga_promo").prop("disabled", false);
                                        $("#btn_tambah_arr_urutan").prop("disabled", false);

                                        return false;

                                    }

                                });
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                var msg = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                                message_topright("Error", "error", msg);

                                $("#loading").hide();
                                $("#btn_save_sku_urutan_harga_promo").prop("disabled", false);
                                $("#btn_update_sku_urutan_harga_promo").prop("disabled", false);
                                $("#btn_delete_sku_urutan_harga_promo").prop("disabled", false);
                                $("#btn_tambah_arr_urutan").prop("disabled", false);
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