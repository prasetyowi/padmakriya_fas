<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-BUAT">Edit</span> <span name="CAPTION-PENERIMAANHARGAPOBARANG">Penerimaan Harga PO Barang</span></h3>
			</div>
			<div style="float: right">

			</div>
		</div>
		<?php foreach ($PNHeader as $header) : ?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel" id="header">
						<div class="x_title">
							<div class="clearfix"></div>
						</div>
						<div class="row">
							<input type="hidden" value="<?= $header['purchase_request_id'] ?>" id="hpr_id" />
							<input type="hidden" value="<?= $purchase_order_id ?>" id="hpo_id" />
							<input type="hidden" value="<?= $penerimaan_id ?>" id="hsp_id" />
							<input type="hidden" value="<?= $penerimaan_id ?>" id="hpn_id" />
							<div class="col-xs-3">
								<div class="form-group field-editpenerimaanorder-penerimaan_order_kode">
									<label class="control-label" for="editpenerimaanorder-penerimaan_order_kode" name="CAPTION-NOPB">No Penerimaan Barang PO</label>
									<select class="input-sm form-control select2" id="editpenerimaanorder-penerimaan_kode" name="editpenerimaanorder[purchase_order_kode]" readonly disabled>
										<option value="">** Pilih Kode PO **</option>
										<?php foreach ($KodePo as $row) : ?>
											<option value="<?= $row['penerimaan_sku_barang_id'] ?>" <?= $header['penerimaan_sku_barang_id'] == $row['penerimaan_sku_barang_id'] ? 'selected' : ''; ?>><?= $row['penerimaan_sku_barang_kode'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-penerimaanorder-penerimaan_order_kode">
									<label class="control-label" for="penerimaanorder-penerimaan_order_kode" name="CAPTION-KODEPO">Kode PO</label>
									<input type="text" id="editpenerimaan-po_kode" class="form-control" readonly disabled value="<?= $header['purchase_order_kode'] ?>">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-editpenerimaanorder-gudang_id">
									<label for="editpenerimaanorder-gudang_id" class="control-label" name="CAPTION-GUDANG">Pilih Gudang</label>
									<select class="input-sm form-control select2" id="editpenerimaanorder-gudang_id" name="editpenerimaanorder[gudang_id]" readonly disabled>
										<option value="">** Pilih Gudang**</option>
										<?php foreach ($Gudang as $row) : ?>
											<option value="<?= $row['gudang_id'] ?>" <?= $header['gudang_id'] == $row['gudang_id'] ? 'selected' : ''; ?>><?= $row['gudang_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-editpenerimaanorder-sales_id">
									<label for="editpenerimaanorder-sales_id" class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
									<select class="input-sm form-control select2" id="editpenerimaanorder-client_wms_id" name="editpenerimaanorder[client_wms_id]" readonly disabled>
										<option value="">** Perusahaan **</option>
										<?php foreach ($Perusahaan as $row) : ?>
											<option value="<?= $row['client_wms_id'] ?>" <?= $header['client_wms_id'] == $row['client_wms_id'] ? 'selected' : ''; ?>><?= $row['client_wms_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>



						</div>
						<div class="row">
							<div class="col-xs-3">
								<div class="form-group field-editpenerimaanorder-penerimaan_order_tgl">
									<label class="control-label" for="editpenerimaanorder-penerimaan_order_tgl" name="CAPTION-TGLPR">Tanggal Purchase Order</label>
									<input type="text" id="editpenerimaanorder-penerimaan_order_tgl" class="form-control datepicker" name="editpenerimaanorder[penerimaan_order_tgl]" autocomplete="off" value="<?= $header['purchase_order_tgl_create']; ?>" readonly disabled>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-editpenerimaanorder-penerimaan_order_tgl_dibutuhkan">
									<label class="control-label" for="editpenerimaanorder-penerimaan_order_tgl_dibutuhkan" name="CAPTION-TGLDIBUTUHKAN">Tanggal Dibutuhkan</label>
									<input type="text" id="editpenerimaanorder-penerimaan_order_tgl_dibutuhkan" class="form-control datepicker" name="editpenerimaanorder[penerimaan_order_tgl_dibutuhkan]" autocomplete="off" value="<?= $header['purchase_request_tgl_dibutuhkan']; ?>" readonly disabled>
								</div>
							</div>
							<div class="col-xs-3" style="display: none;">
								<div class="form-group field-editpenerimaanorder-tipe_transaksi_id">
									<label for="editpenerimaanorder-tipe_transaksi_id" class="control-label" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</label>
									<select class="input-sm form-control select2" id="editpenerimaanorder-tipe_transaksi_id" name="editpenerimaanorder[tipe_transaksi_id]" readonly disabled>
										<option value="">** Pilih **</option>
										<?php foreach ($TipeTransaksi as $row) : ?>
											<option value="<?= $row['tipe_transaksi_id'] ?>" <?= $header['tipe_transaksi_id'] == $row['tipe_transaksi_id'] ? 'selected' : ''; ?>><?= $row['tipe_transaksi_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-editpenerimaanorder-tipe_pengadaan_id">
									<label for="editpenerimaanorder-tipe_pengadaan_id" class="control-label" name="CAPTION-TIPEPENGADAAN">Tipe Pengadaan</label>
									<select class="input-sm form-control select2" id="editpenerimaanorder-tipe_pengadaan_id" name="editpenerimaanorder[tipe_pengadaan_id]" readonly disabled>
										<option value="">** Pilih **</option>
										<?php foreach ($TipePengadaan as $row) : ?>
											<option value="<?= $row['tipe_pengadaan_id'] ?>" <?= $header['tipe_pengadaan_id'] == $row['tipe_pengadaan_id'] ? 'selected' : ''; ?>><?= $row['tipe_pengadaan_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-xs-3" style="display: none;">
								<div class="form-group field-editpenerimaanorder-kategori_biaya_id">
									<label for="editpenerimaanorder-kategori_biaya_id" class="control-label" name="CAPTION-KATEGORIBIAYA">Kategori Biaya</label>
									<select class="input-sm form-control select2" id="editpenerimaanorder-kategori_biaya_id" name="editpenerimaanorder[kategori_biaya_id]" readonly disabled>
										<option value="">** Pilih **</option>
										<?php foreach ($KategoriBiaya as $row) : ?>
											<option value="<?= $row['kategori_biaya_id'] ?>" <?= $header['kategori_biaya_id'] == $row['kategori_biaya_id'] ? 'selected' : ''; ?>><?= $row['kategori_biaya_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3" style="display: none;">
								<div class="form-group field-editpenerimaanorder-tipe_biaya_id">
									<label for="editpenerimaanorder-tipe_biaya_id" class="control-label" name="CAPTION-TIPEBIAYA">Tipe Biaya</label>
									<select class="input-sm form-control select2" id="editpenerimaanorder-tipe_biaya_id" name="editpenerimaanorder[tipe_biaya_id]" readonly disabled>
										<option value="">** Pilih **</option>
										<?php foreach ($TipeBiaya as $row) : ?>
											<option value="<?= $row['tipe_biaya_id'] ?>" <?= $header['tipe_biaya_id'] == $row['tipe_biaya_id'] ? 'selected' : ''; ?>><?= $row['tipe_biaya_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-xs-3">
								<div class="form-group field-editpenerimaanorder-sales_id">
									<label for="editpenerimaanorder-sales_id" class="control-label" name="CAPTION-DIVISI">Divisi</label>
									<select class="input-sm form-control select2" id="editpenerimaanorder-karyawan_divisi_id" name="editpenerimaanorder[karyawan_divisi_id]" readonly disabled>
										<option value="">** Divisi **</option>
										<?php foreach ($Divisi as $row) : ?>
											<option value="<?= $row['karyawan_divisi_id'] ?>" <?= $header['karyawan_divisi_id'] == $row['karyawan_divisi_id'] ? 'selected' : ''; ?>><?= $row['karyawan_divisi_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-xs-3">
								<div class="form-group field-penerimaanorder-penerimaan_order_nm_supplier">
									<label class="control-label" for="penerimaanorder-penerimaan_nm_supplier" name="CAPTION-SUPPLIER">Supplier</label>
									<input type="text" id="editpenerimaanorder-penerimaan_nm_supplier" class="form-control " name="penerimaanorder[penerimaan_nm_supplier]" autocomplete="off" value="<?= $header['supplier_nama'] ?>" readonly disabled>
								</div>
							</div>

							<div class="col-xs-3">
								<div class="form-group field-editpenerimaanorder-penerimaan_order_status">
									<label class="control-label" for="editpenerimaanorder-penerimaan_order_status" name="CAPTION-STATUSPENERIMAANQTYPO">Status Penerimaan Qty Barang PO</label>
									<input type="text" class="form-control" id="editpenerimaanorder-penerimaan_order_status" name="editpenerimaanorder[penerimaan_order_status]" value="<?= $header['purchase_order_status']; ?>" readonly disabled>
								</div>
								<!-- <div class="form-group field-editpenerimaanorder-pr_is_need_approval">
                                <input type="checkbox" id="editpenerimaanorder-pr_is_need_approval" name="editpenerimaanorder[pr_is_need_approval]" autocomplete="off" value="1"> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
                            </div> -->
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group field-editpenerimaanorder-penerimaan_order_keterangan">
									<label class="control-label" for="editpenerimaanorder-penerimaan_order_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
									<textarea class="form-control" id="editpenerimaanorder-penerimaan_order_keterangan" name="editpenerimaanorder[penerimaan_order_keterangan]"><?= $header['purchase_order_keterangan']; ?></textarea>
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
					<h4 class="pull-left" name="CAPTION-REQBARANG">Order Barang</h4>
					<!-- <div class="pull-right"><button data-toggle="modal" data-target="#modal-sku" id="btn-choose-prod-delivery" class="btn btn-success" type="button"><i class="fa fa-search"></i> <span name="CAPTION-CHOOSE" style="color:white;">Pilih</span></button></div> -->
					<div class="clearfix"></div>
				</div>
				<div style="overflow-x:auto;">
					<table class="table table-striped" id="tablebarangpoedit" style="width:100%;">
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
									<th style="color:white;vertical-align: middle;display:none;" rowspan="2"><span name="CAPTION-QTYPOAKANDITERIMA">Qty PO akan diterima</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUHARGA">Sku Harga</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SUBTOTALHARGA">Sub Total Harga</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
									<th style="color:white;vertical-align: middle; display:none;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
								</tr>
							</thead>
						<tbody>
							<input type="hidden" id="item-count-penerimaanhargapodetail" value="<?= count($PNDetail) ?>">
							<?php foreach ($PNDetail as $i => $item) : ?>
								<tr id="row-<?= $i ?>">
									<td><?= $i + 1 ?></td>
									<td><span id="span-item-<?= $i ?>-sku_barang_kode"><?= $item['sku_barang_kode'] ?></span></td>
									<td><span id="span-item-<?= $i ?>-sku_barang_nama_produk"><?= $item['sku_barang_nama_produk'] ?></td>
									<td> <span id="span-item-<?= $i ?>-sku_barang_satuan"><?= $item['sku_barang_satuan'] ?></td>
									<td><span id="span-item-<?= $i ?>-sku_barang_kemasan"><?= $item['sku_barang_kemasan']; ?></td>
									<td><span id="span-item-<?= $i ?>-purchase_order_detail_qty"><?= $item['penerimaan_sku_barang_detail_qty'] ?></td>
									<td><span id="span-item-<?= $i ?>-purchase_order_detail_qty_sisa"><?= $item['penerimaan_sku_barang_detail_qty_sisa'] == null ? $item['penerimaan_sku_barang_detail_qty'] : $item['penerimaan_sku_barang_detail_qty_sisa'] ?></td>
									<td><span id="span-item-<?= $i ?>-purchase_order_detail_qty_terima"><?= $item['penerimaan_sku_barang_detail_qty_terima'] == null ? 0 : $item['penerimaan_sku_barang_detail_qty_terima'] ?></td>
									<td style="display:none"><input type="number" class="form-control numeric" id="item-<?= $i ?>-purchase_order_detail_qty_akan_terima" <?= $item['penerimaan_sku_barang_detail_qty_sisa'] === 0 ? 'disabled' : '' ?> value="<?= $item['po_akan_diterima'] ?>"></td>
									<td><input type="text" class="form-control numeric" id="edititem-<?= $i ?>-sku_barang_harga" onchange="SumSubTotalReqQty(this.value,<?= $i ?>,1)" value="<?= Round($item['sku_barang_harga']) ?>"></td>
									<td><span id="span-item-<?= $i ?>-purchase_order_sub_total"><?= Round($item['sku_barang_harga']) * $item['penerimaan_sku_barang_detail_qty_terima'] ?></span></td>
									<td><?= $item['purchase_order_keterangan'] ?></td>
									<td style="display: none;">
										<button class="btn btn-danger btn-small HapusItemPaketEditPO idx-<?= $i ?> <?= $item['sku_barang_id'] ?>" value="<?= $item['purchase_order_id'] ?>" id="btnDetailPo"><i class="fa fa-trash"><label id="lbnmsupp"></label></i></button>
									</td>
									<td style="display:none;"><span id="span-item-<?= $i ?>-sku_barang_id"><?= $item['sku_barang_id'] ?></span></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div style="float: right">
				<a href="<?= base_url('FAS/Pengadaan/PenerimaanHargaPO/PenerimaanHargaPOMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
				<button class="btn-submit btn btn-success" id="btneditpenerimaanpo"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span> <button class="btn-submit btn btn-danger" id="btneditkonfirmasipenerimaanpo"><i class="fa fa-save"></i> <span name="CAPTION-KONFIRMASI" style="color:white;">Konfirmasi</span></button></button>
			</div>
		</div>
	</div>
</div>