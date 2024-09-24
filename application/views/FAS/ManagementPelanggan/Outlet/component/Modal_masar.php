<div class="modal fade" id="Modal_masar" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><span name="CAPTION-PELANGGAN">Data Pelanggan</span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-PELANGGAN">Pelanggan</label>
                                        <select class="form-control select2" id="filter_pelanggan" style="width:100%;" onchange="GetMasarById()">
                                        </select>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                        <div class="x_panel">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-KODE">Kode</label>
                                        <input type="text" id="Masar-kode" class="form-control" name="Masar[kode]" autocomplete="off" value="">
                                        <input type="hidden" id="Masar-masar_id" class="form-control" name="Masar[masar_id]" autocomplete="off" value="">
                                        <input type="hidden" id="Masar-updtgl" class="form-control" name="Masar[updtgl]" autocomplete="off" value="">
                                        <input type="hidden" id="Masar-updwho" class="form-control" name="Masar[updwho]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-NAMA">Nama</label>
                                        <input type="text" id="Masar-nama" class="form-control" name="Masar[nama]" autocomplete="off" value="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <label class="control-label" name="CAPTION-ALAMAT">Alamat</label>
                                        <input type="text" id="Masar-alamat" class="form-control" name="Masar[alamat]" autocomplete="off" value="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-TELEPON">Telepon</label>
                                        <input type="text" id="Masar-telepon" class="form-control" name="Masar[telepon]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-FAX">Fax</label>
                                        <input type="text" id="Masar-fax" class="form-control" name="Masar[fax]" autocomplete="off" value="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-LOKASI">Lokasi</label>
                                        <select class="form-control select2" id="Masar-lokasi" name="Masar[lokasi]" style="width:100%;">
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:-10px;">
                                            <label class="control-label" name="CAPTION-JATUHTEMPO">Jatuh tempo</label>
                                            <input type="text" id="Masar-jatuh_tempo" class="form-control text-right" name="Masar[jatuh_tempo]" autocomplete="off" value="" onkeyup="changeFormatRupiah(this,this.value)">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:-10px;margin-top:10px;">
                                            <label class="control-label"></label><br>
                                            <label name="CAPTION-HARI">hari</label>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-NPWP">NPWP</label>
                                        <input type="text" id="Masar-npwp" class="form-control" name="Masar[jumlah_kredit]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-LIMITPIUTANG">Limit Piutang</label>
                                        <input type="text" id="Masar-limit_piutang" class="form-control text-right" name="Masar[limit_piutang]" autocomplete="off" value="" onkeyup="changeFormatRupiah(this,this.value)">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-CONTACTPERSON">Contact Person</label>
                                        <input type="text" id="Masar-contact_person" class="form-control" name="Masar[contact_person]" autocomplete="off" value="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="control-label" name="CAPTION-POSITION">Position</label>
                                        <input type="text" id="Masar-position" class="form-control" name="Masar[position]" autocomplete="off" value="">
                                    </div>
                                </div><br>
                            </div>
                        </div>
                        <div class="x_panel">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-NOPERKPIUTANG">No Perk Piutang</label>
                                    <select class="form-control select2" id="Masar-no_perk_piutang" name="Masar[no_perk_piutang]" style="width:100%;">
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-NOPERKDISON">No Perk Diskon</label>
                                    <select class="form-control select2" id="Masar-no_perk_diskon" name="Masar[no_perk_diskon]" style="width:100%;">
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-NOPERKPENJUALAN">No Perk Penjualan</label>
                                    <select class="form-control select2" id="Masar-no_perk_penjualan" name="Masar[no_perk_penjualan]" style="width:100%;">
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-NOPERKPPN">No Perk PPN</label>
                                    <select class="form-control select2" id="Masar-no_perk_ppn" name="Masar[no_perk_ppn]" style="width:100%;">
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-NOPERKRETURJUAL">No Perk Retur Jual</label>
                                    <select class="form-control select2" id="Masar-no_perk_retur_jual" name="Masar[no_perk_retur_jual]" style="width:100%;">
                                    </select>
                                </div>
                            </div><br>
                        </div>
                        <div class="x_panel">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-SALDOAWAL">Saldo Awal</label>
                                    <input type="text" id="Masar-saldo_awal" class="form-control text-right" name="Masar[saldo_awal]" autocomplete="off" value="" disabled>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-PEMBAYARANKAS">Pembayaran Kas</label>
                                    <input type="text" id="Masar-pembayaran_kas" class="form-control text-right" name="Masar[pembayaran_kas]" autocomplete="off" value="" disabled>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-JUMLAHDEBET">Jumlah Debet</label>
                                    <input type="text" id="Masar-jumlah_debet" class="form-control text-right" name="Masar[jumlah_debet]" autocomplete="off" value="" disabled>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-PEMBAYARANCEK">Pembayaran Cek</label>
                                    <input type="text" id="Masar-pembayaran_cek" class="form-control text-right" name="Masar[pembayaran_cek]" autocomplete="off" value="" disabled>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-JUMLAHKREDIT">Jumlah Kredit</label>
                                    <input type="text" id="Masar-jumlah_kredit" class="form-control text-right" name="Masar[jumlah_kredit]" autocomplete="off" value="" disabled>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-MEMODEBET">Memo Debet</label>
                                    <input type="text" id="Masar-memo_debet" class="form-control text-right" name="Masar[memo_debet]" autocomplete="off" value="" disabled>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-SALDOAKHIR">Saldo Akhir</label>
                                    <input type="text" id="Masar-saldo_akhir" class="form-control text-right" name="Masar[saldo_akhir]" autocomplete="off" value="" disabled>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label" name="CAPTION-MEMOKREDIT">Memo Kredit</label>
                                    <input type="text" id="Masar-memo_kredit" class="form-control text-right" name="Masar[memo_kredit]" autocomplete="off" value="" disabled>
                                </div>
                            </div><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingmasar" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" id="btn_update_masar" class="btn btn-success"><i class="fa fa-save"></i> <span name="CAPTION-SIMPAN">Simpan</span></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger" onclick="ResetForm()"><i class="fa fa-sign-out"></i> <span name="CAPTION-CLOSE">Tutup</span>
                </button>
            </div>
        </div>
    </div>
</div>