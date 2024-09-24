<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-x: auto;
        overflow-y: auto;
    }

    .invalid-feedback {
        color: red;
    }

    @media (min-width: 992px) {
        .modal-lg {
            width: 1200px;
        }
    }
</style>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 name="CAPTION-TAMBAHREFERENSIBUDGET">Tambah Referensi Budget</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="panel panel-default">
            <div class="panel-heading"><label name="CAPTION-FORM">Form</label></div>
            <div class="panel-body form-horizontal form-label-left">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="hidden" id="kode_depo" class="form-control" name="kode_depo" value="<?= $depoKode->depo_kode_preffix ?>" readonly />
                            <input type="hidden" id="depo_grup_id" class="form-control" name="depo_grup_id" value="<?= $depoGroup->depo_group_id ?>" readonly />
                            <input type="hidden" id="karyawan_id" class="form-control" name="karyawan_id" value="<?= $karyawan_id['karyawan_id'] ?>" readonly />
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-KODEREFERENSI">Kode Referensi</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <input type="text" id="kode_referensi" class="form-control" name="kode_referensi" value="" readonly placeholder="Auto" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-TANGGALDIBUAT">Tanggal Dibuat</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <input type="text" class="form-control datepicker" name="tgl_dibuat" id="tgl_dibuat" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-TIPEDATA">Tipe
                                Data</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <select id="tipe_data" name="tipe_data" class="form-control select2" style="width:100%" required>
                                    <option value="">** <label name="CAPTION-PILIHTIPE">Pilih Tipe</label> **</option>
                                    <?php foreach ($tipeData as $row) { ?>
                                        <option value="<?= $row['tipe_referensi_id'] ?>"><?= $row['tipe_referensi_nama'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="showsearchapproved" style="display:none">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-KODEREFERENSI">
                                Kode Referensi
                            </label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <select class="form-control select2" name="diskon_kode" id="diskon_kode" style="width:100%">
                                    <option value="">-- Pilih Kode Referensi --</option>
                                    <?php foreach ($diskonApprove as $row) { ?>
                                        <option value="<?= $row['referensi_diskon_id'] ?>">
                                            <?= $row['referensi_diskon_kode'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-PERUSAHAAN">Perusahaan</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <select id="client_wms" name="client_wms" class="form-control select2" style="width:100%" required>
                                    <option value="">** <label name="CAPTION-PILIHPERUSAHAAN">Pilih Perusahaan</label>
                                        **</option>
                                    <?php foreach ($client as $row) { ?>
                                        <option value="<?= $row['client_wms_id'] ?>"><?= $row['client_wms_nama'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-PRINCIPLE">Principle</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <select id="principle" name="principle" class="form-control select2 principle" style="width:100%" onchange="GetPrincipleData(this.value)" required>
                                    <option value="">** <label name="CAPTION-PILIHPRINCIPLE">Pilih Principle</label> **
                                    </option>
                                    <?php foreach ($principle as $row) { ?>
                                        <option kode-principle="<?= $row['principle_kode'] ?>" value="<?= $row['principle_id'] ?>">
                                            <?= "[" . $row['principle_kode'] . "]  " . $row['principle_nama'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-TIPEPROMO">Tipe
                                Promo</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <select id="tipe_promo" name="tipe_promo" class="form-control select2" style="width:100%" required>
                                    <option value="">** <label name="CAPTION-PILIHTIPE">Pilih Tipe</label> **</option>
                                    <?php foreach ($tipePromo as $row) { ?>
                                        <option kode-promo="<?= $row['tipe_promo_kode'] ?>" value="<?= $row['tipe_promo_id'] ?>">
                                            <?= $row['tipe_promo_nama'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-TANGGALPROMO">Tanggal Promo</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" class="form-control datepicker" name="tgl_promo_awal" id="tgl_promo_awal">
                                </div>
                                <div class="col-sm-1" style="margin: 10px 0 10px;">
                                    <p><b>s/d</b></p>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control datepicker" name="tgl_promo_akhir" id="tgl_promo_akhir">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-TIPEBUDGET">Tipe
                                Budget</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="checkbox" name="tipeBudget" style="transform: scale(1.5);" id="in_qty" name="in_qty" value="1" onchange="inQty(this)" checked>
                                        &nbsp;<label name="" for="in_qty"> In
                                            Qty</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="checkbox" name="tipeBudget" style="transform: scale(1.5);" id="in_value" name="in_value" value="1" onchange="inValue(this)" checked>
                                        &nbsp;<label name="" for="in_value">
                                            In
                                            Value</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-GUNAKANGRUPSKU">Gunakan SKU Grup</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <select id="sku_grup" name="sku_grup" class="form-control select2" style="width:100%" required>
                                    <option value="" selected>** <label name="">Pilih</label> **</option>
                                    <option value="1"><label name="">Iya</label></option>
                                    <option value="0"><label name="">Tidak</label></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-STATUS">Status</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <input type="text" name="status" id="status" class="form-control" value="Draft" readonly>
                                <div class="approval" style="padding-top:6px">
                                    <input type="checkbox" name="pengajuan_approval" style="transform: scale(1.5);" id="pengajuan_approval" value="1">
                                    &nbsp;<label name="CAPTION-PENGAJUANAPPROVAL" for="pengajuan_approval"> Pengajuan
                                        Approval</label>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-NOSURATPROMO">No.
                                Surat Promo</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <input type="text" name="no_surat_promo" id="no_surat_promo" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group" id="shownosuratbaru" style="display:none">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-NOSURATPROMOTAMBAHAN">
                                No. Surat Promo Tambahan
                            </label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <input type="text" name="no_surat_promo_tambahan" id="no_surat_promo_tambahan" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-KETERANGAN">Keterangan</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-NOTIFBUDGET">Notifikasi Pemakaian
                                Budget </label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <input type="number" name="notif_pemakaian" id="notif_pemakaian" class="form-control" value="" min="1" max="100">
                            </div>
                            <div class=" col-md-1 col-sm-1">
                                <h4><b>%</b></h4>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" name="CAPTION-TOTALALOKASI">Total Alokasi
                                Budget</label>
                            <div class="col-md-1 col-sm-1"> <b>:</b>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <input type="text" name="total_alokasi" id="total_alokasi" class="form-control" value="0" placeholder="0" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="formatNominal(this)" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="notSku" style="display: none;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <button type="button" id="carisku" class="btn btn-md btn-warning"><i class="fa fa-search"></i>
                            <label name="CAPTION-CARISKU">Cari SKU</label></button>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="row">
                            <table id="withoutSku" width="100%" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th name="" class="text-center">No</th>
                                        <th name="CAPTION-KODESKU" class="text-center">Kode SKU</th>
                                        <th name="CAPTION-SKUNAMA" class="text-center">SKU Nama</th>
                                        <th name="CAPTION-KEMASAN" class="text-center">Kemasan</th>
                                        <th name="CAPTION-SATUAN" class="text-center">Satuan</th>
                                        <th name="" class="text-center">In Qty</th>
                                        <th name="" class="text-center">In Value</th>
                                        <th name="CAPTION-ALOKASIBUDGET" class="text-center">Alokasi Budget</th>
                                        <th name="CAPTION-AKSI" class="text-center" id="aksi">Aksi</th>
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

        <div class="row ro-batch" id="usingSku" style="display: none;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="#!" type="button" id="add_row" class="btn btn-md btn-primary"><i class="fa fa-plus"></i> <label name="CAPTION-TAMBAHGRUPSKU">Tambah Grup SKU</label></a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="row">
                            <table id="withSku" width="100%" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th name="" class="text-center">No</th>
                                        <th name="CAPTION-GRUPSKU" class="text-center">Grup SKU</th>
                                        <th name="CAPTION-GRUPNAMA" class="text-center">Grup Nama</th>
                                        <th name="" class="text-center">In Qty</th>
                                        <th name="" class="text-center">In Value</th>
                                        <th name="CAPTION-ALOKASIBUDGET" class="text-center">Alokasi Budget</th>
                                        <th name="CAPTION-PENGECUALIANPRODUK" class="text-center">Pengecualian Produk
                                        </th>
                                        <th name="CAPTION-AKSI" class="text-center" id="aksi2">Aksi</th>
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
        <div class="panel-footer text-right">
            <button type="button" class="btn btn-danger" onclick="location.href='<?= base_url('FAS/MasterPricing/ReferensiBudget/ReferensiBudgetMenu') ?>'"><i class="fa fa-reply"></i> <label name="CAPTION-KEMBALI">Kembali</label></button>
            <button type="button" class="btn btn-success" id="btn-save-referensi"><i class="fa fa-save"></i> <label name="CAPTION-SIMPAN"> Simpan</label></button>
        </div>

    </div>
</div>

<!-- /page content -->