<script type="text/javascript">
    var ChannelCode = '';
    var arr_list_so = [];
    var arr_list_customer = [];
    var arr_list_sales = [];
    var arr_list_area = [];
    var arr_list_error = [];

    $('#select-sync-all-customer').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="CheckboxCustomer"]:checkbox').each(function() {
                this.checked = true;
                var data_customer = JSON.parse(this.getAttribute('data-customer'));
                arr_list_customer.push({
                    ...data_customer
                });
                // console.log(this.getAttribute('data-customer'));
            });
        } else {
            $('[name="CheckboxCustomer"]:checkbox').each(function() {
                this.checked = false;
                arr_list_customer = [];
            });
        }
    });

    $('#select-sync-all-sales').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="CheckboxSales"]:checkbox').each(function() {
                this.checked = true;

                var data_sales = JSON.parse(this.getAttribute('data-sales'));
                arr_list_sales.push({
                    ...data_sales
                });
            });
        } else {
            $('[name="CheckboxSales"]:checkbox').each(function() {
                this.checked = false;
                arr_list_sales = [];
            });
        }
    });

    $('#select-sync-all-area').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('[name="CheckboxArea"]:checkbox').each(function() {
                this.checked = true;

                var data_area = JSON.parse(this.getAttribute('data-area'));
                arr_list_area.push({
                    ...data_area
                });
            });
        } else {
            $('[name="CheckboxArea"]:checkbox').each(function() {
                this.checked = false;
                arr_list_area = [];
            });
        }
    });

    function message_custom(titleType, iconType, htmlType) {
        Swal.fire({
            title: titleType,
            icon: iconType,
            html: htmlType,
        });
    }

    $(document).ready(function() {
        GetSalesOrderMenu();
        $(".select2").select2();
    });

    function GetPrincipleByPerusahaan() {
        $.ajax({
            type: 'GET',
            url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/GetPrincipleByPerusahaan') ?>",
            data: {
                perusahaan: $("#perusahaan").val()
            },
            dataType: "JSON",
            success: function(response) {
                $("#principle").html('');
                $("#principle").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);

                if (response.length > 0) {
                    $.each(response, function(i, v) {
                        $("#principle").append(`<option value="${v.principle_kode}">${v.principle_kode}</option>`);
                    });
                }
            }
        });
    }


    function GetSalesOrderMenu() {
        $("#loadingview").show();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/GetSalesOrderMenu') ?>",
            //data: "Location="+ Location,
            success: function(response) {
                if (response) {
                    $("#loadingview").hide();
                    ChSalesOrderBosnetMenu(response);
                }
            }
        });
    }

    //var DTABLE;

    function ChSalesOrderBosnetMenu(JSONChannel) {
        var Channel = JSON.parse(JSONChannel);

        var StatusC = Channel.AuthorityMenu[0].menu_c;
        var StatusU = Channel.AuthorityMenu[0].menu_u;
        var StatusD = Channel.AuthorityMenu[0].menu_d;

        if (StatusC == 1) {
            $("#btnsavesobosnet").attr('style', 'display: ;');
        }

        GetSOFAS();

    }

    $("#btngenerateso").click(function() {
        var tgl = $("#datesobosnet").val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/proses_maping_so_eksternal_to_so_fas') ?>",
            dataType: "JSON",
            data: {
                tgl: tgl
            },
            beforeSend: function() {

                Swal.fire({
                    title: 'Loading ...',
                    html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                    timerProgressBar: false,
                    showConfirmButton: false
                });

                $("#loadingview").show();
                $("#btngenerateso").prop("disabled", true);
                $("#btnsavesobosnet").prop("disabled", true);
                $("#btnrefreshsobosnet").prop("disabled", true);
                $("#btnsyncalloutlet").prop("disabled", true);
                $("#btnsyncallsales").prop("disabled", true);
            },
            success: function(response) {

                if (response.length > 0) {
                    arr_list_error = response;

                    $('#btnerrormsg').fadeOut("slow", function() {
                        $(this).hide();
                        $("#CAPTION-JUMLAHERRORMSG").html('');
                    }).fadeIn("slow", function() {
                        $(this).show();
                        $("#CAPTION-JUMLAHERRORMSG").html('');
                        $("#CAPTION-JUMLAHERRORMSG").append(response.length);

                        document.getElementById("btnerrormsg").classList.add('btn-warning');
                        document.getElementById("btnerrormsg").classList.remove('btn-primary');
                    });
                } else {

                    document.getElementById("btnerrormsg").classList.add('btn-primary');
                    document.getElementById("btnerrormsg").classList.remove('btn-warning');
                    $("#CAPTION-JUMLAHERRORMSG").append(`0`);
                }

                $("#loadingview").hide();
                $("#btngenerateso").prop("disabled", false);
                $("#btnsavesobosnet").prop("disabled", false);
                $("#btnrefreshsobosnet").prop("disabled", false);
                $("#btnsyncalloutlet").prop("disabled", false);
                $("#btnsyncallsales").prop("disabled", false);

                let alert_tes = GetLanguageByKode('CAPTION-ALERT-GENERATEDSOEKSTERNALSUCCESS');
                // message("Success", alert_tes, "success");

                Swal.fire({
                    title: alert_tes,
                    text: "",
                    icon: "success",
                    // showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    // cancelButtonColor: "#d33",
                    confirmButtonText: "Oke",
                    // cancelButtonText: "Tidak, Tutup"
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.value == true) {
                        $("#btnrefreshsobosnet").click();
                    }
                })
            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");

                $("#loadingview").hide();
                $("#btngenerateso").prop("disabled", false);
                $("#btnsavesobosnet").prop("disabled", false);
                $("#btnrefreshsobosnet").prop("disabled", false);
                $("#btnsyncalloutlet").prop("disabled", false);
                $("#btnsyncallsales").prop("disabled", false);
            },
            complete: function() {
                $("#loadingview").hide();
                $("#btngenerateso").prop("disabled", false);
                $("#btnsavesobosnet").prop("disabled", false);
                $("#btnrefreshsobosnet").prop("disabled", false);
                $("#btnsyncalloutlet").prop("disabled", false);
                $("#btnsyncallsales").prop("disabled", false);
            }
        });

        // $.ajax({
        //     type: 'POST',
        //     url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/Insert_sales_order') ?>",
        //     data: {
        //         tgl: tgl
        //     },
        //     dataType: "JSON",
        //     success: function(response) {
        //         $("#loadingview").hide();
        //         $("#btngenerateso").prop("disabled", false);
        //         $("#btnsavesobosnet").prop("disabled", false);
        //         $("#btnrefreshsobosnet").prop("disabled", false);
        //         $("#btnsyncalloutlet").prop("disabled", false);
        //         $("#btnsyncallsales").prop("disabled", false);

        //         // console.log(response);
        //         $.each(response, function(i, v) {
        //             if (v == 1) {

        //                 let alert_tes = GetLanguageByKode(
        //                     'CAPTION-ALERT-GENERATEDSOEKSTERNALSUCCESS');
        //                 message_custom("Success", "success", alert_tes);

        //                 GetSOFAS();

        //             } else if (v == 2) {

        //                 let alert_tes = GetLanguageByKode(
        //                     'CAPTION-ALERT-MAPPINGSALESEKSTERNALNOTFOUND');

        //                 var msg = alert_tes;
        //                 var msgtype = 'error';

        //                 //if (!window.__cfRLUnblockHandlers) return false;
        //                 new PNotify
        //                     ({
        //                         title: 'Info',
        //                         text: msg,
        //                         type: msgtype,
        //                         styling: 'bootstrap3',
        //                         delay: 3000,
        //                         stack: stack_center
        //                     });
        //             } else if (v == 3) {
        //                 let alert_tes = GetLanguageByKode(
        //                     'CAPTION-ALERT-MAPPINGCUSTOMEREKSTERNALNOTFOUND');

        //                 var msg = alert_tes;
        //                 var msgtype = 'error';

        //                 //if (!window.__cfRLUnblockHandlers) return false;
        //                 new PNotify
        //                     ({
        //                         title: 'Info',
        //                         text: msg,
        //                         type: msgtype,
        //                         styling: 'bootstrap3',
        //                         delay: 3000,
        //                         stack: stack_center
        //                     });
        //             } else if (v == 4) {
        //                 let alert_tes = GetLanguageByKode('CAPTION-ALERT-SKUSTOCKNOTFOUND');

        //                 var msg = alert_tes;
        //                 var msgtype = 'error';

        //                 //if (!window.__cfRLUnblockHandlers) return false;
        //                 new PNotify
        //                     ({
        //                         title: 'Info',
        //                         text: msg,
        //                         type: msgtype,
        //                         styling: 'bootstrap3',
        //                         delay: 3000,
        //                         stack: stack_center
        //                     });
        //             } else if (v == 0) {
        //                 let alert_tes = GetLanguageByKode(
        //                     'CAPTION-ALERT-SOMESOEKSTERNALCANNOTBEGENERATED');

        //                 var msg = alert_tes;
        //                 var msgtype = 'error';

        //                 //if (!window.__cfRLUnblockHandlers) return false;
        //                 new PNotify
        //                     ({
        //                         title: 'Info',
        //                         text: msg,
        //                         type: msgtype,
        //                         styling: 'bootstrap3',
        //                         delay: 3000,
        //                         stack: stack_center
        //                     });
        //             } else if (v == 10) {
        //                 let alert_tes = GetLanguageByKode(
        //                     'CAPTION-ALERT-SOMESOFASCANNOTBEGENERATED');

        //                 var msg = alert_tes;
        //                 var msgtype = 'error';

        //                 //if (!window.__cfRLUnblockHandlers) return false;
        //                 new PNotify
        //                     ({
        //                         title: 'Info',
        //                         text: msg,
        //                         type: msgtype,
        //                         styling: 'bootstrap3',
        //                         delay: 3000,
        //                         stack: stack_center
        //                     });
        //             } else if (v == 11) {

        //                 let alert_tes = GetLanguageByKode(
        //                     'CAPTION-ALERT-GENERATEDSOFASSUCCESS');
        //                 message_custom("Success", "success", alert_tes);

        //             } else {

        //                 let alert_tes = GetLanguageByKode(
        //                     'CAPTION-ALERT-GENERATEDSOEKSTERNALFAILED');
        //                 message_custom("Error", "error", alert_tes);

        //             }
        //         })

        //         // console.log(response);

        //     },
        //     error: function(xhr, ajaxOptions, thrownError) {
        //         $("#loadingview").hide();
        //         $("#btngenerateso").prop("disabled", false);
        //         $("#btnsavesobosnet").prop("disabled", false);
        //         $("#btnrefreshsobosnet").prop("disabled", false);
        //         $("#btnsyncalloutlet").prop("disabled", false);
        //         $("#btnsyncallsales").prop("disabled", false);
        //     }
        // });
    });

    function ErrorMsgSO() {
        $("#modal-pesan-error").modal('show');

        if ($.fn.DataTable.isDataTable('#table-pesan-error')) {
            $('#table-pesan-error').DataTable().clear();
            $('#table-pesan-error').DataTable().destroy();
        }

        if (arr_list_error.length > 0) {

            $('#table-pesan-error').fadeOut("slow", function() {
                $(this).hide();
            }).fadeIn("slow", function() {
                $(this).show();

                $.each(arr_list_error, function(i, v) {

                    $("#table-pesan-error > tbody").append(`
                        <tr style="background: ${v.StatusMsg == "200" ? '#C0EBA6' : '#EAD8B1'}">
                            <td class="text-center" style="text-align: center; vertical-align: middle;">${i+1}</td>
                            <td class="text-center" style="text-align: center; vertical-align: middle;">${v.StatusMsg}</td>
                            <td class="text-center" style="text-align: center; vertical-align: middle;">${v.ErrMsg}</td>
                        </tr>
                    `)
                });

                $('#table-pesan-error').DataTable({
                    "lengthMenu": [
                        [50, 100],
                        [50, 100],
                    ],
                    "ordering": false,
                });
            });
        }
    }

    $("#btnsavesobosnet").click(
        function() {
            var tgl = $("#datesobosnet").val();
            var perusahaan = $("#perusahaan").val();
            var tipe_so = $("#tipe_so").val();
            var tipe_do = $("#tipe_do").val();
            var principle = $("#principle").val();

            $("#loadingview").show();
            $("#btngenerateso").prop("disabled", true);
            $("#btnsavesobosnet").prop("disabled", true);
            $("#btnrefreshsobosnet").prop("disabled", true);
            $("#btnsyncalloutlet").prop("disabled", true);
            $("#btnsyncallsales").prop("disabled", true);
            $("#btnsyncallarea").prop("disabled", true);

            if (perusahaan != "") {

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/GetSalesOrderBosnet') ?>",
                    data: {
                        tgl: tgl,
                        perusahaan: perusahaan,
                        tipe_so: tipe_so,
                        tipe_do: tipe_do,
                        principle: principle
                    },
                    success: function(response) {
                        if (response) {
                            // console.log(response);
                            ChSalesOrderBosnetTable(response);
                        }
                    }
                });

            } else {
                $("#loadingview").hide();
                $("#btngenerateso").prop("disabled", false);
                $("#btnsavesobosnet").prop("disabled", false);
                $("#btnrefreshsobosnet").prop("disabled", false);
                $("#btnsyncalloutlet").prop("disabled", false);
                $("#btnsyncallsales").prop("disabled", false);
                $("#btnsyncallarea").prop("disabled", false);

                var msg = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
                message_custom("Error", "error", msg);
            }
        }
    );

    $("#btnsavesobosnetwithoutdo").click(
        function() {
            var tgl = $("#datesobosnet").val();
            var perusahaan = $("#perusahaan").val();

            $("#loadingview").show();
            $("#btngenerateso").prop("disabled", true);
            $("#btnsavesobosnet").prop("disabled", true);
            $("#btnrefreshsobosnet").prop("disabled", true);
            $("#btnsyncalloutlet").prop("disabled", true);
            $("#btnsyncallsales").prop("disabled", true);

            if (perusahaan != "") {

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/GetSalesOrderBosnetWithoutDO') ?>",
                    data: {
                        tgl: tgl,
                        perusahaan: perusahaan
                    },
                    success: function(response) {
                        if (response) {
                            // console.log(response);
                            ChSalesOrderBosnetTable(response);
                        }
                    }
                });

            } else {
                $("#loadingview").hide();
                $("#btngenerateso").prop("disabled", false);
                $("#btnsavesobosnet").prop("disabled", false);
                $("#btnrefreshsobosnet").prop("disabled", false);
                $("#btnsyncalloutlet").prop("disabled", false);
                $("#btnsyncallsales").prop("disabled", false);

                var msg = GetLanguageByKode('CAPTION-ALERT-PERUSAHAANTIDAKDIPILIH');
                message_custom("Error", "error", msg);
            }
        }
    );

    $("#btnsyncalloutlet").click(function() {

        // console.log(arr_list_customer);

        if (arr_list_customer.length > 0) {
            $.each(arr_list_customer, function(i, v) {
                SyncCustomer(v.szCustId, v.no_urut, v.status, v.szFSoId, v.tglUpdate);
            });

            setTimeout(() => {
                GetSOFAS();
            }, 2000);
        } else {
            // let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCCUSTOMERGAGAL');
            let alert_tes = "Pilih Outlet";
            message_custom("Error", "error", alert_tes);

        }

        // var tgl = $("#datesobosnet").val();

        // $("#loadingview").show();
        // $("#btngenerateso").prop("disabled", true);
        // $("#btnsavesobosnet").prop("disabled", true);
        // $("#btnrefreshsobosnet").prop("disabled", true);
        // $("#btnsyncalloutlet").prop("disabled", true);
        // $("#btnsyncallsales").prop("disabled", true);

        // $.ajax({
        //     type: 'POST',
        //     url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/Sync_all_customer_bosnet') ?>",
        //     data: {
        //         tgl: tgl
        //     },
        //     dataType: "JSON",
        //     success: function(response) {
        //         $("#loadingview").hide();
        //         $("#btngenerateso").prop("disabled", false);
        //         $("#btnsavesobosnet").prop("disabled", false);
        //         $("#btnrefreshsobosnet").prop("disabled", false);
        //         $("#btnsyncalloutlet").prop("disabled", false);
        //         $("#btnsyncallsales").prop("disabled", false);

        //         if (response != "") {

        //             $.each(response, function(i, v) {
        //                 if (v.kode == 1) {

        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-SYNCCUSTOMERBERHASIL');
        //                     message_custom("Success", "success", alert_tes);

        //                     GetSOFAS();

        //                 } else if (v.kode == 2) {

        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-SYNCCUSTOMERPRINCIPLEGAGAL');

        //                     var msg = alert_tes;
        //                     var msgtype = 'error';

        //                     //if (!window.__cfRLUnblockHandlers) return false;
        //                     new PNotify
        //                         ({
        //                             title: 'Info',
        //                             text: msg,
        //                             type: msgtype,
        //                             styling: 'bootstrap3',
        //                             delay: 3000,
        //                             stack: stack_center
        //                         });
        //                 } else if (v.kode == 3) {
        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-SYNCCUSTOMERPRINCIPLEEKSTERNALGAGAL');

        //                     var msg = alert_tes;
        //                     var msgtype = 'error';

        //                     //if (!window.__cfRLUnblockHandlers) return false;
        //                     new PNotify
        //                         ({
        //                             title: 'Info',
        //                             text: msg,
        //                             type: msgtype,
        //                             styling: 'bootstrap3',
        //                             delay: 3000,
        //                             stack: stack_center
        //                         });
        //                 } else if (v.kode == 4) {
        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-PRINCIPLETIDAKADA');

        //                     var msg = alert_tes;
        //                     var msgtype = 'error';

        //                     //if (!window.__cfRLUnblockHandlers) return false;
        //                     new PNotify
        //                         ({
        //                             title: 'Info',
        //                             text: v.msg + " " + msg,
        //                             type: msgtype,
        //                             styling: 'bootstrap3',
        //                             delay: 3000,
        //                             stack: stack_center
        //                         });
        //                 } else if (v.kode == 5) {

        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-AREAEKSTERNALTIDAKADA');
        //                     var msg = alert_tes;
        //                     var msgtype = 'error';

        //                     //if (!window.__cfRLUnblockHandlers) return false;
        //                     new PNotify
        //                         ({
        //                             title: 'Info',
        //                             text: v.msg + " " + msg,
        //                             type: msgtype,
        //                             styling: 'bootstrap3',
        //                             delay: 3000,
        //                             stack: stack_center
        //                         });

        //                 } else if (v.kode == 0) {

        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-SYNCCUSTOMERGAGAL');
        //                     message_custom("Error", "error", alert_tes);

        //                 } else {

        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-SYNCCUSTOMERGAGAL');
        //                     message_custom("Error", "error", alert_tes);

        //                 }
        //             });

        //         } else {
        //             let alert_tes = GetLanguageByKode('CAPTION-ALERT-SUDAHSYNCCUSTOMER');
        //             message_custom("Warning", "warning", alert_tes);
        //         }
        //     },
        //     error: function(xhr, ajaxOptions, thrownError) {

        //         $("#loadingview").hide();
        //         $("#btngenerateso").prop("disabled", false);
        //         $("#btnsavesobosnet").prop("disabled", false);
        //         $("#btnrefreshsobosnet").prop("disabled", false);
        //         $("#btnsyncalloutlet").prop("disabled", false);
        //         $("#btnsyncallsales").prop("disabled", false);

        //         let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCCUSTOMERGAGAL');
        //         message_custom("Error", "error", alert_tes);
        //     }
        // });
    });

    $("#btnsyncallsales").click(function() {

        // console.log(arr_list_sales);

        if (arr_list_sales.length > 0) {
            $.each(arr_list_sales, function(i, v) {
                SyncSales(v.szSalesId, v.no_urut, v.status, v.szFSoId, v.tglUpdate);
            });

            setTimeout(() => {
                GetSOFAS();
            }, 2000);
        } else {
            // let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCCUSTOMERGAGAL');
            let alert_tes = "Pilih Sales";
            message_custom("Error", "error", alert_tes);

        }

        // var tgl = $("#datesobosnet").val();

        // $("#loadingview").show();
        // $("#btngenerateso").prop("disabled", true);
        // $("#btnsavesobosnet").prop("disabled", true);
        // $("#btnrefreshsobosnet").prop("disabled", true);
        // $("#btnsyncalloutlet").prop("disabled", true);
        // $("#btnsyncallsales").prop("disabled", true);

        // $.ajax({
        //     type: 'POST',
        //     url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/Sync_all_sales_bosnet') ?>",
        //     data: {
        //         tgl: tgl
        //     },
        //     dataType: "JSON",
        //     success: function(response) {
        //         $("#loadingview").hide();
        //         $("#btngenerateso").prop("disabled", false);
        //         $("#btnsavesobosnet").prop("disabled", false);
        //         $("#btnrefreshsobosnet").prop("disabled", false);
        //         $("#btnsyncalloutlet").prop("disabled", false);
        //         $("#btnsyncallsales").prop("disabled", false);

        //         if (response != "") {

        //             $.each(response, function(i, v) {
        //                 if (v.kode == 1) {

        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-SYNCSALESBERHASIL');
        //                     message_custom("Success", "success", alert_tes);

        //                     GetSOFAS();

        //                 } else if (v.kode == 2) {

        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-SYNCSALESPRINCIPLEGAGAL');

        //                     var msg = alert_tes;
        //                     var msgtype = 'error';

        //                     //if (!window.__cfRLUnblockHandlers) return false;
        //                     new PNotify
        //                         ({
        //                             title: 'Info',
        //                             text: msg,
        //                             type: msgtype,
        //                             styling: 'bootstrap3',
        //                             delay: 3000,
        //                             stack: stack_center
        //                         });
        //                 } else if (v.kode == 3) {
        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-SYNCSALESPRINCIPLEEKSTERNALGAGAL');

        //                     var msg = alert_tes;
        //                     var msgtype = 'error';

        //                     //if (!window.__cfRLUnblockHandlers) return false;
        //                     new PNotify
        //                         ({
        //                             title: 'Info',
        //                             text: msg,
        //                             type: msgtype,
        //                             styling: 'bootstrap3',
        //                             delay: 3000,
        //                             stack: stack_center
        //                         });
        //                 } else if (v.kode == 4) {
        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-PRINCIPLETIDAKADA');

        //                     var msg = alert_tes;
        //                     var msgtype = 'error';

        //                     //if (!window.__cfRLUnblockHandlers) return false;
        //                     new PNotify
        //                         ({
        //                             title: 'Info',
        //                             text: v.msg + " " + msg,
        //                             type: msgtype,
        //                             styling: 'bootstrap3',
        //                             delay: 3000,
        //                             stack: stack_center
        //                         });
        //                 } else if (v.kode == 5) {
        //                     let alert_tes = GetLanguageByKode(
        //                         'CAPTION-ALERT-MAPPINGDEPOTIDAKADA');

        //                     var msg = alert_tes;
        //                     var msgtype = 'error';

        //                     //if (!window.__cfRLUnblockHandlers) return false;
        //                     new PNotify
        //                         ({
        //                             title: 'Info',
        //                             text: v.msg + " " + msg,
        //                             type: msgtype,
        //                             styling: 'bootstrap3',
        //                             delay: 3000,
        //                             stack: stack_center
        //                         });
        //                 } else if (v.kode == 0) {

        //                     let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCSALESGAGAL');
        //                     message_custom("Error", "error", alert_tes);

        //                 } else {

        //                     let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCSALESGAGAL');
        //                     message_custom("Error", "error", alert_tes);

        //                 }
        //             });

        //         } else {
        //             let alert_tes = GetLanguageByKode('CAPTION-ALERT-SUDAHSYNCSALES');
        //             message_custom("Warning", "warning", alert_tes);
        //         }
        //     },
        //     error: function(xhr, ajaxOptions, thrownError) {

        //         $("#loadingview").hide();
        //         $("#btngenerateso").prop("disabled", false);
        //         $("#btnsavesobosnet").prop("disabled", false);
        //         $("#btnrefreshsobosnet").prop("disabled", false);
        //         $("#btnsyncalloutlet").prop("disabled", false);
        //         $("#btnsyncallsales").prop("disabled", false);

        //         let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCCUSTOMERGAGAL');
        //         message_custom("Error", "error", alert_tes);
        //     }
        // });
    });

    $("#btnsyncallarea").click(function() {

        if (arr_list_area.length > 0) {
            // console.log(arr_list_area);
            $.each(arr_list_area, function(i, v) {
                SyncArea(v.client_pt_id, v.szCustId, v.szFSoId, v.no_urut, v.status, v.szDeliveryGroupId, v.tglUpdate);
            });

            setTimeout(() => {
                GetSOFAS();
            }, 2000);

        } else {
            let alert_tes = GetLanguageByKode('CAPTION-ALERT-PILIHAREA');
            // let alert_tes = "Pilih Area";
            message_custom("Error", "error", alert_tes);

        }
    });

    function ChSalesOrderBosnetTable(JSONChannel) {

        var Channel = JSON.parse(JSONChannel);
        var counter = 0;

        arr_list_so = []

        if (Channel.SalesOrderMenu != "CAPTION-ALERT-MAPPINGDEPOTIDAKADA") {

            if (Channel.SalesOrderMenu != 0) {

                for (i = 0; i < Channel.SalesOrderMenu.length; i++) {
                    var szFSoId = Channel.SalesOrderMenu[i].szFSoId;
                    arr_list_so.push(szFSoId);
                }

                $.ajax({
                    async: false,
                    type: 'POST',
                    url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/SaveSalesOrderBosnet') ?>",
                    data: {
                        arr_list_so: arr_list_so
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $("#loadingview").hide();
                        $("#btngenerateso").prop("disabled", false);
                        $("#btnsavesobosnet").prop("disabled", false);
                        $("#btnrefreshsobosnet").prop("disabled", false);
                        $("#btnsyncalloutlet").prop("disabled", false);
                        $("#btnsyncallsales").prop("disabled", false);

                        // console.log(response);
                        $.each(response, function(i, v) {
                            if (v.kode == 1) {
                                message_custom("Hasil", "", v.msg);
                            } else if (v.kode == 2) {
                                let alert_tes = GetLanguageByKode(
                                    'CAPTION-ALERT-MAPPINGSALESEKSTERNALNOTFOUND');

                                var msg = alert_tes;
                                var msgtype = 'error';

                                //if (!window.__cfRLUnblockHandlers) return false;
                                new PNotify
                                    ({
                                        title: 'Info',
                                        text: msg,
                                        type: msgtype,
                                        styling: 'bootstrap3',
                                        delay: 3000,
                                        stack: stack_center
                                    });
                            } else if (v.kode == 3) {
                                let alert_tes = GetLanguageByKode(
                                    'CAPTION-ALERT-MAPPINGCUSTOMEREKSTERNALNOTFOUND');

                                var msg = alert_tes;
                                var msgtype = 'error';

                                //if (!window.__cfRLUnblockHandlers) return false;
                                new PNotify
                                    ({
                                        title: 'Info',
                                        text: msg,
                                        type: msgtype,
                                        styling: 'bootstrap3',
                                        delay: 3000,
                                        stack: stack_center
                                    });
                            } else if (v.kode == 4) {
                                let alert_tes = GetLanguageByKode('CAPTION-ALERT-SKUSTOCKNOTFOUND');

                                var msg = alert_tes;
                                var msgtype = 'error';

                                //if (!window.__cfRLUnblockHandlers) return false;
                                new PNotify
                                    ({
                                        title: 'Info',
                                        text: msg,
                                        type: msgtype,
                                        styling: 'bootstrap3',
                                        delay: 3000,
                                        stack: stack_center
                                    });
                            } else if (v.kode == 0) {
                                let alert_tes = GetLanguageByKode(
                                    'CAPTION-ALERT-SOMESOEKSTERNALCANNOTBEGENERATED');

                                var msg = alert_tes;
                                var msgtype = 'error';

                                //if (!window.__cfRLUnblockHandlers) return false;
                                new PNotify
                                    ({
                                        title: 'Info',
                                        text: msg,
                                        type: msgtype,
                                        styling: 'bootstrap3',
                                        delay: 3000,
                                        stack: stack_center
                                    });
                            } else if (v.kode == 10) {
                                let alert_tes = GetLanguageByKode(
                                    'CAPTION-ALERT-SOMESOFASCANNOTBEGENERATED');

                                var msg = alert_tes;
                                var msgtype = 'error';

                                //if (!window.__cfRLUnblockHandlers) return false;
                                new PNotify
                                    ({
                                        title: 'Info',
                                        text: msg,
                                        type: msgtype,
                                        styling: 'bootstrap3',
                                        delay: 3000,
                                        stack: stack_center
                                    });
                            } else if (v.kode == 11) {

                                let alert_tes = GetLanguageByKode(
                                    'CAPTION-ALERT-GENERATEDSOFASSUCCESS');
                                message_custom("Success", "success", alert_tes);

                            } else {

                                let alert_tes = GetLanguageByKode(
                                    'CAPTION-ALERT-GENERATEDSOEKSTERNALFAILED');
                                message_custom("Error", "error", alert_tes);

                            }
                        })

                        // console.log(response);

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#loadingview").hide();
                        $("#btngenerateso").prop("disabled", false);
                        $("#btnsavesobosnet").prop("disabled", false);
                        $("#btnrefreshsobosnet").prop("disabled", false);
                        $("#btnsyncalloutlet").prop("disabled", false);
                        $("#btnsyncallsales").prop("disabled", false);
                    }
                });
            } else {
                $("#loadingview").hide();
                $("#btngenerateso").prop("disabled", false);
                $("#btnsavesobosnet").prop("disabled", false);
                $("#btnrefreshsobosnet").prop("disabled", false);
                $("#btnsyncalloutlet").prop("disabled", false);
                $("#btnsyncallsales").prop("disabled", false);
            }

            GetSOFAS();
        } else if (Channel.SalesOrderMenu != "CAPTION-ALERT-PRINCIPLETIDAKDIPILIH") {
            $("#loadingview").hide();
            $("#btngenerateso").prop("disabled", false);
            $("#btnsavesobosnet").prop("disabled", false);
            $("#btnrefreshsobosnet").prop("disabled", false);
            $("#btnsyncalloutlet").prop("disabled", false);
            $("#btnsyncallsales").prop("disabled", false);

            let alert_tes = GetLanguageByKode('CAPTION-ALERT-PRINCIPLETIDAKDIPILIH');
            message_custom("Error", "error", alert_tes);
        } else {
            $("#loadingview").hide();
            $("#btngenerateso").prop("disabled", false);
            $("#btnsavesobosnet").prop("disabled", false);
            $("#btnrefreshsobosnet").prop("disabled", false);
            $("#btnsyncalloutlet").prop("disabled", false);
            $("#btnsyncallsales").prop("disabled", false);

            let alert_tes = GetLanguageByKode('CAPTION-ALERT-MAPPINGDEPOTIDAKADA');
            message_custom("Error", "error", alert_tes);
        }

    }

    $("#btnrefreshsobosnet").click(
        function() {
            GetSOFAS();
        }
    );

    function GetSOFAS() {

        var tgl = $("#datesobosnet").val();
        var status = $("#status_sync").val();

        $("#select-sync-all-sales").prop("checked", false);
        $("#select-sync-all-customer").prop("checked", false);
        $("#select-sync-all-area").prop("checked", false);

        $("#loadingview").show();
        $("#btngenerateso").prop("disabled", true);
        $("#btnsavesobosnet").prop("disabled", true);
        $("#btnrefreshsobosnet").prop("disabled", true);
        $("#btnsyncalloutlet").prop("disabled", true);
        $("#btnsyncallsales").prop("disabled", true);
        $("#btnsyncallarea").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/GetSalesOrderBosnetInFAS') ?>",
            data: {
                tgl: tgl,
                status: status
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

                $("#loadingview").hide();
                $("#btngenerateso").prop("disabled", false);
                $("#btnsavesobosnet").prop("disabled", false);
                $("#btnrefreshsobosnet").prop("disabled", false);
                $("#btnsyncalloutlet").prop("disabled", false);
                $("#btnsyncallsales").prop("disabled", false);
                $("#btnsyncallarea").prop("disabled", false);

                $("#table-so-bosnet-in-fas > tbody").empty();
                $("#table-so-bosnet-not-in-fas > tbody").empty();

                if ($.fn.DataTable.isDataTable('#table-so-bosnet-in-fas')) {
                    $('#table-so-bosnet-in-fas').DataTable().clear();
                    $('#table-so-bosnet-in-fas').DataTable().destroy();
                }

                if ($.fn.DataTable.isDataTable('#table-so-bosnet-not-in-fas')) {
                    $('#table-so-bosnet-not-in-fas').DataTable().clear();
                    $('#table-so-bosnet-not-in-fas').DataTable().destroy();
                }

                if (response.SOInFAS != 0) {
                    $.each(response.SOInFAS, function(i, v) {
                        var decAmount = parseInt(v.decAmount);
                        $('#table-so-bosnet-in-fas > tbody').append(`
							<tr>
								<td class="text-center">
									<input type="hidden" name="txt_jml_so" id="txt_jml_so" value="${response.SOInFAS.length}">
									<input type="hidden" name="txt_so_' + i + '" id="txt_so_' + i + '" value="${v.szFSoId}">
									${v.szFSoId}
								</td>
								<td class="text-center">${v.dtmOrder}</td>
								<td class="text-center">${v.client_pt_nama}</td>
								<td class="text-center">${v.principle_kode}</td>
								<td class="text-center">${v.karyawan_nama}</td>
								<td class="text-center">${formatRupiah(decAmount.toString())}</td>
							</tr>';	
						`);
                    });
                    $('#table-so-bosnet-in-fas').DataTable({
                        "lengthMenu": [
                            [10, 50, 100],
                            [10, 50, 100],
                        ],
                        "ordering": false,
                    });
                }

                if (response.SONotInFAS != 0) {
                    $.each(response.SONotInFAS, function(i, v) {

                        const data_customer = {
                            'szCustId': v.szCustId,
                            'no_urut': i,
                            'customer_status': v.customer_status,
                            'szFSoId': v.szFSoId,
                            'tglUpdate': v.tglUpdate
                        }

                        const data_sales = {
                            'szSalesId': v.szSalesId,
                            'no_urut': i,
                            'sales_status': v.sales_status,
                            'szFSoId': v.szFSoId,
                            'tglUpdate': v.tglUpdate
                        }

                        const data_area = {
                            'client_pt_id': v.client_pt_id,
                            'szCustId': v.szCustId,
                            'szFSoId': v.szFSoId,
                            'no_urut': i,
                            'area_status': v.area_status,
                            'szDeliveryGroupId': v.szDeliveryGroupId,
                            'tglUpdate': v.tglUpdate
                        }

                        var decAmount = parseInt(v.decAmount);
                        $('#table-so-bosnet-not-in-fas > tbody').append(`
							<tr>
								<td class="text-center">
									<input type="hidden" name="txt_jml_so" id="txt_jml_so" value="${response.SONotInFAS.length}">
									<input type="hidden" name="txt_so_' + i + '" id="txt_so_' + i + '" value="${v.szFSoId}">
									${v.szFSoId}
								</td>
								<td class="text-center">${v.dtmOrder}</td>
								<td class="text-center">${v.szCustId}</td>
								<td class="text-center">${v.szSalesId}</td>
								<td class="text-center">${formatRupiah(decAmount.toString())}</td>
								<td class="text-center">
									<span id="item-${i}-loading-customer" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                    <input type="checkbox" name="${v.customer_status == '1' ? 'CheckboxCustomerChecked' : 'CheckboxCustomer'}" id="item-${i}-sync-customer" value="${v.szCustId}" data-customer='${JSON.stringify({...data_customer})}' OnClick="PushArrayCustomer('${v.szCustId}',${i},'${v.customer_status}', '${v.szFSoId}', '${v.tglUpdate}')" ${v.customer_status == '1' ? 'disabled checked' : ''}>
									<button class="btn ${v.customer_status == '1' ? 'btn-success' : 'btn-danger'} btn-sm btn-sync" id="item-${i}-customer_status">${v.customer_status == '1' ? 'SYNCED' : 'NOT SYNCED'}</button>
								</td>
								<td class="text-center">
									<span id="item-${i}-loading-sales" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                    <input type="checkbox" name="${v.sales_status == '1' ? 'CheckboxSalesChecked' : 'CheckboxSales'}" id="item-${i}-sync-sales" value="${v.szCustId}" data-sales='${JSON.stringify({...data_sales})}' OnClick="PushArraySales('${v.szSalesId}',${i},'${v.sales_status}', '${v.szFSoId}', '${v.tglUpdate}')" ${v.sales_status == '1' ? 'disabled checked' : ''}>
									<button class="btn ${v.sales_status == '1' ? 'btn-success' : 'btn-danger'} btn-sm btn-sync" id="item-${i}-sales_status">${v.sales_status == '1' ? 'SYNCED' : 'NOT SYNCED'}</button>
								</td>
                                <td class="text-center">
									<span id="item-${i}-loading-area" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                    <input type="checkbox" name="${v.area_status == '1' ? 'CheckboxAreaChecked' : 'CheckboxArea'}" id="item-${i}-sync-area" value="${v.szCustId}" data-area='${JSON.stringify({...data_area})}' OnClick="PushArrayArea('${v.client_pt_id}','${v.szCustId}','${v.szFSoId}',${i},'${v.area_status}', '${v.szDeliveryGroupId}', '${v.tglUpdate}')" ${v.area_status == '1' ? 'disabled checked' : ''}>
									<button class="btn ${v.area_status == '1' ? 'btn-success' : 'btn-danger'} btn-sm btn-sync" id="item-${i}-area_status">${v.area_status == '1' ? 'SYNCED' : 'NOT SYNCED'}</button>
								</td>
							</tr>';	
						`);
                    });
                    $('#table-so-bosnet-not-in-fas').DataTable({
                        "lengthMenu": [
                            [10, 50, 100],
                            [10, 50, 100],
                        ],
                        "ordering": false
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                message("Error", "Error 500 Internal Server Connection Failure", "error");
            },
            complete: function() {
                Swal.close();
            }
        });
    }

    function SyncCustomer(szCustId, idx, status, szFSoId, tglUpdate) {

        $("#item-" + idx + "-loading-customer").show();
        $("#select-sync-all-customer").prop("disabled", true);
        $("#select-sync-all-sales").prop("disabled", true);
        $("#select-sync-all-area").prop("disabled", true);

        if (status != "1") {

            requestAjax("<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/Sync_customer_bosnet'); ?>", {
                customer_id: szCustId,
                szFSoId: szFSoId,
                tglUpdate: tglUpdate
            }, "POST", "JSON", function(response) {
                $("#item-" + idx + "-loading-customer").hide();
                $("#select-sync-all-customer").prop("disabled", false);
                $("#select-sync-all-sales").prop("disabled", false);
                $("#select-sync-all-area").prop("disabled", false);

                if (response != "") {
                    if (response == 400) {
                        return messageNotSameLastUpdated();
                    } else {

                        $.each(response, function(i, v) {
                            arr_list_error.push({
                                "StatusMsg": v.StatusMsg,
                                "ErrMsg": v.ErrMsg
                            });
                        });

                        $('#btnerrormsg').fadeOut("slow", function() {
                            $(this).hide();
                            $("#CAPTION-JUMLAHERRORMSG").html('');
                        }).fadeIn("slow", function() {
                            $(this).show();
                            $("#CAPTION-JUMLAHERRORMSG").html('');
                            $("#CAPTION-JUMLAHERRORMSG").append(arr_list_error.length);

                            document.getElementById("btnerrormsg").classList.add('btn-warning');
                            document.getElementById("btnerrormsg").classList.remove('btn-primary');
                        });

                        let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCCUSTOMERSUCCESS');
                        message_custom("Success", "success", alert_tes);
                    }
                } else {
                    let alert_tes = "Error 500 Internal Server Error";
                    message_custom("Error", "error", alert_tes);
                }
            });

        } else {
            let alert_tes = GetLanguageByKode('CAPTION-ALERT-SUDAHSYNCCUSTOMER');
            var msg = alert_tes;
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

        }

        // $.ajax({
        // 	type: 'POST',
        // 	url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/Sync_customer_bosnet') ?>",
        // 	data: {
        // 		customer_id: szCustId,
        // 		szFSoId: szFSoId,
        // 		tglUpdate: tglUpdate
        // 	},
        // 	dataType: "JSON",
        // 	success: function(response) {
        // 		$("#item-" + idx + "-loading-customer").hide();
        // 		$("#item-" + idx + "-customer_status").prop("disabled", false);
        // 		$(".btn-sync").prop("disabled", false);

        // 		if (response != "") {
        // 			if (response == 400) {
        // 				return messageNotSameLastUpdated();
        // 			} else {

        // 				$.each(response, function(i, v) {
        // 					if (v.kode == 1) {

        // 						let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCCUSTOMERBERHASIL');
        // 						message_custom("Success", "success", alert_tes);

        // 						GetSOFAS();

        // 					} else if (v.kode == 2) {

        // 						let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCCUSTOMERPRINCIPLEGAGAL');

        // 						var msg = alert_tes;
        // 						var msgtype = 'error';

        // 						//if (!window.__cfRLUnblockHandlers) return false;
        // 						new PNotify
        // 							({
        // 								title: 'Info',
        // 								text: msg,
        // 								type: msgtype,
        // 								styling: 'bootstrap3',
        // 								delay: 3000,
        // 								stack: stack_center
        // 							});
        // 					} else if (v.kode == 3) {
        // 						let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCCUSTOMERPRINCIPLEEKSTERNALGAGAL');

        // 						var msg = alert_tes;
        // 						var msgtype = 'error';

        // 						//if (!window.__cfRLUnblockHandlers) return false;
        // 						new PNotify
        // 							({
        // 								title: 'Info',
        // 								text: msg,
        // 								type: msgtype,
        // 								styling: 'bootstrap3',
        // 								delay: 3000,
        // 								stack: stack_center
        // 							});
        // 					} else if (v.kode == 4) {
        // 						let alert_tes = GetLanguageByKode('CAPTION-ALERT-PRINCIPLETIDAKADA');

        // 						var msg = alert_tes;
        // 						var msgtype = 'error';

        // 						//if (!window.__cfRLUnblockHandlers) return false;
        // 						new PNotify
        // 							({
        // 								title: 'Info',
        // 								text: msg,
        // 								type: msgtype,
        // 								styling: 'bootstrap3',
        // 								delay: 3000,
        // 								stack: stack_center
        // 							});
        // 					} else if (v.kode == 5) {

        // 						let alert_tes = GetLanguageByKode('CAPTION-ALERT-AREAEKSTERNALTIDAKADA');
        // 						var msg = alert_tes;
        // 						var msgtype = 'error';

        // 						//if (!window.__cfRLUnblockHandlers) return false;
        // 						new PNotify
        // 							({
        // 								title: 'Info',
        // 								text: msg,
        // 								type: msgtype,
        // 								styling: 'bootstrap3',
        // 								delay: 3000,
        // 								stack: stack_center
        // 							});

        // 					} else if (v.kode == 0) {

        // 						let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCCUSTOMERGAGAL');
        // 						message_custom("Error", "error", alert_tes);

        // 					} else {

        // 						let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCCUSTOMERGAGAL');
        // 						message_custom("Error", "error", alert_tes);

        // 					}
        // 				})
        // 			}
        // 		} else {
        // 			let alert_tes = GetLanguageByKode('CAPTION-ALERT-SUDAHSYNCCUSTOMER');
        // 			message_custom("Warning", "warning", alert_tes);
        // 		}
        // 	},
        // 	error: function(xhr, ajaxOptions, thrownError) {

        // 		$("#item-" + idx + "-loading-customer").hide();
        // 		$("#item-" + idx + "-customer_status").prop("disabled", false);
        // 		$(".btn-sync").prop("disabled", false);

        // 		let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCCUSTOMERGAGAL');
        // 		message_custom("Error", "error", alert_tes);
        // 	}
        // });
        // } else {

        // 	let alert_tes = GetLanguageByKode('CAPTION-ALERT-SUDAHSYNCCUSTOMER');
        // 	message_custom("Warning", "warning", alert_tes);

        // }

    }

    function SyncSales(szSalesId, idx, status) {
        // if (status == 0) {

        $("#item-" + idx + "-loading-sales").show();
        $("#select-sync-all-customer").prop("disabled", true);
        $("#select-sync-all-sales").prop("disabled", true);
        $("#select-sync-all-area").prop("disabled", true);

        if (status != "1") {

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/Sync_sales_bosnet') ?>",
                data: {
                    sales_id: szSalesId
                },
                dataType: "JSON",
                success: function(response) {
                    $("#item-" + idx + "-loading-sales").hide();
                    $("#select-sync-all-customer").prop("disabled", false);
                    $("#select-sync-all-sales").prop("disabled", false);
                    $("#select-sync-all-area").prop("disabled", false);

                    if (response != "") {

                        $.each(response, function(i, v) {
                            if (v.kode == 1) {
                                let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCSALESBERHASIL');
                                message_custom("Success", "success", alert_tes);

                            } else if (v.kode == 2) {

                                let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCSALESPRINCIPLEGAGAL');

                                var msg = alert_tes;
                                var msgtype = 'error';

                                //if (!window.__cfRLUnblockHandlers) return false;
                                new PNotify
                                    ({
                                        title: 'Info',
                                        text: msg,
                                        type: msgtype,
                                        styling: 'bootstrap3',
                                        delay: 3000,
                                        stack: stack_center
                                    });
                            } else if (v.kode == 3) {
                                let alert_tes = GetLanguageByKode(
                                    'CAPTION-ALERT-SYNCSALESPRINCIPLEEKSTERNALGAGAL');

                                var msg = alert_tes;
                                var msgtype = 'error';

                                //if (!window.__cfRLUnblockHandlers) return false;
                                new PNotify
                                    ({
                                        title: 'Info',
                                        text: msg,
                                        type: msgtype,
                                        styling: 'bootstrap3',
                                        delay: 3000,
                                        stack: stack_center
                                    });
                            } else if (v.kode == 4) {
                                let alert_tes = GetLanguageByKode('CAPTION-ALERT-PRINCIPLETIDAKADA');

                                var msg = alert_tes;
                                var msgtype = 'error';

                                //if (!window.__cfRLUnblockHandlers) return false;
                                new PNotify
                                    ({
                                        title: 'Info',
                                        text: v.msg + " " + msg,
                                        type: msgtype,
                                        styling: 'bootstrap3',
                                        delay: 3000,
                                        stack: stack_center
                                    });
                            } else if (v.kode == 5) {
                                let alert_tes = GetLanguageByKode('CAPTION-ALERT-MAPPINGDEPOTIDAKADA');

                                var msg = alert_tes;
                                var msgtype = 'error';

                                //if (!window.__cfRLUnblockHandlers) return false;
                                new PNotify
                                    ({
                                        title: 'Info',
                                        text: v.msg + " " + msg,
                                        type: msgtype,
                                        styling: 'bootstrap3',
                                        delay: 3000,
                                        stack: stack_center
                                    });
                            } else if (v.kode == 0) {

                                let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCSALESGAGAL');
                                message_custom("Error", "error", alert_tes);

                            } else {

                                let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCSALESGAGAL');
                                message_custom("Error", "error", alert_tes);

                            }
                        })

                    } else {
                        let alert_tes = GetLanguageByKode('CAPTION-ALERT-SUDAHSYNCSALES');
                        message_custom("Warning", "warning", alert_tes);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {

                    $("#item-" + idx + "-loading-sales").hide();
                    $("#item-" + idx + "-sales_status").prop("disabled", false);
                    $(".btn-sync").prop("disabled", false);

                    let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCSALESGAGAL');
                    message_custom("Error", "error", alert_tes);
                }
            });

        } else {
            let alert_tes = GetLanguageByKode('CAPTION-ALERT-SUDAHSYNCCUSTOMER');
            var msg = alert_tes;
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

        }
        // } else {

        // 	let alert_tes = GetLanguageByKode('CAPTION-ALERT-SUDAHSYNCSALES');
        // 	message_custom("Warning", "warning", alert_tes);

        // }
    }

    function SyncArea(client_pt_id, szCustId, szFSoId, idx, status, szDeliveryGroupId, tglUpdate) {
        // if (status == 0) {

        $("#item-" + idx + "-loading-area").show();
        $("#select-sync-all-customer").prop("disabled", true);
        $("#select-sync-all-sales").prop("disabled", true);
        $("#select-sync-all-area").prop("disabled", true);

        if (status != "1") {

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/SistemEksternal/DownloadSOBosnet/Sync_area_bosnet') ?>",
                data: {
                    client_pt_id: client_pt_id,
                    szCustId: szCustId,
                    szFSoId: szFSoId,
                    szDeliveryGroupId: szDeliveryGroupId
                },
                dataType: "JSON",
                success: function(response) {
                    $("#item-" + idx + "-loading-area").hide();
                    $("#select-sync-all-customer").prop("disabled", false);
                    $("#select-sync-all-sales").prop("disabled", false);
                    $("#select-sync-all-area").prop("disabled", false);

                    if (response != "") {

                        $.each(response, function(i, v) {
                            if (v.status == 200) {
                                message_custom("Success", "success", GetLanguageByKode(v.msg));
                            } else if (v.status == 500) {

                                $("#item-" + idx + "-sync-area").prop("checked", false);

                                var msg = v.msg;
                                var msgtype = 'error';

                                //if (!window.__cfRLUnblockHandlers) return false;
                                new PNotify
                                    ({
                                        title: 'Info',
                                        text: v.kode + " " + GetLanguageByKode(v.msg),
                                        type: msgtype,
                                        styling: 'bootstrap3',
                                        delay: 3000,
                                        stack: stack_center
                                    });
                            } else if (v.status == 404) {

                                $("#item-" + idx + "-sync-area").prop("checked", false);

                                var msg = v.msg;
                                var msgtype = 'error';

                                //if (!window.__cfRLUnblockHandlers) return false;
                                new PNotify
                                    ({
                                        title: 'Info',
                                        text: v.kode + " " + GetLanguageByKode(v.msg),
                                        type: msgtype,
                                        styling: 'bootstrap3',
                                        delay: 3000,
                                        stack: stack_center
                                    });
                            } else {
                                $("#item-" + idx + "-sync-area").prop("checked", false);

                                let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCAREAFAILED');
                                message_custom("Error", "error", alert_tes);
                            }
                        });

                    } else {
                        let alert_tes = GetLanguageByKode('CAPTION-ALERT-SUDAHSYNCSALES');
                        message_custom("Warning", "warning", alert_tes);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {

                    $("#item-" + idx + "-loading-sales").hide();
                    $("#item-" + idx + "-sales_status").prop("disabled", false);
                    $(".btn-sync").prop("disabled", false);

                    let alert_tes = GetLanguageByKode('CAPTION-ALERT-SYNCSALESGAGAL');
                    message_custom("Error", "error", alert_tes);
                }
            });

        } else {
            let alert_tes = GetLanguageByKode('CAPTION-ALERT-SUDAHSYNCAREA');
            var msg = alert_tes;
            var msgtype = 'error';

            //if (!window.__cfRLUnblockHandlers) return false;
            new PNotify
                ({
                    title: 'Info',
                    text: msg,
                    type: msgtype,
                    styling: 'bootstrap3',
                    delay: 3000,
                    stack: stack_center
                });

        }
    }

    function PushArraySales(szSalesId, idx, sales_status, szFSoId, tglUpdate) {

        var checked = $('[id="item-' + idx + '-sync-sales"]:checked').length;

        $("#select-sync-all-sales").prop("checked", false);

        if (checked > 0) {

            arr_list_sales.push({
                'szSalesId': szSalesId,
                'no_urut': idx,
                'sales_status': sales_status,
                'szFSoId': szFSoId,
                'tglUpdate': tglUpdate
            });

            const uniqueArray = [];
            const seenIds = {};

            for (const obj of arr_list_sales) {
                if (!seenIds[obj.szFSoId]) {
                    seenIds[obj.szFSoId] = true;
                    uniqueArray.push(obj);
                }
            }

            arr_list_sales = uniqueArray;
        } else {
            const findIndexData = arr_list_sales.findIndex((value) => value.no_urut == idx);
            if (findIndexData > -1) { // only splice array when item is found
                arr_list_sales.splice(findIndexData, 1); // 2nd parameter means remove one item only
            }
        }
    }

    function PushArrayCustomer(szCustId, idx, customer_status, szFSoId, tglUpdate) {

        // console.log(idx);
        var checked = $('[id="item-' + idx + '-sync-customer"]:checked').length;

        $("#select-sync-all-customer").prop("checked", false);

        if (checked > 0) {

            arr_list_customer.push({
                'szCustId': szCustId,
                'no_urut': idx,
                'customer_status': customer_status,
                'szFSoId': szFSoId,
                'tglUpdate': tglUpdate
            });

            const uniqueArray = [];
            const seenIds = {};

            for (const obj of arr_list_customer) {
                if (!seenIds[obj.szFSoId]) {
                    seenIds[obj.szFSoId] = true;
                    uniqueArray.push(obj);
                }
            }

            arr_list_customer = uniqueArray;
        } else {
            const findIndexData = arr_list_customer.findIndex((value) => value.no_urut == idx);
            if (findIndexData > -1) { // only splice array when item is found
                arr_list_customer.splice(findIndexData, 1); // 2nd parameter means remove one item only
            }
        }
    }

    function PushArrayArea(client_pt_id, szCustId, szFSoId, idx, area_status, szDeliveryGroupId, tglUpdate) {

        // console.log(idx);
        var checked = $('[id="item-' + idx + '-sync-area"]:checked').length;

        $("#select-sync-all-area").prop("checked", false);

        if (checked > 0) {

            arr_list_area.push({
                'client_pt_id': client_pt_id,
                'szCustId': szCustId,
                'szFSoId': szFSoId,
                'no_urut': idx,
                'area_status': area_status,
                'szDeliveryGroupId': szDeliveryGroupId,
                'tglUpdate': tglUpdate
            });

            const uniqueArray = [];
            const seenIds = {};

            for (const obj of arr_list_area) {
                if (!seenIds[obj.szFSoId]) {
                    seenIds[obj.szFSoId] = true;
                    uniqueArray.push(obj);
                }
            }

            arr_list_area = uniqueArray;

            // console.log(arr_list_area);

        } else {
            const findIndexData = arr_list_area.findIndex((value) => value.no_urut == idx);
            if (findIndexData > -1) { // only splice array when item is found
                arr_list_area.splice(findIndexData, 1); // 2nd parameter means remove one item only
            }
        }
    }

    <?php
    if ($Menu_Access["D"] == 1) {
    ?>
        $("#btnnodeletechannel").click(
            function() {
                GetSalesOrderMenu();
            }
        );

    <?php
    }
    ?>

    <?php
    if ($Menu_Access["U"] == 1) {
    ?>

    <?php
    }
    ?>

    <?php
    if ($Menu_Access["C"] == 1) {
    ?>

    <?php
    }
    ?>

    function ResetForm() {
        <?php
        if ($Menu_Access["U"] == 1) {
        ?>
            $("#txtupdatechannelnama").val('');
            $("#cbupdatechanneljenis").prop('selectedIndex', 0);
            $("#chupdatechannelsppbr").prop('checked', false);
            $("#chupdatechanneltipeecomm").prop('checked', false);
            $("#chupdatechannelisactive").prop('checked', false);

            $("#loadingupdate").hide();
            $("#btnsaveupdatenewchannel").prop("disabled", false);
        <?php
        }
        ?>

        <?php
        if ($Menu_Access["C"] == 1) {
        ?>
            $("#txtchannelnama").val('');
            $("#cbchanneljenis").prop('selectedIndex', 0);
            $("#chchannelsppbr").prop('checked', false);
            $("#chchanneltipeecomm").prop('checked', false);
            $("#chchannelisactive").prop('checked', false);

            $("#loadingadd").hide();
            $("#btnsaveaddnewchannel").prop("disabled", false);
        <?php
        }
        ?>

    }
</script>