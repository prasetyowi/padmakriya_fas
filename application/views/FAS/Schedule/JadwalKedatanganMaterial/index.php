<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 name="CAPTION-217402000">Jadwal Kedatangan Material</h3>
            </div>
            <div style="float: right">
                <?php if ($Menu_Access["C"] == 1) : ?>
                    <a href="<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/create') ?>" class="btn btn-primary" target="_blank"><i class="fa fa-plus"></i> <span name="CAPTION-BARU">Baru</span></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4>Filter Data</h4>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-4">
                                <label name="CAPTION-TANGGAL">Tahun</label>
                                <input type="text" id="filter_tahun" class="form-control" name="filter_tahun" value="<?= date('Y') ?>" />
                            </div>
                            <div class="col-xs-4">
                                <label for="TrKedatangan Material-client_wms_id" class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                <select id="filter_perusahaan" class="form-control select2" name="filter_perusahaan">
                                    <option value="">** <span name="CAPTION-SEMUA">Semua</span> **</option>
                                    <?php foreach ($Perusahaan as $row) : ?>
                                        <option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <label for="TrKedatangan Material-client_wms_id" class="control-label" name="CAPTION-STATUS">Status</label>
                                <select id="filter_status" class="form-control select2" name="filter_status">
                                    <option value="">** <span name="CAPTION-SEMUA">Semua</span> **</option>
                                    <option value="Draft">Draft</option>
                                    <option value="Laksanakan">Laksanakan</option>
                                    <option value="Canceled">Canceled</option>
                                </select>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-12">
                                <span id="loadingviewdodraft" style="display:none;"><i class="fa fa-spinner fa-spin"></i> <span name="CAPTION-LOADING">Loading</span>...</span>
                                <button type="button" id="btn_search_production_schedule" class="btn btn-primary" onclick="Get_production_schedule_by_filter()"><i class="fa fa-search"></i> <span name="CAPTION-CARI">Cari</span></button>
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
                        <div class="col-xs-12">
                            <div class="x_content table-responsive">
                                <table id="table_list_production_schedule" width="100%" class="table table-bordered table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th class="text-center" style="text-align: center; vertical-align: middle;color:white;">#</th>
                                            <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-TAHUN">Tahun</span></th>
                                            <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-PERUSAHAAN">Perusahaan</span></th>
                                            <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-PRINCIPLE">Principle</span></th>
                                            <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-KODEKEDATANGANMATERIAL">Kode Kedatangan Material</span></th>
                                            <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-STATUS">Status</span></th>
                                            <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-ACTION">Action</span></th>
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
</div>

<div class="modal fade" id="modal_detail_jadwal_kedatangan_material" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:90%">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title-detail pull-left">Detail Jadwal Kedatangan Material</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="container mt-2">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <label class="control-label col-xs-4" name="CAPTION-TAHUN">Tahun</label>
                                    <label class="control-label col-xs-2">:</label>
                                    <label class="control-label col-xs-6"><span id="filter_tahun_detail"></label>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <label class="control-label col-xs-4" name="CAPTION-KODE">Kode</label>
                                    <label class="control-label col-xs-2">:</label>
                                    <label class="control-label col-xs-6"><span id="filter_kode_detail"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <label class="control-label col-xs-4" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                    <label class="control-label col-xs-2">:</label>
                                    <label class="control-label col-xs-6"><span id="filter_perusahaan_detail"></label>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <label class="control-label col-xs-4" name="CAPTION-PRINCIPLE">Principle</label>
                                    <label class="control-label col-xs-2">:</label>
                                    <label class="control-label col-xs-6"><span id="filter_principle_detail"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="x_content table-responsive">
                                    <table id="table_production_schedule_detail" width="100%" class="table table-bordered">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;">#</th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-SKU">SKU</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-SKUSATUAN">SKU Satuan</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-JAN">Jan</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-FEB">Feb</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-MAR">Mar</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-Apr">Apr</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-MAY">May</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-JUN">Jun</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-JUL">Jul</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-AUG">Aug</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-SEP">Sep</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-OCT">Oct</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-NOV">Nov</span></th>
                                                <th class="text-center" style="text-align: center; vertical-align: middle;color:white;"><span name="CAPTION-DEC">Dec</span></th>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-sign-out"></i> <span name="CAPTION-TUTUP">Tutup</span></button>
            </div>
        </div>
    </div>

</div>