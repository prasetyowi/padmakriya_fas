<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-DETAIL">Detail</span> Purchase Request</h3>
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
									<label class="control-label" for="purchaserequest-purchase_request_kode" name="CAPTION-NOPR">No Purchase Request</label>
									<input readonly="readonly" type="hidden" id="purchaserequest-purchase_request_id" class="form-control" name="purchaserequest[purchase_request_id]" autocomplete="off" value="<?= $header['purchase_request_id']; ?>">
									<input readonly="readonly" type="text" id="purchaserequest-purchase_request_kode" class="form-control" name="purchaserequest[purchase_request_kode]" autocomplete="off" value="<?= $header['purchase_request_kode']; ?>">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-sales_id">
									<label for="purchaserequest-sales_id" class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
									<select class="input-sm form-control select2" id="purchaserequest-client_wms_id" name="purchaserequest[client_wms_id]" disabled>
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
									<select class="input-sm form-control select2" id="purchaserequest-tipe_pengadaan_id" name="purchaserequest[tipe_pengadaan_id]" disabled>
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
									<select class="input-sm form-control select2" id="purchaserequest-karyawan_divisi_id" name="purchaserequest[karyawan_divisi_id]" disabled>
										<option value="">** Divisi **</option>
										<?php foreach ($Divisi as $row) : ?>
											<option value="<?= $row['karyawan_divisi_id'] ?>" <?= $header['karyawan_divisi_id'] == $row['karyawan_divisi_id'] ? 'selected' : ''; ?>><?= $row['karyawan_divisi_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3" style="display: none;">
								<div class="form-group field-purchaserequest-tipe_transaksi_id">
									<label for="purchaserequest-tipe_transaksi_id" class="control-label" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</label>
									<select class="input-sm form-control select2" id="purchaserequest-tipe_transaksi_id" name="purchaserequest[tipe_transaksi_id]" disabled>
										<option value="">** Pilih **</option>
										<?php foreach ($TipeTransaksi as $row) : ?>
											<option value="<?= $row['tipe_transaksi_id'] ?>" <?= $header['tipe_transaksi_id'] == $row['tipe_transaksi_id'] ? 'selected' : ''; ?>><?= $row['tipe_transaksi_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-kategori_biaya_id" style="display:none;">
									<label for="purchaserequest-kategori_biaya_id" class="control-label" name="CAPTION-KATEGORIBIAYA">Kategori Biaya</label>
									<select class="input-sm form-control select2" id="purchaserequest-kategori_biaya_id" name="purchaserequest[kategori_biaya_id]" disabled>
										<option value="">** Pilih **</option>
										<?php foreach ($KategoriBiaya as $row) : ?>
											<option value="<?= $row['kategori_biaya_id'] ?>" <?= $header['kategori_biaya_id'] == $row['kategori_biaya_id'] ? 'selected' : ''; ?>><?= $row['kategori_biaya_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-tipe_biaya_id" style="display:none;">
									<label for="purchaserequest-tipe_biaya_id" class="control-label" name="CAPTION-TIPEBIAYA">Tipe Biaya</label>
									<select class="input-sm form-control select2" id="purchaserequest-tipe_biaya_id" name="purchaserequest[tipe_biaya_id]" disabled>
										<option value="">** Pilih **</option>
										<?php foreach ($TipeBiaya as $row) : ?>
											<option value="<?= $row['tipe_biaya_id'] ?>" <?= $header['tipe_biaya_id'] == $row['tipe_biaya_id'] ? 'selected' : ''; ?>><?= $row['tipe_biaya_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-purchase_request_pemohon">
									<label class="control-label" for="purchaserequest-purchase_request_pemohon" name="CAPTION-PEMOHON">Pemohon</label>
									<input type="text" id="purchaserequest-purchase_request_pemohon" class="form-control" name="purchaserequest[purchase_request_pemohon]" autocomplete="off" value="<?= $header['purchase_request_pemohon']; ?>" readonly>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-3" style="display:none;">
								<div class="form-group field-purchaserequest-tipe_kepemilikan_id">
									<label for="purchaserequest-sales_id" class="control-label" name="CAPTION-KEPEMILIKAN">Kepemilikan</label>
									<select class="input-sm form-control select2" id="purchaserequest-tipe_kepemilikan_id" name="purchaserequest[tipe_kepemilikan_id]" disabled>
										<option value="">** Kepemilikan **</option>
										<?php foreach ($TipeKepemilikan as $row) : ?>
											<option value="<?= $row['tipe_kepemilikan_id'] ?>" <?= $header['tipe_kepemilikan_id'] == $row['tipe_kepemilikan_id'] ? 'selected' : ''; ?>><?= $row['tipe_kepemilikan_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

						</div>
						<div class="row" style="display: none;">
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
									<select id="purchaserequest-purchase_request_add_anggaran_detail_2" name="purchaserequest-purchase_request_add_anggaran_detail_2" class="form-control custom-select select2" disabled readonly>
										<option value="">--PILIH--</option>
										<?php foreach ($Anggaran as $key => $value) { ?>
											<option value="<?= $value['anggaran_detail_2_id'] ?>" <?= $header['anggaran_detail_2_id'] == $value['anggaran_detail_2_id'] ? 'selected' : ''; ?>><?= $value['anggaran_detail_2_kode'] ?><?= $value['anggaran_detail_2_nama_anggaran'] ?>
											</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-purchase_request_pemohon">
									<label class="control-label" name="CAPTION-NAMAPENERIMA">Nama
										Penerima</label>
									<input type="text" id="purchaserequest-purchase_request_add_nama_penerima" name="purchaserequest-purchase_request_add_nama_penerima" class="txtno_rekening form-control" value="<?= $header['pengajuan_dana_penerima']; ?>" disabled />
								</div>
							</div>
						</div>
						<div class="row" style="display: none;">
							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-purchase_request_pemohon">
									<label class="control-label" name="CAPTION-DEFAULTPEMBAYARAN">Default Pembayaran</label>
									<select id="purchaserequest-purchase_request_add_default_pembayaran" name="purchaserequest-purchase_request_add_default_pembayaran" class="cbdefaultpembayaran form-control select2" disabled readonly>
										<option value="">--PILIH--</option>
										<option value="Tunai" <?= $header['pengajuan_dana_default_pembayaran'] == "Tunai" ? 'selected' : ''; ?>><label name="CAPTION-TUNAI">Tunai</label></option>
										<option value="Non Tunai" <?= $header['pengajuan_dana_default_pembayaran'] == "Non Tunai" ? 'selected' : ''; ?>> <label name="CAPTION-NONTUNAI">Non
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
											<option value="<?= $value['bank_account_id'] ?>" <?= $header['bank_account_id'] == $value['bank_account_id'] ? 'selected' : ''; ?>><?= $value['bank_account_nama'] ?>
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
									<input type="text" id="purchaserequest-purchase_request_add_judul" name="purchaserequest-purchase_request_add_judul" class="txtjudul form-control" value="<?= $header["pengajuan_dana_judul"] ?>" disabled />
								</div>
							</div>

							<div class="col-xs-3">
								<div class="form-group field-purchaserequest-purchase_request_status">
									<label class="control-label" for="purchaserequest-purchase_request_status">Status</label>
									<input type="text" class="form-control" id="purchaserequest-purchase_request_status" name="purchaserequest[purchase_request_status]" value="<?= $header['purchase_request_status']; ?>" readonly>
								</div>
								<div class="form-group field-purchaserequest-pr_is_need_approval">
									<input type="checkbox" id="purchaserequest-pr_is_need_approval" name="purchaserequest[pr_is_need_approval]" autocomplete="off" value="1" <?= $header['purchase_request_status'] != 'Draft' ? 'checked' : ''; ?> disabled> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group field-purchaserequest-purchase_request_keterangan">
									<label class="control-label" for="purchaserequest-purchase_request_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
									<textarea class="form-control" id="purchaserequest-purchase_request_keterangan" name="purchaserequest[purchase_request_keterangan]" readonly><?= $header['purchase_request_keterangan']; ?></textarea>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group field-purchaserequest-purchase_request_keterangan">
									<label class="control-label" for="purchaserequest-purchase_request_keterangan" name="CAPTION-LAMPIRANN">Lampiran</label>
									<a href="<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/ViewAttachment?file=' . $header['pengajuan_dana_attacment_1']) ?>" target="_blank" class="btn btn-info"><?= $header['pengajuan_dana_attacment_1'] ?></a>
								</div>
							</div>


						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="row" id="panel-barang">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4 class="pull-left" name="CAPTION-REQBARANG">Request Barang</h4>
					<div class="clearfix"></div>
				</div>
				<div style="overflow-x:auto;">
					<table class="table table-striped" id="table-req-barang" style="width:100%;">
						<thead>
							<tr class="bg-primary">
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SUPPLIER">Supplier</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUKODE">Kode</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUNAMA">Nama</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" colspan="2"><span name="CAPTION-REQUEST">Request</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" colspan="2"><span name="CAPTION-APPROVED">Approved</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-QTYPO">Qty PO</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-QTYTERIMA">Qty Terima</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-NOPO">No PO</span></th>
							</tr>
							<tr class="bg-primary">
								<th class=" text-center" style="color:white;vertical-align: middle;"><span name="CAPTION-QTY">Qty</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;"><span name="CAPTION-SUBTOTAL">SUB Total</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;"><span name="CAPTION-QTY">Qty</span></th>
								<th class="text-center" style="color:white;vertical-align: middle;"><span name="CAPTION-SUBTOTAL">SUB Total</span></th>
							</tr>
						</thead>
						<tbody>
							<input type="hidden" id="item-count-purchaserequestdetail" value="<?= count($PRDetail) ?>">
							<?php foreach ($PRDetail as $i => $item) : ?>
								<tr id="row-<?= $i ?>">
									<td class="text-center"><?= $item['supplier_nama'] ?></td>
									<td class="text-center"><?= $item['sku_barang_kode'] ?></td>
									<td class="text-center"><?= $item['sku_barang_nama_produk'] ?></td>
									<td class="text-center"><?= $item['sku_barang_satuan'] ?></td>
									<td class="text-center"><?= $item['purchase_request_detail_keterangan']; ?></td>
									<td class="text-center"><?= $item['purchase_request_detail_qty_req'] ?></td>
									<td class="text-center"><?= $item['purchase_request_detail_qty_req'] * $item['sku_barang_harga'] ?></td>
									<td class="text-center"><?= $item['purchase_request_detail_qty_approve'] ?></td>
									<td class="text-center"><?= $item['purchase_request_detail_qty_approve'] * $item['sku_barang_harga'] ?></td>
									<td class="text-center"><?= $item['purchase_request_detail_qty_po'] ?></td>
									<td class="text-center"><?= $item['purchase_request_detail_qty_terima'] ?></td>
									<td class="text-center" style="width:10%;"><?= $item['purchase_order_kode'] ?></td>
								</tr>
							<?php endforeach; ?>
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