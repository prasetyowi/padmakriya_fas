<script>
    $(document).ready(function() {
        // alert('aaa')
        $(".select2").select2({
            width: "100%"
        });
        $(".custom-select").select2({
            width: "100%"
        });
        $('#tablePengajuan').DataTable();
        if ($('#filter_tanggal').length > 0) {
            $('#filter_tanggal').daterangepicker({
                'applyClass': 'btn-sm btn-success',
                'cancelClass': 'btn-sm btn-default',
                locale: {
                    "format": "DD/MM/YYYY",
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel',
                },
                'startDate': '<?= date("01-m-Y") ?>',
                'endDate': '<?= date("t-m-Y") ?>'
            });
        }
    });

    //save pengajuan
    $('#PengajuanDana').submit(function(e) {
        e.preventDefault();
        let add_kategori_biaya_id = $("#add_kategori_biaya").val();
        let add_tipe_biaya_id = $("#add_tipe_biaya").val();
        let add_judul = $("#add_judul").val();
        let add_keterangan = $("#add_keterangan").val();
        let add_status = $("#add_status").val();
        let add_selected_date = $("#add_selected_date").val();
        let add_nilai = $("#add_nilai").val();
        let add_default_pembayaran = $("#add_default_pembayaran").val();
        let bank_account_id = $("#bank").val();
        let add_no_rekening = $("#add_no_rekening").val();
        let add_nama_penerima = $("#add_nama_penerima").val();
        let anggaran_detail_2_id = $('#add_anggaran_detail_2').val();
        //jika suadh ada file sebelumnya
        let is_file = $('#is_file').val();
        // let pengajuan_dana_attacment_1 = $('#approval_file').val();
        let attachment = $('#add_file');
        console.log($('#add_file_file'));

        if (add_status != 'Draft') {
            // jika file di database sebelumnya tidak ada
            if (is_file != 1) {
                if (attachment[0].files.length === 0) {
                    alert('Harap upload file atachment dahulu !')
                    return false;
                }
            }
        }

        // console.log(pengajuan_dana_attacment_1);
        if (anggaran_detail_2_id == '') {
            alert('Harap pilih anggaran terlebih dahulu!')
            return false;
        }
        if (add_default_pembayaran == "Tunai") {
            if (add_kategori_biaya_id == "" || add_tipe_biaya_id == "" || add_judul == "" || add_selected_date ==
                "" ||
                add_nilai == "" ||
                add_default_pembayaran == "" ||
                add_nama_penerima == "") {
                alert('Harap Lengkapi data dahulu !')
                return false;
            }
            bank_account_id = null;
            add_no_rekening = null;
        } else {
            if (add_kategori_biaya_id == "" || add_tipe_biaya_id == "" || add_judul == "" || add_selected_date ==
                "" ||
                add_nilai == "" ||
                add_default_pembayaran == "" || bank_account_id == "" || add_no_rekening == "" ||
                add_nama_penerima == "") {
                alert('Harap Lengkapi data dahulu !')
                return false;
            }
        }

        let files = attachment[0].files[0];
        var formData = new FormData(this);
        formData.append('file', files);
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
                    url: "<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/UpdatePengajuanDana') ?>",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
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
                                    "<?= base_url('FAS/Barjas/PengajuanPengeluaranDana/PengajuanPengeluaranDanaMenu') ?>";
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

    function delAttachment() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Ingin menghapus file yang ada!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value == true) {
                $('#spanAttachment').hide();
                $('#is_file').val(0);
            }
        })
    }

    function addApproval() {
        if ($('#chk_approval').is(':checked')) {
            $('#add_status').val('In progress approval')
        } else {
            $('#add_status').val('Draft')
        }
    }

    function formatRupiah(angka, prefix) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }
</script>