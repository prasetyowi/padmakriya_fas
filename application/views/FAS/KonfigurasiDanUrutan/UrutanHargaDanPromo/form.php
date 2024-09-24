<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span name="CAPTION-223004000">Urutan Harga dan Promo</span></h3>
            </div>
            <div style="float: right">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4><span name="CAPTION-FORMURUTANHARGADANPROMO" style="color:#434242;">Form Urutan Harga dan Promo</span></h4>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group field-SKUKatalogSetting-depo_id">
                                <label class="control-label" for="SKUKatalogSetting-depo_id" name="CAPTION-LOKASIKERJA">Lokasi Kerja</label>
                                <select id="SKUKatalogSetting-depo_id" class="selectpicker form-control" name="SKUKatalogSetting[depo_id]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Workplace" disabled>
                                    <?php foreach ($Depo as $row) : ?>
                                        <option value="'<?= $row['depo_id'] ?>'" <?= $row['depo_id'] == $this->session->userdata('depo_id') ? 'selected' : '' ?>><?= $row['depo_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <span id="loadingdetail" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                            <button class="btn-submit btn btn-primary" id="btn_tambah_urutan"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAH">Tambah</span></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div id="view-table-katalog-detail"></div>
                            <table class="table table-bordered" id="table-urutan">
                                <thead>
                                    <tr>
                                        <th style="vertical-align:middle; text-align:center;">#</th>
                                        <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-URUTANPRIORITASHARGADANPROMO">Urutan Prioritas Harga Dan Promo</span></th>
                                        <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-KATALOGHEADER">Katalog Header</span></th>
                                        <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-LANJUTANPERHITUNGAN">Lanjutan Perhitungan</span></th>
                                        <th style="vertical-align:middle; text-align:center;"><span name="CAPTION-ACTION">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div style="float: right">
                                <span id="loading" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                <?php if ($UrutanDepo == 0) { ?>
                                    <button class="btn-submit btn btn-success" id="btn_save_sku_urutan_harga_promo"><i class="fa fa-save"></i> <span name="CAPTION-SAVE">Simpan</span></button>
                                <?php } else { ?>
                                    <button class="btn-submit btn btn-success" id="btn_update_sku_urutan_harga_promo"><i class="fa fa-save"></i> <span name="CAPTION-SAVE">Simpan</span></button>
                                <?php } ?>
                                <!-- <a class="btn-submit btn btn-info" href="<?= base_url() ?>FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/UrutanHargaDanPromoMenu"><i class="fa fa-trash"></i> <span name="CAPTION-KEMBALI">Kembali</span></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>