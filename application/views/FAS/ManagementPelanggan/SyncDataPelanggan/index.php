<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span name="CAPTION-222020000">Sync Data Pelanggan</span></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- <div class="panel panel-default">
            <div class="panel-heading"><label>Filter</label></div>
            <div class="panel-body form-horizontal form-label-left">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-form-label col-md-2 col-sm-2 label-align" name="CAPTION-SISTEMEKSTERNAL">Sistem Eksternal</label>
                            <div class="col-md-6 col-sm-6">
                                <select id="filter_perusahaan" class="form-control select2" style="width:100%">
                                    <option value=""><span name="CAPTION-PILIH">** Pilih **</span></option>
                                    <?php foreach ($Sistem as $row) : ?>
                                        <option value="<?= $row['sistemeksternal_nama']; ?>"><?= $row['sistemeksternal_nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="loadingviewindex" style="display:none;"><i class="fa fa-spinner fa-spin"></i> <label name="CAPTION-LOADING">Loading</label>...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="panel panel-default">
            <div class="panel-body form-horizontal form-label-left">
                <div class="row">
                    <table id="tablesyncpelanggan" width="100%" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"><span name="CAPTION-SISTEMEKSTERNAL">Sistem Eksternal</span></th>
                                <th class="text-center"><span name="CAPTION-JUMLAHSISTEMEKSTERNAL">Jumlah Sistem Eksternal</span></th>
                                <th class="text-center"><span name="CAPTION-JUMLAHSISTEMInternal">Jumlah Sistem Internal</span></th>
                                <th class="text-center"><span name="CAPTION-STATUS">Status</span></th>
                                <th class="text-center"><span name="CAPTION-Action">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Sistem as $i => $row) : ?>
                                <tr>
                                    <td class="text-center"><?= $row['sistemeksternal_nama']; ?></td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary" id="loadingview_<?= $i ?>" style="display:none;" disabled><i class="fa fa-refresh fa-spin"></i></button>
                                        <!-- <span id="loadingview_<?= $i ?>" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span> -->
                                        <button type="button" class="btn btn-primary btnsync" id="btnsync_<?= $i ?>" onclick="SyncCustomer('<?= $i ?>','<?= $row['sistemeksternal_nama'] ?>')"><i class="fa fa-refresh"></i></button>
                                    </td>
                                <tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalcustomerprinciple" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><label name="CAPTION-OUTLET">Outlet</label></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-4">
                                <label name="CAPTION-OUTLET">Outlet</label>
                                <input readonly="readonly" type="hidden" id="filter-client_pt_id" class="form-control" value="">
                            </div>
                            <div class="col-xs-4">
                                <label name="CAPTION-ALAMATOUTLET">Alamat</label>
                            </div>
                            <div class="col-xs-4">
                                <label name="CAPTION-TELP">Telepon</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <span id="filter-client_pt_nama"></span>
                            </div>
                            <div class="col-xs-4">
                                <span id="filter-client_pt_alamat"></span>
                            </div>
                            <div class="col-xs-4">
                                <span id="filter-client_pt_telepon"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <label name="CAPTION-SISTEMEKSTERNAL">Sistem Eksternal</label>
                                <select id="filter-slc_sistem_eksternal" class="selectpicker form-control" name="filter[slc_sistem_eksternal]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select System">
                                    <?php foreach ($Sistem as $row) : ?>
                                        <option value="<?= $row['sistemeksternal_nama']; ?>"><?= $row['sistemeksternal_nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br><br>
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped" id="tablecustomerprinciple">
                            <thead>
                                <tr class="bg-primary">
                                    <th style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-SISTEMEKSTERNAL">Sistem Eksternal</th>
                                    <th style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-PRINCIPLE">Principle</th>
                                    <th style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-CUSTOMERIDBOSNET">Customer ID Eksternal</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingviewprinciple" style="display:none;"><i class="fa fa-spinner fa-spin"></i><label name="CAPTION-LOADING">Loading</label>...</span>
                <button type="button" class="btn btn-info" id="btnsavecustomerprinciple"><label name="CAPTION-SIMPAN">Simpan</label></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger"><label name="CAPTION-TUTUP">Tutup</label></button>
            </div>
        </div>
    </div>
</div>

<span name="CAPTION-ALERT-DATABERHASILDISIMPAN" style="display: none;">Data Berhasil Disimpan</span>
<span name="CAPTION-ALERT-CHECKCUSTOMEREKSTERNAL" style="display: none;">Customer Eksternal Kosong</span>
<span name="CAPTION-ALERT-DATAGAGALDISIMPAN" style="display: none;">Data Gagal Disimpan</span>