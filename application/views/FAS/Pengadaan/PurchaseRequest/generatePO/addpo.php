<style>
	table {
		border-collapse: collapse;
		width: 100%;
	}

	th {
		background-color: #337ab7;
		padding: 8px 16px;
	}


	.tableFixHead {
		overflow: auto;
		height: 100px;
	}

	.tableFixHead thead th {
		position: sticky;
		top: 0;
	}
</style>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-GENERATEPO">Generate</span> Purchase Order</h3>
				<input type="hidden" id="pr_id" value="<?= $pr_id ?>">
				<input type="hidden" id="item-count-po" value="<?= count($PRDetailSupplier) ?>">
			</div>
			<div style="float: right">
				<button data-toggle="modal" data-target="#modal-history-approval" id="btn-history-approval" class="btn btn-success" type="button"><i class="fa fa-clock"></i> <span name="CAPTION-HISTORY" style="color:white;">Riwayat</span></button>
			</div>
		</div>
		<?php foreach ($PRHeader as $header) : ?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<div class="clearfix"></div>
						</div>
						<div class="row">
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-purchase_request_kode">
									<label class="control-label" for="purchaserequest-purchase_request_kode" name="CAPTION-NOSO">No Purchase Request</label>
									<input readonly="readonly" type="hidden" id="purchaserequest-purchase_request_id" class="form-control" name="purchaserequest[purchase_request_id]" autocomplete="off" value="<?= $header['purchase_request_id']; ?>">
									<input readonly="readonly" type="text" id="purchaserequest-purchase_request_kode" class="form-control" name="purchaserequest[purchase_request_kode]" autocomplete="off" value="<?= $header['purchase_request_kode']; ?>">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-sales_id">
									<label for="purchaserequest-sales_id" class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
									<select class="input-sm form-control select2" id="purchaserequest-client_wms_id" name="purchaserequest[client_wms_id]">
										<option value="">** Perusahaan **</option>
										<?php foreach ($Perusahaan as $row) : ?>
											<option value="<?= $row['client_wms_id'] ?>" <?= $header['client_wms_id'] == $row['client_wms_id'] ? 'selected' : ''; ?>><?= $row['client_wms_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-purchase_request_tgl">
									<label class="control-label" for="purchaserequest-purchase_request_tgl" name="CAPTION-TGLPR">Tanggal Purchase Request</label>
									<input type="text" id="purchaserequest-purchase_request_tgl" class="form-control datepicker" name="purchaserequest[purchase_request_tgl]" autocomplete="off" value="<?= $header['purchase_request_tgl']; ?>" readonly disabled>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-purchase_request_tgl_dibutuhkan">
									<label class="control-label" for="purchaserequest-purchase_request_tgl_dibutuhkan" name="CAPTION-TGLDIBUTUHKAN">Tanggal Dibutuhkan</label>
									<input type="text" id="purchaserequest-purchase_request_tgl_dibutuhkan" class="form-control datepicker" name="purchaserequest[purchase_request_tgl_dibutuhkan]" autocomplete="off" value="<?= $header['purchase_request_tgl_dibutuhkan']; ?>" readonly disabled>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-tipe_pengadaan_id">
									<label for="purchaserequest-tipe_pengadaan_id" class="control-label" name="CAPTION-TIPEPENGADAAN">Tipe Pengadaan</label>
									<select class="input-sm form-control select2" id="purchaserequest-tipe_pengadaan_id" name="purchaserequest[tipe_pengadaan_id]">
										<option value="">** Pilih **</option>
										<?php foreach ($TipePengadaan as $row) : ?>
											<option value="<?= $row['tipe_pengadaan_id'] ?>" <?= $header['tipe_pengadaan_id'] == $row['tipe_pengadaan_id'] ? 'selected' : ''; ?>><?= $row['tipe_pengadaan_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-sales_id">
									<label for="purchaserequest-sales_id" class="control-label" name="CAPTION-DIVISI">Divisi</label>
									<select class="input-sm form-control select2" id="purchaserequest-karyawan_divisi_id" name="purchaserequest[karyawan_divisi_id]">
										<option value="">** Divisi **</option>
										<?php foreach ($Divisi as $row) : ?>
											<option value="<?= $row['karyawan_divisi_id'] ?>" <?= $header['karyawan_divisi_id'] == $row['karyawan_divisi_id'] ? 'selected' : ''; ?>><?= $row['karyawan_divisi_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-purchase_request_pemohon">
									<label class="control-label" for="purchaserequest-purchase_request_pemohon" name="CAPTION-PEMOHON">Pemohon</label>
									<input type="text" id="purchaserequest-purchase_request_pemohon" class="form-control" name="purchaserequest[purchase_request_pemohon]" autocomplete="off" value="<?= $header['purchase_request_pemohon']; ?>">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-purchase_request_status">
									<label class="control-label" for="purchaserequest-purchase_request_status">Status</label>
									<input type="text" class="form-control" id="purchaserequest-purchase_request_status" name="purchaserequest[purchase_request_status]" value="<?= $header['purchase_request_status']; ?>" readonly>
								</div>
								<div class="form-group field-purchaserequest-pr_is_need_approval">
									<input type="checkbox" id="purchaserequest-pr_is_need_approval" name="purchaserequest[pr_is_need_approval]" autocomplete="off" value="1" <?= $header['purchase_request_status'] != 'Draft' ? 'checked' : ''; ?>> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
								</div>
							</div>
						</div>
						<div class="row" style="display: none;">
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-tipe_transaksi_id">
									<label for="purchaserequest-tipe_transaksi_id" class="control-label" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</label>
									<select class="input-sm form-control select2" id="purchaserequest-tipe_transaksi_id" name="purchaserequest[tipe_transaksi_id]">
										<option value="">** Pilih **</option>
										<?php foreach ($TipeTransaksi as $row) : ?>
											<option value="<?= $row['tipe_transaksi_id'] ?>" <?= $header['tipe_transaksi_id'] == $row['tipe_transaksi_id'] ? 'selected' : ''; ?>><?= $row['tipe_transaksi_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-kategori_biaya_id">
									<label for="purchaserequest-kategori_biaya_id" class="control-label" name="CAPTION-KATEGORIBIAYA">Kategori Biaya</label>
									<select class="input-sm form-control select2" id="purchaserequest-kategori_biaya_id" name="purchaserequest[kategori_biaya_id]">
										<option value="">** Pilih **</option>
										<?php foreach ($KategoriBiaya as $row) : ?>
											<option value="<?= $row['kategori_biaya_id'] ?>" <?= $header['kategori_biaya_id'] == $row['kategori_biaya_id'] ? 'selected' : ''; ?>><?= $row['kategori_biaya_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-tipe_biaya_id">
									<label for="purchaserequest-tipe_biaya_id" class="control-label" name="CAPTION-TIPEBIAYA">Tipe Biaya</label>
									<select class="input-sm form-control select2" id="purchaserequest-tipe_biaya_id" name="purchaserequest[tipe_biaya_id]">
										<option value="">** Pilih **</option>
										<?php foreach ($TipeBiaya as $row) : ?>
											<option value="<?= $row['tipe_biaya_id'] ?>" <?= $header['tipe_biaya_id'] == $row['tipe_biaya_id'] ? 'selected' : ''; ?>><?= $row['tipe_biaya_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-tipe_kepemilikan_id">
									<label for="purchaserequest-sales_id" class="control-label" name="CAPTION-KEPEMILIKAN">Tipe Kepemilikan</label>
									<select class="input-sm form-control select2" id="purchaserequest-tipe_kepemilikan_id" name="purchaserequest[tipe_kepemilikan_id]">
										<option value="">** Kepemilikan **</option>
										<?php foreach ($TipeKepemilikan as $row) : ?>
											<option value="<?= $row['tipe_kepemilikan_id'] ?>" <?= $header['tipe_kepemilikan_id'] == $row['tipe_kepemilikan_id'] ? 'selected' : ''; ?>><?= $row['tipe_kepemilikan_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-xs-3">
								<label class="control-label" name="CAPTION-JUDUL">Judul</label>
								<div class="form-group field-purchaserequest-purchase_request_pemohon">
									<input type="text" id="purchaserequest-purchase_request_add_judul" name="purchaserequest-purchase_request_add_judul" class="txtjudul form-control" readonly value="<?= $header['pengajuan_dana_judul']; ?>" />
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group field-purchaserequest-purchase_request_keterangan">
									<label class="control-label" for="purchaserequest-purchase_request_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
									<textarea class="form-control" id="purchaserequest-purchase_request_keterangan" name="purchaserequest[purchase_request_keterangan]" readonly><?= $header['purchase_request_keterangan']; ?></textarea>
								</div>
							</div>

						<?php endforeach; ?>
						<div class="col-xs-4">
							<label class="control-label" for="purchaserequest-purchase_request_keterangan" name="CAPTION-LISTSUPPLIER">List Supplier</label>
							<div style="overflow-x:auto;height:200px;">
								<div class="form-group field-purchaserequest-purchase_request_keterangan">
									<div id="table-wrapper">
										<div id="table-scroll">
											<table class="table table-striped tableFixHead" id="table-supplier" style="width:100%;">
												<thead>
													<tr class="bg-primary">
														<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-NO" class="text"></span><input type="checkbox" name="select-po-supplier" id="select-po-supplier" value="1"></th>
														<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-PILIHSUPPLIER" class="text">Pilih Supplier</span></th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<!-- <div style=" float: right">
                                    <button class="btn-submit btn btn-warning" id="btngeneratepo"><i class="fa fa-save"></i> <span name="CAPTION-GENERATEPO" style="color:white;">Generate PO</span></button>
                                </div> -->
						</div>
						</div>
						<div style=" float: right">
							<button class="btn-submit btn btn-warning" id="btngeneratepo"><i class="fa fa-save"></i> <span name="CAPTION-GENERATEPO" style="color:white;">Generate PO</span></button>
						</div>
					</div>
				</div>

				<!-- eendorfeac -->
			</div>
			<div class="row" id="panel-barang">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h4 class="pull-left" name="CAPTION-LISTPURCHASEORDER">List Purchase Order</h4>

							<div class="clearfix"></div>
						</div>
						<div style="overflow-x:auto;">
							<table class="table table-striped" id="tablelistpo" style="width:100%;">
								<thead>
									<tr class="bg-primary">
										<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-NO">No.</span></th>
										<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-NOMORPO">No Po</span></th>
										<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-TANGGALPO">Tanggal Po</span></th>
										<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SUPPLIER">Supplier</span></th>
										<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-ALAMAT">Alamat</span></th>
										<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
										<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-DETAIL">Detail</span></th>
									</tr>
								</thead>
								<tbody>
									<!-- <input type="hidden" id="item-count-purchaserequestdetail" value="<?= count($PRDetail) ?>"> -->

								</tbody>
							</table>
						</div>
					</div>
					<div style="float: right">
						<a href="<?= base_url('FAS/Pengadaan/PurchaseRequest/PurchaseRequestMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>

					</div>
				</div>
			</div>
	</div>
</div>

<div class="modal fade" id="modal-sku" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label name="CAPTION-CARISKU">Cari SKU Barang</label></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-4">
								<label name="CAPTION-PERUSAHAAN">Perusahaan</label>
								<select id="filter-perusahaan-sku" name="filter_perusahaan_sku" class="form-control input-sm select2" style="width:100%;">
									<option value="">Semua</option>
									<?php foreach ($Perusahaan as $type) : ?>
										<option value="<?= $type['client_wms_id'] ?>"><?= $type['client_wms_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-xs-4">
								<label name="CAPTION-SKUKODE">SKU Kode</label>
								<input type="text" id="filter-sku-kode" name="filter_sku_kode" class=" form-control input-sm" style="height:40px;" />
							</div>
							<div class="col-xs-4">
								<label name="CAPTION-SKU">SKU</label>
								<input type="text" id="filter-sku-nama-produk" name="filter_sku_nama_produk" class="form-control input-sm" style="height:40px;" />
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 text-right">
								<label>&nbsp;</label>
								<div>
									<span id="loadingsku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
									<button type="button" id="btn-search-sku" class="btn btn-success"><i class="fa fa-search"></i> <span name="CAPTION-SEARCH">Cari</span></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-striped" id="table-sku">
							<thead>
								<tr class="bg-primary">
									<th class="text-center" style="color:white;"><input type="checkbox" name="select-sku" id="select-sku" value="1"></th>
									<!-- <th class="text-center" style="color:white;"><span name="CAPTION-PERUSAHAAN">Perusahaan</span></th> -->
									<th class="text-center" style="color:white;"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-SKU">SKU Nama</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-info btn-choose-sku-multi"><span name="CAPTION-CHOOSE">Pilih</span></button>
				<button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-sku-detail-po" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label name="CAPTION-DETAIL">Detail</span></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<h4 class="modal-title" style="margin-left: 20px;">Barang untuk Supplier <label id="labelspullier">asd</label></h4>

				</div>
				<br>
				<br>

				<div class="row">
					<div class="col-xs-12">
						<table class="table table-striped" id="table-sku-detail-po">
							<thead>
								<tr class="bg-primary">
									<!-- <th class="text-center" style="color:white;"><input type="checkbox" name="select-sku" id="select-sku" value="1"></th> -->
									<!-- <th class="text-center" style="color:white;"><span name="CAPTION-PERUSAHAAN">Perusahaan</span></th> -->
									<th class="text-center" style="color:white;"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-SKU">SKU Nama</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-QTY">Qty</span></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" data-dismiss="modal" class="btn btn-info btn-choose-sku-multi"><span name="CAPTION-CHOOSE">Pilih</span></button> -->
				<button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-history-approval" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label name="CAPTION-HISTORY">Riwayat</label> <label>Approval</label></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-striped" id="table-history-approval">
							<thead>
								<tr class="bg-primary">
									<th class="text-center" style="color:white;"><span name="CAPTION-No">No</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-TGLAPPROVAL">Tanggal Approval</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-NODOKUMEN">No Dokumen</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-TANGGAL">Status</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-USER">Pengguna</span></th>
									<th class="text-center" style="color:white;"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<span id="loadinghistory" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
				<button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
			</div>
		</div>
	</div>
</div>