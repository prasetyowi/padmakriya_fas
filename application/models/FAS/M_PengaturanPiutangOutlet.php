<?php

class M_PengaturanPiutangOutlet extends CI_Model
{

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function GetCategory()
	{
		$query = $this->db->query("SELECT * FROM category_pengaturan_piutang_outlet() ORDER BY kategori ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		// return $this->db->last_query();
		return $query;
	}

	public function GetPerusahaan()
	{
		$query = $this->db->query("SELECT * FROM client_wms WHERE client_wms_is_aktif = '1' ORDER BY client_wms_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		// return $this->db->last_query();
		return $query;
	}

	public function search_client_pt($client_pt)
	{
		$query = $this->db->query("SELECT client_pt_id, client_pt_nama FROM client_pt WHERE client_pt_is_aktif = '1' AND client_pt_nama LIKE '%$client_pt%' ORDER BY client_pt_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		// return $this->db->last_query();
		return $query;
	}

	public function Get_pengaturan_piutang_outlet($perusahaan, $brand, $sku_induk)
	{
		$brand = $brand == "all" || $brand == "" ? "" : " AND a.client_pt_setting_brand = '$brand' ";
		$sku_induk = $sku_induk == "all" || $sku_induk == "" ? "" : " AND a.client_pt_setting_sku_id = '$sku_induk' ";

		$query = $this->db->query("SELECT 
									a.client_pt_setting_piutang_id,
									ISNULL(a.client_pt_setting_segment1,'') AS client_pt_setting_segment1,
									ISNULL(segment1.client_pt_segmen_nama,'') AS client_pt_setting_segment1_ket,
									ISNULL(a.client_pt_setting_segment2,'') AS client_pt_setting_segment2,
									ISNULL(segment2.client_pt_segmen_nama,'') AS client_pt_setting_segment2_ket,
									ISNULL(a.client_pt_setting_segment3,'') AS client_pt_setting_segment3,
									ISNULL(segment3.client_pt_segmen_nama,'') AS client_pt_setting_segment3_ket,
									ISNULL(a.client_pt_setting_category,'') AS client_pt_setting_category,
									a.client_pt_setting_brand,
									ISNULL(brand.principle_brand_nama,'') AS principle_brand_nama,
									a.client_pt_setting_sku_id,
									ISNULL(sku.sku_nama_produk,'') AS sku_nama_produk,
									ISNULL(a.client_pt_setting_top,'0') AS client_pt_setting_top 
									FROM client_pt_setting_piutang a
									LEFT JOIN sku
									ON sku.sku_id = a.client_pt_setting_sku_id
									LEFT JOIN principle_brand brand
									ON brand.principle_brand_id = a.client_pt_setting_brand
									LEFT JOIN client_pt_segmen segment1
									ON segment1.client_pt_segmen_kode = a.client_pt_setting_segment1
									LEFT JOIN client_pt_segmen segment2
									ON segment2.client_pt_segmen_kode = a.client_pt_setting_segment2
									LEFT JOIN client_pt_segmen segment3
									ON segment3.client_pt_segmen_kode = a.client_pt_setting_segment3
									WHERE a.client_wms_id = '$perusahaan' 
									" . $brand . " " . $sku_induk . " 
									ORDER BY client_pt_setting_segment1 ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_pengaturan_piutang_outlet_by_id($id)
	{

		$query = $this->db->query("SELECT 
									a.client_pt_setting_piutang_id,
									ISNULL(a.client_pt_setting_segment1,'') AS client_pt_setting_segment1,
									ISNULL(segment1.client_pt_segmen_nama,'') AS client_pt_setting_segment1_ket,
									ISNULL(a.client_pt_setting_segment2,'') AS client_pt_setting_segment2,
									ISNULL(segment2.client_pt_segmen_nama,'') AS client_pt_setting_segment2_ket,
									ISNULL(a.client_pt_setting_segment3,'') AS client_pt_setting_segment3,
									ISNULL(segment3.client_pt_segmen_nama,'') AS client_pt_setting_segment3_ket,
									ISNULL(a.client_pt_setting_category,'') AS client_pt_setting_category,
									a.client_pt_setting_brand,
									ISNULL(brand.principle_brand_nama,'') AS principle_brand_nama,
									a.client_pt_setting_sku_id,
									ISNULL(sku.sku_nama_produk,'') AS sku_nama_produk,
									ISNULL(a.client_pt_setting_top,'0') AS client_pt_setting_top,
									a.client_wms_id,
									a.updwho,
									a.updtgl,
									ISNULL(a.client_pt_setting_is_aktif,'0') as client_pt_setting_is_aktif
									FROM client_pt_setting_piutang a
									LEFT JOIN client_pt_segmen segment1
									ON segment1.client_pt_segmen_kode = a.client_pt_setting_segment1
									LEFT JOIN client_pt_segmen segment2
									ON segment2.client_pt_segmen_kode = a.client_pt_setting_segment2
									LEFT JOIN client_pt_segmen segment3
									ON segment3.client_pt_segmen_kode = a.client_pt_setting_segment3
									LEFT JOIN principle_brand brand
									ON brand.principle_brand_id = a.client_pt_setting_brand
									LEFT JOIN sku
									ON sku.sku_id = a.client_pt_setting_sku_id
									WHERE a.client_pt_setting_piutang_id = '$id' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_client_pt_setting_piutang_khusus_by_id($id)
	{

		$query = $this->db->query("SELECT
									a.client_pt_setting_piutang_khusus_id, 
									a.client_pt_setting_piutang_id,
									a.client_pt_id,
									ISNULL(b.client_pt_nama,'') AS client_pt_nama
									FROM client_pt_setting_piutang_khusus a
									LEFT JOIN client_pt b
									ON b.client_pt_id = a.client_pt_id
									WHERE client_pt_setting_piutang_id = '$id' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_segment1($terms)
	{
		$terms = $terms == "all" ? "" : $terms;

		$query = $this->db->query("SELECT top 100
									client_pt_segmen_kode AS id,
									CONCAT(client_pt_segmen_kode, ' || ', client_pt_segmen_nama) AS text
									FROM client_pt_segmen
									WHERE client_pt_segmen_is_aktif = '1'
									AND client_pt_segmen_level = '1'
									AND (client_pt_segmen_kode LIKE '%$terms%'
									OR client_pt_segmen_nama LIKE '%$terms%')
									ORDER BY client_pt_segmen_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_segment2($terms)
	{
		$terms = $terms == "all" ? "" : $terms;

		$query = $this->db->query("SELECT top 100
									client_pt_segmen_kode AS id,
									CONCAT(client_pt_segmen_kode, ' || ', client_pt_segmen_nama) AS text
									FROM client_pt_segmen
									WHERE client_pt_segmen_is_aktif = '1'
									AND client_pt_segmen_level = '2'
									AND (client_pt_segmen_kode LIKE '%$terms%'
									OR client_pt_segmen_nama LIKE '%$terms%')
									ORDER BY client_pt_segmen_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_segment3($terms)
	{
		$terms = $terms == "all" ? "" : $terms;

		$query = $this->db->query("SELECT top 100
									client_pt_segmen_kode AS id,
									CONCAT(client_pt_segmen_kode, ' || ', client_pt_segmen_nama) AS text
									FROM client_pt_segmen
									WHERE client_pt_segmen_is_aktif = '1'
									AND client_pt_segmen_level = '3'
									AND (client_pt_segmen_kode LIKE '%$terms%'
									OR client_pt_segmen_nama LIKE '%$terms%')
									ORDER BY client_pt_segmen_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_brand($terms)
	{
		$terms = $terms == "all" ? "" : $terms;

		$query = $this->db->query("SELECT top 100
									principle_brand_id as id,
									principle_brand_nama as text
									FROM principle_brand
									WHERE principle_brand_is_aktif = '1'
									AND principle_brand_nama LIKE '%$terms%'
									ORDER BY principle_brand_nama");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_sku($terms)
	{

		$terms = $terms == "all" ? "" : $terms;

		$query = $this->db->query("SELECT TOP 100
									sku_id as id,
									sku_nama_produk AS text
									FROM sku
									WHERE sku_nama_produk LIKE '%$terms%'
									ORDER BY sku_nama_produk asc");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function insert_client_pt_setting_piutang($client_pt_setting_piutang_id, $client_pt_setting_segment1, $client_pt_setting_segment2, $client_pt_setting_segment3, $client_pt_setting_category, $client_pt_setting_brand, $client_pt_setting_sku_id, $client_pt_setting_top, $client_pt_setting_is_aktif, $client_wms_id)
	{
		$client_pt_setting_segment1 = $client_pt_setting_segment1 != '' ? $client_pt_setting_segment1 : null;
		$client_pt_setting_segment2 = $client_pt_setting_segment2 != '' ? $client_pt_setting_segment2 : null;
		$client_pt_setting_segment3 = $client_pt_setting_segment3 != '' ? $client_pt_setting_segment3 : null;
		$client_pt_setting_category = $client_pt_setting_category != '' ? $client_pt_setting_category : null;
		$client_pt_setting_brand = $client_pt_setting_brand != '' ? $client_pt_setting_brand : null;
		$client_pt_setting_sku_id = $client_pt_setting_sku_id != '' ? $client_pt_setting_sku_id : null;
		$client_pt_setting_top = $client_pt_setting_top != '' ? $client_pt_setting_top : null;
		$client_pt_setting_is_aktif = $client_pt_setting_is_aktif != '' ? $client_pt_setting_is_aktif : null;
		$client_wms_id = $client_wms_id != '' ? $client_wms_id : null;

		$backend = $this->load->database('backend', TRUE);

		$backend->set('client_pt_setting_piutang_id', $client_pt_setting_piutang_id);
		$backend->set('client_pt_setting_segment1', $client_pt_setting_segment1);
		$backend->set('client_pt_setting_segment2', $client_pt_setting_segment2);
		$backend->set('client_pt_setting_segment3', $client_pt_setting_segment3);
		$backend->set('client_pt_setting_category', $client_pt_setting_category);
		$backend->set('client_pt_setting_brand', $client_pt_setting_brand);
		$backend->set('client_pt_setting_sku_id', $client_pt_setting_sku_id);
		$backend->set('client_pt_setting_top', $client_pt_setting_top);
		$backend->set('client_pt_setting_is_aktif', $client_pt_setting_is_aktif);
		$backend->set('client_wms_id', $client_wms_id);
		$backend->set('updwho', $this->session->userdata('pengguna_username'));
		$backend->set('updtgl', "GETDATE()", FALSE);

		$backend->insert("client_pt_setting_piutang");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function insert_client_pt_setting_piutang_khusus($client_pt_setting_piutang_khusus_id, $client_pt_setting_piutang_id, $client_pt_id)
	{
		$client_pt_setting_piutang_id = $client_pt_setting_piutang_id != '' ? $client_pt_setting_piutang_id : null;
		$client_pt_id = $client_pt_id != '' ? $client_pt_id : null;

		$backend = $this->load->database('backend', TRUE);

		$backend->set('client_pt_setting_piutang_khusus_id', $client_pt_setting_piutang_khusus_id);
		$backend->set('client_pt_setting_piutang_id', $client_pt_setting_piutang_id);
		$backend->set('client_pt_id', $client_pt_id);

		$backend->insert("client_pt_setting_piutang_khusus");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function Update_client_pt_setting_piutang($client_pt_setting_piutang_id, $client_pt_setting_segment1, $client_pt_setting_segment2, $client_pt_setting_segment3, $client_pt_setting_category, $client_pt_setting_brand, $client_pt_setting_sku_id, $client_pt_setting_top, $client_pt_setting_is_aktif, $client_wms_id)
	{

		$client_pt_setting_segment1 = $client_pt_setting_segment1 != '' ? $client_pt_setting_segment1 : null;
		$client_pt_setting_segment2 = $client_pt_setting_segment2 != '' ? $client_pt_setting_segment2 : null;
		$client_pt_setting_segment3 = $client_pt_setting_segment3 != '' ? $client_pt_setting_segment3 : null;
		$client_pt_setting_category = $client_pt_setting_category != '' ? $client_pt_setting_category : null;
		$client_pt_setting_brand = $client_pt_setting_brand != '' ? $client_pt_setting_brand : null;
		$client_pt_setting_sku_id = $client_pt_setting_sku_id != '' ? $client_pt_setting_sku_id : null;
		$client_pt_setting_top = $client_pt_setting_top != '' ? $client_pt_setting_top : null;
		$client_pt_setting_is_aktif = $client_pt_setting_is_aktif != '' ? $client_pt_setting_is_aktif : null;
		$client_wms_id = $client_wms_id != '' ? $client_wms_id : null;

		$backend = $this->load->database('backend', TRUE);

		$backend->set('client_pt_setting_segment1', $client_pt_setting_segment1);
		$backend->set('client_pt_setting_segment2', $client_pt_setting_segment2);
		$backend->set('client_pt_setting_segment3', $client_pt_setting_segment3);
		$backend->set('client_pt_setting_category', $client_pt_setting_category);
		$backend->set('client_pt_setting_brand', $client_pt_setting_brand);
		$backend->set('client_pt_setting_sku_id', $client_pt_setting_sku_id);
		$backend->set('client_pt_setting_top', $client_pt_setting_top);
		$backend->set('client_pt_setting_is_aktif', $client_pt_setting_is_aktif);
		$backend->set('client_wms_id', $client_wms_id);
		$backend->set('updwho', $this->session->userdata('pengguna_username'));
		$backend->set('updtgl', "GETDATE()", FALSE);

		$backend->where('client_pt_setting_piutang_id', $client_pt_setting_piutang_id);

		$backend->update("client_pt_setting_piutang");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $backend->last_query();
	}

	public function delete_client_pt_setting_piutang($client_pt_setting_piutang_id)
	{

		$backend = $this->load->database('backend', TRUE);

		$backend->where('client_pt_setting_piutang_id', $client_pt_setting_piutang_id);
		$backend->delete("client_pt_setting_piutang");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function delete_client_pt_setting_piutang_khusus($client_pt_setting_piutang_id)
	{

		$backend = $this->load->database('backend', TRUE);

		$backend->where('client_pt_setting_piutang_id', $client_pt_setting_piutang_id);
		$backend->delete("client_pt_setting_piutang_khusus");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function Get_brand_by_sku($sku_id)
	{

		$query = $this->db->query("select principle_brand_id, principle_brand_nama from principle_brand where principle_brand_id in (select principle_brand_id from sku where sku_id = '$sku_id')");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}
}
