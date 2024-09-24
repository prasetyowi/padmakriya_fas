<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> Draft Surat Tugas Pengiriman</h3>
      </div>
      <div style="float: right">

      </div>
    </div>
    <?php foreach ($DOHeader as $header) : ?>
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
                  <input readonly="readonly" type="text" id="deliveryorderdraft-edit-delivery_order_draft_kode" class="form-control input-sm" name="DeliveryOrderDraft[edit_delivery_order_draft_kode]" autocomplete="off" value="<?= $header['delivery_order_draft_kode']; ?>">
                  <input readonly="readonly" type="hidden" id="deliveryorderdraft-edit-delivery_order_draft_id" class="form-control input-sm" name="DeliveryOrderDraft[edit_delivery_order_draft_id]" autocomplete="off" value="<?= $header['delivery_order_draft_id']; ?>">
                  <input type="hidden" id="cek_customer" value="0">
                  <input type="hidden" id="cek_qty" value="0">
                </div>
              </div>
              <div class="col-xs-3">
                <div class="form-group field-deliveryorderdraft-delivery_order_draft_kode">
                  <label class="control-label" for="deliveryorderdraft-delivery_order_draft_kode">Tipe</label>
                  <select name="DeliveryOrderDraft[edit_tipe_delivery_order_id]" class="input-sm form-control" id="deliveryorderdraft-edit-tipe_delivery_order_id">
                    <option value="">** Tipe DO **</option>
                    <?php foreach ($TipeDeliveryOrder as $type) : ?>
                      <option value="<?= $type['tipe_delivery_order_id'] ?>" <?= $type['tipe_delivery_order_id'] == $header['tipe_delivery_order_id'] ? 'selected' : '' ?>><?= $type['tipe_delivery_order_nama'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-3">
                <div class="form-group field-deliveryorderdraft-delivery_order_draft_tgl_buat_do">
                  <label class="control-label" for="deliveryorderdraft-delivery_order_draft_tgl_buat_do">Tanggal Entry DO</label>
                  <input type="text" id="deliveryorderdraft-edit-delivery_order_draft_tgl_buat_do" class="form-control input-sm datepicker" name="DeliveryOrderDraft[edit_delivery_order_draft_tgl_buat_do]" autocomplete="off" value="<?= $header['delivery_order_draft_tgl_buat_do']; ?>">
                </div>
              </div>
              <div class="col-xs-3">
                <div class="form-group field-deliveryorderdraft-delivery_order_draft_tgl_expired_do">
                  <label class="control-label" for="deliveryorderdraft-delivery_order_draft_tgl_expired_do">Tanggal Expired</label>
                  <input type="text" id="deliveryorderdraft-edit-delivery_order_draft_tgl_expired_do" class="form-control input-sm datepicker" name="DeliveryOrderDraft[edit_delivery_order_draft_tgl_expired_do]" autocomplete="off" value="<?= $header['delivery_order_draft_tgl_expired_do']; ?>">
                </div>
              </div>
              <div class="col-xs-3">
                <div class="form-group field-deliveryorderdraft-delivery_order_draft_tgl_surat_jalan">
                  <label class="control-label" for="deliveryorderdraft-delivery_order_draft_tgl_surat_jalan">Tanggal Surat Jalan</label>
                  <input type="text" id="deliveryorderdraft-edit-delivery_order_draft_tgl_surat_jalan" class="form-control input-sm datepicker" name="DeliveryOrderDraft[edit_delivery_order_draft_tgl_surat_jalan]" autocomplete="off" value="<?= $header['delivery_order_draft_tgl_surat_jalan']; ?>">
                </div>
              </div>
              <div class="col-xs-3">
                <div class="form-group field-deliveryorderdraft-delivery_order_draft_tgl_rencana_kirim">
                  <label class="control-label" for="deliveryorderdraft-delivery_order_draft_tgl_rencana_kirim">Tanggal Rencana Kirim</label>
                  <input type="text" id="deliveryorderdraft-edit-delivery_order_draft_tgl_rencana_kirim" class="form-control input-sm datepicker" name="DeliveryOrderDraft[edit_delivery_order_draft_tgl_rencana_kirim]" autocomplete="off" value="<?= $header['delivery_order_draft_tgl_rencana_kirim']; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <div class="form-group field-deliveryorderdraft-client_wms_id">
                  <label for="deliveryorderdraft-client_wms_id" class="control-label">Perusahaan</label>
                  <select id="deliveryorderdraft-edit-client_wms_id" class="input-sm form-control select2" name="DeliveryOrderDraft[edit_client_wms_id]" onchange="getCustomer()">
                    <option value="">** Perusahaan **</option>
                    <?php foreach ($Perusahaan as $row) : ?>
                      <option value="<?= $row['client_wms_id'] ?>" <?= $row['client_wms_id'] == $header['client_wms_id'] ? 'selected' : '' ?>><?= $row['client_wms_nama'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group field-deliveryorderdraft-client_wms_alamat">
                  <label class="control-label" for="deliveryorderdraft-client_wms_alamat">Alamat Perusahaan</label>
                  <textarea readonly="readonly" type="text" id="deliveryorderdraft-edit-client_wms_alamat" class="form-control input-sm" name="DeliveryOrderDraft[edit_client_wms_alamat]" autocomplete="off"><?= $header['client_wms_alamat'] ?></textarea>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="form-group field-deliveryorderdraft-delivery_order_draft_keterangan">
                  <label class="control-label" for="deliveryorderdraft-delivery_order_draft_keterangan">Keterangan</label>
                  <textarea rows="5" type="text" id="deliveryorderdraft-edit-delivery_order_draft_keterangan" class="form-control input-sm" name="DeliveryOrderDraft[edit_delivery_order_draft_keterangan]" autocomplete="off"><?= $header['delivery_order_draft_keterangan'] ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <div class="form-group field-deliveryorderdraft-delivery_order_draft_tipe_pembayaran">
                  <label for="deliveryorderdraft-delivery_order_draft_tipe_pembayaran" class="control-label">Tipe Pembayaran</label>
                  <fieldset>
                    <label>
                      <input class="radio-payment-type" type="radio" name="DeliveryOrderDraft[edit_delivery_order_draft_tipe_pembayaran]" id="deliveryorderdraft-edit-delivery_order_draft_tipe_pembayaran" value="0" <?= $header['delivery_order_draft_tipe_pembayaran'] == 0 ? 'checked' : '' ?>> Tunai
                    </label>
                  </fieldset>
                  <fieldset>
                    <label>
                      <input class="radio-payment-type" type="radio" name="DeliveryOrderDraft[edit_delivery_order_draft_tipe_pembayaran]" id="deliveryorderdraft-edit-delivery_order_draft_tipe_pembayaran" value="1" <?= $header['delivery_order_draft_tipe_pembayaran'] == 1 ? 'checked' : '' ?>> Non Tunai
                    </label>
                  </fieldset>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="form-group field-deliveryorderdraft-delivery_order_draft_tipe_layanan">
                  <label for="deliveryorderdraft-delivery_order_draft_tipe_layanan" class="control-label">Tipe Layanan</label>
                  <?php
                  $index_tipe = 0;
                  foreach ($TipePelayanan as $row) :
                  ?>
                    <fieldset>
                      <label>
                        <input class="radio-service-type" type="radio" id="deliveryorderdraft-edit-delivery_order_draft_tipe_layanan" name="DeliveryOrderDraft[edit_delivery_order_draft_tipe_layanan]" value="<?= $row['tipe_layanan_nama'] ?>" onclick="getCustomer();" <?= $header['delivery_order_draft_tipe_layanan'] == $row['tipe_layanan_nama'] ? 'checked' : '' ?>> <?= $row['tipe_layanan_nama'] ?>
                      </label>
                    </fieldset>
                  <?php
                    $index_tipe++;
                  endforeach;
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" id="panel-customer" style="<?= $header['client_pt_id'] == '' ? 'display:none;' : '' ?>">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h4 class="pull-left">Customer</h4>
              <div class="pull-right"><button data-toggle="modal" data-target="#modal-customer" id="btn-choose-customer" class="btn btn-success" type="button"><i class="fa fa-search"></i> Pilih</button></div>
              <div class="clearfix"></div>
            </div>
            <input type="hidden" name="DeliveryOrderDraft[edit_client_pt_id]" id="deliveryorderdraft-edit-client_pt_id" value="" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_kirim_nama]" id="deliveryorderdraft-edit-delivery_order_draft_kirim_nama" value="<?= $header['client_pt_id']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_kirim_alamat]" id="deliveryorderdraft-edit-delivery_order_draft_kirim_alamat" value="<?= $header['delivery_order_draft_kirim_alamat']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_kirim_provinsi]" id="deliveryorderdraft-edit-delivery_order_draft_kirim_provinsi" value="<?= $header['delivery_order_draft_kirim_provinsi']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_kirim_kota]" id="deliveryorderdraft-edit-delivery_order_draft_kirim_kota" value="<?= $header['delivery_order_draft_kirim_kota']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_kirim_kecamatan]" id="deliveryorderdraft-edit-delivery_order_draft_kirim_kecamatan" value="<?= $header['delivery_order_draft_kirim_kecamatan']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_kirim_kelurahan]" id="deliveryorderdraft-edit-delivery_order_draft_kirim_kelurahan" value="<?= $header['delivery_order_draft_kirim_kelurahan']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_kirim_kodepos]" id="deliveryorderdraft-edit-delivery_order_draft_kirim_kodepos" value="<?= $header['delivery_order_draft_kirim_kodepos']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_kirim_area]" id="deliveryorderdraft-edit-delivery_order_draft_kirim_area" value="<?= $header['delivery_order_draft_kirim_area']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_kirim_telepon]" id="deliveryorderdraft-edit-delivery_order_draft_kirim_telepon" value="<?= $header['delivery_order_draft_kirim_telp']; ?>" />
            <div style="text-align: center; display: none;" class="spinner"><img style="width: 30px;" src="<?= base_url() ?>/assets/images/spinner.gif" alt=""></div>
            <div class="customer-info">
              <div class="row">
                <div class="col-xs-4">
                  <label>Nama:</label>
                  <div class="customer-name"><?= $header['delivery_order_draft_kirim_nama'] ?></div>
                </div>
                <div class="col-xs-4">
                  <label>Alamat:</label>
                  <div class="customer-address"><?= $header['delivery_order_draft_kirim_alamat'] ?></div>
                </div>
                <div class="col-xs-4">
                  <label>Area:</label>
                  <div class="customer-area"><?= $header['delivery_order_draft_kirim_area'] ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" id="panel-factory" style="<?= $header['pabrik_id'] == '' ? 'display:none;' : '' ?>">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h4 class="pull-left">Pabrik</h4>
              <div class="pull-right"><button data-toggle="modal" data-target="#modal-factory" id="btn-choose-factory" class="btn btn-success" type="button"><i class="fa fa-search"></i> Pilih</button></div>
              <div class="clearfix"></div>
            </div>
            <input type="hidden" name="DeliveryOrderDraft[edit_pabrik_id]" id="deliveryorderdraft-edit-pabrik_id" value="" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_ambil_nama]" id="deliveryorderdraft-edit-delivery_order_draft_ambil_nama" value="<?= $header['pabrik_id']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_ambil_alamat]" id="deliveryorderdraft-edit-delivery_order_draft_ambil_alamat" value="<?= $header['delivery_order_draft_ambil_alamat']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_ambil_provinsi]" id="deliveryorderdraft-edit-delivery_order_draft_ambil_provinsi" value="<?= $header['delivery_order_draft_ambil_provinsi']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_ambil_kota]" id="deliveryorderdraft-edit-delivery_order_draft_ambil_kota" value="<?= $header['delivery_order_draft_ambil_kota']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_ambil_kecamatan]" id="deliveryorderdraft-edit-delivery_order_draft_ambil_kecamatan" value="<?= $header['delivery_order_draft_ambil_kecamatan']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_ambil_kelurahan]" id="deliveryorderdraft-edit-delivery_order_draft_ambil_kelurahan" value="<?= $header['delivery_order_draft_ambil_kelurahan']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_ambil_kodepos]" id="deliveryorderdraft-edit-delivery_order_draft_ambil_kodepos" value="<?= $header['delivery_order_draft_ambil_kodepos']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_ambil_telepon]" id="deliveryorderdraft-edit-delivery_order_draft_ambil_telepon" value="<?= $header['delivery_order_draft_ambil_telp']; ?>" />
            <input type="hidden" name="DeliveryOrderDraft[edit_delivery_order_draft_ambil_area]" id="deliveryorderdraft-edit-delivery_order_draft_ambil_area" value="<?= $header['delivery_order_draft_ambil_area']; ?>" />
            <div class="factory-info">
              <div class="row">
                <div class="col-xs-4">
                  <label>Nama:</label>
                  <div class="factory-name" value=""><?= $header['delivery_order_draft_ambil_nama'] ?></div>
                </div>
                <div class="col-xs-4">
                  <label>Alamat:</label>
                  <div class="factory-address" value=""><?= $header['delivery_order_draft_ambil_alamat'] ?></div>
                </div>
                <div class="col-xs-4">
                  <label>Area:</label>
                  <div class="factory-area" value=""><?= $header['delivery_order_draft_ambil_area'] ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="row" id="panel-sku">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h4 class="pull-left">Barang Yang Dikirim</h4>
            <div class="pull-right"><button data-toggle="modal" data-target="#modal-sku" id="btn-choose-prod-delivery" class="btn btn-success" type="button"><i class="fa fa-search"></i> Pilih</button></div>
            <div class="clearfix"></div>
          </div>
          <table class="table table-striped" id="table-sku-delivery-only">
            <thead>
              <tr class="bg-primary">
                <th class="text-center" style="color:white;">SKU Kode</th>
                <th class="text-center" style="color:white;">SKU Kode Pabrik</th>
                <th class="text-center" style="color:white;">SKU</th>
                <th class="text-center" style="color:white;">Kemasan</th>
                <th class="text-center" style="color:white;">Satuan</th>
                <th class="text-center" style="color:white;">Req Exp Date?</th>
                <th class="text-center" style="color:white;">Keterangan</th>
                <th class="text-center" style="color:white;">Qty Req</th>
                <th class="text-center" style="color:white;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($DODetail as $i => $detail) : ?>
                <tr id="row-<?= $i ?>" class="row-item">
                  <td style="display: none">
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_id" value="<?= $detail['sku_id']; ?>" class="sku-id" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-gudang_id" class="gudang-id" value="<?= $detail['gudang_id']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-gudang_detail_id" class="gudang-detail-id" value="<?= $detail['gudang_detail_id']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_harga_satuan" class="sku-harga-satuan" value="<?= $detail['sku_harga_jual']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_disc_percent" class="sku-disc-percent" value="0" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_disc_rp" class="sku-disc-rp" value="0" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_harga_nett" class="sku-harga-nett" value="<?= $detail['sku_harga_jual']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_weight" class="sku-weight" value="<?= $detail['sku_weight']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_weight_unit" class="sku-weight-unit" value="<?= $detail['sku_weight_unit']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_length" class="sku-length" value="<?= $detail['sku_length']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_length_unit" class="sku-length-unit" value="<?= $detail['sku_length_unit']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_width" class="sku-width" value="<?= $detail['sku_width']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_width_unit" class="sku-width-unit" value="<?= $detail['sku_width_unit']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_height" class="sku-height" value="<?= $detail['sku_height']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_height_unit" class="sku-height-unit" value="<?= $detail['sku_height_unit']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_volume" class="sku-volume" value="<?= $detail['sku_volume']; ?>" />
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_volume_unit" class="sku-volume-unit" value="<?= $detail['sku_volume_unit']; ?>" />
                  </td>
                  <td class="text-center">
                    <span class="sku-kode-label"><?= $detail['sku_kode']; ?></span>
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_kode" class="form-control sku-kode" value="<?= $detail['sku_kode']; ?>" />
                  </td>
                  <td class="text-center"></td>
                  <td class="text-center">
                    <span class="sku-nama-produk-label"><?= $detail['sku_nama_produk']; ?></span>
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_nama_produk" class="form-control sku-nama-produk" value="<?= $detail['sku_nama_produk']; ?>" />
                  </td>
                  <td class="text-center">
                    <span class="sku-kemasan-label"><?= $detail['sku_kemasan']; ?></span>
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_kemasan" class="form-control sku-kemasan" value="<?= $detail['sku_kemasan']; ?>" />
                  </td>
                  <td class="text-center">
                    <span class="sku-satuan-label"><?= $detail['sku_satuan']; ?></span>
                    <input type="hidden" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_satuan" class="form-control sku-satuan" value="<?= $detail['sku_satuan']; ?>" />
                  </td>
                  <td class="text-center">
                    <select id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_request_expdate" class="form-control sku-request-expdate">
                      <option value="0" <?= $detail['sku_request_expdate'] == '0' ? 'selected' : '' ?>>Tidak</option>
                      <option value="1" <?= $detail['sku_request_expdate'] == '1' ? 'selected' : '' ?>>Ya</option>
                    </select>
                  </td>
                  <td class="text-center"><input type="text" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_keterangan" class="form-control sku-keterangan" value="<?= $detail['sku_keterangan']; ?>" /></td>
                  <td class="text-center"><input type="number" id="item-<?= $i ?>-DeliveryOrderDetailDraft-sku_qty" class="form-control sku-qty" value="<?= $detail['sku_qty']; ?>" /></td>
                  <td class="text-center">
                    <button class="btn btn-danger btn-small btn-delete-sku" onclick="DeleteSKU(this,<?= $i ?>)"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div style="float: right">
          <a href="<?= base_url('WMS/Distribusi/DeliveryOrderDraft/index') ?>" class="btn btn-info"><i class="fa fa-reply"></i> Kembali</a>
          <button class="btn-submit btn btn-success" id="btnupdatedodraft"><i class="fa fa-save"></i> Save</button>
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
                <select id="filter-area" name="filter_area" class="form-control input-sm select2" style="width:100%;">
                  <option value="">Semua</option>
                  <?php foreach ($Area as $area) : ?>
                    <option value="<?= $area['area_id'] ?>"><?= $area['area_nama'] ?></option>
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
            <table class="table table-striped" id="table-customer">
              <thead>
                <tr class="bg-primary">
                  <th class="text-center" style="color:white;">Nama</th>
                  <th class="text-center" style="color:white;">Alamat</th>
                  <th class="text-center" style="color:white;">Telepon</th>
                  <th class="text-center" style="color:white;">Area</th>
                  <th class="text-center" style="color:white;">Action</th>
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
                <select id="filter-area-principle" name="filter_area_principle" class="form-control input-sm select2" style="width:100%;">
                  <option value="">Semua</option>
                  <?php foreach ($Area as $area) : ?>
                    <option value="<?= $area['area_id'] ?>"><?= $area['area_nama'] ?></option>
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
            <div class="x_content table-responsive">
              <table id="table-factory" width="100%" class="table table-striped">
                <thead>
                  <tr class="bg-primary">
                    <th class="text-center" style="color:white;">Nama</th>
                    <th class="text-center" style="color:white;">Alamat</th>
                    <th class="text-center" style="color:white;">Telepon</th>
                    <th class="text-center" style="color:white;">Area</th>
                    <th class="text-center" style="color:white;">Action</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
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
                <label>Satuan</label>
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
            <table class="table table-striped" id="table-sku">
              <thead>
                <tr class="bg-primary">
                  <th class="text-center" style="color:white;"><input type="checkbox" name="select-sku" id="select-sku" value="1"></th>
                  <th class="text-center" style="color:white;">Sku Induk</th>
                  <th class="text-center" style="color:white;">SKU</th>
                  <th class="text-center" style="color:white;">Kemasan</th>
                  <th class="text-center" style="color:white;">Satuan</th>
                  <th class="text-center" style="color:white;">Principle</th>
                  <th class="text-center" style="color:white;">Brand</th>
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