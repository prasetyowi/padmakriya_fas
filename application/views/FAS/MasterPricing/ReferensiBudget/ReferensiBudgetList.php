<style>
.modal-body {
    max-height: calc(100vh - 210px);
    overflow-x: auto;
    overflow-y: auto;
}

.invalid-feedback {
    color: red;
}
</style>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 name="CAPTION-REFERENSIBUDGET">Data Referensi Budget</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5 name="CAPTION-PENCARIANREFERENSIBUDGET">Pencarian Referensi Budget</h5>
                    </div>
                    <div class="x_content">
                        <form id="form-filter-do" class="form-horizontal form-label-left">
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4">
                                    <div class="item form-group">
                                        <label class="col-form-label col-lg-6 col-md-6 col-sm-6 label-align"
                                            name="CAPTION-KODEREFERENSI">
                                            Kode Referensi
                                        </label>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <select class="form-control select2" name="diskon_kode" id="diskon_kode"
                                                required>
                                                <option value="">-- Pilih semua --</option>
                                                <?php foreach ($data_ref as $row) { ?>
                                                <option value="<?= $row->referensi_diskon_kode ?>">
                                                    <?= $row->referensi_diskon_kode ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="item form-group">
                                        <label class="col-form-label col-md-6 col-sm-6 label-align"
                                            name="CAPTION-UNIT">Unit</label>
                                        <div class="col-md-6 col-sm-6">
                                            <select class="form-control select2" name="unit" id="unit" required>
                                                <option value="">-- Pilih Unit --</option>
                                                <?php foreach ($data_unit as $row) { ?>
                                                <option value="<?= $row['depo_id'] ?>">
                                                    <?= $row['depo_nama'] ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div> -->
                                </div>

                                <div class="item form-group">
                                    <div class="col-md-12 col-sm-12 text-left">
                                        <button type="button" id="btn-submit-filter"
                                            class="btn btn-md btn-primary btn-submit-filter"><i
                                                class="fa fa-search"></i>
                                            <label name="CAPTION-CARI"> Cari</label></button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ro-batch" id="do-table">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5 name="CAPTION-DAFTARREFERENSIBUDGET">Daftar Referensi Budget</h5>
                        <a href="<?= base_url('FAS/MasterPricing/ReferensiBudget/addReference') ?>" type="button"
                            id="btnaddnewoutlet" class="btn btn-md btn-primary"><i class="fa fa-plus"></i>
                            <label name="CAPTION-TAMBAHREFERENSIBUDGET">Tambah
                                Referensi Budget</label></a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="row">
                            <!--div class="x_content" style="overflow-x:auto"-->
                            <table id="tableReferensi" width="100%" class="table table-striped tableReferensi">
                                <thead>
                                    <tr>
                                        <th name="CAPTION-KODEREFERENSI" class="text-center">Kode Referensi</th>
                                        <th name="CAPTION-DEPO" class="text-center">Unit</th>
                                        <th name="CAPTION-TANGGALAWAL" class="text-center">Tgl Awal Berlaku</th>
                                        <th name="CAPTION-TANGGALAKHIR" class="text-center">Tgl Akhir Berlaku</th>
                                        <th name="CAPTION-TANGGALBUAT" class="text-center">Tanggal Dibuat</th>
                                        <th name="CAPTION-DIBUATOLEH" class="text-center">Dibuat Oleh</th>
                                        <th name="CAPTION-TANGGALAPPROVE" class="text-center">Tanggal Disetujui</th>
                                        <th name="CAPTION-APPROVEOLEH" class="text-center">Disetujui Oleh</th>
                                        <th name="CAPTION-AKSI" class="text-center">Aksi</th>
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
<!-- /page content -->