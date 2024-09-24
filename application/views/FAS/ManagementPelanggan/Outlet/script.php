<script type="text/javascript">
    var arr_multiple_alamat = [];

    function url_like(url) {
        return base_url + url;
    }

    function main_page() {
        setTimeout(() => {
            window.location = url_like("Outlet/OutletMenu");
        }, 2000);
    }

    $(document).ready(function() {

        $(".select2").select2({
            width: "100%"
        });
        let OutletId = location.pathname;
        var id = OutletId.substring(OutletId.lastIndexOf('/') + 1);

        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Data_Outlet_By_Id') ?>",
            data: {
                OutletId: id,
                type: "<?= $this->input->get('type') ?>"
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response.data, function(i, v) {
                    $("#txthideOutletId-update").val(i);
                    $("#txtname-coorporate-update").val(v.nama);
                    $("#txtaddress-coorporate-update").val(v.alamat);
                    $("#txtphone-coorporate-update").val(v.telepon);

                    $("#listcoorporate-province-update").val(v.provinsi).trigger('change');
                    $("#listcoorporate-city-update").val(v.kota)
                    $("#listcoorporate-district-update").val(v.kecamatan)
                    $("#listcoorporate-ward-update").val(v.kelurahan)
                    $("#txtpostalcode-coorporate-update").val(v.kodepos)

                    $("#listcoorporate-stretclass-update").val(v.kelas_jalan).trigger('change');
                    $("#listcoorporate-stretclass2-update").val(v.kelas_jalan2).trigger('change');
                    $("#listcoorporate-area-update").val(v.area).trigger('change');

                    $("#txtlattitude-coorporate-update").val(v.lattitude);
                    $("#txtlongitude-coorporate-update").val(v.longitude);
                    $("#txtname-contact-person-update").val(v.nama_cp);
                    $("#txtphone-contact-person-update").val(v.telepon_cp);
                    $("#txtkreditlimit-contact-person-update").val(v.kredit_limit_cp);

                    $("#listcontactperson-segment1-update").val(v.segment1).trigger('change');
                    $("#listcontactperson-segment2-update").val(v.segment2)
                    $("#listcontactperson-segment3-update").val(v.segment3)

                    $("#listcontactperson-client_pt_fax-update").val(v.client_pt_fax);
                    $("#listcontactperson-client_pt_npwp-update").val(v.client_pt_npwp);
                    // $("#listcontactperson-client_pt_status_pkp-update").val();

                    set_selected_client_pt_status_pkp(v.client_pt_status_pkp);

                    if (v.checklist == 1) {
                        $("#multilocationupdate").prop("checked", true);
                        $("#showlistmultilokasiupdate").show();
                    } else {
                        $("#multilocationupdate").prop("checked", false);
                        $("#showlistmultilokasiupdate").hide();
                    }

                    if (v.aktif == 1) {
                        $("#txtstatus-coorporate-update").prop("checked", true);
                    } else {
                        $("#txtstatus-coorporate-update").prop("checked", false);
                    }

                    $("#listcontactperson-location-update").val(v.lokasi_id).trigger('change');
                    $("#list-day-operasional-update > tbody").empty();
                    $.each(v.data, function(index, value) {
                        if (value.id_detail && value.no_urut && value.hari && value
                            .buka &&
                            value.tutup && value.status != null) {
                            var buka = value.buka.split(".");
                            var buka1 = buka[0].split(":");
                            var removebuku_1 = buka1.splice(-1);
                            var tutup = value.tutup.split(".");
                            var tutup1 = tutup[0].split(":");
                            var removetutup_1 = tutup1.splice(-1);
                            var select = '';
                            var clock_open = buka1.join(":") != '00:00' ? buka1.join(
                                ":") : '';
                            var clock_close = tutup1.join(":") != '00:00' ? tutup1.join(
                                ":") : '';
                            if (value.status == 0) {
                                select =
                                    "<option value='1'>BUKA</option><option value='0' selected>TUTUP</option>"
                            } else {
                                select =
                                    "<option value='1' selected>BUKA</option><option value='0'>TUTUP</option>"
                            }
                            // console.table(value)
                            var pengiriman = value.pengiriman == 1 ?
                                '<input type="checkbox" id="chk_pengiriman" name="chk_pengiriman" checked>' :
                                '<input type="checkbox" id="chk_pengiriman" name="chk_pengiriman" />';
                            var penagihan = value.penagihan == 1 ?
                                '<input type="checkbox" id="chk_penagihan" name="chk_penagihan" checked>' :
                                '<input type="checkbox" id="chk_penagihan" name="chk_penagihan" />';
                            // console.log(value.pegiriman);

                            var html = '';
                            var Jam_Buka =
                                '<input type="time" class="from-control" id="jam_buka_perusahaan_update" value="' +
                                clock_open + '" name="jam_buka_perusahaan_update"/>';
                            var Jam_Tutup =
                                '<input type="time" class="from-control" value="' +
                                clock_close +
                                '" id="jam_tutup_perusahaan_update" name="jam_tutup_perusahaan_update"/>';
                            var status =
                                `<select class="form-control" id="status_operasional_perusahaan_update" name="status_operasional_perusahaan_update">` +
                                select + `</select>`;

                            html = html + '<tr>';
                            html = html + '	<td>' + value.no_urut +
                                ' <input type="hidden" id="no_urut_hari_perusahaan_update" name="no_urut_hari_perusahaan_update" value="' +
                                value.no_urut +
                                '"/> <input type="hidden" id="id_detail_perusahaan_update" name="id_detail_perusahaan_update" value="' +
                                value.id_detail + '"/></td>';
                            html = html + '	<td>' + value.hari +
                                ' <input type="hidden" id="nama_hari_perusahaan_update" name="nama_hari_perusahaan_update" value="' +
                                value.hari + '"/></td>';
                            html = html + '	<td>' + Jam_Buka + '</td>';
                            html = html + '	<td>' + Jam_Tutup + '</td>';
                            html = html + '	<td>' + status + '</td>';
                            html = html +
                                '	<td style="vertical-align:middle; text-align: center;">' +
                                pengiriman + '</td>';
                            html = html +
                                '	<td style="vertical-align:middle; text-align: center;">' +
                                penagihan + '</td>';
                            html = html + '</tr>';
                            $("#list-day-operasional-update > tbody").append(html);
                        } else {
                            $("#list-day-operasional-update > tbody").append(
                                '<tr><td colspan="5" class="text-center text-danger">Data Kosong</td></tr>'
                            );
                        }
                    });
                });

                if (response.data3.length > 0) {
                    // arr_multiple_alamat.push(...response.data3)
                    response.data3.forEach(item => {
                        if (item.flag.includes('sama')) {
                            // Properti flag2 akan otomatis ditambahkan meskipun tidak ada
                            item.flag2 = "sama";
                        } else {
                            item.flag2 = "beda";
                        }

                        // Tambahkan item ke array
                        arr_multiple_alamat.push(item);
                    });

                }


                $('#list-detail-outlet tbody').empty();

                if ($.fn.DataTable.isDataTable('#list-detail-outlet')) {
                    $('#list-detail-outlet').DataTable().clear();
                    $('#list-detail-outlet').DataTable().destroy();
                }

                if (response.data2.length > 0) {
                    $.each(response.data2, function(i, v) {
                        var alamat_invoice = arr_multiple_alamat.filter((value) => value.flag.includes('alamat_invoice') && value.client_pt_principle_id == v.client_pt_principle_id).length;
                        var alamat_tagih = arr_multiple_alamat.filter((value) => value.flag.includes('alamat_tagih') && value.client_pt_principle_id == v.client_pt_principle_id).length;
                        var alamat_kirim = arr_multiple_alamat.filter((value) => value.flag.includes('alamat_kirim') && value.client_pt_principle_id == v.client_pt_principle_id).length;
                        var alamat_pajak = arr_multiple_alamat.filter((value) => value.flag.includes('alamat_pajak') && value.client_pt_principle_id == v.client_pt_principle_id).length;


                        $("#list-detail-outlet tbody").append(`
                        <tr>
                            <td class="text-center">${v.principle_kode}</td>
                            <td class="text-center">${v.client_pt_principle_top}</td>
                            <td class="text-center">${formatNumber(parseFloat(v.client_pt_principle_kredit_limit))}</td>
                            <td class="text-center">${v.client_pt_principle_is_kredit == '1' ? 'Ya' : 'Tidak'}</td>
                            <td class="text-center">${v.segmen1}</td>
                            <td class="text-center">${v.segmen2}</td>
                            <td class="text-center">${v.segmen3}</td>
                            <td class="text-center">${formatNumber(parseFloat(v.client_pt_principle_maks_invoice))}</td>
                            <td class="text-center">${v.client_pt_principle_top_retur}</td>
                            <td class="text-center"><button class="btn btn-primary alamat_invoice_beda" data-client-pt-principle-id="${v.client_pt_principle_id}" id="alamat_invoice_beda_${v.client_pt_principle_id}" onclick="newAddress('alamat_invoice', '${v.client_pt_principle_id}', 'Invoice')">${alamat_invoice}</td>
                            <td class="text-center"><button class="btn btn-primary alamat_tagih_beda" data-client-pt-principle-id="${v.client_pt_principle_id}" id="alamat_tagih_beda_${v.client_pt_principle_id}" onclick="newAddress('alamat_tagih', '${v.client_pt_principle_id}', 'Tagih')">${alamat_tagih}</td>
                            <td class="text-center"><button class="btn btn-primary alamat_kirim_beda" data-client-pt-principle-id="${v.client_pt_principle_id}" id="alamat_kirim_beda_${v.client_pt_principle_id}" onclick="newAddress('alamat_kirim', '${v.client_pt_principle_id}', 'Kirim')">${alamat_kirim}</td>
                            <td class="text-center"><button class="btn btn-primary alamat_pajak_beda" data-client-pt-principle-id="${v.client_pt_principle_id}" id="alamat_pajak_beda_${v.client_pt_principle_id}" onclick="newAddress('alamat_pajak', '${v.client_pt_principle_id}', 'Pajak')">${alamat_pajak}</td>
                        </tr>
                    `)
                    })
                } else {
                    $("#list-detail-outlet tbody").append(`
                        <tr>
                            <td colspan="13" class="text-center">Data Kosong</td>
                        </tr>
                    `)
                }

            }
        });

        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/GetDataByIdForEdit') ?>",
            data: {
                id: "<?= $this->uri->segment(5) ?>",
                type: "<?= $this->input->get('type') ?>"
            },
            dataType: "JSON",
            success: function(response) {

                //append dropdown provinsi
                let provinsi_db = response != null ? response.provinsi : null;
                let db_kota = response != null ? response.kota : null;
                let db_kecamatan = response != null ? response.kode_pos_id : null;
                let db_kelurahan = response != null ? response.kelurahan : null;
                let lokasi_outlet_id = response != null ? response.lokasi_outlet_id : null;
                let kelas_jalan = response != null ? response.kelas_jalan : null;
                let area = response != null ? response.area : null;
                let kelas_jalan2 = response != null ? response.kelas_jalan2 : null;
                let segment1 = response != null ? response.segment1 : null;
                let segment2 = response != null ? response.segment2 : null;
                let segment3 = response != null ? response.segment3 : null;

                $("#listcoorporate-province-update").val(response.provinsi);
                // console.log('wad', response);

                //kabupaten change
                $("#listcoorporate-city-update").empty();
                $("#listcoorporate-province-update").change(function() {
                    let ProvinciIid = $(this).val();
                    let id = ProvinciIid == null ? provinsi_db : ProvinciIid;
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kota') ?>",
                        data: {
                            id: id,
                            kota: db_kota
                        },
                        dataType: "JSON",
                        success: function(response) {
                            $("#listcoorporate-city-update").html(response).trigger("change");
                        }
                    });
                    // AppendCity(id, db_kota);
                });

                // function trrigerCity() {
                // let ProvinciIid = $("#listcoorporate-province-update").val();
                // let id = ProvinciIid == null ? provinsi_db : ProvinciIid;
                // $.ajax({
                //     type: "POST",
                //     url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kota') ?>",
                //     data: {
                //         id: id,
                //         kota: db_kota
                //     },
                //     dataType: "JSON",
                //     success: function(response) {
                //         $("#listcoorporate-city-update").html(response).trigger(
                //             "change");
                //     }
                // });
                // }

                //kota change
                $("#listcoorporate-districts-update").empty();
                $("#listcoorporate-city-update").change(function() {
                    let kotaId = $(this).val();
                    let id = kotaId == null ? db_kota : kotaId;
                    let provinsi = $("#listcoorporate-province-update").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kecamatan') ?>",
                        data: {
                            id: id,
                            provinsi: provinsi,
                            kecamatan: db_kecamatan
                        },
                        dataType: "JSON",
                        success: function(response) {
                            $("#listcoorporate-districts-update").html(response)
                                .trigger('change');
                        }
                    });
                });
                //kecamatan change
                $("#listcoorporate-ward-update").empty();

                $("#listcoorporate-districts-update").change(function() {
                    let kecamatanId = $(this).val();
                    let id = kecamatanId == null ? db_kecamatan : kecamatanId;

                    // console.log(kecamatanId);
                    let nama_kecamatan = $('#listcoorporate-districts-update option').filter(
                        ':selected').text();
                    let kota = $('#listcoorporate-city-update option').filter(':selected')
                        .val();
                    $("#data-districts-update").val(nama_kecamatan);
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kelurahan') ?>",
                        data: {
                            id: id,
                            kelurahan: db_kelurahan
                        },
                        dataType: "JSON",
                        success: function(response) {
                            $("#listcoorporate-ward-update").html(response).trigger(
                                "change");
                        }
                    });
                    // let kode_id = $("#listcoorporate-districts-update").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Multi_Lokasi') ?>",
                        data: {
                            kode_id: id,
                            lokasi_outlet_id: lokasi_outlet_id
                        },
                        dataType: "json",
                        success: function(response) {
                            $("#listcontactperson-location-update").html(response)
                                .trigger("change");
                        }
                    });
                });

                $("#listcoorporate-ward-update").change(function() {
                    let kelurahan = $(this).val();
                    let nama_kelurahan = $('#listcoorporate-ward-update option').filter(
                        ':selected').text();
                    $("#data-ward-update").val(nama_kelurahan);
                    $("#txtpostalcode-coorporate-update").val(kelurahan);
                });



                $("#listcontactperson-segment2-update").empty();
                // $("#listcontactperson-segment1-update").change(function() {
                let id1 = $("#listcontactperson-segment1-update").val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Segment2') ?>",
                    data: {
                        id: segment1,
                        segment2: segment2
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#listcontactperson-segment2-update").html(response)
                            .trigger('change');
                    }
                });
                // });

                $("#listcontactperson-segment3-update").empty();
                // $("#listcontactperson-segment2-update").change(function() {
                let segment2_Id = $('#listcontactperson-segment2-update').val();
                let id2 = segment2_Id == null ? segment2 : segment2_Id;
                // let segment1 = $("#listcontactperson-segment1-update").val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Segment3') ?>",
                    data: {
                        id: segment2,
                        Segment3: segment3
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $("#listcontactperson-segment3-update").html(response)
                            .trigger('change');
                    }
                });
                // });

                $("#listcoorporate-province").on("change", function() {
                    let provinsi = $(this).val();
                    AppendCity(provinsi);
                });

                $("#listcoorporate-city").on("change", function() {
                    let provinsi = $("#listcoorporate-province").val();
                    let kota = $(this).val();
                    AppendDistrict(provinsi, kota);
                });

                $("#listcoorporate-districts").on("change", function() {
                    let kecamatan = $(this).val();
                    let nama_kecamatan = $('#listcoorporate-districts option').filter(
                            ':selected')
                        .text();
                    let kota = $('#listcoorporate-city option').filter(':selected').val();
                    $("#data-districts").val(nama_kecamatan);
                    AppendWard(kecamatan);
                    if (kota == "SURABAYA") {
                        AppendAndGetDataMultiLokasi(kecamatan);
                    }
                });

                $("#listcoorporate-ward").on("change", function() {
                    let kelurahan = $(this).val();
                    let nama_kelurahan = $('#listcoorporate-ward option').filter(':selected')
                        .text();
                    $("#data-ward").val(nama_kelurahan);
                    $("#txtpostalcode-coorporate").val(kelurahan);
                });

                $("#listcontactperson-segment1").on("change", function() {
                    let segment1 = $(this).val();
                    AppendSegment2(segment1);
                });

                $("#listcontactperson-segment2").on("change", function() {
                    let segment2 = $(this).val();
                    // console.log(segment2);
                    AppendSegment3(segment2);
                });
            }
        })
    });


    function newAddress(flag, client_pt_principle_id, judul) {
        $("#header_alamat").html(judul);

        var random_id = generateRandomId(10);

        $("#list-day-operasional-update-multiple tbody").empty();

        var button_nama_alamat = '';
        if (arr_multiple_alamat.length > 0) {
            $.each(arr_multiple_alamat, function(i, v) {
                if (v.flag.includes(flag)) {
                    button_nama_alamat += `<button class="btn btn-secondary alamat-btn" onclick="viewMultipleAlamat(this, '${v.random_id}')"><label id="${v.random_id}">${v.nama_person == '' ? 'Alamat Baru' : v.nama_person}</label> &nbsp;
                        <i class="fa-regular fa-circle-xmark" onclick="deleteMultipleAlamat(this, event, '${v.random_id}')" style="color: red;" data-action="delete"></i>
                         </button>`
                }
            })
        }

        // Template HTML untuk form alamat baru
        const formTemplate = `
            <input type="hidden" id="header_client_pt_principle_id" value="${client_pt_principle_id}">
            <input type="hidden" id="header_random_id" value="${random_id}">
            <input type="hidden" id="header_flag" value="${flag}">
            <div class="row" style="display: flex; margin-left: 10px">
                <div id="tab_alamat">
                    ${button_nama_alamat}
                </div>
                <button class="btn btn-warning" id="addAddressBtn" onclick="addAddressBtn()"><i class="fa fa-plus"></i></button>
            </div>
            <hr style="margin-top: 10px;">
            <div id="formMultipleAlamat">
            </div>`;


        // Isi elemen dengan form template
        $("#add_alamat_multiple").empty().html(formTemplate);

        // arr_multiple_alamat.push({
        //     flag: flag,
        //     random_id: random_id,
        //     alamat: '',
        //     telepon: '',
        //     provinsi: '',
        //     kota: '',
        //     kecamatan: '',
        //     kelurahan: '',
        //     kelurahan_nama: '',
        //     kode_pos: '',
        //     area: '',
        //     kelas_jalan1: '',
        //     kelas_jalan2: '',
        //     lattitude: '',
        //     longitude: '',
        //     nama_person: '',
        //     telepon_person: '',
        //     fax_person: '',
        //     npwp_person: '',
        //     waktu_operasional: []
        // })

        // $(".select2").select2({
        //     width: "100%",
        // })

        $("#addAlamatBaru").modal('show');


    }

    function changeMultipleAlamat(flag, random_id, changeSelect) {

        if (changeSelect != undefined) {
            if (changeSelect == 'flag_alamat') {

                if ($("#listcoorporate-flag-alamat-multiple").val() == 'sama') {
                    var outlet_id = $("#txthideOutletId-update").val();

                    $.ajax({
                        // async: false,
                        type: "POST",
                        url: "<?= base_url('FAS/ManagementPelanggan/Outlet/getClientPTDefault') ?>",
                        data: {
                            id: outlet_id
                        },
                        dataType: "JSON",
                        success: function(response) {
                            var formTemplate = ``;
                            var row = ``;
                            var provinsi = response.header.provinsi;
                            var kota = response.header.kota;
                            var kecamatan = response.header.kecamatan;
                            var kelurahan = response.header.kelurahan_nama;
                            var v = response.header;
                            var readonly = 'readonly disabled';

                            $(`#${random_id}`).text(v.nama_person);

                            formTemplate = `
                                <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                    <div class="form-group txtaddress-coorporate-update-multiple">
                                        <label name="CAPTION-FLAGALAMAT">Flag Alamat</label>
                                        <select onchange="changeMultipleAlamat('${flag}', '${random_id}', 'flag_alamat')" class="form-control" id="listcoorporate-flag-alamat-multiple">
                                            <option value="beda"><label name="CAPTION-BEDA">Beda</label></option>
                                            <option value="sama" selected><label name="CAPTION-SAMA">Sama</label></option>
                                        </select>
                                    </div>

                                    <div class="form-group txtaddress-coorporate-update-multiple">
                                        <label name="CAPTION-ALAMAT">Alamat</label>
                                        <textarea ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" rows="3" id="txtaddress-coorporate-update-multiple" placeholder="Alamat Coorporate">${v.alamat}</textarea>
                                        <div class="invalid-feedback invalid-alamat-corporate-update-multiple"></div>
                                    </div>

                                    <div class="form-group txtphone-coorporate-update-multiple">
                                        <label name="CAPTION-TELEPON">Telepon</label>
                                        <input  ${readonly} type="text" onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="form-control numeric" id="txtphone-coorporate-update-multiple" placeholder="Telepon Coorporate-update" value="${v.telepon}" />
                                        <div class="invalid-feedback invalid-telepon-corporate-update-multiple"></div>
                                    </div>

                                    <div class="form-group listcoorporate-province-update-multiple">
                                        <label name="CAPTION-PROVINSI">Provinsi</label>
                                        <select  ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kota')" class="select2 form-control" id="listcoorporate-province-update-multiple">
                                            <option value="">--<label name="CAPTION-PILIHPROVINSI">Pilih Provinsi</label>--</option>
                                            <?php foreach ($Provinsi as $row) { ?>
                                                <option value="<?= $row['reffregion_nama'] ?>" ${v.provinsi == '<?= $row['reffregion_nama'] ?>' ? 'selected' : ''}><?= $row['reffregion_nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback invalid-provinsi-corporate-update-multiple"></div>
                                    </div>

                                    <div class="form-group listcoorporate-city-update-multiple">
                                        <label name="CAPTION-KOTA">Kota</label>
                                        <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kecamatan')" class="select2 form-control" id="listcoorporate-city-update-multiple">
                                        </select>
                                        <div class="invalid-feedback invalid-kota-corporate-update-multiple"></div>
                                    </div>

                                    <div class="form-group listcoorporate-districts-update-multiple">
                                        <label name="CAPTION-KECAMATAN">Kecamatan</label>
                                        <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kelurahan')" class="select2 form-control" id="listcoorporate-districts-update-multiple">
                                        </select>
                                        <div class="invalid-feedback invalid-kecamatan-corporate-update-multiple"></div>
                                        <input type="hidden" id="data-districts-update-multiple" />
                                    </div>

                                    <div class="form-group listcoorporate-ward-update-multiple">
                                        <label name="CAPTION-KELURAHAN">Kelurahan</label>
                                        <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" id="listcoorporate-ward-update-multiple">
                                        </select>
                                        <div class="invalid-feedback invalid-kelurahan-corporate-update-multiple"></div>
                                        <input type="hidden" id="data-ward-update-multiple" />
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group txtpostalcode-coorporate-update-multiple">
                                                <label name="CAPTION-KODEPOS">Kode Pos</label>
                                                <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric" id="txtpostalcode-coorporate-update-multiple" placeholder="Kode Pos sesuai alamat" value="${v.kode_pos}" />
                                                <div class="invalid-feedback invalid-kode-pos-corporate-update-multiple"></div>
                                            </div>

                                            <div class="form-group listcoorporate-stretclass-update-multiple">
                                                <label name="CAPTION-KELASJALANBERDASARKANBEBANMUATAN">Kelas Jalan
                                                    Berdasarkan Beban muatan</label>
                                                <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" name="listcoorporate-stretclass-update-multiple" id="listcoorporate-stretclass-update-multiple" required>
                                                    <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                                            Jalan</label>--</option>
                                                    <?php foreach ($KelasJalan as $row) { ?>
                                                        <option value="<?= $row['id'] ?>" ${v.kelas_jalan1 == '<?= $row['id'] ?>' ? 'selected' : ''}><?= $row['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback invalid-kelas-jalan-corporate-update-multiple"></div>
                                            </div>
                                            <div class="form-group txtlattitude-coorporate-update-multiple">
                                                <label name="CAPTION-LATTITUDE">Lattitude</label>
                                                <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric-coma" id="txtlattitude-coorporate-update-multiple" placeholder="Lattitude Coorporate" value="${v.lattitude}" />
                                                <div class="invalid-feedback invalid-lattitude-corporate-update-multiple"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group listcoorporate-area-update-multiple">
                                                <label name="CAPTION-AREA">Area</label>
                                                <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" id="listcoorporate-area-update-multiple">
                                                    <option value="">--<label name="CAPTION-PILIHAREA">Pilih Area</label>--
                                                    </option>
                                                    <?php foreach ($Area as $row) { ?>
                                                        <option value="<?= $row['id'] ?>" ${v.area == '<?= $row['id'] ?>' ? 'selected' : ''}><?= $row['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback invalid-area-corporate-update-multiple"></div>
                                            </div>
                                            <div class="form-group listcoorporate-stretclass2-update-multiple">
                                                <label name="CAPTION-KELASJALANBERDASARKANFUNGSIJALAN">Kelas Jalan
                                                    Berdasarkan Fungsi jalan</label>
                                                <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" name="listcoorporate-stretclass2-update-multiple" id="listcoorporate-stretclass2-update-multiple" required>
                                                    <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                                            Jalan</label>--</option>
                                                    <?php foreach ($KelasJalan2 as $row) { ?>
                                                        <option value="<?= $row['id'] ?>" ${v.kelas_jalan2 == '<?= $row['id'] ?>' ? 'selected' : ''}><?= $row['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback invalid-kelas-jalan2-corporate-update-multiple"></div>
                                            </div>
                                            <div class="form-group txtlongitude-coorporate-update-multiple">
                                                <label name="CAPTION-LONGITUDE">Longitude</label>
                                                <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric-coma" id="txtlongitude-coorporate-update-multiple" placeholder="Longitude Coorporate" value="${v.lattitude}" />
                                                <div class="invalid-feedback invalid-longitude-corporate-update-multiple"></div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                        <h5 class="text-center badge badge-info" name="CAPTION-CONTACTPERSON">Contact Person
                                        </h5>

                                        <div class="form-group txtname-contact-person-update-multiple">
                                            <label name="CAPTION-NAMA">Nama</label>
                                            <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" id="txtname-contact-person-update-multiple" placeholder="Nama Contact Person" value="${v.nama_person}" />
                                            <div class="invalid-feedback invalid-nama-contact-person-update-multiple"></div>
                                        </div>

                                        <div class="form-group txtphone-contact-person-update-multiple">
                                            <label name="CAPTION-TELEPON">Telepon</label>
                                            <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric" id="txtphone-contact-person-update-multiple" placeholder="Telepon Contact Person" value="${v.telepon_person}" />
                                            <div class="invalid-feedback invalid-telepon-contact-person-update-multiple"></div>
                                        </div>

                                        <div class="form-group txtphone-contact-person">
                                            <label name="CAPTION-FAX">Fax</label>
                                            <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" name="listcontactperson-client_pt_fax-update-multiple" id="listcontactperson-client_pt_fax-update-multiple" placeholder="Fax" value="${v.fax_person}" />
                                            <div class="invalid-feedback invalid-client_pt_fax-update-multiple"></div>
                                        </div>

                                        <div class="form-group txtphone-contact-person">
                                            <label name="CAPTION-NPWP">NPWP</label>
                                            <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" name="listcontactperson-client_pt_npwp-update-multiple" id="listcontactperson-client_pt_npwp-update-multiple" placeholder="NPWP" required value="${v.npwp_person}" />
                                            <div class="invalid-feedback invalid-client_pt_npwp-update-multiple"></div>
                                        </div>

                                        <div class="form-group">
                                            <label name="CAPTION-WAKTUOPERASIONAL">Waktu Operasional</label>
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="list-day-operasional-update-multiple">
                                                    <thead>
                                                        <tr>
                                                            <td width="5%" name="CAPTION-NO">No.</td>
                                                            <td width="10%" name="CAPTION-HARI">Hari</td>
                                                            <td width="10%" name="CAPTION-JAMBUKA">Jam Buka</td>
                                                            <td width="10%" name="CAPTION-JAMTUTUP">Jam Tutup</td>
                                                            <td width="30%" name="CAPTION-STATUS">Status</td>
                                                            <td width="10%" name="CAPTION-PENGIRIMAN">Pengiriman</td>
                                                            <td width="10%" name="CAPTION-PENAGIHAN">Penagihan</td>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($Day as $key => $value) { ?>
                                                                <tr>
                                                                    <td><?= $key ?></td>
                                                                    <td><?= $value ?></td>
                                                                    <td><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-buka" name="jam-buka" />
                                                                    </td>
                                                                    <td><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-tutup" name="jam-tutup" /></td>
                                                                    <td>
                                                                        <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="form-control" id="status-operasional" name="status-operasional">
                                                                            <option value="1" selected>BUKA</option>
                                                                            <option value="0">TUTUP</option>
                                                                        </select>
                                                                    </td>
                                                                    <td style="vertical-align:middle; text-align: center;"><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="checkbox" id="chk_pengiriman" name="chk_pengiriman" /></td>
                                                                    <td style="vertical-align:middle; text-align: center;"><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="checkbox" id="chk_penagihan" name="chk_penagihan" /></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>`;

                            // Ambil waktu_operasional dari alamat yang sesuai
                            var waktu_operasional = response.detail;

                            // Iterasi waktu_operasional dan tambahkan ke dalam tabel
                            $.each(waktu_operasional, function(index, value) {
                                row += `
                                <tr>
                                    <td>${value.no_urut}</td>
                                    <td>${value.hari}</td>
                                    <td><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-buka" name="jam-buka" value="${value.jam_buka}" /></td>
                                    <td><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-tutup" name="jam-tutup" value="${value.jam_tutup}" /></td>
                                    <td>
                                        <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="form-control" id="status-operasional" name="status-operasional">
                                            <option value="1" ${value.status == '1' ? 'selected' : ''}>BUKA</option>
                                            <option value="0" ${value.status == '0' ? 'selected' : ''}>TUTUP</option>
                                        </select>
                                    </td>
                                    <td style="vertical-align:middle; text-align: center;">
                                        <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" ${readonly} type="checkbox" id="chk_pengiriman" name="chk_pengiriman" ${value.pengiriman == 1 ? 'checked' : ''} />
                                    </td>
                                    <td style="vertical-align:middle; text-align: center;">
                                        <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" ${readonly} type="checkbox" id="chk_penagihan" name="chk_penagihan" ${value.penagihan == 1 ? 'checked' : ''} />
                                    </td>
                                </tr>
                            `;
                            });

                            $("#formMultipleAlamat").empty().html(formTemplate);

                            if (row != '') {
                                $("#list-day-operasional-update-multiple tbody").empty().html(row);
                            }

                            changePKKK(provinsi, kota, kecamatan, kelurahan)

                            $(".select2").select2({
                                width: "100%",
                            })

                            const fieldsMapping = {
                                flag2: "#listcoorporate-flag-alamat-multiple",
                                alamat: "#txtaddress-coorporate-update-multiple",
                                telepon: "#txtphone-coorporate-update-multiple",
                                provinsi: "#listcoorporate-province-update-multiple",
                                kota: "#listcoorporate-city-update-multiple",
                                kecamatan: "#listcoorporate-districts-update-multiple",
                                kecamatan_nama: "#listcoorporate-districts-update-multiple",
                                kelurahan: "#listcoorporate-ward-update-multiple",
                                kelurahan_nama: "#listcoorporate-ward-update-multiple",
                                kode_pos: "#txtpostalcode-coorporate-update-multiple",
                                area: "#listcoorporate-area-update-multiple",
                                kelas_jalan1: "#listcoorporate-stretclass-update-multiple",
                                kelas_jalan2: "#listcoorporate-stretclass2-update-multiple",
                                lattitude: "#txtlattitude-coorporate-update-multiple",
                                longitude: "#txtlongitude-coorporate-update-multiple",
                                nama_person: "#txtname-contact-person-update-multiple",
                                telepon_person: "#txtphone-contact-person-update-multiple",
                                fax_person: "#listcontactperson-client_pt_fax-update-multiple",
                                npwp_person: "#listcontactperson-client_pt_npwp-update-multiple"
                            };

                            $(arr_multiple_alamat).each(function(i, v) {
                                if (v.flag.includes(flag) && v.random_id == random_id) {

                                    $.each(fieldsMapping, function(key, selector) {

                                        if (key == 'kelurahan_nama') {
                                            arr_multiple_alamat[i][key] = response.header.kelurahan_nama;
                                        } else if (key == 'kecamatan_nama') {
                                            arr_multiple_alamat[i][key] = response.header.kecamatan_nama;
                                        } else if (key == 'kecamatan') {
                                            arr_multiple_alamat[i][key] = response.header.kecamatan;
                                        } else if (key == 'kelurahan') {
                                            arr_multiple_alamat[i][key] = response.header.kelurahan;
                                        } else if (key == 'kota') {
                                            arr_multiple_alamat[i][key] = response.header.kota;
                                        } else {
                                            arr_multiple_alamat[i][key] = $(selector).val();
                                        }
                                    })

                                    arr_multiple_alamat[i]['waktu_operasional'] = [];

                                    $("#list-day-operasional-update-multiple tbody tr").each(function() {
                                        var no_urut = $(this).find("td:eq(0)").text();
                                        var hari = $(this).find("td:eq(1)").text();
                                        var jam_buka = $(this).find("td:eq(2) input").val();
                                        var jam_tutup = $(this).find("td:eq(3) input").val();
                                        var status = $(this).find("td:eq(4) select").val();
                                        var pengiriman = $(this).find("td:eq(5) input").prop("checked") ? '1' : '0';
                                        var penagihan = $(this).find("td:eq(6) input").prop("checked") ? '1' : '0';

                                        arr_multiple_alamat[i]['waktu_operasional'].push({
                                            no_urut: no_urut,
                                            hari: hari,
                                            jam_buka: jam_buka,
                                            jam_tutup: jam_tutup,
                                            status: status,
                                            pengiriman: pengiriman,
                                            penagihan: penagihan
                                        })
                                    })

                                }
                            })

                        }
                    });
                } else {
                    var formTemplate = `<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                            <div class="form-group txtaddress-coorporate-update-multiple">
                                <label name="CAPTION-FLAGALAMAT">Flag Alamat</label>
                                <select onchange="changeMultipleAlamat('${flag}', '${random_id}', 'flag_alamat')" class="form-control" id="listcoorporate-flag-alamat-multiple">
                                    <option value="beda"><label name="CAPTION-BEDA">Beda</label></option>
                                    <option value="sama"><label name="CAPTION-SAMA">Sama</label></option>
                                </select>
                            </div>

                            <div class="form-group txtaddress-coorporate-update-multiple">
                                <label name="CAPTION-ALAMAT">Alamat</label>
                                <textarea onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" rows="3" id="txtaddress-coorporate-update-multiple" placeholder="Alamat Coorporate"></textarea>
                                <div class="invalid-feedback invalid-alamat-corporate-update-multiple"></div>
                            </div>

                            <div class="form-group txtphone-coorporate-update-multiple">
                                <label name="CAPTION-TELEPON">Telepon</label>
                                <input type="text" onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="form-control numeric" id="txtphone-coorporate-update-multiple" placeholder="Telepon Coorporate-update" />
                                <div class="invalid-feedback invalid-telepon-corporate-update-multiple"></div>
                            </div>

                            <div class="form-group listcoorporate-province-update-multiple">
                                <label name="CAPTION-PROVINSI">Provinsi</label>
                                <select onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kota')" class="select2 form-control" id="listcoorporate-province-update-multiple">
                                    <option value="">--<label name="CAPTION-PILIHPROVINSI">Pilih Provinsi</label>--</option>
                                    <?php foreach ($Provinsi as $row) { ?>
                                        <option value="<?= $row['reffregion_nama'] ?>"><?= $row['reffregion_nama'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback invalid-provinsi-corporate-update-multiple"></div>
                            </div>

                            <div class="form-group listcoorporate-city-update-multiple">
                                <label name="CAPTION-KOTA">Kota</label>
                                <select onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kecamatan')" class="select2 form-control" id="listcoorporate-city-update-multiple">
                                </select>
                                <div class="invalid-feedback invalid-kota-corporate-update-multiple"></div>
                            </div>

                            <div class="form-group listcoorporate-districts-update-multiple">
                                <label name="CAPTION-KECAMATAN">Kecamatan</label>
                                <select onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kelurahan')" class="select2 form-control" id="listcoorporate-districts-update-multiple">
                                </select>
                                <div class="invalid-feedback invalid-kecamatan-corporate-update-multiple"></div>
                                <input type="hidden" id="data-districts-update-multiple" />
                            </div>

                            <div class="form-group listcoorporate-ward-update-multiple">
                                <label name="CAPTION-KELURAHAN">Kelurahan</label>
                                <select onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" id="listcoorporate-ward-update-multiple">
                                </select>
                                <div class="invalid-feedback invalid-kelurahan-corporate-update-multiple"></div>
                                <input type="hidden" id="data-ward-update-multiple" />
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                    <div class="form-group txtpostalcode-coorporate-update-multiple">
                                        <label name="CAPTION-KODEPOS">Kode Pos</label>
                                        <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric" id="txtpostalcode-coorporate-update-multiple" placeholder="Kode Pos sesuai alamat" />
                                        <div class="invalid-feedback invalid-kode-pos-corporate-update-multiple"></div>
                                    </div>

                                    <div class="form-group listcoorporate-stretclass-update-multiple">
                                        <label name="CAPTION-KELASJALANBERDASARKANBEBANMUATAN">Kelas Jalan
                                            Berdasarkan Beban muatan</label>
                                        <select onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" name="listcoorporate-stretclass-update-multiple" id="listcoorporate-stretclass-update-multiple" required>
                                            <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                                    Jalan</label>--</option>
                                            <?php foreach ($KelasJalan as $row) { ?>
                                                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback invalid-kelas-jalan-corporate-update-multiple"></div>
                                    </div>
                                    <div class="form-group txtlattitude-coorporate-update-multiple">
                                        <label name="CAPTION-LATTITUDE">Lattitude</label>
                                        <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric-coma" id="txtlattitude-coorporate-update-multiple" placeholder="Lattitude Coorporate" />
                                        <div class="invalid-feedback invalid-lattitude-corporate-update-multiple"></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                    <div class="form-group listcoorporate-area-update-multiple">
                                        <label name="CAPTION-AREA">Area</label>
                                        <select onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" id="listcoorporate-area-update-multiple">
                                            <option value="">--<label name="CAPTION-PILIHAREA">Pilih Area</label>--
                                            </option>
                                            <?php foreach ($Area as $row) { ?>
                                                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback invalid-area-corporate-update-multiple"></div>
                                    </div>
                                    <div class="form-group listcoorporate-stretclass2-update-multiple">
                                        <label name="CAPTION-KELASJALANBERDASARKANFUNGSIJALAN">Kelas Jalan
                                            Berdasarkan Fungsi jalan</label>
                                        <select onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" name="listcoorporate-stretclass2-update-multiple" id="listcoorporate-stretclass2-update-multiple" required>
                                            <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                                    Jalan</label>--</option>
                                            <?php foreach ($KelasJalan2 as $row) { ?>
                                                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback invalid-kelas-jalan2-corporate-update-multiple"></div>
                                    </div>
                                    <div class="form-group txtlongitude-coorporate-update-multiple">
                                        <label name="CAPTION-LONGITUDE">Longitude</label>
                                        <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric-coma" id="txtlongitude-coorporate-update-multiple" placeholder="Longitude Coorporate" />
                                        <div class="invalid-feedback invalid-longitude-corporate-update-multiple"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                <h5 class="text-center badge badge-info" name="CAPTION-CONTACTPERSON">Contact Person
                                </h5>

                                <div class="form-group txtname-contact-person-update-multiple">
                                    <label name="CAPTION-NAMA">Nama</label>
                                    <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" id="txtname-contact-person-update-multiple" placeholder="Nama Contact Person" />
                                    <div class="invalid-feedback invalid-nama-contact-person-update-multiple"></div>
                                </div>

                                <div class="form-group txtphone-contact-person-update-multiple">
                                    <label name="CAPTION-TELEPON">Telepon</label>
                                    <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric" id="txtphone-contact-person-update-multiple" placeholder="Telepon Contact Person" />
                                    <div class="invalid-feedback invalid-telepon-contact-person-update-multiple"></div>
                                </div>

                                <div class="form-group txtphone-contact-person">
                                    <label name="CAPTION-FAX">Fax</label>
                                    <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" name="listcontactperson-client_pt_fax-update-multiple" id="listcontactperson-client_pt_fax-update-multiple" placeholder="Fax" required />
                                    <div class="invalid-feedback invalid-client_pt_fax-update-multiple"></div>
                                </div>

                                <div class="form-group txtphone-contact-person">
                                    <label name="CAPTION-NPWP">NPWP</label>
                                    <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" name="listcontactperson-client_pt_npwp-update-multiple" id="listcontactperson-client_pt_npwp-update-multiple" placeholder="NPWP" required />
                                    <div class="invalid-feedback invalid-client_pt_npwp-update-multiple"></div>
                                </div>

                                <div class="form-group">
                                    <label name="CAPTION-WAKTUOPERASIONAL">Waktu Operasional</label>
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="list-day-operasional-update-multiple">
                                            <thead>
                                                <tr>
                                                    <td width="5%" name="CAPTION-NO">No.</td>
                                                    <td width="10%" name="CAPTION-HARI">Hari</td>
                                                    <td width="10%" name="CAPTION-JAMBUKA">Jam Buka</td>
                                                    <td width="10%" name="CAPTION-JAMTUTUP">Jam Tutup</td>
                                                    <td width="30%" name="CAPTION-STATUS">Status</td>
                                                    <td width="10%" name="CAPTION-PENGIRIMAN">Pengiriman</td>
                                                    <td width="10%" name="CAPTION-PENAGIHAN">Penagihan</td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php foreach ($Day as $key => $value) { ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td><?= $value ?></td>
                                                            <td><input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-buka" name="jam-buka" />
                                                            </td>
                                                            <td><input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-tutup" name="jam-tutup" /></td>
                                                            <td>
                                                                <select onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="form-control" id="status-operasional" name="status-operasional">
                                                                    <option value="1" selected>BUKA</option>
                                                                    <option value="0">TUTUP</option>
                                                                </select>
                                                            </td>
                                                            <td style="vertical-align:middle; text-align: center;"><input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="checkbox" id="chk_pengiriman" name="chk_pengiriman" /></td>
                                                            <td style="vertical-align:middle; text-align: center;"><input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="checkbox" id="chk_penagihan" name="chk_penagihan" /></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>`;

                    $("#formMultipleAlamat").empty().html(formTemplate);

                    $(`#${random_id}`).text('Alamat Baru');

                    $(".select2").select2({
                        width: "100%",
                    })

                    const fieldsMapping = {
                        flag2: "#listcoorporate-flag-alamat-multiple",
                        alamat: "#txtaddress-coorporate-update-multiple",
                        telepon: "#txtphone-coorporate-update-multiple",
                        provinsi: "#listcoorporate-province-update-multiple",
                        kota: "#listcoorporate-city-update-multiple",
                        kecamatan: "#listcoorporate-districts-update-multiple",
                        kecamatan_nama: "#listcoorporate-districts-update-multiple",
                        kelurahan: "#listcoorporate-ward-update-multiple",
                        kelurahan_nama: "#listcoorporate-ward-update-multiple",
                        kode_pos: "#txtpostalcode-coorporate-update-multiple",
                        area: "#listcoorporate-area-update-multiple",
                        kelas_jalan1: "#listcoorporate-stretclass-update-multiple",
                        kelas_jalan2: "#listcoorporate-stretclass2-update-multiple",
                        lattitude: "#txtlattitude-coorporate-update-multiple",
                        longitude: "#txtlongitude-coorporate-update-multiple",
                        nama_person: "#txtname-contact-person-update-multiple",
                        telepon_person: "#txtphone-contact-person-update-multiple",
                        fax_person: "#listcontactperson-client_pt_fax-update-multiple",
                        npwp_person: "#listcontactperson-client_pt_npwp-update-multiple"
                    };

                    $(arr_multiple_alamat).each(function(i, v) {
                        if (v.flag.includes(flag) && v.random_id == random_id) {

                            $.each(fieldsMapping, function(key, selector) {
                                if (key == 'kelurahan_nama') {
                                    arr_multiple_alamat[i][key] = $(selector + " option:selected").text();
                                } else if (key == 'kecamatan_nama') {
                                    arr_multiple_alamat[i][key] = $(selector + " option:selected").text();
                                } else {
                                    arr_multiple_alamat[i][key] = $(selector).val();
                                }
                            })

                            arr_multiple_alamat[i]['waktu_operasional'] = [];

                            $("#list-day-operasional-update-multiple tbody tr").each(function() {
                                var no_urut = $(this).find("td:eq(0)").text();
                                var hari = $(this).find("td:eq(1)").text();
                                var jam_buka = $(this).find("td:eq(2) input").val();
                                var jam_tutup = $(this).find("td:eq(3) input").val();
                                var status = $(this).find("td:eq(4) select").val();
                                var pengiriman = $(this).find("td:eq(5) input").prop("checked") ? '1' : '0';
                                var penagihan = $(this).find("td:eq(6) input").prop("checked") ? '1' : '0';

                                arr_multiple_alamat[i]['waktu_operasional'].push({
                                    no_urut: no_urut,
                                    hari: hari,
                                    jam_buka: jam_buka,
                                    jam_tutup: jam_tutup,
                                    status: status,
                                    pengiriman: pengiriman,
                                    penagihan: penagihan
                                })
                            })

                        }
                    })

                }

                return false;
            } else {
                changeSelectMultipleAlamat(changeSelect);
            }
        }

        var name_person = $("#txtname-contact-person-update-multiple").val();
        if (name_person != '') {
            $(`#${random_id}`).text(name_person);
        }

        const fieldsMapping = {
            alamat: "#txtaddress-coorporate-update-multiple",
            telepon: "#txtphone-coorporate-update-multiple",
            provinsi: "#listcoorporate-province-update-multiple",
            kota: "#listcoorporate-city-update-multiple",
            kecamatan: "#listcoorporate-districts-update-multiple",
            kecamatan_nama: "#listcoorporate-districts-update-multiple",
            kelurahan: "#listcoorporate-ward-update-multiple",
            kelurahan_nama: "#listcoorporate-ward-update-multiple",
            kode_pos: "#txtpostalcode-coorporate-update-multiple",
            area: "#listcoorporate-area-update-multiple",
            kelas_jalan1: "#listcoorporate-stretclass-update-multiple",
            kelas_jalan2: "#listcoorporate-stretclass2-update-multiple",
            lattitude: "#txtlattitude-coorporate-update-multiple",
            longitude: "#txtlongitude-coorporate-update-multiple",
            nama_person: "#txtname-contact-person-update-multiple",
            telepon_person: "#txtphone-contact-person-update-multiple",
            fax_person: "#listcontactperson-client_pt_fax-update-multiple",
            npwp_person: "#listcontactperson-client_pt_npwp-update-multiple"
        };

        $(arr_multiple_alamat).each(function(i, v) {
            if (v.flag.includes(flag) && v.random_id == random_id) {

                $.each(fieldsMapping, function(key, selector) {

                    if (key == 'kelurahan_nama') {
                        arr_multiple_alamat[i][key] = $(selector + " option:selected").text();

                    } else if (key == 'kecamatan_nama') {
                        arr_multiple_alamat[i][key] = $(selector + " option:selected").text();
                    } else {
                        arr_multiple_alamat[i][key] = $(selector).val();
                    }
                })

                arr_multiple_alamat[i]['waktu_operasional'] = [];

                $("#list-day-operasional-update-multiple tbody tr").each(function() {
                    var no_urut = $(this).find("td:eq(0)").text();
                    var hari = $(this).find("td:eq(1)").text();
                    var jam_buka = $(this).find("td:eq(2) input").val();
                    var jam_tutup = $(this).find("td:eq(3) input").val();
                    var status = $(this).find("td:eq(4) select").val();
                    var pengiriman = $(this).find("td:eq(5) input").prop("checked") ? '1' : '0';
                    var penagihan = $(this).find("td:eq(6) input").prop("checked") ? '1' : '0';

                    arr_multiple_alamat[i]['waktu_operasional'].push({
                        no_urut: no_urut,
                        hari: hari,
                        jam_buka: jam_buka,
                        jam_tutup: jam_tutup,
                        status: status,
                        pengiriman: pengiriman,
                        penagihan: penagihan
                    })
                })

            }
        })

    }

    function changeSelectMultipleAlamat(changeSelect) {
        if (changeSelect == 'kota') {
            $("#listcoorporate-city-update-multiple").empty();
            $("#listcoorporate-districts-update-multiple").empty();
            $("#listcoorporate-ward-update-multiple").empty();

            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kota') ?>",
                data: {
                    id: $("#listcoorporate-province-update-multiple").val(),
                    kota: null
                },
                dataType: "JSON",
                success: function(response) {
                    $("#listcoorporate-city-update-multiple").html(response);
                }
            });
        } else if (changeSelect == 'kecamatan') {
            $("#listcoorporate-districts-update-multiple").empty();
            $("#listcoorporate-ward-update-multiple").empty();

            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kecamatan') ?>",
                data: {
                    id: $("#listcoorporate-city-update-multiple").val(),
                    provinsi: $("#listcoorporate-province-update-multiple").val(),
                    kecamatan: null
                },
                dataType: "JSON",
                success: function(response) {
                    $("#listcoorporate-districts-update-multiple").html(response)
                }
            });
        } else if (changeSelect == 'kelurahan') {
            $("#listcoorporate-ward-update-multiple").empty();

            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kelurahan') ?>",
                data: {
                    id: $("#listcoorporate-districts-update-multiple").val(),
                    kelurahan: null
                },
                dataType: "JSON",
                success: function(response) {
                    $("#listcoorporate-ward-update-multiple").html(response)
                }
            });
        }
    }

    function addAddressBtn() {
        var random_id = generateRandomId(10);

        $(".alamat-btn").removeClass("btn-primary");
        $(".alamat-btn").addClass("btn-secondary");

        var flag = $("#header_flag").val();
        var client_pt_principle_id = $("#header_client_pt_principle_id").val();


        var total = arr_multiple_alamat.filter((value) => value.flag == flag).length + 1;

        $("#tab_alamat").append(`
            <button class="btn btn-primary alamat-btn" onclick="viewMultipleAlamat(this, '${random_id}')"><label id="${random_id}">Alamat Baru</label> &nbsp;
                        <i class="fa-regular fa-circle-xmark" onclick="deleteMultipleAlamat(this, event, '${random_id}')" style="color: red;" data-action="delete"></i>
            </button>
        `)

        const formTemplate = `<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                <div class="form-group txtaddress-coorporate-update-multiple">
                    <label name="CAPTION-FLAGALAMAT">Flag Alamat</label>
                    <select onchange="changeMultipleAlamat('${flag}', '${random_id}', 'flag_alamat')" class="form-control" id="listcoorporate-flag-alamat-multiple">
                        <option value="beda"><label name="CAPTION-BEDA">Beda</label></option>
                        <option value="sama"><label name="CAPTION-SAMA">Sama</label></option>
                    </select>
                </div>

                <div class="form-group txtaddress-coorporate-update-multiple">
                    <label name="CAPTION-ALAMAT">Alamat</label>
                    <textarea onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" rows="3" id="txtaddress-coorporate-update-multiple" placeholder="Alamat Coorporate"></textarea>
                    <div class="invalid-feedback invalid-alamat-corporate-update-multiple"></div>
                </div>

                <div class="form-group txtphone-coorporate-update-multiple">
                    <label name="CAPTION-TELEPON">Telepon</label>
                    <input type="text" onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="form-control numeric" id="txtphone-coorporate-update-multiple" placeholder="Telepon Coorporate-update" />
                    <div class="invalid-feedback invalid-telepon-corporate-update-multiple"></div>
                </div>

                <div class="form-group listcoorporate-province-update-multiple">
                    <label name="CAPTION-PROVINSI">Provinsi</label>
                    <select onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kota')" class="select2 form-control" id="listcoorporate-province-update-multiple">
                        <option value="">--<label name="CAPTION-PILIHPROVINSI">Pilih Provinsi</label>--</option>
                        <?php foreach ($Provinsi as $row) { ?>
                            <option value="<?= $row['reffregion_nama'] ?>"><?= $row['reffregion_nama'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback invalid-provinsi-corporate-update-multiple"></div>
                </div>

                <div class="form-group listcoorporate-city-update-multiple">
                    <label name="CAPTION-KOTA">Kota</label>
                    <select onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kecamatan')" class="select2 form-control" id="listcoorporate-city-update-multiple">
                    </select>
                    <div class="invalid-feedback invalid-kota-corporate-update-multiple"></div>
                </div>

                <div class="form-group listcoorporate-districts-update-multiple">
                    <label name="CAPTION-KECAMATAN">Kecamatan</label>
                    <select onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kelurahan')" class="select2 form-control" id="listcoorporate-districts-update-multiple">
                    </select>
                    <div class="invalid-feedback invalid-kecamatan-corporate-update-multiple"></div>
                    <input type="hidden" id="data-districts-update-multiple" />
                </div>

                <div class="form-group listcoorporate-ward-update-multiple">
                    <label name="CAPTION-KELURAHAN">Kelurahan</label>
                    <select onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" id="listcoorporate-ward-update-multiple">
                    </select>
                    <div class="invalid-feedback invalid-kelurahan-corporate-update-multiple"></div>
                    <input type="hidden" id="data-ward-update-multiple" />
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group txtpostalcode-coorporate-update-multiple">
                            <label name="CAPTION-KODEPOS">Kode Pos</label>
                            <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric" id="txtpostalcode-coorporate-update-multiple" placeholder="Kode Pos sesuai alamat" />
                            <div class="invalid-feedback invalid-kode-pos-corporate-update-multiple"></div>
                        </div>

                        <div class="form-group listcoorporate-stretclass-update-multiple">
                            <label name="CAPTION-KELASJALANBERDASARKANBEBANMUATAN">Kelas Jalan
                                Berdasarkan Beban muatan</label>
                            <select onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" name="listcoorporate-stretclass-update-multiple" id="listcoorporate-stretclass-update-multiple" required>
                                <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                        Jalan</label>--</option>
                                <?php foreach ($KelasJalan as $row) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback invalid-kelas-jalan-corporate-update-multiple"></div>
                        </div>
                        <div class="form-group txtlattitude-coorporate-update-multiple">
                            <label name="CAPTION-LATTITUDE">Lattitude</label>
                            <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric-coma" id="txtlattitude-coorporate-update-multiple" placeholder="Lattitude Coorporate" />
                            <div class="invalid-feedback invalid-lattitude-corporate-update-multiple"></div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group listcoorporate-area-update-multiple">
                            <label name="CAPTION-AREA">Area</label>
                            <select onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" id="listcoorporate-area-update-multiple">
                                <option value="">--<label name="CAPTION-PILIHAREA">Pilih Area</label>--
                                </option>
                                <?php foreach ($Area as $row) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback invalid-area-corporate-update-multiple"></div>
                        </div>
                        <div class="form-group listcoorporate-stretclass2-update-multiple">
                            <label name="CAPTION-KELASJALANBERDASARKANFUNGSIJALAN">Kelas Jalan
                                Berdasarkan Fungsi jalan</label>
                            <select onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" name="listcoorporate-stretclass2-update-multiple" id="listcoorporate-stretclass2-update-multiple" required>
                                <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                        Jalan</label>--</option>
                                <?php foreach ($KelasJalan2 as $row) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback invalid-kelas-jalan2-corporate-update-multiple"></div>
                        </div>
                        <div class="form-group txtlongitude-coorporate-update-multiple">
                            <label name="CAPTION-LONGITUDE">Longitude</label>
                            <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric-coma" id="txtlongitude-coorporate-update-multiple" placeholder="Longitude Coorporate" />
                            <div class="invalid-feedback invalid-longitude-corporate-update-multiple"></div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                    <h5 class="text-center badge badge-info" name="CAPTION-CONTACTPERSON">Contact Person
                    </h5>

                    <div class="form-group txtname-contact-person-update-multiple">
                        <label name="CAPTION-NAMA">Nama</label>
                        <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" id="txtname-contact-person-update-multiple" placeholder="Nama Contact Person" />
                        <div class="invalid-feedback invalid-nama-contact-person-update-multiple"></div>
                    </div>

                    <div class="form-group txtphone-contact-person-update-multiple">
                        <label name="CAPTION-TELEPON">Telepon</label>
                        <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric" id="txtphone-contact-person-update-multiple" placeholder="Telepon Contact Person" />
                        <div class="invalid-feedback invalid-telepon-contact-person-update-multiple"></div>
                    </div>

                    <div class="form-group txtphone-contact-person">
                        <label name="CAPTION-FAX">Fax</label>
                        <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" name="listcontactperson-client_pt_fax-update-multiple" id="listcontactperson-client_pt_fax-update-multiple" placeholder="Fax" required />
                        <div class="invalid-feedback invalid-client_pt_fax-update-multiple"></div>
                    </div>

                    <div class="form-group txtphone-contact-person">
                        <label name="CAPTION-NPWP">NPWP</label>
                        <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" name="listcontactperson-client_pt_npwp-update-multiple" id="listcontactperson-client_pt_npwp-update-multiple" placeholder="NPWP" required />
                        <div class="invalid-feedback invalid-client_pt_npwp-update-multiple"></div>
                    </div>

                    <div class="form-group">
                        <label name="CAPTION-WAKTUOPERASIONAL">Waktu Operasional</label>
                        <div class="table-responsive">
                            <table class="table table-striped" id="list-day-operasional-update-multiple">
                                <thead>
                                    <tr>
                                        <td width="5%" name="CAPTION-NO">No.</td>
                                        <td width="10%" name="CAPTION-HARI">Hari</td>
                                        <td width="10%" name="CAPTION-JAMBUKA">Jam Buka</td>
                                        <td width="10%" name="CAPTION-JAMTUTUP">Jam Tutup</td>
                                        <td width="30%" name="CAPTION-STATUS">Status</td>
                                        <td width="10%" name="CAPTION-PENGIRIMAN">Pengiriman</td>
                                        <td width="10%" name="CAPTION-PENAGIHAN">Penagihan</td>

                                    </tr>
                                </thead>
                                  <tbody>
                                        <?php foreach ($Day as $key => $value) { ?>
                                            <tr>
                                                <td><?= $key ?></td>
                                                <td><?= $value ?></td>
                                                <td><input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-buka" name="jam-buka" />
                                                </td>
                                                <td><input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-tutup" name="jam-tutup" /></td>
                                                <td>
                                                    <select onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="form-control" id="status-operasional" name="status-operasional">
                                                        <option value="1" selected>BUKA</option>
                                                        <option value="0">TUTUP</option>
                                                    </select>
                                                </td>
                                                <td style="vertical-align:middle; text-align: center;"><input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="checkbox" id="chk_pengiriman" name="chk_pengiriman" /></td>
                                                <td style="vertical-align:middle; text-align: center;"><input onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="checkbox" id="chk_penagihan" name="chk_penagihan" /></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>`;

        $("#formMultipleAlamat").empty().html(formTemplate);

        $(".select2").select2({
            width: "100%",
        })

        arr_multiple_alamat.push({
            client_pt_principle_id: client_pt_principle_id,
            flag: flag,
            flag2: 'beda',
            random_id: random_id,
            alamat: '',
            telepon: '',
            provinsi: '',
            kota: '',
            kecamatan: '',
            kecamatan_nama: '',
            kelurahan: '',
            kelurahan_nama: '',
            kode_pos: '',
            area: '',
            kelas_jalan1: '',
            kelas_jalan2: '',
            lattitude: '',
            longitude: '',
            nama_person: '',
            telepon_person: '',
            fax_person: '',
            npwp_person: '',
            waktu_operasional: []
        })
    }

    function viewMultipleAlamat(button, random_id) {

        $(".alamat-btn").removeClass("btn-primary");
        $(".alamat-btn").addClass("btn-secondary");
        $(button).addClass("btn-primary");

        var flag = $("#header_flag").val();
        $("#header_random_id").val(random_id);

        var formTemplate = ``;
        var row = ``;
        var provinsi = ``;
        var kota = ``;
        var kecamatan = ``;
        var kelurahan = ``;
        var readonly = '';

        $.each(arr_multiple_alamat, function(i, v) {

            if (v.flag.includes(flag) && random_id == v.random_id) {
                provinsi = v.provinsi;
                kota = v.kota;
                kecamatan = v.kecamatan;
                kelurahan = v.kelurahan_nama;
                readonly = v.flag2 == 'sama' ? 'readonly disabled' : ''

                formTemplate = `
              <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                <div class="form-group txtaddress-coorporate-update-multiple">
                    <label name="CAPTION-FLAGALAMAT">Flag Alamat</label>
                    <select onchange="changeMultipleAlamat('${flag}', '${random_id}', 'flag_alamat')" class="form-control" id="listcoorporate-flag-alamat-multiple">
                        <option value="beda" ${v.flag2 == 'beda' ? 'selected' : ''}><label name="CAPTION-BEDA">Beda</label></option>
                        <option value="sama" ${v.flag2 == 'sama' ? 'selected' : ''}><label name="CAPTION-SAMA">Sama</label></option>
                    </select>
                </div>

                <div class="form-group txtaddress-coorporate-update-multiple">
                    <label name="CAPTION-ALAMAT">Alamat</label>
                    <textarea ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" rows="3" id="txtaddress-coorporate-update-multiple" placeholder="Alamat Coorporate">${v.alamat}</textarea>
                    <div class="invalid-feedback invalid-alamat-corporate-update-multiple"></div>
                </div>

                <div class="form-group txtphone-coorporate-update-multiple">
                    <label name="CAPTION-TELEPON">Telepon</label>
                    <input  ${readonly} type="text" onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="form-control numeric" id="txtphone-coorporate-update-multiple" placeholder="Telepon Coorporate-update" value="${v.telepon}" />
                    <div class="invalid-feedback invalid-telepon-corporate-update-multiple"></div>
                </div>

                <div class="form-group listcoorporate-province-update-multiple">
                    <label name="CAPTION-PROVINSI">Provinsi</label>
                    <select  ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kota')" class="select2 form-control" id="listcoorporate-province-update-multiple">
                        <option value="">--<label name="CAPTION-PILIHPROVINSI">Pilih Provinsi</label>--</option>
                        <?php foreach ($Provinsi as $row) { ?>
                            <option value="<?= $row['reffregion_nama'] ?>" ${v.provinsi == '<?= $row['reffregion_nama'] ?>' ? 'selected' : ''}><?= $row['reffregion_nama'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback invalid-provinsi-corporate-update-multiple"></div>
                </div>

                <div class="form-group listcoorporate-city-update-multiple">
                    <label name="CAPTION-KOTA">Kota</label>
                    <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kecamatan')" class="select2 form-control" id="listcoorporate-city-update-multiple">
                    </select>
                    <div class="invalid-feedback invalid-kota-corporate-update-multiple"></div>
                </div>

                <div class="form-group listcoorporate-districts-update-multiple">
                    <label name="CAPTION-KECAMATAN">Kecamatan</label>
                    <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}', 'kelurahan')" class="select2 form-control" id="listcoorporate-districts-update-multiple">
                    </select>
                    <div class="invalid-feedback invalid-kecamatan-corporate-update-multiple"></div>
                    <input type="hidden" id="data-districts-update-multiple" />
                </div>

                <div class="form-group listcoorporate-ward-update-multiple">
                    <label name="CAPTION-KELURAHAN">Kelurahan</label>
                    <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" id="listcoorporate-ward-update-multiple">
                    </select>
                    <div class="invalid-feedback invalid-kelurahan-corporate-update-multiple"></div>
                    <input type="hidden" id="data-ward-update-multiple" />
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group txtpostalcode-coorporate-update-multiple">
                            <label name="CAPTION-KODEPOS">Kode Pos</label>
                            <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric" id="txtpostalcode-coorporate-update-multiple" placeholder="Kode Pos sesuai alamat" value="${v.kode_pos}" />
                            <div class="invalid-feedback invalid-kode-pos-corporate-update-multiple"></div>
                        </div>

                        <div class="form-group listcoorporate-stretclass-update-multiple">
                            <label name="CAPTION-KELASJALANBERDASARKANBEBANMUATAN">Kelas Jalan
                                Berdasarkan Beban muatan</label>
                            <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" name="listcoorporate-stretclass-update-multiple" id="listcoorporate-stretclass-update-multiple" required>
                                <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                        Jalan</label>--</option>
                                <?php foreach ($KelasJalan as $row) { ?>
                                    <option value="<?= $row['id'] ?>" ${v.kelas_jalan1 == '<?= $row['id'] ?>' ? 'selected' : ''}><?= $row['nama'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback invalid-kelas-jalan-corporate-update-multiple"></div>
                        </div>
                        <div class="form-group txtlattitude-coorporate-update-multiple">
                            <label name="CAPTION-LATTITUDE">Lattitude</label>
                            <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric-coma" id="txtlattitude-coorporate-update-multiple" placeholder="Lattitude Coorporate" value="${v.lattitude}" />
                            <div class="invalid-feedback invalid-lattitude-corporate-update-multiple"></div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group listcoorporate-area-update-multiple">
                            <label name="CAPTION-AREA">Area</label>
                            <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" id="listcoorporate-area-update-multiple">
                                <option value="">--<label name="CAPTION-PILIHAREA">Pilih Area</label>--
                                </option>
                                <?php foreach ($Area as $row) { ?>
                                    <option value="<?= $row['id'] ?>" ${v.area == '<?= $row['id'] ?>' ? 'selected' : ''}><?= $row['nama'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback invalid-area-corporate-update-multiple"></div>
                        </div>
                        <div class="form-group listcoorporate-stretclass2-update-multiple">
                            <label name="CAPTION-KELASJALANBERDASARKANFUNGSIJALAN">Kelas Jalan
                                Berdasarkan Fungsi jalan</label>
                            <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="select2 form-control" name="listcoorporate-stretclass2-update-multiple" id="listcoorporate-stretclass2-update-multiple" required>
                                <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                        Jalan</label>--</option>
                                <?php foreach ($KelasJalan2 as $row) { ?>
                                    <option value="<?= $row['id'] ?>" ${v.kelas_jalan2 == '<?= $row['id'] ?>' ? 'selected' : ''}><?= $row['nama'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback invalid-kelas-jalan2-corporate-update-multiple"></div>
                        </div>
                        <div class="form-group txtlongitude-coorporate-update-multiple">
                            <label name="CAPTION-LONGITUDE">Longitude</label>
                            <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric-coma" id="txtlongitude-coorporate-update-multiple" placeholder="Longitude Coorporate" value="${v.lattitude}" />
                            <div class="invalid-feedback invalid-longitude-corporate-update-multiple"></div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                    <h5 class="text-center badge badge-info" name="CAPTION-CONTACTPERSON">Contact Person
                    </h5>

                    <div class="form-group txtname-contact-person-update-multiple">
                        <label name="CAPTION-NAMA">Nama</label>
                        <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" id="txtname-contact-person-update-multiple" placeholder="Nama Contact Person" value="${v.nama_person}" />
                        <div class="invalid-feedback invalid-nama-contact-person-update-multiple"></div>
                    </div>

                    <div class="form-group txtphone-contact-person-update-multiple">
                        <label name="CAPTION-TELEPON">Telepon</label>
                        <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control numeric" id="txtphone-contact-person-update-multiple" placeholder="Telepon Contact Person" value="${v.telepon_person}" />
                        <div class="invalid-feedback invalid-telepon-contact-person-update-multiple"></div>
                    </div>

                    <div class="form-group txtphone-contact-person">
                        <label name="CAPTION-FAX">Fax</label>
                        <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" name="listcontactperson-client_pt_fax-update-multiple" id="listcontactperson-client_pt_fax-update-multiple" placeholder="Fax" value="${v.fax_person}" />
                        <div class="invalid-feedback invalid-client_pt_fax-update-multiple"></div>
                    </div>

                    <div class="form-group txtphone-contact-person">
                        <label name="CAPTION-NPWP">NPWP</label>
                        <input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="text" class="form-control" name="listcontactperson-client_pt_npwp-update-multiple" id="listcontactperson-client_pt_npwp-update-multiple" placeholder="NPWP" required value="${v.npwp_person}" />
                        <div class="invalid-feedback invalid-client_pt_npwp-update-multiple"></div>
                    </div>

                    <div class="form-group">
                        <label name="CAPTION-WAKTUOPERASIONAL">Waktu Operasional</label>
                        <div class="table-responsive">
                            <table class="table table-striped" id="list-day-operasional-update-multiple">
                                <thead>
                                    <tr>
                                        <td width="5%" name="CAPTION-NO">No.</td>
                                        <td width="10%" name="CAPTION-HARI">Hari</td>
                                        <td width="10%" name="CAPTION-JAMBUKA">Jam Buka</td>
                                        <td width="10%" name="CAPTION-JAMTUTUP">Jam Tutup</td>
                                        <td width="30%" name="CAPTION-STATUS">Status</td>
                                        <td width="10%" name="CAPTION-PENGIRIMAN">Pengiriman</td>
                                        <td width="10%" name="CAPTION-PENAGIHAN">Penagihan</td>

                                    </tr>
                                </thead>
                                  <tbody>
                                  <?php foreach ($Day as $key => $value) { ?>
                                            <tr>
                                                <td><?= $key ?></td>
                                                <td><?= $value ?></td>
                                                <td><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-buka" name="jam-buka" />
                                                </td>
                                                <td><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-tutup" name="jam-tutup" /></td>
                                                <td>
                                                    <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="form-control" id="status-operasional" name="status-operasional">
                                                        <option value="1" selected>BUKA</option>
                                                        <option value="0">TUTUP</option>
                                                    </select>
                                                </td>
                                                <td style="vertical-align:middle; text-align: center;"><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="checkbox" id="chk_pengiriman" name="chk_pengiriman" /></td>
                                                <td style="vertical-align:middle; text-align: center;"><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="checkbox" id="chk_penagihan" name="chk_penagihan" /></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>`;

                // Ambil waktu_operasional dari alamat yang sesuai
                var waktu_operasional = v.waktu_operasional;

                // Iterasi waktu_operasional dan tambahkan ke dalam tabel
                $.each(waktu_operasional, function(index, value) {
                    row += `
                            <tr>
                                <td>${value.no_urut}</td>
                                <td>${value.hari}</td>
                                <td><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-buka" name="jam-buka" value="${value.jam_buka}" /></td>
                                <td><input ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" type="time" class="from-control" id="jam-tutup" name="jam-tutup" value="${value.jam_tutup}" /></td>
                                <td>
                                    <select ${readonly} onchange="changeMultipleAlamat('${flag}', '${random_id}')" class="form-control" id="status-operasional" name="status-operasional">
                                        <option value="1" ${value.status == '1' ? 'selected' : ''}>BUKA</option>
                                        <option value="0" ${value.status == '0' ? 'selected' : ''}>TUTUP</option>
                                    </select>
                                </td>
                                <td style="vertical-align:middle; text-align: center;">
                                    <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" ${readonly} type="checkbox" id="chk_pengiriman" name="chk_pengiriman" ${value.pengiriman == 1 ? 'checked' : ''} />
                                </td>
                                <td style="vertical-align:middle; text-align: center;">
                                    <input onchange="changeMultipleAlamat('${flag}', '${random_id}')" ${readonly} type="checkbox" id="chk_penagihan" name="chk_penagihan" ${value.penagihan == 1 ? 'checked' : ''} />
                                </td>
                            </tr>
                        `;
                });

                return false;


            };
        });

        // Isi elemen dengan form template
        $("#formMultipleAlamat").empty().html(formTemplate);

        if (row != '') {
            $("#list-day-operasional-update-multiple tbody").empty().html(row);
        }

        changePKKK(provinsi, kota, kecamatan, kelurahan)

        $(".select2").select2({
            width: "100%",
        })
    }

    function changePKKK(provinsi, kota, kecamatan, kelurahan) {

        if (provinsi != null) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kota') ?>",
                data: {
                    id: provinsi,
                    kota: kota
                },
                dataType: "JSON",
                success: function(response) {
                    $("#listcoorporate-city-update-multiple").html(response);
                }
            });
        }

        if (kota != null) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kecamatan') ?>",
                data: {
                    id: kota,
                    provinsi: provinsi,
                    kecamatan: kecamatan
                },
                dataType: "JSON",
                success: function(response) {
                    $("#listcoorporate-districts-update-multiple").html(response)
                }
            });
        }

        if (kecamatan != null) {

            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/ManagementPelanggan/Outlet/Get_Request_Data_Kelurahan') ?>",
                data: {
                    id: kecamatan,
                    kelurahan: kelurahan
                },
                dataType: "JSON",
                success: function(response) {
                    $("#listcoorporate-ward-update-multiple").html(response)
                }
            });
        }
    }

    function deleteMultipleAlamat(button, event, random_id) {
        event.stopPropagation();

        arr_multiple_alamat = arr_multiple_alamat.filter((item) => item.random_id != random_id);

        $(button).parent().remove();

        $(".alamat-btn").removeClass("btn-primary");
        $(".alamat-btn").addClass("btn-secondary");

        $("#formMultipleAlamat").empty();
    }

    function updateCountAlamat() {
        var client_pt_principle_id = $("#header_client_pt_principle_id").val();
        var alamat_invoice_beda = arr_multiple_alamat.filter((item) => item.flag.includes('alamat_invoice') && item.client_pt_principle_id == client_pt_principle_id).length;
        var alamat_tagih_beda = arr_multiple_alamat.filter((item) => item.flag.includes('alamat_tagih') && item.client_pt_principle_id == client_pt_principle_id).length;
        var alamat_kirim_beda = arr_multiple_alamat.filter((item) => item.flag.includes('alamat_kirim') && item.client_pt_principle_id == client_pt_principle_id).length;
        var alamat_pajak_beda = arr_multiple_alamat.filter((item) => item.flag.includes('alamat_pajak') && item.client_pt_principle_id == client_pt_principle_id).length;

        $(`#alamat_invoice_beda_${client_pt_principle_id}`).html(alamat_invoice_beda);
        $(`#alamat_tagih_beda_${client_pt_principle_id}`).html(alamat_tagih_beda);
        $(`#alamat_kirim_beda_${client_pt_principle_id}`).html(alamat_kirim_beda);
        $(`#alamat_pajak_beda_${client_pt_principle_id}`).html(alamat_pajak_beda);
    }

    CheckMultiLocationUpdate();

    $("#btnsaveupdateoutlet").click(
        function() {
            var outlet_id = $("#txthideOutletId-update").val();
            var name_corporate = $("#txtname-coorporate-update");
            var address_corporate = $("#txtaddress-coorporate-update");
            var phone_corporate = $("#txtphone-coorporate-update");
            // var corporate_group = $("#listcoorporate-group-update");
            var lattitude_corporate = $("#txtlattitude-coorporate-update");
            var longitude_corporate = $("#txtlongitude-coorporate-update");
            var stretclass_corporate = $("#listcoorporate-stretclass-update");
            var stretclass2_corporate = $("#listcoorporate-stretclass2-update");
            var area_header = $("#listarea-header");
            var area_corporate = $("#listcoorporate-area-update");
            var province = $("#listcoorporate-province-update");
            var city = $("#listcoorporate-city-update");
            // var districts = $("#listcoorporate-districts-update");
            var districts = $("#data-districts-update");
            // var ward = $("#listcoorporate-ward-update");
            var ward = $("#data-ward-update");
            var kodepos_corporate = $("#txtpostalcode-coorporate-update");

            var name_contact_person = $("#txtname-contact-person-update");
            var phone_contact_person = $("#txtphone-contact-person-update");
            var kreditlimit_contact_person = $("#txtkreditlimit-contact-person-update");
            var segment1_contact_person = $("#listcontactperson-segment1-update").val();
            var segment2_contact_person = $("#listcontactperson-segment2-update").val();
            var segment3_contact_person = $("#listcontactperson-segment3-update").val();
            var client_pt_fax = $("#listcontactperson-client_pt_fax-update").val();
            var client_pt_npwp = $("#listcontactperson-client_pt_npwp-update").val();
            var client_pt_status_pkp = $("#listcontactperson-client_pt_status_pkp-selected-update").val();

            var arr_flag = [];

            var flagTypes = [{
                    className: ".alamat_invoice_beda",
                    flag: 'alamat_invoice_sama'
                },
                {
                    className: ".alamat_tagih_beda",
                    flag: 'alamat_tagih_sama'
                },
                {
                    className: ".alamat_kirim_beda",
                    flag: 'alamat_kirim_sama'
                },
                {
                    className: ".alamat_pajak_beda",
                    flag: 'alamat_pajak_sama'
                }
            ];

            $.each(flagTypes, function(index, item) {
                $(item.className).each(function() {
                    var client_pt_principle_id = $(this).attr("data-client-pt-principle-id");
                    var total = $(this).html();

                    arr_flag.push({
                        flag: item.flag,
                        client_pt_principle_id: client_pt_principle_id,
                        total: total
                    });
                });
            });

            let listcontactperson_location = $("#listcontactperson-location-update");

            let isValidMultiLocation = '';
            if ($("#multilocationupdate").is(':checked')) {
                isValidMultiLocation = 1;
            } else {
                isValidMultiLocation = 0;
            }

            let status = '';
            if ($("#txtstatus-coorporate-update").is(':checked')) {
                status = 1;
            } else {
                status = 0;
            }

            let id_detail = [];
            let no_urut_hari = [];
            let nama_hari = [];
            let jam_buka = [];
            let jam_tutup = [];
            let status_operasional = [];
            let chk_penagihan = [];
            let chk_pengiriman = [];

            $("input[name='id_detail_perusahaan_update']").each(function(i, v) {
                id_detail.push($(this).val());
            });

            $("input[name='no_urut_hari_perusahaan_update']").each(function(i, v) {
                no_urut_hari.push($(this).val());
            });

            $("input[name='nama_hari_perusahaan_update']").each(function(i, v) {
                nama_hari.push($(this).val());
            });

            $("input[name='jam_buka_perusahaan_update']").each(function(i, v) {
                jam_buka.push($(this).val());
            });

            $("input[name='jam_tutup_perusahaan_update']").each(function(i, v) {
                jam_tutup.push($(this).val());
            });

            $("select[name='status_operasional_perusahaan_update']").each(function(i, v) {
                status_operasional.push($(this).val());
            });

            // let chk_pengiriman = pengiriman;
            $("input[name='chk_pengiriman']").each(function(i, v) {
                if ($(this).is(':checked')) {
                    chk_pengiriman.push(1);
                } else {
                    chk_pengiriman.push(0);
                }
            });

            // let chk_penagihan = penagihan;
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
                    id_detail: id_detail[i],
                    no_urut: no_urut_hari[i],
                    hari: nama_hari[i],
                    buka: jam_buka[i],
                    tutup: jam_tutup[i],
                    status: status_operasional[i],
                    penagihan: chk_penagihan[i],
                    pengiriman: chk_pengiriman[i]
                });
            }
            // console.log(final_arr);
            // return false;

            validasi_update(name_corporate, address_corporate, phone_corporate, lattitude_corporate,
                longitude_corporate, stretclass_corporate, stretclass2_corporate, area_corporate,
                province, city, districts, ward, kodepos_corporate, name_contact_person,
                phone_contact_person, kreditlimit_contact_person, isValidMultiLocation,
                listcontactperson_location)

            $("#loadingupdate").show();
            $("#btnsaveupdateoutlet").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/ManagementPelanggan/Outlet/SaveUpdateOutlet') ?>",
                data: {
                    outlet_id: outlet_id,
                    name_corporate_update: name_corporate.val(),
                    address_corporate_update: address_corporate.val(),
                    phone_corporate_update: phone_corporate.val(),
                    // corporate_group_update: corporate_group.val(),
                    lattitude_corporate_update: lattitude_corporate.val(),
                    longitude_corporate_update: longitude_corporate.val(),
                    stretclass_corporate_update: stretclass_corporate.val(),
                    stretclass2_corporate_update: stretclass2_corporate.val(),
                    area_corporate_update: area_corporate.val(),
                    province_update: province.val(),
                    city_update: city.val(),
                    districts_update: districts.val(),
                    ward_update: ward.val(),
                    kodepos_corporate_update: kodepos_corporate.val(),
                    name_contact_person_update: name_contact_person.val(),
                    phone_contact_person_update: phone_contact_person.val(),
                    kreditlimit_contact_person_update: kreditlimit_contact_person.val(),
                    segment1_contact_person_update: segment1_contact_person,
                    segment2_contact_person_update: segment2_contact_person,
                    segment3_contact_person_update: segment3_contact_person,
                    isValidMultiLocation: isValidMultiLocation,
                    listcontactperson_location: listcontactperson_location.val(),
                    timeoperasional_update: final_arr,
                    headOffice: $('#txtoffice-coorporate-update').val(),
                    status: status,
                    type: "<?= $this->input->get('type') ?>",
                    client_pt_fax: client_pt_fax,
                    client_pt_npwp: client_pt_npwp,
                    client_pt_status_pkp: client_pt_status_pkp,
                    arr_multiple_alamat: arr_multiple_alamat,
                    arr_flag: arr_flag
                },
                success: function(response) {
                    $("#loadingupdate").hide();
                    $("#btnsaveupdateoutlet").prop("disabled", false);

                    if (response == 1) {
                        var msg = 'Data Pelanggan berhasil diubah';
                        var msgtype = 'success';

                        Swal.fire(
                            'Success!',
                            msg,
                            msgtype
                        )

                        setTimeout(function() {

                            window.location.href =
                                "<?= base_url('FAS/ManagementPelanggan/Outlet/OutletMenu') ?>";

                        }, 3000);

                        // main_page();
                        // ResetForm();

                        // $("#previewupdateoutlet").modal('hide');

                        // GetOutletMenu();
                        // SetDataAwal();
                    } else if (response == 0) {
                        var msg = 'Gagal mengubah';
                        var msgtype = 'error';

                        Swal.fire(
                            'Errorr!',
                            msg,
                            msgtype
                        )

                        // main_page();
                        // ResetForm();

                        // $("#previewupdateoutlet").modal('hide');

                        // GetOutletMenu();
                        // SetDataAwal();
                    } else {
                        var msg = response;
                        var msgtype = 'error';

                        Swal.fire(
                            'Error!',
                            msg,
                            msgtype
                        )
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#loadingupdate").hide();
                    $("#btnsaveupdateoutlet").prop("disabled", false);
                }
            });
        }
    );

    $("#btnbackoutletupdate").click(function() {
        window.location = url_like("FAS/ManagementPelanggan/Outlet/OutletMenu");
    });
    // trrigerCity();

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

    function validasi_update(name_corporate, address_corporate, phone_corporate, lattitude_corporate, longitude_corporate,
        stretclass_corporate, stretclass2_corporate, area_corporate, province, city, districts, ward, kodepos_corporate,
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
            $(".txtname-coorporate-update").addClass("has-error");
            $(".invalid-nama-corporate-update").html("Nama Outlet tidak boleh kosong");
            name_corporate.focus();
        } else {
            $(".txtname-coorporate-update").removeClass("has-error");
            $(".invalid-nama-corporate-update").html("");
        }

        if (address_corporate.val() == "") {
            $(".txtaddress-coorporate-update").addClass("has-error");
            $(".invalid-alamat-corporate-update").html("Alamat Outlet tidak boleh kosong");
            address_corporate.focus();
        } else {
            $(".txtaddress-coorporate-update").removeClass("has-error");
            $(".invalid-alamat-corporate-update").html("");
        }

        if (phone_corporate.val() == "") {
            $(".txtphone-coorporate-update").addClass("has-error");
            $(".invalid-telepon-corporate-update").html("Telephon Outlet tidak boleh kosong");
            phone_corporate.focus();
        } else {
            $(".txtphone-coorporate-update").removeClass("has-error");
            $(".invalid-telepon-corporate-update").html("");
        }

        // if (lattitude_corporate.val() == "") {
        //     $(".txtlattitude-coorporate-update").addClass("has-error");
        //     $(".invalid-lattitude-corporate-update").html("Lattitude Outlet tidak boleh kosong");
        //     lattitude_corporate.focus();
        // } else {
        //     $(".txtlattitude-coorporate-update").removeClass("has-error");
        //     $(".invalid-lattitude-corporate-update").html("");
        // }

        // if (longitude_corporate.val() == "") {
        //     $(".txtlongitude-coorporate-update").addClass("has-error");
        //     $(".invalid-longitude-corporate-update").html("Longitude Outlet tidak boleh kosong");
        //     longitude_corporate.focus();
        // } else {
        //     $(".txtlongitude-coorporate-update").removeClass("has-error");
        //     $(".invalid-longitude-corporate-update").html("");
        // }

        // if (stretclass_corporate.val() == "") {
        //     $(".listcoorporate-stretclass-update").addClass("has-error");
        //     $(".invalid-kelas-jalan-corporate-update").html("Kelas Jalan Berdasarkan barang muatan tidak boleh kosong");
        //     stretclass_corporate.focus();
        // } else {
        //     $(".listcoorporate-stretclass-update").removeClass("has-error");
        //     $(".invalid-kelas-jalan-corporate-update").html("");
        // }

        // if (stretclass2_corporate.val() == "") {
        //     $(".listcoorporate-stretclass2-update").addClass("has-error");
        //     $(".invalid-kelas-jalan2-corporate-update").html("Kelas Jalan Berdasarkan fungsi jalan tidak boleh kosong");
        //     stretclass2_corporate.focus();
        // } else {
        //     $(".listcoorporate-stretclass2-update").removeClass("has-error");
        //     $(".invalid-kelas-jalan2-corporate-update").html("");
        // }

        if (area_corporate.val() == "") {
            $(".listcoorporate-area-update").addClass("has-error");
            $(".invalid-area-corporate-update").html("Area Outlet tidak boleh kosong");
            area_corporate.focus();
        } else {
            $(".listcoorporate-area-update").removeClass("has-error");
            $(".invalid-area-corporate-update").html("");
        }

        if (province.val() == "") {
            $(".listcoorporate-province-update").addClass("has-error");
            $(".invalid-provinsi-corporate-update").html("Provinsi Outlet tidak boleh kosong");
            province.focus();
        } else {
            $(".listcoorporate-province-update").removeClass("has-error");
            $(".invalid-provinsi-corporate-update").html("");
        }

        if (city.val() == "") {
            $(".listcoorporate-city-update").addClass("has-error");
            $(".invalid-kota-corporate-update").html("Kota Outlet tidak boleh kosong");
            city.focus();
        } else {
            $(".listcoorporate-city-update").removeClass("has-error");
            $(".invalid-kota-corporate-update").html("");
        }

        if (districts.val() == "") {
            $(".listcoorporate-districts-update").addClass("has-error");
            $(".invalid-kecamatan-corporate-update").html("Kecamatan Outlet tidak boleh kosong");
            districts.focus();
        } else {
            $(".listcoorporate-districts-update").removeClass("has-error");
            $(".invalid-kecamatan-corporate-update").html("");
        }

        if (ward.val() == "") {
            $(".listcoorporate-ward-update").addClass("has-error");
            $(".invalid-kelurahan-corporate-update").html("Kelurahan Outlet tidak boleh kosong");
            ward.focus();
        } else {
            $(".listcoorporate-ward-update").removeClass("has-error");
            $(".invalid-kelurahan-corporate-update").html("");
        }

        if (kodepos_corporate.val() == "") {
            $(".txtpostalcode-coorporate-update").addClass("has-error");
            $(".invalid-kode-pos-corporate-update").html("Kode Pos Outlet tidak boleh kosong");
            kodepos_corporate.focus();
        } else {
            $(".txtpostalcode-coorporate-update").removeClass("has-error");
            $(".invalid-kode-pos-corporate-update").html("");
        }

        // if (name_contact_person.val() == "") {
        //     $(".txtname-contact-person-update").addClass("has-error");
        //     $(".invalid-nama-contact-person-update").html("Nama Contact Person tidak boleh kosong");
        //     name_contact_person.focus();
        // } else {
        //     $(".txtname-contact-person-update").removeClass("has-error");
        //     $(".invalid-nama-contact-person-update").html("");
        // }

        // if (phone_contact_person.val() == "") {
        //     $(".txtphone-contact-person-update").addClass("has-error");
        //     $(".invalid-telepon-contact-person-update").html("Telepon Contact Person tidak boleh kosong");
        //     phone_contact_person.focus();
        // } else {
        //     $(".txtphone-contact-person-update").removeClass("has-error");
        //     $(".invalid-telepon-contact-person-update").html("");
        // }

        // if (kreditlimit_contact_person.val() == "") {
        //     $(".txtkreditlimit-contact-person-update").addClass("has-error");
        //     $(".invalid-kredit-limit-contact-person-update").html("Kredit Limit Contact Person tidak boleh kosong");
        //     kreditlimit_contact_person.focus();
        // } else {
        //     $(".txtkreditlimit-contact-person-update").removeClass("has-error");
        //     $(".invalid-kredit-limit-contact-person-update").html("");
        // }

        if (isValidMultiLocation == 1) {
            if (listcontactperson_location.val() == "") {
                $(".listcontactperson-location-update").addClass("has-error");
                $(".invalid-list-location-contact-person-update").html("Lokasi tidak boleh kosong");
                kreditlimit_contact_person.focus();
            } else {
                $(".listcontactperson-location-update").removeClass("has-error");
                $(".invalid-list-location-contact-person-update").html("");
            }
        }


    }

    function get_selected_client_pt_status_pkp() {

        var radioButtons = document.getElementsByName("listcontactperson-client_pt_status_pkp-update");
        var selectedValue = "";

        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                selectedValue = radioButtons[i].value;
                break;
            }
        }

        $("#listcontactperson-client_pt_status_pkp-selected-update").val(selectedValue);
    }

    function set_selected_client_pt_status_pkp(valueToSelect) {
        var radioButtons = document.getElementsByName("listcontactperson-client_pt_status_pkp-update");

        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].value === valueToSelect) {
                radioButtons[i].checked = true;
                break;
            }
        }
    }

    function modalDetail(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/ManagementPelanggan/Outlet/getDetailClientPTPrinciple') ?>",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(response) {
                $('#list-detail-outlet tbody').empty();

                if ($.fn.DataTable.isDataTable('#list-detail-outlet')) {
                    $('#list-detail-outlet').DataTable().clear();
                    $('#list-detail-outlet').DataTable().destroy();
                }

                $.each(response, function(i, v) {
                    $("#list-detail-outlet tbody").append(`
                        <tr>
                            <td class="text-center">${v.principle_kode}</td>
                            <td class="text-center">${v.client_pt_principle_top}</td>
                            <td class="text-center">${formatNumber(parseFloat(v.client_pt_principle_kredit_limit))}</td>
                            <td class="text-center">${v.client_pt_principle_is_kredit == '1' ? 'Ya' : 'Tidak'}</td>
                            <td class="text-center">${v.segmen1}</td>
                            <td class="text-center">${v.segmen2}</td>
                            <td class="text-center">${v.segmen3}</td>
                            <td class="text-center">${formatNumber(parseFloat(v.client_pt_principle_maks_invoice))}</td>
                            <td class="text-center">${v.alamat_penagihan_beda == '1' ? 'Ya' : 'Tidak'}</td>
                            <td class="text-center">${v.client_pt_alamat}</td>
                            <td class="text-center">${v.client_pt_principle_top_retur}</td>
                        </tr>
                    `)
                })

                $("#list-detail-outlet").DataTable();
            }
        });

        $("#previewdetailoutlet").modal('show');
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

    function generateRandomId(length) {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        var randomId = '';
        for (var i = 0; i < length; i++) {
            randomId += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return randomId;
    }
</script>