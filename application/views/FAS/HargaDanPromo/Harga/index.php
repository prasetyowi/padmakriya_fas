<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-221003001">Form Katalog harga</span></h3>
			</div>
			<div style="float: right">
				<?php if ($Menu_Access["C"] == 1) : ?>
					<a href="<?= base_url('FAS/MasterPricing/HargaDanPromo/Harga/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Buat Baru</a>
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
							<div class="col-xs-3">
								<label class="control-label" for="SKUharga-sku_harga_kode" name="CAPTION-IDKATALOGHARGA">ID Katalog harga</label>
								<select name="Filter[sku_harga_kode]" class="input-sm form-control select2" id="Filter-sku_harga_kode" style="width:100%;">
									<option value=""><span name="CAPTION-SEMUA">** Semua **</option>
									<?php foreach ($Harga as $row) : ?>
										<option value="<?= $row['sku_harga_kode'] ?>"><?= $row['sku_harga_kode'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-xs-3">
								<label class="control-label" for="SKUharga-client_wms_id" name="CAPTION-PERUSAHAAN">Perusahaan</label>
								<select name="Filter[client_wms_id]" class="input-sm form-control select2" id="Filter-client_wms_id" style="width:100%;">
									<option value=""><span name="CAPTION-SEMUA">** Semua **</option>
									<?php foreach ($Perusahaan as $row) : ?>
										<option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-xs-3">
								<label class="control-label" for="SKUharga-sku" name="CAPTION-STATUS">Status</label>
								<select name="Filter[sku_harga_is_aktif]" class="input-sm form-control select2" id="Filter-sku_harga_is_aktif" style="width:100%;">
									<option value=""><span name="CAPTION-SEMUA">** Semua **</option>
									<option value="1"><span name="CAPTION-AKTIF">Aktif</option>
									<option value="0"><span name="CAPTION-TIDAKAKTIF">Tidak Aktif</option>
								</select>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-xs-12">
								<span id="loading" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
								<button type="button" id="btn-search-data-harga" class="btn btn-success"><i class="fa fa-search"></i> <span name="CAPTION-CARI">Cari</span></button>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-12">
							<div class="x_content table-responsive">
								<table id="table-data-harga" width="100%" class="table table-striped table-bordered">
									<thead>
										<tr class="bg-primary">
											<td class="text-center" style="color:white;">#</td>
											<td class="text-center" style="color:white;"><span name="CAPTION-IDKATALOGHAGRA">ID Katalog Harga</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-PERUSAHAAN">Perusahaan</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-KETERANGAN">Keterangan</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-LOKASIKERJA">Lokasi Kerja</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-TANGGALAWALBERLAKU">Tanggal Awal Berlaku</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-TANGGALAKHIRBERLAKU">Tanggal Akhir Berlaku</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-TANGGALDIBUAT">Tanggal Dibuat</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-DIBUATOLEH">Dibuat Oleh</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-TANGGALDISETUJUI">Tanggal Disetujui</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-DISETUJUIOLEH">Disetujui Oleh</span></td>
											<td class="text-center" style="color:white;"><span name="CAPTION-STATUS">Status</span></td>
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