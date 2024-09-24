<?php

class M_HargaDanPromo extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function GetTipeDiskon()
	{
		$this->db->select("*")
			->from("tipe_diskon")
			->where("tipe_diskon_is_aktif", 1)
			->order_by("tipe_diskon_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetReferensiDiskon()
	{
		$this->db->select("*")
			->from("referensi_diskon")
			->where("depo_id", $this->session->userdata('depo_id'))
			->order_by("referensi_diskon_kode");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetReferensiDiskonByKategori($kategori)
	{

		$query = $this->db->query("SELECT
									hdr.referensi_diskon_id,
									hdr.referensi_diskon_kode
									FROM referensi_diskon hdr
									INNER JOIN referensi_diskon_detail dtl
									ON dtl.referensi_diskon_id = hdr.referensi_diskon_id
									WHERE hdr.depo_id = '" . $this->session->userdata('depo_id') . "'
									AND dtl.kategori_id = '$kategori'
									GROUP BY hdr.referensi_diskon_id,
											hdr.referensi_diskon_kode
									ORDER BY hdr.referensi_diskon_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetAllSKUHarga()
	{
		$this->db->select("*")
			->from("sku_harga")
			->order_by("sku_harga_kode");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetAllSKUPromo()
	{
		$this->db->select("*")
			->from("sku_promo")
			->order_by("sku_promo_kode");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetPrinciple()
	{
		$this->db->select("*")
			->from("principle")
			->order_by("principle_kode");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetClientPtSegmen1()
	{
		$this->db->select("client_pt_segmen_id, client_pt_segmen_kode, client_pt_segmen_nama")
			->from("client_pt_segmen")
			->where("client_pt_segmen_is_aktif", 1)
			->where("client_pt_segmen_level", 1)
			->order_by("client_pt_segmen_kode");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getPrincipleByPerusahaan($perusahaan)
	{
		$query = $this->db->query("SELECT
										b.principle_id, b.principle_kode
									FROM client_wms_principle a
									LEFT JOIN principle b
										ON a.principle_id = b.principle_id
									WHERE client_wms_id = '$perusahaan'
									order by b.principle_kode asc");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getPrincipleByClientWMS($client_wms_id)
	{
		$query = $this->db->query("SELECT b.principle_id, b.principle_kode FROM client_wms_principle a
		LEFT JOIN principle b on a.principle_id = b.principle_id
		where a.client_wms_id = '" . $client_wms_id . "'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetBrand()
	{
		$this->db->select("*")
			->from("principle_brand")
			->order_by("principle_brand_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_brand_by_principle($principle_id)
	{
		$this->db->select("*")
			->from("principle_brand")
			->where("principle_id", $principle_id)
			->order_by("principle_brand_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function GetKategori()
	{
		$this->db->select("*")
			->from("kategori")
			->where('kategori_nama is NOT NULL', NULL, FALSE)
			->order_by("kategori_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetKategoriGroup()
	{
		$this->db->select("kategori_grup")
			->from("kategori")
			->where('kategori_grup is NOT NULL', NULL, FALSE)
			->where_not_in('kategori_grup', array("SubBrand", "Sub Brand"))
			->group_by("kategori_grup")
			->order_by("kategori_grup");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetKategoriByPrincipleKategori($principle_id, $kategori_grup)
	{
		if ($kategori_grup == "Principle") {
			$query = $this->db->query("select * from kategori where kategori_grup = 'Principle' and kategori_id in (select principle_id from sku where principle_id = '$principle_id')");
		} else if ($kategori_grup == "Brand") {
			$query = $this->db->query("select * from kategori where kategori_grup = 'Brand' and kategori_id in (select principle_brand_id from sku where principle_id = '$principle_id')");
		} else if ($kategori_grup == "Category") {
			$query = $this->db->query("select * from kategori where kategori_grup = 'Category' and kategori_id in (select kategori1_id from sku where principle_id = '$principle_id')");
		} else if ($kategori_grup == "Sub Category") {
			$query = $this->db->query("select * from kategori where kategori_grup = 'Sub Category' and kategori_id in (select kategori2_id from sku where principle_id = '$principle_id')");
		} else if ($kategori_grup == "Jenis") {
			$query = $this->db->query("select * from kategori where kategori_grup = 'Jenis' and kategori_id in (select kategori3_id from sku where principle_id = '$principle_id')");
		} else {
			$query = "";
		}

		if ($query == "") {
			$query = 0;
		} else {

			if ($query->num_rows() == 0) {
				$query = 0;
			} else {
				$query = $query->result_array();
			}
		}

		return $query;

		// return $this->db->last_query();
	}

	public function GetKategoriByGroup($group)
	{
		$this->db->select("*")
			->from("kategori")
			->where('kategori_grup', $group)
			->order_by("kategori_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetNamaPerusahaanById($id)
	{
		$this->db->select("*")
			->from("client_wms")
			->where("client_wms_id", $id)
			->order_by("client_wms_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0)->client_wms_nama;
		}

		return $query;
	}

	public function GetNamaDepoById($id)
	{
		$this->db->select("*")
			->from("depo")
			->where("depo_id", $id)
			->order_by("depo_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0)->depo_nama;
		}

		return $query;
	}

	public function GetPerusahaan()
	{
		if ($this->session->userdata('pengguna_username') == 'Administrator') {
			// $this->db->select("*")
			// 	->from("client_wms")
			// 	->order_by("client_wms_nama");
			// $query = $this->db->get();

			$query = $this->db->query("select
											b.*
										from depo_client_wms a
										left join client_wms b
										on b.client_wms_id = a.client_wms_id 
										where a.depo_id = '" . $this->session->userdata('depo_id') . "'
										ORDER BY b.client_wms_nama ASC");
		} else {

			// $this->db->select("*")
			// 	->from("client_wms")
			// 	->where("client_wms_id", $this->session->userdata('client_wms_id'))
			// 	->order_by("client_wms_nama");
			// $query = $this->db->get();

			$query = $this->db->query("select
										b.*
									from depo_client_wms a
									left join client_wms b
									on b.client_wms_id = a.client_wms_id 
									where a.depo_id = '" . $this->session->userdata('depo_id') . "'
									AND a.client_wms_id = '" . $this->session->userdata('client_wms_id') . "'
									ORDER BY b.client_wms_nama ASC");
		}

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetDepo()
	{
		$this->db->select("*")
			->from("depo")
			->order_by("depo_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetDepoByHarga($sku_harga_id)
	{
		$query = $this->db->query("SELECT
									depo.*,
									depo_harga.depo_id AS depo_harga_id
									FROM depo
									LEFT JOIN (SELECT
									b.*
									FROM sku_harga a
									LEFT JOIN sku_harga_lokasi b
									ON b.sku_harga_id = a.sku_harga_id
									WHERE a.sku_harga_id = '$sku_harga_id') depo_harga
									ON depo_harga.depo_id = depo.depo_id
									ORDER BY depo.depo_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetDepoByPromo($sku_promo_id)
	{
		$query = $this->db->query("SELECT
									depo.*,
									depo_promo.depo_id AS depo_promo_id
									FROM depo
									LEFT JOIN (SELECT
									b.*
									FROM sku_promo_temp a
									LEFT JOIN sku_promo_lokasi_temp b
									ON b.sku_promo_id = a.sku_promo_id
									WHERE a.sku_promo_id = '$sku_promo_id') depo_promo
									ON depo_promo.depo_id = depo.depo_id
									ORDER BY depo.depo_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetDepoGroup()
	{
		$this->db->select("depo_group_nama")
			->from("depo_group")
			->group_by("depo_group_nama")
			->order_by("depo_group_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetDepoGroupByHarga($sku_harga_id)
	{
		$query = $this->db->query("SELECT
									depo_group.depo_group_nama,
									COUNT(DISTINCT depo_harga.depo_group_nama) AS depo_group_nama_harga
									FROM depo_group
									LEFT JOIN (SELECT
									b.depo_group_nama
									FROM sku_harga a
									LEFT JOIN sku_harga_lokasi b
									ON b.sku_harga_id = a.sku_harga_id
									WHERE a.sku_harga_id = '$sku_harga_id'
									GROUP BY b.depo_group_nama) depo_harga
									ON depo_harga.depo_group_nama = depo_group.depo_group_nama
									GROUP BY depo_group.depo_group_nama
									ORDER BY depo_group.depo_group_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetDepoGroupByPromo($sku_promo_id)
	{
		$query = $this->db->query("SELECT
									depo_group.depo_group_nama,
									COUNT(DISTINCT depo_promo.depo_group_nama) AS depo_group_nama_promo
									FROM depo_group
									LEFT JOIN (SELECT
									b.depo_group_nama
									FROM sku_promo_temp a
									LEFT JOIN sku_promo_lokasi_temp b
									ON b.sku_promo_id = a.sku_promo_id
									WHERE a.sku_promo_id = '$sku_promo_id'
									GROUP BY b.depo_group_nama) depo_promo
									ON depo_promo.depo_group_nama = depo_group.depo_group_nama
									GROUP BY depo_group.depo_group_nama
									ORDER BY depo_group.depo_group_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getDepoGroupNamaSkuPromoLokasi($sku_promo_id)
	{
		$query = $this->db->query("SELECT DISTINCT
		depo_group_nama
	  FROM sku_promo_lokasi
	  WHERE sku_promo_id = '$sku_promo_id'
	  ORDER BY depo_group_nama ASC");

		if ($query->num_rows() == 0) {
			$query = [];
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getDepoSkuPromoLokasi($sku_promo_id)
	{
		$query = $this->db->query("SELECT DISTINCT
		b.depo_nama
	  FROM sku_promo_lokasi a
	  LEFT JOIN depo b ON a.depo_id = b.depo_id
	  WHERE a.sku_promo_id = '$sku_promo_id'
	  ORDER BY b.depo_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getSkuPromoSegmen($sku_promo_id)
	{
		$query = $this->db->query("SELECT DISTINCT
										concat(b.client_pt_segmen_kode, ' - ', b.client_pt_segmen_nama) as segmen
									FROM sku_promo_segmen a
									LEFT JOIN client_pt_segmen b ON a.client_pt_segmen_id = b.client_pt_segmen_id
									WHERE a.sku_promo_id = '$sku_promo_id'
									ORDER BY concat(b.client_pt_segmen_kode, ' - ', b.client_pt_segmen_nama) ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getSkuPromoSegmenDetail($sku_promo_id)
	{
		$query = $this->db->query("SELECT
										a.sku_promo_id,
										a.client_pt_id,
										b.client_pt_nama,
										ISNULL(b.client_pt_kelurahan,'') as client_pt_kelurahan,
										ISNULL(b.client_pt_kecamatan,'') as client_pt_kecamatan,
										ISNULL(b.client_pt_kota,'') as client_pt_kota,
										ISNULL(b.client_pt_propinsi,'') as client_pt_propinsi
									FROM sku_promo_segmen_detail a
									LEFT JOIN client_pt b ON a.client_pt_id = b.client_pt_id
									WHERE a.sku_promo_id = '$sku_promo_id'
									ORDER BY b.client_pt_nama ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_promo_temp_by_id($sku_promo_id)
	{
		$query = $this->db->query("SELECT
									sku_promo_id,
									depo_group_id,
									depo_id,
									client_wms_id,
									sku_promo_kode,
									FORMAT(sku_promo_tgl_berlaku_awal, 'dd-MM-yyyy') sku_promo_tgl_berlaku_awal,
									FORMAT(sku_promo_tgl_berlaku_akhir, 'dd-MM-yyyy') sku_promo_tgl_berlaku_akhir,
									sku_promo_keterangan,
									sku_promo_status,
									sku_promo_tgl_create,
									sku_promo_who_create,
									ISNULL(is_khusus, '0') as is_khusus
									FROM sku_promo_temp
									WHERE sku_promo_id = '$sku_promo_id'
									ORDER BY sku_promo_kode DESC ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_promo_by_id($sku_promo_id)
	{
		$query = $this->db->query("SELECT
									sku_promo_id,
									depo_group_id,
									depo_id,
									client_wms.client_wms_nama,
									client_wms.client_wms_id,
									sku_promo_kode,
									FORMAT(sku_promo_tgl_berlaku_awal, 'dd-MM-yyyy') sku_promo_tgl_berlaku_awal,
									FORMAT(sku_promo_tgl_berlaku_akhir, 'dd-MM-yyyy') sku_promo_tgl_berlaku_akhir,
									sku_promo_keterangan,
									sku_promo_status,
									sku_promo_tgl_create,
									sku_promo_who_create,
									ISNULL(is_khusus, '0') as is_khusus
									FROM sku_promo
									LEFT JOIN client_wms ON sku_promo.client_wms_id = client_wms.client_wms_id
									WHERE sku_promo_id = '$sku_promo_id'
									ORDER BY sku_promo_kode DESC ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_sku_promo_lokasi_by_id($sku_promo_id)
	{
		$query = $this->db->query("SELECT
									a.*
									FROM sku_promo_lokasi a
									WHERE a.sku_promo_id = '$sku_promo_id'");
		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getDepoPrefix($depo_id)
	{
		$listDoBatch = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $listDoBatch->row();
	}

	public function cek_sku_harga($tgl, $tgl2, $perusahaan, $depo_id)
	{
		$tgl = date('Y-m-d', strtotime(str_replace("/", "-", $tgl)));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl2)));

		$query = $this->db->query("SELECT
										*
									FROM sku_harga
									WHERE ((sku_harga_startdate BETWEEN '$tgl'AND '$tgl2') OR 
									(sku_harga_enddate BETWEEN '$tgl' AND '$tgl2') OR 
									(sku_harga_startdate <= '$tgl' AND sku_harga_enddate >= '$tgl2'))
									AND client_wms_id = '$perusahaan'
									AND sku_harga_status = 'Approved' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function search_depo_by_group($depo_group_nama)
	{
		// Pastikan $depo_group_nama adalah array
		if (!is_array($depo_group_nama)) {
			$depo_group_nama = [$depo_group_nama];
		}

		$query = $this->db->query("SELECT
									depo.*
									FROM depo_group
									LEFT JOIN depo
									ON depo.depo_id = depo_group.depo_id
									WHERE depo_group.depo_group_nama IN (" . implode(",", $depo_group_nama) . ")
									ORDER BY depo.depo_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function search_depo_by_multi_group($depo_group_nama)
	{
		if ($depo_group_nama == "") {
			$depo_group_nama = "depo_group.depo_group_nama IS NOT NULL";
		} else {
			$depo_group_nama = "depo_group.depo_group_nama IN (" . implode(",", $depo_group_nama) . ")";
		}

		$query = $this->db->query("SELECT
									depo.*
									FROM depo_group
									LEFT JOIN depo
									ON depo.depo_id = depo_group.depo_id
									WHERE " . $depo_group_nama . "
									ORDER BY depo.depo_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function search_sku_promo_by_filter($sku_promo_kode, $depo_group_id, $depo_id)
	{
		if ($sku_promo_kode == "") {
			$sku_promo_kode = "";
		} else {
			$sku_promo_kode = " AND promo.sku_promo_kode = '$sku_promo_kode' ";
		}

		// if ($depo_group_id == "") {
		// 	$depo_group_id = "";
		// } else {
		// 	$depo_group_id = " AND lokasi.depo_group_nama = '$depo_group_id' ";
		// }

		// if ($depo_id == "") {
		// 	$depo_id = "";
		// } else {
		// 	$depo_id = " AND lokasi.depo_id = '$depo_id' ";
		// }

		$query = $this->db->query("SELECT
									*
									FROM(SELECT
									promo.sku_promo_id,
									promo.sku_promo_kode,
									FORMAT(promo.sku_promo_tgl_berlaku_awal, 'dd-MM-yyyy') AS sku_promo_tgl_berlaku_awal,
									FORMAT(promo.sku_promo_tgl_berlaku_akhir, 'dd-MM-yyyy') AS sku_promo_tgl_berlaku_akhir,
									FORMAT(promo.sku_promo_tgl_create, 'dd-MM-yyyy') AS sku_promo_tgl_create,
									promo.sku_promo_who_create,
									'' AS sku_promo_tgl_approved,
									'' AS sku_promo_who_aprroved,
									promo.sku_promo_status
									FROM sku_promo promo
									UNION ALL
									SELECT
									promo_temp.sku_promo_id,
									promo_temp.sku_promo_kode,
									FORMAT(promo_temp.sku_promo_tgl_berlaku_awal, 'dd-MM-yyyy') AS sku_promo_tgl_berlaku_awal,
									FORMAT(promo_temp.sku_promo_tgl_berlaku_akhir, 'dd-MM-yyyy') AS sku_promo_tgl_berlaku_akhir,
									FORMAT(promo_temp.sku_promo_tgl_create, 'dd-MM-yyyy') AS sku_promo_tgl_create,
									promo_temp.sku_promo_who_create,
									'' AS sku_promo_tgl_approved,
									'' AS sku_promo_who_aprroved,
									promo_temp.sku_promo_status
									FROM sku_promo_temp promo_temp) promo
									WHERE promo.sku_promo_id IS NOT NULL
									" . $sku_promo_kode . "
									ORDER BY promo.sku_promo_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function search_sku_harga_by_filter($sku_harga_kode, $client_wms_id, $sku_harga_is_aktif)
	{
		if ($sku_harga_kode == "") {
			$sku_harga_kode = "";
		} else {
			$sku_harga_kode = " AND harga.sku_harga_kode = '$sku_harga_kode' ";
		}

		if ($client_wms_id == "") {
			$client_wms_id = "";
		} else {
			$client_wms_id = " AND harga.client_wms_id = '$client_wms_id' ";
		}

		if ($sku_harga_is_aktif == "") {
			$sku_harga_is_aktif = "";
		} else {
			$sku_harga_is_aktif = " AND harga.sku_harga_is_aktif = '$sku_harga_is_aktif' ";
		}

		// if ($depo_group_id == "") {
		// $depo_group_id = "";
		// } else {
		// $depo_group_id = " AND lokasi.depo_group_nama = '$depo_group_id' ";
		// }

		// if ($depo_id == "") {
		// $depo_id = "";
		// } else {
		// $depo_id = " AND lokasi.depo_id = '$depo_id' ";
		// }

		$query = $this->db->query("SELECT
									harga.sku_harga_id,
									harga.sku_harga_kode,
									harga.client_wms_id,
									perusahaan.client_wms_nama,
									ISNULL(harga.sku_harga_keterangan,'') AS sku_harga_keterangan,
									FORMAT(harga.sku_harga_startdate, 'dd-MM-yyyy') AS sku_harga_tgl_berlaku_awal,
									FORMAT(harga.sku_harga_enddate, 'dd-MM-yyyy') AS sku_harga_tgl_berlaku_akhir,
									FORMAT(harga.sku_harga_tgl_create, 'dd-MM-yyyy') AS sku_harga_tgl_create,
									harga.sku_harga_who_create,
									CASE WHEN harga.sku_harga_tgl_approve IS NOT NULL THEN FORMAT(harga.sku_harga_tgl_approve, 'dd-MM-yyyy') ELSE '' END AS sku_harga_tgl_approved,
									ISNULL(harga.sku_harga_who_approve,'') AS sku_harga_who_aprroved,
									harga.sku_harga_status,
									harga.sku_harga_is_aktif
									FROM sku_harga harga
									LEFT JOIN client_wms perusahaan
									ON perusahaan.client_wms_id = harga.client_wms_id
									WHERE harga.sku_harga_id IS NOT NULL
									" . $sku_harga_kode . "
									" . $client_wms_id . "
									" . $sku_harga_is_aktif . "
									ORDER BY harga.sku_harga_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function search_depo_group_by_multi_depo($depo_id)
	{
		if ($depo_id == "") {
			$depo_id = "depo_id IS NOT NULL";
		} else {
			$depo_id = "depo_id IN (" . implode(",", $depo_id) . ")";
		}

		$query = $this->db->query("SELECT * FROM depo_group WHERE " . $depo_id . " ORDER BY depo_group_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function search_filter_chosen_sku($sku_kode_wms, $sku_kode_pabrik, $brand, $principle, $sku_induk, $sku_nama_produk, $sku_group_id, $sku_group_nama, $perusahaan)
	{
		if ($sku_kode_wms == "") {
			$sku_kode_wms = "";
		} else {
			$sku_kode_wms = "AND sku.sku_kode = '" . $sku_kode_wms . "' ";
		}

		if ($sku_kode_pabrik == "") {
			$sku_kode_pabrik = "";
		} else {
			$sku_kode_pabrik = "AND sku.sku_kode = '" . $sku_kode_pabrik . "' ";
		}

		if ($brand == "") {
			$brand = "";
		} else {
			$brand = "AND sku.principle_brand_id = '$brand' ";
		}

		if ($principle == "") {
			$principle = "";
		} else {
			$principle = "AND sku.principle_id = '$principle' ";
		}

		if ($sku_induk == "") {
			$sku_induk = "";
		} else {
			$sku_induk = "AND sku_induk.sku_induk_nama LIKE '%" . $sku_induk . "%' ";
		}

		if ($sku_nama_produk == "") {
			$sku_nama_produk = "";
		} else {
			$sku_nama_produk = "AND sku.sku_nama_produk LIKE '%" . $sku_nama_produk . "%' ";
		}

		if ($sku_group_id == "") {
			$sku_group_id = "";
			$sku_group_nama = "";
		} else {
			if ($sku_group_id == "Brand") {
				$sku_group_id = "";
				$sku_group_nama = " AND principle_brand.principle_brand_nama = '$sku_group_nama' ";
			} else if ($sku_group_id == "Category") {
				$sku_group_id = "";
				$sku_group_nama = " AND kategori1.kategori_id = '$sku_group_nama' ";
			} else if ($sku_group_id == "Jenis") {
				$sku_group_id = "";
				$sku_group_nama = " AND kategori3.kategori_id = '$sku_group_nama' ";
			} else if ($sku_group_id == "Principle") {
				$sku_group_id = "";
				$sku_group_nama = " AND principle.principle_kode = '$principle' ";
			} else if ($sku_group_id == "Sub Category") {
				$sku_group_id = "";
				$sku_group_nama = " AND kategori2.kategori_id = '$sku_group_nama' ";
			} else if ($sku_group_id == "Sub Brand") {
				$sku_group_id = "";
				$sku_group_nama = "";
			}
		}

		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = "AND sku.client_wms_id = '" . $perusahaan . "' ";
		}

		$query = $this->db->query("SELECT
									sku.client_wms_id,
									client_wms.client_wms_nama,
									sku.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.principle_id,
									principle.principle_kode AS principle,
									sku.principle_brand_id,
									principle_brand.principle_brand_nama AS brand,
									kategori1.kategori_nama AS kategori1,
									kategori2.kategori_nama AS kategori2,
									kategori3.kategori_nama AS kategori3,
									kategori4.kategori_nama AS kategori4,
									kategori5.kategori_nama AS kategori5,
									kategori6.kategori_nama AS kategori6,
									kategori7.kategori_nama AS kategori7,
									kategori8.kategori_nama AS kategori8,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_induk_id,
									sku_induk.sku_induk_nama AS sku_induk
									FROM sku
									LEFT JOIN sku_induk
									ON sku.sku_induk_id = sku_induk.sku_induk_id
									LEFT JOIN principle
									ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand
									ON principle_brand.principle_brand_id = sku.principle_brand_id
									LEFT JOIN kategori kategori1
									ON kategori1.kategori_id = sku.kategori1_id
									LEFT JOIN kategori kategori2
									ON kategori2.kategori_id = sku.kategori2_id
									LEFT JOIN kategori kategori3
									ON kategori3.kategori_id = sku.kategori3_id
									LEFT JOIN kategori kategori4
									ON kategori4.kategori_id = sku.kategori4_id
									LEFT JOIN kategori kategori5
									ON kategori5.kategori_id = sku.kategori5_id
									LEFT JOIN kategori kategori6
									ON kategori6.kategori_id = sku.kategori6_id
									LEFT JOIN kategori kategori7
									ON kategori7.kategori_id = sku.kategori7_id
									LEFT JOIN kategori kategori8
									ON kategori8.kategori_id = sku.kategori8_id
									INNER JOIN client_wms
									ON client_wms.client_wms_id = sku.client_wms_id
									WHERE sku.sku_id IS NOT NULL
									" . $sku_kode_wms . "
									" . $sku_kode_pabrik . "
									" . $brand . "
									" . $principle . "
									" . $sku_induk . "
									" . $sku_nama_produk . "
									" . $sku_group_id . "
									" . $sku_group_nama . "
									" . $perusahaan . "
									ORDER BY client_wms.client_wms_nama, principle.principle_kode, sku.sku_kode");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function search_filter_chosen_sku_harga($perusahaan, $brand, $principle, $sku_induk, $sku_nama_produk)
	{
		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = "AND sku.client_wms_id = '" . $perusahaan . "' ";
		}

		if ($brand == "") {
			$brand = "";
		} else {
			$brand = "AND brand.principle_brand_nama LIKE '%" . $brand . "%' ";
		}

		if ($principle == "") {
			$principle = "";
		} else {
			$principle = "AND sku.principle_id = '$principle' ";
		}

		if ($sku_induk == "") {
			$sku_induk = "";
		} else {
			$sku_induk = "AND sku_induk.sku_induk_nama LIKE '%" . $sku_induk . "%' ";
		}

		if ($sku_nama_produk == "") {
			$sku_nama_produk = "";
		} else {
			$sku_nama_produk = "AND sku.sku_nama_produk LIKE '%" . $sku_nama_produk . "%' ";
		}

		$query = $this->db->query("SELECT
									sku.client_wms_id,
									client_wms.client_wms_nama,
									sku.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.principle_id,
									principle.principle_kode AS principle,
									sku.principle_brand_id,
									principle_brand.principle_brand_nama AS brand,
									kategori1.kategori_nama AS kategori1,
									kategori2.kategori_nama AS kategori2,
									kategori3.kategori_nama AS kategori3,
									kategori4.kategori_nama AS kategori4,
									kategori5.kategori_nama AS kategori5,
									kategori6.kategori_nama AS kategori6,
									kategori7.kategori_nama AS kategori7,
									kategori8.kategori_nama AS kategori8,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_induk_id,
									sku_induk.sku_induk_nama AS sku_induk
									FROM sku
									LEFT JOIN sku_induk
									ON sku.sku_induk_id = sku_induk.sku_induk_id
									LEFT JOIN principle
									ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand
									ON principle_brand.principle_brand_id = sku.principle_brand_id
									LEFT JOIN kategori kategori1
									ON kategori1.kategori_id = sku.kategori1_id
									LEFT JOIN kategori kategori2
									ON kategori2.kategori_id = sku.kategori2_id
									LEFT JOIN kategori kategori3
									ON kategori3.kategori_id = sku.kategori3_id
									LEFT JOIN kategori kategori4
									ON kategori4.kategori_id = sku.kategori4_id
									LEFT JOIN kategori kategori5
									ON kategori5.kategori_id = sku.kategori5_id
									LEFT JOIN kategori kategori6
									ON kategori6.kategori_id = sku.kategori6_id
									LEFT JOIN kategori kategori7
									ON kategori7.kategori_id = sku.kategori7_id
									LEFT JOIN kategori kategori8
									ON kategori8.kategori_id = sku.kategori8_id
									INNER JOIN client_wms
									ON client_wms.client_wms_id = sku.client_wms_id
									WHERE sku.sku_id IS NOT NULL
									" . $perusahaan . "
									" . $brand . "
									" . $principle . "
									" . $sku_induk . "
									" . $sku_nama_produk . "
									ORDER BY client_wms.client_wms_nama, principle.principle_kode, sku.sku_kode");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSelectedSKU($sku_id)
	{
		$sku_id = implode(",", $sku_id);

		$query = $this->db->query("SELECT
									sku.sku_id,
									sku.sku_kode,
									sku.sku_varian,
									sku.sku_induk_id,
									ISNULL(sku.sku_weight,'0') sku_weight,
									ISNULL(sku.sku_weight_unit,'') sku_weight_unit,
									ISNULL(sku.sku_length,'0') sku_length,
									ISNULL(sku.sku_length_unit,'') sku_length_unit,
									ISNULL(sku.sku_width,'0') sku_width,
									ISNULL(sku.sku_width_unit,'') sku_width_unit,
									ISNULL(sku.sku_height,'0') sku_height,
									ISNULL(sku.sku_height_unit,'') sku_height_unit,
									ISNULL(sku.sku_volume,'0') sku_volume,
									ISNULL(sku.sku_volume_unit,'') sku_volume_unit,
									ISNULL(sku.sku_satuan,'') sku_satuan,
									ISNULL(sku.sku_kemasan,'') sku_kemasan,
									sku.kemasan_id,
									ISNULL(sku.sku_harga_jual,'0') AS sku_harga_jual,
									sku.kategori1_id,
									sku.kategori2_id,
									sku.kategori3_id,
									sku.kategori4_id,
									sku.kategori5_id,
									sku.kategori6_id,
									sku.kategori7_id,
									sku.kategori8_id,
									sku.principle_id,
									sku.principle_brand_id,
									sku.sku_nama_produk,
									ISNULL(sku.sku_deskripsi,'') sku_deskripsi,
									ISNULL(sku.sku_origin,'') sku_origin,
									ISNULL(sku.sku_kondisi,'') sku_kondisi,
									ISNULL(sku.sku_sales_min_qty,'0') sku_sales_min_qty,
									ISNULL(sku.sku_ppnbm_persen,'0') sku_ppnbm_persen,
									ISNULL(sku.sku_ppn_persen,'0') sku_ppn_persen,
									ISNULL(sku.sku_pph,'0') sku_pph,
									sku.sku_is_aktif,
									sku.sku_is_jual,
									sku.sku_is_paket,
									sku.sku_is_deleted,
									ISNULL(sku.sku_weight_netto,'0') sku_weight_netto,
									ISNULL(sku.sku_weight_netto_unit,'') sku_weight_netto_unit,
									ISNULL(sku.sku_weight_product,'0') sku_weight_product,
									ISNULL(sku.sku_weight_product_unit,'') sku_weight_product_unit,
									ISNULL(sku.sku_weight_packaging,'0') sku_weight_packaging,
									ISNULL(sku.sku_weight_packaging_unit,'') sku_weight_packaging_unit,
									ISNULL(sku.sku_weight_gift,'0') sku_weight_gift,
									ISNULL(sku.sku_weight_gift_unit,'') sku_weight_gift_unit,
									sku.sku_bosnet_id,
									sku.sku_is_hadiah,
									sku.sku_is_from_import,
									ISNULL(sku.sku_kode_sku_principle,'') sku_kode_sku_principle,
									sku.client_wms_id,
									client_wms.client_wms_nama,
									principle.principle_kode AS principle,
									principle_brand.principle_brand_nama AS brand
									FROM sku
									LEFT JOIN client_wms
									ON client_wms.client_wms_id = sku.client_wms_id
									LEFT JOIN principle
									ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand
									ON principle_brand.principle_brand_id = sku.principle_brand_id
									WHERE sku.sku_id IN (" . $sku_id . ")
									GROUP BY sku.sku_id,
											sku.sku_kode,
											sku.sku_varian,
											sku.sku_induk_id,
											ISNULL(sku.sku_weight, '0'),
											ISNULL(sku.sku_weight_unit, ''),
											ISNULL(sku.sku_length, '0'),
											ISNULL(sku.sku_length_unit, ''),
											ISNULL(sku.sku_width, '0'),
											ISNULL(sku.sku_width_unit, ''),
											ISNULL(sku.sku_height, '0'),
											ISNULL(sku.sku_height_unit, ''),
											ISNULL(sku.sku_volume, '0'),
											ISNULL(sku.sku_volume_unit, ''),
											ISNULL(sku.sku_satuan, ''),
											ISNULL(sku.sku_kemasan, ''),
											sku.kemasan_id,
											sku.sku_harga_jual,
											sku.kategori1_id,
											sku.kategori2_id,
											sku.kategori3_id,
											sku.kategori4_id,
											sku.kategori5_id,
											sku.kategori6_id,
											sku.kategori7_id,
											sku.kategori8_id,
											sku.principle_id,
											sku.principle_brand_id,
											sku.sku_nama_produk,
											ISNULL(sku.sku_deskripsi, ''),
											ISNULL(sku.sku_origin, ''),
											ISNULL(sku.sku_kondisi, ''),
											ISNULL(sku.sku_sales_min_qty, '0'),
											ISNULL(sku.sku_ppnbm_persen, '0'),
											ISNULL(sku.sku_ppn_persen, '0'),
											ISNULL(sku.sku_pph, '0'),
											sku.sku_is_aktif,
											sku.sku_is_jual,
											sku.sku_is_paket,
											sku.sku_is_deleted,
											ISNULL(sku.sku_weight_netto, '0'),
											ISNULL(sku.sku_weight_netto_unit, ''),
											ISNULL(sku.sku_weight_product, '0'),
											ISNULL(sku.sku_weight_product_unit, ''),
											ISNULL(sku.sku_weight_packaging, '0'),
											ISNULL(sku.sku_weight_packaging_unit, ''),
											ISNULL(sku.sku_weight_gift, '0'),
											ISNULL(sku.sku_weight_gift_unit, ''),
											sku.sku_bosnet_id,
											sku.sku_is_hadiah,
											sku.sku_is_from_import,
											ISNULL(sku.sku_kode_sku_principle, ''),
											sku.client_wms_id,
											client_wms.client_wms_nama,
											principle.principle_kode,
											principle_brand.principle_brand_nama
									ORDER BY client_wms.client_wms_nama, sku.sku_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSelectedSKUEdit($sku_harga_id, $sku_id)
	{
		$sku_id = implode(",", $sku_id);

		$query = $this->db->query("SELECT
									sku.sku_id,
									sku.sku_kode,
									sku.sku_varian,
									sku.sku_induk_id,
									ISNULL(sku.sku_weight,'0') sku_weight,
									ISNULL(sku.sku_weight_unit,'') sku_weight_unit,
									ISNULL(sku.sku_length,'0') sku_length,
									ISNULL(sku.sku_length_unit,'') sku_length_unit,
									ISNULL(sku.sku_width,'0') sku_width,
									ISNULL(sku.sku_width_unit,'') sku_width_unit,
									ISNULL(sku.sku_height,'0') sku_height,
									ISNULL(sku.sku_height_unit,'') sku_height_unit,
									ISNULL(sku.sku_volume,'0') sku_volume,
									ISNULL(sku.sku_volume_unit,'') sku_volume_unit,
									ISNULL(sku.sku_satuan,'') sku_satuan,
									ISNULL(sku.sku_kemasan,'') sku_kemasan,
									sku.kemasan_id,
									ISNULL(sku.sku_harga_jual,'0') AS sku_harga_jual,
									sku.kategori1_id,
									sku.kategori2_id,
									sku.kategori3_id,
									sku.kategori4_id,
									sku.kategori5_id,
									sku.kategori6_id,
									sku.kategori7_id,
									sku.kategori8_id,
									sku.principle_id,
									sku.principle_brand_id,
									sku.sku_nama_produk,
									ISNULL(sku.sku_deskripsi,'') sku_deskripsi,
									ISNULL(sku.sku_origin,'') sku_origin,
									ISNULL(sku.sku_kondisi,'') sku_kondisi,
									ISNULL(sku.sku_sales_min_qty,'0') sku_sales_min_qty,
									ISNULL(sku.sku_ppnbm_persen,'0') sku_ppnbm_persen,
									ISNULL(sku.sku_ppn_persen,'0') sku_ppn_persen,
									ISNULL(sku.sku_pph,'0') sku_pph,
									sku.sku_is_aktif,
									sku.sku_is_jual,
									sku.sku_is_paket,
									sku.sku_is_deleted,
									ISNULL(sku.sku_weight_netto,'0') sku_weight_netto,
									ISNULL(sku.sku_weight_netto_unit,'') sku_weight_netto_unit,
									ISNULL(sku.sku_weight_product,'0') sku_weight_product,
									ISNULL(sku.sku_weight_product_unit,'') sku_weight_product_unit,
									ISNULL(sku.sku_weight_packaging,'0') sku_weight_packaging,
									ISNULL(sku.sku_weight_packaging_unit,'') sku_weight_packaging_unit,
									ISNULL(sku.sku_weight_gift,'0') sku_weight_gift,
									ISNULL(sku.sku_weight_gift_unit,'') sku_weight_gift_unit,
									sku.sku_bosnet_id,
									sku.sku_is_hadiah,
									sku.sku_is_from_import,
									ISNULL(sku.sku_kode_sku_principle,'') sku_kode_sku_principle,
									sku.client_wms_id,
									client_wms.client_wms_nama,
									principle.principle_kode AS principle,
									principle_brand.principle_brand_nama AS brand,
									ISNULL(harga.sku_qty,1) sku_qty,
									ISNULL(harga.sku_with_tax,0) sku_with_tax,
									ISNULL(harga.sku_nominal_harga,0) sku_nominal_harga
									FROM sku
									LEFT JOIN sku_harga_detail harga
									ON harga.sku_id = sku.sku_id
									AND harga.sku_harga_id = '$sku_harga_id'
									LEFT JOIN client_wms
									ON client_wms.client_wms_id = sku.client_wms_id
									LEFT JOIN principle
									ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand
									ON principle_brand.principle_brand_id = sku.principle_brand_id
									WHERE sku.sku_id IN (" . $sku_id . ")
									GROUP BY sku.sku_id,
											sku.sku_kode,
											sku.sku_varian,
											sku.sku_induk_id,
											ISNULL(sku.sku_weight, '0'),
											ISNULL(sku.sku_weight_unit, ''),
											ISNULL(sku.sku_length, '0'),
											ISNULL(sku.sku_length_unit, ''),
											ISNULL(sku.sku_width, '0'),
											ISNULL(sku.sku_width_unit, ''),
											ISNULL(sku.sku_height, '0'),
											ISNULL(sku.sku_height_unit, ''),
											ISNULL(sku.sku_volume, '0'),
											ISNULL(sku.sku_volume_unit, ''),
											ISNULL(sku.sku_satuan, ''),
											ISNULL(sku.sku_kemasan, ''),
											sku.kemasan_id,
											sku.sku_harga_jual,
											sku.kategori1_id,
											sku.kategori2_id,
											sku.kategori3_id,
											sku.kategori4_id,
											sku.kategori5_id,
											sku.kategori6_id,
											sku.kategori7_id,
											sku.kategori8_id,
											sku.principle_id,
											sku.principle_brand_id,
											sku.sku_nama_produk,
											ISNULL(sku.sku_deskripsi, ''),
											ISNULL(sku.sku_origin, ''),
											ISNULL(sku.sku_kondisi, ''),
											ISNULL(sku.sku_sales_min_qty, '0'),
											ISNULL(sku.sku_ppnbm_persen, '0'),
											ISNULL(sku.sku_ppn_persen, '0'),
											ISNULL(sku.sku_pph, '0'),
											sku.sku_is_aktif,
											sku.sku_is_jual,
											sku.sku_is_paket,
											sku.sku_is_deleted,
											ISNULL(sku.sku_weight_netto, '0'),
											ISNULL(sku.sku_weight_netto_unit, ''),
											ISNULL(sku.sku_weight_product, '0'),
											ISNULL(sku.sku_weight_product_unit, ''),
											ISNULL(sku.sku_weight_packaging, '0'),
											ISNULL(sku.sku_weight_packaging_unit, ''),
											ISNULL(sku.sku_weight_gift, '0'),
											ISNULL(sku.sku_weight_gift_unit, ''),
											sku.sku_bosnet_id,
											sku.sku_is_hadiah,
											sku.sku_is_from_import,
											ISNULL(sku.sku_kode_sku_principle, ''),
											sku.client_wms_id,
											client_wms.client_wms_nama,
											principle.principle_kode,
											principle_brand.principle_brand_nama,
											harga.sku_qty,
											harga.sku_with_tax,
											harga.sku_nominal_harga
									ORDER BY client_wms.client_wms_nama, sku.sku_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function insert_sku_harga($sku_harga_id, $client_wms_id, $depo_id, $depo_group_nama, $sku_harga_kode, $sku_harga_keterangan, $sku_harga_startdate, $sku_harga_enddate, $sku_harga_status, $sku_harga_who_create, $sku_harga_tgl_create, $sku_harga_who_approve, $sku_harga_tgl_approve, $sku_harga_is_aktif, $sku_harga_is_delete, $sku_harga_id_before, $is_khusus)
	{
		// $tgl = $tgl . " " . date('H:i:s');

		$sku_harga_id =  $sku_harga_id ==  '' ? null : $sku_harga_id;
		$client_wms_id =  $client_wms_id ==  '' ? null : $client_wms_id;
		$depo_id =  $depo_id ==  '' ? null : $depo_id;
		$depo_group_nama =  $depo_group_nama ==  '' ? null : $depo_group_nama;
		$sku_harga_kode =  $sku_harga_kode ==  '' ? null : $sku_harga_kode;
		$sku_harga_keterangan =  $sku_harga_keterangan ==  '' ? null : $sku_harga_keterangan;
		$sku_harga_startdate =  $sku_harga_startdate ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_harga_startdate)));
		$sku_harga_enddate =  $sku_harga_enddate ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_harga_enddate)));
		$sku_harga_status =  $sku_harga_status ==  '' ? null : $sku_harga_status;
		$sku_harga_who_create =  $sku_harga_who_create ==  '' ? null : $sku_harga_who_create;
		$sku_harga_tgl_create =  $sku_harga_tgl_create ==  '' ? null : $sku_harga_tgl_create;
		$sku_harga_who_approve =  $sku_harga_who_approve ==  '' ? null : $sku_harga_who_approve;
		$sku_harga_tgl_approve =  $sku_harga_tgl_approve ==  '' ? null : $sku_harga_tgl_approve;
		$sku_harga_is_aktif =  $sku_harga_is_aktif ==  '' ? null : $sku_harga_is_aktif;
		$sku_harga_is_delete =  $sku_harga_is_delete ==  '' ? null : $sku_harga_is_delete;
		$sku_harga_id_before =  $sku_harga_id_before ==  '' ? null : $sku_harga_id_before;
		$is_khusus =  $is_khusus ==  '' ? null : $is_khusus;

		// $tgl_ = date_create(str_replace("/", "-", $tgl));
		$this->db->set('sku_harga_id', $sku_harga_id);
		$this->db->set('client_wms_id', $client_wms_id);
		// $this->db->set('depo_id', $depo_id);
		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		// $this->db->set('depo_group_nama', $depo_group_nama);
		$this->db->set('sku_harga_kode', $sku_harga_kode);
		$this->db->set('sku_harga_keterangan', $sku_harga_keterangan);
		$this->db->set('sku_harga_startdate', $sku_harga_startdate);
		$this->db->set('sku_harga_enddate', $sku_harga_enddate);
		$this->db->set('sku_harga_status', $sku_harga_status);
		$this->db->set('sku_harga_who_create', $sku_harga_who_create);
		$this->db->set('sku_harga_tgl_create', "GETDATE()", FALSE);
		// $this->db->set('sku_harga_who_approve', $sku_harga_who_approve);
		// $this->db->set('sku_harga_tgl_approve', $sku_harga_tgl_approve);
		$this->db->set('sku_harga_is_aktif', $sku_harga_is_aktif);
		$this->db->set('sku_harga_is_delete', $sku_harga_is_delete);
		$this->db->set('sku_harga_id_before', $sku_harga_id_before);
		$this->db->set('is_khusus', $is_khusus);

		$queryinsert = $this->db->insert("sku_harga");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_harga_detail($sku_harga_id, $sku_harga_detail_id, $data)
	{
		// $sku_harga_detail_id = $data['sku_harga_detail_id'] === "" ? null : $data['sku_harga_detail_id'];
		$sku_harga_id = $sku_harga_id === "" ? null : $sku_harga_id;
		$sku_id = $data['sku_id'] === "" ? null : $data['sku_id'];
		$sku_qty = $data['sku_qty'] === "" ? null : $data['sku_qty'];
		$sku_with_tax = $data['sku_with_tax'] === "" ? null : $data['sku_with_tax'];
		$sku_nominal_harga = $data['sku_nominal_harga'] === "" ? null : $data['sku_nominal_harga'];

		$this->db->set('sku_harga_detail_id', $sku_harga_detail_id);
		$this->db->set('sku_harga_id', $sku_harga_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('sku_qty', $sku_qty);
		$this->db->set('sku_with_tax', $sku_with_tax);
		$this->db->set('sku_nominal_harga', $sku_nominal_harga);

		$queryinsert = $this->db->insert("sku_harga_detail");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_promo_from_temp($sku_promo_id, $sku_promo_id_new)
	{
		$sku_promo_id =  $sku_promo_id ==  '' ? null : $sku_promo_id;
		$sku_promo_id_new =  $sku_promo_id_new ==  '' ? null : $sku_promo_id_new;

		$this->db->query("INSERT INTO sku_promo_detail1_temp 
							SELECT
								sku_promo_detail1_id,
								'$sku_promo_id_new' sku_promo_id,
								sku_promo_detail1_use_groupsku,
								sku_promo_detail1_jenis_groupsku,
								sku_promo_detail1_use_qty_order,
								sku_promo_detail1_use_value_order,
								sku_promo_detail1_min_order_sku,
								sku_promo_detail1_use_bonus,
								sku_promo_detail1_use_diskon
							FROM sku_promo_detail1 WHERE sku_promo_id = '$sku_promo_id' ");

		$this->db->query("INSERT INTO sku_promo_detail2_temp 
							SELECT 
							sku_promo_detail1_id,
							'$sku_promo_id_new' sku_promo_id,
							sku_id,
							kategori_grup,
							kategori_id,
							qty
							FROM sku_promo_detail2 WHERE sku_promo_id = '$sku_promo_id' ");

		$this->db->query("INSERT INTO sku_promo_detail2_diskon_temp
						 	SELECT a.*
							FROM sku_promo_detail2_diskon a
							LEFT JOIN sku_promo_detail2 b
							ON b.sku_promo_detail2_id = a.sku_promo_detail2_id
							WHERE b.sku_promo_id = '$sku_promo_id' ");

		$this->db->query("INSERT INTO sku_promo_detail2_bonus_temp 
							SELECT 
							sku_promo_detail2_bonus_id,
							sku_promo_detail2_id,
							sku_promo_detail1_id,
							'$sku_promo_id_new' sku_promo_id,
							sku_min_qty,
							is_berkelipatan,
							FROM sku_promo_detail2_bonus WHERE sku_promo_id = '$sku_promo_id' ");

		$queryinsert = $this->db->query("INSERT INTO sku_promo_detail2_bonus_detail_temp 
						SELECT 
						sku_promo_detail2_bonus2_id,
						sku_promo_detail2_bonus_id,
						sku_promo_detail2_id,
						sku_promo_detail1_id,
						sku_promo_id
						'$sku_promo_id_new' sku_promo_id,
						sku_tipe_id,
						referensi_diskon_id,
						sku_qty_bonus
						FROM sku_promo_detail2_bonus_detail WHERE sku_promo_id = '$sku_promo_id' ");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_promo($sku_promo_id, $depo_group_id, $depo_id, $client_wms_id, $sku_promo_kode, $sku_promo_tgl_berlaku_awal, $sku_promo_tgl_berlaku_akhir, $sku_promo_keterangan, $sku_promo_status, $sku_promo_tgl_create, $sku_promo_who_create, $is_khusus)
	{
		$sku_promo_id =  $sku_promo_id ==  '' ? null : $sku_promo_id;
		// $depo_group_id =  $depo_group_id ==  '' ? null : $depo_group_id;
		// $depo_id =  $depo_id ==  '' ? null : $depo_id;
		$client_wms_id =  $client_wms_id ==  '' ? null : $client_wms_id;
		$sku_promo_kode =  $sku_promo_kode ==  '' ? null : $sku_promo_kode;
		$sku_promo_tgl_berlaku_awal =  $sku_promo_tgl_berlaku_awal ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_promo_tgl_berlaku_awal)));
		$sku_promo_tgl_berlaku_akhir =  $sku_promo_tgl_berlaku_akhir ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_promo_tgl_berlaku_akhir)));
		$sku_promo_keterangan =  $sku_promo_keterangan ==  '' ? null : $sku_promo_keterangan;
		$sku_promo_status =  $sku_promo_status ==  '' ? null : $sku_promo_status;
		$sku_promo_tgl_create =  $sku_promo_tgl_create ==  '' ? null : $sku_promo_tgl_create;
		$sku_promo_who_create =  $sku_promo_who_create ==  '' ? null : $sku_promo_who_create;
		$is_khusus =  $is_khusus ==  '' ? null : $is_khusus;

		// $tgl_ = date_create(str_replace("/", "-", $tgl));
		$depo_id = $this->session->userdata("depo_id");

		$this->db->set('sku_promo_id', $sku_promo_id);
		// $this->db->set('depo_group_id', $depo_group_id);
		$this->db->set('depo_id', $depo_id);
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('sku_promo_kode', $sku_promo_kode);
		$this->db->set('sku_promo_tgl_berlaku_awal', $sku_promo_tgl_berlaku_awal);
		$this->db->set('sku_promo_tgl_berlaku_akhir', $sku_promo_tgl_berlaku_akhir);
		$this->db->set('sku_promo_keterangan', $sku_promo_keterangan);
		$this->db->set('sku_promo_status', $sku_promo_status);
		$this->db->set('sku_promo_tgl_create', "GETDATE()", FALSE);
		$this->db->set('sku_promo_who_create', $sku_promo_who_create);
		$this->db->set('is_khusus', $is_khusus);

		$this->db->insert("sku_promo");

		$this->db->query("INSERT INTO sku_promo_detail1 SELECT * FROM sku_promo_detail1_temp WHERE sku_promo_id = '$sku_promo_id' ");
		$this->db->query("INSERT INTO sku_promo_detail2 SELECT * FROM sku_promo_detail2_temp WHERE sku_promo_id = '$sku_promo_id' ");
		$this->db->query("INSERT INTO sku_promo_detail2_diskon
						 	SELECT a.*
							FROM sku_promo_detail2_diskon_temp a
							LEFT JOIN sku_promo_detail2_temp b
							ON b.sku_promo_detail2_id = a.sku_promo_detail2_id
							WHERE b.sku_promo_id = '$sku_promo_id' ");
		$this->db->query("INSERT INTO sku_promo_detail2_bonus SELECT * FROM sku_promo_detail2_bonus_temp WHERE sku_promo_id = '$sku_promo_id' ");
		$queryinsert = $this->db->query("INSERT INTO sku_promo_detail2_bonus_detail SELECT * FROM sku_promo_detail2_bonus_detail_temp WHERE sku_promo_id = '$sku_promo_id' ");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_promo_temp($sku_promo_id, $depo_group_id, $depo_id, $client_wms_id, $sku_promo_kode, $sku_promo_tgl_berlaku_awal, $sku_promo_tgl_berlaku_akhir, $sku_promo_keterangan, $sku_promo_status, $sku_promo_tgl_create, $sku_promo_who_create, $is_khusus)
	{
		$sku_promo_id =  $sku_promo_id ==  '' ? null : $sku_promo_id;
		// $depo_group_id =  $depo_group_id ==  '' ? null : $depo_group_id;
		// $depo_id =  $depo_id ==  '' ? null : $depo_id;
		$client_wms_id =  $client_wms_id ==  '' ? null : $client_wms_id;
		$sku_promo_kode =  $sku_promo_kode ==  '' ? null : $sku_promo_kode;
		$sku_promo_tgl_berlaku_awal =  $sku_promo_tgl_berlaku_awal ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_promo_tgl_berlaku_awal)));
		$sku_promo_tgl_berlaku_akhir =  $sku_promo_tgl_berlaku_akhir ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_promo_tgl_berlaku_akhir)));
		$sku_promo_keterangan =  $sku_promo_keterangan ==  '' ? null : $sku_promo_keterangan;
		$sku_promo_status =  $sku_promo_status ==  '' ? null : $sku_promo_status;
		$sku_promo_tgl_create =  $sku_promo_tgl_create ==  '' ? null : $sku_promo_tgl_create;
		$sku_promo_who_create =  $sku_promo_who_create ==  '' ? null : $sku_promo_who_create;
		$is_khusus =  $is_khusus ==  '' ? null : $is_khusus;

		// $tgl_ = date_create(str_replace("/", "-", $tgl));
		$depo_id = $this->session->userdata("depo_id");

		$this->db->set('sku_promo_id', $sku_promo_id);
		// $this->db->set('depo_group_id', $depo_group_id);
		$this->db->set('depo_id', $depo_id);
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('sku_promo_kode', $sku_promo_kode);
		$this->db->set('sku_promo_tgl_berlaku_awal', $sku_promo_tgl_berlaku_awal);
		$this->db->set('sku_promo_tgl_berlaku_akhir', $sku_promo_tgl_berlaku_akhir);
		$this->db->set('sku_promo_keterangan', $sku_promo_keterangan);
		$this->db->set('sku_promo_status', $sku_promo_status);
		$this->db->set('sku_promo_tgl_create', "GETDATE()", FALSE);
		$this->db->set('sku_promo_who_create', $sku_promo_who_create);
		$this->db->set('is_khusus', $is_khusus);

		$queryinsert = $this->db->insert("sku_promo_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sku_promo_temp($sku_promo_id, $depo_group_id, $depo_id, $client_wms_id, $sku_promo_kode, $sku_promo_tgl_berlaku_awal, $sku_promo_tgl_berlaku_akhir, $sku_promo_keterangan, $sku_promo_status, $sku_promo_tgl_create, $sku_promo_who_create, $is_khusus)
	{
		$sku_promo_id =  $sku_promo_id ==  '' ? null : $sku_promo_id;
		// $depo_group_id =  $depo_group_id ==  '' ? null : $depo_group_id;
		// $depo_id =  $depo_id ==  '' ? null : $depo_id;
		$client_wms_id =  $client_wms_id ==  '' ? null : $client_wms_id;
		$sku_promo_kode =  $sku_promo_kode ==  '' ? null : $sku_promo_kode;
		$sku_promo_tgl_berlaku_awal =  $sku_promo_tgl_berlaku_awal ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_promo_tgl_berlaku_awal)));
		$sku_promo_tgl_berlaku_akhir =  $sku_promo_tgl_berlaku_akhir ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_promo_tgl_berlaku_akhir)));
		$sku_promo_keterangan =  $sku_promo_keterangan ==  '' ? null : $sku_promo_keterangan;
		$sku_promo_status =  $sku_promo_status ==  '' ? null : $sku_promo_status;
		$sku_promo_tgl_create =  $sku_promo_tgl_create ==  '' ? null : $sku_promo_tgl_create;
		$sku_promo_who_create =  $sku_promo_who_create ==  '' ? null : $sku_promo_who_create;
		$is_khusus =  $is_khusus ==  '' ? null : $is_khusus;

		// $tgl_ = date_create(str_replace("/", "-", $tgl));

		// $this->db->set('depo_group_id', $depo_group_id);
		// $this->db->set('depo_id', $depo_id);
		$this->db->set('client_wms_id', $client_wms_id);
		// $this->db->set('sku_promo_kode', $sku_promo_kode);
		$this->db->set('sku_promo_tgl_berlaku_awal', $sku_promo_tgl_berlaku_awal);
		$this->db->set('sku_promo_tgl_berlaku_akhir', $sku_promo_tgl_berlaku_akhir);
		$this->db->set('sku_promo_keterangan', $sku_promo_keterangan);
		$this->db->set('sku_promo_status', $sku_promo_status);
		$this->db->set('is_khusus', $is_khusus);
		$this->db->set('sku_promo_tgl_update', "GETDATE()", FALSE);
		$this->db->set('sku_promo_who_update', $sku_promo_who_create);

		$this->db->where('sku_promo_id', $sku_promo_id);

		$queryupdate = $this->db->update("sku_promo_temp");

		return $queryupdate;
		// return $this->db->last_query();
	}

	public function duplicate_sku_promo_temp($sku_promo_id, $depo_group_id, $depo_id, $client_wms_id, $sku_promo_kode, $sku_promo_tgl_berlaku_awal, $sku_promo_tgl_berlaku_akhir, $sku_promo_keterangan, $sku_promo_status, $sku_promo_tgl_create, $sku_promo_who_create, $is_khusus)
	{
		$sku_promo_id =  $sku_promo_id ==  '' ? null : $sku_promo_id;
		// $depo_group_id =  $depo_group_id ==  '' ? null : $depo_group_id;
		// $depo_id =  $depo_id ==  '' ? null : $depo_id;
		$client_wms_id =  $client_wms_id ==  '' ? null : $client_wms_id;
		$sku_promo_kode =  $sku_promo_kode ==  '' ? null : $sku_promo_kode;
		$sku_promo_tgl_berlaku_awal =  $sku_promo_tgl_berlaku_awal ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_promo_tgl_berlaku_awal)));
		$sku_promo_tgl_berlaku_akhir =  $sku_promo_tgl_berlaku_akhir ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_promo_tgl_berlaku_akhir)));
		$sku_promo_keterangan =  $sku_promo_keterangan ==  '' ? null : $sku_promo_keterangan;
		$sku_promo_status =  $sku_promo_status ==  '' ? null : $sku_promo_status;
		$sku_promo_tgl_create =  $sku_promo_tgl_create ==  '' ? null : $sku_promo_tgl_create;
		$sku_promo_who_create =  $sku_promo_who_create ==  '' ? null : $sku_promo_who_create;
		$is_khusus =  $is_khusus ==  '' ? null : $is_khusus;

		// $tgl_ = date_create(str_replace("/", "-", $tgl));

		// $this->db->set('depo_group_id', $depo_group_id);
		// $this->db->set('depo_id', $depo_id);
		$this->db->set('client_wms_id', $client_wms_id);
		// $this->db->set('sku_promo_kode', $sku_promo_kode);
		$this->db->set('sku_promo_tgl_berlaku_awal', $sku_promo_tgl_berlaku_awal);
		$this->db->set('sku_promo_tgl_berlaku_akhir', $sku_promo_tgl_berlaku_akhir);
		$this->db->set('sku_promo_keterangan', $sku_promo_keterangan);
		$this->db->set('sku_promo_status', $sku_promo_status);
		$this->db->set('is_khusus', $is_khusus);
		$this->db->set('sku_promo_tgl_create', "GETDATE()", FALSE);
		$this->db->set('sku_promo_who_create', $sku_promo_who_create);
		$this->db->set('sku_promo_tgl_update', "GETDATE()", FALSE);
		$this->db->set('sku_promo_who_update', $sku_promo_who_create);

		$this->db->where('sku_promo_id', $sku_promo_id);

		$queryupdate = $this->db->update("sku_promo_temp");

		return $queryupdate;
		// return $this->db->last_query();
	}

	public function insert_sku_promo_lokasi($sku_promo_kode, $depo_group_nama, $depo_id)
	{
		$sku_promo_kode =  $sku_promo_kode ==  ' ' ? null : $sku_promo_kode;
		$depo_group_nama =  $depo_group_nama ==  '' ? null : $depo_group_nama;
		$depo_id =  $depo_id ==  '' ? null : $depo_id;

		$this->db->set('sku_promo_lokasi_id', "NEWID()", FALSE);
		$this->db->set('sku_promo_id', $sku_promo_kode);
		$this->db->set('depo_group_nama', $depo_group_nama);
		$this->db->set('depo_id', $depo_id);

		$queryinsert = $this->db->insert("sku_promo_lokasi_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_harga_lokasi($sku_promo_kode, $depo_group_nama, $depo_id)
	{
		$sku_promo_kode =  $sku_promo_kode ==  ' ' ? null : $sku_promo_kode;
		$depo_group_nama =  $depo_group_nama ==  '' ? null : $depo_group_nama;
		$depo_id =  $depo_id ==  '' ? null : $depo_id;

		$this->db->set('sku_harga_lokasi_id', "NEWID()", FALSE);
		$this->db->set('sku_harga_id', $sku_promo_kode);
		$this->db->set('depo_group_nama', $depo_group_nama);
		$this->db->set('depo_id', $depo_id);

		$queryinsert = $this->db->insert("sku_harga_lokasi");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_harga_segmen($sku_harga_segmen_id, $sku_harga_id, $client_pt_segmen_id)
	{
		$sku_harga_segmen_id =  $sku_harga_segmen_id ==  ' ' ? null : $sku_harga_segmen_id;
		$sku_harga_id =  $sku_harga_id ==  '' ? null : $sku_harga_id;
		$client_pt_segmen_id =  $client_pt_segmen_id ==  '' ? null : $client_pt_segmen_id;

		$this->db->set('sku_harga_segmen_id', $sku_harga_segmen_id);
		$this->db->set('sku_harga_id', $sku_harga_id);
		$this->db->set('client_pt_segmen_id', $client_pt_segmen_id);

		$queryinsert = $this->db->insert("sku_harga_segmen");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_harga_segmen_detail($sku_harga_segmen_detail_id, $sku_harga_segmen_id, $sku_harga_id, $client_pt_id)
	{
		$sku_harga_segmen_detail_id =  $sku_harga_segmen_detail_id ==  ' ' ? null : $sku_harga_segmen_detail_id;
		$sku_harga_segmen_id =  $sku_harga_segmen_id ==  ' ' ? null : $sku_harga_segmen_id;
		$sku_harga_id =  $sku_harga_id ==  '' ? null : $sku_harga_id;
		$client_pt_id =  $client_pt_id ==  '' ? null : $client_pt_id;

		$this->db->set('sku_harga_segmen_detail_id', $sku_harga_segmen_detail_id);
		$this->db->set('sku_harga_segmen_id', $sku_harga_segmen_id);
		$this->db->set('sku_harga_id', $sku_harga_id);
		$this->db->set('client_pt_id', $client_pt_id);

		$queryinsert = $this->db->insert("sku_harga_segmen_detail");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_promo_segmen($sku_promo_segmen_id, $sku_promo_id, $client_pt_segmen_id)
	{
		$sku_promo_segmen_id =  $sku_promo_segmen_id ==  ' ' ? null : $sku_promo_segmen_id;
		$sku_promo_id =  $sku_promo_id ==  '' ? null : $sku_promo_id;
		$client_pt_segmen_id =  $client_pt_segmen_id ==  '' ? null : $client_pt_segmen_id;

		$this->db->set('sku_promo_segmen_id', $sku_promo_segmen_id);
		$this->db->set('sku_promo_id', $sku_promo_id);
		$this->db->set('client_pt_segmen_id', $client_pt_segmen_id);

		$queryinsert = $this->db->insert("sku_promo_segmen_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_promo_segmen_detail($sku_promo_segmen_detail_id, $sku_promo_segmen_id, $sku_promo_id, $client_pt_id)
	{
		$sku_promo_segmen_detail_id =  $sku_promo_segmen_detail_id ==  ' ' ? null : $sku_promo_segmen_detail_id;
		$sku_promo_segmen_id =  $sku_promo_segmen_id ==  ' ' ? null : $sku_promo_segmen_id;
		$sku_promo_id =  $sku_promo_id ==  '' ? null : $sku_promo_id;
		$client_pt_id =  $client_pt_id ==  '' ? null : $client_pt_id;

		$this->db->set('sku_promo_segmen_detail_id', $sku_promo_segmen_detail_id);
		$this->db->set('sku_promo_segmen_id', $sku_promo_segmen_id);
		$this->db->set('sku_promo_id', $sku_promo_id);
		$this->db->set('client_pt_id', $client_pt_id);

		$queryinsert = $this->db->insert("sku_promo_segmen_detail_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_promo_detail1_temp($sku_promo_detail1_id, $sku_promo_id, $principle_id, $sku_promo_detail1_use_groupsku, $sku_promo_detail1_jenis_groupsku, $sku_promo_detail1_use_qty_order, $sku_promo_detail1_use_value_order, $sku_promo_detail1_min_order_sku, $sku_promo_detail1_use_bonus, $sku_promo_detail1_use_diskon, $sku_promo_detail1_nourut)
	{
		$sku_promo_detail1_id = $sku_promo_detail1_id === "" ? null : $sku_promo_detail1_id;
		$sku_promo_id = $sku_promo_id === "" ? null : $sku_promo_id;
		$principle_id = $principle_id === "" ? null : $principle_id;
		$sku_promo_detail1_use_groupsku = $sku_promo_detail1_use_groupsku === "" ? null : $sku_promo_detail1_use_groupsku;
		$sku_promo_detail1_jenis_groupsku = $sku_promo_detail1_jenis_groupsku === "" ? null : $sku_promo_detail1_jenis_groupsku;
		$sku_promo_detail1_use_qty_order = $sku_promo_detail1_use_qty_order === "" ? null : $sku_promo_detail1_use_qty_order;
		$sku_promo_detail1_use_value_order = $sku_promo_detail1_use_value_order === "" ? null : $sku_promo_detail1_use_value_order;
		$sku_promo_detail1_min_order_sku = $sku_promo_detail1_min_order_sku === "" ? null : $sku_promo_detail1_min_order_sku;
		$sku_promo_detail1_use_bonus = $sku_promo_detail1_use_bonus === "" ? null : $sku_promo_detail1_use_bonus;
		$sku_promo_detail1_use_diskon = $sku_promo_detail1_use_diskon === "" ? null : $sku_promo_detail1_use_diskon;
		$sku_promo_detail1_nourut = $sku_promo_detail1_nourut === "" ? null : $sku_promo_detail1_nourut;

		$this->db->set('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->set('sku_promo_id', $sku_promo_id);
		$this->db->set('principle_id', $principle_id);
		$this->db->set('sku_promo_detail1_use_groupsku', $sku_promo_detail1_use_groupsku);
		$this->db->set('sku_promo_detail1_jenis_groupsku', $sku_promo_detail1_jenis_groupsku);
		$this->db->set('sku_promo_detail1_use_qty_order', $sku_promo_detail1_use_qty_order);
		$this->db->set('sku_promo_detail1_use_value_order', $sku_promo_detail1_use_value_order);
		$this->db->set('sku_promo_detail1_min_order_sku', $sku_promo_detail1_min_order_sku);
		$this->db->set('sku_promo_detail1_use_bonus', $sku_promo_detail1_use_bonus);
		$this->db->set('sku_promo_detail1_use_diskon', $sku_promo_detail1_use_diskon);
		$this->db->set('sku_promo_detail1_nourut', $sku_promo_detail1_nourut);

		$queryinsert = $this->db->insert("sku_promo_detail1_temp");

		// return $queryinsert;
		return $this->db->last_query();
	}

	public function insert_sku_promo_detail2_temp($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_id, $kategori_grup, $kategori_id, $qty)
	{
		$sku_promo_detail2_id = $sku_promo_detail2_id === "" ? null : $sku_promo_detail2_id;
		$sku_promo_detail1_id = $sku_promo_detail1_id === "" ? null : $sku_promo_detail1_id;
		$sku_promo_id = $sku_promo_id === "" ? null : $sku_promo_id;
		$sku_id = $sku_id === "" ? null : $sku_id;
		$kategori_grup = $kategori_grup === "" ? null : $kategori_grup;
		$kategori_id = $kategori_id === "" ? null : $kategori_id;
		$qty = $qty === "" ? null : $qty;

		$this->db->set('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->set('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->set('sku_promo_id', $sku_promo_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('kategori_grup', $kategori_grup);
		$this->db->set('kategori_id', $kategori_id);
		$this->db->set('qty', $qty);

		$queryinsert = $this->db->insert("sku_promo_detail2_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sku_promo_detail2_temp_detail1_id($sku_promo_detail1_id, $sku_promo_detail1_id_new)
	{

		$this->db->set('sku_promo_detail1_id', $sku_promo_detail1_id_new);

		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);

		$queryinsert = $this->db->update("sku_promo_detail2_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_min_qty, $is_berkelipatan, $sku_promo_detail2_bonus_nourut, $dasar_jumlah_order)
	{
		$sku_promo_detail2_bonus_id = $sku_promo_detail2_bonus_id === "" ? null : $sku_promo_detail2_bonus_id;
		$sku_promo_detail2_id = $sku_promo_detail2_id === "" ? null : $sku_promo_detail2_id;
		$sku_promo_detail1_id = $sku_promo_detail1_id === "" ? null : $sku_promo_detail1_id;
		$sku_promo_id = $sku_promo_id === "" ? null : $sku_promo_id;
		$sku_min_qty = $sku_min_qty === "" ? null : $sku_min_qty;
		$is_berkelipatan = $is_berkelipatan === "" ? null : $is_berkelipatan;
		$sku_promo_detail2_bonus_nourut = $sku_promo_detail2_bonus_nourut === "" ? null : $sku_promo_detail2_bonus_nourut;

		if ($dasar_jumlah_order == 'value order') {
			$this->db->set("sku_min_value", $sku_min_qty);
		} else {
			$this->db->set("sku_min_qty", $sku_min_qty);
		}

		$this->db->set('sku_promo_detail2_bonus_id', $sku_promo_detail2_bonus_id);
		$this->db->set('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->set('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->set('sku_promo_id', $sku_promo_id);
		// $this->db->set('sku_min_qty', $sku_min_qty);
		$this->db->set('is_berkelipatan', $is_berkelipatan);
		$this->db->set('sku_promo_detail2_bonus_nourut', $sku_promo_detail2_bonus_nourut);

		$queryinsert = $this->db->insert("sku_promo_detail2_bonus_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sku_promo_detail2_bonus_temp_detail2_id($sku_promo_detail2_id, $sku_promo_detail2_id_new)
	{
		$this->db->set('sku_promo_detail2_id', $sku_promo_detail2_id_new);

		$this->db->where('sku_promo_detail2_id', $sku_promo_detail2_id);

		$queryinsert = $this->db->update("sku_promo_detail2_bonus_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_promo_detail2_diskon_temp($sku_promo_detail2_diskon_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_qty_diskon, $tipe_diskon_id, $value_diskon, $referensi_diskon_id, $is_hitung_diskon, $sku_promo_detail2_diskon_nourut)
	{
		$sku_promo_detail2_diskon_id = $sku_promo_detail2_diskon_id === "" ? null : $sku_promo_detail2_diskon_id;
		$sku_promo_detail2_id = $sku_promo_detail2_id === "" ? null : $sku_promo_detail2_id;
		$sku_promo_detail1_id = $sku_promo_detail1_id === "" ? null : $sku_promo_detail1_id;
		$sku_promo_id = $sku_promo_id === "" ? null : $sku_promo_id;
		$sku_qty_diskon = $sku_qty_diskon === "" ? null : $sku_qty_diskon;
		$tipe_diskon_id = $tipe_diskon_id === "" ? null : $tipe_diskon_id;
		$value_diskon = $value_diskon === "" ? null : $value_diskon;
		$referensi_diskon_id = $referensi_diskon_id === "" ? null : $referensi_diskon_id;
		$is_hitung_diskon = $is_hitung_diskon === "" ? null : $is_hitung_diskon;
		$sku_promo_detail2_diskon_nourut = $sku_promo_detail2_diskon_nourut === "" ? null : $sku_promo_detail2_diskon_nourut;

		$this->db->set('sku_promo_detail2_diskon_id', $sku_promo_detail2_diskon_id);
		$this->db->set('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->set('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->set('sku_promo_id', $sku_promo_id);
		$this->db->set('sku_qty_diskon', $sku_qty_diskon);
		$this->db->set('tipe_diskon_id', $tipe_diskon_id);
		$this->db->set('value_diskon', $value_diskon);
		$this->db->set('referensi_diskon_id', $referensi_diskon_id);
		$this->db->set('is_hitung_diskon', $is_hitung_diskon);
		$this->db->set('sku_promo_detail2_diskon_nourut', $sku_promo_detail2_diskon_nourut);

		$queryinsert = $this->db->insert("sku_promo_detail2_diskon_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sku_promo_detail2_diskon_temp_detail2_id($sku_promo_detail2_id, $sku_promo_detail2_id_new)
	{
		$this->db->set('sku_promo_detail2_id', $sku_promo_detail2_id_new);
		$this->db->where('sku_promo_detail2_id', $sku_promo_detail2_id);

		$queryinsert = $this->db->update("sku_promo_detail2_diskon_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_promo_detail2_bonus_detail_temp($sku_promo_detail2_bonus2_id, $sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_id, $sku_tipe_id, $referensi_diskon_id, $sku_qty_bonus)
	{
		$sku_promo_detail2_bonus2_id = $sku_promo_detail2_bonus2_id === "" ? null : $sku_promo_detail2_bonus2_id;
		$sku_promo_detail2_bonus_id = $sku_promo_detail2_bonus_id === "" ? null : $sku_promo_detail2_bonus_id;
		$sku_promo_detail2_id = $sku_promo_detail2_id === "" ? null : $sku_promo_detail2_id;
		$sku_promo_detail1_id = $sku_promo_detail1_id === "" ? null : $sku_promo_detail1_id;
		$sku_promo_id = $sku_promo_id === "" ? null : $sku_promo_id;
		$sku_id = $sku_id === "" ? null : $sku_id;
		$sku_tipe_id = $sku_tipe_id === "" ? null : $sku_tipe_id;
		$referensi_diskon_id = $referensi_diskon_id === "" ? null : $referensi_diskon_id;
		$sku_qty_bonus = $sku_qty_bonus === "" ? null : $sku_qty_bonus;

		$this->db->set('sku_promo_detail2_bonus2_id', $sku_promo_detail2_bonus2_id);
		$this->db->set("sku_promo_detail2_bonus_id", $sku_promo_detail2_bonus_id);
		$this->db->set("sku_promo_detail2_id", $sku_promo_detail2_id);
		$this->db->set("sku_promo_detail1_id", $sku_promo_detail1_id);
		$this->db->set("sku_promo_id", $sku_promo_id);
		$this->db->set("sku_id", $sku_id);
		$this->db->set("sku_tipe_id", $sku_tipe_id);
		$this->db->set("referensi_diskon_id", $referensi_diskon_id);
		$this->db->set("sku_qty_bonus", $sku_qty_bonus);

		$queryinsert = $this->db->insert("sku_promo_detail2_bonus_detail_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sku_promo_detail2_bonus_detail_temp_bonus_id($sku_promo_detail2_bonus_id, $sku_promo_detail2_bonus_id_new)
	{
		$this->db->set('sku_promo_detail2_bonus_id', $sku_promo_detail2_bonus_id_new);
		$this->db->where("sku_promo_detail2_bonus_id", $sku_promo_detail2_bonus_id);

		$queryinsert = $this->db->update("sku_promo_detail2_bonus_detail_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_promo_detail2_sku_temp($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_id, $is_pengecualian)
	{
		$sku_promo_detail2_id = $sku_promo_detail2_id === "" ? null : $sku_promo_detail2_id;
		$sku_promo_detail1_id = $sku_promo_detail1_id === "" ? null : $sku_promo_detail1_id;
		$sku_promo_id = $sku_promo_id === "" ? null : $sku_promo_id;
		$sku_id = $sku_id === "" ? null : $sku_id;
		$is_pengecualian = $is_pengecualian === "" ? null : $is_pengecualian;

		$this->db->set('sku_promo_detail2_sku_id', "NEWID()", FALSE);
		$this->db->set('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->set('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->set('sku_promo_id', $sku_promo_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('is_pengecualian', $is_pengecualian);

		$queryinsert = $this->db->insert("sku_promo_detail2_sku_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_min_qty, $is_berkelipatan, $sku_promo_detail2_bonus_nourut, $dasarJumlahOrder)
	{
		$sku_promo_detail2_bonus_id = $sku_promo_detail2_bonus_id === "" ? null : $sku_promo_detail2_bonus_id;
		$sku_promo_detail2_id = $sku_promo_detail2_id === "" ? null : $sku_promo_detail2_id;
		$sku_promo_detail1_id = $sku_promo_detail1_id === "" ? null : $sku_promo_detail1_id;
		$sku_promo_id = $sku_promo_id === "" ? null : $sku_promo_id;
		$sku_min_qty = $sku_min_qty === "" ? null : $sku_min_qty;
		$is_berkelipatan = $is_berkelipatan === "" ? null : $is_berkelipatan;
		$sku_promo_detail2_bonus_nourut = $sku_promo_detail2_bonus_nourut === "" ? null : $sku_promo_detail2_bonus_nourut;

		if ($dasarJumlahOrder == 'value order') {
			$this->db->set("sku_min_value", $sku_min_qty);
			$this->db->set("sku_min_qty", null);
		} else {
			$this->db->set("sku_min_qty", $sku_min_qty);
			$this->db->set("sku_min_value", null);
		}

		$this->db->set("is_berkelipatan", $is_berkelipatan);
		$this->db->set("sku_promo_detail2_bonus_nourut", $sku_promo_detail2_bonus_nourut);

		$this->db->where("sku_promo_detail2_bonus_id", $sku_promo_detail2_bonus_id);
		$this->db->where("sku_promo_detail2_id", $sku_promo_detail2_id);
		$this->db->where("sku_promo_detail1_id", $sku_promo_detail1_id);
		$this->db->where("sku_promo_id", $sku_promo_id);

		$queryinsert = $this->db->update("sku_promo_detail2_bonus_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sku_promo_detail2_diskon_temp($sku_promo_detail2_diskon_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_qty_diskon, $tipe_diskon_id, $value_diskon, $referensi_diskon_id, $is_hitung_diskon, $sku_promo_detail2_diskon_nourut)
	{
		$sku_promo_detail2_diskon_id = $sku_promo_detail2_diskon_id === "" ? null : $sku_promo_detail2_diskon_id;
		$sku_promo_detail2_id = $sku_promo_detail2_id === "" ? null : $sku_promo_detail2_id;
		$sku_promo_detail1_id = $sku_promo_detail1_id === "" ? null : $sku_promo_detail1_id;
		$sku_qty_diskon = $sku_qty_diskon === "" ? null : $sku_qty_diskon;
		$tipe_diskon_id = $tipe_diskon_id === "" ? null : $tipe_diskon_id;
		$value_diskon = $value_diskon === "" ? null : $value_diskon;
		$referensi_diskon_id = $referensi_diskon_id === "" ? null : $referensi_diskon_id;
		$is_hitung_diskon = $is_hitung_diskon === "" ? null : $is_hitung_diskon;
		$sku_promo_detail2_diskon_nourut = $sku_promo_detail2_diskon_nourut === "" ? null : $sku_promo_detail2_diskon_nourut;

		if ($tipe_diskon_id == "4BF2022B-6A53-4B81-81D1-1EFA6934C52B") {
			$this->db->set('value_diskon', $value_diskon);
		} else {
			$this->db->set('value_rupiah', $value_diskon);
		}

		$this->db->set('sku_qty_diskon', $sku_qty_diskon);
		$this->db->set('tipe_diskon_id', $tipe_diskon_id);
		$this->db->set('referensi_diskon_id', $referensi_diskon_id);
		$this->db->set('is_hitung_diskon', $is_hitung_diskon);
		$this->db->set('sku_promo_detail2_diskon_nourut', $sku_promo_detail2_diskon_nourut);

		$this->db->where('sku_promo_detail2_diskon_id', $sku_promo_detail2_diskon_id);
		$this->db->where('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);

		$queryinsert = $this->db->update("sku_promo_detail2_diskon_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sku_promo_detail2_bonus_detail_temp($sku_promo_detail2_bonus2_id, $sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_id, $sku_qty_bonus, $sku_tipe_id, $referensi_diskon_id)
	{
		$sku_promo_detail2_bonus_id = $sku_promo_detail2_bonus_id === "" ? null : $sku_promo_detail2_bonus_id;
		$sku_promo_detail2_id = $sku_promo_detail2_id === "" ? null : $sku_promo_detail2_id;
		$sku_promo_detail1_id = $sku_promo_detail1_id === "" ? null : $sku_promo_detail1_id;
		$sku_promo_id = $sku_promo_id === "" ? null : $sku_promo_id;
		$sku_id = $sku_id === "" ? null : $sku_id;
		$sku_qty_bonus = $sku_qty_bonus === "" ? null : $sku_qty_bonus;
		$sku_tipe_id = $sku_tipe_id === "" ? null : $sku_tipe_id;
		$referensi_diskon_id = $referensi_diskon_id === "" ? null : $referensi_diskon_id;

		$this->db->set("sku_id", $sku_id);
		$this->db->set("sku_qty_bonus", $sku_qty_bonus);
		$this->db->set("sku_tipe_id", $sku_tipe_id);
		$this->db->set("referensi_diskon_id", $referensi_diskon_id);

		$this->db->where('sku_promo_detail2_bonus2_id', $sku_promo_detail2_bonus2_id);
		$this->db->where("sku_promo_detail2_bonus_id", $sku_promo_detail2_bonus_id);
		$this->db->where("sku_promo_detail2_id", $sku_promo_detail2_id);
		$this->db->where("sku_promo_detail1_id", $sku_promo_detail1_id);
		$this->db->where("sku_promo_id", $sku_promo_id);

		$queryinsert = $this->db->update("sku_promo_detail2_bonus_detail_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sku_promo_detail2_temp($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $kategori_id, $qty)
	{
		$sku_promo_detail2_id = $sku_promo_detail2_id === "" ? null : $sku_promo_detail2_id;
		$sku_promo_detail1_id = $sku_promo_detail1_id === "" ? null : $sku_promo_detail1_id;
		$sku_promo_id = $sku_promo_id === "" ? null : $sku_promo_id;
		$kategori_id = $kategori_id === "" ? null : $kategori_id;
		$qty = $qty === "" ? null : $qty;

		$this->db->set("kategori_id", $kategori_id);
		$this->db->set("qty", $qty);

		$this->db->where("sku_promo_detail2_id", $sku_promo_detail2_id);
		$this->db->where("sku_promo_detail1_id", $sku_promo_detail1_id);
		$this->db->where("sku_promo_id", $sku_promo_id);

		$queryinsert = $this->db->update("sku_promo_detail2_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sku_promo_detail_temp($sku_promo_detail1_id, $sku_promo_id, $principle_id, $sku_promo_detail1_use_groupsku, $sku_promo_detail1_jenis_groupsku, $sku_promo_detail1_use_qty_order, $sku_promo_detail1_use_value_order, $sku_promo_detail1_min_order_sku, $sku_promo_detail1_use_bonus, $sku_promo_detail1_use_diskon, $sku_promo_detail1_nourut)
	{
		$sku_promo_detail1_id = $sku_promo_detail1_id === "" ? null : $sku_promo_detail1_id;
		$sku_promo_id = $sku_promo_id === "" ? null : $sku_promo_id;
		$principle_id = $principle_id === "" ? null : $principle_id;
		$sku_promo_detail1_use_groupsku = $sku_promo_detail1_use_groupsku === "" ? null : $sku_promo_detail1_use_groupsku;
		$sku_promo_detail1_jenis_groupsku = $sku_promo_detail1_jenis_groupsku === "" ? null : $sku_promo_detail1_jenis_groupsku;
		$sku_promo_detail1_use_qty_order = $sku_promo_detail1_use_qty_order === "" ? null : $sku_promo_detail1_use_qty_order;
		$sku_promo_detail1_use_value_order = $sku_promo_detail1_use_value_order === "" ? null : $sku_promo_detail1_use_value_order;
		$sku_promo_detail1_min_order_sku = $sku_promo_detail1_min_order_sku === "" ? null : $sku_promo_detail1_min_order_sku;
		$sku_promo_detail1_use_bonus = $sku_promo_detail1_use_bonus === "" ? null : $sku_promo_detail1_use_bonus;
		$sku_promo_detail1_use_diskon = $sku_promo_detail1_use_diskon === "" ? null : $sku_promo_detail1_use_diskon;
		$sku_promo_detail1_nourut = $sku_promo_detail1_nourut === "" ? null : $sku_promo_detail1_nourut;

		$this->db->set("principle_id", $principle_id);
		$this->db->set("sku_promo_detail1_use_groupsku", $sku_promo_detail1_use_groupsku);
		$this->db->set("sku_promo_detail1_jenis_groupsku", $sku_promo_detail1_jenis_groupsku);
		$this->db->set("sku_promo_detail1_use_qty_order", $sku_promo_detail1_use_qty_order);
		$this->db->set("sku_promo_detail1_use_value_order", $sku_promo_detail1_use_value_order);
		$this->db->set("sku_promo_detail1_min_order_sku", $sku_promo_detail1_min_order_sku);
		$this->db->set("sku_promo_detail1_use_bonus", $sku_promo_detail1_use_bonus);
		$this->db->set("sku_promo_detail1_use_diskon", $sku_promo_detail1_use_diskon);
		$this->db->set("sku_promo_detail1_nourut", $sku_promo_detail1_nourut);

		$this->db->where("sku_promo_detail1_id", $sku_promo_detail1_id);
		$this->db->where("sku_promo_id", $sku_promo_id);

		$queryinsert = $this->db->update("sku_promo_detail1_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_detail_temp($sku_promo_id, $sku_promo_detail1_id)
	{
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_bonus_detail_temp");

		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_bonus_temp");

		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->delete("sku_promo_detail2_diskon_temp");

		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_sku_temp");

		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_temp");

		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);
		$querydelete = $this->db->delete("sku_promo_detail1_temp");

		return $querydelete;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id)
	{
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_bonus_detail_temp");

		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_bonus_temp");

		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->delete("sku_promo_detail2_diskon_temp");

		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);
		$querydelete = $this->db->delete("sku_promo_detail2_temp");

		return $querydelete;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_detail2_temp_by_id($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id)
	{
		$this->db->where('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_bonus_detail_temp");

		$this->db->where('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_bonus_temp");

		$this->db->where('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->delete("sku_promo_detail2_diskon_temp");

		$this->db->where('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);
		$querydelete = $this->db->delete("sku_promo_detail2_temp");

		return $querydelete;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id)
	{
		$this->db->where('sku_promo_detail2_bonus_id', $sku_promo_detail2_bonus_id);
		$this->db->where('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);

		$this->db->delete("sku_promo_detail2_bonus_detail_temp");

		$this->db->where('sku_promo_detail2_bonus_id', $sku_promo_detail2_bonus_id);
		$this->db->where('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);

		$querydelete = $this->db->delete("sku_promo_detail2_bonus_temp");

		return $querydelete;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_detail2_bonus_temp_by_detail1($sku_promo_id, $sku_promo_detail1_id)
	{
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);

		$this->db->delete("sku_promo_detail2_bonus_detail_temp");

		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);

		$querydelete = $this->db->delete("sku_promo_detail2_bonus_temp");

		return $querydelete;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_detail2_diskon_temp_by_detail1($sku_promo_id, $sku_promo_detail1_id)
	{
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->where('sku_promo_id', $sku_promo_id);

		$querydelete = $this->db->delete("sku_promo_detail2_diskon_temp");

		return $querydelete;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_detail2_bonus_detail_temp($sku_promo_detail2_bonus2_id)
	{
		$this->db->where('sku_promo_detail2_bonus2_id', $sku_promo_detail2_bonus2_id);
		$querydelete = $this->db->delete("sku_promo_detail2_bonus_detail_temp");

		return $querydelete;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_detail2_diskon_temp($sku_promo_detail2_diskon_id, $sku_promo_detail2_id, $sku_promo_detail1_id)
	{
		$this->db->where('sku_promo_detail2_diskon_id', $sku_promo_detail2_diskon_id);
		$this->db->where('sku_promo_detail2_id', $sku_promo_detail2_id);
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);

		$querydelete = $this->db->delete("sku_promo_detail2_diskon_temp");

		return $querydelete;
		// return $this->db->last_query();
	}

	public function Get_sku_promo_detail1_temp($sku_promo_id)
	{
		$this->db->select("*")
			->from("sku_promo_detail1_temp")
			->where("sku_promo_id", $sku_promo_id)
			->order_by("sku_promo_detail1_nourut");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function Get_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id)
	{
		$query = $this->db->query("SELECT
									promo.sku_promo_detail2_id,
									promo.sku_promo_detail1_id,
									promo.sku_promo_id,
									promo.sku_id,
									ISNULL(sku.sku_kode, '') sku_kode,
									ISNULL(sku.sku_nama_produk, '') sku_nama_produk,
									ISNULL(sku.sku_kemasan, '') sku_kemasan,
									ISNULL(sku.sku_satuan, '') sku_satuan,
									promo.kategori_grup,
									promo.kategori_id,
									promo.qty,
									COUNT(DISTINCT diskon.sku_promo_detail2_diskon_id) AS count_diskon,
									COUNT(DISTINCT bonus.sku_promo_detail2_bonus_id) AS count_bonus
									FROM sku_promo_detail2_temp promo
									LEFT JOIN sku_promo_detail2_diskon_temp diskon
									ON diskon.sku_promo_detail2_id = promo.sku_promo_detail2_id
									LEFT JOIN sku_promo_detail2_bonus_temp bonus
									ON bonus.sku_promo_detail2_id = promo.sku_promo_detail2_id
									LEFT JOIN sku
									ON sku.sku_id = promo.sku_id
									WHERE promo.sku_promo_id = '$sku_promo_id'
									AND promo.sku_promo_detail1_id = '$sku_promo_detail1_id'
									GROUP BY promo.sku_promo_detail2_id,
											promo.sku_promo_detail1_id,
											promo.sku_promo_id,
											promo.sku_id,
											ISNULL(sku.sku_kode, ''),
											ISNULL(sku.sku_nama_produk, ''),
											ISNULL(sku.sku_kemasan, ''),
											ISNULL(sku.sku_satuan, ''),
											promo.kategori_grup,
											promo.kategori_id,
											promo.qty
									ORDER BY ISNULL(sku.sku_kode, '') ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function Get_sku_promo_detail22($sku_promo_id, $sku_promo_detail1_id)
	{
		$query = $this->db->query("SELECT
									promo.sku_promo_detail2_id,
									promo.sku_promo_detail1_id,
									promo.sku_promo_id,
									promo.sku_id,
									ISNULL(sku.sku_kode, '') sku_kode,
									ISNULL(sku.sku_nama_produk, '') sku_nama_produk,
									ISNULL(sku.sku_kemasan, '') sku_kemasan,
									ISNULL(sku.sku_satuan, '') sku_satuan,
									promo.kategori_grup,
									promo.kategori_id,
									ISNULL(kategori.kategori_nama, '') kategori_nama,
									promo.qty,
									COUNT(DISTINCT diskon.sku_promo_detail2_diskon_id) AS count_diskon,
									COUNT(DISTINCT bonus.sku_promo_detail2_bonus_id) AS count_bonus
									FROM sku_promo_detail2 promo
									LEFT JOIN sku_promo_detail2_diskon diskon
									ON diskon.sku_promo_detail2_id = promo.sku_promo_detail2_id
									LEFT JOIN sku_promo_detail2_bonus bonus
									ON bonus.sku_promo_detail2_id = promo.sku_promo_detail2_id
									LEFT JOIN sku
									ON sku.sku_id = promo.sku_id
									LEFT JOIN kategori
									ON promo.kategori_id = kategori.kategori_id
									WHERE promo.sku_promo_id = '$sku_promo_id'
									AND promo.sku_promo_detail1_id = '$sku_promo_detail1_id'
									GROUP BY promo.sku_promo_detail2_id,
											promo.sku_promo_detail1_id,
											promo.sku_promo_id,
											promo.sku_id,
											ISNULL(sku.sku_kode, ''),
											ISNULL(sku.sku_nama_produk, ''),
											ISNULL(sku.sku_kemasan, ''),
											ISNULL(sku.sku_satuan, ''),
											promo.kategori_grup,
											promo.kategori_id,
											ISNULL(kategori.kategori_nama, ''),
											promo.qty
									ORDER BY ISNULL(sku.sku_kode, '') ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function Get_sku_promo_detail2_bonus_temp($sku_promo_id, $sku_promo_detail1_id)
	{
		$this->db->select("*")
			->from("sku_promo_detail2_bonus_temp")
			->where("sku_promo_id", $sku_promo_id)
			->where("sku_promo_detail1_id", $sku_promo_detail1_id)
			// ->order_by("sku_promo_detail2_id")
			->order_by("sku_promo_detail2_bonus_nourut", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function Get_sku_promo_detail2_bonus_temp_by_one($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id)
	{
		$query = $this->db->query("SELECT
									header.sku_promo_detail2_bonus_id,
									header.sku_promo_detail2_id,
									header.sku_promo_detail1_id,
									header.sku_promo_id,
									header.sku_min_qty,
									ISNULL(header.sku_min_value, 0) AS sku_min_value,
									header.is_berkelipatan,
									header.sku_promo_detail2_bonus_nourut,
									COUNT(DISTINCT detail.sku_promo_detail2_bonus2_id) AS jml_detail
									FROM sku_promo_detail2_bonus_temp header
									LEFT JOIN sku_promo_detail2_bonus_detail_temp detail
									ON detail.sku_promo_detail2_bonus_id = header.sku_promo_detail2_bonus_id
									WHERE header.sku_promo_id = '$sku_promo_id'
									AND header.sku_promo_detail1_id = '$sku_promo_detail1_id'
									AND header.sku_promo_detail2_id = '$sku_promo_detail2_id'
									GROUP BY header.sku_promo_detail2_bonus_id,
											header.sku_promo_detail2_id,
											header.sku_promo_detail1_id,
											header.sku_promo_id,
											header.sku_min_qty,
											header.sku_min_value,
											header.is_berkelipatan,
											header.sku_promo_detail2_bonus_nourut
									ORDER BY sku_promo_detail2_bonus_nourut ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function Get_sku_promo_detail2_bonus_by_one($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id)
	{
		$query = $this->db->query("SELECT
									header.sku_promo_detail2_bonus_id,
									header.sku_promo_detail2_id,
									header.sku_promo_detail1_id,
									header.sku_promo_id,
									header.sku_min_qty,
									ISNULL(header.sku_min_value, 0) AS sku_min_value,
									header.is_berkelipatan,
									header.sku_promo_detail2_bonus_nourut,
									COUNT(DISTINCT detail.sku_promo_detail2_bonus2_id) AS jml_detail
									FROM sku_promo_detail2_bonus header
									LEFT JOIN sku_promo_detail2_bonus_detail detail
									ON detail.sku_promo_detail2_bonus_id = header.sku_promo_detail2_bonus_id
									WHERE header.sku_promo_id = '$sku_promo_id'
									AND header.sku_promo_detail1_id = '$sku_promo_detail1_id'
									AND header.sku_promo_detail2_id = '$sku_promo_detail2_id'
									GROUP BY header.sku_promo_detail2_bonus_id,
											header.sku_promo_detail2_id,
											header.sku_promo_detail1_id,
											header.sku_promo_id,
											header.sku_min_qty,
											header.sku_min_value,
											header.is_berkelipatan,
											header.sku_promo_detail2_bonus_nourut
									ORDER BY sku_promo_detail2_bonus_nourut ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function Get_sku_promo_detail2_diskon_temp_all_kategori($sku_promo_id, $sku_promo_detail1_id)
	{
		$this->db->select("*")
			->from("sku_promo_detail2_diskon_temp")
			->where("sku_promo_detail1_id", $sku_promo_detail1_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_sku_promo_detail2_diskon_temp($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id)
	{
		$this->db->select("*")
			->from("sku_promo_detail2_diskon_temp")
			->where("sku_promo_detail1_id", $sku_promo_detail1_id)
			->where("sku_promo_detail2_id", $sku_promo_detail2_id)
			->order_by("sku_promo_detail2_diskon_nourut");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_sku_promo_detail2_bonus_detail_temp($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id, $sku_promo_detail2_bonus_id)
	{
		$query = $this->db->query("SELECT
							header.sku_promo_detail2_bonus2_id,
							header.sku_promo_detail2_bonus_id,
							header.sku_promo_detail2_id,
							header.sku_promo_detail1_id,
							header.sku_promo_id,
							header.sku_id,
							sku.sku_nama_produk,
							sku.sku_kemasan,
							sku.sku_satuan,
							ISNULL(header.sku_qty_bonus,'0') sku_qty_bonus,
							header.sku_tipe_id,
							header.referensi_diskon_id
							FROM sku_promo_detail2_bonus_detail_temp header
							LEFT JOIN sku
							ON sku.sku_id = header.sku_id
							WHERE header.sku_promo_id = '$sku_promo_id'
							AND header.sku_promo_detail1_id = '$sku_promo_detail1_id'
							AND header.sku_promo_detail2_id = '$sku_promo_detail2_id'
							AND header.sku_promo_detail2_bonus_id = '$sku_promo_detail2_bonus_id'
							ORDER BY sku.sku_nama_produk ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_sku_promo_detail2_bonus_detail2($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id, $sku_promo_detail2_bonus_id)
	{
		$query = $this->db->query("SELECT
							header.sku_promo_detail2_bonus2_id,
							header.sku_promo_detail2_bonus_id,
							header.sku_promo_detail2_id,
							header.sku_promo_detail1_id,
							header.sku_promo_id,
							header.sku_id,
							sku.sku_nama_produk,
							sku.sku_kemasan,
							sku.sku_satuan,
							ISNULL(referensi_diskon.referensi_diskon_kode, '') referensi_diskon_kode,
							ISNULL(header.sku_qty_bonus,'0') sku_qty_bonus,
							header.sku_tipe_id,
							header.referensi_diskon_id
							FROM sku_promo_detail2_bonus_detail header
							LEFT JOIN sku
							ON sku.sku_id = header.sku_id
							LEFT JOIN referensi_diskon
							ON referensi_diskon.referensi_diskon_id = header.referensi_diskon_id
							WHERE header.sku_promo_id = '$sku_promo_id'
							AND header.sku_promo_detail1_id = '$sku_promo_detail1_id'
							AND header.sku_promo_detail2_id = '$sku_promo_detail2_id'
							AND header.sku_promo_detail2_bonus_id = '$sku_promo_detail2_bonus_id'
							ORDER BY sku.sku_nama_produk ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function delete_all_sku_promo_temp($sku_promo_id)
	{
		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_bonus_detail_temp");

		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_bonus_temp");

		$this->db->query("DELETE FROM sku_promo_detail2_diskon_temp WHERE sku_promo_detail2_id IN (SELECT sku_promo_detail2_id FROM sku_promo_detail2_temp WHERE sku_promo_id = '$sku_promo_id')");

		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_sku_temp");

		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->delete("sku_promo_detail2_temp");

		$this->db->where('sku_promo_id', $sku_promo_id);
		$querydelete = $this->db->delete("sku_promo_detail1_temp");

		return $querydelete;
		// return $this->db->last_query();
	}

	public function delete_all_sku_promo_temp_tanpa_id()
	{
		$query = $this->db->query("select a.* from sku_promo_detail1_temp a left join sku_promo_temp b on b.sku_promo_id = a.sku_promo_id where b.sku_promo_id is null");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();

			foreach ($query as $value) {
				$this->db->where("sku_promo_detail1_id", $value['sku_promo_detail1_id']);
				$this->db->delete("sku_promo_detail2_bonus_detail_temp");

				$this->db->where("sku_promo_detail1_id", $value['sku_promo_detail1_id']);
				$this->db->delete("sku_promo_detail2_bonus_temp");

				$this->db->where("sku_promo_detail1_id", $value['sku_promo_detail1_id']);
				$this->db->delete("sku_promo_detail2_diskon_temp");

				$this->db->where("sku_promo_detail1_id", $value['sku_promo_detail1_id']);
				$this->db->delete("sku_promo_detail2_sku_temp");

				$this->db->where("sku_promo_detail1_id", $value['sku_promo_detail1_id']);
				$this->db->delete("sku_promo_detail2_temp");

				$this->db->where("sku_promo_detail1_id", $value['sku_promo_detail1_id']);
				$this->db->delete("sku_promo_detail1_temp");
			}

			$query = 1;
		}

		return $query;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_lokasi($sku_promo_id)
	{
		$this->db->where('sku_promo_id', $sku_promo_id);

		$queryinsert = $this->db->delete("sku_promo_lokasi_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_detail2_bonus_temp_dan_bonus_detail_temp($sku_promo_id, $sku_promo_detail1_id)
	{
		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->delete("sku_promo_detail2_bonus_temp");

		$this->db->where('sku_promo_id', $sku_promo_id);
		$this->db->where('sku_promo_detail1_id', $sku_promo_detail1_id);
		$this->db->delete("sku_promo_detail2_bonus_detail_temp");

		return 1;
	}

	public function cek_qty_bonus($sku_promo_id)
	{
		$query = $this->db->query("SELECT
									*
									FROM sku_promo_detail2_bonus_detail_temp
									WHERE sku_promo_id = '$sku_promo_id'
									AND (sku_qty_bonus IS NULL
									OR sku_qty_bonus = 0)");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function cek_sku_promo_detail2_bonus($sku_promo_id)
	{
		$query = $this->db->query("SELECT
									*
									FROM sku_promo_detail2_bonus_temp
									WHERE sku_promo_id = '$sku_promo_id'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function cek_sku_promo_detail2_diskon($sku_promo_id)
	{
		$query = $this->db->query("SELECT a.*
									FROM sku_promo_detail2_diskon_temp a
									LEFT JOIN sku_promo_detail2_temp b
									ON b.sku_promo_detail2_id = a.sku_promo_detail2_id
									WHERE b.sku_promo_id = '$sku_promo_id'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Get_sku_promo_detail1($sku_promo_id)
	{
		$this->db->select("sku_promo_detail1.*, principle.principle_nama")
			->from("sku_promo_detail1")
			->join("principle", "sku_promo_detail1.principle_id = principle.principle_id", "left")
			->where("sku_promo_id", $sku_promo_id)
			->order_by("sku_promo_detail1_nourut");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_sku_promo_detail2($sku_promo_id, $sku_promo_detail1_id)
	{
		$this->db->select("*")
			->from("sku_promo_detail2")
			->where("sku_promo_detail1_id", $sku_promo_detail1_id)
			->where("sku_promo_id", $sku_promo_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_sku_promo_detail2_diskon($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id)
	{
		$query = $this->db->query("SELECT a.*
							FROM sku_promo_detail2_diskon a
							LEFT JOIN sku_promo_detail2 b
							ON b.sku_promo_detail2_id = a.sku_promo_detail2_id
							WHERE b.sku_promo_id = '$sku_promo_id'
							AND a.sku_promo_detail1_id = '$sku_promo_detail1_id'
							AND a.sku_promo_detail2_id = '$sku_promo_detail2_id' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_sku_promo_detail2_bonus($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id)
	{
		$this->db->select("*")
			->from("sku_promo_detail2_bonus")
			->where("sku_promo_detail2_id", $sku_promo_detail2_id)
			->where("sku_promo_detail1_id", $sku_promo_detail1_id)
			->where("sku_promo_id", $sku_promo_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_sku_promo_detail2_bonus_detail($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id)
	{
		$this->db->select("*")
			->from("sku_promo_detail2_bonus_detail")
			->where("sku_promo_detail2_bonus_id", $sku_promo_detail2_bonus_id)
			->where("sku_promo_detail2_id", $sku_promo_detail2_id)
			->where("sku_promo_detail1_id", $sku_promo_detail1_id)
			->where("sku_promo_id", $sku_promo_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_sku_promo_detail2_sku($sku_promo_id)
	{
		$this->db->select("*")
			->from("sku_promo_detail2_sku")
			->where("sku_promo_id", $sku_promo_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_sku_promo_detail2_sku_by_filter($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id)
	{
		$this->db->select("*")
			->from("sku_promo_detail2_sku")
			->where("sku_promo_detail2_id", $sku_promo_detail2_id)
			->where("sku_promo_detail1_id", $sku_promo_detail1_id)
			->where("sku_promo_id", $sku_promo_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function update_sku_harga($sku_harga_id, $client_wms_id, $depo_id, $depo_group_nama, $sku_harga_kode, $sku_harga_keterangan, $sku_harga_startdate, $sku_harga_enddate, $sku_harga_status, $sku_harga_who_create, $sku_harga_tgl_create, $sku_harga_who_approve, $sku_harga_tgl_approve, $sku_harga_is_aktif, $sku_harga_is_delete, $sku_harga_id_before, $is_khusus)
	{
		// $tgl = $tgl . " " . date('H:i:s');

		$sku_harga_id =  $sku_harga_id ==  '' ? null : $sku_harga_id;
		$client_wms_id =  $client_wms_id ==  '' ? null : $client_wms_id;
		$depo_id =  $depo_id ==  '' ? null : $depo_id;
		$depo_group_nama =  $depo_group_nama ==  '' ? null : $depo_group_nama;
		$sku_harga_kode =  $sku_harga_kode ==  '' ? null : $sku_harga_kode;
		$sku_harga_keterangan =  $sku_harga_keterangan ==  '' ? null : $sku_harga_keterangan;
		$sku_harga_startdate =  $sku_harga_startdate ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_harga_startdate)));
		$sku_harga_enddate =  $sku_harga_enddate ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sku_harga_enddate)));
		$sku_harga_status =  $sku_harga_status ==  '' ? null : $sku_harga_status;
		$sku_harga_who_create =  $sku_harga_who_create ==  '' ? null : $sku_harga_who_create;
		$sku_harga_tgl_create =  $sku_harga_tgl_create ==  '' ? null : $sku_harga_tgl_create;
		$sku_harga_who_approve =  $sku_harga_who_approve ==  '' ? null : $sku_harga_who_approve;
		$sku_harga_tgl_approve =  $sku_harga_tgl_approve ==  '' ? null : $sku_harga_tgl_approve;
		$sku_harga_is_aktif =  $sku_harga_is_aktif ==  '' ? null : $sku_harga_is_aktif;
		$sku_harga_is_delete =  $sku_harga_is_delete ==  '' ? null : $sku_harga_is_delete;
		$sku_harga_id_before =  $sku_harga_id_before ==  '' ? null : $sku_harga_id_before;
		$is_khusus =  $is_khusus ==  '' ? null : $is_khusus;

		// $tgl_ = date_create(str_replace("/", "-", $tgl));
		$this->db->set('client_wms_id', $client_wms_id);
		// $this->db->set('depo_id', $depo_id);
		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		// $this->db->set('depo_group_nama', $depo_group_nama);
		$this->db->set('sku_harga_kode', $sku_harga_kode);
		$this->db->set('sku_harga_keterangan', $sku_harga_keterangan);
		$this->db->set('sku_harga_startdate', $sku_harga_startdate);
		$this->db->set('sku_harga_enddate', $sku_harga_enddate);
		$this->db->set('sku_harga_status', $sku_harga_status);
		// $this->db->set('sku_harga_who_create', $sku_harga_who_create);
		// $this->db->set('sku_harga_tgl_create', "GETDATE()", FALSE);
		// $this->db->set('sku_harga_who_approve', $sku_harga_who_approve);
		// $this->db->set('sku_harga_tgl_approve', $sku_harga_tgl_approve);
		$this->db->set('sku_harga_is_aktif', $sku_harga_is_aktif);
		$this->db->set('sku_harga_is_delete', $sku_harga_is_delete);
		$this->db->set('sku_harga_id_before', $sku_harga_id_before);
		$this->db->set('is_khusus', $is_khusus);

		$this->db->where('sku_harga_id', $sku_harga_id);
		$queryinsert = $this->db->update("sku_harga");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function delete_sku_harga_detail($sku_harga_id)
	{
		$this->db->where('sku_harga_id', $sku_harga_id);

		$querydelete = $this->db->delete("sku_harga_detail");

		return $querydelete;
		// return $this->db->last_query();
	}

	public function delete_sku_harga_lokasi($sku_harga_id)
	{
		$this->db->where('sku_harga_id', $sku_harga_id);
		$queryinsert = $this->db->delete("sku_harga_lokasi");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function delete_sku_harga_segmen($sku_harga_id)
	{
		$this->db->where('sku_harga_id', $sku_harga_id);
		$queryinsert = $this->db->delete("sku_harga_segmen");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function delete_sku_harga_segmen_detail($sku_harga_id)
	{
		$this->db->where('sku_harga_id', $sku_harga_id);
		$queryinsert = $this->db->delete("sku_harga_segmen_detail");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_segmen($sku_promo_id)
	{
		$this->db->where('sku_promo_id', $sku_promo_id);
		$queryinsert = $this->db->delete("sku_promo_segmen_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function delete_sku_promo_segmen_detail($sku_promo_id)
	{
		$this->db->where('sku_promo_id', $sku_promo_id);
		$queryinsert = $this->db->delete("sku_promo_segmen_detail_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function Get_harga_header_by_id($id)
	{
		$this->db->select("*")
			->from("sku_harga")
			->where("sku_harga_id", $id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_harga_detail_by_id($id)
	{
		$query = $this->db->query("SELECT
										detail.sku_harga_detail_id,
										detail.sku_harga_id,
										detail.sku_id,
										sku.sku_kode,
										sku.sku_nama_produk,
										sku.sku_satuan,
										sku.sku_kemasan,
										detail.sku_qty,
										detail.sku_with_tax,
										detail.sku_nominal_harga
									FROM sku_harga_detail detail
									LEFT JOIN sku
									ON sku.sku_id = detail.sku_id
									WHERE detail.sku_harga_id = '$id'
									ORDER BY sku.sku_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetPromoDepo($sku_promo_id)
	{
		$query = $this->db->query("SELECT
									lokasi.sku_promo_id,
									lokasi.depo_id,
									depo.depo_nama As depo
									FROM (
										SELECT * FROM sku_promo_lokasi
										UNION ALL
										SELECT * FROM sku_promo_lokasi_temp
									) lokasi
									LEFT JOIN depo
									ON depo.depo_id = lokasi.depo_id
									WHERE lokasi.sku_promo_id = '$sku_promo_id'
									ORDER BY depo.depo_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function GetHargaDepo($sku_harga_id)
	{
		$query = $this->db->query("SELECT
									lokasi.sku_harga_id,
									lokasi.depo_id,
									depo.depo_nama As depo
									FROM sku_harga_lokasi lokasi
									LEFT JOIN depo
									ON depo.depo_id = lokasi.depo_id
									WHERE lokasi.sku_harga_id = '$sku_harga_id'
									ORDER BY depo.depo_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function Exec_approval_pengajuan($depo_id, $sales_id, $approvalParam, $sales_order_id, $sales_order_kode, $is_approvaldana, $total_biaya)
	{
		$query = $this->db->query("exec approval_pengajuan '$depo_id', '$sales_id','$approvalParam', '$sales_order_id','$sales_order_kode', '$is_approvaldana','$total_biaya'");

		// $res = $query->result_array();

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$res = 1; // Success
		} else {
			$res = 0; // Success
		}

		return $res;
	}

	public function Update_kategori_sku_promo_detail_by_id($sku_promo_detail2_id, $kategori_grup)
	{
		$this->db->set('kategori_grup', $kategori_grup);
		$this->db->where('sku_promo_detail2_id', $sku_promo_detail2_id);

		$queryupdate = $this->db->update("sku_promo_detail2_temp");

		return $queryupdate;
		// return $this->db->last_query();
	}

	public function GetPelangganBySegmen($segmen)
	{

		if ($segmen != "") {
			// Pastikan $depo_group_nama adalah array
			if (!is_array($segmen)) {
				$segmen = [$segmen];
			}

			$query = $this->db->query("SELECT distinct
									cp.client_pt_id,
									cp.client_pt_nama,
									cp.client_pt_kelurahan,
									cp.client_pt_kecamatan,
									cp.client_pt_kota
									FROM client_pt cp
									LEFT JOIN area a
									ON a.area_id =  cp.area_id
									LEFT JOIN depo_area_header dah
									ON dah.area_header_id = a.area_header_id
									WHERE cp.client_pt_segmen_id1 IN (" . implode(",", $segmen) . ")
									AND dah.depo_id = '" . $this->session->userdata('depo_id') . "'
									AND cp.client_pt_is_aktif = '1'
									ORDER BY cp.client_pt_nama ASC");

			if ($query->num_rows() == 0) {
				$query = 0;
			} else {
				$query = $query->result_array();
			}
		} else {
			$query = array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_sku_harga_segmen_for_client_pt($sku_harga_id, $client_pt_id)
	{

		if ($client_pt_id != "") {
			if (!is_array($client_pt_id)) {
				$client_pt_id = [$client_pt_id];
			}

			$query = $this->db->query("SELECT
										a.sku_harga_segmen_id,
										a.sku_harga_id,
										a.client_pt_segmen_id,
										b.client_pt_id
									FROM sku_harga_segmen a
									LEFT JOIN client_pt b
									ON b.client_pt_segmen_id1 = a.client_pt_segmen_id
									WHERE a.sku_harga_id = '$sku_harga_id'
									AND b.client_pt_id IN (" . implode(",", $client_pt_id) . ")");

			if ($query->num_rows() == 0) {
				$query = array();
			} else {
				$query = $query->result_array();
			}
		} else {
			$query = array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_sku_promo_segmen_for_client_pt($sku_promo_id, $client_pt_id)
	{

		if ($client_pt_id != "") {
			if (!is_array($client_pt_id)) {
				$client_pt_id = [$client_pt_id];
			}

			$query = $this->db->query("SELECT
										a.sku_promo_segmen_id,
										a.sku_promo_id,
										a.client_pt_segmen_id,
										b.client_pt_id
									FROM sku_promo_segmen_temp a
									LEFT JOIN client_pt b
									ON b.client_pt_segmen_id1 = a.client_pt_segmen_id
									WHERE a.sku_promo_id = '$sku_promo_id'
									AND b.client_pt_id IN (" . implode(",", $client_pt_id) . ")");

			if ($query->num_rows() == 0) {
				$query = array();
			} else {
				$query = $query->result_array();
			}
		} else {
			$query = array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetClientPtSegmen1ByHarga($sku_harga_id)
	{
		$query = $this->db->query("select distinct
										a.client_pt_segmen_id,
										a.client_pt_segmen_kode,
										a.client_pt_segmen_nama,
										b.client_pt_segmen_id as client_pt_segmen_id_harga
									from client_pt_segmen a
									left join sku_harga_segmen b
									on b.client_pt_segmen_id = a.client_pt_segmen_id
									and b.sku_harga_id = '$sku_harga_id'
									where a.client_pt_segmen_is_aktif = '1'
									and a.client_pt_segmen_level = '1'
									order by client_pt_segmen_kode asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetClientPtByHarga($sku_harga_id, $segmen)
	{
		// Pastikan $depo_group_nama adalah array
		if (!is_array($segmen)) {
			$segmen = [$segmen];
		}

		if (isset($segmen) && count($segmen) > 0) {

			$query = $this->db->query("SELECT distinct
									cp.client_pt_id,
									cp.client_pt_nama,
									cp.client_pt_kelurahan,
									cp.client_pt_kecamatan,
									cp.client_pt_kota,
									shsd.client_pt_id as client_pt_id_harga
									FROM client_pt cp
									LEFT JOIN area a
									ON a.area_id =  cp.area_id
									LEFT JOIN depo_area_header dah
									ON dah.area_header_id = a.area_header_id
									LEFT JOIN sku_harga_segmen_detail shsd
									on shsd.client_pt_id = cp.client_pt_id
									and shsd.sku_harga_id = '$sku_harga_id'
									WHERE cp.client_pt_segmen_id1 IN (" . implode(",", $segmen) . ")
									AND dah.depo_id = '" . $this->session->userdata('depo_id') . "'
									AND cp.client_pt_is_aktif = '1'
									ORDER BY cp.client_pt_nama ASC");

			if ($query->num_rows() == 0) {
				$query = array();
			} else {
				$query = $query->result_array();
			}
		} else {
			$query = array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetClientPtSegmen1ByPromo($sku_promo_id)
	{
		$query = $this->db->query("select distinct
										a.client_pt_segmen_id,
										a.client_pt_segmen_kode,
										a.client_pt_segmen_nama,
										b.client_pt_segmen_id as client_pt_segmen_id_promo
									from client_pt_segmen a
									left join sku_promo_segmen_temp b
									on b.client_pt_segmen_id = a.client_pt_segmen_id
									and b.sku_promo_id = '$sku_promo_id'
									where a.client_pt_segmen_is_aktif = '1'
									and a.client_pt_segmen_level = '1'
									order by client_pt_segmen_kode asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetClientPtByPromo($sku_promo_id, $segmen)
	{
		// Pastikan $depo_group_nama adalah array
		if (!is_array($segmen)) {
			$segmen = [$segmen];
		}

		if (isset($segmen) && count($segmen) > 0) {

			$query = $this->db->query("SELECT distinct
									cp.client_pt_id,
									cp.client_pt_nama,
									cp.client_pt_kelurahan,
									cp.client_pt_kecamatan,
									cp.client_pt_kota,
									shsd.client_pt_id as client_pt_id_promo
									FROM client_pt cp
									LEFT JOIN area a
									ON a.area_id =  cp.area_id
									LEFT JOIN depo_area_header dah
									ON dah.area_header_id = a.area_header_id
									LEFT JOIN sku_promo_segmen_detail_temp shsd
									on shsd.client_pt_id = cp.client_pt_id
									and shsd.sku_promo_id = '$sku_promo_id'
									WHERE cp.client_pt_segmen_id1 IN (" . implode(",", $segmen) . ")
									AND dah.depo_id = '" . $this->session->userdata('depo_id') . "'
									AND cp.client_pt_is_aktif = '1'
									ORDER BY cp.client_pt_nama ASC");

			if ($query->num_rows() == 0) {
				$query = array();
			} else {
				$query = $query->result_array();
			}
		} else {
			$query = array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function DuplicatePromoToTemp($sku_promo_id)
	{
		$query = $this->db->query("
						insert into sku_promo_temp 
						select sku_promo_id,
						depo_group_id,
						depo_id,
						client_wms_id,
						sku_promo_kode,
						sku_promo_tgl_berlaku_awal,
						sku_promo_tgl_berlaku_akhir,
						sku_promo_keterangan,
						'Draft' sku_promo_status,
						null,
						sku_promo_who_create,
						null,
						null,
						null,
						is_khusus,
						null,
						sku_promo_who_update from sku_promo where sku_promo_id = '$sku_promo_id'
						insert into sku_promo_detail1_temp select * from sku_promo_detail1 where sku_promo_id = '$sku_promo_id'
						insert into sku_promo_detail2_temp select * from sku_promo_detail2 where sku_promo_id = '$sku_promo_id'
						insert into sku_promo_detail2_bonus_temp select * from sku_promo_detail2_bonus where sku_promo_id = '$sku_promo_id'
						insert into sku_promo_detail2_bonus_detail_temp select * from sku_promo_detail2_bonus_detail where sku_promo_id = '$sku_promo_id'
						insert into sku_promo_detail2_diskon_temp select * from sku_promo_detail2_diskon where sku_promo_id = '$sku_promo_id'
						insert into sku_promo_detail2_sku_temp select * from sku_promo_detail2_sku where sku_promo_id = '$sku_promo_id'
						insert into sku_promo_lokasi_temp select * from sku_promo_lokasi where sku_promo_id = '$sku_promo_id'
						insert into sku_promo_segmen_temp select * from sku_promo_segmen where sku_promo_id = '$sku_promo_id'
						insert into sku_promo_segmen_detail_temp select * from sku_promo_segmen_detail where sku_promo_id = '$sku_promo_id'");

		return $query;
		// return $this->db->last_query();
	}

	public function Update_new_sku_promo_id($sku_promo_id, $sku_promo_id_new)
	{
		$query = $this->db->query("update sku_promo_temp set sku_promo_id = '$sku_promo_id_new' where sku_promo_id = '$sku_promo_id'
						update sku_promo_detail1_temp set sku_promo_id = '$sku_promo_id_new' where sku_promo_id = '$sku_promo_id'
						update sku_promo_detail2_temp set sku_promo_id = '$sku_promo_id_new' where sku_promo_id = '$sku_promo_id'
						update sku_promo_detail2_bonus_temp set sku_promo_id = '$sku_promo_id_new' where sku_promo_id = '$sku_promo_id'
						update sku_promo_detail2_bonus_detail_temp set sku_promo_id = '$sku_promo_id_new' where sku_promo_id = '$sku_promo_id'
						update sku_promo_detail2_diskon_temp set sku_promo_id = '$sku_promo_id_new' where sku_promo_id = '$sku_promo_id'
						update sku_promo_detail2_sku_temp set sku_promo_id = '$sku_promo_id_new' where sku_promo_id = '$sku_promo_id'
						update sku_promo_lokasi_temp set sku_promo_id = '$sku_promo_id_new' where sku_promo_id = '$sku_promo_id'
						update sku_promo_segmen_temp set sku_promo_id = '$sku_promo_id_new' where sku_promo_id = '$sku_promo_id'
						update sku_promo_segmen_detail_temp set sku_promo_id = '$sku_promo_id_new' where sku_promo_id = '$sku_promo_id'");

		return $query;
		// return $this->db->last_query();
	}

	public function DeleteDuplicatePromoEmptyCreated()
	{
		$query = $this->db->query("delete sku_promo_temp where sku_promo_id in (SELECT sku_promo_id from sku_promo_temp where sku_promo_who_create = '" . $this->session->userdata('pengguna_username') . "' and sku_promo_tgl_create is null)
								delete sku_promo_detail1_temp where sku_promo_id in (SELECT sku_promo_id from sku_promo_temp where sku_promo_who_create = '" . $this->session->userdata('pengguna_username') . "' and sku_promo_tgl_create is null)
								delete sku_promo_detail2_temp where sku_promo_id in (SELECT sku_promo_id from sku_promo_temp where sku_promo_who_create = '" . $this->session->userdata('pengguna_username') . "' and sku_promo_tgl_create is null)
								delete sku_promo_detail2_bonus_temp where sku_promo_id in (SELECT sku_promo_id from sku_promo_temp where sku_promo_who_create = '" . $this->session->userdata('pengguna_username') . "' and sku_promo_tgl_create is null)
								delete sku_promo_detail2_bonus_detail_temp where sku_promo_id in (SELECT sku_promo_id from sku_promo_temp where sku_promo_who_create = '" . $this->session->userdata('pengguna_username') . "' and sku_promo_tgl_create is null)
								delete sku_promo_detail2_diskon_temp where sku_promo_id in (SELECT sku_promo_id from sku_promo_temp where sku_promo_who_create = '" . $this->session->userdata('pengguna_username') . "' and sku_promo_tgl_create is null)
								delete sku_promo_detail2_sku_temp where sku_promo_id in (SELECT sku_promo_id from sku_promo_temp where sku_promo_who_create = '" . $this->session->userdata('pengguna_username') . "' and sku_promo_tgl_create is null)
								delete sku_promo_lokasi_temp where sku_promo_id in (SELECT sku_promo_id from sku_promo_temp where sku_promo_who_create = '" . $this->session->userdata('pengguna_username') . "' and sku_promo_tgl_create is null)
								delete sku_promo_segmen_temp where sku_promo_id in (SELECT sku_promo_id from sku_promo_temp where sku_promo_who_create = '" . $this->session->userdata('pengguna_username') . "' and sku_promo_tgl_create is null)
								delete sku_promo_segmen_detail_temp where sku_promo_id in (SELECT sku_promo_id from sku_promo_temp where sku_promo_who_create = '" . $this->session->userdata('pengguna_username') . "' and sku_promo_tgl_create is null)");

		return $query;
		// return $this->db->last_query();
	}

	public function proses_duplicate_sku_promo($sku_promo_id)
	{
		$query = $this->db->query("exec proses_duplicate_sku_promo '$sku_promo_id', '" . $this->session->userdata('pengguna_username') . "'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}
}
