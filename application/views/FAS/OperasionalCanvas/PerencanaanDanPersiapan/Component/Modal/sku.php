<div class="modal fade" id="modal-sku" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" style="width: 80%;">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title"><label name="CAPTION-CARISKU">Cari SKU</label></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <table class="table table-striped" id="table-list-sku">
              <thead>
                <tr class="bg-primary">
                  <th class="text-center" style="color:white;"><input type="checkbox" name="select-sku" onclick="handlerSelectAllSku(event)" id="select-sku" value="1"></th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-PERUSAHAAN">Perusahaan</span></th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-SKUKODE">SKU
                      Kode</span></th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-SKUINDUK">Sku
                      Induk</span></th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-SKU">SKU</span>
                  </th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-PRINCIPLE">Principle</span></th>
                  <th class="text-center" style="color:white;"><span name="CAPTION-BRAND">Brand</span>
                  </th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-info" onclick="handlerChoosenSkuInChecked()"><span name="CAPTION-CHOOSE">Pilih</span></button>
        <button type="button" data-dismiss="modal" class="btn btn-danger"><span name="CAPTION-CLOSE">Tutup</span></button>
      </div>
    </div>
  </div>
</div>