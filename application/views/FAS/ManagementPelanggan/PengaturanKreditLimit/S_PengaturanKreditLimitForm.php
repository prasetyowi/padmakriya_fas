<script>
let arrDetail = []
let arrDetailTersimpan = []
// {
// 	principle_id : item.principle_id,
// 	principle_kode : item.principle_kode,
// 	top : item.client_pt_principle_top,
// 	is_kredit : item.client_pt_principle_top,
// }
let arrDraftDetail = []
let arrSlcPrinciple = []
let arrSlcSegment = []
let arrSlcSegment2 = []
let arrSlcSegment3 = []
let arrDetailPrincipleDraft = []
let arrAlamat = [] //aalamat outlet yg 1 group corp
var total_nominal_aktual = 0;

$(document).ready(function() {
    // alert('aaa')
    $(".select2").select2({
        width: "100%"
    });
    $(".custom-select").select2({
        width: "100%"
    });
    // $(".custom-select").select2({
    //     width: "100%"
    // });
    // $('#tableDetail').DataTable();
    $('#tableAddDetail').DataTable();
    $('#tableDetailTersimpan').DataTable({
        "aLengthMenu": [
            [5, 10, 15, 25, 50, 100, -1],
            [5, 10, 15, 25, 50, 100, "All"]
        ],
        "iDisplayLength": 5,
    });
    $('#tableDetail').DataTable({
        paging: false,
        ordering: false,
        info: false,
    });
    getListPrinciple();
    getDataClientSegmen1();
    getDataClientSegmen2();
    getDataClientSegmen3();
    // viewtableDetail()

});

function getListPrinciple() {
    // add principal pelanggan
    $.ajax({
        type: 'GET',
        url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getDataPrinciple') ?>",
        success: function(response) {
            let data = response;
            data.forEach(function(item, index) {
                arrSlcPrinciple.push({
                    principle_id: item.principle_id,
                    principle_kode: item.principle_kode
                })

            });
            // console.log(arrSlcPrinciple);
        }
    });
}

function getDataClientSegmen1() {
    // add principal pelanggan
    $.ajax({
        type: 'GET',
        url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getDataClientSegmen1') ?>",
        success: function(response) {
            let data = response;
            data.forEach(function(item, index) {
                arrSlcSegment.push({
                    segment_id: item.client_pt_segmen_id,
                    segment_nama: item.client_pt_segmen_nama
                })

            });
            // console.log(arrSlcPrinciple);
        }
    });
}

function getDataClientSegmen2() {
    // add principal pelanggan
    $.ajax({
        type: 'GET',
        url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getDataClientSegmen2') ?>",
        success: function(response) {
            let data = response;
            data.forEach(function(item, index) {
                arrSlcSegment2.push({
                    segment_id: item.client_pt_segmen_id,
                    segment_nama: item.client_pt_segmen_nama
                })

            });
            // console.log(arrSlcPrinciple);
        }
    });
}

function getDataClientSegmen3() {
    // add principal pelanggan
    $.ajax({
        type: 'GET',
        url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getDataClientSegmen3') ?>",
        success: function(response) {
            let data = response;
            data.forEach(function(item, index) {
                arrSlcSegment3.push({
                    segment_id: item.client_pt_segmen_id,
                    segment_nama: item.client_pt_segmen_nama
                })

            });
            // console.log(arrSlcPrinciple);
        }
    });
}

function addApproval() {
    if ($('#chk_approval').is(':checked')) {
        $('#add_status').val('In progress approval')
    } else {
        $('#add_status').val('Draft')
    }
}
$("#add_id_pelanggan").change(function() {
    let id_pelanggan = $(this).val();
    let client_corp = $('#add_client_pt_corporate_id').val();
    // getAlamatPelangganById
    $.ajax({
        type: 'GET',
        url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getAlamatPelangganById') ?>",
        data: {
            id_pelanggan: id_pelanggan
        },
        success: function(response) {
            $('#add_alamat').val(response.alamat)
            var alamat_pengiriman = response.count_pengiriman > 0 ? 'Ya' : 'Tidak';
            var alamat_penagihan = response.count_penagihan > 0 ? 'Ya' : 'Tidak';

            $('#add_alamat_pengiriman').val(alamat_pengiriman)
            $('#add_client_pt_corporate_id').val(response.client_pt_corporate_id)
            // alert()
            client_corp = response.client_pt_corporate_id;
            $('#add_alamat_penagihan').val(alamat_penagihan)
            $('#segment_1').val(response.nama_segmen1)
            $('#segment_2').val(response.nama_segmen2)
            $('#segment_3').val(response.nama_segmen3)

            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getPelangganByCorporateId') ?>",
                data: {
                    client_pt_corporate_id: client_corp
                },
                success: function(response) {
                    $('#edit_alamat option').remove()
                    $('#edit_alamat').append($("<option />").val(null).text(
                        '-- Pilih Alamat --'))
                    response.forEach(function(item, index) {
                        if (item.client_pt_id == id_pelanggan) {
                            // alert($("#add_id_pelanggan").val())
                            // alert(item.client_pt_id)
                            return;
                        }
                        arrAlamat.push({
                            alamat_id: item.client_pt_id,
                            alamat_nama: item.client_pt_alamat
                        })
                        $('#edit_alamat').append('<option value="' + item
                            .client_pt_id +
                            '" data-nama="' + item.client_pt_alamat + '">' +
                            item
                            .client_pt_alamat +
                            '</option>')
                    });
                }
            });
        }
    });
    // add detail kredit pelanggan yg sudah aprove
    $.ajax({
        type: 'GET',
        url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getPelangganPrincipleById') ?>",
        data: {
            pelanggan_id: id_pelanggan

        },
        success: function(response) {
            let data = response;
            arrDetailTersimpan = []
            data.forEach(function(item, index) {
                // console.log(item);
                arrDetailTersimpan.push({
                    principle_id: item.principle_id,
                    principle_kode: item.principle_kode,
                    top: item.client_pt_principle_top,
                    is_kredit: item.client_pt_principle_is_kredit,
                    kredit_limit: parseInt(item.client_pt_principle_kredit_limit ==
                        null ? 0 : item.client_pt_principle_kredit_limit),
                    max_invoice: item.client_pt_principle_maks_invoice == null ? 0 :
                        item.client_pt_principle_maks_invoice,
                    segment_harga: null,
                    segment1: item.client_pt_segment_id1,
                    segment2: item.client_pt_segment_id2,
                    segment3: item.client_pt_segment_id3,
                    segment1_nama: item.nama_segmen1,
                    segment2_nama: item.nama_segmen2,
                    segment3_nama: item.nama_segmen3,
                    is_alamat_beda: item.client_pt_is_alamat_penagihan_beda ==
                        null ? 0 : item.client_pt_is_alamat_penagihan_beda,
                    alamat_penagihan_id: item.client_pt_id_penagihan,
                    alamat_penagihan: item.client_pt_alamat

                })
            });
            // console.table(arrDetail)
            showTableDetailTersimpan()

        }
    });


})

function addDataDetailPrinciple() {

    var pelanggan_id = $("#add_id_pelanggan").val()
    $('#slc_add_principle option').remove()
    if (pelanggan_id == "") {
        alert("Harap pilih pelanggan terlebih dahulu!")
        return false;
    }
    // add principal pelanggan
    $('#slc_add_principle').append($("<option />").val(null).text('-- Pilih Principle --'))
    arrSlcPrinciple.forEach(function(item, index) {
        // cek apakah principle sudah dipilih di detail

        let chk_data = arrDetail.some(function(value) {
            return value.principle_kode == item.principle_kode
        });
        // alert(chk_data)
        if (chk_data == true) {
            return;
        }
        // $('#slc_add_principle').append($("<option />").val(item.principle_id).text(
        //     item.principle_kode)).data(
        //     'kode', item.principle_kode
        // );
        $('#slc_add_principle').append('<option value="' + item.principle_id +
            '" data-kode="' + item.principle_kode + '">' + item.principle_kode +
            '</option>')
    });
    arrDraftDetail = [];
    showTableDetailDraft()
    $('#modalDetail').modal("show");
}

function addPricipleToListDetail() {
    let principle_id = $('#slc_add_principle').val();
    let principle_kode = $('#slc_add_principle option:selected').attr('data-kode');
    let index_dataD = arrDraftDetail.findIndex(item => item.principle_kode == principle_kode);
    // cek apakah data sudah pernah ada
    if (index_dataD >= 0) {
        alert('Principle ini sudah ditambahkan!')
    } else {
        arrDraftDetail.push({
            principle_id: principle_id,
            principle_kode: principle_kode
        })
    }
    // console.table(arrDraftDetail);
    showTableDetailDraft()
    // alert(principle_kode)
}

function showTableDetailTersimpan() {

    if ($.fn.DataTable.isDataTable('#tableDetailTersimpan')) {
        $('#tableDetailTersimpan').DataTable().destroy();
    }

    $("#tableDetailTersimpan tbody").empty();
    $("#tableDetailTersimpan tbody").html('');
    arrDetailTersimpan.forEach(function(item, index) {
        $('#tableDetailTersimpan tbody').append(`
            	<tr>
                    <td style="text-align: center;">
						${item.principle_kode}
                    </td>
                    <td style="text-align: center;">${item.is_kredit == 1 ? 'ya': 'tidak'}</td>
                    <td style="text-align: center;">${item.top == null ? 0 : item.top }</td>
                    <td style="text-align: center;">${formatRupiah(parseInt(item.kredit_limit == null ? 0 : item.kredit_limit))}</td>
                    <td style="text-align: center;">${item.max_invoice}</td>
                    <td style="text-align: center;">Segment Harga</td>
                    <td style="text-align: center;">${item.segment1_nama}</td>
                    <td style="text-align: center;">${item.segment2_nama}</td>
                    <td style="text-align: center;">${item.segment3_nama}</td>
                    <td style="text-align: center;">${item.is_alamat_beda == 1 ? 'ya': 'tidak'}</td>
                    <td style="text-align: center;">${item.alamat_penagihan}</td>
            </tr>
        `);
    });
    $('#tableDetailTersimpan').DataTable({
        "aLengthMenu": [
            [5, 10, 15, 25, 50, 100, -1],
            [5, 10, 15, 25, 50, 100, "All"]
        ],
        "iDisplayLength": 5,
    });

}

function showTableDetail() {

    $("#tableDetail tbody").empty();
    $("#tableDetail tbody").html('');
    arrDetail.forEach(function(item, index) {
        $('#tableDetail tbody').append(`
            	<tr>
                    <td style="text-align: center;">
						${item.principle_kode}
                    </td>
                    <td style="text-align: center;">${item.is_kredit == 1 ? 'ya': 'tidak'}</td>
                    <td style="text-align: center;">${item.top == null ? 0 : item.top }</td>
                    <td style="text-align: center;">${formatRupiah(parseInt(item.kredit_limit == null ? 0 : item.kredit_limit))}</td>
                    <td style="text-align: center;">${item.max_invoice}</td>
                    <td style="text-align: center;">Segment Harga</td>
                    <td style="text-align: center;">${item.segment1_nama}</td>
                    <td style="text-align: center;">${item.segment2_nama}</td>
                    <td style="text-align: center;">${item.segment3_nama}</td>
                    <td style="text-align: center;">${item.is_alamat_beda == 1 ? 'ya': 'tidak'}</td>
                    <td style="text-align: center;">${item.alamat_penagihan}</td>
                    <td style="text-align: center;">
						<a id="del" title="Hapus" class="btn btn-danger del-detail btn-sm" data-principle_kode="${item.principle_kode}" onclick="delPrinciple('${index}')"><i class="fa fa-trash " aria-hidden="true"></i></i></a>
					</td>
                    <td style="text-align: center;">
						<a id="edit" title="Edit" class="btn btn-warning del-detail btn-sm" data-principle_kode="${item.principle_kode}" onclick="editPrinciple('${index}')"><i class="fa fa-pen " aria-hidden="true"></i></i></a>
					</td>
            </tr>
        `);
    });

}

function showTableDetailDraft() {
    // alert(12313)
    // // console.table(arrDetail)
    // if ($.fn.DataTable.isDataTable('#tableDetail')) {
    //     $('#tableDetail').DataTable().destroy();
    // }

    if ($.fn.DataTable.isDataTable('#tableAddDetail')) {
        $('#tableAddDetail').DataTable().destroy();
    }

    $("#tableAddDetail tbody").empty();
    $("#tableAddDetail tbody").html('');
    let option_alamat = '';
    //select alamat berdasarkan corp
    arrAlamat.forEach(function(item) {
        option_alamat = option_alamat +
            '<option value="' + item.alamat_id + '/' + item.alamat_nama + '" data-kode="' + item.alamat_nama +
            '">' + item
            .alamat_nama +
            '</option>';
    })
    let segment1_val = $('#segment_1').val()
    let segment2_val = $('#segment_2').val()
    let segment3_val = $('#segment_3').val()
    let option_segment1 = '';
    let option_segment2 = '';
    let option_segment3 = '';
    arrSlcSegment.forEach(function(item) {
        let selected = ''
        if (segment1_val == item.segment_nama) {
            selected = 'selected'
        }
        option_segment1 = option_segment1 +
            '<option value="' + item.segment_id + '/' + item.segment_nama + '"  data-nama="' + item
            .segment_nama + '" ' + selected + '>' +
            item.segment_nama +
            '</option>';
    })
    arrSlcSegment2.forEach(function(item) {
        let selected = ''
        if (segment2_val == item.segment_nama) {
            selected = 'selected'
        }
        option_segment2 = option_segment2 +
            '<option value="' + item.segment_id + '/' + item.segment_nama + '"  data-nama="' + item
            .segment_nama + '" ' + selected + '>' +
            item.segment_nama +
            '</option>';
    })
    arrSlcSegment3.forEach(function(item) {
        let selected = ''
        if (segment3_val == item.segment_nama) {
            selected = 'selected'
        }
        option_segment3 = option_segment3 +
            '<option value="' + item.segment_id + '/' + item.segment_nama + '"  data-nama="' + item
            .segment_nama + '" ' + selected + '>' +
            item.segment_nama +
            '</option>';
    })
    arrDraftDetail.forEach(function(item, index) {
        $('#tableAddDetail tbody').append(`
            					<tr id="tr-${item.principle_kode}">

                                    <td style="text-align: center;">
            							<input type="text" class="form-control" id="add_detail_principle_kode[]" name="add_detail_principle_kode[]" disabled value="${item.principle_kode}" />
										<input type="hidden" id="add_detail_principle_id[]" name="add_detail_principle_id[]" value="${item.principle_id}">
                                    </td>
									<td style="text-align: center;">
										<select id="add_detail_is_kredit-${index}" name="add_detail_is_kredit[]" onchange="chkIsKredit(${index})"
											class="form-control custom-select">
											<option value="1">Ya</option>
											<option value="0" selected>Tidak</option>
										</select>
									</td>
                                    <td style="text-align: center;">
										<input type="text" class="form-control" name="add_detail_top[]" id="add_detail_top-${index}" value="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
									</td>
                                    
                                    <td style="text-align: center;">
										<input type="number" class="form-control" name="add_detail_kredit_limit[]" id="add_detail_kredit_limit-${index}" value="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
									</td>
                                    <td style="text-align: center;">
										<input type="number" class="form-control" name="add_detail_max_invoice[]" id="add_detail_max_invoice-${index}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="0" disabled>
									</td>
                                    <td style="text-align: center;">
										<select id="add_detail_segment_harga[]" name="add_detail_segment_harga[]"
											class="form-control custom-select">
										</select>
									</td>
                                    <td style="text-align: center;">
										<select id="add_detail_segment1-${index}" name="add_detail_segment1[]" onchange="getSegment2Add(${index})"
                                            class="form-control custom-select">
											<option value="">-- Pilih Segment 1 --</option>
											${option_segment1}
                                        </select>
									</td>
                                    <td style="text-align: center;">
										<select id="add_detail_segment2-${index}" name="add_detail_segment2[]" onchange="getSegment3Add(${index})"
                                            class="form-control custom-select">
											<option value="">-- Pilih Segment 2 --</option>
											${option_segment2}
                                        </select>
									</td>
                                    <td style="text-align: center;">
										<select id="add_detail_segment3-${index}" name="add_detail_segment3[]"
                                            class="form-control custom-select">
											<option value="">-- Pilih Segment 3 --</option>
											${option_segment3}
                                        </select>
									</td>
                                    <td style="text-align: center;"><input class="chk_alamat_beda" type="checkbox" name="add_detail_is_alamat_beda[]" id="add_chk_beda-${index}" onclick="chkAddAlamatBeda(${index})"></td>
                                    <td style="text-align: center;">
										<select id="add_detail_alamat-${index}" name="add_detail_alamat[]"
											class="form-control custom-select" disabled>
											<option value="">-- Pilih Alamat --</option>
											${option_alamat}
										</select>
										
									</td>
                                    <td style="text-align: center;">
										<a id="delDetail-${item.principle_kode}" title="Hapus" class="btn btn-danger del-detail btn-sm" data-principle_kode="${item.principle_kode}" onclick="delRow('${index}')"><i class="fa fa-trash " aria-hidden="true"></i></i></a>
									</td>
                                </tr>
    	`)
    });
    $('#tableAddDetail').DataTable({
        paging: false,
        ordering: false,
        info: false,
    });

}



function delRow(index) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus akan hilang!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value == true) {

            arrDraftDetail.splice(index, 1);
            // console.log(arrDetail);
            showTableDetailDraft();
        }
    })
    // $("#tr-" + kode).remove()
}

function delPrinciple(index) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus akan hilang!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value == true) {
            arrDetail.splice(index, 1);
            // console.log(arrDetail);
            showTableDetail();
        }
    })

    // alert(index)

    // $("#tr-" + kode).remove()
}

function editPrinciple(index) {
    console.log(arrDetail);
    $("#edit_index").val(index)
    $("#edit_principle").val(arrDetail[index]['principle_kode'])
    $("#edit_top").val(arrDetail[index]['top'] == null ? 0 : arrDetail[index]['top'])
    $("#edit_kredit_limit").val(arrDetail[index]['kredit_limit'] == null ? 0 : arrDetail[index]['kredit_limit'])
    $("#edit_max_invoice").val(arrDetail[index]['max_invoice'] == null ? 0 : arrDetail[index]['max_invoice'])

    // cek apakah is kredit true atau tidak
    $('#edit_is_kredit option').remove()
    if (arrDetail[index]['is_kredit'] == 1) {
        $("#edit_is_kredit").append('<option value="1" selected >Ya</option>');
        $("#edit_is_kredit").append('<option value="0" >Tidak</option>');
        $('#edit_top').prop('disabled', false);
        $('#edit_kredit_limit').prop('disabled', false);
    }
    if (arrDetail[index]['is_kredit'] == 0) {
        $("#edit_is_kredit").append('<option value="1" >Ya</option>');
        $("#edit_is_kredit").append('<option value="0" selected>Tidak</option>');
        $('#edit_top').prop('disabled', true);
        $('#edit_kredit_limit').prop('disabled', true);
    }
    //cek apakah is alamat beda true
    arrDetail[index]['is_alamat_beda'] == 1 ?
        $('#edit_is_alamat_beda').prop('checked', true) & $('#edit_alamat').prop(
            'disabled', false) :
        $('#edit_is_alamat_beda').prop('checked', false) & $('#edit_alamat').prop(
            'disabled', true)

    // reset slc segment
    $("#edit_segment1 option").remove();
    $("#edit_segment2 option").remove();
    $("#edit_segment3 option").remove();
    // add data slc segment1
    arrSlcSegment.forEach(function(item, i) {
        // alert(123)
        if (arrDetail[index]['segment1'] == item.segment_id) {
            $("#edit_segment1").append('<option selected value="' + item.segment_id + '"  data-nama="' + item
                .segment_nama + '">' +
                item.segment_nama +
                '</option>');
        } else {
            $("#edit_segment1").append('<option value="' + item.segment_id + '"  data-nama="' + item
                .segment_nama + '">' +
                item.segment_nama +
                '</option>');
        }
    });
    // add data slc segment2
    if (arrDetail[index]['segment1'] != null || arrDetail[index]['segment1'] != '') {
        let reff = arrDetail[index]['segment1']
        // alert(reff)
        $.ajax({
            type: 'GET',
            url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getDataClientSegmen2') ?>",
            data: {
                reff_id: reff
            },
            success: function(response) {
                let data = response;
                $("#edit_segment2").append('<option value="">-- Pilih Segment 2 --</option>');
                data.forEach(function(item, index) {
                    if (arrDetail[index]['segment2'] == item.client_pt_segmen_id) {
                        $("#edit_segment2").append('<option selected value="' + item
                            .client_pt_segmen_id + '" data-nama="' + item
                            .client_pt_segmen_nama + '">' +
                            item.client_pt_segmen_nama +
                            '</option>');
                    } else {
                        $("#edit_segment2").append('<option value="' + item.client_pt_segmen_id +
                            '" data-nama="' + item.client_pt_segmen_nama + '">' +
                            item.client_pt_segmen_nama +
                            '</option>');
                    }

                });
            }
        });

    }
    // add data slc segment3
    if (arrDetail[index]['segment2'] != null || arrDetail[index]['segment2'] != '') {
        let reff = arrDetail[index]['segment2']
        // alert(reff)
        $.ajax({
            type: 'GET',
            url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getDataClientSegmen3') ?>",
            data: {
                reff_id: reff
            },
            success: function(response) {
                let data = response;
                $("#edit_segment3").append('<option value="">-- Pilih Segment 3 --</option>');
                data.forEach(function(item, index) {
                    if (arrDetail[index]['segment3'] == item.client_pt_segmen_id) {
                        $("#edit_segment2").append('<option selected value="' + item
                            .client_pt_segmen_id + '" data-nama="' + item
                            .client_pt_segmen_nama + '">' +
                            item.client_pt_segmen_nama +
                            '</option>');
                    } else {
                        $("#edit_segment2").append('<option value="' + item.client_pt_segmen_id +
                            '" data-nama="' + item.client_pt_segmen_nama + '">' +
                            item.client_pt_segmen_nama +
                            '</option>');
                    }

                });
            }
        });

    }

    $("#edit_alamat").val(arrDetail[index]['alamat_penagihan'])
    $('#modalEdit').modal("show");

}

function getSegment2Add(index) {
    let reff = $("#add_detail_segment1-" + index).val()
    $.ajax({
        type: 'GET',
        url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getDataClientSegmen2') ?>",
        data: {
            reff_id: reff
        },
        success: function(response) {
            let data = response;
            $("#add_detail_segment2-" + index + " option").remove();
            $("#add_detail_segment2-" + index).append('<option value="">-- Pilih Segment 2 --</option>');
            data.forEach(function(item, i) {
                $("#add_detail_segment2-" + index).append('<option value="' + item
                    .client_pt_segmen_id + '/' + item.client_pt_segmen_nama +
                    '" data-nama="' + item.client_pt_segmen_nama + '">' +
                    item.client_pt_segmen_nama +
                    '</option>');
                // alert(item.client_pt_segmen_nama)
            });
        }
    });
    // getSegment3Add(index)
}

function getSegment3Add(index) {
    let reff = $("#add_detail_segment2-" + index).val()

    $.ajax({
        type: 'GET',
        url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getDataClientSegmen3') ?>",
        data: {
            reff_id: reff
        },
        success: function(response) {
            let data = response;
            $("#add_detail_segment3-" + index + " option").remove();
            data.forEach(function(item, i) {
                $("#add_detail_segment3-" + index).append('<option value="' + item
                    .client_pt_segmen_id + '/' + item.client_pt_segmen_nama + '" data-nama="' +
                    item.client_pt_segmen_nama + '">' +
                    item.client_pt_segmen_nama +
                    '</option>');
            });
        }
    });
}

function getSegment2Edit() {
    let reff = $("#edit_segment1").val()
    $.ajax({
        type: 'GET',
        url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getDataClientSegmen2') ?>",
        data: {
            reff_id: reff
        },
        success: function(response) {
            let data = response;
            $("#edit_segment2 option").remove();
            $("#edit_segment2").append('<option value="">-- Pilih Segment 2 --</option>');
            data.forEach(function(item, index) {

                $("#edit_segment2").append('<option value="' + item.client_pt_segmen_id +
                    '" data-nama="' + item.client_pt_segmen_nama + '">' +
                    item.client_pt_segmen_nama +
                    '</option>');
            });
        }
    });
}

function getSegment3Edit() {
    let reff = $("#edit_segment2").val()
    $.ajax({
        type: 'GET',
        url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getDataClientSegmen3') ?>",
        data: {
            reff_id: reff
        },
        success: function(response) {
            let data = response;
            $("#edit_segment3 option").remove();
            $("#edit_segment2").append('<option value="">-- Pilih Segment 3 --</option>');
            data.forEach(function(item, index) {
                $("#edit_segment3").append('<option value="' + item.client_pt_segmen_id +
                    '" data-nama="' + item.client_pt_segmen_nama + '">' +
                    item.client_pt_segmen_nama +
                    '</option>');
            });
        }
    });
}

function chkIsKredit(index) {
    //cek apakah kredit atau tidak
    if ($('#add_detail_is_kredit-' + index).val() == 1) {

        $('#add_detail_top-' + index).prop('disabled', false);
        $('#add_detail_kredit_limit-' + index).prop('disabled', false);
        $('#add_detail_max_invoice-' + index).prop('disabled', false);
    } else {
        $('#add_detail_top-' + index).val(0)
        $('#add_detail_kredit_limit-' + index).val(0)
        $('#add_detail_top-' + index).prop('disabled', true);
        $('#add_detail_kredit_limit-' + index).prop('disabled', true)
        $('#add_detail_max_invoice-' + index).prop('disabled', true)

    }

}

function chkEditIsKredit() {
    //cek apakah kredit atau tidak
    if ($('#edit_is_kredit').val() == 1) {

        $('#edit_top').prop('disabled', false);
        $('#edit_kredit_limit').prop('disabled', false);
        $('#edit_max_invoice').prop('disabled', false);
    } else {
        $('#edit_top').val(0)
        $('#edit_kredit_limit').val(0)
        $('#edit_max_invoice').val(0)
        $('#edit_top').prop('disabled', true);
        $('#edit_kredit_limit').prop('disabled', true);
        $('#edit_max_invoice').prop('disabled', true);

    }
}

function chkAlamatBeda() {
    // alert(1231)
    //cek apakah checkbox is_alamat_beda is checked
    $('#edit_is_alamat_beda').is(':checked') ?
        $('#edit_alamat').prop('disabled', false) :
        $('#edit_alamat').prop('disabled', true) & $('#edit_alamat').val(null)
}

function chkAddAlamatBeda(index) {
    // alert(1231)
    //cek apakah checkbox is_alamat_beda is checked
    $('#add_chk_beda-' + index).is(':checked') ?
        $('#add_detail_alamat-' + index).prop('disabled', false) :
        $('#add_detail_alamat-' + index).prop('disabled', true) & $('#add_detail_alamat-' + index).val(null)

}

function updateDetail() {
    let index = $("#edit_index").val();
    let principle_kode = $("#edit_principle").val()
    let top = $("#edit_top").val()
    let is_kredit = $("#edit_is_kredit").val()
    let kredit_limit = $("#edit_kredit_limit").val()
    let max_invoice = $("#edit_max_invoice").val()
    let segment_harga = $("#edit_segment_harga").val()
    let is_alamat_beda = $('#edit_is_alamat_beda').is(':checked') ? 1 : 0;
    let alamat_penagihan_id = $("#edit_alamat").val()
    let alamat_penagihan = $('#edit_alamat option:selected').attr('data-nama') == null ? '' : $(
        '#edit_alamat option:selected').attr('data-nama')
    let segment1 = $('#edit_segment1').val()
    let segment2 = $('#edit_segment2').val()
    let segment3 = $('#edit_segment3').val()
    let segment1_nama = $('#edit_segment1 option:selected').attr('data-nama') == null ? '' : $(
        '#edit_segment1 option:selected').attr('data-nama');
    let segment2_nama = $('#edit_segment2 option:selected').attr('data-nama') == null ? '' : $(
        '#edit_segment2 option:selected').attr('data-nama');
    let segment3_nama = $('#edit_segment3 option:selected').attr('data-nama') == null ? '' : $(
        '#edit_segment3 option:selected').attr('data-nama');
    if (is_alamat_beda == 1 && (alamat_penagihan == null || alamat_penagihan == '')) {
        alert('Harap pilih alamat penagihan beda terlebih dahulu')
        return false;
    }

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang sebelumnya akan hilang!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value == true) {

            arrDetail[index]['principle_kode'] = principle_kode;
            arrDetail[index]['top'] = top;
            arrDetail[index]['is_kredit'] = is_kredit;
            arrDetail[index]['kredit_limit'] = kredit_limit;
            arrDetail[index]['max_invoice'] = max_invoice;
            arrDetail[index]['is_alamat_beda'] = is_alamat_beda;
            arrDetail[index]['segment_harga'] = segment_harga;
            arrDetail[index]['alamat_penagihan'] = alamat_penagihan;
            arrDetail[index]['alamat_penagihan_id'] = alamat_penagihan_id;
            arrDetail[index]['segment1'] = segment1;
            arrDetail[index]['segment2'] = segment2;
            arrDetail[index]['segment3'] = segment3;
            arrDetail[index]['segment1_nama'] = segment1_nama;
            arrDetail[index]['segment2_nama'] = segment2_nama;
            arrDetail[index]['segment3_nama'] = segment3_nama;
            showTableDetail()
            console.log(arrDetail);
            $('#modalEdit').modal("hide");
        }
    })
    //update arrDetail principle outlet

}

function addDetail() {


    let principle_kode = $("input[name='add_detail_principle_kode[]']").map(function() {
        return this.value;
    }).get();
    let principle_id = $("input[name='add_detail_principle_id[]']").map(function() {
        return this.value;
    }).get();
    let top = $("input[name='add_detail_top[]']").map(function() {
        return this.value;
    }).get();
    let is_kredit = $("[name='add_detail_is_kredit[]']").map(function() {
        return this.value;
    }).get();
    let kredit_limit = $("input[name='add_detail_kredit_limit[]']").map(function() {
        return this.value;
    }).get();
    let max_invoice = $("input[name='add_detail_max_invoice[]']").map(function() {
        return this.value;
    }).get();
    let segment_harga = $("input[name='add_detail_segment_harga[]']").map(function() {
        return this.value;
    }).get();

    let alamat_penagihan = $("[name='add_detail_alamat[]']").map(function() {
        if (this.value == "" || this.value == null) {
            return ""
        }
        let arrayVal = this.value.split("/");
        let id = arrayVal[0];
        let nama = arrayVal[1];

        return nama;
    }).get();
    let alamat_penagihan_id = $("[name='add_detail_alamat[]']").map(function() {
        if (this.value == "" || this.value == null) {
            return ""
        }
        let arrayVal = this.value.split("/");
        let id = arrayVal[0];
        let nama = arrayVal[1];
        return id;
    }).get();

    let add_detail_segment1 = $("[name='add_detail_segment1[]']").map(function() {
        if (this.value == "" || this.value == null) {
            return ""
        }
        let arrayVal = this.value.split("/");
        let id = arrayVal[0];
        let nama = arrayVal[1];
        return id;
    }).get();
    let add_detail_segment2 = $("[name='add_detail_segment2[]']").map(function() {
        if (this.value == "" || this.value == null) {
            return ""
        }
        let arrayVal = this.value.split("/");
        let id = arrayVal[0];
        let nama = arrayVal[1];
        return id;
    }).get();
    let add_detail_segment3 = $("[name='add_detail_segment3[]']").map(function() {
        if (this.value == "" || this.value == null) {
            return ""
        }
        let arrayVal = this.value.split("/");
        let id = arrayVal[0];
        let nama = arrayVal[1];
        return id;
    }).get();
    // segment nama
    let add_detail_segment1_nama = $("[name='add_detail_segment1[]']").map(function() {
        if (this.value == "" || this.value == null) {
            return ""
        }
        let arrayVal = this.value.split("/");
        let id = arrayVal[0];
        let nama = arrayVal[1];
        return nama;
    }).get();
    let add_detail_segment2_nama = $("[name='add_detail_segment2[]']").map(function() {
        if (this.value == "" || this.value == null) {
            return ""
        }
        let arrayVal = this.value.split("/");
        let id = arrayVal[0];
        let nama = arrayVal[1];
        return nama;
    }).get();
    let add_detail_segment3_nama = $("[name='add_detail_segment3[]']").map(function() {
        if (this.value == "" || this.value == null) {
            return ""
        }
        let arrayVal = this.value.split("/");
        let id = arrayVal[0];
        let nama = arrayVal[1];
        return nama;
    }).get();

    let is_alamat_beda = $("input[name='add_detail_is_alamat_beda[]']").map(function() {
        if ($(this).is(':checked')) {
            return 1;
        } else {
            return 0;
        }
    }).get();
    let eror_alamat = 0;
    // check jika alamat beda maka harus ada pilihan alamatnya
    is_alamat_beda.forEach((val, index) => {
        if (val == 1) {
            if (alamat_penagihan_id[index] == null || alamat_penagihan_id[index] == '') {

                eror_alamat++;
                return false;
            }
        }
    });
    if (eror_alamat > 0) {
        alert('Harap pilih alamat penagihan beda terlebih dahulu')
        return false;
    }
    // console.log(alamat_penagihan);
    //add arrDetail principle outlet
    principle_kode.forEach((value, index) => {
        arrDetail.push({
            principle_id: principle_id[index],
            principle_kode: principle_kode[index],
            top: top[index],
            is_kredit: is_kredit[index],
            kredit_limit: kredit_limit[index],
            max_invoice: max_invoice[index],
            segment_harga: segment_harga[index],
            is_alamat_beda: is_alamat_beda[index],
            alamat_penagihan_id: alamat_penagihan_id[index],
            alamat_penagihan: alamat_penagihan[index],
            segment1: add_detail_segment1[index],
            segment2: add_detail_segment2[index],
            segment3: add_detail_segment3[index],
            segment1_nama: add_detail_segment1_nama[index],
            segment2_nama: add_detail_segment2_nama[index],
            segment3_nama: add_detail_segment3_nama[index]
        })
    });
    console.log(arrDetail);
    arrDraftDetail = [];

    showTableDetail()
    $('#modalDetail').modal("hide");
}

function ubahNominal(index) {

    let nominal_aktual = $('#nominal-aktual-' + index).val()
    let nominal = $('#nominal-aktual-' + index).val()
    if (nominal_aktual < 0) {
        $('#nominal-aktual-' + index).val(0)
    }
    //jika nominal aktual melebihi nominL pengajuan
    // if (nominal_aktual > nominal) {
    //     alert("Nominal aktual tidak boleh m,elebihi nominal permintaan !")
    //     $('#nominal-aktual-' + index).val(0)
    // }
    // alert(nominal)
    // ubah nominal aktual di array
    arrPermintaan[index]['nominal_aktual'] = nominal_aktual

    let total_nominal_aktual = 0;
    arrPermintaan.forEach(item => {
        total_nominal_aktual += parseInt(item.nominal_aktual);
    });
    $("#total_nominal_aktual").val(total_nominal_aktual);
    $("#span_nominal_aktual").html(formatRupiah(parseInt(total_nominal_aktual)));

}

function deletePermintaan(index) {
    arrPermintaan.splice(index, 1);
    viewtableDetail()
}


//save Pengeluaran
$('#saveData').click(function(e) {
    e.preventDefault();
    // alert('21321')
    let add_id_pelanggan = $("#add_id_pelanggan").val();
    let add_keterangan = $("#add_keterangan").val();
    let add_status = $("#add_status").val();

    if (add_id_pelanggan == '') {
        alert('Harap pilih pelanggan terlebih dahulu !')
        $("#add_id_pelanggan").focus();
        return false;
    }

    if (arrDetail.length === 0) {
        alert('Harap tambahkan data principle terlebih dahulu !')
        return false;
    }

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Pastikan data yang diinput sudah benar!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya!'
    }).then((result) => {
        if (result.value == true) {
            $.ajax({
                url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/SaveKreditLimit') ?>",
                type: 'POST',
                data: {
                    id_pelanggan: add_id_pelanggan,
                    status: add_status,
                    keterangan: add_keterangan,
                    dataDetail: arrDetail
                },
                dataType: "JSON",
                async: false,
                success: function(response) {
                    if (response.status == 1) {
                        Swal.fire(
                            'Success!',
                            'Data has been saved.',
                            'success'
                        )
                        setTimeout(function() {
                            window.location.href =
                                "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/PengaturanKreditLimitMenu') ?>";
                        }, 3000);
                    } else {
                        Swal.fire(
                            'Error!',
                            response.message,
                            'warning'
                        )
                    }
                },
            });
        }
    })
});

function formatRupiah(angka, prefix) {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (
        var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
    return rupiah.split('', rupiah.length - 1).reverse().join('');
}

</script>