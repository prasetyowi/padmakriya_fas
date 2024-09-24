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

	#tbody-listSKU tr,
	#tbody-listLokasiSKU tr {
		cursor: pointer;
	}
</style>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 name="CAPTION-PENGAJUANPENGELUARANDANA">Pengajuan Pengeluaran Dana</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h5 name="CAPTION-PENCARIANPENGAJUANPENGELUARANDANA">Pencarian Pengajuan Pengeluaran Dana</h5>
					</div>
					<div class="x_content">
						<form id="form-filter-do" class="form-horizontal form-label-left">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label class="col-form-label col-lg-6 col-md-6 col-sm-6 label-align" name="CAPTION-TANGGAL">Tanggal
										</label>
										<div class="col-lg-6 col-md-6 col-sm-6">
											<input type="text" id="filter_tanggal" class="form-control" name="filter_tanggal" value="" />
										</div>
									</div>
									<div class="item form-group">
										<label class="col-form-label col-lg-6 col-md-6 col-sm-6 label-align" name="CAPTION-TIPEBIAYA">Tipe
											Biaya
										</label>
										<div class="col-lg-6 col-md-6 col-sm-6">
											<select class="form-control select2" name="filter_tipe_biaya" id="filter_tipe_biaya" required>
												<option value="" selected>-- ALL --</option>
												<?php foreach ($rangeYear as $item) : ?>
													<option value="<?php echo $item ?>">
														<?php echo $item ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="item form-group">
											<label class="col-form-label col-md-6 col-sm-6 label-align" name="CAPTION-STATUS">Status</label>
											<div class="col-lg-6 col-md-6 col-sm-6">
												<select class="form-control select2" name="filter_status" id="filter_status" required>
													<option value="">-- ALL --</option>
												</select>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-6 col-sm-6 label-align" name="CAPTION-PERUSAHAAN">Perusahaan</label>
											<div class="col-md-6 col-sm-6">
												<select class="form-control custom-select" name="filter_perusahaan" id="filter_perusahaan" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required>

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
								</div>
							</div>

							<div class="item form-group">
								<div class="col-md-12 col-sm-12 text-left">
									<a class="btn btn-md btn-primary btn-submit-filter" onclick="getDataSearch()" name="CAPTION-CARI">Cari</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row ro-batch" id="do-table">

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h5 name="CAPTION-DAFTARPENGAJUANPENGELUARANDANA">Daftar Pengajuan Pengeluaran Dana</h5>
						<a class="btn btn-md btn-primary" onclick="viewModalAdd()" name="CAPTION-BUATPENGAJUANPENGELUARANDANA">Buat Pengajuan Pengeluaran Dana</a>
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<table id="tablePengajuan" width="100%" class="table table-responsive">
							<thead>
								<tr>
									<th name="CAPTION-NO">No</th>
									<th name="CAPTION-NODOKUMEN">No Dokumen</th>
									<th name="CAPTION-TGLPERMINTAAN">Tgl Permintaan</th>
									<th name="CAPTION-TGLDIBUTUHKAN">Tgl Dibutuhkan</th>
									<!-- <th name="CAPTION-KATEGORIBIAYA">Kategori Biaya</th>
									<th name="CAPTION-TIPEBIAYA">Tipe Biaya</th> -->
									<th name="CAPTION-NAMAPERMINTAAN">Nama Permintaan</th>
									<th name="CAPTION-VALUE">Value</th>
									<th name="CAPTION-DEFAULTPEMBAYARAN">Default Pembayaran</th>
									<th name="CAPTION-DIBUATOLEH">Dibuat Oleh</th>
									<th name="CAPTION-STATUS">Status</th>
									<th name="CAPTION-ACTION">Action</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
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

<!-- modal add pengajuan dana -->
<div class="modal fade" id="modalPengajuanDana" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-xlg">
		<!-- Modal content-->
		<form class="form-horizontal" enctype="multipart/form-data" id="PengajuanDana">
			<div class="modal-content">
				<div class="modal-header bg-primary form-horizontal">
					<h4 class="modal-title"><label name="CAPTION-PENGAJUANDANA">Pengajuan Dana</label></h4>
				</div>
				<div class="modal-body form-label-left form-horizontal">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding tab-content" id="anylist">
							<div class="tab-pane active" id="event">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
									<input type="hidden" id="add_id" name="add_id" class="txtkode form-control" />
									<input type="hidden" id="add_detail_id" name="add_detail_id" class="txtkode form-control" />
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KODE">Kode</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="(Auto)" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PERUSAHAAN">Perusahaan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<select class="form-control custom-select" name="add_perusahaan" id="add_perusahaan" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required>

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

									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JENISPENGADAAN">Jenis Pengadaan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<select id="add_jenis_pengadaan" name="add_jenis_pengadaan" class="form-control custom-select" disabled readonly>
												<option value="">-- <label name="CAPTION-JENISPENGADAAN">Pilih
														Jenis Pengadaan</label> --</option>
												<?php foreach ($TipePengadaan as $row) : ?>
													<option value="<?= $row['tipe_pengadaan_id'] ?>" <?= $row['tipe_pengadaan_nama']  == "Non PO" ? 'selected' : '' ?>>
														<?= $row['tipe_pengadaan_nama'] ?></option>
												<?php endforeach; ?>

											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<select class="form-control custom-select" name="add_tipe_transaksi" id="add_tipe_transaksi">
												<option value="">-- Select --</option>
												<!-- <?php foreach ($TipeTransaksi as $row) : ?>
													<option value="<?= $row['tipe_transaksi_id'] ?>"><?= $row['tipe_transaksi_nama'] ?></option>
												<?php endforeach; ?> -->
											</select>
										</div>
									</div>
									<div class="form-group" id="formnodocpo" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NODOCPO">No Doc PO</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="add_nodocpo" name="add_nodocpo" class="txtjudul form-control" />
										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JENISASSET">Jenis Asset</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<select id="add_jenis_asset" name="add_jenis_asset" class="form-control custom-select">
												<option value="">-- <label name="CAPTION-JENISASSET">Pilih Jenis Asset</label>--</option>
												<option value="Internal"><label name="CAPTION-INTERNAL">Internal</label></option>
												<option value="Eksternal"><label name="CAPTION-EKSTERNAL">Eksternal</label></option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGALPENGAJUAN">Tanggal
											Pengajuan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="date" id="add_tanggal_pengajuan" name="add_tanggal_pengajuan" class="txtselected_date form-control" value="<?= date("Y-m-d") ?>" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGALDIBUTUHKAN">Tanggal
											Dibutuhkan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="date" id="add_tanggal" name="add_tanggal" class="txtselected_date form-control" value="<?= date("Y-m-d") ?>" />
										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KATEGORIBIAYA">Kategori
											Biaya</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<select id="add_kategori_biaya" name="add_kategori_biaya" class="form-control custom-select">
												<option value="">-- <label name="CAPTION-PILIHKATEGORI">Pilih
														Kategori</label> --</option>
												<?php foreach ($kategori_biaya as $key => $value) { ?>
													<option value="<?= $value['kategori_biaya_id'] ?>">
														<?= $value['kategori_biaya_nama'] ?>
													</option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TIPEBIAYA">Tipe
											Biaya</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<select id="add_tipe_biaya" name="add_tipe_biaya" class="form-control custom-select">
												<option value="">-- <label name="CAPTION-PILIHTIPE">Pilih Tipe</label>
													--</option>
												<?php foreach ($tipe_biaya as $key => $value) { ?>
													<option value="<?= $value['tipe_biaya_id'] ?>">
														<?= $value['tipe_biaya_nama'] ?>
													</option>
												<?php } ?>
											</select>
										</div>
									</div>


								</div>

								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PILIHTAHUNANGGARAN">Pilih
											Tahun Anggaran</label>
										<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="approval_anggaran_detail_tahun" name="approval_anggaran_detail_tahun" class="txtjudul form-control" value="<?= date("Y"); ?>" disabled />
											<!-- <select id="approval_anggaran_detail_tahun" name="approval_anggaran_detail_tahun" class="form-control custom-select"> -->
											<!-- <option value="<?= date('Y'); ?>" selected><?= date('Y'); ?></option>
                                                <?php foreach ($rangeYear as $item) : ?>
                                                    <option value="<?php echo $item ?>">
                                                        <?php echo $item ?></option>
                                                <?php endforeach; ?> -->
											<!-- </select> -->

										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PILIHANGGARAN">Pilih
											Anggaran</label>
										<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
											<select id="add_anggaran_detail_2" name="add_anggaran_detail_2" class="form-control custom-select">

											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NILAI">Nilai</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="add_nilai" name="add_nilai" class="txtnilai form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPENERIMA">Nama
											Penerima</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="add_nama_penerima" name="add_nama_penerima" class="txtno_rekening form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-DEFAULTPEMBAYARAN">Default
											Pembayaran</label>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<select id="add_default_pembayaran" name="add_default_pembayaran" class="cbdefaultpembayaran form-control">
												<option value="Tunai"><label name="CAPTION-TUNAI">Tunai</label></option>
												<option value="Non Tunai"> <label name="CAPTION-NONTUNAI">Non
														Tunai</label></option>
											</select>
										</div>
									</div>
									<div class="form-group">

										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BANKPENERIMA">Bank
											Penerima</label>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<select id="add_bank" class="form-control custom-select" disabled>
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

									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOREKENING">No.
											Rekening</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="add_no_rekening" name="add_no_rekening" class="txtno_rekening form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled />
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JUDUL">Judul</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="add_judul" name="add_judul" class="txtjudul form-control" />
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KETERANGAN">Keterangan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<textarea id="add_keterangan" name="add_keterangan" class="txtjudul form-control" style="height: 100px; width: 100%; resize: none;"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-STATUS">
											Status</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="add_status" name="add_status" value="Draft" class="txtselected_date form-control" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PENGAJUANAPPROVAL">
											Pengajuan Approval</label>
										<div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 col-xl-1">
											<input type="checkbox" class="" style="width: 20px;height: 20px;" name="chk_approval" id="chk_approval" onclick="addApproval()">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-body form-label-left">
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
				<div class="modal-footer">
					<button class="btn btn-success" title="Save" type="submit" id="savePengajuan">
						<label name="CAPTION-SIMPAN">Simpan</label></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><label name="CAPTION-BATAL">Batal</label></button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- modal view pemngajuan dana -->