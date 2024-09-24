<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span name="CAPTION-221003002">Form Katalog Promo Detail</span></h3>
            </div>
            <div style="float: right">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group field-SKUPromo-sku_promo_kode">
                                <label class="control-label" for="SKUPromo-sku_promo_kode" name="CAPTION-IDKATALOGPROMO">ID Katalog Promo</label>
                                <input type="text" id="SKUPromo-sku_promo_kode" class="form-control" name="SKUPromo[sku_promo_kode]" autocomplete="off" value="">
                                <input readonly="readonly" type="hidden" id="SKUPromo-sku_promo_id" class="form-control" name="SKUPromo[sku_promo_id]" autocomplete="off" value="<?= $sku_promo_id; ?>">
                                <input type="hidden" id="cek_sku_promo_detail_bonus" value="0">
                                <input type="hidden" id="cek_sku_promo_detail_diskon" value="0">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group field-SKUPromo-sku_promo_keterangan">
                                <label class="control-label" for="SKUPromo-sku_promo_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
                                <input type="text" id="SKUPromo-sku_promo_keterangan" class="form-control" name="SKUPromo[sku_promo_keterangan]" autocomplete="off" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group field-SKUPromo-depo_group_id">
                                <label class="control-label" for="SKUPromo-depo_group_id" name="CAPTION-GROUPLOKASIKERJA">Group Lokasi Kerja</label>
                                <select id="SKUPromo-depo_group_id" class="selectpicker form-control" name="SKUPromo[depo_group_id]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Group Workplace">
                                    <?php foreach ($DepoGroup as $row) : ?>
                                        <option value="'<?= $row['depo_group_nama'] ?>'"><?= $row['depo_group_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group field-SKUPromo-depo_id">
                                <label class="control-label" for="SKUPromo-depo_id" name="CAPTION-LOKASIKERJA">Lokasi Kerja</label>
                                <span id="loadingdepo" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                <select id="SKUPromo-depo_id" class="selectpicker form-control" name="SKUPromo[depo_id]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Workplace">
                                    <!-- <?php foreach ($Depo as $row) : ?>
                                        <option value="'<?= $row['depo_id'] ?>'"><?= $row['depo_nama'] ?></option>
                                    <?php endforeach; ?> -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group field-SKUPromo-sku_promo_kode">
                                <label class="control-label" for="SKUPromo-sku_promo_kode" name="CAPTION-TANGGALAKTIF">Tanggal Aktif</label>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="text" id="SKUPromo-sku_promo_tgl_berlaku_awal" class="form-control input-sm datepicker" name="SKUPromo[sku_promo_tgl_berlaku_awal]" autocomplete="off" value="<?= date('d-m-Y') ?>">
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="text" id="SKUPromo-sku_promo_tgl_berlaku_akhir" class="form-control input-sm datepicker" name="SKUPromo[sku_promo_tgl_berlaku_akhir]" autocomplete="off" value="<?= date('d-m-Y') ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group field-SKUPromo-sku_promo_status">
                                <label class="control-label" for="SKUPromo-sku_promo_status">Status</label>
                                <input readonly="readonly" type="text" id="SKUPromo-sku_promo_status" class="form-control" name="SKUPromo[sku_promo_status]" autocomplete="off" value="Draft">
                            </div>
                            <!-- <div class="form-group field-SKUPromo-sku_promo_is_need_approval">
                                <input type="checkbox" id="SKUPromo-sku_promo_is_need_approval" name="SKUPromo[sku_promo_is_need_approval]" autocomplete="off" value="1"> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <label class="control-label" for="headerPerusahaan" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                            <select name="headerPerusahaan" class="input-sm form-control select2" id="headerPerusahaan" style="width:100%;">
                                <option value="">** <span name="CAPTION-PILIH">PILIH</span> **</option>
                                <?php foreach ($Perusahaan as $row) : ?>
                                    <option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xs-6" style="margin-top: 20px">
                            <div class="form-group field-SKUPromo-sku_promo_is_need_approval">
                                <input type="checkbox" id="SKUPromo-sku_promo_is_need_approval" name="SKUPromo[sku_promo_is_need_approval]" autocomplete="off" value="1"> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group field-SKUPromo-depo_group_nama">
                                <label class="control-label" for="SKUPromo-depo_group_nama" name="CAPTION-SEGMENT">Segmen</label>
                                <select id="SKUPromo-client_pt_segmen" class="selectpicker form-control" name="SKUPromo[client_pt_segmen]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Group Workplace" onchange="GetPelangganBySegmen()">
                                    <?php foreach ($Segmen1 as $row) : ?>
                                        <option value="'<?= $row['client_pt_segmen_id'] ?>'"><?= $row['client_pt_segmen_kode'] . " - " . $row['client_pt_segmen_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group field-SKUPromo-sku_promo_is_khusus">
                                <input type="checkbox" id="SKUPromo-sku_promo_is_khusus" name="SKUPromo[sku_promo_is_khusus]" autocomplete="off" value="1"> <span name="CAPTION-KHUSUS">Khusus</span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group field-SKUPromo-client_pt_id">
                                <label class="control-label" for="SKUPromo-client_pt_id" name="CAPTION-PELANGGAN">Pelanggan</label>
                                <span id="loadingdepo" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                <select id="SKUPromo-client_pt_id" class="selectpicker form-control" name="SKUPromo[client_pt_id]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Pelanggan" disabled>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-primary" id="btn_tambah_promo_detail"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHPROMODETAIL">Tambah Promo Detail</span></button>
            </div>
        </div>
        <div id="span_promo_detail">

        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div style="float: right">
                    <span id="loading" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                    <button class="btn-submit btn btn-success" id="btn_save_sku_promo"><i class="fa fa-save"></i> <span name="CAPTION-SAVE">Simpan</span></button>
                    <a href="<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/PromoMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI">Kembali</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pengaturan" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-PENGATURANBONUS">Pengaturan Bonus</label></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="panel-pengaturan">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" id="panel-pengaturan-header">
                            <div class="x_title">
                                <h5 class="pull-left" name="CAPTION-PENGATURANHEADER">Pengaturan Header</h5>
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id" value="">
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail2_id" value="">
                                <input type="hidden" id="Filter-principle_id" value="">
                                <input type="hidden" id="dasar_jumlah_order" value="">
                                <button type="button" class="btn btn-success btn-sm pull-right" id="btn_tambah_promo_detail2"><i class="fa fa-plus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered" id="table-pengaturan-header" style="width: 50%;">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle; text-align:center;">#</th>
                                                <th style="vertical-align:middle; text-align:center;" id="thMinimumGlobal"><span name="CAPTION-QTYMINIMUM">Qty Minimum</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BERKELIPATAN">Berkelipatan</span></th>
                                                <th style="vertical-align:middle; text-align:center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="x_panel" id="panel-pengaturan-detail" style="display: none;">
                            <div class=" x_title">
                                <h5 class="pull-left" name="CAPTION-PENGATURANDETAIL">Pengaturan Detail #<h5 id="SKUPromoDetail2Bonus-no_urut"></h5>
                                </h5>
                                <button type="button" class="btn btn-success btn-sm pull-right" id="btn_search_sku"><i class="fa fa-search"></i></button>
                                <input type="hidden" id="SKUPromoDetail2Bonus-index" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-check_pilihan" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_detail2_id" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_detail1_id" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_id" value="">
                                <input type="hidden" id="cek_qty_bonus" value="0">
                                <input type="hidden" id="random_id" value="">
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table-pengaturan-detail">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-NO">No</span></th>
                                                    <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKU">SKU</span></th>
                                                    <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-KEMASAN">Kemasan</span></th>
                                                    <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SATUAN">Satuan</span></th>
                                                    <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-QTYBONUS">QTY Bonus</span></th>
                                                    <th style="vertical-align:middle; text-align:center;display:none;"><span name="CAPTION-TIPE">Tipe</span></th>
                                                    <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-REFERENSIDISKON">Referensi Diskon</span></th>
                                                    <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-ACTION">Action</span></th>
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
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_save_pengaturan_bonus2"><span name="CAPTION-SAVE">Simpan</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger" id="btn_tutup_pengaturan_bonus"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pengaturan-by-one" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-PENGATURANBONUS">Pengaturan Bonus</label></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="panel-pengaturan">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" id="panel-pengaturan-header-by-one">
                            <div class="x_title">
                                <h5 class="pull-left" name="CAPTION-PENGATURANHEADER">Pengaturan Header</h5>
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_by_one" value="">
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail2_id_by_one" value="">
                                <input type="hidden" id="dasar_jumlah_order" value="">
                                <input type="hidden" id="Filter-principle_id_by_one" value="">
                                <button type="button" class="btn btn-success btn-sm pull-right" id="btn_tambah_promo_detail2_by_one"><i class="fa fa-plus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group field-FilterPengaturan-sku_group_id_by_one">
                                        <label class="control-label" for="FilterPengaturan-sku_group_id" name="CAPTION-SKUGROUP">SKU Group</label>
                                        <input readonly type="text" id="FilterPengaturan-sku_group_id_by_one" class="form-control" name="FilterPengaturan[sku_group_id]" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group field-FilterPengaturan-sku_group_nama">
                                        <label class="control-label" for="FilterPengaturan-sku_group_nama" name="CAPTION-SKUGROUP">Group Nama</label>
                                        <input readonly type="text" id="FilterPengaturan-sku_group_nama_by_one" class="form-control" name="FilterPengaturan[sku_group_nama]" autocomplete="off" value="">
                                        <input readonly type="hidden" id="FilterPengaturan-kategori_id_by_one" class="form-control" name="FilterPengaturan[kategori_id_by_one]" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered" id="table-pengaturan-header-by-one" style="width: 50%;">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle; text-align:center;">#</th>
                                                <th style="vertical-align:middle; text-align:center;" id="thMinimum"><span name="CAPTION-QTYMINIMUM">Qty Minimum</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BERKELIPATAN">Berkelipatan</span></th>
                                                <th style="vertical-align:middle; text-align:center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="x_panel" id="panel-pengaturan-detail-by-one" style="display: none;">
                            <div class=" x_title">
                                <h5 class="pull-left" name="CAPTION-PENGATURANDETAIL">Pengaturan Detail #<h5 id="SKUPromoDetail2Bonus-no_urut_by_one"></h5>
                                </h5>
                                <input type="hidden" id="SKUPromoDetail2Bonus-check_pilihan" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-index_by_one" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_one" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_detail2_id_by_one" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_detail1_id_by_one" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_id_by_one" value="">
                                <input type="hidden" id="cek_qty_bonus_by_one" value="0">
                                <button type="button" class="btn btn-success pull-right" id="btn_search_sku_by_one"><i class="fa fa-search"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered" id="table-pengaturan-detail-by-one">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-NO">No</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKU">SKU</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-KEMASAN">Kemasan</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SATUAN">Satuan</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-QTYBONUS">QTY Bonus</span></th>
                                                <th style="vertical-align:middle; text-align:center;display:none;"><span name="CAPTION-TIPE">Tipe</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-REFERENSIDISKON">Referensi Diskon</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-ACTION">Action</span></th>
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
            </div>
            <div class="modal-footer">
                <span id="loadingpengaturanbyone" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" class="btn btn-success" id="btn_save_pengaturan_bonus_by_one"><span name="CAPTION-SAVE">Simpan</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pengaturan-by-sku" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-PENGATURANBONUS">Pengaturan Bonus</label></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="panel-pengaturan">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" id="panel-pengaturan-header-by-sku">
                            <div class="x_title">
                                <h5 class="pull-left" name="CAPTION-PENGATURANHEADER">Pengaturan Header</h5>
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_by_sku" value="">
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail2_id_by_sku" value="">
                                <input type="hidden" id="Filter-principle_id_by_sku" value="">
                                <input type="hidden" id="Filter-sku_id_by_sku" value="">
                                <input type="hidden" id="dasar_jumlah_order" value="">
                                <button type="button" class="btn btn-success btn-sm pull-right" id="btn_tambah_promo_detail2_by_sku"><i class="fa fa-plus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group field-FilterPengaturan-sku_kode_by_sku">
                                        <label class="control-label" for="FilterPengaturan-sku_kode_by_sku" name="CAPTION-SKUKODE">SKU Kode</label>
                                        <input readonly type="text" id="FilterPengaturan-sku_kode_by_sku" class="form-control" name="FilterPengaturan[sku_kode_by_sku]" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group field-FilterPengaturan-sku_nama_produk_by_sku">
                                        <label class="control-label" for="FilterPengaturan-sku_nama_produk_by_sku" name="CAPTION-SKU">SKU</label>
                                        <input readonly type="text" id="FilterPengaturan-sku_nama_produk_by_sku" class="form-control" name="FilterPengaturan[sku_nama_produk_by_sku]" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group field-FilterPengaturan-sku_kemasan_by_sku">
                                        <label class="control-label" for="FilterPengaturan-sku_kemasan_by_sku" name="CAPTION-SKUKEMASAN">Kemasan</label>
                                        <input readonly type="text" id="FilterPengaturan-sku_kemasan_by_sku" class="form-control" name="FilterPengaturan[sku_kemasan_by_sku]" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group field-FilterPengaturan-sku_satuan_by_sku">
                                        <label class="control-label" for="FilterPengaturan-sku_satuan_by_sku" name="CAPTION-SKUSATUAN">Satuan</label>
                                        <input readonly type="text" id="FilterPengaturan-sku_satuan_by_sku" class="form-control" name="FilterPengaturan[sku_satuan_by_sku]" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered" id="table-pengaturan-header-by-sku" style="width: 50%;">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle; text-align:center;">#</th>
                                                <th style="vertical-align:middle; text-align:center;" id="thMinimumBySKU"><span name="CAPTION-QTYMINIMUM">Qty Minimum</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BERKELIPATAN">Berkelipatan</span></th>
                                                <th style="vertical-align:middle; text-align:center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="x_panel" id="panel-pengaturan-detail-by-sku" style="display: none;">
                            <div class=" x_title">
                                <h5 class="pull-left" name="CAPTION-PENGATURANDETAIL">Pengaturan Detail #<h5 id="SKUPromoDetail2Bonus-no_urut_by_sku"></h5>
                                </h5>
                                <input type="hidden" id="SKUPromoDetail2Bonus-check_pilihan" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-index_by_sku" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_detail2_bonus_id_by_sku" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_detail2_id_by_sku" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_detail1_id_by_sku" value="">
                                <input type="hidden" id="SKUPromoDetail2Bonus-sku_promo_id_by_sku" value="">
                                <input type="hidden" id="cek_qty_bonus_by_sku" value="0">
                                <button type="button" class="btn btn-success pull-right" id="btn_search_sku_by_sku"><i class="fa fa-search"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered" id="table-pengaturan-detail-by-sku">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-NO">No</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKU">SKU</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-KEMASAN">Kemasan</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SATUAN">Satuan</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-QTYBONUS">QTY Bonus</span></th>
                                                <th style="vertical-align:middle; text-align:center;display:none;"><span name="CAPTION-TIPE">Tipe</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-REFERENSIDISKON">Referensi Diskon</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-ACTION">Action</span></th>
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
            </div>
            <div class="modal-footer">
                <span id="loadingpengaturanbysku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" class="btn btn-success" id="btn_save_pengaturan_bonus_by_sku"><span name="CAPTION-SAVE">Simpan</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-sku" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-CARISKU">Cari SKU</label></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="panel-pengaturan">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" id="panel-sku-header">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKU-sku_promo_kode">
                                        <label class="control-label" for="FilterPencarianSKU-sku_promo_kode" name="CAPTION-DEPO">Depo</label>
                                        <select name="FilterPencarianSKU[depo_id]" class="input-sm form-control select2" id="FilterPencarianSKU-depo_id" style="width:100%;" disabled>
                                        </select>
                                        <input type="hidden" id="FilterPencarianSKU-index" value="">
                                        <input type="hidden" id="FilterPencarianSKU-checked_bonus" value="">
                                        <input type="hidden" id="FilterPencarianSKU-checked_diskon" value="">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKU-principle_id">
                                        <label class="control-label" for="FilterPencarianSKU-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
                                        <select name="FilterPencarianSKU[principle_id]" class="input-sm form-control select2" id="FilterPencarianSKU-principle_id" style="width:100%;">
                                            <option value="">** <span name="CAPTION-All">All</span> **</option>
                                            <?php foreach ($Principle as $row) : ?>
                                                <option value="<?= $row['principle_id'] ?>"><?= $row['principle_kode'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKU-kode_sku_wms">
                                        <label class="control-label" for="FilterPencarianSKU-kode_sku_wms" name="CAPTION-SKU">Kode SKU WMS</label>
                                        <input type="text" id="FilterPencarianSKU-kode_sku_wms" class="form-control" name="FilterPencarianSKU[kode_sku_wms]" style="width:100%;" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKU-sku_promo_keterangan">
                                        <label class="control-label" for="FilterPencarianSKU-gudang_id" name="CAPTION-GUDANG">Gudang</label>
                                        <select name="FilterPencarianSKU[gudang_id]" class="input-sm form-control select2" id="FilterPencarianSKU-gudang_id" style="width:100%;" disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKU-brand_id">
                                        <label class="control-label" for="FilterPencarianSKU-brand_id" name="CAPTION-GROUPLOKASIKERJA">Brand</label>
                                        <select name="FilterPencarianSKU[brand_id]" class="input-sm form-control select2" id="FilterPencarianSKU-brand_id" style="width:100%;">
                                            <option value="">** <span name="CAPTION-PILIH">PILIH</span> **</option>
                                            <?php foreach ($Brand as $row) : ?>
                                                <option value="<?= $row['principle_brand_id'] ?>"><?= $row['principle_brand_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKU-kode_sku_pabrik">
                                        <label class="control-label" for="FilterPencarianSKU-kode_sku_pabrik" name="CAPTION-GROUPLOKASIKERJA">Kode SKU Pabrik</label>
                                        <input type="text" id="FilterPencarianSKU-kode_sku_pabrik" class="form-control input-sm" name="FilterPencarianSKU[kode_sku_pabrik]" style="width:100%;" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKU-sku_induk">
                                        <label class="control-label" for="FilterPencarianSKU-sku_induk" name="CAPTION-SKUINDUK">SKU Induk</label>
                                        <select name="FilterPencarianSKU[sku_induk]" class="input-sm form-control select2" id="FilterPencarianSKU-sku_induk" style="width:100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKU-sku_nama">
                                        <label class="control-label" for="FilterPencarianSKU-sku_nama">SKU</label>
                                        <input type="text" id="FilterPencarianSKU-sku_nama" class="form-control" name="FilterPencarianSKU[sku_nama]" autocomplete="off" style="width:100%;" value="">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKU-client_wms_id">
                                        <label class="control-label" for="FilterPencarianSKU-client_wms_id" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                        <select name="FilterPencarianSKU[client_wms_id]" class="input-sm form-control select2" id="FilterPencarianSKU-client_wms_id" style="width:100%;">
                                            <option value="">** <span name="CAPTION-PILIH">PILIH</span> **</option>
                                            <?php foreach ($Perusahaan as $row) : ?>
                                                <option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <span id="loadingsku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                    <button type="button" class="btn btn-primary" id="btn_cari_sku"><i class="fa fa-search"></i> <span name="CAPTION-SEARCH">Cari</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="x_panel" id="panel-sku">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered" id="table-sku">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle; text-align:center;"><input type="checkbox" name="select-sku" id="select-sku" value="1"></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKUINDUK">SKU Induk</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKU">SKU</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-KEMASAN">Kemasan</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SATUAN">Satuan</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PRINCIPLE">Principle</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BRAND">Brand</span></th>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-choose-sku-multi" id="btn_save_promo_detail2"><span name="CAPTION-CHOOSE">Pilih</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-sku-detail1" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-CARISKU">Cari SKU</label></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="panel-pengaturan">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" id="panel-sku-header">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUDetail1-sku_promo_kode">
                                        <label class="control-label" for="FilterPencarianSKUDetail1-sku_promo_kode" name="CAPTION-DEPO">Depo</label>
                                        <select name="FilterPencarianSKUDetail1[depo_id]" class="input-sm form-control select2" id="FilterPencarianSKUDetail1-depo_id" style="width:100%;" disabled>
                                        </select>
                                        <input type="hidden" id="FilterPencarianSKUDetail1-index" value="">
                                        <input type="hidden" id="FilterPencarianSKUDetail1-checked_bonus" value="">
                                        <input type="hidden" id="FilterPencarianSKUDetail1-checked_diskon" value="">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUDetail1-principle_id">
                                        <label class="control-label" for="FilterPencarianSKUDetail1-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
                                        <select name="FilterPencarianSKUDetail1[principle_id]" class="input-sm form-control select2" id="FilterPencarianSKUDetail1-principle_id" style="width:100%;">
                                            <option value="">** <span name="CAPTION-All">All</span> **</option>
                                            <?php foreach ($Principle as $row) : ?>
                                                <option value="<?= $row['principle_id'] ?>"><?= $row['principle_kode'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUDetail1-kode_sku_wms">
                                        <label class="control-label" for="FilterPencarianSKUDetail1-kode_sku_wms" name="CAPTION-LOKASIKERJA">Kode SKU WMS</label>
                                        <input type="text" id="FilterPencarianSKUDetail1-kode_sku_wms" class="form-control" name="FilterPencarianSKUDetail1[kode_sku_wms]" style="width:100%;" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUDetail1-sku_promo_keterangan">
                                        <label class="control-label" for="FilterPencarianSKUDetail1-gudang_id" name="CAPTION-GUDANG">Gudang</label>
                                        <select name="FilterPencarianSKUDetail1[gudang_id]" class="input-sm form-control select2" id="FilterPencarianSKUDetail1-gudang_id" style="width:100%;" disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUDetail1-brand_id">
                                        <label class="control-label" for="FilterPencarianSKUDetail1-brand_id" name="CAPTION-GROUPLOKASIKERJA">Brand</label>
                                        <select name="FilterPencarianSKUDetail1[brand_id]" class="input-sm form-control select2" id="FilterPencarianSKUDetail1-brand_id" style="width:100%;">
                                            <option value="">** <span name="CAPTION-PILIH">PILIH</span> **</option>
                                            <?php foreach ($Brand as $row) : ?>
                                                <option value="<?= $row['principle_brand_id'] ?>"><?= $row['principle_brand_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUDetail1-kode_sku_pabrik">
                                        <label class="control-label" for="FilterPencarianSKUDetail1-kode_sku_pabrik" name="CAPTION-GROUPLOKASIKERJA">Kode SKU Pabrik</label>
                                        <input type="text" id="FilterPencarianSKUDetail1-kode_sku_pabrik" class="form-control input-sm" name="FilterPencarianSKUDetail1[kode_sku_pabrik]" style="width:100%;" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUDetail1-sku_induk">
                                        <label class="control-label" for="FilterPencarianSKUDetail1-sku_induk" name="CAPTION-SKUINDUK">SKU Induk</label>
                                        <select name="FilterPencarianSKUDetail1[sku_induk]" class="input-sm form-control select2" id="FilterPencarianSKUDetail1-sku_induk" style="width:100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUDetail1-sku_nama">
                                        <label class="control-label" for="FilterPencarianSKUDetail1-sku_nama">SKU</label>
                                        <input type="text" id="FilterPencarianSKUDetail1-sku_nama" class="form-control" name="FilterPencarianSKUDetail1[sku_nama]" autocomplete="off" style="width:100%;" value="">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKU-client_wms_id">
                                        <label class="control-label" for="FilterPencarianSKU-client_wms_id" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                        <select name="FilterPencarianSKU[client_wms_id]" class="input-sm form-control select2" id="FilterPencarianSKU-client_wms_id" style="width:100%;">
                                            <option value="">** <span name="CAPTION-PILIH">PILIH</span> **</option>
                                            <?php foreach ($Perusahaan as $row) : ?>
                                                <option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <span id="loadingsku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                    <button type="button" class="btn btn-primary" id="btn_cari_sku_2"><i class="fa fa-search"></i> <span name="CAPTION-SEARCH">Cari</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="x_panel" id="panel-sku-detail">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered" id="table-sku-detail">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle; text-align:center;"><input type="checkbox" name="select-sku-detail" id="select-sku-detail" value="1"></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKUINDUK">SKU Induk</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKU">SKU</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-KEMASAN">Kemasan</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SATUAN">Satuan</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PRINCIPLE">Principle</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BRAND">Brand</span></th>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="btn_save_promo_detail2_by_sku"><span name="CAPTION-CHOOSE">Pilih</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-sku-pengecualian" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-CARISKU">Cari SKU</label></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="panel-pengaturan">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" id="panel-sku-header">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUPengecualian-sku_promo_kode">
                                        <label class="control-label" for="FilterPencarianSKUPengecualian-sku_promo_kode" name="CAPTION-DEPO">Depo</label>
                                        <select name="FilterPencarianSKUPengecualian[depo_id]" class="input-sm form-control select2" id="FilterPencarianSKUPengecualian-depo_id" style="width:100%;" disabled>
                                        </select>
                                        <input type="hidden" id="FilterPencarianSKUPengecualian-index" value="">
                                        <input type="hidden" id="FilterPencarianSKUPengecualian-sku_promo_detail2_id" value="">
                                        <input type="hidden" id="FilterPencarianSKUPengecualian-sku_promo_detail1_id" value="">
                                        <input type="hidden" id="FilterPencarianSKUPengecualian-sku_promo_id" value="">
                                        <input type="hidden" id="FilterPencarianSKUPengecualian-sku_group_id" value="">
                                        <input type="hidden" id="FilterPencarianSKUPengecualian-sku_group_nama" value="">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUPengecualian-principle_id">
                                        <label class="control-label" for="FilterPencarianSKUPengecualian-principle_id" name="CAPTION-PRINCIPLE">Principle</label>
                                        <select name="FilterPencarianSKUPengecualian[principle_id]" class="input-sm form-control select2" id="FilterPencarianSKUPengecualian-principle_id" style="width:100%;">
                                            <option value="">** <span name="CAPTION-All">All</span> **</option>
                                            <?php foreach ($Principle as $row) : ?>
                                                <option value="<?= $row['principle_id'] ?>"><?= $row['principle_kode'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUPengecualian-kode_sku_wms">
                                        <label class="control-label" for="FilterPencarianSKUPengecualian-kode_sku_wms" name="CAPTION-LOKASIKERJA">Kode SKU WMS</label>
                                        <input type="text" id="FilterPencarianSKUPengecualian-kode_sku_wms" class="form-control" name="FilterPencarianSKUPengecualian[kode_sku_wms]" style="width:100%;" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUPengecualian-sku_promo_keterangan">
                                        <label class="control-label" for="FilterPencarianSKUPengecualian-gudang_id" name="CAPTION-GUDANG">Gudang</label>
                                        <select name="FilterPencarianSKUPengecualian[gudang_id]" class="input-sm form-control select2" id="FilterPencarianSKUPengecualian-gudang_id" style="width:100%;" disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUPengecualian-brand_id">
                                        <label class="control-label" for="FilterPencarianSKUPengecualian-brand_id" name="CAPTION-GROUPLOKASIKERJA">Brand</label>
                                        <select name="FilterPencarianSKUPengecualian[brand_id]" class="input-sm form-control select2" id="FilterPencarianSKUPengecualian-brand_id" style="width:100%;">
                                            <option value="">** <span name="CAPTION-PILIH">PILIH</span> **</option>
                                            <?php foreach ($Brand as $row) : ?>
                                                <option value="<?= $row['principle_brand_id'] ?>"><?= $row['principle_brand_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUPengecualian-kode_sku_pabrik">
                                        <label class="control-label" for="FilterPencarianSKUPengecualian-kode_sku_pabrik" name="CAPTION-GROUPLOKASIKERJA">Kode SKU Pabrik</label>
                                        <input type="text" id="FilterPencarianSKUPengecualian-kode_sku_pabrik" class="form-control input-sm" name="FilterPencarianSKUPengecualian[kode_sku_pabrik]" style="width:100%;" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUPengecualian-sku_induk">
                                        <label class="control-label" for="FilterPencarianSKUPengecualian-sku_induk" name="CAPTION-SKUINDUK">SKU Induk</label>
                                        <select name="FilterPencarianSKUPengecualian[sku_induk]" class="input-sm form-control select2" id="FilterPencarianSKUPengecualian-sku_induk" style="width:100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKUPengecualian-sku_nama">
                                        <label class="control-label" for="FilterPencarianSKUPengecualian-sku_nama">SKU</label>
                                        <input type="text" id="FilterPencarianSKUPengecualian-sku_nama" class="form-control" name="FilterPencarianSKUPengecualian[sku_nama]" autocomplete="off" style="width:100%;" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <span id="loadingsku3" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                    <button type="button" class="btn btn-primary" id="btn_cari_sku_pengecualian"><i class="fa fa-search"></i> <span name="CAPTION-SEARCH">Cari</span></button>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group field-FilterPencarianSKU-client_wms_id">
                                        <label class="control-label" for="FilterPencarianSKU-client_wms_id" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                        <select name="FilterPencarianSKU[client_wms_id]" class="input-sm form-control select2" id="FilterPencarianSKU-client_wms_id" style="width:100%;">
                                            <option value="">** <span name="CAPTION-PILIH">PILIH</span> **</option>
                                            <?php foreach ($Perusahaan as $row) : ?>
                                                <option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="x_panel" id="panel-sku-pengecualian">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered" id="table-sku-pengecualian">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle; text-align:center;"><input type="checkbox" name="select-sku-pengecualian" id="select-sku-pengecualian" value="1"></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKUINDUK">SKU Induk</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKU">SKU</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-KEMASAN">Kemasan</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SATUAN">Satuan</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-PRINCIPLE">Principle</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-BRAND">Brand</span></th>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="btn_save_pengecualian_sku"><span name="CAPTION-CHOOSE">Pilih</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pengaturan-diskon" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-PENGATURANDISKON">Pengaturan diskon</label></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="panel-pengaturan">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" id="panel-pengaturan-detail">
                            <div class=" x_title">
                                <h5 class="pull-left" name="CAPTION-PENGATURANDETAIL">Pengaturan Detail</h5>
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id" value="">
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail2_id" value="">
                                <input type="hidden" id="Filter-principle_id" value="">
                                <button type="button" class="btn btn-success btn-sm pull-right" id="btn_tambah_promo_detail2_diskon"><i class="fa fa-plus"></i></button>
                                <input type="hidden" id="SKUPromoDetail2Diskon-index" value="">
                                <input type="hidden" id="SKUPromoDetail2Diskon-check_pilihan" value="">
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered" id="table-pengaturan-diskon">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-NO">No</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-QTY">QTY</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-TIPE">Tipe</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-NILAI">Nilai</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-REFERENSIDISKON">Referensi Diskon</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-HITUNGDISKON">Hitung Diskon</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-ACTION">Action</span></th>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_save_pengaturan_diskon"><span name="CAPTION-SAVE">Simpan</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger" id="btn_tutup_pengaturan_diskon"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pengaturan-diskon-by-one" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-PENGATURANDISKON">Pengaturan Diskon</label></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="panel-pengaturan">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" id="panel-pengaturan-header-by-one">
                            <div class="x_title">
                                <h5 class="pull-left" name="CAPTION-PENGATURANHEADER">Pengaturan Header</h5>
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_by_one" value="">
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail2_id_by_one" value="">
                                <input type="hidden" id="Filter-principle_id_by_one" value="">
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group field-FilterPengaturanDiskon-sku_group_id_by_one">
                                        <label class="control-label" for="FilterPengaturanDiskon-sku_group_id" name="CAPTION-SKUGROUP">SKU Group</label>
                                        <input readonly type="text" id="FilterPengaturanDiskon-sku_group_id_by_one" class="form-control" name="FilterPengaturanDiskon[sku_group_id]" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group field-FilterPengaturanDiskon-sku_group_nama">
                                        <label class="control-label" for="FilterPengaturanDiskon-sku_group_nama" name="CAPTION-SKUGROUP">Group Nama</label>
                                        <input readonly type="text" id="FilterPengaturanDiskon-sku_group_nama_by_one" class="form-control" name="FilterPengaturanDiskon[sku_group_nama]" autocomplete="off" value="">
                                        <input readonly type="hidden" id="FilterPengaturanDiskon-kategori_id_by_one" class="form-control" name="FilterPengaturanDiskon[kategori_id_by_one]" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="x_panel" id="panel-pengaturan-diskon-by-one">
                            <div class=" x_title">
                                <h5 class="pull-left" name="CAPTION-PENGATURANDETAIL">Pengaturan Detail</h5>
                                <input type="hidden" id="SKUPromoDetail2Diskon-check_pilihan" value="">
                                <input type="hidden" id="SKUPromoDetail2Diskon-index_by_one" value="">
                                <button type="button" class="btn btn-success btn-sm pull-right" id="btn_tambah_promo_detail2_diskon_by_one"><i class="fa fa-plus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered" id="table-pengaturan-diskon-by-one">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-NO">No</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-QTY">QTY</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-TIPE">Tipe</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-NILAI">Nilai</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-REFERENSIDISKON">Referensi Diskon</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-HITUNGDISKON">Hitung Diskon</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-ACTION">Action</span></th>
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
            </div>
            <div class="modal-footer">
                <span id="loadingpengaturanbyone" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" class="btn btn-success" id="btn_save_pengaturan_diskon_by_one"><span name="CAPTION-SAVE">Simpan</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pengaturan-diskon-by-sku" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-PENGATURANDISKON">Pengaturan Diskon</label></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="panel-pengaturan">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" id="panel-pengaturan-header-by-sku">
                            <div class="x_title">
                                <h5 class="pull-left" name="CAPTION-PENGATURANHEADER">Pengaturan Header</h5>
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail1_id_by_sku" value="">
                                <input type="hidden" id="SKUPromoDetail-sku_promo_detail2_id_by_sku" value="">
                                <input type="hidden" id="Filter-principle_id_by_sku" value="">
                                <input type="hidden" id="Filter-sku_id_by_sku" value="">
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group field-FilterPengaturanDiskon-sku_kode_by_sku">
                                        <label class="control-label" for="FilterPengaturanDiskon-sku_kode_by_sku" name="CAPTION-SKUKODE">SKU Kode</label>
                                        <input readonly type="text" id="FilterPengaturanDiskon-sku_kode_by_sku" class="form-control" name="FilterPengaturanDiskon[sku_kode_by_sku]" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group field-FilterPengaturanDiskon-sku_nama_produk_by_sku">
                                        <label class="control-label" for="FilterPengaturanDiskon-sku_nama_produk_by_sku" name="CAPTION-SKU">SKU</label>
                                        <input readonly type="text" id="FilterPengaturanDiskon-sku_nama_produk_by_sku" class="form-control" name="FilterPengaturanDiskon[sku_nama_produk_by_sku]" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group field-FilterPengaturanDiskon-sku_kemasan_by_sku">
                                        <label class="control-label" for="FilterPengaturanDiskon-sku_kemasan_by_sku" name="CAPTION-SKUKEMASAN">Kemasan</label>
                                        <input readonly type="text" id="FilterPengaturanDiskon-sku_kemasan_by_sku" class="form-control" name="FilterPengaturanDiskon[sku_kemasan_by_sku]" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group field-FilterPengaturanDiskon-sku_satuan_by_sku">
                                        <label class="control-label" for="FilterPengaturanDiskon-sku_satuan_by_sku" name="CAPTION-SKUSATUAN">Satuan</label>
                                        <input readonly type="text" id="FilterPengaturanDiskon-sku_satuan_by_sku" class="form-control" name="FilterPengaturanDiskon[sku_satuan_by_sku]" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div><br>
                        </div>
                        <div class="x_panel" id="panel-pengaturan-diskon-by-sku">
                            <div class=" x_title">
                                <h5 class="pull-left" name="CAPTION-PENGATURANDETAIL">Pengaturan Detail</h5>
                                <input type="hidden" id="SKUPromoDetail2Diskon-check_pilihan" value="">
                                <input type="hidden" id="SKUPromoDetail2Diskon-index_by_sku" value="">
                                <button type="button" class="btn btn-success btn-sm pull-right" id="btn_tambah_promo_detail2_diskon_by_sku"><i class="fa fa-plus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered" id="table-pengaturan-diskon-by-sku">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-NO">No</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-QTY">QTY</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-TIPE">Tipe</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-NILAI">Nilai</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-REFERENSIDISKON">Referensi Diskon</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-HITUNGDISKON">Hitung Diskon</span></th>
                                                <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-ACTION">Action</span></th>
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
            </div>
            <div class="modal-footer">
                <span id="loadingpengaturanbysku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" class="btn btn-success" id="btn_save_pengaturan_diskon_by_sku"><span name="CAPTION-SAVE">Simpan</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
            </div>
        </div>
    </div>
</div>