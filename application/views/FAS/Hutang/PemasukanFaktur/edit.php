<div class="right_col" role="main" id="thispage">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-EDIT">Edit</span> <span name="CAPTION-PEMASUKANFAKTUR">Pemasukan Faktur</span></h3>
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
							<input type="hidden" value="" id="hpr_id" />
							<input type="hidden" value="" id="hpo_id" />
							<input type="hidden" value="" id="hsp_id" />
							<input type="hidden" value="" id="hpn_id" />
							<input type="hidden" value="" id="hpf_id" />
							<input type="hidden" value="" id="typepo" />
							<input type="hidden" value="<?= $header['purchase_request_id'] ?>" id="purchase_request_id" />
							<input type="hidden" value="<?= $header['purchase_order_id'] ?>" id="po_kode" />
							<input type="hidden" value="<?= $konfirmasi_hutang_id ?>" id="konfirmasi_hutang_id" />
							<input type="hidden" value="<?= $header['purchase_request_id'] ?>" id="purchase_request_id" />
							<div class="col-xs-3">
								<div class="form-group field-pemasukanfaktur_kode">
									<label class="control-label" for="pemasukanfaktur_kode" name="CAPTION-NOKONFIRMASIHUTANG">Kode Pemasukan Faktur</label>
									<input readonly="readonly" type="text" id="kodepemasukanfakturhutang" class="form-control" name="purchaserequest[purchase_request_kode]" autocomplete="off" value="<?= $header['konfirmasi_hutang_kode'] ?>">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-pemasukanfaktur_kode">
									<label class="control-label" for="pemasukanfaktur_kode" name="CAPTION-NOKONFIRMASIHUTANG">Kode Penerimaan Dan Barang</label>
									<input readonly="readonly" type="text" id="kodepemasukanfakturhutang" class="form-control" name="purchaserequest[purchase_request_kode]" autocomplete="off" value="<?= $typeid == 1 ? $header['penerimaan_sku_barang_kode'] : $header['konfirmasi_sku_jasa_kode'] ?>">
								</div>
							</div>
							<div class=" col-xs-3">
								<div class="form-group field-pemasukanfaktur_tgl">
									<label class="control-label" for="pemasukanfaktur_tgl" name="CAPTION-TGLPR">Tanggal Konfirmasi Hutang</label>
									<input type="text" id="pemasukanfaktur_tgl" class="form-control datepicker" name="pemasukanfaktur[penerimaan_order_tgl]" autocomplete="off" value="<?= date('d-m-Y', strtotime($header['konfirmasi_hutang_tgl_create']))  ?>" readonly disabled>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-pemasukanfaktur_tgl_dibutuhkan">
									<label class="control-label" for="pemasukanfaktur_tgl_dibutuhkan" name="CAPTION-TGLDIBUTUHKAN">Tanggal Penerimaan & Konfirmasi</label>
									<input type="text" id="pemasukanfaktur_tgl_dibutuhkan" class="form-control datepicker" name="pemasukanfaktur[penerimaan_order_tgl_dibutuhkan]" autocomplete="off" value="<?= $typeid == 1 ? date('d-m-Y', strtotime($header['penerimaan_sku_barang_tgl_create'])) : date('d-m-Y', strtotime($header['konfirmasi_jasa_tgl_create'])) ?>" readonly disabled>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-xs-3">
								<div class="form-group field-pemasukanfaktur-sales_id">
									<label for="pemasukanfaktur-sales_id" class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan </label>
									<select class="input-sm form-control select2" id="pemasukanfaktur_client_wms_id" name="pemasukanfaktur[client_wms_id]" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required readonly disabled>

										<option value="">-- ALL --</option>
										<?php foreach ($Perusahaan as $row) : ?>
											<option value="<?= $row['client_wms_id'] ?>" <?= $header['client_wms_id'] == $row['client_wms_id'] ? 'selected' : ''; ?>><?= $row['client_wms_nama'] ?></option>
										<?php endforeach; ?>

									</select>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-pemasukanfaktur-sales_id">
									<label for="pemasukanfaktur-sales_id" class="control-label" name="CAPTION-DIVISI">Divisi</label>
									<select class="input-sm form-control select2" id="pemasukanfaktur_karyawan_divisi_id" name="pemasukanfaktur[karyawan_divisi_id]" disabled readonly>
										<option value="">** Divisi **</option>
										<?php foreach ($Divisi as $row) : ?>
											<option value="<?= $row['karyawan_divisi_id'] ?>" <?= $header['karyawan_divisi_id'] == $row['karyawan_divisi_id'] ? 'selected' : ''; ?>><?= $row['karyawan_divisi_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-xs-3">
								<div class="form-group field-pemasukanfaktur_status">
									<label class="control-label" for="pemasukanfaktur_status">Status Penerimaan & Konfirmasi</label>
									<input type="text" class="form-control" id="pemasukanfaktur_status_penerimaankonfirmasi" name="pemasukanfaktur[penerimaan_order_status]" value="<?= $typeid == 1 ? $header['penerimaan_sku_barang_status'] : $header['konfirmasi_jasa_status'] ?>" readonly>
								</div>
								<!-- <div class="form-group field-pemasukanfaktur-pr_is_need_approval">
                                <input type="checkbox" id="pemasukanfaktur-pr_is_need_approval" name="pemasukanfaktur[pr_is_need_approval]" autocomplete="off" value="1"> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
                            </div> -->
							</div>
							<div class="col-xs-3">
								<div class="form-group field-pemasukanfaktur_status">
									<label class="control-label" for="pemasukanfaktur_status">Status Konfirmasi Hutang</label>
									<input type="text" class="form-control" id="pemasukanfaktur_status" name="pemasukanfaktur[penerimaan_order_status]" value="<?= $header['konfirmasi_hutang_status'] ?>" readonly>
								</div>
								<div class="form-group field-pemasukanfaktur-pr_is_need_approval" style="display:none">
									<input type="checkbox" id="pemasukanfaktur_is_need_approval" name="pemasukanfaktur[pr_is_need_approval]" autocomplete="off" value="1" <?= $header['konfirmasi_hutang_status'] != 'Draft' ? 'checked' : ''; ?>> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
								</div>
							</div>


							<div class="col-xs-3" style="display:none">
								<div class="form-group field-pemasukanfaktur-tipe_transaksi_id">
									<label for="pemasukanfaktur-tipe_transaksi_id" class="control-label" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</label>
									<select class="input-sm form-control select2" id="pemasukanfaktur_tipe_transaksi_id" name="pemasukanfaktur[tipe_transaksi_id]">
										<option value="">** Pilih **</option>
										<?php foreach ($TipeTransaksi as $row) : ?>
											<option value="<?= $row['tipe_transaksi_id'] ?>"><?= $row['tipe_transaksi_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>


							<div class="col-xs-3" style="display:none">
								<div class="form-group field-pemasukanfaktur-kategori_biaya_id">
									<label for="pemasukanfaktur-kategori_biaya_id" class="control-label" name="CAPTION-KATEGORIBIAYA">Kategori Biaya</label>
									<select class="input-sm form-control select2" id="pemasukanfaktur_kategori_biaya_id" name="pemasukanfaktur[kategori_biaya_id]">
										<option value="">** Pilih **</option>
										<?php foreach ($KategoriBiaya as $row) : ?>
											<option value="<?= $row['kategori_biaya_id'] ?>"><?= $row['kategori_biaya_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3" style="display:none">
								<div class="form-group field-pemasukanfaktur-tipe_biaya_id">
									<label for="pemasukanfaktur-tipe_biaya_id" class="control-label" name="CAPTION-TIPEBIAYA">Tipe Biaya</label>
									<select class="input-sm form-control select2" id="pemasukanfaktur-tipe_biaya_id" name="pemasukanfaktur[tipe_biaya_id]">
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
								<div class="form-group field-pemasukanfaktur_nm_penerima">
									<label class="control-label" for="pemasukanfaktur_nm_penerima" name="CAPTION-NAMAPENERIMA">Nama Penerima</label>
									<input type="text" id="pemasukanfaktur_nm_penerima" class="form-control " name="pemasukanfaktur[penerimaan_nm_penerima]" autocomplete="off" value="<?= $header['purchase_request_pemohon'] ?>" readonly disabled>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-pemasukanfaktur_nm_supplier">
									<label class="control-label" for="pemasukanfaktur_nm_supplier" name="CAPTION-SUPPLIER">Supplier</label>
									<input type="text" id="pemasukanfaktur_nm_supplier" class="form-control " name="pemasukanfaktur[penerimaan_nm_supplier]" autocomplete="off" value="<?= $header['supplier_nama'] ?>" readonly disabled>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group field-pemasukanfaktur-tipe_pengadaan_id">
									<label for="pemasukanfaktur-tipe_pengadaan_id" class="control-label" name="CAPTION-TIPEPENGADAAN">Tipe Pengadaan</label>
									<select class="input-sm form-control select2" id="pemasukanfaktur_tipe_pengadaan_id" name="pemasukanfaktur[tipe_pengadaan_id]" readonly disabled>
										<option value="">** Pilih **</option>
										<?php foreach ($TipePengadaan as $row) : ?>
											<option value="<?= $row['tipe_pengadaan_id'] ?>" <?= $header['tipe_pengadaan_id'] == $row['tipe_pengadaan_id'] ? 'selected' : ''; ?>><?= $row['tipe_pengadaan_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>


						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group field-pemasukanfaktur_keterangan">
									<label class="control-label" for="pemasukanfaktur_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
									<textarea class="form-control" id="pemasukanfaktur_keterangan" name="pemasukanfaktur[penerimaan_order_keterangan]" value="<? $header['konfirmasi_hutang_keterangan'] ?>"></textarea>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		<?php endforeach; ?>
		<div class="x_panel">
			<div class="x_title">
				<h5 name="CAPTION-UPLOADATTACHMENT">Upload Attachment</h5>
				<div class="clearfix"></div>
			</div>
			<div class="row">
				<div class="form-group" id="divaddfile">
					<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-FILE">File</label>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<input type="file" id="add_file" name="add_file" class="txtnilai form-control" accept="application/pdf,application/vnd.ms-excel" />
					</div>
				</div>
				<?php if ($header['konfirmasi_hutang_attachment_1'] != null || $header['konfirmasi_hutang_attachment_1'] != "") { ?>
					<div class="form-group" id="spanAttachment">
						<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-ATTACHMENT">
							Attachment</label>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<?php
							if ($header['konfirmasi_hutang_attachment_1'] != null || $header['konfirmasi_hutang_attachment_1'] != "") { ?>


								<a href="<?= base_url('FAS/PemasukanFaktur/ViewAttachment?file=' . $header['konfirmasi_hutang_attachment_1']) ?>" target="_blank" class="btn btn-info"><?= $header['konfirmasi_hutang_attachment_1'] ?></a>
								<input type="hidden" id="is_file" name="is_file" value="1" />
								<input type="hidden" id="name_file" name="name_file" value="<?= $header['konfirmasi_hutang_attachment_1'] ?>" />
								<!-- <a class="btn btn-md btn-danger" title="Hapus File Attachment" onclick="delAttachment()"><i class="fa fa-trash"></i></a> -->
							<?php    } else {
							?>
								<input type="hidden" id="is_file" name="is_file" value="0" />
							<?php } ?>
						</div>
					</div>
				<?php    } else {
				?>
					<input type="hidden" id="is_file" name="is_file" value="0" />
				<?php } ?>
			</div>
		</div>

	</div>
	<div class="row" id="panel-barang">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4 class="pull-left" name="CAPTION-KONFIRMASIHUTANG">Konfirmasi Hutang</h4>
					<!-- <div class="pull-right"><button data-toggle="modal" data-target="#modal-sku" id="btn-choose-prod-delivery" class="btn btn-success" type="button"><i class="fa fa-search"></i> <span name="CAPTION-CHOOSE" style="color:white;">Pilih</span></button></div> -->
					<div class="clearfix"></div>
				</div>
				<div style="overflow-x:auto;">
					<table class="table table-striped" id="edittablekonfirmasihutang" style="width:100%;">
						<thead>
							<thead>
								<tr class="bg-primary">

									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-NO">No.</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUKODE">Kode</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUNAMA">Nama</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-QTYBARANGJASA">Qty Barang Jasa</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SKUHARGA">Sku Harga</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-SUBTOTALHARGA">Sub Total Harga</span></th>
									<th style="color:white;vertical-align: middle;" rowspan="2"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
									<th style="color:white;vertical-align: middle;display:none;" rowspan="2"><span name="CAPTION-ACTION">Action</span></th>
								</tr>
							</thead>
						<tbody>
							<input type="hidden" id="item-count-purchaserequestdetail" value="<?= $PNDetail != 0 ? count($PNDetail) : 0 ?>">
							<?php if (!empty($PNDetail)) { ?>
								<?php foreach ($PNDetail as $i => $item) : ?>
									<tr id="row-<?= $i ?>">
										<td><?= $i + 1 ?><input type="hidden" id="hcountlistpo" value="<?= $i ?>"></td>
										<td>
											<span id="span-item-<?= $i ?>-sku_barang_kode"><?= $item['sku_barang_kode'] ?></span>
										</td>
										<td>
											<span id="span-item-<?= $i ?>-sku_barang_nama_produk"><?= $item['sku_barang_nama_produk'] ?></span>
										</td>
										<td>
											<span id="span-item-<?= $i ?>-sku_barang_satuan"><?= $item['sku_barang_satuan'] ?></span>
										</td>
										<td><span id="span-item-<?= $i ?>-sku_barang_kemasan"><?= $item['sku_barang_kemasan'] == null ? '-' : $item['sku_barang_kemasan'] ?></span></td>
										<td><input type="number" class="form-control numeric dis" id="span-item-<?= $i ?>-purchase_order_detail_qty" value="<?= $item['penerimaan_sku_barang_detail_qty_terima'] ?>" onchange="SumSubTotalReqQty(this.value,<?= $i ?>)"></td>
										<td><input type="number" class="form-control rupeah dolars-<?= $i ?> dis" id="span-item-<?= $i ?>-sku_barang_harga" value="<?= Round($item['sku_barang_harga']) ?>" onchange="SumSubTotalReqHarga(this.value,<?= $i ?>)"></td>
										<td><span id="span-item-<?= $i ?>-purchase_order_sub_total"><?= Round($item['sku_barang_harga']) * $item['penerimaan_sku_barang_detail_qty_terima'] ?></span></td>
										<td><span id="span-item-<?= $i ?>-keterangan"><?= $item['purchase_order_keterangan'] == null ? '-' : $header['purchase_order_keterangan'] ?></span></td>
										<td style="display: none;">
											<button class="btn btn-danger btn-small HapusItemPaketAddPO idx-<?= $i ?> $item['sku_barang_id']'" value="<?= $item['purchase_order_id'] ?>" id="btnDetailPo"><i class="fa fa-trash"><label id="lbnmsupp" class="nm-$item['supplier_nama}"></label></i></button>
										</td>
										<td style="display:none;"><span id="span-item-<?= $i ?>-supplier_id">-</span></td>
										<td style="display:none;"><span id="span-item-<?= $i ?>-sku_barang_id"><?= $item['sku_barang_id'] ?></span></td>
									</tr>
								<?php endforeach; ?>
							<?php } ?>

						</tbody>
					</table>
				</div>
			</div>
			<div style="float: right">
				<a href="<?= base_url('FAS/PemasukanFaktur/PemasukanFakturMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
				<button class="btn-submit btn btn-success" id="editbtnsavepemasukanfaktur"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span>
					<button class="btn-submit btn btn-danger" id="btnkonfirmasipemasukanfaktur"><i class="fa fa-save"></i> <span name="CAPTION-KONFIRMASI" style="color:white;">Konfirmasi</span>
						<!-- <button class="btn-submit btn btn-danger" id="editbtnkonfirmasipemasukanfaktur"><i class="fa fa-save"></i> <span name="CAPTION-KONFIRMASI" style="color:white;">Konfirmasi</span></button> -->
			</div>
		</div>
	</div>
</div>