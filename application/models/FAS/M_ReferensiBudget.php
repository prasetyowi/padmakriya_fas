<?php
class M_ReferensiBudget extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getReffKode()
    {
        // return $this->db->get('referensi_diskon')->result();
        $depo_id = $this->session->userdata('depo_id');
        $query = $this->db->select("referensi_diskon_id, referensi_diskon_kode")
            ->from("referensi_diskon")
            ->where("depo_id", $depo_id)->get()->result();
        return $query;
    }

    public function getDiskonApprove()
    {
        $this->db->select("referensi_diskon_id, referensi_diskon_kode")
            ->from("referensi_diskon")
            ->where("referensi_diskon_status", "Approved")
            ->where("referensi_diskon_is_aktif", 1);
        // $query = $this->db->query("SELECT
        //                                 referensi_diskon_id AS diskon_id,
        //                                 referensi_diskon_kode AS diskon_kode
        //                             FROM referensi_diskon
        //                             WHERE referensi_diskon_status = 'Approved' 
        //                             AND '" . date('Y-m-d') . "' BETWEEN FORMAT(referensi_diskon_tgl_berlaku_awal,'yyyy-MM-dd') AND FORMAT(referensi_diskon_tgl_berlaku_akhir,'yyyy-MM-dd') ");
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getDataPromoByKodeReff($id)
    {
        $query = $this->db->select("tp.tipe_promo_nama, tp.tipe_promo_id")
            ->from("tipe_promo as tp")
            ->join("referensi_diskon as rb", "tp.tipe_promo_id = rb.tipe_promo_id")
            ->where("rb.referensi_diskon_id", $id)->get()->result();

        return $query;
    }

    public function getUnit()
    {
        $this->db->distinct();
        $this->db->select("depo_id, depo_nama")
            ->from("depo");
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getReferensiBudget($diskon_kode, $unit)
    {
        // if ($unit == "") {
        //     $unit = "";
        // } else {
        //     $unit = "AND dg.depo_id = '" . $unit . "' ";
        // }

        if ($diskon_kode == "") {
            $diskon_kode = "";
        } else {
            $diskon_kode = "WHERE referensi_diskon_kode = '" . $diskon_kode . "' ";
        }

        $query = $this->db->query("SELECT
                                        rd.referensi_diskon_id AS diskon_id,
                                        rd.referensi_diskon_kode AS diskon_kode,
                                        d.depo_nama AS unit,
                                        format(rd.referensi_diskon_tgl_berlaku_awal, 'dd-MM-yyyy') AS tgl_awal,
                                        format(rd.referensi_diskon_tgl_berlaku_akhir, 'dd-MM-yyyy') AS tgl_akhir,
                                        format(rd.referensi_diskon_tgl_create, 'dd-MM-yyyy') AS tgl_dibuat,
                                        rd.referensi_diskon_who_create AS dibuat_oleh,
                                        format(referensi_diskon_tgl_approve, 'dd-MM-yyyy') AS tgl_disetujui,
                                        rd.referensi_diskon_who_approve AS disetujui_oleh
                                    FROM referensi_diskon AS rd
                                    INNER JOIN depo AS d
                                    ON rd.depo_id = d.depo_id
                                    " . $diskon_kode . "
                                    AND rd.depo_id = '" . $this->session->userdata('depo_id') . "'
                                    ");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result();
        }

        return $query;
    }

    public function getTipePromo()
    {
        $this->db->select("tipe_promo_id, tipe_promo_nama, tipe_promo_kode")
            ->from("tipe_promo")
            ->where("tipe_promo_is_aktif", "1");
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getTipeData()
    {
        $this->db->select("tipe_referensi_id, tipe_referensi_nama")
            ->from("tipe_referensi")
            ->where("tipe_referensi_is_aktif", "1");
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getClientWms()
    {
        $this->db->select("client_wms_id, client_wms_nama")
            ->from("client_wms")
            ->where("client_wms_is_aktif", "1");
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getClientWmsByKaryawanId($karyawan_id)
    {
        $this->db->select("client_wms.client_wms_id, client_wms_nama")
            ->from("client_wms")
            ->join("karyawan", "client_wms.client_wms_id = karyawan.client_wms_id", "left")
            ->where("karyawan.karyawan_id", $karyawan_id)
            ->where("client_wms_is_aktif", "1");
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getDepoGrup($depo_id)
    {
        $this->db->select("*")
            ->from("depo_group")
            ->where("depo_id", $depo_id);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getSkuGrup()
    {
        $this->db->distinct();
        $this->db->select("kategori_grup")
            ->from("kategori")
            ->where("kategori_grup is NOT NULL", NULL, false)
            ->where("kategori_is_aktif", 1);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getNamaGrup($id)
    {
        $this->db->distinct();
        $this->db->select("kategori_id, kategori_nama")
            ->from("kategori")
            ->where("kategori_nama is NOT NULL", NULL, false)
            ->where("kategori_is_aktif", 1)
            ->where("kategori_id", $id);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function exceptionGetSkuGrup($grup_sku, $principle_id)
    {
        //pengecekan untuk penambahan syntax query apabila salah satu kondisi terpenuhi
        if ($principle_id != '' && $grup_sku == 'Brand') {
            $brand = "AND kategori_id IN 
            (SELECT principle_brand_id FROM principle_brand 
                WHERE principle_id = '" . $principle_id . "')";
        } else {
            $brand = '';
        }

        if ($principle_id != '' && $grup_sku == 'Principle') {
            $principle = "AND kategori_id IN 
            (SELECT principle_id FROM sku 
                WHERE principle_id = '" . $principle_id . "')";
        } else {
            $principle = '';
        }

        if ($principle_id != '' && $grup_sku == 'Category') {
            $kategori = "AND kategori_id IN 
            (SELECT kategori1_id FROM sku 
                WHERE principle_id = '" . $principle_id . "')";
        } else {
            $kategori = '';
        }

        if ($principle_id != '' && $grup_sku == 'Sub Category') {
            $subkategori = "AND kategori_id IN 
            (SELECT kategori4_id FROM sku 
                WHERE principle_id = '" . $principle_id . "')";
        } else {
            $subkategori = '';
        }

        if ($principle_id != '' && $grup_sku == 'Jenis') {
            $jenis = "AND kategori_id IN 
            (SELECT kategori3_id FROM sku 
                WHERE principle_id = '" . $principle_id . "')";
        } else {
            $jenis = '';
        }

        $query = $this->db->query("SELECT DISTINCT kategori_id, kategori_grup, kategori_nama 
                                    FROM kategori
                                    WHERE kategori_grup is NOT NULL and kategori_grup = '" . $grup_sku . "' 
                                    " . $brand . "
                                    " . $principle . "
                                    " . $kategori . "
                                    " . $subkategori . "
                                    " . $jenis . "
                                ");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result();
        }

        return $query;
    }

    public function certainSku($grup_nama, $grup_sku)
    {
        if ($grup_nama != '' && $grup_sku == 'Category') {
            $kategori = "LEFT JOIN kategori AS k 
            ON s.kategori1_id = k.kategori_id 
            WHERE k.kategori_id = '" . $grup_nama . "'";
        } else {
            $kategori = '';
        }

        if ($grup_nama != '' && $grup_sku == 'Sub Category') {
            $subkategori = "LEFT JOIN kategori AS k 
            ON s.kategori2_id = k.kategori_id 
            WHERE k.kategori_id = '" . $grup_nama . "'";
        } else {
            $subkategori = '';
        }

        if ($grup_nama != '' && $grup_sku == 'Jenis') {
            $jenis = "LEFT JOIN kategori AS k 
            ON s.kategori3_id = k.kategori_id 
            WHERE k.kategori_id = '" . $grup_nama . "'";
        } else {
            $jenis = '';
        }

        if ($grup_nama != '' && $grup_sku == 'SubBrand') {
            $subbrand = "LEFT JOIN kategori AS k 
            ON s.kategori4_id = k.kategori_id 
            WHERE k.kategori_id = '" . $grup_nama . "'";
        } else {
            $subbrand = '';
        }

        if ($grup_nama != '' && $grup_sku == 'Principle') {
            $principle = "LEFT JOIN kategori AS k 
            ON s.principle_id = k.kategori_id 
            WHERE k.kategori_id IN 
            (SELECT principle_id FROM principle 
                WHERE principle_id = '" . $grup_nama . "')";
        } else {
            $principle = '';
        }

        if ($grup_nama != '' && $grup_sku == 'Brand') {
            $brand = "LEFT JOIN kategori AS k 
            ON s.principle_brand_id = k.kategori_id 
            WHERE k.kategori_id IN 
            (SELECT principle_brand_id FROM principle_brand 
                WHERE principle_brand_id = '" . $grup_nama . "')";
        } else {
            $brand = '';
        }

        $query = $this->db->query("SELECT 
                                        s.sku_id,
                                        s.sku_nama_produk AS sku_nama,
                                        s.sku_kode AS kode,
                                        s.sku_kemasan AS kemasan,
                                        s.sku_satuan AS satuan,
                                        k.kategori_grup AS kategori_grup
                                        FROM sku AS s 
                                        " . $kategori . "
                                        " . $subkategori . "
                                        " . $jenis . "
                                        " . $subbrand . "
                                        " . $principle . "
                                        " . $brand . "
                                    ");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result();
        }

        return $query;
    }

    public function getPrinciple()
    {
        $this->db->distinct();
        $this->db->select("*")
            ->from("principle")
            ->where("principle_nama is NOT NULL", NULL, false);

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getDataDepoByPrincipleId($id)
    {
        $this->db->select("a.principle_id, a.principle_nama, b.principle_brand_id, b.principle_brand_nama, c.depo_id, c.depo_nama, d.sku_id, e.sku_stock_id, f.depo_detail_id, f.depo_detail_nama")
            ->from("principle as a")
            ->join("principle_brand as b", "a.principle_id = b.principle_id", "left")
            ->join("sku as d", "d.principle_id = a.principle_id", "left")
            ->join("sku_stock as e", "d.sku_id = e.sku_id", "left")
            ->join("depo as c", "e.depo_id = c.depo_id", "left")
            ->join("depo_detail as f", "c.depo_id = f.depo_id", "left")
            ->where("a.principle_id", $id)
            ->limit(1);
            
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getDataPrincipleByPrincipleId($id)
    {
        $this->db->select("principle_id, principle_nama")
            ->from("principle")
            ->where("principle_nama is NOT NULL", NULL, false)
            ->where("principle_id", $id);

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getBrandByPrincipleId($id)
    {
        $this->db->distinct();
        $this->db->select("a.principle_id, b.principle_brand_id, b.principle_brand_nama")
            ->from("principle as a")
            ->join("principle_brand as b", "a.principle_id = b.principle_id", "inner")
            ->where("principle_nama is NOT NULL", NULL, false)
            ->where("principle_brand_is_aktif", 1)
            ->where("a.principle_id", $id);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getSkuIndukByPrincipleId($id)
    {
        $this->db->select("a.principle_id, b.sku_induk_id, b.sku_induk_nama")
            ->from("principle as a")
            ->join("sku_induk as b", "a.principle_id = b.principle_id", "left")
            ->where("a.principle_id", $id);

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getSkuNamaBySkuGrup($kategori_grup)
    {
        $this->db->select("kategori_id, kategori_nama")
            ->from("kategori")
            ->where("kategori_grup", $kategori_grup);

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function searchSkubyFilter($skuinduk, $principle, $brand, $namasku, $kodeskuwms)
    {

        if ($skuinduk == "") {
            $skuinduk = "";
        } else {
            $skuinduk = "AND s.sku_induk_id = '" . $skuinduk . "' ";
        }

        if ($principle == "") {
            $principle = "";
        } else {
            $principle = "s.principle_id = '" . $principle . "' ";
        }

        if ($brand == "") {
            $brand = "";
        } else {
            $brand = "AND s.principle_brand_id = '" . $brand . "' ";
        }

        if ($namasku == "") {
            $namasku = "";
        } else {
            $namasku = "AND s.sku_nama_produk = '" . $namasku . "' ";
        }

        if ($kodeskuwms == "") {
            $kodeskuwms = "";
        } else {
            $kodeskuwms = "AND s.sku_kode = '" . $kodeskuwms . "' ";
        }

        $query = $this->db->query("SELECT
                                        pr.principle_id,
                                        pr.principle_nama,
                                        si.sku_induk_id,
                                        si.sku_induk_nama,
                                        s.sku_id,
                                        s.sku_nama_produk,
                                        s.sku_kemasan,
                                        s.sku_satuan,
                                        s.principle_id,
                                        s.principle_brand_id,
                                        pb.principle_brand_nama
                                    FROM sku AS s
                                    LEFT JOIN principle AS pr
                                    ON pr.principle_id = s.principle_id 
                                    LEFT JOIN principle_brand AS pb
                                    ON s.principle_brand_id = pb.principle_brand_id " . $brand . "
                                    LEFT JOIN sku_induk AS si
                                    ON s.sku_induk_id = si.sku_induk_id
                                    WHERE " . $principle . "
                                          " . $skuinduk . "  
                                          " . $namasku . "
                                          " . $kodeskuwms . "
                                    ");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result();
        }

        return $query;
    }

    public function getDataSku($id)
    {
        $query = $this->db->select("s.sku_id, s.sku_kode, s.sku_nama_produk, s.sku_kemasan, s.sku_satuan, k.kategori_id")
            ->from("sku as s")
            ->join("kategori as k", "s.kategori1_id = k.kategori_id", "left")
            ->where_in("sku_id", $id)->get()->result();

        return $query;
    }

    public function getDepoKode($depo_id)
    {
        return $this->db->select("depo_kode_preffix")
            ->from("depo")
            ->where("depo_id", $depo_id)
            ->get()->row();
    }

    public function getDepoGroup($depo_id)
    {
        return $this->db->select("depo_group_id")
            ->from("depo_group")
            ->where("depo_id", $depo_id)
            ->get()->row();
    }

    public function insertReferensiBudget(
        $rb_id,
        $kode_promo,
        $depo_grup_id,
        $depo_id,
        $client_wms,
        $tipe_referensi,
        $tipe_promo,
        $principle,
        $grup_sku,
        $no_surat_promo,
        $tgl1,
        $tgl2,
        $keterangan,
        $in_qty,
        $in_value,
        $total_alokasi,
        $notif_pemakaian,
        $status,
        $createdby
    ) {
        $today = date('Y-m-d');

        $is_aktif = $this->db->query("SELECT CASE WHEN '$today' BETWEEN '$tgl1' AND '$tgl2' THEN 1 ELSE 0 END is_aktif")->row(0)->is_aktif;

        $this->db->set("referensi_diskon_id", $rb_id);
        $this->db->set("referensi_diskon_kode", $kode_promo);
        // $this->db->set("depo_group_id", $depo_grup_id);
        $this->db->set("depo_id", $depo_id);
        $this->db->set("client_wms_id", $client_wms);
        $this->db->set("tipe_referensi_id", $tipe_referensi);
        $this->db->set("tipe_promo_id", $tipe_promo);
        $this->db->set("principle_id", $principle);
        $this->db->set("referensi_diskon_is_use_grupsku", $grup_sku);
        $this->db->set("referensi_diskon_no_surat_promo", $no_surat_promo);
        $this->db->set("referensi_diskon_tgl_berlaku_awal", $tgl1);
        $this->db->set("referensi_diskon_tgl_berlaku_akhir", $tgl2);
        $this->db->set("referensi_diskon_keterangan", $keterangan);
        $this->db->set("referensi_diskon_is_in_qty", $in_qty);
        $this->db->set("referensi_diskon_is_in_value", $in_value);
        $this->db->set("referensi_diskon_total_budget", $total_alokasi);
        $this->db->set("referensi_diskon_notif_budget", $notif_pemakaian);
        $this->db->set("referensi_diskon_status", $status);
        $this->db->set("referensi_diskon_tgl_create", "GETDATE()", false);
        $this->db->set("referensi_diskon_who_create", $createdby);
        $this->db->set("referensi_diskon_is_aktif", $is_aktif);

        $this->db->insert("referensi_diskon");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }

    public function editReferensiBudget(
        $rb_id,
        $kode_promo,
        $client_wms,
        $tipe_referensi,
        $tipe_promo,
        $principle,
        $grup_sku,
        $no_surat_promo,
        $tgl1,
        $tgl2,
        $keterangan,
        $in_qty,
        $in_value,
        $total_alokasi,
        $notif_pemakaian,
        $status,
        $createdby
    ) {
        $today = date('Y-m-d');

        $is_aktif = $this->db->query("SELECT CASE WHEN '$today' BETWEEN '$tgl1' AND '$tgl2' THEN 1 ELSE 0 END is_aktif")->row(0)->is_aktif;

        $this->db->set("referensi_diskon_kode", $kode_promo);
        $this->db->set("client_wms_id", $client_wms);
        $this->db->set("tipe_referensi_id", $tipe_referensi);
        $this->db->set("tipe_promo_id", $tipe_promo);
        $this->db->set("principle_id", $principle);
        $this->db->set("referensi_diskon_is_use_grupsku", $grup_sku);
        $this->db->set("referensi_diskon_no_surat_promo", $no_surat_promo);
        $this->db->set("referensi_diskon_tgl_berlaku_awal", $tgl1);
        $this->db->set("referensi_diskon_tgl_berlaku_akhir", $tgl2);
        $this->db->set("referensi_diskon_keterangan", $keterangan);
        $this->db->set("referensi_diskon_is_in_qty", $in_qty);
        $this->db->set("referensi_diskon_is_in_value", $in_value);
        $this->db->set("referensi_diskon_total_budget", $total_alokasi);
        $this->db->set("referensi_diskon_notif_budget", $notif_pemakaian);
        $this->db->set("referensi_diskon_status", $status);
        $this->db->set("referensi_diskon_tgl_create", "GETDATE()", false);
        $this->db->set("referensi_diskon_who_create", $createdby);
        $this->db->set("referensi_diskon_is_aktif", $is_aktif);
        $this->db->where("referensi_diskon_id", $rb_id);
        $this->db->update("referensi_diskon");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryupdate = 1;
        } else {
            $queryupdate = 0;
        }

        return $queryupdate;
    }

    public function insertReferensiBudgetDetail(
        $referensi_diskon_detail_id,
        $referensi_diskon_id,
        $sku_id,
        $kategori_id,
        $referensi_diskon_detail_qty,
        $referensi_diskon_detail_value,
        $referensi_diskon_detail_alokasi
    ) {
        $this->db->set("referensi_diskon_detail_id", $referensi_diskon_detail_id);
        $this->db->set("referensi_diskon_id", $referensi_diskon_id);
        $this->db->set("sku_id", $sku_id);
        $this->db->set("kategori_id", $kategori_id);
        $this->db->set("referensi_diskon_detail_qty", $referensi_diskon_detail_qty);
        $this->db->set("referensi_diskon_detail_value", $referensi_diskon_detail_value);
        $this->db->set("referensi_diskon_detail_budget", $referensi_diskon_detail_alokasi);

        $this->db->insert("referensi_diskon_detail");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }

    public function insertReferensiBudgetDetail2(
        $referensi_diskon_detail2_id,
        $referensi_diskon_detail_id,
        $referensi_diskon_id,
        $sku_id2
    ) {
        $this->db->set("referensi_diskon_detail2_id", $referensi_diskon_detail2_id);
        $this->db->set("referensi_diskon_detail_id", $referensi_diskon_detail_id);
        $this->db->set("referensi_diskon_id", $referensi_diskon_id);
        $this->db->set("sku_id", $sku_id2);
        $this->db->set("is_pengecualian", 1);

        $this->db->insert("referensi_diskon_detail2");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }

    public function updateReferensiBudget(
        $id,
        $no_surat_promo_tambahan,
        $keterangan,
        $notif_pemakaian,
        $status
    ) {
        $this->db->set("referensi_diskon_no_surat_promo_tambahan", $no_surat_promo_tambahan);
        $this->db->set("referensi_diskon_keterangan", $keterangan);
        $this->db->set("referensi_diskon_notif_budget", $notif_pemakaian);
        $this->db->set("referensi_diskon_status", $status);
        $this->db->where("referensi_diskon_id", $id);
        $this->db->update("referensi_diskon");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryupdate = 1;
        } else {
            $queryupdate = 0;
        }

        return $queryupdate;
    }

    public function deleteReferensiBudgetDetail($id)
    {
        $query = $this->db->where("referensi_diskon_id", $id)
            ->delete("referensi_diskon_detail");

        return $query;
    }

    public function deleteReferensiBudgetDetail2($id)
    {
        $query = $this->db->where("referensi_diskon_id", $id)
            ->delete("referensi_diskon_detail2");

        return $query;
    }

    public function getKaryawanId()
    {
        $query = $this->db->query("SELECT karyawan_id FROM karyawan
									WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' ORDER BY karyawan_nama ASC");


        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->row_array();
        }

        return $query;
    }

    public function Exec_approval_pengajuan($depo_id, $karyawan_id, $approvalParam, $rb_id, $kode_promo, $is_approvaldana, $total_biaya)
    {
        $query = $this->db->query("exec approval_pengajuan '$depo_id', '$karyawan_id','$approvalParam', '$rb_id','$kode_promo', '$is_approvaldana','$total_biaya'");

        $affectedrows = $this->db->affected_rows();
        if ($affectedrows > 0) {
            $res = 1; // Success
        } else {
            $res = 0; // Success
        }

        return $res;
    }

    public function Get_ParameterApprovalMutasi()
    {
        $query = $this->db->query("SELECT vrbl_param, vrbl_kode FROM vrbl WHERE vrbl_param IN
								(SELECT approval_setting_parameter FROM approval_setting WHERE menu_web_kode = '221006000' AND approval_setting_jenis = 'Referensi Diskon')");
        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->row(0)->vrbl_param;
        }

        return $query;
    }

    public function getDataReferenceById($id)
    {
        $query = $this->db->select("referensi_diskon_id AS rb_id,
                                        referensi_diskon_kode AS rb_kode,
                                        depo_group_id AS dpg_id,
                                        depo_id,
                                        client_wms_id AS client_wms,
                                        tipe_referensi_id AS tipe_referensi,
                                        tipe_promo_id AS tipe_promo,
                                        principle_id AS principle,
                                        referensi_diskon_is_use_grupsku AS grup_sku,
                                        referensi_diskon_no_surat_promo AS no_surat,
                                        format(referensi_diskon_tgl_berlaku_awal, 'dd-MM-yyyy') AS tgl_awal,
                                        format(referensi_diskon_tgl_berlaku_akhir, 'dd-MM-yyyy') AS tgl_akhir,
                                        referensi_diskon_keterangan AS keterangan,
                                        referensi_diskon_is_in_qty AS in_qty,
                                        referensi_diskon_is_in_value AS in_value,
                                        referensi_diskon_notif_budget AS notif_budget,
                                        referensi_diskon_total_budget AS total_budget,
                                        referensi_diskon_status AS status,
                                        format(referensi_diskon_tgl_create, 'dd-MM-yyyy') AS tgl_buat,
                                        referensi_diskon_who_create AS createdby")
            ->from("referensi_diskon")
            ->where("referensi_diskon_id", $id)
            ->get()->row();
        return $query;
    }

    public function keyRbd($id)
    {
        $query = $this->db->select("*")
            ->from("referensi_diskon_detail")
            ->where("referensi_diskon_id", $id)
            ->get()->row();
        return $query;
    }

    public function getDetailReferenceById($id)
    {
        $query = $this->db->select("rbd.referensi_diskon_detail_id AS rbd_id,
                                        rbd.referensi_diskon_id AS rb_id,
                                        rbd.sku_id AS sku_id,
                                        rbd.kategori_id AS kategori_id,
                                        rbd.referensi_diskon_detail_qty AS rbd_qty,
                                        rbd.referensi_diskon_detail_value AS rbd_value,
                                        rbd.referensi_diskon_detail_budget AS rbd_budget,
                                        s.sku_kode, s.sku_nama_produk, s.sku_kemasan, s.sku_satuan,
                                        k.kategori_grup")
            ->from("referensi_diskon_detail AS rbd")
            ->join("referensi_diskon AS rb", "rbd.referensi_diskon_id = rb.referensi_diskon_id", "left")
            ->join("sku AS s", "rbd.sku_id = s.sku_id", "left")
            ->join("kategori as k", "rbd.kategori_id = k.kategori_id", "left")
            ->where("rbd.referensi_diskon_id", $id)
            ->get()->result();
        return $query;
    }

    public function getDataRow($referensi_diskon_id, $kategori_id)
    {
        $query = $this->db->select("referensi_diskon_detail_id")
            ->from("referensi_diskon_detail")
            ->where("referensi_diskon_id", $referensi_diskon_id)
            ->where("kategori_id", $kategori_id)
            ->get()->row();
        return $query;
    }

    public function count($referensi_diskon_id)
    {
        $query = $this->db->select("*")
            ->from("referensi_diskon_detail")
            ->where("referensi_diskon_id", $referensi_diskon_id)
            ->get();

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function getDetail2ReferenceById($grup_nama, $rbdid)
    {
        $query = $this->db->select("rbd2.referensi_diskon_detail2_id AS rbd2_id,
                                        rbd2.referensi_diskon_detail_id AS rbd_id,
                                        rbd2.referensi_diskon_id AS rb_id,
                                        rbd2.sku_id AS sku_id,
                                        rbd.kategori_id AS kategori_id,
                                        rbd2.is_pengecualian")
            ->from("referensi_diskon_detail2 AS rbd2")
            ->join("referensi_diskon_detail AS rbd", "rbd2.referensi_diskon_detail_id = rbd.referensi_diskon_detail_id", "left")
            ->join("referensi_diskon AS rb", "rbd.referensi_diskon_id = rb.referensi_diskon_id", "left")
            ->where("rbd.kategori_id", $grup_nama)
            ->where("rbd2.referensi_diskon_detail_id", $rbdid)
            ->get()->result();
        return $query;
    }

    public function getDet2ReferenceById($id)
    {
        $query = $this->db->select("rbd2.referensi_diskon_detail2_id AS rbd2_id,
                                        rbd2.referensi_diskon_detail_id AS rbd_id,
                                        rbd2.referensi_diskon_id AS rb_id,
                                        rbd2.sku_id AS sku_id,
                                        rbd.kategori_id AS kategori_id,
                                        rbd2.is_pengecualian")
            ->from("referensi_diskon_detail2 AS rbd2")
            ->join("referensi_diskon_detail AS rbd", "rbd2.referensi_diskon_detail_id = rbd.referensi_diskon_detail_id", "left")
            ->join("referensi_diskon AS rb", "rbd.referensi_diskon_id = rb.referensi_diskon_id", "left")
            ->where("rbd2.referensi_diskon_id", $id)
            ->get()->result();
        return $query;
    }

    public function getRelModal($kategori_id, $sku_id)
    {
        $query = $this->db->select("k.kategori_id, rbd2.sku_id")
            ->from("referensi_diskon_detail as rbd")
            ->join("kategori as k", "rbd.kategori_id = k.kategori_id", "left")
            ->join("referensi_diskon_detail2 as rbd2", "rbd.referensi_diskon_detail_id = rbd2.referensi_diskon_detail_id")
            ->where("k.kategori_id", $kategori_id)
            ->where("rbd2.sku_id", $sku_id)
            ->get()->row();
        return $query;
    }
}