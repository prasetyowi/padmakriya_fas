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
				<h3 name="CAPTION-ANGGARAN">Anggaran</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h5 name="CAPTION-PENCARIANANGGARANTAHUNAN">Pencarian Anggaran Tahunan</h5>
					</div>
					<div class="x_content">
						<form id="form-filter-do" class="form-horizontal form-label-left">
							<div class="row">
								<div class="col-lg-6 col-md-4 col-sm-4">
									<div class="item form-group">
										<label class="col-form-label col-lg-6 col-md-6 col-sm-6 label-align" name="CAPTION-TAHUNANGGARAN">
											Tahun Anggaran
										</label>
										<div class="col-lg-6 col-md-6 col-sm-6">
											<select class="form-control select2" name="tahun" id="tahun" required>
												<option value="" selected>-- ALL --</option>
												<?php foreach ($rangeYear as $item) : ?>
													<option value="<?php echo $item ?>">
														<?php echo $item ?></option>
												<?php endforeach; ?>


											</select>
										</div>
									</div>
									<div class="item form-group">
										<label class="col-form-label col-md-6 col-sm-6 label-align" name="CAPTION-NODOKUMEN">No Dokumen</label>
										<div class="col-md-6 col-sm-6">
											<select class="form-control select2" name="level" id="level" required>
												<option value="">-- ALL --</option>
											</select>
										</div>
									</div>
									<div class="item form-group">
										<label class="col-form-label col-md-6 col-sm-6 label-align" name="CAPTION-PERUSAHAAN">Perusahaan</label>
										<div class="col-md-6 col-sm-6">
											<select class="form-control select2" name="filter_perusahaan" id="filter_perusahaan" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required>
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

								<div class="item form-group">
									<div class="col-md-12 col-sm-12 text-left">
										<a class="btn btn-md btn-primary btn-submit-filter" onclick="getDataAnggaranSearch()" name="CAPTION-CARI">Cari</a>
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
						<h5 name="CAPTION-DAFTARANGGARANTAHUNAN">Daftar Anggaran Tahunan</h5>
						<a class="btn btn-md btn-primary" onclick="viewModalAdd()" name="CAPTION-PERSIAPANDOKUMENANGGARAN">Persiapan Dokumen Anggaran</a>
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<table id="tableAnggaran" width="100%" class="table table-responsive">
							<thead>
								<tr>
									<th name="CAPTION-NO">No</th>
									<th name="CAPTION-PERUSAHAAN">PERUSAHAAN</th>
									<th name="CAPTION-NODOKUMEN">No Dokumen</th>
									<th name="CAPTION-TAHUNANGGARAN">Tahun Anggaran</th>
									<th name="CAPTION-LASTUPDATE">Last Update</th>
									<th name="CAPTION-WHOUPDATE">Who Update</th>
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
</div>

<div id="overlay">
	<div class="cv-spinner">
		<span class="spinner"></span>
	</div>
</div>

<!-- modal Add Dokumen -->
<div class="modal fade" id="modalAdd" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-md">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
				<h4 class="modal-title"><label name="CAPTION-BUATPERSIAPANDOKUMENANGGARAN">Buat Persiapan Dokumen
						Anggaran</label></h4>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="item form-group">
								<label class="col-form-label col-lg-6 col-md-6 col-sm-6 label-align" name="CAPTION-NODOKUMEN">No Dokumen
								</label>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<input type="text" class="form-control input-date-start" name="anggaran_kode" id="anggaran_kode" placeholder="(Auto)" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="item form-group">
								<label class="col-form-label col-lg-6 col-md-6 col-sm-6 label-align" name="CAPTION-TAHUNANGGARAN">Tahun Anggaran
								</label>
								<div class=" col-lg-6 col-md-6 col-sm-6">
									<select class="form-control select2" name="anggaran_tahun" id="anggaran_tahun" required>
										<?php foreach ($rangeYear as $item) : ?>
											<option value="<?php echo $item ?>" <?= ($item == date('Y') ? "selected" : "") ?>>
												<?php echo $item ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="item form-group">
								<label class="col-form-label col-md-6 col-sm-6 label-align" name="CAPTION-JUMLAHLEVEL">Jumlah Level
								</label>
								<div class="col-md-6 col-sm-6">
									<select class="form-control select2" name="anggaran_jumlah_level" id="anggaran_jumlah_level" required>
										<!-- <option value="0">0</option> -->
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="item form-group">
								<label class="col-form-label col-md-6 col-sm-6 label-align" name="CAPTION-STATUS">Status
								</label>
								<div class="col-md-6 col-sm-6">
									<input type="text" class="form-control input-date-start" name="anggaran_status" id="anggaran_status" value="Draft" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="item form-group">
								<label class="col-form-label col-md-6 col-sm-6 label-align" name="CAPTION-PERUSAHAAN">Perusahaan</label>
								<div class="col-md-6 col-sm-6">
									<select class="form-control select2" name="perusahaan" id="perusahaan" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required>
										<?php if (count($Perusahaan) != 1) { ?>
											<option value="">-- ALL --</option>
										<?php } ?>
										<?php foreach ($Perusahaan as $row) : ?>
											<option value="<?= $row['client_wms_id'] ?>">
												<?= $row['client_wms_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="saveData" onclick="SaveAnggaran()"><i class="fas fa-floppy-disk"></i>
					<label name="CAPTION-SIMPAN">Simpan</label></button>
				<button type="button" class="btn btn-dark " data-dismiss="modal"><i class="fas fa-xmark"></i>
					<label name="CAPTION-TUTUP">Tutup</label></button>
			</div>
		</div>
	</div>
</div>

<!-- modal view detail-->

<div class="modal fade" id="modalDetail" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" style="width: 90%;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
				<h4 class="modal-title"><label name="CAPTION-DETAILANGGARAN">Detail Anggaran</label></h4>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="table-responsive">
						<table id="tableDetail" style="width:100%" class="table table-hover  table-primary table-bordered ">
							<thead>
								<tr>
									<th style="text-align: center;" name="CAPTION-NO">No</th>
									<th style="text-align: center;" name="CAPTION-TAHUN">Tahun</th>
									<th style="text-align: center;" name="CAPTION-NODOKUMEN">No Dokumen</th>
									<th style="text-align: center;" name="CAPTION-NODOKUMENDETAIL">No Dokumen Detail
									</th>
									<th style="text-align: center;" name="CAPTION-STATUS">Status</th>
									<th style="text-align: center;" name="CAPTION-DIBUATOLEH">Dibuat Oleh</th>
									<th style="text-align: center;" name="CAPTION-ACTION">Action</th>

								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>


				</div>
			</div>
			<div class="modal-footer">

				<button type="button" class="btn btn-dark btnclosemodalbuatpackingdo" data-dismiss="modal"><i class="fas fa-xmark"></i> <label name="CAPTION-TUTUP">Tutup</label></button>
			</div>
		</div>
	</div>
</div>