<script type="text/javascript">
    $(document).ready(
        function() {
            $('.select2').select2();
        }
    );

    //start button group

    $("#btn-search-data-promo").click(function() {

        $("#loading").show();
        $("#btn-search-data-promo").prop("disabled", true);

        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/search_sku_promo_by_filter') ?>",
            data: {
                sku_promo_kode: $("#Filter-sku_promo_kode").val(),
                // depo_group_id: $("#Filter-depo_group_id").val(),
                // depo_id: $("#Filter-depo_id").val()
            },
            dataType: "JSON",
            success: function(response) {

                $("#loading").hide();
                $("#btn-search-data-promo").prop("disabled", false);

                $('#table-data-promo > tbody').empty('');

                if ($.fn.DataTable.isDataTable('#table-data-promo')) {
                    $('#table-data-promo').DataTable().clear();
                    $('#table-data-promo').DataTable().destroy();
                }

                if (response != 0) {
                    $.each(response, function(i, v) {

                        if (v.sku_promo_status == "Draft") {

                            $("#table-data-promo > tbody").append(`
                                <tr id="row-${i}">
                                    <td class="text-center">${i+1}</td>
                                    <td class="text-center">${v.sku_promo_kode}</td>
                                    <td class="text-center"><span id="item-${i}-promo-lokasi"></span></td>
                                    <td class="text-center">${v.sku_promo_tgl_berlaku_awal}</td>
                                    <td class="text-center">${v.sku_promo_tgl_berlaku_akhir}</td>
                                    <td class="text-center">${v.sku_promo_tgl_create}</td>
                                    <td class="text-center">${v.sku_promo_who_create}</td>
                                    <td class="text-center">${v.sku_promo_tgl_approved}</td>
                                    <td class="text-center">${v.sku_promo_who_aprroved}</td>
                                    <td class="text-center">${v.sku_promo_status}</td>
                                    <td class="text-center">
                                        <a href="<?= base_url() ?>FAS/MasterPricing/HargaDanPromo/Promo/edit/?id=${v.sku_promo_id}" target="_blank" class="btn btn-info btn-small"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            `);

                        } else if (v.sku_promo_status == "In Progress Approval") {

                            $("#table-data-promo > tbody").append(`
                                <tr id="row-${i}">
                                    <td class="text-center">${i+1}</td>
                                    <td class="text-center">${v.sku_promo_kode}</td>
                                    <td class="text-center"><span id="item-${i}-promo-lokasi"></span></td>
                                    <td class="text-center">${v.sku_promo_tgl_berlaku_awal}</td>
                                    <td class="text-center">${v.sku_promo_tgl_berlaku_akhir}</td>
                                    <td class="text-center">${v.sku_promo_tgl_create}</td>
                                    <td class="text-center">${v.sku_promo_who_create}</td>
                                    <td class="text-center">${v.sku_promo_tgl_approved}</td>
                                    <td class="text-center">${v.sku_promo_who_aprroved}</td>
                                    <td class="text-center">${v.sku_promo_status}</td>
                                    <td class="text-center">
                                        <a href="<?= base_url() ?>FAS/MasterPricing/HargaDanPromo/Promo/edit/?id=${v.sku_promo_id}" target="_blank" class="btn btn-info btn-small"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            `);

                        } else if (v.sku_promo_status == "Approved") {

                            $("#table-data-promo > tbody").append(`
                                <tr id="row-${i}">
                                    <td class="text-center">${i+1}</td>
                                    <td class="text-center">${v.sku_promo_kode}</td>
                                    <td class="text-center"><span id="item-${i}-promo-lokasi"></span></td>
                                    <td class="text-center">${v.sku_promo_tgl_berlaku_awal}</td>
                                    <td class="text-center">${v.sku_promo_tgl_berlaku_akhir}</td>
                                    <td class="text-center">${v.sku_promo_tgl_create}</td>
                                    <td class="text-center">${v.sku_promo_who_create}</td>
                                    <td class="text-center">${v.sku_promo_tgl_approved}</td>
                                    <td class="text-center">${v.sku_promo_who_aprroved}</td>
                                    <td class="text-center">${v.sku_promo_status}</td>
                                    <td class="text-center">
                                        <a href="<?= base_url() ?>FAS/MasterPricing/HargaDanPromo/Promo/detail/?id=${v.sku_promo_id}" target="_blank" class="btn btn-info btn-small"><i class="fa fa-search"></i></a>
                                        <a href="<?= base_url() ?>FAS/MasterPricing/HargaDanPromo/Promo/duplicate/?id=${v.sku_promo_id}" target="_blank" class="btn btn-danger btn-small"><i class="fa fa-copy"></i></a>
                                    </td>
                                </tr>
                            `);
                        }

                        var arr_lokasi = [];

                        $.ajax({
                            async: false,
                            type: 'GET',
                            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetPromoDepo') ?>",
                            data: {
                                sku_promo_id: v.sku_promo_id
                            },
                            dataType: "JSON",
                            success: function(response2) {

                                $("#item-" + i + "-promo-lokasi").html('');

                                if (response2 != 0) {
                                    $.each(response2, function(idx, val) {
                                        arr_lokasi.push(val.depo);
                                    });

                                    $("#item-" + i + "-promo-lokasi").append(arr_lokasi.toString());
                                }
                            }
                        });
                    });

                    $('#table-data-promo').DataTable();
                }
            }
        });

    });

    //end button group
</script>