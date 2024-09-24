<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-221003002">Form Katalog Promo</span></h3>
			</div>
			<div style="float: right">
				<?php if ($Menu_Access["C"] == 1) : ?>
					<a href="<?= base_url('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Buat Baru</a>
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
								<label class="control-label" for="Filter-sku_katalog_setting_id" name="CAPTION-IDKATALOG">ID Katalog</label>
								<select name="Filter[sku_katalog_setting_id]" class="input-sm form-control select2" id="Filter-sku_katalog_setting_id" style="width:100%;">
									<option value=""><span name="CAPTION-SEMUA">** Semua **</span></option>
									<?php foreach ($Katalog as $row) : ?>
										<option value="<?= $row['sku_katalog_setting_id'] ?>"><?= $row['sku_katalog_setting_kode'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-xs-12">
								<span id="loading" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
								<button type="button" id="btn_search_konfigurasi" class="btn btn-success"><i class="fa fa-search"></i> <span name="CAPTION-CARI">Cari</span></button>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-12">
							<div class="x_content table-responsive">
								<table id="table-data-konfigurasi" width="100%" class="table table-striped table-bordered">
									<thead>
										<tr class="bg-primary">
											<td class="text-center" style="color:white;">#</td>
											<td class="text-center" style="color:white;"><span name="CAPTION-IDKATALOG">ID Katalog</span></td>
											<!-- <td class="text-center" style="color:white;"><span name="CAPTION-LOKASIKERJA">Lokasi Kerja</span></td> -->
											<td class="text-center" style="color:white;"><span name="CAPTION-KETERANGAN">Keterangan</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-DIBUATOLEH">Dibuat Oleh</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-TANGGALDIBUAT">Tanggal Dibuat</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-DISETUJUIOLEH">Disetujui Oleh</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-TANGGALDISETUJUI">Tanggal Disetujui</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-AKTIF">Aktif</span></td>
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