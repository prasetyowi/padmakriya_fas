<script type="text/javascript">
    var arr_pengaturan_khusus = [];

    $(document).ready(function() {
        $(".select2").select2();
        // Get_pengaturan_piutang_outlet();

        $('#filter_brand').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_brand') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });

        $('#filter_sku_id').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_sku') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });

        $('#PengaturanPiutangOutlet-segment1').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_segment1') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });

        $('#PengaturanPiutangOutlet-segment2').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_segment2') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });

        $('#PengaturanPiutangOutlet-segment3').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_segment3') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });

        $('#PengaturanPiutangOutlet-brand').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_brand') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });

        $('#PengaturanPiutangOutlet-sku_id').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_sku') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });
    });

    function message_custom(titleType, iconType, htmlType) {
        Swal.fire({
            title: titleType,
            icon: iconType,
            html: htmlType,
        });
    }

    $("#btn_add_pengaturan_piutang_outlet").click(function() {
        $("#modal_tambah_client_pt_setting_piutang").modal('show');
    });

    $("#btn_refresh_pengaturan_piutang_outlet").click(function() {
        Get_pengaturan_piutang_outlet();
    });

    function Get_pengaturan_piutang_outlet() {

        if ($("#filter_perusahaan").val() != "") {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/Get_pengaturan_piutang_outlet') ?>",
                data: {
                    perusahaan: $("#filter_perusahaan").val(),
                    brand: $("#filter_brand").val(),
                    sku_id: $("#filter_sku_id").val(),
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

                    $('#table_pengaturan_piutang_outlet').fadeOut("slow", function() {
                        $(this).hide();

                        $('#table_pengaturan_piutang_outlet > tbody').empty('');

                        if ($.fn.DataTable.isDataTable('#table_pengaturan_piutang_outlet')) {
                            $('#table_pengaturan_piutang_outlet').DataTable().clear();
                            $('#table_pengaturan_piutang_outlet').DataTable().destroy();
                        }

                    }).fadeIn("slow", function() {
                        $(this).show();

                        if (response.length != 0) {

                            $.each(response, function(i, v) {
                                $("#table_pengaturan_piutang_outlet > tbody").append(`
								<tr>
									<td class="text-center">${i+1}</td>
									<td class="text-center">${v.client_pt_setting_segment1}</td>
									<td class="text-center">${v.client_pt_setting_segment1_ket}</td>
									<td class="text-center">${v.client_pt_setting_segment2}</td>
									<td class="text-center">${v.client_pt_setting_segment2_ket}</td>
									<td class="text-center">${v.client_pt_setting_segment3}</td>
									<td class="text-center">${v.client_pt_setting_segment3_ket}</td>
									<td class="text-center">${v.client_pt_setting_category}</td>
									<td class="text-center">${v.principle_brand_nama}</td>
									<td class="text-center">${v.sku_nama_produk}</td>
									<td class="text-center">${v.client_pt_setting_top}</td>
									<td class="text-center">
										<button type="button" class="btn btn-warning btn-sm" onClick="Edit_client_pt_setting_piutang('${v.client_pt_setting_piutang_id}')"><i class="fa fa-pencil"></i></button>
										<button type="button" class="btn btn-danger btn-sm" onClick="Delete_client_pt_setting_piutang('${v.client_pt_setting_piutang_id}')"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
							`);
                            });

                            $("#table_pengaturan_piutang_outlet").DataTable({
                                lengthMenu: [
                                    [50, 100, 200, -1],
                                    [50, 100, 200, 'All'],
                                ],
                            });
                        }
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
            const msg = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
            message_custom("Error", "error", msg);
        }
    }

    function TambahListPengaturanPiutangOutletKhusus(tipe) {
        arr_pengaturan_khusus.push({
            'idx': '',
            'tipe': 'client_pt',
            'client_pt_id': '',
            'client_pt_nama': ''
        });

        console.log(tipe);

        Get_pengaturan_piutang_outlet_khusus(tipe);
    }

    function Edit_client_pt_setting_piutang(id) {
        $("#modal_edit_client_pt_setting_piutang").modal('show');

        $("#PengaturanPiutangOutlet-segment1-edit").html('');
        $("#PengaturanPiutangOutlet-segment2-edit").html('');
        $("#PengaturanPiutangOutlet-segment3-edit").html('');
        $("#PengaturanPiutangOutlet-brand-edit").html('');
        $("#PengaturanPiutangOutlet-sku_id-edit").html('');

        arr_pengaturan_khusus = [];

        $.ajax({
            type: 'GET',
            url: "<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/Get_pengaturan_piutang_outlet_by_id') ?>",
            data: {
                id: id
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

                if (response.header.length != 0) {
                    $.each(response.header, function(i, v) {
                        $('#PengaturanPiutangOutlet-client_pt_setting_piutang_id-edit').val(v.client_pt_setting_piutang_id);
                        $('#PengaturanPiutangOutlet-top-edit').val(v.client_pt_setting_top);
                        $('#PengaturanPiutangOutlet-updwho-edit').val(v.updwho);
                        $('#PengaturanPiutangOutlet-updtgl-edit').val(v.updtgl);

                        $("#PengaturanPiutangOutlet-category-edit option[value='" + v.client_pt_setting_category + "']").prop("selected", true);
                        $("#PengaturanPiutangOutlet-client_wms_id-edit option[value='" + v.client_wms_id + "']").prop("selected", true);

                        $('#PengaturanPiutangOutlet-category-edit').val(v.client_pt_setting_category).trigger('change');
                        $('#PengaturanPiutangOutlet-client_wms_id-edit').val(v.client_wms_id).trigger('change');

                        // $("#PengaturanPiutangOutlet-segment1-edit").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
                        // $("#PengaturanPiutangOutlet-segment2-edit").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
                        // $("#PengaturanPiutangOutlet-segment3-edit").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
                        // $("#PengaturanPiutangOutlet-brand-edit").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);
                        // $("#PengaturanPiutangOutlet-sku_id-edit").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);

                        $("#PengaturanPiutangOutlet-segment1-edit").append(`<option value="${v.client_pt_setting_segment1}" selected>${v.client_pt_setting_segment1 + " || " + v.client_pt_setting_segment1_ket}</option>`);
                        $("#PengaturanPiutangOutlet-segment2-edit").append(`<option value="${v.client_pt_setting_segment2}" selected>${v.client_pt_setting_segment2 + " || " + v.client_pt_setting_segment2_ket}</option>`);
                        $("#PengaturanPiutangOutlet-segment3-edit").append(`<option value="${v.client_pt_setting_segment3}" selected>${v.client_pt_setting_segment3 + " || " + v.client_pt_setting_segment3_ket}</option>`);
                        $("#PengaturanPiutangOutlet-brand-edit").append(`<option value="${v.client_pt_setting_brand}" selected>${v.principle_brand_nama}</option>`);
                        $("#PengaturanPiutangOutlet-sku_id-edit").append(`<option value="${v.client_pt_setting_sku_id}" selected>${v.sku_nama_produk}</option>`);

                        if (v.client_pt_setting_is_aktif == "1") {
                            $("#PengaturanPiutangOutlet-is_aktif-edit").prop("checked", true);
                        } else {
                            $("#PengaturanPiutangOutlet-is_aktif-edit").prop("checked", false);
                        }

                        $('#PengaturanPiutangOutlet-segment1-edit').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_segment1') ?>', // URL to your CodeIgniter controller method
                                dataType: 'json',
                                delay: 250,
                                data: function(params) {
                                    return {
                                        q: params.term
                                    };
                                },
                                processResults: function(data, params) {
                                    return {
                                        results: data
                                    };
                                },
                                cache: true
                            },
                            placeholder: GetLanguageByKode('CAPTION-PILIH'),
                            // minimumInputLength: 3
                        });

                        $('#PengaturanPiutangOutlet-segment2-edit').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_segment2') ?>', // URL to your CodeIgniter controller method
                                dataType: 'json',
                                delay: 250,
                                data: function(params) {
                                    return {
                                        q: params.term
                                    };
                                },
                                processResults: function(data, params) {
                                    return {
                                        results: data
                                    };
                                },
                                cache: true
                            },
                            placeholder: GetLanguageByKode('CAPTION-PILIH'),
                            // minimumInputLength: 3
                        });

                        $('#PengaturanPiutangOutlet-segment3-edit').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_segment3') ?>', // URL to your CodeIgniter controller method
                                dataType: 'json',
                                delay: 250,
                                data: function(params) {
                                    return {
                                        q: params.term
                                    };
                                },
                                processResults: function(data, params) {
                                    return {
                                        results: data
                                    };
                                },
                                cache: true
                            },
                            placeholder: GetLanguageByKode('CAPTION-PILIH'),
                            // minimumInputLength: 3
                        });

                        $('#PengaturanPiutangOutlet-brand-edit').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_brand') ?>', // URL to your CodeIgniter controller method
                                dataType: 'json',
                                delay: 250,
                                data: function(params) {
                                    return {
                                        q: params.term
                                    };
                                },
                                processResults: function(data, params) {
                                    return {
                                        results: data
                                    };
                                },
                                cache: true
                            },
                            placeholder: GetLanguageByKode('CAPTION-PILIH'),
                            // minimumInputLength: 3
                        });

                        $('#PengaturanPiutangOutlet-sku_id-edit').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_sku') ?>', // URL to your CodeIgniter controller method
                                dataType: 'json',
                                delay: 250,
                                data: function(params) {
                                    return {
                                        q: params.term
                                    };
                                },
                                processResults: function(data, params) {
                                    return {
                                        results: data
                                    };
                                },
                                cache: true
                            },
                            placeholder: GetLanguageByKode('CAPTION-PILIH'),
                            // minimumInputLength: 3
                        });

                    });

                    $.each(response.detail, function(i, v) {
                        arr_pengaturan_khusus.push({
                            'idx': i,
                            'tipe': 'client_pt',
                            'client_pt_id': v.client_pt_id,
                            'client_pt_nama': v.client_pt_nama
                        });
                    });

                    Get_pengaturan_piutang_outlet_khusus('edit');
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

    function Get_pengaturan_piutang_outlet_khusus(tipe) {
        if (tipe == "tambah") {

            $("#table_pengaturan_piutang_outlet_khusus_tambah > tbody").html('');
            $("#table_pengaturan_piutang_outlet_khusus_tambah > tbody").empty();

            if (arr_pengaturan_khusus.length != 0) {
                $.each(arr_pengaturan_khusus, function(i, v) {

                    $("#table_pengaturan_piutang_outlet_khusus_tambah > tbody").append(`
						<tr>
							<td class="text-center" style="width:5%">
								${i+1}
								<input type="hidden" id="item-${i}-client_pt_setting_piutang_khusus-idx" class="form-control" autocomplete="off" value="${i}">
							</td>
							<td class="text-center" style="width:20%;">
								<input type="text" name="item-${i}-client_pt_setting_piutang_khusus-client_pt_nama" id="item-${i}-client_pt_setting_piutang_khusus-client_pt_nama" class="form-control" value="${v.client_pt_nama}"/>
								<input type="hidden" name="item-${i}-client_pt_setting_piutang_khusus-client_pt_id" id="item-${i}-client_pt_setting_piutang_khusus-client_pt_id" class="form-control" value="${v.client_pt_id}" />
							</td>
							<td class="text-center" style="width:5%">
								<button type="button" id="btn_delete_list_client_pt_setting_piutang_khusus" class="btn btn-sm btn-danger" onclick="Delete_list_client_pt_setting_piutang_khusus('${tipe}','${i}')"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
					`);
                });

                $.each(arr_pengaturan_khusus, function(i, v) {
                    $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_nama").autocomplete({
                        serviceUrl: "<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/search_client_pt') ?>",
                        params: {
                            // "msglseg": function() {
                            //     return $("#PengaturanPiutangOutlet-msglseg").val();
                            // },
                        },
                        dataType: 'json',
                        onSearchComplete: function(query, suggestions) {
                            if (suggestions.length == 0) {

                                setTimeout(() => {
                                    $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_id").val('');
                                    $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_nama").val('');
                                }, 1000);
                            }
                        },
                        onSelect: function(data) {
                            if (data) {
                                $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_id").val(data.client_pt_id);
                                $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_nama").val(data.client_pt_nama);

                                Update_list_client_pt_setting_piutang_khusus(tipe, i);
                            } else {
                                $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_id").val('');
                                $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_nama").val('');
                            }
                        }
                    });
                });
            }
        } else if (tipe == "edit") {
            $("#table_pengaturan_piutang_outlet_khusus_edit > tbody").html('');
            $("#table_pengaturan_piutang_outlet_khusus_edit > tbody").empty();

            if (arr_pengaturan_khusus.length != 0) {
                $.each(arr_pengaturan_khusus, function(i, v) {

                    $("#table_pengaturan_piutang_outlet_khusus_edit > tbody").append(`
						<tr>
							<td class="text-center" style="width:5%">
								${i+1}
								<input type="hidden" id="item-${i}-client_pt_setting_piutang_khusus-idx-edit" class="form-control" autocomplete="off" value="${i}">
							</td>
							<td class="text-center" style="width:20%;">
								<input type="text" name="item-${i}-client_pt_setting_piutang_khusus-client_pt_nama-edit" id="item-${i}-client_pt_setting_piutang_khusus-client_pt_nama-edit" class="form-control" value="${v.client_pt_nama}"/>
								<input type="hidden" name="item-${i}-client_pt_setting_piutang_khusus-client_pt_id-edit" id="item-${i}-client_pt_setting_piutang_khusus-client_pt_id-edit" class="form-control" value="${v.client_pt_id}" />
							</td>
							<td class="text-center" style="width:5%">
								<button type="button" id="btn_delete_list_client_pt_setting_piutang_khusus" class="btn btn-sm btn-danger" onclick="Delete_list_client_pt_setting_piutang_khusus('${tipe}','${i}')"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
					`);
                });

                $.each(arr_pengaturan_khusus, function(i, v) {
                    $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_nama-edit").autocomplete({
                        serviceUrl: "<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/search_client_pt') ?>",
                        params: {
                            // "msglseg": function() {
                            //     return $("#PengaturanPiutangOutlet-msglseg").val();
                            // },
                        },
                        dataType: 'json',
                        onSearchComplete: function(query, suggestions) {
                            if (suggestions.length == 0) {

                                setTimeout(() => {
                                    $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_id-edit").val('');
                                    $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_nama-edit").val('');
                                }, 1000);
                            }
                        },
                        onSelect: function(data) {
                            if (data) {
                                $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_id-edit").val(data.client_pt_id);
                                $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_nama-edit").val(data.client_pt_nama);

                                Update_list_client_pt_setting_piutang_khusus(tipe, i);
                            } else {
                                $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_id-edit").val('');
                                $("#item-" + i + "-client_pt_setting_piutang_khusus-client_pt_nama-edit").val('');
                            }
                        }
                    });
                });
            }
        }

    }

    function Update_list_client_pt_setting_piutang_khusus(tipe, index) {
        if (tipe == "tambah") {

            arr_pengaturan_khusus[index] = ({
                'idx': $('#item-' + index + '-client_pt_setting_piutang_khusus-idx').val(),
                'tipe': 'client_pt',
                'client_pt_id': $('#item-' + index + '-client_pt_setting_piutang_khusus-client_pt_id').val(),
                'client_pt_nama': $('#item-' + index + '-client_pt_setting_piutang_khusus-client_pt_nama').val()
            });

        } else if (tipe == "edit") {

            arr_pengaturan_khusus[index] = ({
                'idx': $('#item-' + index + '-client_pt_setting_piutang_khusus-idx-edit').val(),
                'tipe': 'client_pt',
                'client_pt_id': $('#item-' + index + '-client_pt_setting_piutang_khusus-client_pt_id-edit').val(),
                'client_pt_nama': $('#item-' + index + '-client_pt_setting_piutang_khusus-client_pt_nama-edit').val()
            });
        }
    }

    $("#btn_simpan_pengaturan_piutang_outlet").click(function() {

        if ($("#PengaturanPiutangOutlet-segment1").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-SEGMENT1KOSONG');
            message_custom("Error", "error", msg);

            return false;
        }

        if ($("#PengaturanPiutangOutlet-segment2").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-SEGMENT2KOSONG');
            message_custom("Error", "error", msg);

            return false;
        }

        if ($("#PengaturanPiutangOutlet-segment3").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-SEGMENT3KOSONG');
            message_custom("Error", "error", msg);

            return false;
        }

        if ($("#PengaturanPiutangOutlet-client_wms_id").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
            message_custom("Error", "error", msg);

            return false;
        }

        if ($("#PengaturanPiutangOutlet-category").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-KATEGORITIDAKDIPILIH');
            message_custom("Error", "error", msg);

            return false;
        }

        if ($("#PengaturanPiutangOutlet-category").val() == "BRAND") {
            if ($("#PengaturanPiutangOutlet-brand").val() == "") {
                const msg = GetLanguageByKode('CAPTION-ALERT-BRANDTIDAKDIPILIH');
                message_custom("Error", "error", msg);

                return false;
            }
        } else if ($("#PengaturanPiutangOutlet-category").val() == "SKU INDUK") {
            if ($("#PengaturanPiutangOutlet-sku_id").val() == "") {
                const msg = GetLanguageByKode('CAPTION-PILIHSKUINDUK');
                message_custom("Error", "error", msg);

                return false;
            }
        }

        if ($("#PengaturanPiutangOutlet-top").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-TOPKOSONG');
            message_custom("Error", "error", msg);

            return false;
        }

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
                    url: "<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/insert_client_pt_setting_piutang'); ?>",
                    type: "POST",
                    beforeSend: function() {

                        Swal.fire({
                            title: 'Loading ...',
                            html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                            timerProgressBar: false,
                            showConfirmButton: false
                        });

                        $("#btn_simpan_pengaturan_piutang_outlet").prop("disabled", true);
                    },
                    data: {
                        client_pt_setting_segment1: $('#PengaturanPiutangOutlet-segment1').val(),
                        client_pt_setting_segment2: $('#PengaturanPiutangOutlet-segment2').val(),
                        client_pt_setting_segment3: $('#PengaturanPiutangOutlet-segment3').val(),
                        client_pt_setting_category: $('#PengaturanPiutangOutlet-category').val(),
                        client_pt_setting_brand: $('#PengaturanPiutangOutlet-brand').val(),
                        client_pt_setting_sku_id: $('#PengaturanPiutangOutlet-sku_id').val(),
                        client_pt_setting_top: $('#PengaturanPiutangOutlet-top').val(),
                        client_wms_id: $('#PengaturanPiutangOutlet-client_wms_id').val(),
                        client_pt_setting_is_aktif: 1,
                        detail: arr_pengaturan_khusus
                    },
                    dataType: "JSON",
                    success: function(response) {

                        if (response == 1) {

                            var alert = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                            // var alert = "Data Berhasil Disimpan";
                            message_custom("Success", "success", alert);
                            setTimeout(() => {
                                Get_pengaturan_piutang_outlet()
                            }, 500);

                            ResetForm();

                            $("#modal_tambah_client_pt_setting_piutang").modal('hide');
                        } else {
                            var alert = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                            // var alert = "Data Gagal Disimpan";
                            message_custom("Error", "error", alert);
                        }

                        $("#btn_simpan_pengaturan_piutang_outlet").prop("disabled", false);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        message("Error", "Error 500 Internal Server Connection Failure", "error");

                        $("#btn_simpan_pengaturan_piutang_outlet").prop("disabled", false);
                    },
                    complete: function() {
                        // Swal.close();
                        $("#btn_simpan_pengaturan_piutang_outlet").prop("disabled", false);
                        $("#modal_tambah_client_pt_setting_piutang").modal('hide');
                    }
                });
            }
        });
    });

    $("#btn_update_pengaturan_piutang_outlet").click(function() {

        if ($("#PengaturanPiutangOutlet-segment1-edit").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-SEGMENT1KOSONG');
            message_custom("Error", "error", msg);

            return false;
        }

        if ($("#PengaturanPiutangOutlet-segment2-edit").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-SEGMENT2KOSONG');
            message_custom("Error", "error", msg);

            return false;
        }

        if ($("#PengaturanPiutangOutlet-segment3-edit").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-SEGMENT3KOSONG');
            message_custom("Error", "error", msg);

            return false;
        }

        if ($("#PengaturanPiutangOutlet-client_wms_id-edit").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
            message_custom("Error", "error", msg);

            return false;
        }

        if ($("#PengaturanPiutangOutlet-category-edit").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-KATEGORITIDAKDIPILIH');
            message_custom("Error", "error", msg);

            return false;
        }

        if ($("#PengaturanPiutangOutlet-category-edit").val() == "BRAND") {
            if ($("#PengaturanPiutangOutlet-brand-edit").val() == "") {
                const msg = GetLanguageByKode('CAPTION-ALERT-BRANDTIDAKDIPILIH');
                message_custom("Error", "error", msg);

                return false;
            }
        } else if ($("#PengaturanPiutangOutlet-category-edit").val() == "SKU INDUK") {
            if ($("#PengaturanPiutangOutlet-sku_id-edit").val() == "") {
                const msg = GetLanguageByKode('CAPTION-PILIHSKUINDUK');
                message_custom("Error", "error", msg);

                return false;
            }
        }

        if ($("#PengaturanPiutangOutlet-top-edit").val() == "") {
            const msg = GetLanguageByKode('CAPTION-ALERT-TOPKOSONG');
            message_custom("Error", "error", msg);

            return false;
        }

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
                    url: "<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/update_client_pt_setting_piutang'); ?>",
                    type: "POST",
                    beforeSend: function() {

                        Swal.fire({
                            title: 'Loading ...',
                            html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                            timerProgressBar: false,
                            showConfirmButton: false
                        });

                        $("#btn_update_pengaturan_piutang_outlet").prop("disabled", true);
                    },
                    data: {
                        client_pt_setting_piutang_id: $('#PengaturanPiutangOutlet-client_pt_setting_piutang_id-edit').val(),
                        client_pt_setting_segment1: $('#PengaturanPiutangOutlet-segment1-edit').val(),
                        client_pt_setting_segment2: $('#PengaturanPiutangOutlet-segment2-edit').val(),
                        client_pt_setting_segment3: $('#PengaturanPiutangOutlet-segment3-edit').val(),
                        client_pt_setting_category: $('#PengaturanPiutangOutlet-category-edit').val(),
                        client_pt_setting_brand: $('#PengaturanPiutangOutlet-brand-edit').val(),
                        client_pt_setting_sku_id: $('#PengaturanPiutangOutlet-sku_id-edit').val(),
                        client_pt_setting_top: $('#PengaturanPiutangOutlet-top-edit').val(),
                        client_wms_id: $('#PengaturanPiutangOutlet-client_wms_id-edit').val(),
                        client_pt_setting_is_aktif: $('[id="PengaturanPiutangOutlet-is_aktif-edit"]:checked').length,
                        updwho: $('#PengaturanPiutangOutlet-updwho-edit').val(),
                        updtgl: $('#PengaturanPiutangOutlet-updtgl-edit').val(),
                        detail: arr_pengaturan_khusus
                    },
                    dataType: "JSON",
                    success: function(response) {

                        if (response == 1) {

                            var alert = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                            // var alert = "Data Berhasil Disimpan";
                            message_custom("Success", "success", alert);
                            setTimeout(() => {
                                Get_pengaturan_piutang_outlet()
                            }, 500);

                            ResetForm();
                        } else {
                            var alert = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISIMPAN');
                            // var alert = "Data Gagal Disimpan";
                            message_custom("Error", "error", alert);
                        }

                        $("#btn_update_pengaturan_piutang_outlet").prop("disabled", false);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        message("Error", "Error 500 Internal Server Connection Failure", "error");

                        $("#btn_update_pengaturan_piutang_outlet").prop("disabled", false);
                    },
                    complete: function() {
                        // Swal.close();
                        $("#btn_update_pengaturan_piutang_outlet").prop("disabled", false);
                        $("#modal_edit_client_pt_setting_piutang").modal('hide');
                    }
                });
            }
        });
    });

    function Delete_client_pt_setting_piutang(client_pt_setting_piutang_id) {
        Swal.fire({
            title: "Apakah anda yakin mengapus data?",
            text: "Pastikan data yang sudah anda hapus benar!",
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
                    url: "<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/delete_client_pt_setting_piutang'); ?>",
                    type: "POST",
                    beforeSend: function() {

                        Swal.fire({
                            title: 'Loading ...',
                            html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                            timerProgressBar: false,
                            showConfirmButton: false
                        });
                    },
                    data: {
                        client_pt_setting_piutang_id: client_pt_setting_piutang_id
                    },
                    dataType: "JSON",
                    success: function(response) {

                        if (response == 1) {

                            var alert = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDIHAPUS');
                            // var alert = "Data Berhasil Disimpan";
                            message_custom("Success", "success", alert);
                            setTimeout(() => {
                                Get_pengaturan_piutang_outlet()
                            }, 500);

                            ResetForm();
                        } else {
                            var alert = GetLanguageByKode('CAPTION-ALERT-DATAGAGALDISHAPUS');
                            // var alert = "Data Gagal Disimpan";
                            message_custom("Error", "error", alert);
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
    }

    function Delete_list_client_pt_setting_piutang_khusus(tipe, index) {
        var arr_pengaturan_khusus_temp = [];

        arr_pengaturan_khusus[index] = "";
        arr_pengaturan_khusus_temp = arr_pengaturan_khusus;

        arr_pengaturan_khusus = [];

        $.each(arr_pengaturan_khusus_temp, function(i, v) {
            if (v != "") {
                arr_pengaturan_khusus.push(v);
            }
        });

        // console.log(arr_pengaturan_khusus);

        Get_pengaturan_piutang_outlet_khusus(tipe);
    }

    function GetBrandBySKUInduk(sku_id, tipe) {
        if (tipe == "tambah") {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/Get_brand_by_sku') ?>",
                data: {
                    sku_id: sku_id
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
                    $('#PengaturanPiutangOutlet-brand').html('');
                    if (response.length != 0) {
                        $.each(response, function(i, v) {
                            $("#PengaturanPiutangOutlet-brand").append(`<option value="${v.principle_brand_id}">${v.principle_brand_nama}</option>`);

                            $('#PengaturanPiutangOutlet-brand').select2({
                                ajax: {
                                    url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_brand') ?>', // URL to your CodeIgniter controller method
                                    dataType: 'json',
                                    delay: 250,
                                    data: function(params) {
                                        return {
                                            q: params.term
                                        };
                                    },
                                    processResults: function(data, params) {
                                        return {
                                            results: data
                                        };
                                    },
                                    cache: true
                                },
                                placeholder: GetLanguageByKode('CAPTION-PILIH'),
                                // minimumInputLength: 3
                            });
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    message("Error", "Error 500 Internal Server Connection Failure", "error");
                },
                complete: function() {
                    Swal.close();
                }
            });
        } else if (tipe == "edit") {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/Get_brand_by_sku') ?>",
                data: {
                    sku_id: sku_id
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
                    $('#PengaturanPiutangOutlet-brand-edit').html('');
                    if (response.length != 0) {
                        $.each(response, function(i, v) {
                            $("#PengaturanPiutangOutlet-brand-edit").append(`<option value="${v.principle_brand_id}">${v.principle_brand_nama}</option>`);

                            $('#PengaturanPiutangOutlet-brand-edit').select2({
                                ajax: {
                                    url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_brand') ?>', // URL to your CodeIgniter controller method
                                    dataType: 'json',
                                    delay: 250,
                                    data: function(params) {
                                        return {
                                            q: params.term
                                        };
                                    },
                                    processResults: function(data, params) {
                                        return {
                                            results: data
                                        };
                                    },
                                    cache: true
                                },
                                placeholder: GetLanguageByKode('CAPTION-PILIH'),
                                // minimumInputLength: 3
                            });
                        });
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

    }

    function ResetForm() {
        $("#table_pengaturan_piutang_outlet_khusus_tambah > tbody").html('');
        $("#table_pengaturan_piutang_outlet_khusus_tambah > tbody").empty();

        $('#PengaturanPiutangOutlet-segment1').html('');
        $('#PengaturanPiutangOutlet-segment2').html('');
        $('#PengaturanPiutangOutlet-segment3').html('');
        $('#PengaturanPiutangOutlet-brand').html('');
        $('#PengaturanPiutangOutlet-sku_id').html('');
        $('#PengaturanPiutangOutlet-top').val(0);

        $("#PengaturanPiutangOutlet-client_wms_id option[value='']").prop("selected", true);
        $('#PengaturanPiutangOutlet-client_wms_id').val('').trigger('change');

        $("#PengaturanPiutangOutlet-category option[value='']").prop("selected", true);
        $('#PengaturanPiutangOutlet-category').val('').trigger('change');

        $('#PengaturanPiutangOutlet-segment1').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_segment1') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });

        $('#PengaturanPiutangOutlet-segment2').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_segment2') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });

        $('#PengaturanPiutangOutlet-segment3').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_segment3') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });

        $('#PengaturanPiutangOutlet-brand').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_brand') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });

        $('#PengaturanPiutangOutlet-sku_id').select2({
            ajax: {
                url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_sku') ?>', // URL to your CodeIgniter controller method
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: GetLanguageByKode('CAPTION-PILIH'),
            // minimumInputLength: 3
        });
    }

    function ResetCategory(tipe) {
        if (tipe == "tambah") {
            $("#PengaturanPiutangOutlet-brand").html('');
            $("#PengaturanPiutangOutlet-sku_id").html('');

            $('#PengaturanPiutangOutlet-brand').select2({
                ajax: {
                    url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_brand') ?>', // URL to your CodeIgniter controller method
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data, params) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: GetLanguageByKode('CAPTION-PILIH'),
                // minimumInputLength: 3
            });

            $('#PengaturanPiutangOutlet-sku_id').select2({
                ajax: {
                    url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_sku') ?>', // URL to your CodeIgniter controller method
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data, params) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: GetLanguageByKode('CAPTION-PILIH'),
                // minimumInputLength: 3
            });

        } else if (tipe == "edit") {
            $("#PengaturanPiutangOutlet-brand-edit").html('');
            $("#PengaturanPiutangOutlet-sku_id-edit").html('');

            $('#PengaturanPiutangOutlet-brand-edit').select2({
                ajax: {
                    url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_brand') ?>', // URL to your CodeIgniter controller method
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data, params) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: GetLanguageByKode('CAPTION-PILIH'),
                // minimumInputLength: 3
            });

            $('#PengaturanPiutangOutlet-sku_id-edit').select2({
                ajax: {
                    url: '<?= base_url('FAS/ManagementPelanggan/PengaturanPiutangOutlet/get_sku') ?>', // URL to your CodeIgniter controller method
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data, params) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: GetLanguageByKode('CAPTION-PILIH'),
                // minimumInputLength: 3
            });

        }

    }
</script>