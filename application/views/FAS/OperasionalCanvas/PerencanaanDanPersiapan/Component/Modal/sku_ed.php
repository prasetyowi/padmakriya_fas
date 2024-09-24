<div class="modal fade" id="modal-ed-sku" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" style="width: 90%;">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title"><label name="CAPTION-CARISKU">Cari SKU</label></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-3">
                <label name="CAPTION-SKUKODE">Kode SKU</label>
                <input type="text" id="caption-ed-sku-kode" name="caption_ed_sku" class="form-control input-sm" readonly />
                <input type="hidden" id="caption-ed-sku-id" name="caption_ed_sku_id" class="form-control input-sm" readonly />
                <input type="hidden" id="caption-ed-sku-index" name="caption_ed_sku_index" value="0" />
              </div>
              <div class="col-xs-3">
                <label name="CAPTION-SKU">SKU</label>
                <input type="text" id="caption-ed-sku" name="caption_ed_sku" class="form-control input-sm" readonly />
              </div>
              <div class="col-xs-3">
                <label name="CAPTION-SKUKEMASAN">Kemasan</label>
                <input type="text" id="caption-ed-sku-kemasan" name="caption_ed_sku_kemasan" class="form-control input-sm" readonly />
              </div>
              <div class="col-xs-3">
                <label name="CAPTION-SKUSATUAN">Satuan</label>
                <input type="text" id="caption-ed-sku-satuan" name="caption_ed_sku_satuan" class="form-control input-sm" readonly />
              </div>
            </div><br>
            <div class="row">
              <div class="col-xs-3">
                <label name="CAPTION-QTY Order">QTY Order</label>
                <input type="text" id="caption-sku-qty-order" name="caption_sku_qty_order" class="form-control input-sm" readonly />
              </div>
              <div class="col-xs-3">
                <label name="CAPTION-TOTALQTY">Total QTY</label>
                <input type="text" id="caption-sku-qty" name="caption_sku_qty" class="form-control input-sm" readonly />
                <input type="hidden" id="caption-ed-sku-harga" name="caption_ed_sku_harga" value="0" />
              </div>
            </div>
          </div>
        </div><br><br>
        <div class="row">
          <div class="col-xs-12">
            <table class="table table-striped" id="table-ed-sku">
              <thead>
                <tr class="bg-primary">
                  <th class="text-center" style="color:white;">No</th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-AREA">Area</span>
                  </th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-SKUREQEXPDATE">Tgl
                      Kadaluwarsa SKU</span></th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-JMLSKUSTOCKTERAKHIR">Stock Akhir</span></th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-QTYAMBIL">QTY
                      Ambil</span></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <span id="loadingedsku" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
        <button type="button" class="btn btn-info" onclick="handlerChoosenEdSKU()"><span name="CAPTION-CHOOSE">Pilih</span></button>
        <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
      </div>
    </div>
  </div>
</div>