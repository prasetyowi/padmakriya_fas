<section>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<div class="clearfix"></div>
				</div>
				<div class="container mt-2">
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label name="CAPTION-NODOKUMEN">No. Dokumen</label>
										<input type="hidden" name="lastUpdated" id="lastUpdated" value="<?= isset($dataCanvas) ? $dataCanvas->header->canvas_tgl_update : "" ?>">
										<input type="text" class="form-control" name="kode_dokumen" id="kode_dokumen" placeholder="Auto generate" value="<?= isset($dataCanvas) ? $dataCanvas->header->canvas_kode : "" ?>" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label name="CAPTION-TANGGALPERMINTAAN">Tanggal Request</label>
										<input type="text" class="form-control" name="tgl_request" id="tgl_request" value="<?= isset($dataCanvas) ? $dataCanvas->header->canvas_requestdate : date('Y-m-d') ?>" disabled>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label name="CAPTION-SALES">Sales</label>
								<select name="sales" id="sales" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> class="form-control select2">
									<option value="">--Pilih Sales--</option>
									<?php foreach ($sales as $value) { ?>
										<option value="<?= $value->client_pt_id ?>" <?= isset($dataCanvas) && $dataCanvas->header->client_pt_id == $value->client_pt_id ? 'selected' : '' ?>><?= $value->client_pt_nama ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label name="CAPTION-PT">Perusahaan</label>
								<?php if (isset($clientPT)) { ?>
									<select name="perusahaan" id="perusahaan" class="form-control select2" onchange="GetPrincipleByPerusahaan()" disabled>
										<option value="<?= $this->session->userdata('client_wms_id') ?>" selected><?= $clientPT->client_wms_nama ?></option>
									</select>
								<?php } else { ?>
									<select name="perusahaan" id="perusahaan" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> class="form-control select2" onchange="GetPrincipleByPerusahaan()">
										<option value="">--Pilih Perusahaan--</option>
										<?php foreach ($clientWMS as $value) { ?>
											<option value="<?= $value->id ?>" <?= isset($dataCanvas) && $dataCanvas->header->client_wms_id == $value->id ? 'selected' : '' ?>><?= $value->nama ?></option>
										<?php } ?>
									</select>
								<?php } ?>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label name="CAPTION-TANGGALMULAI">Tanggal Mulai</label>
										<input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" value="<?= isset($dataCanvas) ? $dataCanvas->header->canvas_startdate : "" ?>" placeholder="dd-mm-yyyy" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label name="CAPTION-TANGGALAKHIR">Tanggal Akhir</label>
										<input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="<?= isset($dataCanvas) ? $dataCanvas->header->canvas_enddate : "" ?>" placeholder="dd-mm-yyyy" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> />
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label name="CAPTION-STATUS">Status</label>
										<input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?= isset($dataCanvas) ? $dataCanvas->header->canvas_status : "Draft" ?>" disabled>
									</div>

								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label name="CAPTION-NOKENDARAAN">No. Kendaraan</label>
										<select name="kendaraan_id" id="kendaraan_id" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> class="form-control select2">
											<option value="">--Pilih Kendaraan--</option>
											<?php foreach ($kendaraans as $kendaraan) { ?>
												<option value="<?= $kendaraan->kendaraan_id ?>" <?= isset($dataCanvas) && $dataCanvas->header->kendaraan_id == $kendaraan->kendaraan_id ? 'selected' : '' ?>><?= $kendaraan->kendaraan_nopol ?></option>
											<?php } ?>
										</select>
									</div>

								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="area">Area</label>
										<select name="area" id="area" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> class="form-control select2" multiple="multiple">
											<?php foreach ($areas as $area) { ?>
												<option value="<?= $area->area_id ?>" <?= isset($dataCanvas) && in_array($area->area_id, $dataCanvas->detailAreas) ? 'selected' : '' ?>><?= $area->area_kode ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="PRINCIPLE">Principle</label>
										<select name="principle_id" id="principle_id" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> class="form-control select2">
											<option value="">--Pilih Principle--</option>
											<?php foreach ($Principle as $value) { ?>
												<option value="<?= $value->principle_id ?>" <?= isset($dataCanvas) && $dataCanvas->header->principle_id == $value->principle_id ? 'selected' : '' ?>><?= $value->principle_kode ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
							<div class="form-group">
								<label name="CAPTION-KETERANGAN">Keterangan</label>
								<textarea cols="10" style="width: 100%;height: 100px" class="form-control" name="keterangan" id="keterangan" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> placeholder="Keterangan"><?= isset($dataCanvas) ? ($dataCanvas->header->canvas_keterangan == null ? "" : $dataCanvas->header->canvas_keterangan) : "" ?></textarea>
							</div>

							<div class="form-group">
								<label for="ajukan_approval"></label>
								<input type="checkbox" name="" style="margin-top:10px;transform: scale(1.5)" onclick="handlerChangeStatus(event)" id="ajukan_approval" value="Approved" <?= $this->uri->segment(4) == "view" ? 'disabled' : '' ?> />
								<span style="margin-left: 10px;font-size:15px;font-weight:700" name="CAPTION-LAKSANAKAN">Laksanakan</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>