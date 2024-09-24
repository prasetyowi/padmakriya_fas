<script>
let arrDetailTersimpan = []
let arrDetail = []
// {
// 	principle_id : item.principle_id,
// 	principle_kode : item.principle_kode,
// 	top : item.client_pt_principle_top,
// 	is_kredit : item.client_pt_principle_top,
// }
let arrDraftDetail = []
let arrSlcPrinciple = []
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
    // $('#tableDetail').DataTable({
    //     paging: false,
    //     ordering: false,
    //     info: false,
    // });
    $('#tableDetail').DataTable({
        "aLengthMenu": [
            [5, 10, 15, 25, 50, 100, -1],
            [5, 10, 15, 25, 50, 100, "All"]
        ],
        "iDisplayLength": 5,
    });
    getDataDetailPrincipalInPelanggan()
    // viewtableDetail()

});

function getDataDetailPrincipalInPelanggan() {
    // add detail kredit pelanggan yg sudah aprove
    $.ajax({
        type: 'GET',
        url: "<?= base_url('FAS/ManagementPelanggan/PengaturanKreditLimit/getPelangganPrincipleById') ?>",
        data: {
            pelanggan_id: $('#add_id_pelanggan').val()

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
                    max_invoice: item.client_pt_principle_maks_invoice == null ? 0 : item
                        .client_pt_principle_maks_invoice,
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

function formatRupiah(angka, prefix) {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
    return rupiah.split('', rupiah.length - 1).reverse().join('');
}
</script>
