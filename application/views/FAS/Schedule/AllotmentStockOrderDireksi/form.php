<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 name="CAPTION-217403000">Allotment Stock Order</h3>
			</div>
			<div style="float: right">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<div class="form-group field-AllotmentStockOrder-allotment_stock_order_kode">
								<label class="control-label" name="CAPTION-NOALLOTMENTSTOCKORDER">No. Allotment Stock Order</label>
								<input readonly="readonly" type="text" id="AllotmentStockOrder-allotment_stock_order_kode" class="form-control" name="AllotmentStockOrder[allotment_stock_order_kode]" autocomplete="off" value="">
								<input readonly="readonly" type="hidden" id="AllotmentStockOrder-allotment_stock_order_id" class="form-control" name="AllotmentStockOrder[allotment_stock_order_id]" autocomplete="off" value="<?= $allotment_stock_order_id ?>">
								<input readonly="readonly" type="hidden" id="AllotmentStockOrder-allotment_stock_order_tgl_update" class="form-control" name="AllotmentStockOrder[allotment_stock_order_tgl_update]" autocomplete="off" value="">
								<input readonly="readonly" type="hidden" id="AllotmentStockOrder-allotment_stock_order_who_update" class="form-control" name="AllotmentStockOrder[allotment_stock_order_who_update]" autocomplete="off" value="">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group field-AllotmentStockOrder-client_wms_id">
								<label for="AllotmentStockOrder-client_wms_id" class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
								<select id="AllotmentStockOrder-client_wms_id" class="form-control select2" name="AllotmentStockOrder[client_wms_id]" onchange="GetPrincipleByPerusahaan()">
									<option value="">** <label name="CAPTION-PERUSAHAAN">Perusahaan</label> **</option>
									<?php foreach ($Perusahaan as $row) : ?>
										<option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group field-AllotmentStockOrder-client_wms_id">
								<label for="AllotmentStockOrder-karyawan_direksi_id" class="control-label" name="CAPTION-DIREKSI">Direksi</label>
								<select id="AllotmentStockOrder-karyawan_direksi_id" class="form-control select2" name="AllotmentStockOrder[karyawan_direksi_id]">
									<option value="">** <label name="CAPTION-PILIH">Pilih</label> **</option>
									<?php foreach ($Direksi as $row) : ?>
										<option value="<?= $row['karyawan_id'] ?>"><?= $row['karyawan_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<div class="form-group field-AllotmentStockOrder-allotment_stock_order_kode">
								<label class="control-label" for="AllotmentStockOrder-allotment_stock_order_kode" name="CAPTION-TAHUN">Tahun</label>
								<input type="text" id="AllotmentStockOrder-allotment_stock_order_tahun" class="form-control" name="AllotmentStockOrder[allotment_stock_order_tahun]" autocomplete="off" value="<?= date('Y') ?>">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group field-AllotmentStockOrder-allotment_stock_order_keterangan">
								<label class="control-label" for="AllotmentStockOrder-allotment_stock_order_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
								<input type="text" id="AllotmentStockOrder-allotment_stock_order_keterangan" class="form-control" name="AllotmentStockOrder[allotment_stock_order_keterangan]" autocomplete="off" value="">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group field-AllotmentStockOrder-allotment_stock_order_status">
								<label class="control-label" for="AllotmentStockOrder-allotment_stock_order_status" name="CAPTION-STATUS">Status</label>
								<input readonly="readonly" type="text" id="AllotmentStockOrder-allotment_stock_order_status" class="form-control" name="AllotmentStockOrder[allotment_stock_order_status]" autocomplete="off" value="Draft" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="panel-sku">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h4 class="pull-left" name="CAPTION-SUMMARYSKU">Summary SKU</h4>
						<div class="pull-right">
							<button class="btn btn-primary" id="btn_modal_list_data_pilih_sku" onclick="ViewModalListDataPilihSKUBackOrder()"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHSKU" style="color:white;">Tambah SKU</span></button>
							<button class="btn btn-danger" id="btn_modal_list_data_pilih_sku" onclick="DeleteAllSKUBackOrder()"><i class="fa fa-trash"></i> <span name="CAPTION-HAPUSSEMUASKU" style="color:white;">Hapus Semua SKU</span></button>
						</div>
						<div class="clearfix"></div>
					</div>
					<table class="table table-bordered" id="table_allotment_stock_order_detail" style="width: 100%;">
						<thead>
							<tr>
								<th class="text-center" style="text-align: center; vertical-align: middle;">#</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-PRINCIPLE">Principle</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-BRAND">Brand</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SKUKODE">SKU Kode</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-NAMABARANG">Nama Barang</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-KEMASAN">Kemasan</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-SATUAN">Satuan</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-JUMLAHBARANG">Jumlah Barang</th>
								<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-ACTION">Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div style="float: right">
					<a href="<?= base_url('FAS/Schedule/AllotmentStockOrderDireksi/AllotmentStockOrderDireksiMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI">Kembali</span></a>
					<button class="btn-submit btn btn-success" id="btn_simpan" onclick="saveData()"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN">Simpan</span></button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_list_sku_back_order" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" style="width:90%;">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<h4 class="modal-title"><label name="CAPTION-CARISKU">Cari SKU</label></h4>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-4">
						<div class="form-group field-AllotmentStockOrder-allotment_stock_order_kode">
							<label class="control-label" name="CAPTION-TAHUN">Tahun</label>
							<input type="text" id="filter_tahun_backorder" class="form-control" name="filter_tahun_backorder" autocomplete="off" value="<?= date('Y') ?>" disabled>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="form-group field-AllotmentStockOrder-allotment_stock_order_kode">
							<label class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
							<select id="filter_perusahaan_backorder" class="form-control" name="filter_perusahaan_backorder" disabled>
								<option value="">** <label name="CAPTION-PERUSAHAAN">Perusahaan</label> **</option>
								<?php foreach ($Perusahaan as $row) : ?>
									<option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="form-group field-AllotmentStockOrder-allotment_stock_order_kode">
							<label class="control-label" name="CAPTION-PRINCIPLE">Principle</label>
							<select id="filter_principle_backorder" class="form-control select2" name="filter_principle_backorder" onchange="Get_list_sku_back_order()">
								<option value="">** <label name="CAPTION-PRINCIPLE">Principle</label> **</option>
								<?php foreach ($Principle as $row) : ?>
									<option value="<?= $row['principle_id'] ?>"><?= $row['principle_kode'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 table-responsive">
						<table id="table_list_sku_back_order" width="100%" class="table table-bordered">
							<thead>
								<tr class="bg-primary">
									<th class="text-center" style="color:white;"><input type="checkbox" name="chk-all-sku_id" id="chk-all-sku_id" value="1"></th>
									<th class="text-center" style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-PRINCIPLE">Principle</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-BRAND">Brand</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-SKUKODE">SKU Kode</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-NAMABARANG">Nama Barang</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-KEMASAN">Kemasan</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-SATUAN">Satuan</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;color:white;" name="CAPTION-QTYBACKORDER">Qty Back Order</th>
									</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12 pull-right">
						<button type="button" class="btn btn-info" id="btn_pilih_back_order" onclick="PilihSKUBackOrder()"><label name="CAPTION-PILIH">Pilih</label></button>
						<button type="button" data-dismiss="modal" class="btn btn-danger"><label name="CAPTION-TUTUP">Tutup</label></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_simulasi_sku" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" style="width:90%;">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<h4 class="modal-title"><label name="CAPTION-PROSESIMULASI">Proses Simulasi</label></h4>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6">
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-TAHUN">Tahun</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_tahun_detail_summary_sku"></label>
								<input type="hidden" id="filter_sku_id_detail_summary_sku" name="filter_sku_id_detail_summary_sku" value="" />
							</div>
						</div>
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-KODESKU">Kode SKU</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_sku_kode_detail_summary_sku"></label>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-SKU">SKU</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_sku_nama_produk_detail_summary_sku"></label>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6">
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-SKUSATUAN">SKU Satuan</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_sku_satuan_detail_summary_sku"></label>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-SKUKEMASAN">SKU Kemasan</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_sku_kemasan_detail_summary_sku"></label>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-QTY">SKU Qty</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_sku_qty_detail_summary_sku"></label>
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 table-responsive">
						<table id="table_list_simulasi_sku" width="100%" class="table table-bordered">
							<thead>
								<tr class="bg-primary">
									<th class="text-center" style="color:white;">#</th>
									<th class="text-center" style="color:white;" name="CAPTION-JENIS">Jenis</th>
									<th class="text-center" style="color:white;" name="CAPTION-TOTAL">Total</th>
									<th class="text-center" style="color:white;" name="CAPTION-JAN">Jan</th>
									<th class="text-center" style="color:white;" name="CAPTION-FEB">Feb</th>
									<th class="text-center" style="color:white;" name="CAPTION-MAR">Mar</th>
									<th class="text-center" style="color:white;" name="CAPTION-APR">Apr</th>
									<th class="text-center" style="color:white;" name="CAPTION-MAY">May</th>
									<th class="text-center" style="color:white;" name="CAPTION-JUN">Jun</th>
									<th class="text-center" style="color:white;" name="CAPTION-JUL">Jul</th>
									<th class="text-center" style="color:white;" name="CAPTION-AUG">Aug</th>
									<th class="text-center" style="color:white;" name="CAPTION-SEP">Sep</th>
									<th class="text-center" style="color:white;" name="CAPTION-OCT">Oct</th>
									<th class="text-center" style="color:white;" name="CAPTION-NOV">Nov</th>
									<th class="text-center" style="color:white;" name="CAPTION-DEC">Dec</th>
									</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12 pull-right">
						<button type="button" data-dismiss="modal" class="btn btn-danger" onclick="Get_list_allotment_stock_order_detail()"><i class="fa fa-times"></i> <label name="CAPTION-TUTUP">Tutup</label></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_list_back_order_by_sku" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" style="width:90%;">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<h4 class="modal-title"><label name="CAPTION-CARIBACKORDER">Cari Back Order</label></h4>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-TAHUN">Tahun</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_tahun_back_order_by_sku"></label>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-SKU">Bulan</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_bulan_back_order_by_sku"></label>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-TIPE">Tipe</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_tipe_back_order_by_sku"></label>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-KODESKU">Kode SKU</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_sku_kode_back_order_by_sku"></label>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-SKU">SKU</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_sku_nama_produk_back_order_by_sku"></label>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-SKUKEMSAN">SKU Kemasan</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_sku_kemasan_back_order_by_sku"></label>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-SKUSATUAN">SKU Satuan</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_sku_satuan_back_order_by_sku"></label>
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 table-responsive">
						<table id="table_list_back_order_by_sku" width="100%" class="table table-bordered">
							<thead>
								<tr class="bg-primary">
									<th class="text-center" style="color:white;">#</th>
									<th class="text-center" style="color:white;" name="CAPTION-KDOEBACKORDER">Kode Back Order</th>
									<th class="text-center" style="color:white;" name="CAPTION-AREA">Area</th>
									<th class="text-center" style="color:white;" name="CAPTION-CUSTOMER">Customer</th>
									<th class="text-center" style="color:white;" name="CAPTION-ALAMATKIRIM">Alamat Kirim
									<th class="text-center" style="color:white;" name="CAPTION-KECAMATAN">Kecamatan</th>
									<th class="text-center" style="color:white;" name="CAPTION-KOTA">Kota</th>
									<th class="text-center" style="color:white;" name="CAPTION-PROVINSI">Provinsi</th>
									<th class="text-center" style="color:white;" name="CAPTION-TIPE">Tipe</th>
									<th class="text-center" style="color:white;" name="CAPTION-QTY">Qty</th>
									</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-success" id="btn_update_back_order" onclick="UpdateBackOrder()"><i class="fa fa-save"></i> <label name="CAPTION-PILIH">Simpan</label></button>
						<button type="button" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> <label name="CAPTION-TUTUP">Tutup</label></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_simulasi_mps_temp2" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" style="width:90%;">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<h4 class="modal_title_simulasi_mps_temp2"></h4>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="x_panel">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="row">
								<div class="col-xs-2">
									<label name="CAPTION-KODESKU">Kode SKU</label>
								</div>
								<div class="col-xs-1">
									<label>:</label>
								</div>
								<div class="col-xs-9">
									<label id="filter_sku_kode_simulasi_mps_temp2"></label>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-2">
									<label name="CAPTION-SKU">SKU</label>
								</div>
								<div class="col-xs-1">
									<label>:</label>
								</div>
								<div class="col-xs-9">
									<label id="filter_sku_nama_produk_simulasi_mps_temp2"></label>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="row">
								<div class="col-xs-2">
									<label name="CAPTION-SKUSATUAN">SKU Satuan</label>
								</div>
								<div class="col-xs-1">
									<label>:</label>
								</div>
								<div class="col-xs-9">
									<label id="filter_sku_satuan_simulasi_mps_temp2"></label>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-2">
									<label name="CAPTION-SKUKEMASAN">SKU Kemasan</label>
								</div>
								<div class="col-xs-1">
									<label>:</label>
								</div>
								<div class="col-xs-9">
									<label id="filter_sku_kemasan_simulasi_mps_temp2"></label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="x_panel">
					<div class="row">
						<div class="col-xs-4">
							<div class="form-group field-SimulasiMpsTemp2-tahun">
								<label class="control-label" name="CAPTION-TAHUN">Tahun</label>
								<input readonly="readonly" type="text" id="SimulasiMpsTemp2-tahun" class="form-control" name="SimulasiMpsTemp2[tahun]" autocomplete="off" value="">
								<input type="hidden" id="SimulasiMpsTemp2-sku_id" name="SimulasiMpsTemp2[sku_id]" value="" />
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group field-SimulasiMpsTemp2-bulan">
								<label for="SimulasiMpsTemp2-bulan" class="control-label" name="CAPTION-BULAN">Bulan</label>
								<select id="SimulasiMpsTemp2-bulan" class="form-control" name="SimulasiMpsTemp2[bulan]" disabled>
									<option value="">** <label name="CAPTION-PILIH">Pilih</label> **</option>
									<?php foreach ($Bulan as $key => $value) : ?>
										<option value="<?= $key ?>"><?= $value ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<div class="form-group field-SimulasiMpsTemp2-qty">
								<label class="control-label" for="SimulasiMpsTemp2-qty" name="CAPTION-QTY">Qty</label>
								<input type="text" id="SimulasiMpsTemp2-qty" class="form-control" name="SimulasiMpsTemp2[qty]" autocomplete="off" value="0" onchange="CekQtySisa()">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group field-SimulasiMpsTemp2-qty">
								<label class="control-label" for="SimulasiMpsTemp2-qty" name="CAPTION-QTYSISAGLOBAL">Qty Sisa Global</label>
								<input type="text" id="SimulasiMpsTemp2-qty_sisa" class="form-control" name="SimulasiMpsTemp2[qty_sisa]" autocomplete="off" value="0" disabled>
								<input type="hidden" id="SimulasiMpsTemp2-qty_max" class="form-control" name="SimulasiMpsTemp2[qty_max]" autocomplete="off" value="0">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group field-SimulasiMpsTemp2-qty">
								<label class="control-label" for="SimulasiMpsTemp2-qty" name="CAPTION-QTYSISAPERBULAN">Qty Sisa Per Bulan</label>
								<input type="text" id="SimulasiMpsTemp2-qty_sisa_perbulan" class="form-control" name="SimulasiMpsTemp2[qty_sisa_perbulan]" autocomplete="off" value="0" disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="x_panel">
					<div class="row">
						<button class="btn btn-primary" id="btn_modal_list_data_pilih_karyawan" onclick="ViewModalListDataPilihKaryawan()"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHKARYAWANMANAGER" style="color:white;">Tambah Karyawan Manager</span></button>
						<button class="btn btn-danger" id="btn_modal_list_data_pilih_sku" onclick="DeleteAllKaryawan()"><i class="fa fa-trash"></i> <span name="CAPTION-HAPUSSEMUA" style="color:white;">Hapus Semua</span></button>
						<table class="table table-bordered" id="table_list_karyawan_manager_simulasi_mps" style="width: 100%;">
							<thead>
								<tr>
									<th class="text-center" style="text-align: center; vertical-align: middle;">#</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-KARYAWAN">Karyawan</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-DIVISI">Divisi</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-LEVEL">Level</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-QTY">Qty</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-ACTION">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12 pull-right">
						<button type="button" class="btn btn-success" id="btn_save_simulasi_mps_temp2" onclick="SaveSimulasiMpsTemp2()"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN">Simpan</span></button>
						<button type="button" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> <span name="CAPTION-TUTUP">Tutup</span></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_list_karyawan" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" style="width:90%;">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<h4><span name="CAPTION-KARYAWAN">Karyawan</span></h4>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="x_panel">
					<div class="row">
						<div class="col-xs-4">
							<div class="form-group field-AllotmentStockOrder-allotment_stock_order_kode">
								<label class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
								<select id="filter_perusahaan_karyawan" class="form-control" name="filter_perusahaan_karyawan" disabled>
									<option value="">** <label name="CAPTION-PERUSAHAAN">Perusahaan</label> **</option>
									<?php foreach ($Perusahaan as $row) : ?>
										<option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="x_panel">
					<div class="row">
						<table class="table table-bordered" id="table_list_karyawan" style="width: 100%;">
							<thead>
								<tr>
									<th class="text-center" style="text-align: center; vertical-align: middle;">
										<input type="checkbox" name="chk-all-karyawan_id" id="chk-all-karyawan_id" value="1">
									</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-KARYAWAN">Karyawan</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-DIVISI">Divisi</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-LEVEL">Level</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-12 pull-right">
						<button type="button" class="btn btn-success" id="btn_pilih_karyawan" onclick="PilihKaryawan()"><i class="fa fa-save"></i> <span name="CAPTION-PILIH">Pilih</span></button>
						<button type="button" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> <span name="CAPTION-TUTUP">Tutup</span></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>