<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 name="CAPTION-217402000">Jadwal Kedatangan Material</h3>
			</div>
			<div style="float: right">
			</div>
		</div>
		<?php foreach ($Header as $header) : ?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<div class="clearfix"></div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group field-ProductionShedule-production_schedule_kode">
									<label class="control-label" name="CAPTION-NOSURATJALAN">No. Surat Jalan</label>
									<input readonly="readonly" type="text" id="ProductionShedule-production_schedule_kode" class="form-control" name="ProductionShedule[production_schedule_kode]" autocomplete="off" value="<?= $header['production_schedule_kode'] ?>">
									<input readonly="readonly" type="hidden" id="ProductionShedule-production_schedule_id" class="form-control" name="ProductionShedule[production_schedule_id]" autocomplete="off" value="<?= $header['production_schedule_id'] ?>">
									<input readonly="readonly" type="hidden" id="ProductionShedule-production_schedule_tgl_update" class="form-control" name="ProductionShedule[production_schedule_tgl_update]" autocomplete="off" value="<?= $header['production_schedule_tgl_update'] ?>">
									<input readonly="readonly" type="hidden" id="ProductionShedule-production_schedule_who_update" class="form-control" name="ProductionShedule[production_schedule_who_update]" autocomplete="off" value="<?= $header['production_schedule_who_update'] ?>">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group field-ProductionShedule-client_wms_id">
									<label for="ProductionShedule-client_wms_id" class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
									<select id="ProductionShedule-client_wms_id" class="form-control select2" name="ProductionShedule[client_wms_id]" onchange="GetPrincipleByPerusahaan()">
										<option value="">** <label name="CAPTION-PERUSAHAAN">Perusahaan</label> **</option>
										<?php foreach ($Perusahaan as $row) : ?>
											<option value="<?= $row['client_wms_id'] ?>" <?= $header['client_wms_id'] == $row['client_wms_id'] ? 'selected' : '' ?>><?= $row['client_wms_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group field-ProductionShedule-production_schedule_kode">
									<label class="control-label" for="ProductionShedule-production_schedule_kode" name="CAPTION-TAHUN">Tahun</label>
									<input type="text" id="ProductionShedule-production_schedule_tahun" class="form-control" name="ProductionShedule[production_schedule_tahun]" autocomplete="off" value="<?= $header['production_schedule_tahun'] ?>">
									<input type="hidden" id="ProductionShedule-production_schedule_tgl" class="form-control" name="ProductionShedule[production_schedule_tgl]" autocomplete="off" value="<?= $header['production_schedule_tgl'] ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group field-ProductionShedule-client_wms_id">
									<label for="ProductionShedule-client_wms_id" class="control-label" name="CAPTION-PENYALURATAUPRINCIPLE">Penyalur / Principle</label>
									<select id="ProductionShedule-principle_id" class="form-control select2" name="ProductionShedule[principle_id]">
										<option value="">** <label name="CAPTION-PENYALURATAUPRINCIPLE">Penyalur / Principle</label> **</option>
										<?php foreach ($Principle as $row) : ?>
											<option value="<?= $row['principle_id'] ?>" <?= $header['principle_id'] == $row['principle_id'] ? 'selected' : '' ?>><?= $row['principle_kode'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group field-ProductionShedule-production_schedule_keterangan">
									<label class="control-label" for="ProductionShedule-production_schedule_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
									<input type="text" id="ProductionShedule-production_schedule_keterangan" class="form-control" name="ProductionShedule[production_schedule_keterangan]" autocomplete="off" value="<?= $header['production_schedule_keterangan'] ?>">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="form-group field-ProductionShedule-production_schedule_status">
									<label class="control-label" for="ProductionShedule-production_schedule_status" name="CAPTION-STATUS">Status</label>
									<input readonly="readonly" type="text" id="ProductionShedule-production_schedule_status" class="form-control" name="ProductionShedule[production_schedule_status]" autocomplete="off" value="<?= $header['production_schedule_status'] ?>" disabled>
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
						<h4 class="pull-left" name="CAPTION-LISTSKU">List SKU</h4>
						<div class="pull-right">
							<button class="btn btn-primary" id="btn_modal_list_data_pilih_sku_back_order" onclick="ViewModalListDataPilihSKUBackOrder()"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHSKUBACKORDER" style="color:white;">Tambah SKU Back Order</span></button>
							<button class="btn btn-primary" id="btn_modal_list_data_pilih_sku" onclick="ViewModalListDataPilihSKU()"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHSKU" style="color:white;">Tambah SKU</span></button>
						</div>
						<div class="clearfix"></div>
					</div>
					<table class="table table-bordered" id="table_production_schedule_detail" style="width: 100%;">
						<thead>
							<tr>
								<th class="text-center" style="text-align: center; vertical-align: middle;">#</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SKUKODE">SKU Kode</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-NAMABARANG">Nama Barang</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-KEMASAN">Kemasan</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SATUAN">Satuan</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-EXPIREDDATE">Expired Date</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-JUMLAHBARANG">Jumlah Barang</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-ACTION">Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div style="float: right">
					<a href="<?= base_url('FAS/Schedule/JadwalKedatanganMaterial/JadwalKedatanganMaterialMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI">Kembali</span></a>
					<button class="btn-submit btn btn-success" id="btn_simpan" onclick="saveData()"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN">Simpan</span></button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_list_data_pilih_sku" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" style="width:90%">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="container mt-2">
							<div class="row">
								<div class="x_content table-responsive">
									<table id="table_list_data_pilih_sku" width="100%" class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center" style="text-align: center; vertical-align: middle;">
													<input type="checkbox" id="check-all-pilih-sku" style="transform: scale(0.8)" class="form-control input-sm" width="20" />
												</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SKUINDUK">SKU Induk</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SKUKODE">SKU Kode</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SKU">SKU</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-KEMASAN">Kemasan</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SATUAN">Satuan</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-PRINCIPLE">Principle</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-BRAND">Brand</th>
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
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="PilihSKU()"><i class="fas fa-plus"></i> <label name="CAPTION-PILIH">Pilih</label></button>
				<button type="button" class="btn btn-danger btn_close_list_data_pilih_sku" data-dismiss="modal"><i class="fas fa-xmark"></i> <label name="CAPTION-TUTUP">Tutup</label></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_list_data_pilih_sku_back_order" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" style="width:90%">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title-bo"></h4>
			</div>
			<div class="modal-body">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="container mt-2">
							<div class="row">
								<div class="x_content table-responsive">
									<table id="table_list_data_pilih_sku_back_order" width="100%" class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center" style="text-align: center; vertical-align: middle;">
													<input type="checkbox" id="check-all-pilih-sku-back-order" style="transform: scale(0.8)" class="form-control input-sm" width="20" />
												</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SKUINDUK">SKU Induk</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SKUKODE">SKU Kode</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SKU">SKU</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-KEMASAN">Kemasan</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SATUAN">Satuan</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-PRINCIPLE">Principle</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-BRAND">Brand</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-JAN">Jan</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-FEB">Feb</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-MAR">Mar</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-APR">Apr</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-MAY">May</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-JUN">Jun</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-JUL">Jul</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-AUG">Aug</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SEP">Sep</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-OCT">Oct</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-NOV">Nov</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-DEC">Dec</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-TOTAL">Total</th>
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
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="PilihSKUBackOrder()"><i class="fas fa-plus"></i> <label name="CAPTION-PILIH">Pilih</label></button>
				<button type="button" class="btn btn-danger btn_close_list_data_pilih_sku_back_order" data-dismiss="modal"><i class="fas fa-xmark"></i> <label name="CAPTION-TUTUP">Tutup</label></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_list_data_pilih_jadwal_sku" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" style="width:90%">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title-detail pull-left"></h4>
				<h4 class="modal-total-detail pull-right">Maksimal : <span id="title_sku_jumlah_barang">0</span></h4>
			</div>
			<div class="modal-body">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="container mt-2">
							<div class="row">
								<div class="col-xs-4">
									<div class="form-group field-ProductionShedule-client_wms_id">
										<label for="ProductionShedule-client_wms_id" class="control-label" name="CAPTION-TAHUN">Tahun</label>
										<input type="text" class="form-control" id="filter_tahun_detail2" name="filter_tahun_detail2" value="<?= date('Y') ?>" onchange="UpdateTahunProductionScheduleDetail2()" disabled>
										<input type="hidden" class="form-control" id="filter_sku_id_detail2" name="filter_sku_id_detail2" value="">
										<input type="hidden" class="form-control" id="filter_sku_kode_detail2" name="filter_sku_kode_detail2" value="">
										<input type="hidden" class="form-control" id="filter_sku_nama_produk_detail2" name="filter_sku_nama_produk_detail2" value="">
										<input type="hidden" class="form-control" id="filter_sku_jumlah_barang_detail2" name="filter_sku_jumlah_barang_detail2" value="">
									</div>
								</div>
								<!-- <button type="button" class="btn btn-primary" onclick="AddListProductionScheduleDetail2()"><i class="fas fa-plus"></i> <span name="CAPTION-TAMBAHJADWAL">Tambah Jadwal</span></button> -->
								<div class="x_content table-responsive">
									<table id="table_list_data_pilih_jadwal" width="100%" class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center" style="text-align: center; vertical-align: middle;">#</th>
												<!-- <th class="text-center" style="text-align: center; vertical-align: middle;width:30%;" name="CAPTION-TAHUN">Tahun</th> -->
												<th class="text-center" style="text-align: center; vertical-align: middle;width:45%;" name="CAPTION-BULAN">Bulan</th>
												<th class="text-center" style="text-align: center; vertical-align: middle;width:45%;" name="CAPTION-JUMLAHBARANG">Jumlah Barang</th>
												<!-- <th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-ACTION">Action</th> -->
											</tr>
										</thead>
										<tbody></tbody>
										<tfoot>
										</tfoot>
									</table>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="PilihJadwal()"><i class="fas fa-plus"></i> <label name="CAPTION-PILIH">Pilih</label></button>
				<button type="button" class="btn btn-danger btn_close_list_data_pilih_sku" data-dismiss="modal"><i class="fas fa-xmark"></i> <label name="CAPTION-TUTUP">Tutup</label></button>
			</div>
		</div>
	</div>

</div>