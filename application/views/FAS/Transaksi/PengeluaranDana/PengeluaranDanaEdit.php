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
				<h3 name="CAPTION-EDITPENGAJUANPENGELUARANDANA">Edit Pengajuan Pengeluaran Dana</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h5 name="CAPTION-EDITPENGAJUANPENGELUARANDANA">Edit Pengajuan Pengeluaran Dana</h5>
					</div>
					<div class="x_content">
						<form id="PengajuanDana" class="form-horizontal">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " id="anylist">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
										<div class="item form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 label-align" name="CAPTION-KODE">Kode
											</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengajuan_dana->pengajuan_dana_kode ?>" readonly />
												<input type="hidden" id="id" name="id" class="txtselected_date form-control" value="<?= $pengajuan_dana->pengajuan_dana_id ?>" readonly />
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
												<input type="checkbox" class="" style="width: 20px;height: 20px;" name="chk_approval" id="chk_approval" onclick="addApproval()" <?= $pengajuan_dana->pengajuan_dana_status != 'Draft' ? 'checked disabled' : '' ?>>
											</div>
										</div>
										<div class="form-group" style="display:none">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KATEGORIBIAYA">Kategori
												Biaya</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<select id="add_kategori_biaya" name="add_kategori_biaya" class="form-control custom-select">
													<option value="">-- <label name="CAPTION-PILIHKATEGORI">Pilih
															Kategori</label> --</option>
													<?php foreach ($kategori_biaya as $key => $value) { ?>
														<option value="<?= $value['kategori_biaya_id'] ?>" <?= $pengajuan_dana->kategori_biaya_id == $value['kategori_biaya_id'] ? 'selected' : '' ?>>
															<?= $value['kategori_biaya_nama'] ?>
														</option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TIPEBIAYA">Tipe
												Biaya</label>

											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<select id="add_tipe_biaya" name="add_tipe_biaya" class="form-control custom-select">
													<option value="">-- <label name="CAPTION-PILIHTIPE">Pilih
															Tipe</label> --</option>
													<?php foreach ($tipe_biaya as $key => $value) { ?>
														<option value="<?= $value['tipe_biaya_id'] ?>" <?= $pengajuan_dana->tipe_biaya_id == $value['tipe_biaya_id'] ? 'selected' : '' ?>>
															<?= $value['tipe_biaya_nama'] ?>
														</option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JUDUL">Judul</label>

											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_judul" name="add_judul" class="txtjudul form-control" value="<?= $pengajuan_dana->pengajuan_dana_judul ?>" />
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KETERANGAN">Keterangan</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<textarea id="add_keterangan" name="add_keterangan" class="txtjudul form-control" value="<?= $pengajuan_dana->pengajuan_dana_keterangan ?>" style="height: 100px; width: 100%; resize: none;"></textarea>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
												Anggaran</label>
											<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
												<select id="add_anggaran_detail_2" name="add_anggaran_detail_2" class="form-control custom-select">
													<option value="">-- <label name="CAPTION-PILIHANGGARAN">Pilih
															Anggaran</label> --</option>
													<?php foreach ($anggaran_detail_2 as $key => $value) { ?>
														<option value="<?= $value['anggaran_detail_2_id'] ?>" <?= $pengajuan_dana->anggaran_detail_2_id == $value['anggaran_detail_2_id'] ? 'selected' : '' ?>>
															<?= $value['anggaran_detail_2_kode'] ?> -
															<?= $value['anggaran_detail_2_nama_anggaran'] ?>
														</option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NILAI">Nilai</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_nilai" name="add_nilai" class="txtnilai form-control" value="<?= (int)($pengajuan_dana->pengajuan_dana_value) ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPENERIMA">Nama
												Penerima</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_nama_penerima" name="add_nama_penerima" class="txtno_rekening form-control" value="<?= $pengajuan_dana->pengajuan_dana_nama_penerima ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-DEFAULTPEMBAYARAN">Default
												Pembayaran</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<select id="add_default_pembayaran" name="add_default_pembayaran" class="cbdefaultpembayaran form-control">
													<option value="Tunai" <?= $pengajuan_dana->pengajuan_dana_default_pembayaran == 'Tunai' ? 'selected' : '' ?>>
														<label name="CAPTION-TUNAI">Tunai</label>
													</option>
													<option value="Non Tunai" <?= $pengajuan_dana->pengajuan_dana_default_pembayaran == 'Non Tunai' ? 'selected' : '' ?>>
														<label name="CAPTION-NONTUNAI">Non Tunai</label>
													</option>
												</select>

											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BANKPENERIMA">Bank
												Penerima</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_bank" name="add_bank" class="txtno_rekening form-control" value="<?= $pengajuan_dana->bank_account_nama ?>" <?= $pengajuan_dana->pengajuan_dana_default_pembayaran == 'Tunai' ? 'disabled' : '' ?> />
											</div>

										</div>

										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOREKENING">No.

												Rekening</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_no_rekening" name="add_no_rekening" class="txtno_rekening form-control" value="<?= $pengajuan_dana->pengajuan_dana_rekening_penerima ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" <?= $pengajuan_dana->pengajuan_dana_default_pembayaran == 'Tunai' ? 'disabled' : '' ?> />
											</div>
										</div>
										<!-- <div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
												Attachment</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8" id="spanAttachment">

												<?php
												if ($pengajuan_dana->pengajuan_dana_attacment_1 != null || $pengajuan_dana->pengajuan_dana_attacment_1 != "") { ?>


													<a href="<?= base_url('PengajuanPengeluaranDana/ViewAttachment?file=' . $pengajuan_dana->pengajuan_dana_attacment_1) ?>" target="_blank" class="btn btn-info"><?= $pengajuan_dana->pengajuan_dana_attacment_1 ?></a>
													<input type="hidden" id="is_file" name="is_file" value="1" />
													<a class="btn btn-md btn-danger" title="Hapus File Attachment" onclick="delAttachment()"><i class="fa fa-trash"></i></a>
												<?php    } else {
												?>
													<input type="hidden" id="is_file" name="is_file" value="0" />
												<?php } ?>
											</div>
										</div> -->
									</div>
								</div>
							</div>
							<div cl ass="x_panel" id="spanUpload">
								<div class="x_title">
									<h5 name="CAPTION-UPLOADATTACHMENT">Upload Attachment</h5>


									<div class="clearfix"></div>
									</d iv>
									<div class="row">
										<div class="form-group">

											<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-FILE">File</label>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">

												<input type="file" id="add_file" name="add_file" value="assets/uploads/files/PengajuanDana/<?= $pengajuan_dana->pengajuan_dana_attacment_1 ?>" class="txtnilai form-control" accept="application/pdf,application/vnd.ms-excel" />
											</div>
										</div>
										<!-- jika ada attachment file di db -->
										<?php if ($pengajuan_dana->pengajuan_dana_attacment_1 != null || $pengajuan_dana->pengajuan_dana_attacment_1 != "") { ?>
											<div class="form-group" id="spanAttachment">
												<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-ATTACHMENT">
													Attachment</label>
												<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
													<?php
													if ($pengajuan_dana->pengajuan_dana_attacment_1 != null || $pengajuan_dana->pengajuan_dana_attacment_1 != "") { ?>


														<a href="<?= base_url('PengajuanPengeluaranDana/ViewAttachment?file=' . $pengajuan_dana->pengajuan_dana_attacment_1) ?>" target="_blank" class="btn btn-info"><?= $pengajuan_dana->pengajuan_dana_attacment_1 ?></a>
														<input type="hidden" id="is_file" name="is_file" value="1" />
														<a class="btn btn-md btn-danger" title="Hapus File Attachment" onclick="delAttachment()"><i class="fa fa-trash"></i></a>
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
								<div class="modal-footer">
									<button class="btn btn-success" title="Save" type="submit" id="savePengajuan">
										<label name="CAPTION-SIMPAN">Simpan</label></button>
									<a class="btn btn-danger" href="<?= base_url('PengajuanPengeluaranDana/PengajuanPengeluaranDanaMenu') ?>" name="CAPTION-BATAL">Batal</a>
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