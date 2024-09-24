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
									<input type="hidden" id="penyelesaian_kasbon_id" name="penyelesaian_kasbon_id" class="txtkode form-control" value="<?= $penyelesaian_kasbon->penyelesaian_kasbon_id ?>" />
									<input type="hidden" id="pengajuan_dana_id" name="pengajuan_dana_id" class="txtkode form-control" value="" />
									<input type="hidden" id="no_transaksi_id" name="no_transaksi_id" class="txtkode form-control" value="<?= $penyelesaian_kasbon->transaksi_dana_id ?>" />
									<input type="hidden" id="pemohon" name="pemohon" class="txtkode form-control" value="" />
									<input type="hidden" id="name_filepost" name="pengajuan_dana_id" class="txtkode form-control" />
									<input type="hidden" id="hvaluekasbon" name="hvaluekasbon" class="txtkode form-control" value="<?= (int) $penyelesaian_kasbon->kasbon_value ?>" />
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KODEPENYELESAIANKASBON">Kode Penyelesaian Kasbon
										</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="kode" name="kode" class="txtselected_date form-control" value="<?= $penyelesaian_kasbon->penyelesaian_kasbon_kode ?>" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGALPENYELESAIANKASBON">Tanggal Penyelesaian Kasbon</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="date" id="add_tanggal_penyelesaian" name="add_tanggal_penyelesaian" class="txtselected_date form-control" value="<?= $penyelesaian_kasbon->tgl != '' ? $penyelesaian_kasbon->tgl : date("Y-m-d") ?>" readonly disabled />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PERUSAHAAN">Perusahaan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<select class="form-control custom-select" name="add_perusahaan" id="add_perusahaan" required readonly disabled>
												<option value="">-- ALL --</option>
												<?php foreach ($Perusahaan as $row) : ?>
													<option value="<?= $row['client_wms_id'] ?>" <?= $penyelesaian_kasbon->client_wms_id == $row['client_wms_id'] ? 'selected' : '' ?>> <?= $row['client_wms_nama'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KETERANGAN">Keterangan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<textarea id="add_keterangan" name="add_keterangan" class="txtjudul form-control" style="height: 100px; width: 100%; resize: none;"><?= $penyelesaian_kasbon->penyelesaian_kasbon_keterangan ?></textarea>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPENYELESAIANKASBON">Nama Penyelesaian Kasbon</label>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<select id="add_no_transaksi" name="add_no_transaksi" class="form-control add_bank custom-select" readonly disabled>
												<option value="">-- <label name="CAPTION-PILIH">--PILIH--</label> --</option>
												<?php foreach ($TransaksiDanaNamaPemohon as $row) : ?>
													<option value="<?= $row['pemohon'] ?>" <?= $penyelesaian_kasbon->penyelesaian_kasbon_nama == $row['pemohon'] ? 'selected' : '' ?>> <?= $row['pemohon'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOTRANSAKSI">No Transaksi</label>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<select id="add_no_transaksi" name="add_no_transaksi" class="form-control add_bank custom-select" readonly disabled>
												<option value="">-- <label name="CAPTION-PILIH">--PILIH--</label> --</option>
												<?php foreach ($TransaksiDana as $row) : ?>
													<option value="<?= $row['client_wms_id'] ?>" <?= $penyelesaian_kasbon->transaksi_dana_id == $row['transaksi_dana_id'] ? 'selected' : '' ?>> <?= $row['transaksi_dana_kode'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-VALUEKASBON">Value Kasbon</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="add_value_kasbon" name="add_value_kasbon" class="=kasbonkasbondasdadasdasaasdtxtno_rekening add_no_rekening form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled value="<?= (int) $penyelesaian_kasbon->kasbon_value ?>" />
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
								<?php foreach ($penyelesaian_kasbon_detail as $i => $row) : ?>
									<tr>
										<td style='vertical-align:middle; text-align: center;'><?= $i + 1  ?></td>
										<td style='vertical-align:middle; text-align: center;'><input type="text" id="txtname-<?= $i + 1 ?>" class="form-control" value="<?= $row['nama_pengeluaran_detail'] ?>"></td>
										<td style='vertical-align:middle; text-align: center;'><input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="qty-aktual-<?= $i + 1 ?>" onkeyup="ubahQty('<?= $i + 1 ?>')" value="<?= (int)$row['qty_pengeluaran_detail'] == null ? 0 : (int)$row['qty_pengeluaran_detail'] ?>"></td>
										<td style='vertical-align:middle; text-align: center;'><input type=" text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="nominal-aktual-<?= $i + 1 ?>" onkeyup="ubahNominal('<?= $i + 1 ?>')" value="<?= Round($row['harga_pengeluaran_detail']) == null ? 0 : Round($row['harga_pengeluaran_detail']) ?>"></td>
										<td style='vertical-align:middle; text-align: center;'><span id="spanTotal-<?= $i + 1 ?>"><?= (int)$row['qty_pengeluaran_detail'] * Round($row['harga_pengeluaran_detail']) ?></span></td>
										<td style='vertical-align:middle; text-align: center;'><a class="btn btn-danger HapusItemPaketAdd" title="delete"><i class="fas fa-trash"></i></a></td>
									</tr>

								<?php endforeach; ?>
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
				<input type="hidden" id="hvaluekasbon" value="<?= Round($penyelesaian_kasbon->kasbon_value) ?>">
				<input type="hidden" id="hpengeluarandana" value="<?= Round($penyelesaian_kasbon->penyelesaian_kasbon_sum_value) ?>">
				<input type="hidden" id="htotalkasbon" value="<?= Round($penyelesaian_kasbon->penyelesaian_kasbon_aktual) ?>">
				<div class="row">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-VALUEKASBON">Value Kasbon</label>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<input class="form-control" type="text" id="total_value_kasbon" name="input_nominal" disabled onchange="" disabled value="<?= Round($penyelesaian_kasbon->kasbon_value) ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						</div>
					</div>

				</div>
				<br>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-PENGELUARANDANA">Total Pengeluaran Dana</label>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<input class="form-control" type="text" id="total_pengeluaran_dana" name="input_nominal" disabled onchange="" disabled value="<?= Round($penyelesaian_kasbon->penyelesaian_kasbon_sum_value) ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						</div>
					</div>

				</div>
				<br>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-PENYELESAIANKASBON">Total Penyelesaian Kasbon</label>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<input class="form-control" type="text" id="total_penyelesaian_kasbon" name="input_nominal" disabled onchange="" disabled value="<?= Round($penyelesaian_kasbon->penyelesaian_kasbon_aktual) ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
				</div>
				<div class="row">
					<?php if ($penyelesaian_kasbon->penyelesaian_kasbon_attachment != null || $penyelesaian_kasbon->penyelesaian_kasbon_attachment != "") { ?>
						<div class="form-group" id="spanAttachment">
							<label class="control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" name="CAPTION-ATTACHMENT">
								Attachment</label>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
								<?php
								if ($penyelesaian_kasbon->penyelesaian_kasbon_attachment != null || $penyelesaian_kasbon->penyelesaian_kasbon_attachment != "") { ?>


									<a href="<?= base_url('FAS/PemasukanFaktur/ViewAttachment?file=' . $penyelesaian_kasbon->penyelesaian_kasbon_attachment) ?>" target="_blank" class="btn btn-info"><?= $penyelesaian_kasbon->penyelesaian_kasbon_attachment ?></a>
									<input type="hidden" id="is_file" name="is_file" value="1" />
									<input type="hidden" id="name_file" name="name_file" value="<?= $penyelesaian_kasbon->penyelesaian_kasbon_attachment == '' ? '' : $penyelesaian_kasbon->penyelesaian_kasbon_attachment ?>" />
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
	</div>
	<div class="row mt-2">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div style="float: right">

					<a href="<?= base_url('FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonMenu') ?>" class="btn btn-info"><i class="fa fa-reply"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></a>

					<button class="btn-submit btn btn-success" id="editbtnSaveData"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span></button>
					<button class="btn-submit btn btn-danger" id="konfirmasibtnSaveData"><i class="fa fa-save"></i> <span name="CAPTION-KONFIRMASI" style="color:white;">Konfirmasi</span></button>
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