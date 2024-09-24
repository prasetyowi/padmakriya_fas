<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span name="CAPTION-BUAT">Buat</span> Back Order</h3>
            </div>
            <div style="float: right">
            </div>
        </div>
        <?php foreach ($SOHeader as $header) : ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group field-backorder-back_order_kode">
                                    <label class="control-label" for="backorder-back_order_kode" name="CAPTION-NOSO">No SO</label>
                                    <input readonly="readonly" type="text" id="backorder-back_order_kode" class="form-control" name="backorder[back_order_kode]" autocomplete="off" value="<?= $header['back_order_kode'] ?>">
                                    <input type="hidden" id="cek_sku" value="1">
                                    <input type="hidden" id="cek_customer" value="1">
                                    <input type="hidden" id="so_id" value="<?= $so_id ?>">
                                    <input type="hidden" id="tgl_update" value="<?= $header['tglUpdate'] ?>">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-backorder-back_order_no_po">
                                    <label class="control-label" for="backorder-back_order_no_po" name="CAPTION-NOPO">No PO</label>
                                    <input type="text" class="form-control" id="backorder-back_order_no_po" name="backorder[back_order_no_po]" value="<?= $header['back_order_no_po'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-backorder-tipe_back_order_id">
                                    <label class="control-label" for="backorder-tipe_back_order_id" name="CAPTION-TIPESO">Tipe SO</label>
                                    <select name="backorder[tipe_back_order_id]" class="input-sm form-control select2" id="backorder-tipe_back_order_id" disabled>
                                        <option value="">** <label name="CAPTION-TIPESO">Tipe SO</label> **</option>
                                        <?php foreach ($TipeBackOrder as $row) : ?>
                                            <option value="<?= $row['tipe_back_order_id'] ?>" <?= $header['tipe_back_order_id'] == $row['tipe_back_order_id'] ? 'selected' : '' ?>>
                                                <?= $row['tipe_back_order_nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-backorder-tipe_delivery_order_id">
                                    <label class="control-label" for="backorder-tipe_delivery_order_id" name="CAPTION-TIPEDO">Tipe DO</label>
                                    <select name="backorder[tipe_delivery_order_id]" class="input-sm form-control select2" id="backorder-tipe_delivery_order_id" disabled>
                                        <option value="">** <label name="CAPTION-TIPEDO">Tipe DO</label> **</option>
                                        <?php foreach ($TipeDeliveryOrder as $row) : ?>
                                            <option value="<?= $row['tipe_delivery_order_id'] ?>" <?= $header['tipe_delivery_order_id'] == $row['tipe_delivery_order_id'] ? 'selected' : '' ?>>
                                                <?= $row['tipe_delivery_order_nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group field-backorder-back_order_tgl">
                                    <label class="control-label" for="backorder-back_order_tgl" name="CAPTION-TGLSO">Tanggal SO</label>
                                    <input type="text" id="backorder-back_order_tgl" class="form-control input-sm datepicker" name="backorder[back_order_tgl]" autocomplete="off" value="<?= $header['back_order_tgl'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-backorder-back_order_tgl_exp">
                                    <label class="control-label" for="backorder-back_order_tgl_exp" name="CAPTION-TGLEXP">Tanggal Expired</label>
                                    <input type="text" id="backorder-back_order_tgl_exp" class="form-control input-sm datepicker" name="backorder[back_order_tgl_exp]" autocomplete="off" value="<?= $header['back_order_tgl_exp'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group field-backorder-back_order_tgl_harga">
                                    <label class="control-label" for="backorder-back_order_tgl_harga" name="CAPTION-TGLHARGA">Tanggal Harga</label>
                                    <input type="text" id="backorder-back_order_tgl_harga" class="form-control input-sm datepicker" name="backorder[back_order_tgl_harga]" autocomplete="off" value="<?= $header['back_order_tgl_harga'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group field-backorder-back_order_tgl_sj">
                                    <label class="control-label" for="backorder-back_order_tgl_sj" name="CAPTION-TGLSJ">Tanggal Surat Jalan</label>
                                    <input type="text" id="backorder-back_order_tgl_sj" class="form-control input-sm datepicker" name="backorder[back_order_tgl_sj]" autocomplete="off" value="<?= $header['back_order_tgl_sj'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group field-backorder-back_order_tgl_kirim">
                                    <label class="control-label" for="backorder-back_order_tgl_kirim" name="CAPTION-TGLKIRIM">Tanggal Kirim</label>
                                    <input type="text" id="backorder-back_order_tgl_kirim" class="form-control input-sm datepicker" name="backorder[back_order_tgl_kirim]" autocomplete="off" value="<?= $header['back_order_tgl_kirim'] ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <label name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                <select id="backorder-client_wms_id" name="backorder[client_wms_id]" class="form-control select2" style="width:100%;" disabled>
                                    <option value=""><label name="CAPTION-PILIH">Pilih</label></option>
                                    <?php foreach ($Perusahaan as $type) : ?>
                                        <option value="<?= $type['client_wms_id'] ?>" <?= $header['client_wms_id'] == $type['client_wms_id'] ? 'selected' : '' ?>><?= $type['client_wms_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <label name="CAPTION-PRINCIPLE">Principle</label>
                                <select id="backorder-principle_id" name="backorder[principle_id]" class="form-control select2" style="width:100%;" disabled>
                                    <option value=""><label name="CAPTION-PILIH">Pilih</label></option>
                                    <?php foreach ($Principle as $type) : ?>
                                        <option value="<?= $type['principle_id'] ?>" <?= $header['principle_id'] == $type['principle_id'] ? 'selected' : '' ?>><?= $type['principle_kode'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group field-backorder-sales_id">
                                    <label for="backorder-sales_id" class="control-label" name="CAPTION-SALES">Sales</label>
                                    <select id="backorder-sales_id" class="input-sm form-control select2" name="CAPTION-SALES" onChange="GetPerusahaanBySales(this.value)" disabled>
                                        <option value="">** <label name="CAPTION-SALES">Sales</label> **</option>
                                        <?php foreach ($Sales as $row) : ?>
                                            <option value="<?= $row['karyawan_id'] ?>" <?= $header['sales_id'] == $row['karyawan_id'] ? 'selected' : '' ?>> <?= $row['karyawan_nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group field-backorder-back_order_tipe_pembayaran">
                                    <label for="backorder-back_order_tipe_pembayaran" class="control-label" name="CAPTION-TIPEPEMBAYARAN">Tipe Pembayaran</label>
                                    <fieldset>
                                        <label>
                                            <input class="radio-payment-type" type="radio" name="backorder[back_order_tipe_pembayaran]" id="backorder-back_order_tipe_pembayaran" value="0" onclick="reset_table_sku()" <?= $header['back_order_tipe_pembayaran'] == '0' ? 'checked' : '' ?> disabled> <span name="CAPTION-TUNAI">Tunai</span>
                                        </label>
                                    </fieldset>
                                    <fieldset>
                                        <label>
                                            <input class="radio-payment-type" type="radio" name="backorder[back_order_tipe_pembayaran]" id="backorder-back_order_tipe_pembayaran" value="1" onclick="reset_table_sku()" <?= $header['back_order_tipe_pembayaran'] == '1' ? 'checked' : '' ?> disabled> <span name="CAPTION-NONTUNAI">Non Tunai</span>
                                        </label>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-backorder-back_order_tipe_ppn">
                                    <label for="backorder-back_order_tipe_ppn" class="control-label" name="CAPTION-TIPEPPN">Tipe PPN</label>
                                    <fieldset>
                                        <label>
                                            <input <?= $SOHeader[0]['tipe_ppn'] == 'ppn_global' ? 'checked disabled' : 'disabled' ?> onclick="chgTipePPN(this.value)" class="radio-payment-type" type="radio" name="backorder[back_order_tipe_ppn]" id="backorder-back_order_tipe_ppn" value="0"> <span name="CAPTION-PPNGLOBAL">PPN Global</span>
                                        </label>
                                    </fieldset>
                                    <fieldset>
                                        <label>
                                            <input <?= $SOHeader[0]['tipe_ppn'] == 'ppn_detail' ? 'checked disabled' : 'disabled' ?> onclick="chgTipePPN(this.value)" class="radio-payment-type" type="radio" name="backorder[back_order_tipe_ppn]" id="backorder-back_order_tipe_ppn" value="1"> <span name="CAPTION-PPNDETAIL">PPN Detail</span>
                                        </label>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-backorder-back_order_status">
                                    <label class="control-label" for="backorder-back_order_status" name="CAPTION-STATUS">Status</label>
                                    <input readonly="readonly" type="text" id="backorder-back_order_status" class="form-control" name="backorder[back_order_status]" autocomplete="off" value="<?= $header['back_order_status'] ?>" disabled>
                                </div>
                                <!-- <div class="form-group field-backorder-so_is_need_approval">
                                    <input type="checkbox" id="backorder-so_is_need_approval" name="backorder[so_is_need_approval]" autocomplete="off" value="1" <?= $header['back_order_status'] != 'Draft' ? 'checked' : '' ?> disabled> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
                                </div> -->
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-backorder-back_order_who_create">
                                    <label class="control-label" for="backorder-back_order_approved_by" name="CAPTION-DISETUJUI">Disetujui</label>
                                    <input readonly="readonly" type="text" id="backorder-back_order_approved_by" class="form-control" name="backorder[back_order_approved_by]" autocomplete="off" value="<?= $header['back_order_approved_by'] ?>">
                                </div>
                                <div class="form-group field-backorder-back_order_is_handheld">
                                    <input type="checkbox" id="backorder-back_order_is_handheld" name="backorder[back_order_is_handheld]" autocomplete="off" <?= $header['back_order_is_handheld'] == '1' ? 'checked' : '' ?> disabled> <span name="CAPTION-UPLOADHH">Upload dari handheld</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="panel-customer">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h4 class="pull-left" name="CAPTION-CUST">Customer</h4>
                            <div class="clearfix"></div>
                        </div>
                        <input type="hidden" name="backorder[client_pt_id]" id="backorder-client_pt_id" value="<?= $header['client_pt_id'] ?>" />
                        <input type="hidden" name="backorder[back_order_kirim_nama]" id="backorder-back_order_kirim_nama" value="" />
                        <input type="hidden" name="backorder[back_order_kirim_alamat]" id="backorder-back_order_kirim_alamat" value="" />
                        <input type="hidden" name="backorder[back_order_kirim_provinsi]" id="backorder-back_order_kirim_provinsi" value="" />
                        <input type="hidden" name="backorder[back_order_kirim_kota]" id="backorder-back_order_kirim_kota" value="" />
                        <input type="hidden" name="backorder[back_order_kirim_kecamatan]" id="backorder-back_order_kirim_kecamatan" value="" />
                        <input type="hidden" name="backorder[back_order_kirim_kelurahan]" id="backorder-back_order_kirim_kelurahan" value="" />
                        <input type="hidden" name="backorder[back_order_kirim_kodepos]" id="backorder-back_order_kirim_kodepos" value="" />
                        <input type="hidden" name="backorder[back_order_kirim_area]" id="backorder-back_order_kirim_area" value="" />
                        <input type="hidden" name="backorder[back_order_kirim_telepon]" id="backorder-back_order_kirim_telepon" value="" />
                        <div style="text-align: center; display: none;" class="spinner"><img style="width: 30px;" src="<?= base_url() ?>/assets/images/spinner.gif" alt=""></div>
                        <div class="customer-info">
                            <div class="row">
                                <div class="col-xs-4">
                                    <label name="CAPTION-CUSTNAME">Nama:</label>
                                    <div class="customer-name"><?= $header['client_pt_nama'] ?></div>
                                </div>
                                <div class="col-xs-4">
                                    <label name="CAPTION-CUSTADDRESS">Alamat:</label>
                                    <div class="customer-address"><?= $header['client_pt_alamat'] ?></div>
                                </div>
                                <div class="col-xs-4">
                                    <label name="CAPTION-CUSTAREA">Area:</label>
                                    <div class="customer-area"><?= $header['area_nama'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="row" id="panel-sku">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4 class="pull-left" name="CAPTION-BARANGYANGDIKIRIM">Barang Yang Dikirim</h4>
                        <div class="clearfix"></div>
                    </div>
                    <table class="table table-striped" id="table-sku-delivery-only" style="width:100%;">
                        <thead>
                            <tr class="bg-primary">
                                <!-- <th class="text-center" style="color:white;"><span name="CAPTION-PERUSAHAAN">Perusahaan</span></th> -->
                                <th class="text-center" style="display:none;"></th>
                                <!-- <th class="text-center" style="color:white;"><span name="CAPTION-PRINCIPLE">Principle</span></th> -->
                                <th class="text-center" style="color:white;"><span name="CAPTION-BRAND">Brand</span>
                                </th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-SKUKODE">SKU
                                        Kode</span></th>
                                <th class="text-center" style="display:none;"></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-SKU">SKU</span></th>
                                <!-- <th class="text-center" style="color:white;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th> -->
                                <th class="text-center" style="color:white;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-HARGA">Harga</span>
                                </th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-SKUQTY">Qty</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-DISKONITEM">Diskon Item(%)</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-DISKONRUPIAH">Diskon Item(Rp)</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-SUBJUMLAH">Sub
                                        Jumlah</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-DISKONGLOBAL">Diskon Global(%)</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-DISKONGLOBALRUPIAH">Diskon Global(Rp)</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-PPN">PPN (%)</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-PPNRUPIAH">PPN (Rp)</span></th>
                                <!-- <th class="text-center" style="color:white;"><span name="CAPTION-ED">ED Product</span></th> -->
                                <th class="text-center" style="color:white;"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-ACTION">Action</span></th>
                                <!-- <th class="text-center" style="color:white;"><span name="CAPTION-TIPESTOK">Tipe
                                        Stok</span></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <input type="hidden" id="item-count-BackOrderDetail" value="<?= count($SODetail) ?>">
                            <?php foreach ($SODetail as $i => $item) : ?>
                                <tr id="row-<?= $i ?>">
                                    <td style="display: none">
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-client_wms_id" value="<?= $item['client_wms_id'] ?>" class="client-wms-id" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_id" value="<?= $item['sku_id'] ?>" class="sku-id" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_harga_satuan" class="sku-harga-satuan" value="<?= $item['sku_harga_satuan'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_disc_percent" class="sku-disc-percent" value="0" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_disc_rp" class="sku-disc-rp" value="0" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_harga_nett" class="sku-harga-nett" value="<?= $item['sub_total'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_weight" class="sku-weight" value="<?= $item['sku_weight'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_weight_unit" class="sku-weight-unit" value="<?= $item['sku_weight_unit'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_length" class="sku-length" value="<?= $item['sku_length'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_length_unit" class="sku-length-unit" value="<?= $item['sku_length_unit'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_width" class="sku-width" value="<?= $item['sku_width'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_width_unit" class="sku-width-unit" value="<?= $item['sku_width_unit'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_height" class="sku-height" value="<?= $item['sku_height'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_height_unit" class="sku-height-unit" value="<?= $item['sku_height_unit'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_volume" class="sku-volume" value="<?= $item['sku_volume'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_volume_unit" class="sku-volume-unit" value="<?= $item['sku_volume_unit'] ?>" />
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_qty" class="form-control sku-qty" value="<?= $item['sku_qty'] ?>" />
                                    </td>
                                    <!-- <td class="text-center">
                                        <span class="sku-kode-label"><?= $item['principle'] ?></span>
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-principle" class="form-control sku-kode" value="<?= $item['principle'] ?>" />
                                    </td> -->
                                    <td class="text-center">
                                        <span class="sku-kode-label"><?= $item['brand'] ?></span>
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-brand" class="form-control sku-kode" value="<?= $item['brand'] ?>" />
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-kode-label"><?= $item['sku_kode'] ?></span>
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_kode" class="form-control sku-kode" value="<?= $item['sku_kode'] ?>" />
                                    </td>
                                    <td class="text-center" style="display: none"></td>
                                    <td class="text-center">
                                        <span class="sku-nama-produk-label"><?= $item['sku_nama_produk'] ?></span>
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_nama_produk" class="form-control sku-nama-produk" value="<?= $item['sku_nama_produk'] ?>" />
                                    </td>
                                    <!-- <td class="text-center">
                                        <span class="sku-kemasan-label"><?= $item['sku_kemasan'] ?></span>
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_kemasan" class="form-control sku-kemasan" value="<?= $item['sku_kemasan'] ?>" />
                                    </td> -->
                                    <td class="text-center">
                                        <span class="sku-satuan-label"><?= $item['sku_satuan'] ?></span>
                                        <input type="hidden" id="item-<?= $i ?>-BackOrderDetail-sku_satuan" class="form-control sku-satuan" value="<?= $item['sku_satuan'] ?>" />
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-satuan-label"><?= number_format(round($item['sku_harga_satuan']), 0, ',', '.') ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-<?= $i ?>-BackOrderDetail-sku_qty"><?= number_format(round($item['sku_qty']), 0, ',', '.')  ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-<?= $i ?>-BackOrderDetail-sku_disc_percent"><?= round($item['sku_disc_percent']) ?></span>
                                        <!-- <input onchange="chgSubJumlah(this.value, '<?= $i ?>', '<?= round($item['sku_harga_satuan']) ?>', 'disc_item')" type="text" id="input-item-<?= $i ?>-BackOrderDetail-sku_disc_percent" class="form-control numericInput" value="<?= round($item['sku_disc_percent']) ?>" /> -->
                                    </td>
                                    <td class="text-center">
                                        <!-- <span id="caption-<?= $i ?>-BackOrderDetail-sku_disc_percent"><?= round($item['sku_disc_rp']) ?></span> -->
                                        <span id="caption-<?= $i ?>-BackOrderDetail-sku_disc_rp"><?= number_format(round($item['sku_disc_rp']), 0, ',', '.') ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-<?= $i ?>-BackOrderDetail-sku_harga_nett"><?= number_format(round($item['sub_total']), 0, ',', '.')  ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-<?= $i ?>-BackOrderDetail-sku_disc_global_percent"><?= round($item['sku_diskon_global_percent']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-<?= $i ?>-BackOrderDetail-sku_disc_global_rupiah"><?= number_format(round($item['sku_diskon_global_rp']), 0, ',', '.') ?></span>
                                    </td>
                                    <!-- <td class="text-center">
                                        <input <?= $SOHeader[0]['tipe_ppn'] == 'ppn_global' ? 'checked disabled' : (round($item['sku_ppn_rp']) != '0' ? 'checked' : '') ?> onchange="chgPPNPercent(this.checked, '<?= $i ?>', '<?= round($item['client_wms_tax']) ?>')" style="transform: scale(1.5)" type="checkbox" id="checkbox-item-<?= $i ?>-BackOrderDetail-ppn" value="" />
                                    </td> -->
                                    <td class="text-center">
                                        <span id="caption-<?= $i ?>-BackOrderDetail-sku_disc_global_rupiah"><?= round($item['sku_ppn_percent']) ?></span>
                                        <!-- <input onchange="chgPPNRP(this.value, '<?= $i ?>')" disabled type="text" id="input-item-<?= $i ?>-BackOrderDetail-ppn_percent" class="form-control numericInput" value="<?= $item['sku_ppn_percent'] != '0' ? round($item['sku_ppn_percent']) : '0' ?>" /> -->
                                    </td>
                                    <td class="text-center">
                                        <span id="caption-<?= $i ?>-BackOrderDetail-ppn_rp"><?= $item['sku_ppn_rp'] != '0' ? number_format(round($item['sku_ppn_rp']), 0, ',', '.') : '0' ?></span>
                                    </td>
                                    <!-- <td class="text-center">
                                        <button class="btn btn-success btn-small btn-get-ed-sku" style="<?= $header['tipe_back_order_id'] != 'AD89E05B-46A6-453B-8F19-886514234A21' ? 'display:none' : '' ?>" onclick="GetEDSKU('<?= $item['sku_id'] ?>','<?= $i ?>','detail','<?= $item['principle_id'] ?>')"><i class="fa fa-plus"></i></button>
                                    </td> -->
                                    <td class="text-center" style="width:10%;"><?= $item['sku_keterangan'] ?></td>
                                    <td class="text-center" style="width:10%;">
                                        <button type="button" style="border:none;background:transparent" onclick="ScheduleSKU(this,'<?= $i ?>','<?= $item['sku_id'] ?>','<?= $item['sku_kode'] ?>','<?= $item['sku_nama_produk'] ?>','<?= $item['sku_satuan'] ?>','<?= $item['sku_kemasan'] ?>','<?= $item['principle'] ?>','<?= $item['brand'] ?>')"><i class="fas fa-plus text-primary" style="cursor: pointer"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- <div style="float: right">
                    <a href="<?= base_url('FAS/BackOrder/BackOrderMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
                </div> -->
            </div>
        </div>
        <div class="row" id="panel-detail">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                    <div class="x_title">
                        <!-- <h4 class="pull-left" name="CAPTION-BARANGYANGDIKIRIM">Barang Yang Dikirim</h4> -->
                        <div class="pull-right">
                            <!-- <button id="btnAvaibilityCheckProcess" class="btn btn-warning"><b>Avaibility Check Process</b></button> -->
                            <!-- <button data-toggle="modal" data-target="#modal-sku" id="btn-choose-prod-delivery" class="btn btn-success" type="button"><i class="fa fa-search"></i> <span name="CAPTION-CHOOSE" style="color:white;">Pilih</span></button> -->
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php foreach ($SOHeader as $key => $value) : ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <label name="CAPTION-TOTALDISKONITEM">Total Diskon Item</label> <span>Rp</span>
                                <input disabled type="text" id="total_diskon_item" class="form-control" name="total_diskon_item" autocomplete="off" value="<?= number_format(round($value['total_diskon_item']), 0, ',', '.') ?>">
                            </div>
                            <div class="col-xs-12" style="margin-top: 10px;">
                                <label name="CAPTION-Total">Total</label> <span>Rp</span>
                                <input disabled type="text" id="total_rp" class="form-control" name="total_rp" autocomplete="off" value="<?= number_format(round($value['total']), 0, ',', '.') ?>">
                            </div>
                            <div class="col-xs-6" style="margin-top: 10px;">
                                <label name="CAPTION-DISKONGLOBAL">Diskon Global</label>%
                                <input disabled onchange="chgDiskonGlobal(this.value, 'percent')" type="text" id="diskon_global_percent" class="form-control" name="diskon_global_percent" autocomplete="off" value="<?= round($value['diskon_global_percent']) ?>">
                            </div>
                            <div class="col-xs-6" style="margin-top: 10px;">
                                <label>Rp</label>
                                <input disabled onchange="chgDiskonGlobal(this.value, 'rupiah')" type="text" id="diskon_global_rp" class="form-control" name="diskon_global_rp" autocomplete="off" value="<?= number_format(round($value['diskon_global_rp']), 0, ',', '.') ?>">
                            </div>
                            <div class="col-xs-12" style="margin-top: 10px;">
                                <label name="CAPTION-DASARKENAPAJAK">Dasar Kena Pajak</label>
                                <input disabled type="text" id="dasar_kena_pajak" class="form-control" name="dasar_kena_pajak" autocomplete="off" value="<?= number_format(round($value['dasar_kena_pajak']), 0, ',', '.') ?>">
                            </div>
                            <div class="col-xs-6" style="margin-top: 10px;">
                                <!-- <input onchange="chgPPNGlobal(this.checked, this.value)" style="transform: scale(1);" type="checkbox" name="checkbox_ppn_global" id="checkbox_ppn_global" value="<?= round($value['client_wms_tax']) ?>"> -->
                                <label style="margin-left: 5px;" name="CAPTION-PPN">PPN</label>%
                                <input disabled type="text" id="ppn_global_percent" class="form-control" name="ppn_global_percent" autocomplete="off" value="<?= round($value['ppn_global_percent']) ?>">
                            </div>
                            <div class="col-xs-6" style="margin-top: 10px;">
                                <label>Rp</label>
                                <input disabled type="text" id="ppn_global_rp" class="form-control" name="ppn_global_rp" autocomplete="off" value="<?= number_format(round($value['ppn_global_rp']), 0, ',', '.') ?>">
                            </div>
                            <div class="col-xs-12" style="margin-top: 10px;">
                                <label name="CAPTION-ADJUSMENT">Adjustment</label>
                                <input disabled onchange="triggerDetail()" type="number" id="adjustment" class="form-control" name="adjustment" autocomplete="off" value="<?= number_format(round($value['adjustment']), 0, ',', '.') ?>">
                            </div>
                            <div class="col-xs-12" style="margin-top: 10px;">
                                <label name="CAPTION-TOTALFAKTUR">Total Faktur</label>
                                <input disabled type="text" id="total_faktur" class="form-control" name="total_faktur" autocomplete="off" value="<?= number_format(round($value['total_faktur']), 0, ',', '.') ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- <div style="float: right">
                    <a href="<?= base_url('FAS/backorder/backorderMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
                    <button class="btn-submit btn btn-success" id="btnsaveso"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span></button>
                </div> -->
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                    <div class="x_title">
                        <!-- <h4 class="pull-left" name="CAPTION-BARANGYANGDIKIRIM">Barang Yang Dikirim</h4> -->
                        <div class="pull-right">
                            <!-- <button id="btnAvaibilityCheckProcess" class="btn btn-warning"><b>Avaibility Check Process</b></button> -->
                            <!-- <button data-toggle="modal" data-target="#modal-sku" id="btn-choose-prod-delivery" class="btn btn-success" type="button"><i class="fa fa-search"></i> <span name="CAPTION-CHOOSE" style="color:white;">Pilih</span></button> -->
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <label name="CAPTION-KETERANGAN">Keterangan</label>
                        <textarea disabled rows="6" class="form-control" name="keterangan_detail" id="keterangan_detail"><?= $SOHeader[0]['keterangan'] ?></textarea>
                    </div>
                </div>
                <div style="float: right">
                    <a href="<?= base_url('FAS/BackOrder/BackOrderMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ed-sku" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-CARISKU">Cari SKU</label></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3">
                                <label name="CAPTION-SKUKODE">Kode SKU</label>
                                <input type="text" id="caption-ed-sku-kode" name="caption_ed_sku" class="form-control input-sm" disabled />
                                <input type="hidden" id="caption-ed-sku-id" name="caption_ed_sku_id" class="form-control input-sm" disabled />
                                <input type="hidden" id="caption-ed-sku-index" name="caption_ed_sku_index" value="0" />
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-SKU">SKU</label>
                                <input type="text" id="caption-ed-sku" name="caption_ed_sku" class="form-control input-sm" disabled />
                            </div>
                            <div class="col-xs-2">
                                <label name="CAPTION-SKUKEMASAN">Kemasan</label>
                                <input type="text" id="caption-ed-sku-kemasan" name="caption_ed_sku_kemasan" class="form-control input-sm" disabled />
                            </div>
                            <div class="col-xs-2">
                                <label name="CAPTION-SKUSATUAN">Satuan</label>
                                <input type="text" id="caption-ed-sku-satuan" name="caption_ed_sku_satuan" class="form-control input-sm" disabled />
                            </div>
                            <div class="col-xs-2">
                                <label name="CAPTION-TOTALQTY">Total QTY</label>
                                <input type="text" id="caption-sku-qty" name="caption_sku_qty" class="form-control input-sm" disabled />
                                <input type="hidden" id="caption-ed-sku-harga" name="caption_ed_sku_harga" value="0" />
                            </div>
                        </div>
                    </div>
                </div><br><br>
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped" id="table-ed-sku">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center" style="color:white;">No</th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-AREA">Area</span>
                                    </th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SKUREQEXPDATE">Tgl
                                            Kadaluwarsa SKU</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-JMLSKUSTOCKTERAKHIR">Stock Akhir</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-QTYAMBIL">QTY
                                            Ambil</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingedsku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <!-- <button type="button" class="btn btn-info" id="btn-choose-ed-sku-multi"><span name="CAPTION-CHOOSE">Pilih</span></button> -->
                <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-ed-sku-retur" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-CARISKU">Cari SKU</label></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label name="CAPTION-SKUKODE">Kode SKU</label>
                                        <input type="text" id="caption-ed-sku-kode-retur" name="caption_ed_sku_retur" class="form-control input-sm" disabled />
                                        <input type="hidden" id="caption-ed-sku-id-retur" name="caption_ed_sku_id_retur" class="form-control input-sm" disabled />
                                        <input type="hidden" id="caption-ed-sku-index-retur" name="caption_ed_sku_index_retur" value="0" />
                                    </div>
                                    <div class="col-xs-6">
                                        <label name="CAPTION-SKU">SKU</label>
                                        <input type="text" id="caption-ed-sku-retur" name="caption_ed_sku_retur" class="form-control input-sm" disabled />
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKUKEMASAN">Kemasan</label>
                                        <input type="text" id="caption-ed-sku-kemasan-retur" name="caption_ed_sku_kemasan_retur" class="form-control input-sm" disabled />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKUSATUAN">Satuan</label>
                                        <input type="text" id="caption-ed-sku-satuan-retur" name="caption_ed_sku_satuan_retur" class="form-control input-sm" disabled />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-TOTALQTY">Total QTY</label>
                                        <input type="text" id="caption-sku-qty-retur" name="caption_sku_qty_retur" class="form-control input-sm" disabled />
                                        <input type="hidden" id="caption-ed-sku-harga-retur" name="caption_ed_sku_harga_retur" value="0" />
                                        <input type="hidden" id="total_so_detail2_qty" name="total_so_detail2_qty" value="0" />
                                    </div>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="col-xs-12">
                                <table class="table table-striped" id="table-ed-sku-retur">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th class="text-center" style="color:white;">No</th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-NODO">No DO</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-GUDANGBARANG">Gudang</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-SKUREQEXPDATE">Tgl Kadaluwarsa SKU</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-QTYAMBIL">QTY Ambil</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingedskuretur" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <!-- <button type="button" class="btn btn-info" id="btn-choose-ed-sku-multi-retur"><i class="fa fa-save"></i> <span name="CAPTION-CHOOSE">Pilih</span></button> -->
                <button type="button" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> <span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_list_data_pilih_jadwal_sku" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:90%">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4><span name="CAPTION-JADWALREQUEST">Jadwal Request</span></h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label name="CAPTION-KODESKU">Kode SKU</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <label id="filter_schedule_sku_kode"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label name="CAPTION-SKU">SKU</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <label id="filter_schedule_sku_nama_produk"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label name="CAPTION-SKUSATUAN">SKU Satuan</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <label id="filter_schedule_sku_satuan"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label name="CAPTION-SKUKEMASAN">SKU Kemasan</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <label id="filter_schedule_sku_kemasan"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group field-SimulasiMpsTemp2-tahun">
                                    <label for="ProductionShedule-client_wms_id" class="control-label" name="CAPTION-TAHUN">Tahun</label>
                                    <input type="text" class="form-control" id="filter_schedule_tahun" name="filter_schedule_tahun" value="<?= date('Y') ?>" disabled>
                                    <input type="hidden" class="form-control" id="filter_schedule_sku_id" name="filter_schedule_sku_id" value="">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group field-SimulasiMpsTemp2-qty">
                                    <label class="control-label" for="SimulasiMpsTemp2-qty" name="CAPTION-QTY">Qty</label>
                                    <input type="text" id="filter_schedule_sku_qty" class="form-control" name="filter_schedule_sku_qty" autocomplete="off" value="0" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="container mt-2">
                            <div class="row">
                                <div class="x_content table-responsive">
                                    <table id="table_list_data_pilih_jadwal" width="100%" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;">#</th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;width:45%;" name="CAPTION-BULAN">Bulan</th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;width:45%;" name="CAPTION-JUMLAHBARANG">Jumlah Barang</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn_close_list_data_pilih_sku" data-dismiss="modal"><i class="fas fa-xmark"></i> <span name="CAPTION-TUTUP">Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<script>

</script>