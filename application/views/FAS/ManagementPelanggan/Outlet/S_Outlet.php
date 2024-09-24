<script type="text/javascript">
    var OutletCode = '';
    var modeCb = "0";
    var arr_list_masar = [];
    var arr_list_masap = [];

    function url_like(url) {
        return '<?= base_url() ?>' + url;
    }

    $(document).ready(
        function() {
            $('#showHead').show('slow');
            getOutletCorporate();
            // SetDataAwal();
            url_like();

            $('.numeric').on('input', function(event) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            $(".select2").select2({
                width: "100%"
            });

            $(".numeric-coma").keypress(function(e) {
                if (/\d+|,+|[/b]+|-+/i.test(e.key)) {
                    // alert(+ e.key)
                } else {
                    // alert(+ e.key)
                    return false;
                }
            });

            CheckMultiLocation();

            CheckMultiLocationUpdate();
        }
    );

    $('#select-sync-all-masar').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="CheckboxMasar"]:checkbox').each(function() {
                this.checked = true;
                var data_masar_idx = this.getAttribute('data-masar-idx');
                var data_masar_client_pt_id = this.getAttribute('data-masar-client_pt_id');
                var data_masar_client_pt_nama = this.getAttribute('data-masar-client_pt_nama');

                arr_list_masar.push({
                    'idx': data_masar_idx,
                    'client_pt_id': data_masar_client_pt_id,
                    'client_pt_nama': data_masar_client_pt_nama
                });
                // console.log(this.getAttribute('data-masap'));
            });
        } else {
            $('[name="CheckboxMasar"]:checkbox').each(function() {
                this.checked = false;
                arr_list_masar = [];
            });
        }
    });

    $('#select-sync-all-masap').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="CheckboxMasap"]:checkbox').each(function() {
                this.checked = true;
                var data_masap_idx = this.getAttribute('data-masap-idx');
                var data_masap_client_pt_id = this.getAttribute('data-masap-client_pt_id');
                var data_masap_client_pt_nama = this.getAttribute('data-masap-client_pt_nama');

                arr_list_masap.push({
                    'idx': data_masap_idx,
                    'client_pt_id': data_masap_client_pt_id,
                    'client_pt_nama': data_masap_client_pt_nama

                });
                // console.log(this.getAttribute('data-masap'));
            });
        } else {
            $('[name="CheckboxMasap"]:checkbox').each(function() {
                this.checked = false;
                arr_list_masap = [];
            });
        }
    });

    function getOutletCorporate() {
        $.ajax({
            type: 'GET',
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/getOutletCorporate') ?>",
            dataType: "json",
            success: function(response) {
                if (response.length > 0) {
                    // alert hide
                    if ($.fn.DataTable.isDataTable('#tableoutletmenuhead')) {
                        $('#tableoutletmenuhead').DataTable().destroy();
                    }

                    $('#tableoutletmenuhead tbody').empty();

                    let no = 1;
                    for (i = 0; i < response.length; i++) {
                        var client_pt_id = response[i].client_pt_corporate_id;
                        var client_pt_nama = response[i].client_pt_corporate_nama;
                        var client_pt_alamat = response[i].client_pt_corporate_alamat;
                        var client_pt_telepon = response[i].client_pt_corporate_telepon;
                        var client_pt_nama_contact_person = response[i].client_pt_corporate_nama_contact_person;
                        var client_pt_email_contact_person = response[i]
                            .client_pt_corporate_email_contact_person;
                        var client_pt_telepon_contact_person = response[i]
                            .client_pt_corporate_telepon_contact_person;

                        var isAktif = response[i].client_pt_corporate_is_aktif;

                        if (isAktif == 0) {
                            Status_PT = 'Non Aktif';
                        } else {
                            Status_PT = 'Aktif';
                        }

                        var strmenu = '';

                        var strU = '';
                        var strD = '';

                        strU = '<a href="' + url_like("FAS/ManagementPelanggan/Outlet/EditData/" +
                                client_pt_id + "?type=head") +
                            '" style="width: 40px;" class="btn btn-warning btneditoutletmenu form-control" data-id="' +
                            client_pt_id + '"><i class="fa fa-pencil"></i></a>';
                        strD =
                            '<button style="width: 40px;" class="btn btn-danger btndeleteoutletmenu form-control" onclick="DeleteOutletMenu(\'' +
                            client_pt_id + '\')"><i class="fa fa-times"></i></button>';

                        strmenu = strmenu + '<tr>';
                        strmenu = strmenu + '	<td>' + no++ + '</td>';
                        strmenu = strmenu + '	<td>' + client_pt_nama + '</td>';
                        strmenu = strmenu + '	<td>' + client_pt_alamat + '</td>';
                        strmenu = strmenu + '	<td>' + client_pt_telepon + '</td>';
                        strmenu = strmenu + '	<td>' + client_pt_nama_contact_person + '</td>';
                        strmenu = strmenu + '	<td>' + client_pt_telepon_contact_person + '</td>';
                        strmenu = strmenu + '	<td>' + Status_PT + '</td>';
                        strmenu = strmenu + '	<td><span>';
                        strmenu = strmenu + strU;
                        strmenu = strmenu + strD;
                        strmenu = strmenu + '	</span></td>';
                        strmenu = strmenu + '</tr>';

                        $("#tableoutletmenuhead > tbody").append(strmenu);
                    }
                }

                $('#tableoutletmenuhead').DataTable();
            }
        });
    }

    const chkCompareOrApproval = (event) => {

        if (event.currentTarget.value == "0") {
            $("#showHead").show('slow')
            $("#showCabang").hide('slow')
            $("#showInternal").hide('slow')
        } else if (event.currentTarget.value == "1") {
            $("#showHead").hide('slow');
            $("#showInternal").hide('slow');
            $("#showCabang").show('slow');
            GetOutletMenu();
            //Alert memuat data
            Swal.fire({
                title: 'Memuat data!',
                text: 'Mohon tunggu sebentar...',
                icon: 'warning',
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false
            }).then(
                function() {},
                // handling the promise rejection
                function(dismiss) {
                    if (dismiss === 'timer') {
                        //console.log('your message')
                    }
                }
            )

            //Alert sukses memuat data
            setTimeout(function() {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Berhasil memuat data.',
                    icon: 'success',
                    timer: 3000,
                    showCancelButton: false,
                    showConfirmButton: true
                }).then(
                    function() {},
                    // handling the promise rejection
                    function(dismiss) {
                        if (dismiss === 'timer') {
                            //console.log('your message')
                        }
                    }
                )
            }, 1000);
        } else {
            $("#showHead").hide('slow');
            $("#showInternal").show('slow');
            $("#showCabang").hide('slow');
            GetOutletInternal();
            //Alert memuat data
            Swal.fire({
                title: 'Memuat data!',
                text: 'Mohon tunggu sebentar...',
                icon: 'warning',
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false
            }).then(
                function() {},
                // handling the promise rejection
                function(dismiss) {
                    if (dismiss === 'timer') {
                        //console.log('your message')
                    }
                }
            )

            //Alert sukses memuat data
            setTimeout(function() {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Berhasil memuat data.',
                    icon: 'success',
                    timer: 3000,
                    showCancelButton: false,
                    showConfirmButton: true
                }).then(
                    function() {},
                    // handling the promise rejection
                    function(dismiss) {
                        if (dismiss === 'timer') {
                            //console.log('your message')
                        }
                    }
                )
            }, 1000);
        }
    }

    const handlerViewModeClient = (event) => {
        if (event.currentTarget.value == "office") {
            modeCb = 0;
            $(".txtoffice-coorporate").hide("slow");
            $("#txtaddress-coorporate").val('');
            $("#txtphone-coorporate").val('');
            $("#listarea-header").val('').trigger('change');
            $("#listcontactperson-segment1").val('').trigger('change');
            $("#listcontactperson-segment2").val('').trigger('change');
            $("#listcontactperson-segment3").val('').trigger('change');
            $("tbody tr").each(function() {
                // Mengubah nilai elemen jam-buka dan jam-tutup
                $(this).find("#jam-buka").val('').trigger("change");
                $(this).find("#jam-tutup").val('').trigger("change");

                // Mengaktifkan checkbox pengiriman dan penagihan
                $(this).find("#chk_pengiriman").prop("checked", false).trigger("change");
                $(this).find("#chk_penagihan").prop("checked", false).trigger("change");
            });
        } else if (event.currentTarget.value == "cabang") {
            modeCb = 1;
            $(".txtoffice-coorporate").show("slow");
            $("#txtaddress-coorporate").val('');
            $("#txtphone-coorporate").val('');
            $("#listarea-header").val('').trigger('change');
            $("#listcontactperson-segment1").val('').trigger('change');
            $("#listcontactperson-segment2").val('').trigger('change');
            $("#listcontactperson-segment3").val('').trigger('change');
            $("tbody tr").each(function() {
                // Mengubah nilai elemen jam-buka dan jam-tutup
                $(this).find("#jam-buka").val('').trigger("change");
                $(this).find("#jam-tutup").val('').trigger("change");

                // Mengaktifkan checkbox pengiriman dan penagihan
                $(this).find("#chk_pengiriman").prop("checked", false).trigger("change");
                $(this).find("#chk_penagihan").prop("checked", false).trigger("change");
            });
        } else {
            modeCb = 2;
            $(".txtoffice-coorporate").hide("slow");
            $("#listcontactperson-segment1").val('CE06C67C-D9A3-44DB-B07C-9759B558B1AD').trigger(
                'change');
            $.ajax({
                type: "POST",
                url: '<?= base_url('FAS/MAnagementPelanggan/Outlet/getInternal') ?>',
                dataType: "JSON",
                success: function(response) {
                    $("#txtaddress-coorporate").val(response.depo_alamat);
                    $("#txtphone-coorporate").val(response.depo_no_telp);
                    $("#listarea-header").val(response.area_header_id).trigger('change');

                }
            })
            $("tbody tr").each(function() {
                // Mengubah nilai elemen jam-buka dan jam-tutup
                $(this).find("#jam-buka").val("07:00").trigger("change");
                $(this).find("#jam-tutup").val("17:00").trigger("change");

                // Mengaktifkan checkbox pengiriman dan penagihan
                $(this).find("#chk_pengiriman").prop("checked", true).trigger("change");
                $(this).find("#chk_penagihan").prop("checked", true).trigger("change");
            });
        }
        $(".txtoffice-coorporate").val("");
    }

    function GetOutletMenu() {
        // alert show

        $("#select-sync-all-masar").prop("checked", false);
        $("#select-sync-all-masap").prop("checked", false);

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/GetOutletMenu') ?>",
            // data: "OutletId=" + id,
            success: function(response) {
                if (response) {
                    ChOutletMenu(response);
                }
            }
        });
    }

    function GetOutletInternal() {
        // alert show
        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/GetOutletInternal') ?>",
            // data: "OutletId=" + id,
            success: function(response) {
                if (response) {
                    ChOutletInternal(response);
                }
            }
        });
    }

    function ChOutletInternal(JSONOutlet) {
        var Outlet = JSON.parse(JSONOutlet);

        var StatusC = Outlet.AuthorityMenu[0].StatusC;
        var StatusU = Outlet.AuthorityMenu[0].StatusU;
        var StatusD = Outlet.AuthorityMenu[0].StatusD;


        if (StatusC == 0) {
            $("#btnaddnewoutlet").attr('style', 'display: none;');
        }

        $("#cboutletjenis").html('');
        $("#cbupdateoutletjenis").html('');

        //check multi lokasi
        CheckMultiLocation();

        CheckMultiLocationUpdate();

        if ($.fn.DataTable.isDataTable('#tableoutletinternal')) {
            $('#tableoutletinternal').DataTable().destroy();
        }

        $('#tableoutletinternal').DataTable({
            'serverSide': true,
            'ajax': {
                'url': '<?= base_url('FAS/ManagementPelanggan/Outlet/Get_OutletInternal') ?>',
                'type': 'POST',
                'dataType': "JSON"
            },
            'columns': [{
                data: null,
                // untuk menghitung nomor urut berdasarkan halaman saat ini dan indeks baris dalam halaman tersebut
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false
            }, {
                data: 'client_pt_nama'
            }, {
                data: 'client_pt_alamat'
            }, {
                data: 'client_pt_telepon'
            }, {
                data: 'client_pt_nama_contact_person'
            }, {
                data: 'client_pt_telepon_contact_person'
            }, {
                data: 'client_pt_segmen_nama'
            }, {
                data: 'Status_PT'
            }, {
                render: function(data, type, row) {
                    var strU = '';
                    var strD = '';

                    <?php if ($Menu_Access["U"] == 1) { ?>
                        strU = '<a href="' + url_like("FAS/ManagementPelanggan/Outlet/EditData/" +
                                row.client_pt_id + "?type=cabang") +
                            '" style="width: 40px;" class="btn btn-warning btneditoutletmenu form-control" data-id="' +
                            row.client_pt_id + '"><i class="fa fa-pencil"></i></a>';
                    <?php }
                    if ($Menu_Access["D"] == 1) { ?>
                        strD =
                            '<button style="width: 40px;" class="btn btn-danger btndeleteoutletmenu form-control" onclick="DeleteOutletMenu(\'' +
                            row.client_pt_id + '\')"><i class="fa fa-times"></i></button>';
                    <?php }  ?>

                    var button = '';
                    button += strU;
                    button += strD;
                    return button;
                },
                orderable: false
            }]
        });
    }

    function ChOutletMenu(JSONOutlet) {

        var Outlet = JSON.parse(JSONOutlet);
        var StatusC = Outlet.AuthorityMenu[0].StatusC;
        var StatusU = Outlet.AuthorityMenu[0].StatusU;
        var StatusD = Outlet.AuthorityMenu[0].StatusD;

        if (StatusC == 0) {
            $("#btnaddnewoutlet").attr('style', 'display: none;');
        }

        $("#cboutletjenis").html('');
        $("#cbupdateoutletjenis").html('');

        //check multi lokasi
        CheckMultiLocation();
        CheckMultiLocationUpdate();

        if ($.fn.DataTable.isDataTable('#tableoutletmenu')) {
            $('#tableoutletmenu').DataTable().destroy();
        }

        var table_data_cabang = $('#tableoutletmenu').DataTable({
            // 'serverSide': true,
            // 'ajax': {
            //     'url': '<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Outlet') ?>',
            //     'type': 'POST',
            //     'dataType': "JSON"
            // },
            // 'columns': [
            //     {
            //         data: null,
            //         // untuk menghitung nomor urut berdasarkan halaman saat ini dan indeks baris dalam halaman tersebut
            //         render: function(data, type, row, meta) {
            //             return meta.row + meta.settings._iDisplayStart + 1;
            //         },
            //         orderable: false
            //     }, 
            //     { data: 'client_pt_nama' }, 
            //     { data: 'client_pt_alamat' }, 
            //     { data: 'client_pt_telepon' }, 
            //     { data: 'client_pt_nama_contact_person' }, 
            //     { data: 'client_pt_telepon_contact_person' }, 
            //     { data: 'client_pt_segmen_nama' }, 
            //     { data: 'Status_PT' }, 
            //     {
            //         render: function(data, type, row) {
            //             var strU = '';
            //             var strD = '';

            //             var button = '';
            //             button += strU;
            //             button += strD;
            //             return button;
            //         },
            //         orderable: false
            //     }
            // ]


            "responsive": true,
            "order": [
                [1, "asc"]
            ],
            "searchDelay": 1000,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?= base_url() ?>FAS/ManagementPelanggan/Outlet/Get_Outlet',
                "type": "POST",
                "data": function(data) {
                    data.page_addt = "nothing";
                },
            },
            "columns": [{
                    data: null,
                    // untuk menghitung nomor urut berdasarkan halaman saat ini dan indeks baris dalam halaman tersebut
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
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
                    data: 'client_pt_nama_contact_person'
                },
                {
                    data: 'client_pt_telepon_contact_person'
                },
                {
                    data: 'client_pt_segmen_nama'
                },
                {
                    data: 'Status_PT'
                },
                // {
                //     render: function(data, type, row, meta) {

                //         if (row.is_masar > 0) {
                //             return '<input type="checkbox" id="chk-' + meta.row + '-masar-checked" name="CheckboxMasarChecked" data-masar-idx="' + meta.row + '" data-masar-client_pt_id="' + row.client_pt_id.trim() + '" data-masar-client_pt_nama="' + row.client_pt_nama.trim() + '" value="' + row.client_pt_id + '" disabled checked> <button type="button" id="btn_modal_masar" class="btn btn-primary btn-sm" OnClick="ViewModalMasar(\'' + row.client_pt_id + '\')"><i class="fa fa-search"></i></button>';
                //         } else {
                //             return '<input type="checkbox" id="chk-' + meta.row + '-masar" name="CheckboxMasar" data-masar-idx="' + meta.row + '" data-masar-client_pt_id="' + row.client_pt_id.trim() + '" data-masar-client_pt_nama="' + row.client_pt_nama.trim() + '" value="' + row.client_pt_id + '" OnClick="PushArrayMasar(\'' + meta.row + '\',\'' + row.client_pt_id + '\',\'' + row.client_pt_nama + '\')">';
                //         }
                //     },
                //     orderable: false
                // },
                // {
                //     render: function(data, type, row, meta) {

                //         if (row.is_masap > 0) {
                //             return '<input type="checkbox" id="chk-' + row.idx + '-masap-checked" name="CheckboxMasapChecked" value="' + row.client_pt_id + '" data-masap-idx="' + meta.row + '" data-masap-client_pt_id="' + row.client_pt_id.trim() + '" data-masap-client_pt_nama="' + row.client_pt_nama.trim() + '" disabled checked> <button type="button" id="btn_modal_masap" class="btn btn-primary btn-sm" OnClick="ViewModalMasap(\'' + row.client_pt_id + '\')"><i class="fa fa-search"></i></button>';
                //         } else {
                //             return '<input type="checkbox" id="chk-' + row.idx + '-masap" name="CheckboxMasap" value="' + row.client_pt_id + '" data-masap-idx="' + meta.row + '" data-masap-client_pt_id="' + row.client_pt_id.trim() + '" data-masap-client_pt_nama="' + row.client_pt_nama.trim() + '" OnClick="PushArrayMasap(\'' + meta.row + '\',\'' + row.client_pt_id + '\',\'' + row.client_pt_nama + '\')">';;
                //         }

                //     },
                //     orderable: false
                // },
                {
                    render: function(data, type, row) {
                        var strU = '';
                        var strD = '';
                        button = '<span class="d-if">'
                        <?php if ($Menu_Access["U"] == 1) { ?>
                            strU = '<a href="' + url_like("FAS/ManagementPelanggan/Outlet/EditData/" +
                                    row.client_pt_id + "?type=cabang") +
                                '" style="width: 40px;" class="btn btn-warning btneditoutletmenu form-control" data-id="' +
                                row.client_pt_id + '"><i class="fa fa-pencil"></i></a>';
                        <?php }
                        if ($Menu_Access["D"] == 1) { ?>
                            strD =
                                '<button style="width: 40px;" class="btn btn-danger btndeleteoutletmenu form-control" onclick="DeleteOutletMenu(\'' +
                                row.client_pt_id + '\')"><i class="fa fa-times"></i></button>';
                        <?php }  ?>

                        button += strU;
                        button += strD;
                        button += '</span>'
                        return button;
                    },
                    orderable: false
                }
            ],
            "columnDefs": [{
                    targets: 0,
                    searchable: false,
                    orderable: false
                },
                {
                    targets: 1,
                },
                {
                    targets: 2,
                },
                {
                    targets: 3,
                },
                {
                    targets: 4,
                },
                {
                    targets: 5,
                },
                {
                    targets: 6,
                },
                {
                    targets: 7,
                },
                // {
                //     targets: 8,
                // },
                // {
                //     targets: 9,
                // },
                {
                    targets: 8,
                    class: '',
                    searchable: false,
                    orderable: false
                }
            ],
            initComplete: function() {
                parent_outlet_cabang = $('#tableoutletmenu').closest('.dataTables_wrapper')
                parent_outlet_cabang.find('.dataTables_filter').css('width', 'auto')
                var input = parent_outlet_cabang.find('.dataTables_filter input').unbind(),
                    self = this.api(),
                    $searchButton = $('<button class="btn btn-flat btn-success btn-sm mb-0 mr-0 ml-5">')
                    .html('<i class="fa fa-fw fa-search">')
                    .click(function() {
                        self.search(input.val()).draw();
                    }),
                    $clearButton = $('<button class="btn btn-flat btn-warning btn-sm mb-0 mr-0 ml-5">')
                    .html('<i class="fa fa-fw fa-recycle">')
                    .click(function() {
                        input.val('');
                        $searchButton.click();
                    })
                parent_outlet_cabang.find('.dataTables_filter').append($searchButton, $clearButton);
                parent_outlet_cabang.find('.dataTables_filter input').keypress(function(e) {
                    var key = e.which;
                    if (key == 13) {
                        $searchButton.click();
                        return false;
                    }
                });
            },
        });
    }

    $(document).on("change", "#listcoorporate-province", function() {
        let provinsi = $(this).val();
        AppendCity(provinsi);
    });

    $(document).on("change", "#listcoorporate-city", function() {
        let provinsi = $("#listcoorporate-province").val();
        let kota = $(this).val();
        AppendDistrict(provinsi, kota);
    });

    $(document).on("change", "#listcoorporate-districts", function() {
        let kecamatan = $(this).val();
        let nama_kecamatan = $('#listcoorporate-districts option').filter(':selected').text();
        let kota = $('#listcoorporate-city option').filter(':selected').val();
        $("#data-districts").val(nama_kecamatan);
        AppendWard(kecamatan);
        if (kota == "SURABAYA") {
            AppendAndGetDataMultiLokasi(kecamatan);
        }
        console.log(nama_kecamatan);
    });

    $(document).on("change", "#listcoorporate-ward", function() {
        let kelurahan = $(this).val();
        let nama_kelurahan = $('#listcoorporate-ward option').filter(':selected').text();
        $("#data-ward").val(nama_kelurahan);
        $("#txtpostalcode-coorporate").val(kelurahan);
    });

    $(document).on("change", "#listcontactperson-segment1", function() {
        let segment1 = $(this).val();
        // console.log(segment1);
        AppendSegment2(segment1);
    });

    $(document).on("change", "#listcontactperson-segment2", function() {
        let segment2 = $(this).val();
        // console.log(segment2);
        AppendSegment3(segment2);
    });

    // function AppendProvince(Outlet) {
    //     if (Outlet.Provinsi != null) {
    //         $("#listcoorporate-province").empty();
    //         let html = '';
    //         html += '<option value="">--Pilih Provinsi--</option>';
    //         $.each(Outlet.Provinsi, function(i, v) {
    //             html += '<option value="' + v.reffregion_nama + '">' + v.reffregion_nama + '</option>';
    //             $("#listcoorporate-province").html(html);
    //         });
    //     } else {
    //         $("#listcoorporate-province").append('<option value="">--Pilih Provinsi--</option>');
    //     }

    // }

    function AppendCity(provinsi) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kota') ?>",
            data: {
                id: provinsi
            },
            dataType: "JSON",
            success: function(response) {
                $("#listcoorporate-city").html(response);
            }
        });
    }


    function AppendDistrict(provinsi, kota) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kecamatan') ?>",
            data: {
                provinsi: provinsi,
                id: kota
            },
            dataType: "JSON",
            success: function(response) {
                $("#listcoorporate-districts").html(response);
            }
        });
    }


    function AppendWard(kecamatan) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kelurahan') ?>",
            data: {
                id: kecamatan
            },
            dataType: "JSON",
            success: function(response) {
                $("#listcoorporate-ward").html(response);
            }
        });

    }


    // function AppendStreetClass(Outlet) {
    //     if (Outlet.KelasJalan != null) {
    //         $("#listcoorporate-stretclass").empty();
    //         // $("#listcoorporate-stretclass-update").empty();
    //         let html = '';
    //         html += '<option value="">--Pilih Kelas jalan--</option>';
    //         $.each(Outlet.KelasJalan, function(i, v) {
    //             html += '<option value="' + v.id + '">' + v.nama + '</option>';
    //             $("#listcoorporate-stretclass").html(html);
    //         });
    //     } else {
    //         $("#listcoorporate-stretclass").html('<option value="">--Pilih Kelas Jalan--</option>');
    //     }
    // }

    // function AppendStreetClass2(Outlet) {
    //     if (Outlet.KelasJalan2 != null) {
    //         $("#listcoorporate-stretclass2").empty();
    //         let html = '';
    //         html += '<option value="">--Pilih Kelas jalan--</option>';
    //         $.each(Outlet.KelasJalan2, function(i, v) {
    //             html += '<option value="' + v.id + '">' + v.nama + '</option>';
    //             $("#listcoorporate-stretclass2").html(html);
    //         });
    //         // $("#listcoorporate-stretclass2-update").trigger('change');
    //     } else {
    //         $("#listcoorporate-stretclass2").append('<option value="">--Pilih Kelas Jalan--</option>');
    //     }
    // }

    // function AppendWilayah(Outlet) {
    //     if (Outlet.Area != null) {
    //         $("#listarea-header").empty();
    //         let html = '';
    //         html += '<option value="">--Pilih Wilayah--</option>';
    //         $.each(Outlet.AreaHeader, function(i, v) {
    //             html += '<option value="' + v.id + '">' + v.nama + '</option>';
    //             $("#listarea-header").html(html);
    //         });
    //         // $("#listcoorporate-area-update").trigger('change');
    //     } else {
    //         $("#listarea-header").append('<option value="">--Pilih Wilayah--</option>');
    //     }
    // }

    $("#listarea-header").change(
        function() {
            var area_header_id = $("#listarea-header option:selected").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Area') ?>",

                data: {
                    id: area_header_id
                },
                dataType: "JSON",
                success: function(response) {
                    $("#listcoorporate-area").html(response);
                }
            });
        }
    );
    /*
    function AppendArea(Outlet) {
        if (Outlet.Area != null) {
            $("#listcoorporate-area").empty();
            let html = '';
            html += '<option value="">--Pilih Area--</option>';
            $.each(Outlet.Area, function(i, v) {
                html += '<option value="' + v.id + '">' + v.nama + '</option>';
                $("#listcoorporate-area").html(html);
            });
            // $("#listcoorporate-area-update").trigger('change');
        } else {
            $("#listcoorporate-area").append('<option value="">--Pilih Area--</option>');
        }
    }*/

    // function AppendSegment1(Outlet) {
    //     if (Outlet.Segment1 != null) {
    //         $("#listcontactperson-segment1").empty();
    //         let html = '';
    //         html += '<option value="">--Pilih Segmentasi 1--</option>';
    //         $.each(Outlet.Segment1, function(i, v) {
    //             html += '<option value="' + v.id + '">' + v.nama + '</option>';
    //             $("#listcontactperson-segment1").html(html);
    //         });
    //     } else {
    //         $("#listcontactperson-segment1").append('<option value="">--Pilih Segmentasi 1--</option>');
    //     }
    // }

    function AppendSegment2(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Segment2') ?>",
            data: {
                id: id
            },
            dataType: "json",
            async: "true",
            success: function(response) {
                $("#listcontactperson-segment2").html(response);
                if (modeCb == 2) {
                    $("#listcontactperson-segment2").val('C160266E-0BC7-4E0A-A820-5FD27635C235').trigger(
                        'change');
                }
            }

        });
    }


    function AppendSegment3(SegmentId2) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Segment3') ?>",
            data: {
                id: SegmentId2
            },
            dataType: "json",
            success: function(response) {
                $("#listcontactperson-segment3").html(response);
                if (modeCb == 2) {
                    $("#listcontactperson-segment3").val('96E77207-836B-40B1-ADA4-76E80F625B52').trigger(
                        'change');
                }
            }
        });
    }

    function CheckMultiLocation() {
        $("#multilocation").on("change", function() {
            if ($("#multilocation").prop('checked') == true) {
                $("#showlistmultilokasi").show("slow");
            } else {
                $("#showlistmultilokasi").hide("slow");
            }
        });
    }

    function CheckMultiLocationUpdate() {
        $("#multilocationupdate").on("change", function() {
            if ($("#multilocationupdate").prop('checked') == true) {
                $("#showlistmultilokasiupdate").show("slow");
            } else {
                $("#showlistmultilokasiupdate").hide("slow");
                $("#listcontactperson-location-update").val("")
            }
        });
    }

    function AppendAndGetDataMultiLokasi(kode_id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Multi_Lokasi') ?>",
            data: {
                kode_id: kode_id
            },
            dataType: "json",
            success: function(response) {
                $("#listcontactperson-location").html(response);
            }
        });
    }

    // function AppendTimeOperasional(Day) {
    //     $('#list-day-operasional tbody').empty();

    //     $.each(Day, function(i, v) {
    //         var html = '';

    //         var Jam_Buka = '<input type="time" class="from-control" id="jam-buka" name="jam-buka"/>';
    //         var Jam_Tutup = '<input type="time" class="from-control" id="jam-tutup" name="jam-tutup"/>';
    //         var status = `<select class="form-control" id="status-operasional" name="status-operasional">
    //                         <option value="1" selected>BUKA</option>
    //                         <option value="0">TUTUP</option>
    //                     </select>`;

    //         html = html + '<tr>';
    //         html = html + '	<td>' + i + ' <input type="hidden" id="no-urut-hari" name="no-urut-hari" value="' + i + '"/></td>';
    //         html = html + '	<td>' + v + ' <input type="hidden" id="nama-hari" name="nama-hari" value="' + v + '"/></td>';
    //         html = html + '	<td>' + Jam_Buka + '</td>';
    //         html = html + '	<td>' + Jam_Tutup + '</td>';
    //         html = html + '	<td>' + status + '</td>';
    //         html = html + '	<td style="vertical-align:middle; text-align: center;" ><input type="checkbox" id="chk_pengiriman" name="chk_pengiriman"/></td>';
    //         html = html + '	<td style="vertical-align:middle; text-align: center;"><input type="checkbox" id="chk_penagihan" name="chk_penagihan"/></td>';
    //         html = html + '</tr>';

    //         $("#list-day-operasional > tbody").append(html);
    //     });
    // }

    $("#btnback").click(
        function() {
            ResetForm();
            getOutletCorporate()
        }
    );

    <?php
    if ($Menu_Access["D"] == 1) {
    ?> $("#btndeleteoutletmenu").click(
            function() {
                getOutletCorporate()
            }
        );

        // Delete Channel
        function DeleteOutletMenu(OutletID) {
            // $("#lbdeleteoutletname").html(ChannelName);
            $("#hddeleteoutletid").val(OutletID);

            $("#previewdeleteoutlet").modal('show');
        }

        $("#btnyesdeleteoutlet").click(
            function() {
                var OutletID = $("#hddeleteoutletid").val();

                $("#loadingdelete").show();
                $("#btnyesdeleteoutlet").prop("disabled", true);

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/ManagementPelanggan/Outlet/DeleteOutletMenu') ?>",
                    data: {
                        OutletID: OutletID
                    },
                    success: function(response) {
                        $("#loadingdelete").hide();
                        $("#btnyesdeleteoutlet").prop("disabled", false);

                        if (response == 1) {
                            Swal.fire(
                                'Success!',
                                'Data Pelanggan berhasil dihapus.',
                                'success'
                            )
                        } else {
                            var ErrMsg = response.split('$$$');
                            ErrMsg = ErrMsg[1];


                            var msg = ErrMsg;
                            var msgtype = 'error';

                            Swal.fire(
                                'Error!',
                                msg,
                                'error'
                            )
                        }

                        $("#previewdeleteoutlet").modal('hide');
                        getOutletCorporate()

                    },
                    error: function(xhr, ajaxOptions, thrownError) {

                        $("#loadingdelete").hide();
                        $("#btnyesdeleteoutlet").prop("disabled", false);
                    }
                });
            }
        );
    <?php
    }
    ?>

    $("#btnaddnewoutlet").click(
        function() {
            ResetForm();
            $("#previewaddnewoutlet").modal('show');
        }
    );

    $("#btnsaveaddnewoutlet").click(
        function() {
            let name_corporate = $("#txtname-coorporate");
            let address_corporate = $("#txtaddress-coorporate");
            let phone_corporate = $("#txtphone-coorporate");
            // let corporate_group = $("#listcoorporate-group");
            let lattitude_corporate = $("#txtlattitude-coorporate");
            let longitude_corporate = $("#txtlongitude-coorporate");
            let stretclass_corporate = $("#listcoorporate-stretclass");
            let stretclass2_corporate = $("#listcoorporate-stretclass2");
            let area_corporate = $("#listcoorporate-area");
            let province = $("#listcoorporate-province");
            let city = $("#listcoorporate-city");
            // let districts = $("#listcoorporate-districts");
            let districts = $("#data-districts");
            // let ward = $("#listcoorporate-ward");
            let ward = $("#data-ward");
            let kodepos_corporate = $("#txtpostalcode-coorporate");

            let name_contact_person = $("#txtname-contact-person");
            let phone_contact_person = $("#txtphone-contact-person");
            let kreditlimit_contact_person = $("#txtkreditlimit-contact-person");
            let segment1_contact_person = $("#listcontactperson-segment1").val();
            let segment2_contact_person = $("#listcontactperson-segment2").val();
            let segment3_contact_person = $("#listcontactperson-segment3").val();
            let listcontactperson_location = $("#listcontactperson-location");

            var client_pt_fax = $("#listcontactperson-client_pt_fax").val();
            var client_pt_npwp = $("#listcontactperson-client_pt_npwp").val();
            var client_pt_status_pkp = $("#listcontactperson-client_pt_status_pkp-selected").val();

            let isValidMultiLocation = '';
            if ($("#multilocation").is(':checked')) {
                isValidMultiLocation = 1;
            } else {
                isValidMultiLocation = 0;
            }

            let status = '';
            if ($("#txtstatus-coorporate").is(':checked')) {
                status = 1;
            } else {
                status = 0;
            }

            let modesave = '';
            if ($("#rbcabang").prop('checked') == true) {
                modesave = 'CB';
            } else if ($("#rbheadoffice").prop('checked') == true) {
                modesave = 'HO';
            }

            let no_urut_hari = [];
            let nama_hari = [];
            let jam_buka = [];
            let jam_tutup = [];
            let status_operasional = [];
            let chk_penagihan = [];
            let chk_pengiriman = [];

            if (modeCb == "1") {
                if ($('#txtoffice-coorporate').val() == "") {
                    alert('pilih head office terlebih dahulu');
                    return false;
                }
            }

            $("input[name='no-urut-hari']").each(function(i, v) {
                no_urut_hari.push($(this).val());
            });

            $("input[name='nama-hari']").each(function(i, v) {
                nama_hari.push($(this).val());
            });

            $("input[name='jam-buka']").each(function(i, v) {
                jam_buka.push($(this).val());
            });

            $("input[name='jam-tutup']").each(function(i, v) {
                jam_tutup.push($(this).val());
            });

            $("select[name='status-operasional']").each(function(i, v) {
                status_operasional.push($(this).val());
            });

            $("input[name='chk_pengiriman']").each(function(i, v) {
                if ($(this).is(':checked')) {
                    chk_pengiriman.push(1);
                } else {
                    chk_pengiriman.push(0);
                }
            });

            $("input[name='chk_penagihan']").each(function(i, v) {
                if ($(this).is(':checked')) {
                    chk_penagihan.push(1);
                } else {
                    chk_penagihan.push(0);
                }
            });

            let final_arr = [];
            for (let i = 0; i < no_urut_hari.length; i++) {
                final_arr.push({
                    no_urut: no_urut_hari[i],
                    hari: nama_hari[i],
                    buka: jam_buka[i],
                    tutup: jam_tutup[i],
                    status: status_operasional[i],
                    penagihan: chk_penagihan[i],
                    pengiriman: chk_pengiriman[i]
                });
            }

            if (modeCb != "2") {
                validasi(name_corporate, address_corporate, phone_corporate, lattitude_corporate, longitude_corporate,
                    stretclass_corporate, stretclass2_corporate, area_corporate, province, city, districts, ward,
                    kodepos_corporate, name_contact_person, phone_contact_person, kreditlimit_contact_person,
                    isValidMultiLocation, listcontactperson_location);
            }

            $("#loadingadd").show();
            $("#btnsaveaddnewoutlet").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/ManagementPelanggan/Outlet/SaveAddNewOutlet') ?>",
                dataType: "json",
                async: "true",
                data: {
                    modesave: modesave,
                    headOffice: modeCb == "0" ? "" : $('#txtoffice-coorporate').val(),
                    name_corporate: name_corporate.val(),
                    address_corporate: address_corporate.val(),
                    phone_corporate: phone_corporate.val(),
                    // corporate_group: corporate_group.val(),
                    lattitude_corporate: lattitude_corporate.val(),
                    longitude_corporate: longitude_corporate.val(),
                    stretclass_corporate: stretclass_corporate.val(),
                    stretclass2_corporate: stretclass2_corporate.val(),
                    area_corporate: area_corporate.val(),
                    province: province.val(),
                    city: city.val(),
                    districts: districts.val(),
                    ward: ward.val(),
                    kodepos_corporate: kodepos_corporate.val(),
                    name_contact_person: name_contact_person.val(),
                    phone_contact_person: phone_contact_person.val(),
                    kreditlimit_contact_person: kreditlimit_contact_person.val(),
                    segment1_contact_person: segment1_contact_person,
                    segment2_contact_person: segment2_contact_person,
                    segment3_contact_person: segment3_contact_person,
                    isValidMultiLocation: isValidMultiLocation,
                    listcontactperson_location: listcontactperson_location.val(),
                    timeoperasional: final_arr,
                    status: status,
                    modeCb: modeCb,
                    client_pt_fax: client_pt_fax,
                    client_pt_npwp: client_pt_npwp,
                    client_pt_status_pkp: client_pt_status_pkp
                },

                success: function(response) {
                    $("#loadingadd").hide();
                    $("#btnsaveaddnewoutlet").prop("disabled", false);
                    if (response == 1) {
                        var msg = 'Data Pelanggan berhasil ditambah';
                        var msgtype = 'success';

                        Swal.fire(
                            'Success!',
                            msg,
                            msgtype
                        )

                        getOutletCorporate();
                        // SetDataAwal();

                        $("#previewaddnewoutlet").modal('hide');
                        ResetForm();
                    } else if (response == 0) {
                        var msg = 'Data Pelanggan gagal ditambah';
                        var msgtype = 'error';

                        Swal.fire(
                            'Error!',
                            msg,
                            msgtype
                        )
                    } else {
                        Swal.fire(
                            'Error!',
                            response,
                            msgtype
                        )
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#loadingadd").hide();
                    $("#btnsaveaddnewoutlet").prop("disabled", false);
                }
            });
        }
    );

    function ResetForm() {
        $("#txtname-coorporate").val('');
        $("#txtphone-coorporate").val('');
        $("#txtaddress-coorporate").val('');
        $("#txtphone-coorporate").val('');
        $("#listarea-header").val('').trigger('change');
        $("#txtoffice-coorporate").val('').trigger('change');
        $("#listcoorporate-province").val('').trigger('change');
        $("#listcoorporate-city").val('').trigger('change');
        $("#listcoorporate-districts").val('').trigger('change');
        $("#listcoorporate-ward").val('').trigger('change');
        $("#txtpostalcode-coorporate").val('');
        $("#listcoorporate-stretclass").val('').trigger('change');
        $("#listcoorporate-stretclass2").val('').trigger('change');
        $("#listarea-header").val('').trigger('change');
        $("#listcoorporate-area").val('').trigger('change');
        $("#txtlattitude-coorporate").val('');
        $("#txtlongitude-coorporate").val('');
        $("#txtname-contact-person").val('');
        $("#txtphone-contact-person").val('');
        $("#txtkreditlimit-contact-person").val('');
        $("#listcontactperson-segment1").val('').trigger('change');
        $("#listcontactperson-segment2").val('').trigger('change');
        $("#listcontactperson-segment3").val('').trigger('change');
        $("tbody tr").each(function() {
            // Mengubah nilai elemen jam-buka dan jam-tutup
            $(this).find("#jam-buka").val('').trigger("change");
            $(this).find("#jam-tutup").val('').trigger("change");

            // Mengaktifkan checkbox pengiriman dan penagihan
            $(this).find("#chk_pengiriman").prop("checked", false).trigger("change");
            $(this).find("#chk_penagihan").prop("checked", false).trigger("change");
        });
        <?php
        if ($Menu_Access["U"] == 1) {
        ?>
            $("#txtname-coorporate, #txtaddress-coorporate, #txtphone-coorporate, #txtlattitude-coorporate, #txtlongitude-coorporate, #txtpostalcode-coorporate, #data-districts, #data-ward, #txtname-contact-person, #txtphone-contact-person, #txtkreditlimit-contact-person")
                .each(function() {
                    $(this).val("");
                });

            $("#listcoorporate-stretclass, #listcoorporate-stretclass2, #listcoorporate-area, #listcoorporate-province, #listcoorporate-city, #listcoorporate-districts, #listcoorporate-ward, #listcontactperson-segment1, #listcontactperson-segment2, #listcontactperson-segment3")
                .each(function() {
                    $(this).prop('selectedIndex', 0);
                    // $(this).val("");
                });
        <?php
        }
        ?>

        <?php
        if ($Menu_Access["C"] == 1) {
        ?>
            $("#txtname-coorporate, #txtaddress-coorporate, #txtphone-coorporate, #txtlattitude-coorporate, #txtlongitude-coorporate, #txtpostalcode-coorporate, #data-districts, #data-ward, #txtname-contact-person, #txtphone-contact-person, #txtkreditlimit-contact-person")
                .each(function() {
                    $(this).val("");
                });

            $("#listcoorporate-stretclass, #listcoorporate-stretclass, #listcoorporate-area, #listcoorporate-province, #listcoorporate-city, #listcoorporate-districts, #listcoorporate-ward, #listcontactperson-segment1, #listcontactperson-segment2, #listcontactperson-segment3")
                .each(function() {
                    $(this).prop('selectedIndex', 0);
                });
        <?php
        }
        ?>

        $("#Masar-masar_id").val('');
        $("#Masar-kode").val('');
        $("#Masar-nama").val('');
        $("#Masar-alamat").val('');
        $("#Masar-telepon").val('');
        $("#Masar-fax").val('');
        $("#Masar-lokasi").val('');
        $("#Masar-jatuh_tempo").val('');
        $("#Masar-npwp").val('');
        $("#Masar-limit_piutang").val('');
        $("#Masar-contact_person").val('');
        $("#Masar-position").val('');
        $("#Masar-no_perk_piutang").html('');
        $("#Masar-no_perk_diskon").html('');
        $("#Masar-no_perk_penjualan").html('');
        $("#Masar-no_perk_ppn").html('');
        $("#Masar-no_perk_retur_jual").html('');
        $("#Masar-saldo_awal").val('');
        $("#Masar-pembayaran_kas").val('');
        $("#Masar-jumlah_debet").val('');
        $("#Masar-pembayaran_cek").val('');
        $("#Masar-jumlah_kredit").val('');
        $("#Masar-memo_debet").val('');
        $("#Masar-saldo_akhir").val('');
        $("#Masar-memo_kredit").val('');

    }

    function validasi(name_corporate, address_corporate, phone_corporate, lattitude_corporate, longitude_corporate,
        stretclass_corporate, stretclass2_corporate, area_corporate, province, city, districts, ward,
        kodepos_corporate,
        name_contact_person, phone_contact_person, kreditlimit_contact_person, isValidMultiLocation,
        listcontactperson_location) {

        name_corporate.prop("required", true);
        address_corporate.prop("required", true);
        phone_corporate.prop("required", true);
        // lattitude_corporate.prop("required", true);
        // longitude_corporate.prop("required", true);
        // stretclass_corporate.prop("required", true);
        // stretclass2_corporate.prop("required", true);
        area_corporate.prop("required", true);
        province.prop("required", true);
        city.prop("required", true);
        districts.prop("required", true);
        ward.prop("required", true);
        kodepos_corporate.prop("required", true);
        // name_contact_person.prop("required", true);
        // phone_contact_person.prop("required", true);
        kreditlimit_contact_person.prop("required", true);
        if (isValidMultiLocation == 1) {
            listcontactperson_location.prop("required", true);
        }

        if (name_corporate.val() == "") {
            $(".txtname-coorporate").addClass("has-error");
            $(".invalid-nama-corporate").html("Nama Outlet tidak boleh kosong");
            name_corporate.focus();
        } else {
            $(".txtname-coorporate").removeClass("has-error");
            $(".invalid-nama-corporate").html("");
        }

        if (address_corporate.val() == "") {
            $(".txtaddress-coorporate").addClass("has-error");
            $(".invalid-alamat-corporate").html("Alamat Outlet tidak boleh kosong");
            address_corporate.focus();
        } else {
            $(".txtaddress-coorporate").removeClass("has-error");
            $(".invalid-alamat-corporate").html("");
        }

        if (phone_corporate.val() == "") {
            $(".txtphone-coorporate").addClass("has-error");
            $(".invalid-telepon-corporate").html("Telephon Outlet tidak boleh kosong");
            phone_corporate.focus();
        } else {
            $(".txtphone-coorporate").removeClass("has-error");
            $(".invalid-telepon-corporate").html("");
        }

        // if (lattitude_corporate.val() == "") {
        //     $(".txtlattitude-coorporate").addClass("has-error");
        //     $(".invalid-lattitude-corporate").html("Lattitude Outlet tidak boleh kosong");
        //     lattitude_corporate.focus();
        // } else {
        //     $(".txtlattitude-coorporate").removeClass("has-error");
        //     $(".invalid-lattitude-corporate").html("");
        // }

        // if (longitude_corporate.val() == "") {
        //     $(".txtlongitude-coorporate").addClass("has-error");
        //     $(".invalid-longitude-corporate").html("Longitude Outlet tidak boleh kosong");
        //     longitude_corporate.focus();
        // } else {
        //     $(".txtlongitude-coorporate").removeClass("has-error");
        //     $(".invalid-longitude-corporate").html("");
        // }

        // if (stretclass_corporate.val() == "") {
        //     $(".listcoorporate-stretclass").addClass("has-error");
        //     $(".invalid-kelas-jalan-corporate").html("Kelas Jalan Berdasarkan muatan tidak boleh kosong");
        //     stretclass_corporate.focus();
        // } else {
        //     $(".listcoorporate-stretclass").removeClass("has-error");
        //     $(".invalid-kelas-jalan-corporate").html("");
        // }

        // if (stretclass2_corporate.val() == "") {
        //     $(".listcoorporate-stretclass2").addClass("has-error");
        //     $(".invalid-kelas-jalan2-corporate").html("Kelas Jalan Berdasarkan fungsi jalan tidak boleh kosong");
        //     stretclass2_corporate.focus();
        // } else {
        //     $(".listcoorporate-stretclass2").removeClass("has-error");
        //     $(".invalid-kelas-jalan2-corporate").html("");
        // }

        if (area_corporate.val() == "") {
            $(".listcoorporate-area").addClass("has-error");
            $(".invalid-area-corporate").html("Area Outlet tidak boleh kosong");
            area_corporate.focus();
        } else {
            $(".listcoorporate-area").removeClass("has-error");
            $(".invalid-area-corporate").html("");
        }

        if (province.val() == "") {
            $(".listcoorporate-province").addClass("has-error");
            $(".invalid-provinsi-corporate").html("Provinsi Outlet tidak boleh kosong");
            province.focus();
        } else {
            $(".listcoorporate-province").removeClass("has-error");
            $(".invalid-provinsi-corporate").html("");
        }

        if (city.val() == "") {
            $(".listcoorporate-city").addClass("has-error");
            $(".invalid-kota-corporate").html("Kota Outlet tidak boleh kosong");
            city.focus();
        } else {
            $(".listcoorporate-city").removeClass("has-error");
            $(".invalid-kota-corporate").html("");
        }

        if (districts.val() == "") {
            $(".listcoorporate-districts").addClass("has-error");
            $(".invalid-kecamatan-corporate").html("Kecamatan Outlet tidak boleh kosong");
            districts.focus();
        } else {
            $(".listcoorporate-districts").removeClass("has-error");
            $(".invalid-kecamatan-corporate").html("");
        }

        if (ward.val() == "") {
            $(".listcoorporate-ward").addClass("has-error");
            $(".invalid-kelurahan-corporate").html("Kelurahan Outlet tidak boleh kosong");
            ward.focus();
        } else {
            $(".listcoorporate-ward").removeClass("has-error");
            $(".invalid-kelurahan-corporate").html("");
        }

        if (kodepos_corporate.val() == "") {
            $(".txtpostalcode-coorporate").addClass("has-error");
            $(".invalid-kode-pos-corporate").html("Kode Pos Outlet tidak boleh kosong");
            kodepos_corporate.focus();
        } else {
            $(".txtpostalcode-coorporate").removeClass("has-error");
            $(".invalid-kode-pos-corporate").html("");
        }

        // if (name_contact_person.val() == "") {
        //     $(".txtname-contact-person").addClass("has-error");
        //     $(".invalid-nama-contact-person").html("Nama Contact Person tidak boleh kosong");
        //     name_contact_person.focus();
        // } else {
        //     $(".txtname-contact-person").removeClass("has-error");
        //     $(".invalid-nama-contact-person").html("");
        // }

        // if (phone_contact_person.val() == "") {
        //     $(".txtphone-contact-person").addClass("has-error");
        //     $(".invalid-telepon-contact-person").html("Telepon Contact Person tidak boleh kosong");
        //     phone_contact_person.focus();
        // } else {
        //     $(".txtphone-contact-person").removeClass("has-error");
        //     $(".invalid-telepon-contact-person").html("");
        // }

        if (kreditlimit_contact_person.val() == "") {
            $(".txtkreditlimit-contact-person").addClass("has-error");
            $(".invalid-kredit-limit-contact-person").html("Kredit Limit Contact Person tidak boleh kosong");
            kreditlimit_contact_person.focus();
        } else {
            $
                (".txtkreditlimit-contact-person").removeClass("has-error");
            $(".invalid-kredit-limit-contact-person").html("");
        }

        if (isValidMultiLocation == 1) {
            if (listcontactperson_location.val() == "") {
                $(".listcontactperson-location").addClass("has-error");
                $(".invalid-list-location-contact-person").html("Lokasi tidak boleh kosong");
                kreditlimit_contact_person.focus();
            } else {
                $(".listcontactperson-location").removeClass("has-error");
                $(".invalid-list-location-contact-person").html("");
            }
        }
    }

    function PushArrayMasar(idx, client_pt_id, client_pt_nama) {

        // console.log(idx);
        var checked = $('[id="chk-' + idx + '-masar"]:checked').length;

        $("#select-sync-all-masar").prop("checked", false);

        if (checked > 0) {

            arr_list_masar.push({
                'idx': idx,
                'client_pt_id': client_pt_id,
                'client_pt_nama': client_pt_nama
            });

            const uniqueArray = [];
            const seenIds = {};

            for (const obj of arr_list_masar) {
                if (!seenIds[obj.client_pt_id]) {
                    seenIds[obj.client_pt_id] = true;
                    uniqueArray.push(obj);
                }
            }

            arr_list_masar = uniqueArray;
        } else {
            const findIndexData = arr_list_masar.findIndex((value) => value.no_urut == idx);
            if (findIndexData > -1) { // only splice array when item is found
                arr_list_masar.splice(findIndexData, 1); // 2nd parameter means remove one item only
            }
        }
    }

    function PushArrayMasap(idx, client_pt_id, client_pt_nama) {

        // console.log(idx);
        var checked = $('[id="chk-' + idx + '-masap"]:checked').length;

        $("#select-sync-all-masap").prop("checked", false);

        if (checked > 0) {

            arr_list_masap.push({
                'idx': idx,
                'client_pt_id': client_pt_id,
                'client_pt_nama': client_pt_nama
            });

            const uniqueArray = [];
            const seenIds = {};

            for (const obj of arr_list_masap) {
                if (!seenIds[obj.client_pt_id]) {
                    seenIds[obj.client_pt_id] = true;
                    uniqueArray.push(obj);
                }
            }

            arr_list_masap = uniqueArray;
        } else {
            const findIndexData = arr_list_masap.findIndex((value) => value.no_urut == idx);
            if (findIndexData > -1) { // only splice array when item is found
                arr_list_masap.splice(findIndexData, 1); // 2nd parameter means remove one item only
            }
        }
    }

    function SyncMasar(idx, client_pt_id, client_pt_nama) {

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/sync_client_masar') ?>",
            data: {
                client_pt_id: client_pt_id,
                client_pt_nama: client_pt_nama
            },
            dataType: "JSON",
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading ...',
                    html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                    timerProgressBar: false,
                    showConfirmButton: false
                });

                $("#btn_sync_masap").prop("disabled", true);
                $("#btn_sync_masar").prop("disabled", true);
            },
            success: function(response) {
                $.each(response, function(i, v) {
                    if (v.status == "200") {
                        new PNotify
                            ({
                                title: 'Success',
                                text: client_pt_nama + " " + GetLanguageByKode(v.msg),
                                // text: "Supplier Belum Dipilih",
                                type: 'success',
                                styling: 'bootstrap3',
                                delay: 3000,
                                stack: stack_center
                            });
                    } else if (v.status == "500") {
                        new PNotify
                            ({
                                title: 'Error',
                                text: client_pt_nama + " " + GetLanguageByKode(v.msg),
                                // text: client_pt_nama + " " + GetLanguageByKode(v.msg),
                                // text: "Supplier Belum Dipilih",
                                type: 'error',
                                styling: 'bootstrap3',
                                delay: 3000,
                                stack: stack_center
                            });
                    } else if (v.status == "501") {
                        new PNotify
                            ({
                                title: 'Error',
                                text: client_pt_nama + " " + GetLanguageByKode(v.msg),
                                // text: "Supplier Belum Dipilih",
                                type: 'error',
                                styling: 'bootstrap3',
                                delay: 3000,
                                stack: stack_center
                            });
                    } else if (v.status == "404") {
                        new PNotify
                            ({
                                title: 'Error',
                                text: client_pt_nama + " Tidak Ditemukan",
                                // text: "Supplier Belum Dipilih",
                                type: 'error',
                                styling: 'bootstrap3',
                                delay: 3000,
                                stack: stack_center
                            });
                    }

                });

                $("#btn_sync_masap").prop("disabled", false);
                $("#btn_sync_masar").prop("disabled", false);

                Swal.close();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");
                $("#btn_sync_masap").prop("disabled", false);
                $("#btn_sync_masar").prop("disabled", false);
            },
            complete: function() {
                Swal.close();
                $("#btn_sync_masap").prop("disabled", false);
                $("#btn_sync_masar").prop("disabled", false);
            }
        });

    }

    function SyncMasap(idx, client_pt_id, client_pt_nama) {

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/sync_client_masap') ?>",
            data: {
                client_pt_id: client_pt_id,
                client_pt_nama: client_pt_nama
            },
            dataType: "JSON",
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading ...',
                    html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                    timerProgressBar: false,
                    showConfirmButton: false
                });

                $("#btn_sync_masap").prop("disabled", true);
                $("#btn_sync_masar").prop("disabled", true);
            },
            success: function(response) {
                $.each(response, function(i, v) {
                    if (v.status == "200") {
                        new PNotify
                            ({
                                title: 'Success',
                                text: client_pt_nama + " " + GetLanguageByKode(v.msg),
                                // text: "Supplier Belum Dipilih",
                                type: 'success',
                                styling: 'bootstrap3',
                                delay: 3000,
                                stack: stack_center
                            });
                    } else if (v.status == "500") {
                        new PNotify
                            ({
                                title: 'Error',
                                text: client_pt_nama + " " + GetLanguageByKode(v.msg),
                                // text: "Supplier Belum Dipilih",
                                type: 'error',
                                styling: 'bootstrap3',
                                delay: 3000,
                                stack: stack_center
                            });
                    } else if (v.status == "501") {
                        new PNotify
                            ({
                                title: 'Error',
                                text: client_pt_nama + " " + GetLanguageByKode(v.msg),
                                // text: "Supplier Belum Dipilih",
                                type: 'error',
                                styling: 'bootstrap3',
                                delay: 3000,
                                stack: stack_center
                            });
                    }

                });

                $("#btn_sync_masap").prop("disabled", false);
                $("#btn_sync_masar").prop("disabled", false);

                Swal.close();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");
                $("#btn_sync_masap").prop("disabled", false);
                $("#btn_sync_masar").prop("disabled", false);
            },
            complete: function() {
                Swal.close();
                $("#btn_sync_masap").prop("disabled", false);
                $("#btn_sync_masar").prop("disabled", false);
            }
        });
    }

    $("#btn_sync_masar").click(function() {

        // console.log(arr_list_masar);
        if (arr_list_masar.length > 0) {
            $.each(arr_list_masar, function(i, v) {
                SyncMasar(v.idx, v.client_pt_id, v.client_pt_nama);
            });

            setTimeout(() => {
                GetOutletMenu();
            }, 2000);
        } else {
            let alert_tes = GetLanguageByKode('CAPTION-ALERT-PILIHPELANGGAN');
            // let alert_tes = "Pilih Masar";
            message_custom("Error", "error", alert_tes);

        }
    });

    $("#btn_sync_masap").click(function() {
        if (arr_list_masap.length > 0) {
            $.each(arr_list_masap, function(i, v) {
                SyncMasap(v.idx, v.client_pt_id, v.client_pt_nama);
            });

            setTimeout(() => {
                GetOutletMenu();
            }, 2000);
        } else {
            let alert_tes = GetLanguageByKode('CAPTION-ALERT-PILIHPELANGGAN');
            // let alert_tes = "Pilih Masar";
            message_custom("Error", "error", alert_tes);

        }
    });

    function ViewModalMasar(client_pt_id) {
        $("#Modal_masar").modal('show');
        GetMasarByClientPt(client_pt_id);
    }

    function ViewModalMasap(client_pt_id) {
        $("#Modal_masap").modal('show');
        GetMasapByClientPt(client_pt_id);
    }

    function GetMasarByClientPt(client_pt_id) {

        $.ajax({
            type: 'GET',
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_masar_by_client_pt') ?>",
            data: {
                client_pt_id: client_pt_id
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

                $("#filter_pelanggan").html('');

                if (response.length > 0) {
                    $("#filter_pelanggan").append(`<option value=""></option>`);
                    $.each(response, function(i, v) {
                        $("#filter_pelanggan").append(`<option value="${v.masar_id}">${v.masar_nama}</option>`);
                    });
                }

                Swal.close();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");
            },
            complete: function() {
                Swal.close();
            }
        });
    }

    function GetMasarById() {

        $("#Masar-masar_id").val('');
        $("#Masar-kode").val('');
        $("#Masar-nama").val('');
        $("#Masar-alamat").val('');
        $("#Masar-telepon").val('');
        $("#Masar-fax").val('');
        $("#Masar-lokasi").val('');
        $("#Masar-jatuh_tempo").val('');
        $("#Masar-npwp").val('');
        $("#Masar-limit_piutang").val('');
        $("#Masar-contact_person").val('');
        $("#Masar-position").val('');
        $("#Masar-no_perk_piutang").html('');
        $("#Masar-no_perk_diskon").html('');
        $("#Masar-no_perk_penjualan").html('');
        $("#Masar-no_perk_ppn").html('');
        $("#Masar-no_perk_retur_jual").html('');
        $("#Masar-saldo_awal").val('');
        $("#Masar-pembayaran_kas").val('');
        $("#Masar-jumlah_debet").val('');
        $("#Masar-pembayaran_cek").val('');
        $("#Masar-jumlah_kredit").val('');
        $("#Masar-memo_debet").val('');
        $("#Masar-saldo_akhir").val('');
        $("#Masar-memo_kredit").val('');

        $.ajax({
            type: 'GET',
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_masar_by_id') ?>",
            data: {
                masar_id: $("#filter_pelanggan").val()
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

                if (response.length > 0) {
                    $.each(response, function(i, v) {
                        $("#Masar-masar_id").val(v.masar_id);
                        $("#Masar-kode").val(v.masar_no);
                        $("#Masar-nama").val(v.masar_nama);
                        $("#Masar-alamat").val(v.masar_alamat);
                        $("#Masar-telepon").val(v.masar_telepon);
                        $("#Masar-fax").val(v.masar_fax);
                        $("#Masar-lokasi").val('');
                        $("#Masar-jatuh_tempo").val(formatRupiah(parseInt(v.masar_jatuh_tempo).toString().replaceAll(".", ",")));
                        $("#Masar-npwp").val(v.masar_npwp);
                        $("#Masar-limit_piutang").val(formatRupiah(v.masar_limit.toString().replaceAll(".", ",")));
                        $("#Masar-contact_person").val(v.masar_contact1);
                        $("#Masar-position").val(v.masar_position1);
                        $("#Masar-saldo_awal").val(formatRupiah(v.masar_saldo_awal.toString().replaceAll(".", ",")));
                        $("#Masar-pembayaran_kas").val(formatRupiah(v.masar_lunas_kas.toString().replaceAll(".", ",")));
                        $("#Masar-jumlah_debet").val(formatRupiah(v.masar_debet.toString().replaceAll(".", ",")));
                        $("#Masar-pembayaran_cek").val(formatRupiah(v.masar_lunas_cek.toString().replaceAll(".", ",")));
                        $("#Masar-jumlah_kredit").val(formatRupiah(v.masar_kredit.toString().replaceAll(".", ",")));
                        $("#Masar-memo_debet").val(formatRupiah(v.masar_debet_memo.toString().replaceAll(".", ",")));
                        $("#Masar-saldo_akhir").val(formatRupiah(v.masar_saldo_akhir.toString().replaceAll(".", ",")));
                        $("#Masar-memo_kredit").val(formatRupiah(v.masar_kredit_memo.toString().replaceAll(".", ",")));
                        $("#Masar-updtgl").val(v.updtgl);
                        $("#Masar-updwho").val(v.updwho);

                        $("#Masar-no_perk_piutang").append(`<option value="${v.masar_no_piutang}">${v.masar_no_piutang} || ${v.masar_no_piutang_ket}</option>`);
                        $("#Masar-no_perk_diskon").append(`<option value="${v.masar_no_disc}">${v.masar_no_disc} || ${v.masar_no_disc_ket}</option>`);
                        $("#Masar-no_perk_penjualan").append(`<option value="${v.masar_no_penj}">${v.masar_no_penj} || ${v.masar_no_penj_ket}</option>`);
                        $("#Masar-no_perk_ppn").append(`<option value="${v.masar_no_ppn}">${v.masar_no_ppn} || ${v.masar_no_ppn_ket}</option>`);
                        $("#Masar-no_perk_retur_jual").append(`<option value="${v.masar_no_retur}">${v.masar_no_retur} || ${v.masar_no_retur_ket}</option>`);

                        $('#Masar-no_perk_piutang').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/Outlet/search_no_perkiraan_all') ?>', // URL to your CodeIgniter controller method
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
                            minimumInputLength: 3
                        });

                        $('#Masar-no_perk_diskon').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/Outlet/search_no_perkiraan_all') ?>', // URL to your CodeIgniter controller method
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
                            minimumInputLength: 3
                        });

                        $('#Masar-no_perk_penjualan').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/Outlet/search_no_perkiraan_all') ?>', // URL to your CodeIgniter controller method
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
                            minimumInputLength: 3
                        });

                        $('#Masar-no_perk_ppn').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/Outlet/search_no_perkiraan_all') ?>', // URL to your CodeIgniter controller method
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
                            minimumInputLength: 3
                        });

                        $('#Masar-no_perk_retur_jual').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/Outlet/search_no_perkiraan_all') ?>', // URL to your CodeIgniter controller method
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
                            minimumInputLength: 3
                        });
                    });
                } else {
                    $("#Masar-masar_id").val('');
                    $("#Masar-kode").val('');
                    $("#Masar-nama").val('');
                    $("#Masar-alamat").val('');
                    $("#Masar-telepon").val('');
                    $("#Masar-fax").val('');
                    $("#Masar-lokasi").val('');
                    $("#Masar-jatuh_tempo").val('');
                    $("#Masar-npwp").val('');
                    $("#Masar-limit_piutang").val('');
                    $("#Masar-contact_person").val('');
                    $("#Masar-position").val('');
                    $("#Masar-no_perk_piutang").html('');
                    $("#Masar-no_perk_diskon").html('');
                    $("#Masar-no_perk_penjualan").html('');
                    $("#Masar-no_perk_ppn").html('');
                    $("#Masar-no_perk_retur_jual").html('');
                    $("#Masar-saldo_awal").val('');
                    $("#Masar-pembayaran_kas").val('');
                    $("#Masar-jumlah_debet").val('');
                    $("#Masar-pembayaran_cek").val('');
                    $("#Masar-jumlah_kredit").val('');
                    $("#Masar-memo_debet").val('');
                    $("#Masar-saldo_akhir").val('');
                    $("#Masar-memo_kredit").val('');
                }

                Swal.close();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");
            },
            complete: function() {
                Swal.close();
            }
        });
    }

    function GetMasapByClientPt(client_pt_id) {

        $("#Masap-masap_id").val('');
        $("#Masap-kode").val('');
        $("#Masap-nama").val('');
        $("#Masap-alamat").val('');
        $("#Masap-kota").val('');
        $("#Masap-telepon").val('');
        $("#Masap-fax").val('');
        $("#Masap-lokasi").val('');
        $("#Masap-jatuh_tempo").val('');
        $("#Masap-npwp").val('');
        $("#Masap-limit_piutang").val('');
        $("#Masap-contact_person").val('');
        $("#Masap-position").val('');
        $("#Masap-no_perk_piutang").html('');
        $("#Masap-no_perk_diskon").html('');
        $("#Masap-no_perk_penjualan").html('');
        $("#Masap-no_perk_ppn").html('');
        $("#Masap-no_perk_retur_jual").html('');
        $("#Masap-saldo_awal").val('');
        $("#Masap-pembayaran_kas").val('');
        $("#Masap-jumlah_debet").val('');
        $("#Masap-pembayaran_cek").val('');
        $("#Masap-jumlah_kredit").val('');
        $("#Masap-memo_debet").val('');
        $("#Masap-saldo_akhir").val('');
        $("#Masap-memo_kredit").val('');
        $("#Masap-status-selected").val('');


        $.ajax({
            type: 'GET',
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_masap_by_client_pt') ?>",
            data: {
                client_pt_id: client_pt_id
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

                if (response.length > 0) {
                    $.each(response, function(i, v) {
                        $("#Masap-masap_id").val(v.masap_id);
                        $("#Masap-kode").val(v.supp_kode);
                        $("#Masap-nama").val(v.supp_nama);
                        $("#Masap-alamat").val(v.supp_alamat);
                        $("#Masap-kota").val(v.supp_kota);
                        $("#Masap-telepon").val(v.supp_tilpun);
                        $("#Masap-fax").val(v.supp_fax);
                        $("#Masap-contact_person").val(v.supp_contact1);
                        $("#Masap-position").val(v.supp_position1);
                        $("#Masap-keterangan").val(v.supp_keterangan);
                        $("#Masap-no_rek").val(v.supp_ac);
                        $("#Masap-bank").val(v.supp_bank);
                        $("#Masap-limit_hutang").val('');
                        $("#Masap-kredit").val('');
                        $("#Masap-saldo_awal").val(formatRupiah(v.supp_awal_brg.toString().replaceAll(".", ",")));
                        $("#Masap-pembayaran_kas").val(formatRupiah(v.supp_lunas_kas.toString().replaceAll(".", ",")));
                        $("#Masap-jumlah_debet").val(formatRupiah(v.supp_debet_brg.toString().replaceAll(".", ",")));
                        $("#Masap-pembayaran_cek").val(formatRupiah(v.supp_lunas_cek.toString().replaceAll(".", ",")));
                        $("#Masap-jumlah_kredit").val(formatRupiah(v.supp_kredit_brg.toString().replaceAll(".", ",")));
                        $("#Masap-memo_debet").val(formatRupiah(v.supp_debet_memo.toString().replaceAll(".", ",")));
                        $("#Masap-saldo_akhir").val(formatRupiah(v.supp_akhir_brg.toString().replaceAll(".", ",")));
                        $("#Masap-memo_kredit").val(formatRupiah(v.supp_kredit_memo.toString().replaceAll(".", ",")));
                        $("#Masap-updtgl").val(v.updtgl);
                        $("#Masap-updwho").val(v.updwho);
                        $("#Masap-status-selected").val(v.supp_status);

                        if (v.isexpedisi == 1) {
                            $("#Masap-is_ekspedisi").prop("checked", true);
                        }

                        setRadioStatusValue(v.supp_status);

                        $("#Masap-no_perk_hutang").append(`<option value="${v.supp_per_htng}">${v.supp_per_htng} || ${v.supp_per_htng_ket}</option>`);
                        $("#Masap-no_perk_diskon").append(`<option value="${v.supp_per_disc}">${v.supp_per_disc} || ${v.supp_per_disc_ket}</option>`);
                        $("#Masap-no_perk_selisih_retur").append(`<option value="${v.supp_per_beli}">${v.supp_per_beli} || ${v.supp_per_beli_ket}</option>`);
                        $("#Masap-no_perk_ppn").append(`<option value="${v.supp_per_ppn}">${v.supp_per_ppn} || ${v.supp_per_ppn_ket}</option>`);

                        $('#Masap-no_perk_hutang').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/Outlet/search_no_perkiraan_all') ?>', // URL to your CodeIgniter controller method
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
                            minimumInputLength: 3
                        });

                        $('#Masap-no_perk_diskon').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/Outlet/search_no_perkiraan_all') ?>', // URL to your CodeIgniter controller method
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
                            minimumInputLength: 3
                        });

                        $('#Masap-no_perk_selisih_retur').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/Outlet/search_no_perkiraan_all') ?>', // URL to your CodeIgniter controller method
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
                            minimumInputLength: 3
                        });

                        $('#Masap-no_perk_ppn').select2({
                            ajax: {
                                url: '<?= base_url('FAS/ManagementPelanggan/Outlet/search_no_perkiraan_all') ?>', // URL to your CodeIgniter controller method
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
                            minimumInputLength: 3
                        });
                    });
                } else {
                    $("#Masap-masap_id").val('');
                    $("#Masap-kode").val('');
                    $("#Masap-nama").val('');
                    $("#Masap-alamat").val('');
                    $("#Masap-telepon").val('');
                    $("#Masap-fax").val('');
                    $("#Masap-lokasi").val('');
                    $("#Masap-jatuh_tempo").val('');
                    $("#Masap-npwp").val('');
                    $("#Masap-limit_piutang").val('');
                    $("#Masap-contact_person").val('');
                    $("#Masap-position").val('');
                    $("#Masap-no_perk_piutang").html('');
                    $("#Masap-no_perk_diskon").html('');
                    $("#Masap-no_perk_penjualan").html('');
                    $("#Masap-no_perk_ppn").html('');
                    $("#Masap-no_perk_retur_jual").html('');
                    $("#Masap-saldo_awal").val('');
                    $("#Masap-pembayaran_kas").val('');
                    $("#Masap-jumlah_debet").val('');
                    $("#Masap-pembayaran_cek").val('');
                    $("#Masap-jumlah_kredit").val('');
                    $("#Masap-memo_debet").val('');
                    $("#Masap-saldo_akhir").val('');
                    $("#Masap-memo_kredit").val('');
                }

                Swal.close();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");
            },
            complete: function() {
                Swal.close();
            }
        });
    }

    $("#btn_update_masar").click(function(event) {

        messageBoxBeforeRequest('Pastikan data yang sudah anda input benar!', 'Iya, Simpan', 'Tidak, Tutup').then((result) => {
            if (result.value == true) {
                requestAjax(
                    "<?= base_url('FAS/ManagementPelanggan/Outlet/Update_masar'); ?>", {
                        masar_id: $("#Masar-masar_id").val(),
                        masar_no: $("#Masar-kode").val(),
                        masar_nama: $("#Masar-nama").val(),
                        masar_alamat: $("#Masar-alamat").val(),
                        masar_telepon: $("#Masar-telepon").val(),
                        masar_fax: $("#Masar-fax").val(),
                        masar_jatuh_tempo: ($("#Masar-jatuh_tempo").val().toString().replaceAll(".", "")).replaceAll(",", "."),
                        masar_npwp: $("#Masar-npwp").val(),
                        masar_limit: ($("#Masar-limit_piutang").val().toString().replaceAll(".", "")).replaceAll(",", "."),
                        masar_contact1: $("#Masar-contact_person").val(),
                        masar_position1: $("#Masar-position").val(),
                        masar_no_piutang: $("#Masar-no_perk_piutang").val(),
                        masar_no_disc: $("#Masar-no_perk_diskon").val(),
                        masar_no_penj: $("#Masar-no_perk_penjualan").val(),
                        masar_no_ppn: $("#Masar-no_perk_ppn").val(),
                        masar_no_retur: $("#Masar-no_perk_retur_jual").val(),
                        updtgl: $("#Masar-updtgl").val(),
                        updwho: $("#Masar-updwho").val()
                    }, "POST", "JSON",
                    function(response) {
                        if (response.status == "200") {
                            var msg = GetLanguageByKode("CAPTION-ALERT-DATABERHASILDISIMPAN");
                            message("Success", msg, "success");
                            GetOutletMenu();
                            ResetForm();
                            $("#Modal_masar").modal('hide');
                        } else if (response.status == "400") {
                            ResetForm();
                            return messageNotSameLastUpdated();
                        } else {
                            var msg = GetLanguageByKode("CAPTION-ALERT-DATAGAGALDISIMPAN");
                            message("Error", msg, "error");
                        }
                    })
            }
        });
    });

    $("#btn_update_masap").click(function(event) {

        messageBoxBeforeRequest('Pastikan data yang sudah anda input benar!', 'Iya, Simpan', 'Tidak, Tutup').then((result) => {
            if (result.value == true) {
                requestAjax(
                    "<?= base_url('FAS/ManagementPelanggan/Outlet/Update_masap'); ?>", {
                        masap_id: $("#Masap-masap_id").val(),
                        supp_kode: $("#Masap-kode").val(),
                        supp_nama: $("#Masap-nama").val(),
                        supp_alamat: $("#Masap-alamat").val(),
                        supp_kota: $("#Masap-kota").val(),
                        supp_tilpun: $("#Masap-telepon").val(),
                        supp_fax: $("#Masap-fax").val(),
                        supp_contact1: $("#Masap-contact_person").val(),
                        supp_position1: $("#Masap-position").val(),
                        supp_keterangan: $("#Masap-keterangan").val(),
                        supp_ac: $("#Masap-no_rek").val(),
                        supp_bank: $("#Masap-bank").val(),
                        updtgl: $("#Masap-updtgl").val(),
                        updwho: $("#Masap-updwho").val(),
                        supp_status: $("#Masap-status-selected").val(),
                        supp_per_htng: $("#Masap-no_perk_hutang").val(),
                        supp_per_disc: $("#Masap-no_perk_diskon").val(),
                        supp_per_beli: $("#Masap-no_perk_selisih_retur").val(),
                        supp_per_ppn: $("#Masap-no_perk_ppn").val(),
                        isexpedisi: $('[id="Masap-is_ekspedisi"]:checked').length
                    }, "POST", "JSON",
                    function(response) {
                        if (response.status == "200") {
                            var msg = GetLanguageByKode("CAPTION-ALERT-DATABERHASILDISIMPAN");
                            message("Success", msg, "success");
                            GetOutletMenu();
                            ResetForm();
                            $("#Modal_masap").modal('hide');
                        } else if (response.status == "400") {
                            ResetForm();
                            return messageNotSameLastUpdated();
                        } else {
                            var msg = GetLanguageByKode("CAPTION-ALERT-DATAGAGALDISIMPAN");
                            message("Error", msg, "error");
                        }
                    })
            }
        });
    });

    function getSelectedRadioStatusValue() {
        var radioButtons = document.getElementsByName("Masap[status]");
        var selectedValue = "";

        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                selectedValue = radioButtons[i].value;
                break;
            }
        }

        $("#Masap-status-selected").val(selectedValue);
    }

    function setRadioStatusValue(valueToSelect) {
        var radioButtons = document.getElementsByName("Masap[status]");

        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].value === valueToSelect) {
                radioButtons[i].checked = true;
                break;
            }
        }
    }

    function get_selected_client_pt_status_pkp() {

        var radioButtons = document.getElementsByName("listcontactperson-client_pt_status_pkp");
        var selectedValue = "";

        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                selectedValue = radioButtons[i].value;
                break;
            }
        }

        $("#listcontactperson-client_pt_status_pkp-selected").val(selectedValue);
    }

    function set_selected_client_pt_status_pkp(valueToSelect) {
        var radioButtons = document.getElementsByName("listcontactperson-client_pt_status_pkp");

        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].value === valueToSelect) {
                radioButtons[i].checked = true;
                break;
            }
        }
    }
</script>