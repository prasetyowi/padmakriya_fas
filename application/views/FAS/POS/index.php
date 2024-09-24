<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Point Of Sales</h3>
            </div>
            <div style="float: right">
                <?php if ($Menu_Access["C"] == 1) : ?>
                    <a href="<?= base_url('FAS/POS/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i><span name="CAPTION-BUATBARU">Buat Baru</span></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label name="CAPTION-TANGGALSO">Tanggal SO</label>
                                <input type="text" id="filter-so-date" class="form-control" name="filter_so_date" value="" />
                                <input type="hidden" id="jml_so" class="form-control" value="0" />
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-TANGGALKIRIM">Tanggal KIRIM</label>
                                <input type="date" id="filter-so-date-kirim" class="form-control" name="filter_so_date-kirim" value="" />
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-NOSO">No. SO</label>
                                <input type="text" id="filter-so-number" class="form-control" name="filter_so_number" value="">
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-TIPE">Tipe</label>
                                <select id="filter-tipe" name="filter_tipe" class="form-control">
                                    <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                                    <?php foreach ($TipeSalesOrder as $key => $value) : ?>
                                        <option value="<?= $value['tipe_sales_order_id'] ?>">
                                            <?= $value['tipe_sales_order_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-3">
                                <label name="CAPTION-STATUS">Status</label>
                                <select id="filter-status" name="filter_status" class="form-control">
                                    <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                                    <option value="Draft">Draft</option>
                                    <option value="In Progress Approval">In Progress Approval</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-PERUSAHAAN">Perusahaan</label>
                                <select id="filter-perusahaan" class="input-sm form-control select2" name="filter-perusahaan" onchange="getPrinciple(this.value)">
                                    <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                                    <?php foreach ($Perusahaan as $row) : ?>
                                        <option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-PRINCIPLE">Principle</label>
                                <select id="filter-principle" class="input-sm form-control select2" name="filter-principle">
                                    <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-SALES">Sales</label>
                                <select id="filter-sales" class="input-sm form-control select2" name="filter-sales">
                                    <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                                    <?php foreach ($Sales as $row) : ?>
                                        <option value="<?= $row['karyawan_id'] ?>"><?= $row['karyawan_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label name="CAPTION-PRIORITY">Prioritas</label>
                                <select id="filter-priority" class="input-sm form-control select2" name="filter-priority">
                                    <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                                    <option value="1">Tampilkan yg prioritas</option>
                                    <option value="0">Tampilkan yg bukan prioritas</option>
                                </select>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-12">
                                <span id="loadingviewso" style="display:none;"><i class="fa fa-spinner fa-spin"></i>
                                    Loading...</span>
                                <button type="button" id="btn-search-data-so" class="btn btn-success"><i class="fa fa-search"></i> <span name="CAPTION-CARI">Cari</span></button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="x_content table-responsive">
                                <table id="table_list_data_so" width="100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th class="text-center" style="color:white;">#</th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-TANGGALORDER">Tanggal Order</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-NOORDER">No Order</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-STATUS">Status</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-TIPE">Tipe</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-TIPEPENGIRIMAN">Tipe Pengiriman</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-NAMAPENERIMA">Nama Penerima</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-ALAMATPENERIMA">Alamat Penerima</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-TELPPENERIMA">Telp Penerima</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-TOTALAKHIR">Total Akhir</span></th>
                                            <th class="text-center" style="color:white;"><span name="CAPTION-TOTALPEMBAYARAN">Total Pembayaran</span></th>
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
</div>

<div class="modal fade" id="modalEditDataSO" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:80%">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Edit Data SO</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label name="CAPTION-TANGGALSO">Tanggal SO</label>
                                <input type="text" id="filter-so-date-edit" class="form-control" name="filter-so-date-edit" value="" />
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <label name="CAPTION-NOSO">No. SO</label>
                            <input type="text" id="filter-so-number-edit" class="form-control" name="filter-so-number-edit" value="">
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label name="CAPTION-PERUSAHAAN">Perusahaan</label> <br>
                                <select id="filter-perusahaan-edit" class="input-sm form-control select2" name="filter-perusahaan-edit" style="width: 100%;" onchange="getPrincipleEdit(this.value)">
                                    <option value=""><label name=" CAPTION-SEMUA">Semua</label></option>
                                    <?php foreach ($Perusahaan as $row) : ?>
                                        <option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label name="CAPTION-PRINCIPLE">Principle</label> <br>
                                <select id="filter-principle-edit" class="input-sm form-control select2" name="filter-principle-edit" style="width: 100%;">
                                    <option value=""><label name=" CAPTION-SEMUA">Semua</label></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <label name="CAPTION-STATUS">Status</label>
                            <select id="filter-status-edit" name="filter-status-edit" class="form-control" style="width: 100%;">
                                <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                                <?php foreach ($status as $data) { ?>
                                    <option value="<?= $data['sales_order_status'] ?>"><?= $data['sales_order_status'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <label name="CAPTION-TIPE">Tipe</label>
                            <select id="filter-tipe-edit" name="filter-tipe-edit" class="form-control" style="width: 100%;">
                                <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                                <?php foreach ($tipe as $data) { ?>
                                    <option value="<?= $data['tipe_sales_order_id'] ?>">
                                        <?= $data['tipe_sales_order_nama'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <label name="CAPTION-SALES">Sales</label>
                            <select id="filter-sales-edit" class="input-sm form-control select2" name="filter-sales-edit" style="width: 100%;">
                                <option value=""><label name="CAPTION-SEMUA">Semua</label></option>
                                <?php foreach ($Sales as $row) : ?>
                                    <option value="<?= $row['karyawan_id'] ?>"><?= $row['karyawan_nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <span style="float: right; display: none;" id="loadingviewsoedit"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                            <button style="margin-top: 2.5rem;" class="btn btn-primary" onclick="handlerDataSearchEditSO()"><i class="fas fa-search"></i> <label name="CAPTION-CARI">Cari</label></button>
                        </div>
                        <!-- <div class="col-md-12"> -->
                        <!-- <div class="col-md-2" style="float: right; margin-top: 1rem;">
                            <span style="float: right; display:none;" id="loadingviewsoedit"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                            <button style="float: right;" class="btn btn-primary" onclick="handlerDataSearchEditSO()"><i class="fas fa-search"></i> <label name="CAPTION-CARI">Cari</label></button>
                        </div> -->
                        <!-- </div> -->

                        <div class="col-md-12" style="display: none;" id="fieldChangeFormEditModal">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label name="CAPTION-GANTIAKTUALTGLKIRIM">Ganti Tanggal Kirim Untuk
                                            Semua</label>
                                        <input type="date" onchange="setTanggal(this)" name="allChangeTglKirim" id="allChangeTglKirim" class="form-control" value="<?= date('Y-m-d') ?>"">
									</div>
								</div>
								<div class=" col-md-3">
                                        <!-- <div class="form-group">
                                            <label name="CAPTION-GANTITIPE">Ganti Tipe Untuk Semua</label> <br>
                                            <select onchange="setTipe(this)" name="tipe_sales_order_id_edit" class="input-sm form-control select2" id="tipe_sales_order_id_edit" style="width: 100%;">
                                                <option value="">** <label name="CAPTION-TIPESO">Tipe SO</label> **
                                                </option>
                                                <?php foreach ($TipeSalesOrder as $type) : ?>
                                                    <option value="<?= $type['tipe_sales_order_id'] ?>">
                                                        <?= $type['tipe_sales_order_nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="tableDataSOEdit">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>
                                            <input type="checkbox" onchange="checkAllSJ(this)" id="check-all-pilih-so" style="transform: scale(1)" class="form-control" />
                                        </th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-NOSO">No. SO</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-NOPO">No. PO</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-CUSTOMER">Customer</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-SALES">Sales</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-PERUSAHAAN">Perusahaan</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-PRINCIPLE">Principle</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-ALAMAT">Alamat</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-TANGGALKIRIM">Tanggal Kirim</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-TIPE">Tipe</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-NOMINALSO">Nominal SO</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-UPDATETANGGALKIRIM">Update Tanggal
                                                    Kirim</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-UPDATETIPE">Update Tipe</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-PRIORITY">Prioritas</label></strong></th>
                                        <th class="text-center" style="color:white;"><strong><label name="CAPTION-KETERANGAN">Keterangan</label></strong></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="handlerSaveEditSO()"><i class="fas fa-save"></i> <label name="CAPTION-SAVE">Simpan</label></button>
                    <button type="button" class="btn btn-dark" onclick="handlerCloseEditSO()"><i class="fas fa-xmark"></i> <label name="CAPTION-TUTUP">Tutup</label></button>
                </div>
            </div>
        </div>
    </div>