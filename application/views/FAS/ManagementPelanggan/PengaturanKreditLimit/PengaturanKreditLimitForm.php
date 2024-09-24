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
                                                    class="txtselected_date form-control" value="(Auto)" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-TANGGALPENGAJUAN">Tanggal
                                                Pengajuan</label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <input type="date" id="add_tanggal" name="add_tanggal"
                                                    class="txtselected_date form-control" value="<?= date("Y-m-d") ?>"
                                                    readonly />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-NAMAPELANGGAN">Nama
                                                Pelanggan
                                            </label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <select id="add_id_pelanggan" name="add_id_pelanggan"
                                                    class="form-control custom-select">
                                                    <option value="">-- <label name="CAPTION-PILIHPELANGGAN">Pilih
                                                            Pelanggan</label> --</option>
                                                    <?php
													foreach ($pelanggan as $key => $value) {
													?>
                                                    <option value="<?= $value['client_pt_id'] ?>">
                                                        <?= $value['client_pt_nama'] ?></option>
                                                    <?php	}
													?>
                                                    <!-- <option value="">-- Pilih Tipe --</option> -->

                                                </select>
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
                                                    readonly></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-KETERANGAN">Keterangan</label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <textarea id="add_keterangan" name="add_keterangan"
                                                    class="txtjudul form-control"></textarea>
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
                                                    class="txtselected_date form-control" value="Draft" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-PENGAJUANAPPROVAL">
                                                Pengajuan Approval</label>
                                            <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                <input type="checkbox" class="" style="width: 20px;height: 20px;"
                                                    name="chk_approval" id="chk_approval" onclick="addApproval()">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-ALAMATPENGIRIMAN">Alamat
                                                Pengiriman</label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <input type="text" id="add_alamat_pengiriman"
                                                    name="add_alamat_pengiriman"
                                                    class="txtno_rekening add_no_rekening form-control" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"
                                                name="CAPTION-ALAMATPENAGIHAN">Alamat
                                                Penagihan</label>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <input type="text" id="add_alamat_penagihan" name="add_alamat_penagihan"
                                                    class="txtno_rekening add_no_rekening form-control" disabled />
                                            </div>
                                        </div>
                                        <br />
                                        <table id="tableSegment" width="100%" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><label name="CAPTION-SEGMENT">Segment</label> 1</th>
                                                    <th><label name="CAPTION-SEGMENT">Segment</label> 2</th>
                                                    <th><label name="CAPTION-SEGMENT">Segment</label> 3</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>

                                                    <td class="text-center"><input class="form-control" type="text"
                                                            id="segment_1" readonly value="-"></td>
                                                    <td class="text-center"><input class="form-control" type="text"
                                                            id="segment_2" readonly value="-"></td>
                                                    <td class="text-center"><input class="form-control" type="text"
                                                            id="segment_3" readonly value="-"></td>
                                                </tr>
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
        <div class="row ro-batch" id="do-table">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a class="btn btn-sm btn-primary " onclick="addDataDetailPrinciple()"><i class="fa fa-plus"
                                aria-hidden="true"></i> <label name="CAPTION-DATAPRINCIPLE">Data Principle</label></a>
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
                                        <th style="text-align: center;" colspan="2" name="CAPTION-ACTION">Action</th>
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
                        <a class="btn btn-primary btn-update-picklist-progress" id="saveData"
                            name="CAPTION-SIMPAN">Simpan</a>
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

<!-- modal add Permintaan dana -->
<div class="modal fade" id="modalDetail" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xlg">
        <!-- Modal content-->
        <form class="form-horizontal" enctype="multipart/form-data" id="e">
            <div class="modal-content">
                <div class="modal-header bg-primary form-horizontal">
                    <h4 class="modal-title"><label name="CAPTION-ADDDATA">Add Data</label></h4>
                </div>

                <div class="modal-body">
                    <div class="row x_title">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <!-- <label>Data Principle yang terdaftar pada Pelanggan</label> -->
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <select id="slc_add_principle" name="slc_add_principle"
                                        class="form-control custom-select">

                                    </select>
                                </div>
                                <a class="btn btn-primary" onclick="addPricipleToListDetail()"><i
                                        class="fa fa-plus"></i> <label name="CAPTION-TAMBAH">Tambah</label></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="tableAddDetail" style="width:100%"
                            class="table table-hover  table-primary table-bordered ">

                            <thead>
                                <tr>
                                    <th style="text-align: center;" name="CAPTION-PRINCIPLE">Principle</th>
                                    <th style="text-align: center;" name="CAPTION-BOLEHKREDIT">Boleh Kredit</th>
                                    <th style="text-align: center;" name="CAPTION-TOP">TOP</th>
                                    <th style="text-align: center;" name="CAPTION-KREDITLIMIT">Kredit Limit</th>
                                    <th style="text-align: center;" name="CAPTION-MAXINVOICE">Max invoice</th>
                                    <th style="text-align: center;" name="CAPTION-SEGMENTHARGA">Segment Harga</th>
                                    <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 1</th>
                                    <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 2</th>
                                    <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 3</th>
                                    <th style="text-align: center;" name="CAPTION-ALAMATPENAGIHANBERBEDA">Alamat
                                        Penagihan Berbeda</th>
                                    <th style="text-align: center;" name="CAPTION-ALAMATPENAGIHAN">Alamat Penagihan</th>
                                    <th style="text-align: center;" name="CAPTION-ACTION">Action</th>
                                </tr>

                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" title="Save" onclick="addDetail()">
                        Simpan</a>
                    <a type="button" class="btn btn-danger" data-dismiss="modal" name="CAPTION-BATAL">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="modalEdit" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xlg">
        <!-- Modal content-->
        <form class="form-horizontal" enctype="multipart/form-data" id="e">
            <div class="modal-content">
                <div class="modal-header bg-primary form-horizontal">
                    <h4 class="modal-title"><label name="CAPTION-EDITDATA">Edit Data</label></h4>
                </div>

                <div class="modal-body">
                    <div class="row x_title">
                    </div>
                    <div class="table-responsive">
                        <table id="tableEditDetail" style="width:100%"
                            class="table table-hover  table-primary table-bordered ">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" name="CAPTION-PRINCIPLE">Principle</th>
                                    <th style="text-align: center;" name="CAPTION-BOLEHKREDIT">Boleh Kredit</th>
                                    <th style="text-align: center;" name="CAPTION-TOP">TOP</th>
                                    <th style="text-align: center;" name="CAPTION-KREDITLIMIT">Kredit Limit</th>
                                    <th style="text-align: center;" name="CAPTION-MAXINVOICE">Max invoice</th>
                                    <th style="text-align: center;" name="CAPTION-SEGMENTHARGA">Segment Harga</th>
                                    <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 1</th>
                                    <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 2</th>
                                    <th style="text-align: center;"><label name="CAPTION-SEGMENT">Segment</label> 3</th>
                                    <th style="text-align: center;" name="CAPTION-ALAMATPENAGIHANBERBEDA">Alamat
                                        Penagihan Berbeda</th>
                                    <th style="text-align: center;" name="CAPTION-ALAMATPENAGIHAN">Alamat Penagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: center;"><input type="text" class="form-control"
      
                                      name="edit_principle" id="edit_principle" disabled>
                                        <input type="hidden" name="edit_index" id="edit_index">
                                    </td>
                                    <td style="text-align: center;">
                                        <select id="edit_is_kredit" name="edit_is_kredit"
                                            class="form-control custom-select" onchange="chkEditIsKredit()">
                                            <option value="1"><label name="CAPTION-YA">Ya</label></option>
                                            <option value="0"><label name="CAPTION-TIDAK">Tidak</label></option>
                                        </select>
                                    </td>
                                    <td style="text-align: center;"><input type="text" class="form-control"
                                            name="edit_top" id="edit_top"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                    </td>

                                    <td style="text-align: center;"><input type="text" class="form-control"
                                            name="edit_kredit_limit" id="edit_kredit_limit"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>

                                    <td style="text-align: center;"><input type="text" class="form-control"
                                            name="edit_max_invoice" id="edit_max_invoice"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>
                                    <td style="text-align: center;"><input type="text" class="form-control"
                                            name="edit_segment_harga" id="edit_segment_harga" readonly></td>
                                    <td style="text-align: center;">
                                        <select id="edit_segment1" name="edit_segment1" onchange="getSegment2Edit()"
                                            class="form-control custom-select">

                                        </select>
                                    </td>
                                    <td style="text-align: center;">
                                        <select id="edit_segment2" name="edit_segment2" onchange="getSegment3Edit()"
                                            class="form-control custom-select">
                                            <option value="">-- <label name="CAPTION-PILIHSEGMENT">Pilih Segmen</label>
                                                2 --</option>
                                        </select>
                                    </td>
                                    <td style="text-align: center;">
                                        <select id="edit_segment3" name="edit_segment3"
                                            class="form-control custom-select">

                                        </select>
                                    </td>
                                    <td style="text-align: center;"><input type="checkbox" name="edit_is_alamat_beda"
                                            id="edit_is_alamat_beda" onclick="chkAlamatBeda()" /></td>
                                    <td style="text-align: center;">
                                        <select id="edit_alamat" name="edit_alamat" class="form-control custom-select">

                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" title="Save" onclick="updateDetail()" name="CAPTION-SIMPAN">
                        Simpan</a>
                    <a type="button" class="btn btn-danger" data-dismiss="modal" name="CAPTION-BATAL">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>