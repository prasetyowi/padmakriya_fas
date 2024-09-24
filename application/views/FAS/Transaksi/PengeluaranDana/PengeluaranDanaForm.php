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
	<form class="form" enctype="multipart/form-data" id="PengeluaranDana">
		<div class="page-title">
			<div class="title_left">
				<h3 name="CAPTION-FORMTRANSAKSIPENGELUARANDANA">Form Transaksi Pengeluaran Dana</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h5 name="CAPTION-FORMTRANSAKSIPENGELUARANDANA">Form Transaksi Pengeluaran Dana</h5>
					</div>

					<div class="x_content">
						<div class="row form-horizontal form-label-left">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding tab-content" id="anylist">
								<div class="tab-pane active" id="event">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
										<input type="hidden" id="add_id" name="add_id" class="txtkode form-control" />
										<input type="hidden" id="add_detail_id" name="add_detail_id" class="txtkode form-control" />
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOTRANSAKSI">No
												Transaksi
											</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="(Auto)" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGALTRANSAKSI">Tanggal
												Transaksi</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="date" id="add_tanggal_pengeluaran" name="add_tanggal_pengeluaran" class="txtselected_date form-control" value="<?= date("Y-m-d") ?>" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PERUSAHAAN">Perusahaan</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<select class="form-control custom-select" name="add_perusahaan" id="add_perusahaan" required>
													<option value="">-- ALL --</option>
													<?php foreach ($Perusahaan as $row) : ?>
														<option value="<?= $row['client_wms_id'] ?>">
															<?= $row['client_wms_nama'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOPERKIRAAN">No
												Perkiraan
											</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<select id="add_no_perkiraan" name="add_no_perkiraan" class="form-control custom-select">
													<!-- <option value="">-- Pilih Tipe --</option> -->

												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KETERANGAN">Keterangan</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<textarea id="add_keterangan" name="add_keterangan" class="txtjudul form-control" style="height: 100px; width: 100%; resize: none;"></textarea>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-STATUSPOSTING">Status
												Posting
											</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_status" name="add_status" class="txtselected_date form-control" value="Belum" readonly />
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
														<option value="<?= $value['kategori_biaya_id'] ?>" data-nama="<?= $value['kategori_biaya_nama'] ?>">
															<?= $value['kategori_biaya_nama'] ?>
														</option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPEMOHON">Nama
												Pemohon</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<select id="add_pemohon" name="add_pemohon" class="form-control custom-select">
													<option value="">-- <label name="CAPTION-PILIHPEMOHON">Pilih
															Pemohon</label> --</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JENISPENGELUARAN">Jenis
												Pengeluaran</label>
											<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
												<select id="add_default_pembayaran" name="add_default_pembayaran" class="cbdefaultpembayaran form-control">
													<option value="Tunai"><label name="CAPTION-TUNAI">Tunai</label>
													</option>
													<option value="Non Tunai"><label name="CAPTION-NONTUNAI">Non
															Tunai</label></option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BANKPENERIMA">Bank
												Penerima</label>
											<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
												<select id="add_bank_penerima" name="add_bank_penerima" class="form-control add_bank custom-select" disabled>
													<option value="">-- <label name="CAPTION-PILIHBANK">Pilih
															Bank</label> --</option>
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
												<input type="text" id="add_no_rekening_penerima" name="add_no_rekening_penerima" class="txtno_rekening add_no_rekening form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPENERIMA">Nama
												Penerima</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="add_nama_penerima" name="add_nama_penerima" class="txtno_rekening add_nama_penerima form-control" disabled />
											</div>
										</div>
									</div>
								</div>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row ro-batch" id="do-table">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<a class="btn btn-sm btn-primary " onclick="searchPermintaanPengeluaran()"><i class="fa fa-plus" aria-hidden="true"></i> <label name="CAPTION-PERMINTAANPENGELUARANDANA">Permintaan
								Pengeluaran dana</label></a>
					</div>
					<div class="row">
						<div class="table-responsive">

							<table id="tablePermintaan" style="width:100%" class="table table-primary table-bordered ">
								<thead>
									<tr>
										<th style="text-align: center;" name="CAPTION-NO">No</th>
										<th style="text-align: center;" name="CAPTION-NODOKUMEN">No Dokumen</th>
										<th style="text-align: center;" name="CAPTION-TGLPERMINTAAN">Tgl Permintaan</th>
										<th style="text-align: center;" name="CAPTION-TGLDIBUTUHKAN">Tgl Dibutuhkan</th>
										<th style="text-align: center;" name="CAPTION-JUDULPERMINTAAN">Judul Permintaan
										</th>
										<th style="text-align: center;" name="CAPTION-ANGGARAN">Anggaran</th>
										<th style="text-align: center;" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</th>
										<th style="text-align: center;" name="CAPTION-KETERANGAN">Keterangan</th>
										<th style="text-align: center;" name="CAPTION-ESTIMASIPENGELUARAN">Estimasi
											Pengeluaran</th>
										<th style="text-align: center;" name="CAPTION-AKTUALPENGELUARAN">Aktual
											Pengeluaran</th>
										<th style="text-align: center;" name="CAPTION-ACTION">Action</th>
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
		<div class="row" id="do-table">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<label name="CAPTION-KONFIRMASIPENGELUARANDANAOLEHKASIR">Konfirmasi Pengeluaran Dana Oleh
							Kasir</label>
					</div>
					<div class="row">
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-JUMLAHPENGELUARAN">Jumlah
								Pengeluaran</label>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<input class="form-control" type="text" id="input_nominal" name="input_nominal" onchange="inputNominalKasir()" value="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
							</div>
						</div>

					</div>
					<br />
					<div class="row">
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-BANKPENGIRIM">Bank
								Pengirim</label>
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<select id="add_bank_pengirim" name="add_bank_pengirim" class="add_bank form-control custom-select" disabled>
									<option value="">-- <label name="CAPTION-PILIHBANK">Pilih Bank</label> --</option>
									<?php foreach ($bank as $key => $value) { ?>
										<option value="<?= $value['bank_account_id'] ?>">
											<?= $value['bank_account_nama'] ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<input placeholder="(rekening pengirim)" type="text" id="add_no_rekening_pengirim" name="add_no_rekening_pengirim" class="txtno_rekening add_no_rekening form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled />
							</div>
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<input placeholder="(nama pengirim)" type="text" id="add_nama_pengirim" name="add_nama_pengirim" class="txtno_rekening add_nama_penerima form-control" disabled />
							</div>
						</div>
					</div>
					<br />
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
		</div>
		<div class="row mt-2">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" style="display: flex;align-items:center;justify-content:space-between">

					<div class="text-right">
						<button class="btn btn-primary btn-update-picklist-progress" id="saveData" type="submit"><label name="CAPTION-SIMPAN">Simpan</label></button>
						<a class="btn btn-danger" href="<?php echo site_url('FAS/Transaksi/PengeluaranDana/PengeluaranDanaMenu') ?>" name="CAPTION-KEMBALI">Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<div id="overlay">
	<div class="cv-spinner">
		<span class="spinner"></span>
	</div>
</div>

<!-- modal add Permintaan dana -->
<div class="modal fade" id="modalAddPermintaan" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-xlg">
		<!-- Modal content-->
		<form class="form-horizontal" enctype="multipart/form-data" id="e">
			<div class="modal-content">
				<div class="modal-header bg-primary form-horizontal">
					<h4 class="modal-title"><label name="CAPTION-ADDPERMINTAANDANA">Add Permintaan Dana</label></h4>
				</div>

				<div class="modal-body">
					<div class="row x_title">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tab-content" id="anylist">
							<div class="tab-pane active" id="event">

								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KATEGORIBIAYA">Kategori
											Biaya</label>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<input type="text" id="view_kategori_biaya" name="view_kategori_biaya" class="txtno_rekening form-control" readonly />
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JENISPENGELUARAN">Jenis
											Pengeluaran</label>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<input type="text" id="view_default_pembayaran" name="view_default_pembayaran" class="txtno_rekening form-control" value="Tunai" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPEMOHON">Nama
											Pemohon</label>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<input type="text" id="view_pemohon" name="view_pemohon" class="txtno_rekening form-control" readonly />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table id="tableAddPermintaan" style="width:100%" class="table table-hover  table-primary table-bordered ">
							<thead>
								<tr>
									<th style="text-align: center;" name="CAPTION-PILIH">Pilih</th>
									<th style="text-align: center;" name="CAPTION-NODOKUMEN">No Dokumen</th>
									<th style="text-align: center;" name="CAPTION-TGLPERMINTAAN">Tgl Permintaan</th>
									<th style="text-align: center;" name="CAPTION-TGLDIBUTUHKAN">Tgl Dibutuhkan</th>
									<th style="text-align: center;" name="CAPTION-JUDULPERMINTAAN">Judul Permintaan</th>
									<th style="text-align: center;" name="CAPTION-ANGGARAN">Anggaran</th>
									<th style="text-align: center;" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</th>
									<th style="text-align: center;" name="CAPTION-KETERANGAN">Keterangan</th>
									<th style="text-align: center;" name="CAPTION-JUMLAH">Jumlah</th>
								</tr>
							</thead>
							<tbody>

							</tbody>

						</table>
					</div>
				</div>
				<div class="modal-footer">
					<a class="btn btn-success" title="Save" onclick="addPermintaan()" name="CAPTION-SIMPAN">
						Simpan</a>
					<a type="button" class="btn btn-danger" data-dismiss="modal" name="CAPTION-BATAL">Batal</a>
				</div>
			</div>
		</form>
	</div>
</div