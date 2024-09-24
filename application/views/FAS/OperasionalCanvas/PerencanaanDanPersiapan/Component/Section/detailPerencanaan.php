<section id="sectionDataDetailOpname">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h4 class="pull-left" name="CAPTION-BARANGYANGDIKIRIM">Barang Yang Dikirim</h4>
          <?php if ($this->uri->segment(4) != "view") { ?>
            <div class="pull-right"><button class="btn btn-success" type="button" onclick="handlerShowSKU()"><i class="fa fa-search"></i> <span name="CAPTION-CHOOSE" style="color:white;">Pilih</span></button></div>
          <?php } ?>
          <div class="clearfix"></div>
        </div>
        <table class="table table-striped" id="table-sku" style="width:100%;">
          <thead>
            <tr class="bg-primary">
              <th class="text-center" style="display:none;"></th>
              <th class="text-center" style="color:white;"><span name="CAPTION-PRINCIPLE">Principle</span></th>
              <th class="text-center" style="color:white;"><span name="CAPTION-BRAND">Brand</span></th>
              <th class="text-center" style="color:white;"><span name="CAPTION-SKUKODE">SKU Kode</span></th>
              <th class="text-center" style="display:none;"></th>
              <th class="text-center" style="color:white;"><span name="CAPTION-SKU">SKU</span></th>
              <th class="text-center" style="color:white;"><span name="CAPTION-SKUKEMASAN">Kemasan</span></th>
              <th class="text-center" style="color:white;"><span name="CAPTION-SKUSATUAN">Satuan</span></th>
              <th class="text-center" style="color:white;"><span name="CAPTION-SKUQTY">Qty</span></th>
              <th class="text-center" style="color:white;" hidden><span name="CAPTION-ED">ED Product</span></th>
              <th class="text-center" style="color:white;"><span name="CAPTION-KETERANGAN">Keterangan</span></th>
              <th class="text-center" style="color:white;"><span name="CAPTION-TIPESTOK">Tipe Stok</span></th>
              <th class="text-center" style="color:white;">Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div style="float: right">
        <?php if ($this->uri->segment(4) != "view") { ?>
          <button class="btn-submit btn btn-success" id="btnsaveso" onclick="handlerSaveData()"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN" style="color:white;">Simpan</span></button>
        <?php } ?>
        <button class="btn-submit btn btn-dark" onclick="handlerBackToHome()"><i class="fa fa-arrow-left"></i> <span name="CAPTION-KEMBALI" style="color:white;">Kembali</span></button>
      </div>
    </div>
  </div>
</section>