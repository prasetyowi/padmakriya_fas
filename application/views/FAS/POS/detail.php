<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span name="CAPTION-BUAT">Buat</span> Point Of Sales</h3>
            </div>
            <div style="float: right">

            </div>
        </div>
        <?php foreach ($SOHeader as $header) : ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group field-salesorder-sales_order_kode">
                                        <label class="control-label" for="salesorder-sales_order_kode" name="CAPTION-NOSO">No SO</label>
                                        <input readonly="readonly" type="text" id="salesorder-sales_order_kode" class="form-control" name="salesorder[sales_order_kode]" autocomplete="off" value="<?= $header['sales_order_kode'] ?>" disabled>
                                        <input type="hidden" id="cek_sku" value="0">
                                        <input type="hidden" id="cek_customer" value="0">
                                        <input type="hidden" id="so_id" value="<?= $so_id ?>">
                                        <input type="hidden" id="tgl_update" value="<?= $header['tglUpdate'] ?>">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group field-salesorder-tipe_sales_order_id">
                                        <label class="control-label" for="salesorder-tipe_sales_order_id" name="CAPTION-TIPESO">Tipe SO</label>
                                        <select name="salesorder[tipe_sales_order_id]" class="form-control select2" id="salesorder-tipe_sales_order_id" disabled>
                                            <option value="">** <label name="CAPTION-TIPESO">Tipe SO</label> **</option>
                                            <?php foreach ($TipeSalesOrder as $type) : ?>
                                                <option value="<?= $type['tipe_sales_order_id'] ?>" <?= $header['tipe_sales_order_id'] == $type['tipe_sales_order_id'] ? 'selected' : '' ?>><?= $type['tipe_sales_order_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group field-salesorder-tipe_delivery_order_id">
                                        <label class="control-label" for="salesorder-tipe_delivery_order_id" name="CAPTION-TIPEPENGIRIMAN">Tipe Pengiriman</label>
                                        <select name="salesorder[tipe_delivery_order_id]" class="form-control select2" id="salesorder-tipe_delivery_order_id" disabled>
                                            <option value="">** <label name="CAPTION-TIPEDO">Tipe DO</label> **</option>
                                            <?php foreach ($TipeDeliveryOrder as $type) : ?>
                                                <option value="<?= $type['tipe_delivery_order_id'] ?>" <?= $header['tipe_delivery_order_id'] == $type['tipe_delivery_order_id'] ? 'selected' : '' ?>><?= $type['tipe_delivery_order_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group field-salesorder-sales_order_tgl">
                                        <label class="control-label" for="salesorder-sales_order_tgl" name="CAPTION-TGLPOS">Tanggal POS</label>
                                        <input type="text" id="salesorder-sales_order_tgl" class="form-control datepicker" name="salesorder[sales_order_tgl]" autocomplete="off" value="<?= $header['sales_order_tgl'] ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <br />
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
                        <input type="hidden" name="salesorder[client_pt_id]" id="salesorder-client_pt_id" value="<?= $header['client_pt_id'] ?>" />
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
            <div class="row" id="panel-sku">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="pull-left">
                                <h4><span name="CAPTION-SKU">SKU</span></h4>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="table-wrapperr" style="width:100%;overflow: scroll;">
                            <table class="table table-bordered" id="table-sku-delivery-only" style="width: 100%;">
                                <thead>
                                    <tr class="bg-primary">
                                        <th style="color:white;text-align:center; vertical-align:middle">#</th>
                                        <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
                                        <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-SKU">SKU</span></th>
                                        <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
                                        <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
                                        <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-ED">ED Product</span>
                                        </th>
                                        <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-HARGA">Harga</span>
                                        </th>
                                        <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-SKUQTY">Qty</span></th>
                                        <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-DISKON">Diskon</span>
                                        </th>
                                        <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-SUBJUMLAH">Sub Jumlah</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="x_title">
                            <h4><span name="CAPTION-PEMBAYARAN">Pembayaran</span></h4>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="table-wrapperr" style="width:100%;">
                                    <table class="table table-bordered" id="table-so-payment" style="width: 100%;">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th style="color:white;text-align:center; vertical-align:middle">#</th>
                                                <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-TIPEPEMBAYARAN">Tipe Pembayaran</span></th>
                                                <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-NOMINALPEMBAYARAN">Nominal Pembayaran</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-horizontal form-label-left">
                                    <div class="form-group row">
                                        <label class="control-label col-md-4 col-sm-4 "><span name="CAPTION-SUBTOTAL">Sub Total</span></th></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon" style="height: 5px;">Rp. </span>
                                                <input type="text" class="form-control text-right mask-money" id="Payment-subtotal" value="0" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-4 col-sm-4 "><span name="CAPTION-DISKON">Diskon</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon" style="height: 5px;">Rp. </span>
                                                <input type="text" class="form-control text-right mask-money" id="Payment-diskon" value="0" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-4 col-sm-4 "><span name="CAPTION-TOTALAKHIR">Total Akhir</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon" style="height: 5px;">Rp. </span>
                                                <input type="text" class="form-control text-right mask-money" id="Payment-total_akhir" value="0" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-4 col-sm-4 "><span name="CAPTION-PEMBAYARAN">Pembayaran</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon" style="height: 5px;">Rp. </span>
                                                <input type="text" class="form-control text-right mask-money" id="Payment-total_bayar" value="0" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-4 col-sm-4 "><span name="CAPTION-KURANGBAYAR">Kurang Bayar</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon" style="height: 5px;">Rp. </span>
                                                <input type="text" class="form-control text-right mask-money" id="Payment-total_kurang_bayar" value="0" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-4 col-sm-4 "><span name="CAPTION-KEMBALIAN">Kembalian</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon" style="height: 5px;">Rp. </span>
                                                <input type="text" class="form-control text-right mask-money" id="Payment-total_kembalian" value="0" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="float: right">
                        <a href="<?= base_url('FAS/POS/POSMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="modal fade" id="modal-customer" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width: 90%;">
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
                                    <div class="col-xs-4">
                                        <label name="CAPTION-CUSTNAME">Nama</label>
                                        <input type="text" id="filter-client-name" name="filter_client_name" class="form-control input-sm" style="height:40px;" onchange="getCustomer()" />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-CUSTADDRESS">Alamat</label>
                                        <input type="text" id="filter-client-address" name="filter_client_address" class="form-control input-sm" style="height:40px;" onchange="getCustomer()" />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-CUSTPHONE">Telepon</label>
                                        <input type="text" id="filter-client-phone" name="filter_client_phone" class="form-control input-sm" style="height:40px;" onchange="getCustomer()" />
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
                                <table class="table table-striped" id="table-customer">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-CUSTNAME">Nama</span></th>
                                            <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-CUSTADDRESS">Alamat</span></th>
                                            <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-CUSTPHONE">Telepon</span></th>
                                            <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-CUSTAREA">Area</span></th>
                                            <th style="color:white;text-align:center; vertical-align:middle">Action</th>
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
    <div class="modal-dialog modal-lg" style="width: 90%;">
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
                                    <div class="col-xs-4">
                                        <label name="CAPTION-PRINCIPLE">Principle</label>
                                        <select id="filter-principle" name="filter_principle" class="form-control input-sm select2" style="width:100%;" onchange="initDataSKU()">
                                            <option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
                                            <?php foreach ($Principle as $row) : ?>
                                                <option value="<?= $row['principle_kode'] ?>"><?= $row['principle_kode'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKUINDUK">SKU Induk</label>
                                        <input type="text" id="filter-sku-induk" name="filter_sku_induk" class="form-control input-sm" style="height:40px;" onchange="initDataSKU()" />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKU">SKU</label>
                                        <input type="text" id="filter-sku-nama-produk" name="filter_sku_nama_produk" class="form-control input-sm" style="height:40px;" onchange="initDataSKU()" />
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKUKEMASAN">Kemasan</label>
                                        <input type="text" id="filter-sku-kemasan" name="filter_sku_kemasan" class="form-control input-sm" style="height:40px;" onchange="initDataSKU()" />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKUSATUAN">Satuan</label>
                                        <input type="text" id="filter-sku-satuan" name="filter_sku_satuan" class="form-control input-sm" style="height:40px;" onchange="initDataSKU()" />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-BRAND">Brand</label>
                                        <input type="text" id="filter-brand" name="filter_brand" class="form-control input-sm" style="height:40px;" onchange="initDataSKU()" />
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
                                <table class="table table-bordered" id="table-sku">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th style="color:white;text-align:center; vertical-align:middle"><input type="checkbox" name="select-sku" id="select-sku" value="1"></th>
                                            <th class="text-center" style="color:white;text-align: center; vertical-align: middle;"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
                                            <th class="text-center" style="color:white;text-align: center; vertical-align: middle;"><span name="CAPTION-SKUINDUK">Sku Induk</span></th>
                                            <th class="text-center" style="color:white;text-align: center; vertical-align: middle;"><span name="CAPTION-SKU">SKU</span></th>
                                            <th class="text-center" style="color:white;text-align: center; vertical-align: middle;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
                                            <th class="text-center" style="color:white;text-align: center; vertical-align: middle;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
                                            <th class="text-center" style="color:white;text-align: center; vertical-align: middle;"><span name="CAPTION-PRINCIPLE">Principle</span></th>
                                            <th class="text-center" style="color:white;text-align: center; vertical-align: middle;"><span name="CAPTION-BRAND">Brand</span>
                                            <th class="text-center" style="color:white;text-align: center; vertical-align: middle;"><span name="CAPTION-TGLEXP">Tanggal Kadaluwarsa</span>
                                            <th class=" text-center" style="color:white;text-align: center; vertical-align: middle;"><span name="CAPTION-QTY">Qty</span>
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
                <button type="button" class="btn btn-info" id="btn-choose-sku-multi"><span name="CAPTION-CHOOSE">Pilih</span></button>
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
                                    <th style="color:white;text-align:center; vertical-align:middle">No</th>
                                    <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-AREA">Area</span>
                                    </th>
                                    <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-SKUREQEXPDATE">Tgl Kadaluwarsa SKU</span></th>
                                    <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-JMLSKUSTOCKTERAKHIR">Stock Akhir</span></th>
                                    <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-QTYAMBIL">QTY Ambil</span></th>
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
                                    <div class="col-xs-4">
                                        <label name="CAPTION-NODO">No DO</label>
                                        <select id="filter-delivery_order_id" class="selectpicker form-control" name="filter[delivery_order_id]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Document" onchange="add_so_detail2_ed_by_do_detail2()">
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKUKODE">Kode SKU</label>
                                        <input type="text" id="caption-ed-sku-kode-retur" name="caption_ed_sku_retur" class="form-control input-sm" readonly />
                                        <input type="hidden" id="caption-ed-sku-id-retur" name="caption_ed_sku_id_retur" class="form-control input-sm" readonly />
                                        <input type="hidden" id="caption-ed-sku-index-retur" name="caption_ed_sku_index_retur" value="0" />
                                        <input type="hidden" id="caption-ed-principle-id-retur" name="caption_ed_principle_id_retur" value="" />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKU">SKU</label>
                                        <input type="text" id="caption-ed-sku-retur" name="caption_ed_sku_retur" class="form-control input-sm" readonly />
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKUKEMASAN">Kemasan</label>
                                        <input type="text" id="caption-ed-sku-kemasan-retur" name="caption_ed_sku_kemasan_retur" class="form-control input-sm" readonly />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-SKUSATUAN">Satuan</label>
                                        <input type="text" id="caption-ed-sku-satuan-retur" name="caption_ed_sku_satuan_retur" class="form-control input-sm" readonly />
                                    </div>
                                    <div class="col-xs-4">
                                        <label name="CAPTION-TOTALQTY">Total QTY</label>
                                        <input type="text" id="caption-sku-qty-retur" name="caption_sku_qty_retur" class="form-control input-sm" readonly />
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
                                <button type="button" class="btn btn-primary" id="btn-add-ed-sku-retur" onclick="add_so_detail2_ed()"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHSKU">Tambah SKU</span></button>
                                <button type="button" class="btn btn-primary" id="btn-reset-ed-sku-retur" onclick="reset_so_detail2_ed()"><i class="fa fa-refresh"></i> <span name="CAPTION-RESET">Reset</span></button>
                                <table class="table table-striped" id="table-ed-sku-retur">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th style="color:white;text-align:center; vertical-align:middle">No</th>
                                            <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-NODO">NO DO</span></th>
                                            <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-GUDANGBARANG">Gudang</span></th>
                                            <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-SKUREQEXPDATE">Tgl Kadaluwarsa SKU</span></th>
                                            <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-QTYAMBIL">QTY Ambil</span></th>
                                            <th style="color:white;text-align:center; vertical-align:middle"><span name="CAPTION-ACTION">Action</span></th>
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