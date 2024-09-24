<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span name="CAPTION-221003001">Form Katalog Harga Detail</span></h3>
            </div>
            <div style="float: right">

            </div>
        </div>
        <?php foreach ($HargaHeader as $header) : ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group field-SKUHarga-sku_harga_kode">
                                    <label class="control-label" for="SKUHarga-sku_harga_kode" name="CAPTION-IDKATALOGHARGA">ID Katalog Harga</label>
                                    <input readonly="readonly" type="text" id="SKUHarga-sku_harga_kode" class="form-control" name="SKUHarga[sku_harga_kode]" autocomplete="off" value="<?= $header['sku_harga_kode'] ?>">
                                    <input type="hidden" id="SKUHarga-sku_harga_id" class="form-control" name="SKUHarga[sku_harga_id]" autocomplete="off" value="<?= $header['sku_harga_id'] ?>">
                                    <input type="hidden" id="SKUHarga-sku_harga_id_new" class="form-control" name="SKUHarga[sku_harga_id_new]" autocomplete="off" value="<?= $sku_harga_id_new ?>">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group field-SKUHarga-client_wms_id">
                                    <label class="control-label" for="SKUHarga-client_wms_id" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                    <select name="SKUHarga[client_wms_id]" class="form-control select2" id="SKUHarga-client_wms_id">
                                        <option value="">** <span name="CAPTION-CHOOSE">Pilih</span> **</option>
                                        <?php foreach ($Perusahaan as $row) : ?>
                                            <option value="<?= $row['client_wms_id'] ?>" <?= $row['client_wms_id'] == $header['client_wms_id'] ? 'selected' : '' ?>><?= $row['client_wms_nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group field-SKUHarga-depo_group_nama">
                                    <label class="control-label" for="SKUHarga-depo_group_nama" name="CAPTION-GROUPLOKASIKERJA">Group Lokasi Kerja</label>
                                    <select id="SKUHarga-depo_group_nama" class="selectpicker form-control" name="SKUHarga[depo_group_nama]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Group Workplace">
                                        <?php foreach ($DepoGroup as $row) : ?>
                                            <option value="'<?= $row['depo_group_nama'] ?>'" <?= $row['depo_group_nama_harga'] > 0 ? 'selected' : '' ?>><?= $row['depo_group_nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group field-SKUHarga-depo_id">
                                    <label class="control-label" for="SKUHarga-depo_id" name="CAPTION-LOKASIKERJA">Lokasi Kerja</label>
                                    <span id="loadingdepo" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                    <select id="SKUHarga-depo_id" class="selectpicker form-control" name="SKUHarga[depo_id]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Group Workplace">
                                        <?php foreach ($Depo as $row) : ?>
                                            <option value="'<?= $row['depo_id'] ?>'" <?= $row['depo_id'] == $row['depo_harga_id'] ? 'selected' : '' ?>><?= $row['depo_nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group field-SKUHarga-sku_harga_kode">
                                    <label class="control-label" for="SKUHarga-sku_harga_kode" name="CAPTION-TANGGALAKTIF">Tanggal Aktif</label>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <input type="text" id="SKUHarga-sku_harga_startdate" class="form-control input-sm datepicker" name="SKUHarga[sku_harga_startdate]" autocomplete="off" value="<?= date('d-m-Y', strtotime($header['sku_harga_startdate'])) ?>">
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="text" id="SKUHarga-sku_harga_enddate" class="form-control input-sm datepicker" name="SKUHarga[sku_harga_enddate]" autocomplete="off" value="<?= date('d-m-Y', strtotime($header['sku_harga_enddate'])) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group field-SKUHarga-sku_harga_keterangan">
                                    <label class="control-label" for="SKUHarga-sku_harga_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
                                    <input type="text" id="SKUHarga-sku_harga_keterangan" class="form-control" name="SKUHarga[sku_harga_keterangan]" autocomplete="off" value="<?= $header['sku_harga_keterangan'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group field-SKUHarga-sku_harga_status">
                                    <label class="control-label" for="SKUHarga-sku_harga_status">Status</label>
                                    <input readonly="readonly" type="text" id="SKUHarga-sku_harga_status" class="form-control" name="SKUHarga[sku_harga_status]" autocomplete="off" value="Draft">
                                </div>
                                <div class="form-group field-SKUHarga-sku_harga_is_need_approval">
                                    <input type="checkbox" id="SKUHarga-sku_harga_is_need_approval" name="SKUHarga[sku_harga_is_need_approval]" autocomplete="off" value="1"> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group field-SKUHarga-sku_harga_who_create">
                                    <label class="control-label" for="SKUHarga-sku_harga_approved_by" name="CAPTION-DISETUJUI">Disetujui</label>
                                    <input readonly="readonly" type="text" id="SKUHarga-sku_harga_approved_by" class="form-control" name="SKUHarga[sku_harga_who_approve]" autocomplete="off" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group field-SKUHarga-depo_group_nama">
                                    <label class="control-label" for="SKUHarga-depo_group_nama" name="CAPTION-SEGMENT">Segmen</label>
                                    <select id="SKUHarga-client_pt_segmen" class="selectpicker form-control" name="SKUHarga[client_pt_segmen]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Group Workplace" onchange="GetPelangganBySegmen()">
                                        <?php foreach ($Segmen1 as $row) : ?>
                                            <option value="'<?= $row['client_pt_segmen_id'] ?>'" <?= $row['client_pt_segmen_id'] == $row['client_pt_segmen_id_harga'] ? 'selected' : '' ?>><?= $row['client_pt_segmen_kode'] . " - " . $row['client_pt_segmen_nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group field-SKUHarga-sku_harga_is_khusus">
                                    <input type="checkbox" id="SKUHarga-sku_harga_is_khusus" name="SKUHarga[sku_harga_is_khusus]" autocomplete="off" value="1" <?= $header['is_khusus'] == '1' ? 'checked' : '' ?>> <span name="CAPTION-KHUSUS">Khusus</span>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group field-SKUHarga-client_pt_id">
                                    <label class="control-label" for="SKUHarga-client_pt_id" name="CAPTION-PELANGGAN">Pelanggan</label>
                                    <span id="loadingdepo" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                    <select id="SKUHarga-client_pt_id" class="selectpicker form-control" name="SKUHarga[client_pt_id]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Pelanggan" <?= $header['is_khusus'] == '1' ? '' : 'disabled' ?>>
                                        <?php foreach ($Customer as $row) : ?>
                                            <option value="'<?= $row['client_pt_id'] ?>'" <?= $row['client_pt_id'] == $row['client_pt_id_harga'] ? 'selected' : '' ?>><?= $row['client_pt_nama'] . " - " . $row['client_pt_kelurahan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
                        <h4 class="pull-left" name="CAPTION-SKUDKIRIM">Table Input Harga</h4>
                        <div class="pull-right">
                            <span id="loadingsku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                            <button data-toggle="modal" data-target="#modal-sku" id="btn-choose-prod-delivery" class="btn btn-success" type="button"><i class="fa fa-search"></i> <span name="CAPTION-CHOOSE" style="color:white;">Pilih</span></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <table class="table table-striped" id="table-input-harga" style="width:100%;">
                        <thead>
                            <tr class="bg-primary">
                                <th class="text-center" style="display:none"></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-NO">No</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-SKU">SKU</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-SKUQTY">Qty</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-UOM">UOM</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-DENGANPAJAK">Dengan Pajak</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-HARGA">Harga</span></th>
                                <th class="text-center" style="color:white;"><span name="CAPTION-ACTION">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($HargaDetail as $key => $detail) : ?>
                                <tr id="row-<?= $key ?>">
                                    <td style="display: none">
                                        <input type="hidden" id="item-<?= $key ?>-SKUHargaDetail-sku_id" value="<?= $detail['sku_id'] ?>" class="sku-id" />
                                    </td>
                                    <td class="text-center"><?= $key + 1 ?></td>
                                    <td class="text-center"><?= $detail['sku_kode'] ?></td>
                                    <td class="text-center"><?= $detail['sku_nama_produk'] ?></td>
                                    <td class="text-center">
                                        <input type="number" id="item-<?= $key ?>-SKUHargaDetail-sku_qty" class="form-control" value="<?= $detail['sku_qty'] ?>" />
                                    </td>
                                    <td class="text-center">
                                        <span class="sku-satuan-label"><?= $detail['sku_satuan'] ?></span>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" id="item-<?= $key ?>-SKUHargaDetail-sku_with_tax" value="1" <?= $detail['sku_with_tax'] == '1' ? 'checked' : '' ?> />
                                    </td>
                                    <td class="text-center">
                                        <input type="number" id="item-<?= $key ?>-SKUHargaDetail-sku_nominal_harga" class="form-control" value="<?= format_rupiah($detail['sku_nominal_harga']) ?>" />
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,'<?= $key ?>','<?= $detail['sku_id'] ?>')"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php $no = $key;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div style="float: right">
                    <span id="loadingview" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                    <a href="<?= base_url('FAS/MasterPricing/HargaDanPromo/Harga/HargaMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
                    <button class="btn-submit btn btn-success" id="btnduplicate"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-sku" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-CARISKU">Cari SKU</label></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3">
                                <label name="CAPTION-SKUINDUK">SKU Induk</label>
                                <input type="text" id="filter-sku-induk" name="filter_sku_induk" class="form-control" style="height:30px;" />
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-SKU">SKU</label>
                                <input type="text" id="filter-sku-nama-produk" name="filter_sku_nama_produk" class="form-control" style="height:30px;" />
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-PRINCIPLE">Principle</label>
                                <select name="filter_principle" class="input-sm form-control select2" id="filter-principle" style="width:100%;">
                                    <option value="">** <span name="CAPTION-All">All</span> **</option>
                                    <?php foreach ($Principle as $row) : ?>
                                        <option value="<?= $row['principle_id'] ?>"><?= $row['principle_kode'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- <input type="text" id="filter-principle" name="filter_principle" class="form-control" style="height:30px;" /> -->
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-BRAND">Brand</label>
                                <input type="text" id="filter-brand" name="filter_brand" class="form-control" style="height:30px;" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <label>&nbsp;</label>
                                <div>
                                    <span id="loadingsku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                    <button type="button" id="btn-search-sku" class="btn btn-success"><i class="fa fa-search"></i> <span name="CAPTION-SEARCH">Cari</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped" id="table-sku">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center" style="color:white;"><input type="checkbox" name="select-sku" id="select-sku" value="1"></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-PERUSAHAAN">Perusahaan</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SKUINDUK">Sku Induk</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SKU">SKU</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-PRINCIPLE">Principle</span></th>
                                    <th class="text-center" style="color:white;"><span name="CAPTION-BRAND">Brand</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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