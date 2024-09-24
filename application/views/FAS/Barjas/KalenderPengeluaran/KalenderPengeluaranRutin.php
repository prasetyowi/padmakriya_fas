<style>
	.swal2-radio {
		display: grid !important;
		text-align: left !important;
	}
</style>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 name="CAPTION-MENUKALENDERPENGELUARANRUTIN">Menu Kalender Pengeluaran Rutin</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">

						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-4 col-sm-4 col-md-2 col-lg-2 col-xl-2" name="CAPTION-PERUSAHAAN">Perusahaan</label>
						<div class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-xl-4 nopadding">
							<select class="form-control custom-select" name="filter_perusahaan" id="filter_perusahaan" onchange="GetKalenderByPerusahaan(this.value)" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required>
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
						<label class="control-label col-xs-4 col-sm-4 col-md-2 col-lg-2 col-xl-2" name="CAPTION-DEPO">Depo</label>
						<div class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-xl-4 nopadding">
							<!-- <?= $depo[0]['depo_nama'] ?> -->
							<select id="cbDepo" class="form-control" disabled>
								<option value="" selected> <?= $depo[0]['depo_nama'] ?></option>
							</select>
						</div>
					</div>
					<br><br><br>
					<div>
						<!-- <button type="button" id="btnAddEvent" onclick="addEvent()" class="btn btn-primary" style="display: ;"><i class="fa fa-plus"></i> Tambah Event</button> -->
						<button type="button" id="btnAddEvent" onclick="addEvent()" class="btn btn-primary"><i class="fa fa-plus"></i> <label name="CAPTION-TAMBAHEVENT">Tambah Event</label></button>
						<!-- <button type="button" id="btnListEventBerulang" onclick="viewEventBerulang()" class="btn btn-info" style="display: ;"><i class="fa fa-list"></i> List Event</button> -->
						<button type="button" id="btnListEventBerulang" onclick="viewEventBerulang()" class="btn btn-info"><i class="fa fa-list"></i> <label name="CAPTION-LISTEVENT">List
								Event</label></button>
					</div>
					<br>
					<div class="form-horizontal form-label-left">
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div id="calendar" class="fc fc-unthemed fc-ltr" style="display:none"></div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- modal add event -->
<div class="modal fade" id="modalAddEvent" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-xlg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label name="CAPTION-TAMBAHEVENT">Tambah Event</label></h4>
			</div>
			<div class="modal-body form-label-left form-horizontal">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-12 nopadding">
						<ul class="nav nav-pills nopadding" role="anylist" id="navigation">
							<li id="tab1" class="active"><a href="#event" role="tab" data-toggle="pill" name="CAPTION-EVENT">Event</a></li>
							<li id="tab2"><a href="#jadwalbiayarutin" role="tab" data-toggle="pill" name="CAPTION-JADWALBIAYARUTIN">Jadwal Biaya
									Rutin</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding tab-content" id="anylist">
						<div class="tab-pane active" id="event">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<!-- <div class="form-group">
                                    <label
                                        class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">Kode</label>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <input type="text" id="txtkalender_kode" class="txtkalender_kode form-control"
                                            value="(Auto)" readonly />
                                    </div>
                                </div> -->
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PERUSAHAAN">Perusahaan</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<select class="form-control custom-select" name="perusahaan" id="perusahaan" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required>
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
										<select id="jenis_pengadaanevent" name="jenis_pengadaanevent" class="form-control custom-select">
											<option value="">-- <label name="CAPTION-JENISPENGADAAN">Pilih
													Jenis Pengadaan</label> --</option>
											<?php foreach ($TipePengadaan as $row) : ?>
												<option value="<?= $row['tipe_pengadaan_id'] ?>">
													<?= $row['tipe_pengadaan_nama'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group" style="display:none" id="diviskasbon">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-ISKASBON">Is Kasbon</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input style="transform: scale(1.5)" type="checkbox" id="cb_iskasbon" name="cb_iskasbon" autocomplete="off" value="1"> <span name="CAPTION-ISKASBON"> Is Kasbon</span>
										<input type="hidden" id="cb_iskasbonvalue" name="cb_iskasbonvalue" autocomplete="off" value="">
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KATEGORIBIAYA"> Kategori
										Biaya</label>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<select id="kategori_biaya" class="form-control custom-select">
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
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<select id="tipe_biaya" class="form-control custom-select">
											<option value="">-- <label name="CAPTION-PILIHTIPE">Pilih Tipe</label> --
											</option>
											<?php foreach ($tipe_biaya as $key => $value) { ?>
												<option value="<?= $value['tipe_biaya_id'] ?>">
													<?= $value['tipe_biaya_nama'] ?>
												</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JUDUL">Judul</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="kalender_judul" class="txtkalender_judul form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KETERANGAN">Keterangan</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<textarea id="kalender_keterangan" class="txtkalender_judul form-control" style="height: 100px; width: 100%; resize: none;"></textarea>
									</div>
								</div>
								<!-- <div class="form-group">
                                    <label
                                        class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">Warna</label>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <input type="color" id="kalender_warna" class="form-control" />
                                    </div>
                                </div> -->
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGAL">Tanggal</label>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<input type="date" class="form-control input-date-start" name="kalender_selected_date" id="kalender_selected_date" required="required" value="<?php echo Date('Y-m-d') ?>">
										<!-- <input type="text" id="txtkalender_selected_date"
											class="txtkalender_selected_date form-control" /> -->
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPENERIMA">Nama
										Penerima</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="kalender_nama_penerima" class="txtkalender_no_rekening form-control" />
									</div>
								</div>
								<!-- <div class="form-group">
									<label
										class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">Anggaran</label>
									<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
										<select id="cbanggaran_detail_2_level"
											class="cbanggaran_detail_2_level form-control"></select>
									</div>
								</div> -->
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-DEFAULTPEMBAYARAN">Default
										Pembayaran</label>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<select id="kalender_default_pembayaran" class="cbdefaultpembayaran form-control">
											<option value="Tunai"><label name="CAPTION-TUNAI">Tunai</label></option>
											<option value="Non Tunai"><label name="CAPTION-NONTUNAI">Non Tunai</label>
											</option>
										</select>
									</div>
								</div>
								<div class="form-group" id="divnilaievent" style="display: none;">
									<!-- <div class="form-group" id="divnilaievent"> -->
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NILAI">Nilai</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="kalender_nilai" class="txtkalender_nilai form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
									</div>
								</div>

								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BANKPENERIMA">Bank
										Penerima</label>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<select id="bank" class="form-control custom-select" disabled>
											<option value="">-- <label name="CAPTION-PILIHBANK">Pilih Bank</label> --
											</option>
											<?php foreach ($bank as $key => $value) { ?>
												<option value="<?= $value['bank_account_id'] ?>">
													<?= $value['bank_account_nama'] ?>
												</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOREKENING">No.
										Rekening</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="txtkalender_no_rekening" class="txtkalender_no_rekening form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled />
									</div>
								</div>

							</div>
						</div>
						<div class="tab-pane" id="jadwalbiayarutin">
							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BERULANG">Berulang</label>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
									<select id="cbberulang" class="form-control">
										<option value="1"><label name="CAPTION-YA">Ya</label></option>
										<option value="0" selected><label name="CAPTION-TIDAK">Tidak</label></option>
									</select>
								</div>
							</div>
							<div id="YesUlang" style="display: none;">
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-SETIAP">Setiap</label>
									<div class="col-xs-12 col-sm-4 col-md-2 col-md-2 col-lg-2 col-xl-2">
										<select id="cbmode" class="form-control">
											<option value="1" selected><label name="CAPTION-HARI">Hari</label></option>
											<option value="2"><label name="CAPTION-MINGGU">Minggu</label></option>
											<option value="3"><label name="CAPTION-BULAN">Bulan</label></option>
											<option value="4"><label name="CAPTION-TAHUN">Tahun</label></option>
										</select>
									</div>
								</div>
								<div id="Mode_D">
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JUMLAH">Jumlah</label>
										<div class="col-xs-2 col-sm-2 col-md-1 col-md-1 col-lg-1 col-xl-1">
											<input type="text" id="txtjumlahD" class="txtjumlah form-control" value="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
										</div>
										<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1" align="left" name="CAPTION-HARISEKALI">Hari Sekali</label>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BERAKHIR">Berakhir</label>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<select id="akhirD" class="form-control">
												<option value="1" selected><label name="CAPTION-TIDAK">Tidak</label>
												</option>
												<option value="2"><label name="CAPTION-YA">Ya</label></option>
											</select>

										</div>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input id="tglakhirD" type="date" class="form-control" value="<?= date("Y-m-d") ?>" style="display:none" />
										</div>
									</div>
								</div>
								<div id="Mode_W" style="display: none;">
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JUMLAH">Jumlah</label>
										<div class="col-xs-2 col-sm-2 col-md-1 col-md-1 col-lg-1 col-xl-1">
											<input type="text" id="txtjumlahW" class="txtjumlah form-control" value="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly />
										</div>
										<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1" align="left" name="CAPTION-MINGGU">Minggu</label>
									</div>
									<div class="form-group">
										<table id="tbW" class="table">
											<tbody>

												<tr>
													<td width="5%"><input type="checkbox" id="chW_1" class="chW_1 chW checkbox_form" /></td>
													<td width="9%"><label class="control-label" name="CAPTION-SENIN">Senin</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_2" class="chW_2 chW checkbox_form" /></td>
													<td width="10%"><label class="control-label" name="CAPTION-SELASA">Selasa</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_3" class="chW_3 chW checkbox_form" /></td>
													<td width="9%"><label class="control-label" name="CAPTION-RABU">Rabu</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_4" class="chW_4 chW checkbox_form" /></td>
													<td width="9%"><label class="control-label" name="CAPTION-KAMIS">Kamis</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_5" class="chW_5 chW checkbox_form" /></td>
													<td width="9%"><label class="control-label" name="CAPTION-JUMAT">Jumat</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_6" class="chW_6 chW checkbox_form" /></td>
													<td width="9%"><label class="control-label" name="CAPTION-SABTU">Sabtu</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_7" class="chW_7 chW checkbox_form" /></td>
													<td width="10%"><label class="control-label" name="CAPTION-MINGGU">Minggu</label>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BERAKHIR">Berakhir</label>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<select id="akhirW" class="form-control">
												<option value="1" selected><label name="CAPTION-TIDAK">Tidak</label>
												</option>
												<option value="2"><label name="CAPTION-YA">Ya</label></option>
											</select>

										</div>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input id="tglakhirW" type="date" class="form-control" value="<?= date("Y-m-d") ?>" style="display:none" />
										</div>
									</div>
								</div>
								<div id="Mode_M" style="display: none;">
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-SETIAP">Setiap</label>
										<div class=" col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input type="text" id="txtjumlahM" class="txtjumlah form-control" value="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
										</div>
										<label class=" col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" align="left" name="CAPTION-BULANSEKALI">Bulan
											Sekali</label>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGAL">Tanggal</label>
										<div class=" col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input type="text" id="tanggalM" class="txtjumlahD form-control" value="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
										</div>
										<label class=" col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" align="left" name="CAPTION-SETIAPBULAN">Setiap
											Bulan</label>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BERAKHIR">Berakhir</label>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<select id="akhirM" class="form-control">
												<option value="1" selected><label name="CAPTION-TIDAK">Tidak</label>
												</option>
												<option value="2"><label name="CAPTION-YA">Ya</label></option>
											</select>

										</div>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input id="tglakhirM" type="date" class="form-control" value="<?= date("Y-m-d") ?>" style="display:none" />
										</div>
									</div>

								</div>
								<div id="Mode_Y" style="display: none;">
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-SETIAP">Setiap</label>
										<div class=" col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input type="text" id="txtjumlahY" class="txtjumlah form-control" value="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
										</div>
										<label class=" col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" align="left" name="CAPTION-TAHUNSEKALI">Tahun
											Sekali</label>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BERAKHIR">Berakhir</label>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<select id="akhirY" class="form-control">
												<option value="1" selected><label name="CAPTION-TIDAK">Tidak</label>
												</option>
												<option value="2"><label name="CAPTION-YA">Ya</label></option>
											</select>

										</div>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input id="tglakhirY" type="date" class="form-control" value="<?= date("Y-m-d") ?>" style="display:none" />
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="saveEvent()" id="saveEvent"><label name="CAPTION-SIMPAN">Simpan</label></button>
				<button type="button" class="btn btn-danger" onclick="cancelEvent()"><label name="CAPTION-BATAL">Batal</label></button>
			</div>
		</div>
	</div>
</div>
<!-- modal view event -->
<div class="modal fade" id="modalView" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-xlg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary form-horizontal">
				<h4 class="modal-title"><label name="CAPTION-DETAILEVENT">Detail Event</label></h4>
			</div>

			<div class="modal-body form-label-left form-horizontal">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding tab-content" id="anylist">
						<div class="tab-pane active" id="event">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<!-- <div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">Kode</label>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<input type="text" id="view_kalender_kode" class="txtkalender_kode form-control" readonly />
									</div>
								</div> -->
								<input type="hidden" id="viewtipepengaadannama" class="form-control" readonly />
								<input type="hidden" id="view_kalender_id" class="txtkalender_kode form-control" readonly />
								<input type="hidden" id="view_kalender_detail_id" class="txtkalender_kode form-control" readonly />

								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGAL">Tanggal</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="view_kalender_tanggal" class="txtkalender_selected_date form-control" readonly />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PERUSAHAAN">Perusahaan</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="view_perusahaan" class="txtkalender_judul form-control" readonly />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TIPEPENGADAAN">Tipe Pengadaan</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="view_tipepengadaan" class="txtkalender_judul form-control" readonly />
										<input type="hidden" id="view_tipepengadaanid" class="txtkalender_judul form-control" readonly />
									</div>
								</div>
								<div class="form-group" style="display:none" id="viewdiviskasbon">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-ISKASBON">Is Kasbon</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input style="transform: scale(1.5)" type="checkbox" id="viewcb_iskasbon" name="cb_iskasbon" autocomplete="off" value="1" disabled readonly> <span name="CAPTION-ISKASBON"> Is Kasbon</span>
										<input type="hidden" id="viewcb_iskasbonvalue" name="cb_iskasbonvalue" autocomplete="off" value="">
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KATEGORIBIAYA">Kategori
										Biaya</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="view_kategori_biaya" class="txtkalender_judul form-control" readonly />
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TIPEBIAYA">Tipe
										Biaya</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="view_tipe_biaya" class="txtkalender_judul form-control" readonly />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JUDUL">Judul</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="view_kalender_judul" class="txtkalender_judul form-control" readonly />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KETERANGAN">Keterangan</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<textarea id="view_kalender_keterangan" class="txtkalender_judul form-control" style="height: 100px; width: 100%; resize: none;" readonly></textarea>
									</div>
								</div>
								<!-- <div class="form-group">
                                    <label
                                        class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">Warna</label>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <input type="color" id="view_kalender_warna" class="form-control" disabled />
                                    </div>
                                </div> -->
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<!-- <div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">Anggaran</label>
									<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="view_kalender_anggaran" class="cbanggaran_detail_2_level form-control" readonly />
									</div>
								</div> -->
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NILAI">Nilai</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="view_kalender_nilai" class="txtkalender_nilai form-control" readonly />
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPENERIMA">Nama
										Penerima</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="view_kalender_nama_penerima" class="txtkalender_no_rekening form-control" readonly />
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-DEFAULTPEMBAYARAN">Default
										Pembayaran</label>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<input type="text" id="view_kalender_default_pembayaran" class="cbdefaultpembayaran form-control" readonly />
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BANKPENERIMA">Bank
										Penerima</label>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<input type="text" id="view_bank" class="form-control" readonly />
									</div>
								</div>

								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOREKENING">No.
										Rekening</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="view_kalender_no_rekening" class="txtkalender_no_rekening form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" title="Edit" onclick="updateEvent()" id="btnUpdateView"><i class="fa fa-pencil"></i></button>
				<button class="btn btn-danger" title="Delete" onclick="deleteEvent()" id="btnDeleteView"><i class="fa fa-trash"></i></button>
				<button class="btn btn-primary" title="Approval" onclick="pengajuanApproval()" id="btnPengajuanView"><i class="fa fa-file"></i>
					<!-- <label name="CAPTION-PENGAJUANDANA">Pengajuan Dana</label></button> -->
					<label name="" id="lblbtnPengajuanDanaModalDetailEvent">Pengajuan Dana</label></button>
				<!-- <label name="">Purchase Request</label> -->
				</button>
				<button type="button" class="btn btn-info" data-dismiss="modal"><label name="CAPTION-TUTUP">Tutup</label></button>
			</div>
		</div>
	</div>
</div>
<!-- modal list event berulang -->
<div class="modal fade" id="modalListEventBerulang" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-xlg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label name="CAPTION-LISTEVENTBERULANG">List Event Berulang</label></h4>
			</div>
			<div class="modal-body form-label-left form-horizontal">
				<table id="tableListEventBerulang" width="100%" class="table table-responsive">
					<thead>
						<tr>
							<th name="CAPTION-NO">No</th>
							<th name="CAPTION-NAMABIAYARUTIN">Nama Biaya Rutin</th>
							<th name="CAPTION-NILAI">Nilai</th>
							<th name="CAPTION-RECURRENCE">Recurrence</th>

							<th name="CAPTION-DIBUATOLEH">Dibuat Oleh</th>
							<th name="CAPTION-DIBUATTGL">Dibuat Tgl</th>
							<!-- <th>Status</th> -->
							<th name="CAPTION-ACTION">Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal"><label name="CAPTION-TUTUP">Tutup</label></button>
			</div>
		</div>
	</div>
</div>

<!-- modal list event berulang detail -->
<div class="modal fade" id="modalDetailEventBerulang" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-md">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label name="CAPTION-DETAILBIAYARUTIN">Detail Biaya Rutin</label></h4>

			</div>

			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BIAYARUTIN">Biaya
							Rutin</label>
						<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
							<input type="text" id="detail_judul" class="txtkalender_no_rekening form-control" readonly />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NILAI">Nilai</label>
						<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
							<input type="text" id="detail_nilai" class="txtkalender_no_rekening form-control" readonly />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-RECURRENCE">Recurrence</label>
						<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
							<input type="text" id="detail_recurrence" class="txtkalender_no_rekening form-control" readonly />
						</div>
					</div>
				</div>
				<div class="clearfix"></div><br />
				<table id="tableDetailEventBerulang" width="100%" class="table table-responsive">
					<thead>
						<tr>
							<th name="CAPTION-NO">No</th>
							<!-- <th>Kode</th> -->
							<th name="CAPTION-TANGGAL">Tanggal</th>
							<th name="CAPTION-HARI">Hari</th>
							<th style='vertical-align:middle; text-align: center;' name="CAPTION-STATUSPENGAJUAN">Status
								Pengajuan</th>
							<th style='vertical-align:middle; text-align: center;' name="CAPTION-ACTION">Action</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<div class="modal-footer">

				<button type="button" class="btn btn-info" data-dismiss="modal"><label name="CAPTION-TUTUP">Tutup</label></button>
			</div>
		</div>
	</div>
</div>

<!-- modal permintaan approval -->
<div class="modal fade" id="modalPengajuanApproval" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-xlg">
		<!-- Modal content-->
		<form class="form-horizontal" enctype="multipart/form-data" id="PengajuanApproval">
			<div class="modal-content">
				<div class="modal-header bg-primary form-horizontal">
					<h4 class="modal-title"><label name="CAPTION-PENGAJUANDANA" id="lblpengajuandana">Pengajuan Dana</label></h4>
					<h4 class="modal-title"><label name="CAPTION-PURCHASEREQUEST" id="lblpurchaserequest">Purchase Request</label></h4>
				</div>
				<div class="modal-body form-label-left form-horizontal">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding tab-content" id="anylist">
							<div class="tab-pane active" id="event">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
									<input type="hidden" id="approval_kalender_id" name="approval_kalender_id" class="txtkalender_kode form-control" readonly />
									<input type="hidden" id="approval_kalender_detail_id" name="approval_kalender_detail_id" class="txtkalender_kode form-control" readonly />
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PERUSAHAAN">Perusahaan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="hidden" id="approval_perusahaan_id" name="approval_perusahaan_id" class="txtkalender_selected_date form-control" value="" readonly />
											<input type="text" id="approval_perusahaan" name="approval_perusahaan" class="txtkalender_selected_date form-control" value="" readonly />
											<!-- <select class="form-control custom-select" name="approval_perusahaan" id="approval_perusahaan" disabled></select> -->
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-DIAJUKANSEBANYAK">Diajukan sebanyak</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="count_pengajuan" name="count_pengajuan" class="txtkalender_selected_date form-control" value="0" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGALPENGAJUAN">Tanggal
											Pengajuan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="approval_kalender_tanggal_pengajuan" name="approval_kalender_tanggal_pengajuan" class="txtkalender_selected_date form-control" value="<?= date("Y-m-d") ?>" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGALDIBUTUHKAN">Tanggal
											DIbutuhkan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="approval_kalender_tanggal" name="approval_kalender_tanggal" class="txtkalender_selected_date form-control" value="<?= date("Y-m-d") ?>" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-STATUS">
											Status</label>
										<div class="col-xs-8 col-sm-6 col-md-6 col-lg-6 col-xl-6">
											<input type="text" id="approval_status" name="approval_status" value="In progress approval" class="txtkalender_selected_date form-control" readonly />

										</div>
										<div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 col-xl-1">
											<input type="checkbox" class="" style="width: 20px;height: 20px;" name="chk_approval" id="chk_approval" checked disabled>
										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KATEGORIBIAYA">Kategori
											Biaya</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">

											<input type="text" id="approval_kategori_biaya" name="approval_kategori_biaya" name="approval_kategori_biaya" class="txtkalender_judul form-control" readonly />
											<input type="hidden" id="approval_kategori_biaya_id" name="approval_kategori_biaya_id" class="txtkalender_judul form-control" readonly />
										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TIPEBIAYA">Tipe
											Biaya</label>

										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="approval_tipe_biaya" class="txtkalender_judul form-control" readonly />
											<input type="hidden" id="approval_tipe_biaya_id" name="approval_tipe_biaya_id" class="txtkalender_judul form-control" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JUDUL">Judul</label>

										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="approval_kalender_judul" name="approval_kalender_judul" class="txtkalender_judul form-control" readonly />


										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KETERANGAN">Keterangan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<textarea id="approval_kalender_keterangan" name="approval_kalender_keterangan" class="txtkalender_judul form-control" style="height: 100px; width: 100%; resize: none;" readonly></textarea>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PILIHTAHUNANGGARAN">Pilih
											Tahun Anggaran</label>
										<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
											<select id="approval_anggaran_detail_tahun" name="approval_anggaran_detail_tahun" class="form-control custom-select" readonly disabled>
												<option value="<?= date('Y'); ?>" selected><?= date('Y'); ?></option>
												<?php foreach ($rangeYear as $item) : ?>
													<option value="<?php echo $item ?>">
														<?php echo $item ?></option>
												<?php endforeach; ?>
											</select>

										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PILIHANGGARAN">Pilih
											Anggaran</label>
										<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
											<select id="approval_anggaran_detail_2" name="approval_anggaran_detail_2" class="form-control custom-select"></select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JENISPENGADAAN">Jenis Pengadaan</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<select id="approval_jenis_pengadaan" name="approval_jenis_pengadaan" class="form-control custom-select" disabled readonly>
												<option value="">-- <label name="CAPTION-JENISPENGADAAN">Pilih
														Jenis Pengadaan</label> --</option>
												<?php foreach ($TipePengadaan as $row) : ?>
													<option value="<?= $row['tipe_pengadaan_id'] ?>">
														<?= $row['tipe_pengadaan_nama'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<select class="form-control custom-select" name="approval_tipe_transaksi" id="approval_tipe_transaksi">
												<option value="">-- Select --</option>
												<?php foreach ($TipeTransaksi as $row) : ?>
													<option value="<?= $row['tipe_transaksi_id'] ?>"><?= $row['tipe_transaksi_nama'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>


									<div class="form-group" id="formnodocpo" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NODOCPO">No Doc PO</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="approval_nodocpo" name="approval_nodocpo" class="txtjudul form-control" />
										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JENISASSET">Jenis Asset</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<select id="approval_jenis_asset" name="approval_jenis_asset" class="form-control custom-select">
												<option value="">-- <label name="CAPTION-JENISASSET">Pilih Jenis Asset</label>
													--</option>
												<option value="Internal"><label name="CAPTION-INTERNAL">Internal</label></option>
												<option value="Eksternal"><label name="CAPTION-EKSTERNAL">Eksternal</label></option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NILAI">Nilai</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="approval_kalender_nilai" name="approval_kalender_nilai" class="txtkalender_nilai form-control" readonly />
										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPENERIMA">Nama
											Penerima</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="approval_kalender_nama_penerima" name="approval_kalender_nama_penerima" class="txtkalender_no_rekening form-control" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPEMOHON">Nama
											Pemohon</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="approval_kalender_nama_pemohon" name="approval_kalender_nama_pemohon" class=" form-control" />
										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-DEFAULTPEMBAYARAN">Default
											Pembayaran</label>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<input type="text" id="approval_kalender_default_pembayaran" name="approval_kalender_default_pembayaran" class="cbdefaultpembayaran form-control" readonly />
										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BANKPENERIMA">Bank
											Penerima</label>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<input type="text" id="approval_bank" class="form-control" readonly />
											<input type="hidden" id="approval_bank_id" name="approval_bank_id" class="form-control" readonly />
										</div>
									</div>

									<div class="form-group" style="display: none;">
										<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOREKENING">No.
											Rekening</label>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
											<input type="text" id="approval_kalender_no_rekening" name="approval_kalender_no_rekening" class="txtkalender_no_rekening form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly />
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
									<input type="file" id="approval_file" name="approval_file" class="txtkalender_nilai form-control" accept="application/pdf,application/vnd.ms-excel" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" title="Save" type="submit" id="saveApproval">
						<label name="CAPTION-SIMPAN">Simpan</label></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><label name="CAPTION-BATAL">Batal</label></button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- modal update event -->
<div class="modal fade" id="modalUpdateEvent" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-xlg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label name="CAPTION-EDITEVENT">Edit Event</label></h4>
			</div>
			<div class="modal-body form-label-left form-horizontal">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-12 nopadding">
						<ul class="nav nav-pills nopadding" role="anylist" id="navigation">
							<li id="tab1" class="active"><a href="#updateevent" role="tab" data-toggle="pill" name="CAPTION-EVENT">Event</a></li>
							<li id="tab2"><a href="#updatejadwalbiayarutin" role="tab" data-toggle="pill" name="CAPTION-JADWALBIAYARUTIN">Jadwal Biaya
									Rutin</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<input type="hidden" id="hkalender_id" value="">
					<input type="hidden" id="hkalender_detail_id" value="">
					<input type="hidden" id="typeedit" value="">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding tab-content" id="anylist">
						<div class="tab-pane active" id="updateevent">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-PERUSAHAAN">Perusahaan</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<select class="form-control custom-select" name="perusahaan" id="updateperusahaan" required>

											<option value="">-- ALL --</option>
											<?php foreach ($Perusahaan as $row) : ?>
												<option value="<?= $row['client_wms_id'] ?>">
													<?= $row['client_wms_nama'] ?></option>
											<?php endforeach; ?>

										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JENISPENGADAAN">Jenis Pengadaan</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<select id="updatejenis_pengadaanevent" name="updatejenis_pengadaanevent" class="form-control custom-select">
											<option value="">-- <label name="CAPTION-JENISPENGADAAN">Pilih
													Jenis Pengadaan</label> --</option>
											<?php foreach ($TipePengadaan as $row) : ?>
												<option value="<?= $row['tipe_pengadaan_id'] ?>">
													<?= $row['tipe_pengadaan_nama'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group" style="display:none" id="updatediviskasbon">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-ISKASBON">Is Kasbon</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input style="transform: scale(1.5)" type="checkbox" id="updatecb_iskasbon" name="cb_iskasbon" autocomplete="off" value="1"> <span name="CAPTION-ISKASBON"> Is Kasbon</span>
										<input type="hidden" id="updatecb_iskasbonvalue" name="cb_iskasbonvalue" autocomplete="off" value="">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JUDUL">Judul</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="updatekalender_judul" class="txtkalender_judul form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-KETERANGAN">Keterangan</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<textarea id="updatekalender_keterangan" class="txtkalender_judul form-control" style="height: 100px; width: 100%; resize: none;"></textarea>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGAL">Tanggal</label>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<input type="date" class="form-control input-date-start" name="updatekalender_selected_date" id="updatekalender_selected_date" required="required" value="<?php echo Date('Y-m-d') ?>">
										<!-- <input type="text" id="txtkalender_selected_date"
											class="txtkalender_selected_date form-control" /> -->
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NAMAPENERIMA">Nama
										Penerima</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="updatekalender_nama_penerima" class="txtkalender_no_rekening form-control" />
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-DEFAULTPEMBAYARAN">Default
										Pembayaran</label>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<select id="updatekalender_default_pembayaran" class="cbdefaultpembayaran form-control">
											<option value="Tunai"><label name="CAPTION-TUNAI">Tunai</label></option>
											<option value="Non Tunai"><label name="CAPTION-NONTUNAI">Non Tunai</label>
											</option>
										</select>
									</div>
								</div>
								<div class="form-group" id="updatedivnilaievent" style="display: none;">
									<!-- <div class="form-group" id="divnilaievent"> -->
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NILAI">Nilai</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="updatekalender_nilai" class="txtkalender_nilai form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
									</div>
								</div>

								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BANKPENERIMA">Bank
										Penerima</label>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<select id="updatebank" class="form-control custom-select" disabled>
											<option value="">-- <label name="CAPTION-PILIHBANK">Pilih Bank</label> --
											</option>
											<?php foreach ($bank as $key => $value) { ?>
												<option value="<?= $value['bank_account_id'] ?>">
													<?= $value['bank_account_nama'] ?>
												</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-NOREKENING">No.
										Rekening</label>
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
										<input type="text" id="updatetxtkalender_no_rekening" class="txtkalender_no_rekening form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled />
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="updatejadwalbiayarutin">
							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BERULANG">Berulang</label>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
									<select id="updatecbberulang" class="form-control">
										<option value="1"><label name="CAPTION-YA">Ya</label></option>
										<option value="0" selected><label name="CAPTION-TIDAK">Tidak</label></option>
									</select>
								</div>
							</div>
							<div id="updateYesUlang" style="display: none;">
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-SETIAP">Setiap</label>
									<div class="col-xs-12 col-sm-4 col-md-2 col-md-2 col-lg-2 col-xl-2">
										<select id="updatecbmode" class="form-control">
											<option value="1" selected><label name="CAPTION-HARI">Hari</label></option>
											<option value="2"><label name="CAPTION-MINGGU">Minggu</label></option>
											<option value="3"><label name="CAPTION-BULAN">Bulan</label></option>
											<option value="4"><label name="CAPTION-TAHUN">Tahun</label></option>
										</select>
									</div>
								</div>
								<div id="updateMode_D">
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JUMLAH">Jumlah</label>
										<div class="col-xs-2 col-sm-2 col-md-1 col-md-1 col-lg-1 col-xl-1">
											<input type="text" id="updatetxtjumlahD" class="txtjumlah form-control" value="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
										</div>
										<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1" align="left" name="CAPTION-HARISEKALI">Hari Sekali</label>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BERAKHIR">Berakhir</label>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<select id="updateakhirD" class="form-control">
												<option value="1" selected><label name="CAPTION-TIDAK">Tidak</label>
												</option>
												<option value="2"><label name="CAPTION-YA">Ya</label></option>
											</select>

										</div>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input id="updatetglakhirD" type="date" class="form-control" value="<?= date("Y-m-d") ?>" style="display:none" />
										</div>
									</div>
								</div>
								<div id="updateMode_W" style="display: none;">
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-JUMLAH">Jumlah</label>
										<div class="col-xs-2 col-sm-2 col-md-1 col-md-1 col-lg-1 col-xl-1">
											<input type="text" id="updatetxtjumlahW" class="txtjumlah form-control" value="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly />
										</div>
										<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1" align="left" name="CAPTION-MINGGU">Minggu</label>
									</div>
									<div class="form-group">
										<table id="updatetbW" class="table">
											<tbody>

												<tr>
													<td width="5%"><input type="checkbox" id="chW_1" class="chW_1 chW checkbox_form" /></td>
													<td width="9%"><label class="control-label" name="CAPTION-SENIN">Senin</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_2" class="chW_2 chW checkbox_form" /></td>
													<td width="10%"><label class="control-label" name="CAPTION-SELASA">Selasa</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_3" class="chW_3 chW checkbox_form" /></td>
													<td width="9%"><label class="control-label" name="CAPTION-RABU">Rabu</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_4" class="chW_4 chW checkbox_form" /></td>
													<td width="9%"><label class="control-label" name="CAPTION-KAMIS">Kamis</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_5" class="chW_5 chW checkbox_form" /></td>
													<td width="9%"><label class="control-label" name="CAPTION-JUMAT">Jumat</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_6" class="chW_6 chW checkbox_form" /></td>
													<td width="9%"><label class="control-label" name="CAPTION-SABTU">Sabtu</label>
													</td>
													<td width="5%"><input type="checkbox" id="chW_7" class="chW_7 chW checkbox_form" /></td>
													<td width="10%"><label class="control-label" name="CAPTION-MINGGU">Minggu</label>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BERAKHIR">Berakhir</label>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<select id="updateakhirW" class="form-control">
												<option value="1" selected><label name="CAPTION-TIDAK">Tidak</label>
												</option>
												<option value="2"><label name="CAPTION-YA">Ya</label></option>
											</select>

										</div>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input id="updatetglakhirW" type="date" class="form-control" value="<?= date("Y-m-d") ?>" style="display:none" />
										</div>
									</div>
								</div>
								<div id="updateMode_M" style="display: none;">
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-SETIAP">Setiap</label>
										<div class=" col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input type="text" id="updatetxtjumlahM" class="txtjumlah form-control" value="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
										</div>
										<label class=" col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" align="left" name="CAPTION-BULANSEKALI">Bulan
											Sekali</label>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-TANGGAL">Tanggal</label>
										<div class=" col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input type="text" id="updatetanggalM" class="txtjumlahD form-control" value="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
										</div>
										<label class=" col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" align="left" name="CAPTION-SETIAPBULAN">Setiap
											Bulan</label>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BERAKHIR">Berakhir</label>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<select id="updateakhirM" class="form-control">
												<option value="1" selected><label name="CAPTION-TIDAK">Tidak</label>
												</option>
												<option value="2"><label name="CAPTION-YA">Ya</label></option>
											</select>

										</div>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input id="updatetglakhirM" type="date" class="form-control" value="<?= date("Y-m-d") ?>" style="display:none" />
										</div>
									</div>

								</div>
								<div id="updateMode_Y" style="display: none;">
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-SETIAP">Setiap</label>
										<div class=" col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input type="text" id="updatetxtjumlahY" class="txtjumlah form-control" value="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
										</div>
										<label class=" col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" align="left" name="CAPTION-TAHUNSEKALI">Tahun
											Sekali</label>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4" name="CAPTION-BERAKHIR">Berakhir</label>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<select id="updateakhirY" class="form-control">
												<option value="1" selected><label name="CAPTION-TIDAK">Tidak</label>
												</option>
												<option value="2"><label name="CAPTION-YA">Ya</label></option>
											</select>
										</div>
										<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input id="updatetglakhirY" type="date" class="form-control" value="<?= date("Y-m-d") ?>" style="display:none" />
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="updatesaveEvent()" id="updatesaveEvent"><label name="CAPTION-SIMPAN">Simpan</label></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><label name="CAPTION-BATAL">Batal</label></button>
			</div>
		</div>
	</div>
</div>


<!-- /page content -->


<!-- /page content -->