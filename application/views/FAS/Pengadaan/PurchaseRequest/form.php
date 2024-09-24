<style type="text/css">
	.modal-body {
		max-height: calc(100vh - 210px);
		overflow-x: auto;
		overflow-y: auto;
	}

	.invalid-feedback {
		color: red;
	}

	.invalid-feedback {
		color: red;
	}

	.fa-spin {
		animation: sp-anime 0.8s infinite linear;
	}

	@keyframes sp-anime {
		100% {
			transform: rotate(360deg);
		}
	}

	.principle-brand-btn {
		position: relative;
		height: 30px;
		background: #333;
		border-radius: 4px;
		display: flex;
		justify-content: center;
		align-items: center;
		transition: 0.5s;
		box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
		overflow: hidden;
		text-decoration: none;
	}

	.principle-brand-btn.active {
		background: green;
	}

	.principle-brand-btn span {
		position: absolute;
		right: 20px;
		width: 15px;
		height: 15px;
		display: inline-block;
		background: #fff;
		border-bottom-left-radius: 3px;
		border-bottom-right-radius: 3px;
		transition: 0.5s;
	}

	.principle-brand-btn:hover span {
		transform: scale(1.5) rotate(-60deg) translateY(10px);
	}

	.principle-brand-btn.active span {
		left: 50%;
		transform: translateX(-50%) rotate(-45deg);
		border-radius: 0;
		width: 20px;
		height: 10px;
		background: transparent;
		border-left: 2px solid #fff;
		border-bottom: 2px solid #fff;
	}

	.principle-brand-btn span::before {
		content: '';
		position: absolute;
		top: -3px;
		right: 0;
		width: 100%;
		height: 2px;
		background: #fff;
		box-shadow: 12px -2px 0 #333, 12px -3px 0 #333, 15px -1px 0 #333, 3px -2px 0 #fff;
		transition: 0.5s
	}

	.principle-brand-btn.active:hover span::before,
	.principle-brand-btn.active span::before {
		transform: scale(0);
	}

	.principle-brand-btn:hover span::before {
		transform: rotate(90deg) translateX(-50%) translateY(-10px);
	}

	.principle-brand-btn text {
		position: absolute;
		left: 20px;
		color: #fff;
		font-size: 12px;
		transition: 0.5s;
	}

	.principle-brand-btn:hover text,
	.principle-brand-btn.active text {
		transform: translateX(120px) translateY(-5px) scale(0);
	}

	#list_principle_brand,
	#list_principle_brand_update {
		display: flex;
		flex-wrap: wrap;
		justify-content: start;
	}
</style>

<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-BUAT">Buat</span> Purchase Request</h3>
			</div>
			<div style="float: right">
				<button data-toggle="modal" data-target="#modal-history-approval" id="btn-history-approval" class="btn btn-success" type="button"><i class="fa fa-clock"></i> <span name="CAPTION-HISTORY" style="color:white;">Riwayat</span></button>
			</div>
		</div>
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
								<input readonly="readonly" type="text" id="purchaserequest-purchase_request_kode" class="form-control" name="purchaserequest[purchase_request_kode]" autocomplete="off" value="">
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-sales_id">
								<label for="purchaserequest-sales_id" class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
								<select class="input-sm form-control select2" id="purchaserequest-client_wms_id" name="purchaserequest[client_wms_id]" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required>
									<?php if (count($Perusahaan) == 1) { ?>

										<?php foreach ($Perusahaan as $row) : ?>
											<option value="<?= $row['client_wms_id'] ?>" <?= ($row['client_wms_id']  == $this->session->userdata('client_wms_id') ? "selected" : "") ?>><?= $row['client_wms_nama'] ?></option>
										<?php endforeach; ?>
									<?php } else { ?>
										<option value="">-- ALL --</option>
										<?php foreach ($Perusahaan as $row) : ?>
											<option value="<?= $row['client_wms_id'] ?>">
												<?= $row['client_wms_nama'] ?></option>
										<?php endforeach; ?>
									<?php } ?>

								</select>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-purchase_request_tgl">
								<label class="control-label" for="purchaserequest-purchase_request_tgl" name="CAPTION-TGLPR">Tanggal Purchase Request</label>
								<input type="text" id="purchaserequest-purchase_request_tgl" class="form-control datepicker" name="purchaserequest[purchase_request_tgl]" autocomplete="off" value="<?= set_value('purchaserequest[purchase_request_tgl_buat_do]') != "" ? set_value('purchaserequest[purchase_request_tgl_buat_do]') : (isset($purchaserequest['purchase_request_tgl_buat_do']) ? date('d-m-Y', strtotime($purchaserequest['purchase_request_tgl_buat_do'])) : date('d-m-Y')) ?>">
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-purchase_request_tgl_dibutuhkan">
								<label class="control-label" for="purchaserequest-purchase_request_tgl_dibutuhkan" name="CAPTION-TGLDIBUTUHKAN">Tanggal Dibutuhkan</label>
								<input type="text" id="purchaserequest-purchase_request_tgl_dibutuhkan" class="form-control datepicker" name="purchaserequest[purchase_request_tgl_dibutuhkan]" autocomplete="off" value="<?= set_value('purchaserequest[purchase_request_tgl_buat_do]') != "" ? set_value('purchaserequest[purchase_request_tgl_buat_do]') : (isset($purchaserequest['purchase_request_tgl_buat_do']) ? date('d-m-Y', strtotime($purchaserequest['purchase_request_tgl_buat_do'])) : date('d-m-Y')) ?>">
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
										<option value="<?= $row['tipe_pengadaan_id'] ?>"><?= $row['tipe_pengadaan_nama'] ?></option>
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
										<option value="<?= $row['karyawan_divisi_id'] ?>"><?= $row['karyawan_divisi_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-3" style="display:none">
							<div class="form-group field-purchaserequest-tipe_transaksi_id">
								<label for="purchaserequest-tipe_transaksi_id" class="control-label" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</label>
								<select class="input-sm form-control select2" id="purchaserequest-tipe_transaksi_id" name="purchaserequest[tipe_transaksi_id]">
									<option value="">** Pilih **</option>
									<?php foreach ($TipeTransaksi as $row) : ?>
										<option value="<?= $row['tipe_transaksi_id'] ?>"><?= $row['tipe_transaksi_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-kategori_biaya_id" style="display:none;">
								<label for="purchaserequest-kategori_biaya_id" class="control-label" name="CAPTION-KATEGORIBIAYA">Kategori Biaya</label>
								<select class="input-sm form-control select2" id="purchaserequest-kategori_biaya_id" name="purchaserequest[kategori_biaya_id]">
									<option value="">** Pilih **</option>
									<?php foreach ($KategoriBiaya as $row) : ?>
										<option value="<?= $row['kategori_biaya_id'] ?>"><?= $row['kategori_biaya_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-tipe_biaya_id" style="display:none;">
								<label for="purchaserequest-tipe_biaya_id" class="control-label" name="CAPTION-TIPEBIAYA">Tipe Biaya</label>
								<select class="input-sm form-control select2" id="purchaserequest-tipe_biaya_id" name="purchaserequest[tipe_biaya_id]">
									<option value="">** Pilih **</option>
									<?php foreach ($TipeBiaya as $row) : ?>
										<option value="<?= $row['tipe_biaya_id'] ?>"><?= $row['tipe_biaya_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-3" style="display:none;">
							<div class="form-group field-purchaserequest-tipe_kepemilikan_id">
								<label for="purchaserequest-sales_id" class="control-label" name="CAPTION-KEPEMILIKAN">Kepemilikan</label>
								<select class="input-sm form-control select2" id="purchaserequest-tipe_kepemilikan_id" name="purchaserequest[tipe_kepemilikan_id]">
									<option value="">** Kepemilikan **</option>
									<?php foreach ($TipeKepemilikan as $row) : ?>
										<option value="<?= $row['tipe_kepemilikan_id'] ?>"><?= $row['tipe_kepemilikan_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-purchase_request_pemohon">
								<label class="control-label" for="purchaserequest-purchase_request_pemohon" name="CAPTION-PEMOHON">Pemohon</label>
								<input type="text" id="purchaserequest-purchase_request_pemohon" class="form-control" name="purchaserequest[purchase_request_pemohon]" autocomplete="off" value="">
							</div>
						</div>
					</div>
					<div class="row" style="display:none;">

						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-purchase_request_pemohon">
								<label class="control-label" name="CAPTION-PILIHTAHUNANGGARAN">Pilih Tahun Anggaran</label>
								<input type="text" id="purchaserequest-purchase_request_anggaran_detail_tahun" name="purchaserequest-purchase_request_anggaran_detail_tahun" class="txtjudul form-control" value="<?= date("Y"); ?>" disabled />
								<!-- <select id="approval_anggaran_detail_tahun" name="approval_anggaran_detail_tahun" class="form-control custom-select"> -->
								<!-- <option value="<?= date('Y'); ?>" selected><?= date('Y'); ?></option>
                                                <?php foreach ($rangeYear as $item) : ?>
                                                    <option value="<?php echo $item ?>">
                                                        <?php echo $item ?></option>
                                                <?php endforeach; ?> -->
								<!-- </select> -->
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-purchase_request_pemohon">
								<label class="control-label" name="CAPTION-PILIHANGGARAN">Pilih Anggaran</label>
								<select id="purchaserequest-purchase_request_add_anggaran_detail_2" name="purchaserequest-purchase_request_add_anggaran_detail_2" class="form-control custom-select select2">
									<option value="">--PILIH--</option>
								</select>
							</div>
						</div>

						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-purchase_request_pemohon">
								<label class="control-label" name="CAPTION-NAMAPENERIMA">Nama
									Penerima</label>
								<input type="text" id="purchaserequest-purchase_request_add_nama_penerima" name="purchaserequest-purchase_request_add_nama_penerima" class="txtno_rekening form-control" />
							</div>
						</div>
					</div>
					<div class="row" style="display:none;">
						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-purchase_request_pemohon">
								<label class="control-label" name="CAPTION-DEFAULTPEMBAYARAN">Default
									Pembayaran</label>
								<select id="purchaserequest-purchase_request_add_default_pembayaran" name="purchaserequest-purchase_request_add_default_pembayaran" class="cbdefaultpembayaran form-control select2">
									<option value="Tunai"><label name="CAPTION-TUNAI">Tunai</label></option>
									<option value="Non Tunai"> <label name="CAPTION-NONTUNAI">Non
											Tunai</label></option>
								</select>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-purchase_request_pemohon">
								<label class="control-label" name="CAPTION-BANKPENERIMA">Bank Penerima</label>
								<select id="purchaserequest-purchase_request_add_bank" class="form-control custom-select select2" disabled>
									<option value="">-- <label name="CAPTION-PILIHBANK">Pilih Bank</label>
										--</option>
									<?php foreach ($bank as $key => $value) { ?>
										<option value="<?= $value['bank_account_id'] ?>">
											<?= $value['bank_account_nama'] ?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-purchase_request_pemohon">
								<label class="control-label" name="CAPTION-NOREKENING">No.
									Rekening</label>
								<input type="text" id="purchaserequest-purchase_request_add_no_rekening" name="add_no_rekening" class="txtno_rekening form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled />
							</div>
						</div>


					</div>
					<div class="row">

						<div class="col-xs-3">
							<label class="control-label" name="CAPTION-JUDUL">Judul</label>
							<div class="form-group field-purchaserequest-purchase_request_pemohon">
								<input type="text" id="purchaserequest-purchase_request_add_judul" name="purchaserequest-purchase_request_add_judul" class="txtjudul form-control" />
							</div>
						</div>

						<div class="col-xs-3">
							<div class="form-group field-purchaserequest-purchase_request_status">
								<label class="control-label" for="purchaserequest-purchase_request_status">Status</label>
								<input type="text" class="form-control" id="purchaserequest-purchase_request_status" name="purchaserequest[purchase_request_status]" value="Draft" readonly>
							</div>
							<div class="form-group field-purchaserequest-pr_is_need_approval">
								<input type="checkbox" id="purchaserequest-pr_is_need_approval" name="purchaserequest[pr_is_need_approval]" autocomplete="off" value="1"> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group field-purchaserequest-purchase_request_keterangan">
								<label class="control-label" for="purchaserequest-purchase_request_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
								<textarea class="form-control" id="purchaserequest-purchase_request_keterangan" name="purchaserequest[purchase_request_keterangan]"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="x_panel">
			<div class="x_title">
				<h5 name="CAPTION-UPLOADATTACHMENT">Upload Attachment</h5>
				<div class="clearfix"></div>
			</div>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-FILE">File</label>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<input type="file" id="add_file" name="add_file" class="txtnilai form-control" accept="application/pdf,application/vnd.ms-excel" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="panel-barang">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4 class="pull-left" name="CAPTION-REQBARANG">Request Barang</h4>
					<!-- <div class="pull-right"><button data-toggle="modal" data-target="#modal-sku" id="btn-choose-prod-delivery" class="btn btn-success" type="button"><i class="fa fa-search"></i> <span name="CAPTION-CHOOSE" style="color:white;">Pilih</span></button></div> -->
					<div class="pull-right"><button data-toggle="modal" id="btn-choose-prod-delivery" class="btn btn-success" type="button"><i class="fa fa-search"></i> <span name="CAPTION-CHOOSE" style="color:white;">Pilih</span></button></div>
					<div class="clearfix"></div>
				</div>
				<div style="overflow-x:auto;">
					<table class="table table-striped" id="table-req-barang" style="width:100%;">
						<thead>
							<tr class="bg-primary">
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-NO">No.</span></th>
								<th class="text-center" style="display:none;"></th>
								<th class="text-center" style="color:white;vertical-align: middle;" colspan="2" rowspan="2"><span name="CAPTION-SUPPLIER">Supplier</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUKODE">Kode</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUNAMA">Nama</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-HARGASATUAN">Harga Satuan</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" colspan="2"><span name="CAPTION-REQUEST">Request</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" colspan="2"><span name="CAPTION-APPROVED">Approved</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-QTYPO">Qty PO</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-QTYTERIMA">Qty Terima</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-NOPO">No PO</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2">Action</th>
							</tr>
							<tr class="bg-primary">
								<th class=" text-center" style="color:white;vertical-align: middle;"><span name="CAPTION-QTY">Qty</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;"><span name="CAPTION-SUBTOTAL">SUB Total</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;"><span name="CAPTION-QTY">Qty</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;"><span name="CAPTION-SUBTOTAL">SUB Total</span></th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div style="float: right">
				<a href="<?= base_url('FAS/Pengadaan/PurchaseRequest/PurchaseRequestMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
				<button class="btn-submit btn btn-success" id="btnsavepr"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span></button>
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

<div class="modal fade" id="modal-supplier" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" style="width: 80%;">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label name="CAPTION-CARI">Cari</label> <label>Supplier</label></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<h4 class="modal-title" style="margin-left: 20px;">Supplier untuk produk <label id="labelnamasku"></label></h4>

				</div>
				<br>
				<div class="row">
					<div class="col-xs-12">
						<button type="button" id="btnaddnewprinciple" style="display: none;" class="btn btn-success"><i class="fa fa-search"></i> <span name="CAPTION-TAMBAH">Tambah</span></button>&nbsp;
						<button type="button" id="btnpilihsupplier" class="btn btn-primary"><i class="fa fa-search"></i> <span name="CAPTION-PILIH">Pilih <label>Supplier</label></span></button>
						<span id="loadingsupplier" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
						<input type="hidden" class="form-control" name="txtindex" id="txtindex" value="" />
						<input type="hidden" class="form-control" name="txtskubid" id="txtskubid" value="" />

						<table id="tableprinciplemenu" width="100%" class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Supplier</th>
									<th>Alamat Supplier</th>
									<th>Kota</th>
									<th>Harga</th>
									<th style="display: none;"></th>
									<th style="display: none;"></th>
									<th style="display: none;"></th>
									<th style="display: none;"></th>
									<th style="display: none;"></th>
									<th style="display: none;"></th>
									<!-- <th></th> -->
									<!-- <th>Kode Principle</th>
                  <th>Nama Principle</th>
                  <th>Alamat Principle</th>
                  <th>Telepon Principle</th>
                  <th>Nama Contact Person</th>
                  <th>Telepon Contact Person</th>-->
									<th>Who Update</th>
									<th>Last Update</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info btn-choose-supplier-multi"><span name="CAPTION-CHOOSE">Pilih</span></button>
				<button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-pilihsupplier" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" style="width: 80%;">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label name="CAPTION-PILIH">Pilih</label> <label>Supplier</label></h4>
			</div>
			<div class="modal-body">
				<br>
				<div class="row">
					<div class="col-xs-4" style="display:none;">
						<label name="CAPTION-PERUSAHAAN">Cari Area</label>
						<select id="filter-area" name="filter_area" class="form-control input-sm select2" style="width:100%;">
							<option value="">-- Pilih Area --</option>
							<?php foreach ($Area as $type) : ?>
								<option value="<?= $type['area_id'] ?>"><?= $type['area_nama'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-xs-4">
						<label name="CAPTION-NAMASUPPLIER">Nama Supplier</label>
						<input type="text" id="txtnamasupplier" name="txtnamasupplier" class=" form-control input-sm" style="height:40px;" placeholder="Cari nama supplier" />
					</div>
					<div class="row">
						<div class="col-xs-12 text-right">
							<label>&nbsp;</label>
							<div>
								<span id="loadingsku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
								<button type="button" id="btn-search-supplier" class="btn btn-success"><i class="fa fa-search"></i> <span name="CAPTION-SEARCH">Cari</span></button>
							</div>
						</div>
					</div>
				</div>
				<br>
				<br>
				<div class="row">
					<div class="col-xs-12">

						<input type="hidden" class="form-control" name="txtindex" id="txtindex" value="" />
						<input type="hidden" class="form-control" name="txtskubidplsupplier" id="txtskubidplsupplier" value="" />

						<table id="tablepilihsupplier" width="100%" class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Supplier</th>
									<th>Alamat Supplier</th>
									<th>Kota</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info btn-choose-supplier-insert"><span name="CAPTION-CHOOSE">Pilih</span></button>
				<button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-history-approval" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" style="width: 80%;">
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

<div class="modal fade" id="previewaddnewprinciple" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" style="width: 80%;">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><label>Tambah Data Supplier</label></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
								<div class="form-group txtkode_coorporate_principle">
									<label>Kode</label>
									<input type="text" class="form-control" name="txtkode_coorporate_principle" id="txtkode_coorporate_principle" placeholder="Kode Principle" required />
									<div class="invalid-feedback invalid_kode_corporate_principle"></div>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
								<div class="form-group txtname_coorporate_principle">
									<label>Nama</label>
									<input type="text" class="form-control" name="txtname_coorporate_principle" id="txtname_coorporate_principle" placeholder="Nama Principle" required />
									<div class="invalid-feedback invalid_nama_corporate_principle"></div>
								</div>
							</div>
						</div>

						<div class="form-group txtaddress_coorporate_principle">
							<label>Alamat</label>
							<textarea type="text" class="form-control" rows="3" name="txtaddress_coorporate_principle" id="txtaddress_coorporate_principle" placeholder="Alamat Principle" required></textarea>
							<div class="invalid-feedback invalid_alamat_corporate_principle"></div>
						</div>

						<!-- <div class="form-group listcoorporate-group">
                            <label>Coorporate Group</label>
                            <select class="form-control" name="listcoorporate-group" id="listcoorporate-group">
                                <option value="">--Pilih Coorporate Group--</option>
                            </select>
                        </div> -->

						<div class="form-group txtphone_coorporate_principle">
							<label>Telepon</label>
							<input type="text" class="form-control numeric" name="txtphone_coorporate_principle" id="txtphone_coorporate_principle" placeholder="Telepon Principle" required />
							<div class="invalid-feedback invalid_telepon_corporate"></div>
						</div>

						<div class="form-group listcoorporate_province_principle">
							<label>Provinsi</label>
							<select class="select2 form-control" name="listcoorporate_province_principle" id="listcoorporate_province_principle" required>

							</select>
							<div class="invalid-feedback invalid_provinsi_corporate_principle"></div>
						</div>

						<div class="form-group listcoorporate_city_principle">
							<label>Kota</label>
							<select class="select2 form-control" name="listcoorporate_city_principle" id="listcoorporate_city_principle" required>

							</select>
							<div class="invalid-feedback invalid_kota_corporate_principle"></div>
						</div>

						<div class="form-group listcoorporate_districts_principle">
							<label>Kecamatan</label>
							<select class="select2 form-control" name="listcoorporate_districts_principle" id="listcoorporate_districts_principle" required>

							</select>
							<div class="invalid-feedback invalid_kecamatan_corporate_principle"></div>
							<input type="hidden" id="data_districts_principle" />
						</div>

						<div class="form-group listcoorporate_ward_principle">
							<label>Kelurahan</label>
							<select class="select2 form-control" name="listcoorporate_ward_principle" id="listcoorporate_ward_principle" required>

							</select>
							<div class="invalid-feedback invalid_kelurahan_corporate_principle"></div>
							<input type="hidden" id="data_ward_principle" />
						</div>

						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
								<div class="form-group txtpostalcode_coorporate_principle">
									<label>Kode Pos</label>
									<input type="text" class="form-control" name="txtpostalcode_coorporate_principle" id="txtpostalcode_coorporate_principle" placeholder="Kode Pos sesuai alamat" required />
									<div class="invalid-feedback invalid_kode_pos_corporate_principle"></div>
								</div>

								<div class="form-group listcoorporate_stretclass_principle">
									<label>Kelas Jalan berdasarkan barang muatan</label>
									<select class="select2 form-control" name="listcoorporate_stretclass_principle" id="listcoorporate_stretclass_principle" required>
									</select>
									<div class="invalid-feedback invalid_kelas_jalan_corporate_principle"></div>
								</div>

								<div class="form-group txtlattitude_coorporate_principle">
									<label>Lattitude</label>
									<input type="text" class="form-control" name="txtlattitude_coorporate_principle" id="txtlattitude_coorporate_principle" placeholder="Lattitude Principle" required />
									<div class="invalid-feedback invalid_lattitude_corporate_principle"></div>
								</div>

								<div class="form-group">
									<label>Principle Brand</label>
									<input type="text" class="form-control" name="tambah_principle_brand" class="tambah_principle_brand" id="tambah_principle_brand" placeholder="Nama brand" />
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
								<div class="form-group listcoorporate_area_principle">
									<label>Area</label>
									<select class="select2 form-control" name="listcoorporate_area_principle" id="listcoorporate_area_principle" required>
									</select>
									<div class="invalid-feedback invalid_area_corporate_principle"></div>
								</div>

								<div class="form-group listcoorporate_stretclass2_principle">
									<label>Kelas Jalan berdasarkan fungsi jalan</label>
									<select class="select2 form-control" name="listcoorporate_stretclass2_principle" id="listcoorporate_stretclass2_principle" required>
									</select>
									<div class="invalid-feedback invalid_kelas_jalan2_corporate_principle"></div>
								</div>

								<div class="form-group txtlongitude_coorporate_principle">
									<label>Longitude</label>
									<input type="text" class="form-control" name="txtlongitude_coorporate_principle" id="txtlongitude_coorporate_principle" placeholder="Longitude Principle" required />
									<div class="invalid-feedback invalid_longitude_corporate_principle"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
						<h5 class="text-center badge badge-info">Contact Person</h5>

						<div class="form-group txtname_contact_person_principle">
							<label>Nama</label>
							<input type="text" class="form-control" name="txtname_contact_person_principle" id="txtname_contact_person_principle" placeholder="Nama Contact Person" required />
							<div class="invalid-feedback invalid_nama_contact_person_principle"></div>
						</div>

						<div class="form-group txtphone_contact_person_principle">
							<label>Telepon</label>
							<input type="text" class="form-control numeric" name="txtphone_contact_person_principle" id="txtphone_contact_person_principle" placeholder="Telepon Contact Person" required />
							<div class="invalid-feedback invalid_telepon_contact_person_principle"></div>
						</div>

						<div class="form-group txtkreditlimit_contact_person_principle">
							<label>Kredit Limit</label>
							<input type="text" class="form-control numeric" name="txtkreditlimit_contact_person_principle" id="txtkreditlimit_contact_person_principle" placeholder="Kredit Limit Contact Person" required />
							<div class="invalid-feedback invalid_kredit_limit_contact_person_principle"></div>
						</div>

						<!-- <div class="form-group">
                            <input type="checkbox" class="form-check-input" id="iskoordinat_principle">
                            <label class="form-check-label" for="iskoordinat_principle">Titik Ambil Sesuai Alamat?</label>
                        </div>
                        <div id="showiskoordinat_principle">
                            <div class="form-group listaddressget_contact_person_principle">
                                <label for="listaddressget_contact_person_principle">Alamat Ambil</label>
                                <select class="form-control" name="listaddressget_contact_person_principle" id="listaddressget_contact_person_principle" required>
                                    <option value="">--Pilih Alamat--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                                <div class="invalid-feedback invalid_addressget_contact_person_principle"></div>
                            </div>
                            <div class="form-group">
                                <textarea type="text" class="form-control mt-1" rows="3" name="txtaddressget_contact_person_principle" id="txtaddressget_contact_person_principle" placeholder="Superindo Margorejo" required></textarea>
                                <div class="invalid-feedback invalid_address_contact_person_principle"></div>
                            </div>
                        </div> -->

						<div class="form-group">
							<label>Waktu Operasional</label>
							<div class="table-responsive">
								<table class="table table-striped" id="list_day_operasional_principle">
									<thead>
										<tr>
											<td width="5%">No.</td>
											<td width="10%">Hari</td>
											<td width="10%">Jam Buka</td>
											<td width="10%">Jam Tutup</td>
											<td width="30%">Status</td>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>

						<div class="form-group">
							<input type="checkbox" class="form-check-input" checked required id="txtstatus_principle">
							<label class="form-check-label" for="txtstatus_principle">Status Aktif</label>
						</div>
					</div>
				</div>

				<div class="container">
					<div id="list_principle_brand"></div>
				</div>
			</div>
			<div class="modal-footer">
				<span id="loadingaddprinciple" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
				<button type="button" class="btn btn-success" id="btnsaveaddnewprinciple">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" id="btnbackprinciple">Kembali</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="previewaddnewsupplier" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" style="width: 80%;">
		<!-- Modal content-->
		<div class="modal-content modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal">&times;</button <h4 class="modal-title"><label>Tambah Data Supplier</label></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
						<div class="form-group rbmode">
							<!-- <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                <label class="control-label col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">Head Office</label>
                <input type="radio" style="margin-left: -25px;margin-top: -2px;" class="checkbox_form col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" id="rbheadoffice" name="rbmode" checked="checked" />
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                <label class="control-label col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">Cabang</label>
                <input type="radio" style="margin-left: -50px; margin-top: -2px;" class="checkbox_form col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" id="rbcabang" name="rbmode" />
              </div> -->
						</div>

						<div class="form-group txtname-supplier">
							<label>Nama</label>
							<input type="text" class="form-control<?php if (form_error('name_supplier')) echo 'has-error'; ?>" name="txtname-supplier" id="txtname-supplier" placeholder="Nama Supplier" required />
							<div class="invalid-feedback invalid-nama-supplier"></div>
							<?= form_error('name_supplier', '<small class="text-danger pl-2" style="margin-top:3px;">', '</small>'); ?>
						</div>

						<div class="form-group txtaddress-supplier">
							<label>Alamat</label>
							<textarea type="text" class="form-control" rows="3" name="txtaddress-supplier" id="txtaddress-supplier" placeholder="Alamat Supplier" required></textarea>
							<div class="invalid-feedback invalid-alamat-supplier"></div>
						</div>

						<!-- <div class="form-group listsupplier-group">
                            <label>supplier Group</label>
                            <select class="form-control" name="listsupplier-group" id="listsupplier-group">
                                <option value="">--Pilih supplier Group--</option>
                            </select>
                        </div> -->

						<div class="form-group txtphone-supplier">
							<label>Telepon</label>
							<input type="text" class="form-control numeric <?php if (form_error('phone_supplier')) echo 'has-error'; ?>" name="txtphone-supplier" id="txtphone-supplier" placeholder="Telepon Supplier" required />
							<div class="invalid-feedback invalid-telepon-supplier"></div>
							<?= form_error('phone_supplier', '<small class="text-danger pl-2" style="margin-top:3px;">', '</small>'); ?>
						</div>

						<div class="form-group listsupplier-province">
							<label>Provinsi</label>
							<select class="select2 form-control" name="listsupplier-province" id="listsupplier-province" required>

							</select>
							<div class="invalid-feedback invalid-provinsi-supplier"></div>
						</div>

						<div class="form-group listsupplier-city">
							<label>Kota</label>
							<select class="select2 form-control" name="listsupplier-city" id="listsupplier-city" required>

							</select>
							<div class="invalid-feedback invalid-kota-supplier"></div>
						</div>

						<div class="form-group listsupplier-districts">
							<label>Kecamatan2</label>
							<select class="select2 form-control" name="listsupplier-districts" id="listsupplier-districts" required>

							</select>
							<div class="invalid-feedback invalid-kecamatan-supplier"></div>
							<input type="hidden" id="data-districts" />
						</div>

						<div class="form-group listsupplier-ward">
							<label>Kelurahan</label>
							<select class="select2 form-control" name="listsupplier-ward" id="listsupplier-ward" required>

							</select>
							<div class="invalid-feedback invalid-kelurahan-supplier"></div>
							<input type="hidden" id="data-ward" />
						</div>

						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
								<div class="form-group txtpostalcode-supplier">
									<label>Kode Pos</label>
									<input type="text" class="form-control numeric" name="txtpostalcode-supplier" id="txtpostalcode-supplier" placeholder="Kode Pos sesuai alamat" required />
									<div class="invalid-feedback invalid-kode-pos-supplier"></div>
								</div>

								<div class="form-group listsupplier-stretclass">
									<label>Kelas Jalan Berdasarkan Beban muatan</label>
									<select class="select2 form-control" name="listsupplier-stretclass" id="listsupplier-stretclass" required>
									</select>
									<div class="invalid-feedback invalid-kelas-jalan-supplier"></div>
								</div>

								<div class="form-group listsupplier-stretclass2">
									<label>Kelas Jalan Berdasarkan Fungsi jalan</label>
									<select class="select2 form-control" name="listsupplier-stretclass2" id="listsupplier-stretclass2" required>
									</select>
									<div class="invalid-feedback invalid-kelas-jalan2-supplier"></div>
								</div>

								<div class="form-group">
									<input type="checkbox" class="form-check-input" checked required id="txtstatus-supplier">
									<label class="form-check-label" for="txtstatus-supplier">Status Aktif</label>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
								<div class="form-group listarea-header">
									<label>Wilayah</label>
									<select class="select2 form-control" name="listarea-header" id="listarea-header" required>
										<option value="">--Pilih Wilayah--</option>
									</select>
									<div class="invalid-feedback invalid-area-header"></div>
								</div>

								<div class="form-group listsupplier-area">
									<label>Area</label>
									<select class="select2 form-control" name="listsupplier-area" id="listsupplier-area" required>

									</select>
									<div class="invalid-feedback invalid-area-supplier"></div>
								</div>

								<div class="form-group txtlattitude-supplier">
									<label>Lattitude</label>
									<input type="text" class="form-control " name="txtlattitude-supplier" id="txtlattitude-supplier" placeholder="Lattitude Supplier" required />
									<div class="invalid-feedback invalid-lattitude-supplier"></div>
								</div>

								<div class="form-group txtlongitude-supplier">
									<label>Longitude</label>
									<input type="text" class="form-control " name="txtlongitude-supplier" id="txtlongitude-supplier" placeholder="Longitude Supplier" required />
									<div class="invalid-feedback invalid-longitude-supplier"></div>
								</div>
							</div>
						</div>

					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
						<h5 class="text-center badge badge-info">Contact Person</h5>

						<div class="form-group txtname-contact-person">
							<label>Nama</label>
							<input type="text" class="form-control" name="txtname-contact-person" id="txtname-contact-person" placeholder="Nama Contact Person" required />
							<div class="invalid-feedback invalid-nama-contact-person"></div>
						</div>

						<div class="form-group txtphone-contact-person">
							<label>Telepon</label>
							<input type="text" class="form-control numeric" name="txtphone-contact-person" id="txtphone-contact-person" placeholder="Telepon Contact Person" required />
							<div class="invalid-feedback invalid-telepon-contact-person"></div>
						</div>

						<div class="form-group txtkreditlimit-contact-person">
							<!-- <label>Kredit Limit</label> -->
							<input type="hidden" class="form-control numeric" name="txtkreditlimit-contact-person" id="txtkreditlimit-contact-person" placeholder="Kredit Limit Contact Person" required />
							<!-- <div class="invalid-feedback invalid-kredit-limit-contact-person"></div> -->
						</div>

						<div class="form-group">
							<label>Segmentasi 1</label>
							<select class="select2 form-control" name="listcontactperson-segment1" id="listcontactperson-segment1">

							</select>
						</div>

						<div class="form-group">
							<label>Segmentasi 2</label>
							<select class="select2 form-control" name="listcontactperson-segment2" id="listcontactperson-segment2">

							</select>
						</div>

						<div class="form-group">
							<label>Segmentasi 3</label>
							<select class="select2 form-control" name="listcontactperson-segment3" id="listcontactperson-segment3">

							</select>
						</div>

						<div class="form-group form-check">
							<input type="checkbox" class="form-check-input" id="multilocation">
							<label class="form-check-label" for="multilocation">Multi Lokasi?</label>
						</div>
						<div class="form-group listcontactperson-location" id="showlistmultilokasi" style="display:none">
							<label for="listcontactperson-location">Lokasi</label><br>
							<select class="select2 form-control" name="listcontactperson-location" id="listcontactperson-location">

							</select>
							<div class="invalid-feedback invalid-list-location-contact-person"></div>
						</div>

						<div class="form-group">
							<label>Waktu Operasional</label>
							<div class="table-responsive">
								<table class="table table-striped" id="list-day-operasional">
									<thead>
										<tr>
											<td width="5%">No.</td>
											<td width="10%">Hari</td>
											<td width="10%">Jam Buka</td>
											<td width="10%">Jam Tutup</td>
											<td width="30%">Status</td>
											<td width="10%">Pengiriman</td>
											<td width="10%">Penagihan</td>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<span id="loadingadd" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
				<button type="button" class="btn btn-success" id="btnsaveaddnewsupplier">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" id="btnback">Kembali</button>
			</div>
		</div>
	</div>
</div>