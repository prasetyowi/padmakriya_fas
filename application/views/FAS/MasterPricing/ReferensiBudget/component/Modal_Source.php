<div class="modal fade" id="confirmDelete" style="display: none;" tabindex="-1" role="dialog" data-keyboard="false"
    data-backdrop="static">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                <h4 class="modal-title"><label name="CAPTION-HAPUSDATAREFERENSIBUDGET">Hapus Data Referensi
                        Budget</label></h4>
                <input type="hidden" id="hddeleteoutletid" />
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h4><label name="CAPTION-APAKAHANDAYAKINUNTUKMENGHAPUSDATAREFERENSIBUDGET">Apakah anda
                                yakin
                                untuk menghapus
                                Data Referensi Budget </label> <strong><label id="lbdeleteoutletname"></label></strong>
                            ?</h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingdelete" style="display:none;"><i class="fa fa-spinner fa-spin"></i>
                    Loading...</span>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="btnyesdeleteoutlet"><label
                        name="CAPTION-IYA">Iya</label></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnnodeleteoutlet"><label
                        name="CAPTION-TIDAK">Tidak</label></button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cariSku" style="display: none;" tabindex="-1" role="dialog" data-keyboard="false"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                <h4 class="modal-title"><label name="CAPTION-CARISKU">Cari SKU</label></h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><label name="CAPTION-PENCARIANSKU">Pencarian SKU</label></h4>
                    </div>
                    <div class="panel-body form-horizontal form-label-left">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        name="CAPTION-DEPO">Depo</label>
                                    <div class="col-md-1 col-sm-1"> <b>:</b>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <select id="depo" class="form-control select2" name="depo" disabled
                                            style="width:100%">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        name="CAPTION-SKUINDUK">SKU
                                        Induk</label>
                                    <div class="col-md-1 col-sm-1"> <b>:</b>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <select id="sku_induk" name="sku_induk" class="form-control select2"
                                            style="width:100%" required>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        name="CAPTION-PRINCIPLE">Principle</label>
                                    <div class="col-md-1 col-sm-1"> <b>:</b>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <select id="getPrinciple" class="form-control select2" name="getPrinciple"
                                            disabled style="width:100%">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        name="CAPTION-BRAND">Brand</label>
                                    <div class="col-md-1 col-sm-1"> <b>:</b>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <select id="brand" name="brand" class="form-control select2" style="width:100%"
                                            required>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        name="CAPTION-SKUNAMA">Nama SKU</label>
                                    <div class="col-md-1 col-sm-1"> <b>:</b>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="text" name="nama_sku" id="nama_sku" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        name="CAPTION-KODESKU">Kode SKU
                                        WMS</label>
                                    <div class="col-md-1 col-sm-1"> <b>:</b>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="text" name="kode_sku_wms" id="kode_sku_wms" class="form-control"
                                            value="">
                                    </div>
                                </div>
                                <span id="loading" style="display:none;"><i class="fa fa-spinner fa-spin"></i>
                                    Loading...</span>
                                <button type="button" id="btn-cari-sku" class="btn btn-md btn-warning btn-cari-sku"
                                    style="float: right">
                                    <i class="fa fa-search"></i>
                                    <label name="CAPTION-CARISKU">Cari SKU</label>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="notSku">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h4><label name="CAPTION-DAFTARSKU">Daftar SKU</label></h4>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <div class="row">
                                    <!--div class="x_content" style="overflow-x:auto"-->
                                    <table id="table-cari-sku" width="100%" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th name="" class="text-center"><input type="checkbox"
                                                        name="chk-data-all" style="transform: scale(1.5);"
                                                        id="chk-data-all" value="1" onchange="checkAllSKU(this)">
                                                </th>
                                                <th name="CAPTION-PILIH" class="text-center">Pilih</th>
                                                <th name="CAPTION-SKUINDUK" class="text-center">SKU Induk</th>
                                                <th name="CAPTION-SKU" class="text-center">SKU</th>
                                                <th name="CAPTION-KEMASAN" class="text-center">Kemasan</th>
                                                <th name="CAPTION-SATUAN" class="text-center">Satuan</th>
                                                <th name="CAPTION-PRINCIPLE" class="text-center">Principle</th>
                                                <th name="CAPTION-BRAND" class="text-center">Brand</th>
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
            <div class="modal-footer">
                <span id="loadingdelete" style="display:none;"><i class="fa fa-spinner fa-spin"></i>
                    Loading...</span>
                <button type="button" class="btn btn-success" id="btn_pilih_sku"><label
                        name="CAPTION-PILIH">Pilih</label></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnnodeleteoutlet"><label
                        name="CAPTION-BATAL">Batal</label></button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExceptProduk" class="modalExceptProduk" tabindex="-1" role="dialog"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                <h4 class="modal-title"><label name="CAPTION-PENGECUALIANPRODUK">Pengecualian Produk</label></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="notSku">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <div class="row">
                                    <!--div class="x_content" style="overflow-x:auto"-->
                                    <table id="tableException" class="table table-striped tableException">
                                        <thead>
                                            <tr>
                                                <th name="" class="text-center">No</th>
                                                <th name="CAPTION-PILIH" class="text-center">Pilih</th>
                                                <th name="CAPTION-KODESKU" class="text-center">Kode SKU</th>
                                                <th name="CAPTION-NAMASKU" class="text-center">Nama SKU</th>
                                                <th name="CAPTION-KEMASAN" class="text-center">Kemasan</th>
                                                <th name="CAPTION-SATUAN" class="text-center">Satuan</th>
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
            <div class="modal-footer">
                <span id="loadingdelete" style="display:none;"><i class="fa fa-spinner fa-spin"></i>
                    Loading...</span>
                <?php if ($this->uri->segment(4) == 'detailReference') { ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnnodeleteoutlet"><label
                        name="CAPTION-KEMBALI">Kembali</label></button>
                <?php } else { ?>
                <button type="button" class="btn btn-success" id="btnSimpanExcept" onclick="saveSkuTemp()"><label
                        name="CAPTION-SIMPAN">Simpan</label></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnnodeleteoutlet"><label
                        name="CAPTION-KEMBALI">Kembali</label></button>
                <?php } ?>

            </div>
        </div>
    </div>
</div>