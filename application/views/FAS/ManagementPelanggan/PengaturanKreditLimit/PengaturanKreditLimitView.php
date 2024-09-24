<style>
#overlay {
    position: fixed;
    top: 0;
    z-index: 100;
    width: 100%;
    height: 100%;
    display: none;
    background: rgba(0, 0, 0, 0.6);
}

.cv-spinner {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 4px #ddd solid;
    border-top: 4px #2e93e6 solid;
    border-radius: 50%;
    animation: sp-anime 0.8s infinite linear;
}

@keyframes sp-anime {
    100% {
        transform: rotate(360deg);
    }
}

.is-hide {
    display: none;
}

#tbody-listSKU tr,
#tbody-listLokasiSKU tr {
    cursor: pointer;
}
</style>
<div class="right_col" role="main">
    <form class="form" enctype="multipart/form-data" id="FormKreditLimit">
        <div class="page-title">
            <div class="title_left">
                <h3 name="CAPTION-FORMPENGAJUANKREDITLIMITPELANGGAN">Form Pengajuan Kredit Limit Pelanggan</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5 name="CAPTION-FORMPENGAJUANKREDITLIMITPELANGGAN">Form Pengajuan Kredit Limit Pelanggan</h5>
                    </div>

                    <div class="x_content">
                        <div class="row form-horizontal form-label-left">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding tab-content" id="anylist">
                                <div class="tab-pane active" id="event">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <input type="hidden" id="add_id" name="add_id" class="txtkode form-control" />
                                        <input type="hidden" id="add_detail_id" name="add_detail_id"
                                            class="txtkode form-control" />
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-NOPENGAJUAN">No
                                                Pengajuan
                                            </label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <input type="text" id="kode" name="kode"
                                                    class="txtselected_date form-control"
                                                    value="<?= $kredit_limit->pengajuan_kredit_kode ?>" readonly />
                                                <input type="hidden" id="add_id_pelanggan" name="add_id_pelanggan"
                                                    class="txtselected_date form-control"
                                                    value="<?= $kredit_limit->client_pt_id ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-TANGGALPENGAJUAN">Tanggal
                                                Pengajuan</label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <input type="date" id="add_tanggal" name="add_tanggal"
                                                    class="txtselected_date form-control"
                                                    value="<?= $kredit_limit->tgl ?>" readonly />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-NAMAPELANGGAN">Nama
                                                Pelanggan
                                            </label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <input type="text" id="kode" name="kode"
                                                    class="txtselected_date form-control"
                                                    value="<?= $kredit_limit->pelanggan_nama ?>" readonly />

                                                <input type="hidden" name="add_client_pt_corporate_id"
                                                    id="add_client_pt_corporate_id" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-ALAMAT">Alamat</label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <textarea id="add_alamat" name="add_alamat"
                                                    class="txtjudul form-control"
                                                    style="height: 90px; width: 100%; resize: none;"
                                                    readonly><?= $kredit_limit->pelanggan_alamat ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-KETERANGAN">Keterangan</label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <textarea id="add_keterangan" name="add_keterangan"
                                                    class="txtjudul form-control"
                                                    readonly><?= $kredit_limit->pengajuan_kredit_keterangan ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-STATUS">Status
                                            </label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <input type="text" id="add_status" name="add_status"
                                                    class="txtselected_date form-control"
                                                    value="<?= $kredit_limit->pengajuan_kredit_status ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-PENGAJUANAPPROVAL">
                                                Pengajuan Approval</label>
                                            <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                <input type="checkbox" class="" style="width: 20px;height: 20px;"
                                                    name="chk_approval" id="chk_approval" onclick="addApproval()"
                                                    <?= $kredit_limit->pengajuan_kredit_status == 'Draft' ? '' : 'checked' ?>
                                                    disabled>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-ALAMATPENGIRIMAN">Alamat
                                                Pengiriman</label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <input type="text" id="add_alamat_pengiriman"
                                                    name="add_alamat_pengiriman"
                                                    class="txtno_rekening add_no_rekening form-control"
                                                    value="<?= $kredit_limit_pelanggan->count_pengiriman == 0 ? 'Tidak' : 'Ya' ?>"
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-ALAMATPENAGIHAN">Alamat
                                                Penagihan</label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <input type="text" id="add_alamat_penagihan" name="add_alamat_penagihan"
                                                    class="txtno_rekening add_no_rekening form-control"
                                                    value="<?= $kredit_limit_pelanggan->count_penagihan == 0 ? 'Tidak' : 'Ya' ?>"
                                                    disabled />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ro-batch" id="do-table">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5 name="CAPTION-DATADETAILPENGAJUAN">Data detail pengajuan</h5>
                    </div>
                    <div class="row">
                        <div class="table-responsive">

                            <table id="tableDetail" style="width:100%;" class="table table-primary table-bordered ">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;" name="CAPTION-PRINCIPLE">Principle</th>
                                        <th style="text-align: center;" name="CAPTION-BOLEHKREDIT">Boleh Kredit</th>
                                        <th style="text-align: center;" name="CAPTION-TOP">TOP</th>
                                        <th style="text-align: center;" name="CAPTION-KREDITLIMIT">Kredit Limit</th>
                                        <th style="text-align: center;" name="CAPTION-MAXINVOICE">Max invoice</th>
                                        <th style="text-align: center;" name="CAPTION-SEGMENTHARGA">Segment Harga</th>
                                        <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 1
                                        </th>
                                        <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 2
                                        </th>
                                        <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 3
                                        </th>
                                        <th style="text-align: center;" name="CAPTION-ALAMATPENAGIHANBERBEDA">Alamat
                                            Penagihan Berbeda</th>
                                        <th style="text-align: center;" name="CAPTION-ALAMATPENAGIHAN">Alamat Penagihan
                                        </th>

                                    </tr>


                                </thead>
                                <tbody>
                                    <?php
									foreach ($kredit_limit_detail as $key => $value) { ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $value['principle_kode'] ?></td>
                                        <td style="text-align: center;"><?= $value['is_kredit'] == 1 ? 'Ya' : 'Tidak' ?>
                                        </td>
                                        <td style="text-align: center;"><?= $value['pengajuan_kredit_top'] ?></td>
                                        <td style="text-align: center;">
                                            <?= format_idr($value['pengajuan_kredit_limit']) ?></td>
                                        <td style="text-align: center;"><?= $value['pengajuan_kredit_maks_invoice'] ?>
                                        <td style="text-align: center;"><?= $value['segmen_harga_id'] ?>
                                        </td>
                                        <td style="text-align: center;"><?= $value['nama_segmen1'] ?>
                                        </td>
                                        <td style="text-align: center;"><?= $value['nama_segmen2'] ?>
                                        </td>
                                        <td style="text-align: center;"><?= $value['nama_segmen3'] ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?= $value['pengajuan_kredit_is_alamat_penagihan_beda'] == 1 ? 'Ya' : 'Tidak' ?>

                                        </td>
                                        <td style="text-align: center;"><?= $value['alamat_penagihan'] ?></td>
                                    </tr>


                                    <?php	}
									?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ro-batch" id="do-table">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5 name="CAPTION-DATAYANGSUDAHTERDAFTAR">Data yang sudah terdaftar</h5>
                    </div>
                    <div class="row">
                        <div class="table-responsive">

                            <table id="tableDetailTersimpan" style="width:100%;"
                                class="table table-primary table-bordered ">
                                <thead>
                                    <tr>
      
                                  <th style="text-align: center;" name="CAPTION-PRINCIPLE">Principle</th>
                                        <th style="text-align: center;" name="CAPTION-BOLEHKREDIT">Boleh Kredit</th>
                                        <th style="text-align: center;" name="CAPTION-TOP">TOP</th>
                                        <th style="text-align: center;" name="CAPTION-KREDITLIMIT">Kredit Limit</th>
                                        <th style="text-align: center;" name="CAPTION-MAXINVOICE">Max invoice</th>
                                        <th style="text-align: center;" name="CAPTION-SEGMENTHARGA">Segment Harga</th>
                                        <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 1
                                        </th>
                                        <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 2
                                        </th>
                                        <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 3
                                        </th>
                                        <th style="text-align: center;" name="CAPTION-ALAMATPENAGIHANBERBEDA">Alamat
                                            Penagihan Berbeda</th>
                                        <th style="text-align: center;" name="CAPTION-ALAMATPENAGIHAN">Alamat Penagihan
                                        </th>
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

        <div class="row mt-2">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="display: flex;align-items:center;justify-content:space-between">

                    <div class="text-right">

                        <a class="btn btn-danger"
                            href="<?php echo site_url('FAS/ManagementPelanggan/PengaturanKreditLimit/PengaturanKreditLimitMenu') ?>"
                            name="CAPTION-KEMBALI">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>