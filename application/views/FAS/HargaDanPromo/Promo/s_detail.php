<script>
    $(document).ready(function() {
        GetPromoDetail();

        $('#table-data-customer').DataTable({
            "lengthMenu": [
                [25, 50, 100, -1],
                [25, 50, 100, "All"]
            ]
        });
    })

    function GetPromoDetail() {
        var headerPerusahaan = $("#headerPerusahaan").val();

        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail1') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val()
            },
            dataType: "JSON",
            success: function(response) {
                $('#span_promo_detail').html('');

                if (response != 0) {

                    $.each(response, function(i, v) {
                        if (v.sku_promo_detail1_use_groupsku == 1) {
                            $('#span_promo_detail').append(`
                                <div class="row" id="panel-promo-detail-${i}">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h4 class="pull-left" name="CAPTION-SKUDKIRIM">Table Input Harga #${v.sku_promo_detail1_nourut}</h4>
                                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_nourut_${i}" value="${v.sku_promo_detail1_nourut}">
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-principle_id">
                                                        <label class="control-label" for="SKUPromoDetail-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
                                                        <select disabled name="SKUPromoDetail[principle_id_${i}]" class="form-control select2" id="SKUPromoDetail-principle_id_${i}" onChange="UpdateSKUDetailPromo1('${i}')">
                                                            <option value="">${v.principle_nama}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-sku_group_filter">
                                                        <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
                                                        <select disabled name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
                                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                            <option value="1" ${v.sku_promo_detail1_use_groupsku=='1' ?'selected':''}>Ya</option>
                                                            <option value="0" ${v.sku_promo_detail1_use_groupsku=='0' ?'selected':''}>Tidak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-sku_group_filter">
                                                        <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_${i}" value="${v.sku_promo_detail1_id}">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <table class="table table-bordered" id="table-syarat-item-${i}" style="width:100%;height: 250px;">
                                                        <thead>
                                                            <tr>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-SYARATITEMS">Syarat Items</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <input disabled onclick="chgQtyOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_qty_order=='1' ?'checked':''}> Dasar Jumlah Qty Order
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <input disabled onclick="chgValueOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_value_order=='1' ?'checked':''}> Dasar Jumlah Value Order
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    Min Order Product :
                                                                    <select disabled class="form-control" name="SKUPromoDetail[sku_promo_detail1_min_order_sku_${i}]" id="SKUPromoDetail-sku_promo_detail1_min_order_sku_${i}" style="width:20%;" onChange="UpdateSKUDetailPromo1('${i}')">
                                                                        <option value="1" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>1</option>
                                                                        <option value="0" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>0</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input disabled type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_bonus_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_bonus_${i}" value="1" onClick="SetPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus=='1' ?'checked':''}> Bonus
                                                                </td>
                                                                <td>
                                                                    <input disabled type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_diskon_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_diskon_${i}" value="1" onClick="SetPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon=='1' ?'checked':''}> Diskon
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-xs-8">
                                                    <table class="table table-bordered" id="table-product-promo-${i}" style="width:100%;height: 250px;">
                                                        <thead>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
                                                                <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="3"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPSKU">Group SKU</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPNAMA">Group Nama</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PENGECUALIAN">Pengecualian</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                    <table class="table table-bordered" id="table-product-promo-by-sku-${i}" style="width:100%;height: 250px;display:none;">
                                                        <thead>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="4"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
                                                                <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKODE">Kode SKU</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKU">SKU</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row" style="float: right">
                                                <input type="hidden" id="promo_detail_index" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `);

                            var principle_id = $("#SKUPromoDetail-principle_id_" + i).val();
                            var checked_bonus = $('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + i + '"]:checked').length;
                            var checked_diskon = $('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + i + '"]:checked').length;

                            $.ajax({
                                async: false,
                                type: 'GET',
                                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail22') ?>",
                                data: {
                                    sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                                    sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + i).val()
                                },
                                dataType: "JSON",
                                success: function(response) {
                                    $('#table-product-promo-' + i + ' > tbody').empty();

                                    // if ($.fn.DataTable.isDataTable('#table-sku')) {
                                    // $('#table-product-promo-' + i).DataTable().clear();
                                    // $('#table-product-promo-' + i).DataTable().destroy();
                                    // }

                                    if (response.length > 0) {
                                        $.each(response, function(idx, val) {
                                            $('#table-product-promo-' + i + ' > tbody').append(`
                                                <tr id="row-${idx}">
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        ${idx+1}
                                                        <input type="hidden" id="item-${idx}-SKUPromoDetail2-sku_promo_detail2_id" value="${val.sku_promo_detail2_id}">
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        <select disabled name="FilterPencarianSKU[principle_id]" class="input-sm form-control select2" id="item-${i}-${idx}-SKUPromoDetail2-kategori_grup" onchange="GetKategoriByGroup('${val.sku_promo_detail2_id}',this.value,'${i}','${idx}','${principle_id}')">
                                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **${val.kategori_grup}</option>
                                                            <?php foreach ($KategoriGroup as $row) : ?>
                                                                <option value="<?= $row['kategori_grup'] ?>" ${val.kategori_grup == '<?= $row['kategori_grup'] ?>' ? 'selected' : '' }><?= $row['kategori_grup'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        <select disabled name="FilterPencarianSKU[principle_id]" class="input-sm form-control select2" id="item-${i}-${idx}-SKUPromoDetail2-kategori_id" onChange="UpdateSKUDetailPromo2('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}',this.value,'0')">
                                                            <option value="">${val.kategori_nama}</option>
                                                        </select>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;display:none;">
                                                        <span id="item-${idx}-SKUPromoDetail2-qty">0</span>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        <button class="btn btn-info btn-sm">${val.count_bonus}</button>
                                                        <button class="btn ${parseInt(val.count_bonus) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_bonus_${i}" id="item-${idx}-SKUPromoDetail2-atur_bonus" onclick="AturBonus('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}')" ${checked_bonus> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        <button class="btn btn-info btn-sm">${val.count_diskon}</button>
                                                        <button class="btn ${parseInt(val.count_diskon) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_diskon_${i}" id="item-${idx}-SKUPromoDetail2-atur_diskon" onclick="AturDiskon('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}')" ${checked_diskon> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        <button class="btn btn-primary btn-small" id="item-${idx}-SKUPromoDetail2-atur_pengecualian" onclick="AturPengecualian('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}')"><i class="fa fa-pencil"></i></button>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        
                                                    </td>
                                                </tr>';
                                            `);
                                        });

                                        // $.each(response, function(idx, val) {
                                        //     $.ajax({
                                        //         async: false,
                                        //         type: 'GET',
                                        //         url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetKategoriByPrincipleKategori') ?>",
                                        //         data: {
                                        //             principle_id: principle_id,
                                        //             kategori_grup: $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_grup").val()
                                        //         },
                                        //         dataType: "JSON",
                                        //         success: function(response) {
                                        //             $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_id").html('');
                                        //             $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_id").append(`<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>`);

                                        //             $.each(response, function(i2, v2) {
                                        //                 $("#item-" + i + "-" + idx + "-SKUPromoDetail2-kategori_id").append(`<option value="${v2.kategori_id}" ${val.kategori_id == v2.kategori_id ? 'selected' : '' }>${v2.kategori_nama}</option>`);
                                        //             });
                                        //         }
                                        //     });
                                        // });

                                        // $('#table-product-promo-' + i).DataTable({
                                        // "lengthMenu": [
                                        // [-1],
                                        // ["All"]
                                        // ],
                                        // "paging": false,
                                        // "ordering": false,
                                        // "searching": false,
                                        // "info": false,
                                        // scrollY: '300px',
                                        // scrollCollapse: true
                                        // });
                                    }
                                }
                            });
                        } else if (v.sku_promo_detail1_use_groupsku == 0) {
                            $('#span_promo_detail').append(`
                                <div class="row" id="panel-promo-detail-${i}">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h4 class="pull-left" name="CAPTION-SKUDKIRIM">Table Input Harga #${v.sku_promo_detail1_nourut}</h4>
                                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_nourut_${i}" value="${v.sku_promo_detail1_nourut}">
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-principle_id">
                                                        <label class="control-label" for="SKUPromoDetail-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
                                                        <select name="SKUPromoDetail[principle_id_${i}]" class="form-control select2" id="SKUPromoDetail-principle_id_${i}" onChange="UpdateSKUDetailPromo1('${i}')">
                                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                            ${slc}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-sku_group_filter">
                                                        <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
                                                        <select name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
                                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                            <option value="1" ${v.sku_promo_detail1_use_groupsku=='1' ?'selected':''}>Ya</option>
                                                            <option value="0" ${v.sku_promo_detail1_use_groupsku=='0' ?'selected':''}>Tidak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-sku_group_filter">
                                                        <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_${i}" value="${v.sku_promo_detail1_id}">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <table class="table table-bordered" id="table-syarat-item-${i}" style="width:100%;height: 250px;">
                                                        <thead>
                                                            <tr>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-SYARATITEMS">Syarat Items</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <input onclick="chgQtyOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_qty_order=='1' ?'checked':''}> Dasar Jumlah Qty Order
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <input onclick="chgValueOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')" ${v.sku_promo_detail1_use_value_order=='1' ?'checked':''}> Dasar Jumlah Value Order
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    Min Order Product :
                                                                    <select class="form-control" name="SKUPromoDetail[sku_promo_detail1_min_order_sku_${i}]" id="SKUPromoDetail-sku_promo_detail1_min_order_sku_${i}" style="width:20%;" onChange="UpdateSKUDetailPromo1('${i}')">
                                                                        <option value="1" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>1</option>
                                                                        <option value="0" ${v.sku_promo_detail1_min_order_sku=='1' ?'selected':''}>0</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_bonus_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_bonus_${i}" value="1" onClick="SetPengaturanBonus('${i}')" ${v.sku_promo_detail1_use_bonus=='1' ?'checked':''}> Bonus
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_diskon_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_diskon_${i}" value="1" onClick="SetPengaturanDiskon('${i}')" ${v.sku_promo_detail1_use_diskon=='1' ?'checked':''}> Diskon
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-xs-8">
                                                    <table class="table table-bordered" id="table-product-promo-${i}" style="width:100%;height: 250px;display:none;">
                                                        <thead>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
                                                                <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="3"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPSKU">Group SKU</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPNAMA">Group Nama</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PENGECUALIAN">Pengecualian</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                    <table class="table table-bordered" id="table-product-promo-by-sku-${i}" style="width:100%;height: 250px;">
                                                        <thead>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="4"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
                                                                <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKODE">Kode SKU</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKU">SKU</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row" style="float: right">
                                                <input type="hidden" id="promo_detail_index" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);

                            var checked_bonus = $('[id="SKUPromoDetail-sku_promo_detail1_use_bonus_' + i + '"]:checked').length;
                            var checked_diskon = $('[id="SKUPromoDetail-sku_promo_detail1_use_diskon_' + i + '"]:checked').length;

                            $.ajax({
                                async: false,
                                type: 'GET',
                                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_temp') ?>",
                                data: {
                                    sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                                    sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_" + i).val()
                                },
                                dataType: "JSON",
                                success: function(response) {
                                    $('#table-product-promo-by-sku-' + i + ' > tbody').empty();

                                    // if ($.fn.DataTable.isDataTable('#table-sku')) {
                                    // $('#table-product-promo-' + i).DataTable().clear();
                                    // $('#table-product-promo-' + i).DataTable().destroy();
                                    // }

                                    if (response.length > 0) {
                                        $.each(response, function(idx, val) {
                                            $('#table-product-promo-by-sku-' + i + ' > tbody').append(`
                                                <tr id="row-${idx}">
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        ${idx+1}
                                                        <input type="hidden" id="item-${idx}-SKUPromoDetail2-sku_promo_detail2_id" value="${val.sku_promo_detail2_id}">
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        ${val.sku_kode}
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        ${val.sku_nama_produk}
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        ${val.sku_kemasan}
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        ${val.sku_satuan}
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;display:none;">
                                                        <span id="item-${idx}-SKUPromoDetail2-qty">0</span>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        <button class="btn btn-info btn-sm">${val.count_bonus}</button>
                                                        <button class="btn ${parseInt(val.count_bonus) > 0 ? 'btn-success' : 'btn-warning'}  btn-small btn_atur_bonus_${idx}" id="item-${idx}-SKUPromoDetail2-atur_bonus" onclick="AturBonusBySKU('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}','${val.sku_id}','${val.sku_kode}','${val.sku_nama_produk}','${val.sku_kemasan}','${val.sku_satuan}')" ${checked_bonus> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                        ${val.count_diskon}
                                                        <button class="btn ${parseInt(val.count_diskon) > 0 ? 'btn-success' : 'btn-warning'} btn-small btn_atur_diskon_${idx}" id="item-${idx}-SKUPromoDetail2-atur_diskon" onclick="AturDiskonBySKU('${val.sku_promo_detail2_id}','${val.sku_promo_detail1_id}','${val.sku_promo_id}','${i}','${idx}','${val.sku_id}','${val.sku_kode}','${val.sku_nama_produk}','${val.sku_kemasan}','${val.sku_satuan}')" ${checked_diskon> 0 ? '' : 'disabled'}><i class="fa fa-pencil"></i></button>
                                                    </td>
                                                    <td style="vertical-align:middle; text-align:center;">
                                                       
                                                    </td>
                                                </tr>';
                                            `);
                                        });

                                        // $('#table-product-promo-' + i).DataTable({
                                        // "lengthMenu": [
                                        // [-1],
                                        // ["All"]
                                        // ],
                                        // "paging": false,
                                        // "ordering": false,
                                        // "searching": false,
                                        // "info": false,
                                        // scrollY: '300px',
                                        // scrollCollapse: true
                                        // });
                                    }
                                }
                            });

                        } else {
                            $('#span_promo_detail').append(`
                                <div class="row" id="panel-promo-detail-${i}">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h4 class="pull-left" name="CAPTION-SKUDKIRIM">Table Input Harga #${v.sku_promo_detail1_nourut}</h4>
                                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_nourut_${i}" value="${v.sku_promo_detail1_nourut}">
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-principle_id">
                                                        <label class="control-label" for="SKUPromoDetail-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
                                                        <select name="SKUPromoDetail[principle_id_${i}]" class="form-control select2" id="SKUPromoDetail-principle_id_${i}" onChange="UpdateSKUDetailPromo1('${i}')">
                                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                            ${slc}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-sku_group_filter">
                                                        <label class="control-label" for="SKUPromoDetail-sku_group_filter" name="CAPTION-GUNAKANGROUPSKU">Gunakan Group SKU</label>
                                                        <select name="SKUPromoDetail[sku_promo_detail1_use_groupsku_${i}]" class="form-control" id="SKUPromoDetail-sku_promo_detail1_use_groupsku_${i}" onChange="UseGroupSKU(this.value,'${v.sku_promo_detail1_use_groupsku}','${i}')">
                                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                                            <option value="1" ${v.sku_promo_detail1_use_groupsku=='1' ?'selected':''}>Ya</option>
                                                            <option value="0" ${v.sku_promo_detail1_use_groupsku=='0' ?'selected':''}>Tidak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group field-SKUPromoDetail-sku_group_filter">
                                                        <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_${i}" value="${v.sku_promo_detail1_id}">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <table class="table table-bordered" id="table-syarat-item-${i}" style="width:100%;height: 250px;">
                                                        <thead>
                                                            <tr>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-SYARATITEMS">Syarat Items</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <input onclick="chgQtyOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_qty_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_qty_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')"> Dasar Jumlah Qty Order
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <input onclick="chgValueOrder(this.checked, '${i}')" type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_value_order_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_value_order_${i}" value="1" onChange="UpdateSKUDetailPromo1('${i}')"> Dasar Jumlah Value Order
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    Min Order Product :
                                                                    <select class="form-control" name="SKUPromoDetail[sku_promo_detail1_min_order_sku_${i}]" id="SKUPromoDetail-sku_promo_detail1_min_order_sku_${i}" style="width:20%;" onChange="UpdateSKUDetailPromo1('${i}')">
                                                                        <option value="1">1</option>
                                                                        <option value="0">0</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_bonus_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_bonus_${i}" value="1" onClick="SetPengaturanBonus('${i}')"> Bonus
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" name="SKUPromoDetail[sku_promo_detail1_use_diskon_${i}]" id="SKUPromoDetail-sku_promo_detail1_use_diskon_${i}" value="1" onClick="SetPengaturanDiskon('${i}')"> Diskon
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-xs-8">
                                                    <table class="table table-bordered" id="table-product-promo-${i}" style="width:100%;height: 250px;display:none;">
                                                        <thead>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
                                                                <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="3"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPSKU">Group SKU</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:20%;"><span name="CAPTION-GROUPNAMA">Group Nama</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PENGECUALIAN">Pengecualian</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                    <table class="table table-bordered" id="table-product-promo-by-sku-${i}" style="width:100%;height: 250px;display:none;">
                                                        <thead>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-NO">No</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="4"><span name="CAPTION-PRODUCTPROMO">Product Promo</span></th>
                                                                <th style="vertical-align:middle; text-align:center;display:none;" rowspan="2"><span name="CAPTION-SKUQTY">Qty</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" colspan="2"><span name="CAPTION-PENGATURANPRODUK">Pengaturan Produk</span></th>
                                                                <th style="vertical-align:middle; text-align:center;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKODE">Kode SKU</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKU">SKU</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
                                                                <th style="vertical-align:middle; text-align:center;width:10%;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BONUS">Bonus</span></th>
                                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-DISKON">Diskon</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row" style="float: right">
                                                <input type="hidden" id="promo_detail_index" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }
                    });

                    $(".select2").select2();
                }
            }
        });
    }

    function AturBonus(sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, idx, idx2) {

        var sku_group_id = $.trim($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_grup").children("option:selected").text());
        var sku_group_nama = $.trim($("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").children("option:selected").text());
        var kategori_id = $("#item-" + idx + "-" + idx2 + "-SKUPromoDetail2-kategori_id").val();
        var principle_id = $("#SKUPromoDetail-principle_id_" + idx).val();

        // alert(sku_group_nama)

        $("#modal-pengaturan-by-one").modal('show');
        $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val('');
        $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val('');
        $("#Filter-principle_id_by_one").val('');
        $("#FilterPengaturan-kategori_id_by_one").val('');

        $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val(sku_promo_detail1_id);
        $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val(sku_promo_detail2_id);
        $("#Filter-principle_id_by_one").val(principle_id);
        $("#FilterPengaturan-sku_group_id_by_one").val(sku_group_id);
        $("#FilterPengaturan-sku_group_nama_by_one").val(sku_group_nama);
        $("#FilterPengaturan-kategori_id_by_one").val(kategori_id);

        $("#panel-pengaturan-detail-by-one").hide();
        $("#table-pengaturan-detail-by-one tbody").empty();

        var checked = $(`#SKUPromoDetail-sku_promo_detail1_use_value_order_${idx}`).prop('checked');

        if (checked) {
            $("#dasar_jumlah_order").val('value order')
        } else {
            $("#dasar_jumlah_order").val('qty order')
        }

        GetPromoDetail2BonusByOne();
    }

    function GetPromoDetail2BonusByOne() {
        $.ajax({
            async: false,
            type: 'GET',
            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_bonus_by_one') ?>",
            data: {
                sku_promo_id: $("#SKUPromo-sku_promo_id_new").val(),
                sku_promo_detail1_id: $("#SKUPromoDetail-sku_promo_detail1_id_by_one").val(),
                sku_promo_detail2_id: $("#SKUPromoDetail-sku_promo_detail2_id_by_one").val(),
            },
            dataType: "JSON",
            success: function(response) {
                $('#table-pengaturan-header-by-one > tbody').empty();
                var stringValue = $("#dasar_jumlah_order").val();
                var str = '';

                if (stringValue == 'value order') {
                    $("#thMinimum").html("<span name='CAPTION-VALUEMININUM'>Value Minimum</span>")
                } else {
                    $("#thMinimum").html("<span name='CAPTION-QTYMINIMUM'>Qty Minimum</span>")
                }

                if (response != "0") {

                    $.each(response, function(i, v) {
                        if (stringValue == 'value order') {
                            str = `<input disabled type="text" onkeyup="formatNominal(this)" id="item-${i}-SKUPromoDetail2Bonus-sku_min_qty_by_one" class="form-control input-sm" value="${v.sku_min_value == 0 ? '' : formatNumber(parseFloat(v.sku_min_value))}" onChange="UpdateSKUPromoDetail2Bonus('${i}','by_one')" />`
                        } else {
                            str = `<input disabled type="number" id="item-${i}-SKUPromoDetail2Bonus-sku_min_qty_by_one" class="form-control input-sm" value="${v.sku_min_qty}" onChange="UpdateSKUPromoDetail2Bonus('${i}','by_one')" />`
                        }

                        $('#table-pengaturan-header-by-one > tbody').append(`
						<tr>
							<td class="text-center">
								${v.sku_promo_detail2_bonus_nourut}
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut_by_one" value="${v.sku_promo_detail2_bonus_nourut}">
							</td>
							<td class="text-center">
                                ${str}
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one" value="${v.sku_promo_detail2_bonus_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one" value="${v.sku_promo_detail2_id}">
								<input type="hidden" id="item-${i}-SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one" value="${v.sku_promo_detail1_id}">
							</td>
							<td class="text-center">
								<input disabled type="checkbox" id="item-${i}-SKUPromoDetail2Bonus-is_berkelipatan_by_one" value="1" ${v.is_berkelipatan == '1' ? 'checked' : ''} onChange="UpdateSKUPromoDetail2Bonus('${i}','by_one')"/>
							</td>
							<td class="text-center">
                                <button class="btn btn-info btn-sm">${v.jml_detail}</button>
								<button class="btn btn-primary btn-sm" onclick="ViewBonusDetail2ByOne('${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}',${i})"><i class="fa fa-pencil"></i></button>
							</td>
						</tr>';
					`);
                    });
                }
            }
        });
    }

    function ViewBonusDetail2ByOne(sku_promo_detail2_bonus_id, sku_promo_detail2_id, sku_promo_detail1_id, sku_promo_id, index) {

        var no_urut = $("#item-" + index + "-SKUPromoDetail2Bonus-sku_promo_detail2_bonus_nourut_by_one").val();
        $("#SKUPromoDetail2Bonus-no_urut_by_one").html('');
        $("#SKUPromoDetail2Bonus-check_pilihan").val('');

        $("#panel-pengaturan-detail-by-one").show();
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one").val(sku_promo_detail2_bonus_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one").val(sku_promo_detail2_id);
        $("#SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one").val(sku_promo_detail1_id);
        $("#SKUPromoDetail2Bonus-sku_promo_id").val(sku_promo_id);
        $("#SKUPromoDetail2Bonus-index").val(index);
        $("#SKUPromoDetail2Bonus-check_pilihan").val("by_one");
        $("#SKUPromoDetail2Bonus-no_urut_by_one").append(no_urut);

        pushToTablePengaturanDetail();

    }

    function pushToTablePengaturanDetail() {

        var check_pilihan = $("#SKUPromoDetail2Bonus-check_pilihan").val();

        if (check_pilihan == "all") {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_bonus_detail_temp') ?>",
                data: {
                    sku_promo_detail2_bonus_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id").val(),
                    sku_promo_detail2_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_id").val(),
                    sku_promo_detail1_id: $("#SKUPromoDetail2Bonus-sku_promo_detail1_id").val(),
                    sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val()
                },
                dataType: "JSON",
                success: function(response) {
                    $('#table-pengaturan-detail > tbody').empty('');

                    if ($.fn.DataTable.isDataTable('#table-pengaturan-detail')) {
                        $('#table-pengaturan-detail').DataTable().clear();
                        $('#table-pengaturan-detail').DataTable().destroy();
                    }

                    if (response != 0) {
                        $.each(response, function(i, v) {
                            $("#table-pengaturan-detail > tbody").append(`
                        <tr id="row-${i}">
                            <td class="text-center">
                                ${i+1}
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus2_id" value="${v.sku_promo_detail2_bonus2_id}" />
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus_id" value="${v.sku_promo_detail2_bonus_id}" />
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_id" value="${v.sku_id}" />
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_nama_produk" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_kemasan" class="form-control sku-kemasan" value="${v.sku_kemasan}" />
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_satuan" class="form-control sku-satuan" value="${v.sku_satuan}" />
                            </td>
                            <td class="text-center">
                                <span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
                            </td>
                            <td class="text-center">
                                <span class="sku-kemasan-label">${v.sku_kemasan}</span>
                            </td>
                            <td class="text-center">
                                <span class="sku-satuan-label">${v.sku_satuan}</span>
                            </td>
                            <td class="text-center" style="width:10%;">
                                <input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-sku_qty_bonus" class="form-control input-sm" value="${v.sku_qty_bonus}" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','all')"/>
                            </td>
                            <td class="text-center" style="width:10%;display:none;">
                                <select id="item-${i}-SKUPromoDetail2BonusDetail-sku_tipe_id" class="form-control input-sm" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','all')">
                                    <option value="">**Pilih**</option>
                                </select>
                            </td>
                            <td class="text-center" style="width:10%;">
                                <select id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon_id" class="form-control select2"  onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','all')">
                                    <option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
                                    <?php if ($ReferensiDiskon != "0") {
                                        foreach ($ReferensiDiskon as $value) : ?>
                                            <option value="<?= $value['referensi_diskon_id']; ?>" ${v.referensi_diskon_id == '<?= $value['referensi_diskon_id'] ?>' ? 'selected' : ''}><?= $value['referensi_diskon_kode']; ?></option>
                                    <?php endforeach;
                                    } ?>
                                </select>
                            </td>
                            <td class="text-center">
                            </td>
                        </tr>
                    `);
                        });

                        $('#table-pengaturan-detail').DataTable({
                            'info': false,
                            'paging': false,
                            'searching': false,
                            'pagination': false,
                            'ordering': false,
                            scrollX: true,
                            scrollY: '300px',
                            scrollCollapse: true
                        });

                        $(".select2").select2();
                    }
                }
            });
        } else if (check_pilihan == "by_one") {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_bonus_detail2') ?>",
                data: {
                    sku_promo_detail2_bonus_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one").val(),
                    sku_promo_detail2_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one").val(),
                    sku_promo_detail1_id: $("#SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one").val(),
                    sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val()
                },
                dataType: "JSON",
                success: function(response) {
                    $('#table-pengaturan-detail-by-one > tbody').empty('');

                    if ($.fn.DataTable.isDataTable('#table-pengaturan-detail-by-one')) {
                        $('#table-pengaturan-detail-by-one').DataTable().clear();
                        $('#table-pengaturan-detail-by-one').DataTable().destroy();
                    }

                    if (response != 0) {
                        $.each(response, function(i, v) {
                            $("#table-pengaturan-detail-by-one > tbody").append(`
                        <tr id="row-${i}">
                            <td class="text-center">
                                ${i+1}
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus2_id_by_one" value="${v.sku_promo_detail2_bonus2_id}" />
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus_id_by_one" value="${v.sku_promo_detail2_bonus_id}" />
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_id_by_one" value="${v.sku_id}" />
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_nama_produk_by_one" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_kemasan_by_one" class="form-control sku-kemasan" value="${v.sku_kemasan}" />
                                <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_satuan_by_one" class="form-control sku-satuan" value="${v.sku_satuan}" />
                            </td>
                            <td class="text-center">
                                <span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
                            </td>
                            <td class="text-center">
                                <span class="sku-kemasan-label">${v.sku_kemasan}</span>
                            </td>
                            <td class="text-center">
                                <span class="sku-satuan-label">${v.sku_satuan}</span>
                            </td>
                            <td class="text-center" style="width:10%;">
                                <input disabled type="text" id="item-${i}-SKUPromoDetail2BonusDetail-sku_qty_bonus_by_one" class="form-control input-sm" value="${v.sku_qty_bonus}" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_one')"/>
                            </td>
                            <td class="text-center" style="width:10%;display:none;">
                                <select disabled id="item-${i}-SKUPromoDetail2BonusDetail-sku_tipe_id_by_one" class="form-control input-sm" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_one')">
                                    <option value="">**Pilih**</option>
                                </select>
                            </td>
                            <td class="text-center" style="width:10%;">
                                <select disabled id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_one" class="form-control select2" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_one')">
                                    <option value="">${v.referensi_diskon_kode}</option>
                                </select>
                            </td>
                            <td class="text-center">
                            </td>
                        </tr>
                    `);
                        });

                        $(".select2").select2({
                            width: '100%'
                        });

                        $('#table-pengaturan-detail-by-one').DataTable({
                            'info': false,
                            'paging': false,
                            'searching': false,
                            'pagination': false,
                            'ordering': false,
                            scrollX: true,
                            scrollY: '300px',
                            scrollCollapse: true
                        });

                        $(".select2").select2();
                    }
                }
            });
        } else if (check_pilihan == "by_sku") {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/Get_sku_promo_detail2_bonus_detail_temp') ?>",
                data: {
                    sku_promo_detail2_bonus_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_sku").val(),
                    sku_promo_detail2_id: $("#SKUPromoDetail2Bonus-sku_promo_detail2_id_by_sku").val(),
                    sku_promo_detail1_id: $("#SKUPromoDetail2Bonus-sku_promo_detail1_id_by_sku").val(),
                    sku_promo_id: $("#SKUPromoDetail2Bonus-sku_promo_id").val()
                },
                dataType: "JSON",
                success: function(response) {
                    $('#table-pengaturan-detail-by-sku > tbody').empty('');

                    if ($.fn.DataTable.isDataTable('#table-pengaturan-detail-by-sku')) {
                        $('#table-pengaturan-detail-by-sku').DataTable().clear();
                        $('#table-pengaturan-detail-by-sku').DataTable().destroy();
                    }

                    if (response != 0) {
                        $.each(response, function(i, v) {
                            $("#table-pengaturan-detail-by-sku > tbody").append(`
                    <tr id="row-${i}">
                        <td class="text-center">
                            ${i+1}
                            <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus2_id_by_sku" value="${v.sku_promo_detail2_bonus2_id}" />
                            <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_promo_detail2_bonus_id_by_sku" value="${v.sku_promo_detail2_bonus_id}" />
                            <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_id_by_sku" value="${v.sku_id}" />
                            <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_nama_produk_by_sku" class="form-control sku-nama-produk" value="${v.sku_nama_produk}" />
                            <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_kemasan_by_sku" class="form-control sku-kemasan" value="${v.sku_kemasan}" />
                            <input type="hidden" id="item-${i}-SKUPromoDetail2BonusDetail-sku_satuan_by_sku" class="form-control sku-satuan" value="${v.sku_satuan}" />
                        </td>
                        <td class="text-center">
                            <span class="sku-nama-produk-label">${v.sku_nama_produk}</span>
                        </td>
                        <td class="text-center">
                            <span class="sku-kemasan-label">${v.sku_kemasan}</span>
                        </td>
                        <td class="text-center">
                            <span class="sku-satuan-label">${v.sku_satuan}</span>
                        </td>
                        <td class="text-center" style="width:10%;">
                            <input type="text" id="item-${i}-SKUPromoDetail2BonusDetail-sku_qty_bonus_by_sku" class="form-control input-sm" value="${v.sku_qty_bonus}" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_sku')"/>
                        </td>
                        <td class="text-center" style="width:10%;display:none;">
                            <select id="item-${i}-SKUPromoDetail2BonusDetail-sku_tipe_id_by_sku" class="form-control input-sm" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_sku')">
                                <option value="">**Pilih**</option>
                            </select>
                        </td>
                        <td class="text-center" style="width:10%;">
                            <select id="item-${i}-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_sku" class="form-control select2" onChange="UpdateSKUPromoDetail2BonusDetail('${v.sku_promo_detail2_bonus2_id}','${v.sku_promo_detail2_bonus_id}','${v.sku_promo_detail2_id}','${v.sku_promo_detail1_id}','${v.sku_promo_id}','${v.sku_id}','${i}','by_sku')">
                                <option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
                            </select>
                        </td>
                        <td class="text-center">
                        </td>
                    </tr>
                `);
                        });

                        $("item-" + i + "-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_sku").html('');

                        $.ajax({
                            type: 'GET',
                            url: "<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/GetReferensiDiskonByKategori') ?>",
                            dataType: "JSON",
                            data: {
                                kategori: $("#FilterPengaturanDiskon-kategori_id_by_one").val()
                            },
                            success: function(response2) {
                                if (response2 != 0) {
                                    $.each(response2, function(idx, val) {
                                        $("item-" + i + "-SKUPromoDetail2BonusDetail-referensi_diskon_id_by_sku").append(`<option value="${val.referensi_diskon_id}" ${val.referensi_diskon_id == v.referensi_diskon_id}>${val.referensi_diskon_kode}</option>`);
                                    })
                                }

                            }
                        });

                        $('#table-pengaturan-detail-by-sku').DataTable({
                            'info': false,
                            'paging': false,
                            'searching': false,
                            'pagination': false,
                            'ordering': false,
                            scrollX: true,
                            scrollY: '300px',
                            scrollCollapse: true
                        });

                        $(".select2").select2();
                    }
                }
            });
        }
    }

    function message_custom(titleType, iconType, htmlType) {
        Swal.fire({
            title: titleType,
            icon: iconType,
            html: htmlType,
        });
    }

    function message2(msg, msgtext, msgtype) {
        Swal.fire(msg, msgtext, msgtype);
    }

    function message_topright2(titleType, iconType, htmlType) {
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

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>