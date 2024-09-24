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
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 name="CAPTION-DETAILANGGARANTAHUNAN">Detail Anggaran Tahunan</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5 name="CAPTION-DETAILANGGARAN">Detail Anggaran</h5>
                    </div>
                    <div class="x_content">
                        <form id="form-filter-do" class="form-horizontal form-label-left">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-6 col-sm-6 label-align"
                                            name="CAPTION-NODOKUMEN">No Dokumen
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" class="form-control input-date-start"
                                                name="no_doc_header" id="no_doc_header"
                                                value="<?= $anggaran_detail->anggaran_kode ?>" readonly>
                                            <input type="hidden" class="form-control input-date-start" name="id_header"
                                                id="id_header" value="<?= $anggaran_detail->anggaran_id ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-6 col-sm-6 label-align"
                                            name="CAPTION-TAHUNANGGARAN">Tahun Anggaran
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" class="form-control input-date-start" name="tahun"
                                                id="tahun" value="<?= $anggaran_detail->anggaran_tahun ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-6 col-sm-6 label-align"
                                            name="CAPTION-JUMLAHLEVEL">Jumlah Level
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" class="form-control" name="jumlah_level"
                                                id="jumlah_level" value="<?= $anggaran_detail->anggaran_jumlah_level ?>"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="x_title">
                                <h5 name="CAPTION-ANGGARANTAHUNAN">Anggaran Tahunan</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-6 col-sm-6 label-align"
                                            name="CAPTION-NODOKUMENANGGARAN">No Dokumen Anggaran
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" class="form-control input-date-start"
                                                name="no_doc_detail" id="no_doc_detail" placeholder="(Auto)"
                                                value="<?= $anggaran_detail->anggaran_detail_kode ?>" readonly>
                                            <input type="hidden" class="form-control input-date-start"
                                                name="anggaran_detail_id" id="anggaran_detail_id" placeholder="(Auto)"
                                                value="<?= $anggaran_detail->anggaran_detail_id ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-6 col-sm-6 label-align"
                                            name="CAPTION-STATUS">Status
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" class="form-control" name="anggaran_detail_status"
                                                id="anggaran_detail_status"
                                                value="<?= $anggaran_detail->anggaran_detail_status ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-6 col-sm-6 label-align"
                                            name="CAPTION-PENGAJUANAPPROVAL">Pengajuan Approval
                                        </label>
                                        <div class="col-md-2 col-sm-2">
                                            <input type="checkbox" class="form-control" name="aproval" id="aproval"
                                                disabled
                                                <?= ($anggaran_detail->anggaran_detail_status == 'In progress approval') ?  'checked' :  '' ?>>
                                        </div>
                                    </div>
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

                    <div class="row">
                        <table id="tableAnggaran" width="100%" class="table table-responsive">
                            <thead>
                                <tr>
                                    <th name="CAPTION-NO">No</th>
                                    <th name="CAPTION-KODEANGGARAN">Kode Anggaran</th>
                                    <th name="CAPTION-NAMAANGGARAN">Nama Anggaran</th>
                                    <th name="CAPTION-BUDGET">Budget</th>
                                    <th name="CAPTION-ALOKASI">Alokasi</th>
                                    <th name="CAPTION-TERPAKAI">Terpakai</th>
                                    <th name="CAPTION-SISA">Sisa</th>
                                    <th name="CAPTION-ACTION">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <!-- <a class="btn btn-primary btn-update-picklist-progress" id="saveData">Simpan</a> -->
            <a class="btn btn-warning" href="<?php echo site_url('FAS/Barjas/Anggaran/AnggaranMenu') ?>"
                name="CAPTION-KEMBALI">Kembali</a>
        </div>
    </div>
</div>

<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>


<!-- modal Budgeting -->
<div class="modal fade" id="modalAddBudgeting" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title"><label name="CAPTION-DATABUDGET">Data Budget</label></h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="item form-group">
                                <label class="col-form-label col-lg-4 col-md-4 col-sm-4 label-align"
                                    name="CAPTION-NAMAANGGARAN">Nama
                                    Anggaran
                                </label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control input-date-start" name="nama_anggaran_budget"
                                        id="nama_anggaran_budget" readonly>
                                    <input type="hidden" class="form-control input-date-start"
                                        name="kode_anggaran_budget" id="kode_anggaran_budget" readonly>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control input-date-start"
                                        name="total_anggaran_budget" id="total_anggaran_budget" readonly>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="item form-group">
                                <label class="col-form-label col-lg-4 col-md-4 col-sm-4 label-align"
                                    name="CAPTION-UNLIMITED">Unlimited
                                </label>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <input type="checkbox" class="form-control" style="transform:scale(1.0)"
                                        name="cbunlimit" id="cbunlimit" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="x_title">
                        <h5 name="CAPTION-DATABUDGETPERBULAN">Data Budget Per Bulan</h5>
                    </div>
                    <div class="table-responsive">
                        <table id="tableBudget" style="width:100%"
                            class="table table-hover  table-primary table-bordered ">
                            <thead>
                                <tr>

                                    <th style="text-align: center; width: 20%" name="CAPTION-NOURUT">No Urut</th>
                                    <th style="text-align: center; width: 40%" name="CAPTION-BULAN">Bulan</th>
                                    <th style="text-align: center; width: 20%" name="CAPTION-ANGGARAN">Anggaran</th>



                                    <th style="text-align: center; width: 20%" name="CAPTION-ALOKASI">Alokasi</th>
                                    <th style="text-align: center; width: 20%" name="CAPTION-TERPAKAI">Terpakai</th>
                                    <th style="text-align: center; width: 20%" name="CAPTION-SISA">Sisa</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-dark btnclosemodalbuatpackingdo" data-dismiss="modal"><i
                            class="fas fa-xmark"></i> <label name="CAPTION-TUTUP">Tutup</label></button>
                </div>
            </div>
        </div>
    </div>
</div>