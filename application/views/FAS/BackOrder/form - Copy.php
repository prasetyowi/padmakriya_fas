<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3> Draft Surat Tugas Pengiriman</h3>
			</div>
			<div style="float: right">

			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="col-xs-3">
							<div class="form-group field-deliveryorderdraft-delivery_order_draft_kode">
								<label class="control-label" for="deliveryorderdraft-delivery_order_draft_kode">No DO</label>
								<input readonly="readonly" type="text" id="deliveryorderdraft-delivery_order_draft_kode" class="form-control input-sm" name="DeliveryOrderDraft[delivery_order_draft_kode]" autocomplete="off" value="">
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-deliveryorderdraft-delivery_order_draft_kode">
								<label class="control-label" for="deliveryorderdraft-delivery_order_draft_kode">Tipe</label>
								<select name="DeliveryOrderDraft[tipe_delivery_order_id]" class="input-sm form-control" id="deliveryorderdraft-tipe_delivery_order_id">
									<option value=""></option>
									<?php foreach ($types as $type) : ?>
										<option <?= set_select('DeliveryOrderDraft[tipe_delivery_order_id]', $type->tipe_delivery_order_id) != "" ? set_select('DeliveryOrderDraft[tipe_delivery_order_id]', $type->tipe_delivery_order_id) : ((isset($deliveryOrderDraft['tipe_delivery_order_id']) && $deliveryOrderDraft['tipe_delivery_order_id'] == $type->tipe_delivery_order_id ? "selected" : "")) ?> value="<?= $type->tipe_delivery_order_id ?>"><?= $type->tipe_delivery_order_nama ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3">
							<div class="form-group field-deliveryorderdraft-delivery_order_draft_tgl_buat_do">
								<label class="control-label" for="deliveryorderdraft-delivery_order_draft_tgl_buat_do">Tanggal Entry DO</label>
								<input type="text" id="deliveryorderdraft-delivery_order_draft_tgl_buat_do" class="form-control input-sm datepicker" name="DeliveryOrderDraft[delivery_order_draft_tgl_buat_do]" autocomplete="off" value="<?= set_value('DeliveryOrderDraft[delivery_order_draft_tgl_buat_do]') != "" ? set_value('DeliveryOrderDraft[delivery_order_draft_tgl_buat_do]') : (isset($deliveryOrderDraft['delivery_order_draft_tgl_buat_do']) ? date('d-m-Y', strtotime($deliveryOrderDraft['delivery_order_draft_tgl_buat_do'])) : date('d-m-Y')) ?>">
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-deliveryorderdraft-delivery_order_draft_tgl_expired_do">
								<label class="control-label" for="deliveryorderdraft-delivery_order_draft_tgl_expired_do">Tanggal Expired</label>
								<input type="text" id="deliveryorderdraft-delivery_order_draft_tgl_expired_do" class="form-control input-sm datepicker" name="DeliveryOrderDraft[delivery_order_draft_tgl_expired_do]" autocomplete="off" value="<?= set_value('DeliveryOrderDraft[delivery_order_draft_tgl_expired_do]') != "" ? set_value('DeliveryOrderDraft[delivery_order_draft_tgl_expired_do]') : (isset($deliveryOrderDraft['delivery_order_draft_tgl_expired_do']) ? date('d-m-Y', strtotime($deliveryOrderDraft['delivery_order_draft_tgl_expired_do'])) : date('d-m-Y')) ?>">
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-deliveryorderdraft-delivery_order_draft_tgl_surat_jalan">
								<label class="control-label" for="deliveryorderdraft-delivery_order_draft_tgl_surat_jalan">Tanggal Surat Jalan</label>
								<input type="text" id="deliveryorderdraft-delivery_order_draft_tgl_surat_jalan" class="form-control input-sm datepicker" name="DeliveryOrderDraft[delivery_order_draft_tgl_surat_jalan]" autocomplete="off" value="<?= set_value('DeliveryOrderDraft[delivery_order_draft_tgl_surat_jalan]') != "" ? set_value('DeliveryOrderDraft[delivery_order_draft_tgl_surat_jalan]') : (isset($deliveryOrderDraft['delivery_order_draft_tgl_surat_jalan']) ? date('d-m-Y', strtotime($deliveryOrderDraft['delivery_order_draft_tgl_surat_jalan'])) : "") ?>">
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group field-deliveryorderdraft-delivery_order_draft_tgl_rencana_kirim">
								<label class="control-label" for="deliveryorderdraft-delivery_order_draft_tgl_rencana_kirim">Tanggal Rencana Kirim</label>
								<input type="text" id="deliveryorderdraft-delivery_order_draft_tgl_rencana_kirim" class="form-control input-sm datepicker" name="DeliveryOrderDraft[delivery_order_draft_tgl_rencana_kirim]" autocomplete="off" value="<?= set_value('DeliveryOrderDraft[delivery_order_draft_tgl_rencana_kirim]') != "" ? set_value('DeliveryOrderDraft[delivery_order_draft_tgl_rencana_kirim]') : (isset($deliveryOrderDraft['delivery_order_draft_tgl_rencana_kirim']) ? date('d-m-Y', strtotime($deliveryOrderDraft['delivery_order_draft_tgl_rencana_kirim'])) : "") ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group field-deliveryorderdraft-client_wms_id">
								<label for="deliveryorderdraft-client_wms_id" class="control-label">Perusahaan</label>
								<select id="DeliveryOrderDraft[client_wms_id]" class="input-sm form-control select2" name="DeliveryOrderDraft[client_wms_id]">
									<?php foreach ($clientwms as $client) : ?>
										<option value="<?= $client->client_wms_id ?>"><?= $client->client_wms_nama ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group field-deliveryorderdraft-client_wms_alamat">
								<label class="control-label" for="deliveryorderdraft-client_wms_alamat">Alamat Perusahaan</label>
								<textarea readonly="readonly" type="text" id="deliveryorderdraft-client_wms_alamat" class="form-control input-sm" name="DeliveryOrderDraft[client_wms_alamat]" autocomplete="off"><?= set_value('DeliveryOrderDraft[client_wms_alamat]') != "" ? set_value('DeliveryOrderDraft[client_wms_alamat]') : "" ?></textarea>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group field-deliveryorderdraft-delivery_order_draft_keterangan">
								<label class="control-label" for="deliveryorderdraft-delivery_order_draft_keterangan">Keterangan</label>
								<textarea rows="5" type="text" id="deliveryorderdraft-delivery_order_draft_keterangan" class="form-control input-sm" name="DeliveryOrderDraft[delivery_order_draft_keterangan]" autocomplete="off"><?= set_value('DeliveryOrderDraft[delivery_order_draft_keterangan]') != "" ? set_value('DeliveryOrderDraft[delivery_order_draft_keterangan]') : (isset($deliveryOrderDraft['delivery_order_draft_keterangan']) ? $deliveryOrderDraft['delivery_order_draft_keterangan'] : "") ?></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group field-deliveryorderdraft-delivery_order_draft_tipe_pembayaran">
								<label for="deliveryorderdraft-delivery_order_draft_tipe_pembayaran" class="control-label">Tipe Pembayaran</label>
								<div id="deliveryorderdraft-delivery_order_draft_tipe_pembayaran">
									<fieldset>
										<label>
											<input class="radio-payment-type" type="radio" name="DeliveryOrderDraft[delivery_order_draft_tipe_pembayaran]" id="DeliveryOrderDraft[delivery_order_draft_tipe_pembayaran]" value="Tunai>"> Tunai
										</label>
									</fieldset>
									<fieldset>
										<label>
											<input class="radio-payment-type" type="radio" name="DeliveryOrderDraft[delivery_order_draft_tipe_pembayaran]" id="DeliveryOrderDraft[delivery_order_draft_tipe_pembayaran]" value="Non Tunai"> Non Tunai
										</label>
									</fieldset>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group field-deliveryorderdraft-delivery_order_draft_tipe_layanan">
								<label for="deliveryorderdraft-delivery_order_draft_tipe_layanan" class="control-label">Tipe Layanan</label>
								<fieldset>
									<label>
										<input class="radio-service-type" type="radio" id="DeliveryOrderDraft[delivery_order_draft_tipe_layanan]" name="DeliveryOrderDraft[delivery_order_draft_tipe_layanan]" value="Delivery Only"> Delivery Only
									</label>
								</fieldset>
								<fieldset>
									<label>
										<input class="radio-service-type" type="radio" id="DeliveryOrderDraft[delivery_order_draft_tipe_layanan]" name="DeliveryOrderDraft[delivery_order_draft_tipe_layanan]" value="Pickup Only"> Pickup Only
									</label>
								</fieldset>
								<fieldset>
									<label>
										<input class="radio-service-type" type="radio" id="DeliveryOrderDraft[delivery_order_draft_tipe_layanan]" name="DeliveryOrderDraft[delivery_order_draft_tipe_layanan]" value="Delivery dan Pickup "> Delivery dan Pickup
									</label>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="panel-customer" style="display:none;">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h4 class="pull-left">Customer</h4>
						<div class="pull-right"><button data-toggle="modal" data-target="#modal-customer" id="btn-choose-customer" class="btn btn-success" type="button"><i class="fa fa-search"></i> Pilih</button></div>
						<div class="clearfix"></div>
					</div>
					<input type="hidden" name="DeliveryOrderDraft[client_pt_id]" id="deliveryorderdraft-client_pt_id" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_kirim_nama]" id="deliveryorderdraft-delivery_order_draft_kirim_nama" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_kirim_alamat]" id="deliveryorderdraft-delivery_order_draft_kirim_alamat" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_kirim_provinsi]" id="deliveryorderdraft-delivery_order_draft_kirim_provinsi" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_kirim_kota]" id="deliveryorderdraft-delivery_order_draft_kirim_kota" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_kirim_kecamatan]" id="deliveryorderdraft-delivery_order_draft_kirim_kecamatan" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_kirim_kelurahan]" id="deliveryorderdraft-delivery_order_draft_kirim_kelurahan" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_kirim_kodepose]" id="deliveryorderdraft-delivery_order_draft_kirim_kodepose" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_kirim_area]" id="deliveryorderdraft-delivery_order_draft_kirim_area" value="" />
					<div style="text-align: center; display: none;" class="spinner"><img style="width: 30px;" src="<?= base_url() ?>/assets/images/spinner.gif" alt=""></div>
					<div class="customer-info">
						<div class="row">
							<div class="col-xs-4">
								<label>Nama:</label>
								<div class="customer-name"></div>
							</div>
							<div class="col-xs-4">
								<label>Alamat:</label>
								<div class="customer-address"></div>
							</div>
							<div class="col-xs-4">
								<label>Area:</label>
								<div class="customer-area"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="panel-factory" style="display:none;">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h4 class="pull-left">Pabrik</h4>
						<div class="pull-right"><button data-toggle="modal" data-target="#modal-factory" id="btn-choose-factory" class="btn btn-success" type="button"><i class="fa fa-search"></i> Pilih</button></div>
						<div class="clearfix"></div>
					</div>
					<input type="hidden" name="DeliveryOrderDraft[pabrik_id]" id="deliveryorderdraft-pabrik_id" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_ambil_nama]" id="deliveryorderdraft-delivery_order_draft_ambil_nama" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_ambil_alamat]" id="deliveryorderdraft-delivery_order_draft_ambil_alamat" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_ambil_provinsi]" id="deliveryorderdraft-delivery_order_draft_ambil_provinsi" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_ambil_kota]" id="deliveryorderdraft-delivery_order_draft_ambil_kota" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_ambil_kecamatan]" id="deliveryorderdraft-delivery_order_draft_ambil_kecamatan" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_ambil_kelurahan]" id="deliveryorderdraft-delivery_order_draft_ambil_kelurahan" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_ambil_kodepose]" id="deliveryorderdraft-delivery_order_draft_ambil_kodepose" value="" />
					<input type="hidden" name="DeliveryOrderDraft[delivery_order_draft_ambil_area]" id="deliveryorderdraft-delivery_order_draft_ambil_area" value="" />
					<div class="factory-info">
						<div class="row">
							<div class="col-xs-4">
								<label>Nama:</label>
								<div class="factory-name" value=""></div>
							</div>
							<div class="col-xs-4">
								<label>Alamat:</label>
								<div class="factory-address" value=""></div>
							</div>
							<div class="col-xs-4">
								<label>Area:</label>
								<div class="factory-area" value=""></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="panel-sku">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h4 class="pull-left">Barang Yang Dikirim</h4>
						<div class="pull-right"><button data-toggle="modal" data-target="#modal-sku" id="btn-choose-prod-delivery" class="btn btn-success" type="button"><i class="fa fa-search"></i> Pilih</button></div>
						<div class="clearfix"></div>
					</div>
					<table class="table table-bordered table-striped" id="table-sku-delivery-only">
						<thead>
							<tr>
								<th class="text-center">SKU Kode</th>
								<th class="text-center">SKU Kode Pabrik</th>
								<th class="text-center">SKU</th>
								<th class="text-center">Kemasan</th>
								<th class="text-center">Satuan</th>
								<th class="text-center">Req Exp Date?</th>
								<th class="text-center">Keterangan</th>
								<th class="text-center">Qty Req</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<!-- <?php foreach ($items as $i => $item) : ?>
								<tr id="row-<?= $i ?>" class="row-item">
									<td style="display: none">
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_id]" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_id]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_id]') : (isset($item['DeliveryOrderDetailDraft']['sku_id']) ? $item['DeliveryOrderDetailDraft']['sku_id'] : "") ?>" class="sku-id" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][gudang_id]" class="gudang-id" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][gudang_id]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][gudang_id]') : (isset($item['DeliveryOrderDetailDraft']['gudang_id']) ? $item['DeliveryOrderDetailDraft']['gudang_id'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][gudang_detail_id]" class="gudang-detail-id" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][gudang_detail_id]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][gudang_detail_id]') : (isset($item['DeliveryOrderDetailDraft']['gudang_detail_id']) ? $item['DeliveryOrderDetailDraft']['gudang_detail_id'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_harga_satuan]" class="sku-harga-satuan" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_harga_satuan]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_harga_satuan]') : (isset($item['DeliveryOrderDetailDraft']['sku_harga_satuan']) ? $item['DeliveryOrderDetailDraft']['sku_harga_satuan'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_disc_percent]" class="sku-disc-percent" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_disc_percent]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_disc_percent]') : (isset($item['DeliveryOrderDetailDraft']['sku_disc_percent']) ? $item['DeliveryOrderDetailDraft']['sku_disc_percent'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_disc_rp]" class="sku-disc-rp" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_disc_rp]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_disc_rp]') : (isset($item['DeliveryOrderDetailDraft']['sku_disc_rp']) ? $item['DeliveryOrderDetailDraft']['sku_disc_rp'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_harga_nett]" class="sku-harga-nett" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_harga_nett]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_harga_nett]') : (isset($item['DeliveryOrderDetailDraft']['sku_harga_nett']) ? $item['DeliveryOrderDetailDraft']['sku_harga_nett'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_weight]" class="sku-weight" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_weight]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_weight]') : (isset($item['DeliveryOrderDetailDraft']['sku_weight']) ? $item['DeliveryOrderDetailDraft']['sku_weight'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_weight_unit]" class="sku-weight-unit" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_weight_unit]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_weight_unit]') : (isset($item['DeliveryOrderDetailDraft']['sku_weight_unit']) ? $item['DeliveryOrderDetailDraft']['sku_weight_unit'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_length]" class="sku-length" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_length]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_length]') : (isset($item['DeliveryOrderDetailDraft']['sku_length']) ? $item['DeliveryOrderDetailDraft']['sku_length'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_length_unit]" class="sku-length-unit" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_length_unit]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_length_unit]') : (isset($item['DeliveryOrderDetailDraft']['sku_length_unit']) ? $item['DeliveryOrderDetailDraft']['sku_length_unit'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_width]" class="sku-width" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_width]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_width]') : (isset($item['DeliveryOrderDetailDraft']['sku_width']) ? $item['DeliveryOrderDetailDraft']['sku_width'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_width_unit]" class="sku-width-unit" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_width_unit]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_width_unit]') : (isset($item['DeliveryOrderDetailDraft']['sku_width_unit']) ? $item['DeliveryOrderDetailDraft']['sku_width_unit'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_height]" class="sku-height" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_height]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_height]') : (isset($item['DeliveryOrderDetailDraft']['sku_height']) ? $item['DeliveryOrderDetailDraft']['sku_height'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_height_unit]" class="sku-height-unit" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_height_unit]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_height_unit]') : (isset($item['DeliveryOrderDetailDraft']['sku_height_unit']) ? $item['DeliveryOrderDetailDraft']['sku_height_unit'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_volume]" class="sku-volume" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_volume]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_volume]') : (isset($item['DeliveryOrderDetailDraft']['sku_volume']) ? $item['DeliveryOrderDetailDraft']['sku_volume'] : "") ?>" />
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_volume_unit]" class="sku-volume-unit" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_volume_unit]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_volume_unit]') : (isset($item['DeliveryOrderDetailDraft']['sku_volume_unit']) ? $item['DeliveryOrderDetailDraft']['sku_volume_unit'] : "") ?>" />
									</td>
									<td>
										<span class="sku-kode-label"><?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_kode]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_kode]') : (isset($item['DeliveryOrderDetailDraft']['sku_kode']) ? $item['DeliveryOrderDetailDraft']['sku_kode'] : "") ?></span>
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_kode]" class="form-control sku-kode" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_kode]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_kode]') : (isset($item['DeliveryOrderDetailDraft']['sku_kode']) ? $item['DeliveryOrderDetailDraft']['sku_kode'] : "") ?>" />
									</td>
									<td></td>
									<td>
										<span class="sku-nama-produk-label"><?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_nama_produk]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_nama_produk]') : (isset($item['DeliveryOrderDetailDraft']['sku_nama_produk']) ? $item['DeliveryOrderDetailDraft']['sku_nama_produk'] : "") ?></span>
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_nama_produk]" class="form-control sku-nama-produk" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_nama_produk]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_nama_produk]') : (isset($item['DeliveryOrderDetailDraft']['sku_nama_produk']) ? $item['DeliveryOrderDetailDraft']['sku_nama_produk'] : "") ?>" />
									</td>
									<td>
										<span class="sku-kemasan-label"><?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_kemasan]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_kemasan]') : (isset($item['DeliveryOrderDetailDraft']['sku_kemasan']) ? $item['DeliveryOrderDetailDraft']['sku_kemasan'] : "") ?></span>
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_kemasan]" class="form-control sku-kemasan" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_kemasan]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_kemasan]') : (isset($item['DeliveryOrderDetailDraft']['sku_kemasan']) ? $item['DeliveryOrderDetailDraft']['sku_kemasan'] : "") ?>" />
									</td>
									<td>
										<span class="sku-satuan-label"><?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_satuan]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_satuan]') : (isset($item['DeliveryOrderDetailDraft']['sku_satuan']) ? $item['DeliveryOrderDetailDraft']['sku_satuan'] : "") ?></span>
										<input type="hidden" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_satuan]" class="form-control sku-satuan" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_satuan]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_satuan]') : (isset($item['DeliveryOrderDetailDraft']['sku_satuan']) ? $item['DeliveryOrderDetailDraft']['sku_satuan'] : "") ?>" />
									</td>
									<td>
										<select name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_request_expdate]" class="form-control sku-request-expdate">
											<option <?= set_select('item[' . $i . '][DeliveryOrderDetailDraft][sku_request_expdate]', '0') ?> value="0">Tidak</option>
											<option <?= set_select('item[' . $i . '][DeliveryOrderDetailDraft][sku_request_expdate]', '1') ?> value="1">Ya</option>
										</select>
									</td>
									<td><input type="text" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_keterangan]" class="form-control sku-keterangan" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_keterangan]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_keterangan]') : (isset($item['DeliveryOrderDetailDraft']['sku_keterangan']) ? $item['DeliveryOrderDetailDraft']['sku_keterangan'] : "") ?>" /></td>
									<td><input type="number" name="item[<?= $i ?>][DeliveryOrderDetailDraft][sku_qty]" class="form-control sku-qty" value="<?= set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_qty]') != "" ? set_value('item[' . $i . '][DeliveryOrderDetailDraft][sku_qty]') : (isset($item['DeliveryOrderDetailDraft']['sku_qty']) ? $item['DeliveryOrderDetailDraft']['sku_qty'] : "") ?>" /></td>
									<td><button class="btn btn-danger btn-small btn-delete-sku"><i class="fa fa-trash"></i></button></td>
								</tr>
							<?php endforeach; ?> -->
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-customer" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label>Cari Customer</label></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-3">
								<label>Nama</label>
								<input type="text" id="filter-client-name" name="filter_client_name" class="form-control input-sm" />
							</div>
							<div class="col-xs-3">
								<label>Alamat</label>
								<input type="text" id="filter-client-address" name="filter_client_address" class="form-control input-sm" />
							</div>
							<div class="col-xs-3">
								<label>Telepon</label>
								<input type="text" id="filter-client-phone" name="filter_client_phone" class="form-control input-sm" />
							</div>
							<div class="col-xs-3">
								<label>Area</label>
								<select id="filter-area" name="filter_area" class="form-control input-sm">
									<option value="">Semua</option>
									<?php foreach ($areas as $area) : ?>
										<option value="<?= $area->area_id ?>"><?= $area->area_nama ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 text-right">
								<label>&nbsp;</label>
								<div>
									<span id="loadingcustomer" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
									<button type="button" id="btn-search-customer" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-bordered table-striped" id="table-customer">
							<thead>
								<tr>
									<th class="text-center">Nama</th>
									<th class="text-center">Alamat</th>
									<th class="text-center">Telepon</th>
									<th class="text-center">Area</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-danger">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-factory" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label>Cari Pabrik</label></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-3">
								<label>Nama</label>
								<input type="text" id="filter-principle-name" name="principle_nama" class="form-control input-sm" />
							</div>
							<div class="col-xs-3">
								<label>Alamat</label>
								<input type="text" id="filter-principle-address" name="principle_alamat" class="form-control input-sm" />
							</div>
							<div class="col-xs-3">
								<label>Telepon</label>
								<input type="text" id="filter-principle-phone" name="principle_telepon" class="form-control input-sm" />
							</div>
							<div class="col-xs-3">
								<label>Area</label>
								<select id="filter-area-principle" name="filter_area_principle" class="form-control input-sm">
									<option value="">Semua</option>
									<?php foreach ($areas as $area) : ?>
										<option value="<?= $area->area_id ?>"><?= $area->area_nama ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 text-right">
								<label>&nbsp;</label>
								<div>
									<span id="loadingfactory" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
									<button type="button" id="btn-search-factory" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-bordered table-striped" id="table-factory">
							<thead>
								<tr>
									<th class="text-center">Nama</th>
									<th class="text-center">Alamat</th>
									<th class="text-center">Telepon</th>
									<th class="text-center">Area</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-danger">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-sku" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><label>Cari SKU</label></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-2">
								<label>SKU Induk</label>
								<input type="text" id="filter-sku-induk" name="filter_sku_induk" class="form-control input-sm" />
							</div>
							<div class="col-xs-2">
								<label>SKU</label>
								<input type="text" id="filter-sku-nama-produk" name="filter_sku_nama_produk" class="form-control input-sm" />
							</div>
							<div class="col-xs-2">
								<label>Kemasan</label>
								<input type="text" id="filter-sku-kemasan" name="filter_sku_kemasan" class="form-control input-sm" />
							</div>
							<div class="col-xs-2">
								<label>Satuan ?></label>
								<input type="text" id="filter-sku-satuan" name="filter_sku_satuan" class="form-control input-sm" />
							</div>
							<div class="col-xs-2">
								<label>Principle</label>
								<input type="text" id="filter-principle" name="filter_principle" class="form-control input-sm" />
							</div>
							<div class="col-xs-2">
								<label>Brand</label>
								<input type="text" id="filter-brand" name="filter_brand" class="form-control input-sm" />
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 text-right">
								<label>&nbsp;</label>
								<div>
									<span id="loadingsku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
									<button type="button" id="btn-search-sku" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-bordered table-striped" id="table-sku">
							<thead>
								<tr>
									<th class="text-center"><input type="checkbox" name="select-sku" id="select-sku" value="1"></th>
									<th class="text-center">Sku Induk</th>
									<th class="text-center">SKU</th>
									<th class="text-center">Kemasan</th>
									<th class="text-center">Satuan</th>
									<th class="text-center">Principle</th>
									<th class="text-center">Brand</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-info btn-choose-sku-multi">Pilih</button>
				<button type="button" data-dismiss="modal" class="btn btn-danger">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="table-sku-delivery-only-template-container" style="display: none">
	<table id="table-sku-delivery-only-template">
		<tr id="row-{index}" class="row-item">
			<td style="display: none">
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_id]" class="sku-id" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][gudang_id]" class="gudang-id" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][gudang_detail_id]" class="gudang-detail-id" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_harga_satuan]" class="sku-harga-satuan" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_disc_percent]" class="sku-disc-percent" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_disc_rp]" class="sku-disc-rp" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_harga_nett]" class="sku-harga-nett" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_weight]" class="sku-weight" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_weight_unit]" class="sku-weight-unit" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_length]" class="sku-length" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_length_unit]" class="sku-length-unit" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_width]" class="sku-width" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_width_unit]" class="sku-width-unit" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_height]" class="sku-height" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_height_unit]" class="sku-height-unit" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_volume]" class="sku-volume" />
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_volume_unit]" class="sku-volume-unit" />
			</td>
			<td>
				<span class="sku-kode-label"></span>
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_kode]" class="form-control sku-kode" />
			</td>
			<td></td>
			<td>
				<span class="sku-nama-produk-label"></span>
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_nama_produk]" class="form-control sku-nama-produk" />
			</td>
			<td>
				<span class="sku-kemasan-label"></span>
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_kemasan]" class="form-control sku-kemasan" />
			</td>
			<td>
				<span class="sku-satuan-label"></span>
				<input type="hidden" name="item[{index}][DeliveryOrderDetailDraft][sku_satuan]" class="form-control sku-satuan" />
			</td>
			<td>
				<select name="item[{index}][DeliveryOrderDetailDraft][sku_request_expdate]" class="form-control sku-request-expdate">
					<option value="0">Tidak</option>
					<option value="1">Ya</option>
				</select>
			</td>
			<td><input type="text" name="item[{index}][DeliveryOrderDetailDraft][sku_keterangan]" class="form-control sku-keterangan" /></td>
			<td><input type="number" name="item[{index}][DeliveryOrderDetailDraft][sku_qty]" class="form-control sku-qty" /></td>
			<td><button class="btn btn-danger btn-small btn-delete-sku"><i class="fa fa-trash"></i></button></td>
		</tr>
	</table>
</div>