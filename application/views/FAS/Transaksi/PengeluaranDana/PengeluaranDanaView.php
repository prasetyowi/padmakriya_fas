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
				<h3 name="CAPTION-VIEWTRANSAKSIPENGELUARANDANA">View Transaksi Pengeluaran Dana</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h5 name="CAPTION-VIEWTRANSAKSIPENGELUARANDANA">View Transaksi Pengeluaran Dana</h5>
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
												<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengeluaran_dana->transaksi_dana_kode ?>" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGALTRANSAKSI">Tanggal
												Transaksi</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="date" id="add_tanggal_pengeluaran" name="add_tanggal_pengeluaran" class="txtselected_date form-control" value="<?= $pengeluaran_dana->tgl ?>" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PERUSAHAAN">Perusahaan</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<select class="form-control custom-select" name="add_perusahaan" id="add_perusahaan" disabled>
													<option value="">-- ALL --</option>
													<?php foreach ($Perusahaan as $row) : ?>
														<option value="<?= $row['client_wms_id'] ?>" <?= $pengeluaran_dana->client_wms_id == $row['client_wms_id'] ? 'selected' : '' ?>>
															<?= $row['client_wms_nama'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>

										<!-- <div class="form-group">
                                            <label
                                                class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">No
                                                Perkiraan
                                            </label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <select id="add_no_perkiraan" name="add_no_perkiraan"
                                                    class="form-control custom-select">
                                                    

                                                </select>
                                            </div>
                                        </div> -->
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KETERANGAN">Keterangan</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<textarea id="add_keterangan" name="add_keterangan" class="txtjudul form-control" style="height: 100px; width: 100%; resize: none;" readonly><?= $pengeluaran_dana->transaksi_dana_keterangan ?></textarea>
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
												<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengeluaran_dana->kategori_biaya_nama ?>" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPEMOHON">Nama
												Pemohon</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengeluaran_dana->transaksi_dana_nama_pemohon ?>" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JENISPENGELUARAN">Jenis
												Pengeluaran</label>
											<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
												<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengeluaran_dana->transaksi_dana_pembayaran ?>" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BANKPENERIMA">Bank
												Penerima</label>
											<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
												<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengeluaran_dana->bank_penerima ?>" readonly />
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOREKENING">No.
												Rekening</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengeluaran_dana->transaksi_dana_rekening_penerima ?>" readonly />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPENERIMA">Nama
												Penerima</label>
											<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengeluaran_dana->transaksi_dana_nama_penerima ?>" readonly />
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
										<th style="text-align: center;" name="CAPTION-KETERANGAN">Keterangan</th>
										<th style="text-align: center;" name="CAPTION-ESTIMASIPENGELUARAN">Estimasi
											Pengeluaran</th>
										<th style="text-align: center;" name="CAPTION-AKTUALPENGELUARAN">Aktual
											Pengeluaran</th>
										<th style="text-align: center;" name="CAPTION-ACTION">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									$jumlah_nominal = 0;
									foreach ($pengeluaran_dana_detail as $key => $value) { ?>
										<tr>
											<td style='vertical-align:middle; '><?= $no ?></td>
											<td style='vertical-align:middle; '><?= $value['pengajuan_dana_kode'] ?></td>
											<td style='vertical-align:middle; '><?= $value['tgl_dibutuhkan'] ?></td>
											<td style='vertical-align:middle; '><?= $value['tgl_dibutuhkan'] ?></td>
											<td style='vertical-align:middle; '><?= $value['pengajuan_dana_judul'] ?></td>
											<td style='vertical-align:middle; '>
												<?= $value['anggaran_detail_2_nama_anggaran'] ?></td>
											<td style='vertical-align:middle; '><?= $value['pengajuan_dana_keterangan'] ?>
											</td>
											<td style='vertical-align:middle; text-align: center;'>
												<?= format_idr($value['transaksi_dana_detail_plan_value']) ?></td>
											<td style='vertical-align:middle; text-align: center;'>
												<?= format_idr($value['transaksi_dana_detail_aktual_value']) ?></td>
											<td style='vertical-align:middle; '>
												<a class="btn btn-primary" title="lihat Attachment" target="_blank" href="<?= base_url() . 'FAS/Barjas/PengajuanPengeluaranDana/ViewAttachment?file=' . $value['pengajuan_dana_attacment_1'] ?>"><i class="fas fa-eye"></i></a>
											</td>
										</tr>
									<?php $no++;
										$jumlah_nominal += $value['transaksi_dana_detail_aktual_value'];
									} ?>

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
								<input class="form-control" type="text" id="input_nominal" name="input_nominal" onchange="inputNominalKasir()" value="<?= format_idr($jumlah_nominal) ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly>
							</div>
						</div>

					</div>

					<br />
					<div class="row">
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-BANKPENGIRIM">Bank
								Pengirim</label>

							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2">

								<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengeluaran_dana->bank_pengirim ?>" readonly />
							</div>
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengeluaran_dana->transaksi_dana_rekening_pengirim ?>" readonly />
							</div>
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $pengeluaran_dana->transaksi_dana_rekening_pengirim ?>" readonly />
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-ATTACHMENT">Attcahment</label>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<a href="<?= base_url('FAS/Transaksi/PengeluaranDana/ViewAttachment?file=' . $pengeluaran_dana->transaksi_dana_attacment) ?>" target="_blank" class="btn btn-info"><?= $pengeluaran_dana->transaksi_dana_attacment ?></a>
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