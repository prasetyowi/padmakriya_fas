<script type="text/javascript">
    var arr_sku_except = [];
    $(document).ready(function() {
        //inisialisasi awal
        $('.select2').select2();
        $('.tableReferensi').DataTable();

        //menampilkan form grup sku
        $('#sku_grup').on('change', function() {
            if (this.value == '') {
                $("#usingSku").hide("slow");
                $("#notSku").hide("slow");
            } else if (this.value == '1') {
                $("#withSku > tbody").empty();
                $("#usingSku").show("slow");
                $("#notSku").hide("slow");
            } else {
                $("#withoutSku > tbody").empty();
                $("#notSku").show("slow");
                $("#usingSku").hide("slow");
            }
        });

        $('#sku_grup_change').on('change', function() {
            if (this.value == '') {
                $("#usingSku").hide("slow");
                $("#notSku").hide("slow");
            } else if (this.value == '1') {
                $("#withSku > tbody").empty();
                $("#usingSku").show("slow");
                $("#notSku").hide("slow");
            } else {
                $("#withoutSku > tbody").empty();
                $("#notSku").show("slow");
                $("#usingSku").hide("slow");
            }
        });

        let skugrup = $("#skugrup").val();
        if (skugrup == 0) {
            $("#notSku").show();
            $("#usingSku").hide();
        } else if (skugrup == 1) {
            $("#usingSku").show();
            $("#notSku").hide();
        } else {
            $("#usingSku").hide();
            $("#notSku").hide();
        }

        $("#tipe_data").change(function() {
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = currentDate.getMonth() + 1; // Returns 0-11
            var day = currentDate.getDate();
            var resetDate = day + "/" + month + "/" + year;

            if ($(this).val() == "FE53E319-268E-4B69-A50A-2583ECFBAEED") {
                $("#showsearchapproved").show("slow");
                $("#shownosuratbaru").show("slow");
                $("#no_surat_promo").prop("disabled", true);
                $("#aksi").css("display", "none");
                $("#aksi2").css("display", "none");
                $("#add_row").css("display", "none");
                $("#carisku").css("display", "none");
            } else {
                $("#showsearchapproved").hide("slow");
                $("#shownosuratbaru").hide("slow");
                $("#no_surat_promo").prop("disabled", false);
                $("#usingSku").hide("slow");
                $("#notSku").hide("slow");
                $("#kode_referensi").val("");
                $("#tgl_dibuat").val(resetDate);
                $("#tgl_promo_awal").val(resetDate);
                $("#tgl_promo_akhir").val(resetDate);
                $("#status").val("Draft");
                $("#no_surat_promo").val("");
                $("#keterangan").val("");
                $("#notif_pemakaian").val("");
                $("#total_alokasi").val();
                $("#in_qty").prop("checked", "checked");
                $("#in_value").prop("checked", "checked");
                $("#btn-save-referensi").removeAttr("reff-id", true);
                $("#tipe_promo").val("").change();
                $("#client_wms").val("").change();
                $("#principle").val("").change();
                $("#sku_grup").val("").change();
                $("#tipe_promo").prop("disabled", false);
                $("#client_wms").prop("disabled", false);
                $("#principle").prop("disabled", false);
                $("#sku_grup").prop("disabled", false);
                $("#tgl_promo_awal").prop("disabled", false);
                $("#tgl_promo_akhir").prop("disabled", false);
                $("#in_qty").prop("disabled", false);
                $("#in_value").prop("disabled", false);
                $("#chk_pilih_except").prop("disabled", false);
                $("#add_row").removeAttr("style");
                $("#carisku").removeAttr("style");
            }
        })

        //untuk tambah baris tabel temp
        $("#add_row").click(function() {
            var principle = $("#principle").val();

            if (principle == "") {
                message_topright("warning", "Pilih Principle dahulu!");
                return false;
            } else {
                //set ajax untuk onchange multiple select sku grup dan nama dari tabel kategori
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getSkuGrup') ?>",
                    data: {
                        id: principle
                    },
                    dataType: "JSON",
                    success: function(response) {
                        var markup = '';
                        var grup_sku =
                            '<option value=""><label name="">Pilih grup sku</label></option>';

                        if (response.length > 0) {
                            //perulangan untuk select option yg dipilih berdasarkan sku grup yg memiliki key pada principle yg dipilih
                            //dimana sku grup yg menjadi acuan adalah brand dan principle
                            let rowCount = $('#usingSku table tbody tr').length;
                            var lineNo = rowCount + 1;
                            $.each(response, function(i, v) {
                                if (v.kategori_grup == 'Brand') {
                                    grup_sku +=
                                        '<option value="Brand"><label name="">Brand</label></option>';
                                } else if (v.kategori_grup == 'Principle') {
                                    grup_sku +=
                                        '<option value="Principle"><label name="">Principle</label></option>';
                                } else if (v.kategori_grup == 'Category') {
                                    grup_sku +=
                                        '<option value="Category"><label name="">Category</label></option>';
                                } else if (v.kategori_grup == 'Sub Category') {
                                    grup_sku +=
                                        '<option value="Sub Category"><label name="">Sub Category</label></option>';
                                } else if (v.kategori_grup == 'Jenis') {
                                    grup_sku +=
                                        '<option value="Jenis"><label name="">Jenis</label></option>';
                                } else {
                                    grup_sku +=
                                        `<option value="${v.kategori_grup}"><label name="">${v.kategori_grup}</label></option>`;
                                }
                            })
                        }

                        if ($("#in_qty").is(":checked") && $("#in_value").is(":checked")) {
                            markup += "<tr> <td>" + lineNo + "</td>";
                            markup +=
                                "<td> <select id='grupSku-" + lineNo +
                                "' name='grupSku' class='form-control select2' onchange='getGrupSku(" +
                                lineNo + ", this.value)' required> " +
                                grup_sku + " </select></td>";
                            markup +=
                                "<td><select id='grupNama-" + lineNo +
                                "' name='grupNama' class='form-control select2' required><option value='' selected><label name=''> Pilih nama grup </label></option></select></td>";
                            markup +=
                                "<td> <input class='form-control' type='text' id='inQty' value='' onkeyup='formatNominal(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57'> </td>";
                            markup +=
                                "<td> <input class='form-control' type='text' id='inValue' value='' onkeyup='formatNominal(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57'> </td>";
                            markup +=
                                "<td><input class='alokasi alokasi-add form-control' type='text' id='alokasi" +
                                lineNo +
                                "' name='alokasi' value='' onkeyup='formatNominal(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57' disabled></td>";
                            markup +=
                                "<td class='text-center'><button id='exceptproduk" + lineNo +
                                "' name='exceptproduk' onclick='certainSku(" +
                                lineNo +
                                ")' style='width: auto;' class='btn btn-success form-control'><i class='fa fa-gear'></i></button></td>";
                            markup +=
                                "<td class='text-center'><button style='width: 40px;' class='btn btn-danger form-control' onclick='delRow(this)'><i class='fa fa-close'></i></button></td></tr>";

                        } else if ($("#in_qty").is(":checked") && $("#in_value").not(
                                ":checked")) {
                            markup += "<tr> <td>" + lineNo + "</td>";
                            markup +=
                                "<td> <select id='grupSku-" + lineNo +
                                "' name='grupSku' class='form-control select2' onchange='getGrupSku(" +
                                lineNo + ", this.value)' required> " +
                                grup_sku + " </select></td>";
                            markup +=
                                "<td><select id='grupNama-" + lineNo +
                                "' name='grupNama' class='form-control select2' required><option value='' selected><label name=''> Pilih nama grup </label></option></select></td>";
                            markup +=
                                "<td> <input class='form-control' type='text' id='inQty' value='' onkeyup='formatNominal(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57'> </td>";
                            markup +=
                                "<td> <input class='form-control' type='text' id='inValue' value='' onkeyup='formatNominal(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57' disabled> </td>";
                            markup +=
                                "<td><input class='alokasi alokasi-add form-control' type='text' id='alokasi" +
                                lineNo +
                                "' name='alokasi' value='' onkeyup='formatNominal(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57' disabled></td>";
                            markup +=
                                "<td class='text-center'><button id='exceptproduk" + lineNo +
                                "' name='exceptproduk' onclick='certainSku(" +
                                lineNo +
                                ")' style='width: auto;' class='btn btn-success form-control'><i class='fa fa-gear'></i></button></td>";
                            markup +=
                                "<td class='text-center'><button style='width: 40px;' class='btn btn-danger form-control' onclick='delRow(this)'><i class='fa fa-close'></i></button></td></tr>";

                        } else if ($("#in_qty").not(":checked") && $("#in_value").is(
                                ":checked")) {
                            markup += "<tr> <td>" + lineNo + "</td>";
                            markup +=
                                "<td> <select id='grupSku-" + lineNo +
                                "' name='grupSku' class='form-control select2' onchange='getGrupSku(" +
                                lineNo + ", this.value)' required> " +
                                grup_sku + " </select></td>";
                            markup +=
                                "<td><select id='grupNama-" + lineNo +
                                "' name='grupNama' class='form-control select2' required><option value='' selected><label name=''> Pilih nama grup </label></option></select></td>";
                            markup +=
                                "<td> <input class='form-control' type='text' id='inQty' value='' onkeyup='formatNominal(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57' disabled> </td>";
                            markup +=
                                "<td> <input class='form-control' type='text' id='inValue' value='' onkeyup='formatNominal(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57'> </td>";
                            markup +=
                                "<td><input class='alokasi alokasi-add form-control' type='text' id='alokasi" +
                                lineNo +
                                "' name='alokasi' value='' onkeyup='formatNominal(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57' disabled></td>";
                            markup +=
                                "<td class='text-center'><button id='exceptproduk" + lineNo +
                                "' name='exceptproduk' onclick='certainSku(" +
                                lineNo +
                                ")' style='width: auto;' class='btn btn-success form-control'><i class='fa fa-gear'></i></button></td>";
                            markup +=
                                "<td class='text-center'><button style='width: 40px;' class='btn btn-danger form-control' onclick='delRow(this)'><i class='fa fa-close'></i></button></td></tr>";

                        } else if ($("#in_qty").not(":checked") && $("#in_value").not(
                                ":checked")) {
                            markup += "<tr> <td>" + lineNo + "</td>";
                            markup +=
                                "<td> <select id='grupSku-" + lineNo +
                                "' name='grupSku' class='form-control select2' onchange='getGrupSku(" +
                                lineNo + ", this.value)' required> " +
                                grup_sku + " </select></td>";
                            markup +=
                                "<td><select id='grupNama-" + lineNo +
                                "' name='grupNama' class='form-control select2' required><option value='' selected><label name=''> Pilih nama grup </label></option></select></td>";
                            markup +=
                                "<td> <input class='form-control' type='text' id='inQty' value='' onkeyup='formatNominal(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57' disabled> </td>";
                            markup +=
                                "<td> <input class='form-control' type='text' id='inValue' value='' onkeyup='formatNominal(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57' disabled> </td>";
                            markup +=
                                "<td><input class='alokasi alokasi-add form-control' type='text' id='alokasi" +
                                lineNo +
                                "' name='alokasi' value='' onkeypress='return event.charCode >= 48 && event.charCode <= 57' disabled></td>";
                            markup +=
                                "<td class='text-center'><button id='exceptproduk" + lineNo +
                                "' name='exceptproduk' onclick='certainSku(" +
                                lineNo +
                                ")' style='width: auto;' class='btn btn-success form-control'><i class='fa fa-gear'></i></button></td>";
                            markup +=
                                "<td class='text-center'><button style='width: 40px;' class='btn btn-danger form-control' onclick='delRow(this)'><i class='fa fa-close'></i></button></td></tr>";
                        }
                        tableBody = $("#usingSku table tbody");
                        tableBody.append(markup);
                        lineNo++;
                    }
                });
            }
        });

        //untuk tambah baris tabel temp duplicate
        $("#add_row_detail").click(function() {
            var principle = $("#principle").val();

            if (principle == "") {
                message_topright("warning", "Pilih Principle dahulu!");
                return false;
            } else {
                //set ajax untuk onchange multiple select sku grup dan nama dari tabel kategori
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getSkuGrup') ?>",
                    data: {
                        id: principle
                    },
                    dataType: "JSON",
                    success: function(response) {
                        // console.log(response);
                        var markup = '';
                        var grup_sku =
                            '<option value=""><label name="">Pilih grup sku</label></option>';

                        if (response.length > 0) {
                            //perulangan untuk select option yg dipilih berdasarkan sku grup yg memiliki key pada principle yg dipilih
                            //dimana sku grup yg menjadi acuan adalah brand dan principle
                            var count = $("#count_row_detail").val();

                            let rowCount = $('#usingSku table tbody tr').length;
                            if (count == rowCount) {
                                var index = parseInt(count) + 1;
                            } else {
                                index = rowCount + 1;
                            }
                            $.each(response, function(i, v) {
                                if (v.kategori_grup == 'Brand') {
                                    grup_sku +=
                                        '<option value="Brand"><label name="">Brand</label></option>';
                                } else if (v.kategori_grup == 'Principle') {
                                    grup_sku +=
                                        '<option value="Principle"><label name="">Principle</label></option>';
                                } else if (v.kategori_grup == 'Category') {
                                    grup_sku +=
                                        '<option value="Category"><label name="">Category</label></option>';
                                } else if (v.kategori_grup == 'Sub Category') {
                                    grup_sku +=
                                        '<option value="Sub Category"><label name="">Sub Category</label></option>';
                                } else if (v.kategori_grup == 'Jenis') {
                                    grup_sku +=
                                        '<option value="Jenis"><label name="">Jenis</label></option>';
                                } else {
                                    grup_sku +=
                                        `<option value="${v.kategori_grup}"><label name="">${v.kategori_grup}</label></option>`;
                                }
                            })
                        }

                        markup += "<tr> <td>" + index + "</td>";
                        markup +=
                            "<td> <select id='grupSku-" + index +
                            "' name='grupSku' class='form-control select2' onchange='getGrupSku(" +
                            index + ", this.value)' required> " +
                            grup_sku + " </select></td>";
                        markup +=
                            "<td><select id='grupNama-" + index +
                            "' name='grupNama' class='form-control select2' required><option value='' selected><label name=''> Pilih nama grup </label></option></select></td>";
                        markup +=
                            "<td> <input class='form-control' type='text' id='inQty' value=''> </td>";
                        markup +=
                            "<td> <input class='form-control' type='text' id='inValue' value=''> </td>";
                        markup +=
                            "<td><input class='alokasi alokasi-add form-control' type='text' id='alokasi" +
                            index +
                            "' name='alokasi' value='' onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>";
                        markup +=
                            "<td class='text-center'><button id='exceptproduk" + index +
                            "' name='exceptproduk' onclick='certainSku(" +
                            index +
                            ")' style='width: auto;' class='btn btn-success form-control'><i class='fa fa-gear'></i></button></td>";
                        markup +=
                            "<td class='text-center'><button style='width: 40px;' class='btn btn-danger form-control' onclick='delRow(this)'><i class='fa fa-close'></i></button></td></tr>";

                        tableBody = $("#usingSku table tbody");
                        tableBody.append(markup);
                        index++;
                    }
                });
            }
        });

        $(document).on("change", ".alokasi", function() {
            var sum = 0;
            var empty = true;
            $(".alokasi").each(function() {
                var thevalue = this.value.replace(/,/g, '');
                if (thevalue.length != 0) {
                    empty = false;
                }
            });
            if (empty) {
                $("#total_alokasi").val(0);
            } else {
                $(".alokasi").each(function() {
                    var thevalue = this.value.replace(/,/g, '');
                    if (!isNaN(thevalue) && thevalue.length != 0) {
                        sum += parseFloat(thevalue);
                        $("#total_alokasi").val(sum);
                    }
                });
            }
        });

        $(".alokasi").on({
            focus: function() {
                if (this.value == '0') this.value = '';
            },
            blur: function() {
                if (this.value == '') this.value = '0';
            }
        });

        //menampilkan modal cari sku
        $("#carisku").on('click', () => {
            var principle_id = $("#principle").val();

            if (principle_id == "") {
                $("#cariSku").modal('hide');
                message_topright("warning", "Pilih Principle dahulu!");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getDataDepoByPrincipleId') ?>",
                    data: {
                        id: principle_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $("#depo").empty();
                        let html = "";
                        $.each(response, function(i, v) {
                            html += "<option value=" + v.depo_id +
                                " style='width: 100%;'>" + v
                                .depo_nama +
                                "</option>";
                        });
                        $("#depo").append(html);
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getBrandByPrincipleId') ?>",
                    data: {
                        id: principle_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $("#brand").empty();
                        let html = "";
                        html +=
                            '<option value=""><label name="CAPTION-ALL">All</label></option>';
                        $.each(response, function(i, v) {
                            html += "<option value=" + v.principle_brand_id + ">" + v
                                .principle_brand_nama +
                                "</option>";
                        });
                        $("#brand").append(html);
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getPrincipleByPrincipleId') ?>",
                    data: {
                        id: principle_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $("#getPrinciple").empty();
                        let html = "";
                        $.each(response, function(i, v) {
                            html += "<option value=" + v.principle_id + ">" + v
                                .principle_nama +
                                "</option>";
                        });
                        $("#getPrinciple").append(html);
                    }
                });

                //mendapatkan data sku induk berdasarkan id principle
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getSkuIndukByPrincipleId') ?>",
                    data: {
                        id: principle_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $("#sku_induk").empty();
                        let html = "";
                        html +=
                            '<option value=""><label name="CAPTION-ALL">All</label></option>';
                        $.each(response, function(i, v) {
                            html += "<option value=" + v.sku_induk_id + ">" + v
                                .sku_induk_nama +
                                "</option>";
                        });
                        $("#sku_induk").append(html);
                    }
                });
                $("#cariSku").modal('show');
            }
        })

        //hanya bisa memilih 1 checkbox
        // $('input[type="checkbox"]').on('change', function() {
        //     $('input[type="checkbox"]').not(this).prop('checked', false);
        // });

        //menampilkan hasil filter pencarian menggunakan sku grup pada form tambah
        $(".btn-cari-sku").on("click", function() {

            $("#loading").show();
            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/searchSkubyFilter') ?>",
                data: {
                    principle: $("#getPrinciple").val(),
                    skuinduk: $("#sku_induk").val(),
                    brand: $("#brand").val(),
                    namasku: $("#nama_sku").val(),
                    kodeskuwms: $("#kode_sku_wms").val()
                },
                dataType: "JSON",
                success: function(response) {

                    // console.log(depo, principle, brand, namasku, kodeskuwms);
                    // return false;
                    $("#table-cari-sku > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#table-cari-sku')) {
                        $('#table-cari-sku').DataTable().clear();
                        $('#table-cari-sku').DataTable().destroy();
                    }

                    if (response != 0) {
                        $.each(response, function(i, v) {
                            $("#table-cari-sku > tbody").append(`
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="chk-data-result[]" style="transform: scale(1.5);" id="chk-data-result[]" value="${v.sku_id}">
                                </td>
                                <td></td>
                                <td class="text-center">${v.sku_induk_nama}</td>
                                <td class="text-center">${v.sku_nama_produk}</td>
                                <td class="text-center">${v.sku_kemasan}</td>
                                <td class="text-center">${v.sku_satuan}</td>
                                <td class="text-center">${v.principle_nama}</td>
                                <td class="text-center">${v.principle_brand_nama}</td>
                            </tr>
                        `);
                        });
                        $("#table-cari-sku").DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": false,
                            "info": true,
                            "autoWidth": true,
                        });
                    } else {
                        $("#table-cari-sku > tbody").append(`
                            <tr>
                                <td colspan="9" class="text-danger text-center">
                                    Data Kosong
                                </td>
                            </tr>
                `);
                    }

                    $("#loading").hide();
                }
            });
        });

        //untuk menampilkan data referensi budget diskon
        $("#btn-submit-filter").on("click", function() {

            var diskon_kode = $("#diskon_kode").val();
            var unit = $("#unit").val();

            $("#loading").show();
            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getReferensiBudget') ?>",
                data: {
                    diskon_kode: diskon_kode,
                    unit: unit
                },
                dataType: "JSON",
                success: function(response) {

                    $("#tableReferensi > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#tableReferensi')) {
                        $('#tableReferensi').DataTable().clear();
                        $('#tableReferensi').DataTable().destroy();
                    }

                    if (response != 0) {
                        $.each(response, function(i, v) {
                            $("#tableReferensi > tbody").append(`
                                <tr>
                                    <td class="text-center">${v.diskon_kode}</td>
                                    <td class="text-center">${v.unit}</td>
                                    <td class="text-center">${v.tgl_awal}</td>
                                    <td class="text-center">${v.tgl_akhir}</td>
                                    <td class="text-center">${v.tgl_dibuat}</td>
                                    <td class="text-center">${v.dibuat_oleh}</td>
                                    <td class="text-center">${v.tgl_disetujui}</td>
                                    <td class="text-center">${v.disetujui_oleh}</td>
                                    <td>
                                        <a href="<?= base_url("FAS/MasterPricing/ReferensiBudget/detailReference/") ?>${v.diskon_id}" style="width: 40px;" class="btn btn-info form-control"><i
                                                class="fa fa-eye"></i></a>
                                        <a href="<?= base_url("FAS/MasterPricing/ReferensiBudget/duplicateReference/") ?>${v.diskon_id}" style="width: 40px;" class="btn btn-warning form-control"><i
                                                class="fa fa-copy"></i></a>
                                        <a href="<?= base_url("FAS/MasterPricing/ReferensiBudget/EditReference/") ?>${v.diskon_id}" style="width: 40px;" class="btn btn-dark form-control"><i
                                                class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            `);
                        });
                        $('#tableReferensi').DataTable({
                            'ordering': false
                        });
                    } else {
                        $("#tableReferensi > tbody").append(`
                            <tr>
                                <td colspan="9" class="text-danger text-center">
                                    Data Kosong
                                </td>
                            </tr>
                        `);
                    }

                    $("#loading").hide();
                }
            });
            // }
        });

        //untuk memilih sku hasil filter pada sku grup
        $('#btn_pilih_sku').on('click', function() {
            var rowCount = $('#withoutSku tbody tr').length;
            let lineNo = 1;
            let arr_chk = [];
            var checkboxes = $("input[name='chk-data-result[]']");
            for (i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked == true) {
                    arr_chk.push(checkboxes[i].value);
                }
            }

            if (arr_chk.length == 0) {
                // message("Info!", "Pilih SKU yang akan dipilih", "warning");
                message_topright("warning", "Pilih SKU yang akan dipilih");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getDataSku') ?>",
                    data: {
                        id: arr_chk,
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $("#withoutSku > tbody").html('');
                        var no = 1;
                        $.each(response, function(i, v) {

                            if ($("#in_qty").is(":checked") && $("#in_value").is(
                                    ":checked")) {
                                $("#withoutSku > tbody").append(
                                    `<tr>
                                <td style="display: none;">
                                    <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                                </td>
                                <td style="display: none;">
                                    <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                                </td>
                                <td class="text-center">${no++}</td>
                                <td class="text-center">${v.sku_kode}</td>
                                <td class="text-center">${v.sku_nama_produk}</td>
                                <td class="text-center">${v.sku_kemasan}</td>
                                <td class="text-center">${v.sku_satuan}</td>
                                <td>
                                    <input class="inQty form-control" type="text" id="inQty" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" >
                                </td>
                                <td>
                                    <input class="inValue form-control" type="text" id="inValue" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" >
                                </td>
                                <td><input class="alokasi form-control" type="text" id="alokasi" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                                <td class="text-center">
                                    <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                </td>
                            </tr>`
                                );
                            } else if ($("#in_qty").is(":checked") && $("#in_value")
                                .not(":checked")) {
                                $("#withoutSku > tbody").append(
                                    `<tr>
                                <td style="display: none;">
                                    <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                                </td>
                                <td style="display: none;">
                                    <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                                </td>
                                <td class="text-center">${no++}</td>
                                <td class="text-center">${v.sku_kode}</td>
                                <td class="text-center">${v.sku_nama_produk}</td>
                                <td class="text-center">${v.sku_kemasan}</td>
                                <td class="text-center">${v.sku_satuan}</td>
                                <td>
                                    <input class="inQty form-control" type="text" id="inQty" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                </td>
                                <td>
                                    <input class="inValue form-control" type="text" id="inValue" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                </td>
                                <td><input class="alokasi form-control" type="text" id="alokasi" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                                <td class="text-center">
                                    <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                </td>
                            </tr>`
                                );
                            } else if ($("#in_qty").not(":checked") && $("#in_value")
                                .is(":checked")) {
                                $("#withoutSku > tbody").append(
                                    `<tr>
                                <td style="display: none;">
                                    <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                                </td>
                                <td style="display: none;">
                                    <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                                </td>
                                <td class="text-center">${no++}</td>
                                <td class="text-center">${v.sku_kode}</td>
                                <td class="text-center">${v.sku_nama_produk}</td>
                                <td class="text-center">${v.sku_kemasan}</td>
                                <td class="text-center">${v.sku_satuan}</td>
                                <td>
                                    <input class="inQty form-control" type="text" id="inQty" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                </td>
                                <td>
                                    <input class="inValue form-control" type="text" id="inValue" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                </td>
                                <td><input class="alokasi form-control" type="text" id="alokasi" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                                <td class="text-center">
                                    <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                </td>
                            </tr>`
                                );
                            } else if ($("#in_qty").not(":checked") && $("#in_value")
                                .not(":checked")) {
                                $("#withoutSku > tbody").append(
                                    `<tr>
                                <td style="display: none;">
                                    <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                                </td>
                                <td style="display: none;">
                                    <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                                </td>
                                <td class="text-center">${no++}</td>
                                <td class="text-center">${v.sku_kode}</td>
                                <td class="text-center">${v.sku_nama_produk}</td>
                                <td class="text-center">${v.sku_kemasan}</td>
                                <td class="text-center">${v.sku_satuan}</td>
                                <td>
                                    <input class="inQty form-control" type="text" id="inQty" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                </td>
                                <td>
                                    <input class="inValue form-control" type="text" id="inValue" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                </td>
                                <td><input class="alokasi form-control" type="text" id="alokasi" value="" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>
                                <td class="text-center">
                                    <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                </td>
                            </tr>`
                                );
                            }


                            lineNo++;
                        })
                        $("#cariSku").modal("hide");
                        message_topright("success", "Berhasil menampung data");
                    }
                })
            }
        })

        var id = $("#referensi_diskon_id").val();
        $.ajax({
            type: "GET",
            url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getDataReferenceById') ?>",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response.rb, function(i, v) {
                    if (v.grup_sku == 0) {
                        $("#sku_grup").val(0).attr("selected", "selected");
                        // $("#sku_grup option[value='0']").prop("selected", true);
                    } else {
                        $("#sku_grup").val(1).attr("selected", "selected");
                        // $("#sku_grup option[value='1']").prop("selected", true);
                    }
                });
            }
        });

        $("#diskon_kode").on("change", function() {
            // var diskon_kode = $("#diskon_kode").val();
            var id = $("#diskon_kode").val();
            $("#tipe_promo").trigger("change");
            $("#client_wms").trigger("change");
            $("#principle").trigger("change");
            $("#sku_grup").trigger("change");

            $.ajax({
                type: "GET",
                url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getDataReferenceById') ?>",
                data: {
                    id: id,
                },
                dataType: "JSON",
                success: function(data) {
                    $("#kode_referensi").val(data.rb.rb_kode);
                    $("#tgl_dibuat").val(data.rb.tgl_buat);
                    $("#tgl_promo_awal").val(data.rb.tgl_awal);
                    $("#tgl_promo_akhir").val(data.rb.tgl_akhir);
                    $("#status").val(data.rb.status);
                    $("#no_surat_promo").val(data.rb.no_surat);
                    $("#keterangan").val(data.rb.keterangan);
                    $("#notif_pemakaian").val(data.rb.notif_budget);
                    $("#in_qty").val(data.rb.in_qty);
                    $("#in_value").val(data.rb.in_value);
                    $("#total_alokasi").val(Number(data.rb.total_budget).toFixed(0));
                    $("#btn-save-referensi").attr("reff-id", data.rb.rb_id);
                    $("#tgl_promo_awal").prop("disabled", true);
                    $("#tgl_promo_akhir").prop("disabled", true);
                    $("#in_qty").prop("disabled", true);
                    $("#in_value").prop("disabled", true);
                    $("#chk_pilih_except").prop("disabled", true);

                    if ($("#in_qty").val() == 1 && $("#in_value").val() == 1) {
                        $("#in_qty").attr("checked", true);
                        $("#in_value").attr("checked", true);
                    } else if ($("#in_qty").val() == 1 && $("#in_value").val() == 0) {
                        $("#in_qty").attr("checked", true);
                        $("#in_value").removeAttr("checked", "checked");
                    } else if ($("#in_qty").val() == 0 && $("#in_value").val() == 1) {
                        $("#in_qty").removeAttr("checked", "checked");
                        $("#in_value").attr("checked", true);
                    } else if ($("#in_qty").val() == 0 && $("#in_value").val() == 0) {
                        $("#in_qty").removeAttr("checked", "checked");
                        $("#in_value").removeAttr("checked", "checked");
                    }

                    if ($("#tipe_promo").val() == "") {
                        $("#tipe_promo option[value='" + data.rb.tipe_promo + "']")
                            .attr(
                                "selected", true).change();
                        $("#tipe_promo").prop("disabled", true);
                    }

                    if ($("#principle").val() == "") {
                        $("#principle option[value='" + data.rb.principle + "']")
                            .attr(
                                "selected", true).change();
                        $("#principle").prop("disabled", true);
                    }

                    if ($("#client_wms").val() == "") {
                        $("#client_wms option[value='" + data.rb.client_wms + "']")
                            .attr(
                                "selected", true).change();
                        $("#client_wms").prop("disabled", true);
                    }

                    if ($("#sku_grup").val() == "") {
                        $("#sku_grup option[value='" + data.rb.grup_sku + "']")
                            .attr(
                                "selected", true).change();
                        $("#sku_grup").prop("disabled", true);
                    }

                    if (data.rb.grup_sku >= 0) {
                        if ($("#sku_grup option[value='1']").is(":selected")) {
                            $("#sku_grup option[value='1']").attr("selected", "selected");
                            $("#sku_grup option[value='0']").removeAttr("selected", "selected");
                            $("#sku_grup option[value='']").removeAttr("selected", "selected");
                        } else if ($("#sku_grup option[value='0']").is(":selected")) {
                            $("#sku_grup option[value='0']").attr("selected", "selected");
                            $("#sku_grup option[value='1']").removeAttr("selected", "selected");
                            $("#sku_grup option[value='']").removeAttr("selected", "selected");
                        }
                        $("#sku_grup option[value='" + data.rb.grup_sku +
                            "']").attr(
                            "selected", true);

                        var skugrup = $("#sku_grup option:selected").val();

                        if (skugrup == 0) {
                            $("#withSku > tbody").empty();
                            $("#notSku").show("slow");
                            $("#usingSku").hide("slow");
                        } else if (skugrup == 1) {
                            $("#withoutSku > tbody").empty();
                            $("#usingSku").show("slow");
                            $("#notSku").hide("slow");
                        } else {
                            $("#usingSku").hide("slow");
                            $("#notSku").hide("slow");
                        }
                    }

                    $("#withoutSku > tbody").html('');
                    var no = 1;
                    var number = 1;
                    if (skugrup == 0) {
                        $.each(data.rbd, function(i, v) {
                            if ($("#in_qty").is(":checked") && $("#in_value").is(
                                    ":checked")) {
                                $("#withoutSku > tbody").append(
                                    `<tr>
                                <td style="display: none;">
                                    <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                                </td>
                                <td style="display: none;">
                                    <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                                </td>
                                <td class="text-center">${no++}</td>
                                <td class="text-center">${v.sku_kode}</td>
                                <td class="text-center">${v.sku_nama_produk}</td>
                                <td class="text-center">${v.sku_kemasan}</td>
                                <td class="text-center">${v.sku_satuan}</td>
                                <td>
                                    <input class="inQty form-control" type="text" id="inQty" value="${Number(v.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                </td>
                                <td>
                                    <input class="inValue form-control" type="text" id="inValue" value="${Number(v.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                </td>
                                <td><input class="alokasi form-control" type="text" id="alokasi" value="${Number(v.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                                <td class="text-center" style="display: none;">
                                    <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                </td>
                            </tr>`
                                );
                            } else if ($("#in_qty").is(":checked") && $("#in_value")
                                .not(":checked")) {
                                $("#withoutSku > tbody").append(
                                    `<tr>
                                <td style="display: none;">
                                    <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                                </td>
                                <td style="display: none;">
                                    <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                                </td>
                                <td class="text-center">${no++}</td>
                                <td class="text-center">${v.sku_kode}</td>
                                <td class="text-center">${v.sku_nama_produk}</td>
                                <td class="text-center">${v.sku_kemasan}</td>
                                <td class="text-center">${v.sku_satuan}</td>
                                <td>
                                    <input class="inQty form-control" type="text" id="inQty" value="${Number(v.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                </td>
                                <td>
                                    <input class="inValue form-control" type="text" id="inValue" value="${Number(v.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                </td>
                                <td><input class="alokasi form-control" type="text" id="alokasi" value="${Number(v.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                                <td class="text-center" style="display: none;">
                                    <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                </td>
                            </tr>`
                                );
                            } else if ($("#in_qty").not(":checked") && $("#in_value")
                                .is(":checked")) {
                                $("#withoutSku > tbody").append(
                                    `<tr>
                                <td style="display: none;">
                                    <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                                </td>
                                <td style="display: none;">
                                    <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                                </td>
                                <td class="text-center">${no++}</td>
                                <td class="text-center">${v.sku_kode}</td>
                                <td class="text-center">${v.sku_nama_produk}</td>
                                <td class="text-center">${v.sku_kemasan}</td>
                                <td class="text-center">${v.sku_satuan}</td>
                                <td>
                                    <input class="inQty form-control" type="text" id="inQty" value="${Number(v.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                </td>
                                <td>
                                    <input class="inValue form-control" type="text" id="inValue" value="${Number(v.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                </td>
                                <td><input class="alokasi form-control" type="text" id="alokasi" value="${Number(v.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                                <td class="text-center" style="display: none;">
                                    <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                </td>
                            </tr>`
                                );
                            } else if ($("#in_qty").not(":checked") && $("#in_value")
                                .not(":checked")) {
                                $("#withoutSku > tbody").append(
                                    `<tr>
                                <td style="display: none;">
                                    <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                                </td>
                                <td style="display: none;">
                                    <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                                </td>
                                <td class="text-center">${no++}</td>
                                <td class="text-center">${v.sku_kode}</td>
                                <td class="text-center">${v.sku_nama_produk}</td>
                                <td class="text-center">${v.sku_kemasan}</td>
                                <td class="text-center">${v.sku_satuan}</td>
                                <td>
                                    <input class="inQty form-control" type="text" id="inQty" value="${Number(v.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                </td>
                                <td>
                                    <input class="inValue form-control" type="text" id="inValue" value="${Number(v.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                </td>
                                <td><input class="alokasi form-control" type="text" id="alokasi" value="${Number(v.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                                <td class="text-center" style="display: none;">
                                    <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                </td>
                            </tr>`
                                );
                            }
                        })
                        $("#cariSku").modal("hide");
                    } else {
                        var no = 1;
                        $.ajax({
                            type: 'POST',
                            url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getSkuGrup') ?>",
                            data: {
                                id: principle
                            },
                            dataType: "JSON",
                            async: false,
                            success: function(response) {
                                if (response.length > 0) {
                                    //perulangan untuk select option yg dipilih berdasarkan sku grup yg memiliki key pada principle yg dipilih
                                    //dimana sku grup yg menjadi acuan adalah brand dan principle
                                    var lineNo = 1;
                                    $.each(data.rbd, function(i,
                                        x) {
                                        var grup_sku =
                                            '<option value=""><label name="">Pilih grup sku</label></option>';
                                        $.each(response,
                                            function(
                                                i, v
                                            ) {
                                                if (v
                                                    .kategori_grup ==
                                                    x
                                                    .kategori_grup
                                                ) {
                                                    grup_sku
                                                        +=
                                                        `<option value="${v.kategori_grup}" selected><label name="">${v.kategori_grup}</label></option>`;
                                                } else {
                                                    grup_sku
                                                        +=
                                                        `<option value="${v.kategori_grup}" ><label name="">${v.kategori_grup}</label></option>`;
                                                }
                                            })

                                        var grup_nama =
                                            '<option value=""><label name="">Pilih grup nama</label></option>';
                                        $.ajax({
                                            type: 'POST',
                                            url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/exceptionGetSkuGrup') ?>",
                                            data: {
                                                principle: principle,
                                                grup_sku: x
                                                    .kategori_grup
                                            },
                                            dataType: "JSON",
                                            async: false,
                                            success: function(
                                                response
                                            ) {
                                                $.each(response,
                                                    function(
                                                        i,
                                                        y
                                                    ) {
                                                        if (y
                                                            .kategori_id ==
                                                            x
                                                            .kategori_id
                                                        ) {
                                                            grup_nama
                                                                +=
                                                                `<option value="${y.kategori_id}" selected><label name="">${y.kategori_nama}</label></option>`;
                                                        } else {
                                                            grup_nama
                                                                +=
                                                                `<option value="${y.kategori_id}" ><label name="">${y.kategori_nama}</label></option>`;
                                                        }
                                                    }
                                                )
                                            }
                                        });

                                        if ($("#in_qty").is(":checked") &&
                                            $("#in_value").is(":checked")) {
                                            $("#withSku > tbody")
                                                .append(
                                                    `<tr> <td>${lineNo}</td>
                                        <td>
                                            <select id="grupSku-${lineNo}" name="grupSku" class="form-control select2" onchange="getGrupSku('${lineNo}', this.value)" required disabled> ${grup_sku} </select>
                                        </td>
                                        <td>
                                            <select id="grupNama-${lineNo}" name="grupNama" class="form-control select2" required disabled>${grup_nama}</select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inQty" value="${Number(x.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inValue" value="${Number(x.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        </td>
                                        <td>
                                            <input class="alokasi alokasi-add form-control" type="text" id="alokasi${lineNo}" name="alokasi" value="${Number(x.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td class="text-center">
                                            <button id="exceptproduk${lineNo}" name="exceptproduk" onclick="certainSku('${lineNo}', '${x.rbd_id}')" style="width: auto;" class="btn btn-success form-control"><i class="fa fa-gear"></i></button>
                                        </td>
                                        <td class="text-center" style="display: none;">
                                        <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>`
                                                );
                                        } else if ($("#in_qty").is(
                                                ":checked") && $(
                                                "#in_value").not(
                                                ":checked")) {
                                            $("#withSku > tbody")
                                                .append(
                                                    `<tr> <td>${lineNo}</td>
                                        <td>
                                            <select id="grupSku-${lineNo}" name="grupSku" class="form-control select2" onchange="getGrupSku('${lineNo}', this.value)" required disabled> ${grup_sku} </select>
                                        </td>
                                        <td>
                                            <select id="grupNama-${lineNo}" name="grupNama" class="form-control select2" required disabled>${grup_nama}</select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inQty" value="${Number(x.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inValue" value="${Number(x.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td>
                                            <input class="alokasi alokasi-add form-control" type="text" id="alokasi${lineNo}" name="alokasi" value="${Number(x.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td class="text-center">
                                            <button id="exceptproduk${lineNo}" name="exceptproduk" onclick="certainSku('${lineNo}', '${x.rbd_id}')" style="width: auto;" class="btn btn-success form-control"><i class="fa fa-gear"></i></button>
                                        </td>
                                        <td class="text-center" style="display: none;">
                                        <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>`
                                                );
                                        } else if ($("#in_qty").not(
                                                ":checked") && $(
                                                "#in_value").is(
                                                ":checked")) {
                                            $("#withSku > tbody")
                                                .append(
                                                    `<tr> <td>${lineNo}</td>
                                        <td>
                                            <select id="grupSku-${lineNo}" name="grupSku" class="form-control select2" onchange="getGrupSku('${lineNo}', this.value)" required disabled> ${grup_sku} </select>
                                        </td>
                                        <td>
                                            <select id="grupNama-${lineNo}" name="grupNama" class="form-control select2" required disabled>${grup_nama}</select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inQty" value="${Number(x.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inValue" value="${Number(x.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        </td>
                                        <td>
                                            <input class="alokasi alokasi-add form-control" type="text" id="alokasi${lineNo}" name="alokasi" value="${Number(x.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td class="text-center">
                                            <button id="exceptproduk${lineNo}" name="exceptproduk" onclick="certainSku('${lineNo}', '${x.rbd_id}')" style="width: auto;" class="btn btn-success form-control"><i class="fa fa-gear"></i></button>
                                        </td>
                                        <td class="text-center" style="display: none;">
                                        <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>`
                                                );
                                        } else if ($("#in_qty").not(
                                                ":checked") && $(
                                                "#in_value").not(
                                                ":checked")) {
                                            $("#withSku > tbody")
                                                .append(
                                                    `<tr> <td>${lineNo}</td>
                                        <td>
                                            <select id="grupSku-${lineNo}" name="grupSku" class="form-control select2" onchange="getGrupSku('${lineNo}', this.value)" required disabled> ${grup_sku} </select>
                                        </td>
                                        <td>
                                            <select id="grupNama-${lineNo}" name="grupNama" class="form-control select2" required disabled>${grup_nama}</select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inQty" value="${Number(x.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inValue" value="${Number(x.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td>
                                            <input class="alokasi alokasi-add form-control" type="text" id="alokasi${lineNo}" name="alokasi" value="${Number(x.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td class="text-center">
                                            <button id="exceptproduk${lineNo}" name="exceptproduk" onclick="certainSku('${lineNo}', '${x.rbd_id}')" style="width: auto;" class="btn btn-success form-control"><i class="fa fa-gear"></i></button>
                                        </td>
                                        <td class="text-center" style="display: none;">
                                        <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>`
                                                );
                                        }
                                        lineNo++;
                                    })

                                    $.each(data.rbd2, function(
                                        i, z) {
                                        arr_sku_except
                                            .push({
                                                chk_except: z
                                                    .sku_id,
                                                kategori_id: z
                                                    .kategori_id
                                            });
                                    })
                                }
                            }
                        });
                    }
                }
            })
        });
    });



    //menampilkan modal pengecualian produk
    function certainSku(lineNo, rbdid) {
        var grup_nama = $("#grupNama-" + lineNo).val();
        var grup_sku = $("#grupSku-" + lineNo).val();

        if (grup_nama == '' && grup_sku == '') {
            message_topright("warning", "Grup SKU dan Grup Nama tidak boleh kosong!");
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/certainSku') ?>",
                data: {
                    grup_nama: grup_nama,
                    grup_sku: grup_sku,
                    // rbid: rbid,
                    rbdid: rbdid
                },
                dataType: "JSON",
                success: function(response) {
                    $("#modalExceptProduk").modal('show');
                    $("#tableException > tbody").empty();

                    if ($.fn.DataTable.isDataTable('#tableException')) {
                        $('#tableException').DataTable().clear();
                        $('#tableException').DataTable().destroy();
                    }

                    if (response != 0) {
                        var no = 1;
                        $.each(response.sku, function(i, v) {
                            $("#tableException > tbody").append(
                                `<tr>
                                    <td class="text-center">${no++}</td>
                                    <td class="text-center">
                                        <input type="checkbox" temp_kategori="${grup_nama}" name="chk_pilih_except"
                                            style="transform: scale(1.5);" id="chk_pilih_except" value="${v.sku_id}">
                                    </td>
                                    <td class="text-center">${v.kode}</td>
                                    <td class="text-center">${v.sku_nama}</td>
                                    <td class="text-center">${v.kemasan}</td>
                                    <td class="text-center">${v.satuan}</td>
                            </tr>`
                            );
                        })
                        $("#tableException").DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": false,
                            "info": true,
                            "autoWidth": true,
                        });

                        if (arr_sku_except.length > 0) {
                            for (let i = 0; i < arr_sku_except.length; i++) {
                                cekKategori = arr_sku_except[i].chk_except;
                                $("input[name='chk_pilih_except'][value='" + cekKategori + "']")
                                    .prop('checked',
                                        true);
                            }
                        }

                        $.each(response.rbd2, function(i, w) {
                            $("input[name='chk_pilih_except'][value='" + w.sku_id + "']")
                                .prop('checked',
                                    true);
                        })
                    } else {
                        $("#tableException > tbody").append(`
                        <tr>
                            <td colspan="6" class="text-danger text-center">
                                Data Kosong
                            </td>
                        </tr>
                    `);
                    }
                }
            })
        }
    }

    //inisialisasi alert
    function message(msg, msgtext, msgtype) {
        Swal.fire(msg, msgtext, msgtype);
    }

    function message_topright(type, msg) {
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
            icon: type,
            title: msg,
        });
    }

    //mengubah status referensi menjadi in progress approval
    $('#pengajuan_approval').click(function(event) {
        if (this.checked) {
            $("#status").val("In Progress Approval");
        } else {
            $("#status").val("Draft");
        }
    });

    $('#in_qty').click(function(event) {
        if (this.checked) {
            $("#in_qty").val("1");
        } else {
            $("#in_qty").val("0");
        }
    });

    $('#in_value').click(function(event) {
        if (this.checked) {
            $("#in_value").val("1");
        } else {
            $("#in_value").val("0");
        }
    });

    //untuk menghapus baris tabel temp
    function delRow(Idx) {
        var row = Idx.parentNode.parentNode;
        row.parentNode.removeChild(row);

        var no = 1;
        $("#withoutSku > tbody tr").each(function() {
            $(this).find("td:eq(2)").text(no++);
        })

        var no2 = 1;
        $("#withSku > tbody tr").each(function() {
            $(this).find("td:eq(0)").text(no2++);
        })
    }

    //enable & disable input
    function inQty(e) {
        if (e.checked) {
            $("input[id='inQty").removeAttr('disabled', 'disabled');
            $("input[id='inQty").removeAttr('disabled', 'disabled');

            // $('#inValue2').attr('disabled', 'disabled');
        } else {
            $("input[id='inQty").attr('disabled', 'disabled');
            $("input[id='inQty").attr('disabled', 'disabled');
            // $('#inValue2').removeAttr('disabled', 'disabled');
        }
    }

    function inValue(e) {
        if (e.checked) {
            $("input[id='inValue").removeAttr('disabled', 'disabled');
            $("input[id='inValue").removeAttr('disabled', 'disabled');

        } else {
            $("input[id='inValue").attr('disabled', 'disabled');
            $("input[id='inValue").attr('disabled', 'disabled');

        }
    }

    //mendapatkan data inisialisasi pencarian SKU Nama berdasarkan SKU grup yg dipilih
    function getGrupSku(lineNo, kategori_grup) {
        var grup_sku = kategori_grup;
        var principle = '';

        //pengecekan sku grup yg dipilih apakah memiliki key terhadap principle yg dipilih untuk di lempar ke query di model
        if (grup_sku == 'Brand' || grup_sku == 'Principle' || grup_sku == 'Category' || grup_sku ==
            'Sub Category' ||
            grup_sku == 'Jenis') {
            principle = $("#principle").val();
        } else {
            principle = ''
        }

        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/exceptionGetSkuGrup') ?>",
            data: {
                grup_sku: grup_sku,
                principle: principle
            },
            dataType: "JSON",
            success: function(response) {
                $("#grupNama-" + lineNo + "").empty();
                let html = "";
                html += '<option value=""><label name="CAPTION-ALL">Pilih SKU Nama</label></option>';
                $.each(response, function(i, v) {
                    html += "<option value=" + v.kategori_id + ">" + v.kategori_nama +
                        "</option>";
                });
                $("#grupNama-" + lineNo + "").append(html);
            }
        });
    }

    //mendapatkan data inisialisasi pencarian SKU berdasarkan principle yg dipilih
    function GetPrincipleData(principle_id) {
        //mendapatkan data depo berdasarkan id principle
        var principle = $("#principle").val();

        if (principle != "") {
            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getDataDepoByPrincipleId') ?>",
                data: {
                    id: principle_id
                },
                dataType: "JSON",
                success: function(response) {
                    $("#depo").empty();
                    let html = "";
                    $.each(response, function(i, v) {
                        html += "<option value=" + v.depo_id + " style='width: 100%;'>" + v
                            .depo_nama +
                            "</option>";
                    });
                    $("#depo").append(html);
                }
            });
        } else {
            $("#cariSku").modal('hide');
        }


        //mendapatkan data brand berdasarkan id principle
        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getBrandByPrincipleId') ?>",
            data: {
                id: principle_id
            },
            dataType: "JSON",
            success: function(response) {
                $("#brand").empty();
                let html = "";
                html += '<option value=""><label name="CAPTION-ALL">All</label></option>';
                $.each(response, function(i, v) {
                    html += "<option value=" + v.principle_brand_id + ">" + v
                        .principle_brand_nama +
                        "</option>";
                });
                $("#brand").append(html);
            }
        });

        //mendapatkan data principle berdasarkan id principle
        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getPrincipleByPrincipleId') ?>",
            data: {
                id: principle_id
            },
            dataType: "JSON",
            success: function(response) {
                $("#getPrinciple").empty();
                let html = "";
                $.each(response, function(i, v) {
                    html += "<option value=" + v.principle_id + ">" + v.principle_nama +
                        "</option>";
                });
                $("#getPrinciple").append(html);
            }
        });

        //mendapatkan data sku induk berdasarkan id principle
        $.ajax({
            type: "POST",
            url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getSkuIndukByPrincipleId') ?>",
            data: {
                id: principle_id
            },
            dataType: "JSON",
            success: function(response) {
                $("#sku_induk").empty();
                let html = "";
                html += '<option value=""><label name="CAPTION-ALL">All</label></option>';
                $.each(response, function(i, v) {
                    html += "<option value=" + v.sku_induk_id + ">" + v.sku_induk_nama +
                        "</option>";
                });
                $("#sku_induk").append(html);
            }
        });
    }

    //membuat input format nominal
    function formatNominal(input) {
        var nStr = input.value + '';
        nStr = nStr.replace(/\,/g, "");
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        input.value = x1 + x2;
    }

    //mencentang semua opsi check
    function checkAllSKU(e) {
        var checkboxes = $("input[name='chk-data-result[]']");

        if (e.checked) {
            for (i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true;
                }
            }
        } else {
            for (i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = false;
                }
            }
        }
    }

    function saveSkuTemp() {
        var chk_except = $("input[name='chk_pilih_except']");
        var kategori_id = chk_except.attr('temp_kategori');
        // console.log(kategori_id);
        if (arr_sku_except.length > 0) {
            for (let i = 0; i < arr_sku_except.length; i++) {
                cekKategori = arr_sku_except[i].kategori_id;

                if (cekKategori == kategori_id) {
                    arr_sku_except.splice(i, 1);
                    i--;
                }

            }
        }

        for (i = 0; i < chk_except.length; i++) {
            if (chk_except[i].checked == true) {
                arr_sku_except.push({
                    chk_except: chk_except[i].value,
                    kategori_id: kategori_id
                });
            }
        }

        // console.log(arr_sku_except);

        $("#modalExceptProduk").modal('hide');
        message_topright("success", "Berhasil menampung data");
    };

    $("#btn-save-referensi").on('click', () => {
        var depo_grup_id = $("#depo_grup_id").val();
        var depo_id = $("#depo").val();
        var tgl_dibuat = $("#tgl_dibuat").val();
        var tipe_referensi = $("#tipe_data").val();
        var tipe_promo = $("#tipe_promo").val();
        var tgl_promo_awal = $("#tgl_promo_awal").val();
        var tgl_promo_akhir = $("#tgl_promo_akhir").val();
        var in_qty = $('#in_qty').val();
        var in_value = $('#in_value').val();
        var principle = $("#principle").val();
        var grup_sku = $("#sku_grup").val();
        if (grup_sku == undefined) {
            grup_sku = $("#sku_grup_change").val();
        }
        var status = $("#status").val();
        var client_wms = $("#client_wms").val();
        var no_surat_promo = $("#no_surat_promo").val();
        var no_surat_promo_tambahan = $("#no_surat_promo_tambahan").val();
        var keterangan = $("#keterangan").val();
        var notif_pemakaian = $("#notif_pemakaian").val();
        var total_alokasi = $("#total_alokasi").val();
        console.log();
        var kode_tipepromo = $('#tipe_promo').find('option:selected').attr('kode-promo');
        var kode_principle = $('#principle').find('option:selected').attr('kode-principle');
        var karyawan_id = $("#karyawan_id").val();
        var referensi_diskon_id = $("#referensi_diskon_id").val();
        var arr_sku_id1 = [];
        var arr_sku_id2 = [];

        if (tipe_data == '') {
            message("Warning!", "Tipe data tidak boleh kosong", "warning");
            return false;
        } else if (tipe_promo == '') {
            message("Warning!", "Tipe promo tidak boleh kosong", "warning");
            return false;
        } else if (tgl_promo_awal == '') {
            message("Warning!", "Tanggal awal promo tidak boleh kosong", "warning");
            return false;
        } else if (tgl_promo_akhir == '') {
            message("Warning!", "Tanggal akhir promo tidak boleh kosong", "warning");
            return false;
        } else if (principle == '') {
            message("Warning!", "Principle tidak boleh kosong", "warning");
            return false;
        } else if (status == '') {
            message("Warning!", "Status tidak boleh kosong", "warning");
            return false;
        } else if (status == '') {
            message("Warning!", "Status tidak boleh kosong", "warning");
            return false;
        } else if (client_wms == '') {
            message("Warning!", "Client WMS tidak boleh kosong", "warning");
            return false;
        } else if (no_surat_promo == '') {
            message("Warning!", "No surat promo tidak boleh kosong", "warning");
            return false;
        } else if (keterangan == '') {
            message("Warning!", "Keterangan tidak boleh kosong", "warning");
            return false;
        } else if (notif_pemakaian == '') {
            message("Warning!", "Notifikasi pemakaian budget tidak boleh kosong", "warning");
            return false;
        }

        if (grup_sku == 1) {

            $("#withSku > tbody tr").each(function() {
                var no = 1;
                var inQty1 = $(this).find("td:eq(3) input[type='text']").val().replace(/,/g, '');
                var inValue1 = $(this).find("td:eq(4) input[type='text']").val().replace(/,/g, '');
                var alokasi1 = $(this).find("td:eq(5) input[type='text']").val().replace(/,/g, '');
                var kategori_id = $(this).find("td:eq(2) select[name='grupNama']").val();

                arr_sku_id1.push({
                    inQty1,
                    inValue1,
                    alokasi1,
                    kategori_id
                });
                no++;
            })

        } else {
            $("#withoutSku > tbody tr").each(function() {
                var sku_id = $(this).find("td:eq(0) input[type='hidden']").val();
                var kategori_id = $(this).find("td:eq(1) input[type='hidden']").val();
                var inQty2 = $(this).find("td:eq(7) input[type='text']").val().replace(/,/g, '');
                var inValue2 = $(this).find("td:eq(8) input[type='text']").val().replace(/,/g, '');
                var alokasi2 = $(this).find("td:eq(9) input[type='text']").val().replace(/,/g, '');
                arr_sku_id2.push({
                    sku_id,
                    kategori_id,
                    inQty2,
                    inValue2,
                    alokasi2,
                });
            })
        }

        var kode_promo = $("#kode_depo").val() + "-" + kode_tipepromo + "-" + kode_principle + "-" + $(
            "#no_surat_promo").val();

        var reff_id = $("#btn-save-referensi").attr("reff-id");
        var currentUrl = window.location.href;
        var segment = currentUrl.split("/")[7];

        if (reff_id === undefined && segment != "EditReference") {
            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/saveReferensiBudget') ?>",
                data: {
                    depo_grup_id: depo_grup_id,
                    depo_id: depo_id,
                    tgl_dibuat: tgl_dibuat,
                    tipe_referensi: tipe_referensi,
                    tipe_promo: tipe_promo,
                    tgl_promo_awal: tgl_promo_awal,
                    tgl_promo_akhir: tgl_promo_akhir,
                    in_qty: in_qty,
                    in_value: in_value,
                    principle: principle,
                    grup_sku: grup_sku,
                    status: status,
                    client_wms: client_wms,
                    no_surat_promo: no_surat_promo,
                    keterangan: keterangan,
                    notif_pemakaian: notif_pemakaian,
                    total_alokasi: total_alokasi,
                    arr_sku_id1: arr_sku_id1,
                    arr_sku_id2: arr_sku_id2,
                    arr_sku_except: arr_sku_except,
                    kode_promo: kode_promo,
                    karyawan_id: karyawan_id
                },
                dataType: "JSON",
                success: function(response) {
                    if (response == 1) {
                        message("Selamat,", "Data berhasil disimpan!", "success");
                        setTimeout(() => {
                            location.href =
                                "<?= base_url("FAS/MasterPricing/ReferensiBudget/ReferensiBudgetMenu") ?>";
                        }, 1000);
                    } else {
                        message("Maaf,", "Data gagal disimpan!", "error");
                    }
                }
            })

        } else if (segment === "EditReference") {
            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/editReferensiBudget') ?>",
                data: {
                    referensi_diskon_id: referensi_diskon_id,
                    kode_promo: kode_promo,
                    depo_id: depo_id,
                    client_wms: client_wms,
                    tipe_referensi: tipe_referensi,
                    tipe_promo: tipe_promo,
                    principle: principle,
                    grup_sku: grup_sku,
                    no_surat_promo: no_surat_promo,
                    tgl_promo_awal: tgl_promo_awal,
                    tgl_promo_akhir: tgl_promo_akhir,
                    tgl_dibuat: tgl_dibuat,
                    keterangan: keterangan,
                    in_qty: in_qty,
                    in_value: in_value,
                    total_alokasi: total_alokasi,
                    notif_pemakaian: notif_pemakaian,
                    status: status,
                    arr_sku_id1: arr_sku_id1,
                    arr_sku_id2: arr_sku_id2,
                    arr_sku_except: arr_sku_except,
                    karyawan_id: karyawan_id
                },
                dataType: "JSON",
                success: function(response) {
                    if (response == 1) {
                        message("Selamat,", "Data berhasil diperbaharui!", "success");
                        setTimeout(() => {
                            location.href =
                                "<?= base_url("FAS/MasterPricing/ReferensiBudget/ReferensiBudgetMenu") ?>";
                        }, 1000);
                    } else {
                        message("Maaf,", "Data gagal diperbaharui!", "error");
                    }
                }
            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/updateReferensiBudget') ?>",
                data: {
                    reff_id: reff_id,
                    depo_id: depo_id,
                    grup_sku: grup_sku,
                    status: status,
                    no_surat_promo_tambahan: no_surat_promo_tambahan,
                    keterangan: keterangan,
                    notif_pemakaian: notif_pemakaian,
                    arr_sku_id1: arr_sku_id1,
                    arr_sku_id2: arr_sku_id2,
                    arr_sku_except: arr_sku_except,
                    kode_promo: kode_promo,
                    karyawan_id: karyawan_id
                },
                dataType: "JSON",
                success: function(response) {
                    if (response == 1) {
                        message("Selamat,", "Data berhasil diperbaharui!", "success");
                        setTimeout(() => {
                            location.href =
                                "<?= base_url("FAS/MasterPricing/ReferensiBudget/ReferensiBudgetMenu") ?>";
                        }, 1000);
                    } else {
                        message("Maaf,", "Data gagal diperbaharui!", "error");
                    }
                }
            })
        }
    });

    let skugroup = $("#skugrup").val();
    var principle = $("#principle").val();
    var id = $("#referensi_diskon_id").val();

    $.ajax({
        type: "GET",
        url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getDataReferenceById') ?>",
        data: {
            id: id,
        },
        dataType: "JSON",
        success: function(data) {
            $("#withoutSku > tbody").html('');
            var no = 1;
            var number = 1;
            if (skugroup == 0) {
                $.each(data.rbd, function(i, v) {
                    if ($("#in_qty").is(":checked") && $("#in_value").is(":checked")) {
                        $("#withoutSku > tbody").append(
                            `<tr>
                            <td style="display: none;">
                                <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                            </td>
                            <td style="display: none;">
                                <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                            </td>
                            <td class="text-center">${no++}</td>
                            <td class="text-center">${v.sku_kode}</td>
                            <td class="text-center">${v.sku_nama_produk}</td>
                            <td class="text-center">${v.sku_kemasan}</td>
                            <td class="text-center">${v.sku_satuan}</td>
                            <td>
                                <input class="inQty form-control" type="text" id="inQty" value="${Number(v.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </td>
                            <td>
                                <input class="inValue form-control" type="text" id="inValue" value="${Number(v.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </td>
                            <td><input class="alokasi form-control" type="text" id="alokasi" value="${Number(v.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                            <td class="text-center">
                                <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                            </td>
                        </tr>`
                        );
                    } else if ($("#in_qty").is(":checked") && $("#in_value").not(
                            ":checked")) {
                        $("#withoutSku > tbody").append(
                            `<tr>
                            <td style="display: none;">
                                <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                            </td>
                            <td style="display: none;">
                                <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                            </td>
                            <td class="text-center">${no++}</td>
                            <td class="text-center">${v.sku_kode}</td>
                            <td class="text-center">${v.sku_nama_produk}</td>
                            <td class="text-center">${v.sku_kemasan}</td>
                            <td class="text-center">${v.sku_satuan}</td>
                            <td>
                                <input class="inQty form-control" type="text" id="inQty" value="${Number(v.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </td>
                            <td>
                                <input class="inValue form-control" type="text" id="inValue" value="${Number(v.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                            </td>
                            <td><input class="alokasi form-control" type="text" id="alokasi" value="${Number(v.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                            <td class="text-center">
                                <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                            </td>
                        </tr>`
                        );
                    } else if ($("#in_qty").not(":checked") && $("#in_value").is(
                            ":checked")) {
                        $("#withoutSku > tbody").append(
                            `<tr>
                            <td style="display: none;">
                                <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                            </td>
                            <td style="display: none;">
                                <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                            </td>
                            <td class="text-center">${no++}</td>
                            <td class="text-center">${v.sku_kode}</td>
                            <td class="text-center">${v.sku_nama_produk}</td>
                            <td class="text-center">${v.sku_kemasan}</td>
                            <td class="text-center">${v.sku_satuan}</td>
                            <td>
                                <input class="inQty form-control" type="text" id="inQty" value="${Number(v.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                            </td>
                            <td>
                                <input class="inValue form-control" type="text" id="inValue" value="${Number(v.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </td>
                            <td><input class="alokasi form-control" type="text" id="alokasi" value="${Number(v.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                            <td class="text-center">
                                <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                            </td>
                        </tr>`
                        );
                    } else if ($("#in_qty").not(":checked") && $("#in_value").not(
                            ":checked")) {
                        $("#withoutSku > tbody").append(
                            `<tr>
                            <td style="display: none;">
                                <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                            </td>
                            <td style="display: none;">
                                <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                            </td>
                            <td class="text-center">${no++}</td>
                            <td class="text-center">${v.sku_kode}</td>
                            <td class="text-center">${v.sku_nama_produk}</td>
                            <td class="text-center">${v.sku_kemasan}</td>
                            <td class="text-center">${v.sku_satuan}</td>
                            <td>
                                <input class="inQty form-control" type="text" id="inQty" value="${Number(v.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                            </td>
                            <td>
                                <input class="inValue form-control" type="text" id="inValue" value="${Number(v.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                            </td>
                            <td><input class="alokasi form-control" type="text" id="alokasi" value="${Number(v.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                            <td class="text-center">
                                <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                            </td>
                        </tr>`
                        );
                    }

                    $("#withoutSkuRead > tbody").append(
                        `<tr>
                        <td style="display: none;">
                            <input type="hidden" id="sku_id[]" name="sku_id[]" value="${v.sku_id}" />
                        </td>
                        <td style="display: none;">
                            <input type="hidden" id="kategori_id[]" name="kategori_id[]" value="${v.kategori_id}" />
                        </td>
                        <td class="text-center">${number++}</td>
                        <td class="text-center">${v.sku_kode}</td>
                        <td class="text-center">${v.sku_nama_produk}</td>
                        <td class="text-center">${v.sku_kemasan}</td>
                        <td class="text-center">${v.sku_satuan}</td>
                        <td>
                            <input class="inQty form-control" type="text" id="inQty" value="${v.rbd_qty}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                        </td>
                        <td>
                            <input class="inValue form-control" type="text" id="inValue" value="${Number(v.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                        </td>
                        <td><input class="alokasi form-control" type="text" id="alokasi" value="${Number(v.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled></td>
                    </tr>`
                    );
                })
                $("#cariSku").modal("hide");
            } else {
                var no = 1;
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/getSkuGrup') ?>",
                    data: {
                        id: principle
                    },
                    dataType: "JSON",
                    async: false,
                    success: function(response) {
                        // console.log(response);
                        if (response.length > 0) {
                            //perulangan untuk select option yg dipilih berdasarkan sku grup yg memiliki key pada principle yg dipilih
                            //dimana sku grup yg menjadi acuan adalah brand dan principle

                            var lineNo = 1;
                            $.each(data.rbd, function(i, x) {
                                var grup_sku =
                                    '<option value=""><label name="">Pilih grup sku</label></option>';
                                $.each(response, function(i, v) {
                                    if (v.kategori_grup == x.kategori_grup) {
                                        grup_sku +=
                                            `<option value="${v.kategori_grup}" selected><label name="">${v.kategori_grup}</label></option>`;
                                    } else {
                                        grup_sku +=
                                            `<option value="${v.kategori_grup}" ><label name="">${v.kategori_grup}</label></option>`;
                                    }
                                })

                                var grup_nama =
                                    '<option value=""><label name="">Pilih grup nama</label></option>';
                                $.ajax({
                                    type: 'POST',
                                    url: "<?= base_url('FAS/MasterPricing/ReferensiBudget/exceptionGetSkuGrup') ?>",
                                    data: {
                                        principle: principle,
                                        grup_sku: x.kategori_grup
                                    },
                                    dataType: "JSON",
                                    async: false,
                                    success: function(response) {
                                        $.each(response, function(i, y) {
                                            if (y.kategori_id == x
                                                .kategori_id) {
                                                grup_nama +=
                                                    `<option value="${y.kategori_id}" selected><label name="">${y.kategori_nama}</label></option>`;
                                            } else {
                                                grup_nama +=
                                                    `<option value="${y.kategori_id}" ><label name="">${y.kategori_nama}</label></option>`;
                                            }
                                        })
                                    }
                                });

                                if ($("#in_qty").is(":checked") && $("#in_value").is(
                                        ":checked")) {
                                    $("#withSku > tbody").append(
                                        `<tr> <td>${lineNo}</td>
                                        <td>
                                            <select id="grupSku-${lineNo}" name="grupSku" class="form-control select2" onchange="getGrupSku('${lineNo}', this.value)" required> ${grup_sku} </select>
                                        </td>
                                        <td>
                                            <select id="grupNama-${lineNo}" name="grupNama" class="form-control select2" required>${grup_nama}</select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inQty" value="${Number(x.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inValue" value="${Number(x.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        </td>
                                        <td>
                                            <input class="alokasi alokasi-add form-control" type="text" id="alokasi${lineNo}" name="alokasi" value="${Number(x.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td class="text-center">
                                            <button id="exceptproduk${lineNo}" name="exceptproduk" onclick="certainSku('${lineNo}', '${x.rbd_id}')" style="width: auto;" class="btn btn-success form-control"><i class="fa fa-gear"></i></button>
                                        </td>
                                        <td class="text-center">
                                        <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>`
                                    );
                                } else if ($("#in_qty").is(":checked") && $("#in_value")
                                    .not(":checked")) {
                                    $("#withSku > tbody").append(
                                        `<tr> <td>${lineNo}</td>
                                        <td>
                                            <select id="grupSku-${lineNo}" name="grupSku" class="form-control select2" onchange="getGrupSku('${lineNo}', this.value)" required> ${grup_sku} </select>
                                        </td>
                                        <td>
                                            <select id="grupNama-${lineNo}" name="grupNama" class="form-control select2" required>${grup_nama}</select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inQty" value="${Number(x.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inValue" value="${Number(x.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td>
                                            <input class="alokasi alokasi-add form-control" type="text" id="alokasi${lineNo}" name="alokasi" value="${Number(x.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td class="text-center">
                                            <button id="exceptproduk${lineNo}" name="exceptproduk" onclick="certainSku('${lineNo}', '${x.rbd_id}')" style="width: auto;" class="btn btn-success form-control"><i class="fa fa-gear"></i></button>
                                        </td>
                                        <td class="text-center">
                                        <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>`
                                    );
                                } else if ($("#in_qty").not(":checked") && $("#in_value")
                                    .is(":checked")) {
                                    $("#withSku > tbody").append(
                                        `<tr> <td>${lineNo}</td>
                                        <td>
                                            <select id="grupSku-${lineNo}" name="grupSku" class="form-control select2" onchange="getGrupSku('${lineNo}', this.value)" required> ${grup_sku} </select>
                                        </td>
                                        <td>
                                            <select id="grupNama-${lineNo}" name="grupNama" class="form-control select2" required>${grup_nama}</select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inQty" value="${Number(x.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inValue" value="${Number(x.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        </td>
                                        <td>
                                            <input class="alokasi alokasi-add form-control" type="text" id="alokasi${lineNo}" name="alokasi" value="${Number(x.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td class="text-center">
                                            <button id="exceptproduk${lineNo}" name="exceptproduk" onclick="certainSku('${lineNo}', '${x.rbd_id}')" style="width: auto;" class="btn btn-success form-control"><i class="fa fa-gear"></i></button>
                                        </td>
                                        <td class="text-center">
                                        <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>`
                                    );
                                } else if ($("#in_qty").not(":checked") && $("#in_value")
                                    .not(":checked")) {
                                    $("#withSku > tbody").append(
                                        `<tr> <td>${lineNo}</td>
                                        <td>
                                            <select id="grupSku-${lineNo}" name="grupSku" class="form-control select2" onchange="getGrupSku('${lineNo}', this.value)" required> ${grup_sku} </select>
                                        </td>
                                        <td>
                                            <select id="grupNama-${lineNo}" name="grupNama" class="form-control select2" required>${grup_nama}</select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inQty" value="${Number(x.rbd_qty).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inValue" value="${Number(x.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td>
                                            <input class="alokasi alokasi-add form-control" type="text" id="alokasi${lineNo}" name="alokasi" value="${Number(x.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td class="text-center">
                                            <button id="exceptproduk${lineNo}" name="exceptproduk" onclick="certainSku('${lineNo}', '${x.rbd_id}')" style="width: auto;" class="btn btn-success form-control"><i class="fa fa-gear"></i></button>
                                        </td>
                                        <td class="text-center">
                                        <button style="width: 40px;" class="btn btn-danger form-control" onclick="delRow(this)"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>`
                                    );
                                }

                                $("#withSkuRead > tbody").append(
                                    `<tr> <td>${lineNo}</td>
                                        <td>
                                            <select id="grupSku-${lineNo}" name="grupSku" class="form-control select2" onchange="getGrupSku('${lineNo}', this.value)" required disabled> ${grup_sku} </select>
                                        </td>
                                        <td>
                                            <select id="grupNama-${lineNo}" name="grupNama" class="form-control select2" required disabled>${grup_nama}</select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inQty" value="${x.rbd_qty}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="inValue" value="${Number(x.rbd_value).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td>
                                            <input class="alokasi alokasi-add form-control" type="text" id="alokasi${lineNo}" name="alokasi" value="${Number(x.rbd_budget).toFixed(0)}" onkeyup="formatNominal(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                        </td>
                                        <td class="text-center">
                                            <button id="exceptproduk${lineNo}" name="exceptproduk" onclick="certainSku('${lineNo}', '${x.rbd_id}')" style="width: auto;" class="btn btn-info form-control"><i class="fa fa-eye"></i></button>
                                        </td>
                                </tr>`
                                );
                                lineNo++;
                                // })
                            })

                            $.each(data.rbd2, function(i, z) {
                                // console.log(z.sku_id);
                                arr_sku_except.push({
                                    chk_except: z.sku_id,
                                    kategori_id: z.kategori_id
                                });
                            })


                        }
                    }
                });

            }
        }
    })
</script>