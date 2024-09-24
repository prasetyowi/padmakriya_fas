<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 name="CAPTION-PERENCANAAN&PERSIAPAN">Perencanaan & Persiapan</h3>
			</div>
			<div style="float: right">
				<a class="btn btn-primary btn-md" onclick="handlerNewDataPersiapanAndPerencanaan()"><i class="fas fa-plus"></i> <label name="CAPTION-TAMBAHDATA">Tambah Data</label></a>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel panel-default">
			<div class="panel-body form-horizontal form-label-left">
				<div class="row">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h3><strong><label name="CAPTION-FILTERDATA">Filter Data</label></strong></h3>
									<div class="clearfix"></div>
								</div>
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#tab-home"><span name="CAPTION-HOME">Home</span></a></li>
									<li><a data-toggle="tab" href="#tab-download"><span name="CAPTION-DOWNLOAD">Download</span></a></li>
								</ul>
								<div class="tab-content">
									<div id="tab-home" class="tab-pane fade in active">
										<div class="container mt-2">
											<div class="row">
												<div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label name="CAPTION-TAHUN">Tahun</label>
																<select class="form-control select2" name="vfiltertahun" id="vfiltertahun" required>
																	<option value="">--Pilih Tahun--</option>
																	<?php foreach ($rangeYear as $item) : ?>
																		<option value="<?php echo $item ?>" <?= ($item == date('Y') ? "selected" : "") ?>>
																			<?php echo $item ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label name="CAPTION-BULAN">Bulan</label>
																<select id="vfilterbulan" name="vfilterbulan" class="form-control select2">
																	<?php foreach ($rangeMonth as $key => $item) : ?>
																		<option value="<?php echo $key ?>" <?= ($key == date('m') ? "selected" : "") ?>>
																			<?php echo $item ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>

												<div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
													<div class="form-group">
														<label name="CAPTION-TIPESTOCKOPNAME">Tipe Stock</label>
														<select name="vfilterstatus" id="vfilterstatus" class="form-control select2">
															<option value=""><label name="CAPTION-ALL">All</label></option>
															<option value="Draft"><label>Draft</label></option>
															<option value="In Progress Approval"><label>In Progress Approval</label></option>
															<option value="Approved"><label>Approved</label></option>
															<option value="In Progress Item Request"><label>In Progress Item Request</label></option>
															<option value="In Progress Picking Item"><label>In Progress Picking Item</label></option>
															<option value="Picking Item Confirmed"><label>Picking Item Confirmed</label></option>
															<option value="In Transit"><label>In Transit</label></option>
															<option value="In Progress Closing"><label>In Progress Closing</label></option>
															<option value="Settlement Completed"><label>Settlement Completed</label></option>
														</select>
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
													<div class="form-group">
														<label name="CAPTION-PERUSAHAAN">Perusahaan</label>
														<select id="vperusahaan" class="form-control select2">
															<option value="">-- <label name="CAPTION-PERUSAHAAN">
																	Perusahaan</label> --</option>
															<?php foreach ($Perusahaan as $key => $value) { ?>
																<option value="<?= $value['client_wms_id'] ?>" data-kode="<?= $value['client_wms_id'] ?>">
																	<?= $value['client_wms_nama'] ?>
																</option>
															<?php } ?>
														</select>
													</div>
												</div>
											</div>
											<div class="item form-group">
												<button class="btn btn-primary" id="btnsearchdata" onclick="handlerFilterData()"><i class="fas fa-search"></i> <label name="CAPTION-FILTER">Filter</label></button>
												<span id="loadingsearch" style="display:none;"><i class="fa fa-spinner fa-spin"></i> <label name="CAPTION-LOADING">Loading</label>...</span>
												<!-- <button class="btn btn-danger" id="clear-storage"><i class="fas fa-trash"></i> Clear Storage</button> -->
											</div>
										</div>
									</div>
									<div id="tab-download" class="tab-pane fade">
										<div class="container mt-2">
											<div class="row">
												<div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
													<div class="form-group">
														<label name="CAPTION-TANGGAL">Tanggal</label>
														<input type="text" id="filter_tgl_request" class="form-control" name="filter_tgl_request" value="" />
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
													<div class="form-group">
														<label name="CAPTION-PERUSAHAAN">Perusahaan</label>
														<select id="filter_perusahaan" name="filter_perusahaan" class="form-control select2">
															<option value="">-- <label name="CAPTION-PERUSAHAAN">
																	Perusahaan</label> --</option>
															<?php foreach ($Perusahaan as $key => $value) { ?>
																<option value="<?= $value['client_wms_id'] ?>" data-kode="<?= $value['client_wms_id'] ?>">
																	<?= $value['client_wms_nama'] ?>
																</option>
															<?php } ?>
														</select>
													</div>
												</div>
											</div>
											<div class="item form-group">
												<span id="loadingdownload" style="display:none;"><i class="fa fa-spinner fa-spin"></i> <label name="CAPTION-LOADING">Loading</label>...</span>
												<button class="btn btn-primary" id="btndownloadpb"><i class="fas fa-download"></i> <span name="CAPTION-DOWNLOAD">Download</span></button>
												<!-- <button class="btn btn-danger" id="clear-storage"><i class="fas fa-trash"></i> Clear Storage</button> -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="list-data-form-search">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="container mt-2">
						<div class="row">
							<div class="x_content table-responsive">
								<table id="listperencanaanpersiapan" width="100%" class="table table-striped">
									<thead>
										<tr>
											<!-- <th width="5%" class="text-center">#</th> -->
											<th widtd="7%" class="text-center"><label name="CAPTION-NO">NO</label></th>
											<th widtd="15%" class="text-center"><label name="CAPTION-KODEDOKUMEN">Kode Dokumen</label></th>
											<th widtd="15%" class="text-center"><label name="CAPTION-PERUSAHAAN">Perusahaan</label></th>
											<th widtd="15%" class="text-center"><label name="CAPTION-PRINCIPLE">Principle</label></th>
											<th widtd="15%" class="text-center"><label name="CAPTION-TANGGAL">Tanggal</label></th>
											<th widtd="15%" class="text-center"><label name="CAPTION-TANGGALMULAI">Tanggal Mulai</label></th>
											<th widtd="15%" class="text-center"><label name="CAPTION-TANGGALAKHIR">Tanggal Akhir</label></th>
											<th widtd="15%" class="text-center"><label name="CAPTION-SALES">Sales</label></th>
											<th widtd="15%" class="text-center"><label name="CAPTION-AREA">Area</label></th>
											<th widtd="18%" class="text-center"><label name="CAPTION-CANVASREFFKODE">Canvas Reff Kode</label></th>
											<th widtd="18%" class="text-center"><label name="CAPTION-ISDOWNLOAD">Is Download</label></th>
											<th widtd="18%" class="text-center"><label name="CAPTION-STATUS">Status</label></th>
											<th widtd="10%" class="text-center"><label name="CAPTION-ACTION">Action</label></th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>