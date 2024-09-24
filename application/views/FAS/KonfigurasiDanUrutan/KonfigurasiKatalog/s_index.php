<script type="text/javascript">
    $(document).ready(
        function() {
            $('.select2').select2();
        }
    );

    //start button group

    $("#btn_search_konfigurasi").click(function() {

        $("#loading").show();
        $("#btn_search_konfigurasi").prop("disabled", true);

        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/GetKonfigurasiKatalogByFilter') ?>",
            data: {
                sku_katalog_setting_id: $("#Filter-sku_katalog_setting_id").val()
            },
            dataType: "JSON",
            success: function(response) {

                $("#loading").hide();
                $("#btn_search_konfigurasi").prop("disabled", false);

                $('#table-data-konfigurasi > tbody').empty('');

                if ($.fn.DataTable.isDataTable('#table-data-konfigurasi')) {
                    $('#table-data-konfigurasi').DataTable().clear();
                    $('#table-data-konfigurasi').DataTable().destroy();
                }

                if (response != 0) {
                    $.each(response, function(i, v) {

                        $("#table-data-konfigurasi > tbody").append(`
                            <tr id="row-${i}">
                                <td class="text-center">${i+1}</td>
                                <td class="text-center">${v.sku_katalog_setting_kode}</td>
                                <td class="text-center">${v.sku_katalog_setting_keterangan}</td>
                                <td class="text-center">${v.sku_katalog_setting_who_create}</td>
                                <td class="text-center">${v.sku_katalog_setting_tgl_create}</td>
                                <td class="text-center">${v.sku_katalog_setting_who_approve}</td>
                                <td class="text-center">${v.sku_katalog_setting_tgl_approve}</td>
                                <td class="text-center ${v.sku_katalog_setting_is_aktif == 'ACTIVE' ? 'text-success' : 'text-danger'}">${v.sku_katalog_setting_is_aktif}</td>
                                <td class="text-center">
                                    <a href="<?= base_url() ?>FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/edit/?id=${v.sku_katalog_setting_id}" target="_blank" class="btn btn-info btn-small"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                        `);

                        // if (v.sku_katalog_setting_status == "Draft") {

                        //     $("#table-data-konfigurasi > tbody").append(`
                        //         <tr id="row-${i}">
                        //             <td class="text-center">${i+1}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_kode}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_keterangan}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_status}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_who_create}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_tgl_create}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_who_approve}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_tgl_approve}</td>
                        //             <td class="text-center ${v.sku_katalog_setting_is_aktif == 'ACTIVE' ? 'text-success' : 'text-danger'}">${v.sku_katalog_setting_is_aktif}</td>
                        //             <td class="text-center">
                        //                 <a href="<?= base_url() ?>FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/edit/?id=${v.sku_katalog_setting_id}" target="_blank" class="btn btn-info btn-small"><i class="fa fa-pencil"></i></a>
                        //             </td>
                        //         </tr>
                        //     `);

                        // } else if (v.sku_katalog_setting_status == "In Progress Approval") {

                        //     $("#table-data-konfigurasi > tbody").append(`
                        //         <tr id="row-${i}">
                        //             <td class="text-center">${i+1}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_kode}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_keterangan}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_status}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_who_create}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_tgl_create}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_who_approve}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_tgl_approve}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_is_aktif}</td>
                        //             <td class="text-center ${v.sku_katalog_setting_is_aktif == 'ACTIVE' ? 'text-success' : 'text-danger'}">
                        //                 <a href="<?= base_url() ?>FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/edit/?id=${v.sku_katalog_setting_id}" target="_blank" class="btn btn-info btn-small"><i class="fa fa-pencil"></i></a>
                        //             </td>
                        //         </tr>
                        //     `);

                        // } else if (v.sku_katalog_setting_status == "Approved") {

                        //     $("#table-data-konfigurasi > tbody").append(`
                        //         <tr id="row-${i}">
                        //             <td class="text-center">${i+1}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_kode}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_keterangan}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_status}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_who_create}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_tgl_create}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_who_approve}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_tgl_approve}</td>
                        //             <td class="text-center">${v.sku_katalog_setting_is_aktif}</td>
                        //             <td class="text-center ${v.sku_katalog_setting_is_aktif == 'ACTIVE' ? 'text-success' : 'text-danger'}">
                        //                 <a href="<?= base_url() ?>FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/detail/?id=${v.sku_katalog_setting_id}" target="_blank" class="btn btn-info btn-small"><i class="fa fa-search"></i></a>
                        //             </td>
                        //         </tr>
                        //     `);
                        // }
                    });

                    $('#table-data-konfigurasi').DataTable();
                }
            }
        });

    });

    //end button group
</script>