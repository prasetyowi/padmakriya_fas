<script type="text/javascript">
    var arr_customer_eksternal = [];

    $(document).ready(function() {
        $(".select2").select2({
            width: "100%"
        });

        $('.selectpicker').selectpicker();
    });

    function message_custom(titleType, iconType, htmlType) {
        Swal.fire({
            title: titleType,
            icon: iconType,
            html: htmlType,
        });
    }

    function message(msg, msgtext, msgtype) {
        Swal.fire(msg, msgtext, msgtype);
    }

    function message_topright(titleType, iconType, htmlType) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

        Toast.fire({
            title: titleType,
            icon: iconType,
            html: htmlType,
        });
    }

    $("#filter_perusahaan").on("change", function() {
        initDataCustomer();
    });

    $("#filter-slc_sistem_eksternal").on("change", function() {
        $('#filter-slc_sistem_eksternal').selectpicker('refresh');
        $("#tablecustomerprinciple > tbody").empty();

        if ($("#filter-slc_sistem_eksternal").val() != "") {
            initDataCustomerPrinciple($("#filter-client_pt_id").val());
        }
    });

    $("#btnsavecustomerprinciple").on("click", function() {
        var check_error = 0;
        arr_customer_eksternal = [];

        $("#tablecustomerprinciple > tbody tr").each(function(idx) {
            if ($("#item-" + idx + "-ClientPTPrincipleEksternal-principle_id").val() != "" && $("#item-" + idx + "-ClientPTPrincipleEksternal-customer_eksternal_id").val() != "" && $("#item-" + idx + "-ClientPTPrincipleEksternal-sistem_eksternal").val() != "") {
                arr_customer_eksternal.push({
                    'sistem_eksternal': $("#item-" + idx + "-ClientPTPrincipleEksternal-sistem_eksternal").val(),
                    'principle_id': $("#item-" + idx + "-ClientPTPrincipleEksternal-principle_id").val(),
                    'customer_eksternal_id': $("#item-" + idx + "-ClientPTPrincipleEksternal-customer_eksternal_id").val()
                });
            } else {
                check_error++;
            }
        });

        Swal.fire({
            title: "Are you sure?",
            text: "Check Input Data is Correct!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.value == true) {
                //ajax save data

                if (check_error == 0) {
                    $("#loadingviewprinciple").show();

                    $.ajax({
                        async: false,
                        url: "<?= base_url('FAS/ManagementPelanggan/MappingPelangganEksternal/Insert_client_pt_principle_eksternal'); ?>",
                        type: "POST",
                        data: {
                            client_pt_id: $("#filter-client_pt_id").val(),
                            list_customer: arr_customer_eksternal
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data == 1) {
                                $("#loadingviewprinciple").hide();
                                $("#modalcustomerprinciple").modal('hide');

                                let alert_tes = $('span[name="CAPTION-ALERT-DATABERHASILDISIMPAN').eq(0).text();
                                message_topright("Success", "success", alert_tes);

                            } else {
                                $("#loadingviewprinciple").hide();

                                let alert_tes = $('span[name="CAPTION-ALERT-DATAGAGALDISIMPAN"]').eq(0).text();
                                message_topright("Error", "error", alert_tes);
                            }
                        }
                    });
                } else {
                    $("#loadingviewprinciple").hide();

                    let alert_tes = $('span[name="CAPTION-ALERT-CHECKCUSTOMEREKSTERNAL"]').eq(0).text();
                    message_custom("Error", "error", alert_tes);
                }
            }
        });
    });

    function initDataCustomerPrinciple(client_pt_id) {
        var sistem_eksternal = $("#filter-slc_sistem_eksternal").val();
        var arr_sistem_eksternal = sistem_eksternal != null ? sistem_eksternal.toString().split(",") : '';
        var idx = 0;

        $("#loadingviewprinciple").show();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/ManagementPelanggan/MappingPelangganEksternal/GetCustomerPrincipleById') ?>",
            data: {
                client_pt_id: client_pt_id
            },
            dataType: "JSON",
            success: function(response) {

                $("#tablecustomerprinciple > tbody").empty();

                if (response != 0) {
                    $.each(response, function(i, v) {
                        if (arr_sistem_eksternal != "") {
                            for (var x = 0; x < arr_sistem_eksternal.length; x++) {
                                if (v.sistem_eksternal == arr_sistem_eksternal[x]) {
                                    $("#tablecustomerprinciple > tbody").append(`
                                        <tr>
                                            <td class="text-center">${v.sistem_eksternal}</td>
                                            <td class="text-center">${v.principle_kode}</td>
                                            <td class="text-center">
                                                <input type="hidden" id="item-${idx}-ClientPTPrincipleEksternal-sistem_eksternal" class="form-control input-sm" value="${v.sistem_eksternal}">
                                                <input type="hidden" id="item-${idx}-ClientPTPrincipleEksternal-principle_id" class="form-control input-sm" value="${v.principle_id}">
                                                <input type="text" id="item-${idx}-ClientPTPrincipleEksternal-customer_eksternal_id" class="form-control input-sm" value="${v.customer_eksternal_id}">
                                            </td>
                                        </tr>
                                    `);
                                } else {
                                    $("#tablecustomerprinciple > tbody").append(`
                                        <tr>
                                            <td class="text-center">${arr_sistem_eksternal[x]}</td>
                                            <td class="text-center">${v.principle_kode}</td>
                                            <td class="text-center">
                                                <input type="hidden" id="item-${idx}-ClientPTPrincipleEksternal-sistem_eksternal" class="form-control input-sm" value="${arr_sistem_eksternal[x]}">
                                                <input type="hidden" id="item-${idx}-ClientPTPrincipleEksternal-principle_id" class="form-control input-sm" value="${v.principle_id}">
                                                <input type="text" id="item-${idx}-ClientPTPrincipleEksternal-customer_eksternal_id" class="form-control input-sm" value="">
                                            </td>
                                        </tr>
                                    `);
                                }
                                idx++;
                            }
                        } else {
                            if (v.sistem_eksternal != "") {
                                $("#tablecustomerprinciple > tbody").append(`
                                    <tr>
                                        <td class="text-center">${v.sistem_eksternal}</td>
                                        <td class="text-center">${v.principle_kode}</td>
                                        <td class="text-center">
                                            <input type="hidden" id="item-${idx}-ClientPTPrincipleEksternal-sistem_eksternal" class="form-control input-sm" value="${v.sistem_eksternal}">
                                            <input type="hidden" id="item-${idx}-ClientPTPrincipleEksternal-principle_id" class="form-control input-sm" value="${v.principle_id}">
                                            <input type="text" id="item-${idx}-ClientPTPrincipleEksternal-customer_eksternal_id" class="form-control input-sm" value="${v.customer_eksternal_id}">
                                        </td>
                                    </tr>
                                `);
                            } else {
                                $("#tablecustomerprinciple > tbody").append(`
                                    <tr>
                                        <td colspan="3" class="text-danger text-center">Data Kosong</td>
                                    </tr>
                                `);
                            }

                            idx++;
                        }
                    });

                    $("#btnsavecustomerprinciple").prop("disabled", false);
                } else {
                    $("#tablecustomerprinciple > tbody").append(`
                        <tr>
                            <td colspan="3" class="text-danger text-center">Data Kosong</td>
                        </tr>
                    `);
                    $("#btnsavecustomerprinciple").prop("disabled", true);
                }

                $("#loadingviewprinciple").hide();
            }
        });
    }

    function initDataCustomer() {
        if ($("#filter_perusahaan").val() != "") {

            $("#loadingviewindex").show();
            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/ManagementPelanggan/MappingPelangganEksternal/GetCustomerByFilter') ?>",
                data: {
                    perusahaan: $("#filter_perusahaan").val()
                },
                dataType: "JSON",
                success: function(response) {

                    $("#tableoutletmenu > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#tableoutletmenu')) {
                        $('#tableoutletmenu').DataTable().clear();
                        $('#tableoutletmenu').DataTable().destroy();
                    }

                    if (response != 0) {
                        $.each(response, function(i, v) {
                            $("#tableoutletmenu > tbody").append(`
							<tr>
							    <td class="text-center">${i+1}</td>
								<td class="text-center">${v.client_pt_nama}</td>
								<td class="text-center">${v.client_pt_alamat}</td>
								<td class="text-center">${v.client_pt_telepon}</td>
								<td class="text-center">${v.client_pt_is_aktif == 1 ? 'Aktif' : 'Tidak Aktif' }</td>
								<td class="text-center">
                                    <button type="button" id="btncustomerprinciple" class="btn btn-sm btn-warning" onClick="GetCustomerPrinciple('${v.client_pt_id}','${v.client_pt_nama}','${v.client_pt_alamat}','${v.client_pt_telepon}','${i}')"><i class="fa fa-pencil"></i></button>
                                </td>
							</tr>
						`);
                        });
                        $('#tableoutletmenu').DataTable({
                            'ordering': false
                        });
                    } else {
                        $("#tableoutletmenu > tbody").append(`
                            <tr>
                                <td colspan="6" class="text-danger text-center">Data Kosong</td>
                            </tr>
                        `);
                    }

                    $("#loadingviewindex").hide();
                }
            });
        } else {
            $("#tableoutletmenu > tbody").empty();

            if ($.fn.DataTable.isDataTable('#tableoutletmenu')) {
                $('#tableoutletmenu').DataTable().clear();
                $('#tableoutletmenu').DataTable().destroy();
            }

            $("#tableoutletmenu > tbody").append(`
                <tr>
                    <td colspan="6" class="text-danger text-center">Data Kosong</td>
                </tr>
            `);
        }
    }

    function GetCustomerPrinciple(client_pt_id, client_pt_nama, client_pt_alamat, client_pt_telepon) {
        $("#modalcustomerprinciple").modal('show');

        $("#filter-client_pt_id").val('');
        $("#filter-client_pt_nama").html('');
        $("#filter-client_pt_alamat").html('');
        $("#filter-client_pt_telepon").html('');

        $("#filter-client_pt_id").val(client_pt_id);
        $("#filter-client_pt_nama").append(client_pt_nama);
        $("#filter-client_pt_alamat").append(client_pt_alamat);
        $("#filter-client_pt_telepon").append(client_pt_telepon);

        if ($("#filter-slc_sistem_eksternal").val() != "") {
            initDataCustomerPrinciple(client_pt_id);
        } else {
            $("#tablecustomerprinciple > tbody").empty();
        }
    }
</script>