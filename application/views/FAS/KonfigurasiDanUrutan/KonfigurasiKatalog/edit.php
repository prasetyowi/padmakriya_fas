<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span name="CAPTION-221009000">Konfigurasi Katalog</span></h3>
            </div>
            <div style="float: right">

            </div>
        </div>
        <?php foreach ($KonfigurasiHeader as $header) : ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h4><span name="CAPTION-FORMKATALOGHEADER" style="color:#434242;">Form Katalog Header</span></h4>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group field-SKUKatalogSetting-depo_id">
                                    <label class="control-label" for="SKUKatalogSetting-depo_id" name="CAPTION-LOKASIKERJA">Lokasi Kerja</label>
                                    <select id="SKUKatalogSetting-depo_id" class="selectpicker form-control" name="SKUKatalogSetting[depo_id]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Workplace" disabled>
                                        <?php foreach ($Depo as $row) : ?>
                                            <option value="'<?= $row['depo_id'] ?>'" <?= $row['depo_id'] == $header['depo_id'] ? 'selected' : '' ?>><?= $row['depo_nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group field-SKUKatalogSetting-sku_katalog_setting_kode">
                                    <label class="control-label" for="SKUKatalogSetting-sku_katalog_setting_kode" name="CAPTION-IDKATALOG">ID Katalog</label>
                                    <input type="text" id="SKUKatalogSetting-sku_katalog_setting_kode" class="form-control" name="SKUKatalogSetting[sku_katalog_setting_kode]" autocomplete="off" value="<?= $header['sku_katalog_setting_kode']; ?>">
                                    <input readonly="readonly" type="hidden" id="SKUKatalogSetting-sku_katalog_setting_id" class="form-control" name="SKUKatalogSetting[sku_katalog_setting_id]" autocomplete="off" value="<?= $header['sku_katalog_setting_id']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group field-SKUKatalogSetting-sku_katalog_setting_keterangan">
                                    <label class="control-label" for="SKUKatalogSetting-sku_katalog_setting_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
                                    <input type="text" id="SKUKatalogSetting-sku_katalog_setting_keterangan" class="form-control" name="SKUKatalogSetting[sku_katalog_setting_keterangan]" autocomplete="off" value="<?= $header['sku_katalog_setting_keterangan']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h4><span name="CAPTION-SETTINGBERDASARKAN" style="color:#434242;">Setting Berdasarkan</span></h4>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group field-SKUKatalogSettingDetail-tipe_kategori1">
                                    <label class="control-label" for="SKUKatalogSetting-tipe_kategori1" name="CAPTION-LOKASIKERJA">1. <span name="CAPTION-KATEGORI1">Kategori 1</span></label>
                                    <select name="SKUKatalogSettingDetail[tipe_kategori1]" class="input-sm form-control select2" id="SKUKatalogSettingDetail-tipe_kategori1" style="width:100%;" onchange="UpdateKategori1SKUKatalogSettingDetail(this.value)">
                                        <option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
                                        <?php foreach ($KategoriGroup as $row) : ?>
                                            <option value="<?= $row['kategori_grup'] ?>" <?= $row['kategori_grup'] == $header['tipe_kategori1'] ? 'selected' : '' ?>><?= $row['kategori_grup'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group field-SKUKatalogSettingDetail-tipe_kategori3">
                                    <label class="control-label" for="SKUKatalogSettingDetail-tipe_kategori3" name="CAPTION-LOKASIKERJA">3. <span name="CAPTION-KATEGORI3">Kategori 3</span></label>
                                    <select name="SKUKatalogSettingDetail[tipe_kategori3]" class="input-sm form-control select2" id="SKUKatalogSettingDetail-tipe_kategori3" style="width:100%;" onchange="UpdateKategori3SKUKatalogSettingDetail(this.value)">
                                        <option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
                                        <?php foreach ($KategoriGroup as $row) : ?>
                                            <option value="<?= $row['kategori_grup'] ?>" <?= $row['kategori_grup'] == $header['tipe_kategori3'] ? 'selected' : '' ?>><?= $row['kategori_grup'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group field-SKUKatalogSettingDetail-tipe_kategori5">
                                    <label class="control-label" for="SKUKatalogSettingDetail-tipe_kategori5" name="CAPTION-LOKASIKERJA">5. <span name="CAPTION-KATEGORI5">Kategori 5</span></label>
                                    <select name="SKUKatalogSettingDetail[tipe_kategori5]" class="input-sm form-control select2" id="SKUKatalogSettingDetail-tipe_kategori5" style="width:100%;" onchange="UpdateKategori5SKUKatalogSettingDetail(this.value)">
                                        <option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
                                        <?php foreach ($KategoriGroup as $row) : ?>
                                            <option value="<?= $row['kategori_grup'] ?>" <?= $row['kategori_grup'] == $header['tipe_kategori5'] ? 'selected' : '' ?>><?= $row['kategori_grup'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group field-SKUKatalogSettingDetail-tipe_kategori2">
                                    <label class="control-label" for="SKUKatalogSettingDetail-tipe_kategori2" name="CAPTION-LOKASIKERJA">2. <span name="CAPTION-KATEGORI2">Kategori 2</span></label>
                                    <select name="SKUKatalogSettingDetail[tipe_kategori2]" class="input-sm form-control select2" id="SKUKatalogSettingDetail-tipe_kategori2" style="width:100%;" onchange="UpdateKategori2SKUKatalogSettingDetail(this.value)">
                                        <option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
                                        <?php foreach ($KategoriGroup as $row) : ?>
                                            <option value="<?= $row['kategori_grup'] ?>" <?= $row['kategori_grup'] == $header['tipe_kategori2'] ? 'selected' : '' ?>><?= $row['kategori_grup'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group field-SKUKatalogSettingDetail-tipe_kategori4">
                                    <label class="control-label" for="SKUKatalogSettingDetail-tipe_kategori4" name="CAPTION-LOKASIKERJA">4. <span name="CAPTION-KATEGORI4">Kategori 4</span></label>
                                    <select name="SKUKatalogSettingDetail[tipe_kategori4]" class="input-sm form-control select2" id="SKUKatalogSettingDetail-tipe_kategori4" style="width:100%;" onchange="UpdateKategori4SKUKatalogSettingDetail(this.value)">
                                        <option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
                                        <?php foreach ($KategoriGroup as $row) : ?>
                                            <option value="<?= $row['kategori_grup'] ?>" <?= $row['kategori_grup'] == $header['tipe_kategori4'] ? 'selected' : '' ?>><?= $row['kategori_grup'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group field-SKUKatalogSettingDetail-tipe_kategori6">
                                    <label class="control-label" for="SKUKatalogSettingDetail-tipe_kategori6" name="CAPTION-LOKASIKERJA">6. <span name="CAPTION-KATEGORI6">Kategori 6</span></label>
                                    <select name="SKUKatalogSettingDetail[tipe_kategori6]" class="input-sm form-control select2" id="SKUKatalogSettingDetail-tipe_kategori6" style="width:100%;" onchange="UpdateKategori6SKUKatalogSettingDetail(this.value)">
                                        <option value="">**<span name="CAPTION-PILIH">Pilih</span>**</option>
                                        <?php foreach ($KategoriGroup as $row) : ?>
                                            <option value="<?= $row['kategori_grup'] ?>" <?= $row['kategori_grup'] == $header['tipe_kategori6'] ? 'selected' : '' ?>><?= $row['kategori_grup'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div style="float: left">
                                <span id="loadingkategori" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                <button class="btn-submit btn btn-primary" id="btn_save_sku_katalog_setting"><i class="fa fa-search"></i> <span name="CAPTION-LIHAT">Lihat</span></button>
                            </div>
                        </div>
                    </div> -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4><span name="CAPTION-FORMKATALOGDETAIL" style="color:#434242;">Form Katalog Detail</span></h4>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <span id="loadingdetail" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                            <button class="btn-submit btn btn-primary" id="btn_tambah_sku_katalog_setting_detail"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAH">Tambah</span></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div id="view-table-katalog-detail"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-katalog-detail">
                                    <thead>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div style="float: right">
                                <span id="loading" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                <button class="btn-submit btn btn-success" id="btn_update_sku_katalog_setting"><i class="fa fa-save"></i> <span name="CAPTION-SAVE">Simpan</span></button>
                                <!-- <button class="btn-submit btn btn-danger" id="btn_delete_sku_katalog_setting"><i class="fa fa-trash"></i> <span name="CAPTION-Hapus">Hapus</span></button> -->
                                <a href="<?= base_url("FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/KonfigurasiKatalogMenu") ?>" class="btn-submit btn btn-info" id="btn_kembali_sku_katalog_setting"><i class="fa fa-undo"></i> <span name="CAPTION-KEMBALI">Kembali</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-kategori" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" style="width:80%;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title"><label id="titleKategori"></label></h4>
                </div>
                <div class="modal-body">
                    <div class="row" id="panel-pengaturan">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" id="panel-sku-header">
                                <div class="x_panel">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <table style="width: 100%; display:none;" class="table table-bordered" id="table_sku">
                                                <thead>
                                                    <tr>
                                                        <th style="vertical-align:middle; text-align:center;">#</th>
                                                        <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
                                                        <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-SKU">SKU</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <table style="width: 100%; display:none;" class="table table-bordered" id="table_outlet">
                                                <thead>
                                                    <tr>
                                                        <th style="vertical-align:middle; text-align:center;">#</th>
                                                        <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-NAMA">Nama</span></th>
                                                        <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-ALAMAT">Alamat</span></th>
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
                    <button type="button" class="btn btn-info" id="btn_pilih"><span name="CAPTION-CHOOSE">Pilih</span></button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
                </div>
            </div>
        </div>

    </div>