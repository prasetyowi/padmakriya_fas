<style>
.custom-checkbox-input {
    position: relative;
    z-index: 1;
    display: block;
    min-height: 1.5rem;
    padding-left: 1.5rem;
}

.custom-checkbox-input .form-check-input {
    width: 20px;
    height: 20px;
}

.custom-checkbox-input .form-check-input::after {
    content: '';
    display: inline-block;
    width: 20px;
    height: 20px;
    border: solid 1px grey;
    border-radius: 2px;
}

.custom-checkbox-input .form-check-input-acc {
    width: 20px;
    height: 20px;
}

.custom-checkbox-input .form-check-input-acc::after {
    content: '';
    display: inline-block;
    width: 20px;
    height: 20px;
    border: solid 1px grey;
    border-radius: 2px;
}

.custom-checkbox-input .form-check-input:checked::after {
    width: 20px;
    height: 20px;
    border: solid 1px red;
    content: 'X';
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    background-color: red;
    color: white;
    text-align: center;
    font-size: 13px;
    position: relative;
    top: 0px;

}

.custom-checkbox-input .form-check-input-acc:checked::after {
    width: 20px;
    height: 20px;
    border: solid 1px lightgreen;
    content: '\f00c';
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    background-color: lightgreen;
    color: white;
    text-align: center;
    font-size: 13px;
    position: relative;
    top: 0px;

}

.custom-checkbox-input .form-check-input .custom-color-grey::after {
    background-color: grey;
}

.custom-checkbox-input .form-check-input .custom-color-white::after {
    background-color: white;
}

.custom-checkbox-input .form-check-input-acc .custom-color-white::after {
    background-color: white;
}
</style>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><label id="lbtitleoutlet"></label></h3>
            </div>


            <!--div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" align="right">
                    <div class="digital-clock">Loading... <i class="fa fa-spinner fa-spin"></i></div>
                </div>
            </div-->
        </div>
        <div class="clearfix"></div>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <label ame="CAPTION-PERUSAHAAN">Perusahaan</label>
                <select class="form-control select2" name="filter_perusahaan" id="filter_perusahaan">
                    <?php foreach ($Perusahaan as $row) : ?>
                    <option value="<?= $row['client_wms_id'] ?>">
                        <?= $row['client_wms_nama'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <label name="CAPTION-FILTERTANGGALSTATUS">Filter Tanggal Status</label>
                <input type="text" id="filter_tgl" class="form-control datepicker" name="filter_tgl"
                    autocomplete="off" />
            </div>
        </div>
        <!-- <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h5 name="CAPTION-PENCARIANBYPERUSAHAAN">Pencarian By Perusahaan</h5>
					</div>
					<div class="x_content">
						<form id="form-filter-do" class="form-horizontal form-label-left">
							<div class="row">
								<div class="col-lg-6 col-md-4 col-sm-4">

									<div class="item form-group">
										<label class="col-form-label col-md-6 col-sm-6 label-align" name="CAPTION-PERUSAHAAN">Perusahaan</label>
										<div class="col-md-6 col-sm-6">
											<select class="form-control select2" name="filter_perusahaan" id="filter_perusahaan" required>
												<?php foreach ($Perusahaan as $row) : ?>
													<option value="<?= $row['client_wms_id'] ?>">
														<?= $row['client_wms_nama'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>

								<div class="item form-group">
									<div class="col-md-12 col-sm-12 text-left">
										<a class="btn btn-md btn-primary btn-submit-filter" onclick="getOutstandingApproval()" name="CAPTION-CARI">Cari</a>
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div> -->
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="row ro-batch" id="do-table">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h5 name="CAPTION-OUTSTANDINGAPPROVAL">Outstanding Approval</h5>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="tableApproval" width="100%" class="table">
                                        <thead>
                                            <tr>
                                                <th name="CAPTION-NO">No</th>
                                                <th name="CAPTION-JENISPENGAJUAN">Jenis Pengajuan</th>
                                                <th name="CAPTION-JUMLAH">Jumlah</th>
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
            <div class="col-lg-2 col-md-2 col-sm-6">
                <div class="tile-stats">
                    <div class="icon">
                        <i class="fas fa-list text-warning"></i>
                    </div>
                    <div class="count" id="so"></div>

                    <h3>SO</h3>
                    <p>Jumlah SO yang masuk</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6">
                <div class="tile-stats">
                    <div class="icon">
                        <i class="fas fa-check text-success"></i>
                    </div>
                    <div class="count" id="apprv"></div>

                    <h3>Approved</h3>
                    <p>Jumlah SO yang sudah disetujui</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6">
                <div class=" tile-stats">
                    <div class="icon">
                        <i class="fas fa-clock text-danger"></i>
                    </div>
                    <div class="count" id="pndg"></div>

                    <h3>Pending</h3>
                    <p>Jumlah SO yang belum disetujui</p>
                </div>
            </div>
        </div>

        <div class="row">

        </div>

    </div>
</div>
</div>

<!-- /page content -->

<!-- modal view approval-->
<div class="modal fade" id="modalApproval" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width: 90%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title"><label name="CAPTION-CAPTION-LISTAPPROVAL">List Approval</label></h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="table-responsive">
                        <table id="tableDetailApproval" style="width:100%"
                            class="table table-hover  table-primary table-bordered ">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" name="CAPTION-NO">No</th>
                                    <th style="text-align: center;" name="CAPTION-JENISPENGAJUAN">Jenis Pengajuan</th>
                                    <th style="text-align: center;" name="CAPTION-TGLPENGAJUAN">Tgl Pengajuan</th>
                                    <th style="text-align: center;" name="CAPTION-DIAJUKANOLEH">Diajukan Oleh</th>
                                    <th style="text-align: center;" name="CAPTION-NODOKUMEN">No Dokumen</th>
                                    <th style="text-align: center;" name="CAPTION-HISTORYAPPROVAL">History approval</th>
                                    <th style="text-align: center;" name="CAPTION-Y">Y</th>
                                    <th style="text-align: center;" name="CAPTION-N">N</th>
                                    <th style="text-align: center;" name="CAPTION-NOTE">Note</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="saveApproval"><i class="fas fa-floppy-disk"></i>
                    <label name="CAPTION-SAVE">Simpan</label></button>
                <button type="button" class="btn btn-dark btnclosemodalbuatpackingdo" data-dismiss="modal"><i
                        class="fas fa-xmark"></i> <label name="CAPTION-TUTUP">Tutup</label></button>

            </div>




        </div>
    </div>
</div>
<!-- modal history approval-->
<div class="modal fade" id="modalHistoryApproval" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width: 80%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title"><label name="CAPTION-HISTORYAPPROVAL">History Approval</label></h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="table-responsive">
                        <table id="tableHistoryApproval" style="width:100%"
                            class="table table-hover  table-primary table-bordered ">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" name="CAPTION-NO">No</th>
                                    <th style="text-align: center;" name="CAPTION-JENISPENGAJUAN">Jenis Pengajuan</th>
                                    <th style="text-align: center;" name="CAPTION-TGLAPPROVAL">Tgl Approval</th>
                                    <th style="text-align: center;" name="CAPTION-NODOKUMEN">No Dokumen</th>
                                    <th style="text-align: center;" name="CAPTION-STATUS">Status</th>
                                    <th style="text-align: center;" name="CAPTION-OLEH">Oleh</th>
                                    <th style="text-align: center;" name="CAPTION-NOTE">Note</th>
                                    <th style="text-align: center;" name="CAPTION-GROUP">Group</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-dark btnclosemodalbuatpackingdo" data-dismiss="modal"><i
                        class="fas fa-xmark"></i> <label name="CAPTION-TUTUP">Tutup</label></button>

            </div>














        </div>
    </div>
</div>