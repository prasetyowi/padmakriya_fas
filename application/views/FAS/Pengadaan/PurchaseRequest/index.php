<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3><span name="CAPTION-PURCHASEREQUEST">Purchase Request</span></h3>
			</div>
			<div style="float: right">
				<?php if ($Menu_Access["C"] == 1) : ?>
					<a href="<?= base_url('FAS/Pengadaan/PurchaseRequest/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <span name="CAPTION-ADDNEW">Buat Baru<span></a>
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
								<label name="CAPTION-TANGGAL">Tanggal</label>
								<input type="text" id="filter-pr-date" class="form-control" name="filter_pr_date" value="" />
							</div>
							<div class="col-xs-3">
								<label name="CAPTION-PERUSAHAAN">Perusahaan</label>
								<select class="input-sm form-control select2" id="filter-pr-perusahaan" name="filter_pr_perusahaan" <?php echo count($Perusahaan) != 1  ? '' : 'disabled readonly'  ?> required>
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
							<div class="col-xs-3">
								<label name="CAPTION-DIVISI">Divisi</label>
								<select class="input-sm form-control select2" id="filter-pr-divisi" name="filter_pr_divisi">
									<option value="">** Divisi **</option>
									<?php foreach ($Divisi as $row) : ?>
										<option value="<?= $row['karyawan_divisi_id'] ?>"><?= $row['karyawan_divisi_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<!-- <div class="col-xs-3">
								<label for="purchaserequest-tipe_transaksi_id" class="control-label" name="CAPTION-TIPETRANSAKSI">Tipe Transaksi</label>
								<select class="input-sm form-control select2" id="tipe_transaksi_id" name="purchaserequest[tipe_transaksi_id]">
									<option value="">** Pilih **</option>
									<?php foreach ($TipeTransaksi as $row) : ?>
										<option value="<?= $row['tipe_transaksi_id'] ?>"><?= $row['tipe_transaksi_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div> -->
						</div>
						<br />
						<div class="row">
							<div class="col-xs-12">
								<span id="loadingviewpr" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
								<button type="button" id="btn-search-data-pr" class="btn btn-success"><i class="fa fa-search"></i> <span name="CAPTION-CARI">Cari</span></button>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-12">
							<div class="x_content">
								<table id="table_list_data_pr" width="100%" class="table table-striped table-bordered">
									<thead>
										<tr class="bg-primary">
											<td class="text-center" style="color:white;"><label name="CAPTION-DIVISI">Divisi</label></td>
											<td class="text-center" style="color:white;"><label name="CAPTION-NOPR">No. Purchase Request</label></td>
											<td class="text-center" style="color:white;"><label name="CAPTION-TANGGAL">Tanggal</label></td>
											<td class="text-center" style="color:white;"><label name="CAPTION-TGLDIBUTUHKAN">Tgl Dibutuhkan</label></td>
											<td class="text-center" style="color:white;"><label name="CAPTION-STATUS">Status</label></td>
											<td class="text-center" style="color:white;"><label name="CAPTION-TIPEPENGADAAN">Tipe Pengadaan</label></td>
											<td class="text-center" style="color:white;"><label name="CAPTION-DISETUJUI">Disetujui</label></td>
											<td class="text-center" style="color:white;"><label name="CAPTION-TGLDISETUJUI">Tgl Disetujui</label></td>
											<td class="text-center" style="color:white;"><label name="CAPTION-JABATAN">Jabatan</label></td>
											<td class="text-center" style="color:white;"><label name="CAPTION-REQUEST">Request</label></td>
											<!-- <td class="text-center" style="color:white;"><label name="CAPTION-USERREQUEST">User Request</label></td> -->
											<!-- <td class="text-center" style="color:white;"><label name="CAPTION-USERUPDATE">User Update</label></td>
											<td class="text-center" style="color:white;"><label name="CAPTION-TGLUPDATE">Tgl Update</label></td> -->
											<td class="text-center" style="color:white;"><label>Action</label></td>
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