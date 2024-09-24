<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-BUAT">Buat</span> <span name="CAPTION-PENERIMAANQTYPOBARANG">Penerimaan Qty PO Barang</span></h3>
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
							<div class="form-group field-penerimaanorder-penerimaan_order_kode">
								<label class="control-label" for="penerimaanorder-penerimaan_order_kode" name="CAPTION-NOPB">Penerimaan Barang PO</label>
								<input readonly="readonly" type="text" id="purchaserequest-purchase_request_kode" class="form-control" name="purchaserequest[purchase_request_kode]" autocomplete="off" value="">
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-penerimaanorder-penerimaan_order_kode">
								<label class="control-label" for="penerimaanorder-penerimaan_order_kode" name="CAPTION-KODEPO">Pilih Kode PO</label>
								<select class="input-sm form-control select2" id="penerimaanorder-purchase_order_kode" name="penerimaanorder[purchase_order_kode]">
									<option value="">** Pilih Kode PO **</option>
									<?php foreach ($KodePo as $row) : ?>
										<option value="<?= $row['purchase_order_id'] ?>"><?= $row['purchase_order_kode'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-penerimaanorder-gudang_id">
								<label for="penerimaanorder-gudang_id" class="control-label" name="CAPTION-GUDANG">Pilih Gudang</label>
								<select class="input-sm form-control select2" id="penerimaanorder-gudang_id" name="penerimaanorder[gudang_id]">
									<option value="">** Pilih Gudang**</option>
									<?php foreach ($Gudang as $row) : ?>
										<option value="<?= $row['gudang_id'] ?>"><?= $row['gudang_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-penerimaanorder-sales_id">
								<label for="penerimaanorder-sales_id" class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
								<select class="input-sm form-control select2" id="penerimaanorder-client_wms_id" name="penerimaanorder[client_wms_id]" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required>
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

					</div>
					<div class="row">

						<div class=" col-xs-3">
							<div class="form-group field-penerimaanorder-penerimaan_order_tgl">
								<label class="control-label" for="penerimaanorder-penerimaan_order_tgl" name="CAPTION-TGLPR">Tanggal Purchase Order</label>
								<input type="text" id="penerimaanorder-penerimaan_order_tgl" class="form-control datepicker" name="penerimaanorder[penerimaan_order_tgl]" autocomplete="off" value="<?= set_value('penerimaanorder[penerimaan_order_tgl_buat_do]') != "" ? set_value('penerimaanorder[penerimaan_order_tgl_buat_do]') : (isset($penerimaanorder['penerimaan_order_tgl_buat_do']) ? date('d-m-Y', strtotime($penerimaanorder['penerimaan_order_tgl_buat_do'])) : date('d-m-Y')) ?>">
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-penerimaanorder-penerimaan_order_tgl_dibutuhkan">
								<label class="control-label" for="penerimaanorder-penerimaan_order_tgl_dibutuhkan" name="CAPTION-TGLDIBUTUHKAN">Tanggal Dibutuhkan</label>
								<input type="text" id="penerimaanorder-penerimaan_order_tgl_dibutuhkan" class="form-control datepicker" name="penerimaanorder[penerimaan_order_tgl_dibutuhkan]" autocomplete="off" value="<?= set_value('penerimaanorder[penerimaan_order_tgl_buat_do]') != "" ? set_value('penerimaanorder[penerimaan_order_tgl_buat_do]') : (isset($penerimaanorder['penerimaan_order_tgl_buat_do']) ? date('d-m-Y', strtotime($penerimaanorder['penerimaan_order_tgl_buat_do'])) : date('d-m-Y')) ?>" readonly disabled>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-penerimaanorder-tipe_pengadaan_id">
								<label for="penerimaanorder-tipe_pengadaan_id" class="control-label" name="CAPTION-TIPEPENGADAAN">Tipe Pengadaan</label>
								<select class="input-sm form-control select2" id="penerimaanorder-tipe_pengadaan_id" name="penerimaanorder[tipe_pengadaan_id]">
									<option value="">** Pilih **</option>
									<?php foreach ($TipePengadaan as $row) : ?>
										<option value="<?= $row['tipe_pengadaan_id'] ?>"><?= $row['tipe_pengadaan_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-penerimaanorder-penerimaan_order_nm_supplier">
								<label class="control-label" for="penerimaanorder-penerimaan_nm_supplier" name="CAPTION-SUPPLIER">Supplier</label>
								<input type="text" id="penerimaanorder-penerimaan_nm_supplier" class="form-control " name="penerimaanorder[penerimaan_nm_supplier]" autocomplete="off" value="-" readonly disabled>
							</div>
						</div>

						<div class="col-xs-3" style="display:none">
							<div class="form-group field-penerimaanorder-tipe_transaksi_id">
								<label for="penerimaanorder-tipe_transaksi_id" class="control-label" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</label>
								<select class="input-sm form-control select2" id="penerimaanorder-tipe_transaksi_id" name="penerimaanorder[tipe_transaksi_id]">
									<option value="">** Pilih **</option>
									<?php foreach ($TipeTransaksi as $row) : ?>
										<option value="<?= $row['tipe_transaksi_id'] ?>"><?= $row['tipe_transaksi_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>


						<div class="col-xs-3" style="display:none">
							<div class="form-group field-penerimaanorder-kategori_biaya_id">
								<label for="penerimaanorder-kategori_biaya_id" class="control-label" name="CAPTION-KATEGORIBIAYA">Kategori Biaya</label>
								<select class="input-sm form-control select2" id="penerimaanorder-kategori_biaya_id" name="penerimaanorder[kategori_biaya_id]">
									<option value="">** Pilih **</option>
									<?php foreach ($KategoriBiaya as $row) : ?>
										<option value="<?= $row['kategori_biaya_id'] ?>"><?= $row['kategori_biaya_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-3" style="display:none">
							<div class="form-group field-penerimaanorder-tipe_biaya_id">
								<label for="penerimaanorder-tipe_biaya_id" class="control-label" name="CAPTION-TIPEBIAYA">Tipe Biaya</label>
								<select class="input-sm form-control select2" id="penerimaanorder-tipe_biaya_id" name="penerimaanorder[tipe_biaya_id]">
									<option value="">** Pilih **</option>
									<?php foreach ($TipeBiaya as $row) : ?>
										<option value="<?= $row['tipe_biaya_id'] ?>"><?= $row['tipe_biaya_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-xs-3">
							<div class="form-group field-penerimaanorder-sales_id">
								<label for="penerimaanorder-sales_id" class="control-label" name="CAPTION-DIVISI">Divisi</label>
								<select class="input-sm form-control select2" id="penerimaanorder-karyawan_divisi_id" name="penerimaanorder[karyawan_divisi_id]">
									<option value="">** Divisi **</option>
									<?php foreach ($Divisi as $row) : ?>
										<option value="<?= $row['karyawan_divisi_id'] ?>"><?= $row['karyawan_divisi_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>


						<div class="col-xs-3">
							<div class="form-group field-penerimaanorder-penerimaan_order_status">
								<label class="control-label" for="penerimaanorder-penerimaan_order_status">Status</label>
								<input type="text" class="form-control" id="penerimaanorder-penerimaan_order_status" name="penerimaanorder[penerimaan_order_status]" value="Draft" readonly>
							</div>
							<!-- <div class="form-group field-penerimaanorder-pr_is_need_approval">
                                <input type="checkbox" id="penerimaanorder-pr_is_need_approval" name="penerimaanorder[pr_is_need_approval]" autocomplete="off" value="1"> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
                            </div> -->
						</div>


					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group field-penerimaanorder-penerimaan_order_keterangan">
								<label class="control-label" for="penerimaanorder-penerimaan_order_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
								<textarea class="form-control" id="penerimaanorder-penerimaan_order_keterangan" name="penerimaanorder[penerimaan_order_keterangan]" readonly></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="panel-barang">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4 class="pull-left" name="CAPTION-REQBARANG">Order Barang</h4>
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
									<th style="color:white;vertical-align: middle;display:none;" rowspan="2"><span name="CAPTION-SKUHARGA">Sku Harga</span></th>
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
				<a href="<?= base_url('FAS/Pengadaan/PenerimaanBarangPO/PenerimaanBarangPOMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
				<button class="btn-submit btn btn-success" id="btnsavepenerimaanpo"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span>
					<button class="btn-submit btn btn-danger" id="btnkonfirmasipenerimaanpo"><i class="fa fa-save"></i> <span name="CAPTION-KONFIRMASI" style="color:white;">Konfirmasi</span></button>
			</div>
		</div>
	</div>
</div>