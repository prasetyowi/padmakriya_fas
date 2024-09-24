<script>
    // array data per akun
    let arrDataD = [];
    let arrDataBudget = [];
    let arrBulan = [{
            no: 1,
            nama: "Januari"
        },
        {
            no: 2,
            nama: "Februari"
        },
        {
            no: 3,
            nama: "Maret"
        },
        {
            no: 4,
            nama: "April"
        },
        {
            no: 5,
            nama: "Mei"
        },
        {
            no: 6,
            nama: "Juni"
        },
        {
            no: 7,
            nama: "Juli"
        },
        {
            no: 8,
            nama: "Agustus"
        },
        {
            no: 9,
            nama: "September"
        },
        {
            no: 10,
            nama: "Oktober"
        },
        {
            no: 11,
            nama: "November"
        },
        {
            no: 12,
            nama: "Desember"
        },
    ]

    $(document).ready(function() {
        // alert('aaa')
        $(".select2").select2({
            width: "100%"
        });
        getListDetail2AnggaranById()
    });

    //get data list detail 2
    function getListDetail2AnggaranById() {
        $("#tableAnggaran tbody").empty();
        let anggaran_detail_id = $("#anggaran_detail_id").val()
        let jumlah_level = $("#jumlah_level").val()
        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/Barjas/Anggaran/getListDetail2AnggaranById') ?>",
            data: {
                anggaran_detail_id: anggaran_detail_id,
            },
            success: function(response) {

                let no = 1;
                let data = response;

                if (data.length > 0) {
                    $.each(data, function(index, value) {
                        var petik = "'";
                        var style = "";
                        var action = ''
                        if (value.anggaran_detail_2_level != 0) {
                            var action = ''
                            if (value.anggaran_detail_2_level == jumlah_level - 1) {
                                var style = 'style="font-weight:bold;background-color:lightgrey" ';
                            } else {
                                var style = 'style="font-weight:bold"';
                            }
                        } else {
                            var style = "";
                            var action = '<a class="btn btn-success" onclick="viewBudgeting(' + petik +
                                value.anggaran_detail_2_id + petik + ',' + petik +
                                value.anggaran_detail_2_kode + petik + ',' + petik +
                                value.anggaran_detail_2_nama_anggaran + petik + ',' + value
                                .anggaran_detail_2_budget + ',' + petik +
                                value.anggaran_detail_2_is_unlimited + petik + ')">View Budget</a>'
                        }
                        $('#tableAnggaran tbody').append(`
                            <tr ${style}>
                                <td style='vertical-align:middle; text-align: center;' >${no}</td>
                                <td style='vertical-align:middle; ' >${value.anggaran_detail_2_kode}<input type="hidden" class="form-control" name="sku_id[]" value="${value.sku_id}"></td>
                                <td style='vertical-align:middle; ' >${value.anggaran_detail_2_nama_anggaran}</td>
                                <td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(value.anggaran_detail_2_budget)|| 0)}</td>
                                <td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(value.anggaran_detail_2_alokasi) || 0)}</td>
                                <td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(value.anggaran_detail_2_terpakai)|| 0)}</td>
                                <td style='vertical-align:middle; text-align: center;' >${formatRupiah(parseInt(value.anggaran_detail_2_sisa)|| 0)}</td>
                                <td style='vertical-align:middle; ' >${action}</td>

                             </tr>
                    `);
                        no++;
                    });
                } else {
                    $("#tableAnggaran tbody").html('');
                }
            }
        });
    }

    // untuk render body / isi table Budget setiap ada perubahan
    function viewBudgeting(anggaran_detail_2_id, anggaran_detail_2_kode, anggaran_detail_2_nama_anggaran, budget, isunlimit) {
        console.log(isunlimit);
        $("#tableBudget tbody").empty();
        $("#nama_anggaran_budget").val(anggaran_detail_2_kode + " - " + anggaran_detail_2_nama_anggaran);
        $("#total_anggaran_budget").val(parseInt(budget));
        if (isunlimit == 1 || isunlimit == true || isunlimit == "true") {
            $("#cbunlimit").prop("checked", true);
        } else {
            $("#cbunlimit").prop("checked", false);
        }
        // $("#kode_anggaran_budget").val(kode_anggaran);
        $('#modalAddBudgeting').modal("show");
        let no = 1;
        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/Barjas/Anggaran/getListDetail3AnggaranById') ?>",
            data: {
                anggaran_detail_2_id: anggaran_detail_2_id,
            },
            success: function(response) {

                let no = 1;
                let data = response;

                if (data.length > 0) {
                    $.each(data, function(index, value) {

                        $('#tableBudget tbody').append(`
                        <tr>
                            <td style='vertical-align:middle; text-align: center;' >${value.anggaran_detail_3_urut_bulan}</td>
                            <td style='vertical-align:middle; ' >${value.anggaran_detail_3_nama_bulan}</td>
                            <td style='vertical-align:middle; ' >${formatRupiah(parseInt(value.anggaran_detail_3_jumlah) || 0)}</td>
                            <td style='vertical-align:middle; ' >${formatRupiah(parseInt(value.anggaran_detail_3_alokasi) || 0)}</td>
                            <td style='vertical-align:middle; ' >${formatRupiah(parseInt(value.anggaran_detail_3_terpakai) || 0)}</td>
                            <td style='vertical-align:middle; ' >${formatRupiah(parseInt(value.anggaran_detail_3_sisa) || 0)}</td>
                        </tr>
                    `);
                        no++;
                    });
                } else {
                    $("#tableBudget tbody").html('');
                }
            }
        });

    }

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }
</script>