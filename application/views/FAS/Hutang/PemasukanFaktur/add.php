<div class="right_col" role="main" id="thispage">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-BUAT">Buat</span> <span name="CAPTION-PEMASUKANFAKTUR">Pemasukan Faktur</span></h3>
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
						<input type="hidden" value="" id="hpn_id" />
						<input type="hidden" value="" id="hpf_id" />
						<input type="hidden" value="" id="typepo" />
						<input type="hidden" value="" id="konfirmasi_hutang_id" />
						<input type="hidden" value="" id="purchase_request_id" />
						<input type="hidden" value="" id="po_kode" />
						<div class="col-xs-3">
							<div class="form-group field-pemasukanfaktur_kode">
								<label class="control-label" for="pemasukanfaktur_kode" name="CAPTION-NOKONFIRMASIHUTANG">Kode Pemasukan Faktur </label>
								<input readonly="readonly" type="text" id="purchaserequest-purchase_request_kode" class="form-control" name="purchaserequest[purchase_request_kode]" autocomplete="off" value="">
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-pemasukanfaktur_kode">
								<label class="control-label" for="pemasukanfaktur_kode" name="CAPTION-KODEPO">Pilih Kode Penerimaan & Konfirmasi</label>
								<select class="input-sm form-control select2" id="pemasukanfaktur_kode" name="pemasukanfaktur[purchase_order_kode]">
									<option value="">** Pilih Kode**</option>
									<!-- <?php foreach ($KodePo as $row) : ?>
										<option value="<?= $row['penerimaan_sku_barang_id'] ?>"><?= $row['penerimaan_sku_barang_kode'] ?></option>
									<?php endforeach; ?> -->
								</select>
							</div>
						</div>
						<div class=" col-xs-3">
							<div class="form-group field-pemasukanfaktur_tgl">
								<label class="control-label" for="pemasukanfaktur_tgl" name="CAPTION-TGLPR">Tanggal Konfirmasi Hutang</label>
								<input type="text" id="pemasukanfaktur_tgl" class="form-control datepicker" name="pemasukanfaktur[penerimaan_order_tgl]" autocomplete="off" value="<?= set_value('pemasukanfaktur[penerimaan_order_tgl_buat_do]') != "" ? set_value('pemasukanfaktur[penerimaan_order_tgl_buat_do]') : (isset($pemasukanfaktur['penerimaan_order_tgl_buat_do']) ? date('d-m-Y', strtotime($pemasukanfaktur['penerimaan_order_tgl_buat_do'])) : date('d-m-Y')) ?>" readonly disabled>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-pemasukanfaktur_tgl_dibutuhkan">
								<label class="control-label" for="pemasukanfaktur_tgl_dibutuhkan" name="CAPTION-TGLDIBUTUHKAN">Tanggal Penerimaan & Konfirmasi</label>
								<input type="text" id="pemasukanfaktur_tgl_dibutuhkan" class="form-control datepicker" name="pemasukanfaktur[penerimaan_order_tgl_dibutuhkan]" autocomplete="off" value="<?= set_value('pemasukanfaktur[penerimaan_order_tgl_buat_do]') != "" ? set_value('pemasukanfaktur[penerimaan_order_tgl_buat_do]') : (isset($pemasukanfaktur['penerimaan_order_tgl_buat_do']) ? date('d-m-Y', strtotime($pemasukanfaktur['penerimaan_order_tgl_buat_do'])) : date('d-m-Y')) ?>" readonly disabled>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-xs-3">
							<div class="form-group field-pemasukanfaktur-sales_id">
								<label for="pemasukanfaktur-sales_id" class="control-label" name="CAPTION-PERUSAHAAN">Perusahaan</label>
								<select class="input-sm form-control select2" id="pemasukanfaktur_client_wms_id" name="pemasukanfaktur[client_wms_id]" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required readonly disabled>

									<option value="">-- ALL --</option>
									<?php foreach ($Perusahaan as $row) : ?>
										<option value="<?= $row['client_wms_id'] ?>">
											<?= $row['client_wms_nama'] ?></option>
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
										<option value="<?= $row['karyawan_divisi_id'] ?>"><?= $row['karyawan_divisi_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="col-xs-3">
							<div class="form-group field-pemasukanfaktur_status">
								<label class="control-label" for="pemasukanfaktur_status">Status Penerimaan & Konfirmasi</label>
								<input type="text" class="form-control" id="pemasukanfaktur_status_penerimaankonfirmasi" name="pemasukanfaktur[penerimaan_order_status]" value="Draft" readonly>
							</div>
							<!-- <div class="form-group field-pemasukanfaktur-pr_is_need_approval">
                                <input type="checkbox" id="pemasukanfaktur-pr_is_need_approval" name="pemasukanfaktur[pr_is_need_approval]" autocomplete="off" value="1"> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
                            </div> -->
						</div>
						<div class="col-xs-3">
							<div class="form-group field-pemasukanfaktur_status">
								<label class="control-label" for="pemasukanfaktur_status">Status Konfirmasi Hutang</label>
								<input type="text" class="form-control" id="pemasukanfaktur_status" name="pemasukanfaktur[penerimaan_order_status]" value="Draft" readonly>
							</div>
							<div class="form-group field-pemasukanfaktur-pr_is_need_approval" style="display:none">
								<input type="checkbox" id="pemasukanfaktur_is_need_approval" name="pemasukanfaktur[pr_is_need_approval]" autocomplete="off" value="1"> <span name="CAPTION-PENGAJUAN">Pengajuan Approval</span>
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
								<input type="text" id="pemasukanfaktur_nm_penerima" class="form-control " name="pemasukanfaktur[penerimaan_nm_penerima]" autocomplete="off" value="-" readonly disabled>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-pemasukanfaktur_nm_supplier">
								<label class="control-label" for="pemasukanfaktur_nm_supplier" name="CAPTION-SUPPLIER">Supplier</label>
								<input type="text" id="pemasukanfaktur_nm_supplier" class="form-control " name="pemasukanfaktur[penerimaan_nm_supplier]" autocomplete="off" value="-" readonly disabled>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-pemasukanfaktur-tipe_pengadaan_id">
								<label for="pemasukanfaktur-tipe_pengadaan_id" class="control-label" name="CAPTION-TIPEPENGADAAN">Tipe Pengadaan</label>
								<select class="input-sm form-control select2" id="pemasukanfaktur_tipe_pengadaan_id" name="pemasukanfaktur[tipe_pengadaan_id]" readonly disabled>
									<option value="">** Pilih **</option>
									<?php foreach ($TipePengadaan as $row) : ?>
										<option value="<?= $row['tipe_pengadaan_id'] ?>"><?= $row['tipe_pengadaan_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>


					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group field-pemasukanfaktur_keterangan">
								<label class="control-label" for="pemasukanfaktur_keterangan" name="CAPTION-KETERANGAN">Keterangan</label>
								<textarea class="form-control" id="pemasukanfaktur_keterangan" name="pemasukanfaktur[penerimaan_order_keterangan]"></textarea>
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
				<div class="form-group" id="divaddfile">
					<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-FILE">File</label>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<input type="file" id="add_file" name="add_file" class="txtnilai form-control" accept="application/pdf,application/vnd.ms-excel" />
					</div>
				</div>
				<div class="form-group" id="spanAttachment">

				</div>

			</div>
			<div class="row">

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
					<table class="table table-striped" id="tablekonfirmasihutang" style="width:100%;">
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

						</tbody>
					</table>
				</div>
			</div>
			<div style="float: right">
				<a href="<?= base_url('FAS/PemasukanFaktur/PemasukanFakturMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
				<button class="btn-submit btn btn-success" id="btnsavepemasukanfaktur"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span></button>
				<button style="display: none;" class="btn-submit btn btn-success" id="editbtnsavepemasukanfaktur"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span></button>
				<button style="display: none;" class="btn-submit btn btn-danger" id="btnkonfirmasipemasukanfaktur"><i class="fa fa-save"></i> <span name="CAPTION-KONFIRMASI" style="color:white;">Konfirmasi</span></button>
				<!-- <button class="btn-submit btn btn-danger" id="btnkonfirmasipemasukanfaktur"><i class="fa fa-save"></i> <span name="CAPTION-KONFIRMASI" style="color:white;">Konfirmasi</span></button> -->
			</div>
		</div>
	</div>
</div>