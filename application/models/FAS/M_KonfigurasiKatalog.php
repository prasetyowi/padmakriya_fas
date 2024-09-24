<?php

class M_KonfigurasiKatalog extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function GetAllSKUHarga()
	{
		$query = $this->db->query("SELECT
								harga.sku_harga_id,
								harga.client_wms_id,
								harga.depo_id,
								harga.depo_group_nama,
								harga.sku_harga_kode,
								harga.sku_harga_keterangan,
								harga.sku_harga_startdate,
								harga.sku_harga_enddate,
								harga.sku_harga_status,
								harga.sku_harga_who_create,
								harga.sku_harga_tgl_create,
								harga.sku_harga_who_approve,
								harga.sku_harga_tgl_approve,
								harga.sku_harga_is_aktif,
								harga.sku_harga_is_delete,
								harga.sku_harga_id_before
								FROM sku_harga harga
								LEFT JOIN sku_harga_lokasi lokasi
								ON lokasi.sku_harga_id = harga.sku_harga_id
								WHERE lokasi.depo_id = '" . $this->session->userdata('depo_id') . "'
								GROUP BY harga.sku_harga_id,
										harga.client_wms_id,
										harga.depo_id,
										harga.depo_group_nama,
										harga.sku_harga_kode,
										harga.sku_harga_keterangan,
										harga.sku_harga_startdate,
										harga.sku_harga_enddate,
										harga.sku_harga_status,
										harga.sku_harga_who_create,
										harga.sku_harga_tgl_create,
										harga.sku_harga_who_approve,
										harga.sku_harga_tgl_approve,
										harga.sku_harga_is_aktif,
										harga.sku_harga_is_delete,
										harga.sku_harga_id_before");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetAllSKUPromo()
	{
		$query = $this->db->query("SELECT
									promo.sku_promo_id,
									promo.depo_group_id,
									promo.depo_id,
									promo.client_wms_id,
									promo.sku_promo_kode,
									promo.sku_promo_tgl_berlaku_awal,
									promo.sku_promo_tgl_berlaku_akhir,
									promo.sku_promo_keterangan,
									promo.sku_promo_status,
									promo.sku_promo_tgl_create,
									promo.sku_promo_who_create,
									promo.sku_promo_id_before
									FROM sku_promo promo
									LEFT JOIN sku_promo_lokasi lokasi
									ON lokasi.sku_promo_id = promo.sku_promo_id
									WHERE lokasi.depo_id = '92C32C09-4DDD-4094-8550-315E1964C92E'
									GROUP BY promo.sku_promo_id,
											promo.depo_group_id,
											promo.depo_id,
											promo.client_wms_id,
											promo.sku_promo_kode,
											promo.sku_promo_tgl_berlaku_awal,
											promo.sku_promo_tgl_berlaku_akhir,
											promo.sku_promo_keterangan,
											promo.sku_promo_status,
											promo.sku_promo_tgl_create,
											promo.sku_promo_who_create,
											promo.sku_promo_id_before");

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

	public function GetKonfigurasiKatalogByFilter($sku_katalog_setting_id)
	{
		if ($sku_katalog_setting_id != "") {
			$sku_katalog_setting_id = " AND hdr.sku_katalog_setting_id = '$sku_katalog_setting_id' ";
		} else {
			$sku_katalog_setting_id = "";
		}

		$query = $this->db->query("SELECT
									hdr.sku_katalog_setting_id,
									hdr.client_wms_id,
									hdr.depo_id,
									hdr.sku_katalog_setting_kode,
									hdr.sku_katalog_setting_keterangan,
									hdr.sku_katalog_setting_status,
									hdr.sku_katalog_setting_who_create,
									FORMAT(hdr.sku_katalog_setting_tgl_create, 'dd-MM-yyyy') AS sku_katalog_setting_tgl_create,
									ISNULL(hdr.sku_katalog_setting_who_approve,'') AS sku_katalog_setting_who_approve,
									ISNULL(FORMAT(hdr.sku_katalog_setting_tgl_approve, 'dd-MM-yyyy'),'') AS sku_katalog_setting_tgl_approve,
									CASE WHEN hdr.sku_katalog_setting_is_aktif = 1 THEN 'ACTIVE' ELSE 'NOT ACTIVE' END sku_katalog_setting_is_aktif,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori1), '') AS tipe_kategori1,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori2), '') AS tipe_kategori2,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori3), '') AS tipe_kategori3,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori4), '') AS tipe_kategori4,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori5), '') AS tipe_kategori5,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori6), '') AS tipe_kategori6
									FROM sku_katalog_setting hdr
									LEFT JOIN sku_katalog_setting_detail dtl
									ON dtl.sku_katalog_setting_id = hdr.sku_katalog_setting_id
									WHERE hdr.sku_katalog_setting_kode IS NOT NULL " . $sku_katalog_setting_id . "
									GROUP BY hdr.sku_katalog_setting_id,
											hdr.client_wms_id,
											hdr.depo_id,
											hdr.sku_katalog_setting_kode,
											hdr.sku_katalog_setting_keterangan,
											hdr.sku_katalog_setting_status,
											hdr.sku_katalog_setting_who_create,
											hdr.sku_katalog_setting_tgl_create,
											ISNULL(hdr.sku_katalog_setting_who_approve,''),
											ISNULL(FORMAT(hdr.sku_katalog_setting_tgl_approve, 'dd-MM-yyyy'),''),
											CASE WHEN hdr.sku_katalog_setting_is_aktif = 1 THEN 'ACTIVE' ELSE 'NOT ACTIVE' END,
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori1), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori2), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori3), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori4), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori5), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori6), '')");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetKonfigurasiHeader($sku_katalog_setting_id)
	{
		$query = $this->db->query("SELECT
									hdr.sku_katalog_setting_id,
									hdr.client_wms_id,
									hdr.depo_id,
									hdr.sku_katalog_setting_kode,
									hdr.sku_katalog_setting_keterangan,
									hdr.sku_katalog_setting_status,
									hdr.sku_katalog_setting_who_create,
									FORMAT(hdr.sku_katalog_setting_tgl_create, 'dd-MM-yyyy') AS sku_katalog_setting_tgl_create,
									ISNULL(hdr.sku_katalog_setting_who_approve,'') AS sku_katalog_setting_who_approve,
									ISNULL(FORMAT(hdr.sku_katalog_setting_tgl_approve, 'dd-MM-yyyy'),'') AS sku_katalog_setting_tgl_approve,
									CASE WHEN hdr.sku_katalog_setting_is_aktif = 1 THEN 'ACTIVE' ELSE 'NOT ACTIVE' END sku_katalog_setting_is_aktif,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori1), '') AS tipe_kategori1,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori2), '') AS tipe_kategori2,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori3), '') AS tipe_kategori3,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori4), '') AS tipe_kategori4,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori5), '') AS tipe_kategori5,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori6), '') AS tipe_kategori6
									FROM sku_katalog_setting hdr
									LEFT JOIN sku_katalog_setting_detail dtl
									ON dtl.sku_katalog_setting_id = hdr.sku_katalog_setting_id
									WHERE hdr.sku_katalog_setting_id = '$sku_katalog_setting_id'
									GROUP BY hdr.sku_katalog_setting_id,
											hdr.client_wms_id,
											hdr.depo_id,
											hdr.sku_katalog_setting_kode,
											hdr.sku_katalog_setting_keterangan,
											hdr.sku_katalog_setting_status,
											hdr.sku_katalog_setting_who_create,
											hdr.sku_katalog_setting_tgl_create,
											ISNULL(hdr.sku_katalog_setting_who_approve,''),
											ISNULL(FORMAT(hdr.sku_katalog_setting_tgl_approve, 'dd-MM-yyyy'),''),
											CASE WHEN hdr.sku_katalog_setting_is_aktif = 1 THEN 'ACTIVE' ELSE 'NOT ACTIVE' END,
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori1), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori2), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori3), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori4), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori5), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori6), '')");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetKonfigurasiDetail($sku_katalog_setting_id)
	{
		$query = $this->db->query("SELECT
									sku_katalog_setting_detail,
									sku_katalog_setting_id,
									ISNULL(tipe_kategori1, '') AS tipe_kategori1,
									ISNULL(CONVERT(varchar(50), kategori1_id), '') AS kategori1_id,
									ISNULL(tipe_kategori2, '') AS tipe_kategori2,
									ISNULL(CONVERT(varchar(50), kategori2_id), '') AS kategori2_id,
									ISNULL(tipe_kategori3, '') AS tipe_kategori3,
									ISNULL(CONVERT(varchar(50), kategori3_id), '') AS kategori3_id,
									ISNULL(tipe_kategori4, '') AS tipe_kategori4,
									ISNULL(CONVERT(varchar(50), kategori4_id), '') AS kategori4_id,
									ISNULL(tipe_kategori5, '') AS tipe_kategori5,
									ISNULL(CONVERT(varchar(50), kategori5_id), '') AS kategori5_id,
									ISNULL(tipe_kategori6, '') AS tipe_kategori6,
									ISNULL(CONVERT(varchar(50), kategori6_id), '') AS kategori6_id,
									ISNULL(CONVERT(varchar(50), sku_harga_id), '') AS sku_harga_id,
									ISNULL(CONVERT(varchar(50), sku_promo_id), '') AS sku_promo_id
									FROM sku_katalog_setting_detail
									WHERE sku_katalog_setting_id = '$sku_katalog_setting_id'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function cek_sku_katalog_setting($sku_katalog_setting_kode)
	{
		$this->db->select("*")
			->from("sku_katalog_setting")
			->where("sku_katalog_setting_kode", $sku_katalog_setting_kode)
			->order_by("sku_katalog_setting_kode");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function GetKategoriGroup()
	{
		// $this->db->select("kategori_grup")
		// 	->from("kategori")
		// 	->where('kategori_grup is NOT NULL', NULL, FALSE)
		// 	->where_not_in('kategori_grup', array("SubBrand", "Sub Brand"))
		// 	->group_by("kategori_grup")
		// 	->order_by("kategori_grup");
		// $query = $this->db->get();

		$query = $this->db->query("SELECT
									'SKU' AS tipe_kategori,
									kategori_grup
									FROM kategori
									WHERE kategori_grup NOT IN ('SubBrand', 'Sub Brand')
									GROUP BY kategori_grup
									UNION ALL
									SELECT
									'Customer' AS tipe_kategori,
									CONCAT('Segment', client_pt_segmen_level) AS client_pt_segmen_level
									FROM client_pt_segmen
									GROUP BY CONCAT('Segment', client_pt_segmen_level)
									UNION ALL
									SELECT 'SKU' AS tipe_kategori, 'SKU' AS kategori_grup
									UNION ALL
									SELECT 'Customer' AS tipe_kategori, 'Outlet' AS kategori_grup");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetKategoriByTipeKategori($tipe_kategori)
	{
		if ($tipe_kategori == "Principle") {
			$query = $this->db->query("select kategori_id, kategori_nama from kategori where kategori_grup = 'Principle' ORDER BY kategori_nama ASC");
		} else if ($tipe_kategori == "Brand") {
			$query = $this->db->query("select kategori_id, kategori_nama from kategori where kategori_grup = 'Brand' ORDER BY kategori_nama ASC");
		} else if ($tipe_kategori == "Category") {
			$query = $this->db->query("select kategori_id, kategori_nama from kategori where kategori_grup = 'Category' ORDER BY kategori_nama ASC");
		} else if ($tipe_kategori == "Sub Category") {
			$query = $this->db->query("select kategori_id, kategori_nama from kategori where kategori_grup = 'Sub Category' ORDER BY kategori_nama ASC");
		} else if ($tipe_kategori == "Jenis") {
			$query = $this->db->query("select kategori_id, kategori_nama from kategori where kategori_grup = 'Jenis' ORDER BY kategori_nama ASC");
		} else if ($tipe_kategori == "Segment1") {
			$query = $this->db->query("select client_pt_segmen_id AS kategori_id, client_pt_segmen_nama AS kategori_nama from client_pt_segmen where client_pt_segmen_level = '1' ORDER BY client_pt_segmen_nama ASC");
		} else if ($tipe_kategori == "Segment2") {
			$query = $this->db->query("select client_pt_segmen_id AS kategori_id, client_pt_segmen_nama AS kategori_nama from client_pt_segmen where client_pt_segmen_level = '2' ORDER BY client_pt_segmen_nama ASC");
		} else if ($tipe_kategori == "Segment3") {
			$query = $this->db->query("select client_pt_segmen_id AS kategori_id, client_pt_segmen_nama AS kategori_nama from client_pt_segmen where client_pt_segmen_level = '3' ORDER BY client_pt_segmen_nama ASC");
		} else if ($tipe_kategori == "SKU") {
			$query = $this->db->query("select sku_id, sku_kode, sku_nama_produk from sku ORDER BY sku_nama_produk ASC");
		} else if ($tipe_kategori == "Outlet") {
			$query = $this->db->query("select client_pt_id, client_pt_nama, client_pt_alamat from client_pt ORDER BY client_pt_nama ASC");
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

	public function GetKategoriBySKUOutlet($id, $kategori)
	{
		if ($kategori == "SKU") {
			$query = $this->db->query("select sku_id AS id, sku_kode AS nama from sku where sku_id = '$id' ORDER BY sku_nama_produk ASC");
		} else if ($kategori == "Outlet") {
			$query = $this->db->query("select client_pt_id AS id, client_pt_nama AS nama from client_pt where client_pt_id = '$id' ORDER BY client_pt_nama ASC");
		}

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row_array();
		}

		return $query;
	}

	public function getByKategori($kategori)
	{
		$this->load->model('M_DataTable');

		if ($kategori == 'SKU') {
			$sql = "SELECT ROW_NUMBER () OVER (ORDER BY sku_kode ASC) AS idx, sku_id, sku_kode, sku_nama_produk
		FROM sku";
		} else {
			$sql = "SELECT ROW_NUMBER () OVER (ORDER BY client_pt_nama ASC) AS idx, client_pt_id, client_pt_nama, client_pt_alamat
		FROM client_pt";
		}

		$response = $this->M_DataTable->dtTableGetList($sql);

		$output = array(
			"draw" => $response['draw'],
			"recordsTotal" => $response['recordsTotal'],
			"recordsFiltered" => $response['recordsFiltered'],
			"data" => $response['data'],
		);

		return $output;
	}

	public function insert_sku_katalog_setting($sku_katalog_setting_id, $client_wms_id, $depo_id, $sku_katalog_setting_kode, $sku_katalog_setting_keterangan, $sku_katalog_setting_status, $sku_katalog_setting_who_create, $sku_katalog_setting_tgl_create, $sku_katalog_setting_who_approve, $sku_katalog_setting_tgl_approve, $sku_katalog_setting_is_aktif)
	{
		$sku_katalog_setting_id =  $sku_katalog_setting_id ==  '' ? null : $sku_katalog_setting_id;
		$client_wms_id =  $client_wms_id ==  '' ? null : $client_wms_id;
		$depo_id =  $depo_id ==  '' ? null : $depo_id;
		$sku_katalog_setting_kode =  $sku_katalog_setting_kode ==  '' ? null : $sku_katalog_setting_kode;
		$sku_katalog_setting_keterangan =  $sku_katalog_setting_keterangan ==  '' ? null : $sku_katalog_setting_keterangan;
		$sku_katalog_setting_status =  $sku_katalog_setting_status ==  '' ? null : $sku_katalog_setting_status;
		$sku_katalog_setting_who_create =  $sku_katalog_setting_who_create ==  '' ? null : $sku_katalog_setting_who_create;
		$sku_katalog_setting_tgl_create =  $sku_katalog_setting_tgl_create ==  '' ? null : $sku_katalog_setting_tgl_create;
		$sku_katalog_setting_who_approve =  $sku_katalog_setting_who_approve ==  '' ? null : $sku_katalog_setting_who_approve;
		$sku_katalog_setting_tgl_approve =  $sku_katalog_setting_tgl_approve ==  '' ? null : $sku_katalog_setting_tgl_approve;
		$sku_katalog_setting_is_aktif =  $sku_katalog_setting_is_aktif ==  '' ? null : $sku_katalog_setting_is_aktif;

		$this->db->set('sku_katalog_setting_id', $sku_katalog_setting_id);
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('depo_id', $depo_id);
		$this->db->set('sku_katalog_setting_kode', $sku_katalog_setting_kode);
		$this->db->set('sku_katalog_setting_keterangan', $sku_katalog_setting_keterangan);
		// $this->db->set('sku_katalog_setting_status', $sku_katalog_setting_status);
		$this->db->set('sku_katalog_setting_who_create', $sku_katalog_setting_who_create);
		$this->db->set('sku_katalog_setting_tgl_create', "GETDATE()", FALSE);
		// $this->db->set('sku_katalog_setting_who_approve', $sku_katalog_setting_who_approve);
		// $this->db->set('sku_katalog_setting_tgl_approve', $sku_katalog_setting_tgl_approve);
		$this->db->set('sku_katalog_setting_is_aktif', $sku_katalog_setting_is_aktif);

		$queryinsert = $this->db->insert("sku_katalog_setting");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sku_katalog_setting_detail($sku_katalog_setting_detail, $sku_katalog_setting_id, $data)
	{
		// $sku_harga_detail_id = $data['sku_harga_detail_id'] === "" ? null : $data['sku_harga_detail_id'];
		$sku_katalog_setting_detail = $sku_katalog_setting_detail == '' ? null : $sku_katalog_setting_detail;
		$sku_katalog_setting_id = $sku_katalog_setting_id == '' ? null : $sku_katalog_setting_id;
		$tipe_kategori1 = $data['tipe_kategori1'] == '' ? null : $data['tipe_kategori1'];
		$kategori1_id = $data['kategori1_id'] == '' ? null : $data['kategori1_id'];
		$tipe_kategori2 = $data['tipe_kategori2'] == '' ? null : $data['tipe_kategori2'];
		$kategori2_id = $data['kategori2_id'] == '' ? null : $data['kategori2_id'];
		$tipe_kategori3 = $data['tipe_kategori3'] == '' ? null : $data['tipe_kategori3'];
		$kategori3_id = $data['kategori3_id'] == '' ? null : $data['kategori3_id'];
		$tipe_kategori4 = $data['tipe_kategori4'] == '' ? null : $data['tipe_kategori4'];
		$kategori4_id = $data['kategori4_id'] == '' ? null : $data['kategori4_id'];
		$tipe_kategori5 = $data['tipe_kategori5'] == '' ? null : $data['tipe_kategori5'];
		$kategori5_id = $data['kategori5_id'] == '' ? null : $data['kategori5_id'];
		$tipe_kategori6 = $data['tipe_kategori6'] == '' ? null : $data['tipe_kategori6'];
		$kategori6_id = $data['kategori6_id'] == '' ? null : $data['kategori6_id'];
		$sku_harga_id = $data['sku_harga_id'] == '' ? null : $data['sku_harga_id'];
		$sku_promo_id = $data['sku_promo_id'] == '' ? null : $data['sku_promo_id'];

		$this->db->set('sku_katalog_setting_detail', $sku_katalog_setting_detail);
		$this->db->set('sku_katalog_setting_id', $sku_katalog_setting_id);
		$this->db->set('tipe_kategori1', $tipe_kategori1);
		$this->db->set('kategori1_id', $kategori1_id);
		$this->db->set('tipe_kategori2', $tipe_kategori2);
		$this->db->set('kategori2_id', $kategori2_id);
		$this->db->set('tipe_kategori3', $tipe_kategori3);
		$this->db->set('kategori3_id', $kategori3_id);
		$this->db->set('tipe_kategori4', $tipe_kategori4);
		$this->db->set('kategori4_id', $kategori4_id);
		$this->db->set('tipe_kategori5', $tipe_kategori5);
		$this->db->set('kategori5_id', $kategori5_id);
		$this->db->set('tipe_kategori6', $tipe_kategori6);
		$this->db->set('kategori6_id', $kategori6_id);
		$this->db->set('sku_harga_id', $sku_harga_id);
		$this->db->set('sku_promo_id', $sku_promo_id);

		$queryinsert = $this->db->insert("sku_katalog_setting_detail");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sku_katalog_setting($sku_katalog_setting_id, $client_wms_id, $depo_id, $sku_katalog_setting_kode, $sku_katalog_setting_keterangan, $sku_katalog_setting_status, $sku_katalog_setting_who_create, $sku_katalog_setting_tgl_create, $sku_katalog_setting_who_approve, $sku_katalog_setting_tgl_approve, $sku_katalog_setting_is_aktif)
	{
		$sku_katalog_setting_id =  $sku_katalog_setting_id ==  '' ? null : $sku_katalog_setting_id;
		$client_wms_id =  $client_wms_id ==  '' ? null : $client_wms_id;
		$depo_id =  $depo_id ==  '' ? null : $depo_id;
		$sku_katalog_setting_kode =  $sku_katalog_setting_kode ==  '' ? null : $sku_katalog_setting_kode;
		$sku_katalog_setting_keterangan =  $sku_katalog_setting_keterangan ==  '' ? null : $sku_katalog_setting_keterangan;
		$sku_katalog_setting_status =  $sku_katalog_setting_status ==  '' ? null : $sku_katalog_setting_status;
		$sku_katalog_setting_who_create =  $sku_katalog_setting_who_create ==  '' ? null : $sku_katalog_setting_who_create;
		$sku_katalog_setting_tgl_create =  $sku_katalog_setting_tgl_create ==  '' ? null : $sku_katalog_setting_tgl_create;
		$sku_katalog_setting_who_approve =  $sku_katalog_setting_who_approve ==  '' ? null : $sku_katalog_setting_who_approve;
		$sku_katalog_setting_tgl_approve =  $sku_katalog_setting_tgl_approve ==  '' ? null : $sku_katalog_setting_tgl_approve;
		$sku_katalog_setting_is_aktif =  $sku_katalog_setting_is_aktif ==  '' ? null : $sku_katalog_setting_is_aktif;

		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('depo_id', $depo_id);
		$this->db->set('sku_katalog_setting_kode', $sku_katalog_setting_kode);
		$this->db->set('sku_katalog_setting_keterangan', $sku_katalog_setting_keterangan);
		// $this->db->set('sku_katalog_setting_status', $sku_katalog_setting_status);
		// $this->db->set('sku_katalog_setting_who_create', $sku_katalog_setting_who_create);
		// $this->db->set('sku_katalog_setting_tgl_create', "GETDATE()", FALSE);
		// $this->db->set('sku_katalog_setting_who_approve', $sku_katalog_setting_who_approve);
		// $this->db->set('sku_katalog_setting_tgl_approve', $sku_katalog_setting_tgl_approve);
		$this->db->set('sku_katalog_setting_is_aktif', $sku_katalog_setting_is_aktif);

		$this->db->where('sku_katalog_setting_id', $sku_katalog_setting_id);

		$queryupdate = $this->db->update("sku_katalog_setting");

		return $queryupdate;
		// return $this->db->last_query();
	}

	public function delete_sku_katalog_setting_detail($sku_katalog_setting_id)
	{
		$this->db->where('sku_katalog_setting_id', $sku_katalog_setting_id);
		$querydelete = $this->db->delete("sku_katalog_setting_detail");

		return $querydelete;
		// return $this->db->last_query();
	}
}
