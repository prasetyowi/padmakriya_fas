<div class="modal fade" id="Modal_masap" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><span name="CAPTION-SUPPLIER">Data Supplier</span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-KODE">Kode</label>
                                        <input type="text" id="Masap-kode" class="form-control" name="Masap[kode]" autocomplete="off" value="">
                                        <input type="hidden" id="Masap-masap_id" class="form-control" name="Masap[masap_id]" autocomplete="off" value="">
                                        <input type="hidden" id="Masap-updtgl" class="form-control" name="Masap[updtgl]" autocomplete="off" value="">
                                        <input type="hidden" id="Masap-updwho" class="form-control" name="Masap[updwho]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-NAMA">Nama</label>
                                        <input type="text" id="Masap-nama" class="form-control" name="Masap[nama]" autocomplete="off" value="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-ALAMAT">Alamat</label>
                                        <input type="text" id="Masap-alamat" class="form-control" name="Masap[alamat]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-KOTA">Kota</label>
                                        <input type="text" id="Masap-kota" class="form-control" name="Masap[kota]" autocomplete="off" value="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-CONTACTPERSON">Contact Person</label>
                                        <input type="text" id="Masap-contact_person" class="form-control" name="Masap[contact_person]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-POSITION">Position</label>
                                        <input type="text" id="Masap-position" class="form-control" name="Masap[position]" autocomplete="off" value="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-TELEPON">Telepon</label>
                                        <input type="text" id="Masap-telepon" class="form-control" name="Masap[telepon]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-FAX">Fax</label>
                                        <input type="text" id="Masap-fax" class="form-control" name="Masap[fax]" autocomplete="off" value="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-NPWP">NPWP</label>
                                        <input type="text" id="Masap-npwp" class="form-control" name="Masap[npwp]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-KETERANGAN">Keterangan</label>
                                        <input type="text" id="Masap-keterangan" class="form-control" name="Masap[keterangan]" autocomplete="off" value="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-NOREK">No. Rek</label>
                                        <input type="text" id="Masap-no_rek" class="form-control" name="Masap[no_rek]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-BANK">Bank</label>
                                        <input type="text" id="Masap-bank" class="form-control" name="Masap[bank]" autocomplete="off" value="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-LIMITHUTANG">Limit Hutang</label>
                                        <input type="text" id="Masap-limit_hutang" class="form-control text-right" name="Masap[limit_hutang]" autocomplete="off" value="" onkeyup="changeFormatRupiah(this,this.value)">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:-10px;">
                                            <label class="control-label" name="CAPTION-KREDIT">Kredit</label>
                                            <input type="text" id="Masap-kredit" class="form-control text-right" name="Masap[kredit]" autocomplete="off" value="" onkeyup="changeFormatRupiah(this,this.value)">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:-10px;margin-top:10px;">
                                            <label class="control-label"></label><br>
                                            <label name="CAPTION-HARI">hari</label>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading"><label name="CAPTION-STATUS">Status</label></div>
                                            <div class="panel-body">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:-10px;">
                                                    <input type="radio" id="Masap-status" name="Masap[status]" autocomplete="off" value="PKP" onclick="getSelectedRadioStatusValue()"> PKP
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:-10px;">
                                                    <input type="radio" id="Masap-status" name="Masap[status]" autocomplete="off" value="NON PKP" onclick="getSelectedRadioStatusValue()"> Non PKP
                                                </div>
                                                <input type="hidden" id="Masap-status-selected" class="form-control" name="Masap[status][selected]" autocomplete="off" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <br>
                                        <input type="checkbox" id="Masap-is_ekspedisi" name="Masap[is_ekspedisi]" autocomplete="off" value="1"> <span name="NAME-EKSPEDISI">Ekspedisi</<span>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                        <div class="x_panel">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-NOPERKPIUTANG">No Perk Hutang</label>
                                    <select class="form-control select2" id="Masap-no_perk_hutang" name="Masap[no_perk_hutang]" style="width:100%;">
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-NOPERKDISON">No Perk Diskon</label>
                                    <select class="form-control select2" id="Masap-no_perk_diskon" name="Masap[no_perk_diskon]" style="width:100%;">
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-NOPERKSELISIHRETUR">No Perk Selisih Retur</label>
                                    <select class="form-control select2" id="Masap-no_perk_selisih_retur" name="Masap[no_perk_selisih_retur]" style="width:100%;">
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-NOPERKPPN">No Perk PPN</label>
                                    <select class="form-control select2" id="Masap-no_perk_ppn" name="Masap[no_perk_ppn]" style="width:100%;">
                                    </select>
                                </div>
                            </div><br>
                        </div>
                        <div class="x_panel">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-SALDOAWAL">Saldo Awal</label>
                                    <input type="text" id="Masap-saldo_awal" class="form-control text-right" name="Masap[saldo_awal]" autocomplete="off" value="" disabled>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-PEMBAYARANKAS">Pembayaran Kas</label>
                                    <input type="text" id="Masap-pembayaran_kas" class="form-control text-right" name="Masap[pembayaran_kas]" autocomplete="off" value="" disabled>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-JUMLAHDEBET">Jumlah Debet</label>
                                    <input type="text" id="Masap-jumlah_debet" class="form-control text-right" name="Masap[jumlah_debet]" autocomplete="off" value="" disabled>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-PEMBAYARANCEK">Pembayaran Cek</label>
                                    <input type="text" id="Masap-pembayaran_cek" class="form-control text-right" name="Masap[pembayaran_cek]" autocomplete="off" value="" disabled>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-JUMLAHKREDIT">Jumlah Kredit</label>
                                    <input type="text" id="Masap-jumlah_kredit" class="form-control text-right" name="Masap[jumlah_kredit]" autocomplete="off" value="" disabled>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-MEMODEBET">Memo Debet</label>
                                    <input type="text" id="Masap-memo_debet" class="form-control text-right" name="Masap[memo_debet]" autocomplete="off" value="" disabled>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-SALDOAKHIR">Saldo Akhir</label>
                                    <input type="text" id="Masap-saldo_akhir" class="form-control text-right" name="Masap[saldo_akhir]" autocomplete="off" value="" disabled>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-MEMOKREDIT">Memo Kredit</label>
                                    <input type="text" id="Masap-memo_kredit" class="form-control text-right" name="Masap[memo_kredit]" autocomplete="off" value="" disabled>
                                </div>
                            </div><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingmasap" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" id="btn_update_masap" class="btn btn-success"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN">Simpan</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger" onclick="ResetForm()"><i class="fa fa-sign-out"></i> <span name="CAPTION-CLOSE">Tutup</span>
                </button>
            </div>
        </div>
    </div>
</div>