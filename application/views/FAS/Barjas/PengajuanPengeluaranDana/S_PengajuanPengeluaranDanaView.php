<script>
    $("#btn_history_approval").click(
        function() {
            var dokumen_kode = '<?= $pengajuan_dana->pengajuan_dana_kode ?>';

            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/Approval/getHistoryApproval') ?>",
                data: {
                    dokumen_kode: dokumen_kode
                },
                success: function(response) {

                    let no = 1;
                    let data = response;

                    if ($.fn.DataTable.isDataTable('#tableHistoryApproval')) {
                        $('#tableHistoryApproval').DataTable().destroy();
                    }

                    $("#tableHistoryApproval tbody").empty();
                    $("#tableHistoryApproval tbody").html('');
                    if (data.length > 0) {
                        $.each(data, function() {
                            if (this.approval_status == "Approved") {
                                var color = "style='background-color:green;color:white'"
                            } else {
                                var color = "style='background-color:red;color:white'"
                            }
                            $("#txt_jenis_pengajuan").val(`${this.approval_reff_dokumen_jenis}`);

                            $('#tableHistoryApproval tbody').append(`
                                <tr>
                                    <td style='vertical-align:middle; text-align: center; ' >${no}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.tgl}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.approval_reff_dokumen_kode}</td>
                                    <td style='vertical-align:middle; text-align: center;' ><a ${color} class="btn btn-md">${this.approval_status}<a/></td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.karyawan_nama}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.approval_keterangan}</td>
                                </tr>
                            `);
                            no++;
                        });
                    } else {
                        $("#tableHistoryApproval tbody").html('');
                    }

                    $('#tableHistoryApproval').DataTable({
                        paging: false
                    });

                }
            });
            $('#modalHistoryApproval').modal('show');
        }
    );
</script>