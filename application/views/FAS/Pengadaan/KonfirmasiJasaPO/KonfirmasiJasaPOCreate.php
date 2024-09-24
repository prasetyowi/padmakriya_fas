<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-BUAT">Buat</span> Konfirmasi Jasa PO</h3>
			</div>
			<div style="float: right">

			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" id="header">
					<div class="x_title">
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<input type="hidden" value="" id="hpr_id" />
						<input type="hidden" value="" id="hpo_id" />
						<input type="hidden" value="" id="hsp_id" />
						<div class="col-xs-3">
							<div class="form-group field-konfirmasijasa-penerimaan_order_kode">
								<label class="control-label" for="konfirmasijasa-penerimaan_order_kode" name="CAPTION-NOPO">No Purchase Order</label>
								<input readonly="readonly" type="text" id="purchaserequest-purchase_request_kode" class="form-control" name="purchaserequest[purchase_request_kode]" autocomplete="off" value="">
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-konfirmasijasa-penerimaan_order_kode">
								<label class="control-label" for="konfirmasijasa-penerimaan_order_kode" name="CAPTION-KODEPO">Pilih Kode PO</label>
								<select class="input-sm form-control select2" id="konfirmasijasa-purchase_order_kode" name="konfirmasijasa[purchase_order_kode]">
									<option value="">** Pilih Kode PO **</option>
									<?php foreach ($KodePo as $row) : ?>
										<option value="<?= $row['purchase_order_id'] ?>"><?= $row['purchase_order_kode'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<!-- <div class="col-xs-3">
							<div class="form-group field-konfirmasijasa-gudang_id">
								<label for="konfirmasijasa-gudang_id" class="control-label" name="CAPTION-GUDANG">Pilih Gudang</label>
								<select class="input-sm form-control select2" id="konfirmasijasa-gudang_id" name="konfirmasijasa[gudang_id]">
									<option value="">** Pilih Gudang**</option>
									<?php foreach ($Gudang as $row) : ?>
										<option value="<?= $row['gudang_id'] ?>"><?= $row['gudang_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div> -->
						<div class="col-xs-3">
							<div class="form-group field-konfirmasijasa-sales_id">
								<label for="konfirmasijasa-sales_id" class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
								<select class="input-sm form-control select2" id="konfirmasijasa-client_wms_id" name="konfirmasijasa[client_wms_id]" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required disabled readonly>
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
							<div class="form-group field-konfirmasijasa-sales_id">
								<label for="konfirmasijasa-sales_id" class="control-label" name="CAPTION-DIVISI">Divisi</label>
								<select class="input-sm form-control select2" id="konfirmasijasa-karyawan_divisi_id" name="konfirmasijasa[karyawan_divisi_id]" disabled readonly>
									<option value="">** Divisi **</option>
									<?php foreach ($Divisi as $row) : ?>
										<option value="<?= $row['karyawan_divisi_id'] ?>"><?= $row['karyawan_divisi_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

					</div>
					<div class="row">

						<div class=" col-xs-3">
							<div class="form-group field-konfirmasijasa-penerimaan_order_tgl">
								<label class="control-label" for="konfirmasijasa-penerimaan_order_tgl" name="CAPTION-TGLPR">Tanggal Purchase Order</label>
								<input type="text" id="konfirmasijasa-penerimaan_order_tgl" class="form-control datepicker" name="konfirmasijasa[penerimaan_order_tgl]" autocomplete="off" value="<?= set_value('konfirmasijasa[penerimaan_order_tgl_buat_do]') != "" ? set_value('konfirmasijasa[penerimaan_order_tgl_buat_do]') : (isset($konfirmasijasa['penerimaan_order_tgl_buat_do']) ? date('d-m-Y', strtotime($konfirmasijasa['penerimaan_order_tgl_buat_do'])) : date('d-m-Y')) ?>" disabled readonly>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-konfirmasijasa-penerimaan_order_tgl_dibutuhkan">
								<label class="control-label" for="konfirmasijasa-penerimaan_order_tgl_dibutuhkan" name="CAPTION-TGLDIBUTUHKAN">Tanggal Dibutuhkan</label>
								<input type="text" id="konfirmasijasa-penerimaan_order_tgl_dibutuhkan" class="form-control datepicker" name="konfirmasijasa[penerimaan_order_tgl_dibutuhkan]" autocomplete="off" value="<?= set_value('konfirmasijasa[penerimaan_order_tgl_buat_do]') != "" ? set_value('konfirmasijasa[penerimaan_order_tgl_buat_do]') : (isset($konfirmasijasa['penerimaan_order_tgl_buat_do']) ? date('d-m-Y', strtotime($konfirmasijasa['penerimaan_order_tgl_buat_do'])) : date('d-m-Y')) ?>" readonly disabled>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-konfirmasijasa-tipe_pengadaan_id">
								<label for="konfirmasijasa-tipe_pengadaan_id" class="control-label" name="CAPTION-TIPEPENGADAAN">Tipe Pengadaan</label>
								<select class="input-sm form-control select2" id="konfirmasijasa-tipe_pengadaan_id" name="konfirmasijasa[tipe_pengadaan_id]" disabled readonly>
									<option value="">** Pilih **</option>
									<?php foreach ($TipePengadaan as $row) : ?>
										<option value="<?= $row['tipe_pengadaan_id'] ?>"><?= $row['tipe_pengadaan_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-3" style="display:none">
							<div class="form-group field-konfirmasijasa-tipe_transaksi_id">
								<label for="konfirmasijasa-tipe_transaksi_id" class="control-label" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</label>
								<select class="input-sm form-control select2" id="konfirmasijasa-tipe_transaksi_id" name="konfirmasijasa[tipe_transaksi_id]" disabled readonly>
									<option value="">** Pilih **</option>
									<?php foreach ($TipeTransaksi as $row) : ?>
										<option value="<?= $row['tipe_transaksi_id'] ?>"><?= $row['tipe_transaksi_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>


					</div>
					<div class="row">

						<div class="col-xs-3">
							<div class="form-group field-konfirmasijasa-penerimaan_order_nm_supplier">
								<label class="control-label" for="konfirmasijasa-penerimaan_nm_supplier" name="CAPTION-SUPPLIER">Supplier</label>
								<input type="text" id="konfirmasijasa-penerimaan_nm_supplier" class="form-control " name="konfirmasijasa[penerimaan_nm_supplier]" autocomplete="off" value="-" readonly disabled>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-konfirmasijasa-penerimaan_order_status">
								<label class="control-label" for="konfirmasijasa-penerimaan_order_status">Status</label>
								<input type="text" class="form-control" id="konfirmasijasa-penerimaan_order_status" name="konfirmasijasa[penerimaan_order_status]" value="Draft" disabled readonly>
							</div>
							<!-- <div class="form-group field-konfirmasijasa-pr_is_need_approval">
                                <input type="checkbox" id="konfirmasijasa-pr_is_need_approval" name="konfirmasijasa[pr_is_need_approval]" autocomplete="off" value="1"> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
                            </div> -->
						</div>
						<div class="col-xs-6">
							<div class="form-group field-konfirmasijasa-penerimaan_order_keterangan">
								<label class="control-label" for="konfirmasijasa-penerimaan_order_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
								<textarea class="form-control" id="konfirmasijasa-penerimaan_order_keterangan" name="konfirmasijasa[penerimaan_order_keterangan]" disabled readonly></textarea>
							</div>
						</div>
					</div>
					<div class="row">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="panel-barang">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4 class="pull-left" name="CAPTION-REQBARANG">Request Jasa</h4>
					<!-- <div class="pull-right"><button data-toggle="modal" data-target="#modal-sku" id="btn-choose-prod-delivery" class="btn btn-success" type="button"><i class="fa fa-search"></i> <span name="CAPTION-CHOOSE" style="color:white;">Pilih</span></button></div> -->
					<div class="clearfix"></div>
				</div>
				<div style="overflow-x:auto;">
					<table class="table table-striped" id="tablebarangpo" style="width:100%;">
						<thead>
							<thead>
								<tr class="bg-primary">

									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-NO">No.</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUKODE">Kode</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUNAMA">Nama</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-QTYPO">Qty PO</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-QTYPOSISA">Qty PO Sisa</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-QTYPOTERIMA">Qty PO Terima</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-QTYPOAKANDITERIMA">Qty PO akan diterima</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUHARGA">Sku Harga</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
									<th style="color:white;vertical-align: middle;display:none;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
								</tr>
							</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div style="float: right">
				<a href="<?= base_url('FAS/Pengadaan/KonfirmasiJasaPO/KonfirmasiJasaPOMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
				<button class="btn-submit btn btn-success" id="btnsavekonfirmasijasapo"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span>
					<button class="btn-submit btn btn-danger" id="btnkonfirmasikonfirmasijasapo"><i class="fa fa-save"></i> <span name="CAPTION-KONFIRMASI" style="color:white;">Konfirmasi</span></button>
			</div>
		</div>
	</div>
</div>