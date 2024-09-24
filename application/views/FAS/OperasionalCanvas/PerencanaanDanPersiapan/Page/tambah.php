<?php $this->load->view("FAS/OperasionalCanvas/PerencanaanDanPersiapan/Component/Script/Style/index") ?>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3 name="CAPTION-TAMBAHDATAPERENCANAAN&PERSIAPAN">Tambah Data Perencanaan & Persiapan </h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <!-- list table surat kerja -->
    <?php $this->load->view("FAS/OperasionalCanvas/PerencanaanDanPersiapan/Component/Section/headerPerencanaan") ?>

    <!-- list table surat kerja -->
    <?php $this->load->view("FAS/OperasionalCanvas/PerencanaanDanPersiapan/Component/Section/detailPerencanaan") ?>

    <!-- load modal -->
    <?php $this->load->view("FAS/OperasionalCanvas/PerencanaanDanPersiapan/Component/Modal/sku") ?>
    <?php $this->load->view("FAS/OperasionalCanvas/PerencanaanDanPersiapan/Component/Modal/sku_ed") ?>
  </div>
</div>

<!-- /page content -->