<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span name="CAPTION-BUAT">Buat</span> Sales Order</h3>
            </div>
            <div style="float: right">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_order_kode">
                                    <label class="control-label" for="salesorder-sales_order_kode" name="CAPTION-NOSO">No SO</label>
                                    <input readonly="readonly" type="text" id="salesorder-sales_order_kode" class="form-control" name="salesorder[sales_order_kode]" autocomplete="off" value="">
                                    <input type="hidden" id="cek_sku" value="0">
                                    <input type="hidden" id="cek_customer" value="0">
                                    <input type="hidden" id="so_id" value="<?= $so_id ?>">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <label for="salesorder-sales_order_no_reff" class="control-label" name="CAPTION-SALESORDERDROPSHIPPER">Sales Order Dropshipper</label>
                                <select id="salesorder-sales_order_no_reff" class="form-control select2" name="CAPTION-SALES" onChange="GetDataSalesOrderDropshipper(this.value)">
                                    <option value="">** <label name="CAPTION-PILIH">Pilih</label> **</option>
                                    <?php foreach ($SODropshipper as $row) : ?>
                                        <option value="<?= $row['sales_order_id'] ?>"><?= $row['sales_order_kode'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_order_no_po">
                                    <label class="control-label" for="salesorder-sales_order_no_po" name="CAPTION-NOPO">No PO</label>
                                    <input type="text" class="form-control" id="salesorder-sales_order_no_po" name="salesorder[sales_order_no_po]" value="">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_order_tgl">
                                    <label class="control-label" for="salesorder-sales_order_tgl" name="CAPTION-TGLSO">Tanggal SO</label>
                                    <input type="text" id="salesorder-sales_order_tgl" class="form-control datepicker" name="salesorder[sales_order_tgl]" autocomplete="off" value="<?= set_value('salesorder[sales_order_tgl_buat_do]') != "" ? set_value('salesorder[sales_order_tgl_buat_do]') : (isset($salesorder['sales_order_tgl_buat_do']) ? date('d-m-Y', strtotime($salesorder['sales_order_tgl_buat_do'])) : date('d-m-Y')) ?>">
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_order_tgl_exp">
                                    <label class="control-label" for="salesorder-sales_order_tgl_exp" name="CAPTION-TGLEXP">Tanggal Expired</label>
                                    <input type="text" id="salesorder-sales_order_tgl_exp" class="form-control datepicker" name="salesorder[sales_order_tgl_exp]" autocomplete="off" value="<?= set_value('salesorder[sales_order_tgl_expired_do]') != "" ? set_value('salesorder[sales_order_tgl_expired_do]') : (isset($salesorder['sales_order_tgl_expired_do']) ? date('d-m-Y', strtotime($salesorder['sales_order_tgl_expired_do'])) : date('d-m-Y')) ?>">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_order_tgl_harga">
                                    <label class="control-label" for="salesorder-sales_order_tgl_harga" name="CAPTION-TGLHARGA">Tanggal Harga</label>
                                    <input type="text" id="salesorder-sales_order_tgl_harga" class="form-control datepicker" name="salesorder[sales_order_tgl_harga]" autocomplete="off" value="<?= set_value('salesorder[sales_order_tgl_buat_do]') != "" ? set_value('salesorder[sales_order_tgl_buat_do]') : (isset($salesorder['sales_order_tgl_buat_do']) ? date('d-m-Y', strtotime($salesorder['sales_order_tgl_buat_do'])) : date('d-m-Y')) ?>">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_order_tgl_sj">
                                    <label class="control-label" for="salesorder-sales_order_tgl_sj" name="CAPTION-TGLSJ">Tanggal Surat Jalan</label>
                                    <input type="text" id="salesorder-sales_order_tgl_sj" class="form-control datepicker" name="salesorder[sales_order_tgl_sj]" autocomplete="off" value="<?= set_value('salesorder[sales_order_tgl_sj]') != "" ? set_value('salesorder[sales_order_tgl_sj]') : (isset($salesorder['sales_order_tgl_sj']) ? date('d-m-Y', strtotime($salesorder['sales_order_tgl_sj'])) : "") ?>">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_order_tgl_kirim">
                                    <label class="control-label" for="salesorder-sales_order_tgl_kirim" name="CAPTION-TGLKIRIM">Tanggal Kirim</label>
                                    <input type="text" id="salesorder-sales_order_tgl_kirim" class="form-control datepicker" name="salesorder[sales_order_tgl_kirim]" autocomplete="off" value="<?= set_value('salesorder[sales_order_tgl_rencana_kirim]') != "" ? set_value('salesorder[sales_order_tgl_rencana_kirim]') : (isset($salesorder['sales_order_tgl_rencana_kirim']) ? date('d-m-Y', strtotime($salesorder['sales_order_tgl_rencana_kirim'])) : "") ?>">
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-3">
                                <label name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                <select id="salesorder-client_wms_id" name="salesorder[client_wms_id]" class="form-control select2" style="width:100%;">
                                    <option value=""><label name="CAPTION-PILIH">Pilih</label></option>
                                    <?php foreach ($Perusahaan as $type) : ?>
                                        <option value="<?= $type['client_wms_id'] ?>"><?= $type['client_wms_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-PRINCIPLE">Principle</label>
                                <select id="salesorder-principle_id" name="salesorder[principle_id]" class="form-control select2" style="width:100%;">
                                    <option value=""><label name="CAPTION-PILIH">Pilih</label></option>
                                    <?php foreach ($Principle as $type) : ?>
                                        <option value="<?= $type['principle_id'] ?>"><?= $type['principle_kode'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_id">
                                    <label for="salesorder-sales_id" class="control-label" name="CAPTION-SALES">Sales</label>
                                    <select id="salesorder-sales_id" class="form-control select2" name="CAPTION-SALES" onChange="GetPerusahaanBySales(this.value)">
                                        <option value="">** <label name="CAPTION-SALES">Sales</label> **</option>
                                        <?php foreach ($Sales as $row) : ?>
                                            <option value="<?= $row['karyawan_id'] ?>"><?= $row['karyawan_nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-tipe_sales_order_id">
                                    <label class="control-label" for="salesorder-tipe_sales_order_id" name="CAPTION-TIPESO">Tipe SO</label>
                                    <select name="salesorder[tipe_sales_order_id]" class="form-control select2" id="salesorder-tipe_sales_order_id" disabled>
                                        <option value="">** <label name="CAPTION-TIPESO">Tipe SO</label> **</option>
                                        <?php foreach ($TipeSalesOrder as $type) : ?>
                                            <option value="<?= $type['tipe_sales_order_id'] ?>" <?= $type['tipe_sales_order_id'] == 'D5A2AB04-0236-424D-859C-1888B46D6F50' ? 'selected' : '' ?>>
                                                <?= $type['tipe_sales_order_nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-tipe_delivery_order_id">
                                    <label class="control-label" for="salesorder-tipe_delivery_order_id" name="CAPTION-TIPEDO">Tipe DO</label>
                                    <select name="salesorder[tipe_delivery_order_id]" class="form-control select2" id="salesorder-tipe_delivery_order_id">
                                        <option value="">** <label name="CAPTION-TIPEDO">Tipe DO</label> **</option>
                                        <?php foreach ($TipeDeliveryOrder as $type) : ?>
                                            <option value="<?= $type['tipe_delivery_order_id'] ?>">
                                                <?= $type['tipe_delivery_order_nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_order_status">
                                    <label class="control-label" for="salesorder-sales_order_status" name="CAPTION-STATUS">Status</label>
                                    <input readonly="readonly" type="text" id="salesorder-sales_order_status" class="form-control" name="salesorder[sales_order_status]" autocomplete="off" value="Draft">
                                </div>
                                <div class="form-group field-salesorder-so_is_need_approval">
                                    <input type="checkbox" id="salesorder-so_is_need_approval" name="salesorder[so_is_need_approval]" autocomplete="off" value="1"> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_order_who_create">
                                    <label class="control-label" for="salesorder-sales_order_approved_by" name="CAPTION-DISETUJUI">Disetujui</label>
                                    <input readonly="readonly" type="text" id="salesorder-sales_order_approved_by" class="form-control" name="salesorder[sales_order_approved_by]" autocomplete="off" value="">
                                </div>
                                <div class="form-group field-salesorder-sales_order_is_handheld">
                                    <input type="checkbox" id="salesorder-sales_order_is_handheld" name="salesorder[sales_order_is_handheld]" autocomplete="off" disabled> <span name="CAPTION-UPLOADHH">Upload dari handheld</span>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_order_tipe_pembayaran">
                                    <label for="salesorder-sales_order_tipe_pembayaran" class="control-label" name="CAPTION-TIPEPEMBAYARAN">Tipe Pembayaran</label>
                                    <fieldset>
                                        <label>
                                            <input class="radio-payment-type" type="radio" name="salesorder[sales_order_tipe_pembayaran]" id="salesorder-sales_order_tipe_pembayaran" value="0" onclick="reset_table_sku()" checked> <span name="CAPTION-TUNAI">Tunai</span>
                                        </label>
                                    </fieldset>
                                    <fieldset>
                                        <label>
                                            <input class="radio-payment-type" type="radio" name="salesorder[sales_order_tipe_pembayaran]" id="salesorder-sales_order_tipe_pembayaran" value="1" onclick="reset_table_sku()"> <span name="CAPTION-NONTUNAI">Non Tunai</span>
                                        </label>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group field-salesorder-sales_order_tipe_ppn">
                                    <label for="salesorder-sales_order_tipe_ppn" class="control-label" name="CAPTION-TIPEPPN">Tipe PPN</label>
                                    <fieldset>
                                        <label>
                                            <input onclick="chgTipePPN(this.value)" class="radio-payment-type" type="radio" name="salesorder[sales_order_tipe_ppn]" id="salesorder-sales_order_tipe_ppn" value="0" checked> <span name="CAPTION-PPNGLOBAL">PPN Global</span>
                                        </label>
                                    </fieldset>
                                    <fieldset>
                                        <label>
                                            <input onclick="chgTipePPN(this.value)" class="radio-payment-type" type="radio" name="salesorder[sales_order_tipe_ppn]" id="salesorder-sales_order_tipe_ppn" value="1"> <span name="CAPTION-PPNDETAIL">PPN Detail</span>
                                        </label>
                                    </fieldset>
                                </div>
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
                        <div class="pull-right"><button data-toggle="modal" data-target="#modal-customer" id="btn-choose-customer" class="btn btn-success" type="button"><i class="fa fa-search"></i> <span name="CAPTION-CHOOSE" style="color:white;">Pilih</span></button></div>
                        <div class="clearfix"></div>
                    </div>
                    <input type="hidden" name="salesorder[client_pt_id]" id="salesorder-client_pt_id" value="" />
                    <input type="hidden" name="salesorder[sales_order_kirim_nama]" id="salesorder-sales_order_kirim_nama" value="" />
                    <input type="hidden" name="salesorder[sales_order_kirim_alamat]" id="salesorder-sales_order_kirim_alamat" value="" />
                    <input type="hidden" name="salesorder[sales_order_kirim_provinsi]" id="salesorder-sales_order_kirim_provinsi" value="" />
                    <input type="hidden" name="salesorder[sales_order_kirim_kota]" id="salesorder-sales_order_kirim_kota" value="" />
                    <input type="hidden" name="salesorder[sales_order_kirim_kecamatan]" id="salesorder-sales_order_kirim_kecamatan" value="" />
                    <input type="hidden" name="salesorder[sales_order_kirim_kelurahan]" id="salesorder-sales_order_kirim_kelurahan" value="" />
                    <input type="hidden" name="salesorder[sales_order_kirim_kodepos]" id="salesorder-sales_order_kirim_kodepos" value="" />
                    <input type="hidden" name="salesorder[sales_order_kirim_area]" id="salesorder-sales_order_kirim_area" value="" />
                    <input type="hidden" name="salesorder[sales_order_kirim_telepon]" id="salesorder-sales_order_kirim_telepon" value="" />
                    <div style="text-align: center; display: none;" class="spinner"><img style="width: 30px;" src="<?= base_url() ?>/assets/images/spinner.gif" alt=""></div>
                    <div class="customer-info">
                        <div class="row">
                            <div class="col-xs-4">
                                <label name="CAPTION-CUSTNAME">Nama:</label>
                                <div class="customer-name"></div>
                            </div>
                            <div class="col-xs-4">
                                <label name="CAPTION-CUSTADDRESS">Alamat:</label>
                                <div class="customer-address"></div>
                            </div>
                            <div class="col-xs-4">
                                <label name="CAPTION-CUSTAREA">Area:</label>
                                <div class="customer-area"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="panel-sku">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4 class="pull-left" name="CAPTION-BARANGYANGDIKIRIM">Barang Yang Dikirim</h4>
                        <!-- <button id="btnAvaibilityCheckProcess" class="btn btn-warning"><b>Avaibility Check Process</b></button> -->
                        <div class="pull-right"><button data-toggle="modal" data-target="#modal-sku" id="btn-choose-prod-delivery" class="btn btn-success" type="button"><i class="fa fa-search"></i> <span name="CAPTION-CHOOSE" style="color:white;">Pilih</span></button></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-wrapperr" style="width:100%;overflow: scroll;">
                        <table class="table table-striped" id="table-sku-delivery-only" style="width: 1200px;">
                            <thead>
                                <tr class="bg-primary">
                                    <!-- <th class="text-center" style="color:white;"><span name="CAPTION-PERUSAHAAN">Perusahaan</span></th> -->
                                    <th class="text-center" style="display:none;"></th>
                                    <!-- <th class="text-center" style="color:white;"><span name="CAPTION-PRINCIPLE">Principle</span></th> -->
                                    <th class="text-center" style="color:white;"><span name="CAPTION-BRAND">Brand</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SKUKODE">SKUKode</span></th>
                                    <th class="text-center" style="display:none;"></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SKU">SKU</span></th>
                                    <!-- <th class="text-center" style="color:white;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th> -->
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-TIPE">Tipe</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-HARGA">Harga</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SKUQTY">Qty</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SKUQTYSISA">Qty Sisa</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-DISKONITEM">Diskon Item(%)</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-DISKONRUPIAH">Diskon Item(Rp)</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SUBJUMLAH">Sub Jumlah</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-DISKONGLOBAL">Diskon Global(%)</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-DISKONGLOBALRUPIAH">Diskon Global(Rp)</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-PPN">PPN</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-PPN">PPN (%)</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-PPNRUPIAH">PPN (Rp)</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-ED">ED Product</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
                                    <!-- <th class="text-center" style="color:white;"><span name="CAPTION-TIPESTOK">Tipe Stok</span></th> -->
                                    <!-- <th class="text-center" style="color:white;"><span name="CAPTION-AVAILCHECKSTATUS">Avail. Check Status</span></th> -->
                                    <th class="text-center" style="color:white;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                    <div class="row">
                        <div class="col-xs-12">
                            <label name="CAPTION-TOTALDISKONITEM">Total Diskon Item</label> <span>Rp</span>
                            <input disabled type="text" id="total_diskon_item" class="form-control mask-money text-right" name="total_diskon_item" autocomplete="off" value="0">
                        </div>
                        <div class="col-xs-12" style="margin-top: 10px;">
                            <label name="CAPTION-Total">Total</label> <span>Rp</span>
                            <input disabled type="text" id="total_rp" class="form-control mask-money text-right" name="total_rp" autocomplete="off" value="0">
                        </div>
                        <div class="col-xs-6" style="margin-top: 10px;">
                            <label name="CAPTION-DISKONGLOBAL">Diskon Global</label>%
                            <input onchange="chgDiskonGlobal(this.value, 'percent')" type="text" id="diskon_global_percent" class="form-control mask-money text-right" name="diskon_global_percent" autocomplete="off" value="0">
                        </div>
                        <div class="col-xs-6" style="margin-top: 10px;">
                            <label>Rp</label>
                            <input onchange="chgDiskonGlobal(this.value, 'rupiah')" type="text" id="diskon_global_rp" class="form-control mask-money text-right" name="diskon_global_rp" autocomplete="off" value="0">
                        </div>
                        <div class="col-xs-12" style="margin-top: 10px;">
                            <label name="CAPTION-DASARKENAPAJAK">Dasar Kena Pajak</label>
                            <input disabled type="text" id="dasar_kena_pajak" class="form-control mask-money text-right" name="dasar_kena_pajak" autocomplete="off" value="0">
                        </div>
                        <div class="col-xs-6" style="margin-top: 10px;">
                            <!-- <input checked disabled onchange="chgPPNGlobal(this.checked, this.value)" style="transform: scale(1);" type="checkbox" name="checkbox_ppn_global" id="checkbox_ppn_global" value=""> -->
                            <label style="margin-left: 5px;" name="CAPTION-PPN">PPN</label>%
                            <input disabled type="text" id="ppn_global_percent" class="form-control mask-money text-right" name="ppn_global_percent" autocomplete="off" value="0">
                        </div>
                        <div class="col-xs-6" style="margin-top: 10px;">
                            <label>Rp</label>
                            <input disabled type="text" id="ppn_global_rp" class="form-control mask-money text-right" name="ppn_global_rp" autocomplete="off" value="0">
                        </div>
                        <div class="col-xs-12" style="margin-top: 10px;">
                            <label name="CAPTION-ADJUSMENT">Adjustment</label>
                            <input onchange="triggerDetail()" type="text" id="adjustment" class="form-control mask-money text-right" name="adjustment" autocomplete="off" value="0">
                        </div>
                        <div class="col-xs-12" style="margin-top: 10px;">
                            <label name="CAPTION-TOTALFAKTUR">Total Faktur</label>
                            <input disabled type="text" id="total_faktur" class="form-control mask-money text-right" name="total_faktur" autocomplete="off" value="0">
                        </div>
                    </div>
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
                        <textarea rows="6" class="form-control" name="keterangan_detail" id="keterangan_detail"></textarea>
                    </div>
                </div>
                <div style="float: right">
                    <a href="<?= base_url('FAS/SalesOrderDropshipper/SalesOrderDropshipperMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
                    <button class="btn-submit btn btn-success" id="btnsaveso"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-customer" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-CARICUST">Cari Customer</label></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <!-- <div class="col-xs-4">
                                        <label name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                        <select id="filter-perusahaan-customer" name="filter_perusahaan_customer" class="form-control input-sm select2" style="width:100%;">
                                            <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                                            <?php foreach ($Perusahaan as $type) : ?>
                                                <option value="<?= $type['client_wms_id'] ?>"><?= $type['client_wms_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> -->
                                    <div class="col-xs-4">
                                        <label name="CAPTION-CUSTAREA">Area</label>
                                        <select id="filter-area" name="filter_area" class="form-control input-sm select2" style="width:100%;">
                                            <option value=""><label name="CAPTION-PILIH">Pilih</label></option>
                                            <?php foreach ($Area as $area) : ?>
                                                <option value="<?= $area['area_id'] ?>"><?= $area['area_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-CUSTNAME">Nama</label>
                                        <input type="text" id="filter-client-name" name="filter_client_name" class="form-control input-sm" style="height:40px;" />
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-xs-4">
                                        <label name="CAPTION-CUSTADDRESS">Alamat</label>
                                        <input type="text" id="filter-client-address" name="filter_client_address" class="form-control input-sm" style="height:40px;" />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-CUSTPHONE">Telepon</label>
                                        <input type="text" id="filter-client-phone" name="filter_client_phone" class="form-control input-sm" style="height:40px;" />
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-xs-4">
                                        <span id="loadingcustomer" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                        <button type="button" id="btn-search-customer" class="btn btn-success"><i class="fa fa-search"></i> <span name="CAPTION-SEARCH">Cari</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="col-xs-12">
                                <table class="table table-striped" style="width: 100%;" id="table-customer">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th class="text-center" style="color:white;"><span name="CAPTION-CUSTNAME">Nama</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-CUSTADDRESS">Alamat</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-CUSTPHONE">Telepon</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-CUSTAREA">Area</span></th>
                                            <th class="text-center" style="color:white;">Action</th>
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
                <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-sku" role="dialog" data-keyboard="false" data-backdrop="static">
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
                                    <!-- <div class="col-xs-4">
                                        <label name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                        <select id="filter-perusahaan-sku" name="filter_perusahaan_sku" class="form-control input-sm select2" style="width:100%;">
                                            <option value="">Semua</option>
                                            <?php foreach ($Perusahaan as $type) : ?>
                                                <option value="<?= $type['client_wms_id'] ?>"><?= $type['client_wms_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> -->
                                    <!-- <div class="col-xs-4">
                                        <label name="CAPTION-PRINCIPLE">Principle</label>
                                        <select id="filter-principle" name="filter_principle" class="form-control input-sm select2" style="width:100%;">
                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                            <?php foreach ($Principle as $row) : ?>
                                                <option value="<?= $row['principle_kode'] ?>"><?= $row['principle_kode'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> -->
                                    <div class="col-xs-4">
                                        <label name="CAPTION-BRAND">Brand</label>
                                        <input type="text" id="filter-brand" name="filter_brand" class="form-control input-sm" style="height:40px;" />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKUINDUK">SKU Induk</label>
                                        <input type="text" id="filter-sku-induk" name="filter_sku_induk" class="form-control input-sm" style="height:40px;" />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKU">SKU</label>
                                        <input type="text" id="filter-sku-nama-produk" name="filter_sku_nama_produk" class="form-control input-sm" style="height:40px;" />
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKUKEMASAN">Kemasan</label>
                                        <input type="text" id="filter-sku-kemasan" name="filter_sku_kemasan" class="form-control input-sm" style="height:40px;" />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKUSATUAN">Satuan</label>
                                        <input type="text" id="filter-sku-satuan" name="filter_sku_satuan" class="form-control input-sm" style="height:40px;" />
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-xs-3">
                                        <span id="loadingsku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                        <button type="button" id="btn-search-sku" class="btn btn-success"><i class="fa fa-search"></i> <span name="CAPTION-SEARCH">Cari</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="col-xs-12">
                                <table class="table table-striped" id="table-sku">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th class="text-center" style="color:white;"><input type="checkbox" name="select-sku" id="select-sku" value="1"></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-PERUSAHAAN">Perusahaan</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-SKUKODE">SKU
                                                    Kode</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-SKUINDUK">Sku
                                                    Induk</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-SKU">SKU</span>
                                            </th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-PRINCIPLE">Principle</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-BRAND">Brand</span>
                                            </th>
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
                <button type="button" data-dismiss="modal" class="btn btn-info btn-choose-sku-multi"><span name="CAPTION-CHOOSE">Pilih</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
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
                                <input type="text" id="caption-ed-sku-kode" name="caption_ed_sku" class="form-control input-sm" readonly />
                                <input type="hidden" id="caption-ed-sku-id" name="caption_ed_sku_id" class="form-control input-sm" readonly />
                                <input type="hidden" id="caption-ed-sku-index" name="caption_ed_sku_index" value="0" />
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-SKU">SKU</label>
                                <input type="text" id="caption-ed-sku" name="caption_ed_sku" class="form-control input-sm" readonly />
                            </div>
                            <div class="col-xs-2">
                                <label name="CAPTION-SKUKEMASAN">Kemasan</label>
                                <input type="text" id="caption-ed-sku-kemasan" name="caption_ed_sku_kemasan" class="form-control input-sm" readonly />
                            </div>
                            <div class="col-xs-2">
                                <label name="CAPTION-SKUSATUAN">Satuan</label>
                                <input type="text" id="caption-ed-sku-satuan" name="caption_ed_sku_satuan" class="form-control input-sm" readonly />
                            </div>
                            <div class="col-xs-2">
                                <label name="CAPTION-TOTALQTY">Total QTY</label>
                                <input type="text" id="caption-sku-qty" name="caption_sku_qty" class="form-control input-sm" readonly />
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
                <button type="button" class="btn btn-info" id="btn-choose-ed-sku-multi"><span name="CAPTION-CHOOSE">Pilih</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-stock-avaibility-check" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-STOCKAVAIBILITYCHECK">Stock Avaibility Check</label> (<span id="sku_nama_produk"></span>)</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-1">
                                        <label style="float:right" name="CAPTION-TAMPILAN">Tampilan</label>
                                    </div>
                                    <div class="col-xs-2">
                                        <select class="form-control" style="width: 100%;" name="filterTampilan" id="filterTampilan">
                                            <option value="bulan">Bulan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="col-xs-12">
                                    <table class="table table-striped" id="table-stock-availability-check">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="text-center" style="color:white;"><span name="CAPTION-INFORMASI">Informasi</span></th>
                                                <th class="text-center" style="color:white;">0</th>
                                                <th class="text-center" style="color:white;">1</th>
                                                <th class="text-center" style="color:white;">2</th>
                                                <th class="text-center" style="color:white;">3</th>
                                                <th class="text-center" style="color:white;">4</th>
                                                <th class="text-center" style="color:white;">5</th>
                                                <th class="text-center" style="color:white;">6</th>
                                                <th class="text-center" style="color:white;">7</th>
                                                <th class="text-center" style="color:white;">8</th>
                                                <th class="text-center" style="color:white;">9</th>
                                                <th class="text-center" style="color:white;">10</th>
                                                <th class="text-center" style="color:white;">11</th>
                                                <th class="text-center" style="color:white;">12</th>
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
                    <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
                </div>
            </div>
        </div>
    </div>
</div>