<style>
	#overlay {
		position: fixed;
		top: 0;
		z-index: 100;
		width: 100%;
		height: 100%;
		display: none;
		background: rgba(0, 0, 0, 0.6);
	}

	.cv-spinner {
		height: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.spinner {
		width: 40px;
		height: 40px;
		border: 4px #ddd solid;
		border-top: 4px #2e93e6 solid;
		border-radius: 50%;
		animation: sp-anime 0.8s infinite linear;
	}

	@keyframes sp-anime {
		100% {
			transform: rotate(360deg);
		}
	}

	.is-hide {
		display: none;
	}

	/* .form-group {
    margin: 5px;
} */

	#tbody-listSKU tr,
	#tbody-listLokasiSKU tr {
		cursor: pointer;
	}
</style>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 name="CAPTION-DETAILPENGAJUANPENGELUARANDANA">Detail Pengajuan Pengeluaran Dana</h3>
			</div>
		</div>
		<button class="btn btn-primary pull-right" name="btn_history_approval" id="btn_history_approval" <?= $pengajuan_dana->pengajuan_dana_status == 'Draft' ? 'style="display:none;' : ''; ?>><i class="fa fa-clock"></i>
			<label name="CAPTION-HISTORYAPPROVAL">History Approval</label></button>
		<div class="clearfix"></div>
		<div class="row">
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h5 name="CAPTION-DETAILPENGAJUANPENGELUARANDANA">Detail Pengajuan Pengeluaran Dana</h5>
					</div>
					<div class="x_content">
						<form id="form-filter-do" class="form-horizontal">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " id="anylist">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
										<div class="item form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 label-align">Kode
											</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengajuan_dana->pengajuan_dana_kode ?>" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PERUSAHAAN">Perusahaan</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<select class="form-control custom-select" name="perusahaan" id="perusahaan" disabled>
													<option value="">-- Select --</option>
													<?php foreach ($Perusahaan as $row) : ?>
														<option value="<?= $row['client_wms_id'] ?>" <?= $pengajuan_dana->client_wms_id == $row['client_wms_id'] ? 'selected' : '' ?>>
															<?= $row['client_wms_nama'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JENISPENGADAAN">Jenis Pengadaan</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<select id="add_jenis_pengadaan" name="add_jenis_pengadaan" class="form-control custom-select" disabled readonly>
													<option value="">----</option>
													<?php foreach ($TipePengadaan as $row) : ?>
														<option value="<?= $row['tipe_pengadaan_id'] ?>" <?= $pengajuan_dana->pengajuan_dana_jenis_pengadaan == $row['tipe_pengadaan_id'] ? 'selected' : '' ?>><?= $row['tipe_pengadaan_nama'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<select class="form-control custom-select" name="viewtipetransaksi" id="viewtipetransaksi" disabled readonly>

													<option value="">----</option>
													<?php foreach ($TipeTransaksi as $row) : ?>
														<option value="<?= $row['tipe_transaksi_id'] ?>" <?= $pengajuan_dana->pengajuan_dana_tipe_transaksi == $row['tipe_transaksi_id'] ? 'selected' : '' ?>><?= $row['tipe_transaksi_nama'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>

										<div class="form-group" id="formnodocpo">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NODOCPO">No Doc PO</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_nodocpo" name="add_nodocpo" class="txtjudul form-control" value="<?= $pengajuan_dana->pengajuan_dana_no_doc_po == null || '' ? "-" :  $pengajuan_dana->pengajuan_dana_no_doc_po ?>" disabled readonly />
											</div>
										</div>
										<div class="form-group" style="display: none;">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JENISASSET">Jenis Asset</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<select id="add_jenis_asset" name="add_jenis_asset" class="form-control custom-select" disabled readonly>
													<option value="">-- <label name="CAPTION-JENISASSET">Pilih Jenis Asset</label>
														--</option>
													<option value="Internal" <?= $pengajuan_dana->pengajuan_dana_jenis_asset == 'Internal' || 'INTERNAL' ? 'selected' : '' ?>><label name="CAPTION-INTERNAL">Internal</label></option>
													<option value="Eksternal" <?= $pengajuan_dana->pengajuan_dana_jenis_asset == 'Eksternal' ? 'selected' : '' ?>><label name="CAPTION-EKSTERNAL">Eksternal</label></option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 label-align" name="CAPTION-TANGGALPENGAJUAN">Tanggal
												Pengajuan</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="date" id="add_tanggal_pengajuan" name="add_tanggal_pengajuan" class="txtselected_date form-control" value="<?= $pengajuan_dana->tgl_pengajuan ?>" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGALDIBUTUHKAN">Tanggal
												DIbutuhkan</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="date" id="add_tanggal" name="add_tanggal" class="txtselected_date form-control" value="<?= $pengajuan_dana->tgl_dibutuhkan ?>" readonly />
											</div>
										</div>

										<div class="form-group" style="display: none;">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KATEGORIBIAYA">Kategori
												Biaya</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_kategori_biaya" name="add_kategori_biaya" class="form-control" value="<?= $pengajuan_dana->kategori_biaya_nama ?>" readonly />
											</div>
										</div>
										<div class="form-group" style="display: none;">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TIPEBIAYA">Tipe
												Biaya</label>

											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_kategori_biaya" name="add_kategori_biaya" class="form-control" value="<?= $pengajuan_dana->tipe_biaya_nama ?>" readonly />
											</div>
										</div>

									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-ANGGARAN">
												Anggaran</label>
											<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_anggaran" name="add_anggaran" class="txtjudul form-control" value="<?= $pengajuan_dana->anggaran_detail_2_kode ?> - <?= $pengajuan_dana->anggaran_detail_2_nama_anggaran ?>" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NILAI">Nilai</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_nilai" name="add_nilai" class="txtnilai form-control" value="<?= format_idr($pengajuan_dana->pengajuan_dana_value) ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPENERIMA">Nama
												Penerima</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_nama_penerima" name="add_nama_penerima" class="txtno_rekening form-control" value="<?= $pengajuan_dana->pengajuan_dana_nama_penerima ?>" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-DEFAULTPEMBAYARAN">Default
												Pembayaran</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_default_pembayaran" name="add_default_pembayaran" class="txtno_rekening form-control" value="<?= $pengajuan_dana->pengajuan_dana_default_pembayaran ?>" readonly />
											</div>
										</div>

										<div class="form-group">

											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BANKPENERIMA">Bank
												Penerima</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_bank" name="add_bank" class="txtno_rekening form-control" value="<?= $pengajuan_dana->bank_account_nama ?>" readonly />
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOREKENING">No.
												Rekening</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_no_rekening" name="add_no_rekening" class="txtno_rekening form-control" value="<?= $pengajuan_dana->pengajuan_dana_rekening_penerima ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled />
											</div>

										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JUDUL">Judul</label>

											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_judul" name="add_judul" class="txtjudul form-control" value="<?= $pengajuan_dana->pengajuan_dana_judul ?>" readonly />
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KETERANGAN">Keterangan</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<textarea id="add_keterangan" name="add_keterangan" class="txtjudul form-control" value="<?= $pengajuan_dana->pengajuan_dana_keterangan ?>" style="height: 100px; width: 100%; resize: none;" readonly><?= $pengajuan_dana->pengajuan_dana_keterangan ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-STATUS">
												Status</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_status" name="add_status" value="<?= $pengajuan_dana->pengajuan_dana_status ?>" class="txtselected_date form-control" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PENGAJUANAPPROVAL">
												Pengajuan Approval</label>
											<div class="col-xs-8 col-sm-6 col-md-6 col-lg-6 col-xl-6">
												<input type="checkbox" class="" style="width: 20px;height: 20px;" name="chk_approval" id="chk_approval" <?= $pengajuan_dana->pengajuan_dana_status != 'Draft' ? 'checked' : '' ?> disabled>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-ATTACHMENT">
												Attachment</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<a href="<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/ViewAttachment?file=' . $pengajuan_dana->pengajuan_dana_attacment_1) ?>" target="_blank" class="btn btn-info"><?= $pengajuan_dana->pengajuan_dana_attacment_1 ?></a>

											</div>
										</div>
									</div>

								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





<div id="overlay">
	<div class="cv-spinner">
		<span class="spinner"></span>
	</div>
</div>




<!-- modal view pemngajuan dana -->

<!-- modal history approval-->
<div class="modal fade" id="modalHistoryApproval" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" style="width: 80%;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
				<h4 class="modal-title"><label name="CAPTION-HISTORYAPPROVAL">History Approval</label></h4>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-lg-2"><label name="CAPTION-JENISPENGAJUAN">Jenis Pengajuan</label></div>
						<div class="col-lg-4"><input class="form-control" id="txt_jenis_pengajuan" value="" readonly>
						</div>
					</div>
					<div class="table-responsive">
						<table id="tableHistoryApproval" style="width:100%" class="table table-hover  table-primary table-bordered ">
							<thead>
								<tr style="background:#F0EBE3;">
									<th style="text-align: center;" name="CAPTION-NO">No</th>
									<th style="text-align: center;" name="CAPTION-TGLAPPROVAL">Tgl Approval</th>
									<th style="text-align: center;" name="CAPTION-NODOKUMEN">No Dokumen</th>
									<th style="text-align: center;" name="CAPTION-STATUS">Status</th>
									<th style="text-align: center;" name="CAPTION-OLEH">Oleh</th>
									<th style="text-align: center;" name="CAPTION-NOTE">Note</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>

				</div>
			</div>
			<div class="modal-footer">

				<button type="button" class="btn btn-danger btnclosemodalbuatpackingdo" data-dismiss="modal"><i class="fas fa-xmark"></i> <label name="CAPTION-TUTUP">Tutup</label></button>

			</div>

		</div>
	</div>
</div>