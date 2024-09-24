<div class="modal fade" id="previewaddnewoutlet" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" style="width: 95%;">
        <!-- Modal content-->
        <div class="modal-content modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><label name="CAPTION-TAMBAHDATAOUTLET">Tambah Data Outlet</label></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group rbmode mb-4" style="padding-left: 2rem;">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
                            <input type="radio" style="margin-left: -25px;margin-top: -2px;" class="checkbox_form col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" id="rbheadoffice" value="office" name="rbmode" checked onchange="handlerViewModeClient(event)" />
                            <label class="control-label col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" name="CAPTION-HEADOFFICE">Head Office</label>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
                            <input type="radio" style="margin-left: -50px; margin-top: -2px;" class="checkbox_form col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" id="rbcabang" value="cabang" name="rbmode" onchange="handlerViewModeClient(event)" />
                            <label class="control-label col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" name="CAPTION-CABANG">Cabang</label>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
                            <input type="radio" style="margin-left: -50px; margin-top: -2px;" class="checkbox_form col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" id="rbinternal" value="internal" name="rbmode" onchange="handlerViewModeClient(event)" />
                            <label class="control-label col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" name="CAPTION-INTERNAL">Internal</label>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group txtoffice-coorporate mt-4" style="display: none;">
                            <label>Head Office</label>
                            <select class="select2 form-control" name="txtoffice-coorporate" id="txtoffice-coorporate">
                                <option value="">--Pilih Head Office--</option>
                                <?php foreach ($clientPtCorporate as $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback invalid-office-corporate"></div>
                            <?= form_error('office_corporate', '<small class="text-danger pl-2" style="margin-top:3px;">', '</small>'); ?>
                        </div><br>

                        <div class="form-group txtname-coorporate">
                            <label name="CAPTION-NAMA">Nama</label>
                            <input type="text" class="form-control<?php if (form_error('name_corporate')) echo 'has-error'; ?>" name="txtname-coorporate" id="txtname-coorporate" placeholder="Nama Outlet" required />
                            <div class="invalid-feedback invalid-nama-corporate"></div>
                            <?= form_error('name_corporate', '<small class="text-danger pl-2" style="margin-top:3px;">', '</small>'); ?>
                        </div>

                        <div class="form-group txtaddress-coorporate">
                            <label name="CAPTION-ALAMAT">Alamat</label>
                            <textarea type="text" class="form-control" rows="3" name="txtaddress-coorporate" id="txtaddress-coorporate" placeholder="Alamat Outlet" required></textarea>
                            <div class="invalid-feedback invalid-alamat-corporate"></div>
                        </div>

                        <!-- <div class="form-group listcoorporate-group">
                            <label>Coorporate Group</label>
                            <select class="form-control" name="listcoorporate-group" id="listcoorporate-group">
                                <option value="">--Pilih Coorporate Group--</option>
                            </select>
                        </div> -->

                        <div class="form-group txtphone-coorporate">
                            <label name="CAPTION-TELEPON">Telepon</label>
                            <input type="text" class="form-control numeric <?php if (form_error('phone_corporate')) echo 'has-error'; ?>" name="txtphone-coorporate" id="txtphone-coorporate" placeholder="Telepon Outlet" required />
                            <div class="invalid-feedback invalid-telepon-corporate"></div>
                            <?= form_error('phone_corporate', '<small class="text-danger pl-2" style="margin-top:3px;">', '</small>'); ?>
                        </div>

                        <div class="form-group listcoorporate-province">
                            <label name="CAPTION-PROVINSI">Provinsi</label>
                            <select class="select2 form-control" name="listcoorporate-province" id="listcoorporate-province" required>
                                <option value="">--Pilih Provinsi--</option>
                                <?php foreach ($Provinsi as $row) { ?>
                                    <option value="<?= $row['reffregion_nama'] ?>"><?= $row['reffregion_nama'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback invalid-provinsi-corporate"></div>
                        </div>

                        <div class="form-group listcoorporate-city">
                            <label name="CAPTION-KOTA">Kota</label>
                            <select class="select2 form-control" name="listcoorporate-city" id="listcoorporate-city" required>

                            </select>
                            <div class="invalid-feedback invalid-kota-corporate"></div>
                        </div>

                        <div class="form-group listcoorporate-districts">
                            <label name="CAPTION-KECAMATAN">Kecamatan</label>
                            <select class="select2 form-control" name="listcoorporate-districts" id="listcoorporate-districts" required></select>
                            <div class="invalid-feedback invalid-kecamatan-corporate"></div>
                            <input type="hidden" id="data-districts" />
                        </div>

                        <div class="form-group listcoorporate-ward">
                            <label name="CAPTION-KELURAHAN">Kelurahan</label>
                            <select class="select2 form-control" name="listcoorporate-ward" id="listcoorporate-ward" required>

                            </select>
                            <div class="invalid-feedback invalid-kelurahan-corporate"></div>
                            <input type="hidden" id="data-ward" />
                        </div>

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                <div class="form-group txtpostalcode-coorporate">
                                    <label name="CAPTION-KODEPOS">Kode Pos</label>
                                    <input type="text" class="form-control numeric" name="txtpostalcode-coorporate" id="txtpostalcode-coorporate" placeholder="Kode Pos sesuai alamat" required />
                                    <div class="invalid-feedback invalid-kode-pos-corporate"></div>
                                </div>

                                <div class="form-group listcoorporate-stretclass">
                                    <label name="CAPTION-KELASJALANBERDASARKANBEBANMUATAN">Kelas Jalan Berdasarkan Beban
                                        muatan</label>
                                    <select class="select2 form-control" name="listcoorporate-stretclass" id="listcoorporate-stretclass" required>
                                        <option value="">--Pilih Kelas Jalan--</option>
                                        <?php foreach ($KelasJalan as $row) { ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback invalid-kelas-jalan-corporate"></div>
                                </div>

                                <div class="form-group listcoorporate-stretclass2">
                                    <label name="CAPTION-KELASJALANBERDASARKANFUNGSIJALAN">Kelas Jalan Berdasarkan
                                        Fungsi jalan</label>
                                    <select class="select2 form-control" name="listcoorporate-stretclass2" id="listcoorporate-stretclass2" required>
                                        <option value="">--Pilih Kelas Jalan--</option>
                                        <?php foreach ($KelasJalan2 as $row) { ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback invalid-kelas-jalan2-corporate"></div>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" checked required id="txtstatus-coorporate">
                                    <label class="form-check-label" for="txtstatus-coorporate" name="CAPTION-STATUSAKTIF">Status Aktif</label>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                <div class="form-group listarea-header">
                                    <label name="CAPTION-WILAYAH">Wilayah</label>
                                    <select class="select2 form-control" name="listarea-header" id="listarea-header" required>
                                        <option value="">--Pilih Wilayah--</option>
                                        <?php foreach ($AreaHeader as $row) { ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback invalid-area-header"></div>
                                </div>

                                <div class="form-group listcoorporate-area">
                                    <label name="CAPTION-AREA">Area</label>
                                    <select class="select2 form-control" name="listcoorporate-area" id="listcoorporate-area" required>

                                    </select>
                                    <div class="invalid-feedback invalid-area-corporate"></div>
                                </div>

                                <div class="form-group txtlattitude-coorporate">
                                    <label name="CAPTION-LATTITUDE">Lattitude</label>
                                    <input type="text" class="form-control " name="txtlattitude-coorporate" id="txtlattitude-coorporate" placeholder="Lattitude Outlet" required />
                                    <div class="invalid-feedback invalid-lattitude-corporate"></div>
                                </div>

                                <div class="form-group txtlongitude-coorporate">
                                    <label name="CAPTION-LONGITUDE">Longitude</label>
                                    <input type="text" class="form-control " name="txtlongitude-coorporate" id="txtlongitude-coorporate" placeholder="Longitude Outlet" required />
                                    <div class="invalid-feedback invalid-longitude-corporate"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <h5 class="text-center badge badge-info" name="CAPTION-CONTACTPERSON">Contact Person</h5>

                        <div class="form-group txtname-contact-person">
                            <label name="CAPTION-NAMA">Nama</label>
                            <input type="text" class="form-control" name="txtname-contact-person" id="txtname-contact-person" placeholder="Nama Contact Person" required />
                            <div class="invalid-feedback invalid-nama-contact-person"></div>
                        </div>

                        <div class="form-group txtphone-contact-person">
                            <label name="CAPTION-TELEPON">Telepon</label>
                            <input type="text" class="form-control numeric" name="txtphone-contact-person" id="txtphone-contact-person" placeholder="Telepon Contact Person" required />
                            <div class="invalid-feedback invalid-telepon-contact-person"></div>
                        </div>

                        <div class="form-group txtphone-contact-person">
                            <label name="CAPTION-FAX">Fax</label>
                            <input type="text" class="form-control" name="listcontactperson-client_pt_fax" id="listcontactperson-client_pt_fax" placeholder="Fax" required />
                            <div class="invalid-feedback invalid-client_pt_fax"></div>
                        </div>

                        <div class="form-group txtphone-contact-person">
                            <label name="CAPTION-NPWP">NPWP</label>
                            <input type="text" class="form-control" name="listcontactperson-client_pt_npwp" id="listcontactperson-client_pt_npwp" placeholder="NPWP" required />
                            <div class="invalid-feedback invalid-client_pt_npwp"></div>
                        </div>

                        <div class="form-group txtphone-contact-person">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><label name="CAPTION-STATUS">Status</label></div>
                                <div class="panel-body">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:-10px;">
                                        <input type="radio" id="listcontactperson-client_pt_status_pkp" name="listcontactperson-client_pt_status_pkp" autocomplete="off" value="PKP" onclick="get_selected_client_pt_status_pkp()"> PKP
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:-10px;">
                                        <input type="radio" id="listcontactperson-client_pt_status_pkp" name="listcontactperson-client_pt_status_pkp" autocomplete="off" value="NON PKP" onclick="get_selected_client_pt_status_pkp()"> Non PKP
                                    </div>
                                    <input type="hidden" id="listcontactperson-client_pt_status_pkp-selected" class="form-control" name="listcontactperson-client_pt_status_pkp" autocomplete="off" value="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group txtkreditlimit-contact-person">
                            <!-- <label>Kredit Limit</label> -->
                            <input type="hidden" class="form-control numeric" name="txtkreditlimit-contact-person" id="txtkreditlimit-contact-person" placeholder="Kredit Limit Contact Person" required />
                            <!-- <div class="invalid-feedback invalid-kredit-limit-contact-person"></div> -->
                        </div>

                        <div class="form-group">
                            <label name="CAPTION-SEGMENTASI">Segmentasi </label> <label>1</label>
                            <select class="select2 form-control" name="listcontactperson-segment1" id="listcontactperson-segment1">
                                <option value="">--Pilih Segmentasi--</option>
                                <?php foreach ($Segment1 as $row) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label name="CAPTION-SEGMENTASI">Segmentasi </label> <label>2</label>
                            <select class="select2 form-control" name="listcontactperson-segment2" id="listcontactperson-segment2">
                                <option value="">Pilih segmentasi 2</option>
                                <?php foreach ($segmen2 as $data) { ?>
                                    <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label name="CAPTION-SEGMENTASI">Segmentasi </label> <label>3</label>
                            <select class="select2 form-control" name="listcontactperson-segment3" id="listcontactperson-segment3">
                                <option value="">Pilih segmentasi 3</option>
                                <?php foreach ($segmen3 as $data) { ?>
                                    <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="multilocation">
                            <label class="form-check-label" for="multilocation">Multi Lokasi</label> <label>?</label>
                        </div>
                        <div class="form-group listcontactperson-location" id="showlistmultilokasi" style="display:none">
                            <label for="listcontactperson-location" name="CAPTION-LOKASI">Lokasi</label><br>
                            <select class="select2 form-control" name="listcontactperson-location" id="listcontactperson-location">

                            </select>

                            <div class="invalid-feedback invalid-list-location-contact-person"></div>
                        </div>

                        <div class="form-group">
                            <label name="CAPTION-WAKTUOPERASIONAL">Waktu Operasional</label>
                            <div class="table-responsive">
                                <table class="table table-striped" id="list-day-operasional">
                                    <thead>
                                        <tr>
                                            <td width="5%" name="CAPTION-NO">No.</td>
                                            <td width="10%" name="CAPTION-HARI">Hari</td>
                                            <td width="10%" name="CAPTION-JAMBUKA">Jam Buka</td>
                                            <td width="10%" name="CAPTION-JAMTUTUP">Jam Tutup</td>
                                            <td width="30%" name="CAPTION-STATUS">Status</td>
                                            <td width="10%" name="CAPTION-PENGIRIMAN">Pengiriman</td>
                                            <td width="10%" name="CAPTION-PENAGIHAN">Penagihan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Day as $key => $value) { ?>
                                            <tr>
                                                <td><?= $key ?> <input type="hidden" id="no-urut-hari" name="no-urut-hari" value="<?= $key ?>" /></td>
                                                <td><?= $value ?> <input type="hidden" id="nama-hari" name="nama-hari" value="<?= $key ?>" /></td>
                                                <td><input type="time" class="from-control" id="jam-buka" name="jam-buka" />
                                                </td>
                                                <td><input type="time" class="from-control" id="jam-tutup" name="jam-tutup" /></td>
                                                <td>
                                                    <select class="form-control" id="status-operasional" name="status-operasional">
                                                        <option value="1" selected>BUKA</option>
                                                        <option value="0">TUTUP</option>
                                                    </select>
                                                </td>
                                                <td style="vertical-align:middle; text-align: center;"><input type="checkbox" id="chk_pengiriman" name="chk_pengiriman" /></td>
                                                <td style="vertical-align:middle; text-align: center;"><input type="checkbox" id="chk_penagihan" name="chk_penagihan" /></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingadd" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" class="btn btn-success" id="btnsaveaddnewoutlet"><label name="CAPTION-SIMPAN">Simpan</label></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnback"><label name="CAPTION-KEMBALI">Kembali</label></button>
            </div>
        </div>
    </div>
</div>