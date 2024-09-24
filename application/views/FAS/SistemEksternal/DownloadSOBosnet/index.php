<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Menu Unduh SO Eksternal</h3>
			</div>


		</div>

		<div class="clearfix"></div>


		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">

						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="col-md-2 col-sm-12">
							<input type="text" id="datesobosnet" class="form-control datepicker" value="" style="width: 100%;" />
						</div>
						<div class="col-md-2 col-sm-12">
							<select name="filter_perusahaan" class="form-control select2" id="perusahaan" style="width:100%;" onchange="GetPrincipleByPerusahaan()">
								<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
								<?php foreach ($Perusahaan as $row) : ?>
									<option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-2 col-sm-12">
							<select name="filter_perusahaan" class="form-control select2" id="principle" style="width:100%;">
								<option value="">** <span name="CAPTION-PILIH">Pilih</span> **</option>
							</select>
						</div>
						<div class="col-md-2 col-sm-12">
							<select name="filter_principle" class="form-control select2" id="status_sync" style="width:100%;">
								<option value="">** <span name="CAPTION-SEMUA">Semua</span> **</option>
								<option value="1">Sync</option>
								<option value="0">Not Sync</option>
							</select>
						</div>
						<div class="col-md-2 col-sm-12">
							<select name="filter_principle" class="form-control select2" id="tipe_so" style="width:100%;">
								<option value="">** <span name="CAPTION-SEMUA">Semua</span> **</option>
								<option value="OPE">OPE</option>
								<option value="CLO">CLO</option>
							</select>
						</div>
						<div class="col-md-2 col-sm-12">
							<select name="filter_principle" class="form-control select2" id="tipe_do" style="width:100%;">
								<option value="">** <span name="CAPTION-SEMUA">Semua</span> **</option>
								<option value="DO_DRAFT">Draft</option>
								<option value="DO_TIDAK_ADA">Belum Ada DO</option>
								<option value="DO_TERKIRIM">DO Terkirim</option>
							</select>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<button type="button" id="btnsavesobosnet" class="btn btn-success"><i class="fa fa-download"></i> Unduh SO By DO Draft</button>
							<!-- <button type="button" id="btnsavesobosnetwithoutdo" class="btn btn-success"><i class="fa fa-download"></i> Download SO</button> -->
							<button type="button" id="btngenerateso" class="btn btn-warning"><i class="fa fa-save"></i> Generate</button>
							<button type="button" id="btnrefreshsobosnet" class="btn btn-primary"><i class="fa fa-refresh"></i> Refresh</button>
							<button type="button" id="btnsyncalloutlet" class="btn btn-success"><i class="fa fa-refresh"></i> Sync All Outlet</button>
							<button type="button" id="btnsyncallsales" class="btn btn-success"><i class="fa fa-refresh"></i> Sync All Sales</button>
							<button type="button" id="btnsyncallarea" class="btn btn-success"><i class="fa fa-refresh"></i> Update Area</button>
							<button class="btn-submit btn btn-primary" id="btnerrormsg" onclick="ErrorMsgSO()"><i class="fa fa-message"></i> <span name="CAPTION-PESANERRORGENERATESALESORDER">Pesan Error Generate Sales Order</span> (<span id="CAPTION-JUMLAHERRORMSG">0</span>)</button>
							<span id="loadingview" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
						</div>
					</div>
					<div class="clearfix"></div><br>
					<div class="row">
						<div class="container">
							<ul class="nav nav-tabs">
								<li><a data-toggle="tab" href="#panel-in-fas">In FAS</a></li>
								<li class="active"><a data-toggle="tab" href="#panel-not-in-fas">Not In FAS</a></li>
							</ul>
							<div class="clearfix"></div><br>
							<div class="tab-content">
								<div id="panel-in-fas" class="tab-pane fade">
									<table id="table-so-bosnet-in-fas" width="100%" class="table table-striped">
										<thead>
											<tr>
												<!-- <th><input type="checkbox" name="select-all-so-bosnet" id="select-all-so-bosnet" value="1"> PILIH</th> -->
												<th class="text-center" name="CAPTION-SO">SO</th>
												<th class="text-center" name="CAPTION-TANGGAL">Tanggal SO</th>
												<th class="text-center" name="CAPTION-OUTLET">Outlet</th>
												<th class="text-center" name="CAPTION-PRINCIPLE">Principle</th>
												<th class="text-center" name="CAPTION-SALES">Sales</th>
												<th class="text-center" name="CAPTION-JUMLAH">Value(Rp.)</th>
											</tr>
										</thead>
										<tbody>

										</tbody>
									</table>
								</div>
								<div id="panel-not-in-fas" class="tab-pane fade in active">
									<table id="table-so-bosnet-not-in-fas" width="100%" class="table table-striped">
										<thead>
											<tr>
												<!-- <th><input type="checkbox" name="select-all-so-bosnet" id="select-all-so-bosnet" value="1"> PILIH</th> -->
												<th class="text-center" name="CAPTION-SO">SO</th>
												<th class="text-center" name="CAPTION-TANGGAL">Tanggal SO</th>
												<th class="text-center" name="CAPTION-OUTLET">Outlet</th>
												<th class="text-center" name="CAPTION-SALES">Sales</th>
												<th class="text-center" name="CAPTION-JUMLAH">Value(Rp.)</th>
												<th class="text-center" name="CAPTION-STATUSOUTLET"><input type="checkbox" name="select-sync-all-customer" id="select-sync-all-customer" value="1"> Status Outlet</th>
												<th class="text-center" name="CAPTION-STATUSSALES"><input type="checkbox" name="select-sync-all-sales" id="select-sync-all-sales" value="1"> Status Sales</th>
												<th class="text-center" name="CAPTION-STATUSAREA"><input type="checkbox" name="select-sync-all-area" id="select-sync-all-area" value="1"> Status Area</th>
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
</div>

<div class="modal fade" id="modal-pesan-error" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" style="width: 80%;">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label name="CAPTION-PESANERRORGENERATESALESORDER">Pesan Error Generate Sales Order</label></h4>
			</div>
			<div class="modal-body">
				<div class="row" id="panel-sku">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<table class="table table-bordered" id="table-pesan-error" style="width:100%;">
								<thead>
									<tr class="bg-primary">
										<th style="text-align: center; vertical-align: middle;color:white;">#</th>
										<th style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-KODEERROR">Kode Error</th>
										<th style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-PESANERROR">Pesan Error</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> <span name="CAPTION-TUTUP">Tutup</span></button>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<!-- <span name="CAPTION-ALERT-DATABERHASILDISIMPAN" style="display: none;">Data Berhasil Disimpan</span> -->

<span name="CAPTION-ALERT-MAPPINGSALESEKSTERNALNOTFOUND" style="display: none;">MAPPINGSALESEKSTERNALNOTFOUND</span>
<span name="CAPTION-ALERT-MAPPINGCUSTOMEREKSTERNALNOTFOUND" style="display: none;">MAPPINGCUSTOMEREKSTERNALNOTFOUND</span>
<span name="CAPTION-ALERT-SKUSTOCKNOTFOUND" style="display: none;">SKUSTOCKNOTFOUND</span>
<span name="CAPTION-ALERT-SOMESOEKSTERNALCANNOTBEGENERATED" style="display: none;">SOMESOEKSTERNALCANNOTBEGENERATED</span>
<span name="CAPTION-ALERT-SOMESOFASCANNOTBEGENERATED" style="display: none;">SOMESOFASCANNOTBEGENERATED</span>
<span name="CAPTION-ALERT-GENERATEDSOEKSTERNALSUCCESS" style="display: none;">GENERATEDSOEKSTERNALSUCCESS</span>
<span name="CAPTION-ALERT-GENERATEDSOFASSUCCESS" style="display: none;">GENERATEDSOFASSUCCESS</span>
<span name="CAPTION-ALERT-GENERATEDSOEKSTERNALFAILED" style="display: none;">GENERATEDSOEKSTERNALFAILED</span>