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
				<h3 name="CAPTION-PENYELESAIANKASBON">Penyelesaian Kasbon</h3>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h5 name="CAPTION-PENCAIRANPENYELESAIANKASBON">Pencarian Penyelesaian Kasbon</h5>
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
									<label class="col-form-label col-md-6 col-sm-6 label-align" name="CAPTION-PERUSAHAAN">Perusahaan</label>
									<div class="col-lg-6 col-md-6 col-sm-6">
										<select class="form-control custom-select" name="filter_perusahaan" id="filter_perusahaan" required>
											<option value="">-- ALL --</option>
											<?php foreach ($Perusahaan as $row) : ?>
												<option value="<?= $row['client_wms_id'] ?>">
													<?= $row['client_wms_nama'] ?></option>
											<?php endforeach; ?>
										</select>
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
					<h5 name="CAPTION-DAFTARPENYELESAIANKASBON">Daftar Penyelesaian Kasbon</h5>
					<a class="btn btn-md btn-primary" href="<?php echo base_url('FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonForm'); ?>" name="CAPTION-BUATPENYELESAIANKASBON">Buat
						Penyelesaian Kasbon</a>
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<table id="tablePengeluaran" width="100%" class="table table-responsive">
						<thead>
							<tr>
								<th name="CAPTION-NO">No</th>
								<th name="CAPTION-NODOKUMEN">No Dokumen</th>
								<th name="CAPTION-TGLTRANSAKSI">Tgl Transaksi</th>
								<th name="CAPTION-JUMLAH">Jumlah</th>
								<!-- <th>Default Pembayaran</th> -->
								<th name="CAPTION-STATUS">Status</th>
								<th name="CAPTION-DIBUATOLEH">Dibuat Oleh</th>
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