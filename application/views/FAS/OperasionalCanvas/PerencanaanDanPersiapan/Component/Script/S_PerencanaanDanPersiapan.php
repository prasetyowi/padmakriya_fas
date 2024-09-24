<script>
    let arrSkuSelected = [];
    let arrDataDetail2 = [];

    const urlPage = window.location.href.split('/');

    $(document).ready(function() {
        select2();
        if ($('#filter_tgl_request').length > 0) {
            $('#filter_tgl_request').daterangepicker({
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

        $(document).on("input", ".numeric", function(event) {
            this.value = this.value.replace(/[^\d.]+/g, '');
        });

        <?php if ($this->uri->segment(4) == "edit") { ?>
            requestDataDetailCanvas()
        <?php } ?>

        <?php if ($this->uri->segment(4) == "view") { ?>
            requestDataDetailCanvas()
            <?php if ($dataCanvas->header->canvas_status == "In Progress Approval") { ?>
                $("#ajukan_approval").prop('checked', true)
            <?php } ?>
        <?php } ?>

    })

    /** --------------------------------------- Untuk Global ------------------------------------------- */

    const select2 = () => {
        $(".select2").select2({
            width: "100%"
        });
    }

    // const message = (msg, msgtext, msgtype) => {
    // 	Swal.fire(msg, msgtext, msgtype);
    // }

    // const message_topright_global = (type, msg) => {
    // 	const Toast = Swal.mixin({
    // 		toast: true,
    // 		position: "top-end",
    // 		showConfirmButton: false,
    // 		timer: 3000,
    // 		didOpen: (toast) => {
    // 			toast.addEventListener("mouseenter", Swal.stopTimer);
    // 			toast.addEventListener("mouseleave", Swal.resumeTimer);
    // 		},
    // 	});

    // 	Toast.fire({
    // 		icon: type,
    // 		title: msg,
    // 	});
    // }

    const resetUrlPushState = () => {
        let url = window.location.href;
        if (url.indexOf("?") != -1) {
            let resUrl = url.split("?");

            if (typeof window.history.pushState == 'function') {
                window.history.pushState({}, "Hide", resUrl[0]);
            }
        }
    }

    async function postDataRequest(url = '', data = {}, type) {
        if (type == "GET") {
            const response = await fetch(url);

            if (!response.ok) return response
            return response.json();
        } else {
            const response = await fetch(url, {
                method: type,
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) return response
            return response.json();
        }

        // Default options are marked with *

    }

    const handlerBackToHome = () => {
        location.href = "<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/PerencanaanDanPersiapanMenu') ?>";
    }

    /** Halaman Depan */

    const handlerNewDataPersiapanAndPerencanaan = () => {
        location.href = "<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/create') ?>";
    }

    function getStringOfArrayString(data) {
        let string = "";

        data.forEach(datum => string += datum + ", ");

        return string.slice(0, -2);
    }

    const handlerFilterData = () => {
        postDataRequest('<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/getDataByFilter') ?>', {
                tahun: $("#vfiltertahun").val(),
                bulan: $("#vfilterbulan").val(),
                status: $("#vfilterstatus").val(),
                perusahaan: $("#vperusahaan").val()
            }, 'POST')
            .then((response) => {
                $('#listperencanaanpersiapan > tbody').empty();
                if (response.length > 0) {

                    if ($.fn.DataTable.isDataTable('#listperencanaanpersiapan')) {
                        $('#listperencanaanpersiapan').DataTable().destroy();
                    }

                    $.each(response, function(i, v) {
                        let str = "";

                        if (v.canvas_status == "Draft") {
                            str +=
                                `<button class='btn btn-warning btn-md' title='Edit Data' onclick="handlerEditData('${v.canvas_id}')"><i class='fa fa-edit'></i></button>`;
                            str +=
                                `<button class='btn btn-danger btn-md' title='Hapus Data' onclick="handlerHapusDataById('${v.canvas_id}', '${v.canvas_tgl_update}')"><i class='fa fa-xmark'></i></button>`;
                        } else {
                            str +=
                                `<button class='btn btn-primary btn-md' title='Detail Data' onclick="handlerViewDataById('${v.canvas_id}')"><i class='fas fa-eye'> </i></button>`;
                        }
                        $('#listperencanaanpersiapan > tbody').append(`
                            <tr class="text-center">
                                <td>${i + 1}</td>
                                <td>${v.canvas_kode}</td>
                                <td>${v.client_wms_nama}</td>
                                <td>${v.principle_kode}</td>
                                <td>${v.tanggal}</td>
                                <td>${v.canvas_startdate}</td>
                                <td>${v.canvas_enddate}</td>
                                <td>${v.sales}</td>
                                <td>${getStringOfArrayString(v.area)}</td>
                                <td>${v.canvas_reff_kode}</td>
                                <td>${v.is_download}</td>
                                <td>${v.canvas_status}</td>
                                <td>${str}</td>
                            </tr>
                        `);
                    });
                } else {
                    $('#listperencanaanpersiapan > tbody').append(
                        `<tr><td colspan="13"><h4 class="text-center text-danger">Data not found</h4></td></tr>`
                    )
                }

            }).catch((error) => {
                message('Error!', 'Error ' + error, 'error')
            })
    }

    /** End Halaman Depan */

    const handlerChangeStatus = (event) => {
        if (event.currentTarget.checked) {
            $('#status').val(event.currentTarget.value)
        } else {
            $('#status').val('Draft')
        }
    }

    const handlerSelectAllSku = (event) => {
        if (event.currentTarget.checked) {
            $('[name="CheckboxSKU"]:checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('[name="CheckboxSKU"]:checkbox').each(function() {
                this.checked = false;
            });
        }
    }

    const handlerShowSKU = () => {
        if ($('#perusahaan').val() == "") {
            message('Error!', 'Perusahan kosong, harap pilih perusahaan terlebih dahulu!', 'error')
            return false;
        }

        $('#modal-sku').modal('show');

        postDataRequest('<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/getSKUbyPerusahaan') ?>', {
                perusahaan: $('#perusahaan').val(),
                principle_id: $('#principle_id').val()
            }, 'POST')
            .then((response) => {
                if (typeof response.ok !== 'undefined') {
                    message('Error!', response.status + " " + response.statusText, 'error')
                    return false;
                }

                $("#table-list-sku > tbody").empty();
                if (response.length > 0) {
                    $.each(response, function(i, v) {
                        $("#table-list-sku > tbody").append(`
								<tr>
										<td width="5%" class="text-center">
											<input type="checkbox" name="CheckboxSKU" id="check-sku-${i}" value="${v.sku_id}">
										</td>
										<td width="15%" class="text-center">${v.client_wms_nama}</td>
                    <td class="text-center">${v.sku_kode}</td>
                    <td width="15%" class="text-center">${v.sku_induk}</td>
                    <td width="25%" class="text-center">${v.sku_nama_produk}</td>
                    <td width="8%" class="text-center">${v.sku_kemasan}</td>
                    <td width="8%" class="text-center">${v.sku_satuan}</td>
                    <td width="10%" class="text-center">${v.principle}</td>
                    <td width="10%" class="text-center">${v.brand}</td>
								</tr>
						`);
                    });
                } else {
                    $("#table-list-sku > tbody").append(`
								<tr>
										<td colspan="9" class="text-center text-danger">
												Data not found
										</td>
								</tr>
						`);
                }

            }).catch((error) => {
                message('Error!', 'Error ' + error, 'error')
            })

    }

    const handlerChoosenSkuInChecked = () => {
        let jumlah = $('input[name="CheckboxSKU"]').length;
        let numberOfChecked = $('input[name="CheckboxSKU"]:checked').length;
        let no = 1;
        jumlah_sku = numberOfChecked;

        arr_sku = [];

        if (numberOfChecked > 0) {
            for (let i = 0; i < jumlah; i++) {
                let checked = $('[id="check-sku-' + i + '"]:checked').length;
                if (checked > 0) {
                    arr_sku.push($("#check-sku-" + i).val());
                }
            }

            postDataRequest('<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/GetSelectedSKU') ?>', {
                    arr_sku
                }, 'POST')
                .then((response) => {
                    if (typeof response.ok !== 'undefined') {
                        message('Error!', response.status + " " + response.statusText, 'error')
                        return false;
                    }

                    $.each(response, function(i, v) {

                        if (arrSkuSelected.length === 0) {
                            arrSkuSelected.push({
                                ...v,
                                qty: null,
                                qty2: null,
                                keterangan: null,
                                type: null,
                                is_cocok: null
                            });
                        } else {
                            const findData = arrSkuSelected.find((item) => (item.sku_id == v.sku_id))

                            if (typeof findData === 'undefined') {
                                arrSkuSelected.push({
                                    ...v,
                                    qty: null,
                                    qty2: null,
                                    keterangan: null,
                                    type: null,
                                    is_cocok: null
                                });
                            }
                        }
                    });

                    initDataToTableSku();

                }).catch((error) => {
                    message('Error!', 'Error ' + error, 'error')
                })

            // $("#listperencanaanpersiapan > tbody").empty();
        } else {
            message('Error!', 'Centang data minimal 1 SKU', 'error')
        }
    }

    const initDataToTableSku = () => {

        var result = arrSkuSelected.reduce((unique, o) => {
            if (!unique.some(obj => obj.sku_id === o.sku_id)) {
                unique.push(o);
            }
            return unique;
        }, []);

        console.log(result);


        if ($.fn.DataTable.isDataTable('#table-sku')) {
            $('#table-sku').DataTable().destroy();
        }

        $("#table-sku > tbody").empty();

        // if ($.fn.DataTable.isDataTable('#table-sku')) {
        //   $('#table-sku').DataTable().clear();
        //   $('#table-sku').DataTable().destroy();
        // }

        $.each(result, function(i, v) {

            let btnDlete = '';
            let styleTr = "";

            if ("<?= $this->uri->segment(4) == "view" ?>") {
                btnDlete += '-';
            } else {
                btnDlete +=
                    `<button class="btn btn-danger btn-sm btn-delete-sku" onclick="DeleteSKU(this,'${i}','${v.sku_id}', '${v.sku_kode}', '${v.sku_nama_produk}', '${v.sku_kemasan}', '${v.sku_satuan}','${v.qty}')"><i class="fa fa-trash"></i></button>`
            }

            if (v.is_cocok == null || v.is_cocok == "" || v.is_cocok == 0) {
                styleTr = 'style="background-color: #FA9884;"'
            }

            // if (v.type == null || v.type == "") {
            //     styleTr = 'style="background-color: #FA9884;"'
            // }

            // <span id="caption-${i}-detail-sku_qty">${v.qty == null ? "" : v.qty}</span>

            $("#table-sku > tbody").append(`
                <tr id="row-${i}" ${styleTr}>
                    <td style="display: none">
                        <input type="hidden" id="item-${i}-detail-sku_id" class="form-control sku-id" value="${v.sku_id}" />
                    </td>
                    <td class="text-center">
                        <span class="sku-kode-label">${v.principle}</span>
                    </td>
                    <td class="text-center">
                        <span class="sku-kode-label">${v.brand}</span>
                    </td>
                    <td class="text-center">
                        <span class="sku-kode-label">${v.sku_kode}</span>
                        <input type="hidden" id="item-${i}-detail-sku_kode" class="form-control sku-kode" value="${v.sku_kode}" />
                    </td>
                    <td class="text-center" style="display: none"></td>
                    <td class="text-center">
                        <span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
                        <input type="hidden" id="item-${i}-detail-sku_nama_produk" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
                    </td>
                    <td class="text-center">
                        <span class="sku-kemasan-label">${v.sku_kemasan}</span>
                        <input type="hidden" id="item-${i}-detail-sku_kemasan" class="form-control sku-kemasan" value="${v.sku_kemasan}" />
                    </td>
                    <td class="text-center">
                        <span class="sku-satuan-label">${v.sku_satuan}</span>
                        <input type="hidden" id="item-${i}-detail-sku_satuan" class="form-control sku-satuan" value="${v.sku_satuan}" />
                    </td>
                    <td class="text-center">
                         <input type="text" id="caption-${i}-detail-sku_qty" class="form-control input-sm" onchange="tempQty(this.value, '${v.sku_id}')" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> value="${v.qty == null ? "" : v.qty}"/>
                    </td>
                    <td class="text-center" hidden>
                        <button class="btn btn-success btn-sm btn-get-ed-sku" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> onclick="handlerGetEDSKU('${v.sku_id}', '${v.sku_kode}', '${v.sku_nama_produk}', '${v.sku_kemasan}', '${v.sku_satuan}','${v.qty}','${i}')"><i class="fa fa-plus"></i></button>
                    </td>
                    <td class="text-center" style="width:10%;">
                        <input type="text" id="item-${i}-detail-sku_keterangan" class="form-control input-sm" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> onchange="handlerChangeKeterangan('${i}', event)" value="${v.keterangan == null ? "" : v.keterangan}"/>
                    </td>
                    <td class="text-center" style="width:10%;">
                        <select id="item-${i}-detail-tipe_stock_nama" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> class="form-control input-sm select2" onchange="handlerChangeTypeStock('${i}', event)">
                            <option value="">**Pilih**</option>
                            <?php if ($this->uri->segment(4) == "create" || $this->uri->segment(4) == "edit" || $this->uri->segment(4) == "view") { ?>
                                <?php foreach ($tipeStock as $row) : ?>
                                <option value="<?= $row->tipe_stock_nama ?>" ${v.type == "<?= $row->tipe_stock_nama ?>" ? 'selected' : '' }><?= $row->tipe_stock_nama ?></option>
                                <?php endforeach ?>
                            <?php } ?>
                        </select>
                    </td>
                    <td class="text-center">${btnDlete}</td>
                </tr>
            `);

        });

        select2();

        $('#table-sku').DataTable({
            'info': false,
            'paging': false,
            'searching': false,
            'pagination': false,
            'ordering': false,
            scrollX: true
        });
    }

    const handlerChangeKeterangan = (idx, event) => {

        const findIndexData = arrSkuSelected.findIndex((item, index) => (index == idx))
        arrSkuSelected[findIndexData]['keterangan'] = event.currentTarget.value;

    }

    const handlerChangeTypeStock = (idx, event) => {
        const findIndexData = arrSkuSelected.findIndex((item, index) => (index == idx))
        arrSkuSelected[findIndexData]['type'] = event.currentTarget.value;
    }

    function tempQty(value, sku_id) {
        const findIndexData = arrSkuSelected.findIndex((item) => (item.sku_id == sku_id))
        arrSkuSelected[findIndexData]['qty'] = value;
        // arrSkuSelected[findIndexData]['qty2'] = value;
    }


    function DeleteSKU(row, idx, sku_id, sku_kode, sku_nama_produk, sku_kemasan, sku_satuan, sku_qty) {
        var row = row.parentNode.parentNode;
        row.parentNode.removeChild(row);

        const filter = arrSkuSelected.filter((item) => item.sku_id != sku_id)
        const filter2 = arrDataDetail2.filter((item) => item.sku_id != sku_id)

        arrSkuSelected.length = 0
        arrDataDetail2.length = 0

        $.each(filter, function(i, v) {
            arrSkuSelected.push(v)
        })


        $.each(filter2, function(i, v) {
            arrDataDetail2.push(v)
        });

        initDataToTableSku();

        // $("#table-sku tbody tr").each(function(i, v) {
        //     console.log(v);
        //     let rowId = $(this);
        //     let skuId = $(this).find("td:eq(0) input[type='hidden']")
        //     let skuKode = $(this).find("td:eq(3) input[type='hidden']")
        //     let skuNamaProduk = $(this).find("td:eq(5) input[type='hidden']")
        //     let skuKemasan = $(this).find("td:eq(6) input[type='hidden']")
        //     let skuSatuan = $(this).find("td:eq(7) input[type='hidden']")
        //     let skuQty = $(this).find("td:eq(8) span")
        //     let edSku = $(this).find("td:eq(9) button")
        //     let skuKeterangan = $(this).find("td:eq(10) input[type='text']")
        //     let typeStock = $(this).find("td:eq(11) select")
        //     let btnDelete = $(this).find("td:eq(12) button")

        //     rowId.attr('id', `row-${i}`);
        //     skuId.attr('id', `item-${i}-detail-sku_id`);
        //     skuKode.attr('id', `item-${i}-detail-sku_kode`);
        //     skuNamaProduk.attr('id', `item-${i}-detail-sku_nama_produk`);
        //     skuKemasan.attr('id', `item-${i}-detail-sku_kemasan`);
        //     skuSatuan.attr('id', `item-${i}-detail-sku_satuan`);
        //     skuQty.attr('id', `item-${i}-detail-sku_qty`);
        //     edSku.attr('onclick',
        //         `handlerGetEDSKU('${sku_id}', '${sku_kode}', '${sku_nama_produk}', '${sku_kemasan}', '${sku_satuan}', '${sku_qty}', '${i}')`
        //     )
        //     skuKeterangan.attr('id', `item-${i}-detail-sku_keterangan`);
        //     skuKeterangan.attr('onchange', `handlerChangeKeterangan('${i}', event)`);
        //     typeStock.attr('id', `item-${i}-detail-tipe_stock_nama`);
        //     typeStock.attr('onchange', `handlerChangeTypeStock('${i}', event)`);
        //     btnDelete.attr('onclick',
        //         `DeleteSKU(this,'${i}','${sku_id}', '${sku_kode}', '${sku_nama_produk}', '${sku_kemasan}', '${sku_satuan}', '${sku_qty}')`
        //     );
        // });
    }


    const handlerGetEDSKU = (sku_id, sku_kode, sku_nama_produk, sku_kemasan, sku_satuan, sku_qty, idx) => {

        $("#modal-ed-sku").modal('show');
        $("#loadingedsku").show();

        $("#caption-ed-sku-id").val(sku_id);
        $("#caption-ed-sku-kode").val(sku_kode);
        $("#caption-ed-sku-kemasan").val(sku_kemasan);
        $("#caption-ed-sku-satuan").val(sku_satuan);
        $("#caption-ed-sku").val(sku_nama_produk);
        // $("#caption-ed-sku-harga").val(sku_harga_jual);
        $("#caption-sku-qty").val('');
        $("#caption-sku-qty-order").val(sku_qty);
        $("#caption-ed-sku-index").val(idx);

        postDataRequest('<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/getEdSkuById') ?>', {
                sku_id
            }, 'POST')
            .then((response) => {
                if (typeof response.ok !== 'undefined') {
                    message('Error!', response.status + " " + response.statusText, 'error')
                    return false;
                }
                $("#loadingedsku").hide();

                if (response.length > 0) {
                    $("#table-ed-sku > tbody").empty();
                    let total_qty = 0;

                    $.each(response, function(i, v) {

                        let new_qty = "";

                        if (arrDataDetail2.length !== 0) {
                            const findData = arrDataDetail2.find((item) => (item.sku_id == v.sku_id) && (item.sku_stock_id == v.sku_stock_id) && (item.exp_date == v.sku_stock_expired_date))
                            if (typeof findData !== 'undefined') {
                                new_qty += findData.sku_qty;
                            } else {
                                new_qty += "";
                            }

                            console.log(arrDataDetail2);
                        }

                        total_qty += isNaN(parseInt(new_qty)) ? 0 : parseInt(new_qty);

                        $("#table-ed-sku > tbody").append(`
                            <tr>
                                <td width="10%" class="text-center">
                                    <input type="hidden" id="item-${i}-detail2-sku_id" value="${v.sku_id}">
                                    ${i + 1}
                                </td>
                                <td width="30%" class="text-center">${v.depo_detail_nama} <input type="hidden" id="item-${i}-detail2-sku_stock_id" value="${v.sku_stock_id}"></td>
                                <td width="20%" class="text-center">${v.sku_stock_expired_date}</td>
                                <td width="20%" class="text-center">${v.sku_stock_akhir}</td>
                                <td width="20%" class="text-center">
                                    <input type="text" class="form-control numeric" id="item-${i}-detail2-sku_qty" value="${new_qty == "" ? "" : new_qty}" onchange="handlerTotalQtySKUED('${i}',event,'${v.sku_stock_akhir}')">
                                </td>
                            </tr>
                        `);
                    });

                    $("#caption-sku-qty").val(total_qty);

                    let setQty = 0;
                    $("#table-ed-sku > tbody tr").each(function() {
                        let qty = $(this).find("td:eq(4) input[type='text']").val();
                        setQty += qty == "" ? 0 : parseInt(qty)
                    })

                    // $("#caption-sku-qty").val(setQty == 0 ? "" : setQty);
                } else {
                    $("#table-ed-sku > tbody").html(`<tr><td colspan="5" class="text-center text-danger">Data Kosong</td></tr>`);
                }

            }).catch((error) => {
                message('Error!', 'Error ' + error, 'error')
            })
    }

    const handlerTotalQtySKUED = (idx, event, stock_akhir) => {

        if (parseInt(event.currentTarget.value) <= parseInt(stock_akhir)) {
            let setQty = 0;
            $("#table-ed-sku > tbody tr").each(function() {
                let qty = $(this).find("td:eq(4) input[type='text']").val();
                setQty += qty == "" ? 0 : parseInt(qty)
            })
            $("#caption-sku-qty").val(setQty);
        } else {
            $("#item-" + idx + "-detail2-sku_qty").val('');

            let setQty = 0;
            $("#table-ed-sku > tbody tr").each(function() {
                let qty = $(this).find("td:eq(4) input[type='text']").val();
                setQty += qty == "" ? 0 : parseInt(qty)
            })

            $("#caption-sku-qty").val(setQty);

            message("Error", "Stok Tidak Cukup!", "error");
        }
    }

    const handlerChoosenEdSKU = () => {
        if ($("#caption-sku-qty").val() == 0 || $("#caption-sku-qty").val() == "") {
            message('Error!', 'Total Qty minimal harus terisi', 'error')
            return false;
        }

        let sku_qty_dtl = 0;
        let sku_qty_dtl2 = 0;
        let error = false;

        $("#table-ed-sku > tbody tr").each(function() {
            let sku_id = $(this).find("td:eq(0) input[type='hidden']");
            let sku_stock_id = $(this).find("td:eq(1) input[type='hidden']");
            let sku_exp_date = $(this).find("td:eq(2)");
            let sku_stock_akhir = $(this).find("td:eq(3)");
            let sku_qty = $(this).find("td:eq(4) input[type='text']");

            if (arrDataDetail2.length === 0) {
                arrDataDetail2.push({
                    'sku_id': sku_id.val(),
                    'sku_stock_id': sku_stock_id.val(),
                    'exp_date': sku_exp_date.text(),
                    'sku_qty': sku_qty.val()
                });
            } else {
                const findData = arrDataDetail2.find((item) => (item.sku_id == sku_id.val()) && (item
                    .sku_stock_id == sku_stock_id.val()) && (item.exp_date == sku_exp_date.text()))

                if (typeof findData === 'undefined') {
                    arrDataDetail2.push({
                        'sku_id': sku_id.val(),
                        'sku_stock_id': sku_stock_id.val(),
                        'exp_date': sku_exp_date.text(),
                        'sku_qty': sku_qty.val()
                    });
                } else {
                    const findIndexData = arrDataDetail2.findIndex((item) => (item.sku_id == sku_id.val()) && (
                        item.sku_stock_id == sku_stock_id.val()) && (item.exp_date == sku_exp_date
                        .text()))

                    arrDataDetail2[findIndexData]['sku_qty'] = sku_qty.val();
                }
            }

            sku_qty_dtl2 += isNaN(parseInt(sku_qty.val())) ? 0 : parseInt(sku_qty.val());

            // if (parseInt(sku_stock_akhir.text()) != 0) {
            //   if (sku_qty.val() == "") {
            //     message('Error!', 'Qty Ambil tidak boleh kosong', 'error')
            //     error = true
            //     return false
            //   } else {
            //     error = false

            //   }
            // }
        })


        if (error) return false;

        const findIndexData = arrSkuSelected.findIndex((item, index) => (index == $("#caption-ed-sku-index").val()))


        if (isNaN(parseInt($("#caption-sku-qty-order").val()))) {
            sku_qty_dtl = 0;
        } else {
            sku_qty_dtl = parseInt($("#caption-sku-qty-order").val());
        }

        console.log(sku_qty_dtl + "-" + sku_qty_dtl2);

        arrSkuSelected[findIndexData]['qty'] = sku_qty_dtl2;
        arrSkuSelected[findIndexData]['qty2'] = sku_qty_dtl2;
        arrSkuSelected[findIndexData]['is_cocok'] = sku_qty_dtl2 == sku_qty_dtl ? '1' : '0';


        $("#modal-ed-sku").modal('hide');

        $('#table-sku').fadeOut("slow", function() {
            $(this).hide();
        }).fadeIn("slow", function() {
            $(this).show();
            initDataToTableSku()
        });
    }

    const handlerSaveData = () => {

        let error = false;
        let canvasId = "<?= isset($_GET['id']) ? $_GET['id'] : null ?>";

        // if (arrDataDetail2.length == 0) {
        //     message('Error!', 'SKU Stock tidak boleh kosong', 'error');
        //     error = true;
        //     return false
        // }

        if ($('#sales').val() == "") {
            message('Error!', 'Sales tidak boleh kosong', 'error')
            error = true;
            return false
        }

        if ($('#perusahaan').val() == "") {
            message('Error!', 'Perusahaan tidak boleh kosong', 'error')
            error = true;
            return false
        }

        if ($('#tgl_mulai').val() == "") {
            message('Error!', 'Tanggal mulai tidak boleh kosong', 'error')
            error = true;
            return false
        }

        if ($('#tgl_akhir').val() == "") {
            message('Error!', 'Tanggal akhir tidak boleh kosong', 'error')
            error = true;
            return false
        }

        if ($('#kendaraan_id').val() == "") {
            message('Error!', 'No. Kendaraan tidak boleh kosong', 'error')
            error = true;
            return false
        }

        const areas = $("#area").children("option").filter(":selected").map(function() {
            return this.value;
        }).get();

        if (areas.length === 0) {
            message('Error!', 'Area tidak boleh kosong', 'error')
            error = true;
            return false
        }

        if ($('#table-sku > tbody tr').length == 0) {
            message('Error!', 'Data barang yang dikirim tidak boleh kosong', 'error')
            error = true;
            return false
        } else {
            console.log(arrSkuSelected);
            $("#table-sku > tbody tr").each(function(idx) {
                // let skuQty = $(this).find("td:eq(8) span").text()
                let skuQty = $(this).find("td:eq(8) input").val()
                let typeStock = $(this).find("td:eq(11) select").children("option").filter(":selected").val();
                // let qty2 = arrSkuSelected[idx]['qty2'];

                if (skuQty == "" || skuQty == '0') {
                    $(this).css("background-color", "#FA9884");
                    message('Error!', 'Jumlah Barang tidak boleh 0 atau kosong!', 'error');
                    // message('Error!', 'ED Produk masih kosong', 'error');

                    error = true;
                    return false
                } else if (typeStock == "") {
                    $(this).css("background-color", "#FA9884");
                    message('Error!', 'Type stock tidak boleh kosong', 'error');

                    error = true;
                    return false
                }
                //  else if (qty2 == "" || qty2 == null || qty2 == 0) {
                //     $(this).css("background-color", "#FA9884");
                //     message('Error!', 'SKU Stock masih kosong', 'error');

                //     error = true;
                //     return false
                // }
                else {
                    error = false
                    $(this).css("background-color", "");
                }


            });
        }

        if (!error) {
            messageBoxBeforeRequest('Pastikan data yang sudah anda input benar!', 'Iya, Simpan', 'Tidak, Tutup').then((
                result) => {
                if (result.value == true) {
                    postData("<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/saveData') ?>", {
                        kodeDokumen: $('#kode_dokumen').val(),
                        sales: $('#sales').val(),
                        perusahaan: $('#perusahaan').val(),
                        tglMulai: $('#tgl_mulai').val(),
                        tglAkgir: $('#tgl_akhir').val(),
                        kendaraanId: $('#kendaraan_id').val(),
                        status: $('#status').val(),
                        keterangan: $('#keterangan').val(),
                        lastUpdated: $('#lastUpdated').val(),
                        principle_id: $('#principle_id').val(),
                        canvasDetail: arrSkuSelected,
                        // canvasDetail2: arrDataDetail2,
                        canvasId,
                        areas,
                        mode: "<?= $this->uri->segment(4) == "create" ? 'new' : ($this->uri->segment(4) == "edit" ? 'edit' : '') ?>"
                    }, 'POST', function(response) {
                        if (response.status === 200) {
                            const msgRes =
                                "<?= $this->uri->segment(4) == "create" ? "Data berhasil di simpan" : ($this->uri->segment(4) == "edit" ? "Data berhasil di diupdate" : "") ?>";
                            message_topright_global('success', msgRes)
                            setTimeout(() => {
                                Swal.fire({
                                    title: '<span ><i class="fa fa-spinner fa-spin"></i> Loading...</span>',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                location.href =
                                    "<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/PerencanaanDanPersiapanMenu') ?>";
                            }, 1000);
                        }

                        if (response.status === 401) return message_topright_global("error", response
                            .message);
                        if (response.status === 400) return messageNotSameLastUpdated()
                    })
                }
            });
        }

    }

    /** Handler Edit */
    const handlerEditData = (canvasId) => {
        location.href = "<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/edit?id=') ?>" + canvasId;
    }

    const requestDataDetailCanvas = () => {
        postDataRequest('<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/requestDataDetailCanvas') ?>', {
                canvasId: "<?= isset($_GET['id']) ? $_GET['id'] : "" ?>"
            }, 'POST')
            .then((response) => {

                if (typeof response.ok !== 'undefined') {
                    message('Error!', response.status + " " + response.statusText, 'error')
                    return false;
                }

                if (response != null) {
                    if (response.canvasDetail.length > 0) {
                        $.each(response.canvasDetail, function(i, v) {
                            arrSkuSelected.push({
                                brand: v.brand,
                                keterangan: v.sku_keterangan,
                                principle: v.principle,
                                qty: v.sku_qty,
                                qty2: v.sku_qty_dtl2,
                                sku_id: v.sku_id,
                                sku_kemasan: v.sku_kemasan,
                                sku_kode: v.sku_kode,
                                sku_nama_produk: v.sku_nama,
                                sku_satuan: v.sku_satuan,
                                type: v.tipe_stock_nama,
                                is_cocok: v.is_cocok
                            });
                        })
                    }

                    if (response.canvasDetail2.length > 0) {
                        $.each(response.canvasDetail2, function(i, v) {
                            arrDataDetail2.push(v);
                        })
                    }
                    initDataToTableSku()
                }

            }).catch((error) => {
                message('Error!', 'Error ' + error, 'error')
            })
    }
    /** End Handler Edit */


    /** Handler View */

    const handlerViewDataById = (canvasId) => {
        location.href = "<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/view?id=') ?>" + canvasId;
    }

    /** End Handler View */


    /** Handler Delete */

    const handlerHapusDataById = (canvasId, lastUpdated) => {

        messageBoxBeforeRequest('Ingin hapus data ini!', 'Iya, Hapus', 'Tidak, Tutup').then((result) => {
            if (result.value == true) {
                postData("<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/deleteDataCanvas') ?>", {
                    canvasId,
                    lastUpdated
                }, 'POST', function(response) {
                    if (response.status === 200) {
                        message_topright_global('success', "Data berhasil dihapus")
                        setTimeout(() => {
                            Swal.fire({
                                title: '<span ><i class="fa fa-spinner fa-spin"></i> Loading...</span>',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            location.reload();
                        }, 1000);
                    }

                    if (response.status === 401) return message_topright_global("error", response
                        .message);
                    if (response.status === 400) return messageNotSameLastUpdated()
                })
            }
        });

    }

    $("#btndownloadpb").click(function() {
        var jml_pb = 0;
        var cek_pb = 0;

        if ($("#filter_perusahaan").val() != "") {

            $.ajax({
                type: 'POST',
                url: "<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/GetPenerimaanBarangBosnet') ?>",
                data: {
                    tgl: $("#filter_tgl_request").val(),
                    perusahaan: $("#filter_perusahaan").val(),
                },
                dataType: "JSON",
                beforeSend: function() {

                    $("#btndownloadpb").prop("disabled", true);
                    $("#btnsearchdata").prop("disabled", true);

                    Swal.fire({
                        title: 'Loading ...',
                        html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                        timerProgressBar: false,
                        showConfirmButton: false
                    });
                },
                success: function(response) {
                    $("#loadingdownload").hide();
                    $("#btndownloadpb").prop("disabled", false);
                    $("#btnsearchdata").prop("disabled", false);

                    // console.log(response);

                    if (response != "0") {

                        if (response == "2") {
                            let alert_tes = "Perusahaan Tidak Memiliki Principle";
                            message("Error", alert_tes, "error");
                        } else {
                            jml_pb = response.length;

                            $.each(response, function(i, v) {
                                $.ajax({
                                    type: 'POST',
                                    url: "<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/Insert_bosnet_penerimaan_barang') ?>",
                                    data: {
                                        data_pb_bosnet: response
                                    },
                                    dataType: "JSON",
                                    async: false,
                                    success: function(response) {
                                        console.log("insert penerimaan barang eksternal success");
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        console.log("insert penerimaan barang eksternal failed");
                                    }
                                });

                                cek_pb++;
                            });

                            if (jml_pb == cek_pb) {


                                $.ajax({
                                    type: 'POST',
                                    url: "<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/GetBosnetPenerimaanBarang') ?>",
                                    data: {
                                        tgl: $("#filter_tgl_request").val(),
                                        perusahaan: $("#filter_perusahaan").val(),
                                    },
                                    dataType: "JSON",
                                    async: false,
                                    beforeSend: function() {

                                        $("#btndownloadpb").prop("disabled", true);
                                        $("#btnsearchdata").prop("disabled", true);

                                        Swal.fire({
                                            title: 'Loading ...',
                                            html: '<span><i class="fa fa-spinner fa-spin" style="font-size:60px"></i></span>',
                                            timerProgressBar: false,
                                            showConfirmButton: false
                                        });
                                    },
                                    success: function(response) {
                                        // console.log(response);

                                        if (response.BosnetPenerimaanBarangHeader != "0" && response
                                            .BosnetPenerimaanBarangDetail != "0") {
                                            $.ajax({
                                                type: 'POST',
                                                url: "<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/Insert_canvas') ?>",
                                                data: {
                                                    perusahaan: $("#filter_perusahaan").val(),
                                                    data_pb_eksternal_header: response.BosnetPenerimaanBarangHeader,
                                                    // data_pb_eksternal_detail: response.BosnetPenerimaanBarangDetail,
                                                },
                                                dataType: "JSON",
                                                async: false,
                                                success: function(response) {
                                                    // console.log("insert canvas success");

                                                    $.each(response, function(i, v) {

                                                        if (v.kode == "1") {

                                                            let alert_tes = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                                            message("Success", alert_tes, "success");

                                                        } else if (v.kode == "2") {

                                                            let alert_tes = GetLanguageByKode('CAPTION-ALERT-SUDAHADA');

                                                            var msg = "<span style='font-weight:bold'>Canvas Reff " + v.reff_id + "</span> " + alert_tes;
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

                                                        } else if (v.kode == "3") {

                                                            // let alert_tes = GetLanguageByKode('CAPTION-ALERT-MAPPINGKARYAWANEKSTERNALTIDAKDITEMUKAN');
                                                            let alert_tes = "Mapping Karyawan Eksternal Tidak Ditemukan";

                                                            var msg = "<span style='font-weight:bold'>Reff ID " + v.reff_id + "</span> " + alert_tes;
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

                                                        } else if (v.kode == "4") {

                                                            let alert_tes = "SKU Konversi Group " + v.sku_konversi_group + " Tidak Ditemukan";

                                                            var msg = "<span style='font-weight:bold'>Reff ID " + v.reff_id + "</span> " + alert_tes;
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

                                                        } else if (v.kode == "12") {

                                                            let alert_tes = v.msg;

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

                                                        } else if (v.kode == "13") {

                                                            let alert_tes = v.msg;

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

                                                        } else if (v.kode == "14") {

                                                            let alert_tes = v.msg;

                                                            var msg = "<span style='font-weight:bold'>Principle " + v.reff_id + "</span> " + alert_tes;
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

                                                        } else if (v.kode == "15") {

                                                            let alert_tes = v.msg;

                                                            var msg = "<span style='font-weight:bold'>Karyawan " + v.reff_id + "</span> " + alert_tes;
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

                                                    });

                                                    GetCanvasByFilter();

                                                },
                                                error: function(xhr, ajaxOptions, thrownError) {
                                                    // console.log("insert canvas failed");

                                                    // let alert_tes = GetLanguageByKode('CAPTION-ALERT-DATABERHASILDISIMPAN');
                                                    let alert_tes = "Error 500 External System Server Connection Failure";
                                                    message("Error", alert_tes, "error");

                                                }
                                            });
                                        } else {
                                            let alert_tes = GetLanguageByKode('CAPTION-ALERT-TIDAKADAPENERIMAANBARANGDARISISTEMEKSTERNAL');
                                            message("Error", alert_tes, "error");
                                        }
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        let alert_tes = "Error 500 External System Server Connection Failure";
                                        message("Error", alert_tes, "error");

                                        $("#btndownloadpb").prop("disabled", false);
                                        $("#btnsearchdata").prop("disabled", false);
                                    },
                                    complete: function() {
                                        Swal.close();

                                        $("#btndownloadpb").prop("disabled", false);
                                        $("#btnsearchdata").prop("disabled", false);
                                    }
                                });
                            }
                        }

                    } else {
                        console.log("tidak ada pb bosnet");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.close()

                    $("#btndownloadpb").prop("disabled", false);
                    $("#btnsearchdata").prop("disabled", false);
                },
                complete: function() {
                    Swal.close();

                    $("#btndownloadpb").prop("disabled", false);
                    $("#btnsearchdata").prop("disabled", false);
                }
            });

        } else {
            $("#loadingdownload").hide();
            $("#btndownloadpb").prop("disabled", false);
            $("#btnsearchdata").prop("disabled", false);

            let alert_tes = GetLanguageByKode('CAPTION-MSG03');
            message("Error", alert_tes, "error");

        }
    });

    function GetCanvasByFilter() {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/GetCanvasByFilter') ?>",
            data: {
                tgl: $("#filter_tgl_request").val(),
                perusahaan: $("#filter_perusahaan").val(),
            },
            dataType: "JSON",
            async: false,
            success: function(response) {
                // console.log(response);
                $('#listperencanaanpersiapan > tbody').empty();

                if ($.fn.DataTable.isDataTable('#listperencanaanpersiapan')) {
                    $('#listperencanaanpersiapan').DataTable().clear();
                    $('#listperencanaanpersiapan').DataTable().destroy();
                }

                $.each(response, function(i, v) {
                    let str = "";

                    if (v.canvas_status == "Draft") {
                        str +=
                            `<button class='btn btn-warning btn-md' title='Edit Data' onclick="handlerEditData('${v.canvas_id}')"><i class='fa fa-edit'></i></button>`;
                        str +=
                            `<button class='btn btn-danger btn-md' title='Hapus Data' onclick="handlerHapusDataById('${v.canvas_id}', '${v.canvas_tgl_update}')"><i class='fa fa-xmark'></i></button>`;
                    } else {
                        str +=
                            `<button class='btn btn-primary btn-md' title='Detail Data' onclick="handlerViewDataById('${v.canvas_id}')"><i class='fas fa-eye'> </i></button>`;
                    }

                    $('#listperencanaanpersiapan > tbody').append(`
						<tr class="text-center">
							<td>${i + 1}</td>
							<td>${v.canvas_kode}</td>
							<td>${v.client_wms_nama}</td>
                            <td>${v.principle_kode}</td>
							<td>${v.canvas_requestdate}</td>
							<td>${v.canvas_startdate}</td>
							<td>${v.canvas_enddate}</td>
							<td>${v.karyawan_nama}</td>
							<td>${v.area_kode}</td>
                            <td>${v.canvas_reff_kode}</td>
                            <td>${v.is_download}</td>
							<td>${v.canvas_status}</td>
							<td>${str}</td>
						</tr>
					`)
                })

                $('#listperencanaanpersiapan').DataTable({
                    'ordering': false,
                    scrollX: true
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                let alert_tes = "Error 500 System Server Connection Failure";
                message("Error", alert_tes, "error");
            }
        });
    }

    function GetPrincipleByPerusahaan() {

        $("#principle_id").html('');

        $.ajax({
            type: 'GET',
            url: "<?= base_url('FAS/OperasionalCanvas/PerencanaanDanPersiapan/GetPrincipleByPerusahaan') ?>",
            data: {
                perusahaan: $("#perusahaan").val(),
            },
            dataType: "JSON",
            async: false,
            success: function(response) {
                if (response.length > 0) {

                    $.each(response, function(i, v) {
                        $("#principle_id").append(`<option value="${v.principle_id}">${v.principle_kode}</option>`);
                    })
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                let alert_tes = "Error 500 System Server Connection Failure";
                message("Error", alert_tes, "error");
            }
        });
    }

    /** End Handler Delete */
</script>