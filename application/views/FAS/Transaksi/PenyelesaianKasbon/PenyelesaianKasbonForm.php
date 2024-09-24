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
<div class="right_col" role="main" id="thispage">

	<div class="page-title">
		<div class="title_left">
			<h3 name="CAPTION-FORMPENYELESAIANKASBON">Form Penyelesaian Kasbon</h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h5 name="CAPTION-FORMPENYELESAIANKASBON">Form Penyelesaian Kasbon</h5>
				</div>

				<div class="x_content">
					<div class="row form-horizontal form-label-left">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding tab-content" id="anylist">
							<div class="tab-pane active" id="event">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
									<input type="hidden" id="penyelesaian_kasbon_id" name="penyelesaian_kasbon_id" class="txtkode form-control" />
									<input type="hidden" id="penyelesaian_kasbon_id" name="penyelesaian_kasbon_id" class="txtkode form-control" value="" />
									<input type="hidden" id="pengajuan_dana_id" name="pengajuan_dana_id" class="txtkode form-control" value="" />
									<input type="hidden" id="no_transaksi_id" name="no_transaksi_id" class="txtkode form-control" value="" />
									<input type="hidden" id="pemohon" name="pemohon" class="txtkode form-control" value="" />
									<input type="hidden" id="hvaluekasbon" name="hvaluekasbon" class="txtkode form-control" value="" />
									<input type="hidden" id="pengajuan_dana_id" name="pengajuan_dana_id" class="txtkode form-control" />
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KODEPENYELESAIANKASBON">Kode Penyelesaian Kasbon
										</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="(Auto)" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGALPENYELESAIANKASBON">Tanggal Penyelesaian Kasbon</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="date" id="add_tanggal_penyelesaian" name="add_tanggal_penyelesaian" class="txtselected_date form-control" value="<?= date("Y-m-d") ?>" readonly />
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
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KETERANGAN">Keterangan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<textarea id="add_keterangan" name="add_keterangan" class="txtjudul form-control" style="height: 100px; width: 100%; resize: none;"></textarea>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPENYELESAIANKASBON">Nama Penyelesaian Kasbon</label>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<select id="add_nama_penyelesaian" name="add_nama_penyelesaian" class="cbdefaultpembayaran form-control custom-select">
												<option value=""><label name="CAPTION-PILIH">--PILIH--</label>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOTRANSAKSI">No Transaksi</label>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<select id="add_no_transaksi" name="add_no_transaksi" class="form-control add_bank custom-select">
												<option value="">-- <label name="CAPTION-PILIH">--PILIH--</label> --</option>

											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-VALUEKASBON">Value Kasbon</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="add_value_kasbon" name="add_value_kasbon" class="txtno_rekening add_no_rekening form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled />
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
					<a class="btn btn-sm btn-primary " onclick="AppendToTable()"><i class="fa fa-plus" aria-hidden="true"></i> <label name="CAPTION-TAMBAHDETAILPENGELUARANDANA">Tambah Pengeluaran dana</label></a>
				</div>
				<div class="row">
					<div class="table-responsive">

						<table id="tablePermintaan" style="width:100%" class="table table-primary table-bordered ">
							<thead>
								<tr bgcolor="slate">
									<th style="text-align: center;" name="CAPTION-NO">No</th>
									<th style="text-align: center;" name="CAPTION-NAMA">Nama</th>
									<th style="text-align: center;" name="CAPTION-JUMLAH">Jumlah</th>
									<th style="text-align: center;" name="CAPTION-HARGA">Harga</th>
									<th style="text-align: center;" name="CAPTION-TOTAL">Total</th>
									<th style="text-align: center;" name="CAPTION-ACTION">Action</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
							<tfoot>
								<tr bgcolor="#FFD966">
									<td colspan="1"><input type="hidden" id="total_nominal_aktual"></td>
									<td colspan="1" style="font-weight: 700; color:black;">Total</td>
									<td colspan="1" style="font-weight: 700; color:black;"><span id="span_qty_aktual">0</span></td>
									<td colspan="1" style="font-weight: 700; color:black;"></td>
									<td class="subTotal" colspan="1" style="font-weight: 700; color:black;"><span id="span_nominal_aktual">0</span></td>

									<td></td>
								</tr>
							</tfoot>
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
					<label name="CAPTION-TOTALDETAILPENGELUARANKASBON">Total Pengeluaran Detail Kasbon</label>
				</div>
				<input type="hidden" id="hvaluekasbon" value="">
				<input type="hidden" id="hpengeluarandana" value="">
				<input type="hidden" id="htotalkasbon" value="">
				<div class="row">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-VALUEKASBON">Value Kasbon</label>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<input class="form-control" type="text" id="total_value_kasbon" name="input_nominal" disabled onchange="" value="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						</div>
					</div>

				</div>
				<br>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-PENGELUARANDANA">Total Pengeluaran Dana</label>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<input class="form-control" type="text" id="total_pengeluaran_dana" name="input_nominal" disabled onchange="" value="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						</div>
					</div>

				</div>
				<br>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-PENYELESAIANKASBON">Total Penyelesaian Kasbon</label>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<input class="form-control" type="text" id="total_penyelesaian_kasbon" name="input_nominal" disabled onchange="" value="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						</div>
					</div>

				</div>
				<br>
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
			</div>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div style="float: right">

					<a href="<?= base_url('FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>
					<button class="btn btn-primary" id="btnsaveData"><label name="CAPTION-SIMPAN">Simpan</label></button>
					<button style="display: none;" class="btn-submit btn btn-success" id="editbtnSaveData"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span></button>
					<button style="display: none;" class="btn-submit btn btn-danger" id="konfirmasibtnSaveData"><i class="fa fa-save"></i> <span name="CAPTION-KONFIRMASI" style="color:white;">Konfirmasi</span></button>
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