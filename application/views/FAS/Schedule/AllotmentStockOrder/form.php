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
							<div class="form-group field-AllotmentStockOrder-allotment_stock_order_kode">
								<label class="control-label" for="AllotmentStockOrder-allotment_stock_order_kode" name="CAPTION-TAHUN">Tahun</label>
								<input type="text" id="AllotmentStockOrder-allotment_stock_order_tahun" class="form-control" name="AllotmentStockOrder[allotment_stock_order_tahun]" autocomplete="off" value="<?= date('Y') ?>">
							</div>
						</div>
					</div>
					<div class="row">
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
		<div class="row" id="panel-back-order">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h4 class="pull-left" name="CAPTION-LISTBACKORDER">List Back Order</h4>
						<div class="pull-right">
							<button class="btn btn-primary" id="btn_modal_list_data_pilih_sku" onclick="ViewModalListDataPilihBackOrder()"><i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHBACKORDER" style="color:white;">Tambah Back Order</span></button>
							<button class="btn btn-danger" id="btn_modal_list_data_pilih_sku" onclick="DeleteAllBackOrder()"><i class="fa fa-trash"></i> <span name="CAPTION-HAPUSSEMUABACKORDER" style="color:white;">Hapus Semua Back Order</span></button>
						</div>
						<div class="clearfix"></div>
					</div>
					<table class="table table-bordered" id="table_allotment_stock_order_detail3" style="width: 100%;">
						<thead>
							<tr>
								<th class="text-center" style="text-align: center; vertical-align: middle;">#</th>
								<th class="text-center resetPrioritas">Nama</th>
								<th class="text-center resetPrioritas">Alamat</th>
								<th class="text-center resetPrioritas">Kecamatan</th>
								<th class="text-center resetPrioritas">Kota</th>
								<th class="text-center resetPrioritas">Area</th>
								<th class="text-center resetPrioritas">Telp</th>
								<th class="text-center resetPrioritas">Jumlah Back Order</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row" id="panel-sku">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h4 class="pull-left" name="CAPTION-SUMMARYSKU">Summary SKU</h4>
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
					<a href="<?= base_url('FAS/Schedule/AllotmentStockOrder/AllotmentStockOrderMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI">Kembali</span></a>
					<button class="btn-submit btn btn-success" id="btn_simpan" onclick="saveData()"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN">Simpan</span></button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_list_back_order" role="dialog" data-keyboard="false" data-backdrop="static">
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
					<div class="col-xs-6">
						<div class="form-group field-AllotmentStockOrder-allotment_stock_order_kode">
							<label class="control-label" name="CAPTION-TAHUN">Tahun</label>
							<input type="text" id="filter_tahun_backorder" class="form-control" name="filter_tahun_backorder" autocomplete="off" value="<?= date('Y') ?>" disabled>
						</div>
					</div>
					<div class="col-xs-6">
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
				</div><br>
				<div class="row">
					<div class="col-xs-12 table-responsive">
						<table id="table_list_back_order" width="100%" class="table table-bordered">
							<thead>
								<tr class="bg-primary">
									<th class="text-center" style="color:white;"><input type="checkbox" name="chk-all-back-order" id="chk-all-back-order" value="1"></th>
									<th class="text-center" style="color:white;" name="CAPTION-KDOEBACKORDER">Kode Back Order</th>
									<th class="text-center" style="color:white;" name="CAPTION-NOPO">No. PO</th>
									<th class="text-center" style="color:white;" name="CAPTION-TANGGAL">Tanggal</th>
									<th class="text-center" style="color:white;" name="CAPTION-TIPE">Tipe</th>
									<th class="text-center" style="color:white;" name="CAPTION-CUSTOMER">Customer</th>
									<th class="text-center" style="color:white;" name="CAPTION-ALAMATKIRIM">Alamat Kirim
									<th class="text-center" style="color:white;" name="CAPTION-KECAMATAN">Kecamatan</th>
									<th class="text-center" style="color:white;" name="CAPTION-KOTA">Kota</th>
									<th class="text-center" style="color:white;" name="CAPTION-PROVINSI">Provinsi</th>
									<th class="text-center" style="color:white;" name="CAPTION-AREA">Area</th>
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
						<button type="button" class="btn btn-info" id="btn_pilih_back_order" onclick="PilihBackOrder()"><label name="CAPTION-PILIH">Pilih</label></button>
						<button type="button" data-dismiss="modal" class="btn btn-danger"><label name="CAPTION-TUTUP">Tutup</label></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_list_back_order_by_customer" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" style="width:80%;">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<h4 class="modal-title"><label name="CAPTION-LISTBACKORDER">List Back Order</label></h4>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6">
						<div class="row">
							<div class="col-xs-2">
								<label name="CAPTION-PELANGGAN">Pelanggan</label>
							</div>
							<div class="col-xs-1">
								<label>:</label>
							</div>
							<div class="col-xs-9">
								<label id="filter_pelanggan_back_order_by_customer"></label>
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 table-responsive">
						<table id="table_list_back_order_by_customer" width="100%" class="table table-bordered">
							<thead>
								<tr class="bg-primary">
									<th class="text-center" style="color:white;">
										<input type="checkbox" name="chk-all-delete-back-order" id="chk-all-delete-back-order" value="1">
									</th>
									<th class="text-center" style="color:white;" name="CAPTION-KDOEBACKORDER">Kode Back Order</th>
									<th class="text-center" style="color:white;" name="CAPTION-NOPO">No. PO</th>
									<th class="text-center" style="color:white;" name="CAPTION-TANGGAL">Tanggal</th>
									<th class="text-center" style="color:white;" name="CAPTION-TIPE">Tipe</th>
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
						<button type="button" class="btn btn-danger" onclick="DeleteSelectedBackOrder()"><i class="fa fa-trash"></i> <label name="CAPTION-HAPUS">Hapus</label></button>
						<button type="button" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> <label name="CAPTION-TUTUP">Tutup</label></button>
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
									<th class="text-center" style="color:white;" name="CAPTION-APR">APR</th>
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
						<table class="table table-bordered" id="table_list_back_order_simulasi_mps" style="width: 100%;">
							<thead>
								<tr>
									<th class="text-center" style="text-align: center; vertical-align: middle;">#</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-KODEBACKORDER">Kode Back Order</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-TANGGALBACKORDER">Tanggal Back Order</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-OUTLET">Outlet</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-QTYPLAN">Qty Plan</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-QTYSISA">Qty Sisa</th>
									<th class="text-center" style="text-align: center; vertical-align: middle;" name="CAPTION-QTY">Qty</th>
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