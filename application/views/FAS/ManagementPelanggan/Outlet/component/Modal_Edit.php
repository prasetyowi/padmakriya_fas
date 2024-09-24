<div class="modal fade" id="previewupdateoutlet" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <!-- Modal content-->
        <div class="modal-content modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button <h4 class="modal-title"><label name="CAPTION-EDITDATAOUTLET">Edit Data Outlet</label></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group txtname-coorporate-update">
                            <label name="CAPTION-NAMA">Nama</label>
                            <input type="hidden" id="txthideOutletId-update" />
                            <input type="text" class="form-control" id="txtname-coorporate-update" placeholder="Nama Coorporate" />
                            <div class="invalid-feedback invalid-nama-corporate-update"></div>
                        </div>

                        <div class="form-group txtaddress-coorporate-update">
                            <label name="CAPTION-ALAMAT">Alamat</label>
                            <textarea type="text" class="form-control" rows="3" id="txtaddress-coorporate-update" placeholder="Alamat Coorporate"></textarea>
                            <div class="invalid-feedback invalid-alamat-corporate-update"></div>
                        </div>

                        <!-- <div class="form-group listcoorporate-group-update">
                            <label>Coorporate Group</label>
                            <select class="form-control" name="listcoorporate-group-update" id="listcoorporate-group-update">
                                <option value="">--Pilih Coorporate Group--</option>
                            </select>
                        </div> -->

                        <div class="form-group txtphone-coorporate-update">
                            <label name="CAPTION-TELEPON">Telepon</label>
                            <input type="text" class="form-control numeric" id="txtphone-coorporate-update" placeholder="Telepon Coorporate-update" />
                            <div class="invalid-feedback invalid-telepon-corporate-update"></div>
                        </div>

                        <div class="form-group txtphone-contact-person">
                            <label name="CAPTION-FAX">Fax</label>
                            <input type="text" class="form-control" name="listcontactperson-client_pt_fax-update" id="listcontactperson-client_pt_fax-update" placeholder="Fax" required />
                            <div class="invalid-feedback invalid-client_pt_fax-update"></div>
                        </div>

                        <div class="form-group txtphone-contact-person">
                            <label name="CAPTION-NPWP">NPWP</label>
                            <input type="text" class="form-control" name="listcontactperson-client_pt_npwp-update" id="listcontactperson-client_pt_npwp-update" placeholder="NPWP" required />
                            <div class="invalid-feedback invalid-client_pt_npwp-update"></div>
                        </div>

                        <div class="form-group txtphone-contact-person">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><label name="CAPTION-STATUS">Status</label></div>
                                <div class="panel-body">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:-10px;">
                                        <input type="radio" id="listcontactperson-client_pt_status_pkp-update" name="listcontactperson-client_pt_status_pkp-update" autocomplete="off" value="PKP" onclick="get_selected_client_pt_status_pkp()"> PKP
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:-10px;">
                                        <input type="radio" id="listcontactperson-client_pt_status_pkp-update" name="listcontactperson-client_pt_status_pkp-update" autocomplete="off" value="NON PKP" onclick="get_selected_client_pt_status_pkp()"> Non PKP
                                    </div>
                                    <input type="hidden" id="listcontactperson-client_pt_status_pkp-selected-update" class="form-control" name="listcontactperson-client_pt_status_pkp-seleced-update" autocomplete="off" value="">
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group listcoorporate-province-update">
                            <label name="CAPTION-PROVINSI">Provinsi</label>
                            <select class="form-control" id="listcoorporate-province-update">
                                <option value="">--<label name="CAPTION-PILIHPROVINSI">Pilih Provinsi</label>--</option>
                            </select>
                            <div class="invalid-feedback invalid-provinsi-corporate-update"></div>
                        </div> -->

                        <div class="form-group listcoorporate-city-update">
                            <label name="CAPTION-KOTA">Kota</label>
                            <select class="form-control" id="listcoorporate-city-update">
                                <option value="">--<label name="CAPTION-PILIHKOTA">Pilih Kota</label>--</option>
                            </select>
                            <div class="invalid-feedback invalid-kota-corporate-update"></div>
                        </div>

                        <div class="form-group listcoorporate-districts-update">
                            <label name="CAPTION-KECAMATAN">Kecamatan</label>
                            <select class="form-control" id="listcoorporate-districts-update">
                                <option value="">--<label name="CAPTION-PILIHKECAMATAN">Pilih Kecamatan</label>--
                                </option>
                            </select>
                            <div class="invalid-feedback invalid-kecamatan-corporate-update"></div>
                            <input type="hidden" id="data-districts-update" />
                        </div>

                        <div class="form-group listcoorporate-ward-update">
                            <label name="CAPTION-KELURAHAN">Kelurahan</label>
                            <select class="form-control" id="listcoorporate-ward-update">
                                <option value="">--<label name="CAPTION-PILIHKELURAHAN">Pilih Kelurahan</label>--
                                </option>
                            </select>
                            <div class="invalid-feedback invalid-kelurahan-corporate-update"></div>
                            <input type="hidden" id="data-ward-update" />
                        </div>

                        <div class="form-group txtpostalcode-coorporate-update">
                            <label name="CAPTION-KODEPOS">Kode Pos</label>
                            <input type="text" class="form-control numeric" id="txtpostalcode-coorporate-update" placeholder="Kode Pos sesuai alamat" />
                            <div class="invalid-feedback invalid-kode-pos-corporate-update"></div>
                        </div>

                        <div class="form-group listcoorporate-stretclass-update">
                            <label name="CAPTION-KELASJALANBERDASARKANBEBANMUATAN">Kelas Jalan Berdasarkan Beban
                                muatan</label>
                            <select class="form-control" name="listcoorporate-stretclass-update" id="listcoorporate-stretclass-update" required>
                                <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas Jalan</label>--
                                </option>
                            </select>
                            <div class="invalid-feedback invalid-kelas-jalan-corporate-update"></div>
                        </div>

                        <div class="form-group listcoorporate-stretclass2-update">
                            <label name="CAPTION-KELASJALANBERDASARKANFUNGSIJALAN">Kelas Jalan Berdasarkan Fungsi
                                jalan</label>
                            <select class="form-control" name="listcoorporate-stretclass2-update" id="listcoorporate-stretclass2-update" required>
                                <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas Jalan</label>--
                                </option>
                            </select>
                            <div class="invalid-feedback invalid-kelas-jalan2-corporate-update"></div>
                        </div>

                        <div class="form-group listcoorporate-area-update">
                            <label name="CAPTION-AREA">Area</label>
                            <select class="form-control" id="listcoorporate-area-update">
                                <option value="">--<label name="CAPTION-PILIHAREA">Pilih Area</label>--</option>
                            </select>
                            <div class="invalid-feedback invalid-area-corporate-update"></div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                <div class="form-group txtlattitude-coorporate-update">
                                    <label name="CAPTION-LATTITUDE">Lattitude</label>
                                    <input type="text" class="form-control numeric-coma" id="txtlattitude-coorporate-update" placeholder="Lattitude Coorporate" />
                                    <div class="invalid-feedback invalid-lattitude-corporate-update"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                <div class="form-group txtlongitude-coorporate-update">
                                    <label name="CAPTION-LONGITUDE">Longitude</label>
                                    <input type="text" class="form-control numeric-coma" id="txtlongitude-coorporate-update" placeholder="Longitude Coorporate" />
                                    <div class="invalid-feedback invalid-longitude-corporate-update"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <h5 class="text-center badge badge-info" name="CAPTION-CONTACTPERSON">Contact Person</h5>

                        <div class="form-group txtname-contact-person-update">
                            <label name="CAPTION-NAMA">Nama</label>
                            <input type="text" class="form-control" id="txtname-contact-person-update" placeholder="Nama Contact Person" />
                            <div class="invalid-feedback invalid-nama-contact-person-update"></div>
                        </div>

                        <div class="form-group txtphone-contact-person-update">
                            <label name="CAPTION-TELEPON">Telepon</label>
                            <input type="text" class="form-control numeric" id="txtphone-contact-person-update" placeholder="Telepon Contact Person" />
                            <div class="invalid-feedback invalid-telepon-contact-person-update"></div>
                        </div>

                        <div class="form-group txtkreditlimit-contact-person-update">
                            <label name="CAPTION-KREDITLIMIT">Kredit Limit</label>
                            <input type="text" class="form-control" id="txtkreditlimit-contact-person-update" placeholder="Kredit Limit Contact Person" />
                            <div class="invalid-feedback invalid-kredit-limit-contact-person-update"></div>
                        </div>

                        <div class="form-group">
                            <label name="CAPTION-SEGMENTASI">Segmentasi</label> <label>1</label>
                            <select class="form-control" id="listcontactperson-segment1-update">
                                <option value="">--<label name="CAPTION-PILIHSEGMENTASI">Pilih Segmentasi</label> 1--
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label name="CAPTION-SEGMENTASI">Segmentasi</label> <label>2</label>
                            <select class="form-control" id="listcontactperson-segment2-update">
                                <option value="">--<label name="CAPTION-PILIHSEGMENTASI">Pilih Segmentasi</label> 2--
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label name="CAPTION-SEGMENTASI">Segmentasi</label> <label>3</label>
                            <select class="form-control" id="listcontactperson-segment3-update">
                                <option value="">--<label name="CAPTION-PILIHSEGMENTASI">Pilih Segmentasi</label> 3--
                                </option>
                            </select>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="multilocationupdate">
                            <label class="form-check-label" for="multilocation" name="CAPTION-MULTILOKASI">Multi
                                Lokasi</label> <label>?</label>
                        </div>
                        <div class="form-group listcontactperson-location-update" id="showlistmultilokasiupdate" style="display:none">
                            <label for="listcontactperson-location-update" name="CAPTION-LOKASI">Lokasi</label><br>
                            <select class="form-control" name="listcontactperson-location-update" id="listcontactperson-location-update">
                                <option value="">--<label name="CAPTION-PILIHLOKASI">Pilih Lokasi</label>--</option>
                            </select>
                            <div class="invalid-feedback invalid-list-location-contact-person-update"></div>
                        </div>

                        <div class="form-group">
                            <label name="CAPTION-WAKTUOPERASIONAL">Waktu Operasional</label>
                            <div class="table-responsive">
                                <table class="table table-striped" id="list-day-operasional-update">
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
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>


                        <div class="form-group">
                            <input type="checkbox" class="form-check-input" checked required id="txtstatus-coorporate-update">
                            <label class="form-check-label" for="txtstatus-coorporate-update" name="CAPTION-STATUSAKTIF">Status Aktif</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingupdate" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" class="btn btn-success" id="btnsaveupdateoutlet"><label name="CAPTION-UBAH">Ubah</label></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnupdateback"><label name="CAPTION-KEMBALI">Kembali</label></button>
            </div>
        </div>
    </div>
</div>