<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-x: auto;
        overflow-y: auto;
    }

    .invalid-feedback {
        color: red;
    }

    .wrapper {
        display: inline-flex;
        margin-top: 10px;
        height: 40px;
        width: 50%;
        align-items: center;
        justify-content: space-evenly;
        border-radius: 5px;
    }

    .wrapper .option {
        background: #fff;
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        margin: 0 10px;
        border-radius: 5px;
        cursor: pointer;
        padding: 0 10px;
        border: 2px solid lightgrey;
        transition: all 0.3s ease;
    }

    .wrapper .option .dot {
        height: 20px;
        width: 20px;
        background: #d9d9d9;
        border-radius: 50%;
        position: relative;
    }

    .wrapper .option .dot::before {
        position: absolute;
        content: "";
        top: 4px;
        left: 4px;
        width: 12px;
        height: 12px;
        background: #0069d9;
        border-radius: 50%;
        opacity: 0;
        transform: scale(1.5);
        transition: all 0.3s ease;
    }

    input[name*="selectSplit"] {
        display: none;
    }

    #option-1:checked:checked~.option-1,
    #option-2:checked:checked~.option-2,
    #option-3:checked:checked~.option-3 {
        border-color: #0069d9;
        background: #0069d9;
    }

    #option-1:checked:checked~.option-1 .dot,
    #option-2:checked:checked~.option-2 .dot,
    #option-3:checked:checked~.option-3 .dot {
        background: #fff;
    }

    #option-1:checked:checked~.option-1 .dot::before,
    #option-2:checked:checked~.option-2 .dot::before,
    #option-3:checked:checked~.option-3 .dot::before {
        opacity: 1;
        transform: scale(1);
    }

    .wrapper .option span {
        font-size: 16px;
        color: #808080;
    }

    #option-1:checked:checked~.option-1 span,
    #option-2:checked:checked~.option-2 span,
    #option-3:checked:checked~.option-3 span {
        color: #fff;
    }
</style>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 name="CAPTION-DATAOUTLET">Data Outlet</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="row">
                        <div class="wrapper">
                            <input type="radio" name="selectSplit" id="option-1" value="0" class="chkCompareOrApproval" onchange="chkCompareOrApproval(event)" checked>
                            <input type="radio" name="selectSplit" id="option-2" value="1" class="chkCompareOrApproval" onchange="chkCompareOrApproval(event)">
                            <input type="radio" name="selectSplit" id="option-3" value="2" class="chkCompareOrApproval" onchange="chkCompareOrApproval(event)">
                            <label for="option-1" class="option option-1">
                                <span>Head Office</span>
                            </label>
                            <label for="option-2" class="option option-2">
                                <span>Cabang</span>
                            </label>
                            <label for="option-3" class="option option-3">
                                <span>Internal</span>
                            </label>
                        </div>

                        <div style="float: right">
                            <!-- <button type="button" id="btn_sync_masar" class="btn btn-primary">
                                <i class="fa fa-refresh"></i> <span name="CAPTION-SYNCUSTOMER">Sinkron Pelanggan</span>
                            </button>
                            <button type="button" id="btn_sync_masap" class="btn btn-primary">
                                <i class="fa fa-refresh"></i> <span name="CAPTION-SYNCSUPPLIER">Sinkron Supplier</span>
                            </button> -->
                            <button type="button" id="btnaddnewoutlet" class="btn btn-primary">
                                <i class="fa fa-plus"></i> <span name="CAPTION-TAMBAHOUTLET">Tambah Outlet</span>
                            </button>
                        </div>
                    </div>
                    <hr>

                    <div id="showHead" style="margin-top: 20px; width: 100%;position:relative;max-height:100%; display: none">
                        <div class="row">
                            <table id="tableoutletmenuhead" width="100%" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th name="CAPTION-NAMAOUTLET">Nama Outlet</th>
                                        <th name="CAPTION-ALAMATOUTLET">Alamat Outlet</th>
                                        <th name="CAPTION-TELEPONOUTLET">Telepon Outlet</th>
                                        <th name="CAPTION-NAMACONTACTPERSON">Nama Contact Person</th>
                                        <th name="CAPTION-TELEPONCONTACTPERSON">Telepon Contact Person</th>
                                        <th name="CAPTION-STATUS">Status</th>
                                        <th name="CAPTION-OPSI">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <!--/div-->
                        </div>
                    </div>

                    <div id="showCabang" style="margin-top: 20px; width: 100%;position:relative;max-height:100%; display: none">
                        <div class="row">
                            <!--div class="x_content" style="overflow-x:auto"-->
                            <table id="tableoutletmenu" width="100%" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th name="CAPTION-NAMAOUTLET">Nama Outlet</th>
                                        <th name="CAPTION-ALAMATOUTLET">Alamat Outlet</th>
                                        <th name="CAPTION-TELEPONOUTLET">Telepon Outlet</th>
                                        <th name="CAPTION-NAMACONTACTPERSON">Nama Contact Person</th>
                                        <th name="CAPTION-TELEPONCONTACTPERSON">Telepon Contact Person</th>
                                        <th name="CAPTION-SEGMENTASI">Segmentasi</th>
                                        <th name="CAPTION-STATUS">Status</th>
                                        <!-- <th><input type="checkbox" id="select-sync-all-masar" name="select-sync-all-masar" value="1"> <span name="CAPTION-CUSTOMER">Pelanggan</span></th>
                                        <th><input type="checkbox" id="select-sync-all-masap" name="select-sync-all-masap" value="1"> <span name="CAPTION-SUPPLIER">Supplier</span></th> -->
                                        <th name="CAPTION-OPSI">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <!--/div-->
                        </div>
                    </div>

                    <div id="showInternal" style="margin-top: 20px; width: 100%;position:relative;max-height:100%; display: none">
                        <div class="row">
                            <!--div class="x_content" style="overflow-x:auto"-->
                            <table id="tableoutletinternal" width="100%" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th name="CAPTION-NAMAOUTLET">Nama Outlet</th>
                                        <th name="CAPTION-ALAMATOUTLET">Alamat Outlet</th>
                                        <th name="CAPTION-TELEPONOUTLET">Telepon Outlet</th>
                                        <th name="CAPTION-NAMACONTACTPERSON">Nama Contact Person</th>
                                        <th name="CAPTION-TELEPONCONTACTPERSON">Telepon Contact Person</th>
                                        <th name="CAPTION-SEGMENTASI">Segmentasi</th>
                                        <th name="CAPTION-STATUS">Status</th>
                                        <th name="CAPTION-OPSI">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <!--/div-->
                        </div>
                    </div>

                    <!-- Modal untuk menampilkan Add Channel !-->
                    <?php $this->load->view("FAS/ManagementPelanggan/Outlet/component/Modal_Add") ?>

                    <!-- Modal untuk menampilkan Add Channel !-->
                    <?php $this->load->view("FAS/ManagementPelanggan/Outlet/component/Modal_Edit") ?>

                    <!-- Modal untuk menampilkan Delete Channel !-->
                    <?php $this->load->view("FAS/ManagementPelanggan/Outlet/component/Modal_Delete") ?>

                    <!-- Modal untuk menampilkan masar !-->
                    <?php $this->load->view("FAS/ManagementPelanggan/Outlet/component/Modal_masar") ?>

                    <!-- Modal untuk menampilkan masap !-->
                    <?php $this->load->view("FAS/ManagementPelanggan/Outlet/component/Modal_masap") ?>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- /page content -->