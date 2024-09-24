<style>
    .invalid-feedback {
        color: red;
    }
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 name="CAPTION-EDITDATA">Edit Data</h3>
            </div>
        </div>
        <!-- <div class="clearfix"></div> -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <!-- <div class="x_title"> -->
                    <!-- <h5>Batch For Pick</h5> -->
                    <!-- </div> -->
                    <div style="float: right;">
                        <button onclick="modalDetail('<?= $id ?>')" class="btn btn-primary">Detail</button>
                    </div>
                    <hr style="margin-top: 50px;">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                <?php if ($this->input->get('type') == 'cabang') { ?>
                                    <div class="form-group txtoffice-coorporate-update">
                                        <label>Head Office</label>
                                        <select class="select2 form-control" name="txtoffice-coorporate-update" id="txtoffice-coorporate-update">
                                            <option value="">--Pilih Head Office--</option>
                                            <?php foreach ($clientPtCorporate as $value) { ?>
                                                <?php if ($clientPt->client_pt_corporate_id != null) { ?>
                                                    <?php if ($clientPt->client_pt_corporate_id == $value->id) { ?>
                                                        <option value="<?= $value->id ?>" selected><?= $value->nama ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback invalid-office-corporate"></div>
                                    </div>
                                <?php } ?>
                                <div class="form-group txtname-coorporate-update">
                                    <label name="CAPTION-NAMA">Nama</label>
                                    <input type="hidden" id="txthideOutletId-update" value="<?= $id ?>" />
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

                                <div class="form-group listcoorporate-province-update">
                                    <label name="CAPTION-PROVINSI">Provinsi</label>
                                    <select class="select2 form-control" id="listcoorporate-province-update">
                                        <option value="">--<label name="CAPTION-PILIHPROVINSI">Pilih Provinsi</label>--</option>
                                        <?php foreach ($Provinsi as $row) { ?>
                                            <option value="<?= $row['reffregion_nama'] ?>"><?= $row['reffregion_nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback invalid-provinsi-corporate-update"></div>
                                </div>

                                <div class="form-group listcoorporate-city-update">
                                    <label name="CAPTION-KOTA">Kota</label>
                                    <select class="select2 form-control" id="listcoorporate-city-update">
                                    </select>
                                    <div class="invalid-feedback invalid-kota-corporate-update"></div>
                                </div>

                                <div class="form-group listcoorporate-districts-update">
                                    <label name="CAPTION-KECAMATAN">Kecamatan</label>
                                    <select class="select2 form-control" id="listcoorporate-districts-update">
                                    </select>
                                    <div class="invalid-feedback invalid-kecamatan-corporate-update"></div>
                                    <input type="hidden" id="data-districts-update" />
                                </div>

                                <div class="form-group listcoorporate-ward-update">
                                    <label name="CAPTION-KELURAHAN">Kelurahan</label>
                                    <select class="select2 form-control" id="listcoorporate-ward-update">
                                    </select>
                                    <div class="invalid-feedback invalid-kelurahan-corporate-update"></div>
                                    <input type="hidden" id="data-ward-update" />
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                        <div class="form-group txtpostalcode-coorporate-update">
                                            <label name="CAPTION-KODEPOS">Kode Pos</label>
                                            <input type="text" class="form-control numeric" id="txtpostalcode-coorporate-update" placeholder="Kode Pos sesuai alamat" />
                                            <div class="invalid-feedback invalid-kode-pos-corporate-update"></div>
                                        </div>

                                        <div class="form-group listcoorporate-stretclass-update">
                                            <label name="CAPTION-KELASJALANBERDASARKANBEBANMUATAN">Kelas Jalan
                                                Berdasarkan Beban muatan</label>
                                            <select class="select2 form-control" name="listcoorporate-stretclass-update" id="listcoorporate-stretclass-update" required>
                                                <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                                        Jalan</label>--</option>
                                                <?php foreach ($KelasJalan as $row) { ?>
                                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback invalid-kelas-jalan-corporate-update"></div>
                                        </div>
                                        <div class="form-group txtlattitude-coorporate-update">
                                            <label name="CAPTION-LATTITUDE">Lattitude</label>
                                            <input type="text" class="form-control numeric-coma" id="txtlattitude-coorporate-update" placeholder="Lattitude Coorporate" />
                                            <div class="invalid-feedback invalid-lattitude-corporate-update"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                        <div class="form-group listcoorporate-area-update">
                                            <label name="CAPTION-AREA">Area</label>
                                            <select class="select2 form-control" id="listcoorporate-area-update">
                                                <option value="">--<label name="CAPTION-PILIHAREA">Pilih Area</label>--
                                                </option>
                                                <?php foreach ($Area as $row) { ?>
                                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback invalid-area-corporate-update"></div>
                                        </div>

                                        <div class="form-group listcoorporate-stretclass2-update">
                                            <label name="CAPTION-KELASJALANBERDASARKANFUNGSIJALAN">Kelas Jalan
                                                Berdasarkan Fungsi jalan</label>
                                            <select class="select2 form-control" name="listcoorporate-stretclass2-update" id="listcoorporate-stretclass2-update" required>
                                                <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                                        Jalan</label>--</option>
                                                <?php foreach ($KelasJalan2 as $row) { ?>
                                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback invalid-kelas-jalan2-corporate-update"></div>
                                        </div>
                                        <div class="form-group txtlongitude-coorporate-update">
                                            <label name="CAPTION-LONGITUDE">Longitude</label>
                                            <input type="text" class="form-control numeric-coma" id="txtlongitude-coorporate-update" placeholder="Longitude Coorporate" />
                                            <div class="invalid-feedback invalid-longitude-corporate-update"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                <h5 class="text-center badge badge-info" name="CAPTION-CONTACTPERSON">Contact Person
                                </h5>

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

                                <div class="form-group txtkreditlimit-contact-person-update">
                                    <!-- <label>Kredit Limit</label> -->
                                    <input type="hidden" class="form-control" id="txtkreditlimit-contact-person-update" placeholder="Kredit Limit Contact Person" />
                                    <!-- <div class="invalid-feedback invalid-kredit-limit-contact-person-update"></div> -->
                                </div>

                                <div class="form-group">
                                    <label name="CAPTION-SEGMENTASI">Segmentasi</label> <label>1</label>
                                    <select class="select2 form-control" id="listcontactperson-segment1-update">
                                        <option value="">--<label name="CAPTION-PILIHSEGMENTASI">Pilih
                                                Segmentasi</label> 1--</option>
                                        <?php foreach ($Segment1 as $row) { ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label name="CAPTION-SEGMENTASI">Segmentasi</label> <label>2</label>
                                    <select class="select2 form-control" id="listcontactperson-segment2-update">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label name="CAPTION-SEGMENTASI">Segmentasi</label> <label>3</label>
                                    <select class="select2 form-control" id="listcontactperson-segment3-update">
                                    </select>
                                </div>

                                <?php if ($this->input->get('type') == 'cabang') { ?>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="multilocationupdate">
                                        <label class="form-check-label" for="multilocation" name="CAPTION-MULTILOKASI">Multi
                                            Lokasi</label> <label>?</label>
                                    </div>
                                <?php } ?>


                                <div class="form-group listcontactperson-location-update" id="showlistmultilokasiupdate" style="display:none">
                                    <label for="listcontactperson-location-update" name="CAPTION-LOKASI">Lokasi</label><br>
                                    <select class="select2 form-control" name="listcontactperson-location-update" id="listcontactperson-location-update">
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
                                    <label class="form-check-label" for="txtstatus-coorporate-update" name="CAPTION-STATUSAKTIF">Status
                                        Aktif</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
                                <h4><strong>Detail</strong></h4>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="list-detail-outlet">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-center" style="color: white;" name="CAPTION-PRINCIPLE">Principle</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-TOP">TOP</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-KREDITLIMIT">Kredit Limit</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-ISKREDIT">Is Kredit</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-SEGMENT1">Segmen 1</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-SEGMENT2">Segmen 2</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-SEGMENT3">Segmen 3</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-MAXINVOICE">Maks. Invoice</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-TOPRETUR">TOP Retur</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-ALAMATINVOICE">Alamat Invoice</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-ALAMATTAGIH">Alamat Tagih</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-ALAMATKIRIM">Alamat Kirim</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-ALAMATPAJAK">Alamat Pajak</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <button class="btn btn-success" type="button" id="btnsaveupdateoutlet"><label name="CAPTION-UBAH">Ubah</label></button>
                            <span id="loadingupdate" style="display:none;"><i class="fa fa-spinner fa-spin"></i>
                                Loading...</span>
                            <button class="btn btn-danger" type="button" id="btnbackoutletupdate"><label name="CAPTION-KEMBALI" onclick="location.href='<?= base_url('FAS/ManagementPelanggan/Outlet/OutletMenu') ?>'">Kembali</label></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="previewdetailoutlet" role="dialog" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="width: 80%;">
                    <!-- Modal content-->
                    <div class="modal-content modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-header bg-primary">
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <h4 class="modal-title"><label name="CAPTION-DETAILOUTLET">Detail Outlet</label></h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <!-- <table class="table table-striped" id="list-detail-outlet">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-center" style="color: white;" name="CAPTION-PRINCIPLE">Principle</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-TOP">TOP</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-KREDITLIMIT">Kredit Limit</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-ISKREDIT">Is Kredit</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-SEGMENT1">Segmen 1</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-SEGMENT2">Segmen 2</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-SEGMENT3">Segmen 3</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-MAXINVOICE">Maks. Invoice</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-ALAMATPENAGIHANBEDA">Alamat Penagihan Beda</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-ALAMATPENAGIHAN">Alamat Penagihan</th>
                                                <th class="text-center" style="color: white;" name="CAPTION-TOPRETUR">TOP Retur</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table> -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span id="loadingupdate" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><label name="CAPTION-TUTUP">Tutup</label></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addAlamatBaru" role="dialog" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="width: 90%;">
                    <!-- Modal content-->
                    <div class="modal-content modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-header bg-primary">
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <h4 class="modal-title"><label name="CAPTION-Tambah Alamat">Tambah Alamat <span id="header_alamat"></span></label></label></h4>
                        </div>
                        <div class="modal-body">
                            <div class="row" id="add_alamat_multiple">
                                <!-- <input type="hidden" id="header_random_id" value="">
                                <div class="row" style="display: flex; margin-left: 10px">
                                    <div id="tab_alamat">
                                        <button class="btn btn-primary" onclick="test(this)"><label>Alamat 1</label> &nbsp;<i class="fa-regular fa-circle-xmark" style="color: red;" onclick="testt(event)"></i></button>
                                    </div>
                                    <button class="btn btn-warning"><i class="fa fa-plus"></i></button>
                                </div>
                                <hr style="margin-top: 10px;">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                    <div class="form-group txtaddress-coorporate-update-multiple">
                                        <label name="CAPTION-ALAMAT">Alamat</label>
                                        <textarea type="text" class="form-control" rows="3" id="txtaddress-coorporate-update-multiple" placeholder="Alamat Coorporate"></textarea>
                                        <div class="invalid-feedback invalid-alamat-corporate-update-multiple"></div>
                                    </div>

                                    <div class="form-group txtphone-coorporate-update-multiple">
                                        <label name="CAPTION-TELEPON">Telepon</label>
                                        <input type="text" class="form-control numeric" id="txtphone-coorporate-update-multiple" placeholder="Telepon Coorporate-update" />
                                        <div class="invalid-feedback invalid-telepon-corporate-update-multiple"></div>
                                    </div>

                                    <div class="form-group listcoorporate-province-update-multiple">
                                        <label name="CAPTION-PROVINSI">Provinsi</label>
                                        <select class="select2 form-control" id="listcoorporate-province-update-multiple">
                                            <option value="">--<label name="CAPTION-PILIHPROVINSI">Pilih Provinsi</label>--</option>
                                            <?php foreach ($Provinsi as $row) { ?>
                                                <option value="<?= $row['reffregion_nama'] ?>"><?= $row['reffregion_nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback invalid-provinsi-corporate-update-multiple"></div>
                                    </div>

                                    <div class="form-group listcoorporate-city-update-multiple">
                                        <label name="CAPTION-KOTA">Kota</label>
                                        <select class="select2 form-control" id="listcoorporate-city-update-multiple">
                                        </select>
                                        <div class="invalid-feedback invalid-kota-corporate-update-multiple"></div>
                                    </div>

                                    <div class="form-group listcoorporate-districts-update-multiple">
                                        <label name="CAPTION-KECAMATAN">Kecamatan</label>
                                        <select class="select2 form-control" id="listcoorporate-districts-update-multiple">
                                        </select>
                                        <div class="invalid-feedback invalid-kecamatan-corporate-update-multiple"></div>
                                        <input type="hidden" id="data-districts-update-multiple" />
                                    </div>

                                    <div class="form-group listcoorporate-ward-update-multiple">
                                        <label name="CAPTION-KELURAHAN">Kelurahan</label>
                                        <select class="select2 form-control" id="listcoorporate-ward-update-multiple">
                                        </select>
                                        <div class="invalid-feedback invalid-kelurahan-corporate-update-multiple"></div>
                                        <input type="hidden" id="data-ward-update-multiple" />
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group txtpostalcode-coorporate-update-multiple">
                                                <label name="CAPTION-KODEPOS">Kode Pos</label>
                                                <input type="text" class="form-control numeric" id="txtpostalcode-coorporate-update-multiple" placeholder="Kode Pos sesuai alamat" />
                                                <div class="invalid-feedback invalid-kode-pos-corporate-update-multiple"></div>
                                            </div>

                                            <div class="form-group listcoorporate-stretclass-update-multiple">
                                                <label name="CAPTION-KELASJALANBERDASARKANBEBANMUATAN">Kelas Jalan
                                                    Berdasarkan Beban muatan</label>
                                                <select class="select2 form-control" name="listcoorporate-stretclass-update-multiple" id="listcoorporate-stretclass-update-multiple" required>
                                                    <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                                            Jalan</label>--</option>
                                                    <?php foreach ($KelasJalan as $row) { ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback invalid-kelas-jalan-corporate-update-multiple"></div>
                                            </div>
                                            <div class="form-group txtlattitude-coorporate-update-multiple">
                                                <label name="CAPTION-LATTITUDE">Lattitude</label>
                                                <input type="text" class="form-control numeric-coma" id="txtlattitude-coorporate-update-multiple" placeholder="Lattitude Coorporate" />
                                                <div class="invalid-feedback invalid-lattitude-corporate-update-multiple"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group listcoorporate-area-update-multiple">
                                                <label name="CAPTION-AREA">Area</label>
                                                <select class="select2 form-control" id="listcoorporate-area-update-multiple">
                                                    <option value="">--<label name="CAPTION-PILIHAREA">Pilih Area</label>--
                                                    </option>
                                                    <?php foreach ($Area as $row) { ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback invalid-area-corporate-update-multiple"></div>
                                            </div>
                                            <div class="form-group listcoorporate-stretclass2-update-multiple">
                                                <label name="CAPTION-KELASJALANBERDASARKANFUNGSIJALAN">Kelas Jalan
                                                    Berdasarkan Fungsi jalan</label>
                                                <select class="select2 form-control" name="listcoorporate-stretclass2-update-multiple" id="listcoorporate-stretclass2-update-multiple" required>
                                                    <option value="">--<label name="CAPTION-PILIHKELASJALAN">Pilih Kelas
                                                            Jalan</label>--</option>
                                                    <?php foreach ($KelasJalan2 as $row) { ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback invalid-kelas-jalan2-corporate-update-multiple"></div>
                                            </div>
                                            <div class="form-group txtlongitude-coorporate-update-multiple">
                                                <label name="CAPTION-LONGITUDE">Longitude</label>
                                                <input type="text" class="form-control numeric-coma" id="txtlongitude-coorporate-update-multiple" placeholder="Longitude Coorporate" />
                                                <div class="invalid-feedback invalid-longitude-corporate-update-multiple"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                                    <h5 class="text-center badge badge-info" name="CAPTION-CONTACTPERSON">Contact Person
                                    </h5>

                                    <div class="form-group txtname-contact-person-update-multiple">
                                        <label name="CAPTION-NAMA">Nama</label>
                                        <input type="text" class="form-control" id="txtname-contact-person-update-multiple" placeholder="Nama Contact Person" />
                                        <div class="invalid-feedback invalid-nama-contact-person-update-multiple"></div>
                                    </div>

                                    <div class="form-group txtphone-contact-person-update-multiple">
                                        <label name="CAPTION-TELEPON">Telepon</label>
                                        <input type="text" class="form-control numeric" id="txtphone-contact-person-update-multiple" placeholder="Telepon Contact Person" />
                                        <div class="invalid-feedback invalid-telepon-contact-person-update-multiple"></div>
                                    </div>

                                    <div class="form-group txtphone-contact-person">
                                        <label name="CAPTION-FAX">Fax</label>
                                        <input type="text" class="form-control" name="listcontactperson-client_pt_fax-update-multiple" id="listcontactperson-client_pt_fax-update-multiple" placeholder="Fax" required />
                                        <div class="invalid-feedback invalid-client_pt_fax-update-multiple"></div>
                                    </div>

                                    <div class="form-group txtphone-contact-person">
                                        <label name="CAPTION-NPWP">NPWP</label>
                                        <input type="text" class="form-control" name="listcontactperson-client_pt_npwp-update-multiple" id="listcontactperson-client_pt_npwp-update-multiple" placeholder="NPWP" required />
                                        <div class="invalid-feedback invalid-client_pt_npwp-update-multiple"></div>
                                    </div>

                                    <div class="form-group">
                                        <label name="CAPTION-WAKTUOPERASIONAL">Waktu Operasional</label>
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="list-day-operasional-update-multiple">
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
                                </div> -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span id="loadingupdate" style="display:none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                            <button onclick="updateCountAlamat()" type="button" class="btn btn-success" data-dismiss="modal"><label name="CAPTION-SIMPAN">Simpan</label></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>