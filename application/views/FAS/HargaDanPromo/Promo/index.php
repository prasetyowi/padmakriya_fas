<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-221003002">Form Katalog Promo</span></h3>
			</div>
			<div style="float: right">
				<?php if ($Menu_Access["C"] == 1) : ?>
					<a href="<?= base_url('FAS/MasterPricing/HargaDanPromo/Promo/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Buat Baru</a>
				<?php endif; ?>
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
						<div class="row">
							<div class="col-xs-6">
								<label class="control-label" for="SKUPromo-sku_promo_kode" name="CAPTION-IDKATALOGPROMO">ID Katalog Promo</label>
								<select name="Filter[sku_promo_kode]" class="input-sm form-control select2" id="Filter-sku_promo_kode" style="width:100%;">
									<option value=""><span name="CAPTION-SEMUA">** Semua **</span></option>
									<?php foreach ($Promo as $row) : ?>
										<option value="<?= $row['sku_promo_kode'] ?>"><?= $row['sku_promo_kode'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-xs-6">
								<div class="form-group field-Filter-depo_group_id">
									<label class="control-label" for="Filter-depo_group_id" name="CAPTION-GROUPLOKASIKERJA">Group Lokasi Kerja</label>
									<select id="Filter-depo_group_id" class="selectpicker form-control" name="Filter[depo_group_id]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Group Workplace">
										<?php foreach ($DepoGroup as $row) : ?>
											<option value="'<?= $row['depo_group_nama'] ?>'"><?= $row['depo_group_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group field-Filter-depo_id">
									<label class="control-label" for="Filter-depo_id" name="CAPTION-LOKASIKERJA">Lokasi Kerja</label>
									<span id="loadingdepo" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
									<select id="Filter-depo_id" class="selectpicker form-control" name="Filter[depo_id]" data-live-search="true" style="color:#000000" multiple required data-actions-box="true" title="Select Workplace">
										<?php foreach ($Depo as $row) : ?>
											<option value="'<?= $row['depo_id'] ?>'"><?= $row['depo_nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div> -->
						<br />
						<div class="row">
							<div class="col-xs-12">
								<span id="loading" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
								<button type="button" id="btn-search-data-promo" class="btn btn-success"><i class="fa fa-search"></i> <span name="CAPTION-CARI">Cari</span></button>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-12">
							<div class="x_content table-responsive">
								<table id="table-data-promo" width="100%" class="table table-striped table-bordered">
									<thead>
										<tr class="bg-primary">
											<td class="text-center" style="color:white;">#</td>
											<td class="text-center" style="color:white;"><span name="CAPTION-IDKATALOGPROMO">ID Katalog Promo</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-LOKASIKERJA">Lokasi Kerja</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-TANGGALAWALBERLAKU">Tanggal Awal Berlaku</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-TANGGALAKHIRBERLAKU">Tanggal Akhir Berlaku</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-TANGGALDIBUAT">Tanggal Dibuat</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-DIBUATOLEH">Dibuat Oleh</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-TANGGALDISETUJUI">Tanggal Disetujui</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-DISETUJUIOLEH">Disetujui Oleh</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-STATUS">Status</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-ACTION">Action</span></td>
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
</div>