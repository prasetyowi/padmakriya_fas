<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span name="CAPTION-222023000">Pengaturan Piutang Outlet</span></h3>
            </div>
            <div style="float: right">
                <?php if ($Menu_Access["C"] == 1) : ?>
                    <button type="button" id="btn_add_pengaturan_piutang_outlet" class="btn btn-primary"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHPENGATURANPIUTANGOUTLET">Tambah Pengaturan Piutang Outlet</span></button>
                <?php endif; ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="panel panel-default">
            <div class="panel-heading"><label name="CAPTION-FILTER">Filter Data</label></div>
            <div class="panel-body form-horizontal form-label-left">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-4">
                                <label class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                <select class="form-control select2" id="filter_perusahaan" style="width:100%;">
                                    <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                    <?php foreach ($Perusahaan as $key => $value) : ?>
                                        <option value="<?= $value['client_wms_id']; ?>"><?= $value['client_wms_nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label" name="CAPTION-BRAND">Brand</label>
                                <select class="form-control select2" id="filter_brand" style="width:100%;">
                                    <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <label class="control-label" name="CAPTION-SKU">SKU</label>
                                <select class="form-control select2" id="filter_sku_id" style="width:100%;">
                                    <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-xs-4">
                                <span id="loading" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                <button type="button" id="btn_refresh_pengaturan_piutang_outlet" class="btn btn-primary"><i class="fa fa-refresh"></i> <span name="CAPTION-REFRESH">Refresh</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body form-horizontal form-label-left">
                <div class="row">
                    <table id="table_pengaturan_piutang_outlet" width="100%" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center"><span name="CAPTION-SEGMENT">Segment </span>1</th>
                                <th class="text-center"><span name="CAPTION-SEGMENT">Segment </span>1 Desc</th>
                                <th class="text-center"><span name="CAPTION-SEGMENT">Segment </span>2</th>
                                <th class="text-center"><span name="CAPTION-SEGMENT">Segment </span>2 Desc</th>
                                <th class="text-center"><span name="CAPTION-SEGMENT">Segment </span>3</th>
                                <th class="text-center"><span name="CAPTION-SEGMENT">Segment </span>3 Desc</th>
                                <th class="text-center"><span name="CAPTION-CATEGORY">Kategori</span></th>
                                <th class="text-center"><span name="CAPTION-BRAND">Brand</span></th>
                                <th class="text-center"><span name="CAPTION-SKU">SKU</span></th>
                                <th class="text-center"><span name="CAPTION-TOP">TOP</span></th>
                                <th class="text-center"><span name="CAPTION-ACTION">Action</span></th>
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

<div class="modal fade" id="modal_tambah_client_pt_setting_piutang" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xlg" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><span name="CAPTION-222023000">Pengaturan Piutang Outlet</span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-client_wms_id" style="width:100%;">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                            <?php foreach ($Perusahaan as $key => $value) : ?>
                                                <option value="<?= $value['client_wms_id']; ?>"><?= $value['client_wms_nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SEGMENT">Segment</label> <label>1</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-segment1" style="width:100%;">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SEGMENT">Segment</label> <label>2</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-segment2" style="width:100%;">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SEGMENT">Segment</label> <label>3</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-segment3" style="width:100%;">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-CATEGORY">Category</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-category" style="width:100%;" onchange="ResetCategory('tambah')">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                            <?php foreach ($Category as $row) { ?>
                                                <option value="<?= $row['kategori'] ?>"><?= $row['kategori'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-BRAND">Brand</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-brand" style="width:100%;">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SKU">SKU</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-sku_id" style="width:100%;" onchange="GetBrandBySKUInduk(this.value,'tambah')">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-TOP">TOP</label> <label>(Hari)</label>
                                        <input type="text" id="PengaturanPiutangOutlet-top" class="form-control text-right" name="PengaturanPiutangOutlet[top]" autocomplete="off" value="0">
                                    </div>
                                </div><br>
                            </div>
                        </div>
                        <div class="x_panel">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="x_content table-responsive">
                                        <button type="button" id="btn_tambah_list_pengaturan_piutang_outlet" class="btn btn-primary" onclick="TambahListPengaturanPiutangOutletKhusus('tambah')"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHPENGATURANPIUTANGOUTLETKHUSUS">Tambah Pengaturan Piutang Outlet Khusus</span></button>
                                        <table id="table_pengaturan_piutang_outlet_khusus_tambah" width="100%" class="table table-border table-bordered">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th class="text-center" style="color:white;"><span name="CAPTION-NO">No</span></th>
                                                    <th class="text-center" style="color:white;"><span name="CAPTION-OUTLET">Outlet</span></th>
                                                    <th class="text-center" style="color:white;"><span name="CAPTION-ACTION">Action</span></th>
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
                <span id="loadingPengaturanPiutangOutletadd" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" id="btn_simpan_pengaturan_piutang_outlet" class="btn btn-success"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN">Simpan</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger" onclick="ResetForm()"><i class="fa fa-sign-out"></i> <span name="CAPTION-CLOSE">Tutup</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_client_pt_setting_piutang" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xlg" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><span name="CAPTION-222023000">Pengaturan Piutang Outlet</span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-client_wms_id-edit" style="width:100%;">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                            <?php foreach ($Perusahaan as $key => $value) : ?>
                                                <option value="<?= $value['client_wms_id']; ?>"><?= $value['client_wms_nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" id="PengaturanPiutangOutlet-client_pt_setting_piutang_id-edit" class="form-control" name="PengaturanPiutangOutlet[client_pt_setting_piutang_id]" autocomplete="off" value="">
                                        <input type="hidden" id="PengaturanPiutangOutlet-updtgl-edit" class="form-control" name="PengaturanPiutangOutlet[updtgl]" autocomplete="off" value="">
                                        <input type="hidden" id="PengaturanPiutangOutlet-updwho-edit" class="form-control" name="PengaturanPiutangOutlet[updwho]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SEGMENT">Segment</label> <label>1</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-segment1-edit" style="width:100%;">
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SEGMENT">Segment</label> <label>2</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-segment2-edit" style="width:100%;">
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SEGMENT">Segment</label> <label>3</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-segment3-edit" style="width:100%;">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-CATEGORY">Category</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-category-edit" style="width:100%;" onchange="ResetCategory('edit')">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                            <?php foreach ($Category as $row) { ?>
                                                <option value="<?= $row['kategori'] ?>"><?= $row['kategori'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-BRAND">Brand</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-brand-edit" style="width:100%;">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SKU">SKU</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-sku_id-edit" style="width:100%;" onchange="GetBrandBySKUInduk(this.value,'edit')">
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-TOP">TOP</label> <label>(Hari)</label>
                                        <input type="text" id="PengaturanPiutangOutlet-top-edit" class="form-control text-right" name="PengaturanPiutangOutlet[top]" autocomplete="off" value="0">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-AKTIF">Aktif</label>
                                        <input type="checkbox" id="PengaturanPiutangOutlet-is_aktif-edit" name="PengaturanPiutangOutlet[is_aktif]" autocomplete="off" value="1">
                                    </div>
                                </div><br>
                            </div>
                        </div>
                        <div class="x_panel">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="x_content table-responsive">
                                        <button type="button" id="btn_tambah_list_pengaturan_piutang_outlet" class="btn btn-primary" onclick="TambahListPengaturanPiutangOutletKhusus('edit')"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHPENGATURANPIUTANGOUTLETKHUSUS">Tambah Pengaturan Piutang Outlet Khusus</span></button>
                                        <table id="table_pengaturan_piutang_outlet_khusus_edit" width="100%" class="table table-border table-bordered">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th class="text-center" style="color:white;"><span name="CAPTION-NO">No</span></th>
                                                    <th class="text-center" style="color:white;"><span name="CAPTION-OUTLET">Outlet</span></th>
                                                    <th class="text-center" style="color:white;"><span name="CAPTION-ACTION">Action</span></th>
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
                <span id="loadingPengaturanPiutangOutletadd" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" id="btn_update_pengaturan_piutang_outlet" class="btn btn-success"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN">Simpan</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger" onclick="ResetForm()"><i class="fa fa-sign-out"></i> <span name="CAPTION-CLOSE">Tutup</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_detail_client_pt_setting_piutang" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xlg" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><span name="CAPTION-222023000">Pengaturan Piutang Outlet</span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-client_wms_id-detail" style="width:100%;" disabled>
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                            <?php foreach ($Perusahaan as $key => $value) : ?>
                                                <option value="<?= $value['client_wms_id']; ?>"><?= $value['client_wms_nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" id="PengaturanPiutangOutlet-client_pt_setting_piutang_id-detail" class="form-control" name="PengaturanPiutangOutlet[client_pt_setting_piutang_id]" autocomplete="off" value="">
                                        <input type="hidden" id="PengaturanPiutangOutlet-updtgl-detail" class="form-control" name="PengaturanPiutangOutlet[updtgl]" autocomplete="off" value="">
                                        <input type="hidden" id="PengaturanPiutangOutlet-updwho-detail" class="form-control" name="PengaturanPiutangOutlet[updwho]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SEGMENT">Segment</label> <label>1</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-segment1-detail" style="width:100%;" disabled>
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SEGMENT">Segment</label> <label>2</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-segment2-detail" style="width:100%;" disabled>
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SEGMENT">Segment</label> <label>3</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-segment3-detail" style="width:100%;" disabled>
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-CATEGORY">Category</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-category-detail" style="width:100%;" disabled>
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                            <?php foreach ($Category as $row) { ?>
                                                <option value="<?= $row['kategori'] ?>"><?= $row['kategori'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-BRAND">Brand</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-brand-detail" style="width:100%;" disabled>
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-SKU">SKU</label>
                                        <select class="form-control select2" id="PengaturanPiutangOutlet-sku_id-detail" style="width:100%;" disabled>
                                            <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" name="CAPTION-TOP">TOP</label> <label>(Hari)</label>
                                        <input type="text" id="PengaturanPiutangOutlet-top-detail" class="form-control text-right" name="PengaturanPiutangOutlet[top]" autocomplete="off" value="0" disabled>
                                    </div>
                                </div><br>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label class="control-label" name="CAPTION-AKTIF">Aktif</label>
                                    <input type="checkbox" id="PengaturanPiutangOutlet-is_aktif-detail" name="PengaturanPiutangOutlet[is_aktif]" autocomplete="off" value="1" disabled>
                                </div>
                            </div><br>
                        </div>
                        <div class="x_panel">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="x_content table-responsive">
                                        <table id="table_pengaturan_piutang_outlet_khusus_detail" width="100%" class="table table-border table-bordered">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th class="text-center" style="color:white;"><span name="CAPTION-NO">No</span></th>
                                                    <th class="text-center" style="color:white;"><span name="CAPTION-OUTLET">Outlet</span></th>
                                                    <th class="text-center" style="color:white;"><span name="CAPTION-ACTION">Action</span></th>
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
                <span id="loadingPengaturanPiutangOutletadd" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" data-dismiss="modal" class="btn btn-danger" onclick="ResetForm()"><i class="fa fa-sign-out"></i> <span name="CAPTION-CLOSE">Tutup</span>
                </button>
            </div>
        </div>
    </div>
</div>